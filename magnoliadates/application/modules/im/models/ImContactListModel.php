<?php

declare(strict_types=1);

namespace Pg\modules\im\models;

use Pg\Libraries\View;

if (!defined('IM_CONTACT_LIST_TABLE')) {
    define('IM_CONTACT_LIST_TABLE', DB_PREFIX . 'im_contact_list');
}

/**
 * IM contact list model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 */
class ImContactListModel extends \Model
{
    private $fields = [
        'id_user',
        'id_contact',
        'site_status',
        'count_new',
        'date_update',
    ];

    private $fields_str;

    public function __construct()
    {
        parent::__construct();

        $this->fields_str = implode(', ', $this->fields);
    }

    public function importFriendlist($user_id = null)
    {
        $this->ci->load->model('friendlist/models/Friendlist_model');
        $friendlist_count = $this->ci->Friendlist_model->get_list_count(null, 'accept');
        if ($friendlist_count) {
            // import by packs of N rows
            $rows_pack = 10000;
            $iterations = ceil($friendlist_count / $rows_pack);
            for ($i = 1; $i <= $iterations; ++$i) {
                $friendlist = $this->ci->Friendlist_model->get_friendlist(null, $i, $rows_pack, null, '', false);
                $contact_list = [];
                foreach ($friendlist as $list) {
                    $contact_list[] = [
                        'id_user'     => $list['id_user'],
                        'id_contact'  => $list['id_dest_user'],
                        'date_update' => $list['date_update'],
                    ];
                }
                $this->ci->db->insert_batch(IM_CONTACT_LIST_TABLE, $contact_list, true);
            }
        }
    }

    public function callbackUpdateContactList($event_status, $id_user, $id_contact_user)
    {
        switch ($event_status) {
            case 'remove':
            case 'block':
                $this->remove_contact($id_user, $id_contact_user);
                break;
            case 'accept':
                $this->add_contact($id_user, $id_contact_user);
                break;
        }
    }

    public function callbackUpdateContactsStatuses($event_status, $users_ids)
    {
        if (!empty($users_ids)) {
            $data_upd['site_status'] = intval($event_status);
            $params['where_in']['id_contact'] = $users_ids;
            $this->save([], $data_upd, $params);

            return $this->ci->db->affected_rows();
        }

        return false;
    }

    private function remove($params)
    {
        if (!empty($params['where']) && is_array($params['where'])) {
            $this->ci->db->where($params['where']);
        }
        if (!empty($params['or_where']) && is_array($params['or_where'])) {
            $this->ci->db->or_where($params['or_where']);
        }
        if (!empty($params['where_in']) && is_array($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        $this->ci->db->delete(IM_CONTACT_LIST_TABLE);
        return $this->ci->db->affected_rows();
    }

    private function save($data_ins = [], $data_upd = [], $params = [])
    {
        if (!empty($data_ins) && is_array($data_ins)) {
            $update_str = '';
            if (!empty($data_upd)) {
                $fields_upd = [];
                foreach ($data_upd as $field => $val) {
                    if ($field === 'count_new' && ($val === '+' || $val === '-')) {
                        $fields_upd[] = "`{$field}` = {$field} {$val} " . (int)$val;
                    } else {
                        $fields_upd[] = "`{$field}` = " . $this->ci->db->escape($val);
                    }
                }
                $update_str = implode(', ', $fields_upd);
            }
            if ($update_str) {
                $sql = $this->ci->db->insert_string(IM_CONTACT_LIST_TABLE, $data_ins) . " ON DUPLICATE KEY UPDATE {$update_str}";
            } else {
                $sql = $this->ci->db->insert_string(IM_CONTACT_LIST_TABLE, $data_ins);
                $sql = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $sql);
            }
            $this->ci->db->query($sql);
        } elseif (!empty($data_upd) && is_array($data_upd)) {
            if (!empty($params["where"]) && is_array($params["where"])) {
                $this->ci->db->where($params["where"]);
            }
            if (!empty($params["where_in"]) && is_array($params["where_in"])) {
                foreach ($params["where_in"] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
                }
            }
            $count_new = null;
            if (!empty($data_upd['count_new']) && ($data_upd['count_new'][0] == '+' || $data_upd['count_new'][0] == '-')) {
                $count_new = "count_new {$data_upd['count_new'][0]} " . intval($data_upd['count_new']);
                unset($data_upd['count_new']);
            }
            if ($count_new) {
                $this->ci->db->set('count_new', $count_new, false);
            }
            $this->ci->db->update(IM_CONTACT_LIST_TABLE, $data_upd);
        } else {
            return false;
        }
        return $this->ci->db->affected_rows();
    }

    public function get($params, $page = null, $items_on_page = null, $order_by = null)
    {
        if (!empty($params["where"]) && is_array($params["where"])) {
            $this->ci->db->where($params["where"]);
        }

        if (!empty($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (is_array($order_by) && count($order_by)) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field, $dir);
                }
            }
        }

