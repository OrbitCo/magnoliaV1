<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/**
 * Contact us user side controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanev@pilotgroup.net>
 * */
if (!defined('USERS_DELETED_TABLE')) {
    define('USERS_DELETED_TABLE', DB_PREFIX . 'users_deleted');
}

class UsersDeletedModel extends \Model
{
    protected $fields = [
        'id',
        'id_user',
        'nickname',
        'fname',
        'sname',
        'email',
        'data',
        'date_deleted',
        'status_deleted',
    ];
    protected $fields_str;

    public function __construct()
    {
        parent::__construct();
        if ($this->ci->Users_model->is_couples_installed === true) {
            $this->fields = \Pg\modules\couples\models\CouplesModel::addFields(USERS_DELETED_TABLE, $this->fields);
        }
        $this->fields_str = implode(', ', $this->fields);
        $this->ci->cache->registerService(USERS_DELETED_TABLE);
    }

    public function getUserById($id, $formatted = false)
    {
        $fields     = $this->fields_str;
        $nameTable  = USERS_DELETED_TABLE;

        $result = $this->ci->cache->get(USERS_DELETED_TABLE, 'getUserById'.$id, function () use ($id, $fields, $nameTable) {
            $ci = &get_instance();

            return $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where("id", $id)->get()->result_array();
        });

        if (empty($result)) {
            return false;
        } elseif ($formatted) {
            return $this->formatUser($result[0]);
        }

        return $result[0];
    }

    public function getUserByUserId($id_user, $formatted = false)
    {
        $fields     = $this->fields_str;
        $nameTable  = USERS_DELETED_TABLE;

        $result = $this->ci->cache->get(USERS_DELETED_TABLE, 'getUserByUserId'.$id_user, function () use ($id_user, $fields, $nameTable) {
            $ci = &get_instance();

            $result = $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where("id_user", $id_user)
                ->get()->result_array();

            return $result;
        });

        if (empty($result)) {
            return [];
        } elseif ($formatted) {
            return $this->formatUser($result[0]);
        }

        return $result[0];
    }

    public function getUserByLogin($login)
    {
        $fields     = $this->fields_str;
        $nameTable  = USERS_DELETED_TABLE;

        $result = $this->ci->cache->get(USERS_DELETED_TABLE, 'getUserByLogin'.$login, function () use ($login, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where("nickname", $login)
                ->get()->result_array();

            return $result;
        });

        return empty($result) ? false : $result[0];
    }

    public function getUserByEmail($email)
    {
        $fields     = $this->fields_str;
        $nameTable  = USERS_DELETED_TABLE;

        $result = $this->ci->cache->get(USERS_DELETED_TABLE, 'getUserByEmail'.$email, function () use ($email, $fields, $nameTable) {
            $ci = &get_instance();

            $result = $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where("email", $email)
                ->get()->result_array();

            return $result;
        });

        return empty($result) ? false : $result[0];
    }

    public function getAllUsersId($status_deleted = 0)
    {
        $nameTable  = USERS_DELETED_TABLE;
        $result = $this->ci->cache->get(USERS_DELETED_TABLE, 'getAllUsersId'.$status_deleted, function () use ($status_deleted, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db
                ->select('id_user')
                ->from($nameTable)
                ->where("status_deleted", $status_deleted)
                ->get()->result_array();

            return $result;
        });

        $return = [];
        foreach ($result as $row) {
            $return[] = $row['id_user'];
        }

        return $return;
    }

    public function getUsersList(
        $page = null,
        $items_on_page = null,
        $order_by = null,
        $params = [],
        $filter_object_ids = [],
        $formatted = true
    ) {
        if (isset($params["fields"]) && is_array($params["fields"]) && count($params["fields"])) {
            $this->setAdditionalFields($params["fields"]);
        }

        $this->ci->db->select($this->fields_str);
        $this->ci->db->from(USERS_DELETED_TABLE);

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
                if (in_array($field, $this->fields) || $field == 'fields') {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? (int)$page : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            if ($formatted) {
                $results = $this->format_users($results);
            }

            return $results;
        }

        return [];
    }

    public function getUsersListByKey(
        $page = null,
        $items_on_page = null,
        $order_by = null,
        $params = [],
        $filter_object_ids = [],
        $formatted = true
    ) {
        $list = $this->getUsersList($page, $items_on_page, $order_by, $params, $filter_object_ids, $formatted);
        if (!empty($list)) {
            foreach ($list as $l) {
                $data[$l["id"]] = $l;
            }

            return $data;
        }

        return [];
    }

