<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('mobile_detect')) {
    function mobile_detect()
    {
        if (!INSTALL_MODULE_DONE) {
            return false;
        }
        $ci = &get_instance();
        $ci->load->helper('cookie');

        $mobile_detect = filter_input(INPUT_GET, 'mobile_detect');
        if (empty($mobile_detect)) {
            $mobile_detect = filter_input(INPUT_COOKIE, 'mobile_detect');
        } elseif ('denied' === $mobile_detect) {
            // Back from the mobapp
            set_cookie([
                'name'   => 'mobile_detect',
                'value'  => 'denied',
                'expire' => time() + '86500',
                'domain' => COOKIE_SITE_SERVER,
                'path'   => '/' . SITE_SUBFOLDER
            ]);

            return false;
        }

        if ('denied' === $mobile_detect || !$ci->pg_module->is_module_installed('mobile') || $ci->router->is_api_class || !$ci->pg_module->get_module_config('mobile', 'use_mobile_detect')) {
            return false;
        } else {
            if ((new \Detection\MobileDetect())->isMobile()) {
                set_cookie([
                    'name'   => 'mobile_detect',
                    'value'  => 'ask',
                    'expire' => time() + '86500',
                    'domain' => COOKIE_SITE_SERVER,
                    'path'   => '/' . SITE_SUBFOLDER,
                ]);
                redirect($ci->pg_module->get_module_config('mobile', 'app_url') . '/#!/redirect');
            }

            return true;
        }
    }
}
