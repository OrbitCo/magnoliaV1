<?php

namespace Pg\Libraries\Acl\Driver;

use BeatSwitch\Lock\Callers\Caller;
use BeatSwitch\Lock\Drivers\Driver as IDriver;
use BeatSwitch\Lock\Permissions\Permission;
use BeatSwitch\Lock\Permissions\PermissionFactory;
use BeatSwitch\Lock\Roles\Role;

class DbDriver implements IDriver
{
    /**
     * Table name
     *
     * @var string
     */
    public const PERMISSIONS_TABLE = 'acl';

    /**
     * @var \CodeIgniter
     */
    protected $ci;

    /**
     * Permission attributes
     *
     * @var array
     */
    protected $fields = [
        self::PERMISSIONS_TABLE => [
            'id',
            'caller_type',
            'caller_id',
            'role',
            'type',
            'action',
            'resource_type',
            'resource_id',
            'data',
        ],
    ];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->cache->registerService('acl_callers');
        $this->ci->cache->registerService('acl_roles');
    }

    /**
     * Returns all the permissions for a caller
     *
     * @param \BeatSwitch\Lock\Callers\Caller $caller
     *
     * @return \BeatSwitch\Lock\Permissions\Permission
     */
    public function getCallerPermissions(Caller $caller)
    {
        $caller_type = $caller->getCallerType();
        $caller_id = $caller->getCallerId();

        // TODO: cache
        $results = $this->ci->cache->get('acl_callers', $caller_type . '_' . $caller_id, function () use ($caller_type, $caller_id) {
            $ci = &get_instance();

            $result = $ci->db
                ->select(['type', 'action', 'resource_type', 'resource_id',])
                ->from(DB_PREFIX . self::PERMISSIONS_TABLE)
                ->where('caller_type', $caller_type)
                ->where('caller_id', $caller_id)
                ->get()->result_array();

            return $result ?? [];
        });

        return !empty($results) ? PermissionFactory::createFromData($results) : [];
    }

    /**
     * Stores a new permission for a caller
     *
     * @param \BeatSwitch\Lock\Callers\Caller $caller
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return void
     */
    public function storeCallerPermission(Caller $caller, Permission $permission)
    {
        $this->ci->db->insert(DB_PREFIX . self::PERMISSIONS_TABLE, [
            'caller_type' => $caller->getCallerType(),
            'caller_id' => $caller->getCallerId(),
            'type' => $permission->getType(),
            'action' => $permission->getAction(),
            'resource_type' => $permission->getResourceType(),
            'resource_id' => (int) $permission->getResourceId(),
        ]);

        // TODO: cache - flush callers
        $this->ci->cache->flush('acl_callers');
    }

    /**
     * Removes a permission for a caller
     *
     * @param \BeatSwitch\Lock\Callers\Caller $caller
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return void
     */
    public function removeCallerPermission(Caller $caller, Permission $permission)
    {
        $this->ci->db
            ->where('caller_type', $caller->getCallerType())
            ->where('caller_id', $caller->getCallerId())
            ->where('type', $permission->getType())
            ->where('action', (int) $permission->getAction())
            ->where('resource_type', (int) $permission->getResourceType())
            ->where('resource_id', (int) $permission->getResourceId())
            ->delete(DB_PREFIX . self::PERMISSIONS_TABLE);

        // TODO: cache - flush callers
        $this->ci->cache->flush('acl_callers');
    }

    /**
     * Checks if a permission is stored for a caller
     *
     * @param \BeatSwitch\Lock\Callers\Caller $caller
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return bool
     */
    public function hasCallerPermission(Caller $caller, Permission $permission)
    {
        return $this->ci->db
                ->select('1')
                ->from(DB_PREFIX . self::PERMISSIONS_TABLE)
                ->where('caller_type', $caller->getCallerType())
                ->where('caller_id', $caller->getCallerId())
                ->where('type', $permission->getType())
                ->where('action', $permission->getAction())
                ->where('resource_type', $permission->getResourceType())
                ->where('resource_id', $permission->getResourceId())
                ->get()
                ->result_array();
    }

    /**
     * Returns all the permissions for a role
     *
     * @param \BeatSwitch\Lock\Roles\Role $role
     *
     * @return \BeatSwitch\Lock\Permissions\Permission
     */
    public function getRolePermissions(Role $role)
    {
        $role_name = $role->getRoleName();

        // TODO: cache
        $results = $this->ci->cache->get('acl_roles', $role_name, function () use ($role_name) {
            $ci = &get_instance();

            return $ci->db
                ->select(['type', 'action', 'resource_type', 'resource_id',])
                ->from(DB_PREFIX . self::PERMISSIONS_TABLE)
                ->where('role', $role_name)->get()->result_array();
        });

        return !empty($results) ? PermissionFactory::createFromData($results) : [];
    }

    /**
     * Stores a new permission for a role
     *
     * @param \BeatSwitch\Lock\Roles\Role $role
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return void
     */
    public function storeRolePermission(Role $role, Permission $permission)
    {
        $this->ci->db->insert(DB_PREFIX . self::PERMISSIONS_TABLE, [
            'role' => $role->getRoleName(),
            'type' => $permission->getType(),
            'action' => $permission->getAction(),
            'resource_type' => $permission->getResourceType(),
            'resource_id' => (int) $permission->getResourceId(),
        ]);

        // TODO: cache - flush roles
        $this->ci->cache->flush('acl_roles');
    }

    /**
     * Removes a permission for a role
     *
     * @param \BeatSwitch\Lock\Roles\Role $role
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return void
     */
    public function removeRolePermission(Role $role, Permission $permission)
    {
        $this->ci->db
            ->from(DB_PREFIX . self::PERMISSIONS_TABLE)
            ->where('role', $role->getRoleName())
            ->where('type', $permission->getType())
            ->where('action', $permission->getAction())
            ->where('resource_type', $permission->getResourceType())
            ->where('resource_id', $permission->getResourceId())
            ->delete(DB_PREFIX . self::PERMISSIONS_TABLE);

        // TODO: cache - flush roles
        $this->ci->cache->flush('acl_roles');
    }

    /**
     * Checks if a permission is stored for a role
     *
     * @param \BeatSwitch\Lock\Roles\Role $role
     * @param \BeatSwitch\Lock\Permissions\Permission
     *
     * @return bool
     */
    public function hasRolePermission(Role $role, Permission $permission)
    {
        $this->ci->db
            ->select('1')
            ->from(DB_PREFIX . self::PERMISSIONS_TABLE)
            ->where('role', $role->getRoleName())
            ->where('type', $permission->getType())
            ->where('action', $permission->getAction());

        if (!is_null($permission->getResourceType())) {
            $this->ci->db->where('resource_type', $permission->getResourceType());
        }

        if (!is_null($permission->getResourceId())) {
            $this->ci->db->where('resource_id', $permission->getResourceId());
        }

        return (bool) $this->ci->db->get()->result_array();
    }
}
