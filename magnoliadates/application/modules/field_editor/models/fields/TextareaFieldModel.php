<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Textarea field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class TextareaFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'    => 'TEXT',
        'null'    => false,
        'default' => '',
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'text', "default" => ''],
        'min_char'      => ['type' => 'int', 'min' => 0, "default" => 0],
        'max_char'      => ['type' => 'int', 'min' => 0, "default" => ''],
    ];
    private $moderation_type = 'field_editor';
    public $form_field_settings = [];

    public function validateFieldType($settings_data)
    {
        $return = parent::validateFieldType($settings_data);

        $settings = $this->manage_field_param;

        if ($return["data"]["min_char"] < $settings["min_char"]["min"]) {
            $return["data"]["min_char"] = $settings["min_char"]["min"];
        }
        if ($return["data"]["max_char"] < $settings["max_char"]["min"]) {
            $return["data"]["max_char"] = $settings["max_char"]["min"];
        }

        return $return;
    }

    public function formatFormFields($field, $content = null)
    {
        $field["value"] = $content;

        return $field;
    }

    public function validateField($settings, $value)
    {
        $return = ["errors" => [], "data" => $value];
        $return["data"] = trim(strip_tags($return["data"]));
        $string_length = strlen($return["data"]);
        if ($settings["settings_data_array"]["min_char"] > $string_length) {
            $return["errors"][$settings['field_name']] = str_replace("[length]", $settings["settings_data_array"]["min_char"], l('error_field_length_less_than', 'field_editor'));
        }
        if ($settings["settings_data_array"]["max_char"] && $settings["settings_data_array"]["max_char"] < $string_length) {
            $return["errors"][$settings['field_name']] = str_replace("[length]", $settings["settings_data_array"]["max_char"], l('error_field_length_more_than', 'field_editor'));
        }
        $this->ci->load->model('moderation/models/Moderation_badwords_model');
        $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']);
        if ($bw_count) {
            $return['errors'][$settings['field_name']] = l('error_badwords_text', 'field_editor');
        }

        return $return;
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if (!empty($data[$gid])) {
            $criteria["where"][$prefix . $gid . " LIKE"] = "%" . trim(strip_tags($data[$gid])) . "%";
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
            'format_form_fields' => 'formatFormFields',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'validate_field' => 'validateField',
            'validate_field_type' => 'validateFieldType',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
