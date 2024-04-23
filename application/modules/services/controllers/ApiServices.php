<?php

declare(strict_types=1);

namespace Pg\modules\services\controllers;

/**
 * Services api controller.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiServices extends \Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Services_model');
    }

    /**
     * @api {post} /services/form Service form
     * @apiGroup Services
     * @apiParam {string} [service_gid] service gid
     * @apiParam {int} [price] price
     * @apiParam {string} [payment_type] payment type
     * @apiParam {array} [data_user] user data
     * @apiParam {boolean} activate_immediately  activate immediately or later
     */
    public function form()
    {
        $user_id = $this->session->userdata('user_id');
        $service_gid = filter_input(INPUT_POST, 'service_gid');

        $this->load->model('users/models/Auth_model');
        $this->Auth_model->update_user_session_data($user_id);

        $data = $this->Services_model->get_service_by_gid($service_gid);

        if (!$data['status']) {
            log_message('error', 'services API: Wrong service status');
            $this->set_api_content('errors', l('error_service_code_incorrect', 'services'));

            return false;
        }
        $format_service = $this->Services_model->format_service([$data]);
        $data = array_shift($format_service);
        $data['template'] = $this->Services_model->format_template($data['template']);

        if (!empty($data['data_admin_array'])) {
            foreach ($data['template']['data_admin_array'] as $gid => $temp) {
                if (!empty($data['data_admin_array'][$gid])) {
                    $data['template']['data_admin_array'][$gid]['value'] = $data['data_admin_array'][$gid];
                }
            }
        }

        if ($data['template']['price_type'] == '2' || $data['template']['price_type'] == '3') {
            $data['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        }
        $errors = [];
        $messages = [];
        $type = filter_input(INPUT_POST, 'payment_type', FILTER_SANITIZE_STRING);
        $user_form_data = filter_input(INPUT_POST, 'data_user', FILTER_REQUIRE_ARRAY);
        if ($type) {
            $service_return = $this->Services_model->validate_service_payment($data['id'], $user_form_data, $data['price']);
            if (!empty($service_return['errors'])) {
                $errors[] = $service_return['errors'];
            } else {
                $origin_return = $this->Services_model->validate_service_original_model($data['id'], $user_form_data, $user_id, $data['price']);
                if (!empty($origin_return['errors'])) {
                    $errors[] = $origin_return['errors'];
                } else {
                    $activate_immediately = filter_input(INPUT_POST, 'activate_immediately', FILTER_VALIDATE_BOOLEAN);
                    if ('account' === $type) {
                        $payment = $this->Services_model->accountPayment($data, $user_id, $user_form_data, $activate_immediately, true);
                        if ($payment !== true) {
                            $errors[] = $payment;
                        } else {
                            $messages[] = l('success_services_apply', 'services');
                            $this->load->model('users/models/Auth_model');
                            $this->Auth_model->update_user_session_data($user_id);
                        }
                        $this->set_api_content('data', $data);
                        $this->set_api_content('errors', $errors);
                        $this->set_api_content('messages', $messages);

                        return true;
                    }
                }
            }
        }

        if (!empty($data['template']['data_user_array'])) {
            foreach ($data['template']['data_user_array'] as $gid => $temp) {
                $value = '';
                if ($temp['type'] == 'hidden') {
                    $value = filter_input(INPUT_POST, $gid);
                } elseif (isset($user_form_data[$gid])) {
                    $value = $user_form_data[$gid];
                }
                $data['template']['data_user_array'][$gid]['value'] = $value;
            }
        }

        // get payments types
        $data['free_activate'] = false;
        if ($data['price'] <= 0) {
            $data['free_activate'] = true;
        }
        if ($data['pay_type'] == 1 || $data['pay_type'] == 2) {
            $this->load->model('Users_payments_model');
            $data['user_account'] = $this->Users_payments_model->get_user_account($user_id);
            if ($data['user_account'] <= 0 && $data['price'] > 0) {
                $data['disable_account_pay'] = true;
            } elseif (($data['template']['price_type'] == 1 || $data['template']['price_type'] == 3) && $data['price'] > $data['user_account']) {
                $data['disable_account_pay'] = true;
            }
        }
        if ($data['pay_type'] == 2 || $data['pay_type'] == 3) {
            $this->load->model('payments/models/Payment_systems_model');
            $billing_systems = $this->Payment_systems_model->get_active_system_list();
            $data['billing_systems'] = $billing_systems;
        }
        $data['is_module_installed'] = $this->pg_module->is_module_installed('users_payments');
        $this->set_api_content('data', $data);
        $this->set_api_content('errors', $errors);
        $this->set_api_content('messages', $messages);
    }

    /**
     * @api {post} /services/buyList Services list
     * @apiGroup Services
     * @apiParam {int} [lang_id] language id
     */
    public function buyList()
    {
        $this->load->model(['Services_model', 'Users_model']);
        $lang_id = filter_input(INPUT_POST, 'lang_id', FILTER_VALIDATE_INT) ?? $this->pg_language->current_lang_id;
        $services = $this->Services_model->getServiceList(['where' => ['status' => 1]], null, null, $lang_id);
        $services = $this->formatService($services);

        $user_id = $this->session->userdata('user_id');
        $this->load->model('services/models/Services_users_model');
        $user_services = $this->Services_users_model->getUserServices($user_id, $lang_id, 2);
        foreach ($services as $key => $service) {
            if ($service['gid'] == 'admin_approve') {
                $user = $this->Users_model->getUserById($user_id);
                if (!empty($user['approved'])) {
                    unset($services[$key]);
                    continue;
                }
            }

            if (array_key_exists($service['gid'], $user_services)) {
                $services[$key]['id_user_service'] = $user_services[$service['gid']]['id'];
                $services[$key]['is_purchased'] = $user_services[$service['gid']]['is_active'] ? '0' : '1';
                $services[$key]['is_active'] = $user_services[$service['gid']]['is_active'];
                $expires = strtotime($user_services[$service['gid']]['date_expires']);
                if ($expires > 0) {
                    $services[$key]['date_expires'] = date('Y-m-d', $expires);
                } else {
                    $services[$key]['date_expires'] = '';
                }
            } else {
                $services[$key]['is_purchased'] = '0';
            }
        }

        $this->set_api_content('data', array_values($services));
    }

    /**
     * @api {post} /services/buyList Get service by gid
     * @apiGroup Services
     * @apiParam {string} gid service gid
     */
    public function get()
    {
        $gid = filter_input(INPUT_POST, 'gid');
        if (!$gid) {
            $this->set_api_content('errors', ['Empty service gid']);

            return false;
        }
        $this->load->model('Services_model');
        $service = $this->Services_model->getServiceList(['where' => ['gid' => $gid]], null, null);

        $service = $this->formatService($service);
        if (count($service)) {
            $service = array_shift($service);
        }
        $this->set_api_content('data', $service);
    }

    /**
     * @api {post} /services/my My services
     * @apiGroup Services
     * @apiParam {int} lang_id language id
     */
    public function my()
    {
        $user_id = $this->session->userdata('user_id');
        $lang_id = filter_input(INPUT_POST, 'lang_id', FILTER_VALIDATE_INT) ?? $this->pg_language->current_lang_id;
        $this->load->model('services/models/Services_users_model');
        $order_by = [
            'status' => 'DESC',
            'count' => 'DESC',
            'date_created' => 'DESC',
        ];
        $where = ['where_sql' => [
            "id_user = $user_id AND (id_users_package = '0' OR status = '0')",
        ]];
        $services = $this->Services_users_model->getServicesList($where, $order_by, null, $lang_id);
        $this->set_api_content('data', $services);
    }

    /**
     * @api {post} /services/userServiceActivate Activate user service
     * @apiGroup Services
     * @apiParam {int} id_user_service user id
     * @apiParam {string} gid service gid
     */
    public function userServiceActivate()
    {
        $id_user = $this->session->userdata('user_id');
        if (!$id_user) {
            $this->set_api_content('errors', l('error_service_activating', 'services'));

            return false;
        }
        $id_user_service = filter_input(INPUT_POST, 'id_user_service', FILTER_VALIDATE_INT);
        $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);

        $this->load->model('services/models/Services_users_model');
        $user_service = $this->Services_users_model->get_service_by_id($id_user_service);

        //check for free services
        if (!$user_service && $gid) {
            $this->load->model('Services_model');
            $service = $this->Services_model->format_service($this->Services_model->get_service_by_gid($gid));
            if ($service && !$service['price'] && $service['template']['price_type'] == 1) {
                $user_service = [
                    'id_user' => $id_user,
                    'service_gid' => $service['gid'],
                    'template_gid' => $service['template_gid'],
                    'service' => $service,
                    'template' => $service['template'],
                    'payment_data' => [],
                    'id_users_package' => 0,
                    'status' => 1,
                    'count' => 1,
                ];
                $id_user_service = $this->Services_users_model->save_service(null, $user_service);
            }
        }
        if (!$user_service) {
            $this->set_api_content('errors', l('error_service_activating', 'services'));

            return false;
        }

        // TODO: почему то сервис сохраняется не так
        if (!empty($user_service['template']['template'])) {
            $user_service['template'] = $user_service['template']['template'];
        }

        $module = $user_service['template']['callback_module'];
        $model = $user_service['template']['callback_model'];
        $method = $user_service['template']['callback_activate_method'];

        $this->load->model($module.'/models/'.$model);

        // TODO: убрать после приведения к PSR
        if (!method_exists($this->$model, $method)) {
            $chunks = explode('_', $method);
            $method = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }

            if (!method_exists($this->$model, $method)) {
                $this->set_api_content('errors', 'callback not found');

                return false;
            }
        }

        $result = $this->{$model}->{$method}($id_user, $id_user_service);
        $this->set_api_content('messages', $result['message']);
        $this->set_api_content('data', $result);
    }

    private function formatService($services)
    {
        $services_modules = [];
        foreach ($services as $key => $service) {
            if ($service['template']['price_type'] > 2) {
                unset($services[$key]);
            } else {
                $services[$key]['price'] = (float) $services[$key]['price'];
                $model = strtolower($service['template']['callback_model']);
                $services_modules[$service['template']['callback_module']][$model] = ucfirst($model);
            }
        }
        $buy_gids = [];
        foreach ($services_modules as $module => $models) {
            foreach ($models as $model) {
                $this->load->model("$module/models/$model");
                if (!empty($this->{$model}->services_buy_gids)) {
                    $buy_gids = array_merge($buy_gids, $this->{$model}->services_buy_gids);
                }
            }
        }
        foreach ($services as $key => $service) {
            if (!in_array($service['gid'], $buy_gids)) {
                unset($services[$key]);
            }
        }

        return $services;
    }
}
