<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models;

use Pg\modules\payments\models\PaymentsModel;
use Pg\Libraries\Acl\Driver\DbDriver;
use Pg\Libraries\EventDispatcher;
use Pg\modules\access_permissions\models\events\EventAccessPermissions;
use Pg\Libraries\Traits\ModuleModel;

define('PERMISSIONS_TABLE', DB_PREFIX . DbDriver::PERMISSIONS_TABLE);

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AccessPermissionsModel extends \Model
{
    use ModuleModel;

    /**
     * Module GUID
     *
     * @var string
     */
    public const MODULE_GID = 'access_permissions';

    /**
     * Payment type as write off from account
     *
     * @var string
     */
    public const PAYMENT_TYPE_ACCOUNT = 'account';

    /**
     * Payment type as write off from account and direct payment
     *
     * @var string
     */
    public const PAYMENT_TYPE_ACCOUNT_AND_DIRECT = 'account_and_direct';

    /**
     * Payment type as direct payment
     *
     * @var string
     */
    public const PAYMENT_TYPE_DIRECT = 'direct';

    /**
     * Payment type gid prefix
     *
     * @var string
     */
    public const PAYMENT_TYPE_GID_PREFIX = 'access_permissions_';

    /**
     * Authorized user
     *
     * @var string
     */
    public const USER = 'user';

    /**
     * Authorized user (admin)
     *
     * @var string
     */
    public const ADMIN = 'admin';

    /**
     * Unauthorized user
     *
     * @var string
     */
    public const GUEST = 'guest';

    /**
     * Period type in years
     *
     * @var string
     */
    public const PERIOD_TYPE_YEARS = 'years';

    /**
     * Period type in months
     *
     * @var string
     */
    public const PERIOD_TYPE_MONTHS = 'months';

    /**
     * Period type in days
     *
     * @var string
     */
    public const PERIOD_TYPE_DAYS = 'days';

    /**
     * Period type in hours
     *
     * @var string
     */
    public const PERIOD_TYPE_HOURS = 'hours';

    /**
     * Date format
     *
     * @var string
     */
    public const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * User Roles
     *
     * @var array
     */
    public $roles = [
        self::GUEST => 1,
        self::USER => 2,
        self::ADMIN => 2,
    ];

    /**
     * AccessPermissionsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(PERMISSIONS_TABLE);
    }

    /**
     * Return allowed period types as array
     *
     * @return array
     */
    public function getAllowedPeriodTypes()
    {
        return [
            self::PERIOD_TYPE_HOURS,
            self::PERIOD_TYPE_DAYS,
            self::PERIOD_TYPE_MONTHS,
            self::PERIOD_TYPE_YEARS,
        ];
    }

    /**
     * Return allowed payments types as array
     *
     * @return array
     */
    public function getAllowedPaymentTypes(): array
    {
        return [
            self::PAYMENT_TYPE_ACCOUNT,
            self::PAYMENT_TYPE_DIRECT,
            self::PAYMENT_TYPE_ACCOUNT_AND_DIRECT,
        ];
    }

    /**
     * Format subscriptions
     *
     * @param array $subscriptions
     * @param array $periods
     *
     * @return array
     */
    public function formatGroups(array $subscriptions, array $periods)
    {
        $this->ci->load->model([self::MODULE_GID . '/models/Access_permissions_users_model',
            self::MODULE_GID . '/models/Access_permissions_groups_model']);
        $user_group = $this->ci->Access_permissions_users_model->getUserGroup([
            'where' => [
                'id_user' => $this->ci->session->userdata('user_id'),
                'is_active' => 1
            ]
        ], 'gid');
        foreach ($subscriptions as $gid => $subscription) {
            if (!$subscription['is_default']) {
                if ($subscription['is_trial']) {
                    $subscriptions[$gid]['trial_period_str'] = $this->ci->Access_permissions_groups_model->getTrialPeriodStr($subscription['trial_period']);
                    $subscriptions[$gid]['trial_period_left'] = $this->ci->Access_permissions_users_model->getTrialPeriodLeft();
                } else {
                    $subscriptions[$gid]['is_purchased'] = in_array($gid, $user_group);
                    foreach ($periods as $key => $period) {
                        $subscriptions[$gid]['periods'][$key]['id'] = $period['id'];
                        $subscriptions[$gid]['periods'][$key]['period'] = $period['period'];
                        $subscriptions[$gid]['periods'][$key]['period_str'] = self::formatPeriod($period['period']);
                        $subscriptions[$gid]['periods'][$key]['price'] = $period[$gid . '_group'];
                    }
                }
            }
        }

        return $this->ci->Access_permissions_settings_model
            ->getAccessData($this->roles[$this->ci->session->userdata['auth_type']])
            ->permissionsGroup($subscriptions);
    }

    /**
     * Add column
     *
     * @param string $group_gid
     *
     * @return void
     */
    public function callbackGroupAdd(string $group_gid)
    {
        if ($group_gid) {
            $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
            $this->Access_permissions_settings_model
                ->getAccessData($this->roles[self::USER])->addGroup($group_gid);
        }
    }

    /**
     * Delete column
     *
     * @param string $group_gid
     *
     * @return void
     */
    public function callbackGroupDelete($group_gid)
    {
        if ($group_gid) {
            $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
            $this->ci->Access_permissions_settings_model
                ->getAccessData($this->roles[self::USER])->groupDelete($group_gid);
        }
    }

    /**
     * Add new user type
     *
     * @param bool|string $gid user type GUID
     *
     * @return void
     */
    public function calbackAddUserType($gid = false)
    {
        if ($gid !== false) {
            $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
            $this->ci->Access_permissions_settings_model
                ->getAccessData($this->roles[self::USER])->addUserType($gid);
        }
    }

    public function calbackDeleteUserType($gid)
    {
        $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
        $this->ci->Access_permissions_settings_model
            ->getAccessData($this->roles[self::USER])->deleteUserType($gid);
    }

    /**
     * Format Amount
     *
     * @param int $period
     *
     * @return string
     */
    public static function formatPeriod($period, $lang_id = null)
    {
        $num = $period % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1:
                return $period . '&nbsp;' . l('field_format_day', self::MODULE_GID, $lang_id);
            case 2:
            case 3:
            case 4:
                return $period . '&nbsp;' . l('field_format_days', self::MODULE_GID, $lang_id);
            default:
                return $period . '&nbsp;' . l('field_days', self::MODULE_GID, $lang_id);
        }
    }

    /**
     * Payment Data
     *
     * @param array $data
     *
     * @return array
     */
    public function getPaymenData(array $data)
    {
        $return = ['errors' => [], 'data' => []];
        $this->ci->load->model([
            self::MODULE_GID . '/models/Access_permissions_groups_model',
            self::MODULE_GID . '/models/Access_permissions_settings_model',
            PaymentsModel::MODULE_GID . '/models/Payment_systems_model',
            'Users_payments_model'
        ]);
        $return['data']['user_account'] = $this->ci->Users_payments_model->getUserAccount($this->ci->session->userdata['user_id']);
        if (!empty($data['group_gid'])) {
            $return['data']['group'] = $this->ci->Access_permissions_groups_model->getGroupByGid($data['group_gid']);
            if (!empty($data['period_id'])) {
                $where = ['where' => ['is_default' => 0, 'is_trial' => 0]];
                $period = $this->ci->Access_permissions_settings_model
                    ->getAccessData($this->roles[$this->ci->session->userdata['auth_type']])->getPeriodById($data['period_id'], $where);
                $return['data']['period'] = [
                    'id' => $period['id'],
                    'period' => $period['period'],
                    'period_str' => self::formatPeriod($period['period']),
                    'price' => $period[$data['group_gid'] . '_group'],
                ];
                $return['data']['disable_account_pay'] = false;
                if ($data['pay_system_gid'] === 'account') {
                    if ($return['data']['user_account'] < $return['data']['period']['price']) {
                        $return['data']['disable_account_pay'] = true;
                        $return['data']['deficit'] = $return['data']['period']['price'] - $return['data']['user_account'];
                    }
                }
            } else {
                $return['errors'][] = l('error_unknown_period', self::MODULE_GID);
            }
        } else {
            $return['errors'][] = l('error_unknown_group', self::MODULE_GID);
        }
        if (!empty($data['pay_system_gid'])) {
            if ($data['pay_system_gid'] != 'account') {
                $return['data']['pay_system'] = $this->ci->Payment_systems_model->getSystemByGid($data['pay_system_gid']);
            } else {
                $return['data']['pay_system'] = [
                    'gid' => 'account',
                    'name' => l('btn_pay_account', 'services')
                ];
            }
        } else {
            $return['errors'][] = l('error_unknown_pay_system', self::MODULE_GID);
        }

        return $return;
    }

    /**
     * Group Payment
     *
     * @param array $data
     * @param integer $user_id
     *
     * @return array
     */
    public function groupPayment(array $data, $user_id)
    {
        $this->ci->load->model([
            self::MODULE_GID . '/models/Access_permissions_settings_model',
            'Users_payments_model', 'users/models/Auth_model'
        ]);
        $group_data = $this->ci->Access_permissions_settings_model
            ->getAccessData($this->roles[$this->ci->session->userdata['auth_type']])
            ->getGroupData($data['group_gid'], ['where' => ['id' => $data['period_id']]]);
        if ($data['pay_system_gid'] == 'account') {
            $result = $this->accountPayment($group_data, $user_id);
        } else {
            $result = $this->systemPayment($group_data, $user_id, $data['pay_system_gid'], $data['user_type'], $data['is_recurring']);
        }
        $this->ci->Auth_model->updateUserSessionData($user_id);

        if (empty($result['error'])) {
            $this->ci->load->library('Analytics');
            $event = $this->ci->analytics->getEvent('payments', 'access_permissions', 'user');
            $this->ci->analytics->track($event);
        }

        return $result;
    }

    /**
     * Payment from the user's account
     *
     * @param array $group_data
     * @param integer $user_id
     *
     * @return array
     */
    private function accountPayment(array $group_data, $user_id)
    {
        $payment_result = $this->ci->Users_payments_model->writeOffUserAccount(
            $user_id,
            $group_data['period'][$group_data['gid'] . '_group'],
            l('field_membership_payment', self::MODULE_GID) . ': ' . $group_data["current_name"],
            $this->getPaymentTypeGidByGroupData($group_data),
            ['lang' => 'payment_stat_membership', 'module' => self::MODULE_GID]
        );
        if ($payment_result === true) {
            $is_apply = $this->applyGroup($group_data, $user_id);
            if ($is_apply === true) {
                return [
                    'success' => [l('success_payment_completed', self::MODULE_GID)],
                    'data' => $group_data
                ];
            }

            return [
                    'error' => [l('error_system', self::MODULE_GID)]
                ];
        }

        return [
                'error' => [l('error_system', self::MODULE_GID)]
            ];
    }

    public function getGroupNameByPaymentTypeGid($gid)
    {
        $name = '';
//        $name_tmp = str_replace(self::PAYMENT_TYPE_GID_PREFIX, '', $gid);
//        $name_tmp = explode('_', $name_tmp);
//        /**
//         * @todo get real group name
//         */
//        $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_groups_model');
//        $group = $this->ci->Access_permissions_groups_model->getGroupByGid($name[0]);
        return $name;
    }

    private function getPaymentTypeGidByGroupData($group_data)
    {
        return self::PAYMENT_TYPE_GID_PREFIX . $group_data['gid'] . '_' . $group_data['period']['period'] . '_' . $group_data['period']['period_type'];
    }

    /**
     * Payment for by system
     *
     * @param array $group_data
     * @param integer $user_id
     * @params string $system_gid
     *
     * @return array
     */
    private function systemPayment(array $group_data, $user_id, $system_gid, $user_type, $is_recurring = 0)
    {
        $this->ci->load->model(PaymentsModel::MODULE_GID . "/models/Payment_currency_model");
        $currency_gid = $this->ci->Payment_currency_model->default_currency["gid"];
        $payment_data = [
            'name' => l('field_membership_payment', self::MODULE_GID) . ': ' . $group_data["current_name"],
            'group_gid' => $group_data['gid'],
            'period_id' => $group_data['period']['id'],
            'lang' => 'field_membership_payment',
            'module' => self::MODULE_GID,
            'user_type' => $user_type,
            'is_recurring' => $is_recurring,
        ];

        $this->ci->load->helper('payments');

        return \Pg\modules\payments\helpers\sendPayment(
            $this->getPaymentTypeGidByGroupData($group_data),
            $user_id,
            $group_data['period'][$group_data['gid'] . '_group'],
            $currency_gid,
            $system_gid,
            $payment_data,
            true
        );
    }

    /**
     * Update Services by group
     *
     * @param string $group
     *
     * @return void
     */
    public function updateServicesByGroup($group, $user_id)
    {
        if (!empty($user_id)) {
            $user = $this->ci->Users_model->getUserById($user_id);
            if (!empty($user)) {
                $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
                $this->ci->Access_permissions_settings_model
                    ->getAccessData($this->roles[self::USER])->user_type = $user['user_type'];
                $role = $this->ci->Access_permissions_settings_model
                    ->getAccessData($this->roles[self::USER])->getRole($group['gid']);
                $permissions = $this->ci->Access_permissions_settings_model
                    ->getAccessData($this->roles[self::USER])
                    ->permissionsGroup([$group], $role)[$group['gid']]['access'];
                foreach ($permissions as $module => $module_data) {
                    foreach ($module_data as $data) {
                        $ucfirst_module = $this->ucfirstModule($module);
                        if (class_exists(NS_MODULES . $module . '\\models\\' . $ucfirst_module . 'Model') !== false) {
                            $model = ucfirst($module) . '_model';
                            $this->ci->load->model($model);
                            foreach ($data['list'] as $access) {
                                if (!empty($access['data']) && $access['type'] !== \BeatSwitch\Lock\Permissions\Restriction::TYPE) {
                                    $access['data'] = unserialize($access['data']);
                                    if ($access['data']) {
                                        foreach ($access['data'] as $action => $count) {
                                            $method = 'set' . $this->ucfirstModule($action) . 'Count';
                                            $this->ci->{$model}->{$method}($user_id, $count);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function isUnlimitedService($user, $module)
    {
        $this->ci->load->model([
            self::MODULE_GID . '/models/Access_permissions_modules_model',
            self::MODULE_GID . '/models/Access_permissions_settings_model',
            self::MODULE_GID . '/models/Access_permissions_users_model']);
        $this->ci->Access_permissions_settings_model->getAccessData($this->roles[self::USER])->user_type = $user['user_type'];
        $group = $this->ci->Access_permissions_users_model->getUserGroup([
            'where' => [
                'id_user' => $user['id'],
                'is_active' => 1
            ]
        ]);
        $group_gid = !empty($group) ? $group['group_gid'] : 'default';

        return $this->ci->Access_permissions_settings_model->getAccessData($this->roles[self::USER])
            ->isUnlimited($group_gid, $module);
    }

    /**
     * Update group status
     *
     * @param array $data group data
     * @param integer $user_id
     *
     * @throws \Exception
     *
     * @return void
     */
    public function applyGroup(array $data, $user_id)
    {
        $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_users_model');
        $user_current_groups = $this->ci->Access_permissions_users_model->getUserGroupList([
            'where' => ['id_user' => $user_id],
        ]);
        $u_groups = $this->ci->Access_permissions_users_model->getUserGroupList([
            'where' => ['id_user' => $user_id, 'group_gid' => $data['gid']],
        ]);

        if ($u_groups) {
            $user_group = current($u_groups);
        } else {
            $user_group = [];
        }

        $time = $this->getApplyTime($data, $user_group);

        $user_group_id = $user_group['id'] ?? null;
        $save_data = [
            'id_user' => $user_id,
            'group_gid' => $data['gid'],
            'id_period' => !empty($data['period']) ? (int)$data['period']['id'] : 0,
            'data' => serialize($data),
            'is_active' => 1,
            'date_expired' => $time['expired']
        ];
        if (!empty($time['activated'])) {
            $save_data['date_activated'] = $time['activated'];
        }
        $is_save = $this->ci->Access_permissions_users_model->saveUserGroup($user_group_id, $save_data);

        if ($is_save === true) {
            $this->updateServicesByGroup($data, $user_id);
            $this->addEventPayment($data, $user_id);
            //Delete user from all others groups, except the new one
            if (!empty($user_current_groups)) {
                foreach ($user_current_groups as $uc_group) {
                    if ($uc_group['group_gid'] != $data['gid']) {
                        $this->ci->Access_permissions_users_model->deleteUserFromGroup((int)$user_id, $uc_group['group_gid']);
                    }
                }
            }
        }

        return $is_save;
    }

    /**
     * Get Apply Time
     *
     * @param array $data
     * @param array $user_group
     *
     * @throws \Exception
     *
     * @return array
     */
    private function getApplyTime(array $data, array $user_group)
    {
        if (!empty($data['period']) && in_array($data['period']['period_type'], $this->getAllowedPeriodTypes())) {
            if (!empty($user_group)) {
                $date = new \DateTime($user_group['date_expired']);
                $date->add(date_interval_create_from_date_string($data['period']['period'] . ' ' . $data['period']['period_type']));
                $time['expired'] = $date->format(self::DATE_FORMAT);
                $time['activated'] = $user_group['date_activated'];
            } else {
                $tstamp = strtotime('+' . $data['period']['period'] . ' ' . $data['period']['period_type']);
                $time['expired'] = date(self::DATE_FORMAT, $tstamp);
                $time['activated'] = date(self::DATE_FORMAT);
            }
        } else {
            if ($data['gid'] == AccessPermissionsGroupsModel::TRIAL_GROUP && $data['is_trial'] == 1) {
                $time['expired'] = date(self::DATE_FORMAT, strtotime('+ ' . $data['trial_period'] . ' hours'));
            } else {
                $time['expired'] = null;
            }
            $time['activated'] = date(self::DATE_FORMAT);
        }

        return $time;
    }

    /**
     * Add Event Payment
     *
     * @param $group
     * @param $user_id
     *
     * @return void
     */
    private function addEventPayment($group, $user_id)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventAccessPermissions();
        $payment_data = [
            'payment_type_gid' => self::MODULE_GID,
            'payment_data' => [
                'group_gid' => $group['gid'],
                'period' => !empty($group['period']) ? $group['period']['id'] : 0,
            ],
            'id_user' => $user_id,
            'period' => !empty($group['period']) ? $group['period'][$group['gid'] . '_group'] : '',
            'group_data' => $group
        ];
        $event->setData($payment_data);
        $event_handler->dispatch($event, 'users_buy_group');
    }

    /**
     * Update group payment status
     *
     * callback method for payment module
     *
     * Expected status values: 1, 0, -1
     *
     * @param array $payment payment data
     * @param $status payment status
     *
     *@throws \Exception
     *
     * @return void
     */
    public function paymentStatus(array $payment, $status)
    {
        if ($status != 1) {
            return;
        }

        if (!$this->ci->session->userdata['auth_type']) {
            $auth_type = 'user';
        } else {
            $auth_type = $this->ci->session->userdata['auth_type'];
        }

        $this->ci->load->model(self::MODULE_GID . '/models/Access_permissions_settings_model');
        $group = $this->ci->Access_permissions_settings_model
            ->getAccessData($this->roles[$auth_type], $payment)
            ->getGroupData($payment['payment_data']['group_gid'], ['where' => ['id' => $payment["payment_data"]['period_id']]]);
        $this->applyGroup($group, $payment["id_user"]);
    }

    /**
     * Format roles
     *
     * @param array $roles
     *
     * @return array
     */
    public function formatRoles($roles, $user_type)
    {
        $this->ci->load->model([self::MODULE_GID . '/models/Access_permissions_settings_model',
            self::MODULE_GID . '/models/Access_permissions_groups_model']);
        $type = $this->ci->Access_permissions_settings_model->getSubscriptionType(AccessPermissionsSettingsModel::TYPE);
        $fields_list = $this->ci->Access_permissions_groups_model->listGroupPeriod();
        if ($type == 'user_types') {
            $user_type = !empty($user_type) ? $user_type : $this->ci->session->userdata('user_type');
            foreach ($roles as $role) {
                if (!empty($role)) {
                    $role_data = explode('_', $role);
                    if (!empty($role_data[1])) {
                        $fields[] = $role_data[1] . '_' . $user_type . '_group';
                    }
                    $data[] = ($role !== 'default') ? $role . '_' . $user_type : $role;
                }
            }
        } else {
            foreach ($roles as $role) {
                if (!empty($role)) {
                    $role_data = explode('_', $role);
                    if (!empty($role_data[1])) {
                        $fields[] = $role_data[1] . '_group';
                    }
                    $data[] = $role;
                }
            }
        }

        if (!empty($fields) && !empty(array_diff($fields, $fields_list))) {
            $data['errors'] = l('error_system', self::MODULE_GID);
        }

        return $data;
    }

    /**
     * Access Groups
     *
     * @param array $params
     *
     * @return boolean
     */
    public function isAccessGroups(array $params)
    {
        return $this->ci->cache->get(PERMISSIONS_TABLE, 'count', function () use ($params) {
            $ci = &get_instance();
            $ci->db->select('COUNT(id) AS cnt');
            $ci->db->from(PERMISSIONS_TABLE);
            if (isset($params['where'])) {
                foreach ($params['where'] as $field => $value) {
                    $ci->db->where($field, $value);
                }
            }
            if (isset($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $ci->db->where_in($field, $value);
                }
            }
            if (isset($params['where_sql'])) {
                foreach ($params['where_sql'] as $value) {
                    $ci->db->where($value, null, false);
                }
            }

            return (bool)$ci->db->get()->result_array()[0]['cnt'];
        });
    }

    /**
     * Default user type
     *
     * @param type $type
     *
     * @return string
     */
    public function defUserType($type)
    {
        $this->ci->load->model('users/models/Users_types_model');
        $is_type = $this->ci->Users_types_model->getTypeByName($type);
        if ($is_type === false) {
            $type = current($this->ci->Users_types_model->getFirstType())['name'];
        }

        return $type;
    }
}
