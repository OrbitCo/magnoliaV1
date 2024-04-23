<?php

declare(strict_types=1);

namespace Pg\modules\send_money\controllers;

use Pg\Libraries\View;
use Pg\modules\blacklist\models\BlacklistModel;
use Pg\modules\send_money\models\SendMoneyModel;
use function Pg\modules\payments\helpers\sendPayment;
use function Pg\modules\send_money\helpers\sendMoneyBlock;

/**
 * Send money module
 *
 * @package     PG_RealEstate
 *
 * @copyright   Copyright (c) 2000-2014 PG Real Estate - php real estate listing software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendMoney extends \Controller
{
     /**
     * Controller
     *
     * @return SendMoney
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        $this->load->model('Send_money_model');
        $data = [
            'id_user'     => $this->session->userdata('id_user'),
            'id_sender'   => $this->session->userdata('user_id'),
            'amount'      => $this->session->userdata('amount'),
            'full_amount' => $this->session->userdata('full_amount'),
        ];
        $payment_gid       = $this->input->post('system_gid', true);
        $this->load->model("payments/models/Payment_systems_model");
        $payment_gids_temp = $this->Payment_systems_model->get_active_system_list();
        foreach ($payment_gids_temp as $value) {
            $payment_gids[] = $value['gid'];
        }
        $payment_gids[]   = 'account';
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('amount');
        $this->session->unset_userdata('full_amount');
        $transaction_data = $this->Send_money_model->validateTransaction(null, $data);
        if (!empty($transaction_data['errors']) || !in_array($payment_gid, $payment_gids)) {
            $this->system_messages->addMessage(View::MSG_ERROR, $transaction_data['errors']);
        } else {
            $this->load->model('payments/models/Payment_currency_model');

            $currency_gid = $this->Payment_currency_model->default_currency["gid"];

            $to_user_row = $this->Users_model->getUserById($transaction_data['data']['id_user']);
            $to_user = $to_user_row['output_name'];
            $message = l('send_money', 'send_money') . ': ' . $to_user;

            if ($payment_gid == 'account') {
                $transaction_id = $this->Send_money_model->saveTransaction(null, $transaction_data['data']);
                /**
                 * Save write off statistics for the sender
                 */
                $this->ci->load->model("Users_payments_model");
                $this->ci->Users_payments_model->writeOffUserAccount(
                    $transaction_data['data']['id_sender'],
                    $transaction_data['data']['full_amount'],
                    $message,
                    'send_money',
                    ['lang' => 'payment_stat_send_money', 'module' => SendMoneyModel::MODULE_GID]
                );

                $transaction_data['data']['id_transaction'] = $transaction_id;
                $transaction_data['data']['currency_gid']   = $currency_gid;

                $is_send = $this->Send_money_model->sendLetter($transaction_data['data']);
                if (!$is_send) {
                    $this->system_messages->addMessage(View::MSG_ERROR, $transaction_data['errors']);
                }

                $success_txt = l('send_money_transaction_saved', 'send_money');
                $this->system_messages->addMessage(View::MSG_SUCCESS, $success_txt);

                return redirect(site_url() . 'users/account/donate', 'hard');
            }
            $payment_data = [
                    'name'        => $message,
                    'transaction' => $transaction_data['data'],
                    'lang' => 'payment_stat_send_money',
                    'module' => SendMoneyModel::MODULE_GID
                ];

            $this->load->helper('payments');
            sendPayment(
                'send_money',
                $transaction_data['data']['id_sender'],
                $transaction_data['data']['full_amount'],
                $currency_gid,
                $payment_gid,
                $payment_data,
                'form'
            );
        }
    }

    public function confirm()
    {
        $post_data = [];
        if ($this->input->post('btn_send_money_save', true)) {
            $this->load->model('Send_money_model');

            $id_user = $this->input->post('id_user', true);
            if (!empty($id_user)) {
                $post_data['id_user'] = $id_user;
            } else {
                $post_data['id_user'] = $this->input->post('friend', true);
            }
            $post_data['id_sender'] = $this->session->userdata('user_id');
            $post_data['amount']    = $this->input->post('amount', true);
            $this->load->model('payments/models/Payment_currency_model');
            $use_fee                = $this->pg_module->get_module_config('send_money', 'use_fee');
            if ($use_fee == 'use') {
                $currency     = $this->pg_module->get_module_config('send_money', 'fee_currency');
                $transfer_fee = $this->pg_module->get_module_config('send_money', 'fee_price');
                if ($currency == '%') {
                    $koef         = (float) $transfer_fee / 100; //ToDo: May be $koef need store in config table?
                    $transfer_fee = (float) $post_data['amount'] * $koef;
                }
                $post_data['full_amount'] = $post_data['amount'] + $transfer_fee;
                $post_data['full_amount'] = number_format((float)$post_data['full_amount'], 2, '.', '');
                $post_data['amount']      = number_format((float)$post_data['amount'], 2, '.', '');
                $this->view->assign('transfer_fee', number_format((float)$transfer_fee, 2, '.', ''));
                $this->view->assign('use_fee', $use_fee);
            } else {
                $post_data['full_amount'] = $post_data['amount'];
            }
            $validate_data = $this->Send_money_model->validateTransaction(null, $post_data);
            if (empty($validate_data['errors'])) {
                $currency = $this->Payment_currency_model->get_currency_default(true);
                $this->load->model('Users_model');
                $to_user_row = $this->Users_model->get_user_by_id($validate_data['data']['id_user']);
                $to_user = $to_user_row['output_name'];

                $this->load->model("payments/models/Payment_systems_model");
                $pay_type = $this->pg_module->get_module_config('send_money', 'transfer_type');
                if ($pay_type != SendMoneyModel::PAYMENT_TYPE_ACCOUNT) {
                    $billing_systems = $this->Payment_systems_model->get_active_system_list();
                    $this->view->assign('billing_systems', $billing_systems);
                }
                $this->view->assign('currency', $currency['gid']);
                $this->view->assign('full_amount', $validate_data['data']['full_amount']);
                $this->view->assign('to_user', $to_user);
                $this->view->assign('pay_type', $pay_type);
                $this->view->assign('sender_account', $validate_data['validate']['sender_account']);
                $this->session->set_userdata('amount', $validate_data['data']['amount']);
                $this->session->set_userdata('id_user', $validate_data['data']['id_user']);
                $this->session->set_userdata('full_amount', $validate_data['data']['full_amount']);
                // breadcrumbs
                $this->load->model('Menu_model');
                $this->Menu_model->breadcrumbs_set_parent('account-item');
                $this->Menu_model->breadcrumbs_set_active(l('send_money', 'send_money'));
                $this->view->render('confirm');
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                redirect(site_url() . 'users/account/donate');
            }
        } else {
            redirect(site_url() . 'users/account/donate');
        }
    }

    public function approve($transaction_id)
    {
        $this->load->model('Send_money_model');
        $this->system_messages->addMessage(View::MSG_SUCCESS, $this->Send_money_model->statusTransaction($transaction_id, 'approve'));
        redirect(site_url() . 'users/account/donate');
    }

    public function decline($transaction_id)
    {
        $this->load->model('Send_money_model');
        $this->system_messages->addMessage(View::MSG_ERROR, $this->Send_money_model->statusTransaction($transaction_id, 'decline'));
        redirect(site_url() . 'users/account/donate');
    }

    public function ajaxGetSendMoneyBlock($user_id = null)
    {
        $return = [];

        if ((new BlacklistModel())->isBlocked($user_id, $this->session->userdata('user_id'))) {
            $return['errors'][] = l('you_in_blacklist', 'blacklist');
        } else {
            $this->load->helper('send_money');
            $return['html'] = sendMoneyBlock(['user_id' => $user_id]);
        }

        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxValidateTransaction()
    {
        $post_data['friend']      = $this->input->post('friend', true);
        $post_data['id_user']     = $this->input->post('id_user', true);
        $post_data['amount']      = $this->input->post('amount', true);
        $post_data['full_amount'] = $this->input->post('full_amount', true);
        if (empty($post_data['id_user'])) {
            $post_data['id_user'] = $post_data['friend'];
        }
        $post_data['id_sender'] = $this->session->userdata('user_id');
        $this->load->model('Send_money_model');
        $return                 = $this->Send_money_model->validateTransaction(null, $post_data);
        $this->view->assign('errors', implode('<br>', $return['errors']));
        $this->view->render();
    }

    public function ajaxApprove($transaction_id)
    {
        $this->load->model('Send_money_model');
        exit($this->Send_money_model->statusTransaction($transaction_id, 'approve'));
    }

    public function ajaxDecline($transaction_id)
    {
        $this->load->model('Send_money_model');
        exit($this->Send_money_model->statusTransaction($transaction_id, 'decline'));
    }
}
