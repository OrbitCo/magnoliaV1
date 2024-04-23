<?php

declare(strict_types=1);

namespace Pg\modules\wall_events\models;

if (!defined('TABLE_WALL_EVENTS_PERMISSIONS')) {
    define('TABLE_WALL_EVENTS_PERMISSIONS', DB_PREFIX . 'wall_events_permissions');
}

/**
 * Wall events permissions model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WallEventsPermissionsModel extends \Model
{
    private $fields = [
        'id_user',
        'permissions',
    ];

    private $fields_str;

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(TABLE_WALL_EVENTS_PERMISSIONS);
        $this->fields_str = implode(', ', $this->fields);
    }

    public function getUserPermissions($id_user)
    {
        $event_perm = $this->getDefaultPermissions();

        $nameTable = TABLE_WALL_EVENTS_PERMISSIONS;
        $saved_perm = $this->ci->cache->get(TABLE_WALL_EVENTS_PERMISSIONS, 'getUserPermissions'.$id_user, function () use ($id_user, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select('permissions')->from($nameTable)->where('id_user', $id_user)->get()->row_array();

            return $result;
        });

        if (!empty($saved_perm)) {
            $user_perm = unserialize($saved_perm['permissions']);
        } else {
            $user_perm = [];
        }
        $result = [];
        foreach ($event_perm as $e_gid => $perm) {
            foreach ($perm as $perm_name => $val) {
                $result[$e_gid][$perm_name] = isset($user_perm[$e_gid][$perm_name]) ? $user_perm[$e_gid][$perm_name] : $val;
            }
        }

        return $result;
    }

    public function getUserFeeds($id_user)
    {
        $perms = $this->get_user_permissions($id_user);
        $result = [];
        foreach ($perms as $e_gid => $perm) {
            if ($perm['feed']) {
                $result[] = $e_gid;
            }
        }

        return $result;
    }

    public function setUserPermissions($id_user, $permissions)
    {
        $attrs['id_user'] = $id_user;
        if (is_array($permissions)) {
            foreach ($permissions as &$perm) {
                array_map('intval', $perm);
            }
        }
        $attrs['permissions'] = is_array($permissions) ? serialize($permissions) : '';
        $sql = $this->ci->db->insert_string(TABLE_WALL_EVENTS_PERMISSIONS, $attrs) . " ON DUPLICATE KEY UPDATE `permissions`=" . $this->ci->db->escape($attrs['permissions']);
        $this->ci->db->query($sql);
        $this->ci->cache->flush(TABLE_WALL_EVENTS_PERMISSIONS);

        return $this->ci->db->affected_rows();
    }

    private function getDefaultPermissions()
    {
        $result = [];
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        $params['where']['status'] = '1';
        $events_types = $this->ci->Wall_events_types_model->get_wall_events_types($params);
        foreach ($events_types as $e_type) {
            $result[$e_type['gid']] = $e_type['settings']['permissions'];
        }

        return $result;
    }

    public function isPermissionsAllowed($permissions, $id_wall, $id_poster)
    {
        if ($id_wall && $id_wall == $id_poster || $permissions == 3) {
            return true;
        }

        if ($permissions <= 0 || $permissions > 3) {
            return false;
        }

        $user_id = $this->ci->session->userdata('user_id');
        if ($user_id && $permissions >= 2) {
            return true;
        }

        if ($this->ci->pg_module->is_module_installed('friendlist')) {
            $this->ci->load->model('Friendlist_model');
            $is_friend = $this->ci->Friendlist_model->is_friend($id_wall, $user_id);
        } else {
            $is_friend = false;
        }
        if ($permissions == 1 && $is_friend) {
            return true;
        }

        return false;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_user_feeds' => 'getUserFeeds',
            'get_user_permissions' => 'getUserPermissions',
            'is_permissions_allowed' => 'isPermissionsAllowed',
            'set_user_permissions' => 'setUserPermissions',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
