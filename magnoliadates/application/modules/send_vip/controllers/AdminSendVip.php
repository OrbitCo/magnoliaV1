<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\controllers;

use Pg\Libraries\View;

/**
 * Send VIP module
 *
 * @package     PG_DatingPro
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Send VIP admin side controller
 *
 * @package     PG_DatingPro
 * @subpackage  Send vip
 *
 * @category    controllers
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AdminSendVip extends \Controller
{
    /**
     * Controller
     *
     * @return Admin_Send_vip
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Send_vip_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'add_ons_items');
    }

    /**
     * Manage module settings
     *
     * @return void
     */
    public function index()
    {
        $this->settings();
    }

    /**
     * Manage module settings
     *
     * @return void
     */
    public function settings()
    {
        $this->load->model('payments/models/Payment_currency_model');
        $base_currency = $this->Payment_currency_model->getCurrencyDefault(true);
        $currencies = ['%', $base_currency['gid']];
        if ($this->input->post('btn_save')) {
            $post_data['use_fee'] = $this->input->post('use_fee', true);
            $post_data['fee_price'] = $this->input->post('fee_price', true);
            $post_data['fee_currency'] = $this->input->post('fee_currency', true);
            $post_data['to_whom'] = $this->input->post('to_whom', true);
            $post_data['transfer_type'] = $this->input->post('transfer_type', true);
            $post_data['currencies'] = $currencies;
            if (!isset($post_data['fee_price']) || empty($post_data['fee_price'])) {
                $post_data['fee_price'] = $this->pg_module->get_module_config('send_money', 'fee_price');
            }
            if (!isset($post_data['fee_currency']) || empty($post_data['fee_currency'])) {
                $post_data['fee_currency'] = $this->pg_module->get_module_config('send_money', 'fee_currency');
            }
            $validate_data = $this->Send_vip_model->validateSettings($post_data);
            if (!empty($validate_data['errors'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
            } else {
                foreach ($validate_data['data'] as $setting => $value) {
                    $this->pg_module->set_module_config('send_vip', $setting, $value);
                }
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_settings_saved', 'send_vip'));
            }
            $data = $validate_data['data'];
        } else {
            $data['use_fee'] = $this->pg_module->get_module_config('send_vip', 'use_fee');
            $data['fee_price'] = $this->pg_module->get_module_config('send_vip', 'fee_price');
            $data['to_whom'] = $this->pg_module->get_module_config('send_vip', 'to_whom');
            $data['transfer_type'] = $this->pg_module->get_module_config('send_vip', 'transfer_type');
            $data['fee_currency']  = $this->pg_module->get_module_config('send_vip', 'fee_currency');
        }
        $data['transfer_types'] = $this->Send_vip_model->getAllowedPaymentTypes();
        foreach ($data['transfer_types'] as $key => $transfer_type) {
            $data['transfer_types'][$transfer_type] = l('admin_settings_' . $transfer_type, 'send_vip');
            unset($data['transfer_types'][$key]);
        }
        $data['currencies'] = $currencies;

        $this->view->assign('data', $data);
        $this->view->setHeader(l('admin_header_settings', 'send_vip'));
        $this->view->setBackLink(site_url() . 'admin/start/menu/add_ons_items');
        $this->Menu_model->set_menu_active_item('admin_send_vip_menu', 'send_vip_settings_item');
        $this->view->render('settings');
    }

    public function view($page = 1)
    {

        $transactions_count = $this->Send_vip_model->getTransactionsCount();
        if ($transactions_count > 0) {
            $this->load->model([
                'Users_model', 'Access_permissions_model',
                'access_permissions/models/Access_permissions_groups_model'
            ]);

            $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $transactions_count, $items_on_page);

            $data = $this->Send_vip_model->getTransaction(null, $page, $items_on_page);
            $this->load->helper("navigation");
            $url = site_url() . "admin/send_vip/view/";
            $page_data = get_admin_pages_data($url, $transactions_count, $items_on_page, $page, 'briefPage');
            $this->view->assign('page_data', $page_data);

            $id_users_arr = [];
            foreach ($data as $value) {
                $id_users_arr[] = $value['id_user'];
                $id_users_arr[] = $value['id_sender'];
            }
            $users_arr = $this->Users_model->getUsersListByKey(null, null, null, null, array_unique($id_users_arr), false);
            $memberships_names = $this->Access_permissions_groups_model->getActivePaidGroups();
            foreach ($data as $key => $value) {
                $data[$key]['user'] = $users_arr[$value['id_user']]['nickname'];
                $data[$key]['sender_user'] = $users_arr[$value['id_sender']]['nickname'];
                $data[$key]['transfer_fee'] = number_format((float)$data[$key]['transfer_fee'], 2, '.', '');
                $data[$key]['rand'] = mt_rand(0, 10000);
                $data[$key]['membership_name'] = $memberships_names['short'][$data[$key]['membership_obj']]['title'];
            }
            $this->view->assign('data', $data);
        }
        $this->view->assign('count', $transactions_count);
        $this->view->setHeader(l('admin_header_view', 'send_vip'));
        $this->view->setBackLink(site_url() . 'admin/start/menu/add_ons_items');
        $this->Menu_model->setMenuActiveItem('admin_send_vip_menu', 'send_vip_view_item');
        $this->view->render('view');
    }
}
