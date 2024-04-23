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
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class TextFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'       => 'VARCHAR',
        'constraint' => '255',
        'null'       => false,
        'default'    => '',
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'string', "default" => ''],
        'min_char'      => ['type' => 'int', 'min' => 0, 'max' => 255, "default" => 0],
        'max_char'      => ['type' => 'int', 'min' => 1, 'max' => 255, "default" => 255],
        'template'      => ['type' => 'string', 'options' => ['string', 'intval', 'floatval', 'email', 'url', 'price'], "default" => 'string'],
        'format'        => ['type' => 'string', 'options' => ['none', 'year', 'price'], "default" => 'none'],
    ];
    private $moderation_type = 'field_editor';
    public $form_field_settings = [
        "search_type" => ["values" => ['text', 'number'], "default" => 'text'],
        "view_type"   => ["values" => ['equal', 'range'], "default" => 'equal'],
    ];

    public function validate_field_type($settings_data)
    {
        $return = parent::validateFieldType($settings_data);

        $settings = $this->manage_field_param;
        if (!in_array($return["data"]["template"], $settings["template"]["options"])) {
            $return["data"]["template"] = $settings["template"]["default"];
        }
        if (!in_array($return["data"]["format"], $settings["format"]["options"])) {
            $return["data"]["format"] = $settings["format"]["default"];
        }
        if ($return["data"]["min_char"] < $settings["min_char"]["min"]) {
            $return["data"]["min_char"] = $settings["min_char"]["min"];
        }
        if ($return["data"]["min_char"] > $settings["min_char"]["max"]) {
            $return["data"]["min_char"] = $settings["min_char"]["max"];
        }
        if ($return["data"]["max_char"] < $settings["max_char"]["min"]) {
            $return["data"]["max_char"] = $settings["max_char"]["min"];
        }
        if ($return["data"]["max_char"] > $settings["max_char"]["max"]) {
            $return["data"]["max_char"] = $settings["max_char"]["max"];
        }

        return $return;
    }

    public function formatViewFields($settings, $field, $value)
    {
        $field["value_original"] = $value;
        switch ($settings["settings_data_array"]["format"]) {
            case "price":
                $field["value"] = sprintf("%01.2f", $value);
                break;
            case "year":
                $field["value"] = sprintf("%4d", $value);
                break;
            case "none":
                $field["value"] = (!empty($value)) ? $value : $settings["settings_data_array"]['default_value'];
                break;
        }

        return $field;
    }

    public function formatFormFields($field, $content = null)
    {
        $field["value"] = $content;

        return $field;
    }

    public function validateField($settings, $value)
    {
        $return = ["errors" => [], "data" => $value];
        switch ($settings["settings_data_array"]["template"]) {
            case "string":
                $return["data"] = trim(strip_tags($return["data"]));
                break;
            case "intval":
                $return["data"] = intval($return["data"]);
                break;
            case "floatval":
                $return["data"] = floatval($return["data"]);
                break;
            case "email":
                $return["data"] = trim(strip_tags($return["data"]));
                if (!filter_var($return["data"], FILTER_VALIDATE_EMAIL)) {
                    $return["errors"][$settings['field_name']] = l('error_email_incorrect', 'users');
                }
                break;
            case "url":
                $return["data"] = trim(strip_tags($return["data"]));
                if (isset($settings["settings_data_array"]["default_value"]) && $settings["settings_data_array"]["default_value"]) {
                    if ($settings["settings_data_array"]["default_value"] == $value || !$value) {
                        $return['data'] = '';
                        return $return;
                    }
                }
                if (!filter_var($return["data"], FILTER_VALIDATE_URL)) {
                    $return["errors"][$settings['field_name']] = l('error_url_incorrect', 'field_editor');
                }
                break;
            case "price":
                $return["data"] = sprintf("%01.2f", $return["data"]);
                break;
        }
        $string_length = strlen($return["data"]);
        if ($settings["settings_data_array"]["min_char"] > $string_length) {
            $return["errors"][$settings['field_name']] = str_replace("[length]", $settings["settings_data_array"]["min_char"], l('error_field_length_less_than', 'field_editor'));
        }
        if ($settings["settings_data_array"]["max_char"] < $string_length) {
            $return["errors"][$settings['field_name']] = str_replace("[length]", $settings["settings_data_array"]["max_char"], l('error_field_length_more_than', 'field_editor'));
        }
        $this->ci->load->model('moderation/models/Moderation_badwords_model');
        $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']);
        if ($bw_count) {
            $return['errors'][$settings['field_name']] = l('error_badwords_text', 'field_editor');
        }

        return $return;
    }

    public function getFieldNameForSearch($field_data)
    {
        if ($field_data['settings']["view_type"] == "range") {
            return [$field_data['field']['gid'] . '_min', $field_data['field']['gid'] . '_max'];
        } else {
            return $field_data['field']['gid'];
        }
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if ($settings["search_type"] == "text") {
            if (!empty($data[$gid])) {
                if ($settings["view_type"] == "equal") {
                    $criteria["where"][$prefix . $gid] = trim(strip_tags($data[$gid]));
                } else {
                    $criteria["where"][$prefix . $gid . " LIKE"] = '%' . trim(strip_tags($data[$gid])) . '%';
                }
            }
        } else {
            if ($settings["view_type"] == "equal") {
                if (!empty($data[$gid])) {
                    $data[$gid] = (!is_numeric($data[$gid])) ? floatval($data[$gid]) : $data[$gid];
                    $criteria["where"][$prefix . $gid] = $data[$gid];
                }
            } else {
                if (!empty($data[$gid . "_min"])) {
                    $data[$gid . "_min"] = (!is_numeric($data[$gid . "_min"])) ? floatval($data[$gid . "_min"]) : $data[$gid . "_min"];
                    $criteria["where_sql"][] = "CONVERT(`{$prefix}{$gid}`, DECIMAL(22,10)) >= {$data[$gid . '_min']}";
                }
                if (!empty($data[$gid . "_max"])) {
                    $data[$gid . "_max"] = (!is_numeric($data[$gid . "_max"])) ? floatval($data[$gid . "_max"]) : $data[$gid . "_max"];
                    $criteria["where_sql"][] = "CONVERT(`{$prefix}{$gid}`, DECIMAL(22,10)) <= {$data[$gid . '_max']}";
                }
            }
        }

        return $criteria;
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
            'delete_field_option' => 'deleteFieldOption',
            'sorter_field_option' => 'sorterFieldOption',
            'set_field_option' => 'setFieldOption',
            'get_field_name_for_search' => 'getFieldNameForSearch',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'format_form_fields' => 'formatFormFields',
            'format_view_fields' => 'formatViewFields',
            'validate_field' => 'validateField',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
