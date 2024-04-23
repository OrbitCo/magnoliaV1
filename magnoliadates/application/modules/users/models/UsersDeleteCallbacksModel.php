<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/*
 * Contact us user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanev@pilotgroup.net>
 **/

if (!defined('USERS_DELETE_CALLBACKS_TABLE')) {
    define('USERS_DELETE_CALLBACKS_TABLE', DB_PREFIX.'users_delete_callbacks');
}

class UsersDeleteCallbacksModel extends \Model
{
    private $fields = [
        'id',
        'module',
        'model',
        'callback',
        'callback_type',
        'callback_gid',
    ];

    private $fields_str;

    public function __construct()
    {
        parent::__construct();
        $this->fields_str = implode(', ', $this->fields);
        $this->ci->cache->registerService(USERS_DELETE_CALLBACKS_TABLE);
    }

    public function addCallback($module, $model, $callback, $callback_type = '', $callback_gid)
    {
        $this->ci->db->insert(USERS_DELETE_CALLBACKS_TABLE, [
            'module' => $module,
            'model' => $model,
            'callback' => $callback,
            'callback_type' => $callback_type,
            'callback_gid' => $callback_gid,
        ]);
        $this->ci->cache->flush(USERS_DELETE_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteCallbacksByModule($module)
    {
        $this->ci->db
            ->where('module', $module)
            ->delete(USERS_DELETE_CALLBACKS_TABLE);
        $this->ci->cache->flush(USERS_DELETE_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function getCallbacks($callbacks_gid = [])
    {
        if (!empty($callbacks_gid) && is_array($callbacks_gid)) {
            $this->ci->db->where_in('callback_gid', $callbacks_gid);
            $result = $this->ci->db
                ->select($this->fields_str)
                ->from(USERS_DELETE_CALLBACKS_TABLE)->get()->result_array();
        } else {
            $fields = $this->fields_str;
            $nameTable = USERS_DELETE_CALLBACKS_TABLE;
            $result = $this->ci->cache->get(USERS_DELETE_CALLBACKS_TABLE, 'getCallbacks', function () use ($fields, $nameTable) {
                $ci = &get_instance();
                $result = $ci->db
                    ->select($fields)
                    ->from($nameTable)->get()->result_array();

                return $result;
            });
        }

        return $result;
    }

    public function getAllCallbacksGid()
    {
        $nameTable = USERS_DELETE_CALLBACKS_TABLE;

        $result = $this->ci->cache->get(USERS_DELETE_CALLBACKS_TABLE, 'getAllCallbacksGid', function () use ($nameTable) {
            $ci = &get_instance();

            return $ci->db
                ->select('callback_gid')->from($nameTable)->get()->result_array();
        });

        $return = [];
        foreach ($result as $row) {
            $return[] = $row['callback_gid'];
        }

        return $return;
    }

    public function executeCallbacks($id_user, $callbacks_gid)
    {
        $cbs = $this->getCallbacks($callbacks_gid);
        foreach ($cbs as $cb) {
            $model_name = $cb['module'].'_'.$cb['model'];
            $method_name = $cb['callback'];

            if (!$this->ci->pg_module->is_module_installed($cb['module'])) {
                continue;
            }

            $this->ci->load->model($cb['module'].'/models/'.$cb['model'], $model_name, false, true, true);

            // TODO: убрать после приведения к PSR
            if (!method_exists($this->ci->$model_name, $method_name)) {
                $chunks = explode('_', $method_name);
                $method_name = array_shift($chunks);
                foreach ($chunks as $chunk) {
                    $method_name .= ucfirst($chunk);
                }
                if (!method_exists($this->ci->$model_name, $method_name)) {
                    continue;
                }
            }

            try {
                $this->ci->$model_name->$method_name($id_user, $cb['callback_type'], $callbacks_gid);
            } catch (Exception $e) {
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_callback' => 'addCallback',
            'delete_callbacks_by_module' => 'deleteCallbacksByModule',
            'execute_callbacks' => 'executeCallbacks',
            'get_all_callbacks_gid' => 'getAllCallbacksGid',
            'get_callbacks' => 'getCallbacks',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method '.$name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
