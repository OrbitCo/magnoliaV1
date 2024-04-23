<?php

declare(strict_types=1);

namespace Pg\modules\Chatbox\Models;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Messaging Center module
 * Contact list model
 *
 * @package     PG_Dating
 * @subpackage  Chatbox
 * @category    models
 *
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 * @author      Renat Gabdrakhmanov <renatgab@pilotgroup.eu>
 */
class ChatboxContactListModel extends \Model
{
    public const MODULE_GID        = 'chatbox';
    public const TABLE             = DB_PREFIX . 'chatbox_contact_list';
    public const USERS_TABLE       = DB_PREFIX . 'users';
    public const DB_DATE_FORMAT    = 'Y-m-d H:i:s';
    public const DB_DEFAULT_DATE   = '0000-00-00 00:00:00';

    protected $fields = [
        'id',
        'user_id',
        'contact_id',
        'count_new',
        'date_update',
    ];

    protected $format_settings = [
        'get_user'         => false,
        'get_contact'      => true,
        'get_last_message' => true,
    ];

    public $items_per_page = 30;

    public const CACHE_NAME = 'ChatboxContactListModel';

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::TABLE);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(self::TABLE.self::USERS_TABLE);
    }

    protected function getObject($data = [])
    {
        $fields     = $this->fields;
        $fields_str = implode(', ', $fields);

        if (empty($data)) {
            $dbTable = self::TABLE;
            $results =  $this->ci->cache->get(self::TABLE, 'getObject', function () use ($fields_str, $dbTable) {
                $this->ci->db->select($fields_str)->from($dbTable);
                $result = $this->ci->db->get()->result_array();

                return $result;
            });
        } else {
            $this->ci->db->select($fields_str)
                ->from(self::TABLE);

            foreach ($data as $field => $value) {
                $this->ci->db->where($field, $value);
            }

            $results = $this->ci->db->get()->result_array();
        }

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    public function getByUserIdAndContactId($user_id, $contact_id)
    {
        $fields = $this->fields;
        $fields_str = implode(', ', $fields);
        $dbTabel = self::TABLE;
        $results =  $this->ci->cache->get(self::TABLE, 'UserId' . $user_id . 'ContactId' . $contact_id, function () use ($fields_str, $user_id, $contact_id, $dbTabel) {
            $result = $this->ci->db->select($fields_str)
                ->from($dbTabel)
                ->where('user_id', $user_id)
                ->where('contact_id', $contact_id)
                ->get()
                ->result_array();

            return $result;
        });

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    public function getCriteriaInternal($filters)
    {
        $filters = ['data' => $filters, 'table' => self::TABLE, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : self::TABLE;

        $fields = array_flip($this->fields);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (!is_array($filter_data)) {
                $filter_data = trim(/* <bugfix> */ (string)$filter_data/* </bugfix> */);
            }
            switch ($filter_name) {
                case 'min_date_update':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['date_update >=' => $filter_data]]);

                    break;
                case 'max_date_update':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['date_update <=' => $filter_data]]);

                    break;
                case 'min_id':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['id >' => $filter_data]]);

                    break;
                case 'max_id':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['id <' => $filter_data]]);

                    break;
                case 'where':
                case 'where_in':
                case 'where_not_in':
                case 'where_sql':
                    if (empty($filter_data) || !is_array($filter_data)) {
                        break;
                    }
                    if (!array_key_exists($filter_name, $params)) {
                        $params[$filter_name] = [];
                    }
                    $params[$filter_name] = array_merge_recursive($params[$filter_name], $filter_data);

                    break;
                default:
                    if (isset($fields[$filter_name])) {
                        if (is_array($filter_data)) {
                            $params = array_merge_recursive($params, ['where_in' => [$filter_name => $filter_data]]);
                        } else {
                            $params = array_merge_recursive($params, ['where' => [$filter_name => $filter_data]]);
                        }
                    }

                    break;
            }
        }

        return $params;
    }

    protected function getListInternal($page = null, $limits = null, $order_by = null, $params = [])
    {
        $table  = self::TABLE;
        $fields = $this->fields;

        $fields_str = $table . '.' . implode(', ' . $table . '.', $fields);

        $this->ci->db->select($fields_str);
        $this->ci->db->from($table);

        if (isset($params['join'])) {
            foreach ($params['join'] as $j_table => $j_sett) {
                $this->ci->db->join($j_table, $j_sett, 'left');
            }
        }

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql'])) {
            if (!is_array($params['where_sql'])) {
                $params['where_sql'] = [$params['where_sql']];
            }
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                } elseif ($field == 'order_str') {
                    if (is_array($dir)) {
                        foreach ($dir as $f => $d) {
                            $this->ci->db->order_by($f . ' ' . $d);
                        }
                    } else {
                        $this->ci->db->order_by($dir);
                    }
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = (int)$page ?: 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    protected function getCountInternal($params = null)
    {
        $table = isset($params['table']) ? $params['table'] : self::TABLE;

        $this->ci->db->select('COUNT(*) AS cnt');
        $this->ci->db->from($table);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return (int)$results[0]['cnt'];
        }

        return 0;
    }

    public function getList($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getListInternal($page, $items_on_page, $order_by, $params);
    }

    public function getListByKey($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list   = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $key => $item) {
            $return[$item['id']] = $item;
        }

        return $return;
    }

    public function getListByField($field, $filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list   = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $key => $item) {
            $return[$item[$field]] = $item;
        }

        return $return;
    }

    public function getCount($filters = [])
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getCountInternal($params);
    }

    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    public function format($data)
    {
        if (empty($data) || !is_array($data)) {
            return [];
        }

        return current($this->formatArray([0 => $data]));
    }

    public function formatArray($data)
    {
        $return = [];

        if (empty($data) || !is_array($data)) {
            return [];
        }

        $this->ci->load->model('Chatbox_model');
        $for_users = [];

        foreach ($data as $key => $item) {
            if ($this->format_settings['get_user'] && !empty($item['user_id'])) {
                $for_users[] = $item['user_id'];
            }

            if ($this->format_settings['get_contact'] && !empty($item['contact_id'])) {
                $for_users[] = $item['contact_id'];
            }

            if ($this->format_settings['get_last_message']) {
                $item['last_message'] = $this->ci->Chatbox_model->getLastMessage($item['user_id'], $item['contact_id']);

                if (!empty($item['last_message'])) {
                    $item['last_message'] = $this->ci->Chatbox_model->format($item['last_message']);
                    $item['last_message']['linked_message'] = $this->ci->Chatbox_model->getById($item['last_message']['linked_id']);
                }
            }

            $return[$key] = $item;
        }

        if (!empty($for_users) && ($this->format_settings['get_user'] || $this->format_settings['get_contact'])) {
            $this->ci->load->model('Users_model');
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], array_unique($for_users));
            foreach ($return as $key => $item) {
                if ($this->format_settings['get_user']) {
                    $return[$key]['user'] = !empty($users[$item['user_id']])
                        ? $this->ci->Users_model->formatUser($users[$item['user_id']])
                        : $this->ci->Users_model->formatDefaultUser($item['user_id']);
                }
                if ($this->format_settings['get_contact']) {
                    $return[$key]['contact'] = !empty($users[$item['contact_id']])
                        ? $this->ci->Users_model->formatUser($users[$item['contact_id']])
                        : $this->ci->Users_model->formatDefaultUser($item['contact_id']);
                }
            }
        }

        return $return;
    }

    public function formatDefault()
    {
        $data = [];

        return $data;
    }

    public function validate($data = [])
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['user_id'])) {
            $return['data']['user_id'] = (int)$data['user_id'];
            if (empty($return['data']['user_id'])) {
            }
        }

        if (isset($data['contact_id'])) {
            $return['data']['contact_id'] = (int)$data['contact_id'];
            if (empty($return['data']['contact_id'])) {
            }
        }

        if (isset($data['count_new'])) {
            $return['data']['count_new'] = (int)$data['count_new'];
            if (empty($return['data']['count_new'])) {
            }
        }

        if (isset($data['date_update'])) {
            $value = strtotime($data['date_update']);
            if ($value) {
                $return['data']['date_update'] = date('Y-m-d H:i:s');
            } else {
                $return['data']['date_update'] = '0000-00-00 00:00:00';
            }
        }

        return $return;
    }

    public function save($user_id, $contact_id, $save_raw = [])
    {
        if (!empty($user_id) && !empty($contact_id)) {
            $contact_data                            = $this->getByUserIdAndContactId($user_id, $contact_id);
            $save_raw['date_update'] = date('Y-m-d H:i:s');
            if (empty($contact_data)) {
                $save_raw['user_id'] = $user_id;
                $save_raw['contact_id'] = $contact_id;
                $this->ci->db->insert(self::TABLE, $save_raw);
            } else {
                $this->ci->db->where('user_id', $user_id);
                $this->ci->db->where('contact_id', $contact_id);
                $this->ci->db->update(self::TABLE, $save_raw);
            }
            $this->ci->cache->flush(self::CACHE_NAME);

            return true;
        }

        return false;
    }

    public function delete($id)
    {
        if (is_array($id)) {
            foreach ($id as $i) {
                $this->delete($i);
            }
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->delete(self::TABLE);
        }
        $this->ci->cache->flush(self::TABLE);
    }

    public function deleteByUserIdAndContactId($user_id, $contact_id)
    {
        $this->ci->db->where('user_id', $user_id);
        $this->ci->db->where('contact_id', $contact_id);
        $this->ci->db->delete(self::TABLE);

        $this->ci->cache->delete(self::TABLE, 'UserId' . $user_id . 'ContactId' . $contact_id);
    }

    public function updateContact($user_id, $contact_id, $count_new = 0): bool
    {
        $contact_data = $this->getByUserIdAndContactId($user_id, $contact_id);

        if (empty($contact_data)) {
            $save_data = [
                'user_id'    => $user_id,
                'contact_id' => $contact_id,
                'count_new'  => $count_new,
            ];
        } else {
            $save_data = [
                'count_new' => $count_new,
            ];
        }
        $this->ci->cache->flush(self::TABLE);
        $this->save($user_id, $contact_id, $save_data);

        return true;
    }

    public function checkIsRead($user_id, $contact_id)
    {
        $this->ci->db->set('count_new', 0)->where('user_id', $user_id)->where('contact_id', $contact_id)->update(self::TABLE);

        return true;
    }

    public function getSumNewMessages($user_id = 0)
    {
        $result = $this->ci->db->select('SUM(count_new) AS cnt, ' . self::TABLE . '.contact_id, ' . self::USERS_TABLE . '.id')
            ->from(self::TABLE)
            ->join(self::USERS_TABLE, self::USERS_TABLE . '.id = ' . self::TABLE . '.contact_id', 'left')
            ->where(self::TABLE . '.user_id', $user_id)
            ->where(self::USERS_TABLE . '.id = ' . self::TABLE . '.contact_id', null, false)
            ->get()->result_array();

        if (!empty($result) && is_array($result)) {
            return (int)$result[0]['cnt'];
        }

        return 0;
    }

    public function getListIm($user_id, $contact = null, $result = [], $without_mess = false, $only_mess = false)
    {
        $contact_list = $this->getList(
            ['user_id' => $user_id],
            1,
            $this->items_per_page,
            ['date_update' => 'DESC']
        );
        $contact_list = $this->formatArray($contact_list);

        if ($result && $without_mess) {
            $result_dump = [];
            foreach ($result as $key => $value) {
                $result_dump[$value['id_contact']] = $value;
            }
            $result = $result_dump;
            unset($result_dump);
        }

        if ($contact_list && $without_mess) {
            $contact_list_dump = [];
            foreach ($contact_list as $key => $value) {
                $contact_list_dump[$value['contact_id']] = $value;
            }
            $contact_list = $contact_list_dump;
            unset($contact_list_dump);
        }

        foreach ($contact_list as $key => $value) {
            if (!$without_mess) {
                if (
                    (!isset($result['im_messages'][$value['contact_id']])) ||
                    (strtotime($result['im_messages'][$value['contact_id']]['date_add']) < strtotime($value['last_message']['date_added']))
                ) {
                    $result['im_messages'][$value['contact_id']] = $value['last_message'];
                    $result['im_messages'][$value['contact_id']]['text'] = $value['last_message']['message'];
                    $result['im_messages'][$value['contact_id']]['id_user'] = $value['last_message']['user_id'];
                    $result['im_messages'][$value['contact_id']]['id_linked'] = $value['last_message']['linked_id'];
                    $result['im_messages'][$value['contact_id']]['id_contact'] = $value['last_message']['contact_id'];
                }
            }
            $contact = $value;
            $contact['contact_user'] = $contact['contact'];
            unset($contact['contact']);
            $contact['id_contact'] = $contact['contact_id'];
            unset($contact['contact_id']);
            unset($contact['id']);
            $contact['id_user'] = $contact['user_id'];
            unset($contact['user_id']);
            unset($contact['last_message']);
            $contact['contact_user']['thumbs'] = $contact['contact_user']['media']['user_logo']['thumbs'];

            if (!$without_mess) {
                $result['list'][] = $contact;
            } else {
                $count_im = 0;
                $count_cb = 0;
                if (isset($result[$contact['id_contact']])) {
                    $count_im = (int)$result[$contact['id_contact']]['count_new'];
                }
                $count_cb = (int)$contact['count_new'];

                $count_new =  $count_im + $count_cb;
                $result[$contact['id_contact']] = $contact;
                $result[$contact['id_contact']]['count_new'] = $count_new;
            }
        }

        if ($only_mess) {
            return $result['im_messages'];
        }

        $data = [];
        if (!$without_mess) {
            $data = $result['list'];
        } else {
            $data = $result;
        }

        $dump = [];

        foreach ($data as $key => $value) {
            $dump[$value['id_contact']] = $value;
        }

        usort($dump, function ($a1, $a2) {
            $v1 = strtotime($a1['date_update']);
            $v2 = strtotime($a2['date_update']);

            return $v2 - $v1; // $v2 - $v1 to reverse direction
        });

        $result['list'] = $dump;

        if ($without_mess) {
            return $dump;
        }

        return $result;
    }

    public function getFormatChatbox($user_id, $list = [], $im_list_dump = [])
    {
        $this->ci->load->model(['Chatbox_model', 'im/models/Im_messages_model']);

        foreach ($list as $key => $value) {
            $list[$key]['last_message'] = $this->ci->Im_messages_model->getLastMessages($user_id, $value['id_contact'], 1, true);
            if ($list[$key]['last_message']) {
                $list[$key]['last_message'] = $this->ci->Chatbox_model->formatImToChatbox($list[$key]['last_message'][0]);
            }

            if (!isset($list[$key]['contact_user'])) {
                unset($list[$key]);

                continue;
            }
            $list[$key]['contact'] = $list[$key]['contact_user'];
            unset($list[$key]['contact_user']);
            $im_list_dump[$value['id_contact']] = $list[$key];
            $im_list_dump[$value['id_contact']]['contact_id'] =  $im_list_dump[$value['id_contact']]['id_contact'];
            $im_list_dump[$value['id_contact']]['user_id'] =  $im_list_dump[$value['id_contact']]['id_user'];
            $im_list_dump[$value['id_contact']]['contact']['media']['user_logo']['thumbs'] = $im_list_dump[$value['id_contact']]['contact']['thumbs'];
            unset($im_list_dump[$value['id_contact']]['contact']['thumbs']);
        }
        unset($list);

        return $im_list_dump;
    }

    public function mergeDataContacts($contact_list = [], $im_list = [], $user_id, $is_backend = true)
    {
        $contact_list_dump = [];
        $im_list_dump = [];

        if ($contact_list) {
            foreach ($contact_list as $key => $value) {
                $contact_list_dump[$value['contact_id']] = $value;
            }
        }
        unset($contact_list);

        if ($im_list) {
            $im_list_dump = $this->getFormatChatbox($user_id, $im_list, $im_list_dump);
            foreach ($im_list_dump as $key => $value) {
                $im_count_new = (int)$value['count_new'];

                if (isset($contact_list_dump[$key])) {
                    $chatbox_count_new = (int)$contact_list_dump[$key]['count_new'];
                    if (isset($value['last_message']) && $value['last_message'] && $contact_list_dump[$key]['last_message']) {
                        if ($value['last_message']['date_added'] > $contact_list_dump[$key]['last_message']['date_added']) {
                            $contact_list_dump[$key] = $value;
                        }
                    }
                } else {
                    $contact_list_dump[$key] = $value;
                }
                if (!$is_backend) {
                    $contact_list_dump[$key]['count_new'] =  $im_count_new;
                }
            }
        }

        return $contact_list_dump;
    }

    public function backendCheckNewMessages($params = [])
    {
        $return = ['notifications' => [], 'count_new' => 0, 'contacts' => [], 'messages' => [], 'l_time' => 0, 'contact_id' => 0];

        $user_id = $this->ci->session->userdata('user_id');
        $this->ci->load->model('Chatbox_model');

        $this->ci->load->model('Users_model');
        $user_data = $this->ci->Users_model->getUserById($user_id);
        if (isset($user_data['chatbox_sound'])) {
            $return['chatbox_sound'] = $user_data['chatbox_sound'];
        }

        if (isset($params['l_time'])) {
            $l_time = (int)$params['l_time'];
        } else {
            $l_time = null;
        }

        if ($l_time) {
            $l_date = date('Y-m-d H:i:s', $l_time);
            $return['contact_id'] = (int)$params['contact_id'];
            $get_messages         = false;
            $im_contacts          = [];
            $contacts = $this->getList(['user_id' => $user_id, 'min_date_update' => $l_date], null, null, ['date_update' => 'ASC']);

            // get im data
            if ($this->ci->pg_module->is_module_installed('im')) {
                $this->ci->load->model(['im/models/Im_contact_list_model', 'im/models/Im_messages_model']);
                $im_contacts =  $this->ci->Im_contact_list_model->get(['where' => ['id_user' => $user_id, 'date_update >' => $l_date]], null, null, ['date_update' => 'ASC']);
            }

            if (!empty($im_contacts)) {
                $return['im_contacts'] = $im_contacts;
                $im_contacts = $this->ci->Im_contact_list_model->formatList($im_contacts);
                $im_contacts_dump = $this->getFormatChatbox($user_id, $im_contacts);
                if (!empty($contacts)) {
                    $contacts = $this->formatArray($contacts);
                } else {
                    $contacts_ids = [];
                    foreach ($im_contacts_dump as $key => $value) {
                        $contacts_ids[] = $key;
                    }
                    $contacts_chatbox =  $this->formatArray($this->getList(['user_id' => $user_id, 'contact_id' => $contacts_ids]));

                    foreach ($contacts_chatbox as $key => $value) {
                        if (isset($im_contacts_dump[$value['contact_id']])) {
                            $im_contacts_dump[$value['contact_id']]['count_new'] = (int)$im_contacts_dump[$value['contact_id']]['count_new'] + (int)$value['count_new'];
                            $im_contacts_dump[$value['contact_id']]['contact_user'] = $im_contacts_dump[$value['contact_id']]['contact'];
                            $im_contacts_dump[$value['contact_id']]['contact']['online_status'] = $value['contact']['online_status'];
                        }
                    }
                }
                $contacts = $im_contacts_dump;
            }

            if (!empty($contacts)) {
                if (empty($im_contacts)) {
                    $contacts = $this->formatArray($contacts);
                    $im_contacts =  $this->ci->Im_contact_list_model->get(['where' => ['id_user' => $user_id]], null, null, ['date_update' => 'ASC']);
                    $im_contacts_dump = [];
                    foreach ($im_contacts as $key => $value) {
                        $im_contacts_dump[$value['id_contact']]['count_new'] =  $value['count_new'];
                    }
                    foreach ($contacts as $key => $value) {
                        if ($im_contacts_dump[$value['contact_id']]['count_new']) {
                            $contacts[$key]['count_new'] = (int)$contacts[$key]['count_new'] + (int)$im_contacts_dump[$value['contact_id']]['count_new'];
                        }
                    }
                }

                foreach ($contacts as $key => $item) {
                    $contact = [
                        'id'        => $item['contact_id'],
                        'count_new' => $item['count_new'],
                        'html'      => '',
                    ];
                    $this->ci->view->assign('is_mini_logo', 1);  // set 0 for full logo
                    $this->ci->view->assign('user_id', $user_id);
                    $this->ci->view->assign('contact_list', [0 => $item]);
                    $contact['html'] = $this->ci->view->fetch('users', 'user', self::MODULE_GID);
                    // if (!empty($return['contact_id']) && $return['contact_id'] == $contact['id'] && $contact['count_new']) {
                    $get_messages = true;
                    // }

                    $return['contacts'][] = $contact;
                }
            }

            if ($get_messages) {
                $message_filters = [
                    'user_id'        => $user_id,
                    'contact_id'     => $return['contact_id'],
                    'min_date_added' => $l_date,
                ];
                $messages = $this->ci->Chatbox_model->getList($message_filters, null, null, ['date_added' => 'ASC']);

                if (!empty($messages)) {
                    $messages = array_reverse($this->ci->Chatbox_model->formatArray($messages));
                }

                $this->load->model('im/models/Im_messages_model');
                $messages = $this->ci->Im_messages_model->getLastMessagesChatbox($messages, $user_id, $return['contact_id'], $this->ci->Chatbox_model->messages_per_page, $l_date);

                if (!empty($messages)) {
                    $this->ci->load->model('Users_model');
                    $user    = $this->Users_model->get_user_by_id($user_id, true);
                    $contact = $this->Users_model->get_user_by_id($return['contact_id'], true);
                    foreach ($messages as $key => $item) {
                        if ($item['dir'] == 'o') {
                            continue;
                        }
                        $message = [
                            'id'        => $item['id'],
                            'html'      => '',
                        ];
                        $this->ci->view->assign('messages', [0 => $item]);
                        $this->ci->view->assign('user', $user);
                        $this->ci->view->assign('is_mini_logo', 1);  // set 0 for full logo
                        $this->ci->view->assign('contact', $contact);
                        $message['html'] = $this->ci->view->fetch('messages', 'user', self::MODULE_GID);

                        $return['messages'][] = $message;
                    }

                    if ($return['contact_id']) {
                        $this->ci->Chatbox_model->checkIsRead($user_id, $return['contact_id']);
                    }
                }
            }
            $return['l_time'] = strtotime(date('Y-m-d H:i:s'));
        }

        $return['count_new'] = $this->getSumNewMessages($user_id);

        if ($this->ci->pg_module->is_module_installed('im')) {
            $this->ci->load->model('im/models/Im_messages_model');
            $result_im = (int)$this->ci->Im_messages_model->get_unread_count($user_id, 'i');
            $return['count_new'] = $result_im + (int)$return['count_new'];
        }

        $notifications = $this->ci->Chatbox_model->getRequestNotifications();
        $return        = array_merge($return, $notifications);

        $return['lang_new_message'] = l('notify_title', 'chatbox');

        return $return;
    }
}
