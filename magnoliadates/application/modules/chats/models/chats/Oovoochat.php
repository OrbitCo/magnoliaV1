<?php

declare(strict_types=1);

namespace Pg\modules\chats\models\chats;

define('OOVOOCHATS_TABLE', DB_PREFIX . 'oovoochats');

/**
 * Chats model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 */
class Oovoochat extends ChatAbstract
{
    protected $_name = 'Oovoo videochat';

    protected $_gid = 'oovoochat';

    protected $_activities = ['own_page'];

    protected $_settings = [
        'app_token' => '',
        'test_mode' => 0,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('Chats_model');
    }

    public function includeBlock()
    {
        return false;
    }

    public function hasFiles()
    {
        return true;
    }

    public function userPage($subpage = 'outbox', $page = 1)
    {
        if (empty($subpage)) {
            $subpage = 'outbox';
        }

        $this->ci->view->assign('settings', $this->_settings);

        if ($subpage == 'outbox') {
            $params['where_sql'][] = "invite_user_id='" . $this->session->userdata('user_id') . "'";
        } else {
            $params['where_sql'][] = "(invited_user_id='" . $this->session->userdata('user_id') . "' AND (status!='canceled' AND status!='decline'))";
        }

        $last_chats = $this->last_chats($page, $params, false, $subpage);
        $this->ci->view->assign('last_chats', $last_chats);

        $this->ci->view->assign('folder', $subpage);

        return $this->ci->view->fetch('oovoochat_user', 'user', 'chats');
    }

    public function adminPage()
    {
        $this->ci->view->assign('chat', $this->as_array());

        return $this->ci->view->fetch($this->get_tpl_name());
    }

    public function installPage()
    {
        $this->ci->Chats_model->set_installed($this->_gid);

        return;
    }

    public function validateSettings()
    {
        $this->_settings['app_token'] = trim($this->_settings['app_token']);
        $this->_settings['test_mode'] = $this->_settings['test_mode'] ? 1 : 0;

        return true;
    }

    private function getUserInfo()
    {
        $this->load->model("Users_model");
        $user_id = $this->session->userdata('user_id');

        return $this->Users_model->get_user_by_id($user_id);
    }

    public function lastChats($page = 1, $params = [], $admin_mode = true, $subpage = 'outbox')
    {
        $last_chats = [];

        $chats_count = $this->get_last_chats_count($params);

        if (!$page) {
            $page = 1;
        }

        if ($admin_mode) {
            $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $chats_count, $items_on_page);
            if ($chats_count > 0) {
                $last_chats = $this->get_last_chats_list($page, $items_on_page, ['id' => 'DESC'], $params);
                $this->load->helper("navigation");
                $url = site_url() . "admin/chats/settings/pg_videochat/";
                $page_data = get_admin_pages_data($url, $chats_count, $items_on_page, $page, 'briefPage');
                $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
                $this->ci->view->assign('page_data', $page_data);
            }
        } else {
            $items_on_page = $this->pg_module->get_module_config('start', 'index_items_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $chats_count, $items_on_page);
            if ($chats_count > 0) {
                $last_chats = $this->get_last_chats_list($page, $items_on_page, ['id' => 'DESC'], $params);
                $this->load->helper("navigation");

                $url = site_url() . "chats/index/" . $subpage . "/";
                $page_data = get_user_pages_data($url, $chats_count, $items_on_page, $page, 'briefPage');
                $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
                $this->ci->view->assign('page_data', $page_data);
            }
        }

        return $last_chats;
    }

    public function getChatByKey($chat_id = 0, $formated = true)
    {
        $this->ci->db->select();
        $this->ci->db->from(OOVOOCHATS_TABLE);
        $this->ci->db->where("chat_key", $chat_id);
        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            if ($formated) {
                $results = $this->format_last_chats($results);
            }

            return $results[0];
        }

