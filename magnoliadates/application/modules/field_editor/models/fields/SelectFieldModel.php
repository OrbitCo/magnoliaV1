<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Select field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class SelectFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'       => 'INT',
        'constraint' => 3,
        'null'       => false,
        'default'    => 0,
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'int', 'min' => 0, "default" => 0],
        'view_type'     => ['type' => 'string', 'options' => ['select', 'radio'], "default" => "select"],
        'empty_option'  => ['type' => 'bool', "default" => true],
    ];
    public $form_field_settings = [
        "search_type" => ["values" => ['one', 'many'], "default" => 'many'],
        "view_type"   => ["values" => ['select', 'radio'], "default" => 'select'],
    ];

    public function formatField($data, $lang_id = '')
    {
        $data = parent::formatField($data, $lang_id);
        $data["option_module"] = $data["section_gid"] . '_lang';
        $data["option_gid"] = 'field_' . $data["gid"] . '_opt';
        $data["options"] = ld($data["option_gid"], $data["option_module"], $lang_id);

        return $data;
    }

    public function updateFieldName($field, $name)
    {
        parent::updateFieldName($field, $name);

        $languages = $this->ci->pg_language->languages;
        $cur_lang_id = $this->ci->pg_language->current_lang_id;
        $default_lang = isset($name[$cur_lang_id]) ? (trim(strip_tags($name[$cur_lang_id]))) : '';

        foreach ($languages as $lid => $lang_settings) {
            $name[$lid] = trim(strip_tags((string)$name[$lid]));
            if (empty($name[$lid])) {
                $name[$lid] = $default_lang;
            }

            $reference = $this->ci->pg_language->get_reference($field['section_gid'] . '_lang', 'field_' . $field['gid'] . '_opt', $lid);
            $reference["header"] = $name[$lid];
            $this->ci->pg_language->ds->set_module_reference($field['section_gid'] . '_lang', 'field_' . $field['gid'] . '_opt', $reference, $lid);
        }

        return;
    }

    public function deleteFieldLang($type, $section, $gid)
    {
        parent::deleteFieldLang($type, $section, $gid);
        $this->ci->pg_language->ds->delete_reference($section . '_lang', 'field_' . $gid . '_opt');
    }

    public function validateFieldType($settings_data)
    {
        $return = parent::validateFieldType($settings_data);

        $settings = $this->manage_field_param;
        if (!in_array($return["data"]["view_type"], $settings["view_type"]["options"])) {
            $return["data"]["view_type"] = $settings["view_type"]["default"];
        }

        return $return;
    }

    public function formatViewFields($settings, $field, $value)
    {
        $field["value_int"] = $value;
        if (isset($settings["options"]["option"][$value])) {
            $field["value"] = $settings["options"]["option"][$value];
        } elseif (strval($value === '0')) {
            $field["value"] = '';
        } elseif (isset($settings["options"]["option"][$settings["settings_data_array"]["default_value"]])) {
            $field["value"] = $settings["options"]["option"][$settings["settings_data_array"]["default_value"]];
        } else {
            $field["value"] = '';
        }

        return $field;
    }

    public function formatFormFields($field, $content = null)
    {
        $field["value"] = !is_null($content) ? $content : "";
        if (empty($field["value"]) && strval($field["value"] !== '0')) {
            $field["value"] = $field["settings_data_array"]["default_value"];
        }

        return $field;
    }

    public function formatFulltextFields($settings, $field, $value)
    {
        if (!empty($settings["options"]["option"][$value])) {
            $return = $field["name"] . " " . trim($settings["options"]["option"][$value]) . ";";
        } elseif (!empty($settings["options"]["option"][$settings["settings_data_array"]["default_value"]])) {
            $return = $field["name"] . " " . trim($settings["options"]["option"][$settings["settings_data_array"]["default_value"]]) . ";";
        } else {
            $return = '';
        }

        return $return;
    }

    public function validateField($settings, $value)
    {
        $return['errors'] = [];
        if ($value === '') {
            $return['data'] = null;

            return $return;
        }
        if (is_array($value)) {
            $return['data'] = array_map(function ($val) {
                return strval(trim(strip_tags($val)));
            }, $value);
        } else {
            $return['data'] = strval(trim(strip_tags((string)$value)));
        }

        return $return;
    }

    public function validateFieldForSave($settings, $value)
    {
        $data = is_array($value) ? $this->arrToDec($value) : ($value === '' ? null : $value);
        $return = ["errors" => [], "data" => $data];

        return $return;
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if ($settings["search_type"] == "one") {
            if (!empty($data[$gid])) {
                $criteria["where"][$prefix . $gid] = intval($data[$gid]);
            }
        } elseif ($settings["view_type"] == 'slider') {
            if (!empty($data[$gid . '_min'])) {
                $criteria["where"][$prefix . $gid . " >= "] = intval($data[$gid . '_min']);
            }
            if (!empty($data[$gid . '_max'])) {
                $criteria["where"][$prefix . $gid . " <= "] = intval($data[$gid . '_max']);
            }
        } elseif (!empty($data[$gid])) {
            if (is_array($data[$gid])) {
                foreach ($data[$gid] as $key => $value) {
                    $field_data[] = $value;
                }
                $criteria["where_in"][$prefix . $gid] = $field_data;
            } else {
                $criteria["where_in"][$prefix . $gid] = $data[$gid];
            }
        }

        return $criteria;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_field_lang' => 'deleteFieldLang',
            'format_field' => 'formatField',
            'update_field_name' => 'updateFieldName',
            'format_form_fields' => 'formatFormFields',
            'format_fulltext_fields' => 'formatFulltextFields',
            'format_view_fields' => 'formatViewFields',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'validate_field' => 'validateField',
            'validate_field_for_save' => 'validateFieldForSave',
            'validate_field_type' => 'validateFieldType',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
