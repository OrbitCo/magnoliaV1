<?php

declare(strict_types=1);

namespace Pg\modules\languages\models;

/**
 * Languages module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class LanguagesModel extends \Model
{
    /**
     * Module check permission to edit data source
     *
     * @param array $module
     *
     * @return array
     */
    public function isDisabledDSActions(array $module): array
    {
        $model_name = ucfirst($module['module_gid']) . "_model";
        $model = NS_MODULES . $module['module_gid'] . "\\models\\" . $model_name;
        if (class_exists($model)) {
            $this->ci->load->model($model_name);
            if (isset($this->ci->{$model_name}->is_disabled_action_ds)) {
                $module['is_disabled_action_ds'] = $this->ci->{$model_name}->is_disabled_action_ds;
            }
        }
        return $module;
    }

    /**
     * Word search
     * @param array $fields
     * @param string $field
     * @param string $word
     * @return array
     */
    public function search(array $fields, string $field, string $word): array
    {
        $result = $this->ci->db
            ->select(implode(", ", $fields))
            ->from(LANG_PAGES_TABLE)
            ->where('`module_gid` IN (SELECT `module_gid` FROM `'.MODULES_TABLE.'`)', NULL, FALSE)
            ->like($field, $word)
            ->orderBy($field, 'ASC')
            ->get()
            ->result_array();

        $format_autocomplete = [];
        foreach ($result as $key => $value) {
            $format_autocomplete['hit_list'][] = [
                'label' => $value[$field],
                'value' => strip_tags($value[$field] ?: ""),
                'module_gid' => $value['module_gid'],
                'gid' => $value['gid']
            ];
        }

        return $format_autocomplete;
    }
}
