<?php

declare(strict_types=1);

namespace Pg\modules\users_payments\controllers;

use Pg\Libraries\View;
use Pg\modules\access_permissions\models\AccessPermissionsModel;

/**
 * Users payments user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 *
 * @version $Revision: 1 $ $Date: 2012-09-12 10:32:07 +0300 (Ср, 12 сент 2012) $ $Author: abatukhtin $
 * */
class UsersPayments extends \Controller
{

    public function ajaxSavePayment()
    {
        $return = [];
        $system_gid = $this->input->post('system_gid', true);
        if (empty($system_gid)) {
            $return["error"][] = l('error_empty_system_gid', 'users_payments');
        }
        if ($system_gid) {
            $user_id = $this->session->userdata('user_id');
            $amount  = abs(floatval(str_replace(',', '.', $this->input->post('amount', true))));
            if (empty($amount)) {
                $return["error"][] = l('error_empty_amount', 'users_payments');
            } else {
                $this->load->model('payments/models/Payment_currency_model');
                $base_currency = $this->Payment_currency_model->getCurrencyDefault(true);
                $this->load->helper('payments');
                $additional['name'] = l('header_add_funds', 'users_payments');
                $additional['lang'] = 'header_add_funds';
                $additional['module']  = 'users_payments';
                $additional['comment'] = '';
                $payment_data = send_payment_api('account', $user_id, $amount, $base_currency['gid'], $system_gid, $additional);
                if (!empty($payment_data['errors'])) {
                    $return["error"] = $payment_data["errors"];
                } else {
                    $return["success"] = l('success_payment_send', 'payments');
                }
                if (!empty($payment_data['info'])) {
                    $return["info"] = $payment_data["info"];
                }
            }
        } else {
            $return["error"][] =l('error_empty_system_gid', 'users_payments');
        }

        $this->view->assign($return);
        $this->view->render();
    }

    public function savePayment()
    {
        $system_gid = $this->input->post('system_gid', true);
        if (empty($system_gid)) {
            $this->system_messages->addMessage(View::MSG_ERROR,
                l('error_empty_system_gid', 'users_payments'));
        }
        if ($system_gid) {
            $user_id = $this->session->userdata('user_id');
            $amount  = abs(floatval(str_replace(',',
                '.',
                        $this->input->post('amount', true))));
            if (empty($amount)) {
                $this->system_messages->addMessage(View::MSG_ERROR,
                    l('error_empty_amount', 'users_payments'));
            } elseif (empty($system_gid)) {
                $this->system_messages->addMessage(View::MSG_ERROR,
                    l('error_empty_system_gid', 'users_payments'));
            } else {
                $this->load->model('payments/models/Payment_currency_model');
                $base_currency        = $this->Payment_currency_model->get_currency_default(true);
                $this->load->helper('payments');
                $additional['name']   = l('header_add_funds', 'users_payments');
                $additional['lang']   = 'header_add_funds';
                $additional['module'] = 'users_payments';
                $additional['card'] = $this->input->post('card', true) ?? [];
                $payment_data         = send_payment('account',
                    $user_id,
                    $amount,
                    $base_currency['gid'],
                    $system_gid,
                    $additional,
                    'form');
                if (!empty($payment_data['errors'])) {
                    $this->system_messages->addMessage(View::MSG_ERROR,
                        $payment_data['errors']);
                }
                if (!empty($payment_data['info'])) {
                    $this->system_messages->addMessage(View::MSG_INFO,
                        $payment_data['info']);
                }
            }
        }

        $this->load->helper('seo');
        $url = rewrite_link('users', 'account', ['action' => 'update']);
        redirect($url);
    }

    /**
     * Add funds
     *
     * @return array
     */
    public function addFunds()
    {
        if ($this->input->post('send')) {
             $payment_data = [
                'system' => filter_input(INPUT_POST, 'system', FILTER_SANITIZE_STRING),
                'price' => filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT),
             ];
             $this->load->model('payments/models/Payment_systems_model');
             $billing_systems = $this->Payment_systems_model->getActiveSystemList();
             if (!empty($payment_data)) {
                 $payment_data['use_system'] = $this->Payment_systems_model->getSystemByGid($payment_data['system']);
                 $this->view->assign('payment_data', $payment_data);
             }
             $this->view->assign('billing_systems', $billing_systems);
             $result['html'] = $this->view->fetch('add_funds', null, 'users_payments');
        } else {
            $result = ['error' => [l('error_system', AccessPermissionsModel::MODULE_GID)]];
        }
        $this->view->assign($result);
        $this->view->render();
    }
}