        if (!is_null($page) && !is_null($items_on_page)) {
            $page = intval($page) > 0 ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $result = $this->ci->db->select($this->fields_str)
                ->from(IM_CONTACT_LIST_TABLE)
                ->get()->result_array();

        return $result;
    }

    public function removeContact($id_user, $id_contact)
    {
        return $this->remove([
            'where' => [
                'id_user' => $id_user,
                'id_contact' => $id_contact
            ]
        ]);
    }

    public function removeAllContact($id_contact)
    {
        return $this->remove([
            'where' => ['id_contact' => $id_contact],
            'or_where' => ['id_user' => $id_contact]
        ]);
    }

    public function addContact($id_user, $id_contact, $site_status = 0, $count_new = 0)
    {
        return $this->save([
            'id_user' => $id_user,
            'id_contact' => $id_contact,
            'site_status' => $site_status,
            'count_new' => $count_new,
            'date_update' => date("Y-m-d H:i:s"),
        ]);
    }

    public function updateContact($id_user, $id_contact, $site_status = null, $count_new = null, $change_date = true)
    {
        $data_ins['id_user'] = $id_user;
        $data_ins['id_contact'] = $id_contact;
        if (!is_null($site_status)) {
            $data_ins['site_status'] = $data_upd['site_status'] = $site_status;
        }
        if (!is_null($count_new)) {
            $data_ins['count_new'] = intval($count_new);
            $data_upd['count_new'] = $count_new;
        }
        $data_ins['date_update'] = date("Y-m-d H:i:s");
        if ($change_date) {
            $data_upd['date_update'] = $data_ins['date_update'];
        }
        $params['where']['id_user'] = $id_user;
        $params['where']['id_contact'] = $id_contact;

        return $this->save($data_ins, $data_upd, $params);
    }

    public function getContactList($id_user, $page = null, $items_on_page = null, $formatted = true)
    {
        $params = ['where' =>['id_user' => $id_user, 'id_contact <>' => '0']];
        $list = $this->get($params, $page, $items_on_page, ['date_update' => 'DESC']);
        if ($formatted) {
            $list = $this->formatList($list);
        }

        //for chatbox messages
        if ($this->ci->pg_module->is_module_installed('chatbox')) {
            $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
            $list = $this->ci->Chatbox_contact_list_model->getListIm($id_user, null, $list, true);
        }

        return $list;
    }

    public function getContactListTime($id_user)
    {
        $params = ['where' => ['id_user' => $id_user]];
        $result = $this->get($params, 1, 1, ['date_update' => 'DESC']);
        $time = $result ? strtotime($result[0]['date_update']) : 0;

        return $time;
    }

