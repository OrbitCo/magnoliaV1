<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('get_user_confirm')) {
    function get_user_confirm()
    {
        if (INSTALL_MODULE_DONE) {
            $ci = &get_instance();
            $not_confirmed_methods = [
                'registration',
                'photoUpload',
                'ajax_load_avatar',
                'getChangeLocationForm',
                'setChangeLocationForm',
                'getAvailableActivation',
                'ajax_get_locations',
                'upload_avatar',
                'confirm',
                'settings',
                'ajax_backend',
                'ajaxUserSiteVisit',
                'ajax_get_contact_list',
                'getAvailableActivation',
                'logout',
                'tickets',
                'contact_us',
                'i_agree_terms',
                'inactive',
                'homepage',
            ];

            if ($ci->session->userdata('auth_type') == 'user') {
                $ci->load->model('users/models/Auth_model');
                $ci->Auth_model->updateUserSessionData($ci->session->userdata('user_id'));
            }

            if ($ci->pg_module->is_module_installed('users')
                && $ci->session->userdata('auth_type') == 'user'
                && intval($ci->session->userdata('confirm')) == 0
                && in_array($ci->router->method, $not_confirmed_methods) !== true && in_array($ci->router->class, $not_confirmed_methods) !== true) {
                $use_email_confirmation = (bool) $ci->pg_module->get_module_config('users', 'user_confirm');
                $is_reg = (bool)$ci->session->userdata('is_reg');
                if ($is_reg) {
                    $ci->session->unset_userdata('is_reg');
                    $is_reg = false;
                }

                if ($use_email_confirmation === true && $is_reg === false) {
                    if ($ci->router->is_api_class) {
                        exit(json_encode([
                            'data' => 'service_required',
                            'code' => 403,
                            'system_messages' => ['errors' => l('info_please_checkout_mailbox', 'users')],
                        ]));
                    } else {
                        $ci->system_messages->clean_messages();
                        $ci->system_messages->addMessage(\Pg\Libraries\View::MSG_INFO, l('info_please_checkout_mailbox', 'users'));
                        redirect(site_url('users/confirm'), 'hard');
                    }
                }
            }
        }
    }
}
