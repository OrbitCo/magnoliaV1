<?php

declare(strict_types=1);

namespace Pg\modules\menu\models;

if (!defined('MENU_TABLE')) {
    define('MENU_TABLE', DB_PREFIX . 'menu');
}

if (!defined('MENU_ITEMS_TABLE')) {
    define('MENU_ITEMS_TABLE', DB_PREFIX . 'menu_items');
}

/**
 * Menu main model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class MenuModel extends \Model
{
    public $menu_fields_all         = [
        "id",
        "gid",
        "name",
        "check_permissions",
        'date_created',
        'date_modified',
    ];

    public $items_fields_all        = [
        "id",
        "menu_id",
        "parent_id",
        "gid",
        "link",
        "icon",
        "material_icon",
        "sorter",
        "status",
        "is_external",
        "indicator_gid",
    ];

    private $moderate_sections = ['admin_main_menu', 'admin_menu_level1', 'page_sections'];

    public $menu_cache              = [];
    private $menu_items_cache       = [];
    public $menu_raw_items_cache    = [];
    public $curent_active_item_id   = [];
    public $temp_generate_raw_menu  = [];
    public $temp_generate_raw_items = [];
    public $breadcrumbs             = [];
    private $max_length             = 50;
    public $indicators              = [];

    private $menu_items_all = null;

    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(MENU_TABLE);
        $this->ci->cache->registerService(MENU_ITEMS_TABLE);
    }

    // menu functions
    public function getMenusList($page = null, $items_on_page = null, $order_by = [])
    {
        $this->ci->db->select(implode(", ", $this->menu_fields_all));
        $this->ci->db->from(MENU_TABLE);

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->menu_fields_all)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $r;
            }

            return $data;
        }

        return false;
    }

    public function getMenusCount($params = [])
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(MENU_TABLE);

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

        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        }

        return 0;
    }

    public function getMenuById($menu_id)
    {
        if (!isset($this->menu_cache[$menu_id])) {
            $result = $this->ci->db->select(implode(", ", $this->menu_fields_all))->from(MENU_TABLE)->where("id", $menu_id)->get()->result_array();
            if (!empty($result)) {
                $this->menu_cache[$menu_id] = $this->menu_cache[$result[0]["gid"]] = $result[0];
            }
        }

        return $this->menu_cache[$menu_id];
    }

    public function getMenuByGid($gid)
    {
        if (!isset($this->menu_cache[$gid])) {
            $fields = $this->menu_fields_all;

            $results = $this->ci->cache->get(MENU_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();
                $results = $ci->db->select(implode(", ", $fields))
                    ->from(MENU_TABLE)
                    ->get()->result_array();

                if (empty($results) || !is_array($results)) {
                    return null;
                }

                return $results;
            });

            if (!empty($results)) {
                foreach ($results as $result) {
                    $this->menu_cache[$result['gid']] = $this->menu_cache[$result['id']] = $result;
                }
            }
        }

        if (isset($this->menu_cache[$gid])) {
            return $this->menu_cache[$gid];
        }

        return false;
    }

    public function saveMenu($menu_id, $attrs)
    {
        if (is_null($menu_id)) {
            $attrs["date_created"]  = $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(MENU_TABLE, $attrs);
            $menu_id = $this->ci->db->insert_id();
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $menu_id);
            $this->ci->db->update(MENU_TABLE, $attrs);
        }

        $this->ci->cache->flush(MENU_TABLE);

        return $menu_id;
    }

    public function validateMenu($menu_id, $data)
    {
        $return = ["errors" => [], "data" => []];

        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('name', 'reg_exps');

        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"]) || strpbrk($return["data"]["name"], $name_expr) !== false) {
                $return["errors"][] = l('error_menu_name_invalid', 'menu');
            }
        }

        if (isset($data["gid"])) {
            $return["data"]["gid"] = strip_tags($data["gid"]);
            if (empty($return["data"]["gid"]) || strpbrk($return["data"]["gid"], $name_expr) !== false) {
                $return["errors"][] = l('error_menu_gid_invalid', 'menu');
            }
        }
        if (isset($data["check_permissions"])) {
            $return["data"]["check_permissions"] = intval($data["check_permissions"]);
        }

        return $return;
    }

    /**
     * Delete menu by gid
     *
     * @param string $gid
     *
     * @return boolean
     */
    public function deleteMenuByGid($gid)
    {
        $results = $this->ci->db
                        ->select('id')
                        ->from(MENU_TABLE)->where('gid', $gid)
                        ->get()->result_array();
        if (0 === count($results)) {
            return false;
        }
        foreach ($results as $result) {
            $this->deleteMenu($result['id']);
        }

        $this->ci->cache->flush(MENU_TABLE);

        return true;
    }

    public function deleteMenu($menu_id)
    {
        $this->ci->db->where('id', $menu_id);
        $this->ci->db->delete(MENU_TABLE);
        $this->delete_menu_items($menu_id);

        $this->ci->cache->flush(MENU_TABLE);
        $this->ci->cache->flush(MENU_ITEMS_TABLE);

        $this->menu_items_all = null;
    }

    public function deleteMenuItems($menu_id)
    {
        $this->ci->db->where('menu_id', $menu_id);
        $this->ci->db->delete(MENU_ITEMS_TABLE);

        $this->ci->pg_language->pages->delete_module("menu_lang_" . $menu_id);

        $this->ci->cache->flush(MENU_ITEMS_TABLE);

        $this->menu_items_all = null;
    }

    // menu items functions
    public function getMenuItemsList($menu_id, $check_permissions = false, $params = [], $parent_id = 0, $permissions = [], $no_cache = false)
    {
        $_key = md5($menu_id . $check_permissions . serialize($params) . $parent_id . serialize($permissions));

        if (!isset($this->menu_items_cache[$_key])) {
            $menu_id = intval($menu_id);

            if ($params == ['where' => ['status' => 1]]) {
                $results = $this->getAllMenuItems();

                foreach ($results as $index => $result) {
                    if ($result['status'] != $params['where']['status'] || $result['menu_id'] != $menu_id) {
                        unset($results[$index]);
                    }
                }
            } else {
                $this->ci->db->select(implode(", ", $this->items_fields_all));
                $this->ci->db->from(MENU_ITEMS_TABLE);

                $params["where"]["menu_id"] = $menu_id;

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

                $this->ci->db->order_by("parent_id ASC");
                $this->ci->db->order_by("sorter ASC");

                $results = $this->ci->db->get()->result_array();

                if ($no_cache) {
                    return $results;
                }
            }

            $this->temp_generate_raw_items = $this->temp_generate_raw_menu  = [];

            $menu_lang_gid = "menu_lang_" . $menu_id;
            $auth_type     = $this->ci->session->userdata("auth_type");

            if (!empty($results) && is_array($results)) {
                $active_parent_id = [];

                foreach ($results as $r) {
                    $r = $this->parseLink($r);

                    if ($check_permissions && !empty($permissions)) {
                        if (!$this->isModerateAccessToItem($r, $permissions, $params)) {
                            continue;
                        }
                    } elseif ($check_permissions && !$this->isAccessToItem($r, $auth_type)) {
                        continue;
                    }
                    $r["active"]  = $this->isActiveItem($r);
                    $r["value"]   = $this->ci->pg_language->get_string($menu_lang_gid, "menu_item_" . $r["id"]);
                    $r["tooltip"] = $this->ci->pg_language->get_string($menu_lang_gid, "menu_tooltip_item_" . $r["id"]);
                    if ($r["active"]) {
                        $active_parent_id[] = $r["parent_id"];
                    }
                    $this->temp_generate_raw_items[$r["id"]] = $r;
                }
                if (!empty($active_parent_id)) {
                    $this->setActiveChain($active_parent_id);
                }

                foreach ($this->temp_generate_raw_items as $r) {
                    if (isset($r["parent_id"])) {
                        $this->temp_generate_raw_menu[$r["parent_id"]][] = $r;
                    }
                }
                $this->menu_raw_items_cache    = (!empty($this->menu_raw_items_cache)) ? array_merge($this->menu_raw_items_cache, $this->temp_generate_raw_items) : $this->temp_generate_raw_items;
                $this->menu_items_cache[$_key] = $this->generateMenu($parent_id);
            } else {
                $this->menu_items_cache[$_key] = false;
            }
        }

        return $this->menu_items_cache[$_key];
    }

    public function getMenuItemsCount($menu_id, $params = [])
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(MENU_ITEMS_TABLE);

        $params["where"]["menu_id"] = intval($menu_id);

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

    public function getMenuActiveItemsList($menu_id, $check_permissions = false, $params = [], $parent_id = 0, $permissions = [])
    {
        $params["where"]["status"] = 1;

        return $this->getMenuItemsList($menu_id, $check_permissions, $params, $parent_id, $permissions);
    }

    private function resetAllMenuItems()
    {
        $this->menu_items_all = null;

        return $this->getAllMenuItems();
    }

    private function getAllMenuItems()
    {
        if ($this->menu_items_all === null) {
            $fields = $this->items_fields_all;

            $this->menu_items_all = $this->ci->cache->get(MENU_ITEMS_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(MENU_ITEMS_TABLE)
                    ->order_by('parent_id ASC')
                    ->order_by('sorter ASC')
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return [];
                }
                $results = [];
                foreach ($results_raw as $value) {
                    $results[$value['id']] = $value;
                }

                return $results;
            });
        }

        return $this->menu_items_all;
    }

    public function getMenuItemById($item_id, $get_langs = false)
    {
        $results = $this->getAllMenuItems();

        if (empty($results)) {
            return false;
        } elseif (empty($results[$item_id])) {
            $results = $this->resetAllMenuItems();
        }

        foreach ($results as $result) {
            if ($result['id'] == $item_id) {
                return $this->formatItem($result, $get_langs);
            }
        }

        return false;
    }

    public function getMenuItemByGid($gid, $menu_id = null, $get_langs = false)
    {
        $results = $this->getAllMenuItems();

        if (empty($results)) {
            return false;
        }

        foreach ($results as $result) {
            if ($result['gid'] == $gid && ($result['menu_id'] == $menu_id || !$menu_id)) {
                return $this->formatItem($result, $get_langs);
            }
        }

        return false;
    }

    public function formatItem($data, $get_langs = false)
    {
        $data = $this->parseLink($data);

        $data["value"] = $this->ci->pg_language->get_string("menu_lang_" . $data["menu_id"], "menu_item_" . $data['id']);
        $data["tooltip"] = $this->ci->pg_language->get_string("menu_lang_" . $data["menu_id"], "menu_tooltip_item_" . $data['id']);
        $data["indicator"] =  $data["indicator_gid"];

        if ($get_langs) {
            $data["langs"] = $this->_get_item_string_data($data["menu_id"], $data['id']);
        }

        return $data;
    }

    public function saveMenuItem($item_id, $data, $lang_data = [], $lang_tooltip_data = [])
    {
        if (is_null($item_id)) {
            if (!isset($data["status"])) {
                $data["status"] = 1;
            }
            if (!isset($data["sorter"]) && isset($data["menu_id"])) {
                $sorter_params["where"]["parent_id"] = isset($data["parent_id"]) ? $data["parent_id"] : 0;
                $data["sorter"] = $this->get_menu_items_count($data["menu_id"], $sorter_params) + 1;
            }
            $this->ci->db->insert(MENU_ITEMS_TABLE, $data);
            $item_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $item_id);
            $this->ci->db->update(MENU_ITEMS_TABLE, $data);
        }

        $this->ci->cache->flush(MENU_ITEMS_TABLE);

        $this->menu_items_all = null;

        // Refresh data
        $this->getMenuItemById($item_id);

        // langs
        if (isset($lang_data) && !empty($lang_data) && isset($data["menu_id"])) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_value   = (isset($lang_data[$default_lang_id])) ? $lang_data[$default_lang_id] : current($lang_data);

            foreach ($this->ci->pg_language->languages as $lang_id => $language) {
                if (!isset($lang_data[$lang_id])) {
                    $lang_data[$lang_id] = $default_value;
                }
            }

            $this->ci->pg_language->pages->set_string_langs("menu_lang_" . $data["menu_id"], "menu_item_" . $item_id, $lang_data, array_keys($this->ci->pg_language->languages));
        }

        // tooltips
        if (isset($lang_tooltip_data) && !empty($lang_tooltip_data) && isset($data["menu_id"])) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_value   = (isset($lang_tooltip_data[$default_lang_id])) ? $lang_tooltip_data[$default_lang_id] : current($lang_data);

            foreach ($this->ci->pg_language->languages as $lang_id => $language) {
                if (!isset($lang_tooltip_data[$lang_id])) {
                    $lang_tooltip_data[$lang_id] = $default_value;
                }
            }

            $this->ci->pg_language->pages->set_string_langs("menu_lang_" . $data["menu_id"], "menu_tooltip_item_" . $item_id, $lang_tooltip_data, array_keys($this->ci->pg_language->languages));
        }

        return $item_id;
    }

    public function saveMenuItemLang($item_id, $menu_id, $lang_data, $lang_tooltip_data = [])
    {
        $this->ci->pg_language->pages->set_string_langs("menu_lang_" . $menu_id, "menu_item_" . $item_id, $lang_data, array_keys($lang_data));
        if (!empty($lang_tooltip_data)) {
            $this->ci->pg_language->pages->set_string_langs("menu_lang_" . $menu_id, "menu_tooltip_item_" . $item_id, $lang_tooltip_data, array_keys($lang_tooltip_data));
        }
    }

    public function validateMenuItem($item_id = null, $data = [])
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["menu_id"]) || !$item_id) {
            if (!isset($data["menu_id"]) || empty($data["menu_id"])) {
                $return["errors"][] = l('error_menu_item_menu_required', 'menu');
                $return["data"]["menu_id"] = 0;
            } else {
                $return["data"]["menu_id"] = intval($data["menu_id"]);
            }
        }

        if ($data["link_on"]) {
            unset($data["link_on"]);
            if (!empty($data["link"])) {
                $return["data"]["link"] = strip_tags($data["link"]);
                $return["data"]["link"] = str_replace(site_url(), "", $return["data"]["link"]);
            } else {
                $return["errors"][] = l('error_menu_item_link_required', 'menu');
            }
        } else {
            $return["data"]["link"] = null;
        }

        if (isset($data["icon"])) {
            $return["data"]["icon"] = strip_tags($data["icon"]);
        }

        if (isset($data["material_icon"])) {
            $return["data"]["material_icon"] = strip_tags($data["material_icon"]);
        }

        if (!empty($data["gid"])) {
            $return["data"]["gid"] = strip_tags($data["gid"]);
        } else {
            $guid_data = $this->createGUID($data['names']);
            if (!empty($guid_data["errors"])) {
                $return['errors'][] = $guid_data['errors'];
            } else {
                $return['data']['gid'] = $guid_data['data']['gid'];
            }
        }

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        $current_lang_id = $this->ci->pg_language->current_lang_id;
        foreach ($data['names'] as $lid => $name) {
            if (!empty($data['names'][$lid])) {
                $return['names'][$lid] = $name;
            } elseif ($data['names'][$default_lang_id]) {
                $return['names'][$lid] = $data['names'][$default_lang_id];
            } elseif ($data['names'][$current_lang_id]) {
                $return['names'][$lid] = $data['names'][$current_lang_id];
            } else {
                $return['names'][$lid] = $return['data']['gid'];
            }
        }

        if (isset($data["parent_id"])) {
            $return["data"]["parent_id"] = intval($data["parent_id"]);
        }

        if (isset($data["sorter"])) {
            $return["data"]["sorter"] = intval($data["sorter"]);
        }

        if (isset($data["status"])) {
            $return["data"]["status"] = intval($data["status"]);
        }

        if (isset($data["is_external"])) {
            $return["data"]["is_external"] = $data["is_external"] ? 1 : 0;
        }

        if (isset($data["indicator_gid"])) {
            $return["data"]["indicator_gid"] = strip_tags($data["indicator_gid"]);
        }

        return $return;
    }

    protected function createGUID($names = null)
    {
        $name = "";
        $get_default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($names[$this->ci->pg_language->current_lang_id]) {
            $name = strip_tags($names[$this->ci->pg_language->current_lang_id]);
        } elseif ($names[$get_default_lang_id]) {
            $name = strip_tags($names[$get_default_lang_id]);
        } else {
            foreach ($names as $val) {
                if (!empty($val)) {
                    $name = strip_tags($val);

                    continue;
                }
            }
        }
        if (!empty($name)) {
            $this->ci->load->library('Translit');
            $gid = mb_strtolower($this->ci->translit->convert('ru', $name));
            $return = [
                'data' => ['gid' => preg_replace("/[^a-z0-9\-]+/i", '', $gid)]
            ];
            if (empty($return['data']['gid'])) {
                $return['errors'] = l('error_menu_gid_invalid', 'menu');
            }
        } else {
            $return['errors'] = l('error_menu_name_invalid', 'menu');
        }

        return $return;
    }

    public function deleteMenuItem($item_id)
    {
        $item_data = $this->get_menu_item_by_id($item_id);
        if (!empty($item_data)) {
            $this->ci->db->where('id', $item_id);
            $this->ci->db->delete(MENU_ITEMS_TABLE);
            $this->resort_menu_items($item_data["menu_id"], $item_data["parent_id"]);
            $this->ci->pg_language->pages->delete_string("menu_lang_" . $item_data["menu_id"], "menu_item_" . $item_id);
            $this->ci->pg_language->pages->delete_string("menu_lang_" . $item_data["menu_id"], "menu_tooltip_item_" . $item_id);

            ///// delete sub items
            $results = $this->ci->db->select("id")->from(MENU_ITEMS_TABLE)->where("parent_id", $item_id)->order_by('sorter ASC')->get()->result_array();
            if (!empty($results)) {
                foreach ($results as $r) {
                    $this->delete_menu_item($r["id"]);
                }
            }
        }

        $this->ci->cache->flush(MENU_ITEMS_TABLE);

        $this->menu_items_all = null;
    }

    public function activateMenuItem($item_id, $status = 1)
    {
        $attrs["status"] = intval($status);
        $this->ci->db->where('id', $item_id);
        $this->ci->db->update(MENU_ITEMS_TABLE, $attrs);

        $this->ci->cache->flush(MENU_ITEMS_TABLE);

        $this->menu_items_all = null;
    }

    public function resortMenuItems($menu_id, $parent_id = 0)
    {
        $results = $this->ci->db->select("id, sorter")->from(MENU_ITEMS_TABLE)->where("menu_id", $menu_id)->where("parent_id", $parent_id)->order_by('sorter ASC')->get()->result_array();
        if (!empty($results)) {
            $i = 1;
            foreach ($results as $r) {
                $data["sorter"] = $i;
                $this->ci->db->where('id', $r["id"]);
                $this->ci->db->update(MENU_ITEMS_TABLE, $data);
                ++$i;
            }
        }
    }

    public function setMenuActiveItem($menu_id, $item_id)
    {
        if (!is_numeric($menu_id)) {
            $menu    = $this->get_menu_by_gid($menu_id);
            $menu_id = $menu["id"];
        }
        if (!$menu_id) {
            return false;
        }
        if (!is_numeric($item_id)) {
            $item    = $this->get_menu_item_by_gid($item_id, $menu_id);
            $item_id = $item["id"];
        }
        if (!$item_id) {
            return false;
        }
        $this->curent_active_item_id[$menu_id] = $item_id;
    }

    public function getItemStringData($menu_id, $item_id, $lang_ids = [], $type = "value")
    {
        $data = [];
        if (empty($lang_ids)) {
            $lang_ids = array_keys($this->ci->pg_language->languages);
        }
        foreach ($lang_ids as $lang_id) {
            if ($type == "value") {
                $data[$lang_id] = $this->ci->pg_language->get_string("menu_lang_" . $menu_id, "menu_item_" . $item_id, $lang_id);
            } elseif ($type == "tooltip") {
                $data[$lang_id] = $this->ci->pg_language->get_string("menu_lang_" . $menu_id, "menu_tooltip_item_" . $item_id, $lang_id);
            }
        }

        return $data;
    }

    public function isModerateAccessToItem($item, $permissions, $params = [])
    {
        if (!$item["controller"] && !$item["method"]) {
            return true;
        }

        if (
            is_array($params) && isset($params['moderate_sections']) &&
                in_array($params['moderate_sections'], $this->moderate_sections)
        ) {
            $this->ci->load->model('Moderators_model');
            $methods = $this->ci->Moderators_model->getModuleMethods($item["module"]);
            $methods_cnt = count($methods);

            if (is_array($methods) && $methods_cnt > 0) {
                if ($methods_cnt == 1) {
                    if (!isset($permissions[$item["module"]])) {
                        return false;
                    }
                    /**
                     * Moderators access sets for the whole module, so, don't matter,
                     * what method is it
                     */
                    return (intval(end($permissions[$item["module"]])) == 1) ? true : false;
                }
                /**
                 * If access for this method of the module is not tunable for the
                 * moderators, moderator have access
                 */
                if (!in_array($item["method"], $methods)) {
                    if (!isset($permissions[$item["module"]])) {
                        //no access to the at least one method of the module
                        return false;
                    }

                    return true;
                }
            }
        }
        if (!isset($permissions[$item["module"]][$item["method"]]) || $permissions[$item["module"]][$item["method"]] != 1) {
            return false;
        }

        return true;
    }

    public function isAccessToItem($item, $auth_type = null)
    {
        if (!$item["controller"] && !$item["method"]) {
            return true;
        } elseif ($item["module"] == 'm') {
            return true;
        }
        $item["method"] = empty($item["method"]) ? 'index' : $item["method"];
        $access = $this->ci->pg_module->get_module_method_access($item["module"], $item["controller"], $item["method"]);

        if (!$access) {
            return false;
        }

        $auth_type = !empty($auth_type) ? $auth_type : $this->ci->session->userdata("auth_type");

        switch ($auth_type) {
            case "module":
                $allow = ($access <= 1 || $access == 4) ? true : false;

                break;
            case "admin":
                $allow = ($access <= 1 || $access == 3) ? true : false;

                break;
            case "user":
                $allow = ($access <= 2) ? true : false;

                break;
            default:
                $allow = ($access <= 1) ? true : false;
        }

        if (!$allow) {
            return false;
        }

        return true;
    }

    public function parseLink($item)
    {
        $item["module"] = $item["controller"] = $item["method"] = $item["link_out"] = $item["link_in"] = "";

        $link = str_replace(site_url(), "", $item["link"]);
        if (substr($link, 0, 1) == "/") {
            $link = substr($link, 1);
        }

        if (preg_match("/^([a-z]{3,5}:\/\/)/i", $link)) {
            $item["link_out"] = $link;

            return $item;
        }

        if ($item['is_external']) {
            $item["link_out"] = $item["link"];
        } else {
            $params = explode("/", $link);
            if ($params[0] == "admin") {
                $params[1]          = !empty($params[1]) ? $params[1] : $this->ci->router->default_controller;
                $item["controller"] = "admin_" . $params[1];
                $item["module"]     = $params[1];
                $item["method"]     = !empty($params[2]) ? $params[2] : "index";
                $item["params"]     = array_slice($params, 3);
                $is_admin           = true;
            } else {
                $params[0]          = !empty($params[0]) ? $params[0] : $this->ci->router->default_controller;
                $item["controller"] = $item["module"]     = $params[0];
                $item["method"]     = !empty($params[1]) ? $params[1] : '';
                $item["params"]     = array_slice($params, 2);
                $is_admin           = false;
            }
            $item["link_in"] = $item["link"];
        }
        if (!empty($item["module"])) {
            $this->ci->load->helper("seo");
            $params_str   = (!empty($item["params"])) ? implode("|", $item["params"]) : "";
            $item["link"] = rewrite_link($item["module"], $item["method"], $params_str, $is_admin);
        }

        return $item;
    }

    public function isActiveItem($item)
    {
        if (!empty($this->curent_active_item_id[$item["menu_id"]])) {
            if ($this->curent_active_item_id[$item["menu_id"]] == $item["id"]) {
                return true;
            }
        } else {
            if (!$item["controller"] && !$item["method"]) {
                return false;
            }
            if (
                $item["controller"] == $this->ci->router->fetch_class(true) &&
                $item["method"] == $this->ci->router->fetch_method()
            ) {
                return true;
            }
        }

        return false;
    }

    public function setActiveChain($parent_ids)
    {
        foreach ($parent_ids as $id) {
            $parent_id = $id;
            do {
                $this->temp_generate_raw_items[$parent_id]["in_chain"] = true;
                if (!empty($this->temp_generate_raw_items[$parent_id]["parent_id"])) {
                    $parent_id = $this->temp_generate_raw_items[$parent_id]["parent_id"];
                } else {
                    $parent_id = 0;
                }
            } while ($parent_id > 0);
        }
    }

    private function generateMenu($parent_id)
    {
        if (empty($this->temp_generate_raw_menu) || empty($this->temp_generate_raw_menu[$parent_id])) {
            return [];
        }

        $menu = [];
        foreach ($this->temp_generate_raw_menu[$parent_id] as $subitem) {
            if (isset($this->temp_generate_raw_menu[$subitem['id']]) && !empty($this->temp_generate_raw_menu[$subitem['id']])) {
                $subitem['sub'] = $this->generateMenu($subitem['id']);
            }
            // Indicators
            if (!empty($this->indicators[$subitem['indicator_gid']])) {
                $subitem['indicator'] = $this->indicators[$subitem['indicator_gid']];
            } else {
                $subitem['indicator'] = '';
            }
            $menu[] = $subitem;
        }

        return $menu;
    }

    // breadcrumbs
    public function breadcrumbsSetParent($item_gid, $profile_section = '')
    {
        $item = $this->getMenuItemByGid($item_gid);
        if (empty($item)) {
            return $item;
        }
        if ($profile_section) {
            $profile_section = " > " . $profile_section;
        }
        $this->get_menu_active_items_list($item["menu_id"]);
        $parent_id = $item['id'];
        unset($this->breadcrumbs['chain']);
        do {
            if (!empty($this->menu_raw_items_cache[$parent_id])) {
                $item = $this->menu_raw_items_cache[$parent_id];
                if (!empty($item["link_in"]) && $item["link_in"] != "/") {
                    $breadcrumbs[] = [
                        "text" => $item["value"] . $profile_section,
                        "url"  => $item["link"],
                    ];
                }

                $parent_id = $item['parent_id'];
            } else {
                $parent_id = 0;
            }
        } while ($parent_id != 0);

        if (isset($breadcrumbs)) {
            $chain_size = count($breadcrumbs);
            for ($i = $chain_size - 1; $i >= 0; --$i) {
                $this->breadcrumbs['chain'][] = $breadcrumbs[$i];
            }
        }
    }

    public function breadcrumbsSetActive(string $text, $url = '')
    {
        // Cut
        if (mb_strlen($text, 'utf-8') > $this->max_length + 3) {
            $text = mb_substr($text, 0, $this->max_length, 'utf-8') . '...';
        }
        $this->breadcrumbs['active'][] = [
            "text" => $text,
            "url"  => $url,
        ];
    }

    public function getBreadcrumbs()
    {
        $return = [];

        if (!empty($this->breadcrumbs['chain'])) {
            $return = $this->breadcrumbs['chain'];
        }
        if (!empty($this->breadcrumbs['active'])) {
            foreach ($this->breadcrumbs['active'] as $active) {
                $return[] = $active;
            }
        }
        $size = count($return);
        if (!empty($return)) {
            $return[$size - 1]["url"] = '';
        }

        return $return;
    }

    /**
     * Returns items gids as they are in database
     *
     * @param string $menu_gid
     * @param array  $items_gids
     *
     * @return array
     */
    private function getLangGids($menu_gid, $items_gids)
    {
        $menu         = $this->get_menu_by_gid($menu_gid);
        $gids['menu'] = 'menu_lang_' . $menu['id'];
        foreach ($items_gids as $item_gid) {
            $menu_item       = $this->get_menu_item_by_gid($item_gid);
            $gids['items'][] = 'menu_item_' . $menu_item['id'];
        }

        return $gids;
    }

    /**
     * Returns langs data
     *
     * @param array $menus
     * @param array $langs_ids
     *
     * @return array
     */
    public function exportLangs($menus, $langs_ids = null)
    {
        $lang_data = [];
        foreach ($menus as $menu_gid => $menu_items) {
            $gids_db    = $this->getLangGids($menu_gid, $menu_items);
            $langs_db   = $this->ci->pg_language->export_langs($gids_db['menu'], $gids_db['items'], $langs_ids);
            $lang_codes = array_keys($langs_db);
            foreach ($lang_codes as $lang_code) {
                $lang_data[$lang_code][$menu_gid] = array_combine($menu_items, $langs_db[$lang_code]);
            }
        }

        return $lang_data;
    }

    /**
     * Updates langs data
     *
     * @param array $menus
     * @param array $langs_data
     *
     * @return boolean
     */
    public function updateLangs($menus, $langs_data)
    {
        foreach ($menus as $menu_gid => $menu_items) {
            $menu = $this->get_menu_by_gid($menu_gid);
            foreach ($menu_items as $item_gid) {
                $lang_data = $langs_data[$item_gid];
                $menu_item = $this->get_menu_item_by_gid($item_gid);
                $this->ci->pg_language->pages->set_string_langs('menu_lang_' . $menu['id'], 'menu_item_' . $menu_item['id'], $lang_data, array_keys($lang_data));
            }
        }

        return true;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_get_item_string_data' => 'getItemStringData',
            '_is_access_to_item' => 'isAccessToItem',
            '_is_active_item' => 'isActiveItem',
            '_is_moderate_access_to_item' => 'isModerateAccessToItem',
            '_parse_link' => 'parseLink',
            '_set_active_chain' => 'setActiveChain',
            'activate_menu_item' => 'activateMenuItem',
            'breadcrumbs_set_active' => 'breadcrumbsSetActive',
            'breadcrumbs_set_parent' => 'breadcrumbsSetParent',
            'delete_menu' => 'deleteMenu',
            'delete_menu_by_gid' => 'deleteMenuByGid',
            'get_breadcrumbs' => 'getBreadcrumbs',
            'delete_menu_item' => 'deleteMenuItem',
            'delete_menu_items' => 'deleteMenuItems',
            'export_langs' => 'exportLangs',
            'get_menu_active_items_list' => 'getMenuActiveItemsList',
            'get_menu_by_gid' => 'getMenuByGid',
            'get_menu_by_id' => 'getMenuById',
            'get_menu_item_by_gid' => 'getMenuItemByGid',
            'get_menu_item_by_id' => 'getMenuItemById',
            'get_menu_items_count' => 'getMenuItemsCount',
            'get_menu_items_list' => 'getMenuItemsList',
            'get_menus_count' => 'getMenusCount',
            'get_menus_list' => 'getMenusList',
            'resort_menu_items' => 'resortMenuItems',
            'save_menu' => 'saveMenu',
            'save_menu_item' => 'saveMenuItem',
            'set_menu_active_item' => 'setMenuActiveItem',
            'save_menu_item_lang' => 'saveMenuItemLang',
            'update_langs' => 'updateLangs',
            'validate_menu' => 'validateMenu',
            'validate_menu_item' => 'validateMenuItem',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
