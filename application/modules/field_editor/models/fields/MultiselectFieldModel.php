<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Multiselect field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class MultiselectFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'    => 'TEXT',
        'null'    => false,
        'default' => '',
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'array', "default" => ''],
        'view_type'     => ['type' => 'string', 'options' => ['mselect', 'checkbox'], "default" => "checkbox"],
    ];
    public $form_field_settings = [
        "search_type"  => ["values" => ['one', 'many'], "default" => 'one'],
        "view_type"    => ["values" => ['mselect', 'radio'], "default" => 'mselect'],
        "search_match" => ["values" => ['strict', 'notstrict'], "default" => 'notstrict'],
    ];

    public function formatField($data, $lang_id = '')
    {
        $data = parent::formatField($data);
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

    public function formatFormFields($field, $content = null)
    {
        $field["value"] = !is_null($content) ? $content : "";
        if ($field["value"] === '') {
            $field["value"] = $field["settings_data_array"]["default_value"];
        } else {
            $field["value"] = $this->stringToArr($field["value"]);
        }

        return $field;
    }

    public function formatViewFields($settings, $field, $value)
    {
        $sort = [];

        $field["value_array"] = $this->stringToArr($value);

        $i = 0;
        foreach ($settings["options"]["option"] as $key => $val) {
            $sort[$key] = ++$i;
        }

        $field["value"] = [];

        foreach ($field["value_array"] as $v) {
            if (isset($settings["options"]["option"][$v])) {
                $field["value"][$sort[$v]] = $settings["options"]["option"][$v];
            }
        }

        ksort($field["value"]);

        $field["value_str"] = implode(', ', $field["value"]);

        return $field;
    }

    public function formatFulltextFields($settings, $field, $value)
    {
        $field_array = $this->stringToArr($value);
        foreach ($field_array as $v) {
            if (!empty($settings["options"]["option"][$v])) {
                $values[] = trim($settings["options"]["option"][$v]);
            }
        }
        $return = (!empty($values)) ? ($field["name"] . " " . implode(', ', $values) . ";") : '';

        return $return;
    }

    public function validateField($settings, $value)
    {
        $data = is_array($value) ? $this->arrToString($value) : ($value === '' ? null : $value);
        $return = ["errors" => [], "data" => $data];

        return $return;
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if (!empty($data[$gid])) {
            if ($settings["search_type"] == "one" && !is_array($data[$gid])) {
                $temp = $this->arrToString([$data[$gid]]);
            } elseif (is_array($data[$gid])) {
                $temp = $this->arrToString($data[$gid]);
            }
            if (!empty($settings['search_match']) && $settings['search_match'] == 'strict') {
                $criteria["where_sql"][] = "{$prefix}{$gid} & {$temp} = {$temp}";
            } elseif ($temp) {
                $query_str = '';
                $temp = str_replace(" ", '', $temp);
                $temp = explode(",", $temp);
                $query_str = "{$prefix}{$gid} like '% " . $temp[0] . " %' ";
                $tmp_cnt = count($temp);

                if ($tmp_cnt > 1) {
                    $query_str = '( ' . $query_str;
                    foreach ($temp as $key => $value) {
                        if ($key > 0) {
                            $query_str .= " or {$prefix}{$gid} like '% " . $value . " %' ";
                        }
                    }
                    $query_str = $query_str . ' )';
                }

                $criteria["where_sql"][] = $query_str;
            }
        }

        return $criteria;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_field_lang' => 'deleteFieldLang',
            'format_field' => 'formatField',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'validate_field' => 'validateField',
            'validate_field_type' => 'validateFieldType',
            'update_field_name' => 'updateFieldName',
            'format_view_fields' => 'formatViewFields',
            'format_fulltext_fields' => 'formatFulltextFields',
            'format_form_fields' => 'formatFormFields',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
