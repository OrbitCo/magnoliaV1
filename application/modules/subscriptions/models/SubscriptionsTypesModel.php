<?php

declare(strict_types=1);

namespace Pg\modules\subscriptions\models;

if (!defined('SUBSCRIPTIONS_TYPES_TABLE')) {
    define('SUBSCRIPTIONS_TYPES_TABLE', DB_PREFIX . 'subscriptions_types');
}

/**
 * Subscriptions types model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class SubscriptionsTypesModel extends \Model
{
    private $attrs = ['id', 'gid', 'module', 'model', 'method'];

    public function getSubscriptionsTypesList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TYPES_TABLE);

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
                if (in_array($field, $this->attrs)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $data = [];
        $results = $this->ci->db->get()->result_array();
        $data[] = ['id' => 0, 'name' => l('without_content', 'subscriptions')];
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $this->format_subscriptions_type($r, true);
            }
        }

        return $data;
    }

    public function formatSubscriptionsType($data, $get_langs = false)
    {
        $data["name_i"] = "subscriptions_type_" . $data["gid"];
        $data["name"] = ($get_langs) ? (l($data["name_i"], $data['module'])) : "";

        return $data;
    }

    public function getSubscriptionsTypeById($id)
    {
        $data = [];
        $result = $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TYPES_TABLE)->where("id", $id)->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function getSubscriptionsTypeByGid($gid)
    {
        $data = [];
        $result = $this->ci->db->select(implode(", ", $this->attrs))->from(SUBSCRIPTIONS_TYPES_TABLE)->where("gid", $gid)->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function getSubscriptionsTypeContent($id, $lang_id = 1)
    {
        $result = [];
        $st_object = $this->getSubscriptionsTypeById($id);
        if (!empty($st_object['module']) && !empty($st_object['model']) && !empty($st_object['method'])) {
            if ($this->isMethodCallable($st_object["module"], $st_object["model"], $st_object["method"])) {
                $this->ci->load->model($st_object["module"] . "/models/" . $st_object["model"]);
                $lang_id = $lang_id ?: $this->ci->pg_language->get_default_lang_id();
                $result = $this->ci->{$st_object["model"]}->{$st_object["method"]}($lang_id);
            }
        }

        return $result;
    }

    private function isMethodCallable($module, $model, $method)
    {
        $result = false;

        $model_url = $module . "/models/" . $model;
        $model_path = MODULEPATH . strtolower($model_url) . EXT;

        if (file_exists($model_path)) {
            $this->ci->load->model($model_url);
            $object = [$this->ci->{$model}, $method];
            $result = is_callable($object);
        }

        return $result;
    }

    public function saveSubscriptionsType($id, $data)
    {
        if (is_null($id)) {
            $this->ci->db->insert(SUBSCRIPTIONS_TYPES_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(SUBSCRIPTIONS_TYPES_TABLE, $data);
        }

        return $id;
    }

    public function deleteSubscriptionsTypeByGid($gid)
    {
        $this->ci->db->where("gid", $gid);
        $this->ci->db->delete(SUBSCRIPTIONS_TYPES_TABLE);

        return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_subscriptions_type_by_gid' => 'deleteSubscriptionsTypeByGid',
            'format_subscriptions_type' => 'formatSubscriptionsType',
            'get_subscriptions_type_by_gid' => 'getSubscriptionsTypeByGid',
            'get_subscriptions_type_by_id' => 'getSubscriptionsTypeById',
            'get_subscriptions_type_content' => 'getSubscriptionsTypeContent',
            'get_subscriptions_types_list' => 'getSubscriptionsTypesList',
            'save_subscriptions_type' => 'saveSubscriptionsType',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
