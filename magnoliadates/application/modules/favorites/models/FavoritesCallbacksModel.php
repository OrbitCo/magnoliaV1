<?php

declare(strict_types=1);

namespace Pg\modules\favorites\models;

if (!defined('FAVORITES_CALLBACKS_TABLE')) {
    define('FAVORITES_CALLBACKS_TABLE', DB_PREFIX . 'favorites_callbacks');
}

/**
 * Favorites callbacks model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class FavoritesCallbacksModel extends \Model
{
    private $fields = [
        'id',
        'module',
        'model',
        'method',
        'event_status',
        'date_add',
    ];

    private $fields_str;

    public function __construct()
    {
        parent::__construct();

        $this->fields_str = implode(', ', $this->fields);
    }

    public function addCallback($module, $model, $method, $event_status = '')
    {
        $attrs = [
            'module'       => $module,
            'model'        => $model,
            'method'       => $method,
            'event_status' => $event_status,
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->db->insert(FAVORITES_CALLBACKS_TABLE, $attrs);

        return $this->ci->db->affected_rows();
    }

    public function deleteCallbacksByModule($module)
    {
        $this->ci->db->where('module', $module)->delete(FAVORITES_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteCallbacksById($id)
    {
        $this->ci->db->where('id', $id)->delete(FAVORITES_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function getCallbacks($event_status = '', $module = '')
    {
        if ($module) {
            $this->ci->db->where('module', $module);
        }
        if ($event_status) {
            $this->ci->db->where_in('event_status', ['', $event_status]);
        }

        $result = $this->ci->db->select($this->fields_str)->from(FAVORITES_CALLBACKS_TABLE)->get()->result_array();

        return $result;
    }

    public function executeCallbacks($event_status, $id_user, $id_dest_user, $module = '')
    {
        $cbs = $this->get_callbacks($event_status, $module);
        foreach ($cbs as $cb) {
            $model_name = $cb['module'] . '_' . $cb['model'];
            $method_name = $cb['method'];

            if (!$this->ci->pg_module->is_module_installed($cb['module'])) {
                continue;
            }

            $this->ci->load->model($cb['module'] . '/models/' . $cb['model'], $model_name, false, true, true);

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
                $this->ci->$model_name->$method_name($event_status, $id_user, $id_dest_user);
            } catch (\Exception $e) {
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_callback' => 'addCallback',
            'delete_callbacks_by_id' => 'deleteCallbacksById',
            'delete_callbacks_by_module' => 'deleteCallbacksByModule',
            'execute_callbacks' => 'executeCallbacks',
            'get_callbacks' => 'getCallbacks',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
