<?php

declare(strict_types=1);

namespace Pg\modules\chats\models\chats;

define('PG_VIDEOCHAT_TABLE', DB_PREFIX . 'pg_videochats');
define('PG_VIDEOCHAT_MESSAGES_TABLE', DB_PREFIX . 'pg_videochats_messages');


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
class PgVideochat extends ChatAbstract
{
    protected $_name = 'PG Video chat';
    protected $_gid = 'pg_videochat';
    protected $_activities = ['own_page'];
    protected $_settings = [
                'fee_type'       => 'free',
                'chat_type'      => 'invite',
                'amount'         => 0.01,
                'amount_for_min' => 0.6,
                'time_alert'     => 3600,
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

    private function getUserInfo()
    {
        $this->load->model("Users_model");
        $user_id = $this->session->userdata('user_id');

        return $this->Users_model->get_user_by_id($user_id);
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

        $this->ci->view->assign('last_chats', $this->lastChats($page, $params, false, $subpage));

        $this->ci->view->assign('folder', $subpage);

        return $this->ci->view->fetch('pg_videochat_user', 'user', 'chats');
    }

    public function adminPage($page = 1)
    {
        $this->ci->view->assign('chat', $this->as_array());
        $this->ci->view->assign('last_chats', $this->last_chats($page));

        return $this->ci->view->fetch('pg_videochat_admin', 'admin', 'chats');
    }

    public function installPage()
    {
        $this->ci->Chats_model->set_installed($this->_gid);

        return;
    }

    public function validateSettings()
    {
        $this->_settings['amount_for_min'] = floatval($this->_settings['amount']) * 60;

        return true;
    }

    public function hasFiles()
    {
        return true;
    }

    public function lastChats($page = 1, $params = [], $admin_mode = true, $subpage = 'outbox')
    {
        $last_chats = [];

        $chats_count = $this->getLastChatsCount($params);

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
        $this->ci->db->from(PG_VIDEOCHAT_TABLE);
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
        $this->ci->db->from(PG_VIDEOCHAT_TABLE);
        $this->ci->db->where("id", $chat_id);
        $results = $this->ci->db->get()->result_array();

        if (empty($results) || !is_array($results)) {
            return [];
        }

        if ($formated) {
            $results = $this->format_last_chats($results);
        }

        return $results[0];
    }

    public function getLastChatById($chat_id = 0, $formated = true)
    {
        return $this->getChatById($chat_id = 0, $formated = true);
    }

    public function getLastChatsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [])
    {
        $this->ci->db->select();
        $this->ci->db->from(PG_VIDEOCHAT_TABLE);

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

        $result = $this->ci->db->count_all_results(PG_VIDEOCHAT_TABLE);

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
            if (!in_array($chat["status"], ["send", "discussed", "decline", "completed"])) {
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
            $this->ci->db->insert(PG_VIDEOCHAT_TABLE, $attrs);
            $id_chat = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id_chat);
            $this->ci->db->update(PG_VIDEOCHAT_TABLE, $attrs);
        }

