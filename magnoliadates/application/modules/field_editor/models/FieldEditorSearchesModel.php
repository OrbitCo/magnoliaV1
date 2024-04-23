<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\models;

if (!defined('FIELD_EDITOR_SAVED_SEARCHES')) {
    define('FIELD_EDITOR_SAVED_SEARCHES', DB_PREFIX . 'field_editor_saved_searches');
}

/**
 * Field Editor Searches Model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FieldEditorSearchesModel extends \Model
{
    /**
     * FieldEditorSearchesModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(FIELD_EDITOR_SAVED_SEARCHES);
    }

    public function getSearchById($id)
    {
        $nameTable = FIELD_EDITOR_SAVED_SEARCHES;
        $result =  $this->ci->cache->get(FIELD_EDITOR_SAVED_SEARCHES, 'getSearchById' . $id, function () use ($id, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select("id, id_user, form_gid, editor_type_gid, name, criteria, date_add")
                ->from($nameTable)
                ->where("id", $id)
                ->get()
                ->result_array();

            return $result;
        });
        $return = (!empty($result)) ? $result[0] : [];
        if (!empty($return["criteria"])) {
            $return["criteria"] = unserialize($return["criteria"]);
        }

        return $return;
    }

    public function getSearches($params = [], $order_by = [])
    {
        $result = $this->ci->db->select("id, id_user, form_gid, editor_type_gid, name, criteria, date_add")->from(FIELD_EDITOR_SAVED_SEARCHES);

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

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function getSearchesCount($params = [])
    {
        $result = $this->ci->db->select("COUNT(*) AS cnt")->from(FIELD_EDITOR_SAVED_SEARCHES);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function saveSearch($id, $data)
    {
        if (empty($id)) {
            $data["date_add"] = date('Y-m-d H:i:s');
            $this->ci->db->insert(FIELD_EDITOR_SAVED_SEARCHES, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(FIELD_EDITOR_SAVED_SEARCHES, $data);
        }
        $this->ci->cache->flush(FIELD_EDITOR_SAVED_SEARCHES);

        return $id;
    }

    public function deleteSearch($id)
    {
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(FIELD_EDITOR_SAVED_SEARCHES);
        $this->ci->cache->flush(FIELD_EDITOR_SAVED_SEARCHES);
    }

    public function validateSearch($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["editor_type_gid"])) {
            $return["data"]["editor_type_gid"] = strval($data["editor_type_gid"]);
        }
        if (isset($data["form_gid"])) {
            $return["data"]["form_gid"] = strval($data["form_gid"]);
        }
        if (isset($data["id_user"])) {
            $return["data"]["id_user"] = intval($data["id_user"]);
        }
        if (isset($data["name"])) {
            $return["data"]["name"] = trim(strip_tags($data["name"]));
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_empty_search_name', 'field_editor');
            }
        }
        if (isset($data["criteria"])) {
            $return["data"]["criteria"] = $data["criteria"];
            if (empty($return["data"]["criteria"])) {
                $return["errors"][] = l('error_empty_search_criteria', 'field_editor');
            }
            $return["data"]["criteria"] = serialize($return["data"]["criteria"]);
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_search' => 'deleteSearch',
            'get_search_by_id' => 'getSearchById',
            'get_searches' => 'getSearches',
            'get_searches_count' => 'getSearchesCount',
            'save_search' => 'saveSearch',
            'validate_search' => 'validateSearch',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
