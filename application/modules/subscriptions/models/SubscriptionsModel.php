<?php

declare(strict_types=1);

namespace Pg\modules\subscriptions\models;

if (!defined('SUBSCRIPTIONS_TABLE')) {
    define('SUBSCRIPTIONS_TABLE', DB_PREFIX . 'subscriptions');
}

/**
 * Subscriptions main model
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
class SubscriptionsModel extends \Model
{
    private $attrs = ['id', /*'gid',*/ 'id_template', 'subscribe_type', 'id_content_type', 'scheduler'];

    public function getSubscriptionsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(SUBSCRIPTIONS_TABLE);

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

    public function getSubscriptionsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TABLE);

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
                if (in_array($field, $this->attrs)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $data = [];
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $r['scheduler'] = $this->get_scheduler_format($r['scheduler']);
                $data[] = $this->formatSubscription($r, true);
            }
        }

        return $data;
    }

    public function formatSubscription($data, $get_langs = false)
    {
        $data["name_i"] = "subscription_" . $data["id"];
        $data["name"] = ($get_langs) ? (l($data["name_i"], 'subscriptions')) : "";
        if ($data['scheduler']['type'] == 1) {
            $data["scheduler_format"] = l('manual', 'subscriptions');
        }
        if ($data['scheduler']['type'] == 2) {
            $data["scheduler_format"] = l('in_time', 'subscriptions') . ' ' . $data['scheduler']['date'] . ' ' . $data['scheduler']['hours'] . ':' . $data['scheduler']['minutes'];
        }
        if ($data['scheduler']['type'] == 3) {
            $data["scheduler_format"] = l('every_time', 'subscriptions') . ' ' . l($data['scheduler']['period'], 'subscriptions') . ' ' . l('since', 'subscriptions') . ' ' . $data['scheduler']['date'] . ' ' . $data['scheduler']['hours'] . ':' . $data['scheduler']['minutes'];
        }

        return $data;
    }

    public function getSubscriptionByGid($gid)
    {
        $data = [];
        $result = $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TABLE)->where("gid", $gid)->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }
        $data['scheduler'] = $this->get_scheduler_format($data['scheduler']);

        return $data;
    }

    public function getSchedulerFormat($sheduler_str)
    {
        $return = unserialize($sheduler_str);

        return $return;
    }

    public function getSubscriptionById($id)
    {
        $data = [];
        $result = $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TABLE)->where("id", $id)->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
            $data['scheduler'] = $this->get_scheduler_format($data['scheduler']);
        }

        return $data;
    }

    public function validateSubscription($id, $data, $langs)
    {
        $return = ["errors" => [], "data" => [], 'langs' => []];
        if (isset($data['scheduler_type'])) {
            if (empty($data['scheduler_type'])) {
                $return['errors'][] = l('error_scheduler_type_mondatory', 'subscriptions');
            }
            $sheduler_array = [];
            $sheduler_array['type'] = intval($data['scheduler_type']);
            $sheduler_array['date_for_cron'] = 0;
            if (intval($data['scheduler_type']) == 2 || intval($data['scheduler_type']) == 3) {
                $sheduler_array['date'] = strval($data['scheduler_date']);
                $sheduler_array['hours'] = intval($data['scheduler_hours']);
                $sheduler_array['minutes'] = intval($data['scheduler_minutes']);
                $sheduler_array['date_for_cron'] = strtotime($sheduler_array['date'] . ' ' . $sheduler_array['hours'] . ':' . $sheduler_array['minutes']);
            }
            if (intval($data['scheduler_type']) == 3) {
                $sheduler_array['period'] = strval($data['scheduler_period']);
            }
            $return["data"]["scheduler"] = serialize($sheduler_array);
        }
        if (isset($data["id_template"])) {
            $return["data"]["id_template"] = intval($data["id_template"]);
        }

        if (isset($data["subscribe_type"])) {
            $return["data"]["subscribe_type"] = strip_tags($data["subscribe_type"]);
        }

        if (isset($data["id_content_type"])) {
            $return["data"]["id_content_type"] = intval($data["id_content_type"]);
        }

        if (isset($langs)) {
            $langs_data = $this->ci->pg_language->getNamesDifferentLangs($langs);
            if ($langs_data === false) {
                $return["errors"][] = l('error_name_mandatory_field', 'subscriptions');
            } else {
                $return["langs"] = $langs_data;
            }
        }

        return $return;
    }

    public function saveSubscription($id, $data, $langs = null)
    {
        if (is_null($id)) {
            $this->ci->db->insert(SUBSCRIPTIONS_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(SUBSCRIPTIONS_TABLE, $data);
        }

        if (!empty($id) && !empty($langs)) {
            $languages = $this->ci->pg_language->languages;
            $lang_ids = array_keys($languages);
            $this->ci->pg_language->pages->set_string_langs('subscriptions', "subscription_" . $id, $langs, $lang_ids);
        }

        return $id;
    }

    public function deleteSubscription($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(SUBSCRIPTIONS_TABLE);

        return;
    }

    public function deleteSubscriptionByGid($gid)
    {
        $this->ci->db->where("gid", $gid);
        $this->ci->db->delete(SUBSCRIPTIONS_TABLE);

        return;
    }

    public function sendSubscription($id, $page = null, $limit = 1000)
    {
        $this->ci->load->model([
            'subscriptions/models/Subscriptions_users_model',
            'subscriptions/models/Subscriptions_types_model',
            'notifications/models/Templates_model',
            'notifications/models/Sender_model']);
        $count = $this->ci->Subscriptions_users_model->get_subscription_users_count($id);
        $data = ['sended' => 0, 'have_to_send' => 0];
        if ($count) {
            $users = $this->ci->Subscriptions_users_model->get_users_by_id_subscription($id, $page, $limit);
            $subscription_object = $this->get_subscription_by_id($id);
            $template = $this->ci->Templates_model->getTemplateById($subscription_object['id_template']);

            //generate template
            $installed_langs    = $this->ci->pg_language->get_langs('is_default DESC');
            $content = [];
            foreach ($installed_langs as $lang_id => $lang_info) {
                $vars = $this->ci->Subscriptions_types_model->getSubscriptionsTypeContent($subscription_object['id_content_type'], $lang_id);
                $content[$lang_id] = $this->ci->Templates_model->compileTemplate($template['gid'], $vars, $lang_id);
            }

            foreach ($users as $key => $user) {
                $this->ci->Sender_model->push($user['email'], $content[$user['lang_id']]['subject'], $content[$user['lang_id']]['content'], $template['content_type']);
            }

            $data['sended'] = count($users);
            if ($count > $page * $limit) {
                $data['have_to_send'] = 1;
            } else {
                $data['have_to_send'] = 0;
            }
        }

        return $data;
    }

    public function cronSendSubscriptions()
    {
        $subscriptions_list = $this->getSubscriptionsList();
        foreach ($subscriptions_list as $key => $value) {
            if ($value['scheduler']['type'] != 1 && $value['scheduler']['date_for_cron'] != 0 && $value['scheduler']['date_for_cron'] < time()) {
                $this->sendSubscription($value['id']);
                if ($value['scheduler']['type'] == 2) {
                    $value['scheduler']['date_for_cron'] = 0;
                } elseif ($value['scheduler']['type'] == 3) {
                    $d = $value['scheduler']['date_for_cron'];
                    if ($value['scheduler']['period'] == 'day') {
                        $value['scheduler']['date_for_cron'] = mktime(date("H", $d), date("i", $d), date("s", $d), date("n", $d), date("j", $d) + 1, date("Y", $d));
                    } elseif ($value['scheduler']['period'] == 'week') {
                        $value['scheduler']['date_for_cron'] = mktime(date("H", $d), date("i", $d), date("s", $d), date("n", $d), date("j", $d) + 7, date("Y", $d));
                    } elseif ($value['scheduler']['period'] == 'month') {
                        $value['scheduler']['date_for_cron'] = mktime(date("H", $d), date("i", $d), date("s", $d), date("n", $d) + 1, date("j", $d), date("Y", $d));
                    }
                }
                $data = ['scheduler' => serialize($value['scheduler'])];
                $this->saveSubscription($value['id'], $data);
            }
        }
    }

    public function updateLangs($model, $subscriptions, $langs_file, $langs_ids)
    {
        foreach ($subscriptions as $subscription) {
            $subscr = $this->get_subscription_by_gid($subscription['gid']);
            $this->ci->pg_language->pages->set_string_langs('subscriptions',
                                                            'subscription_' . $subscr['id'],
                                                            $langs_file[$subscription['gid']],
                                                            (array) $langs_ids);
            $this->ci->pg_language->pages->set_string_langs($model,
                                                            'subscriptions_type_' . $subscription['gid'],
                                                            $langs_file[$subscription['gid']],
                                                            (array) $langs_ids);
        }

        return true;
    }

    public function exportLangs($subscriptions, $langs_ids = null)
    {
        foreach ($subscriptions as $subscription) {
            $subscr = $this->get_subscription_by_gid($subscription['gid']);
            $gids[$subscription['gid']] = 'subscription_' . $subscr['id'];
        }
        $langs = $this->ci->pg_language->export_langs('subscriptions', $gids, $langs_ids);

        return array_combine(array_keys($gids), $langs);
    }

    public function __call($name, $args)
    {
        $methods = [
            'cron_send_subscriptions' => 'cronSendSubscriptions',
            'delete_subscription' => 'deleteSubscription',
            'delete_subscription_by_gid' => 'deleteSubscriptionByGid',
            'export_langs' => 'exportLangs',
            'format_subscription' => 'formatSubscription',
            'get_scheduler_format' => 'getSchedulerFormat',
            'get_subscription_by_gid' => 'getSubscriptionByGid',
            'get_subscription_by_id' => 'getSubscriptionById',
            'get_subscriptions_count' => 'getSubscriptionsCount',
            'get_subscriptions_list' => 'getSubscriptionsList',
            'save_subscription' => 'saveSubscription',
            'send_subscription' => 'sendSubscription',
            'update_langs' => 'updateLangs',
            'validate_subscription' => 'validateSubscription',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