        return $id_chat;
    }

    public function deleteChat($id_chat = 0)
    {
        $this->ci->db->where('id', $id_chat);
        $this->ci->db->delete(PG_VIDEOCHAT_TABLE);

        return $id_chat;
    }

    public function canceledChats()
    {
        $this->ci->db->where('status', 'approve');
        $this->ci->db->where('amount', 0);
        $this->ci->db->where('date_time + INTERVAL 30 MINUTE < "' . date('Y:m:d H:i:') . '59"', null, false);
        $this->ci->db->update(PG_VIDEOCHAT_TABLE, ['status' => 'canceled']);

        $this->ci->db->where('status', 'approve');
        $this->ci->db->where('amount >', 0);
        $this->ci->db->where('duration >', 5);
        $this->ci->db->where('date_time + INTERVAL 30 MINUTE < "' . date('Y:m:d H:i:') . '59"', null, false);
        $this->ci->db->update(PG_VIDEOCHAT_TABLE, ['status' => 'completed']);
    }

    public function generateKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $length = strlen($characters);
        $randstring = '';
        for ($i = 0; $i < $length; ++$i) {
            $randstring .= $characters[rand(1, $length - 1)];
        }

        return $randstring;
    }

    public function writeOffForChat($id_user = null, $price = 0, $message = '')
    {
        $this->ci->load->model("Users_payments_model");
        $is_paid = $this->ci->Users_payments_model->writeOffUserAccount($id_user, $price, $message);

        return $is_paid;
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

    public function getMessages($chat_id = null, $message_max_id = 0)
    {
        $messages = [];
        $params['where']['id_chat'] = $chat_id;
        if ($message_max_id > 0) {
            $params['where']['id >'] = $message_max_id;
        }

        $messages_count = $this->get_messages_count($params);
        if ($messages_count > 0) {
            $messages = $this->get_messages_list(null, null, ['id' => 'DESC'], $params);
        }

        return $messages;
    }

    public function getMessagesList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [])
    {
        $this->ci->db->select();
        $this->ci->db->from(PG_VIDEOCHAT_MESSAGES_TABLE);

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

        if (!empty($filter_object_ids) && is_array($filter_object_ids) && count(is_array($filter_object_ids))) {
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
            $return = [];
            foreach ($results as $result) {
                $return[$result['id']] = $result;
            }

            return $return;
        }

        return [];
    }

    public function getMessagesCount($params = [], $filter_object_ids = null)
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
        $result = $this->ci->db->count_all_results(PG_VIDEOCHAT_MESSAGES_TABLE);

        return $result;
    }

    public function addMessage($attrs = [])
    {
        $this->ci->db->insert(PG_VIDEOCHAT_MESSAGES_TABLE, $attrs);
    }

    public function setNotified($chats_ids)
    {
        if (empty($chats_ids)) {
            return;
        }
        $this->ci->db->set('is_notified', 1);
        $this->ci->db->where_in('id', $chats_ids);
        $this->ci->db->update(PG_VIDEOCHAT_TABLE);
    }

    public function cronValidateAmountChat()
    {
        if ($this->_settings['fee_type'] == 'payed') {
            $this->ci->db->select();
            $this->ci->db->from(PG_VIDEOCHAT_TABLE);
            $this->ci->db->where("duration > ", 5);
            $this->ci->db->where("amount", 0);
            $this->ci->db->where("status", 'completed');

            $results = $this->ci->db->get()->result_array();

            if ($results) {
                $this->ci->load->model('Users_model');
                $results = $this->format_last_chats($results);

                foreach ($results as $chat) {
                    $amount = floatval($chat['amount_per_second']) * intval($chat['duration']);

                    if (
                        $this->writeOffForChat(
                            $chat['invite_user_id'],
                            $amount,
                            str_replace(['[with_name]', '[date_chat]'], [$chat['invited']['output_name'], date('Y-m-d')], l('service_payment', 'chats'))
                        ) === true
                    ) {
                        $this->saveChat($chat['id'], ['amount' => $amount]);
                    }
                }
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'last_chats' => 'lastChats',
            'add_message' => 'addMessage',
            'canceled_chats' => 'canceledChats',
            'cron_validate_amount_chat' => 'cronValidateAmountChat',
            'delete_chat' => 'deleteChat',
            'format_last_chats' => 'formatLastChats',
            'get_last_chat_by_id' => 'getLastChatById',
            'get_last_chat_by_key' => 'getLastChatByKey',
            'get_last_chats_count' => 'getLastChatsCount',
            'get_last_chats_list' => 'getLastChatsList',
            'get_messages' => 'getMessages',
            'get_messages_count' => 'getMessagesCount',
            'get_messages_list' => 'getMessagesList',
            'save_chat' => 'saveChat',
            'send_alert_per_hour' => 'sendAlertPerHour',
            'validate_invite_form' => 'validateInviteForm',
            'write_off_for_chat' => 'writeOffForChat',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
