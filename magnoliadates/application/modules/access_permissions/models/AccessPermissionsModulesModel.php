<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models;

use Pg\Libraries\Acl\Driver\DbDriver;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define(
    'ACCESS_PERMISSIONS_MODULES_TABLE',
    DB_PREFIX . 'access_permissions_modules'
);

class AccessPermissionsModulesModel extends \Model
{
    /**
     * Modules object properties
     *
     * @var array
     */
    private $fields = [
        'id',
        'module_gid',
        'method',
        'methods',
        'not_methods',
        'access',
        'data',
    ];

    /**
     * AccessPermissionsModulesModel constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(ACCESS_PERMISSIONS_MODULES_TABLE);
    }

    /**
     * Return Module by id
     *
     * @param type $id
     *
     * @return boolean/array
     */
    public function getModuleById($id = null)
    {
        if (!is_null($id)) {
            return $this->getModulesObject('id', $id);
        }

        return false;
    }

    /**
     * Return Modules object
     *
     * @param string $field_name  field name
     * @param mixed  $field_value field value
     *
     * @return boolean/array
     */
    public function getModulesObject($field_name, $field_value)
    {
        $fields = implode(', ', $this->fields);
        $nameTable = ACCESS_PERMISSIONS_MODULES_TABLE;
        $localNameCache = 'getModulesObjectFieldName' . $field_name . 'FieldValue' . $field_value;

        $results = $this->ci->cache->get(ACCESS_PERMISSIONS_MODULES_TABLE, $localNameCache, function () use ($field_name, $field_value, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where($field_name, $field_value)
                ->get()
                ->result_array();

            return $result;
        });

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    /**
     *  Modules List
     *
     * @param array $params
     * @param integer $page
     * @param integer $limits
     * @param string/array $order_by
     *
     * @return array
     */
    public function getModulesList(array $params, $page = null, $limits = null, $order_by = null)
    {
        $this->ci->db->select(implode(', ', $this->fields));
        $this->ci->db->from(ACCESS_PERMISSIONS_MODULES_TABLE);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }
        if (!is_null($page)) {
            $page = intval($page) ?: 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $this->formatModulesList($results);
        }

        return [];
    }

    /**
     * Get permission ID
     *
     * @param array $where
     *
     * @return integer
     */
    public function getPermissionId(array $where)
    {
        $nameTable = ACCESS_PERMISSIONS_MODULES_TABLE;
        $localNameCache = "";
        foreach ($where as $field => $value) {
            if (!empty($value)) {
                $localNameCache = $field . $value;
            }
        }

        $results = $this->ci->cache->get(ACCESS_PERMISSIONS_MODULES_TABLE, 'getPermissionId' . $localNameCache, function () use ($where, $nameTable) {
            $ci = &get_instance();
            $ci->db->select('id');
            $ci->db->from($nameTable);

            foreach ($where as $field => $value) {
                if (!empty($value)) {
                    $this->ci->db->where($field, $value);
                }
            }

            $results = current($ci->db->get()->result_array())['id'];

            return $results;
        });

        return $results;
    }

    /**
     * Save modules
     *
     * @param array $attrs
     * @param integer $id
     *
     * @return integer
     */
    public function saveModules(array $attrs, $id = null)
    {
        // TODO: не применять изменения к указанным методам
        if (isset($attrs['exclude'])) {
            $this->ci->db
                ->set('exclude', '1')
                ->where_in('resource_type', $attrs['exclude'])
                ->update(DB_PREFIX . DbDriver::PERMISSIONS_TABLE);
            unset($attrs['exclude']);
        }

        if (is_null($id)) {
            $this->ci->db->insert(ACCESS_PERMISSIONS_MODULES_TABLE, $attrs);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(ACCESS_PERMISSIONS_MODULES_TABLE, $attrs);
        }
        $this->ci->cache->flush(ACCESS_PERMISSIONS_MODULES_TABLE);

        return $id;
    }

