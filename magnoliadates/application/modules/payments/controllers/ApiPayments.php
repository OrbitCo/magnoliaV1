<?php

declare(strict_types=1);

namespace Pg\modules\payments\controllers;

use Pg\Libraries\View;

/**
 * Payments api controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiPayments extends \Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payments/models/Payment_systems_model');
    }

    /**
    * @api {post} /payments/getSystem Get payment system
    * @apiGroup Payments
    * @apiParam {string} system_gid system gid
    */
    public function getSystem()
    {
        $gid = filter_input(INPUT_POST, 'system_gid');
        if (empty($gid)) {
            $this->view->assign(View::MSG_ERROR, 'error');
        } else {
            $system = $this->Payment_systems_model->get_system_by_gid($gid);
            if (!$system) {
                $this->view->assign(View::MSG_ERROR, 'no_system');
            } else {
                $this->view->assign('data', $system);
            }
        }
    }

    /**
    * @api {post} /payments/getSystems Get systems list
    * @apiGroup Payments
    */
    public function getSystems()
    {
        $data = $this->Payment_systems_model->get_active_system_list();
        $this->view->assign('data', $data);
    }

    /**
    * @api {post} /payments/send Send payment
    * @apiGroup Payments
    * @apiParam {string} system_gid system gid
    * @apiParam {string} payment_type_gid payment type gid
    * @apiParam {float} amount amount
    * @apiParam {array} payment_data payment data
    * @apiParam {string} currency_gid currency gid
    */
    public function send()
    {
        $system_gid = filter_input(INPUT_POST, 'system_gid');
        $payment = [
            'payment_type_gid' => filter_input(INPUT_POST, 'payment_type_gid', FILTER_SANITIZE_STRING),
            'amount' => filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT),
            'id_user' => $this->session->userdata('user_id'),
            'currency_gid' => filter_input(INPUT_POST, 'currency_gid'),
            'system_gid' => $system_gid,
            'payment_data' => filter_input(INPUT_POST, 'payment_data', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY),
            'system' => $this->Payment_systems_model->get_system_by_gid($system_gid),
        ];

        $this->Payment_systems_model->load_driver($payment['system_gid']);
        $this->load->model('Payments_model');
        if (!$this->Payments_model->validate_payment_form($payment)) {
            $this->view->assign(View::MSG_ERROR, 'wrong_payment');
            return;
        }

        $this->load->helper('payments');

        $return = send_payment_api(
            $payment['payment_type_gid'],
            $payment['id_user'],
            $payment['amount'],
            $payment['currency_gid'],
            $payment['system_gid'],
            $payment['payment_data']
        );

        $payment['payment_data'] = $return['data'];

        if (!empty($return['info'])) {
            $this->system_messages->addMessage(View::MSG_INFO, (array)$return['info']);
        }
        if (!empty($return['errors'])) {
            $this->system_messages->addMessage(View::MSG_ERROR, (array)$return['errors']);
        } else {
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_payment_send', 'payments'));
        }
        $this->view->assign('payment', $payment);
    }

    /**
    * @api {post} /payments/getCurrencies Get currencies list
    * @apiGroup Payments
    */
    public function getCurrencies()
    {
        $this->load->model('payments/models/Payment_currency_model');
        $this->view->assign('currencies', $this->Payment_currency_model->get_currency_list());
    }
}
