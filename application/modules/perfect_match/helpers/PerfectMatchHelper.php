<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\helpers {

    /**
     * Perfect_match module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */

    if (!function_exists('perfectMatchForm')) {
        function perfectMatchForm($params = [])
        {
            $ci = &get_instance();

            $ci->load->model(['Field_editor_model', 'Perfect_match_model']);

            $form_settings = [
                'type'         => 'advanced',
                'form_id'      => 'user_advanced',
                'use_advanced' => false,
                'action'       => site_url() . 'perfect_match/search',
                'object'       => 'user',
                'form_url'     => 'perfect_match/search/',
                'search_url'   => 'perfect_match/ajaxSearch/',
                'count_url'    => 'perfect_match/ajaxSearchCounts/',
                'load_users'    => 'perfect_match/ajaxLoadUsers/',
                'view' => !empty($params['view']),
            ];

            $user_id = $ci->session->userdata('user_id');

            $ci->Field_editor_model->initialize($ci->Perfect_match_model->form_editor_type);
            $fields_for_select = $ci->Field_editor_model->get_fields_for_select();
            $ci->Perfect_match_model->setAdditionalFields($fields_for_select);

            if ($ci->session->userdata("perfect_match_full")) {
                $current_settings = $ci->session->userdata("perfect_match_full");
            } else {
                $current_settings = $ci->Perfect_match_model->getUserParams($user_id);
            }

            $validate_settings = $ci->Perfect_match_model->validate($current_settings, 'select');

            if (empty($validate_settings['data']['age_min'])) {
                $validate_settings['data']['age_min'] = $ci->session->userdata("users_search")['age_min'] ?: $ci->pg_module->get_module_config('users', 'age_min');
            }

            if (empty($validate_settings['data']['age_max'])) {
                $validate_settings['data']['age_max'] = $ci->session->userdata("users_search")['age_max'] ?: $ci->pg_module->get_module_config('users', 'age_max');
            }

            $ci->load->model('Properties_model');
            $user_types = $ci->Properties_model->get_property('user_type');
            $looking_user_types = $ci->Properties_model->getProperty('looking_user_type');
            $ci->view->assign('looking_user_types', $looking_user_types);

            $ci->view->assign('user_types', $user_types);

            $min_age = $ci->pg_module->get_module_config('users', 'age_min');
            $max_age = $ci->pg_module->get_module_config('users', 'age_max');
            for ($i = $min_age; $i <= $max_age; ++$i) {
                $age_range[$i] = $i;
            }
            $ci->view->assign('age_range', $age_range);

            $sb_selected = "";
            if (!empty($validate_settings['data']['user_type']) &&
                array_key_exists(current($validate_settings['data']['user_type']), $user_types['option'])) {
                $sb_selected = $validate_settings['data']['user_type'];
            }
            $ci->view->assign('sb_selected', $sb_selected);

            $sb_option["all"] = l('filter_all', 'users');
            foreach ($user_types['option'] as $key => $value) {
                $sb_option[$key] = $value;
            }
            $ci->view->assign("sb_option", $sb_option);

            $form = $ci->Field_editor_forms_model->get_form_by_gid($ci->Perfect_match_model->perfect_match_form_gid, $ci->Perfect_match_model->form_editor_type);
            $form = $ci->Field_editor_forms_model->format_output_form($form, $validate_settings['data']);

            if (!empty($form['field_data'])) {
                foreach ($form['field_data'] as $key => $field_data) {
                    if (!empty($field_data['section']['fields'])) {
                        $form_settings["use_advanced"] = true;
                        break;
                    } elseif (!empty($field_data['field'])) {
                        $form_settings["use_advanced"] = true;
                        break;
                    } else {
                        unset($form['field_data'][$key]);
                    }
                }

                $ci->view->assign('advanced_form', $form['field_data']);
            }

            $ci->view->assign('data', !empty($validate_settings["data"]) ? $validate_settings["data"] : []);
            $ci->view->assign('form_settings', $form_settings);
            $html = ($params['view'] == 'horizontal') ? $ci->view->fetch("helper_search_form_horizontal", 'user', 'users') : $ci->view->fetch("helper_search_form", 'user', 'users') ;
            return $html;
        }
    }

    if (!function_exists('searchFieldBlock')) {
        function searchFieldBlock($params = [])
        {
            $ci = &get_instance();

            $ci->view->assign('field', $params['field']);
            $ci->view->assign('field_name', $params['field_name']);
            $html = $ci->view->fetch("helper_search_field_block", 'user', 'users');

            return $html;
        }
    }

}

namespace {

    if (!function_exists('perfect_match_form')) {
        function perfect_match_form($params = [])
        {
            return Pg\modules\perfect_match\helpers\perfectMatchForm($params);
        }
    }

    if (!function_exists('search_field_block')) {
        function search_field_block($params = [])
        {
            return Pg\modules\perfect_match\helpers\searchFieldBlock($params);
        }
    }

}
