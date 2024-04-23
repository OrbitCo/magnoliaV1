<?php

declare(strict_types=1);

namespace Pg\modules\banners\models;

/**
 * Banners module
 *
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('TABLE_BANNERS_GROUPS')) {
    define('TABLE_BANNERS_GROUPS', DB_PREFIX . 'banners_groups');
}

if (!defined('TABLE_BANNERS_PAGES')) {
    define('TABLE_BANNERS_PAGES', DB_PREFIX . 'banners_pages');
}

if (!defined('TABLE_BANNERS_MODULES')) {
    define('TABLE_BANNERS_MODULES', DB_PREFIX . 'banners_modules');
}

if (!defined('TABLE_BANNERS_PLACE_GROUP')) {
    define('TABLE_BANNERS_PLACE_GROUP', DB_PREFIX . 'banners_place_group');
}

if (!defined('TABLE_BANNERS_BANNER_GROUP')) {
    define('TABLE_BANNERS_BANNER_GROUP', DB_PREFIX . 'banners_banner_group');
}

/**
 * Banners groups model
 *
 * @package     PG_RealEstate
 * @subpackage  Banners
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Real Estate - php real estate listing software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BannerGroupModel extends \Model
{
    /**
     * Properties of banner group object in data source
     *
     * @var array
     */
    protected $group_fields = [
        'id',
        'date_created',
        'date_modified',
        'price',
        'gid',
        'name',
    ];

    /**
     * Identifiers cache of banners' groups by page url
     *
     * @var array
     */
    protected $group_get_cache = [];

    /**
     * Objects cache of banners groups by page url
     *
     * @var array
     */
    protected $group_search_cache = [];

    /**
     * Groups list
     *
     * @var array
     */
    private $groups_all = null;

    /**
     * Pages list
     *
     * @var array
     */
    private $pages_all = null;

    /**
     * Class constructor
     *
     * @return Banner_group_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(TABLE_BANNERS_GROUPS);
        $this->ci->cache->registerService(TABLE_BANNERS_PAGES);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(TABLE_BANNERS_MODULES);
        $this->ci->cache->registerService(TABLE_BANNERS_PLACE_GROUP);
        $this->ci->cache->registerService(TABLE_BANNERS_BANNER_GROUP);
    }

    /**
     * Return all banners groups as array
     *
     * @return array
     */
    public function getAllGroups()
    {
        if ($this->groups_all === null) {
            $fields = $this->group_fields;

            $this->groups_all = $this->ci->cache->get(TABLE_BANNERS_GROUPS, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(TABLE_BANNERS_GROUPS)
                    ->order_by("gid ASC")
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        return $this->groups_all;
    }

    /**
     * Return all banners groups as associated array (identifier as key)
     *
     * @return array
     */
    public function getAllGroupsKeyId()
    {
        $groups_raw = $this->getAllGroups();

        if (empty($groups_raw)) {
            return [];
        }

        $results = $this->formatGroup($groups_raw);

        $sort_results = [];

        foreach ($results as $result) {
            $sort_results[$result["id"]] = $result;
        }

        return $sort_results;
    }

    /**
     * Return banners groups by identifiers as array
     *
     * @param array $ids banner group identifiers
     *
     * @return array
     */
    public function getGroups($ids)
    {
        $groups_raw = $this->getAllGroups();

        if (empty($groups_raw)) {
            return [];
        }

        if (!empty($ids)) {
            foreach ($groups_raw as $index => $group_raw) {
                if (!in_array($group_raw['id'], $ids)) {
                    unset($groups_raw[$index]);
                }
            }
        }

        return $this->formatGroup($groups_raw);
    }

    /**
     * Validate banner group object for saving to data source
     *
     * @param integer $group_id group identifier
     * @param array   $data     group data
     * @param array   $langs    languages data
     *
     * @return array
     */
    public function validateGroup($id, $data, $langs = null)
    {
        $return = ["errors" => [], "data" => [], 'langs' => []];

        if (isset($data["name"])) {
            $return["data"]["name"] = trim(strip_tags($data["name"]));
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_group_name_empty', 'banners');
            } else {
                if (!empty($langs)) {
                    foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                        if (!isset($langs[$lid])) {
                            $return['errors'][] = l('error_group_name_empty', "banners");

                            break;
                        }
                        $return["langs"][$lid] = trim(strip_tags($langs[$lid]));
                        if (empty($return["langs"][$lid])) {
                            $return['errors'][] = l('error_group_name_empty', "banners");

                            break;
                        }
                    }
                }
            }
        } elseif (!empty($langs)) {
            $default_lang_id = $this->ci->pg_language->current_lang_id;
            if (!isset($langs[$default_lang_id])) {
                $return['errors'][] = l('error_group_name_empty', "banners");
            } else {
                $return["langs"][$default_lang_id] = trim(strip_tags($langs[$default_lang_id]));
                if (empty($return["langs"][$default_lang_id])) {
                    $return['errors'][] = l('error_group_name_empty', "banners");
                } else {
                    foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                        if ($lid == $default_lang_id) {
                            continue;
                        }
                        if (!isset($langs[$lid])) {
                            $return["langs"][$lid] = $return["langs"][$default_lang_id];
                        } else {
                            $return["langs"][$lid] = trim(strip_tags($langs[$lid]));
                            if (empty($return["langs"][$lid])) {
                                $return["langs"][$lid] = $return["langs"][$default_lang_id];
                            }
                        }
                    }
                }
            }
        }

        if (!empty($data["gid"])) {
            $gid = !empty($data['gid']) ? $data['gid'] : $return["data"]['name'];
            $gid_data = $this->ci->pg_language->createGUID($gid);
            if (!empty($gid_data['errors'])) {
                $return["errors"]["gid"] = $gid_data['errors'];
            }
            if ($this->getGroupIdByGid($gid_data['gid'])) {
                $return["errors"][] = l('error_group_name_exists', 'banners');
            } else {
                $return["data"]["gid"] = $gid_data['gid'];
            }
        }

        if (isset($data["price"])) {
            $return["data"]["price"] = floatval($data["price"]);
            if (empty($return["data"]["price"]) || $return["data"]["price"] < 0) {
                $return["errors"][] = l('error_group_price_empty', 'banners');
            }
        }

        return $return;
    }

    /**
     * Format banner group object
     *
     * @param $data group data
     *
     * @return array
     */
    public function formatGroup($data)
    {
        foreach ($data as $k => $group) {
            if (isset($group["gid"])) {
                $data[$k]["name"] = l('banners_group_' . $group["gid"], 'banners');
            }
        }

        return $data;
    }

    /**
     * Save group object to data source
     *
     * @param integer $group_id group identifier
     * @param array   $data     group data
     * @param array   $name     name values
     *
     * @return integer
     */
    public function save($id, $attrs, $name = null)
    {
        $id = (is_numeric($id) and $id > 0) ? intval($id) : 0;

        //// unset all unused fields
        foreach ($attrs as $field => $value) {
            if (!in_array($field, $this->group_fields)) {
                unset($attrs[$field]);
            }
        }

        ////save
        if (!empty($id)) {
            $attrs["date_modified"] = date('Y-m-d H:i:s');
            $this->ci->db->where('id', $id);
            $this->ci->db->update(TABLE_BANNERS_GROUPS, $attrs);
        } else {
            $attrs["date_created"] = date('Y-m-d H:i:s');
            $attrs["date_modified"] = date('Y-m-d H:i:s');
            $this->ci->db->insert(TABLE_BANNERS_GROUPS, $attrs);
            $id = $this->ci->db->insert_id();
        }
        if (!empty($name)) {
            $languages = $this->ci->pg_language->languages;
            if (!empty($languages)) {
                $lang_ids = array_keys($languages);
                $this->ci->pg_language->pages->set_string_langs('banners', "banners_group_" . $attrs['gid'], $name, $lang_ids);
            }
        }

        return $id;
    }

    /**
     * Remove banner group object by identifier
     *
     * @param integer $group_id group identifier
     *
     * @return void
     */
    public function delete($id = null)
    {
        $id = (is_numeric($id) && $id > 0) ? intval($id) : 0;
        if ($id == 0) {
            return;
        }

        $this->ci->db->where('id', $id);
        $this->ci->db->delete(TABLE_BANNERS_GROUPS);

        $this->ci->db->where('group_id', $id);
        $this->ci->db->delete(TABLE_BANNERS_PLACE_GROUP);

        $this->ci->db->where('group_id', $id);
        $this->ci->db->delete(TABLE_BANNERS_BANNER_GROUP);

        $this->delete_all_pages($id);

        // TODO: cache
        $this->ci->cache->flush(TABLE_BANNERS_GROUPS);

        $this->groups_all = null;
    }

    /**
     * Return banner group object by identifier
     *
     * @param integer $group_id group identifier
     *
     * @return array
     */
    public function getGroup($group_id)
    {
        $groups_raw = $this->getAllGroups();

        if (empty($groups_raw)) {
            return false;
        }

        foreach ($groups_raw as $group_raw) {
            if ($group_raw['id'] == $group_id) {
                $groups = $this->formatGroup([$group_raw]);

                return $groups[0];
            }
        }

        return false;
    }

    /**
     * Return banner group object by GUID
     *
     * @param string $gid banner group GUID
     *
     * @return array
     */
    public function getGroupIdByGid($gid)
    {
        $groups_raw = $this->getAllGroups();

        if (empty($groups_raw)) {
            return false;
        }

        foreach ($groups_raw as $group_raw) {
            if ($group_raw['gid'] == $gid) {
                return $group_raw['id'];
            }
        }

        return false;
    }

    /**
     * Return available pages for banner group
     *
     * @param integer $group_id group identifier
     *
     * @return array
     */
    public function getGroupPages($group_id)
    {
        $group_id = (is_numeric($group_id) and $group_id > 0) ? intval($group_id) : 0;
        $objects = false;

        if ($group_id) {
            $this->ci->db->select('id, name, link')->from(TABLE_BANNERS_PAGES)->where('group_id', $group_id);
            $results = $this->ci->db->get()->result();
            if (!empty($results) && is_array($results)) {
                foreach ($results as $result) {
                    $objects[] = get_object_vars($result);
                }
            }
        }

        return $objects;
    }

    /**
     * Return banner group identifier by page url
     *
     * @param string $link url of page
     *
     * @return integer
     */
    public function getGroupIdByPageLink($link)
    {
        if (!isset($this->group_get_cache[$link])) {
            $results = $this->getAllPages();
            if (!empty($results)) {
                foreach ($results as $result) {
                    if (strpos($link, $result['link']) !== false) {
                        //if ($result['link'] == $link) {
                        $this->group_get_cache[$link] = $result['group_id'];

                        return $this->group_get_cache[$link];
                    }
                }
                $this->group_get_cache[$link] = false;
            } else {
                $this->group_get_cache[$link] = false;
            }
        }

        return $this->group_get_cache[$link];
    }

    /**
     * Return banners groups data by page url
     *
     * @param string $link url of page
     *
     * @return array
     */
    public function searchGroupsIdByPageLink($link)
    {
        $link = addslashes($this->ci->input->xss_clean($link));
        if (!isset($this->group_search_cache[$link])) {
            $results = $this->ci->db->query("SELECT id, link, group_id FROM " . TABLE_BANNERS_PAGES . " WHERE \"" . $link . "\" LIKE CONCAT( link,  '%' ) AND link!='" . addslashes($link) . "' ORDER BY link DESC")->result();
            if (!empty($results) && is_array($results)) {
                foreach ($results as $result) {
                    $objects[] = $result->group_id;
                }
                $this->group_search_cache[$link] = $objects;
            } else {
                $this->group_search_cache[$link] = false;
            }
        }

        return $this->group_search_cache[$link];
    }

    /**
     * Return modules' list of used banners
     *
     * @return array
     */
    public function getUsedModules()
    {
        $objects = [];

        $this->ci->db->select('id, module_name, model_name, method_name')->from(TABLE_BANNERS_MODULES)->order_by("module_name ASC");
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $objects[] = $result;
            }
        }

        return $objects;
    }

    /**
     * Add module to list of used banners
     *
     * @param string $module_name module name
     * @param string $model_name  model name
     * @param strign $method_name method name
     *
     * @return void
     */
    public function setModule($module_name, $model_name, $method_name)
    {
        $attrs = [
            "module_name" => $module_name,
            "model_name"  => $model_name,
            "method_name" => $method_name,
        ];
        $this->ci->db->insert(TABLE_BANNERS_MODULES, $attrs);
    }

    /**
     * Remove module from list of used banners
     *
     * @param string $module_name module name
     *
     * @return void
     */
    public function deleteModule($module_name)
    {
        $this->ci->db->where("module_name", $module_name);
        $this->ci->db->delete(TABLE_BANNERS_MODULES);
    }

    /**
     * Return used module data by module identifier
     *
     * @param $module_id module identifier
     *
     * @return array
     */
    public function getUsedModule($module_id)
    {
        $object = [];

        $this->ci->db->select('id, module_name, model_name, method_name');
        $this->ci->db->from(TABLE_BANNERS_MODULES);
        $this->ci->db->where("id", $module_id);

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $object = $results[0];
        }

        return $object;
    }

    private function getAllPages()
    {
        if ($this->pages_all === null) {
            $fields = ['group_id', 'link'];

            $this->pages_all = $this->ci->cache->get(TABLE_BANNERS_PAGES, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(TABLE_BANNERS_PAGES)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        return $this->pages_all;
    }

    /**
     * Return module pages of used banners as array
     *
     * @param integer $module_id module identifier
     *
     * @return array
     */
    public function getModulePages($module_id)
    {
        $module_data = $this->get_used_module($module_id);
        if (empty($module_data)) {
            return false;
        }

        $model_name = ucfirst($module_data["model_name"]);
        $model_path = strtolower($module_data["module_name"] . "/models/") . $model_name;
        $this->ci->load->model($model_path);
        $links = $this->ci->{$model_name}->{$module_data["method_name"]}();

        if (empty($links) || !is_array($links) || count($links) == 0) {
            return $links;
        }

        $link_search = [];

        foreach ($links as $link_data) {
            $link_search[] = $link_data["link"];
        }

        $results = $this->getAllPages();

        if (!empty($results)) {
            return $links;
        }

        $page_links = [];

        foreach ($results as $index => $result) {
            if (in_array($result['link'], $link_search)) {
                $pages_links[$result['link']] = $result['group_id'];
            } else {
                unset($results[$index]);
            }
        }

        if (!empty($pages_links)) {
            $groups = $this->getAllGroupsKeyId();
            foreach ($links as $k => $link) {
                if (!empty($pages_links[$link["link"]]) && !empty($pages_links[$link["link"]]["group_id"])) {
                    $links[$k]["group_id"] = $group_id = $pages_links[$link["link"]]["group_id"];
                    $links[$k]["group_name"] = $groups[$group_id]["name"];
                }
            }
        }

        return $links;
    }

    /**
     * Add page to banner group
     *
     * @param array $attrs page data
     *
     * @return void
     */
    public function addPage($attrs)
    {
        $insert["group_id"] = intval($attrs["group_id"]);
        $insert["name"] = $attrs["name"];
        $insert["link"] = $attrs["link"];

        if (!$insert["group_id"] || !$insert["link"]) {
            return;
        }

        $insert["date_created"] = date('Y-m-d H:i:s');
        $insert["date_modified"] = date('Y-m-d H:i:s');

        $this->ci->db->insert(TABLE_BANNERS_PAGES, $insert);
    }

    /**
     * Remove page from banners group
     *
     * @param integer $group_id group identifier
     * @param string  $link     page url
     *
     * @return void
     */
    public function deletePage($group_id, $link)
    {
        $this->ci->db->where("group_id", $group_id);
        $this->ci->db->where("link", $link);
        $this->ci->db->delete(TABLE_BANNERS_PAGES);

        // TODO: cache
        $this->ci->cache->flush(TABLE_BANNERS_PAGES);

        $this->pages_all = null;
    }

    /**
     * Remove all pages from banners group
     *
     * @param integer $group_id group identifier
     *
     * @return void
     */
    public function deleteAllPages($group_id)
    {
        $this->ci->db->where("group_id", $group_id);
        $this->ci->db->delete(TABLE_BANNERS_PAGES);

        // TODO: cache
        $this->ci->cache->flush(TABLE_BANNERS_PAGES);

        $this->pages_all = null;
    }

    /**
     * Return number of filled positions in banner groups
     *
     * @param array   $group_ids         group identifiers
     * @param integer $place_id          place identifier
     * @param integer $exclude_banner_id exclude banner identifier
     *
     * @return array
     */
    public function getFillPositions($group_ids, $place_id, $exclude_banner_id = 0)
    {
        $return = [];
        $this->ci->db->select('group_id, SUM(positions) AS sumall')->from(TABLE_BANNERS_BANNER_GROUP)
                 ->where_in('group_id', $group_ids)
                 ->where('place_id', $place_id);
        if ($exclude_banner_id) {
            $this->ci->db->where('banner_id !=', $exclude_banner_id);
        }
        $this->ci->db->group_by('group_id');
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $return[$r["group_id"]] = $r["sumall"];
            }
        }

        return $return;
    }

    /**
     * Create unique banner group
     *
     * @param array $attrs group data
     *
     * @return integer
     */
    public function createUniqueGroup($attrs = [])
    {
        $group_id = $this->getGroupIdByGid($attrs['gid']);
        if ($group_id) {
            return $group_id;
        }

        return $this->save(null, $attrs);
    }

    /**
     * Import languages of banners groups from extern modules
     *
     * @param array $banners_groups banners groups data
     * @param array $langs_file     languages labels from file
     * @param array $langs_ids      languages identifiers
     *
     * @return void
     */
    public function updateLangs($banners_groups, $langs_file, $langs_ids)
    {
        foreach ($banners_groups as $key => $value) {
            $this->ci->pg_language->pages->set_string_langs(
                'banners',
                $value,
                $langs_file[$value],
                (array) $langs_ids
            );
        }
    }

    /**
     * Prepare languages of banners groups for exporting
     *
     * @param array $banners_groups groups data
     * @param array $langs_ids      languages identifiers
     *
     * @return array
     */
    public function exportLangs($banners_groups, $langs_ids = null)
    {
        return $this->ci->pg_language->export_langs('banners', $banners_groups, $langs_ids);
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_page' => 'addPage',
            'create_unique_group' => 'createUniqueGroup',
            'delete_all_pages' => 'deleteAllPages',
            'delete_module' => 'deleteModule',
            'delete_page' => 'deletePage',
            'export_langs' => 'exportLangs',
            'format_group' => 'formatGroup',
            'get_all_groups' => 'getAllGroups',
            'get_all_groups_key_id' => 'getAllGroupsKeyId',
            'get_fill_positions' => 'getFillPositions',
            'get_group_id_by_gid' => 'getGroupIdByGid',
            'get_group_id_by_page_link' => 'getGroupIdByPageLink',
            'get_group_pages' => 'getGroupPages',
            'get_groups' => 'getGroups',
            'get_group' => 'getGroup',
            'get_module_pages' => 'getModulePages',
            'get_used_modules' => 'getUsedModules',
            'get_used_module' => 'getUsedModule',
            'search_groups_id_by_page_link' => 'searchGroupsIdByPageLink',
            'set_module' => 'setModule',
            'update_langs' => 'updateLangs',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
