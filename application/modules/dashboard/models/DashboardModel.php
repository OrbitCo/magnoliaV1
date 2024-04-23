<?php

declare(strict_types=1);

namespace Pg\modules\dashboard\models;

define("DASHBOARD_TABLE", DB_PREFIX . "dashboard");

class DashboardModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    const MODULE_GID = 'dashboard';

    /**
     * Module table
     *
     * @var string
     */
    const MODULE_TABLE = DASHBOARD_TABLE;

    public $events = [];

    /**
     * Dashboard object properties
     *
     * @var array
     */
    protected $fields = [
        self::MODULE_TABLE => [
            'id',
            'module',
            'type',
            'fk_object_id',
            'data',
            'status',
            'date_created',
            'date_modified',
        ],
    ];

    /**
     * DashboardModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::MODULE_TABLE);
    }
    private function getEventData($field_name, $field_value)
    {
        $fields     = implode(',', $this->fields[self::MODULE_TABLE]);
        $nameTable  = self::MODULE_TABLE;
        $results = $this->ci->cache->get(self::MODULE_TABLE, 'getEventData' . $field_name . "_" . $field_value, function () use ($field_name, $field_value, $fields, $nameTable) {
            $ci = &get_instance();
            $results = $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where($field_name, $field_value)
                ->get()->result_array();

            return $results;
        });

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        throw new \Exception('no data');
    }

    public function getEventById($event_id)
    {
        $callback = [$this,'getEventData'];
        return $this->ci->cache->get(self::MODULE_TABLE, 'getEventById' . $event_id, function () use ($event_id, $callback) {
            return call_user_func($callback, 'id', $event_id);
        });
    }

    public function getEventsList()
    {
        $fields     = implode(',', $this->fields[self::MODULE_TABLE]);
        $nameTable  = self::MODULE_TABLE;
        $results = $this->ci->cache->get(self::MODULE_TABLE, 'getEventsList', function () use ($fields, $nameTable) {
            $ci = &get_instance();
            $item_count_limit = $ci->pg_module->get_module_config('dashboard', 'item_count_limit');
            
            return $ci->db
                ->select($fields)
                ->from($nameTable)
                // TODO: удалённых пока не выводим
                ->where('status !=', 'user_deleted')
                ->where('status !=', 'user_not_confirmed')
                ->limit($item_count_limit)
                ->order_by('id DESC')
                ->get()->result_array();
        });

        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function getEventByObject($module, $type, $object_id)
    {
        $fields     = implode(',', $this->fields[self::MODULE_TABLE]);
        $nameTable  = self::MODULE_TABLE;
        $localCacheName = 'getEventByObject' . $module . "_" . $type . "_" . $object_id;
        $results = $this->ci->cache->get(self::MODULE_TABLE, $localCacheName, function () use ($module, $type, $object_id, $fields, $nameTable) {
            $ci = &get_instance();
            return $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where('module', $module)
                ->where('type', $type)
                ->where('fk_object_id', $object_id)
                ->get->result_array();
        });

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        throw new \Exception('no data');
    }

    public function getEventsByObjects($module, $type, $object_ids)
    {
        $fields     = implode(',', $this->fields[self::MODULE_TABLE]);
        $nameTable  = self::MODULE_TABLE;
        $localCacheName = 'getEventsByObjects' . $module . "_" . $type;
        $results = $this->ci->cache->get(self::MODULE_TABLE, $localCacheName, function () use ($module, $type, $object_ids, $fields, $nameTable) {
            $ci = &get_instance();
            return $ci->db
                ->select($fields)
                ->from($nameTable)
                ->where('module', $module)
                ->where('type', $type)
                ->where_in('fk_object_id', $object_ids)
                ->get()->result_array();
        });

        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function formatEvents($data)
    {
        $modules = [];
        foreach ($data as $key => $event) {
            if (!empty($event['data'])) {
                $event['data'] = (array)unserialize($event['data']);
            } else {
                $event['data'] = [];
            }

            if (!isset($event['data']['dashboard_action_name'])) {
                $event['data']['dashboard_action_name'] = 'link_section_action';
            }
            $event['data']['dashboard_status'] = $event['status'];

            $modules[$event['module']][$key] = $event['data'];
        }

        foreach ($modules as $module => $values) {
            if (!$this->ci->pg_module->is_module_active($module)) {
                continue;
            }

            $model = ucfirst($module . '_model');

            $this->ci->load->model($model);
            $values = $this->ci->{$model}->formatDashboardRecords($values);

            foreach ($values as $key => $value) {
                if (!isset($value['id'])) {
                    continue;
                }

                $data[$key]['data'] = $value;
            }
        }
        return $data;
    }

    public function processEvent($event_data)
    {
        $model = ucfirst($event_data['module'] . '_model');
        $this->ci->load->model($model);

        $ids = [];
        $statuses = [];

        $events = $this->getEventsByObjects($event_data['module'], $event_data['type'], (array)$event_data['id']);
        foreach ($events as $event) {
            if (!isset($ids[$event['fk_object_id']])) {
                $ids[$event['fk_object_id']] = $event['id'];
                $statuses[$event['fk_object_id']] = $event['status'];
            }
        }

        $data = $this->ci->{$model}->getDashboardData($event_data['id'], $event_data['status']);

        if ($data !== false) {
            if (isset($data['dashboard_new_object'])) {
                $is_check_object_exists = !$data['dashboard_new_object'];
            } else {
                if (isset($statuses[$event_data['id']])) {
                    $is_check_object_exists = true;
                }
            }
            if (isset($ids[$event_data['id']]) && $is_check_object_exists) {
                $event_id = $ids[$event_data['id']];
            } else {
                $event_id = null;
            }

            $save_data = [
                'data' => serialize($data),
                'status' => $event_data['status'],
                'date_modified' => date('Y-m-d H:i:s'),
            ];

            if (!$event_id) {
                $save_data['module'] = $event_data['module'];
                $save_data['type'] = $event_data['type'];
                $save_data['fk_object_id'] = $event_data['id'];
                $save_data['date_created'] = $save_data['date_modified'];

                $this->ci->db
                    ->insert(self::MODULE_TABLE, $save_data);
            } else {
                if ($save_data['status'] == 'deleted') {
                    $this->db
                        ->where('id', $event_id)
                        ->delete(self::MODULE_TABLE);
                } else {
                    $this->ci->db
                        ->where('id', $event_id)
                        ->update(self::MODULE_TABLE, $save_data);
                }
            }
        } elseif (!empty($ids)) {
            if ($event_data['status'] == 'deleted') {
                $this->db->where_in('id', $ids);
                $this->db->delete(self::MODULE_TABLE);
            } else {
                $save_data = [
                    'status' => $event_data['status'],
                    'date_modified' => date('Y-m-d H:i:s'),
                ];
                $this->ci->db
                        ->where_in('id', $ids)
                        ->update(self::MODULE_TABLE, $save_data);
            }
        }
    }

    public function clear()
    {
        $item_life_time = $this->ci->pg_module->get_module_config('dashboard', 'item_life_time');
        $item_count_limit = $this->ci->pg_module->get_module_config('dashboard', 'item_count_limit');

        $this->ci->db
            ->where('date_created <=', date('Y-m-d H:i:s', time() - $item_life_time * 86400))
            ->delete(self::MODULE_TABLE);

        $this->ci->db
            ->limit($item_count_limit)
            ->order_by('id DESC')
            ->delete(self::MODULE_TABLE);
        $this->ci->cache->flush(self::MODULE_TABLE);
    }

    public function installBatch($module, $data)
    {
        $model = ucfirst($module . '_model');
        $this->ci->load->model($model);
        foreach ($data['data'] as $method => $where) {
            $result = $this->ci->{$model}->{$method}($where);
        }
        foreach ($result as $item) {
            $this->processEvent([
                'id' => $item['id'],
                'status' => $data['status'],
                'type' => $data['type'],
                'module' => $module,
            ]);
        }
    }
}
