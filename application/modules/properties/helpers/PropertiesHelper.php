<?php

declare(strict_types=1);

namespace Pg\modules\properties\helpers {

    if (!function_exists('propertySelect')) {
        function propertySelect($property_gid, $var_name = '', $selected = [], $multi = 0, $empty = 1, $lang_id = '')
        {
            $ci = &get_instance();
            $ci->load->model("Properties_model");

            if (empty($property_gid)) {
                return false;
            }

            $data = $ci->Properties_model->get_property($property_gid, $lang_id);

            if (empty($data)) {
                return false;
            }

            if (!$var_name) {
                $var_name = $property_gid;
            }

            if (!is_array($selected) && !empty($selected)) {
                $selected = [0 => $selected];
            }
            if (!empty($selected)) {
                foreach ($selected as $item) {
                    $selected_reverse[$item] = 1;
                }
            }

            $select = [
                'options'      => $data['option'],
                'name'         => $var_name,
                'selected'     => $selected_reverse,
                'multi'        => $multi,
                'empty_option' => $empty,
            ];
            $ci->view->assign('properties_helper_data', $select);

            return $ci->view->fetch('helper_properties_select', 'admin', 'properties');
        }
    }

}

namespace {

    if (!function_exists('property_select')) {
        function property_select($property_gid, $var_name = '', $selected = [], $multi = 0, $empty = 1, $lang_id = '')
        {
            return Pg\modules\properties\helpers\propertySelect($property_gid, $var_name, $selected, $multi, $empty, $lang_id);
        }
    }

}
