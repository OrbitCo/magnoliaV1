<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\models;

use Pg\modules\users\models\UsersModel;

define("PERFECT_MATCH_TABLE", DB_PREFIX . "perfect_match");

/**
 * Perfect_match model
 *
 * @package     PG_Dating
 * @subpackage  Perfect_match
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PerfectMatchModel extends \Model
{
    public const MODULE_GID = 'perfect_match';
    public const DB_DATE_FORMAT_SEARCH = 'Y-m-d H:i';

    private $fields_users_table = [
        'online_status',
        'approved',
        'confirm',
        'activity',
        'hide_on_site_end_date <'
    ];

    private $fields = [
        'id_user',
        'looking_user_type',
        'looking_id_country',
        'looking_id_region',
        'looking_id_city',
        'looking_lat',
        'looking_lon',
        'age',
        'age_min',
        'age_max',
        'full_criteria',
        'is_need_notify',
    ];
    private $fields_all = [];
    private $linked_fields = [
        'id_user',
        'looking_user_type',
        'looking_id_country',
        'looking_id_region',
        'looking_id_city',
        'looking_lat',
        'looking_lon',
        'age_min',
        'age_max',
    ];
    private $linked_fields_all = [];

    public $form_editor_type = "users";

    public $perfect_match_form_gid = "perfect_match";

    /**
     * PerfectMatchModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(PERFECT_MATCH_TABLE);
    }

    public function saveParams($user_id, $attrs = [], $fields_type = 'linked')
    {
        $is_changed = false;

        if ($fields_type == 'linked') {
            $params =  $this->getUserParams($user_id, true);
            $fields = $this->linked_fields_all;
        } else {
            $params = ['full_criteria' => []];
            $fields = $this->fields_all;
        }

        foreach ($fields as $field => $value) {
            if (isset($attrs[$value]) && $value != 'id_user' && (!isset($params[$value]) || $params[$value] != $attrs[$value])) {
                $params[$value] = $attrs[$value];
                $params['full_criteria'][$value] = $attrs[$value];
                $is_changed = true;
            }
        }

        $fields_all = array_flip($this->fields_all);

        if (!empty($params['full_criteria'])) {
            foreach ($params['full_criteria'] as $field => $full_criteria) {
                if (!array_key_exists($field, $fields_all)) {
                    unset($params['full_criteria'][$field]);
                }
            }
        }

        if ($is_changed) {
            $full_criteria = serialize($params['full_criteria']);
            unset($params['full_criteria']);

            $params_ins['full_criteria'] = $full_criteria;
            $params_ins['id_user'] = $user_id;
            $params['is_need_notify'] = 1;

            $params_upd = [];
            foreach ($params as $field => $attr) {
                if (is_array($attr)) {
                    $arr_attr = implode(",", $attr);
                    $params_upd[] = "`{$field}`=" . $this->ci->db->escape($arr_attr);
                } else {
                    $params_upd[] = "`{$field}`=" . $this->ci->db->escape($attr);
                }
            }

            $params_ins['is_need_notify'] = 1;

            $sql = $this->ci->db->insert_string(PERFECT_MATCH_TABLE, $params_ins) . " ON DUPLICATE KEY UPDATE " . implode(',', $params_upd);
            $this->ci->db->query($sql);
            $this->ci->cache->flush(PERFECT_MATCH_TABLE);
        }
    }

    public function getFulltextData($id, $fields): array
    {
        $return = ['main_fields' => [], 'fe_fields' => [], 'default_lang_id' => $this->ci->pg_language->get_default_lang_id(), 'object_lang_id' => 1];
        $this->setAdditionalFields($fields);
        $data = $this->getUserById($id);

        foreach ($fields as $field) {
            $return['fe_fields'][$field] = $data[$field];
        }

        return $return;
    }

    public function setAdditionalFields($fields)
    {
        if (!empty($fields)) {
            foreach ($fields as $field) {
                if (($key = array_search($field, $this->fields_all)) === false) {
                    $this->dop_fields[] = $field;
                }
            }
        } else {
            $this->ci->load->model('Field_editor_model');
            $fields_list = $this->ci->Field_editor_model->get_fields_list();

            if (!empty($fields_list)) {
                foreach ($fields_list as $field) {
                    if (($key = array_search($field['field_name'], $this->fields_all)) === false) {
                        $this->dop_fields[] = $field['field_name'];
                    }
                }
            }
        }
        $this->fields_all = (!empty($this->dop_fields)) ? array_merge($this->fields, $this->dop_fields) : $this->fields;
        $this->linked_fields_all = (!empty($this->dop_fields)) ? array_merge($this->linked_fields, $this->dop_fields) : $this->linked_fields;
    }

    public function getUserParams($user_id, $for_save = false)
    {
        $result = $this->getParams([$user_id], $for_save);

        return !empty($result[$user_id]) ? $result[$user_id] : [];
    }

    private function getParams($users_ids, $for_save = false)
    {
        $nameTable  = PERFECT_MATCH_TABLE;
        $fields     = implode(',', $this->fields_all);
        $users_perfect_match =  $this->ci->cache->get(PERFECT_MATCH_TABLE, 'getParams'.implode('_', $users_ids), function () use ($users_ids, $fields, $nameTable) {
            $ci = &get_instance();

            return $ci->db->select($fields)
                ->from($nameTable)
                ->where_in('id_user', $users_ids)
                ->get()
                ->result_array();
        });

        //get all fields from FE for current perfect match form
        $fields_all_cache = $this->fields_all;

        $this->ci->load->model('Field_editor_model');
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');

        $form = $this->ci->Field_editor_forms_model->get_form_by_gid($this->perfect_match_form_gid, $this->form_editor_type);
        $fields_for_search = $this->ci->Field_editor_model->get_fields_names_for_search($form);
        $this->setAdditionalFields($fields_for_search);
        $fields_for_search_by_keys = array_flip($this->fields_all);

        $fields_settings = [];

        foreach ($form as $form_data) {
            if (is_array($form_data)) {
                foreach ($form_data as $f) {
                    $fields_settings[$f['field']['gid']] = $f['field']['type'];
                }
            }
        }

        $result = [];

        foreach ($users_perfect_match as $upm) {
            $user_id = $upm['id_user'];
            unset($upm['id_user']);

            foreach ($fields_settings as $name => $type) {
                if (!empty($upm['fe_'.$name]) && $type == 'select') {
                    $upm['fe_'.$name] = explode(',', $upm['fe_'.$name]);
                }
            }

            if (!empty($upm['full_criteria'])) {
                $upm['full_criteria'] = unserialize($upm['full_criteria']);
                if (empty($upm['full_criteria'])) {
                    unset($upm['full_criteria']);
                    $upm['full_criteria'] = $upm;
                }
            } else {
                $upm['full_criteria'] = $upm;
            }

            //save only fields from current PM form
            $upm['full_criteria'] = array_intersect_key($upm['full_criteria'], $fields_for_search_by_keys);

            if (!$for_save) {
                if (!is_array($upm['looking_user_type'])) {
                    if (isset($upm['looking_user_type']) && strpos($upm['looking_user_type'], ',') !== false) {
                        $upm['looking_user_type'] = explode(",", $upm['looking_user_type']);
                    }
                }

                if (isset($upm['full_criteria']['looking_user_type']) &&
                    !is_array($upm['full_criteria']['looking_user_type']) &&
                    strpos($upm['full_criteria']['looking_user_type'], ',') !== false) {
                    $upm['full_criteria']['looking_user_type'] = explode(",", $upm['full_criteria']['looking_user_type']);
                }

                $upm['user_type'] = $upm['looking_user_type'] ?? null;
                $upm['full_criteria']['user_type'] = $upm['full_criteria']['looking_user_type'] ?? $upm['looking_user_type'];
                unset($upm['looking_user_type'], $upm['full_criteria']['looking_user_type']);
            }

            $result[$user_id] = $upm;
        }
        $this->fields_all = $fields_all_cache; //restore fields

        return $result;
    }

    public function validate($data, $type = 'save')
    {
        $return["errors"] = [];
        $return["data"] = [];
        if (!empty($data["id_user"])) {
            $return["data"]["id_user"] = (int)$data["id_user"];
        }
        if (!empty($data["looking_user_type"])) {
            $return["data"]["looking_user_type"] = is_array($data["looking_user_type"]) === true
                ? implode(',', $data["looking_user_type"]) : $data["looking_user_type"];
        } elseif (!empty($data["user_type"])) {
            $return["data"]["looking_user_type"] = is_array($data["user_type"]) === true
                ? implode(',', $data["user_type"]) : $data["user_type"];
        }

        if (!empty($data["age"])) {
            $return["data"]["age"] = $data["age"];
        }
        if ($type == 'select' && !empty($return["data"]["looking_user_type"])) {
            $return["data"]["user_type"] = explode(',', $return["data"]["looking_user_type"]);
            unset($return["data"]["looking_user_type"]);
        }

        if (!empty($data["id_country"])) {
            $return["data"]["id_country"] = $data["id_country"];
            if (!empty($data["id_region"])) {
                $return["data"]["id_region"] = $data["id_region"];
                if (!empty($data["id_city"])) {
                    $return["data"]["id_city"] = $data["id_city"];
                    if (!empty($data["lat"])) {
                        $return["data"]["lat"] = (float)$data["lat"];
                    }
                    if (!empty($data["lon"])) {
                        $return["data"]["lon"] = (float)$data["lon"];
                    }
                }
            }
        }

        if (!empty($data["looking_id_country"])) {
            $return["data"]["looking_id_country"] = trim(strip_tags($data["looking_id_country"]));
        } elseif (!empty($data["id_country"])) {
            $return["data"]["looking_id_country"] = $data["id_country"];
        } /*else {
            $return["data"]["looking_id_country"] = "";
        }*/

        if (!empty($data["looking_id_region"])) {
            $return["data"]["looking_id_region"] = (int)$data["looking_id_region"];
        } elseif (isset($data["id_region"]) && (int) $data["id_region"] >= 0) {
            $return["data"]["looking_id_region"] = (int)$data["id_region"];
        }/* else {
            $return["data"]["looking_id_region"] = "";
        }*/

        if (!empty($data["looking_id_city"])) {
            $return["data"]["looking_id_city"] = (int)$data["looking_id_city"];
        } elseif (isset($data["id_city"]) && (int) $data["id_city"] >= 0) {
            $return["data"]["looking_id_city"] = (int)$data["id_city"];
        }/* else {
            $return["data"]["looking_id_city"] = "";
        }*/

        if (!empty($data["looking_lat"])) {
            $return["data"]["looking_lat"] = (float)$data["looking_lat"];
        } elseif (!empty($data["lat"])) {
            $return["data"]["looking_lat"] = (float)$data["lat"];
        }

        if (!empty($data["looking_lon"])) {
            $return["data"]["looking_lon"] = (float)$data["looking_lon"];
        } elseif (!empty($data["lon"])) {
            $return["data"]["looking_lon"] = (float)$data["lon"];
        }

        $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
        $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
        if (!empty($data['age_min'])) {
            $return["data"]["age_min"] = (int)$data['age_min'];
            if ($return["data"]["age_min"] < $age_min || $return["data"]["age_min"] > $age_max) {
                $return["data"]["age_min"] = $age_min;
            }
        }
        if (!empty($data['age_max'])) {
            $return["data"]["age_max"] = (int)$data['age_max'];
            if ($return["data"]["age_max"] < $age_min || $return["data"]["age_max"] > $age_max) {
                $return["data"]["age_max"] = $age_max;
            }
            if (!empty($return["data"]["age_min"]) && $return["data"]["age_min"] > $return["data"]["age_max"]) {
                $return["data"]["age_min"] = $age_min;
            }
        }

        $this->ci->load->model('Field_editor_model');
        $fields_list = $this->ci->Field_editor_model->get_fields_list();

        if (!empty($fields_list)) {
            foreach ($data as $key => $value) {
                foreach ($fields_list as $fields => $field) {
                    if ($field['field_name'] == $key) {
                        $return["data"][$key] = $value;
                    }
                }
            }
        }

        return $return;
    }

    /**
     * $attrs array
     * $user_id integer user id
     *
     * @return void
     **/
    public function userUpdated($attrs = [], $user_id = null)
    {
        $validate = $this->validate($attrs);
        if (!$validate['errors']) {
            $id_user = $this->getUserById($user_id);

            $full_criteria = array_intersect_key($validate['data'], array_flip($this->linked_fields));

            if (!$id_user) {
                $this->ci->load->model('Users_model');
                $user_info = $this->ci->Users_model->getUserById($user_id);

                $validate['data']['id_user'] = $user_id;
                $validate['data']['user_type'] = $user_info['user_type'];
                $validate['data']['age'] = $user_info['age'];
                $validate['data']['full_criteria'] = serialize($full_criteria);

                $this->ci->db->insert(PERFECT_MATCH_TABLE, $validate['data']);
            } elseif (!empty($validate['data'])) {
                $validate['data']['full_criteria'] = serialize($full_criteria);
                $this->ci->db->where('id_user', $user_id);
                $this->ci->db->update(PERFECT_MATCH_TABLE, $validate['data']);
            }
        }
        $this->ci->cache->flush(PERFECT_MATCH_TABLE);
    }

    /**
     * Get user by ID
     *
     * @param null $user_id
     *
     * @return mixed
     */
    public function getUserById($user_id = null)
    {
        $nameTable  = PERFECT_MATCH_TABLE;
        $results =  $this->ci->cache->get(PERFECT_MATCH_TABLE, 'getUserById'.$user_id, function () use ($user_id, $nameTable) {
            $ci = &get_instance();
            $ci->db->select();
            $ci->db->where('id_user', $user_id);
            $ci->db->from($nameTable);

            return $ci->db->get()->result_array();
        });

        if (!empty($results) && is_array($results)) {
            return true;
        }

        return false;
    }

    /**
     * $page integer page number
     * $items_on_page integer number records on page
     * $order_by column sort
     * $params array
     * $filter_object_ids array
     * $formatted bool
     * $safe_format bool
     * $lang_id integer id language
     *
     * @return bool
     **/
    public function getUsersList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [], $formatted = true, $safe_format = false, $lang_id = '')
    {
        if (empty($params["fields"])) {
            $params["fields"] = [];
        }
        $this->setAdditionalFields($params["fields"]);

        $fields_all = [];
        foreach ($this->fields_all as $key => $value) {
            $fields_all[] = PERFECT_MATCH_TABLE.".".$value;
        }

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $params['where_not_in']['id_user'] = $blocked_ids;
            }
        }

        $this->ci->db->select(implode(", ", $fields_all));
        $this->ci->db->from(PERFECT_MATCH_TABLE);

        if (!empty($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->join(USERS_TABLE, USERS_TABLE.'.id = ' . PERFECT_MATCH_TABLE . '.id_user', 'left');
            foreach ($params["where"] as $field => $value) {
                if (in_array($field, $this->fields_users_table) === true) {
                    $this->ci->db->where(USERS_TABLE.".".$field, $value);
                } else {
                    $this->ci->db->where(PERFECT_MATCH_TABLE.".".$field, $value);
                }
            }
        }

        if (!empty($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (!empty($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (!empty($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in(PERFECT_MATCH_TABLE.".id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields_all) || $field == 'fields') {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = (int)$page ? (int)$page : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            if ($formatted) {
                $id_user_array = [];
                foreach ($results as $key => $values) {
                    if (!empty($values['id_user'])) {
                        $id_user_array[] = $values['id_user'];

                        continue;
                    }
                }
                $this->ci->load->model('users/models/Users_model');

                if (!empty($order_by["id_user"])) {
                    $order_by = ["date_created" => $order_by["id_user"]];
                    unset($order_by["id_user"]);
                }

                $results = $this->ci->Users_model->getUsersListByKey(null, null, $order_by, [], $id_user_array);
            }

            return $results;
        }

        return [];
    }

    public function getUsersCount($params = [], $filter_object_ids = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $params['where_not_in']['id_user'] = $blocked_ids;
            }
        }

        if (!empty($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->join(USERS_TABLE, USERS_TABLE.'.id = ' . PERFECT_MATCH_TABLE . '.id_user', 'left');
            foreach ($params["where"] as $field => $value) {
                if (in_array($field, $this->fields_users_table) === true) {
                    $this->ci->db->where(USERS_TABLE.".".$field, $value);
                } else {
                    $this->ci->db->where(PERFECT_MATCH_TABLE.".".$field, $value);
                }
            }
        }

        if (!empty($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (!empty($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in(PERFECT_MATCH_TABLE.".".$field, $value);
            }
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }
        $result = $this->ci->db->count_all_results(PERFECT_MATCH_TABLE);

        return $result;
    }

    public function getCommonCriteria($data)
    {
        $criteria = [
            'where' => [
                'confirm' => 1,
                'activity' => 1,
                'approved' => 1,
                'hide_on_site_end_date <' => date(self::DB_DATE_FORMAT_SEARCH)
            ]
        ];

        if (!empty($data['age_min'])) {
            $criteria["where"]["age >="] = (int)$data["age_min"];
        }
        if (!empty($data['age_max'])) {
            $criteria["where"]["age <="] = (int)$data["age_max"];
        }

        if (!empty($data['looking_user_type']) && $data['looking_user_type'] != 'all') {
            $looking_user_type = $data["looking_user_type"];
        } elseif (!empty($data['user_type']) && $data['user_type'] != 'all') {
            $looking_user_type = $data["user_type"];
        }

        if (!empty($looking_user_type)) {
            if (is_array($looking_user_type)) {
                $criteria["where_in"]["user_type"] = $looking_user_type;
            } else {
                $criteria["where"]["user_type"] = $looking_user_type;
            }
        }

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $criteria["where"]["id_user !="] = $this->ci->session->userdata('user_id');
        }

        if (isset($data['radius']) && !empty($data['radius'] && $data['lat'])) {
            $data['distance'] = $data['radius'] / UsersModel::METERS_IN_MILE;

            $data['distance'] = (int)($data['distance'] * $data['distance']);
            $data['radius'] = $data['radius'] / UsersModel::METERS_IN_KM;

            if (!empty($data['lon']) && !empty($data['lat'])) {
                $data['min_lon'] = $data['lon'] - $data['radius'] / abs(cos(deg2rad($data['lat'])) * UsersModel::KM_IN_RAD);
                $data['max_lon'] = $data['lon'] + $data['radius'] / abs(cos(deg2rad($data['lat'])) * UsersModel::KM_IN_RAD);
                $data['min_lat'] = $data['lat'] - ($data['radius'] / UsersModel::KM_IN_RAD);
                $data['max_lat'] = $data['lat'] + ($data['radius'] / UsersModel::KM_IN_RAD);

                if (!empty($data['min_lat'])) {
                    $criteria['where']['lat >='] = (float)$data['min_lat'];
                }
                if (!empty($data['max_lat'])) {
                    $criteria['where']['lat <='] = (float)$data['max_lat'];
                }
                if (!empty($data['min_lon'])) {
                    $criteria['where']['lon >='] = (float)$data['min_lon'];
                }
                if (!empty($data['max_lon'])) {
                    $criteria['where']['lon <='] = (float)$data['max_lon'];
                }
                if (!empty($data['distance']) && !empty($data['lat']) && !empty($data['lon'])) {
                    $criteria['where_sql'][] = "(POW((69.1*(" . PERFECT_MATCH_TABLE . ".lon - " . $data['lon'] . ")*cos(" . $data['lat'] . "/57.3)),\"2\")+POW((69.1*(" . PERFECT_MATCH_TABLE . ".lat - " . $data['lat'] . ")),\"2\")) <=" . $data['distance'];
                }
            }
        } else {
            if (!empty($data["looking_id_country"])) {
                $criteria["where"]["id_country"] = $data["looking_id_country"];
            } elseif (!empty($data["id_country"])) {
                $criteria["where"]["id_country"] = $data["id_country"];
            }
            if (!empty($data["looking_id_region"])) {
                $criteria["where"]["id_region"] = $data["looking_id_region"];
            } elseif (!empty($data["id_region"])) {
                $criteria["where"]["id_region"] = $data["id_region"];
            }
            if (!empty($data["looking_id_city"])) {
                $criteria["where"]["id_city"] = $data["looking_id_city"];
            } elseif (!empty($data["id_city"])) {
                $criteria["where"]["id_city"] = $data["id_city"];
            }
        }

        if (!empty($data['online_status']) && $data['online_status']) {
            $criteria["where"]["online_status"] = 1;
        }

        if ($this->ci->session->userdata('user_type') == 'couple') {
            $criteria["where_not_in"]["id_user"] = [$this->ci->session->userdata('user_id'), $this->ci->session->userdata('couple_id')];
        }

        return $criteria;
    }

    public function callbackUserDelete($id_user)
    {
        if (!empty($id_user)) {
            $this->ci->db->where('id_user', $id_user);
            $this->ci->db->delete(PERFECT_MATCH_TABLE);
            $this->ci->cache->flush(PERFECT_MATCH_TABLE);
        }
    }

    /**
     *  Seo settings
     *
     *  @param string $method
     *  @param integer $lang_id
     *
     *  @return void
     */
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        }
        $actions = ['index'];
        $return = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
        }

        return $return;
    }

    private function getSeoSettingsInternal($method, $lang_id = ''): array
    {
        $result = [];
        if (!empty($method) && $method === 'index') {
            $result['templates'] = [];
            $result['url_vars'] = [];
        }

        return $result;
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }

        return $value;
    }

    /**
     *  Site map xml
     *
     *  @return array
     */
    public function getSitemapXmlUrls(): array
    {
        $this->ci->load->helper('seo');

        return [];
    }

    /**
     *  Banner pages
     *
     *  @return array
     */
    public function bannerAvailablePages()
    {
        $return[] = ["link" => "perfect_match/index", "name" => l('search_results', 'users')];

        return $return;
    }

    public function cronSendMatches()
    {
        $new_params = $this->getUsersList(null, null, null, ['where' => ['is_need_notify' => 1]], [], false);
        if (empty($new_params)) {
            return true;
        }

        foreach ($new_params as $new_param) {
            $new_user_ids[] = $new_param['id_user'];
        }

        $matches = [];

        $this->ci->load->model(['mobile/models/MobileUsersPushNotificationsModel', 'Users_model', 'Field_editor_model', 'field_editor/models/Field_editor_forms_model']);

        $this->ci->Field_editor_model->initialize($this->form_editor_type);
        $form = $this->ci->Field_editor_forms_model->get_form_by_gid($this->perfect_match_form_gid, $this->form_editor_type);
        $fields_for_search = $this->ci->Field_editor_model->get_fields_names_for_search($form);
        $this->setAdditionalFields($fields_for_search);

        $users_data = $this->ci->Users_model->getUsersListByKey(1, 10, null, ['where' => ['activity' => 1]], $new_user_ids);

        foreach ($users_data as $user) {
            $perfect_match_params = $this->getUserParams($user['id']);

            if (!empty($perfect_match_params['full_criteria'])) {
                $full_criteria = $perfect_match_params['full_criteria'];
            } else {
                $full_criteria = [];
            }

            $common_criteria = $this->getCommonCriteria($full_criteria);

            $criteria = array_merge_recursive($this->ci->Field_editor_forms_model->get_search_criteria(
                $this->perfect_match_form_gid,
                $full_criteria,
                $this->form_editor_type,
                false
            ), $common_criteria);
            
            if (empty($user['looking_user_type'])) {
                continue;
            }

            $criteria['where']['id_user !=']        = $user['id'];
            $criteria['where']['looking_user_type'] = $user['user_type'];
            $criteria['where_sql'][] = '('.PERFECT_MATCH_TABLE.'.looking_id_country=0 OR '.PERFECT_MATCH_TABLE.'.looking_id_country=' . $this->ci->db->escape($user['id_country']) . ')';
            $criteria['where_sql'][] = '('.PERFECT_MATCH_TABLE.'.looking_id_region=0 OR '.PERFECT_MATCH_TABLE.'.looking_id_region=' . $this->ci->db->escape($user['id_region']) . ')';
            $criteria['where_sql'][] = '('.PERFECT_MATCH_TABLE.'.looking_id_city=0 OR '.PERFECT_MATCH_TABLE.'.looking_id_city=' . $this->ci->db->escape($user['id_city']) . ')';
            $criteria['where_sql'][] = '('.PERFECT_MATCH_TABLE.'.age_min=0 OR '.PERFECT_MATCH_TABLE.'.age_min <=' . $this->ci->db->escape($user['age']) . ')';
            $criteria['where_sql'][] = '('.PERFECT_MATCH_TABLE.'.age_max=0 OR '.PERFECT_MATCH_TABLE.'.age_max >=' . $this->ci->db->escape($user['age']) . ')';

            $matched_users = $this->getUsersList(null, null, [], $criteria, [], true, false);

            foreach ($matched_users as $matched_user) {
                if (!isset($matches[$matched_user['id']])) {
                    $matches[$matched_user['id']] = 0;
                    $users[$matched_user['id']] = $matched_user;
                }
                $matches[$matched_user['id']]++;
            }
        }

        foreach ($matches as $user_id => $count) {
            $title = l('new_matches_title', 'perfect_match', $users[$user_id]['lang_id']);
            $text = str_replace("[count]", $count, l('new_matches_text', 'perfect_match', $users[$user_id]['lang_id']));
            $this->ci->MobileUsersPushNotificationsModel->pushNotification([
                'id_user' => (int)$user_id,
                'title' => (string)$title,
                'body' => (string)$text,
                'activity' => 'PerfectMatchActivity',
                'module' => 'perfect_match',
                'gid' => 'match',
                'count' => (int)$count,
                'link' => site_url() . 'perfect_match/index'
            ]);
        }

        $this->ci->db->where_in('id_user', $new_user_ids);
        $this->ci->db->update(PERFECT_MATCH_TABLE, ['is_need_notify' => 0]);
        $this->ci->cache->flush(PERFECT_MATCH_TABLE);

        return true;
    }

    public function __call($name, $args)
    {
        $methods = [
            'callback_user_delete' => 'callbackUserDelete',
            'user_updated' => 'userUpdated',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