        return [];
    }

    public function getLastChatByKey($chat_id = 0, $formated = true)
    {
        return $this->getChatByKey($chat_id, $formated);
    }

    public function getChatById($chat_id = 0, $formated = true)
    {
        $this->ci->db->select();
        $this->ci->db->from(OOVOOCHATS_TABLE);
        $this->ci->db->where("id", $chat_id);
        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            if ($formated) {
                $results = $this->format_last_chats($results);
            }

            return $results[0];
        }

        return [];
    }

    public function getLastChatById($chat_id = 0, $formated = true)
    {
        return $this->getChatById($chat_id, $formated);
    }

    public function getLastChatsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [])
    {
        $this->ci->db->select();
        $this->ci->db->from(OOVOOCHATS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $results = $this->format_last_chats($results);

            return $results;
        }

        return [];
    }

    public function getLastChatsCount($params = [], $filter_object_ids = null)
    {
        if (isset($params["where"]) && is_array($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["like"]) && is_array($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }
        $result = $this->ci->db->count_all_results(OOVOOCHATS_TABLE);

        return $result;
    }

    public function formatLastChats($data)
    {
        $current_time = time();

        foreach ($data as $key => $chat) {
            $data[$key]['is_inviter'] = false;
            $data[$key]['is_invited'] = false;
            if (!empty($chat['invite_user_id'])) {
                $user_ids[] = $chat['invite_user_id'];
                if ($chat['invite_user_id'] == $this->session->userdata('user_id')) {
                    $data[$key]['is_inviter'] = true;
                }
            }
            if (!empty($chat['invited_user_id'])) {
                $user_ids[] = $chat['invited_user_id'];
                if ($chat['invited_user_id'] == $this->session->userdata('user_id')) {
                    $data[$key]['is_invited'] = true;
                }
            }
            if ($chat["status"] == "approve" || $chat["status"] == "current" || $chat["status"] == "paused") {
                if (strtotime($chat['date_time']) < $current_time) {
                    $data[$key]['show_link'] = 1;
                    if ($this->_settings['chat_type'] == 'now') {
                        $data[$key]['chat_link'] = site_url() . 'chats/go_to_chat/' . $chat['chat_key'];
                    } else {
                        $data[$key]['chat_link'] = site_url() . 'chats/go_to_chat/' . $chat['id'];
                    }
                }
            }
            $data[$key]['status_str'] = l('lang_status_' . $chat['status'], 'chats');
            if (!empty($data[$key]['session_token'])) {
                $data[$key]['session_token'] = (array) unserialize($data[$key]['session_token']);
            } else {
                $data[$key]['session_token'] = [];
            }
        }

        if (!empty($user_ids)) {
            $this->ci->load->model('Users_model');
            $this->ci->load->helper('seo');
            $users = $this->ci->Users_model->get_users_list_by_key(null, null, null, [], array_unique($user_ids), true, false);
            $users[0] = $this->ci->Users_model->format_default_user();
            foreach ($data as $key => $chat) {
                $data[$key]['invite'] = $users[$chat['invite_user_id']];
                if ($data[$key]['is_inviter'] == true) {
                    if ($this->_settings['fee_type'] == 'payed') {
                        $data[$key]['amount_per_second'] = $this->_settings['amount'];
                        if ($data[$key]['invite']['account'] < $this->_settings['amount']) {
                            $data[$key]['no_money'] = 1;
                            $data[$key]['lang_add_money'] = str_replace('[link]', rewrite_link('users', 'account', ['action' => 'update']), l('pg_videochat_text_add_funds', 'chats'));
                        } else {
                            $data[$key]['available_time'] = intval($data[$key]['invite']['account'] / $this->_settings['amount']) - $chat['duration'];
                            if ($data[$key]['available_time'] < 60) {
                                $data[$key]['available_time_lang'] = $data[$key]['available_time'] . " " . l('pg_videochat_seconds', 'chats');
                            } else {
                                $data[$key]['available_time_lang'] = intval($data[$key]['available_time'] / 60) . " " . l('pg_videochat_minutes', 'chats');
                            }
                        }
                    }
                }
                if ($data[$key]['duration'] < 60) {
                    $data[$key]['duration_lang'] = $data[$key]['duration'] . " " . l('pg_videochat_seconds', 'chats');
                } else {
                    $data[$key]['duration_lang'] = intval($data[$key]['duration'] / 60) . " " . l('pg_videochat_minutes', 'chats');
                    $seconds = $data[$key]['duration'] - intval($data[$key]['duration'] / 60) * 60;
                    if ($seconds > 0) {
                        $data[$key]['duration_lang'] .= " " . $seconds . " " . l('pg_videochat_seconds', 'chats');
                    }
                }
                $data[$key]['invited'] = $users[$chat['invited_user_id']];
            }
        }

        return $data;
    }

    public function validateInviteForm($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["message"])) {
            $return["data"]["message"] = strip_tags($data["message"]);
            if (empty($return["data"]["message"])) {
                $return["errors"]["message"] = l('error_message_incorrect', 'chats');
            }
        }
        if (isset($data["date"])) {
            $return["data"]["date"] = strip_tags($data["date"]);
            if (empty($return["data"]["date"])) {
                $return["errors"]["date"] = l('error_date_incorrect', 'chats');
            }
        }
        if (isset($data["time"])) {
            $return["data"]["time"] = strip_tags($data["time"]);
        }

        return $return;
    }

    public function saveChat($id_chat = null, $attrs = [])
    {
        if (is_null($id_chat)) {
            $this->ci->db->insert(OOVOOCHATS_TABLE, $attrs);
            $id_chat = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id_chat);
            $this->ci->db->update(OOVOOCHATS_TABLE, $attrs);
        }

        return $id_chat;
    }

    public function deleteChat($id_chat = 0)
    {
        $this->ci->db->where('id', $id_chat);
        $this->ci->db->delete(OOVOOCHATS_TABLE);

        return $id_chat;
    }

    public function canceledChats()
    {
        $this->ci->db->where('status', 'send');
        $this->ci->db->where('date_created + INTERVAL 1 DAY < "' . date('Y:m:d H:i:s') . '"', null, false);
        $this->ci->db->update(OOVOOCHATS_TABLE, ['status' => 'canceled']);

        $this->ci->db->where('status', 'approve');
        $this->ci->db->where('date_time + INTERVAL 30 MINUTE < "' . date('Y:m:d H:i:') . '59"', null, false);
        $this->ci->db->update(OOVOOCHATS_TABLE, ['status' => 'canceled']);
    }

    public function generateKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $length = strlen($characters);
        $randstring = '';
        for ($i = 0; $i < 15; ++$i) {
            $randstring .= $characters[rand(0, $length)];
        }

        return $randstring;
    }

    public function writeOffForChat($id_user, $price, $message)
    {
        $this->ci->load->model("Users_payments_model");
        $is_paid = $this->ci->Users_payments_model->write_off_user_account($id_user, $price, $message);
    }

    public function sendAlertPerHour($seconds = 0)
    {
        $attr['where']['status'] = 'approve';
        $attr['where_sql'][] = "DATE_FORMAT(date_time - INTERVAL " . $seconds . " SECOND, '%Y-%m-%d %H:%i') = '" . date('Y-m-d H:i') . "'";
        $chats = $this->get_last_chats_list(null, null, null, $attr);
        if ($chats) {
            $this->ci->load->model('Notifications_model');
            foreach ($chats as $chat) {
                $alert_data = [];
                $alert_data["link"] = site_url() . 'chats/go_to_chat/' . $chat['id'];
                $alert_data["to_name"] = $chat['invited']['output_name'];
                $alert_data["with_name"] = $chat['invite']['output_name'];
                $this->ci->Notifications_model->send_notification($chat['invited']["email"], 'videochat_time_alert', $alert_data, '', $chat['invited']['lang_id']);

                $alert_data["to_name"] = $chat['invite']['output_name'];
                $alert_data["with_name"] = $chat['invited']['output_name'];
                $this->ci->Notifications_model->send_notification($chat['invite']["email"], 'videochat_time_alert', $alert_data, '', $chat['invite']['lang_id']);
            }
        }
    }

    public function setNotified($chats_ids)
    {
        if (empty($chats_ids)) {
            return;
        }
        $this->ci->db->set('is_notified', 1);
        $this->ci->db->where_in('id', $chats_ids);
        $this->ci->db->update(OOVOOCHATS_TABLE);
    }

    public function __call($name, $args)
    {
        $methods = [
            'canceled_chats' => 'canceledChats',
            'delete_chat' => 'deleteChat',
            'last_chats' => 'lastChats',
            'save_chat' => 'saveChat',
            'send_alert_per_hour' => 'sendAlertPerHour',
            'get_last_chats_list' => 'getLastChatsList',
            'validate_invite_form' => 'validateInviteForm',
            'format_last_chats' => 'formatLastChats',
            'get_last_chat_by_id' => 'getLastChatById',
            'write_off_for_chat' => 'writeOffForChat',
            'get_last_chats_count' => 'getLastChatsCount',
            'get_last_chat_by_key' => 'getLastChatByKey',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
