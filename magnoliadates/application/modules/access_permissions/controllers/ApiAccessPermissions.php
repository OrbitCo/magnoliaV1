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

use Pg\modules\access_permissions\models\AccessPermissionsModel;
use Pg\modules\access_permissions\models\AccessPermissionsGroupsModel;

/**
 * Access_permissions api side controller
 *
 * @package PG_Dating
 * @subpackage  Access_permissions
 * @category    controllers
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class ApiAccessPermissions extends \Controller
{

    /**
     * Controller
     *
     * @return Access_permissions_start
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Access_permissions_model');
        $this->load->model([
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model',
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_modules_model',
        ]);
    }

    /**
     * Display index page
     *
     * @return void
     */

    /**
    * @api {post} /access_permissions/index   Display index page
    * @apiGroup Access permissions
    */
    public function index()
    {
        $this->load->model([
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_users_model',
            'payments/models/Payment_systems_model',
        ]);
        $user_groups = $this->Access_permissions_users_model->getUserGroup([
                'where' => [
                    'id_user' => $this->session->userdata('user_id'),
                    'is_active' => 1
                ]
            ], 'current_name', 'gid');

        if (empty($user_groups)) {
            $default_group = $this->Access_permissions_groups_model->getGroupByGid(
                AccessPermissionsGroupsModel::DEFAULT_GROUP,
                true
            );
            $user_groups = [$default_group['gid'] => $default_group['current_name']];
        }
        $groups = $this->Access_permissions_groups_model->formatGroups(
            $this->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
        );
        $periods = $this->Access_permissions_settings_model->getAccessData(
            $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
        )->getPriceGroups($this->session->userdata['user_type']);
        $format_groups = $this->Access_permissions_model->formatGroups($groups, $periods);
        $billing_systems = $this->Payment_systems_model->getActiveSystemList();
        $data['billing_systems'] = $billing_systems;
        $data['groups'] = $format_groups;
        $data['user_groups'] = $user_groups;
        $this->set_api_content('data', $data);
    }

    /**
     * Group Page
     *
     * @param string $gid
     * @param integer $period
     *
     * @return array
     */
    /**
    * @api {post} /access_permissions/groupPage Group Page
    * @apiGroup Access permissions
    * @apiParam {string} gid Group gid
    * @apiParam {int} period Period id
    */
    public function groupPage($gid, $period = null)
    {
        if (!$gid) {
            $this->set_api_content('error', l('error_unknown_group', AccessPermissionsModel::MODULE_GID));
        } else {
            $group = $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
            )->getGroup(['group_gid' => $gid, 'period_id' => $period]);
            if (empty($group)) {
                $this->set_api_content('error', l('error_group_missing', AccessPermissionsModel::MODULE_GID));
            }
            $this->set_api_content('data', $group);
        }
    }

    /**
     * Purchase
     *
     * @return boolean/array
     */
      /**
    * @api {post} /access_permissions/payment Purchase
    * @apiGroup Access permissions
    * @apiParam {string} group_gid Group gid
    * @apiParam {int} period_id Period id
    * @apiParam {string} pay_system_gid Payment system gid
    */
    public function payment()
    {
        if ($this->input->post('send')) {
            $user_id = $this->session->userdata('user_id');
            $post_data = [
                'group_gid' => filter_input(INPUT_POST, 'group_gid', FILTER_SANITIZE_STRING),
                'period_id' => filter_input(INPUT_POST, 'period_id', FILTER_VALIDATE_INT),
                'pay_system_gid' => filter_input(INPUT_POST, 'pay_system_gid', FILTER_SANITIZE_STRING),
            ];
            $result['data'] = $this->Access_permissions_model->groupPayment($post_data, $user_id);
            if (isset($result['data']['success'])) {
                $result['success'] = $result['data']['success'];
                $this->set_api_content("success", $result['success']);
                return;
            } elseif (isset($result['data']['error'])) {
                $result['error'] = $result['data']['error'];
                $this->set_api_content("error", $result['error']);
                return;
            }
        } else {
            $result['error'] = l('error_system', AccessPermissionsModel::MODULE_GID);
            $this->set_api_content("error", $result['error']);
        }
    }
}
