<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Field type model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FieldTypeModel extends \Model
{
    public $base_field_param = [];
    public $manage_field_param = [];
    public $form_field_settings = [];

    public function formatField($data, $lang_id = '')
    {
        if (isset($data['settings_data_array'])) {
            foreach ($data['settings_data_array'] as $param => $value) {
                $param_type = $this->manage_field_param[$param]['type'];
                switch ($param_type) {
                    case 'array':
                        $data['settings_data_array'][$param] = unserialize($value);
                        if (empty($data['settings_data_array'][$param])) {
                            $data['settings_data_array'][$param] = [];
                        }
                        break;
                    case 'bool':
                        $data['settings_data_array'][$param] = (bool) $value;
                        break;
                    case 'intval':
                    case 'int':
                        $data['settings_data_array'][$param] = (int) $value;
                        break;
                    case 'floatval':
                    case 'float':
                        $data['settings_data_array'][$param] = floatval(str_replace(',', '.', $value));
                        break;
                    case 'string':
                        $data['settings_data_array'][$param] = trim(strip_tags($value));
                        break;
                    case 'text':
                        break;
                }
            }
        }

        return $data;
    }

    public function formatFieldName($field, $lang_id)
    {
        return l('field_' . $field['gid'], $field['editor_type_gid'] . '_' . $field['section_gid'] . '_lang', $lang_id);
    }

    public function validateFieldName($name)
    {
        $return = ['errors' => [], 'lang' => []];
        $languages = $this->ci->pg_language->languages;
        $cur_lang_id = $this->ci->pg_language->current_lang_id;

        $default_lang = isset($name[$cur_lang_id]) ? (trim(strip_tags($name[$cur_lang_id]))) : '';
        if ($default_lang == '') {
            $return["errors"][] = l('error_field_name_empty', 'field_editor');
        }

        foreach ($languages as $id_lang => $lang_settings) {
            $return["lang"][$id_lang] = trim(strip_tags($name[$id_lang]));
            if (empty($return["lang"][$id_lang])) {
                $return["lang"][$id_lang] = $default_lang;
            }
        }

        return $return;
    }

    public function updateFieldName($field, $name)
    {
        $lang_ids = array_keys($name);
        if (empty($lang_ids)) {
            return;
        }

        $this->ci->pg_language->pages->set_string_langs(
            $field['editor_type_gid'] . '_' . $field['section_gid'] . '_lang',
            'field_' . $field['gid'],
            $name,
            array_keys($name)
        );
    }

    public function deleteFieldLang($type, $section, $gid)
    {
        $this->ci->pg_language->pages->delete_string($type . '_' . $section . '_lang', 'field_' . $gid);
    }

    public function validateFieldType($settings_data)
    {
        $return = ["errors" => [], "data" => []];

        $settings = $this->manage_field_param;
        foreach ($settings as $param_gid => $param_data) {
            if (isset($settings_data[$param_gid])) {
                $return["data"][$param_gid] = $settings_data[$param_gid];
                switch ($param_data["type"]) {
                    case 'array':
                        $return["data"][$param_gid] = serialize($return["data"][$param_gid]);
                        break;
                    case 'bool':
                        $return["data"][$param_gid] = (bool) $return["data"][$param_gid];
                        break;
                    case 'intval':
                    case 'int':
                        $return["data"][$param_gid] = (int) $return["data"][$param_gid];
                        break;
                    case 'floatval':
                    case 'float':
                        $return["data"][$param_gid] = floatval(str_replace(',', '.', $return["data"][$param_gid]));
                        break;
                    case 'string':
                        $return["data"][$param_gid] = trim(strip_tags($return["data"][$param_gid]));
                        break;
                    case 'text':
                        break;
                }
            } else {
                $return["data"][$param_gid] = $param_data["default"];
            }
        }

        return $return;
    }

    public function formatFormFields($field, $content = null)
    {
        $field["value"] = !is_null($content) ? $content : "";
        if (empty($field["value"])) {
            $field["value"] = $field["settings_data_array"]["default_value"];
        }

        return $field;
    }

    public function formatViewFields($settings, $field, $value)
    {
        $field["value"] = $value;

        return $field;
    }

    public function formatFulltextFields($settings, $field, $value)
    {
        return trim($value) ? trim($value) . ';' : '';
    }

    public function formatFieldForSearch($field_data)
    {
    }

    public function getFieldNameForSearch($field_data)
    {
        return $field_data['field']['gid'];
    }

    public function validateField($settings, $value)
    {
        $return = ["errors" => [], "data" => ($value === '' ? null : $value)];

        return $return;
    }

    public function validateFieldForSave($settings, $value)
    {
        return $this->validate_field($settings, $value);
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if (!empty($data[$gid])) {
            $criteria["where"][$prefix . $gid] = trim(strip_tags($data[$gid]));
        }

        return $criteria;
    }

    public function validateFieldOption($data)
    {
        $return = ['errors' => [], 'lang' => []];
        $languages = $this->ci->pg_language->languages;
        $cur_lang_id = $this->ci->pg_language->current_lang_id;

        $default_lang = isset($data[$cur_lang_id]) ? (trim(strip_tags($data[$cur_lang_id]))) : '';
        if ($default_lang == '') {
            $return["errors"][] = l('error_field_option_name_empty', 'field_editor');
        }

        foreach ($languages as $id_lang => $lang_settings) {
            $return["lang"][$id_lang] = trim(strip_tags($data[$id_lang]));
            if (empty($return["lang"][$id_lang])) {
                $return["lang"][$id_lang] = $default_lang;
            }
        }

        return $return;
    }

    public function setFieldOption($field, $option_gid, $data)
    {
        if (!$option_gid) {
            // add new option
            $option_gid = 0;
            if (!empty($field["options"]["option"])) {
                foreach ($field["options"]["option"] as $gid => $value) {
                    if (intval($gid) > $option_gid) {
                        $option_gid = $gid;
                    }
                }
            }
            ++$option_gid;
        }
        if (!is_array($option_gid)) {
            $lang_data[$option_gid] = $data;
            $option_gid = (array) $option_gid;
        } else {
            $lang_data = $data;
        }

        foreach ($lang_data as $option_gid => $option_data) {
            foreach ($option_data as $lid => $string) {
                $options[$lid][$option_gid] = $string;
            }
        }

        foreach ($options as $lid => $options_data) {
            $reference = $this->ci->pg_language->get_reference($field["option_module"], $field["option_gid"], $lid);
            foreach ($options_data as $gid => $val) {
                $reference["option"][$gid] = $val;
            }
            $this->ci->pg_language->ds->set_module_reference($field["option_module"], $field["option_gid"], $reference, $lid);
        }

        return;
    }

    public function deleteFieldOption($field, $option_gid)
    {
        foreach ($this->ci->pg_language->languages as $lid => $lang) {
            $reference = $this->ci->pg_language->get_reference($field["option_module"], $field["option_gid"], $lid);
            if (isset($reference["option"][$option_gid])) {
                unset($reference["option"][$option_gid]);
                $this->ci->pg_language->ds->set_module_reference($field["option_module"], $field["option_gid"], $reference, $lid);
            }
        }

        return;
    }

    public function sorterFieldOption($field, $sorter_data)
    {
        $this->ci->pg_language->ds->set_reference_sorter($field["option_module"], $field["option_gid"], $sorter_data);
    }

    protected function arrToDec($data)
    {
        $data = (array) $data;
        if (empty($data)) {
            return 0;
        }
        $binary_string = "";
        $max = max($data);
        for ($i = 0; $i <= $max; ++$i) {
            $binary_string = ((in_array($i, $data)) ? "1" : "0") . $binary_string;
        }

        return bindec($binary_string);
    }

    protected function decToArr($dec)
    {
        $data = [];
        $binary_string = decbin($dec);
        $arr = str_split($binary_string);
        $max = count($arr) - 1;
        for ($i = 0; $i <= $max; ++$i) {
            if ($arr[$max - $i] == 1) {
                $data[] = $i;
            }
        }

        return $data;
    }

    /**
     * Convert array to string
     *
     * @param array $arr
     *
     * @return string
     */
    protected function arrToString(array $data)
    {
        if (empty($data)) {
            return 0;
        }

        $data = implode(" , ", $data);
        return ' ' . $data . ' ';
    }

    /**
     * Convert string to array
     *
     * @param string $string
     *
     * @return array
     */
    protected function stringToArr($string)
    {
        $string = str_replace(" ", '', $string);
        $data = explode(",", $string);

        return $data;
    }

    public function __call($name, $args)
    {
        $methods = [
            'arr_to_dec' => 'arrToDec',
            'dec_to_arr' => 'decToArr',
            'delete_field_lang' => 'deleteFieldLang',
            'delete_field_option' => 'deleteFieldOption',
            'sorter_field_option' => 'sorterFieldOption',
            'validate_field' => 'validateField',
            'format_field' => 'formatField',
            'get_field_name_for_search' => 'getFieldNameForSearch',
            'format_field_for_search' => 'formatFieldForSearch',
            'format_field_name' => 'formatFieldName',
            'format_form_fields' => 'formatFormFields',
            'format_fulltext_fields' => 'formatFulltextFields',
            'format_view_fields' => 'formatViewFields',
            'validate_field_type' => 'validateFieldType',
            'update_field_name' => 'updateFieldName',
            'set_field_option' => 'setFieldOption',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'validate_field_for_save' => 'validateFieldForSave',
            'validate_field_name' => 'validateFieldName',
            'validate_field_option' => 'validateFieldOption',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
