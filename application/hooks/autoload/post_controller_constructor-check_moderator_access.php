<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('check_moderator_access')) {
    function check_moderator_access()
    {
        if (INSTALL_MODULE_DONE) {
            $CI = &get_instance();

            $controller = $CI->router->fetch_class(true);
            if (substr($controller, 0, 6) != "admin_") {
                return;
            }

            $auth_type = $CI->session->userdata("auth_type");
            if ($auth_type != "admin") {
                return;
            }

            $user_type = $CI->session->userdata("user_type");
            if ($user_type != "moderator") {
                return;
            }

            $module = $CI->router->fetch_class();
            if ($module == "start") {
                return;
            }

            $method = $CI->router->fetch_method();

            if (($module == 'ausers' || $module == 'moderators') && $method == 'logoff') {
                return;
            }

            $CI->load->model('Moderators_model');
            $methods = $CI->Moderators_model->get_module_methods($module);
            $methods_cnt = count($methods);
            
            $permission_data = $CI->session->userdata("permission_data");
            
            if (is_array($methods) && $methods_cnt > 0) {
                if ($methods_cnt == 1) {
                    if (!isset($permission_data[$module])) {
                        $url = site_url() . "admin/start/error/moderator";
                        redirect($url);
                    }
                    /**
                     * Moderators access sets for the whole module, so, don't matter, what $method is it
                     */
                    if (intval(end($permission_data[$module])) != 1) {
                        $url = site_url() . "admin/start/error/moderator";
                        redirect($url);
                    } else {
                        return;
                    }
                } else {
                    /**
                     * If access for this method of the module is not tunable for the
                     * moderators, so moderator have access
                     */
                    if (!in_array($method, $methods)) {
                        if (!isset($permission_data[$module])) {
                            //no access to the at least one method of the module
                            $url = site_url() . "admin/start/error/moderator";
                            redirect($url);
                        }
                        return;
                    }
                }
            }
            if (!isset($permission_data[$module][$method]) || $permission_data[$module][$method] != 1) {
                $url = site_url() . "admin/start/error/moderator";
                redirect($url);
            }
        }

        return;
    }
}
