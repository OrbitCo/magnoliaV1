<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Text field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 */
class RangeFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'       => 'DECIMAL',
        'constraint' => '15,3',
        'null'       => false,
        'default'    => 0,
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'int', "default" => 0],
        'min_val'       => ['type' => 'int', 'min' => -2147483648, 'max' => 2147483648, "default" => 0],
        'max_val'       => ['type' => 'int', 'min' => -2147483648, 'max' => 2147483648, "default" => 100],
        'template'      => ['type' => 'string', 'options' => ['intval', 'floatval'], "default" => 'intval'],
        'format'        => ['type' => 'string', 'options' => ['none', 'year', 'price'], "default" => 'none'],
    ];
    public $form_field_settings = [
        "search_type" => ["values" => ['number', 'range'], "default" => 'range'],
    ];

    public function validateFieldType($settings_data)
    {
        $return = parent::validateFieldType($settings_data);

        $settings = $this->manage_field_param;
        if (!in_array($return["data"]["template"], $settings["template"]["options"])) {
            $return["data"]["template"] = $settings["template"]["default"];
        }
        if (!in_array($return["data"]["format"], $settings["format"]["options"])) {
            $return["data"]["format"] = $settings["format"]["default"];
        }
        if ($return["data"]["min_val"] < $settings["min_val"]["min"]) {
            $return["data"]["min_val"] = $settings["min_val"]["min"];
        }
        if ($return["data"]["min_val"] > $settings["min_val"]["max"]) {
            $return["data"]["min_val"] = $settings["min_val"]["max"];
        }
        if ($return["data"]["max_val"] < $settings["max_val"]["min"]) {
            $return["data"]["max_val"] = $settings["max_val"]["min"];
        }
        if ($return["data"]["max_val"] > $settings["max_val"]["max"]) {
            $return["data"]["max_val"] = $settings["max_val"]["max"];
        }

        return $return;
    }

    public function formatViewFields($settings, $field, $value)
    {
        $field["value_original"] = $value;
        $value = ($settings["settings_data_array"]['template'] == 'floatval') ? floatval($value) : intval($value);
        switch ($settings["settings_data_array"]["format"]) {
            case "price":
                $field["value"] = sprintf("%01.2f", $value);
                break;
            case "year":
                $field["value"] = sprintf("%4d", $value);
                break;
            case "none":
                $field["value"] = $value;
                break;
        }

        return $field;
    }

    public function validateField($settings, $value)
    {
        $return = ["errors" => [], "data" => $value];
        if ($value === '') {
            $return['data'] = null;

            return $return;
        }
        switch ($settings["settings_data_array"]["template"]) {
            case "intval":
                $return["data"] = intval($return["data"]);
                break;
            case "floatval":
                $return["data"] = floatval(str_replace(',', '.', $return["data"]));
                break;
        }
        if ($settings["settings_data_array"]["min_val"] > $return["data"]) {
            $return["data"] = $settings["settings_data_array"]["min_val"];
        }
        if ($settings["settings_data_array"]["max_val"] < $return["data"]) {
            $return["data"] = $settings["settings_data_array"]["max_val"];
        }

        return $return;
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if ($settings["search_type"] == "number") {
            if (!empty($data[$gid])) {
                $criteria["where"][$prefix . $gid] = $this->getSearchFieldValue($data[$gid]);
            }
        } else {
            if (!empty($data[$gid . "_min"])) {
                $data[$gid . "_min"] = $this->getSearchFieldValue($data[$gid . "_min"]);
                $criteria["where_sql"][] = "`{$prefix}{$gid}` >= {$data[$gid . '_min']}";
            }
            if (!empty($data[$gid . "_max"])) {
                $data[$gid . "_max"] = $this->getSearchFieldValue($data[$gid . "_max"]);
                $criteria["where_sql"][] = "`{$prefix}{$gid}` <= {$data[$gid . '_max']}";
            }
        }

        return $criteria;
    }

    private function getSearchFieldValue($value)
    {
        $value = floatval(str_replace(',', '.', $value));
        if ($value < $this->manage_field_param["min_val"]["min"]) {
            $value = $this->manage_field_param["min_val"]["min"];
        }
        if ($value > $this->manage_field_param["max_val"]["max"]) {
            $value = $this->manage_field_param["max_val"]["max"];
        }

        return $value;
    }

    public function formatFormFields($field, $content = null)
    {
        parent::formatFormFields($field, $content);
        $field["value"] = ($field['settings_data_array']['template'] == 'floatval') ? floatval($content) : intval($content);

        return $field;
    }

    public function getFieldNameForSearch($field_data)
    {
        if ($field_data['settings']["search_type"] == "number") {
            return $field_data['field']['gid'];
        } else {
            return [$field_data['field']['gid'] . '_min', $field_data['field']['gid'] . '_max'];
        }
    }

    public function setFieldOption($field, $option_gid, $data)
    {
        return;
    }

    public function deleteFieldOption($field, $option_gid)
    {
        return;
    }

    public function sorterFieldOption($field, $sorter_data)
    {
        return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'sorter_field_option' => 'sorterFieldOption',
            'delete_field_option' => 'deleteFieldOption',
            'set_field_option' => 'setFieldOption',
            'get_field_name_for_search' => 'getFieldNameForSearch',
            'format_form_fields' => 'formatFormFields',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'format_view_fields' => 'formatViewFields',
            'validate_field' => 'validateField',
            'validate_field_type' => 'validateFieldType',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
