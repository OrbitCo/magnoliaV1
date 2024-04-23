<?php

declare(strict_types=1);

namespace Pg\modules\moderators\models;

/**
 * Moderators module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('AUSERS_TABLE')) {
    define('AUSERS_TABLE', DB_PREFIX . 'ausers');
}

if (!defined('AUSERS_MODERATE_METHODS_TABLE')) {
    define('AUSERS_MODERATE_METHODS_TABLE', DB_PREFIX . 'ausers_moderate_methods');
}
if (!defined('AUSERS_MODERATE_METHOD_GROUPS_TABLE')) {
    define('AUSERS_MODERATE_METHOD_GROUPS_TABLE', DB_PREFIX . 'ausers_moderate_method_groups');
}

/**
 * Moderators main model
 *
 * @package     PG_Core
 * @subpackage  Moderators
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ModeratorsModel extends \Model
{
    /**
     * Moderator GUID
     *
     * @var string
     */
    public $user_type = 'moderator';

    /**
     * Moderator object's properties in data source
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

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return moderator data by identifier
     *
     * @param integer $user_id administrator identifier
     *
     * @return array
     */
    public function getUserById($user_id)
    {
        $result = $this->ci->db->select(implode(", ", $this->fields_all))->from(AUSERS_TABLE)->where("id", $user_id)->get()->result_array();
        if (empty($result)) {
            return false;
        } else {
            $data = $this->formatUser($result[0]);

            return $data;
        }
    }

    /**
     * Return moderator data by login and password
     *
     * @param string $login    administrator login
     * @param string $password administrator password
     *
     * @return array
     */
    public function getUserByLoginPassword($login, $password)
    {
        $result = $this->ci->db->select(implode(", ", $this->fields_all))->from(AUSERS_TABLE)->where("nickname", $login)->get()->result_array();
        if (empty($result) ||  password_verify($password, $result[0]['password']) === false) {
            return false;
        } else {
            return $this->formatUser($result[0]);
        }
    }

    /**
     * Return moderators' data by criteria as array
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
     * Return count of moderators by criteria
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
        } else {
            return 0;
        }
    }

    /**
     * Format moderator's data
     *
     * @param array $data moderator's data
     *
     * @return array
     */
    public function formatUser($data)
    {
        $data["permission_data"] = unserialize($data["permission_data"]);

        return $data;
    }

    /**
     * Save moderator's data to data source
     *
     * Return moderator's identifier of inserted or existed record.
     *
     * @param integer $user_id moderator's identifier
     * @param array   $data    moderator's data
     *
     * @return integer
     */
    public function saveUser($user_id = null, $attrs = [])
    {
        if (is_null($user_id)) {
            $attrs["date_created"] = $attrs["date_modified"] = date("Y-m-d H:i:s");
            if (!isset($attrs["status"])) {
                $attrs["status"] = 1;
            }
            $this->ci->db->insert(AUSERS_TABLE, $attrs);
            $user_id = $this->ci->db->insert_id();
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $user_id);
            $this->ci->db->update(AUSERS_TABLE, $attrs);
        }

        return $user_id;
    }

    /**
     * Get the list of the dependant modules
     *
     * @param array $params
     * @return array
     */
    public function getModuleDependences($params = [])
    {
        $return = [];
        $this->ci->db->select('id, module, method, parent_module')->from(AUSERS_MODERATE_METHODS_TABLE);
        $this->ci->db->where("parent_module != ''");
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $return[$r['parent_module']] = [$r['module'] => [
                    $r['method'] => 1
                ]];
            }
        }
        return $return;
    }

    /**
     * Set access permissions for the dependant modules
     *
     * @param array $permissions
     * @return array
     */
    public function setModuleDependences($permissions = [])
    {

        $module_dependences = $this->getModuleDependences();
        if (!empty($permissions)) {
            foreach ($module_dependences as $module => $dep_module) {
                if (isset($permissions[$module])) {
                    foreach ($dep_module as $d_key => $d_perm) {
                        $permissions[$d_key] = $d_perm;
                    }
                }
            }
        }
        return $permissions;
    }

    /**
     * Activate/de-activate moderator.
     *
     * Available status:
     *
     * 1 - activate moderator
     * 0 - de-activate moderator
     *
     * @param integer $user_id moderator's identifier
     * @param integer $status  activity status
     *
     * @return void
     */
    public function activateUser($user_id, $status = 1)
    {
        $attrs["status"] = intval($status);
        $attrs["date_modified"] = date("Y-m-d H:i:s");
        $this->ci->db->where('id', $user_id);
        $this->ci->db->update(AUSERS_TABLE, $attrs);
    }

    /**
     * Validate moderator data for saving to data source.
     *
     * You can save results of this method to data source.
     *
     * @param integer $user_id moderator identifier
     * @param array   $data    moderator data
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
            $count = $this->getUsersCount($params);
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
     * Remove moderator data from data source
     *
     * @param integer $user_id moderator identifier
     *
     * @return void
     */
    public function deleteUser($user_id = null)
    {
        if (!empty($user_id)) {
            $this->ci->db->where('id', $user_id);
        }
        $this->ci->db->where('user_type', $this->user_type);
        $this->ci->db->delete(AUSERS_TABLE);

        return;
    }

    // Methods for moderated models

    /**
     * Return available modules' methods for moderators
     *
     * @param array $params filters criteria
     *
     * @return array
     */
    public function getMethods($params = [])
    {
        $return = [];
        $this->ci->db->select('id, module, method, is_default, group_id')->from(AUSERS_MODERATE_METHODS_TABLE);

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

        if (isset($params["limit"]) && !empty($params["limit"]) && is_int($params["limit"])) {
            $this->ci->db->limit($params["limit"]);
        }

        $this->ci->db->order_by("module ASC");
        $this->ci->db->order_by("is_default DESC");
        $this->ci->db->order_by("id ASC");

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $r["name"] = l("method_name_" . $r["id"], 'ausers_moderation');
                if ($r["is_default"]) {
                    $return[$r["module"]]['main'] = $r;
                } else {
                    $return[$r["module"]]["methods"][] = $r;
                }
            }
            foreach ($return as $module_gid => $data) {
                $return[$module_gid]['module'] = $this->ci->pg_module->get_module_by_gid($module_gid);
            }
        }

        return $return;
    }

    /**
     * Return moderators methods' groups
     *
     * @return array
     */
    public function getMethodGroups()
    {
        $return = [];
        $this->ci->db->select('id, gid')->from(AUSERS_MODERATE_METHOD_GROUPS_TABLE);
        $this->ci->db->order_by("sort_order ASC");

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $return[$r['id']] = ['gid' => $r['gid'], 'name' => l('moderate_method_group_'.$r['gid'], 'moderators')];
            }
        }
        return $return;
    }

    /**
     * Return available for moderators modules' methods grouped by group
     *
     * @return array
     */
    public function getMethodsByGroups($params = [])
    {
        $return = [];
        $method_groups = $this->getMethodGroups();
        foreach ($method_groups as $m_id => $m_data) {
            $return[$m_data['gid']]['main'] = [
                    'id' => $m_id,
                    'name' => $m_data['name'],
                    'is_default' => '1'
            ];
            $return[$m_data['gid']]['module'] = [
                    'id' => $m_id,
                    'module_name' => $m_data['name'],
                    'module_gid' => $m_data['gid']
            ];
        }

        $this->ci->db->select('id, module, method, is_default, group_id')->from(AUSERS_MODERATE_METHODS_TABLE);
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        $this->ci->db->order_by("group_id ASC");
        $this->ci->db->order_by("id ASC");
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $tmp_gid = $method_groups[$r['group_id']]['gid'];
                $r["name"] = l("method_name_" . $r["id"], 'ausers_moderation');
                $return[$tmp_gid]['methods'][] = $r;
            }
        }
        return $return;
    }

    /**
     * Export modules' language of available methods for moderators
     *
     * @param array $params    filters criteria
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function getMethodsLangExport($params = [], $langs_ids = [])
    {
        $this->ci->db->select('id, module, method, is_default')->from(AUSERS_MODERATE_METHODS_TABLE);

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
        $this->ci->db->order_by("module ASC");
        $this->ci->db->order_by("is_default DESC");
        $this->ci->db->order_by("id ASC");

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as &$r) {
                foreach ($langs_ids as $lang_id) {
                    $r["langs"][$lang_id] = l("method_name_" . $r["id"], 'ausers_moderation', $lang_id);
                }
            }
        }

        return $results;
    }

    /**
     * Return avalable methods for moderators of specified module as array
     *
     * @param string $module module GUID
     *
     * @return array
     */
    public function getModuleMethods($module)
    {
        $return = [];
        $this->ci->db->select('method, is_default')->from(AUSERS_MODERATE_METHODS_TABLE)->where('module', $module);

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $return[] = $r['method'];
            }
        }

        return $return;
    }

    /**
     * Save data of available method for moderator to data source
     *
     * @param integer $method_id method identifier
     * @param array   $attrs     method data
     * @param array   $langs     languages data
     *
     * @return integer
     */
    public function saveMethod($id = null, $attrs = [], $langs = [])
    {
        if (empty($id)) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(AUSERS_MODERATE_METHODS_TABLE, $attrs);
            $id = $this->ci->db->insert_id();
        } elseif (!empty($attrs)) {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(AUSERS_MODERATE_METHODS_TABLE, $attrs);
        }

        if (!empty($langs)) {
            $lang_ids = array_keys($langs);
            $this->ci->pg_language->pages->set_string_langs('ausers_moderation', "method_name_" . $id, $langs, $lang_ids);
        }

        return $id;
    }

    /**
     * Remove data of available methods for moderators from data source by filters criteria
     *
     * @param array $params filters criteria
     *
     * @return void
     */
    public function deleteMethods($params)
    {
        $this->ci->db->select('id')->from(AUSERS_MODERATE_METHODS_TABLE);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $this->delete_method($r["id"]);
            }
        }

        return;
    }

    /**
     * Remove data of available method for moderators from data source by identifier
     *
     * @param integer $method_id method identifier
     *
     * @return void
     */
    public function deleteMethod($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(AUSERS_MODERATE_METHODS_TABLE);
        $this->ci->pg_language->pages->delete_string('ausers_moderation', "method_name_" . $id);

        return;
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
            $query['where'] = ['module' => $module,
                'method' => $method,];
            $method = $this->ci->Moderators_model->get_methods($query);
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
            $gids_db = $this->get_lang_gids($module, $methods);
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
            'delete_method' => 'deleteMethod',
            'delete_methods' => 'deleteMethods',
            'delete_user' => 'deleteUser',
            'export_langs' => 'exportLangs',
            'format_user' => 'formatUser',
            'get_lang_gids' => 'getLangGids',
            'get_methods' => 'getMethods',
            'get_methods_lang_export' => 'getMethodsLangExport',
            'get_module_methods' => 'getModuleMethods',
            'get_user_by_id' => 'getUserById',
            'get_user_by_login_password' => 'getUserByLoginPassword',
            'get_users_count' => 'getUsersCount',
            'get_users_list' => 'getUsersList',
            'save_method' => 'saveMethod',
            'save_user' => 'saveUser',
            'validate_user' => 'validateUser'
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
