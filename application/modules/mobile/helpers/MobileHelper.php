<?php

declare(strict_types=1);

namespace Pg\modules\mobile\helpers {

    if (!function_exists('mobileAppLinks')) {
        function mobileAppLinks($params)
        {
            $ci = &get_instance();

            $ios_app_link = $ci->pg_module->get_module_config('mobile', 'ios_url');
            $ci->view->assign('ios_url', $ios_app_link);

            $android_app_link = $ci->pg_module->get_module_config('mobile', 'android_url');
            $ci->view->assign('android_url', $android_app_link);
            
            if (isset($params['viewtype'])) {
                $viewtype = $params['viewtype'];
            } else {
                $viewtype = "";
            }
            
            $ci->view->assign('params', $params);
    
            switch ($viewtype) {
                case 'btnsBlack':
                    return $ci->view->fetch('helper_app_btns_black', 'user', 'mobile');
                    break;
                case 'ghostWhite':
                    return $ci->view->fetch('helper_app_ghost_white', 'user', 'mobile');
                    break;
                case 'ghostBlack':
                    return $ci->view->fetch('helper_app_ghost_black', 'user', 'mobile');
                    break;
                case 'links':
                    return $ci->view->fetch('helper_app_links', 'user', 'mobile');
                    break;
                default:
                    return $ci->view->fetch('helper_app_btns_black', 'user', 'mobile');
            }
        }
    }

    if (!function_exists('mobileVersion')) {
        function mobileVersion()
        {
            $ci = &get_instance();
            $ci->view->assign("site_url", $ci->config->site_url());

            return $ci->view->fetch('helper_mobile_link', 'user', 'mobile');
        }
    }
    if (!function_exists('appTopBanner')) {
        function appTopBanner()
        {
            $ci = &get_instance();
            $ci->load->library('user_agent');
            $url = '';
            $devices = ['iPhone' => 'ios', 'iPad' => 'ios', 'Android' => 'android'];
            foreach ($devices as $device => $os) {
                if (stripos($ci->agent->agent_string(), $device) !== false) {
                    $url = $os . '_url';
                }
            }
            if (!empty($url)) {
                $app_link = $ci->pg_module->get_module_config('mobile', $url);
                if (!empty($app_link)) {
                    $ci->view->assign('app_' . $url, $app_link);
                    return $ci->view->fetch('helper_top_banner', 'user', 'mobile');
                }
            }
        }
    }

    if (!function_exists('pushNotifications')) {
        function pushNotifications()
        {
            $ci = &get_instance();
            if ($ci->session->userdata("auth_type") === "user") {
                //if (empty($ci->session->userdata('mobile_settings'))) {
                    $ci->load->model('Mobile_model');
                    $ci->session->set_userdata('mobile_settings', $ci->Mobile_model->getSettings());
                //}
                $settings = $ci->session->userdata('mobile_settings');
                $ci->view->assign('mobile_settings', $settings);
                return $ci->view->fetch('helper_firebase', 'user', 'mobile');
            }
        }
    }
}

namespace {

    if (!function_exists('mobile_app_links')) {
        function mobile_app_links($params = [])
        {
            return Pg\modules\mobile\helpers\mobileAppLinks($params);
        }
    }

    if (!function_exists('mobileVersion')) {
        function mobileVersion()
        {
            return Pg\modules\mobile\helpers\mobileVersion();
        }
    }
    if (!function_exists('appTopBanner')) {
        function appTopBanner()
        {
            return Pg\modules\mobile\helpers\appTopBanner();
        }
    }
    if (!function_exists('pushNotifications')) {
        function pushNotifications()
        {
            return Pg\modules\mobile\helpers\pushNotifications();
        }
    }
}
