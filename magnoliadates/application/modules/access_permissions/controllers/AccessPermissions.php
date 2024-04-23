<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\controllers;

/**
 * Access_permissions module
 *
 * @package PG_Dating
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

use Pg\Libraries\View;
use Pg\modules\access_permissions\models\AccessPermissionsModel;
use Pg\modules\access_permissions\models\AccessPermissionsGroupsModel;

/**
 * Access_permissions user side controller
 *
 * @package PG_Dating
 * @subpackage  Access_permissions
 * @category    controllers
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class AccessPermissions extends \Controller
{

    /**
     * AccessPermissions constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Access_permissions_model');
        $this->load->model([
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model',
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_modules_model',
        ]);
        $this->view->assign('header_type', AccessPermissionsModel::MODULE_GID);
    }

    /**
     * Display index page
     *
     * @return void
     */
    public function index()
    {
        if ($this->isAuth() === true) {
            $this->load->model([
                AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
                AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_users_model',
                'payments/models/Payment_systems_model',
            ]);

            $groups = $this->Access_permissions_groups_model->formatGroups(
                $this->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
            );

            $periods = $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
            )->getPriceGroups($this->session->userdata['user_type']);

            $format_groups = $this->Access_permissions_model->formatGroups($groups, $periods);

            $billing_systems = $this->Payment_systems_model->getActiveSystemList();
            $this->view->assign('billing_systems', $billing_systems);
            $this->view->assign('groups', $format_groups);

            $this->view->render('index');
        }
    }

    private function isAuth()
    {
        if ($this->session->userdata['auth_type'] == 'user') {
            $this->load->model('Users_model');
            $user = $this->Users_model->getUserById($this->session->userdata['user_id']);
            if (!empty($user)) {
                return true;
            }
        }
        $this->system_messages->clean_messages();
        $this->system_messages->addMessage(View::MSG_ERROR, l('text_login', 'users'));
        $this->view->setRedirect(site_url('users/logout'));
    }

    /**
     * Group Page
     *
     * @param string $gid
     * @param integer $period
     *
     * @return void
     */
    public function groupPage($gid, $period)
    {
        if (
            !$gid || in_array($gid, [AccessPermissionsGroupsModel::DEFAULT_GROUP,
            AccessPermissionsGroupsModel::TRIAL_GROUP]) === true
        ) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_unknown_group', AccessPermissionsModel::MODULE_GID));
            $this->view->setRedirect(site_url() . AccessPermissionsModel::MODULE_GID);
        } else {
            $group = $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
            )->getGroup(['group_gid' => $gid, 'period_id' => $period]);
            if (empty($group)) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_group_missing', AccessPermissionsModel::MODULE_GID));
                $this->view->setRedirect(site_url() . AccessPermissionsModel::MODULE_GID);
            }
            $this->view->assign('group', $group);
        }
        $this->Menu_model->breadcrumbs_set_parent('access_permissions_menu_item');
        $this->Menu_model->breadcrumbs_set_active($group['name']);
        $this->view->render('group_page');
    }

    /**
     * Group
     *
     * @return void
     */
    public function group()
    {
        if ($this->input->post('send')) {
            $post_data = [
               'group_gid' => filter_input(INPUT_POST, 'group_gid', FILTER_SANITIZE_STRING),
               'period_id' => filter_input(INPUT_POST, 'period_id', FILTER_VALIDATE_INT),
            ];
            $group = $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
            )->getGroup($post_data);
            $this->view->assign('group', $group);
            $result['html'] = $this->view->fetch('group');
        } else {
            $result = [
               'error' => [l('error_system', AccessPermissionsModel::MODULE_GID)]
            ];
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Payment Form
     *
     * @return void
     */
    public function paymentForm()
    {
        if ($this->input->post('send')) {
             $post_data = [
                'group_gid' => filter_input(INPUT_POST, 'group_gid', FILTER_SANITIZE_STRING),
                'period_id' => filter_input(INPUT_POST, 'period_id', FILTER_VALIDATE_INT),
                'pay_system_gid' => filter_input(INPUT_POST, 'pay_system_gid', FILTER_SANITIZE_STRING),
             ];
             $result = $this->Access_permissions_model->getPaymenData($post_data);
             if (!empty($result['errors'])) {
                 $result['error'] = $result['errors'];
             } else {
                 $this->view->assign('payment_data', $result['data']);
                 if ($result['data']['disable_account_pay'] === true) {
                     $this->load->model('payments/models/Payment_systems_model');
                     $billing_systems = $this->Payment_systems_model->getActiveSystemList();
                     $this->view->assign('billing_systems', $billing_systems);
                     $result['html'] = $this->view->fetch('deficit_funds', null, 'users_payments');
                 } else {
                     $result['html'] = $this->view->fetch('payment_form');
                 }
             }
        } else {
            $result = [
               'error' => [l('error_system', AccessPermissionsModel::MODULE_GID)]
            ];
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Purchase
     *
     * @return boolean/array
     */
    public function payment()
    {
        if ($this->input->post('send')) {
            $user_id = $this->session->userdata('user_id');
            $post_data = [
                'group_gid' => filter_input(INPUT_POST, 'group_gid', FILTER_SANITIZE_STRING),
                'period_id' => filter_input(INPUT_POST, 'period_id', FILTER_VALIDATE_INT),
                'user_type' => filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING),
                'pay_system_gid' => filter_input(INPUT_POST, 'pay_system_gid', FILTER_SANITIZE_STRING),
                'is_recurring' => filter_input(INPUT_POST, 'is_recurring', FILTER_VALIDATE_INT),
            ];
            $result = $this->Access_permissions_model->groupPayment($post_data, $user_id);
            $result['redirect'] = $this->session->userdata['service_redirect'] ?: '';
            $this->session->set_userdata(['service_redirect' => '']);
            $this->view->assign('result', $result);
             $result['html'] = $this->view->fetch('payment');
        } else {
            $result = [
                'error' => [l('error_system', AccessPermissionsModel::MODULE_GID)]
            ];
        }
        $this->view->assign($result);
        $this->view->render();
    }
}
