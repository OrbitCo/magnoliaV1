<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('USERS_GROUP', DB_PREFIX . 'access_permissions_users');

class AccessPermissionsUsersModel extends \Model
{

    /**
     * Users group attributes
     *
     * @var array
     */
    protected $fields = [
        'id',
        'id_user',
        'group_gid',
        'id_period',
        'data',
        'is_active',
        'date_activated',
        'date_expired'
    ];

    /**
     * Class constructor
     *
     * @return AccessPermissionsModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(USERS_GROUP);
    }

    /**
     * Get user group field
     *
     * @param array $params
     * @param string $field
     * @param string $gid
     *
     * @return array
     */
    public function getUserGroup(array $params, $field = null, $gid = null): array
    {
        $data = [];

        $list = $this->getUserGroupList($params);

        if (!empty($list)) {
            if (!empty($field)) {
                if (!empty($gid)) {
                    foreach ($list as $item) {
                        $data[$item['data'][$gid]] = $item['data'][$field];
                    }
                } else {
                    foreach ($list as $item) {
                        $data[] = $item['data'][$field];
                    }
                }
            } else {
                return current($list);
            }
        }

        return $data;
    }

    /**
     * Return user's groups as array
     *
     * @param array $params            filter parameters
     *
     * @return array
     */
    public function getUserGroupList($params = [])
    {
        $this->ci->db->select(implode(", ", $this->fields))->from(USERS_GROUP);
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->where($params["where"]);
        }
        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        $groups = $this->ci->db->get()->result_array();
        if (!empty($groups)) {
            return $this->formatGroups($groups);
        }
    }

    /**
     * Format group data
     *
     * @param array $group group data
     *
     * @return array
     */
    public function formatGroup($group)
    {
        return current($this->formatGroups([$group]));
    }

    /**
     * Format groups data
     *
     * @param array $groups_data groups data
     *
     * @return array
     */
    public function formatGroups(array $groups_data)
    {
        if (!empty($groups_data)) {
            $this->ci->load->model('access_permissions/models/Access_permissions_settings_model');
            foreach ($groups_data as $group) {
                $groups[] = $this->ci->Access_permissions_settings_model
                    ->getAccessData($this->ci->session->userdata['auth_type'])
                    ->getGroupData($group['group_gid'], ['where' => ['id' => $group['id_period']]]);
            }
            if (!empty($groups)) {
                foreach ($groups as $group) {
                    $temp[$group['gid']] = $group;
                }
                foreach ($groups_data as $key => $group_data) {
                    if (!empty($temp[$group_data['group_gid']])) {
                        $groups_data[$key]['data'] = $temp[$group_data['group_gid']];
                        $groups_data[$key]['left_str'] = $this->left($groups_data[$key]);
                    } elseif (!empty($group_data['data'])) {
                        $groups_data[$key]['data'] = (array) unserialize($group_data['data']);
                        $groups_data[$key]['left_str'] = $this->left($groups_data[$key]);
                    } else {
                        $groups_data[$key]['data'] = [];
                    }
                }
            }
        }

        return $groups_data;
    }

    /**
     * Period left
     *
     * @param array $user_group
     *
     * @return string
     */
    private function left(array $user_group): string
    {
        $left = $this->ci->pg_date->diff('now', $user_group['date_expired']);
        if ($left->days > 0) {
            return $left->days + round(($left->h + round($left->i / 60)) / 24)
                . ' ' . l('period_type_' . AccessPermissionsModel::PERIOD_TYPE_DAYS, AccessPermissionsModel::MODULE_GID);
        }

        return l('expires_today', AccessPermissionsModel::MODULE_GID);
    }

    /**
     * Return Trial Period Left
     *
     * @return array
     */
    public function getTrialPeriodLeft(): array
    {
        $result = [];
        $this->ci->db->select('date_expired')->from(USERS_GROUP);
        $this->ci->db->where([
            'id_user' => $this->ci->session->userdata('user_id'),
            'is_active' => 1,
            'group_gid' => AccessPermissionsGroupsModel::TRIAL_GROUP
        ]);
        $date_data = $this->ci->db->get()->result_array();
        if (!empty($date_data)) {
            $date_expired = current($date_data)['date_expired'];
            $left_hours = (strtotime($date_expired) - time()) / (60 * 60);
            $this->ci->load->model('users/models/Groups_model');
            $data = $this->ci->Groups_model->getTrialPeriod($left_hours);
            $result['count'] = $left_hours;
            $result['str'] = $this->ci->Groups_model->getTrialPeriodStr($data);
        }

        return $result;
    }

    /**
     * Save user group
     *
     * @param integer $group_id group identifier
     * @param array   $group    group data
     *
     * @return integer
     */
    public function saveUserGroup($group_id = null, $group = [])
    {
        if (empty($group_id)) {
            foreach (array_diff(array_keys($group), ['id', 'id_user']) as $field) {
                if ($field == 'id_period' || $field == 'is_active') {
                    $update_arr[] = "`" . $field . "`=" . (int) $group[$field];
                } else {
                    $update_arr[] = "`" . $field . "`=" . $this->ci->db->escape($group[$field]);
                }
            }

            $sql = $this->ci->db->insert_string(USERS_GROUP, $group)
                . ' ON DUPLICATE KEY UPDATE' . implode(", ", $update_arr);
            $this->ci->db->query($sql);
            $group_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $group_id);
            $this->ci->db->update(USERS_GROUP, $group);
        }
        $user = $this->ci->Users_model->getUserById($group['id_user']);
        $user_data = $this->ci->Users_model->addRoles($user, ['user_' . $group['group_gid']]);
        $roles = implode(',', $user_data['roles']);
        $user_id = $this->ci->Users_model->saveUser(
            $group['id_user'],
            ['roles' => $roles]
        );
        $this->ci->cache->flush(USERS_GROUP);

        return ($group_id && $user_id);
    }

    /**
     * Update memberships by cron
     *
     * @return void
     */
    public function cronUpdateGroups()
    {
        $this->ci->db->select(implode(", ", $this->fields))->from(USERS_GROUP)->where('date_expired <', date(AccessPermissionsModel::DATE_FORMAT, time()));
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $this->ci->load->model('Users_model');
            foreach ($results as $data) {
                $this->deleteUserRole($data);
            }
            $this->ci->db->where('date_expired <', date(AccessPermissionsModel::DATE_FORMAT, time()));
            $this->ci->db->delete(USERS_GROUP);
            $this->ci->cache->flush(USERS_GROUP);
        }
    }

    /**
     * Delete all users from the group
     *
     * @param string $gid
     *
     * @return void
     */
    public function deleteGroupUsers(string $gid)
    {
        $fields     = implode(", ", $this->fields);
        $nameTable  = USERS_GROUP;
        $results = $this->ci->cache->get(USERS_GROUP, 'deleteGroupUsers' . $gid, function () use ($gid, $fields, $nameTable) {
            $ci = &get_instance();
            $ci->db->select($fields)
                ->from($nameTable)
                ->where('group_gid', $gid);
            $results = $ci->db->get()->result_array();

            return $results;
        });

        if (!empty($results) && is_array($results)) {
            foreach ($results as $data) {
                $this->deleteUserRole($data);
            }
            $this->ci->db->where('group_gid', $gid);
            $this->ci->db->delete(USERS_GROUP);
            $this->ci->cache->flush(USERS_GROUP);
        }
    }

    /**
     * Delete the user from the group
     *
     * @param int $id_user
     * @param string $gid
     *
     * @return void
     */
    public function deleteUserFromGroup(int $id_user, string $gid)
    {
        $fields     = implode(", ", $this->fields);
        $nameTable  = USERS_GROUP;
        $where      = [
            'id_user' => $id_user,
            'group_gid' => $gid
        ];

        $results = $this->ci->cache->get(USERS_GROUP, 'deleteUserFromGroupU' . $id_user . 'GId' . $gid, function () use ($where, $fields, $nameTable) {
            $ci = &get_instance();
            $ci->db->select($fields)->from($nameTable)->where($where);
            $results = $ci->db->get()->result_array();

            return $results;
        });

        if (!empty($results) && is_array($results)) {
            foreach ($results as $data) {
                $this->deleteUserRole($data);
            }
            $this->ci->db->where($where);
            $this->ci->db->delete($nameTable);
            $this->ci->cache->flush(USERS_GROUP);
        }
    }

    /**
     * Delete user role
     *
     * @param array $data
     *
     * @return mixed
     */
    private function deleteUserRole(array $data)
    {
        $this->ci->load->model('Users_model');
        $roles = $this->ci->Users_model->getUserRoles($data['id_user']);

        if (isset($roles['errors'])) {
            unset($roles['errors']);
        }

        $this->ci->load->model(['Users_model','access_permissions/models/Access_permissions_settings_model']);
        $type = $this->ci->Access_permissions_settings_model->getSubscriptionType(AccessPermissionsSettingsModel::TYPE);

        if ($type == 'user_types') {
            $user = $this->ci->Users_model->getUserById($data['id_user']);
            $roles = array_map(function ($item) use ($user) {
                return str_replace('_'.$user['user_type'], '', $item);
            }, $roles);
        }

        $id = array_search('user_' . $data['group_gid'], $roles);

        if ($id !== false) {
            unset($roles[$id]);
            $new_roles = implode(',', $roles);
            $this->ci->cache->flush(USERS_GROUP);

            return $this->ci->Users_model->saveUser(
                $data['id_user'],
                ['roles' => $new_roles]
            );
        }

        return false;
    }
}