    public function getUsersCount($params = [], $filter_object_ids = null)
    {
        if (!empty($params["where"]) && is_array($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (!empty($params["like"]) && is_array($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (!empty($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (!empty($params["where_sql"]) && is_array($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        return $this->ci->db->count_all_results(USERS_DELETED_TABLE);
    }

    public function getUserCallbacks($id_user, $callbacks)
    {
        $results = $this->formatUserCallbacks(
            $this->getUserByUserId($id_user),
            $callbacks
        );
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function getUserCallbackGid($id_user, $status_deleted = 0)
    {
        $fields = $this->fields_str;
        $nameTable  = USERS_DELETED_TABLE;
        $results = $this->ci->cache->get(USERS_DELETED_TABLE, 'getUserCallbackGidIdUser'.$id_user.'StatusDeleted'.$status_deleted, function () use ($id_user, $status_deleted, $fields, $nameTable) {
            $ci = &get_instance();

            return $ci->db->select($fields)
                ->from($nameTable)
                ->where("id_user", $id_user)
                ->where("status_deleted", $status_deleted)
                ->get()->result_array();
        });

        if (empty($results)) {
            return false;
        }

        return unserialize($results[0]['data']);
    }

    private function formatUserCallbacks($user_data, $callbacks)
    {
        $user_callbacks = [];
        if (!empty($user_data['data'])) {
            $user_callbacks = unserialize($user_data['data']);
        }
        foreach ($callbacks as $key => $callback) {
            $callbacks[$key]['name'] = l('delete_user_' . $callback['callback_gid'], $callback['module']);
            $callbacks[$key]['disabled_attr'] = '';
            if (in_array($callback['callback_gid'], $user_callbacks)) {
                $callbacks[$key]['disabled_attr'] = 'disabled';
            }
        }

        return $callbacks;
    }

    public function formatUsers($data)
    {
        $couple_ids = [];

        foreach ($data as $key => $user) {
            if (!empty($user['couple_id']) && $user['couple_id'] != 0 && $user['is_coupled'] == 0) {
                $couple_ids[] = $user['couple_id'];
            }
            $user['id'] = $user['id_user'];
            $user['is_deleted'] = true;
            $user['output_name'] = $this->setUserOutputName($user);
            $data[$key] = $user;
        }

        if (!empty($couple_ids)) {
            $couples_by_id = $this->getUsersListByKey(null, null, null, [], $couple_ids);
            foreach ($data as $key => $user) {
                if ($user['couple_id'] != 0 && $user['is_coupled'] == 0 && isset($couples_by_id[$user['couple_id']])) {
                    $data[$key]['couple'] = $couples_by_id[$user['couple_id']];
                }
            }
        }

        return $data;
    }

    public function formatUser($data)
    {
        if ($data) {
            return $this->formatUsers([$data])[0];
        }

        return [];
    }

    public function setUserOutputName(&$user)
    {
        $controller = $this->ci->router->fetch_class(true);
        if (substr($controller, 0, 6) != "admin_") {
            $hide_user_names = $this->ci->pg_module->get_module_config('users', 'hide_user_names');
        } else {
            $hide_user_names = 0;
        }

        if ($hide_user_names && !(!empty($user['id']) && $this->ci->session->userdata('user_id') == $user['id'])) {
            $user['fname'] = $user['sname'] = '';
        }

        if (!(empty($user['fname']) && empty($user['sname'])) && !$hide_user_names) {
            $user['output_name'] = trim($user['fname'] . ' ' . $user['sname']);
        } else {
            $user['output_name'] = isset($user["nickname"]) ? $user["nickname"] : '';
        }

        $user['output_name'] .= " (" . l('success_delete_user', 'users') . ")";
        if ($this->ci->Users_model->is_couples_installed === true) {
            $this->ci->load->model('Couples_model');
            if ($user['couple_id'] != 0 && $user['is_coupled'] == 0) {
                $user['output_name'] = $this->ci->Couples_model->getCouplesName($user, 'user_deleted');
            }
        }

        return $user['output_name'];
    }

    public function saveDeletedUser($data)
    {
        $this->ci->cache->flush(USERS_DELETED_TABLE);
        $user_data = $this->getUserByUserId($data['id']);
        if (in_array('users_uploads', $data['callbacks'])) {
            $callbacks = array_unique(array_merge($data['callbacks'], ['users_delete', 'media_user', 'media_gallery']));
        } elseif (in_array('media_user', $data['callbacks'])) {
            $callbacks = array_unique(array_merge($data['callbacks'], ['media_gallery']));
        } else {
            $callbacks = $data['callbacks'];
        }
        if (!empty($user_data['id'])) {
            $user_callbacks = array_merge($callbacks, unserialize($user_data['data']));
            $diff_callback = array_diff($user_callbacks, unserialize($user_data['data']));
            if (!empty($diff_callback)) {
                $attrs['status_deleted'] = 0;
            }
            $attrs['data'] = serialize($user_callbacks);
            $this->ci->db->where('id', $user_data['id']);
            $this->ci->db->update(USERS_DELETED_TABLE, $attrs);

            return $user_data['id'];
        }
        $attrs['id_user'] = $data['id'];
        $attrs['nickname'] = $data['nickname'];
        $attrs['fname'] = $data['fname'];
        $attrs['sname'] = $data['sname'];
        $attrs['email'] = $data['email'];
        $attrs['data'] = serialize($callbacks);
        $attrs['date_deleted'] = date("Y-m-d H:i:s");
        $attrs['status_deleted'] = 0;
        if ($this->ci->Users_model->is_couples_installed === true) {
            $attrs['couple_id'] = $data['couple_id'];
            $attrs['is_coupled'] = $data['is_coupled'];
        }
        $this->ci->db->insert(USERS_DELETED_TABLE, $attrs);

        return $this->ci->db->insert_id();
    }

    public function setStatusDeleted($id_user, $status_deleted)
    {
        $this->ci->db
            ->set('status_deleted', $status_deleted)
            ->where('id_user', $id_user)
            ->update(USERS_DELETED_TABLE);
        $this->ci->cache->flush(USERS_DELETED_TABLE);
    }

    public function __call($name, $args)
    {
        $methods = [
            'format_user' => 'formatUser',
            'format_user_callbacks' => 'formatUserCallbacks',
            'format_users' => 'formatUsers',
            'get_all_users_id' => 'getAllUsersId',
            'get_user_by_email' => 'getUserByEmail',
            'get_user_by_id' => 'getUserById',
            'get_user_by_login' => 'getUserByLogin',
            'get_user_by_user_id' => 'getUserByUserId',
            'get_user_callback_gid' => 'getUserCallbackGid',
            'get_user_callbacks' => 'getUserCallbacks',
            'get_users_count' => 'getUsersCount',
            'get_users_list' => 'getUsersList',
            'get_users_list_by_key' => 'getUsersListByKey',
            'save_deleted_user' => 'saveDeletedUser',
            'set_status_deleted' => 'setStatusDeleted',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
