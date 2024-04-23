<?php

declare(strict_types=1);

namespace Pg\modules\services\helpers {
    
    if (!function_exists('servicesBuyList')) {
        function servicesBuyList($params = [])
        {
            $service_additional_settings = [
                'users_featured' => [
                  'icon_inactive' => 'ic-featured-gray.png',
                  'icon_active' => 'ic-featured.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_users_featured/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_users_featured/',
                ],
                'admin_approve' => [
                  'icon_inactive' => 'ic-approval-gray.png',
                  'icon_active' => 'ic-approval.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_admin_approve/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_admin_approve/',
                ],
                'hide_on_site' => [
                  'icon_inactive' => 'ic-stealth-gray.png',
                  'icon_active' => 'ic-stealth.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_hide_on_site/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_hide_on_site/',
                ],
                'highlight_in_search' => [
                  'icon_inactive' => 'ic-highlight-gray.png',
                  'icon_active' => 'ic-highlight.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_highlight_in_search/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_highlight_in_search/',
                ],
                'up_in_search' => [
                  'icon_inactive' => 'ic-liftup-gray.png',
                  'icon_active' => 'ic-liftup.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_up_in_search/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_up_in_search/',
                ],
                'user_activate_in_search' => [
                  'icon_inactive' => 'ic-activity-in-search-gray.png',
                  'icon_active' => 'ic-activity-in-search.png',
                  'checkAvailableAjaxUrl' => 'users/ajax_available_user_activate_in_search/',
                  'buyAbilityAjaxUrl' => 'users/ajax_activate_user_activate_in_search/',
                ],
            ];
            
            $ci = &get_instance();
            $ci->load->model(['Services_model', 'services/models/Services_users_model']);
            $where = [
                'where' => [
                    'type' => 'tariff',
                    'status' => 1
                ]
            ];
            if (!empty($params['template_gid'])) {
                $where['where']['template_gid'] = $params['template_gid'];
            }
            $services = $ci->Services_model->getServiceList($where);
            $user_id = $ci->session->userdata("user_id");
            $services_my = $ci->Services_users_model->get_services_list([
                 'where_sql' => ["id_user = {$user_id} AND (id_users_membership = '0' AND (id_users_package = '0' OR status = '0'))"]
             ], null, null, '', false);
            $services_modules = [];
            foreach ($services as $key => $service) {
                $services[$key]['additional_settings'] = isset($service_additional_settings[$service['gid']]) ? $service_additional_settings[$service['gid']] : null;
                $services[$key]['tpl_gid'] = $service['gid'] . '_' . rand(100000, 999999);
                if ($service['template']['price_type'] > 2) {
                    unset($services[$key]);
                } else {
                    $model = strtolower($service['template']['callback_model']);
                    $services_modules[$service['template']['callback_module']][$model] = ucfirst($model);
                    foreach ($services_my as $service_my) {
                        if ($service['gid'] == $service_my['service_gid']) {
                            foreach ($service_my['service']['template']['data_admin_array'] as $setting_gid => $setting_options) {
                                if ($setting_gid != 'period') {
                                    $services[$key]['service_user_data']['count'][$setting_gid] = $service_my['service']['data_admin_array'][$setting_gid];
                                    if ($setting_options > 0) {
                                        $service_my['is_expired'] = 0;
                                    }
                                }
                            }
                            if ($service_my['is_expired'] === false) {
                                //unset($services[$key]['service_user_data']);
                                if ($service_my['date_expired'] === \Pg\modules\services\models\ServicesModel::DB_DEFAULT_DATE) {
                                    $services[$key]['service_user_data']['is_expired'] = 0;
                                }
                            } else {
                                $services[$key]['service_user_data']['is_expired'] = $service_my['is_expired'];
                                /**
                                 * Get the last date from the list of buyed services with one service_gid
                                 */
                                if (isset($services[$key]['service_user_data']['date_expired'])) {
                                    if ($services[$key]['service_user_data']['date_expired'] < $service_my['date_expired']) {
                                        $services[$key]['service_user_data']['date_expired'] = $service_my['date_expired'];
                                    }
                                } else {
                                    $services[$key]['service_user_data']['date_expired'] = $service_my['date_expired'];
                                }
                            }
                            if ($service_my['status'] == 1) {
                                $services[$key]['service_user_data']['activate'] =
                                    site_url() . "services/user_service_activate/{$user_id}/{$service_my['id']}/{$service['gid']}";
                            }
                        }
                    }
                }
            }
            $date_formats = [
                'date_format' => $ci->pg_date->get_format('date_literal', 'st'),
                'date_time_format' => $ci->pg_date->get_format('date_time_literal', 'st'),
            ];
            $ci->view->assign('user_id', $user_id);
            $ci->view->assign('services_block_services', $services);
            $ci->view->assign('services_block_date_formats', $date_formats);
            
            if (!empty($params['tpl'])) {
                return $ci->view->fetch('helper_services_buy_list_' . $params['tpl'], 'user', 'services');
            } else {
                return $ci->view->fetch('helper_services_buy_list', 'user', 'services');
            }
        }
    }
    
