<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models\fields;

/**
 * Like field model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class LikeFieldModel
{
    public $base_field_param = [
        'type'       => 'TINYINT',
        'constraint' => 3,
        'null'       => false,
        'default'    => 0,
    ];
    public $manage_field_param = [
        'default_value' => ['type' => 'int', "default" => 0],
    ];
    public $form_field_settings = [];

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
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
