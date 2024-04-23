<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models;

use Pg\modules\field_editor\models\fields\FieldTypeModel;

/**
 * Field types loader Model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FieldTypesLoaderModel
{
    public function __get($var)
    {
        if (!$var) {
            return '';
        }

        $model_name = NS_MODULES . 'field_editor\\models\\fields\\' . ucfirst($var) . 'FieldModel';
        if (class_exists($model_name)) {
            $this->{$var} = new $model_name();
        } else {
            $this->{$var} = new FieldTypeModel();
        }

        return $this->{$var};
    }
}
