<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models;

if (!defined('SOCIAL_NETWORKING_PAGES_TABLE')) {
    define('SOCIAL_NETWORKING_PAGES_TABLE', DB_PREFIX . 'social_networking_pages');
}

/**
 * Social networking pages model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SocialNetworkingPagesModel extends \Model
{
    public $fields_all = [
        'id',
        'controller',
        'method',
        'name',
        'data',
    ];
    public $enabled = true;
    public $temp_pages_list = [];

    public function getPagesList($order_by = null, $params = [], $filter_object_ids = null)
    {
        $data = [];
        $select_attrs = $this->fields_all;

        $this->ci->db->select(implode(", ", $select_attrs))->from(SOCIAL_NETWORKING_PAGES_TABLE);

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
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields_all)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[$r['id']] = $this->format_page($r);
            }
        }

        return $data;
    }

    public function getPageById($page_id = false)
    {
        $data = [];
        $select_attrs = $this->fields_all;
        $result = $this->ci->db->select(implode(", ", $select_attrs))->from(SOCIAL_NETWORKING_PAGES_TABLE)->where("id", $page_id)->get()->result_array();
        if (!empty($result)) {
            $data = $this->format_page($result[0]);
        }

        return $data;
    }

    public function formatPage($data = [])
    {
        $data['data'] = @unserialize($data['data']);

        return $data;
    }

    public function validatePage($page_id = false, $data = [])
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["controller"])) {
            $return["data"]["controller"] = strip_tags($data["controller"]);
        }

        if (isset($data["method"])) {
            $return["data"]["method"] = strip_tags($data["method"]);
        }

        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
        }

        if (isset($data["data"])) {
            $return["data"]["data"] = @serialize($data["data"]);
        }

        return $return;
    }

    public function savePage($page_id = false, $data = [])
    {
        $data = (array) $data;
        if (is_null($page_id)) {
            $this->ci->db->insert(SOCIAL_NETWORKING_PAGES_TABLE, $data);
            $page_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $page_id);
            $this->ci->db->update(SOCIAL_NETWORKING_PAGES_TABLE, $data);
        }

        return $page_id;
    }

    public function deletePage($page_id = false)
    {
        $this->ci->db->where('id', $page_id);
        $this->ci->db->delete(SOCIAL_NETWORKING_PAGES_TABLE);

        return;
    }

    public function deletePagesByController($controller = '')
    {
        $this->ci->db->where('controller', $controller);
        $this->ci->db->delete(SOCIAL_NETWORKING_PAGES_TABLE);

        return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_page' => 'deletePage',
            'delete_pages_by_controller' => 'deletePagesByController',
            'format_page' => 'formatPage',
            'get_page_by_id' => 'getPageById',
            'get_pages_list' => 'getPagesList',
            'save_page' => 'savePage',
            'validate_page' => 'validatePage',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
