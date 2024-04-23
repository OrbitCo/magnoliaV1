<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/**
 * User types model
 *
 * @package PG_Dating
 *
 * @author Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('GROUPS_TABLE')) {
    define('GROUPS_TABLE', DB_PREFIX . 'groups');
}

/**
 * Users types main model
 *
 * @package     PG_Dating
 * @subpackage  Users
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class GroupsModel extends \Model
{
    /**
     * Default group gid
     *
     * @var string
     */
    public const DEFAULT_GROUP = 'default';

    /**
     * Trial group gid
     *
     * @var string
     */
    public const TRIAL_GROUP = 'trial';

    protected $fields_all = [
        'id',
        'gid',
        'is_default',
        'is_active',
        'is_trial',
        'trial_period',
        'priority',
        'date_created',
        'date_modified',
    ];

    private $groups_all = null;

    /**
     * Constructor
     *
     * @return users object
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(GROUPS_TABLE);
    }

    private function getAllGroups()
    {
        if ($this->groups_all === null) {
            $fields = $this->fields_all;

            $this->groups_all = $this->ci->cache->get(GROUPS_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(GROUPS_TABLE)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        if (empty($this->groups_all)) {
            return [];
        }

        return $this->groups_all;
    }

    public function getGroupById(int $group_id, $langs_ids = null)
    {
        $groups_raw = $this->getAllGroups();

        foreach ($groups_raw as $group_raw) {
            if ($group_raw['id'] == $group_id) {
                return $group_raw;
            }
        }

        return false;
    }

    public function getGroupByGid(string $group_gid, $format = true)
    {
        $groups_raw = $this->getAllGroups();

        foreach ($groups_raw as $group_raw) {
            if ($group_raw['gid'] === $group_gid) {
                return $group_raw;
            }
        }

        return false;
    }

    /**
     * Group check
     *
     * @return boolean/integer
     */
    public function isTrialGroup()
    {
        $groups = $this->getAllGroups();
        foreach ($groups as $group) {
            if ($group['gid'] == self::TRIAL_GROUP) {
                return $group['is_active'];
            }
        }

        return false;
    }

    /**
     * Getting trial group
     *
     * @return mixed
     */
    public function getTrialGroup()
    {
        $groups_raw = $this->getAllGroups();
        foreach ($groups_raw as $group_raw) {
            if ($group_raw['is_trial'] == 1) {
                return $group_raw;
            }
        }

        return false;
    }

    public function getDefaultGroupId()
    {
        $groups_raw = $this->getAllGroups();
        foreach ($groups_raw as $group_raw) {
            if ($group_raw['is_default'] == 1) {
                return $group_raw['id'];
            }
        }

        return false;
    }

    public function getGroupsList($params = [], $langs_ids = [])
    {
        if (empty($langs_ids)) {
            $langs_ids = [$this->ci->pg_language->current_lang_id];
        }

        $fields = $this->fields_all;

        foreach ($langs_ids as $lang_id) {
            $fields[] = 'name_' . $lang_id;
            $fields[] = 'description_' . $lang_id;
        }

        $this->ci->db->select(implode(", ", $fields));
        $this->ci->db->from(GROUPS_TABLE);

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
            return $results;
        }

        return false;
    }

    public function getGroupsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(GROUPS_TABLE);

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
            return (int)$result[0]->cnt;
        }

        return 0;
    }

    public function saveGroup($group_id = null, $attrs = [])
    {
        if (is_null($group_id)) {
            $attrs["date_created"]  = $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(GROUPS_TABLE, $attrs);
            $group_id = $this->ci->db->insert_id();
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $group_id);
            $this->ci->db->update(GROUPS_TABLE, $attrs);
        }

        $this->ci->cache->flush(GROUPS_TABLE);

        $this->groups_all = null;

        return (int)$group_id;
    }

    public function deleteGroup($group_id)
    {
        $this->ci->db->where('id', $group_id);
        $this->ci->db->delete(GROUPS_TABLE);
        $this->ci->pg_language->pages->delete_string(
            "groups_langs",
            "group_item_" . $group_id
        );

        $this->ci->cache->flush(GROUPS_TABLE);

        $this->groups_all = null;
    }

    /**
     * Group validate
     *
     * @param integer $group_id
     * @param array $data
     *
     * @return array
     */
    public function validateGroup($group_id = null, $data = [])
    {
        $return = ["errors" => [], "data" => []];

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        $languages = $this->ci->pg_language->languages;

        $return["data"]["is_active"]  = isset($data["is_active"]) ? 1 : 0;

        if (isset($data["is_trial"])) {
            $return["data"]["is_trial"]  = 1;
            $return["data"]["trial_period"]  = $this->setTrialPeriod($data);
        } else {
            $return["data"]["is_trial"]  = 0;
        }

        if (isset($data["priority"])) {
            $return["data"]["priority"] = (int)$data["priority"];
        }
        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('group_name', 'reg_exps');
        if (isset($data['name_' . $default_lang_id])) {
            $return['data']['name_' . $default_lang_id] = trim(strip_tags($data['name_' . $default_lang_id]));
            if (empty($return['data']['name_' . $default_lang_id]) || !preg_match($name_expr, $return['data']['name_' . $default_lang_id])) {
                $return['errors'][] = l('error_group_name', 'users');
            } else {
                if (is_null($group_id)) {
                    $guid_data = $this->createGUID($return['data']['name_' . $default_lang_id]);
                    if (!empty($guid_data["errors"])) {
                        $return['errors'][] = $guid_data['errors'];
                    } else {
                        $return['data']['gid'] = $guid_data['data']['gid'];
                    }
                }
                foreach ($languages as $lid => $lang_data) {
                    if ($lid == $default_lang_id) {
                        continue;
                    }
                    if (!isset($data['name_' . $lid]) || empty($data['name_' . $lid])) {
                        $return['data']['name_' . $lid] = $return['data']['name_' . $default_lang_id];
                    } else {
                        $return['data']['name_' . $lid] = trim(strip_tags($data['name_' . $lid]));
                        if (!preg_match($name_expr, $return['data']['name_' . $lid]) || empty($return['data']['name_' . $lid])) {
                            $return['errors'][] = $lang_data['name'] . ': ' . l('error_group_name', 'users');

                            break;
                        }
                    }
                }
            }
        } elseif (!$group_id) {
            $return['errors'][] = l('error_group_name', 'users');
        }

        if (isset($data['description_' . $default_lang_id])) {
            $return['data']['description_' . $default_lang_id] = trim($data['description_' . $default_lang_id]);
            if (!empty($return['data']['description_' . $default_lang_id])) {
                foreach ($languages as $lid => $lang_data) {
                    if ($lid == $default_lang_id) {
                        continue;
                    }
                    if (!isset($data['description_' . $lid]) || empty($data['description_' . $lid])) {
                        $return['data']['description_' . $lid] = $return['data']['description_' . $default_lang_id];
                    } else {
                        $return['data']['description_' . $lid] = trim($data['description_' . $lid]);
                    }
                }
            }
        }

        return $return;
    }

    public function setTrialPeriod($data)
    {
        $period = 0;
        if ($data['trial_days'] > 0) {
            $period += $data['trial_days'] * 24;
        }
        if ($data['trial_hours'] > 0) {
            $period += $data['trial_hours'];
        }

        return $period;
    }

    public function getTrialPeriod($data)
    {
        $period = ['trial_days' => 0, 'trial_hours' => 0];
        $period['trial_days'] = floor($data / 24);
        $period['trial_hours'] = floor($data - $period['trial_days'] * 24);

        return $period;
    }

    public function getTrialPeriodStr($data)
    {
        $period_str = '';
        if ($data['trial_days'] > 0) {
            $period_str .= $data['trial_days'] . ' ' . l('field_period_day', 'access_permissions');
        }
        if ($data['trial_hours'] >= 1) {
            $period_str .= ' ' . $data['trial_hours'] . ' ' . l('field_period_hours', 'access_permissions');
        } else {
            $period_str .= ' ' . l('field_expires_one_hour', 'access_permissions');
        }

        return $period_str;
    }

    public function setDefault($group_id)
    {
        $attrs["is_default"] = '0';
        $this->ci->db->where('is_default', '1');
        $this->ci->db->update(GROUPS_TABLE, $attrs);

        $attrs["is_default"] = '1';
        $this->ci->db->where('id', $group_id);
        $this->ci->db->update(GROUPS_TABLE, $attrs);

        $this->ci->cache->flush(GROUPS_TABLE);

        $this->groups_all = null;
    }

    public function getGroupStringData($group_id)
    {
        $data = [];
        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            $data[$lang_id] = $this->ci->pg_language->get_string("groups_langs", "group_item_" . $group_id, $lang_id);
        }

        return $data;
    }

    public function getGroupCurrentName($group_id)
    {
        return $this->ci->pg_language->get_string(
            "groups_langs",
            "group_item_" . $group_id
        );
    }

    protected function createGUID($name = null)
    {
        if (!is_null($name)) {
            $this->ci->load->library('Translit');
            $name = strip_tags($name);
            $gid = mb_strtolower($this->ci->translit->convert('ru', $name));
            $return = [
                'data' => ['gid' => preg_replace("/[^a-z0-9\-]+/i", '', $gid)]
            ];

            if (empty($return['data']['gid'])) {
                $return['errors'][] = l('error_group_name', 'users');
            } else {
                $param['where']['gid'] = $return['data']['gid'];
                $gid_counts = $this->getGroupsCount($param);
                if ($gid_counts > 0) {
                    $return['errors'][] = l('error_group_name_already_exists', 'users');
                }
            }
        }

        return $return;
    }

    public function updateLangs($group_gids, $langs_file, $langs_ids)
    {
        foreach ($group_gids as $key => $value) {
            $group = $this->getGroupByGid($value);
            $this->ci->pg_language->pages->set_string_langs(
                'groups_langs',
                'group_item_' . $group['id'],
                $langs_file['groups_demo_' . $value],
                (array) $langs_ids
            );
        }
    }

    public function exportLangs($group_gids, $langs_ids = null)
    {
        $gids = [];
        foreach ($group_gids as $key => $value) {
            $group  = $this->getGroupByGid($value);
            $gids[] = 'groups_demo_' . $group['id'];
        }

        return $this->ci->pg_language->export_langs(
            'groups_langs',
            $gids,
            $langs_ids
        );
    }

    /**
     * Install module fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(GROUPS_TABLE, [
            'name_' . $lang_id => [
                'type' => 'TEXT',
                'null' => true
             ]
        ]);
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(GROUPS_TABLE);
        }

        $this->ci->dbforge->add_column(GROUPS_TABLE, [
            'description_' . $lang_id => [
                'type' => 'TEXT',
                'null' => true
            ]
         ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('description_' . $lang_id, 'description_' . $default_lang_id, false);
            $this->ci->db->update(GROUPS_TABLE);
        }
    }

    /**
     * Uninstall module fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();

        $fields_exists = $this->ci->db->list_fields(GROUPS_TABLE);

        $fields = [
            'name_' . $lang_id,
            'description_' . $lang_id,
        ];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(GROUPS_TABLE, $field_name);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'update_langs' => 'updateLangs',
            'export_langs' => 'exportLangs',

        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
