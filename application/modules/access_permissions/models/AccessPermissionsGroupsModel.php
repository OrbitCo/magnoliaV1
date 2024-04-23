<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models;

use Pg\modules\users\models\UsersModel;
use Pg\modules\users\models\GroupsModel;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AccessPermissionsGroupsModel extends GroupsModel
{

    /**
     * DB table name (DB_PREFIX . 'access_permissions_group_period')
     *
     * @var string
     */
    const GROUP_PERIOD_TABLE = DB_PREFIX . 'access_permissions_group_period';

    /**
     * Period attributes
     *
     * @var array
     */
    protected $fields = [
        'id',
        'period',
        'period_type',
        'pay_type',
    ];

    /**
     * AccessPermissionsGroupsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::GROUP_PERIOD_TABLE);
    }

    /**
     * Get Subscription (Users group)
     *
     * @param string $group_gid
     * @param boolean $format
     *
     * @return array
     */
    public function getGroupByGid(string $group_gid, $format = true)
    {
        $result = $this->ci->cache->get(self::GROUP_PERIOD_TABLE, 'getGroupByGid' . $group_gid, function () use ($group_gid) {
            $ci = &get_instance();
            $ci->load->model('Users_model');
            return $ci->Users_model->getUserTypesGroups([
                'where' => ['gid' => $group_gid]
            ]);
        });
        if ($format === true) {
            return $this->formatGroups($result)[$group_gid];
        }
        return $result[$group_gid];
    }

    /**
     * Get Subscription (Users group)
     *
     * @param integer $group_id
     * @param array $langs_ids
     *
     * @return array
     */
    public function getGroupById(int $group_id, $langs_ids = null)
    {
        if ($langs_ids) {
            $this->ci->load->model('Users_model');
            return $this->ci->Users_model->getUserTypesGroups(
                ['where' => ['id' => $group_id]],
                $langs_ids
            );
        } else {
            return $this->ci->cache->get(self::GROUP_PERIOD_TABLE, 'getGroupById' . $group_id, function () use ($group_id, $langs_ids) {
                $ci = &get_instance();
                $ci->load->model('Users_model');
                return $ci->Users_model->getUserTypesGroups(
                    ['where' => ['id' => $group_id]],
                    $langs_ids
                );
            });
        }
    }

    /**
     * Get active paid group
     *
     * @return array
     */
    public function getActivePaidGroups(): array
    {
        $userModelGroups = UsersModel::GROUPS;
        $result = $this->ci->cache->get(self::GROUP_PERIOD_TABLE, 'getActivePaidGroups_is_active1_is_default0_is_trial0', function () use ($userModelGroups) {
            $ci = &get_instance();
            $ci->load->model('Users_model');
            return $ci->Users_model->getUserTypesGroups([
                'where' => [
                    'is_active' => 1,
                    'is_default' => 0,
                    'is_trial' => 0
                ]
            ])[$userModelGroups];
        });

        return $this->formatGroupsForServices($result, $this->getPeriodsList());
    }

    /**
     * Get  paid group
     *
     * @return array
     */
    public function getPaidGroups(): array
    {
        $result = $this->ci->cache->get(self::GROUP_PERIOD_TABLE, 'getPaidGroups', function () {
            $ci = &get_instance();
            $ci->load->model('Users_model');
            return $ci->Users_model->getUserTypesGroups([
                'where' => [
                    'is_default' => 0,
                    'is_trial' => 0
                ]
            ]);
        });

        return $this->formatGroups($result);
    }

    /**
     * Get count active paid group
     *
     * @return int
     */
    public function getCountActivePaidGroups(): int
    {
        return $this->getGroupsCount([
            'where' => [
                'is_active' => 1,
                'is_default' => 0,
                'is_trial' => 0
            ]
        ]);
    }

    /**
     * Get count of all active groups
     *
     * @return int
     */
    public function getCountActiveGroups(): int
    {
        return $this->getGroupsCount([
            'where' => [
                'is_active' => 1
            ]
        ]);
    }

    /**
     * Validation Subscription(Users Group)
     *
     * @param integer|null $id
     * @param array $data
     *
     * @return array
     */
    public function validateSubscription($id, array $data): array
    {
        if (isset($data['gid']) && $data['gid'] === self::DEFAULT_GROUP) {
            $data['is_active'] = 1;
        } elseif (isset($data['gid']) && $data['gid'] === self::TRIAL_GROUP) {
            $data['is_trial'] = 1;
        }
        return $this->validateGroup($id, $data);
    }

    /**
     * Save Subscription(Users Group)
     *
     * @param integer|null $id
     * @param array $data
     *
     * @return integer
     */
    public function saveSubscription($id, array $data)
    {
        return $this->saveGroup($id, $data);
    }

    /**
     * Format groups for services
     *
     * @param array $groups
     * @param array $periods
     *
     * @return array
     */
    private function formatGroupsForServices(array $groups, array $periods): array
    {

        $result = [];
        $this->ci->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model');
        $access_type = $this->ci->Access_permissions_settings_model->getSubscriptionType(AccessPermissionsSettingsModel::TYPE);
        if ($access_type == 'user_types') {
            $types = $this->ci->Users_model->getUserTypes();
        }
        foreach ($groups as $group) {
            foreach ($periods as $period) {
                if (isset($types)) {
                    foreach ($types as $type) {
                        $result['short'][$group['gid'] . '_' . $type . '_' . $period['id']] = [
                            'title' => $group['name_' . $this->ci->pg_language->current_lang_id] . ' ' .
                                AccessPermissionsModel::formatPeriod($period['period']),
                            'user_type' => $type
                        ];
                        $result['short_by_type'][$type][$group['gid'] . '_' . $type . '_' . $period['id']] = [
                            'title' => $group['name_' . $this->ci->pg_language->current_lang_id] . ' ' .
                                AccessPermissionsModel::formatPeriod($period['period']),
                            'user_type' => $type
                        ];
                        $result['full'][$group['gid'] . '_' . $type . '_' . $period['id']]['group_gid'] = $group['gid'];
                        $result['full'][$group['gid'] . '_' . $type . '_' . $period['id']]['period']['id'] = $period['id'];
                        $result['full'][$group['gid'] . '_' . $type . '_' . $period['id']]['period']['count'] = $period['period'];
                        $result['full'][$group['gid'] . '_' . $type . '_' . $period['id']]['period']['price'] = $period[$group['gid'] . '_' . $type . '_group'] ?? 0;
                        $result['full'][$group['gid'] . '_' . $type . '_' . $period['id']]['period']['type'] = $period['period_type'];
                    }
                } else {
                    $result['short'][$group['gid'] . '_' . $period['id']]['title'] =
                        $group['name_' . $this->ci->pg_language->current_lang_id] . ' ' .
                        AccessPermissionsModel::formatPeriod($period['period']);
                }
                $result['full'][$group['gid'] . '_' . $period['id']]['group_gid'] = $group['gid'];
                $result['full'][$group['gid'] . '_' . $period['id']]['period']['id'] = $period['id'];
                $result['full'][$group['gid'] . '_' . $period['id']]['period']['count'] = $period['period'];
                $result['full'][$group['gid'] . '_' . $period['id']]['period']['price'] = isset($period[$group['gid'] . '_group']) ? $period[$group['gid'] . '_group'] : 0;
                $result['full'][$group['gid'] . '_' . $period['id']]['period']['type'] = $period['period_type'];
            }
        }
        return $result;
    }

    /**
     * Format Subscriptions Data
     *
     * @param array $groups_data
     *
     * @return array
     */
    public function formatGroups(array $groups_data): array
    {
        $format_groups = $groups_data[UsersModel::GROUPS];
        foreach ($format_groups as $gid => $group) {
            if ($group['is_trial']) {
                $format_groups[$gid]['trial_period'] = $this->getTrialPeriod($group['trial_period']);
            }
            $format_groups[$gid]['current_name'] = $group['name_' . $this->ci->pg_language->current_lang_id]
                ?? $group['name_' . $this->ci->pg_language->get_default_lang_id()];
            $format_groups[$gid]['current_description'] = $group['description_' . $this->ci->pg_language->current_lang_id]
                ?? $group['description_' . $this->ci->pg_language->get_default_lang_id()];
        }

        return $format_groups;
    }

    /**
     * Delete Subscription(Users Group)
     *
     * @param integer $id
     *
     * @return array
     */
    public function deleteSubscription(int $id): array
    {
        if ($id != $this->getDefaultGroupId()) {
            $result = [
                'is_delete' => 1,
                'success' => [l('success_delete_group', AccessPermissionsModel::MODULE_GID)]
            ];
            $this->deleteGroup($id);
        } else {
            $result = [
                'is_delete' => 0,
                'error' => [l('error_default_group_not_deleted', AccessPermissionsModel::MODULE_GID)]
            ];
        }
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
        return $result;
    }

    /**
     * Delete groups
     *
     * @return void
     */
    public function deleteAllGroups()
    {
        $this->ci->db->where('is_default', 0);
        $this->ci->db->delete(GROUPS_TABLE);
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
    }

    /**
     * Change Status Subscription (active/inactive)
     *
     * @param array $data
     *
     * @return array
     */
    public function changeStatusSubscription(array $data): array
    {
        if ($data['status'] == 0 && ($data['id'] == $this->getDefaultGroupId())) {
            $result['error'][] = l('error_default_group_not_is_active', AccessPermissionsModel::MODULE_GID);
        } else {
            $this->saveGroup($data['id'], ['is_active' => $data['status']]);
            $result['success'] = l('success_status_set', AccessPermissionsModel::MODULE_GID);
            if ($data['gid'] == self::TRIAL_GROUP) {
                $result['info'] = ($data['status'] == 0) ?
                    l('trial_status_unset', AccessPermissionsModel::MODULE_GID) :
                    l('trial_status_set', AccessPermissionsModel::MODULE_GID);
            }
        }
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
        return $result;
    }

    /**
     * Add Period
     *
     * @param string $group_gid
     *
     * @return void
     */
    public function addPeriod(string $group_gid)
    {
        $subscription_type = json_decode($this->ci->Access_permissions_settings_model->getModuleSettings('subscription_type'), true);
        $key = array_search(1, array_column($subscription_type, 'data'));
        $this->addPeriodColumn($group_gid);
        if ($subscription_type[$key]['type'] == 'user_types') {
            $types = $this->ci->Users_model->getUserTypes();
            foreach ($types as $type) {
                $this->addPeriodColumn($group_gid . '_' . $type);
            }
        }
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
    }

    /**
     * Add period column
     *
     * @param string $prefix
     *
     * @return boolean
     */
    private function addPeriodColumn(string $prefix)
    {
        $this->ci->load->dbforge();

        $default_value = ($prefix == self::TRIAL_GROUP) ? 0 : 1;
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
        $field_name = $prefix . "_group";
        return $this->ci->dbforge->add_column(self::GROUP_PERIOD_TABLE, [
            "`$field_name`" => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false, 'default' => $default_value]
        ]);
    }

    /**
     * Add period column
     *
     * @param string $prefix
     *
     * @return boolean
     */
    private function deletePeriodColumn(string $prefix)
    {
        $column = $prefix . '_group';
        $this->ci->load->dbforge();
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
        return $this->ci->dbforge->drop_column(self::GROUP_PERIOD_TABLE, "`$column`");
    }

    /**
     * Delete Period
     *
     * @param string $group_gid
     *
     * @return void
     */
    public function deletePeriod(string $group_gid)
    {
        $subscription_type = json_decode($this->ci->Access_permissions_settings_model->getModuleSettings('subscription_type'), true);
        $key = array_search(1, array_column($subscription_type, 'data'));
        $this->deletePeriodColumn($group_gid);
        if ($subscription_type[$key]['type'] == 'user_types') {
            $types = $this->ci->Users_model->getUserTypes();
            foreach ($types as $type) {
                $this->deletePeriodColumn($group_gid . '_' . $type);
            }
        }
        $this->ci->cache->flush(self::GROUP_PERIOD_TABLE);
    }

    /**
     * Periods list
     *
     * @param array $add_fields
     * @param array $params
     *
     * @return array
     */
    public function getPeriodsList($add_fields = [], $params = [])
    {
        $fields = '*';
        if (!empty($add_fields)) {
            $array = array_merge($this->fields, $add_fields);
            $fields = [];
            foreach ($array as $field) {
                $fields[] = "`$field`";
            }
        }

        $this->ci->db->select($fields);

        $this->ci->db->from(self::GROUP_PERIOD_TABLE);
        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where("`$field`", $value);
            }
        }
        $this->ci->db->order_by('period ASC');
        $result = $this->ci->db->get()->result_array();
        return !empty($result) ? $result : [];
    }

    /**
     * Get period price
     *
     * @param array $data
     *
     * @return float
     */
    public function getPeriodPrice($data)
    {
        $fields = $this->ci->Access_permissions_settings_model
            ->getAccessData($this->ci->Access_permissions_model->roles[AccessPermissionsModel::USER])
            ->getField($data['group']);
        return current($this->getPeriodsList([$fields], [
            'where' => ['id' => $data['period']]
        ]))[$fields];
    }

    /**
     * List group period
     *
     * @return array type
     */
    public function listGroupPeriod()
    {
        $this->ci->load->dbforge();
        return $this->ci->db->list_fields(self::GROUP_PERIOD_TABLE);
    }
}
