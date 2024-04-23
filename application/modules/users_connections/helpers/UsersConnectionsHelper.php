<?php

declare(strict_types=1);

namespace Pg\modules\users_connections\helpers {

    if (!function_exists('showSocialNetworkingLink')) {
        function showSocialNetworkingLink()
        {
            $ci = &get_instance();
            $user_id = $ci->session->userdata('user_id');
            $ci->load->model('social_networking/models/Social_networking_services_model');
            $ci->load->model('users_connections/models/Users_connections_model');
            $services = $ci->Social_networking_services_model
                ->get_services_list(null, ['where' => ['oauth_status' => 1]]);
            $apps = [];
            $unapps = [];
            foreach ($services as $id => $val) {
                $connection = $ci->Users_connections_model->get_connection_by_user_id($val['id'], $user_id);
                if ($connection && isset($connection['id'])) {
                    $unapps[$id] = $val;
                } else {
                    $apps[$id] = $val;
                }
            }
            $ci->view->assign("applications", $apps);
            $ci->view->assign("un_applications", $unapps);
            $ci->view->assign("site_url", site_url());
            $ci->view->assign("TRIAL_MODE", TRIAL_MODE);
            echo $ci->view->fetch("oauth_link", 'user', 'users_connections');
        }
    }

    if (!function_exists('showSocialNetworkingLogin')) {
        function showSocialNetworkingLogin()
        {
            $ci = &get_instance();
            $ci->load->model('social_networking/models/Social_networking_services_model');
            $services = $ci->Social_networking_services_model->get_services_list(null, ['where' => ['oauth_status' => 1]]);
            $ci->view->assign("services", $services);
            $ci->view->assign("site_url", site_url());
            $ci->view->assign("TRIAL_MODE", TRIAL_MODE);
            return $ci->view->fetch('oauth_login', 'user', 'users_connections');
        }
    }

}

namespace {

    if (!function_exists('show_social_networking_link')) {
        function show_social_networking_link()
        {
            return Pg\modules\users_connections\helpers\showSocialNetworkingLink();
        }
    }

    if (!function_exists('show_social_networking_login')) {
        function show_social_networking_login()
        {
            return Pg\modules\users_connections\helpers\showSocialNetworkingLogin();
        }
    }

}
