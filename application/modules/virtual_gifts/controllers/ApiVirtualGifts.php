<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\controllers;

use Pg\Libraries\Analytics;

/**
 * VirtualGifts module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */

/**
 * VirtualGifts api side controller
 *
 * @package     PG_Dating
 * @subpackage  VirtualGifts
 * @category    controllers
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */
class ApiVirtualGifts extends \Controller
{
    /**
     * Constructor
     *
     * @return VirtualGifts_start
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Virtual_gifts_model');
        $this->load->model('Users_model');
    }

    /**
    * @api {post} /virtual_gifts/getGifts Get gifts list
    * @apiGroup Virtual gifts
    */
    public function getGifts()
    {
        $this->load->library('Analytics');
        $event = $this->analytics->getEvent('virtual_gifts', 'engaged', 'user');
        $this->analytics->track($event);

        $filters = ['is_active' => 1];
        $gifts = $this->Virtual_gifts_model->getVirtualGiftsList($filters, null, null, ['priority' => 'asc']);

        $this->set_api_content('data', ['gifts' => $gifts]);
    }

    /**
    * @api {post} /virtual_gifts/sendGiftPayment Send gift payment
    * @apiGroup Virtual gifts
    * @apiParam {int} user_id user id
    * @apiParam {int} gift_id gift id
    * @apiParam {boolean} [is_private] is private gift or not
    * @apiParam {string} [comment] of gift
    */
    public function sendGiftPayment($user_id = null, $gift_id = null)
    {
        $sender_id = $this->session->userdata('user_id');
        $user_id = intval($user_id);
        $payment_status = '';
        $gift_id = intval($gift_id);
        if (empty($gift_id)) {
            $gift_id = intval($this->input->post('gift_id'));
        }
        $gift_data = $this->Virtual_gifts_model->getVirtualGiftsById($gift_id);

        $payment_data = [
            "sender_id"  => $sender_id,
            "gift_id"    => $gift_id,
            "is_private" => $this->input->post('is_private'),
            "comment"    => $this->input->post('comment'),
        ];
        $result = $this->Virtual_gifts_model->validatePaymentData($payment_data);

        $payment_type = $this->pg_module->get_module_config('virtual_gifts', 'payment_type');
        $pay_from_account = false;

        if ($payment_type == 'account' || $payment_type == 'account_and_direct') {
            $this->load->model("Users_payments_model");
            $user_account = $this->Users_payments_model->get_user_account($sender_id);
            if ($result['data']['price'] <= $user_account) {
                $pay_from_account = true;
            }
        }

        if ($payment_type == 'direct' || $payment_type == 'account_and_direct') {
            $this->load->model('payments/models/Payment_systems_model');
            $billing_systems = $this->Payment_systems_model->get_active_system_list();
        }

        if (!empty($result["errors"])) {
            $this->set_api_content('message', l('error_payment', 'virtual_gifts'));
        } else {
            $sender_id = $result["data"]["sender_id"];
            $price = $result["data"]["price"];
            $result["data"]["user_id"] = $user_id;

            $payment = $this->Virtual_gifts_model->accountPayment($sender_id, $price, $result["data"]);
            if ($payment) {
                $this->set_api_content('message', l('gift_sent', 'virtual_gifts'));
            } else {
                $this->set_api_content('message', l('error_no_funds', 'virtual_gifts'));
            }
        }
    }

    /**
    * @api {post} /virtual_gifts/getUserGifts Get user gifts
    * @apiGroup Virtual gifts
    * @apiParam {int} [page] page of results
    */
    public function getUserGifts($page = null)
    {
        $user_id = $this->session->userdata('user_id');
        $params['where_not_in'] = [
            'status' => 'decline',
        ];
        $order_by = ['id' => 'DESC'];
        $limits = 8;

        $gifts = $this->Virtual_gifts_model->getUserGiftsList($user_id, true, $params, $order_by, $page, $limits);

        if (!empty($gifts)) {
            $gift_sender_ids = [];
            $formatted_users = [];
            foreach ($gifts as $gift) {
                $gift_sender_ids[] = $gift["fk_sender_id"];
            }
            $gift_sender_ids = array_unique($gift_sender_ids);
            $users = $this->Users_model->get_users_list(null, null, null, ["where_in" => ["id" => $gift_sender_ids]]);
            foreach ($users as $user) {
                $formatted_users[$user["id"]]["name"] = $user["output_name"];
                $formatted_users[$user["id"]]["age"] = $user["age"];
                $formatted_users[$user["id"]]["logo"] = $user["media"]["user_logo"]["thumbs"]["middle"];
                $formatted_users[$user["id"]]["city"] = $user["city"];
            }
            foreach ($gifts as &$gift) {
                $gift['comment'] = trim($gift['comment'], "'");
                $gift["sender"]["name"] = $formatted_users[$gift["fk_sender_id"]]["name"];
                $gift["sender"]["age"] = $formatted_users[$gift["fk_sender_id"]]["age"];
                $gift["sender"]["logo"] = $formatted_users[$gift["fk_sender_id"]]["logo"];
                $gift["sender"]["city"] = $formatted_users[$gift["fk_sender_id"]]["city"];
            }
        }

        $gifts_count = $this->Virtual_gifts_model->getUserGiftsCount($user_id, $params);
        $result = [
            'gifts' => $gifts,
            'count' => $gifts_count,
        ];

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /virtual_gifts/userGiftStatus Set user gift status
    * @apiGroup Virtual gifts
    * @apiParam {int} [gift_id] gift id
    * @apiParam {int} [status] gift status
    */
    public function userGiftStatus($gift_id = null, $status = null)
    {
        $user_id = $this->session->userdata('user_id');
        if (!$gift_id || !$user_id || !$status) {
            $this->set_api_content('message', l('error_undefined', 'virtual_gifts'));
        } else {
            $gift_status = $this->Virtual_gifts_model->updateUserGiftStatus($gift_id, $user_id, $status);
            if ($gift_status) {
                $this->set_api_content('message', $gift_status);
            } else {
                $this->set_api_content('message', l('error_undefined', 'virtual_gifts'));
            }
        }
    }
}
