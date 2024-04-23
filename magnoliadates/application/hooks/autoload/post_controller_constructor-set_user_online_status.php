<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('set_user_online_status')) {
    function set_user_online_status()
    {
        if (INSTALL_MODULE_DONE) {
            $ci = &get_instance();
            $not_update_online_status = $ci->input->post('not_update_online_status', true);
            if ($not_update_online_status) {
                return;
            }

            if ($ci->pg_module->is_module_installed('users') &&
                $ci->load->model('Users_model', '', false, true, true) &&
                method_exists($ci->Users_model, 'updateOnlineStatus') &&
                $ci->session->userdata('auth_type') == 'user') {
                    $id_user = $ci->session->userdata('user_id');
                    $ci->Users_model->update_online_status($id_user, '1');
            }
        }

        return;
    }
}
