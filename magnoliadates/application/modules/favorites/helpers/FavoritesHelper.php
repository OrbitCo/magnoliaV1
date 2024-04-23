<?php

declare(strict_types=1);

namespace Pg\modules\favorites\helpers {

    if (!function_exists('favoritesButton')) {
        function favoritesButton($params)
        {
            $ci = &get_instance();
            $ci->load->model('Favorites_model');
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

            if (in_array($params['id_user'], $ci->Favorites_model->get_list_users_ids($user_id))) {
                $action = 'remove';
            } else {
                $action = 'add';
            }
            $ci->view->assign('action', $action);

            $ci->view->assign('id_dest_user', $params['id_user']);

            if (empty($params['view_type'])) {
                $params['view_type'] = 'button';
            }

            $ci->view->assign('class', (isset($params['class']) && !empty($params['class'])) ? $params['class'] : '');

            return $ci->view->fetch('helper_favorites_' . $params['view_type'], 'user', 'favorites');
        }
    }

}

namespace {

    if (!function_exists('favorites_button')) {
        function favorites_button($params)
        {
            return Pg\modules\favorites\helpers\favoritesButton($params);
        }
    }

}
