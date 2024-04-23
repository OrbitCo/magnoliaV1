<?php

declare(strict_types=1);

namespace Pg\modules\services\controllers;

use Pg\Libraries\View;
use Pg\Libraries\EventDispatcher;
use Pg\modules\services\models\events\EventServices;

/**
 * Services user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 * */
class Services extends \Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Services_model");
    }

    /**
     * Services list
     *
     * @param string $template_gid template GUID
     *
     * @return void
     */
    public function index($template_gid = '')
    {
        $this->view->assign('template_gid', $template_gid);
        $this->view->render('index');
    }

    public function form($service_gid, $user_form_data = [])
    {
        $return = $this->setForm($service_gid, $user_form_data);

        if (isset($return['not_found'])) {
            show_404();
        } elseif (isset($return['redirect'])) {
            $this->view->setRedirect($return['redirect'], 'hard');
        }
        $this->view->render('service_form');
    }

    public function ajaxForm($service_gid)
    {
        $return = $this->setForm($service_gid, [], true, true);

        if (!isset($return['redirect']) && !isset($return['not_found'])) {
            if (isset($return['gid'])) {
                $return['content'] = $this->view->fetch('ajax_service_form');
            }
        }

        $this->view->assign($return);
        $this->view->render();
    }

    private function setForm($service_gid, $user_form_data = [], $check_html_action = true, $is_ajax = false)
    {
        $user_id = $this->session->userdata('user_id');
        if (empty($service_gid)) {
            $return['not_found'] = true;
            return $return;
        }

        $this->load->model('services/models/Services_users_model');
        $params = [
            'where' => [
                'id_user' => $user_id,
                'service_gid' => $service_gid,
                'status' => 1,
                'count > ' => 0
            ]
        ];

        $data['user_services'] = $this->Services_users_model->getServicesList($params);
        if (!empty($data['user_services'])) {
            $this->view->assign('data', $data);
            $return['content'] = $this->view->fetch('use_services_list');
            return $return;
        }

        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($user_id);

        $data = $this->Services_model->getServiceByGid($service_gid);

        if (empty($data['status'])) {
            $msg = str_replace('[service_name]', $data['name'], l('error_services_inactive', 'services'));
            $this->system_messages->addMessage(View::MSG_ERROR, $msg);
            $return_status['not_found'] = true;
            return $return_status;
        }

        $data["template"] = $this->Services_model->formatTemplate($data["template"]);

        if (!empty($data["data_admin"])) {
            foreach ($data["template"]["data_admin_array"] as $gid => $temp) {
                if (!empty($data["data_admin"][$gid])) {
                    $data["template"]["data_admin_array"][$gid]["value"] = $data["data_admin"][$gid];
                }
            }
        }

        if ($data["template"]["price_type"] == "2" || $data["template"]["price_type"] == "3") {
            $data["price"] = $this->input->post('price', true);
        }

        if ($this->input->post('btn_system') || $this->input->post('btn_account')) {
            $user_form_data       = $this->input->post("data_user", true);
            $activate_immediately = $this->input->post('activate_immediately') ? true : false;
            $without_activation   = $this->input->post('without_activation') ? true : false;

            $service_return = $this->Services_model->validateServicePayment($data["id"], $user_form_data, $data["price"]);
            if (!empty($service_return["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $service_return["errors"]);
            } else {
                $origin_return = $this->Services_model->validateServiceOriginalModel($data["id"], $user_form_data, $user_id, $data["price"]);
                if (!empty($origin_return["errors"])) {
                    $this->system_messages->addMessage(View::MSG_ERROR, $origin_return["errors"]);
                } else {
                    if ($this->input->post('btn_account')) {
                        // TODO: service payment send
                        $this->load->library('Analytics');
                        $this->analytics->track('service_system_account_payment_send', ['controller' => 'users']);
                        $this->analytics->track('service_' . $service_gid . '_payment_send', ['controller' => 'users']);

                        $return = $this->Services_model->accountPayment($data, $user_id, $user_form_data, $activate_immediately, $is_ajax);
                        if ($return !== true) {
                            // TODO: service payment fail
                            $this->analytics->track('service_system_account_payment_fail', ['controller' => 'users']);
                            $this->analytics->track('service_' . $service_gid . '_payment_fail', ['controller' => 'users']);

                            $this->system_messages->addMessage(View::MSG_ERROR, $return);
                        } else {
                            // TODO: service payment success
                            $this->analytics->track('service_system_account_payment_success', ['controller' => 'users']);
                            $this->analytics->track('service_' . $service_gid . '_payment_success', ['controller' => 'users']);

                            if (!$without_activation) {
                                if ($activate_immediately) {
                                    if (!empty($data["price"])) {
                                        $this->system_messages->addMessage(View::MSG_SUCCESS,
                                            l('success_services_activated', 'services', null, 'text', ['service' => $data['name']]));
                                    } else {
                                        $this->system_messages->addMessage(View::MSG_SUCCESS,
                                            l('success_service_activating', 'services', null, 'text', ['service' => $data['name']]));
                                    }
                                } else {
                                    $this->system_messages->addMessage(View::MSG_SUCCESS,
                                        l('success_services_can_activate', 'services', null, 'text', ['service' => $data['name']]));
                                }
                            }
                            $redirect = $this->session->userdata('service_redirect');

                            if ($service_gid == 'ability_delete') {
                                $redirect = site_url();
                            }

                            $this->session->set_userdata(['service_redirect' => '']);
                            $this->load->model('users/models/Auth_model');
                            $this->Auth_model->update_user_session_data($user_id);
                            $return_status['redirect'] = $redirect;

                            $this->load->library('Analytics');
                            $event = $this->analytics->getEvent('payments', $service_gid, 'user');
                            $this->analytics->track($event);

                            return $return_status;
                        }
                    } elseif ($this->input->post('btn_system')) {
                        $system_gid = $this->input->post('system_gid', true);
                        // TODO: service payment send
                        $this->load->library('Analytics');
                        $this->analytics->track('service_system_' . $system_gid . '_payment_send', ['controller' => 'users']);
                        $this->analytics->track('service_' . $service_gid . '_payment_send', ['controller' => 'users']);

                        if (empty($system_gid)) {
                            // TODO: service payment fail
                            $this->analytics->track('service_system_' . $system_gid . '_payment_fail', ['controller' => 'users']);
                            $this->analytics->track('service_' . $service_gid . '_payment_fail', ['controller' => 'users']);

                            $this->system_messages->addMessage(View::MSG_ERROR, l('error_select_payment_system', 'services'));
                        } else {
                            // TODO: service payment success
                            $this->analytics->track('service_system_' . $system_gid . '_payment_success', ['controller' => 'users']);
                            $this->analytics->track('service_' . $service_gid . '_payment_success', ['controller' => 'users']);

                            $this->Services_model->system_payment($system_gid,
                                $user_id,
                                $data["id"],
                                $user_form_data,
                                $data["price"],
                                $activate_immediately,
                                $check_html_action);

                            if (!$check_html_action) {
                                $this->system_messages->addMessage(View::MSG_SUCCESS,
                                    l('success_payment_send', 'payments', null, 'text', ['service' => $data['name']]));
                            }
                            $redirect = $this->session->userdata('service_redirect');

                            if ($service_gid == 'ability_delete') {
                                $redirect = site_url();
                            }

                            $this->session->set_userdata(['service_redirect' => '']);
                            $this->load->model('users/models/Auth_model');
                            $this->Auth_model->updateUserSessionData($user_id);
                            $return_status['redirect'] = $redirect;

                            $this->load->library('Analytics');
                            $event = $this->analytics->getEvent('payments', $service_gid, 'user');
                            $this->analytics->track($event);

                            return $return_status;
                        }
                    }
                }
            }
        }

        if (!empty($data["template"]["data_user_array"])) {
            foreach ($data["template"]["data_user_array"] as $gid => $temp) {
                $value = "";
                if ($temp["type"] == "hidden") {
                    $value = $this->input->get_post($gid, true);
                }
                if (isset($user_form_data[$gid])) {
                    $value = $user_form_data[$gid];
                }
                $data["template"]["data_user_array"][$gid]["value"] = $value;
            }
        }

        // get payments types
        $data["free_activate"] = false;
        if ($data["price"] <= 0) {
            $data["free_activate"] = true;
        }

        if ($data["pay_type"] == 1 || $data["pay_type"] == 2) {
            $this->load->model("Users_payments_model");
            $data["user_account"] = $this->Users_payments_model->getUserAccount($user_id);
            if ($data["user_account"] <= 0 && $data["price"] > 0) {
                $data["disable_account_pay"] = true;
            } elseif (($data["template"]["price_type"] == 1 || $data["template"]["price_type"] == 3) && $data["price"] > $data["user_account"]) {
                $data["disable_account_pay"] = true;
            }
        }

        if ($data["pay_type"] == 2 || $data["pay_type"] == 3) {
            $this->load->model("payments/models/Payment_systems_model");
            $billing_systems = $this->Payment_systems_model->getActiveSystemList();
            $this->view->assign('billing_systems', $billing_systems);
        }

        $event_handler = EventDispatcher::getInstance();
        $event  = new EventServices();
        $event_handler->dispatch($event, 'users_view_service_form');

        $this->load->model('Menu_model');
        $this->Menu_model->breadcrumbs_set_parent('my_payments_item');
        $this->Menu_model->breadcrumbs_set_parent('account-item');
        $this->Menu_model->breadcrumbs_set_active($data['name']);

        $this->view->assign('is_module_installed',
            $this->pg_module->is_module_installed('users_payments'));
        $this->view->assign('data', $data);

        return $data;
    }

    public function userServiceActivate($id_user, $id_user_service, $gid = '')
    {
        $redirect = $this->session->userdata('service_activate_redirect');
        $id_user_session = $this->session->userdata('user_id');
        if ($id_user_session !== $id_user) {
            $this->system_messages->addMessage(View::MSG_ERROR,
                l('error_service_activating', 'services'));
            $this->view->setRedirect($redirect);
        }
        $this->load->model('services/models/Services_users_model');
        $user_service = $this->Services_users_model->get_service_by_id($id_user_service);

        if (!$user_service && $gid) {
            $this->load->model('Services_model');
            $service = $this->Services_model->format_service($this->Services_model->get_service_by_gid($gid));
            if ($service && !$service['price'] && $service['template']['price_type'] == 1) {
                $user_service    = [
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
                $id_user_service = $this->Services_users_model->save_service(null,
                    $user_service);
            }
        }
        if (!$user_service) {
            $this->system_messages->addMessage(View::MSG_ERROR,
                l('error_service_activating', 'services'));
            $this->view->setRedirect($redirect);
        }

        $model_name  = $user_service['template']['callback_model'];
        $method_name = $user_service['template']['callback_activate_method'];

        $this->load->model($user_service['template']['callback_module'] . '/models/' . $model_name);
        $method_exists = true;

        // TODO: убрать после приведения к PSR
        if (!method_exists($this->{$model_name}, $method_name)) {
            $chunks      = explode('_', $method_name);
            $method_name = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method_name .= ucfirst($chunk);
            }

            if (!method_exists($this->{$model_name}, $method_name)) {
                $method_exists = false;
            }
        }

        if ($method_exists) {
            $result = $this->{$model_name}->{$method_name}($id_user,
                $id_user_service);
        } else {
            $result = [
                'status' => 0,
                'message' => 'callback not found'
            ];
        }

        if ($result['status']) {
            $this->system_messages->addMessage(View::MSG_SUCCESS,
                $result["message"]);
        } else {
            $this->system_messages->addMessage(View::MSG_ERROR,
                $result["message"]);
        }
        $this->view->setRedirect($redirect);
    }
}
