<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\controllers;

/**
 * AccessPermission module
 *
 * @package PG_Dating
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

use Pg\modules\access_permissions\models\AccessPermissionsModel;
use Pg\modules\access_permissions\models\AccessPermissionsSettingsModel;
use Pg\modules\access_permissions\models\AccessPermissionsGroupsModel;
use Pg\Libraries\View;

/**
 * AccessPermission admin side controller
 *
 * @package PG_Dating
 * @subpackage  AccessPermission
 * @category    controllers
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AdminAccessPermissions extends \Controller
{

    /**
     * Module URL
     *
     * @var string
     */
    public $module_url;

    /**
     * Controller
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Access_permissions_model', 'Menu_model']);
        $this->load->model([
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model',
        ]);
        $this->Menu_model->set_menu_active_item('admin_menu', 'payments_menu_item');
        $this->module_url = site_url() . 'admin/' . AccessPermissionsModel::MODULE_GID;
    }

    /**
     * Display index page
     *
     * @return void
     */
    public function index()
    {
        return $this->registered();
    }

    /**
     * Display registered page
     *
     * @param string $user_types
     *
     * @return void
     */
    public function registered($user_type = 'male')
    {
        $subscription_type = $this->Access_permissions_settings_model->getSubscriptionType(AccessPermissionsSettingsModel::TYPE);
        if ($subscription_type == 'user_types') {
            $user_type = $this->Access_permissions_model->defUserType($user_type);
            return $this->userTypes($user_type);
        } else {
            return $this->mainPage(['role' => 'user']);
        }
    }

    /**
     * Display guests page
     *
     * @return void
     */
    public function guest()
    {
        return $this->mainPage(['role' => 'guest']);
    }

    /**
     * Display user types page
     *
     * @param string $user_type
     *
     * @return void
     */
    public function userTypes($user_type = 'male')
    {
        $user_type = $this->Access_permissions_model->defUserType($user_type);
        $this->Menu_model->setMenuActiveItem('admin_access_user_types_menu', $user_type);
        $this->Access_permissions_settings_model->getAccessData(
            $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
        )->user_type = $user_type;
        return $this->mainPage([
            'role' => 'user',
            'type' => $user_type
        ]);
    }

    /**
     * Save module settings
     *
     * @return  void
     */
    public function saveSubscriptionType()
    {
        if ($this->input->post('send')) {
            $subscription = [
                'type' => filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING),
                'data' => filter_input(INPUT_POST, 'data', FILTER_VALIDATE_INT),
            ];
            $role = [
                'role' => AccessPermissionsModel::USER,
                'type' => filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING) ?: 'male'
            ];

            if ($subscription['type'] == 'user_types') {
                $this->load->model('users/models/Users_types_model');
                $user_types = $this->Users_types_model->getCountTypes();
                if ($user_types == 0) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('error_save_subscription_type', AccessPermissionsModel::MODULE_GID));
                    return;
                } else {
                    $role['type'] = $this->Access_permissions_model->defUserType($role['type']);
                }
            }

            $this->Access_permissions_settings_model->saveSubscriptionType($subscription);
            $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles[AccessPermissionsModel::USER]
            )->changeGroups();
            $this->view->assign('subscription_type', [$subscription]);
            $this->view->assign('role', $role);
            $result['html'] = $this->view->fetch('list_settings');
            $result['success'] = l('success_save_subscription_type', AccessPermissionsModel::MODULE_GID);
        } else {
            $result['error'][] = l('error_save_subscription_type', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Load Subscription Form
     *
     * @return  void
     */
    public function loadSubscriptionForm()
    {
        if ($this->input->post('send')) {
            $subscription_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if ($subscription_id > 0) {
                $langs_ids = array_keys($this->pg_language->languages);
                $this->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model');
                $subscriptions = $this->Access_permissions_groups_model->getGroupById($subscription_id, $langs_ids);
                $subscription  = current($this->Access_permissions_groups_model->formatGroups($subscriptions));

                $new_sub =  [];
                foreach ($subscription as $key => $sub) {
                    if (is_array($sub)) {
                        $new_sub[$key] = $sub;
                    } else {
                        $new_sub[$key] = html_entity_decode((string)$sub, ENT_QUOTES);
                    }
                }
                $subscription = $new_sub;

                $this->view->assign('subscription', $subscription);
            }
            $data = ['action' => $this->module_url . '/editSubscription'];
            $this->view->assign('data', $data);
            $this->view->assign('langs', $this->pg_language->languages);
            $this->view->assign('current_lang_id', $this->pg_language->current_lang_id);
            $result['html'] = $this->view->fetch('subscription_form');
        } else {
            $result['error'][] = l('error_load_form', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Create/Update Subscription Data
     *
     * @return void
     */
    public function editSubscription()
    {
        $post_data = $this->input->post('data', true);
        $id = !empty($post_data['id']) ? intval($post_data['id']) : null;
        if (!empty($post_data)) {
            $post_data =  filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        }

        $this->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model');
        $validate_data = $this->Access_permissions_groups_model->validateSubscription($id, $post_data);
        if (!empty($validate_data["errors"])) {
            $result['error'] = $validate_data['errors'];
        } else {
            $result['id'] = $this->Access_permissions_groups_model->saveSubscription($id, $validate_data['data']);
            if ($result['id']) {
                if (is_null($id)) {
                    $this->Access_permissions_groups_model->addPeriod($validate_data['data']['gid']);
                    $this->Access_permissions_model->callbackGroupAdd($validate_data['data']['gid']);
                }
                $this->load->library('user_agent');
                $type = explode('/', $this->agent->referrer())[6] ?? '';
                $userTypes = explode('/', $this->agent->referrer())[5] ?? '';
                if ($userTypes == 'userTypes' && !empty($type)) {
                    $result['url_reload'] = $this->module_url . '/userTypes/' . $type;
                } else {
                    $result['url_reload'] = $this->module_url;
                }

                if (!$id) {
                    $this->load->library('Analytics');
                    $event = $this->analytics->getEvent('access_permissions', 'create_subscription', 'admin');
                    $this->analytics->track($event);
                }
                $result['success'] = l('success_save', AccessPermissionsModel::MODULE_GID);
            } else {
                $result['error'][] = l('error_system', AccessPermissionsModel::MODULE_GID);
            }
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Delete Subscription
     *
     * @return void
     */
    public function deleteSubscription()
    {
        $result = ['is_delete' => 0];
        if ($this->input->post('send')) {
            $subscription_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $subscription_gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);
            $this->load->model([AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
                AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_users_model']);
            $result = $this->Access_permissions_groups_model->deleteSubscription($subscription_id);
            $this->Access_permissions_groups_model->deletePeriod($subscription_gid);
            $this->Access_permissions_users_model->deleteGroupUsers($subscription_gid);
            $this->Access_permissions_model->callbackGroupDelete($subscription_gid);
        } else {
            $result['error'][] = l('error_system', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Change Status Subscription
     *
     * @return array
     */
    public function statusSubscription()
    {
        if ($this->input->post('send')) {
            $subscription = [
                'id' => filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT),
                'gid' => filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING),
                'status' => filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT),
            ];
            $this->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model');
            $result  = $this->Access_permissions_groups_model->changeStatusSubscription($subscription);
        } else {
            $result['errors'][] = l('error_system', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Main Page
     *
     * @param array $page_data
     *
     * @return void
     */
    private function mainPage(array $page_data)
    {
        $this->view->assign('role', $page_data);
        $subscription_type = $this->Access_permissions_settings_model->getModuleSettings(AccessPermissionsSettingsModel::TYPE);
        $this->view->assign('subscription_type', json_decode($subscription_type));
        $this->view->setBackLink(site_url() . "admin/payments/index");
        $this->view->setHeader(l('admin_header_subscription', AccessPermissionsModel::MODULE_GID));

        $this->load->model('users/models/Users_types_model');
        $user_types = $this->Users_types_model->getCountTypes();
        $this->view->assign('count_user_types', $user_types);

        $this->view->render('index');
    }

    /**
     * Load permissions list
     *
     * @return array
     */
    public function loadPermissionsList()
    {
        if ($this->input->post('send')) {
            $permissions_data = [
                'module_gid' => filter_input(INPUT_POST, 'module_gid', FILTER_SANITIZE_STRING),
                'method' => filter_input(INPUT_POST, 'method', FILTER_SANITIZE_STRING),
                'access' => filter_input(INPUT_POST, 'access', FILTER_VALIDATE_INT),
                'user_type' => filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING),
            ];
            $this->Access_permissions_settings_model
                ->getAccessData($permissions_data['access'])
                ->user_type = $permissions_data['user_type'];

            $this->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_modules_model');
            $module_data = current($this->Access_permissions_modules_model->getModulesList(['where' => [
                'access' => $permissions_data['access'],
                'module_gid' => $permissions_data['module_gid'],
                'method' => !empty($permissions_data['method']) ? $permissions_data['method'] : null
            ]]));
            if (!empty($permissions_data['user_type'])) {
                $module_data['user_type'] = $permissions_data['user_type'];
            }
            $access = $this->Access_permissions_settings_model
                ->getAccessData($module_data['access'])
                ->permissionsList($module_data, true);

            if ($permissions_data['access'] > 1) {
                $groups = $this->Access_permissions_groups_model->formatGroups(
                    $this->Users_model->getUserTypesGroups()
                );
                $this->view->assign('groups', $groups);
            }
            $data = [
                'action' => $this->module_url . '/editPermissions',
                'permissions' => $permissions_data
            ];
            $this->view->assign('data', $data);
            $this->view->assign('access', $access);
            $result['html']   = $this->view->fetch('access_settings');
        } else {
            $result['error'][] = l('error_system', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Edit permissions
     *
     * @return array
     */
    public function editPermissions()
    {
        if ($this->input->post('send')) {
            $module = $this->input->post('module');
            $permissions = $this->input->post('permissions');
            $validate_data = $this->Access_permissions_settings_model
                ->getAccessData($module['access'])->validatePermissions($permissions, $module, true);
            if (empty($validate_data["errors"])) {
                foreach ($validate_data['data'] as $data) {
                    $this->Access_permissions_settings_model->getAccessData($module['access'])->savePermissions($data['attrs'], $data['params']);
                    if (isset($data['settings'])) {
                        $this->Access_permissions_settings_model->getAccessData($module['access'])->savePermissionsSettings($data['settings']);
                    }
                }
                $type = isset($permissions['user_type']) ? 'userTypes/' . $permissions['user_type'] : $this->Access_permissions_settings_model->getAccessData($module['access'])->role_type;
                $result['url_reload'] = $this->module_url . '/' . $type;

                $this->load->library('Analytics');
                $event = $this->analytics->getEvent('access_permissions', 'edit_permission', 'admin');
                $this->analytics->track($event);
            } else {
                $result['error'] = $validate_data['errors'];
            }
        }
        $this->view->assign($result);
        $this->view->render();
    }

     /**
     * Load Subscription Form
     *
     * @return  void
     */
    public function loadPeriodForm()
    {
        if ($this->input->post('send')) {
            $period_id =  filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?: null;
            $user_type =  !empty($this->input->post('user_type')) ? filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING) : '';
            $this->Access_permissions_settings_model
                ->getAccessData($this->Access_permissions_model->roles[AccessPermissionsModel::USER])
                ->user_type = $user_type;
            $where = ['where' => ['is_default' => 0, 'is_trial' => 0]];
            $period = $this->Access_permissions_settings_model
                ->getAccessData($this->Access_permissions_model->roles[AccessPermissionsModel::USER])
                ->getPeriodById($period_id, $where);
            $this->view->assign('period', $period);
            $data = [
                'action' => $this->module_url . '/editPeriod/' . intval($period_id),
                'user_type' => $user_type
            ];
            $this->view->assign('data', $data);
            $groups = $this->Access_permissions_groups_model->formatGroups(
                $this->Users_model->getUserTypesGroups($where)
            );
            $this->view->assign('groups', $groups);
            $result['html'] = $this->view->fetch('period_form');
        } else {
            $result['error'][] = l('error_load_form', AccessPermissionsModel::MODULE_GID);
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Edit period
     *
     * @param integer $id
     *
     * @return array
     */
    public function editPeriod($id)
    {
        if ($this->input->post('data')) {
            $post_data = $this->input->post('data', true);
            $validate_data = $this->Access_permissions_settings_model
                ->getAccessData($this->Access_permissions_model->roles[AccessPermissionsModel::USER])
                ->validatePeriod($post_data, !$id);
            if (!empty($validate_data['errors'])) {
                $result = ['error' => $validate_data['errors']];
            } else {
                 $this->Access_permissions_settings_model
                    ->getAccessData($this->Access_permissions_model->roles[AccessPermissionsModel::USER])
                    ->savePeriod($id, $validate_data['data']);

                $this->load->library('Analytics');
                $event = $this->analytics->getEvent('access_permissions', 'edit_period', 'admin');
                $this->analytics->track($event);
            }
        } else {
            $result = ['error' => [l('error_system', AccessPermissionsModel::MODULE_GID)]];
        }
        $result['url_reload'] = $this->module_url . '/registered/' . $post_data['user_type'];
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Period delete
     *
     * @param integer $id
     *
     * @return void
     */
    public function periodDelete($id = null)
    {
        if (is_null($id)) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_system', AccessPermissionsModel::MODULE_GID));
        } else {
            $this->Access_permissions_settings_model
                ->getAccessData($this->Access_permissions_model->roles[AccessPermissionsModel::USER])
                ->deletePeriod($id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_period', AccessPermissionsModel::MODULE_GID));
        }
        $this->view->setRedirect($this->module_url . '/registered/');
    }

    /**
     * Membership change
     *
     * @return string
     */
    public function membershipChange()
    {
        $this->load->model('access_permissions/models/Access_permissions_groups_model');
        $result = ['groups' => $this->Access_permissions_groups_model->getActivePaidGroups()];
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Add membership
     *
     * @return void
     */
    public function addMembership()
    {
        if (filter_input(INPUT_POST, 'send', FILTER_VALIDATE_INT) === 1) {
            $membership = filter_input(INPUT_POST, 'membership', FILTER_SANITIZE_STRING);
            $period = filter_input(INPUT_POST, 'period', FILTER_VALIDATE_INT);
            $users = filter_input_array(INPUT_POST, ['user_ids' => ['filter' => FILTER_VALIDATE_INT, 'flags' => FILTER_REQUIRE_ARRAY,]]);
            $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);
            if (!empty($users['user_ids'])) {
                $data = !empty($user_type) ? ['user_type' => $user_type] : [];
                $group_data = $this->ci->Access_permissions_settings_model
                ->getAccessData($this->ci->session->userdata['auth_type'], $data)
                ->getGroupData($membership, ['where' => ['id' => $period]]);
                $this->load->model(['Chatbox_model', 'Users_model']);
                foreach ($users['user_ids'] as $user_id) {
                    $this->Access_permissions_model->applyGroup($group_data, $user_id);
                    $group = $this->Access_permissions_users_model->getUserGroup([
                        'where' => [
                            'id_user' => $user_id,
                            'is_active' => 1
                        ]
                    ]);
                    $group['date_expired'] = date('Y-m-d', strtotime($group['date_expired']));
                    $result['group'][$user_id] = !empty($group) ? $group :
                        current($this->Access_permissions_groups_model->getGroupByGid(
                            AccessPermissionsGroupsModel::DEFAULT_GROUP,
                            true
                        ));
                    $recipient = $this->Users_model->getUserById($user_id, true);    
                    $period_str = AccessPermissionsModel::formatPeriod($group_data['period']['period'], $recipient['lang_id']);
                    $message = ' 🎉 ' . l('admin_send_membership', 'access_permissions', $recipient['lang_id']) . ' - ' . $group_data['current_name'] . ' ' . $period_str;
                    $this->Chatbox_model->addMessage($user_id, $user_id, $message, true, true);
                }
                $result['success'] = [l('success_save', 'access_permissions')];
            } else {
                $result = ['error' => [l('error_no_users_to_change_group', 'users')]];
            }
            $this->view->assign($result);
            $this->view->render();
        }
    }
}
