<?php

declare(strict_types=1);

namespace Pg\modules\im\models;

use Pg\Libraries\EmojiMap as EmojiMap;

if (!defined('IM_MESSAGES_TABLE')) {
    define('IM_MESSAGES_TABLE', DB_PREFIX.'im_messages');
}

/**
 * IM messages model.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 */
class ImMessagesModel extends \Model
{
    private $fields = [
        'id',
        'id_linked',
        'id_user',
        'id_contact',
        'text',
        'dir',
        'date_add',
        'is_read',
        'is_notified',
    ];

    public $emoji_raws = ['map' => [], 'revert_map' => [], 'names' => [], 'codes' => [], 'regexp' => ['names', 'codes']];

    private $fields_str;

    private $moderation_type = ImModel::MODULE_GID;

    public function __construct()
    {
        parent::__construct();
        $this->fields_str = implode(', ', $this->fields);
        $this->initEmojiMap();
    }

    public function initEmojiMap()
    {
        $em = new EmojiMap();
        foreach ($em->emoji_data as $key => $emoji) {
            $this->emoji_raws['map'][':'.$emoji[3][0].':'] = $emoji[0][0];
            $this->emoji_raws['revert_map'][$emoji[0][0]] = ':'.$emoji[3][0].':';
            array_push($this->emoji_raws['names'], ':'.$emoji[3][0].':');
            array_push($this->emoji_raws['codes'], $emoji[0][0]);
        }

        $this->emoji_raws['regexp']['names'] = '/('.implode('|', $this->emoji_raws['names']).')/';
        $this->emoji_raws['regexp']['codes'] = '/('.implode('|', $this->emoji_raws['codes']).')/';

        return $this->emoji_raws;
    }

    private function save($data, $id = 0)
    {
        if ($id) {
            $this->ci->db->where('id', $id)->update(IM_MESSAGES_TABLE, $data);
            $return = $this->ci->db->affected_rows();
        } else {
            $this->ci->db->insert(IM_MESSAGES_TABLE, $data);
            $return = $this->ci->db->insert_id();
        }

        return $return;
    }

    private function get($params, $limit = null, $order_by = null, $formatted = true)
    {
        if (!empty($params['where']) && is_array($params['where'])) {
            $this->ci->db->where($params['where']);
        }
        if (!empty($params['where_in']) && is_array($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (!empty($params['where_sql']) && is_array($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        if (!empty($params['group_by'])) {
            $this->ci->db->group_by($params['group_by']);
        }
        if (is_array($order_by) && count($order_by)) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field, $dir);
                }
            }
        }
        if ($limit) {
            $this->ci->db->limit($limit);
        }
        $result = $this->ci->db->select($this->fields_str)
            ->from(IM_MESSAGES_TABLE)
            ->get()->result_array();
        if ($formatted) {
            $result = $this->format($result);
        }

        return $result;
    }

    public function format($data)
    {
        $full_time_format = $this->ci->pg_date->get_format('date_time_literal', 'date');
        $time_format = $this->ci->pg_date->get_format('time_numeric', 'date');
        foreach ($data as &$msg) {
            if (isset($msg['date_add'])) {
                $time = strtotime($msg['date_add']);
                $msg['date_add_format'] = (time() - $time > 3600 * 12) ? date($full_time_format, $time) : date($time_format, $time);
            }
        }

        return $data;
    }

    private function validate($data)
    {
        $return = ['errors' => [], 'data' => []];
        foreach ($data as $field => $val) {
            if (!in_array($field, $this->fields)) {
                unset($data[$field]);
            }
        }
        if (empty($data['date_add'])) {
            $data['date_add'] = date('Y-m-d H:i:s');
        }

        if (!empty($data['text'])) {
            $emoji_length = 0;
            $data['text'] = preg_replace_callback(
                $this->emoji_raws['regexp']['names'],
                function ($matches) use (&$emoji_length) {
                    $emoji_length += strlen(' '.$this->emoji_raws['map'][$matches[0]].' ');

                    return ' '.$this->emoji_raws['map'][$matches[0]].' ';
                },
                $data['text'],
                -1,
                $word_count
            );

            $message_max_chars = $this->ci->pg_module->get_module_config('im', 'message_max_chars') + $emoji_length - $word_count;

            $data['text'] = preg_replace('/<br>|<div>|<\/div>/', ' &#10;&#13; ', $data['text']);
            $data['text'] = strip_tags($data['text']);
            $data['text'] = $word_count
                ? mb_substr($data['text'], 0, strrpos(mb_substr($data['text'], 0, $message_max_chars), ' '))
                : mb_substr($data['text'], 0, $message_max_chars);
        }

        $data['id_user'] = !empty($data['id_user']) ? intval($data['id_user']) : 0;
        $data['id_contact'] = !empty($data['id_contact']) ? intval($data['id_contact']) : 0;
        if (!$data['id_user'] || !$data['id_contact'] || !$data['text']) {
            $return['errors'][] = 'empty fields';
        }

        if (!empty($data['text'])) {
            $this->ci->load->model('moderation/models/Moderation_badwords_model');
            $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $data['text']);
            if ($bw_count) {
                $return['errors'][] = l('error_badwords_message', 'im');
            }
        }
        $return['data'] = $data;