    if (!function_exists('serviceBuyForm')) {
        function serviceBuyForm($params)
        {
            $ci = &get_instance();
            $ci->load->model('Services_model');
            $ci->load->model('services/models/Services_users_model');

            $where['where']['type'] = 'tariff';
            $where['where']['status'] = 1;

            if (!empty($params['template_gid'])) {
                $where['where']['template_gid'] = $params['template_gid'];
            }

            $services = $ci->Services_model->get_service_list($where);

            $user_id = $ci->session->userdata("user_id");

            $ci->view->assign('user_id', $user_id);
            $ci->view->assign('services_block_services', $services);

            $date_formats = [
                'date_format'      => $ci->pg_date->get_format('date_literal', 'st'),
                'date_time_format' => $ci->pg_date->get_format('date_time_literal', 'st'),
            ];
            $ci->view->assign('services_block_date_formats', $date_formats);

            return $ci->view->fetch('helper_service_buy_form', 'user', 'services');
        }
    }

    if (!function_exists('userServicesList')) {
        function userServicesList($params)
        {
            $ci = &get_instance();
            $ci->load->model('services/models/Services_users_model');

            if (empty($params['id_user'])) {
                if ($ci->session->userdata('auth_type') == 'user') {
                    $params['id_user'] = $ci->session->userdata('user_id');
                } else {
                    return '';
                }
            }

            $order_by = [
                'status' => 'DESC',
                'count' => 'DESC',
                'date_created' => 'DESC',
            ];
            $where = [
                'where_sql' => ["id_user = {$params['id_user']} AND (id_users_membership = '0' AND (id_users_package = '0' OR status = '0'))"]
            ];
            if (!empty($params['template_gid'])) {
                $where['where']['template_gid'] = $params['template_gid'];
            }

            $services = $ci->Services_users_model->getServicesList($where, $order_by);
            $ci->view->assign('services_block_services', $services);
            $date_formats = [
                'date_format'      => $ci->pg_date->get_format('date_literal', 'st'),
                'date_time_format' => $ci->pg_date->get_format('date_time_literal', 'st'),
            ];
            $ci->view->assign('services_block_date_formats', $date_formats);

            return $ci->view->fetch('helper_user_services_list', 'user', 'services');
        }
    }

    if (!function_exists('serviceForm')) {
        function serviceForm($params)
        {
            $ci = &get_instance();
            if (empty($params['gid'])) {
                log_message('error', '(services) Empty $params["gid"]');
                show_404();

                return;
            }
            $ci->load->model('Services_model');
            $user_id = $ci->session->userdata("user_id");
            $ci->load->model('users/models/Auth_model');
            $ci->Auth_model->update_user_session_data($user_id);
            $data = $ci->Services_model->format_service($ci->Services_model->get_service_by_gid($params['gid']));
            if ($data["template"]["price_type"] == "2" || $data["template"]["price_type"] == "3") {
                $data["price"] = $ci->input->post('price', true);
            }
            if (!empty($data["template"]["data_user_array"])) {
                foreach ($data["template"]["data_user_array"] as $gid => $temp) {
                    $value = "";
                    if ($temp["type"] == "hidden") {
                        $value = $ci->input->get_post($gid, true);
                    }
                    if (isset($user_form_data[$gid])) {
                        $value = $user_form_data[$gid];
                    }
                    $data["template"]["data_user_array"][$gid]["value"] = $value;
                }
            }
            //// get payments types
            $data["free_activate"] = false;
            if ($data["price"] <= 0) {
                $data["free_activate"] = true;
            }
            if ($data["pay_type"] == 1 || $data["pay_type"] == 2) {
                $ci->load->model("Users_payments_model");
                $data["user_account"] = $ci->Users_payments_model->get_user_account($user_id);
                if ($data["user_account"] <= 0 && $data["price"] > 0) {
                    $data["disable_account_pay"] = true;
                } elseif (($data["template"]["price_type"] == 1 || $data["template"]["price_type"] == 3) && $data["price"] > $data["user_account"]) {
                    $data["disable_account_pay"] = true;
                }
            }
            if ($data["pay_type"] == 2 || $data["pay_type"] == 3) {
                $ci->load->model("payments/models/Payment_systems_model");
                $billing_systems = $ci->Payment_systems_model->get_active_system_list();
                $ci->view->assign('billing_systems', $billing_systems);
            }
            $ci->view->assign('is_module_installed', $ci->pg_module->is_module_installed('users_payments'));
            $ci->view->assign('data', $data);

            return $ci->view->fetch('helper_service_form', 'user', 'services');
        }
    }

    if (!function_exists('servicesGetMenu')) {
        function servicesGetMenu()
        {
            $ci = &get_instance();

            if ('user' != $ci->session->userdata('auth_type')) {
                return false;
            }

            $ci->load->model('services/models/Services_users_model');
            $user_services = $ci->Services_users_model->getUserServices(
                $ci->session->userdata('user_id'),
                $ci->session->userdata('lang_id'),
                true);
            $ci->view->assign('user_services', $user_services);

            return $ci->view->fetch('helper_services_menu', 'user', 'services');
        }
    }

}

namespace {

    if (!function_exists('services_buy_list')) {
        function services_buy_list($params = [])
        {
            return Pg\modules\services\helpers\servicesBuyList($params);
        }
    }

    if (!function_exists('user_services_list')) {
        function user_services_list($params)
        {
            return Pg\modules\services\helpers\userServicesList($params);
        }
    }

    if (!function_exists('service_form')) {
        function service_form($params)
        {
            return Pg\modules\services\helpers\serviceForm($params);
        }
    }

    if (!function_exists('services_get_menu')) {
        function services_get_menu()
        {
            return Pg\modules\services\helpers\servicesGetMenu();
        }
    }

}
