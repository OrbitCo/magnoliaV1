<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models;

if (!defined('FIELD_EDITOR_SECTIONS')) {
    define('FIELD_EDITOR_SECTIONS', DB_PREFIX . 'field_editor_sections');
}

if (!defined('FIELD_EDITOR_FIELDS')) {
    define('FIELD_EDITOR_FIELDS', DB_PREFIX . 'field_editor_fields');
}

/**
 * Field Editor Model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FieldEditorModel extends \Model
{
    private $default_editor_type = '';
    public $settings = [];
    private $cache_field_by_id;
    private $cache_field_by_gid;
    private $cache_section_by_id;
    private $cache_section_by_gid;
    public $fields;
    private $fields_all = null;
    private $attrs = [
        FIELD_EDITOR_FIELDS => [
            'id', 'gid', 'section_gid', 'editor_type_gid', 'field_type',
            'fts', 'settings_data', 'sorter',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->fields = new FieldTypesLoaderModel();

        $this->getDefaultEditorType(true);
        $this->initialize($this->default_editor_type);

        $this->ci->cache->registerService(FIELD_EDITOR_FIELDS);
    }

    public function initialize($type = 'users')
    {
        $this->ci->config->load('field_editor', true);
        $settings = $this->ci->config->item('editor_type', 'field_editor');
        if (!$type) {
            $type = $this->get_default_editor_type(true);
        }
        $this->settings = $settings[$type];
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getEditorTypes($installed_only = false)
    {
        $this->ci->config->load('field_editor', true);
        $settings = $this->ci->config->item('editor_type', 'field_editor');

        $return = [];
        if ($installed_only) {
            foreach ($settings as $type => $sett) {
                if ($this->ci->pg_module->is_module_installed($sett['module'])) {
                    $return[$type] = $sett;
                }
            }
        } else {
            $return = $settings;
        }

        return $return;
    }

    public function getDefaultEditorType($installed_only = false)
    {
        if ($installed_only) {
            $editor_types = $this->get_editor_types($installed_only);
            if (!isset($editor_types[$this->default_editor_type])) {
                $keys = array_keys($editor_types);
                $this->default_editor_type = array_shift($keys);
            }
        }

        return $this->default_editor_type;
    }

    public function getFieldSettings($field_type)
    {
        return $this->fields->{$field_type}->manage_field_param;
    }

    /*
     * Sections methods
     *
     */

    public function getSectionById($id)
    {
        if (empty($this->cache_section_by_id[$id])) {
            $result = $this->ci->db->select("id, gid, editor_type_gid, sorter")->from(FIELD_EDITOR_SECTIONS)->where("id", $id)->get()->result_array();
            $return = (!empty($result)) ? $this->format_section($result[0]) : [];
            $this->cache_section_by_id[$id] = $this->cache_section_by_gid[$return["gid"]] = $return;
        }

        return $this->cache_section_by_id[$id];
    }

    public function getSectionByGid($gid)
    {
        if (empty($this->cache_section_by_gid[$gid])) {
            $result = $this->ci->db->select("id, gid, editor_type_gid, sorter")->from(FIELD_EDITOR_SECTIONS)->where("gid", $gid)->where('editor_type_gid', $this->settings['gid'])->get()->result_array();
            $return = (!empty($result)) ? $this->formatSection($result[0]) : [];
            if (!empty($return)) {
                $this->cache_section_by_gid[$gid] = $this->cache_section_by_id[$return["id"]] = $return;
            }
        }

        return $this->cache_section_by_gid[$gid];
    }

    public function formatSection($data, $lang_id = '')
    {
        if (is_array($lang_id)) {
            foreach ($lang_id as $lid) {
                $data["name_" . $lid] = l('section_' . $data["id"], 'field_editor_sections', $lid);
            }
            $lang_id = $this->ci->pg_language->current_lang_id;
        }
        $data["name"] = l('section_' . $data["id"], 'field_editor_sections', $lang_id);

        return $data;
    }

    public function getSectionList($params = [], $order_by = [], $lang_id = '')
    {
        $params["where"]["editor_type_gid"] = $this->settings["gid"];

        $this->ci->db->select("id, gid, editor_type_gid, sorter")->from(FIELD_EDITOR_SECTIONS);

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

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        } else {
            $this->ci->db->order_by("sorter ASC");
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $k => $r) {
                $return[$r["gid"]] = $this->format_section($r, $lang_id);
            }

            return $return;
        }

        return [];
    }

    public function getSectionCount($params = [])
    {
        $params["where"]["editor_type_gid"] = $this->settings["gid"];

        $this->ci->db->select("COUNT(*) AS cnt")->from(FIELD_EDITOR_SECTIONS);

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
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function saveSection($id, $data, $name = null)
    {
        if (is_null($id)) {
            $this->ci->db->insert(FIELD_EDITOR_SECTIONS, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(FIELD_EDITOR_SECTIONS, $data);
        }

        if (!empty($name)) {
            $this->ci->pg_language->pages->set_string_langs('field_editor_sections', "section_" . $id, $name, array_keys($name));
        }
        unset($this->cache_section_by_id[$id]);
        if (!empty($data["gid"])) {
            unset($this->cache_section_by_gid[$data["gid"]]);
        }

        return $id;
    }

    public function setSectionSorter($id, $sorter)
    {
        $data["sorter"] = intval($sorter);
        $this->ci->db->where("id", $id);
        $this->ci->db->update(FIELD_EDITOR_SECTIONS, $data);
    }

    public function validateSection($id, $data, $lang_data = [])
    {
        $return = ["errors" => [], "data" => [], "lang" => []];

        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('name', 'reg_exps');

        if (isset($data["gid"])) {
            $data["gid"] = strtolower(strip_tags($data["gid"]));
            $data["gid"] = preg_replace("/[\n\s\t]+/i", '-', $data["gid"]);
            $data["gid"] = preg_replace("/[^a-z0-9\-_]+/i", '', $data["gid"]);
            $data["gid"] = preg_replace("/[\-]{2,}/i", '-', $data["gid"]);

            $return["data"]["gid"] = $data["gid"];

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_section_code_incorrect', 'field_editor');
            } else {
                $param["where"]["gid"] = $return["data"]["gid"];
                if ($id) {
                    $param["where"]["id <>"] = $id;
                }
                $gid_counts = $this->getSectionCount($param);
                if ($gid_counts > 0) {
                    $return["errors"][] = l('error_section_code_exists', 'field_editor');
                }
            }
        }

        if (isset($data["editor_type_gid"])) {
            $return["data"]["editor_type_gid"] = strval($data["editor_type_gid"]);
        }

        if (!empty($lang_data)) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($lang_data);
            if ($langs === false) {
                $return["errors"][] = l('error_section_name_empty', 'field_editor');
            } else {
                foreach ($langs as $id => $value) {
                    if (strpbrk($value, $name_expr) !== false) {
                        $return["errors"][] = l('error_section_name_empty', 'field_editor');

                        continue;
                    }
                    $return["lang"][$id] = $value;
                }
            }
        }

        if (isset($data["sorter"])) {
            $return["data"]["sorter"] = strval($data["sorter"]);
        }

        return $return;
    }

    public function deleteSection($id)
    {
        $data = $this->get_section_by_id($id);
        $params["where"]["section_gid"] = $data["gid"];
        $fields = $this->get_fields_list($params);

        foreach ($fields as $field) {
            $this->delete_field($field["id"]);
        }

        $this->ci->db->where('id', $id);
        $this->ci->db->delete(FIELD_EDITOR_SECTIONS);

        $this->ci->pg_language->pages->delete_string('field_editor_sections', "section_" . $id);
    }

    public function deleteSectionByGid($gid)
    {
        $data = $this->get_section_by_gid($gid);
        $params["where"]["section_gid"] = $data["gid"];
        $params["where"]["editor_type_gid"] = $data["editor_type_gid"];
        $fields = $this->get_fields_list($params);

        foreach ($fields as $field) {
            $this->delete_field($field["id"]);
        }

        $this->ci->db->where('gid', $gid);
        $this->ci->db->delete(FIELD_EDITOR_SECTIONS);

        $this->ci->pg_language->pages->delete_string('field_editor_sections', "section_" . $data["id"]);
    }

    /*
     * Perfect match Fields methods
     *
     */

    public function pmFieldCreate($table_name, $field_name, $data)
    {
        if ($this->ci->db->field_exists($field_name, $table_name) === false) {
            $this->ci->load->dbforge();
            $fields[$field_name] = $this->fields->{$data["field_type"]}->base_field_param;
            $field = $this->get_field_select_name($data["gid"]);
            $this->ci->dbforge->add_column($table_name, $fields);
            $this->inc_field_index();
        }

        return $field_name;
    }

    /*
     * Perfect match update fields
     *
     */

    public function pmUpdateFields($fields_arr, $table_name)
    {
        foreach ($fields_arr as $field) {
            $this->ci->db->set($table_name . "." . $field, USERS_TABLE . "." . $field, false);
        }

        $this->ci->db->join(USERS_TABLE, USERS_TABLE . ".id=" . $table_name . '.id_user');
        $this->ci->db->update($table_name);
    }

    /*
     * BASE Fields methods
     *
     */

    public function baseFieldCreate($table_name, $field_name, $field_settings)
    {
        if ($this->ci->db->field_exists($field_name, $table_name) === false) {
            $this->ci->load->dbforge();
            $fields[$field_name] = $field_settings;
            $this->ci->dbforge->add_column($table_name, $fields);
        }
    }

    public function baseFieldUpdate($table_name, $field_name, $field_settings)
    {
        $this->ci->load->dbforge();
        $fields[$field_name] = $field_settings;
        $fields[$field_name]["name"] = $field_name;
        $this->ci->dbforge->modify_column($table_name, $fields);
    }

    public function baseFieldDelete($table_name, $field_name)
    {
        $this->ci->load->dbforge();
        $fields = $this->ci->db->list_fields($table_name);

        if (is_array($field_name)) {
            foreach ($field_name as $field) {
                if (in_array($field, $fields)) {
                    $this->ci->dbforge->drop_column($table_name, $field);
                }
            }
        } else {
            if (in_array($field_name, $fields)) {
                $this->ci->dbforge->drop_column($table_name, $field_name);
            }
        }
    }

    public function baseUpdateFulltextField($id, $content)
    {
        $fields = $this->settings['fulltext_field'];
        $tables = $this->settings['tables'];
        foreach ($fields as $table => $field_name) {
            $data[$field_name] = trim($content);
            $this->ci->db->where("id", $id);
            $this->ci->db->update($tables[$table], $data);
        }
    }

    /*
     * Manage Fields methods
     *
     */

    public function getFieldById($id, $lang_id = '')
    {
        if (empty($this->cache_field_by_id[$id])) {
            $result = $this->ci->db->select("id, gid, section_gid, editor_type_gid, field_type, fts, settings_data, sorter")->from(FIELD_EDITOR_FIELDS)->where("id", $id)->get()->result_array();
            $return = (!empty($result)) ? $this->format_field($result[0], $lang_id) : [];
            $this->cache_field_by_id[$id] = $this->cache_field_by_gid[$return["gid"]] = $return;
        }

        return $this->cache_field_by_id[$id];
    }

    public function getFieldByGid($gid, $lang_id = '')
    {
        if (empty($this->cache_field_by_gid[$gid])) {
            $result = $this->ci->db->select("id, gid, section_gid, editor_type_gid, field_type, fts, settings_data, sorter")->from(FIELD_EDITOR_FIELDS)->where("gid", $gid)->get()->result_array();
            $return = (!empty($result)) ? $this->format_field($result[0], $lang_id) : [];
            if (isset($this->cache_field_by_id[$return["id"]])) {
                $this->cache_field_by_gid[$gid] = $this->cache_field_by_id[$return["id"]];
            } else {
                $this->cache_field_by_gid[$gid] = $return;
            }
        }

        return $this->cache_field_by_gid[$gid];
    }

    public function formatField($data, $lang_id = '')
    {
        $results = $this->formatFields([$data], $lang_id);

        return $results[0];
    }

    public function formatFields($data, $lang_id = '')
    {
        foreach ($data as $index => $field) {
            $data[$index]["field_name"] = $this->getFieldSelectName($field["gid"]);
            $data[$index]["name"] = $this->fields->{$field["field_type"]}->formatFieldName($field, $lang_id);
            $data[$index]["settings_data_array"] = unserialize($field["settings_data"]);
            $data[$index] = $this->fields->{$field["field_type"]}->formatField($data[$index], $lang_id);
        }

        return $data;
    }

    public function formatFieldName($data, $lang_id = '')
    {
        return $this->fields->{$data["field_type"]}->format_field_name($data, $lang_id);
    }

    public function getFieldSelectName($gid)
    {
        return $this->settings['field_prefix'] . $gid;
    }

    public function getFieldRangeMinName($gid)
    {
        return $this->settings['field_prefix'] . $gid . '_min';
    }

    public function getFieldRangeMaxName($gid)
    {
        return $this->settings['field_prefix'] . $gid . '_max';
    }

    private function getAllFields()
    {
        if ($this->fields_all === null) {
            $fields = $this->attrs[FIELD_EDITOR_FIELDS];

            $this->fields_all = $this->ci->cache->get(FIELD_EDITOR_FIELDS, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(FIELD_EDITOR_FIELDS)
                    ->order_by('section_gid ASC')
                    ->order_by('sorter ASC')
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        return $this->fields_all;
    }

    public function getFieldsList($params = [], $filter_object_ids = null, $order_by = [], $format = true, $lang_id = '')
    {
        if (empty($params)) {
            $results = $this->getAllFields();

            if (!empty($this->settings['gid'])) {
                foreach ($results as $index => $result) {
                    if ($result['editor_type_gid'] != $this->settings['gid']) {
                        unset($results[$index]);
                    }
                }
            }

            if (isset($filter_object_ids) && is_array($filter_object_ids)) {
                foreach ($results as $index => $result) {
                    if (!in_array($result['id'], $filter_object_ids)) {
                        unset($results[$index]);
                    }
                }
            }
        } else {
            $this->ci->db->select($this->attrs[FIELD_EDITOR_FIELDS])
                     ->from(FIELD_EDITOR_FIELDS);

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

            if (isset($this->settings['gid']) && !empty($this->settings['gid'])) {
                $this->ci->db->where('editor_type_gid', $this->settings['gid']);
            }

            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            } else {
                $this->ci->db->order_by("section_gid ASC");
                $this->ci->db->order_by("sorter ASC");
            }

            $results = $this->ci->db->get()->result_array();

            if (empty($results) || !is_array($results)) {
                return [];
            }
        }

        if ($format) {
            $results = $this->formatFields($results, $lang_id);
        }

        $return = [];

        foreach ($results as $result) {
            $return[$result["gid"]] = $result;
        }

        return $return;
    }

    public function getFieldsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt")->from(FIELD_EDITOR_FIELDS);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function saveField($id, $type, $section, $data, $name = null)
    {
        if (is_null($id)) {
            $this->ci->db->insert(FIELD_EDITOR_FIELDS, $data);
            $id = $this->ci->db->insert_id();

            $pm_installed = $this->ci->pg_module->is_module_installed('perfect_match');

            foreach ($this->settings["tables"] as $table_gid => $table_name) {
                $field = $this->get_field_select_name($data["gid"]);

                $this->baseFieldCreate($table_name, $field, $this->fields->{$data["field_type"]}->base_field_param);
                if ($pm_installed && $table_gid === 'user') {
                    $this->pmFieldCreate(DB_PREFIX . 'perfect_match', 'looking_' . $field, $data);
                    $this->pmFieldCreate(DB_PREFIX . 'perfect_match', $field, $data);
                }

                if ($data['field_type'] == 'range') {
                    $field = $this->get_field_range_min_name($data["gid"]);
                    $this->base_field_create($table_name, $field, $this->fields->range->base_field_param);
                    if ($pm_installed && $table_gid === 'user') {
                        $this->pm_field_create(DB_PREFIX . 'perfect_match', 'looking_' . $field, $data);
                        $this->pm_field_create(DB_PREFIX . 'perfect_match', $field, $data);
                    }

                    $field = $this->get_field_range_max_name($data["gid"]);
                    $this->base_field_create($table_name, $field, $this->fields->range->base_field_param);
                    if ($pm_installed && $table_gid === 'user') {
                        $this->pm_field_create(DB_PREFIX . 'perfect_match', 'looking_' . $field, $data);
                        $this->pm_field_create(DB_PREFIX . 'perfect_match', $field, $data);
                    }
                }
            }
            $this->inc_field_index();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(FIELD_EDITOR_FIELDS, $data);
        }

        if (!empty($name)) {
            $field = $this->get_field_by_id($id);
            $this->fields->{$data["field_type"]}->update_field_name($field, $name);
        }

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;

        unset($this->cache_field_by_id[$id]);
        if (!empty($data["gid"])) {
            unset($this->cache_field_by_gid[$data["gid"]]);
        }

        return $id;
    }

    public function setFieldSorter($id, $sorter)
    {
        $data["sorter"] = intval($sorter);
        $this->ci->db->where("id", $id);
        $this->ci->db->update(FIELD_EDITOR_FIELDS, $data);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    public function validateFieldOption($id_field, $option_gid, $data)
    {
        $field_data = $this->get_field_by_id($id_field);

        return $this->fields->{$field_data["field_type"]}->validate_field_option($data);
    }

    public function setFieldOption($id_field, $option_gid, $data)
    {
        $field_data = $this->get_field_by_id($id_field);
        $this->fields->{$field_data["field_type"]}->set_field_option($field_data, $option_gid, $data);
    }

    public function deleteFieldOption($id_field, $option_gid)
    {
        $field_data = $this->get_field_by_id($id_field);
        $this->fields->{$field_data["field_type"]}->delete_field_option($field_data, $option_gid);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    public function sorterFieldOption($id_field, $sorter_data)
    {
        $field_data = $this->get_field_by_id($id_field);
        $this->fields->{$field_data["field_type"]}->sorter_field_option($field_data, $sorter_data);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    public function validateField($id, $field_type, $data, $langs = [])
    {
        $return = ["errors" => [], "data" => []];

        if (empty($id)) {
            if (isset($data["section_gid"])) {
                $return["data"]["section_gid"] = strval($data["section_gid"]);
            } else {
                $return["errors"][] = l('error_section_empty', 'field_editor');
                $return["data"]["section_gid"] = "";
            }

            if (isset($data["editor_type_gid"])) {
                $return["data"]["editor_type_gid"] = strval($data["editor_type_gid"]);
            } else {
                $return["errors"][] = l('error_editor_type_empty', 'field_editor');
                $return["data"]["editor_type_gid"] = "";
            }

            $gid_exists = true;
            while ($gid_exists) {
                $data['gid'] = $this->get_field_gid();
                $param["where"]["gid"] = $data["gid"];
                $gid_counts = $this->get_fields_count($param);
                if ($gid_counts > 0) {
                    $this->inc_field_index();
                } else {
                    $gid_exists = false;
                }
            }
            $return["data"]["gid"] = $data["gid"];

            if (isset($data["fts"])) {
                $return["data"]["fts"] = intval($data["fts"]);
            }

            if (isset($data["field_type"])) {
                $return["data"]["field_type"] = strval($data["field_type"]);
            } else {
                $return["errors"][] = l('error_field_type_empty', 'field_editor');
                $return["data"]["field_type"] = "text";
            }

            if (isset($data["sorter"])) {
                $return["data"]["sorter"] = intval($data["sorter"]);
            }

            $temp = $this->fields->{$return["data"]["field_type"]}->manage_field_param;
            foreach ($temp as $param => $param_data) {
                $return["data"]["settings_data"][$param] = $param_data["default"];
            }
            $return["data"]["settings_data"] = serialize($return["data"]["settings_data"]);
        } else {
            if (isset($data["fts"])) {
                $return["data"]["fts"] = intval($data["fts"]);
            }

            if (isset($data["settings_data"])) {
                $validate_types = $this->fields->{$field_type}->validate_field_type($data["settings_data"]);
                $return["data"]["settings_data"] = $validate_types["data"];
                if (!empty($validate_types["errors"])) {
                    foreach ($validate_types["errors"] as $err) {
                        $return["errors"][] = $err;
                    }
                }
                $return["data"]["settings_data"] = serialize($return["data"]["settings_data"]);
            }
        }
        if (!empty($langs)) {
            $validate_lang = $this->fields->{$field_type}->validate_field_name($langs);
            $return = array_merge_recursive($return, $validate_lang);
        }

        return $return;
    }

    public function deleteField($id)
    {
        $data = $this->get_field_by_id($id);

        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        $this->ci->Field_editor_forms_model->cleanUpForms($data["gid"]);
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(FIELD_EDITOR_FIELDS);

        unset($this->cache_field_by_gid[$data["gid"]]);
        $pm_installed = $this->ci->pg_module->is_module_installed('perfect_match');
        foreach ($this->settings["tables"] as $table_gid => $table_name) {
            $field = $this->get_field_select_name($data["gid"]);
            if ($pm_installed && $table_name == DB_PREFIX . 'users') {
                $this->base_field_delete(DB_PREFIX . 'perfect_match', [$field, 'looking_' . $field], $this->fields->{$data["field_type"]}->base_field_param);
            }
            $this->base_field_delete($table_name, $field);
        }
        $this->fields->{$data['field_type']}->delete_field_lang($data["editor_type_gid"], $data["section_gid"], $data["gid"]);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    public function deleteFieldByGid($gid)
    {
        $data = $this->get_field_by_gid($gid);
        if (empty($data)) {
            return;
        }
        $this->ci->db->where('id', $data["id"]);
        $this->ci->db->delete(FIELD_EDITOR_FIELDS);

        $pm_installed = $this->ci->pg_module->is_module_installed('perfect_match');

        if (!empty($this->settings["tables"])) {
            foreach ($this->settings["tables"] as $table_gid => $table_name) {
                $field = $this->get_field_select_name($data["gid"]);
                if ($pm_installed && $data["editor_type_gid"] == 'users') {
                    $this->base_field_delete(DB_PREFIX . 'perfect_match', [$field, 'looking_' . $field], $this->fields->{$data["field_type"]}->base_field_param);
                }
                $this->base_field_delete($table_name, $field);
            }
        }

        $this->fields->{$data['field_type']}->delete_field_lang($data["editor_type_gid"], $data["section_gid"], $data["gid"]);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    /*
     * Method delete field by editor_type_gid
     *
     */
    public function deleteFieldByEditorTypeGid($type_gid)
    {
        $params['where']['editor_type_gid'] = $type_gid;
        $fields = $this->get_fields_list($params);

        if (empty($fields)) {
            return;
        }

        $object_ids = [];
        foreach ($fields as $key => $field) {
            $object_ids[] = $field['id'];
        }

        $this->ci->db->where_in('id', $object_ids);
        $this->ci->db->delete(FIELD_EDITOR_FIELDS);

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;
    }

    /*
     * Method delete sections by editor_type_gid
     *
     */
    public function deleteSectionsByEditorTypeGid($type_gid)
    {
        $params['where']['editor_type_gid'] = $type_gid;
        $sections = $this->get_section_list($params);

        if (empty($sections)) {
            return;
        }

        $object_ids = [];
        foreach ($sections as $key => $section) {
            $object_ids[] = $section['id'];
        }

        $this->ci->db->where_in('id', $object_ids);
        $this->ci->db->delete(FIELD_EDITOR_SECTIONS);
    }

    /*
     *
     * Data methods
     */

    public function getFieldsForSelect($section_gids = [], $field_gids = [])
    {
        $fields_raw = $this->getAllFields();

        if (!empty($this->settings['gid'])) {
            foreach ($fields_raw as $index => $item) {
                if ($item['editor_type_gid'] != $this->settings['gid']) {
                    unset($fields_raw[$index]);
                }
            }
        }

        $field_names = [];

        if (!empty($field_gids)) {
            foreach ($fields_raw as $field_raw) {
                if (in_array($field_raw['gid'], $field_gids)) {
                    $field_names[] = $this->getFieldSelectName($field_raw['gid']);
                }
            }
        }

        if (!empty($section_gids)) {
            if (!is_array($section_gids)) {
                $section_gids = [0 => $section_gids];
            }

            foreach ($fields_raw as $field_raw) {
                if (in_array($field_raw['section_gid'], $section_gids)) {
                    $field_names[] = $this->getFieldSelectName($field_raw['gid']);
                }
            }
        }

        if (empty($field_gids) && empty($section_gids)) {
            foreach ($fields_raw as $field_raw) {
                $field_names[] = $this->getFieldSelectName($field_raw['gid']);
            }
        }

        return $field_names;
    }

    public function getFormFieldsList($content, $params = [], $filter_object_ids = null, $order_by = [], $lang_id = '')
    {
        $fields = $this->get_fields_list($params, $filter_object_ids, $order_by, true, $lang_id);

        foreach ($fields as $key => $field) {
            $fields[$key] = $this->fields->{$field["field_type"]}->format_form_fields($field, $content[$field["field_name"]]);
        }

        return $fields;
    }

    public function getFieldsNamesForSearch($form_data)
    {
        if (empty($form_data)) {
            return '';
        }

        $fields_names_for_search = [];
        if (!empty($form_data['field_data'])) {
            foreach ($form_data['field_data'] as $key => $item) {
                if ($item['type'] == 'section') {
                    foreach ($item['section']['fields'] as $skey => $sitem) {
                        $field_for_search = $this->get_fields_names_for_search($sitem);
                        if (is_array($field_for_search)) {
                            foreach ($field_for_search as $field_name) {
                                $fields_names_for_search[] = $field_name;
                            }
                        } else {
                            $fields_names_for_search[] = $this->get_field_select_name($field_for_search);
                        }
                    }
                } else {
                    $field_type = $item['field']['type'];
                    $field_for_search = $this->fields->{$field_type}->get_field_name_for_search($item);
                    if (is_array($field_for_search)) {
                        foreach ($field_for_search as $field_name) {
                            $fields_names_for_search[] = $this->get_field_select_name($field_name);
                        }
                    } else {
                        $fields_names_for_search[] = $this->get_field_select_name($field_for_search);
                    }
                }
            }
        }

        return $fields_names_for_search;
    }

    public function formatItemFieldsForView($params, $data, $lang_id = '', $return_empty_fields = false)
    {
        $temp = $this->format_list_fields_for_view($params, [0 => $data], $lang_id, $return_empty_fields);
        if (count($temp)) {
            return $temp[0];
        }
    }

    public function formatListFieldsForView($params, $data, $lang_id = '', $return_empty_fields = false)
    {
        $return = [];
        $fields = $this->get_fields_list($params, null, [], true, $lang_id);
        if (empty($fields)) {
            return $return;
        }

        foreach ($data as $key => $item) {
            foreach ($fields as $field) {
                if (empty($item[$field["field_name"]]) && !$return_empty_fields) {
                    if ($field['field_type'] != 'checkbox') {
                        continue;
                    }
                }
                if ($field["field_type"] == 'range') {
                    if (empty(intval($item[$field["field_name"]])) && !$return_empty_fields) {
                        continue;
                    }
                }
                $temp = [
                    "name"        => $field["name"],
                    "field_type"  => $field["field_type"],
                    'section_gid' => $field['section_gid'],
                ];
                $value = $item[$field["field_name"]];
                $return[$key][$field["gid"]] = $this->fields->{$field["field_type"]}->format_view_fields($field, $temp, $value);
            }
        }

        return $return;
    }

    // search
    public function validateFieldsForSelect($params = [], $data = [])
    {
        return $this->validateFields($params, $data, 'select');
    }

    // save user profile
    public function validateFieldsForSave($params = [], $data = [])
    {
        return $this->validateFields($params, $data, 'save');
    }

    // save search criteria
    public function validateFieldsForSelectSave($params = [], $data = [])
    {
        return $this->validateFields($params, $data, 'select_save');
    }

    private function validateFields($params = [], $data = [], $for = 'select')
    {
        $return = ["errors" => [], "data" => []];
        $fields = $this->getFieldsList($params);
        switch ($for) {
            case 'select_save':
                $validate_method = 'validate_field_for_save';

                break;
            case 'select':
            case 'save':
            default:
                $validate_method = 'validate_field';

                break;
        }

        foreach ($fields as $field) {
            if (isset($data[$field["field_name"]])) {
                $temp = $this->fields->{$field["field_type"]}->{$validate_method}($field, $data[$field["field_name"]]);
                if (!is_null($temp['data'])) {
                    $return["data"][$field["field_name"]] = $temp["data"];
                    if (!empty($temp["errors"])) {
                        $return["errors"] = array_merge($return["errors"], $temp["errors"]);
                    }
                }
            } elseif ($for != 'save') {
                if (isset($data[$field["field_name"] . '_min'])) {
                    $temp = $this->fields->{$field["field_type"]}->{$validate_method}($field, $data[$field["field_name"] . '_min']);
                    if (!is_null($temp['data'])) {
                        $return["data"][$field["field_name"] . '_min'] = $temp["data"];
                        if (!empty($temp["errors"])) {
                            $return["errors"] = array_merge($return["errors"], $temp["errors"]);
                        }
                    }
                }
                if (isset($data[$field["field_name"] . '_max'])) {
                    $temp = $this->fields->{$field["field_type"]}->{$validate_method}($field, $data[$field["field_name"] . '_max']);
                    if (!is_null($temp['data'])) {
                        $return["data"][$field["field_name"] . '_max'] = $temp["data"];
                        if (!empty($temp["errors"])) {
                            $return["errors"] = array_merge($return["errors"], $temp["errors"]);
                        }
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Updates langs data
     *
     * @param array $fields_data
     * @param array $langs_data
     *
     * @return boolean
     */
    public function updateSectionsLangs($sections_data, $langs_data)
    {
        foreach ($sections_data as $section) {
            if ($section["data"]["editor_type_gid"] != $this->settings['gid']) {
                continue;
            }
            $s = $this->get_section_by_gid($section["data"]["gid"]);
            if (!$s) {
                continue;
            }
            $lang_data = $langs_data[$section["data"]["gid"]];
            $this->ci->pg_language->pages->set_string_langs('field_editor_sections', 'section_' . $s['id'], $lang_data, array_keys($lang_data));
        }

        return true;
    }

    public function importTypeStructure($editor_type_gid, $sections_data, $fields_data, $forms_data)
    {
        $this->initialize($editor_type_gid);

        foreach ((array) $sections_data as $section) {
            if ($section["data"]["editor_type_gid"] != $editor_type_gid) {
                continue;
            }
            $this->ci->Field_editor_model->save_section(null, $section["data"]);
        }

        foreach ((array) $fields_data as $field) {
            if ($field["data"]["editor_type_gid"] != $editor_type_gid) {
                continue;
            }
            unset($field["data"]['options']);

            $field_id = null;

            if (isset($field["data"]["gid"])) {
                $field_raw = $this->ci->Field_editor_model->getFieldByGid($field["data"]["gid"]);
                if (!empty($field_raw)) {
                    $field_id = $field_raw['id'];
                }
            }

            $this->ci->Field_editor_model->save_field($field_id, $editor_type_gid, '', $field["data"]);
        }

        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        foreach ((array) $forms_data as $form) {
            if ($form["data"]["editor_type_gid"] != $editor_type_gid) {
                continue;
            }
            $this->ci->Field_editor_forms_model->save_form(null, $form["data"]);
        }
    }

    public function exportTypeStructure($editor_type_gid, $file_path = '')
    {
        $content = "<?php\n\n";
        $this->initialize($editor_type_gid);

        // sections
        $sections = $this->get_section_list();

        $content .= '$fe_sections = array(' . "\n";
        foreach ($sections as $section) {
            $fe_sections[] = [
                'data' => [
                    'gid'             => $section['gid'],
                    'editor_type_gid' => $section['editor_type_gid'],
                    'sorter'          => $section['sorter'],
                ],
            ];
            $content .= "\t" . 'array("data" => array( "gid" => "' . $section['gid'] . '", "editor_type_gid" => "' . $section['editor_type_gid'] . '")),' . "\n";
        }
        $content .= ');' . "\n\n";

        // fields
        $params["where"]['editor_type_gid'] = $editor_type_gid;
        $params["where_in"]['section_gid'] = array_keys($sections);
        $fields = $this->get_fields_list($params);

        $content .= '$fe_fields = array(' . "\n";
        foreach ($fields as $field) {
            $options = (!empty($field['options']['option'])) ? array_keys($field['options']['option']) : '';
            $fe_fields[] = [
                'data' => [
                    'gid'             => $field['gid'],
                    'section_gid'     => $field['section_gid'],
                    'editor_type_gid' => $field['editor_type_gid'],
                    'field_type'      => $field['field_type'],
                    'fts'             => $field['fts'],
                    'settings_data'   => $field['settings_data'],
                    'sorter'          => $field['sorter'],
                    'options'         => $options,
                ],
            ];

            $options_str = '""';
            if (!empty($options)) {
                $options_str = "array('" . implode("', '", $options) . "')";
            }
            $content .= "\t" . 'array("data" => array( "gid" => "' . $field['gid'] . '", "section_gid" => "' . $field['section_gid'] . '", "editor_type_gid" => "' . $field['editor_type_gid'] . '", "field_type" => "' . $field['field_type'] . '", "fts" => "' . $field['fts'] . '", "settings_data" => \'' . $field['settings_data'] . '\', "sorter" => "' . $field['sorter'] . '", "options" => ' . $options_str . ')),' . "\n";
        }
        $content .= ');' . "\n\n";

        // forms
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        $fparams["where"]["editor_type_gid"] = $editor_type_gid;
        $forms = $this->ci->Field_editor_forms_model->get_forms_list($fparams);

        $content .= '$fe_forms = array(' . "\n";
        foreach ($forms as $form) {
            $fe_forms[] = [
                'data' => [
                    'gid'             => $form['gid'],
                    'editor_type_gid' => $form['editor_type_gid'],
                    'name'            => htmlspecialchars($form['name']),
                    'field_data'      => $form['field_data'],
                ],
            ];

            $content .= "\t" . 'array("data" => array( "gid" => "' . $form['gid'] . '", "editor_type_gid" => "' . $form['editor_type_gid'] . '", "name" => "' . htmlspecialchars($form['name']) . '", "field_data" => \'' . $form['field_data'] . '\')),' . "\n";
        }
        $content .= ');' . "\n\n";

        if ($file_path && isset($this->ci->zip) && !in_array($file_path, $this->ci->zip->data_arr)) {
            $this->ci->zip->add_data($file_path, $content);
        }

        return [$fe_sections, $fe_fields, $fe_forms];
    }

    public function exportSectionsLangs($sections_data, $langs_ids = null)
    {
        $strings = [];
        foreach ($sections_data as $section) {
            $s = $this->get_section_by_gid($section["data"]["gid"]);
            $strings['section_' . $s['id']] = $section["data"]["gid"];
        }

        $langs_db = $this->ci->pg_language->export_langs('field_editor_sections', array_keys($strings), $langs_ids);
        $lang_codes = array_keys($langs_db);
        foreach ($lang_codes as $lang_code) {
            $lang_data[$strings[$lang_code]] = $langs_db[$lang_code];
        }

        return $lang_data;
    }

    public function updateFieldsLangs($editor_type_gid, $fields_data, $langs_data)
    {
        $field_gids = [];
        $this->initialize($editor_type_gid);
        $module_gid = $this->settings['module'];

        foreach ($fields_data as $field) {
            if ($field['data']['editor_type_gid'] != $editor_type_gid) {
                continue;
            }
            $field_gids[] = $field['data']['gid'];
            $field_options[$field['data']['gid']] = $field['data']['options'];
        }

        $params["where_in"]['gid'] = $field_gids;

        $fields = $this->get_fields_list($params);

        foreach ($fields as $field) {
            $index = 'fields_' . $module_gid . '_' . $field['section_gid'] . '_' . $field['gid'];
            if (isset($langs_data[$index])) {
                $this->fields->{$field["field_type"]}->update_field_name($field, $langs_data[$index]);
            }

            $options = $field_options[$field['gid']];

            if (!empty($options)) {
                $value = [];
                foreach ($options as $option_gid) {
                    if (isset($langs_data[$index . '_' . $option_gid])) {
                        $value[$option_gid] = $langs_data[$index . '_' . $option_gid];
                    } else {
                        $value[$option_gid] = null;
                    }
                }

                $this->fields->{$field["field_type"]}->set_field_option($field, $options, $value);
            }
        }

        $this->ci->cache->flush(FIELD_EDITOR_FIELDS);

        $this->fields_all = null;

        return true;
    }

    public function exportFieldsLangs($editor_type_gid, $fields_data, $langs_ids = null)
    {
        if (!$langs_ids) {
            $langs_ids = array_keys($this->ci->pg_language->languages);
        }
        $field_gids = [];
        $this->initialize($editor_type_gid);
        $module_gid = $this->settings['module'];

        foreach ($fields_data as $field) {
            $field_gids[] = $field['data']['gid'];
        }

        $params["where_in"]['gid'] = $field_gids;
        $fields = $this->get_fields_list($params, null, [], false);

        foreach ($fields as $field) {
            $index = 'fields_' . $module_gid . '_' . $field['section_gid'] . '_' . $field['gid'];
            foreach ($langs_ids as $lid) {
                $fdata = $this->format_field($field, $lid);

                $lang_data[$index][$lid] = $fdata["name"];
                if (!empty($fdata['options']['option'])) {
                    foreach ($fdata['options']['option'] as $ogid => $ovalue) {
                        $lang_data[$index . '_' . $ogid][$lid] = $ovalue;
                    }
                }
            }
        }

        return $lang_data;
    }

    /*
     * update fulltext indexed field in base
     * callback have to return array in format:
     *  main_fields => array (field=>text_value, field=>text_value)
     *  fe_fields => array (field=>value_for_format, field=>value_for_format)
     *  default_lang_id => int
     *  object_lang_id => int
     */

    public function updateFulltextField($id)
    {
        $sections = $this->get_section_list();
        $fields_for_select = empty($sections) ? [] : $this->get_fields_for_select(array_keys($sections));

        $model_name = ucfirst($this->settings["fulltext_model"]);
        $model_path = strtolower($this->settings["module"] . "/models/") . $model_name;
        $this->ci->load->model($model_path);
        $callback = $this->settings["fulltext_callback"];
        $model_data = $this->ci->{$model_name}->{$callback}($id, $fields_for_select);

        if (empty($model_data["fe_fields"])) {
            $model_data["fe_fields"] = [];
        }

        $content = '';
        if (!empty($model_data["main_fields"])) {
            array_map('trim', $model_data["main_fields"]);
            foreach ($model_data["main_fields"] as $key => $main_field) {
                if (empty($main_field)) {
                    unset($model_data["main_fields"][$key]);
                }
            }
            $content = trim(implode('; ', $model_data["main_fields"]));
        }

        $params = [];
        if (!empty($sections)) {
            $params["where_in"]["section_gid"] = array_keys($sections);
        }

        $object_lang_data = $this->format_item_fields_for_fulltext($params, $model_data['fe_fields'], $model_data['object_lang_id']);
        $default_lang_data = $this->format_item_fields_for_fulltext($params, $model_data['fe_fields'], $model_data['default_lang_id']);
        if ($object_lang_data && $content) {
            $content .= ';';
        }

        foreach ($object_lang_data as $field_gid => $value) {
            $content .= $value ? ' ' . $value : '';
            if ($value != $default_lang_data[$field_gid]) {
                $content .= $default_lang_data[$field_gid] ? ' ' . $default_lang_data[$field_gid] : '';
            }
        }
        $this->base_update_fulltext_field($id, $content);
    }

    public function formatItemFieldsForFulltext($params, $data, $lang_id = '')
    {
        $temp = $this->formatListFieldsForFulltext($params, [0 => $data], $lang_id);

        return $temp[0];
    }

    public function formatListFieldsForFulltext($params, $data, $lang_id = '')
    {
        $return = [];

        $fields = $this->getFieldsList($params, null, [], true, $lang_id);
        if (empty($fields)) {
            return $return;
        }

        foreach ($data as $key => $item) {
            foreach ($fields as $field) {
                $temp = [
                    "name"       => $field["name"],
                    "field_type" => $field["field_type"],
                ];
                $value = $item[$field["field_name"]];
                $return[$key][$field["gid"]] = $this->fields->{$field["field_type"]}->format_fulltext_fields($field, $temp, $value);
            }
        }

        return $return;
    }

    public function returnFulltextCriteria($text, $mode = null)
    {
        $fields = $this->settings['fulltext_field'];
        $word_count = str_word_count($text);
        $arr_text = explode(" ", $text);
        $word_count = count($arr_text);
        $text = ($word_count < 2 ? $text . "*" : $text);
        $escape_text = $this->ci->db->escape($text);
        $mode = ($mode && $word_count < 2 ? " IN " . $mode : "");
        foreach ($fields as $table => $field) {
            $return[$table] = [
                'field'     => "MATCH (search_field) AGAINST (" . $escape_text . ") AS fields",
                'where_sql' => "MATCH (search_field) AGAINST (" . $escape_text . $mode . ")",
            ];
        }

        return $return;
    }

    public function getFieldIndex()
    {
        return intval($this->ci->pg_module->get_module_config('field_editor', 'field_counter'));
    }

    public function incFieldIndex()
    {
        $index = $this->get_field_index();
        ++$index;
        $this->ci->pg_module->set_module_config('field_editor', 'field_counter', $index);
    }

    public function getFieldGid()
    {
        $index = $this->get_field_index();

        return "field" . $index;
    }

    public function __call($name, $args)
    {
        $methods = [
            'base_field_create' => 'baseFieldCreate',
            'get_field_gid' => 'getFieldGid',
            'base_field_delete' => 'baseFieldDelete',
            'base_field_update' => 'baseFieldUpdate',
            'base_update_fulltext_field' => 'baseUpdateFulltextField',
            'delete_field' => 'deleteField',
            'delete_field_by_gid' => 'deleteFieldByGid',
            'delete_field_option' => 'deleteFieldOption',
            'delete_section' => 'deleteSection',
            'delete_section_by_gid' => 'deleteSectionByGid',
            'export_fields_langs' => 'exportFieldsLangs',
            'export_sections_langs' => 'exportSectionsLangs',
            'export_type_structure' => 'exportTypeStructure',
            'format_field' => 'formatField',
            'format_field_name' => 'formatFieldName',
            'format_item_fields_for_fulltext' => 'formatItemFieldsForFulltext',
            'format_item_fields_for_view' => 'formatItemFieldsForView',
            'format_list_fields_for_fulltext' => 'formatListFieldsForFulltext',
            'format_list_fields_for_view' => 'formatListFieldsForView',
            'format_section' => 'formatSection',
            'get_default_editor_type' => 'getDefaultEditorType',
            'get_editor_types' => 'getEditorTypes',
            'get_field_by_gid' => 'getFieldByGid',
            'get_field_by_id' => 'getFieldById',
            'get_field_index' => 'getFieldIndex',
            'get_field_range_max_name' => 'getFieldRangeMaxName',
            'get_field_range_min_name' => 'getFieldRangeMinName',
            'get_field_select_name' => 'getFieldSelectName',
            'get_field_settings' => 'getFieldSettings',
            'get_fields_count' => 'getFieldsCount',
            'get_fields_for_select' => 'getFieldsForSelect',
            'get_fields_list' => 'getFieldsList',
            'get_fields_names_for_search' => 'getFieldsNamesForSearch',
            'get_form_fields_list' => 'getFormFieldsList',
            'get_section_by_gid' => 'getSectionByGid',
            'get_section_by_id' => 'getSectionById',
            'get_section_count' => 'getSectionCount',
            'get_section_list' => 'getSectionList',
            'get_settings' => 'getSettings',
            'import_type_structure' => 'importTypeStructure',
            'inc_field_index' => 'incFieldIndex',
            'pm_field_create' => 'pmFieldCreate',
            'pm_update_fields' => 'pmUpdateFields',
            'return_fulltext_criteria' => 'returnFulltextCriteria',
            'save_field' => 'saveField',
            'save_section' => 'saveSection',
            'set_field_option' => 'setFieldOption',
            'set_field_sorter' => 'setFieldSorter',
            'set_section_sorter' => 'setSectionSorter',
            'sorter_field_option' => 'sorterFieldOption',
            'update_fields_langs' => 'updateFieldsLangs',
            'update_fulltext_field' => 'updateFulltextField',
            'update_sections_langs' => 'updateSectionsLangs',
            'validate_field' => 'validateField',
            'validate_field_option' => 'validateFieldOption',
            'validate_fields_for_save' => 'validateFieldsForSave',
            'validate_fields_for_select' => 'validateFieldsForSelect',
            'validate_fields_for_select_save' => 'validateFieldsForSelectSave',
            'validate_section' => 'validateSection',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
