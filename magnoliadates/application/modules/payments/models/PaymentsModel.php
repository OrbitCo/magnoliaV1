<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

use Pg\Libraries\Analytics;
use Pg\Libraries\View;
use Pg\Libraries\EventDispatcher;
use Pg\modules\payments\models\events\EventPayments;
use Pg\modules\services\models\ServicesModel;

define('PAYMENTS_TABLE', DB_PREFIX . 'payments');
define('PAYMENTS_TYPES_TABLE', DB_PREFIX . 'payments_type');

/**
 * Payments main model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class PaymentsModel extends \Model
{
    const MODULE_GID = 'payments';

    const EVENT_PAYMENT_CHANGED = 'payments_payment_changed';

    const TYPE_PAYMENT = 'payment';

    const STATUS_PAYMENT_SENDED = 'payment_sended';
    const STATUS_PAYMENT_PROCESSED = 'payment_processed';
    const STATUS_PAYMENT_FAILED = 'payment_failed';
    const STATUS_PAYMENT_DELETED = 'payment_deleted';

    public $dashboard_events = [
        self::EVENT_PAYMENT_CHANGED,
    ];

    private $fields = [
        'id',
        'payment_type_gid',
        'id_user',
        'amount',
        'currency_gid',
        'status',
        'system_gid',
        'date_add',
        'date_update',
        'payment_data',
        'operation_type',
        'funds_from'
    ];
    // fields will be formatted on
    private $payment_data_registered_fields = ["name", "comment"];
    private $moderation_type = 'payments';

    private $_payment_operations = ['access' => 'access_permissions', 'services' => 'services'];

    public function getPaymentById($id)
    {
        $return = [];
        if (!empty($id)) {
            $result = $this->ci->db->select(implode(", ", $this->fields))
                    ->from(PAYMENTS_TABLE)
                    ->where("id", $id)
                    ->get()->result_array();
            $return = !empty($result[0]) ? $result[0] : [];

            if (!empty($return["payment_data"])) {
                $return["payment_data"] = unserialize($return["payment_data"]);
            }
            $return["id_payment"] = $return["id"];
        }
        return $return;
    }

    public function getPaymentList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(PAYMENTS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                if (!empty($r["payment_data"])) {
                    $r["payment_data"] = unserialize($r["payment_data"]);
                }
                $data[] = $r;
            }

            return $this->formatPayments($data);
        }

        return [];
    }

    public function formatPayments($data)
    {
        if (empty($data)) {
            return $data;
        }
        $this->ci->load->model('Access_permissions_model');
        $user_ids = $currency_gids = [];
        foreach ($data as $key => $payment) {
            if (empty($user_ids) || !in_array($payment["id_user"], $user_ids)) {
                $user_ids[] = $payment["id_user"];
            }
            if (empty($currency_gids) || !in_array($payment["currency_gid"], $currency_gids)) {
                $currency_gids[] = $payment["currency_gid"];
            }

            if (!empty($payment["payment_data"])) {
                foreach ($payment["payment_data"] as $param_id => $param_value) {
                    if (in_array($param_id, $this->payment_data_registered_fields)) {
                        $payment["payment_data_formatted"][$param_id] = [
                            "name"  => l('html_field_' . $param_id, 'payments'),
                            "value" => nl2br($param_value),
                        ];
                    }
                }
                if (!empty($payment["payment_data"]["lang"]) && !empty($payment["payment_data"]["module"])) {
                    if ($payment["payment_data"]["module"] == 'access_permissions') {
                        $payment["payment_data"]['name'] = l(
                            $payment["payment_data"]["lang"],
                            $payment["payment_data"]["module"],
                            '',
                            "text",
                            ['group_name' =>
                                $this->ci->Access_permissions_model->getGroupNameByPaymentTypeGid($payment['payment_type_gid'])]
                        );
                    } else {
                        $payment["payment_data"]['name'] = l($payment["payment_data"]["lang"], $payment["payment_data"]["module"]);
                    }
                }
            }
            $data[$key] = $payment;
        }

        if (!empty($user_ids)) {
            $this->ci->load->model('Users_model');
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $user_ids);
        }

        if (!empty($currency_gids)) {
            $this->ci->load->model("payments/models/Payment_currency_model");
            $params["where_in"]["gid"] = $currency_gids;
            $currencies = $this->ci->Payment_currency_model->get_currency_list_by_key($params);
        }
        foreach ($data as $key => $payment) {
            if (!empty($users[$payment["id_user"]])) {
                $payment["user"] = $users[$payment["id_user"]];
            } else {
                $payment["user"] = $this->ci->Users_model->format_default_user($payment["id_user"]);
            }
            if (!empty($currencies[$payment["currency_gid"]])) {
                $payment["currency"] = $currencies[$payment["currency_gid"]];
            }
            $data[$key] = $payment;
        }
        return $data;
    }

    public function getPaymentCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(PAYMENTS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function validatePayment($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["payment_type_gid"])) {
            $return["data"]["payment_type_gid"] = $data["payment_type_gid"];
        }

        if (isset($data["id_user"])) {
            $return["data"]["id_user"] = intval($data["id_user"]);
        }

        if (isset($data["amount"])) {
            $return["data"]["amount"] = abs(floatval($data["amount"]));
        }

        if (isset($data["currency_gid"])) {
            $return["data"]["currency_gid"] = $data["currency_gid"];
        }

        if (isset($data["status"])) {
            $return["data"]["status"] = intval($data["status"]);
        }

        if (isset($data["system_gid"])) {
            $return["data"]["system_gid"] = $data["system_gid"];
            $data["payment_data"]["system_gid"] = $data["system_gid"];
        }

        if (isset($data["payment_data"])) {
            if (!empty($data["payment_data"]["comment"])) {
                $this->ci->load->model('moderation/models/Moderation_badwords_model');
                $bw_count = $this->ci->Moderation_badwords_model->check_badwords(
                    $this->moderation_type,
                    $data["payment_data"]["comment"]
                );
                if ($bw_count) {
                    $return['errors'][] = l('error_badwords_comment', 'payments');
                }
            }
            $return["data"]["payment_data"] = serialize($data["payment_data"]);
        }

        return $return;
    }

    /**
     * Save payment and set indicator to the menu
     *
     * @param integer $id
     * @param array $data
     * @param boolean $is_funds_from_account If true, funds are add/spend from
     *        the users' account, it is not real payment, we save it here for the statistics
     * @return integer
     */
    public function savePayment($id, $data, $is_funds_from_account = false)
    {
        if (is_null($id)) {
            if (!$is_funds_from_account) {
                $data["date_add"] = $data["date_update"] = date("Y-m-d H:i:s");
            } else {
                $data["date_update"] = $data["date_add"];
            }
            $this->ci->db->insert(PAYMENTS_TABLE, $data);
            $id = $this->ci->db->insert_id();

            if (!$is_funds_from_account) {
                /**
                 * It is real payment (not from account), so we add indicator to the Menu
                 */
                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->add('new_payment_item', $this->ci->db->insert_id());
            }
        } else {
            $data["date_update"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $id);
            $this->ci->db->update(PAYMENTS_TABLE, $data);
        }

        return $id;
    }

    public function addPayment($data, $is_event_dashboard = 1)
    {
        $payment_id = $this->savePayment(null, $data);

        if ($is_event_dashboard === 1) {
            $this->sendEvent(self::EVENT_PAYMENT_CHANGED, [
                'id' => $payment_id,
                'type' => self::TYPE_PAYMENT,
                'status' => self::STATUS_PAYMENT_SENDED,
            ]);
        }

        return $payment_id;
    }

    public function sendEvent($event_gid, $event_data)
    {
        $event_data['module'] = PaymentsModel::MODULE_GID;
        $event_data['action'] = $event_gid;

        $event = new EventPayments();
        $event->setData($event_data);

        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, $event_gid);
    }

    public function deletePayment($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(PAYMENTS_TABLE);

        $this->sendEvent(self::EVENT_PAYMENT_CHANGED, [
            'id' => $id,
            'type' => self::TYPE_PAYMENT,
            'status' => self::STATUS_PAYMENT_DELETED,
        ]);
    }

    private function addEventPayment($payment_data)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventPayments();
        $event->setData($payment_data);
        $event_handler->dispatch($event, 'receive_payment_event');
    }

    // Payment types

    public function getPaymentTypeById($id)
    {
        $result = $this->ci->db->select("id, gid, callback_module, callback_model, callback_method")->from(PAYMENTS_TYPES_TABLE)->where("id", $id)->get()->result_array();
        $return = (!empty($result)) ? $result[0] : [];

        return $return;
    }

    public function getPaymentTypeByGid($gid)
    {
        $gid_exp = explode('_', $gid);
        if (array_key_exists($gid_exp[0], $this->_payment_operations)) {
            $gid = $this->_payment_operations[$gid_exp[0]];
        }

        $result = $this->ci->db->select("id, gid, callback_module, callback_model, callback_method")->from(PAYMENTS_TYPES_TABLE)->where("gid", $gid)->get()->result_array();
        $return = (!empty($result)) ? $result[0] : [];

        return $return;
    }

    public function getPaymentTypeList($params = [], $filter_object_ids = null, $order_by = null)
    {
        $this->ci->db->select('id, gid, callback_module, callback_model, callback_method')->from(PAYMENTS_TYPES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function getPaymentTypeCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt")->from(PAYMENTS_TYPES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function validatePaymentType($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["gid"])) {
            $data["gid"] = strip_tags($data["gid"]);
            $data["gid"] = preg_replace("/[^a-z0-9]+/i", '', $data["gid"]);

            $return["data"]["gid"] = $data["gid"];

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_payment_type_code_incorrect', 'payments');
            }
        }

        if (isset($data["callback_module"])) {
            $return["data"]["callback_module"] = $data["callback_module"];
        }

        if (isset($data["callback_model"])) {
            $return["data"]["callback_model"] = $data["callback_model"];
        }

        if (isset($data["callback_method"])) {
            $return["data"]["callback_method"] = $data["callback_method"];
        }

        return $return;
    }

    public function savePaymentType($id, $data, $name = null)
    {
        if (is_null($id)) {
            $this->ci->db->insert(PAYMENTS_TYPES_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(PAYMENTS_TYPES_TABLE, $data);
        }

        if (!empty($name)) {
            $languages = $this->ci->pg_language->languages;
            if (!empty($languages)) {
                $lang_ids = array_keys($languages);
                $this->ci->pg_language->pages->set_string_langs('payments', "payment_type_name_" . $id, $name, $lang_ids);
            }
        }

        return $id;
    }

    public function deletePaymentType($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(PAYMENTS_TYPES_TABLE);
        $this->ci->pg_language->pages->delete_string("payments", "payment_type_name_" . $id);

        return;
    }

    public function deletePaymentTypeByGid($gid)
    {
        $payment_type_data = $this->get_payment_type_by_gid($gid);
        if (!empty($payment_type_data["id"])) {
            return $this->delete_payment_type($payment_type_data["id"]);
        } else {
            return false;
        }
    }

    public function changePaymentStatus($id_payment, $status)
    {
        $payment_data = $this->getPaymentById($id_payment);
        if (empty($payment_data)) {
            return false;
        }

        if (
            ($payment_data["status"] != $status)
            || ((strpos($payment_data['payment_type_gid'], 'access_permissions') !== false)
            && $payment_data['payment_data']['is_recurring'] == 1
            && $status == 1)
        ) {
            $payment_type = $this->getPaymentTypeByGid($payment_data["payment_type_gid"]);
            $model_name = ucfirst($payment_type["callback_model"]);
            $model_path = strtolower($payment_type["callback_module"] . "/models/") . $model_name;

            $this->ci->load->model($model_path);
            $this->ci->{$model_name}->{$payment_type["callback_method"]}($payment_data, $status);

            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->delete('new_payment_item', $id_payment, true);

            $this->savePayment($id_payment, ["status" => $status]);

            $this->ci->load->model('payments/models/Payment_currency_model');
            $amount_usd = $this->ci->Payment_currency_model->convertToUSD(
                $payment_data['amount'],
                $payment_data['currency_gid']
            );

            $this->sendEvent(self::EVENT_PAYMENT_CHANGED, [
                'id' => $id_payment,
                'type' => self::TYPE_PAYMENT,
                'status' => $status == 1 ? self::STATUS_PAYMENT_PROCESSED : self::STATUS_PAYMENT_FAILED,
                'amount' => $amount_usd,
            ]);

            if ($payment_data['payment_data']['is_recurring'] == 1) {
                $this->ci->load->library('Analytics');
                $event = $this->ci->analytics->getEvent('payments', 'purchase_recurring_first', 'user');
                $this->ci->analytics->track($event);
            }
        }

    }

    public function validatePaymentForm($data)
    {
        $good = true;
        if (!$data["amount"]) {
            $good = false;
        }
        if (!$data["currency_gid"]) {
            $good = false;
        }

        return $good;
    }

    public function updateLangs($data, $langs_file, $langs_ids)
    {
        foreach ($data as $item) {
            $payment_type = $this->get_payment_type_by_gid($item['gid']);
            $this->ci->pg_language->pages->set_string_langs('payments', "payment_type_name_" . $payment_type['id'], $langs_file[$item['gid']], (array) $langs_ids);
        }
    }

    public function exportLangs($data, $langs_ids)
    {
        foreach ($data as $item) {
            $payment_type = $this->get_payment_type_by_gid($item['gid']);
            $gids[$item['gid']] = 'payment_type_name_' . $payment_type['id'];
        }
        $langs_data = $this->ci->pg_language->export_langs('payments', $gids, $langs_ids);
        $export = (count(array_keys($gids)) == count($langs_data)) ? array_combine(array_keys($gids), $langs_data) : [];

        return $export;
    }

    public function formatDashboardRecords($data)
    {
        $data = $this->format_payments($data);

        foreach ($data as $key => $value) {
            $this->ci->view->assign('data', $value);
            $data[$key]['content'] = $this->ci->view->fetch('dashboard', 'admin', 'payments');
        }

        return $data;
    }

    public function getDashboardData($payment_id, $status)
    {
        if ($status != self::STATUS_PAYMENT_SENDED) {
            return false;
        }

        $data = $this->get_payment_by_id($payment_id, false, false);
        $data['dashboard_header'] = 'header_user_payment';
        $data['dashboard_action_link'] = 'admin/payments';

        return $data;
    }

    /**
     * Get payments data
     *
     * @param array $params
     *
     * @return array
     */
    public function getPaymentsData(array $params)
    {
        return $this->getPaymentList(null, null, null, $params);
    }

    public function getAdminPaymentsTypesList()
    {
        $types = $this->getPaymentTypeList();

        foreach ($types as $key => $type) {
            $types[$key]['name'] = l('payment_type_name_' . $type['id'], 'payments');
        }

        $cnt = count($types);
        if ($this->ci->pg_module->is_module_installed('referral_links')) {
            $types[$cnt++] = [
                'gid' => 'referral_bonus',
                'name' => l('referral_link_bonus', 'referral_links')
            ];
        }
        if ($this->ci->pg_module->is_module_installed('bonuses')) {
            $types[$cnt++] = [
                'gid' => 'bonus',
                'name' => l('payment_stat_bonuses', 'bonuses')
            ];
        }

        if ($this->ci->pg_module->is_module_installed('services')) {
            $this->ci->load->model('Services_model');
            $services = $this->ci->Services_model->getServiceList(['where' => ['status' => 1]], null, null);
            foreach ($services as $service) {
                $types[$cnt++] = [
                    'gid' => ServicesModel::PAYMENT_TYPE_GID_PREFIX . $service['gid'],
                    'name' => $service['name']
                ];
            }
            foreach ($types as $key => $type) {
                if ($type['gid'] == 'services') {
                    unset($types[$key]);
                }
            }
        }
        return $types;
    }
    /**
     * Get the list of all available in product payments systems
     *
     * @return array
     */
    public function getAdminPaymentsSystemsList()
    {
        $this->ci->load->model("payments/models/Payment_systems_model");
        $systems  = $this->ci->Payment_systems_model->get_system_list();

        $asystems = [ 'manual' =>
            ['gid' => 'manual', 'name' => l('manual_system_payment', 'payments')]
        ];

        foreach ($systems as $system) {
            $asystems[$system['gid']] = $system;
        }

        if (array_key_exists('offline', $asystems)) {
            $asystems['offline']['name'] = l('offline_system_payment', 'payments');
        }

        if (!array_key_exists('inapp_purchase', $asystems)) {
            $asystems['inapp_purchase'] = [
                'name' => l('added_by_inapp', 'mobile'),
                'gid' => 'inapp_purchase'
            ];
        }

        if (!array_key_exists('account', $asystems)) {
            $asystems['account'] = [
                'name' => l('account_payment', 'payments'),
                'gid' => 'account'
            ];
        }

        return $asystems;
    }

    public function declinePaymentsData($user_id)
    {
        $payments = $this->getPaymentList(null, null, null, [
            'where' => [
                'status' => '0',
                'id_user' => $user_id
            ]
        ]);
        if (!empty($payments)) {
            $this->ci->load->helper('payments');
            foreach ($payments as $payment_data) {
                $payment_data["status"] = -1;
                $payment_data["id_payment"] = $payment_data["id"];
                \Pg\modules\payments\helpers\receivePayment('manual', $payment_data);
            }
        }
    }

    public function cronUpdateCurrencyRates()
    {
        $time_to_declined = $this->ci->db->select('settings')
            ->where('method', 'cron_update_currency_rates')
            ->get(CRONJOB_TABLE)
            ->result();

        if (empty($time_to_declined)) {
            return false;
        }

        $time_to_declined = json_decode($time_to_declined[0]->settings, true);
        if (!empty($time_to_declined)) {
            $time_to_declined = $time_to_declined['time'];
            $date_to_declined = date('Y-m-d H:i:s', strtotime('-' . $time_to_declined . ' minutes'));

            $updatedId =   $this->ci->db
                ->where('status', 0)
                ->where('date_add <=', $date_to_declined)
                ->get(DB_PREFIX . 'payments')
                ->result_array();

            if (!empty($updatedId)) {
                $array_ids = array_column($updatedId, 'id');
                $this->ci->db
                    ->where_in('id', $array_ids)
                    ->update(DB_PREFIX . 'payments', ['status' => '-1']);

                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->delete('new_payment_item', $array_ids, true);
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_payment' => 'addPayment',
            'change_payment_status' => 'changePaymentStatus',
            'delete_payment' => 'deletePayment',
            'delete_payment_type' => 'deletePaymentType',
            'format_payments' => 'formatPayments',
            'delete_payment_type_by_gid' => 'deletePaymentTypeByGid',
            'export_langs' => 'exportLangs',
            'get_payment_by_id' => 'getPaymentById',
            'get_payment_count' => 'getPaymentCount',
            'get_payment_list' => 'getPaymentList',
            'get_payment_type_by_gid' => 'getPaymentTypeByGid',
            'get_payment_type_by_id' => 'getPaymentTypeById',
            'get_payment_type_count' => 'getPaymentTypeCount',
            'get_payment_type_list' => 'getPaymentTypeList',
            'save_payment' => 'savePayment',
            'save_payment_type' => 'savePaymentType',
            'update_langs' => 'updateLangs',
            'validate_payment' => 'validatePayment',
            'validate_payment_form' => 'validatePaymentForm',
            'validate_payment_type' => 'validatePaymentType',
            'cron_update_currency_rates' => 'cronUpdateCurrencyRates',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
