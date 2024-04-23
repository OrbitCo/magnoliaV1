<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('get_user_approve')) {
    function get_user_approve()
    {
        if (INSTALL_MODULE_DONE) {
            $ci = &get_instance();
            $not_approved_modules = [
                'contact_us', 'tickets'
            ];
            $not_approved_methods = [
                'change_lang',
                'confirm',
                'login',
                'login_form',
                'logout',
                'registration',
                'restore',
                'homepage',
                'account',
                'form',
                'ajax_backend',
                'save_payment',
                'photoUpload',
                'ajax_load_avatar',
                'upload_avatar',
                'settings'
            ];
            if ($ci->pg_module->is_module_installed('users')
                && $ci->session->userdata('confirm')
                && !$ci->session->userdata('approved')
                && $ci->session->userdata('auth_type') == 'user'
                && !in_array($ci->router->class, $not_approved_modules)
                && !in_array($ci->router->method, $not_approved_methods)) {
                $user_id = $ci->session->userdata('user_id');
                $use_approve = $ci->pg_module->get_module_config('users', 'user_approve');
                $ci->load->model('users/models/Users_model');
                if ($use_approve == 2 && $ci->pg_module->is_module_installed('services')) {
                    if ($ci->router->class != 'services') {
                        if ($ci->router->is_api_class) {
                            exit(json_encode([
                                'data' => 'service_required',
                                'code' => 403,
                                'system_messages' => ['errors' => l('error_approve_need_buy', 'users')],
                            ]));
                        } else {
                            $ci->load->model('Users_payments_model');
                            $payments = $ci->Users_payments_model->getUserPaymentsByGid('admin_approve', 'services', $user_id);
                            if (!empty($payments)) {
                                if ($payments[0]['status']) {
                                    return;
                                } else {
                                    $ci->view->setRedirect(site_url() . 'users/account/payments_history');
                                }
                            } else {
                                $ci->system_messages->add_message('error', l('error_approve_need_buy', 'users'));
                                $ci->view->setRedirect(site_url() . 'services/form/admin_approve');
                            }
                        }
                    }
                } elseif ($use_approve == 1 && $ci->router->method != 'settings') {
                    if ($ci->router->is_api_class) {
                        exit(json_encode([
                            'data'            => 'waiting_for_approval',
                            'code'            => 403,
                            'system_messages' => ['errors' => l('error_approve_need_wait', 'users')],
                        ]));
                    } else {
                        $ci->system_messages->add_message('error', l('error_approve_need_wait', 'users'));
                        $ci->view->setRedirect(site_url() . 'users/settings');
                    }
                    return;
                } elseif (!$use_approve && $ci->router->method != 'settings') {
                    if ($ci->router->is_api_class) {
                        exit(json_encode([
                            'data'            => 'waiting_for_approval',
                            'code'            => 403,
                            'system_messages' => ['errors' => l('error_approve_need_wait', 'users')],
                        ]));
                    } else {
                        $ci->system_messages->add_message('error', l('error_approve_need_wait', 'users'));
                        $ci->view->setRedirect(site_url() . 'users/logout');
                    }
                }
            }
        }

        return;
    }
}