    /**
     * Delete module
     *
     * @param string $gid
     */
    public function deleteModule($gid)
    {
        $this->ci->db->where('module_gid', $gid);
        $this->ci->db->delete(ACCESS_PERMISSIONS_MODULES_TABLE);
        $this->ci->cache->flush(ACCESS_PERMISSIONS_MODULES_TABLE);
    }

    /**
     * Delete method
     *
     * @param string $gid
     * @param string $method
     *
     * @return void
     */
    public function deleteMethod($gid, $method)
    {
        $this->ci->db->where('module_gid', $gid);
        $this->ci->db->where('method', $method);
        $this->ci->db->delete(ACCESS_PERMISSIONS_MODULES_TABLE);
        $this->ci->cache->flush(ACCESS_PERMISSIONS_MODULES_TABLE);
    }

    /**
     * Validate modules data
     *
     * @param array $data
     * @param integer $id
     *
     * @return array
     */
    public function validateModules(array $data, $id = null)
    {
        $return         = ['errors' => [], 'data' => []];
        $modules_object = !is_null($id) ? $this->getModuleById($id) : [];
        if (!empty($modules_object['module_gid'])) {
            $return['data']['module_gid'] = $modules_object['module_gid'];
        } else {
            if (!empty($data['module_gid'])) {
                $return['data']['module_gid'] = $data['module_gid'];
            } else {
                $return['errors'][] = l('error_gid', AccessPermissionsModel::MODULE_GID);
            }
        }
        if (!empty($data['access'])) {
            $return['data']['access'] = $data['access'];
        } else {
            $return['errors'][] = l('error_unknown_user_type', AccessPermissionsModel::MODULE_GID);
        }
        if (!empty($data['data'])) {
            $data['data'] = serialize($data['data']);
        }
        $return['data']['controller'] = !empty($data['controller']) ? trim($data['controller']) : $modules_object['controllet'];
        $return['data']['method']     = !empty($data['method']) ? trim($data['method']) : $modules_object['method'];

        return $return;
    }

    /**
     * Format module data
     *
     * @param array $module
     *
     * @return array
     */
    public function formatModule(array $module)
    {
        return current(
            $this->formatModulesList([$module])
        );
    }

    /**
     * Format modules data
     *
     * @param array $modules
     *
     * @return array
     */
    public function formatModulesList(array $modules)
    {
        foreach ($modules as $module) {
            $module['data'] = unserialize($module['data']);
            if (!empty($module['data'])) {
                $module['data'] = $this->formatAdditionalSettings($module);
                $module['status'] = 'incomplete';
            }
            if (empty($module['method'])) {
                $module['name'] = l('field_permission_' . $module['module_gid'], AccessPermissionsModel::MODULE_GID);
                $module['description'] = l('field_permission_' . $module['module_gid'] . '_description', AccessPermissionsModel::MODULE_GID);
            } else {
                $module['name'] = l('field_permission_' . $module['module_gid'] . '_' . $module['method'], AccessPermissionsModel::MODULE_GID);
                $module['description'] = l('field_permission_' . $module['module_gid'] . '_' . $module['method'] . '_description', AccessPermissionsModel::MODULE_GID);
            }
            $result[$module['id']] = $module;
        }

        return $result;
    }

    /**
     * Format Additional Settings
     *
     * @param array $data
     *
     * @return array
     */
    private function formatAdditionalSettings(array $data)
    {
        if (isset($data['data']['all'])) {
            $return = [
                [
                    'name' => l('field_additional_permission_' . $data['module_gid'] . '_all', AccessPermissionsModel::MODULE_GID),
                    'count' => $data['data']['all'],
                ]
            ];
        } else {
            foreach ($data['data'] as $key => $item) {
                $return[$key]['name'] = l('field_additional_permission_' . $data['module_gid'] . '_' . $key, AccessPermissionsModel::MODULE_GID);
                $return[$key]['count'] = $item;
            }
        }

        return $return;
    }
}
