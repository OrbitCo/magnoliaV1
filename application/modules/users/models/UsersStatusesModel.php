<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

if (!defined('USERS_STATUSES_CALLBACKS_TABLE')) {
    define('USERS_STATUSES_CALLBACKS_TABLE', DB_PREFIX . 'users_statuses_callbacks');
}

/**
 * Users statuses model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 */
class UsersStatusesModel extends \Model
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

    public $statuses = [
        'offline',
        'online',
    ];

    private $statuses_keys;

    public function __construct()
    {
        parent::__construct();

        $this->fields_str = implode(', ', $this->fields);
        $this->statuses_keys = array_flip($this->statuses);
        $this->ci->cache->registerService(USERS_STATUSES_CALLBACKS_TABLE);
    }

    public function setStatus($user_id, $status): bool
    {
        if (isset($this->statuses[$status])) {
            $attrs['site_status'] = (int)$status;
            $this->ci->load->model('Users_model');
            $is_updated = $this->ci->Users_model->simplyUpdateUser($user_id, $attrs);
            $event_status = $this->statuses[$status];
            if ($is_updated) {
                $this->executeCallbacks($event_status, $user_id);
            }
            $this->ci->cache->flush(USERS_STATUSES_CALLBACKS_TABLE);

            return true;
        }

        return false;
    }

    public function addCallback($module, $model, $method, $event_status = '')
    {
        $attrs = [
            'module'       => $module,
            'model'        => $model,
            'method'       => $method,
            'event_status' => $event_status,
            'date_add'     => date("Y-m-d H:i:s"),
        ];
        $this->ci->db
            ->insert(USERS_STATUSES_CALLBACKS_TABLE, $attrs);
        $this->ci->cache->flush(USERS_STATUSES_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteCallbacksByModule($module)
    {
        $this->ci->db
            ->where('module', $module)
            ->delete(USERS_STATUSES_CALLBACKS_TABLE);
        $this->ci->cache->flush(USERS_STATUSES_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function deleteCallbacksById($id)
    {
        $this->ci->db
            ->where('id', $id)
            ->delete(USERS_STATUSES_CALLBACKS_TABLE);
        $this->ci->cache->flush(USERS_STATUSES_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    public function getCallbacks($event_status = '', $module = '')
    {
        $localNameCache = $module;
        $localNameCache .= is_array($event_status) ? implode('', $event_status) : $event_status;
        $nameTable      =  USERS_STATUSES_CALLBACKS_TABLE;
        $fields         = $this->fields_str;
        $results = $this->ci->cache->get(USERS_STATUSES_CALLBACKS_TABLE, 'getCallbacks'.$localNameCache, function () use ($module, $event_status, $nameTable, $fields) {
            $ci = &get_instance();

            if ($module) {
                $ci->db->where('module', $module);
            }
            if ($event_status) {
                $ci->db->where_in('event_status', ['', $event_status]);
            }

            $results = $ci->db
                ->select($fields)
                ->from($nameTable)
                ->get()->result_array();

            return $results;
        });

        return $results;
    }

    public function executeCallbacks($event_status, $user_id, $module = '')
    {
        $cbs = $this->get_callbacks($event_status, $module);
        foreach ($cbs as $cb) {
            $model_name = $cb['module'] . '_' . $cb['model'];
            $method_name = $cb['method'];

            if (!$this->ci->pg_module->is_module_installed($cb['module'])) {
                continue;
            }

            $this->ci->load->model($cb['module'] . '/models/' . $cb['model'], $model_name, false, true, true);

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
                $this->ci->$model_name->$method_name($this->statuses_keys[$event_status], (array) $user_id);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function getUserStatuses($id)
    {
        $status = $this->getUsersStatuses($id);

        return !empty($status[$id]) ? $status[$id] : [];
    }

    public function getUsersStatuses($ids): array
    {
        if (!is_array($ids) && (int)$ids) {
            $ids = [(int)$ids];
        } else {
            return [];
        }
        $this->ci->load->model('Users_model');
        $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids, false);
        $result = [];
        foreach ($users as $uid => $user) {
            $result[$uid] = $this->formatStatus($user['online_status'], $user['site_status']);
        }

        return $result;
    }

    public function formatStatus($online_status, $site_status)
    {
        $current_site_status = $online_status ? $site_status : 0;

        return [
            'online_status' => $online_status,
            'site_status' => $site_status,
            'online_status_text' => $online_status ? 'online' : 'offline',
            'current_site_status' => $current_site_status,
            'site_status_text' => $this->statuses[$site_status] ?? '',
            'current_site_status_text' => isset($this->statuses[$current_site_status]) ? $this->statuses[$current_site_status] : '',
            'online_status_lang' => l('status_online_' . $online_status, 'users'),
            'site_status_lang' => l('status_site_' . $site_status, 'users'),
            'current_site_status_lang' => l('status_site_' . $current_site_status, 'users'),
        ];
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_callback' => 'addCallback',
            'delete_callbacks_by_id' => 'deleteCallbacksById',
            'delete_callbacks_by_module' => 'deleteCallbacksByModule',
            'execute_callbacks' => 'executeCallbacks',
            'format_status' => 'formatStatus',
            'get_callbacks' => 'getCallbacks',
            'get_user_statuses' => 'getUserStatuses',
            'get_users_statuses' => 'getUsersStatuses',
            'set_status' => 'setStatus',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
