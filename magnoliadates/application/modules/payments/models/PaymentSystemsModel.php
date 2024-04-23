<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

define('PAYMENTS_SYSTEMS_TABLE', DB_PREFIX . 'payments_systems');
define('PAYMENTS_LOG_TABLE', DB_PREFIX . 'payments_log');

/**
 * Payment systems model
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
class PaymentSystemsModel extends \Model
{

    const PAYMENT_SYSTEMS_PATH = '/models/systems/';
    const UPLOAD_FOLDER = 'payments-logo';

    private $fields = [
        'id',
        'gid',
        'name',
        'in_use',
        'date_add',
        'settings_data',
        'tarifs_type',
        'tarifs_editable',
        'tarifs_status',
        'tarifs_data',
        'logo',
        'is_card'
    ];
    private $current_driver_name = "";
    private $driver;
    private $systems_cache = [];
    private $log_data = true;

    /**
     * Module guid
     *
     * @var array
     */
    protected $module_gid = 'payment_systems';

    public function __construct()
    {
        parent::__construct();

        foreach ($this->ci->pg_language->languages as $value) {
            $this->fields[] = 'info_data_' . $value['id'];
        }
    }

    public function getSystemByGid($gid)
    {
        if (empty($this->systems_cache[$gid])) {
            $result = $this->ci->db->select(implode(", ", $this->fields))->from(PAYMENTS_SYSTEMS_TABLE)->where("gid", $gid)->get()->result_array();

            if (!empty($result)) {
                $this->systems_cache[$gid] = $this->format_system($result[0]);
            } else {
                $this->systems_cache[$gid] = [];
            }
        }

        return $this->systems_cache[$gid];
    }

    public function formatSystem($data)
    {
        $data["settings_data"] = unserialize($data["settings_data"]);

        $reference = $this->ci->pg_language->ds->get_reference($this->module_gid, $data['gid'] . '_operators');
        $data["operators_data"] = isset($reference['option']) ? $reference['option'] : [];
        $data["tarifs_status"] = unserialize($data["tarifs_status"]);
        $data["tarifs_data"] = unserialize($data["tarifs_data"]);
        if (!empty($data["info_data_" . $this->ci->pg_language->current_lang_id])) {
            $data["info_data"] = nl2br($data["info_data_" . $this->ci->pg_language->current_lang_id]);
        }
        if (!empty($data["logo"])) {
            $data["logo_path"] = realpath(FRONTEND_PATH . self::UPLOAD_FOLDER
                . DIRECTORY_SEPARATOR . $data['logo']);
            if ($data["logo_path"]) {
                $data["logo_url"] = FRONTEND_URL . self::UPLOAD_FOLDER . DIRECTORY_SEPARATOR
                    . $data['logo'] . '?random=' . rand(1, 999);
            } else {
                // Delete logo if the file does not exist
                log_message("error", '(payments) File "' . $data["logo"] . '" does not exist');
                $this->delete_logo($data['gid']);
            }
        }

        return $data;
    }

    public function getSystemList($params = [], $filter_object_ids = null, $order_by = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(PAYMENTS_SYSTEMS_TABLE);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $this->systems_cache[$r["gid"]] = $this->format_system($r);
            }

            return $data;
        }

        return [];
    }

    public function getActiveSystemList($order_by = ["name" => "ASC"])
    {
        $params["where"]["in_use"] = 1;

        return $this->get_system_list($params, null, $order_by);
    }

    public function getSystemCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(PAYMENTS_SYSTEMS_TABLE);

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

    public function validateSystem($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["gid"])) {
            $data["gid"] = strip_tags($data["gid"]);
            $data["gid"] = preg_replace("/[^a-z0-9]+/i", '', $data["gid"]);

            $return["data"]["gid"] = $data["gid"];

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_system_gid_incorrect', 'payments');
            }

            $param["where"]["gid"] = $return["data"]["gid"];
            if (!empty($id)) {
                $param["where"]["id <>"] = $id;
            }
            $gid_count = $this->get_system_count($param);
            if ($gid_count > 0) {
                $return["errors"][] = l('error_system_gid_already_exists', 'payments');
            }
        }

        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_system_name_incorrect', 'payments');
            }
        }

        if (isset($data["settings_data"])) {
            $return["data"]["settings_data"] = serialize($data["settings_data"]);
        }

        if (isset($data['tarifs_type'])) {
            $return["data"]["tarifs_type"] = intval($data["tarifs_type"]);
        }

        if (isset($data['tarifs_editable'])) {
            $return["data"]["tarifs_editable"] = $data["tarifs_editable"] ? 1 : 0;
        }

        if (isset($data["tarifs_status"])) {
            $return["data"]["tarifs_status"] = serialize($data["tarifs_status"]);
        }

        if (isset($data["tarifs_data"])) {
            $return["data"]["tarifs_data"] = serialize($data["tarifs_data"]);
        }

        if (isset($data["in_use"])) {
            $return["data"]["in_use"] = intval($data["in_use"]);
        }

        if (isset($data["info_data"])) {
            $return['data'] = array_merge($return['data'], $data["info_data"]);
        }

        if (isset($data["logo"])) {
            $return["data"]["logo"] = strip_tags($data["logo"]);
            if (empty($return["data"]["logo"])) {
                $return["errors"][] = l('error_system_logo_incorrect', 'payments');
            }
        }

        return $return;
    }

    public function validateInfoData($data)
    {
        $return = ["errors" => [], "data" => []];

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        if (isset($data['info_data_' . $default_lang_id])) {
            $return['data']['info_data_' . $default_lang_id] = trim($data['info_data_' . $default_lang_id]);
            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                if ($lid == $default_lang_id) {
                    continue;
                }
                if (!isset($data['info_data_' . $lid]) || empty($data['info_data_' . $lid])) {
                    $return['data']['info_data_' . $lid] = $return['data']['info_data_' . $default_lang_id];
                } else {
                    $return['data']['info_data_' . $lid] = trim($data['info_data_' . $lid]);
                }
            }
        }

        return $return;
    }

    public function saveSystem($id, $data)
    {
        if (is_null($id)) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(PAYMENTS_SYSTEMS_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(PAYMENTS_SYSTEMS_TABLE, $data);
        }
        unset($this->systems_cache[$data["gid"]]);

        return $id;
    }

    public function useSystem($gid, $use)
    {
        $data["in_use"] = intval($use);
        $this->ci->db->where('gid', $gid);
        $this->ci->db->update(PAYMENTS_SYSTEMS_TABLE, $data);
        unset($this->systems_cache[$gid]);
    }

    public function deleteSystem($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(PAYMENTS_SYSTEMS_TABLE);

        return;
    }

    public function createTableData()
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->createTableData();
    }

    public function deleteSystemByGid($gid)
    {
        $this->ci->db->where("gid", $gid);
        $this->ci->db->delete(PAYMENTS_SYSTEMS_TABLE);
        unset($this->systems_cache[$gid]);

        return;
    }

    // drivers methods
    public function loadDriver($system_gid)
    {
        if (!empty($this->current_driver_name) && $this->current_driver_name == $system_gid) {
            return true;
        }

        $driver_class = ucfirst($system_gid) . 'Model';
        $driver = NS_MODULES . 'payments\\models\\systems\\' . $driver_class;
        if (class_exists($driver)) {
            $this->driver = new $driver();
            $this->current_driver_name = $system_gid;
        } else {
            $this->current_driver_name = "";
            $this->driver = "";

            return false;
        }
    }

    public function validateSystemSettings($data)
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->validate_settings($data);
    }

    /**
     * Validate operator object of payment system for saving to data source
     *
     * @param string $system_gid   system guid
     * @param string $operator_gid operator guid
     * @param array  $data         operator data
     *
     * @return array
     */
    public function validateSystemOperator($system_gid, $operator_gid, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (empty($operator_gid)) {
            $reference = $this->ci->pg_language->ds->get_reference($this->module_gid, $system_gid . '_operators');
            if (!empty($reference["option"])) {
                $array_keys = array_keys($reference["option"]);
            } else {
                $array_keys = [0];
            }
            $return['data']['gid'] = strval(max($array_keys) + 1);
        } else {
            $return['data']['gid'] = strval($operator_gid);
        }

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        if (isset($data['name_' . $default_lang_id])) {
            $return['data']['name'][$default_lang_id] = trim(strip_tags($data['name_' . $default_lang_id]));
            if (empty($return['data']['name'][$default_lang_id])) {
                $return['errors'][] = l('error_empty_system_operator', 'payments');
            } else {
                foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                    if ($lid == $default_lang_id) {
                        continue;
                    }
                    if (!isset($data['name_' . $lid]) || empty($data['name_' . $lid])) {
                        $return['data']['name'][$lid] = $return['data']['name'][$default_lang_id];
                    } else {
                        $return['data']['name'][$lid] = trim(strip_tags($data['name_' . $lid]));
                        if (empty($return['data']['name'][$lid])) {
                            $return['errors'][] = l('error_empty_system_operator', 'payments');
                            break;
                        }
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Save operator data to data source
     *
     * @param string $system_gid   system guid
     * @param string $operator_gid operator guid
     * @param array  $data         operator data
     *
     * @return array
     */
    public function saveSystemOperator($system_gid, $operator_gid, $data)
    {
        foreach ($data as $lid => $string) {
            $reference = $this->ci->pg_language->ds->get_reference($this->module_gid, $system_gid . '_operators', $lid);
            $reference["option"][$operator_gid] = $string;
            $this->ci->pg_language->ds->set_module_reference($this->module_gid, $system_gid . '_operators', $reference, $lid);
        }
    }

    /**
     * Change sorting order of payment system operators
     *
     * @param string $system_gid  system guid
     * @param array  $sorter_data sorter data
     *
     * @return void
     */
    public function saveSystemOperatorsSorter($system_gid, $sorter_data)
    {
        $this->ci->pg_language->ds->set_reference_sorter($this->module_gid, $system_gid . '_operators', $sorter_data);
    }

    /**
     * Save operator data to data source
     *
     * @param string $system_gid   system guid
     * @param string $operator_gid operator guid
     *
     * @return array
     */
    public function deleteSystemOperator($system_gid, $operator_gid)
    {
        $system_data = $this->get_system_by_gid($system_gid);
        if ($system_data['tarifs_status'][$operator_gid]) {
            unset($system_data['tarifs_status'][$operator_gid]);
        }
        if ($system_data['tarifs_data'][$operator_gid]) {
            unset($system_data['tarifs_data'][$operator_gid]);
        }
        $save_data = ['gid' => $system_data['gid'], 'tarifs_status' => $system_data['tarifs_status'], 'tarifs_data' => $system_data['tarifs_data']];
        $validate_data = $this->validate_system($system_data['id'], $save_data);
        $this->save_system($system_data['id'], $validate_data['data']);

        foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
            $reference = $this->ci->pg_language->ds->get_reference($this->module_gid, $system_gid . '_operators', $lid);
            if (isset($reference["option"][$operator_gid])) {
                unset($reference["option"][$operator_gid]);
            }
            $this->ci->pg_language->ds->set_module_reference($this->module_gid, $system_gid . '_operators', $reference, $lid);
        }
    }

    /**
     * Validate payment system tarifs for saving to data source
     *
     * @param array $data tarifs data
     *
     * @return array
     */
    public function validateTarifsData(array $data = [])
    {
        $return = ['errors' => [], 'data' => []];

        foreach ($data as $key => $values) {
            if (!is_array($values)) {
                continue;
            }
            foreach ($values as $k => $v) {
                $return['data'][$key][$k] = floatval($v);
                if (empty($return['data'][$key][$k])) {
                    unset($return['data'][$key][$k]);
                }
            }
        }

        return $return;
    }

    public function getSystemDataMap()
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->getSettingsMap();
    }

    public function getHtmlDataMap()
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->getHtmlMap();
    }

    public function getSystemData()
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->payment_data;
    }

    public function actionRequest($system_gid, $payment_data)
    {
        if (empty($this->current_driver_name) || $this->current_driver_name != $system_gid) {
            $this->load_driver($system_gid);
        }
        if (!empty($this->current_driver_name)) {
            $system_settings = $this->get_system_by_gid($this->current_driver_name);
        } else {
            $system_settings = [];
        }
        if ($this->log_data) {
            $this->log_data($system_gid, "request", $payment_data);
        }
        if (method_exists($this->driver, 'funcRequest')) {
            return $this->driver->funcRequest($payment_data, $system_settings);
        } else {
            return false;
        }
    }

    public function actionResponce($system_gid, $payment_data)
    {
        if (empty($this->current_driver_name) || $this->current_driver_name != $system_gid) {
            $this->loadDriver($system_gid);
        }
        if (!empty($this->current_driver_name)) {
            $system_settings = $this->getSystemByGid($this->current_driver_name);
        } else {
            $system_settings = [];
        }
        if ($this->log_data) {
            $this->logData($system_gid, "responce", $payment_data);
        }

        return $this->driver->funcResponce($payment_data, $system_settings);
    }

    public function actionHtml($system_gid)
    {
        if (empty($this->current_driver_name) || $this->current_driver_name != $system_gid) {
            $this->load_driver($system_gid);
        }
        if (method_exists($this->driver, 'funcHtml')) {
            return $this->driver->funcHtml();
        } else {
            return false;
        }
    }

    public function actionValidate($system_gid, $payment_data)
    {
        if (empty($this->current_driver_name) || $this->current_driver_name != $system_gid) {
            $this->load_driver($system_gid);
        }
        if (!empty($this->current_driver_name)) {
            $system_settings = $this->get_system_by_gid($this->current_driver_name);
        } else {
            $system_settings = [];
        }

        return $this->driver->funcValidate($payment_data, $system_settings);
    }

    public function logData($system_gid, $log_type = "request", $log_data = [])
    {
        $data["system_gid"] = $system_gid;
        $data["date_add"] = date("Y-m-d H:i:s");
        $data["log_type"] = $log_type;
        $data["payment_data"] = serialize($log_data);
        $this->ci->db->insert(PAYMENTS_LOG_TABLE, $data);

        return;
    }

    /**
     * Upload payment system's logo
     *
     * @param string $system_gid
     * @param array  $size
     * @param string $field_name
     *
     * @return boolean
     */
    public function uploadLogo($system_gid, $size = ['width' => 100, 'height' => 100], $field_name = 'logo')
    {
        $return = ['error' => '', 'success' => false];
        $this->ci->load->helper('upload');

        // upload src file
        $upload_config = [
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => true,
        ];

        $path = FRONTEND_PATH . self::UPLOAD_FOLDER . DIRECTORY_SEPARATOR;
        $image_return = upload_file($field_name, $path, $upload_config);
        if (!empty($image_return['error'])) {
            $return['error'] = implode('<br>', $image_return['error']);
        } else {
            $new_name = $field_name . '_' . $system_gid . $image_return['data']['file_ext'];
            copy($image_return['data']['full_path'], $path . $new_name);
            @unlink($image_return['data']['full_path']);
            @ini_set('memory_limit', '512M');
            $this->ci->load->library('image_lib');

            $resize_config = [
                'width'          => $size['width'],
                'height'         => $size['height'],
                'source_image'   => $path . $new_name,
                'create_thumb'   => false,
                'maintain_ratio' => true,
                'master_dim'     => 'height',
            ];

            $this->ci->image_lib->initialize($resize_config);
            $this->ci->image_lib->resize();

            if (!empty($this->ci->image_lib->error_msg)) {
                $return['error'] = implode('<br>', $this->ci->image_lib->error_msg);
            } else {
                $return['success'] = true;
                $data['logo'] = $new_name;
                $this->ci->db->where('gid', $system_gid)->update(PAYMENTS_SYSTEMS_TABLE, $data);
            }
        }

        return $return;
    }

    /**
     * Delete payment system's logo
     *
     * @param string $system_gid
     *
     * @return bool
     */
    public function deleteLogo($system_gid)
    {
        $result = $this->ci->db->select('logo')
                ->from(PAYMENTS_SYSTEMS_TABLE)
                ->where('gid', $system_gid)->get()->result_array();
        $file_name = realpath(FRONTEND_PATH . self::UPLOAD_FOLDER
            . DIRECTORY_SEPARATOR . $result[0]['logo']);
        if ($file_name) {
            unlink($file_name);
        }
        $this->ci->db->where('gid', $system_gid)
            ->update(PAYMENTS_SYSTEMS_TABLE, ['logo' => '']);

        return true;
    }

    /**
     * Add payment system info language field
     *
     * @param integer $lang_id language identifier
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(PAYMENTS_SYSTEMS_TABLE, [
            'info_data_' . $lang_id => [
                'type' => 'TEXT',
                'null' => true
            ]
        ]);
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('info_data_' . $lang_id, 'info_data_' . $default_lang_id, false);
            $this->ci->db->update(PAYMENTS_SYSTEMS_TABLE);
        }
    }

    /**
     * Remove payment system info language field
     *
     * @param integer $lang_id language identifier
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(PAYMENTS_SYSTEMS_TABLE);
        $fields = ['info_data_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(PAYMENTS_SYSTEMS_TABLE, $field_name);
        }
    }

    public function actionJs($system_gid)
    {
        if (empty($this->current_driver_name) || $this->current_driver_name != $system_gid) {
            $this->load_driver($system_gid);
        }
        if (method_exists($this->driver, 'funcJs')) {
            return $this->driver->funcJs();
        } else {
            return false;
        }
    }

    public function getJs($payment_data, $system_settings)
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->getJs($payment_data, $system_settings);
    }

    public function attachPayment($payment_id, $email, $payment_method_id, $plan_id = null, $system_settings)
    {
        if (empty($this->current_driver_name)) {
            return false;
        }

        return $this->driver->attachPayment($payment_id, $email, $payment_method_id, $plan_id, $system_settings);
    }

    /**
     * Install payment systems list
     *
     * @return array
     */
    public function getInstallSystemData()
    {
        $payments = [];
        foreach (new \DirectoryIterator(MODULEPATH . PaymentsModel::MODULE_GID .
            self::PAYMENT_SYSTEMS_PATH) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            $payment_gid = $fileInfo->getBasename('Model.php');
            if (!empty($payment_gid)) {
                $data = $this->getSystemByGid($payment_gid);
                if (empty($data)) {
                    $this->loadDriver($payment_gid);
                    $system_data = $this->getSystemData();
                    if (!empty($system_data)) {
                        $payments[$payment_gid] = $system_data;
                    }
                }
            }
        }
        return $payments;
    }

    public function __call($name, $args)
    {
        $methods = [
            'action_request' => 'actionRequest',
            'action_responce' => 'actionResponce',
            'delete_logo' => 'deleteLogo',
            'delete_system' => 'deleteSystem',
            'delete_system_by_gid' => 'deleteSystemByGid',
            'delete_system_operator' => 'deleteSystemOperator',
            'format_system' => 'formatSystem',
            'get_active_system_list' => 'getActiveSystemList',
            'get_html_data_map' => 'getHtmlDataMap',
            'get_system_by_gid' => 'getSystemByGid',
            'get_system_count' => 'getSystemCount',
            'get_system_data' => 'getSystemData',
            'get_system_data_map' => 'getSystemDataMap',
            'get_system_list' => 'getSystemList',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'load_driver' => 'loadDriver',
            'log_data' => 'logData',
            'save_system' => 'saveSystem',
            'save_system_operator' => 'saveSystemOperator',
            'save_system_operators_sorter' => 'saveSystemOperatorsSorter',
            'upload_logo' => 'uploadLogo',
            'use_system' => 'useSystem',
            'validate_info_data' => 'validateInfoData',
            'validate_system' => 'validateSystem',
            'validate_system_operator' => 'validateSystemOperator',
            'validate_system_settings' => 'validateSystemSettings',
            'validate_tarifs_data' => 'validateTarifsData',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
