<?php

declare(strict_types=1);

namespace Pg\modules\network\models;

define('NET_EVENTS_HANDLERS_TABLE', DB_PREFIX . 'net_events_handlers');

/**
 * Network events model
 *
 * @package PG_Dating
 * @subpackage application
 * @category modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class NetworkEventsModel extends \Model
{
    private $network_cache = [];
    private $events_to_skip = [];
    private $events_dir;
    public $fields = [
        'id',
        'event',
        'module',
        'model',
        'method',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('network/models/Network_users_model');
        $this->events_dir = TEMPPATH . NetworkModel::MODULE_GID . '/events/';
    }

    /**
     * Add event handler
     *
     * @param array $handler
     *
     * @return int
     */
    public function addHandler(array $handler): int
    {
        $this->ci->db->insert(NET_EVENTS_HANDLERS_TABLE, $handler);

        return (int) $this->ci->db->insert_id();
    }

    /**
     * Delete event handler
     *
     * @param int|string $val
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function delete($val)
    {
        if (is_int($val)) {
            $field = 'id';
        } elseif (is_string($val)) {
            $field = 'event';
        } else {
            throw new \Exception('Wrong type');
        }

        return $this->ci->db->where($field, $val)
                ->delete(NET_EVENTS_HANDLERS_TABLE);
    }

    /**
     * Get event handlers
     *
     * @param array|string $event
     *
     * @return array
     */
    public function get($event = null)
    {
        $this->ci->db->select($this->fields)
            ->from(NET_EVENTS_HANDLERS_TABLE);
        if (!empty($event)) {
            if (is_array($event)) {
                $this->ci->db->where_in('event', $event);
            } else {
                $this->ci->db->where('event', $event);
            }
        }

        return $this->ci->db->get()->result_array();
    }

    /**
     * Get event handlers via cache
     *
     * @param string|null $event
     *
     * @return boolean
     */
    public function getCache(string $event = null)
    {
        if (empty($this->network_cache['handlers'])) {
            $this->network_cache['handlers'] = $this->get();
        }
        if (empty($event)) {
            return $this->network_cache['handlers'];
        } elseif (!empty($this->network_cache['handlers'][$event])) {
            return $this->network_cache['handlers'][$event];
        }
        $handler = $this->get($event);
        if ($handler) {
            $this->network_cache['handlers'][$event] = $handler;

            return $handler;
        }

        return false;
    }

    /**
     * Get events list via cache
     *
     * @return array
     */
    public function getEvents(): array
    {
        if (empty($this->network_cache['events'])) {
            $handlers = $this->getCache();
            $this->network_cache['events'] = [];
            foreach ($handlers as $handler) {
                if (!in_array($handler['event'], $this->network_cache['events'])) {
                    $this->network_cache['events'][] = $handler['event'];
                }
            }
        }

        return array_unique($this->network_cache['events']);
    }

    /**
     * Get connection data
     *
     * @return array
     */
    public function getConnectionData()
    {
        $this->ci->load->model('Network_model');
        $config = $this->ci->Network_model->getConfig();

        if (empty($config['fast_server']) || empty($config['key']) || empty($config['domain'])) {
            return [];
        }

        return [
            'key'    => $config['key'],
            'domain' => $config['domain'],
            'url'    => $config['fast_server'],
        ];
    }

    /**
     * Prohibit the processing of the next action.
     *
     * @param string $event
     */
    private function forbidEmiting($event)
    {
        $this->events_to_skip[$event] = true;

        return $this;
    }

    /**
     * Check whether the actions processing is allowed or not.
     * If not, allow it.
     *
     * @param string $event
     *
     * @return boolean
     */
    private function isEmitingAllowed($event)
    {
        if (!empty($this->events_to_skip[$event])) {
            $this->events_to_skip[$event] = false;

            return false;
        }

        return true;
    }

    /**
     * Execut event handler
     *
     * @param array $handler
     * @param array $data
     *
     * @return mixed
     */
    private function exec($handler, $data)
    {
        $model = $handler['model'];
        $method = $handler['method'];
        if ($handler['module'] . "_model" == strtolower($handler['model'])) {
            $model_path = $handler['model'];
        } else {
            $model_path = $handler['module'] . '/models/' . $handler['model'];
        }

        $this->ci->load->model($model_path);

        $method_exists = true;

        // TODO: убрать после приведения к PSR
        if (!method_exists($this->ci->$model, $method)) {
            $chunks = explode('_', $method);
            $method = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }

            if (!method_exists($this->ci->$model, $method)) {
                $method_exists = false;
            }
        }

        if ($method_exists) {
            $this->forbidEmiting($handler['event']);
            $this->ci->{$model}->{$method}($data);
        } else {
            echo date('H:i:s') . ': error ' . '$ci->{' . $model
            . '}->{' . $handler['method'] . '}(' . serialize($data) . ')' . PHP_EOL;
        }
    }

    /**
     * Prepare incoming data
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareIncomingData($data)
    {
        if (!empty($data['id_user'])) {
            // Replace net id with local id
            $data['id_user'] = $this->ci->Network_users_model->getLocalIdByNet($data['id_user']);
        }
        if (!empty($data['id_to'])) {
            // Replace net id with local id
            $data['id_to'] = $this->ci->Network_users_model->getLocalIdByNet($data['id_to']);
        }
        if (!empty($data['id_contact'])) {
            // Replace net id with local id
            $data['id_contact'] = $this->ci->Network_users_model->getLocalIdByNet($data['id_contact']);
        }

        return $data;
    }

    /**
     * Prepare outcoming data
     *
     * @param array $data
     *
     * @return array
     */
    private function prepareOutcomingData($data)
    {
        if (!empty($data['id_user'])) {
            // Replace local id with net id
            $net_id = $this->ci->Network_users_model->getNetIdByLocal($data['id_user']);
            if (empty($net_id)) {
                return [];
            }
            $data['id_user'] = $net_id;
        }
        if (!empty($data['id_to'])) {
            // Replace local id with net id
            $net_id = $this->ci->Network_users_model->getNetIdByLocal($data['id_to']);
            if (empty($net_id)) {
                return [];
            }
            $data['id_to'] = $net_id;
        }
        if (!empty($data['id_contact'])) {
            // Replace local id with net id
            $net_id = $this->ci->Network_users_model->getNetIdByLocal($data['id_contact']);
            if (empty($net_id)) {
                return [];
            }
            $data['id_contact'] = $net_id;
        }

        return $data;
    }

    /**
     * Handle event
     *
     * @param string $event
     * @param array  $raw_data
     */
    public function handle($event, $raw_data)
    {
        echo date('H:i:s') . ': model handle: ' . $event . PHP_EOL;
        $data = $this->prepareIncomingData($raw_data);
        foreach ($this->getCache($event) as $handler) {
            $this->exec($handler, $data);
        }
    }

    /**
     * Emit event
     *
     * @param string $event
     * @param array  $raw_data
     *
     * @return boolean
     */
    public function emit($event, $raw_data)
    {
        if (!$this->isEmitingAllowed($event)) {
            return false;
        }

        $prepared_data = $this->prepareOutcomingData($raw_data);
        if (empty($prepared_data)) {
            return false;
        }
        $event_data = [
            'event' => $event,
            'data'  => $prepared_data,
        ];

        $file = $this->getEventsDir() . $event . substr(time(), -5) . rand(11111, 99999);
        $fp = fopen($file, 'w');
        fwrite($fp, json_encode($event_data));
        fclose($fp);
        chmod($file, 0777);

        return true;
    }

    /**
     * Get events dir
     *
     * @return string
     */
    public function getEventsDir()
    {
        return $this->events_dir;
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_handler' => 'addHandler',
            'get_cache' => 'getCache',
            'get_connection_data' => 'getConnectionData',
            'get_events' => 'getEvents',
            'get_events_dir' => 'getEventsDir',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
