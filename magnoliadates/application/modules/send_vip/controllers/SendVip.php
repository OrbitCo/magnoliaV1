<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\controllers;

use Pg\Libraries\View;
use Pg\modules\blacklist\models\BlacklistModel;
use Pg\modules\send_vip\models\SendVipModel;
use function Pg\modules\payments\helpers\sendPayment;
use function Pg\modules\send_vip\helpers\sendVipBlock;

/**
 * Send money module.
 *
 *
 * @copyright   Copyright (c) 2000-2014 PG Real Estate - php real estate listing software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendVip extends \Controller
{

    /**
     * SendVip constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Send_vip_model');
    }

    public function save()
    {
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'id_sender' => $this->session->userdata('user_id'),
            'membership' => $this->session->userdata('membership_obj'),
        ];
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('membership_obj');
        $payment_gid = $this->input->post('system_gid', true);
        $this->load->model('payments/models/Payment_systems_model');
        $payment_gids_temp = $this->Payment_systems_model->getActiveSystemList();
        $payment_gids = ['account'];
        foreach ($payment_gids_temp as $value) {
            $payment_gids[] = $value['gid'];
        }
        $use_fee = $this->pg_module->get_module_config('send_vip', 'use_fee');
        if ($use_fee == 'use') {
            $currency = $this->pg_module->get_module_config('send_vip', 'fee_currency');
            $transfer_fee = $this->pg_module->get_module_config('send_vip', 'fee_price');
            $koef = SendVipModel::getСoefficient(['currency' => $currency, 'transfer_fee' => $transfer_fee]);
            $this->view->assign('use_fee', $use_fee);
        } else {
            $transfer_fee = null;
            $koef = null;
        }

        $transaction_data = $this->Send_vip_model->validateTransaction($data, $koef, $transfer_fee);
        if (!empty($transaction_data['errors']) || !in_array($payment_gid, $payment_gids)) {
            $this->system_messages->addMessage(View::MSG_ERROR, $transaction_data['errors']);
        } else {
            $this->load->model('payments/models/Payment_currency_model');
            $currency_gid = $this->Payment_currency_model->default_currency['gid'];

            $to_user_row = $this->Users_model->getUserById($transaction_data['data']['id_user']);
            $to_user = $to_user_row['output_name'];
            $message = l('send_vip', 'send_vip').': '.$to_user;

            if ($payment_gid == 'account') {
                $transaction_id = $this->Send_vip_model->saveTransaction(null, $transaction_data['data']);
                /*
                 * Save write off statistics for the sender
                 */
                $this->ci->load->model('Users_payments_model');
                $this->ci->Users_payments_model->writeOffUserAccount(
                        $transaction_data['data']['id_sender'],
                        $transaction_data['data']['full_amount'],
                        $message,
                        'send_vip',
                        ['lang' => 'payment_stat_send_vip', 'module' => SendVipModel::MODULE_GID]
                );

                $transaction_data['data']['id_transaction'] = $transaction_id;
                $this->Send_vip_model->sendLetter($transaction_data['data']);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('send_vip_transaction_saved', 'send_vip'));

                return redirect(site_url().'users/account/donate/', 'hard');
            }
            $payment_data = [
                    'name' => $message,
                    'transaction' => $transaction_data['data'],
                    'lang' => 'payment_stat_send_vip',
                    'module' => SendVipModel::MODULE_GID,
                ];
            $this->load->helper('payments');
            sendPayment('send_vip',
                    $transaction_data['data']['id_sender'],
                    $transaction_data['data']['full_amount'],
                    $currency_gid,
                    $payment_gid,
                    $payment_data,
                    'form');
        }
    }

    public function confirm()
    {
        if ($this->input->post('btn_send_vip_save', true)) {
            $id_user = filter_input(INPUT_POST, 'id_user', FILTER_VALIDATE_INT);
            $post_data = [
                'id_user' => !empty($id_user) ? $id_user : filter_input(INPUT_POST, 'friend', FILTER_VALIDATE_INT),
                'id_sender' => $this->session->userdata('user_id'),
                'membership' => $this->input->post('membership', true),
            ];
            $this->load->model('payments/models/Payment_currency_model');
            $use_fee = $this->pg_module->get_module_config('send_vip', 'use_fee');
            if ($use_fee == 'use') {
                $currency = $this->pg_module->get_module_config('send_vip', 'fee_currency');
                $transfer_fee = $this->pg_module->get_module_config('send_vip', 'fee_price');
                $koef = SendVipModel::getСoefficient(['currency' => $currency, 'transfer_fee' => $transfer_fee]);
                $this->view->assign('use_fee', $use_fee);
            } else {
                $transfer_fee = null;
                $koef = null;
            }
            $validate_data = $this->Send_vip_model->validateTransaction($post_data, $koef, $transfer_fee);
            if (empty($validate_data['errors'])) {
                $this->load->model([
                    'Users_model', 'Menu_model',
                    'payments/models/Payment_systems_model',
                ]);
                $pay_type = $this->pg_module->get_module_config('send_vip', 'transfer_type');
                if ($pay_type != SendVipModel::PAYMENT_TYPE_ACCOUNT) {
                    $billing_systems = $this->Payment_systems_model->getActiveSystemList();
                    $this->view->assign('billing_systems', $billing_systems);
                }
                $currency = $this->Payment_currency_model->getCurrencyDefault(true);
                $to_user_row = $this->Users_model->getUserById($validate_data['data']['id_user']);
                $to_user = $to_user_row['output_name'];
                $this->view->assign('currency', $currency['gid']);
                $this->view->assign('to_user', $to_user);
                $this->view->assign('pay_type', $pay_type);
                $confirm_data = $this->Send_vip_model->formatConfirmData($validate_data);
                $this->session->set_userdata('membership_obj', $confirm_data['membership_obj']);
                $this->session->set_userdata('full_amount', $confirm_data['full_amount']);
                $this->session->set_userdata('id_user', $confirm_data['id_user']);
                $this->view->assign('data', $confirm_data);
                $this->Menu_model->breadcrumbsSetParent('account-item');
                $this->Menu_model->breadcrumbsSetActive(l('send_vip', 'send_vip'));
                $this->view->render('confirm');
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                redirect(site_url('users/account/donate'));
            }
        } else {
            $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
            redirect(site_url().'users/account/donate');
        }
    }

    public function approve($transaction_id)
    {
        $this->system_messages->addMessage(View::MSG_SUCCESS,
            $this->Send_vip_model->statusTransaction($transaction_id, 'approve'));
        redirect(site_url('users/account/donate'));
    }

    public function decline($transaction_id)
    {
        $this->system_messages->addMessage(View::MSG_ERROR,
            $this->Send_vip_model->statusTransaction($transaction_id, 'decline'));
        redirect(site_url('users/account/donate'));
    }

    public function ajaxGetSendVipBlock($user_id = null)
    {
        $return = [];

        if ((new BlacklistModel())->isBlocked($user_id, $this->session->userdata('user_id'))) {
            $return['errors'][] = l('you_in_blacklist', 'blacklist');
        } else {
            $this->load->helper('send_vip');
            $return['html'] = sendVipBlock(['user_id' => $user_id]);
        }

        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxValidateTransaction()
    {
        $return = $this->Send_vip_model->validateTransaction([
            'friend' => $this->input->post('friend', true),
            'id_user' => !empty($this->input->post('id_user', true)) ? $this->input->post('id_user', true) : $this->input->post('friend', true),
            'amount' => $this->input->post('amount', true),
            'full_amount' => $this->input->post('full_amount', true),
            'group_gid' => $this->input->post('membership', true),
            'id_sender' => $this->session->userdata('user_id'),

        ]);
        $this->view->assign('errors', $return['errors']);
        $this->view->render();
    }

    public function ajaxApprove($transaction_id)
    {
        exit($this->Send_vip_model->statusTransaction($transaction_id, 'approve'));
    }

    public function ajaxDecline($transaction_id)
    {
        exit($this->Send_vip_model->statusTransaction($transaction_id, 'decline'));
    }
}
