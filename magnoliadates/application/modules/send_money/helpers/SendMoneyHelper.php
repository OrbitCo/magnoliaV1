<?php

declare(strict_types=1);

namespace Pg\modules\send_money\helpers {

    /**
     * Send_money module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    if (!function_exists('sendMoneyLink')) {
        function sendMoneyLink($params)
        {
            $ci = &get_instance();
            if ($ci->session->userdata('auth_type') == 'user') {
                $user_id = $ci->session->userdata('user_id');
                if ($params['id_user'] == $user_id) {
                    return false;
                }
                $ci->view->assign('user_id', $params['id_user']);
            }
            $ci->view->assign('rand', mt_rand(100, 500));

            if (isset($params['view_type'])) {
                $ci->view->assign('view_type', $params['view_type']);
            } else {
                $ci->view->assign('view_type', 0);
            }

            return $ci->view->fetch('helper_send_money_link', 'user', 'send_money');
        }
    }

    if (!function_exists('sendMoneyBlock')) {
        function sendMoneyBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model([
                'Send_money_model', 'Users_model',
                'payments/models/Payment_currency_model'
             ]);
            $not_friend = 0;
            $base_currency = $ci->Payment_currency_model->get_currency_default(true);
            $cur_currency  = $base_currency['gid'];
            $currency = $ci->pg_module->get_module_config('send_money', 'fee_currency');
            $use_fee = $ci->pg_module->get_module_config('send_money', 'use_fee');
            $transfer_fee  = $ci->pg_module->get_module_config('send_money', 'fee_price');
            if ($currency == '%') {
                $koef = (float) $transfer_fee / 100; //ToDo: May be $koef need store in config table?
            } else {
                $koef = 1;
            }
            $friends_only = 'to_all';
            if ($ci->pg_module->is_module_installed('friendlist')) {
                $friends_only = $ci->pg_module->get_module_config('send_money', 'to_whom');
            }
            if ($ci->pg_module->is_module_installed('friendlist')) {
                $ci->load->model('Friendlist_model');
                if (isset($params['user_id'])) {
                    $is_friend = $ci->Friendlist_model->isFriend($ci->session->userdata('user_id'), $params['user_id']);
                    if (!$is_friend) {
                        $not_friend = 1;
                    }
                    $user_selected = $ci->Users_model->getUserById($params['user_id']);
                    $ci->view->assign('user_selected', $user_selected);
                }
                $friends_count = $ci->Friendlist_model->get_friendlist_count($ci->session->userdata('user_id'));
                if ($friends_count > 0) {
                    $friends_ids   = $ci->Friendlist_model->get_friendlist_users_ids($ci->session->userdata('user_id'));
                    $friends = $ci->Users_model->getUsersList(null, null, null, null, $friends_ids);
                    foreach ($friends as $value) {
                        $friends_names[$value['id']] = $value['name'];
                    }
                    $ci->view->assign('friends_list', $friends_names);
                    $ci->view->assign('friends_count', $friends_count);
                }
            } else {
                if (isset($params['user_id'])) {
                    $user_selected = $ci->Users_model->getUserById($params['user_id']);
                    $ci->view->assign('user_selected', $user_selected);
                }
            }

            $action = site_url() . "send_money/confirm/";

            $ci->view->assign('not_friend', $not_friend);
            $ci->view->assign('cur_currency', $cur_currency);
            $ci->view->assign('currency', $currency);
            $ci->view->assign('use_fee', $use_fee);
            $ci->view->assign('transfer_fee', $transfer_fee);
            $ci->view->assign('koef', $koef);
            $ci->view->assign('rand', mt_rand(100, 500));
            $ci->view->assign('action', $action);
            $ci->view->assign('friends_only', $friends_only);
            $ci->view->assign('user_id', $ci->session->userdata('user_id'));
            $success = $ci->session->userdata('send_money_msg');
            if ($success) {
                $success_txt = l('send_money_transaction_saved', 'send_money');
                $ci->view->assign('send_money_success', $success_txt);
                $ci->session->unset_userdata('send_money_msg');
            }

            return $ci->view->fetch('helper_send_money_form', 'user', 'send_money');
        }
    }

    if (!function_exists('sendMoneyViewBlock')) {
        function sendMoneyViewBlock()
        {
            $ci           = &get_instance();

            $items_per_page = $ci->pg_module->get_module_config('start', 'items_per_page');

            $ci->load->model('Send_money_model');
            $ci->load->model('Users_model');
            $ci->load->model('payments/models/Payment_currency_model');
            $transactions = $ci->Send_money_model->getTransaction(null, null, $items_per_page);
            $id_user      = $ci->session->userdata('user_id');

            foreach ($transactions as $key => $transaction) {
                if ($transaction['id_sender'] != $id_user && $transaction['id_user'] != $id_user) {
                    unset($transactions[$key]);
                } else {
                    $id_users_arr[] = $transaction['id_user'];
                    $id_users_arr[] = $transaction['id_sender'];
                }
            }

            if (!empty($id_users_arr)) {
                $users_arr = $ci->Users_model->getUsersListByKey(
                    null,
                    null,
                    null,
                    null,
                    $id_users_arr
                );
            }
            if (empty($users_arr)) {
                return [];
            }

            foreach ($transactions as $key => $transaction) {
                if ($transactions[$key]['id_sender'] == $id_user) {
                    $transactions[$key]['amount']      = '-' . $transactions[$key]['amount'];
                    $transactions[$key]['full_amount'] = '-' . $transactions[$key]['full_amount'];
                }
                $transactions[$key]['amount']       = number_format(
                    (float)$transactions[$key]['amount'],
                    2,
                    '.',
                    ''
                );
                $transactions[$key]['transfer_fee'] = $transaction['full_amount'] - $transaction['amount'];
                if ($transaction['id_user'] == $id_user) {
                    $transactions[$key]['comment'] = l(
                        'send_money_gift_from',
                        'send_money'
                    ) .
                        ' <a href="#" data-action="set_user_ids" data-gid="donate" data-href="' . $users_arr[$transaction['id_sender']]['link'] . '">' . $users_arr[$transaction['id_sender']]['output_name'] . '</a>';
                } else {
                    $transactions[$key]['comment'] = l(
                        'send_money_gift_for',
                        'send_money'
                    ) .  ' <a href="#" data-action="set_user_ids" data-gid="donate" data-href="' . $users_arr[$transaction['id_user']]['link'] . '">' . $users_arr[$transaction['id_user']]['output_name'] . '</a>';
                }
                $transactions[$key]['rand'] = mt_rand(0, 10000);

                if ($transaction['status'] == 'waiting') {
                    $transactions[$key]['declineLink'] = 'send_money/decline';
                    if ($transaction['id_user'] == $id_user) {
                        $transactions[$key]['approveLink'] = 'send_money/approve';
                    }
                }
            }

            return $transactions;
        }
    }
}