        return $return;
    }

    public function addMessage($id_user, $id_contact, $text)
    {
        $return = ['errors' => [], 'data' => []];

        // output msg
        $data['id_user'] = $id_user;
        $data['id_contact'] = $id_contact;
        $data['dir'] = 'o';
        $data['text'] = $text;

        $validate = $this->validate($data);
        if ($validate['errors']) {
            $return['errors'] = $validate['errors'];

            return $return;
        }

        $data = $validate['data'];

        // Network event
        if ($this->ci->pg_module->is_module_installed('network')) {
            $this->ci->load->model('network/models/Network_events_model');
            $this->ci->Network_events_model->emit('im.message', [
                'id_user' => $data['id_user'],
                'id_contact' => $data['id_contact'],
                'text' => $data['text'],
            ]);
        }

        $result = $this->saveMessage($data);

        $return = array_merge($return, $result);

        if ($this->ci->pg_module->is_module_installed('mobile') && $this->ci->pg_module->get_module_config('mobile', 'use_notifications')) {
            $this->ci->load->model('mobile/models/MobileUsersPushNotificationsModel');

            $new_msg_count = $this->getUnreadCount($id_contact, 'i', $id_user);
            $all_msg_count = $this->getUnreadCount($id_contact, 'i');

            $user = $this->ci->Users_model->getUserById($id_user, true);
            $contact = $this->ci->Users_model->getUserById($id_contact, true);
            $contact_lang_id = $contact['lang_id'];
            $title = str_replace('[sender]', $user['nickname'], l('im_new_message', 'mobile_app', $contact_lang_id));
            $this->ci->MobileUsersPushNotificationsModel->pushNotification([
                'id_user' => (int)$id_contact,
                'title' => (string)$title,
                'body' => (string)$text,
                'activity' => 'ChatActivity',
                'module' => 'im',
                'gid' => 'new_message',
                'contact_id' => (int)$id_user,
                'contact_name' => (string)$user['output_name'],
                'msg_count' => (int)$new_msg_count,
                'all_msg_count' => (int)$all_msg_count
            ]);
        }

        return $return;
    }

    /**
     * Save chat message.
     *
     * @param $data
     * @return array
     */
    private function saveMessage($data)
    {
        $o_msg_id = $this->save($data);

        $this->ci->load->model('im/models/Im_contact_list_model');
        $this->ci->Im_contact_list_model->updateContact($data['id_user'], $data['id_contact']);

        // input msg
        if ($o_msg_id) {
            $save_data = $data;
            $save_data['id_user'] = $data['id_contact'];
            $save_data['id_contact'] = $data['id_user'];
            $save_data['id_linked'] = $o_msg_id;
            $save_data['dir'] = 'i';
            $i_msg_id = $this->save($save_data);
            if ($i_msg_id) {
                $this->save(['id_linked' => $i_msg_id], $o_msg_id);
                $this->ci->Im_contact_list_model->updateContact($data['id_contact'], $data['id_user'], null, '+1');
            }
        }

        return ['o_msg_id' => $o_msg_id, 'i_msg_id' => $i_msg_id];
    }

    public function backendGetLastMessages($params = [])
    {
        $id_user = $this->ci->session->userdata('user_id');
        $result = [];
        $this->ci->load->model('Im_model');
        $im_status = $this->ci->Im_model->im_status($id_user);
        if ($im_status['im_on']) {
            $result['messages'] = $this->getLastMessages($id_user);
        }

        return $result;
    }

    public function getLastMessagesChatbox($chatbox_messages, $id_user, $contact = null, $count = 20, $chatbox_from_date = [])
    {
        $params = [];
        $order_by = [];
        $params['where']['id_user'] = intval($id_user);
        if (is_array($contact) && !empty($contact)) {
            $params['where_in']['id_contact'] = $contact;
            $params['group_by'] = 'id_contact';
            $order_by['id'] = 'DESC';
        } elseif (!empty($contact)) {
            $params['where']['id_contact'] = intval($contact);
            $order_by['id'] = 'DESC';
        } else {
            $params['where_sql'][] = 'date_add in (select max(date_add) from '.IM_MESSAGES_TABLE.' group by id_contact)'
                .' group by id_contact';
        }

        if ($chatbox_from_date) {
            $params['where']['date_add >'] = $chatbox_from_date;
        }

        $messages = $this->get($params, $count, $order_by);

        if ($messages) {
            foreach ($messages as $key => $value) {
                $messages[$key]['message'] = $value['text'];
                $messages[$key]['user_id'] = $value['id_user'];
                $messages[$key]['linked_id'] = $value['id_linked'];
                $messages[$key]['contact_id'] = $value['id_contact'];
                $messages[$key]['date_added'] = $value['date_add'];
            }

            if ($chatbox_messages) {
                $messages = array_merge($messages, $chatbox_messages);
                usort($messages, function ($a1, $a2) {
                    $v1 = strtotime($a1['date_added']);
                    $v2 = strtotime($a2['date_added']);

                    return $v1 - $v2; // $v2 - $v1 to reverse direction
                });
            }
        } else {
            $messages = $chatbox_messages;
        }

        return $messages;
    }

    public function getLastMessages($id_user, $contact = null, $count = 20, $for_chatbox_data = false)
    {
        $params = [];
        $order_by = [];
        $params['where']['id_user'] = intval($id_user);
        if (is_array($contact) && !empty($contact)) {
            $params['where_in']['id_contact'] = $contact;
            $params['group_by'] = 'id_contact';
            $order_by['id'] = 'DESC';
        } elseif (!empty($contact)) {
            $params['where']['id_contact'] = intval($contact);
            $order_by['id'] = 'DESC';
        } else {
            $params['where_sql'][] = 'date_add in (select max(date_add) from '.IM_MESSAGES_TABLE.' group by id_contact)'
                .' group by id_contact';
        }

        $messages = $this->get($params, $count, $order_by);

        if ($for_chatbox_data) {
            return $messages;
        }

        //for chatbox messages
        if ($this->ci->pg_module->is_module_installed('chatbox')) {
            $messages_chatbox = [];
            if (!$contact) {
                $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
                $messages = $this->ci->Chatbox_contact_list_model->getListIm($id_user, null, ['im_messages' => $messages], false, true);
            } else {
                $this->ci->load->model('chatbox/models/Chatbox_model');
                $messages_chatbox = $this->ci->Chatbox_model->getListIm($id_user, $contact);
            }
        }

        // Set id_contact as array_key
        if (empty($contact)) {
            $sorted = [];
            foreach ($messages as $msg) {
                $sorted[$msg['id_contact']] = $msg;
            }
            $messages = $sorted;
        }

        //for chatbox messages
        if ($this->ci->pg_module->is_module_installed('chatbox')) {
            if ($messages_chatbox) {
                $messages = array_merge($messages, $messages_chatbox);
                usort($messages, function ($a1, $a2) {
                    $v1 = strtotime($a1['date_add']);
                    $v2 = strtotime($a2['date_add']);

                    return $v2 - $v1; // $v2 - $v1 to reverse direction
                });
            }
        }

        return $messages;
    }

    public function getHistory($id_user, $id_contact, $from_id, $count = 100)
    {
        $params['where']['id_user'] = intval($id_user);
        $params['where']['id_contact'] = intval($id_contact);
        $params['where']['id <'] = intval($from_id);
        $order_by['id'] = 'DESC';
        $messages = $this->get($params, $count, $order_by);

        return $messages;
    }

    public function getNewMessages($id_user, $id_contact, $from_id = null, $from_chatbox_id = null, $from_date_add = [])
    {
        $params['where']['id_user'] = intval($id_user);
        $params['where']['id_contact'] = intval($id_contact);
        if ($from_id) {
            $params['where']['id >'] = intval($from_id);
        }
        if ($from_date_add) {
            $params['where']['date_add >'] = $from_date_add;
        }

        $order_by['id'] = 'DESC';
        $messages = $this->get($params, 1000, $order_by);

        //for chatbox messages
        $messages_chatbox = [];
        if ($from_chatbox_id) {
            $this->ci->load->model('chatbox/models/Chatbox_model');
            $messages_chatbox = $this->ci->Chatbox_model->getListIm($id_user, $id_contact, $from_chatbox_id);
        }

        //for chatbox messages
        if ($messages_chatbox) {
            $messages = array_merge($messages, $messages_chatbox);
            usort($messages, function ($a1, $a2) {
                $v1 = strtotime($a1['date_add']);
                $v2 = strtotime($a2['date_add']);

                return $v2 - $v1; // $v2 - $v1 to reverse direction
            });
        }

        return $messages;
    }

    public function checkIsRead($id_user, $id_contact)
    {
        $id_user = intval($id_user);
        $id_contact = intval($id_contact);
        $this->ci->db->set('is_read', '1')
            ->where('id_user', $id_user)
            ->where('id_contact', $id_contact)
            ->update(IM_MESSAGES_TABLE);
        $this->ci->load->model('im/models/Im_contact_list_model');
        $this->ci->Im_contact_list_model->update_contact($id_user, $id_contact, null, 0, false);
    }

    public function deleteMessages($id_user, $id_contact)
    {
        $where['id_user'] = intval($id_user);
        $where['id_contact'] = intval($id_contact);
        $this->ci->db->where($where)->delete(IM_MESSAGES_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteMessageById($id)
    {
        $this->ci->db->where('id', $id)->delete(IM_MESSAGES_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteMessageByUserId($user_id)
    {
        $this->ci->db->where('id_user', $user_id)
            ->or_where('id_contact', $user_id)
            ->delete(IM_MESSAGES_TABLE);
        $this->ci->load->model('im/models/Im_contact_list_model');
        $this->ci->Im_contact_list_model->removeAllContact($user_id);
    }

    public function getUnreadCount($id_user, $dir = null, $id_contact = null)
    {
        $this->ci->db->where('id_user', $id_user)->where('is_read', 0);
        if (!empty($id_contact)) {
            $this->ci->db->where('id_contact', $id_contact);
        }
        if (!empty($dir)) {
            $this->ci->db->where('dir', $dir);
        }
        $result = current($this->ci->db->select('COUNT(id) as cnt')
                ->from(IM_MESSAGES_TABLE)->get()->result_array());

        return $result['cnt'];
    }

    /**
     * Get message from network.
     *
     * @param array $data message data
     *
     * @return array
     */
    public function handlerMessage($data)
    {
        return $this->saveMessage([
            'id_user' => $data['id_user'],
            'id_contact' => $data['id_contact'],
            'dir' => '0',
            'text' => $data['text'],
        ]);
    }

    public function getNewMessagesByContactList($user_id, $contact_ids)
    {
        $messages = $this->get([
            'where' => ['id_user' => $user_id],
            'where_in' => ['id_contact' => $contact_ids],
            'where_sql' => ['date_add in (select max(date_add) from '.IM_MESSAGES_TABLE.' group by id_contact)'
                .' group by id_contact', ],
        ], null, ['id' => 'DESC']);
        $result = [];
        foreach ($messages as $data_msg) {
            $result[$data_msg['id_contact']] = $data_msg;
        }

        return $result;
    }

    public function backendGetNewMessages($params)
    {
        $id_user = $this->ci->session->userdata('user_id');

        if (!empty($params['contact_id'])) {
            if (empty($params['from_id'])) {
                $params['from_id'] = 0;
            }

            // chatbox
            if (!isset($params['from_chatbox_id']) || empty($params['from_chatbox_id'])) {
                $params['from_chatbox_id'] = 0;
            }

            $result['messages'] = $this->getNewMessages($id_user, $params['contact_id'], $params['from_id'], $params['from_chatbox_id']);

            $this->check_is_read($id_user, $params['contact_id']);
        } else {
            $result['messages'] = [];
        }

        $this->ci->load->model('Im_model');

        $result['im_status'] = $this->ci->Im_model->im_status($id_user);

        return $result;
    }

    public function getUserMsgs($params)
    {
        return $this->get($params);
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_message' => 'addMessage',
            'backend_getNewMessages' => 'backendGetNewMessages',
            'check_is_read' => 'checkIsRead',
            'delete_message_by_id' => 'deleteMessageById',
            'delete_message_by_user_id' => 'deleteMessageByUserId',
            'delete_messages' => 'deleteMessages',
            'get_history' => 'getHistory',
            'get_last_messages' => 'getLastMessages',
            'get_new_messages' => 'getNewMessages',
            'get_unread_count' => 'getUnreadCount',
            'handler_message' => 'handlerMessage',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method '.$name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