    public function backendGetContactList($params = [])
    {
        $id_user = $this->ci->session->userdata('user_id');
        $this->ci->load->model('Im_model');
        $im_status = $this->ci->Im_model->im_status($id_user);
        if ($im_status['im_on']) {
            $formatted = (!empty($params['formatted']) && $params['formatted']) ? true : false;
            $loaded_contact_ids = (!empty($params['loaded_contact_ids'])) ? array_map('intval', explode(',', $params['loaded_contact_ids'])) : [];

            $result['list'] = $this->getContactList($id_user, null, null, $formatted);

            $result['time'] = $result['list'] ? strtotime($result['list'][0]['date_update']) : 0;
            $ids_list = [];
            if (!$formatted) {
                foreach ($result['list'] as $l) {
                    $id_contact = intval($l['id_contact']);
                    if (!in_array($id_contact, $loaded_contact_ids)) {
                        $ids_list[$id_contact]['id_contact'] = $id_contact;
                    }
                }
            }
            if ($ids_list) {
                $formatted_list = $this->formatList($ids_list);
                foreach ($result['list'] as &$l) {
                    if (!empty($formatted_list[$l['id_contact']])) {
                        if (isset($formatted_list[$l['id_contact']]['contact_user'])) {
                            $l['contact_user'] = $formatted_list[$l['id_contact']]['contact_user'];
                        }
                    }
                }
            }
        }
        $result['im_status'] = $im_status;

        if ($this->ci->pg_module->is_module_installed('chatbox')) {
            foreach ($result['list'] as $key => $value) {
                if ($value['id_contact'] == $value['id_user']) {
                    $theme_data =  $this->view->getThemeSettings();
                    $result['list'][$key]['contact_user']['thumbs']['middle'] = site_url() . $theme_data['mini_logo']['path'];
                    $result['list'][$key]['contact_user']['output_name'] = '♡  ' . l('site_notification', 'chatbox');
                    $result['list'][$key]['contact_user']['thumbs']['class'] = 'site_logo';
                }
            }
        }

        return $result;
    }

    public function formatList($list)
    {
        if (empty($list) || !is_array($list)) {
            return [];
        }
        $users_ids = [];
        foreach ($list as $l) {
            $users_ids[] = $l['id_contact'];
        }

        if ($users_ids) {
            $this->ci->load->helper('seo');
            $this->ci->load->model('Users_model');
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $users_ids);

            foreach ($list as &$l) {
                $user = $users[$l['id_contact']];
                if (isset($user['id']) && !isset($user['is_deleted'])) {
                    $l['contact_user'] = [
                        'id'          => (int) $user['id'],
                        'output_name' => $user['output_name'],
                        'age'         => !empty($user['age']) ? (int) $user['age'] : 0,
                        'location'    => !empty($user['location']) ? $user['location'] : '',
                        'thumbs'      => !empty($user['user_logo_moderation']) ? $user['media']['user_logo_moderation']['thumbs'] : $user['media']['user_logo']['thumbs'],
                        'link'        => rewrite_link('users', 'view', $user),
                    ];
                }
            }
        }

        return $list;
    }

    public function checkNewMessages($id_user, $im_status = [])
    {

        $result = ['contacts' => [], 'count_new' => 0, 'im_status' => $im_status];
        if (!empty($im_status) && $im_status['im_service_access'] === true) {
            $new_formatted = $this->formatList(
                $this->get([
                    'where' => [
                        'id_user'     => intval($id_user),
                        'count_new >' => 0,
                    ]
                ])
             );
            $result['contacts'] = $new_formatted;
            foreach ($new_formatted as $contact) {
                $result['count_new'] += $contact['count_new'];
            }
        }
        return $result;
    }

    public function backendCheckNewMessages()
    {
        $id_user = $this->ci->session->userdata('user_id');
        $this->ci->load->model('Im_model');
        $im_status = $this->ci->Im_model->imStatus($id_user);
        return $this->checkNewMessages($id_user, $im_status);
    }

    public function __call($name, $args)
    {
        $methods = [
            '_import_friendlist' => 'importFriendlist',
            'add_contact' => 'addContact',
            'backend_check_new_messages' => 'backendCheckNewMessages',
            'backend_get_contact_list' => 'backendGetContactList',
            'callback_update_contact_list' => 'callbackUpdateContactList',
            'callback_update_contacts_statuses' => 'callbackUpdateContactsStatuses',
            'check_new_messages' => 'checkNewMessages',
            'format_list' => 'formatList',
            'get_contact_list' => 'getContactList',
            'get_contact_list_time' => 'getContactListTime',
            'remove_all_contact' => 'removeAllContact',
            'remove_contact' => 'removeContact',
            'update_contact' => 'updateContact',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
