<?php

declare(strict_types=1);

namespace Pg\modules\blacklist\helpers {

    if (!function_exists('blacklistButton')) {
        function blacklistButton($params)
        {
            $ci = &get_instance();
            $ci->load->model('Blacklist_model');
            if (!isset($params['id_user']) || empty($params['id_user'])) {
                return '';
            }

            if ($ci->session->userdata('auth_type') != 'user') {
                return '';
            }

            $user_id = $ci->session->userdata('user_id');
            if (!$user_id || $user_id == $params['id_user']) {
                return '';
            }

            if (in_array($params['id_user'], $ci->Blacklist_model->get_list_users_ids($user_id))) {
                $action = 'remove';
            } else {
                $action = 'add';
            }
            $ci->view->assign('action', $action);

            $ci->view->assign('id_dest_user', $params['id_user']);

            if (empty($params['view_type'])) {
                $params['view_type'] = 'link';
            }

            return $ci->view->fetch('helper_blacklist_' . $params['view_type'], 'user', 'blacklist');
        }
    }

    if (!function_exists('inMyBlackList')) {
        function inMyBlackList($profile_id)
        {
            $ci = &get_instance();
            $ci->load->model('Blacklist_model');

            if ($ci->session->userdata('auth_type') != 'user') {
                return false;
            }

            $user_id = $ci->session->userdata('user_id');

            if ($profile_id == $user_id) {
                return false;
            }


            if (in_array($profile_id, $ci->Blacklist_model->get_list_users_ids($user_id))) {
                return true;
            } else {
                return false;
            }
        }
    }
}

namespace {

    if (!function_exists('blacklist_button')) {
        function blacklist_button($params)
        {
            return Pg\modules\blacklist\helpers\blacklistButton($params);
        }
    }

    if (!function_exists('in_my_blacklist')) {
        function in_my_blacklist($profile_id)
        {
            return Pg\modules\blacklist\helpers\inMyBlackList($profile_id);
        }
    }

}
