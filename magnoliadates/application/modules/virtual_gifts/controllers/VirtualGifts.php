<?php

namespace Pg\modules\virtual_gifts\controllers;

use Pg\Libraries\Analytics;

/**
 * VirtualGifts module
 *
 * @package    PG_Dating
 *
 * @copyright    Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author        DATING PRO LTD <http://www.pilotgroup.net/>
 */

/**
 * VirtualGifts user side controller
 *
 * @package    PG_Dating
 * @subpackage    VirtualGifts
 * @category    controllers
 *
 * @copyright    Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author        DATING PRO LTD <http://www.pilotgroup.net/>
 */
class VirtualGifts extends \Controller
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
    }

    public function ajaxGetGiftsForm($user_id = null)
    {
        $result = [];

        $this->load->model('Blacklist_model');
        if ($this->Blacklist_model->isBlocked($user_id, $this->session->userdata('user_id'))) {
            $result['errors'] = l('you_in_blacklist', 'blacklist');
        } else {
            $this->load->library('Analytics');
            $event = $this->analytics->getEvent('virtual_gifts', 'engaged', 'user');
            $this->analytics->track($event);

            if ($this->input->post('parted')) {
                $this->view->assign('type_of_form', 'parted');
            } else {
                $this->view->assign('type_of_form', 'full');
            }
            $filters = ['is_active' => 1];
            $items_on_page = $this->pg_module->get_module_config('virtual_gifts', 'user_items_per_page');
            $gifts_count = $this->Virtual_gifts_model->getVirtualGiftsCount($filters);

            $this->load->model('Users_model');
            $user_id = intval($user_id);

            if (!empty($user_id)) {
                $user = $this->Users_model->get_users_list(null, null, null, ["where_in" => ["id" => $user_id]]);
                $this->view->assign('user_name', $user[0]["output_name"]);
            }

            if ($this->input->post('more_gifts')) {
                $page_number = intval($this->input->post('page'));
                $gifts = $this->Virtual_gifts_model->getVirtualGiftsList(
                    $filters,
                    $page_number,
                    $items_on_page,
                    ['priority' => 'asc']
                );

                if ((($page_number) * $items_on_page) >= $gifts_count) {
                    foreach ($gifts as &$gift) {
                        $gift["last"] = 1;
                    }
                }
                $this->view->assign('gifts', $gifts);

                return;
            }
            if ($items_on_page < $gifts_count) {
                $this->view->assign('show_more_btn', 1);
            }
            $gifts = $this->Virtual_gifts_model->getVirtualGiftsList(
                $filters,
                1,
                $items_on_page,
                ['priority' => 'asc']
            );

            $this->view->assign('user_id', $user_id);
            $this->view->assign('site_url', site_url());
            $this->view->assign('gifts', $gifts);

            $result = ['content' => $this->view->fetch("ajax_select_gift_form", "user", 'virtual_gifts')];
        }

        $this->view->assign($result);

        $this->view->render();
    }

    public function ajaxGetGiftData()
    {
        $id = intval($this->input->post('id'));
        $user_id = intval($this->input->post('user_id'));
        $gift_data = $this->Virtual_gifts_model->getVirtualGiftsById($id);

        $this->view->assign('gift_data', $gift_data);
        $this->view->assign('user_id', $user_id);
        $this->view->render("ajax_gift_selected_form", "user", "virtual_gifts");
    }

    public function ajaxGetUserGifts()
    {
        if ($this->input->post('user_id')) {
            $user_id = intval($this->input->post('user_id'));
            $this->view->assign('user_id', $user_id);

            $user = $this->Users_model->getUsersList(null, null, null, ["where_in" => ["id" => $user_id]]);
            $this->view->assign('user_name', $user[0]["output_name"]);

            $items_on_page = $this->pg_module->get_module_config('virtual_gifts', 'user_items_per_page');
            $gifts_count = $this->Virtual_gifts_model->getUserGiftsCount(
                $user_id,
                ['where' => ['status' => 'approved']]
            );

            $filters = [
                'where' => ['status' => 'approved'],
            ];

            if ($this->input->post('more_gifts')) {
                $page_number = intval($this->input->post('page'));
                $gifts = $this->Virtual_gifts_model->getUserGiftsList(
                    $user_id,
                    false,
                    $filters,
                    null,
                    $page_number,
                    $items_on_page
                );

                if (!empty($gifts)) {
                    $gift_sender_ids = [];
                    $formatted_users = [];
                    foreach ($gifts as $gift) {
                        $gift_sender_ids[] = $gift["fk_sender_id"];
                    }
                    $gift_sender_ids = array_unique($gift_sender_ids);
                    $users = $this->Users_model->getUsersList(
                        null,
                        null,
                        null,
                        ["where_in" => ["id" => $gift_sender_ids]]
                    );
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

                if ((($page_number) * $items_on_page) >= $gifts_count) {
                    foreach ($gifts as &$gift) {
                        $gift["last"] = 1;
                    }
                }

                echo json_encode($gifts);

                return;
            }
            if ($items_on_page < $gifts_count) {
                $this->view->assign('show_more_btn', 1);
            }
            $gifts = $this->Virtual_gifts_model->getUserGiftsList($user_id, false, $filters, null, 1, $items_on_page);
            $all_gifts = $this->Virtual_gifts_model->getUserGiftsList($user_id);
            $this->view->assign('all_gifts', $all_gifts);
            if (!empty($gifts)) {
                $gift_sender_ids = [];
                $formatted_users = [];
                foreach ($gifts as $gift) {
                    $gift_sender_ids[] = $gift["fk_sender_id"];
                }
                $gift_sender_ids = array_unique($gift_sender_ids);
                $users = $this->Users_model->getUsersListByKey(null, null, null, ["where_in" => ["id" => $gift_sender_ids]]);
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

            $this->view->assign('site_url', site_url());
            $this->view->assign('gifts', $gifts);
            $this->view->render("ajax_all_user_gifts", "user", 'virtual_gifts');
        }

        return false;
    }

    public function ajaxGetReceiptGift()
    {
        $gift_id = intval($this->input->post('gift_id'));
        $user_id = $this->session->userdata('user_id');

        $gift_data = $this->Virtual_gifts_model->getUserGiftById($gift_id);
        $this->load->model('users/models/Users_deleted_model');
        if (!empty($gift_data)) {
            $this->load->model('Users_model');
            $sender_data = current($this->Users_model->getUsersListByKey(null, null, null, [], [$gift_data['fk_sender_id']]));

            $gift_data['comment'] = trim($gift_data['comment'], "'");
            $receipt_date = strtotime($gift_data['receipt_date']);
            $gift_data['receipt_date'] = $this->pg_date->strftime('%a, %b %d', $receipt_date, 'generic');
            $gift_data['sender_data'] = [
                'user_logo' => $sender_data['media']['user_logo']['thumbs']['small'],
                'name' => $sender_data['output_name'],
                'nickname' => $sender_data['nickname'],
                'id' => $sender_data['id']
            ];
            if ($gift_data['fk_user_id'] != $user_id) {
                $gift_data = [];
            }
        }
        $this->view->assign('gift_data', $gift_data);
        $this->view->render("ajax_receipt_gift", "user", 'virtual_gifts');
    }

    public function ajaxSendGift($user_id = null, $gift_id = null)
    {
        $return = ["errors" => '', "content" => ''];

        $sender_id = $this->session->userdata('user_id');
        $gift_data = $this->Virtual_gifts_model->getVirtualGiftsById($gift_id);
        $this->view->assign('gift_data', $gift_data);
        if (empty($gift_data["is_active"]) || ($user_id == $sender_id) || empty($user_id)) {
            return redirect();
        }

        $result = $this->Virtual_gifts_model->validatePaymentData([
            "sender_id" => $sender_id,
            "gift_id" => $gift_id,
            "is_private" => $this->input->post('is_private'),
            "comment" => $this->input->post('comment')
        ]);

        $this->view->assign('is_private', $result['data']["is_private"]);
        $this->view->assign('comment', $result['data']["comment"]);

        $payment_type = $this->pg_module->get_module_config('virtual_gifts', 'payment_type');
        $pay_from_account = false;

        $this->view->assign('payment_type', $payment_type);
        $this->view->assign('user_id', $user_id);

        if ($payment_type == 'account' || $payment_type == 'account_and_direct') {
            $this->load->model("Users_payments_model");
            $user_account = $this->Users_payments_model->getUserAccount($sender_id);
            $this->view->assign('user_account', $user_account);
            if ($result['data']['price'] <= $user_account) {
                $pay_from_account = true;
            } else {
                $this->session->set_userdata('service_redirect', site_url() . 'users/view/' . $user_id);
                $return['redirect'] = site_url() . 'users/account/update';
                $return['errors'] = l('error_money_not_sufficient', 'users_payments');
                $this->view->assign($return);

                return;
            }
        }

        $this->view->assign('pay_from_account', $pay_from_account);
        $this->view->assign('is_payments_installed', $this->pg_module->is_module_installed('users_payments'));

        if ($payment_type == 'direct' || $payment_type == 'account_and_direct') {
            $this->load->model('payments/models/Payment_systems_model');
            $billing_systems = $this->Payment_systems_model->getActiveSystemList();
            $this->view->assign('billing_systems', $billing_systems);
        }

        if ($this->input->post('btn_account') || $this->input->post('btn_system')) {
            if (!empty($result["errors"])) {
                echo l('error_payment', 'virtual_gifts');
            } else {
                $sender_id = $result["data"]["sender_id"];
                $price = $result["data"]["price"];
                $result["data"]["user_id"] = $user_id;
                $payment = false;
                if ($this->input->post('btn_account')) {
                    $payment = $this->Virtual_gifts_model->accountPayment($sender_id, $price, $result["data"]);
                    if ($payment) {
                        $this->system_messages->add_message('success', l('gift_sent', 'virtual_gifts'));
                        redirect(site_url() . 'users/view/' . $user_id . '/wall');
                    }
                } elseif ($this->input->post('btn_system')) {
                    $system_gid = $this->input->post('system_gid', true);
                    $payment = $this->Virtual_gifts_model->systemPayment($system_gid, $user_id, $result["data"], $price);
                }

                if ($payment === false) {
                    echo l('error_payment', 'virtual_gifts');

                    return;
                } elseif ($payment === true) {
                    echo 'ok';

                    return;
                }
            }
        }

        $return['content'] = $this->view->fetchFinal('ajax_payment');
        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxSendGiftPayment($user_id = null, $gift_id = null)
    {
        $sender_id = $this->session->userdata('user_id');
        $user_id = intval($user_id);
        $site_url = site_url();
        $payment_status = '';
        $gift_id = intval($gift_id);
        $gift_data = $this->Virtual_gifts_model->getVirtualGiftsById($gift_id);
        if (empty($gift_data["is_active"]) || ($user_id == $sender_id) || empty($user_id)) {
            exit(json_encode(['redirect' => $site_url]));
        }

        $payment_data = [
            "sender_id" => $sender_id,
            "gift_id" => $gift_id,
            "is_private" => $this->input->post('is_private'),
            "comment" => $this->input->post('comment'),
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

        if ($this->input->post('btn_account') || $this->input->post('btn_system')) {
            if (!empty($result["errors"])) {
                echo l('error_payment', 'virtual_gifts');
            } else {
                $sender_id = $result["data"]["sender_id"];
                $price = $result["data"]["price"];
                $result["data"]["user_id"] = $user_id;
                if ($this->input->post('btn_account')) {
                    $payment = $this->Virtual_gifts_model->accountPayment($sender_id, $price, $result["data"]);
                    if ($payment) {
                        $this->system_messages->add_message('success', l('gift_sent', 'virtual_gifts'));
                    } else {
                        $this->system_messages->add_message('error', l('error_payment', 'virtual_gifts'));
                    }
                } elseif ($this->input->post('btn_system')) {
                    $system_gid = $this->input->post('system_gid', true);
                    $this->Virtual_gifts_model->systemPayment($system_gid, $user_id, $result["data"], $price);
                }
            }
        }
        exit(json_encode(['redirect' => $site_url . 'users/view/' . $user_id . '/wall']));
    }

    public function ajaxUserGiftStatus($gift_id = null, $user_id = null, $status = null)
    {
        $site_url = site_url();
        if (!$gift_id || !$user_id || !$status || ($user_id != $this->session->userdata('user_id'))) {
            $this->system_messages->add_message('success', l('error_undefined', 'virtual_gifts'));

            return redirect($site_url);
        }
        $gift_status = $this->Virtual_gifts_model->updateUserGiftStatus($gift_id, $user_id, $status);
        if ($gift_status) {
            $this->system_messages->add_message('success', $gift_status);
        } else {
            $this->system_messages->add_message('success', l('error_undefined', 'virtual_gifts'));
        }
        $referer = str_replace($site_url, '', $_SERVER['HTTP_REFERER']);
        exit(json_encode(['redirect' => $site_url . $referer]));
    }

    public function sendGiftPayment($user_id = null, $gift_id = null)
    {
        $sender_id = $this->session->userdata('user_id');
        $user_id = intval($user_id);
        $site_url = site_url();
        $gift_id = intval($gift_id);
        if (empty($gift_id)) {
            $gift_id = intval($this->input->post('gift_id'));
        }
        $gift_data = $this->Virtual_gifts_model->getVirtualGiftsById($gift_id);
        if (empty($gift_data["is_active"]) || ($user_id == $sender_id) || empty($user_id)) {
            return redirect($site_url);
        }

        $payment_data = [
            "sender_id" => $sender_id,
            "gift_id" => $gift_id,
            "is_private" => $this->input->post('is_private'),
            "comment" => $this->input->post('comment'),
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

        if ($this->input->post('btn_account') || $this->input->post('btn_system')) {
            if (!empty($result["errors"])) {
                echo l('error_payment', 'virtual_gifts');
            } else {
                $sender_id = $result["data"]["sender_id"];
                $price = $result["data"]["price"];
                $result["data"]["user_id"] = $user_id;
                if ($this->input->post('btn_account')) {
                    $payment = $this->Virtual_gifts_model->accountPayment($sender_id, $price, $result["data"]);
                    if ($payment) {
                        $this->system_messages->add_message('success', l('gift_sent', 'virtual_gifts'));
                    } else {
                        $this->system_messages->add_message('success', l('error_payment', 'virtual_gifts'));
                    }
                } elseif ($this->input->post('btn_system')) {
                    $system_gid = $this->input->post('system_gid', true);
                    $this->Virtual_gifts_model->systemPayment($system_gid, $user_id, $result["data"], $price);
                }
            }
        }

        return redirect($site_url . 'users/view/' . $user_id . '/wall', 'hard');
    }

    public function userGiftStatus($gift_id = null, $user_id = null, $status = null)
    {
        $site_url = site_url();
        if (!$gift_id || !$user_id || !$status || ($user_id != $this->session->userdata('user_id'))) {
            $this->system_messages->add_message('success', l('error_undefined', 'virtual_gifts'));

            return redirect($site_url);
        }
        $gift_status = $this->Virtual_gifts_model->updateUserGiftStatus($gift_id, $user_id, $status);
        if ($gift_status) {
            $this->system_messages->add_message('success', $gift_status);
        } else {
            $this->system_messages->add_message('success', l('error_undefined', 'virtual_gifts'));
        }
        $referer = str_replace($site_url, '', $_SERVER['HTTP_REFERER']);

        return redirect($site_url . $referer);
    }
}
