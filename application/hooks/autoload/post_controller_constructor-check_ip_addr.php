<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('check_ip_addr')) {
    function check_ip_addr()
    {
        if (INSTALL_MODULE_DONE) {
            $ci = &get_instance();

            $block_modules = ['get_token', 'users'];
            /**
             * TODO
             * remove 'stepByStepRegistration'
             */
            $block_methods = ['index', 'login', 'registration', 'stepByStepRegistration'];
            
            if (file_exists(UPLOAD_DIR . 'ip-addr/list')) {
                $ip_list = file(UPLOAD_DIR . 'ip-addr/list');
                $ip = $ci->input->ip_address();
                if (in_array($ip, $ip_list) && in_array($ci->router->class, $block_modules) && in_array($ci->router->method, $block_methods)) {
                    if ($ci->router->is_api_class) {
                        exit(json_encode([
                            'data' => 'service_required',
                            'code' => 403,
                            'system_messages' => ['errors' => l('error_access_denied', 'users')],
                        ]));
                    } else {
                        $ci->system_messages->addMessage('error', l('error_access_denied', 'users'));
                        $ci->view->setRedirect(site_url());
                    }
                }
            }
        }

        return;
    }
}
