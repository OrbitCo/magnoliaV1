<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models\access;

use Pg\modules\access_permissions\models\AccessPermissionsModel;
use Pg\Libraries\Traits\ModuleModel;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class Guests extends AccessAbstract
{
    use ModuleModel;

     /**
     * Role type
     *
     * @var string
     */
    public $role_type = AccessPermissionsModel::GUEST;

    /**
     * Class constructor
     *
     * @return Guests
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Access Role
     *
     * @param string $gid
     *
     * @return string
     */
    public function getRole($gid)
    {
        return $this->role_type;
    }

    /**
     * Get Field Periods Table
     *
     * @param string $gid
     *
     * @return strung
     */
    public function getField($gid)
    {
        return $get;
    }

    /**
     * Permissions list
     *
     * @param array $module
     * @param boolean $format
     *
     * @return array
     */
    public function permissionsList($module, $format = false)
    {
        $postfix = isset($module['method']) ? '_' . $module['method'] : '';
        $text_escape = $this->ci->db->escape('%' . $module['module_gid'] . '_' . $module['module_gid'] . $postfix . '%');
        $params = [
            'where_in' => ['role' => [AccessPermissionsModel::GUEST]],
            'where_sql' => ['(resource_type LIKE ' . $text_escape . ')']
        ];
        $return['permissions'] = $this->getAccessObject($params);
        return ($format === true) ? $this->formatPermissions($return, $module) : $return;
    }

    /**
     * Validate permissions
     *
     * @param array $data
     * @param array $module
     *
     * @return array
     */
    public function validatePermissions(array $data, array $module)
    {
        $result = ['errors' => [], 'data' => []];
        if (!empty($data)) {
            $this->ci->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_modules_model');
            $this->ci->load->model(AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_modules_model');
            $methods_data = current($this->ci->Access_permissions_modules_model->getModulesList([
                'where' => ['module_gid' => $module['module_gid'], 'method' => null, 'access' => 1]
            ]));
            $where_in = [];
            $where_not_in = [];
            if (!empty($methods_data['methods'])) {
                foreach ($methods_data['methods'] as $method) {
                    $where_in[] = $module['module_gid'] . '_' . $module['module_gid'] . '_' . $method;
                    $where_in[] = $module['module_gid'] . '_api_' . $module['module_gid'] . '_' . $method;
                }
            } elseif (!empty($methods_data['not_methods'])) {
                foreach ($methods_data['not_methods'] as $not_method) {
                    $where_not_in[] = $module['module_gid'] . '_' . $module['module_gid'] . '_' . $not_method;
                    $where_not_in[] = $module['module_gid'] . '_api_' . $module['module_gid'] . '_' . $not_method;
                }
            }
            foreach ($data['list'] as $resource_type => $value) {
                $result['data'][AccessPermissionsModel::GUEST]['attrs']['type'] = ($value[AccessPermissionsModel::GUEST]['status'] == 1) ? self::PRIVILEGE : self::RESTRICTION;
                if (empty($where_in)) {
                    $user_controller = $this->ci->db->escape('%' . $module['module_gid'] . "_" . $resource_type . '%');
                    $api_controller = $this->ci->db->escape('%' . $module['module_gid'] . "_api_" . $resource_type . '%');
                    $result['data'][AccessPermissionsModel::GUEST]['params']['where_sql'][] = '(resource_type LIKE ' . $user_controller . ' OR resource_type LIKE ' . $api_controller . ')';
                    if (!empty($where_not_in)) {
                        $result['data'][AccessPermissionsModel::GUEST]['params']['where_not_in']['resource_type'] = $where_not_in;
                    }
                } else {
                    $result['data'][AccessPermissionsModel::GUEST]['params']['where_in']['resource_type'] = $where_in;
                }


                $result['data'][AccessPermissionsModel::GUEST]['params']['where_in']['role'] = [AccessPermissionsModel::GUEST];
                if (isset($value[AccessPermissionsModel::GUEST]['count'])) {
                    $result['data'][AccessPermissionsModel::GUEST]['settings'] = self::formatPermissionSettings(
                        $value[AccessPermissionsModel::GUEST]['count'],
                        $module,
                        $result['data'][AccessPermissionsModel::GUEST]['attrs']['type']
                    );
                }
            }
        }
        return $result;
    }

    /**
     * Format permission settings
     *
     * @param array $data
     * @param string $role
     * @param string $resource_type
     * @param string $type
     *
     * @return array
     */
    protected static function formatPermissionSettings($data, $module, $type)
    {
        $result = [];
        foreach ($data as $method => $count) {
            $result['module_gid'] = $module['module_gid'];
            $result['methods'][$method]['attrs']['type'] = $type;
            $result['methods'][$method]['attrs']['data'] = serialize([$method => $count]);
            $result['methods'][$method]['params']['where_in'] = [
               'role' => [AccessPermissionsModel::GUEST],
               'resource_type' => [$module['module_gid'] . '_' . $module['module_gid'] . '_' . $method]
            ];
        }
        return $result;
    }

    /**
     * Format permissions
     *
     * @param array $data
     * @param array $module
     *
     * @return array
     */
    public function formatPermissions(array $data, array $module)
    {
        $result = [];
        if (!empty($data['permissions'])) {
            $data['status'] = $this->access_type[$data['permissions'][0]['type']];
            foreach ($data['permissions'] as $permission) {
                $result[AccessPermissionsModel::GUEST]['status'] = $this->getPermissionStatus($permission, $module);
                $result[AccessPermissionsModel::GUEST]['permissions'][] = $permission;
            }
        }
        return $result;
    }

    /**
     * Permission status
     *
     * @param array  $permission
     * @param array  $module
     *
     * @return string
     */
    private function getPermissionStatus($permission, $module)
    {
        if (!isset($this->permissions_status[$permission['role']][$module['module_gid']])) {
            if (!empty($permission['data'])) {
                $count = current(unserialize($permission['data']));
                if ($count > 0 && $permission['type'] == self::PRIVILEGE) {
                    $this->permissions_status[$permission['role']][$module['module_gid']] = self::INCOMPLETE;
                    return self::INCOMPLETE;
                } elseif ($count == 0 && $permission['type'] == self::PRIVILEGE) {
                    return $this->access_type[self::PRIVILEGE];
                } else {
                    return $this->access_type[self::RESTRICTION];
                }
            } else {
                return $this->access_type[$permission['type']];
            }
        } else {
            return self::INCOMPLETE;
        }
    }

    /**
     * Save permissions
     *
     * @param array $attrs
     * @param tyarraype $params
     *
     * @return void
     */
    public function savePermissions(array $attrs, $params = null)
    {
        if (is_null($params)) {
            $this->ci->db->insert(PERMISSIONS_TABLE, $attrs);
        } else {
            if (isset($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
                }
            }
            if (isset($params['where_not_in'])) {
                foreach ($params['where_not_in'] as $field => $value) {
                    $this->ci->db->where_not_in($field, $value);
                }
            }
            if (isset($params['where_sql'])) {
                foreach ($params['where_sql'] as $value) {
                    $this->ci->db->where($value, null, false);
                }
            }
            $this->ci->db->update(PERMISSIONS_TABLE, $attrs);
        }
    }

    /**
     * Save permissions settings
     *
     * @param array $settings
     *
     * return void
     */
    public function savePermissionsSettings(array $settings)
    {
        foreach ($settings['methods'] as $method => $data) {
            $this->savePermissions($data['attrs'], $data['params']);
            $model = ucfirst($settings['module_gid']) . '_model';
            $this->ci->load->model($model);
            $access = unserialize($data['attrs']['data']);
            foreach ($access as $action => $count) {
                $method = 'set' . $this->ucfirstModule($action) . 'Count';
                $this->ci->{$model}->{$method}($count);
            }
        }
    }

    /**
     * Return madules data
     * @param array $params
     * @return mixed
     */
    public function getModulesData($params)
    {
        return $this->getAccessObject($params);
    }

    /**
     * Is unlimited services
     * @param string $group_gid
     * @param array $module
     * @return boolean
     */
    public function isUnlimited($group_gid, $module)
    {
        $role = $this->getRole($group_gid);
        $text_escape = $this->ci->db->escape('%' . $module['module_gid'] . '_' . $module['module_gid'] . '_' . $module['method'] . '%');
        $data = current($this->getModulesData([
            'where' => [
                'role' => $role
            ],
            'where_sql' => ['(resource_type LIKE ' . $text_escape . ')']
        ]));
        return $this->getPermissionStatus($data, $module) == $this->access_type[self::PRIVILEGE];
    }
}
