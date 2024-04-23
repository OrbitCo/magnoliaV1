<?php

declare(strict_types=1);

namespace Pg\modules\ausers\models;

/**
 * Ausers module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('AUSERS_TABLE', DB_PREFIX . 'ausers');

/**
 * Ausers module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AusersModel extends \Model
{
    /**
     * User type by default
     *
     * @var string
     */
    public $user_type = 'admin';

    /**
     * Properties of ausers object in data source
     *
     * @var array
     */
    public $fields_all = [
        'id',
        'date_created',
        'date_modified',
        'email',
        'nickname',
        'password',
        'name',
        'description',
        'status',
        'lang_id',
        'user_type',
        'permission_data',
    ];

    public $upload_config_id = "user-logo";

    /**
     * AusersModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(AUSERS_TABLE);
    }

    /**
     * Return administrator data by identifier
     *
     * @param integer $user_id administrator identifier
     *
     * @return array
     */
    public function getUserById($user_id)
    {
        $fields = implode(", ", $this->fields_all);
        $nameTable = AUSERS_TABLE;
        $result = $this->ci->cache->get(AUSERS_TABLE, 'getUserById' . $user_id, function () use ($user_id, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $user_id)
                ->get()->result_array();

            return $result;
        });

        if (empty($result)) {
            return false;
        }
        $data = $this->formatUser($result[0]);

        return $data;
    }

    /**
     * Return administrator data by login and password
     *
     * @param string $login    administrator login
     * @param string $password administrator password
     *
     * @return array
     */
    public function getUserByLoginPassword($login, $password)
    {
        $fields = implode(", ", $this->fields_all);
        $nameTable = AUSERS_TABLE;
        $result = $this->ci->cache->get(AUSERS_TABLE, 'getUserByLoginPassword' . $login, function () use ($login, $fields, $nameTable) {
            $ci = &get_instance();
            return $ci->db->select($fields)
                ->from($nameTable)
                ->where("nickname", $login)
                ->get()->result_array();
        });

        if (empty($result) || password_verify($password, $result[0]['password']) === false) {
            return false;
        }

        return $this->formatUser($result[0]);
    }

    /**
     * Return administrators data by criteria as array
     *
     * Sorting data puts as array of order field as key and order direction as value
     * for example, array('id'=>'DESC')
     *
     * Available where clauses: where, where_in, where_sql etc.
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     items per page
     * @param array   $order_by          sorting data
     * @param array   $params            where clauses
     * @param array   $filter_object_ids filter by identificators
     *
     * @return array
     */
    public function getUsersList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->fields_all));
        $this->ci->db->from(AUSERS_TABLE);

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
                if (in_array($field, $this->fields_all)) {
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
                $data[] = $this->format_user($r);
            }

            return $data;
        }

        return false;
    }

    /**
     * Return count of administrators by criteria
     *
     * Available where clauses: where, where_in, where_sql etc.
     *
     * @param array $params            where clauses
     * @param array $filter_object_ids filter by identificators
     *
     * @return array
     */
    public function getUsersCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(AUSERS_TABLE);

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

        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        }

        return 0;
    }

    /**
     * Format administrator data
     *
     * @param array $data administrator data
     *
     * @return array
     */
    public function formatUser($data)
    {
        $data["permission_data"] = unserialize($data["permission_data"]);
        if ($this->ci->pg_module->is_module_active("moderators") && $data["user_type"] == 'moderator') {
            $data["module"] = 'moderators';
        } else {
            $data["module"] = 'ausers';
        }

        $this->ci->load->model('Uploads_model');
        if (!isset($data["user_logo"])) {
            $data["media"]["user_logo"] = $this->ci->Uploads_model->format_default_upload($this->upload_config_id);
        }

        $this->setUserOutputName($data);

        return $data;
    }

    public function setUserOutputName(&$user)
    {
        $user['output_name'] = isset($user["nickname"]) ? $user["nickname"] : '';

        return $user['output_name'];
    }

    /**
     * Save administrator data to data source
     *
     * Return administrator identifier of inserted or existed record.
     *
     * @param integer $user_id  administrator identifier
     * @param array   $data     administrator data
     * @param string  $password password string
     *
     * @return integer
     */
    public function saveUser($user_id = null, $attrs = [], $password = '')
    {
        if (is_null($user_id)) {
            $attrs["date_created"] = $attrs["date_modified"] = date("Y-m-d H:i:s");
            if (!isset($attrs["status"])) {
                $attrs["status"] = 1;
            }
            $this->ci->db->insert(AUSERS_TABLE, $attrs);
            $user_id = $this->ci->db->insert_id();

            $is_notification_installed = $this->ci->pg_module->is_module_active('notifications');
            if ($is_notification_installed) {
                $user_data = [
                    'user'      => !empty($attrs['output_name']) ? $attrs['output_name'] : $attrs['name'],
                    'username'  => $attrs['nickname'],
                    'email'     => $attrs['email'],
                    'password'  => $password,
                    'user_type' => l('field_user_type_admin', 'ausers'),
                ];
                $this->ci->load->model("Notifications_model");
                $this->ci->Notifications_model->send_notification($attrs['email'], "auser_account_create_by_admin", $user_data, '', $attrs['lang_id']);
            }
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $user_id);
            $this->ci->db->update(AUSERS_TABLE, $attrs);
        }
        $this->ci->cache->flush(AUSERS_TABLE);

        return $user_id;
    }

    /**
     * Activate/de-activate administrator.
     *
     * Available status:
     * 1 - activate administrator
     * 0 - de-activate administrator
     *
     * @param integer $user_id administrator identifier
     * @param integer $status  administraot status
     *
     * @return void
     */
    public function activateUser($user_id, $status = 1)
    {
        $attrs["status"] = intval($status);
        $attrs["date_modified"] = date("Y-m-d H:i:s");
        $this->ci->db->where('id', $user_id);
        $this->ci->db->update(AUSERS_TABLE, $attrs);
        $this->ci->cache->flush(AUSERS_TABLE);
    }

    /**
     * Validate administrator data for saving to data source.
     *
     * You can save results of this method to data source.
     *
     * @param integer $user_id administrator identifier
     * @param array   $data    administrator data
     *
     * @return array
     */
    public function validateUser($user_id = null, $data = [])
    {
        $return = ["errors" => [], "data" => []];

        $this->ci->config->load('reg_exps', true);
        if (isset($data["name"])) {
            $name_expr = $this->ci->config->item('name', 'reg_exps');
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"]) || !preg_match($name_expr, $return["data"]["name"])) {
                $return["errors"][] = l('error_name_incorrect', 'ausers');
            }
        }

        if (isset($data["description"])) {
            $return["data"]["description"] = trim($data["description"]);
        }

        $return["data"]["user_type"] = $this->user_type;

        if (isset($data["lang_id"])) {
            $return["data"]["lang_id"] = $data["lang_id"];
        }

        if (isset($data["permission_data"])) {
            $return["data"]["permission_data"] = serialize($data["permission_data"]);
        }

        if (isset($data["nickname"])) {
            $login_expr = $this->ci->config->item('nickname', 'reg_exps');
            $return["data"]["nickname"] = strip_tags($data["nickname"]);
            if (empty($return["data"]["nickname"]) || !preg_match($login_expr, $return["data"]["nickname"])) {
                $return["errors"][] = l('error_nickname_incorrect', 'ausers');
            }
            $params["where"]["nickname"] = $return["data"]["nickname"];
            if ($user_id) {
                $params["where"]["id <>"] = $user_id;
            }
            $count = $this->get_users_count($params);
            if ($count > 0) {
                $return["errors"][] = l('error_nickname_already_exists', 'ausers');
            }
        }

        if (isset($data["email"])) {
            $return["data"]["email"] = strip_tags($data["email"]);
            if (!filter_var($return["data"]["email"], FILTER_VALIDATE_EMAIL)) {
                $return["errors"][] = l('error_email_incorrect', 'ausers');
            }
        }

        if ((isset($data["update_password"]) && $data["update_password"]) || !$user_id) {
            if (empty($data["password"]) || empty($data["repassword"])) {
                $return["errors"][] = l('error_password_empty', 'ausers');
            } elseif ($data["password"] != $data["repassword"]) {
                $return["errors"][] = l('error_pass_repass_not_equal', 'ausers');
            } else {
                $password_expr = $this->ci->config->item('password', 'reg_exps');
                $data["password"] = trim(strip_tags($data["password"]));
                if (!preg_match($password_expr, $data["password"])) {
                    $return["errors"][] = l('error_password_incorrect', 'ausers');
                } else {
                    $return["data"]["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
                }
            }
        }

        return $return;
    }

    /**
     * Remove administrator data from data source
     *
     * @param integer $user_id administrator identifier
     *
     * @return void
     */
    public function deleteUser(int $user_id)
    {
        $this->ci->db->where('id', $user_id);
        $this->ci->db->delete(AUSERS_TABLE);
        $this->ci->cache->flush(AUSERS_TABLE);
    }

    /**
     * Returns gids of methods names
     *
     * Guids extract as they are in database
     *
     * @param string $module  module GUID
     * @param array  $methods module methods
     *
     * @return array
     */
    private function getLangGids($module, $methods)
    {
        $gid = [];
        $gid['module'] = 'ausers_moderation';
        foreach ($methods as $method) {
            $query['where'] = [
                'module' => $module,
                'method' => $method,
            ];
            $method = $this->ci->Ausers_model->get_methods($query);
            if (!empty($method[$module]['main'])) {
                $gid['items'][] = 'method_name_' . $method[$module]['main']['id'];
            } else {
                $gid['items'][] = 'method_name_' . $method[$module]['methods'][0]['id'];
            }
        }

        return $gid;
    }

    /**
     * Export languages of available methods for moderators
     *
     * @param array $module_methods available methods for moderators of module
     * @param array $langs_ids      languages identifiers
     *
     * @return array
     */
    public function exportLangs($module_methods, $langs_ids = null)
    {
        $lang_data = [];
        foreach ($module_methods as $module => $methods) {
            $gids_db = $this->getLangGids($module, $methods);
            $langs_db = $this->ci->pg_language->export_langs($gids_db['module'], $gids_db['items'], $langs_ids);
            $lang_codes = array_keys($langs_db);
            foreach ($lang_codes as $lang_code) {
                $lang_data[$lang_code][$module] = array_combine($module_methods[$module], $langs_db[$lang_code]);
            }
        }

        return $lang_data;
    }

    public function __call($name, $args)
    {
        $methods = [
            'activate_user' => 'activateUser',
            'delete_user' => 'deleteUser',
            'export_langs' => 'exportLangs',
            'format_user' => 'formatUser',
            'get_user_by_id' => 'getUserById',
            'get_user_by_login_password' => 'getUserByLoginPassword',
            'get_users_count' => 'getUsersCount',
            'get_users_list' => 'getUsersList',
            'save_user' => 'saveUser',
            'validate_user' => 'validateUser',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
