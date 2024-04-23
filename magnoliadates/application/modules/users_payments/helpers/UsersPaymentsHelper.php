<?php

declare(strict_types=1);

namespace Pg\modules\users_payments\helpers {

    if (!function_exists('updateAccountBlock')) {
        function updateAccountBlock($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_systems_model');

            $billing_systems = $ci->Payment_systems_model->get_active_system_list();
            $ci->view->assign('billing_systems', $billing_systems);

            $ci->load->model('payments/models/Payment_currency_model');
            $base_currency = $ci->Payment_currency_model->get_currency_default(true);
            $ci->view->assign('base_currency', $base_currency);
            $ci->view->assign('params', $params);
            $ci->view->assign('is_ajax', $ci->input->is_ajax_request());
            

            return $ci->view->fetch('helper_update_account', 'user', 'users_payments');
        }
    }

    if (!function_exists('addFundsButton')) {
        function buttonAddFunds($params = [])
        {
            $ci = &get_instance();

            $ci->load->model('payments/models/Payment_currency_model');
            $base_currency = $ci->Payment_currency_model->get_currency_default(true);

            if (isset($params['id_user'])) {
                $ci->view->assign('id_user', $params['id_user']);
            }
            $ci->view->assign('base_currency', $base_currency);

            return $ci->view->fetch('helper_add_funds', 'admin', 'users_payments');
        }
    }

    if (!function_exists('userAccount')) {
        function userAccount()
        {
            $ci = &get_instance();

            if ('user' != $ci->session->userdata('auth_type')) {
                return false;
            }

            $user_id = $ci->session->userdata('user_id');

            $ci->load->model('Users_payments_model');
            $ci->view->assign('user_account', $ci->Users_payments_model->get_user_account($user_id));

            $ci->load->model('payments/models/Payment_currency_model');
            $ci->view->assign('base_currency', $ci->Payment_currency_model->get_currency_default(true));

            if ($ci->pg_module->is_module_installed('services')) {
                $ci->load->model('services/models/Services_users_model');
                $user_services = $ci->Services_users_model->getUserServices($user_id, $ci->session->userdata('lang_id'));
                $ci->view->assign('user_services', $user_services);
            }

            if ($ci->pg_module->is_module_installed('memberships')) {
                $ci->load->model('memberships/models/Memberships_users_model');
                $user_memberships = $ci->Memberships_users_model->getUserMemberships($user_id);
                $ci->view->assign('user_memberships', $user_memberships);
            }

            return $ci->view->fetch('helper_account', 'user', 'users_payments');
        }
    }

    if (!function_exists('getUserAccount')) {
        function getUserAccount($params)
        {
            $ci = &get_instance();
            $id_user = (int) $params['id_user'];
            $ci->load->model(['payments/models/Payment_currency_model','Users_payments_model']);
            $user_account = $ci->Users_payments_model->getUserAccount($id_user);
            $base_currency = $ci->Payment_currency_model->getCurrencyDefault(true);
            return $user_account.$base_currency['abbr'];
        }
    }

}

namespace {

    if (!function_exists('update_account_block')) {
        function update_account_block()
        {
            return Pg\modules\users_payments\helpers\updateAccountBlock();
        }
    }

    if (!function_exists('add_funds_button')) {
        function button_add_funds()
        {
            return Pg\modules\users_payments\helpers\buttonAddFunds();
        }
    }

    if (!function_exists('user_account')) {
        function user_account()
        {
            return Pg\modules\users_payments\helpers\userAccount();
        }
    }

    if (!function_exists('getUserAccount')) {
        function getUserAccount()
        {
            return Pg\modules\users_payments\helpers\getUserAccount();
        }
    }

}
