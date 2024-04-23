<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\models;

define('CHATBOX_SERVICES_TABLE', DB_PREFIX . 'chatbox_services');

/**
 * chatbox Model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: mchernov $
 */
class ChatboxServiceModel extends \Model
{
    /**
     * Message data
     *
     * @var array
     */
    private $fields = [
        'id',
        'id_user',
        'gid_service',
        'service_data',
        'date_add',
        'date_modified',
    ];

    /**
     * Format settings
     *
     * @var array
     */
    private $format_settings = [
        "use_format" => true,
    ];

    /**
     * ChatboxServiceModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(CHATBOX_SERVICES_TABLE);
    }

    /**
     * Return chatbox services as array
     *
     * @param array   $params   criteria
     * @param integer $page     page of results
     * @param integer $limits   rows per page
     * @param array   $order_by sorting
     *
     * @return array
     */
    private function get($params = [], $page = null, $limits = null, $order_by = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(CHATBOX_SERVICES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $this->formatServices($results);
        }

        return [];
    }

    /**
     * Return service data by id
     *
     * @param integer $chatbox_service_id
     *
     * @return array
     */
    public function getServiceById($chatbox_service_id)
    {
        $where = ['where' => ['id' => $chatbox_service_id]];
        $callback = [$this,'get'];

        $results = $this->ci->cache->get(CHATBOX_SERVICES_TABLE, 'getServiceById' . $chatbox_service_id, function () use ($callback, $where) {
            $result  = call_user_func($callback, $where);
            return $result;
        });

        if (!empty($results)) {
            return $results[0];
        } else {
            return [];
        }
    }

    /**
     * Return service data by user and service
     *
     * @param integer $user_id     user identifier
     * @param string  $service_gid service GUID
     *
     * @return array
     */
    public function getServiceByUserService($user_id, $service_gid)
    {
        $where = [
            'where' => [
                'id_user' => $user_id,
                'gid_service' => $service_gid
            ]
        ];
        $callback = [$this,'get'];
        $results = $this->ci->cache->get(CHATBOX_SERVICES_TABLE, 'getServiceByUserServiceU' . $user_id . 'GId' . $service_gid, function () use ($callback, $where) {
            $result  = call_user_func($callback, $where);
            return $result;
        });

        if (!empty($results)) {
            return current($results);
        } else {
            return ['unlimited' => true];
        }
    }

    /**
     * Save service data to data source
     *
     * @param integer $chatbox_service_id service identifier
     * @param array   $data               service data
     *
     * @return integer
     */
    public function saveService($chatbox_service_id = null, $data)
    {
        $data['date_modified'] = date('Y-m-d H:i:s');
        if (is_null($chatbox_service_id)) {
            $data["date_add"] = date('Y-m-d H:i:s');
            $this->ci->db->insert(CHATBOX_SERVICES_TABLE, $data);
            $chatbox_service_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $chatbox_service_id);
            $this->ci->db->update(CHATBOX_SERVICES_TABLE, $data);
        }
        $this->ci->cache->flush(CHATBOX_SERVICES_TABLE);
        return $chatbox_service_id;
    }

    /**
     * Change format settings
     *
     * @param string $name  parameter name
     * @param mixed  $value parameter value
     */
    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        if (empty($name)) {
            return;
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    /**
     * Fromat service data
     *
     * @param array $data service data
     *
     * @return array
     */
    public function formatServices($data)
    {
        if (!$this->format_settings['use_format']) {
            return $data;
        }
        foreach ($data as $key => $service) {
            $data[$key]['service_data'] = unserialize($service['service_data']);
            if (!empty($service['service_data'])) {
                $service['service_data'] = [];
            }
        }
        return $data;
    }

    /**
     * Remove Service
     *
     * @param integer $user_id
     *
     * @return void
     */
    public function removeService($user_id, $service)
    {
        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->where('gid_service', $service);
        $this->ci->db->delete(CHATBOX_SERVICES_TABLE);
        $this->ci->cache->flush(CHATBOX_SERVICES_TABLE);
    }

    /**
     * Validate service data
     *
     * @param integer $chatbox_service_id service identifier
     * @param array   $data               service data
     *
     * @return array
     */
    public function validateService($chatbox_service_id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['id_user'])) {
            $return['data']['id_user'] = intval($data['id_user']);
        }

        if (isset($data['gid_service'])) {
            $return['data']['gid_service'] = strval($data['gid_service']);
        }

        if (isset($data['service_data'])) {
            if (empty($data['service_data'])) {
                $data['service_data'] = [];
            }
            $return['data']['service_data'] = serialize($data['service_data']);
        }

        if (isset($data['date_add'])) {
            $value = strtotime($data['date_add']);
            if ($value > 0) {
                $return['data']['date_add'] = date("Y-m-d", $value);
            } else {
                $return['data']['date_add'] = '0000-00-00 00:00:00';
            }
        }

        if (isset($data['date_modified'])) {
            $value = strtotime($data['date_modified']);
            if ($value > 0) {
                $return['data']['date_modified'] = date("Y-m-d", $value);
            } else {
                $return['data']['date_modified'] = '0000-00-00 00:00:00';
            }
        }
        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'format_services' => 'formatServices',
            'get_service_by_id' => 'getServiceById',
            'get_service_by_user_service' => 'getServiceByUserService',
            'save_service' => 'saveService',
            'set_format_settings' => 'setFormatSettings',
            'validate_service' => 'validateService',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
