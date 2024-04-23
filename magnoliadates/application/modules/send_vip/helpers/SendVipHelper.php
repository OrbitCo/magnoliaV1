<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\helpers {

    use Pg\modules\send_vip\models\SendVipModel;

    /**
     * Send_vip module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */

    if (!function_exists('sendVipLink')) {

        function sendVipLink($params)
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
            return $ci->view->fetch('helper_send_vip_link', 'user', 'send_vip');
        }
    }

    if (!function_exists('sendVipBlock')) {
        function sendVipBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model([
                'Send_vip_model','payments/models/Payment_currency_model',
                'access_permissions/models/Access_permissions_settings_model',
                'Users_model','access_permissions/models/Access_permissions_groups_model'
            ]);
            $not_friend = 0;
            $cur_currency = $ci->Payment_currency_model->get_currency_default(true)['gid'];
            $currency = $ci->pg_module->get_module_config('send_vip', 'fee_currency');
            $use_fee = $ci->pg_module->get_module_config('send_vip', 'use_fee');
            $transfer_fee = $ci->pg_module->get_module_config('send_vip', 'fee_price');
            $koef = SendVipModel::getСoefficient(['currency' => $currency, 'transfer_fee' => $transfer_fee]);
            $memberships = $ci->Access_permissions_groups_model->getActivePaidGroups();
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
                $friends_count = $ci->Friendlist_model->getFriendlistCount($ci->session->userdata('user_id'));
                if ($friends_count > 0) {
                    $friends_ids = $ci->Friendlist_model->getFriendlistUsersIds($ci->session->userdata('user_id'));
                    $friends = $ci->Users_model->getUsersList(null, null, null, null, $friends_ids);
                    foreach ($friends as $value) {
                        $friends_names[$value['id']] = [
                            'name' => $value['name'],
                            'user_type' => $value['user_type'],
                        ];
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
            $friends_only = 'to_all';
            if ($ci->pg_module->is_module_installed('friendlist')) {
                $friends_only = $ci->pg_module->get_module_config('send_vip', 'to_whom');
            }

            $access_type = $ci->Access_permissions_settings_model->getSubscriptionType(
                        \Pg\modules\access_permissions\models\AccessPermissionsSettingsModel::TYPE);
            $ci->view->assign('access_type', $access_type);

            $ci->view->assign('not_friend', $not_friend);
            $ci->view->assign('cur_currency', $cur_currency);
            $ci->view->assign('currency', $currency);
            $ci->view->assign('use_fee', $use_fee);
            $ci->view->assign('transfer_fee', $transfer_fee);
            $ci->view->assign('koef', $koef);
            $ci->view->assign('rand', mt_rand(100, 500));
            $ci->view->assign('action', site_url() . "send_vip/confirm/");
            $ci->view->assign('user_id', $ci->session->userdata('user_id'));
            $ci->view->assign('memberships', $memberships);
            $ci->view->assign('memberships_count', $ci->Access_permissions_groups_model->getCountActivePaidGroups());
            $ci->view->assign('friends_only', $friends_only);
            return $ci->view->fetch('helper_send_vip_form', 'user', 'send_vip');
        }
    }

    if (!function_exists('sendVipViewBlock')) {
        function sendVipViewBlock()
        {
            $ci = &get_instance();

            $items_per_page = $ci->pg_module->get_module_config('start', 'items_per_page');

            $ci->load->model([
                'Send_vip_model','Users_model','Access_permissions_model',
                'access_permissions/models/Access_permissions_settings_model',
                'access_permissions/models/Access_permissions_groups_model',
                'payments/models/Payment_currency_model'
            ]);
            $transactions = $ci->Send_vip_model->getTransaction(null, null, $items_per_page);
            $id_user = $ci->session->userdata('user_id');

            foreach ($transactions as $key => $transaction) {
                if ($transaction['id_sender'] != $id_user && $transaction['id_user'] != $id_user) {
                    unset($transactions[$key]);
                } else {
                    $id_users_arr[] = $transaction['id_user'];
                    $id_users_arr[] = $transaction['id_sender'];
                }
            }

            if (!empty($id_users_arr)) {
                $users_arr = $ci->Users_model->getUsersListByKey(null, null, null, null, $id_users_arr);
            }

            if (empty($users_arr)) {
                return [];
            }

            $memberships = $ci->Access_permissions_groups_model->getActivePaidGroups();
            foreach ($transactions as $key => $transaction) {
                $transactions[$key]['transfer_fee'] = $transaction['transfer_fee'];
                $transactions[$key]['name'] = $users_arr[$transaction['id_user']]['output_name'];
                $transactions[$key]['rand'] = mt_rand(0, 10000);
                if ($transaction['id_user'] == $id_user) {
                    $transactions[$key]['comment'] = '<a href="#" data-action="set_user_ids" data-gid="donate" data-href="' . $users_arr[$transaction['id_sender']]['link'] . '">' . $users_arr[$transaction['id_sender']]['output_name'] . '</a> '
                        . l('send_vip_gift_from', 'send_vip') . ' ' . $memberships['short'][$transaction['membership_obj']]['title'];
                } else {
                    $transactions[$key]['comment'] = $memberships['short'][$transaction['membership_obj']]['title']
                        . ' ' . l('send_vip_gift_for', 'send_vip') . ' <a href="#" data-action="set_user_ids" data-gid="donate" data-href="' . $users_arr[$transaction['id_user']]['link'] . '">' . $users_arr[$transaction['id_user']]['output_name'] . '</a>';
                }
                $transactions[$key]['membership_name'] = $memberships['short'][$transaction['membership_obj']]['title'];
                if ($transactions[$key]['id_sender'] == $id_user) {
                    $transactions[$key]['full_amount'] = '-' .
                            ($memberships['full'][$transaction['membership_obj']]['period']['price'] +
                                $transactions[$key]['transfer_fee']);
                }

                if ($transaction['status'] == 'waiting') {
                    $transactions[$key]['declineLink'] = 'send_vip/decline';
                    if ($transaction['id_user'] == $id_user) {
                        $transactions[$key]['approveLink'] = 'send_vip/approve';
                    }
                }
            }

            return $transactions;
        }
    }
}
