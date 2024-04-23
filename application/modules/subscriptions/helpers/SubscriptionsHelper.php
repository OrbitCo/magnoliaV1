<?php

declare(strict_types=1);

namespace Pg\modules\subscriptions\helpers {

    if (!function_exists('getUserSubscriptionsForm')) {
        function getUserSubscriptionsForm($place)
        {
            $ci = &get_instance();
            $ci->load->model(['Subscriptions_model', 'subscriptions/models/Subscriptions_users_model']);
            $subscriptions_list = $ci->Subscriptions_model->
                getSubscriptionsList(null, null, null, ['where' => ['subscribe_type' => 'user']]);
            if (empty($subscriptions_list)) {
                return '';
            }
            $user_subscription = [];
            if (isset($_REQUEST['user_subscriptions_list'])) {
                $user_s = $_REQUEST['user_subscriptions_list'];
                foreach ($user_s as $key => $value) {
                    $user_subscription[$value]  = 1;
                }
            } else {
                $user_id = $ci->session->userdata('user_id');
                if ($user_id) {
                    $user_subscription = $ci->Subscriptions_users_model->getSubscriptionsByIdUser($user_id);
                }
            }
            foreach ($subscriptions_list as $key => $subcription) {
                if (isset($user_subscription[$subcription['id']])) {
                    $subscriptions_list[$key]['subscribed'] = 1;
                }
            }
            $ci->view->assign('subscriptions_list', $subscriptions_list);
            $html = $ci->view->fetch('helper_form_' . $place, 'user', 'subscriptions');
            return $html;
        }
    }
    if (!function_exists('getUserSubscriptionsList')) {
        function getUserSubscriptionsList()
        {
            $ci = &get_instance();
            $ci->load->model('Subscriptions_model');
            $ci->load->model('subscriptions/models/Subscriptions_users_model');

            $subscriptions_list = $ci->Subscriptions_model->get_subscriptions_list(null, null, null, ['where' => ['subscribe_type' => 'user']]);
            $user_id = $ci->session->userdata('user_id');
            if ($user_id) {
                $user_subscription = $ci->Subscriptions_users_model->get_subscriptions_by_id_user($user_id);

                foreach ($subscriptions_list as $key => $subcription) {
                    if (isset($user_subscription[$subcription['id']])) {
                        $subscriptions_list[$key]['subscribed'] = 1;
                    }
                }
            }

            $ci->view->assign('subscriptions_list', $subscriptions_list);
            $html = $ci->view->fetch('user_subscription_list', 'user', 'subscriptions');

            return $html;
        }
    }

}

namespace {

    if (!function_exists('get_user_subscriptions_form')) {
        function get_user_subscriptions_form($place)
        {
            return Pg\modules\subscriptions\helpers\getUserSubscriptionsForm($place);
        }
    }
    if (!function_exists('get_user_subscriptions_list')) {
        function get_user_subscriptions_list()
        {
            return Pg\modules\subscriptions\helpers\getUserSubscriptionsList();
        }
    }

}
