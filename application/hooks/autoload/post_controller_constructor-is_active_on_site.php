<?php

use Pg\modules\ausers\models\AusersModel;
use Pg\modules\users\models\UsersModel;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('is_active_on_site')) {
    function is_active_on_site()
    {
        if (INSTALL_MODULE_DONE) {
            $ci = &get_instance();
            $auth_type = $ci->session->userdata('auth_type');
            $is_session_destroy = false;
            if ($auth_type === 'admin') {
                $user_id = $ci->session->userdata('user_id');
                $ausers_model = new AusersModel();
                $is_session_destroy = empty($ausers_model->getUserById($user_id));
            } elseif ($auth_type === 'user') {
                $user_id = $ci->session->userdata('user_id');
                $users_model = new UsersModel();
                $is_session_destroy = empty($users_model->getUserById($user_id));
            }

            if ($is_session_destroy === true) {
                $ci->session->sess_destroy();
            }
        }
    }
}
