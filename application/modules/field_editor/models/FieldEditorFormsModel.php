<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models;

if (!defined('FIELD_EDITOR_FORMS')) {
    define('FIELD_EDITOR_FORMS', DB_PREFIX . 'field_editor_forms');
}

/**
 * Field Editor Forms Model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FieldEditorFormsModel extends \Model
{
    private $form_section_lang_prefix = 'fs_';
    private $form_section_module_prefix = 'fslng_';
    private $fields;
    private $form_fields = [
        'id',
        'gid',
        'editor_type_gid',
        'name',
        'field_data',
        'is_system',
    ];
    private $forms_all = null;

    public function __construct()
    {
        parent::__construct();

        $this->fields = new FieldTypesLoaderModel();
        $this->ci->cache->registerService(FIELD_EDITOR_FORMS);
    }

    public function getFormById($id)
    {
        $forms_raw = $this->getAllForms();

        foreach ($forms_raw as $form_raw) {
            if ($form_raw['id'] == $id) {
                if (!empty($form_raw["field_data"])) {
                    $form_raw["field_data"] = unserialize($form_raw["field_data"]);
                }

                return $form_raw;
            }
        }

        return false;
    }

    public function getFormByGid($gid, $editor_type_gid = "")
    {
        $forms_raw = $this->getAllForms();

        foreach ($forms_raw as $form_raw) {
            if ($form_raw['gid'] == $gid) {
                if (!empty($editor_type_gid) && $form_raw['editor_type_gid'] != $editor_type_gid) {
                    continue;
                }

                if (!empty($form_raw["field_data"])) {
                    $form_raw["field_data"] = unserialize($form_raw["field_data"]);
                }

                return $form_raw;
            }
        }

        return false;
    }

    public function formatForm($data)
    {
        list($section_gids, $field_gids) = $this->get_form_field_gids($data["field_data"]);

        if (!empty($field_gids)) {
            $this->ci->load->model('Field_editor_model');
            $this->ci->Field_editor_model->initialize($data["editor_type_gid"]);
            $params["where"]["editor_type_gid"] = $data["editor_type_gid"];
            $params["where_in"]["gid"] = $field_gids;
            $fields = $this->ci->Field_editor_model->get_fields_list($params);

            foreach ($data["field_data"] as $key => $item) {
                if ($item["type"] == 'section') {
                    foreach ($item["section"]["fields"] as $skey => $sitem) {
                        if (!isset($fields[$sitem["field"]["gid"]])) {
                            unset($data["field_data"][$key]["section"]["fields"][$skey]);
                        }
                    }
                } else {
                    if (!isset($fields[$item["field"]["gid"]])) {
                        unset($data["field_data"][$key]);
                    }
                }
            }
        }

        return $data;
    }

    public function formatOutputForm($data, $content = [], $defaults = false)
    {
        list($section_gids, $field_gids) = $this->getFormFieldGids($data["field_data"]);

        if (!empty($section_gids)) {
            $sections = $this->getFormSections($data["editor_type_gid"]);

            foreach ($data["field_data"] as $key => $item) {
                if ($item["type"] == 'section') {
                    $data["field_data"][$key]["section"]["name"] = $sections[$item["section"]["gid"]];
                }
            }
        }

        if (!empty($field_gids)) {
            $this->ci->load->model('Field_editor_model');
            $this->ci->Field_editor_model->initialize($data["editor_type_gid"]);
            $params["where"]["editor_type_gid"] = $data["editor_type_gid"];
            $params["where_in"]["gid"] = $field_gids;
            $fields = $this->ci->Field_editor_model->getFieldsList($params);

            foreach ($data["field_data"] as $key => $item) {
                if ($item["type"] == 'section') {
                    foreach ($item["section"]["fields"] as $skey => $sitem) {
                        if (isset($fields[$sitem["field"]["gid"]])) {
                            $field_content = $fields[$sitem["field"]["gid"]];
                            if (isset($content[$field_content["field_name"]])) {
                                $field_content = $this->ci->Field_editor_model->fields->{$field_content["field_type"]}->format_form_fields($field_content, $content[$field_content["field_name"]]);
                            } elseif ($defaults) {
                                $field_content = $this->ci->Field_editor_model->fields->{$field_content["field_type"]}->format_form_fields($field_content);
                            }
                            $data["field_data"][$key]["section"]["fields"][$skey]["field_content"] = $field_content;
                        } else {
                            unset($data["field_data"][$key]["section"]["fields"][$skey]);
                        }
                    }
                } else {
                    if (isset($fields[$item["field"]["gid"]])) {
                        $field_content = $fields[$item["field"]["gid"]];
                        if (isset($content[$field_content["field_name"]])) {
                            $field_content = $this->ci->Field_editor_model->fields->{$field_content["field_type"]}->format_form_fields($field_content, $content[$field_content["field_name"]]);
                        } elseif ($defaults) {
                            $field_content = $this->ci->Field_editor_model->fields->{$field_content["field_type"]}->format_form_fields($field_content);
                        }
                        $data["field_data"][$key]["field_content"] = $field_content;
                    } else {
                        unset($data["field_data"][$key]);
                    }
                }
            }
        }

        return $data;
    }

    private function getAllForms()
    {
        if ($this->forms_all === null) {
            $fields = $this->form_fields;

            $this->forms_all = $this->ci->cache->get(FIELD_EDITOR_FORMS, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(FIELD_EDITOR_FORMS)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        return $this->forms_all;
    }

    public function getFormsList($params = [], $order_by = [])
    {
        $this->ci->db->select(implode(', ', $this->form_fields))->from(FIELD_EDITOR_FORMS);

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
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $k => $r) {
                $return[$r["gid"]] = $r;
            }

            return $return;
        }

        return [];
    }

    public function getFormsCount($params = [])
    {
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

        return $this->ci->db->count_all_results(FIELD_EDITOR_FORMS);
    }

    public function validateForm($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["gid"])) {
            $data["gid"] = strtolower(strip_tags($data["gid"]));
            $data["gid"] = preg_replace("/[\n\s\t]+/i", '-', $data["gid"]);
            $data["gid"] = preg_replace("/[^a-z0-9\-_]+/i", '', $data["gid"]);
            $data["gid"] = preg_replace("/[\-]{2,}/i", '-', $data["gid"]);

            $return["data"]["gid"] = $data["gid"];

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_form_code_incorrect', 'field_editor');
            } else {
                $param["where"]["gid"] = $return["data"]["gid"];
                if ($id) {
                    $param["where"]["id <>"] = $id;
                }
                $gid_counts = $this->getFormsCount($param);
                if ($gid_counts > 0) {
                    $return["errors"][] = l('error_form_code_exists', 'field_editor');
                }
            }
        }

        if (isset($data["editor_type_gid"])) {
            $return["data"]["editor_type_gid"] = strval($data["editor_type_gid"]);
            if (empty($return["data"]["editor_type_gid"])) {
                $return["errors"][] = l('error_form_editor_type_incorrect', 'field_editor');
            }
        }

        if (isset($data["name"])) {
            $return["data"]["name"] = trim(strip_tags($data["name"]));
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_form_name_incorrect', 'field_editor');
            }
        }

        if (isset($data["field_data"]) && is_array($data["field_data"])) {
            foreach ($data["field_data"] as $field) {
                if (is_array($field)) {
                    if ($field["type"] == 'section') {
                        $section_fields = $field["section"]['fields'];
                        $field["section"]['fields'] = [];
                        if (is_array($section_fields) && !empty($section_fields)) {
                            foreach ($section_fields as $sfield) {
                                if (is_array($sfield)) {
                                    $field["section"]['fields'][] = $sfield;
                                }
                            }
                        }
                    }
                    $return["data"]["field_data"][] = $field;
                }
            }
            $return["data"]["field_data"] = serialize($return["data"]["field_data"]);
        } elseif (isset($data["field_data"])) {
            $return["data"]["field_data"] = serialize([]);
        }

        return $return;
    }

    public function saveForm($id, $data)
    {
        if (empty($id)) {
            $this->ci->db->insert(FIELD_EDITOR_FORMS, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(FIELD_EDITOR_FORMS, $data);
        }

        $this->ci->cache->flush(FIELD_EDITOR_FORMS);

        return $id;
    }

    public function deleteFormById($id)
    {
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(FIELD_EDITOR_FORMS);

        $this->ci->cache->flush(FIELD_EDITOR_FORMS);
    }

    public function deleteFormByGid($gid)
    {
        $this->ci->db->where('gid', $gid);
        $this->ci->db->delete(FIELD_EDITOR_FORMS);

        $this->ci->cache->flush(FIELD_EDITOR_FORMS);
    }

    public function formSectionSave($form_editor_type_gid, $section_gid, $name)
    {
        if (!$section_gid) {
            $section_gid = substr(md5(date('Y-m-d H:i:s')), 0, 6);
        }
        $module_gid = $this->form_section_module_prefix . $form_editor_type_gid;
        $section = $this->form_section_lang_prefix . $section_gid;
        $name = $this->ci->pg_language->getNamesDifferentLangs($name);
        if (!empty($name)) {
            $languages = $this->ci->pg_language->languages;
            if (!empty($languages)) {
                $lang_ids = array_keys($languages);
                $this->ci->pg_language->pages->set_string_langs($module_gid, $section, $name, $lang_ids);
            }
        }

        return $section_gid;
    }

    public function formSectionDelete($form_editor_type_gid, $section_gid)
    {
        $module_gid = $this->form_section_module_prefix . $form_editor_type_gid;
        $section = $this->form_section_lang_prefix . $section_gid;

        $this->ci->pg_language->pages->delete_string($module_gid, $section);
    }

    public function getFormSections($form_editor_type_gid, $lang_id = '')
    {
        $module_gid = $this->form_section_module_prefix . $form_editor_type_gid;
        $raw_sections = $this->ci->pg_language->pages->return_module($module_gid, $lang_id);
        if (!empty($raw_sections)) {
            foreach ($raw_sections as $gid => $value) {
                $sections[str_replace($this->form_section_lang_prefix, '', $gid)] = $value;
            }

            return $sections;
        }

        return false;
    }

    public function getFormSection($form_editor_type_gid, $section_gid, $lang_id = '')
    {
        $module_gid = $this->form_section_module_prefix . $form_editor_type_gid;
        $section = $this->form_section_lang_prefix . $section_gid;

        if ($lang_id == 'all') {
            $languages = $this->ci->pg_language->languages;
            if (!empty($languages)) {
                foreach ($languages as $lang_id => $lang) {
                    $data[$lang_id] = l($section, $module_gid, $lang_id);
                }
            }
        } else {
            $data = l($section, $module_gid, $lang_id);
        }

        return $data;
    }

    public function getFormFieldSettings($field_type)
    {
        return $this->fields->{$field_type}->form_field_settings;
    }

    public function getFormFieldGids($field_data)
    {
        $disallowed_fields = [];
        $disallowed_sections = [];
        if (!empty($field_data)) {
            foreach ($field_data as $item) {
                if ($item["type"] == 'section') {
                    $disallowed_sections[] = $item["section"]['gid'];

                    if (!empty($item["section"]["fields"])) {
                        foreach ($item["section"]["fields"] as $field) {
                            if (is_array($field)) {
                                $disallowed_fields[] = $field["field"]['gid'];
                            }
                        }
                    }
                } elseif ($item["type"] == 'field') {
                    $disallowed_fields[] = $item["field"]['gid'];
                }
            }
        }

        return [$disallowed_sections, $disallowed_fields];
    }

    public function getSearchCriteria($form_gid, $data, $editor_type_gid = "", $use_fe_prefix = true)
    {
        $criteria = [];
        if (empty($data)) {
            return $criteria;
        }
        $form = $this->get_form_by_gid($form_gid, $editor_type_gid);
        if (empty($form["field_data"])) {
            return $criteria;
        }

        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($form["editor_type_gid"]);
        $field_gid_prefix = $use_fe_prefix ? '' : $this->ci->Field_editor_model->settings['field_prefix'];
        $prefix = $use_fe_prefix ? $this->ci->Field_editor_model->settings['field_prefix'] : '';

        foreach ($form["field_data"] as $item) {
            if ($item["type"] == 'section') {
                if (!empty($item["section"]["fields"])) {
                    foreach ($item["section"]["fields"] as $field) {
                        $field['field']['gid'] = $field_gid_prefix . $field['field']['gid'];
                        if ($item["field"]["type"]) {
                            $field_criteria = $this->fields->{$field["field"]["type"]}->get_search_field_criteria($field["field"], $field["settings"], $data, $prefix);
                            if (!empty($field_criteria)) {
                                $criteria = array_merge_recursive($criteria, $field_criteria);
                            }
                        }
                    }
                }
            } elseif ($item["type"] == 'field') {
                $item['field']['gid'] = $field_gid_prefix . $item['field']['gid'];
                if (empty($item["settings"])) {
                    $item["settings"] = "";
                }
                if ($item["field"]["type"]) {
                    $field_criteria = $this->fields->{$item["field"]["type"]}->get_search_field_criteria($item["field"], $item["settings"], $data, $prefix);
                    if (!empty($field_criteria)) {
                        $criteria = array_merge_recursive($criteria, $field_criteria);
                    }
                }
            }
        }

        return $criteria;
    }

    public function cleanUpForms($field)
    {
        $results = $this->ci->db
                ->like(['field_data' => $field])
                ->from(FIELD_EDITOR_FORMS)
                ->get()->result_array();

        foreach ($results as $key => $result) {
            $results[$key]['field_data'] = unserialize($result['field_data']);
            foreach ($results[$key]['field_data'] as $f_key => $field_data) {
                if (isset($results[$key]['field_data'][$f_key]['field']['gid']) && $results[$key]['field_data'][$f_key]['field']['gid'] === $field) {
                    unset($results[$key]['field_data'][$f_key]);
                }
            }
            $results[$key]['field_data'] = serialize($results[$key]['field_data']);
            $id = $results[$key]['id'];
            unset($results[$key]['id']);
            $this->ci->db->where('id', $id)->update(FIELD_EDITOR_FORMS, $results[$key]);
        }

        $this->ci->cache->flush(FIELD_EDITOR_FORMS);
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_form_by_gid' => 'deleteFormByGid',
            'delete_form_by_id' => 'deleteFormById',
            'form_section_delete' => 'formSectionDelete',
            'form_section_save' => 'formSectionSave',
            'format_form' => 'formatForm',
            'format_output_form' => 'formatOutputForm',
            'get_form_by_gid' => 'getFormByGid',
            'get_form_by_id' => 'getFormById',
            'get_form_field_gids' => 'getFormFieldGids',
            'get_form_field_settings' => 'getFormFieldSettings',
            'get_form_section' => 'getFormSection',
            'get_form_sections' => 'getFormSections',
            'get_forms_count' => 'getFormsCount',
            'get_forms_list' => 'getFormsList',
            'get_search_criteria' => 'getSearchCriteria',
            'save_form' => 'saveForm',
            'validate_form' => 'validateForm',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
