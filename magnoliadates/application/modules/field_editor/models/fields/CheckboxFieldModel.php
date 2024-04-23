<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Checkbox field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class CheckboxFieldModel extends FieldTypeModel
{
    public $base_field_param = [
        'type'       => 'TINYINT',
        'constraint' => 3,
        'null'       => false,
        'default'    => 0,
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'bool', "default" => false],
    ];
    public $form_field_settings = [];

    public function formatFormFields($field, $content = null)
    {
        parent::formatFormFields($field, $content);
        $field["value"] = !is_null($content) ? $content : false;
        if ($field["value"] === false) {
            $field["value"] = $field["settings_data_array"]["default_value"];
        }

        return $field;
    }

    public function formatFulltextFields($settings, $field, $value)
    {
        return $value ? $field['name'] . ';' : '';
    }

    public function validateField($settings, $value)
    {
        $return = ["errors" => [], "data" => $value];
        $return["data"] = ($return["data"]) ? 1 : 0;

        return $return;
    }

    public function getSearchFieldCriteria($field, $settings, $data, $prefix)
    {
        $criteria = [];
        $gid = $field['gid'];
        if (!empty($data[$gid]) && $data[$gid] == 1) {
            $criteria["where"][$prefix . $gid] = 1;
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
            'sorter_field_option' => 'sorterFieldOption',
            'delete_field_option' => 'deleteFieldOption',
            'set_field_option' => 'setFieldOption',
            'get_search_field_criteria' => 'getSearchFieldCriteria',
            'format_fulltext_fields' => 'formatFulltextFields',
            'format_form_fields' => 'formatFormFields',
            'validate_field' => 'validateField',
        ];

        if (!isset($methods[$name])) {
            return parent::__call($name, $args);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
