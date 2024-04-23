<?php

declare(strict_types=1);

namespace Pg\modules\content\models;

/**
 * Content module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('CONTENT_TABLE')) {
    define('CONTENT_TABLE', DB_PREFIX . 'content');
}

/**
 * Content main model
 *
 * @package     PG_Dating
 * @subpackage  Content
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ContentModel extends \Model
{
    /**
     * All properties of content object in data source
     *
     * @var array
     */
    public $fields_all = [
        "id",
        "lang_id",
        "parent_id",
        "gid",
        'img',
        "sorter",
        "status",
        "date_created",
        "date_modified",
        "id_seo_settings",
    ];

    /**
     * Listing properties of content object in data source
     *
     * @var array
     */
    public $fields_list = [
        'id',
        'lang_id',
        'parent_id',
        'gid',
        'img',
        'sorter',
        'status',
        'date_created',
        'date_modified',
    ];

    /**
     * Info page logo upload (GUID)
     *
     * @var string
     */
    public $upload_config_id = 'info-page-logo';

    /**
     * Data of active item by language
     *
     * @var integer
     */
    public $current_active_item_id = 0;

    /**
     * Buffer for generating tree
     *
     * @var array
     */
    public $temp_generate_raw_tree = [];

    /**
     * Buffer for generatin tree item
     *
     * @var array
     */
    public $temp_generate_raw_items = [];

    /**
     * Pages list
     *
     *
     *  @var array
     */
    private $pages_all = null;

    /**
     * Class constructor
     *
     * @return Content_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(CONTENT_TABLE);
    }

    /**
     * Return information pages as array
     *
     * @param integer $lang_id   language identifier
     * @param integer $parent_id parent page identifier
     * @param array   $params    filters data
     *
     * @return array
     */
    public function getPagesList($lang_id, $parent_id = 0, $params = [])
    {
        $fields_list = $this->fields_list;
        $fields_list[] = 'title_' . $lang_id;
        $fields_list[] = 'annotation_' . $lang_id;

        $this->ci->db->select(implode(", ", $fields_list));
        $this->ci->db->from(CONTENT_TABLE);

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

        $this->temp_generate_raw_items = $this->temp_generate_raw_tree = [];
        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            $results = $this->formatPages($results, [$lang_id]);

            $active_parent_id = [];
            foreach ($results as $r) {
                $r["active"] = $this->_is_active_item($r);
                if ($r["active"]) {
                    $active_parent_id[] = $r["parent_id"];
                }
                $this->temp_generate_raw_items[$r["id"]] = $r;
            }

            if (!empty($active_parent_id)) {
                $this->_set_active_chain($active_parent_id);
            }

            foreach ($this->temp_generate_raw_items as $r) {
                $this->temp_generate_raw_tree[$r["parent_id"]][] = $r;
            }

            $tree = $this->_generate_tree($parent_id);

            return $tree;
        }

        return [];
    }

    /**
     * Return active information pages as array
     *
     * @param integer $lang_id   language identifier
     * @param integer $parent_id parent page identifier
     * @param array   $params    filters data
     *
     * @return array
     */
    public function getActivePagesList($lang_id, $parent_id = 0, $params = [])
    {
        $params["where"]["status"] = 1;

        return $this->get_pages_list($lang_id, $parent_id, $params);
    }

    /**
     * Return number of information pages
     *
     * @param array $params filters data
     *
     * @return integer
     */
    public function getPagesCount($params = [])
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(CONTENT_TABLE);

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

    /**
     * Return number of active information pages
     *
     * @param array $params filters parameters
     *
     * @return integer
     */
    public function getActivePagesCount($params = [])
    {
        $params["where"]["status"] = 1;

        return $this->get_pages_count($params);
    }

    public function getAllPages()
    {
        if ($this->pages_all === null) {
            $fields = $this->fields_all;

            foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
                $fields[] = 'title_' . $lang_id;
                $fields[] = 'annotation_' . $lang_id;
                $fields[] = 'content_' . $lang_id;
            }

            $this->pages_all = $this->ci->cache->get(CONTENT_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(CONTENT_TABLE)
                    ->order_by('parent_id ASC')
                    ->order_by('sorter ASC')
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return [];
                }

                return $results_raw;
            });
        }

        return $this->pages_all;
    }

    /**
     * Return page object by identifier
     *
     * @param integer $page_id  page identifier
     * @param array   $lang_ids language identifiers
     *
     * @return array
     */
    public function getPageById($page_id, $lang_ids = null)
    {
        $pages_raw = $this->getAllPages();

        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        foreach ($pages_raw as $page_raw) {
            if ($page_raw['id'] == $page_id) {
                return $this->formatPage($page_raw, $lang_ids);
            }
        }

        return false;
    }

    /**
     * Return page object by GUID
     *
     * @param string  $gid     page GUID
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    public function getPageByGid($gid, $langs_id = null)
    {
        $pages_raw = $this->getAllPages();

        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        foreach ($pages_raw as $page_raw) {
            if ($page_raw['gid'] == $gid) {
                return $this->formatPage($page_raw, $lang_ids);
            }
        }

        return false;
    }

    /**
     * Return guids of pages as array
     *
     * @return array
     */
    public function getGidList()
    {
        $page_data = [];

        $result = $this->ci->cache->get(CONTENT_TABLE, 'list', function () {
            $ci = &get_instance();

            return $ci->db->select("gid")->from(CONTENT_TABLE)->get()->result_array();
        });

        foreach ($result as $row) {
            $page_data[] = $row['gid'];
        }

        return $page_data;
    }

    /**
     * Save page object to data source
     *
     * @param integer $page_id page identifier
     * @param array   $attrs   page data
     *
     * @return integer
     */
    public function savePage($page_id, $attrs)
    {
        if (!$page_id) {
            if (empty($attrs["date_created"])) {
                $attrs["date_created"] = $attrs["date_modified"] = date("Y-m-d H:i:s");
            }
            if (!isset($attrs["status"])) {
                $attrs["status"] = 1;
            }
            if (!isset($attrs["sorter"]) && isset($attrs["lang_id"])) {
                $sorter_params = [];
                $sorter_params["where"]["parent_id"] = isset($attrs["parent_id"]) ? $attrs["parent_id"] : 0;
                $attrs["sorter"] = $this->getPagesCount($sorter_params) + 1;
            }
            $this->ci->db->insert(CONTENT_TABLE, $attrs);
            $page_id = $this->ci->db->insert_id();
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $page_id);
            $this->ci->db->update(CONTENT_TABLE, $attrs);
        }

        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;

        return $page_id;
    }

    /**
     * Upload page logo to site
     *
     * @param integer $page_id   page identifier
     * @param string  $file_name file name
     *
     * @return void
     */
    public function uploadLogo($page_id, $file_name)
    {
        if (
            empty($file_name) || empty($page_id) || !isset($_FILES[$file_name]) ||
            !is_array($_FILES[$file_name]) || !is_uploaded_file($_FILES[$file_name]["tmp_name"])
        ) {
            return;
        }

        $is_uploads_install = $this->ci->pg_module->is_module_installed('uploads');
        if (!$is_uploads_install) {
            return;
        }

        $page_data = $this->get_page_by_id($page_id);

        $this->ci->load->model("Uploads_model");
        $img_return = $this->ci->Uploads_model->upload($this->upload_config_id, $page_data["prefix"], $file_name);
        if (!empty($img_return["errors"])) {
            return;
        }

        $img_data["img"] = $img_return["file"];
        $this->save_page($page_id, $img_data);
    }

    /**
     * Upload page logo from local file
     *
     * @param integer $page_id   page identifier
     * @param string  $file_path file path
     *
     * @return void
     */
    public function uploadLocalLogo($page_id, $file_path)
    {
        $is_uploads_install = $this->ci->pg_module->is_module_installed('uploads');
        if (!$is_uploads_install) {
            return;
        }

        $page_data = $this->get_page_by_id($page_id);

        $this->ci->load->model("Uploads_model");
        $img_return = $this->ci->Uploads_model->upload_exist($this->upload_config_id, $page_data["prefix"], $file_path);
        if (!empty($img_return["errors"])) {
            return;
        }

        $img_data["img"] = $img_return["file"];
        $this->save_page($page_id, $img_data);
    }

    /**
     * Validate page data
     *
     * @param integer $page_id page identifier
     * @param array   $data    page data
     *
     * @return array
     */
    public function validatePage($page_id, $data)
    {
        $return = ["errors" => [], "data" => []];
        $page_data = [];
        if ($page_id) {
            $lang_ids = array_keys($this->ci->pg_language->languages);
            $page_data = $this->getPageById($page_id, $lang_ids);
        }

        if (isset($data["lang_id"])) {
            $return["data"]["lang_id"] = $page_data['lang_id'] = intval($data["lang_id"]);
        } elseif (!$page_id) {
            $return["data"]["lang_id"] = $page_data['lang_id'] = $this->ci->pg_language->get_default_lang_id();
        }

        if (isset($data['title'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['title']);
            if ($langs === false) {
                $return["errors"]['title'] = l('error_content_title_invalid', 'content');
            } else {
                foreach ($langs as $id => $value) {
                    $return["data"]['title_' . $id] = $value;
                }
            }
        }
        if (!empty($data["gid"])) {
            $gid = !empty($data['gid']) ? $data['gid'] : $return["data"]['title_' . $this->ci->pg_language->current_lang_id];
            $gid_data = $this->ci->pg_language->createGUID($gid);
            if (!empty($gid_data['errors'])) {
                $return["errors"]["gid"] = $gid_data['errors'];
            }
            $params = ['where' => ['gid' => $gid_data['gid']]];
            if ($page_id) {
                $params['where']['id <>'] = $page_id;
            }
            $count = $this->getPagesCount($params);
            if ($count > 0) {
                $return["errors"]["gid"] = l('error_gid_already_exists', 'content');
            } else {
                $return["data"]["gid"] = $gid_data['gid'];
            }
        }

        if (isset($data['annotation'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['annotation']);
            if ($langs === false) {
                $return["errors"]['annotation'] = l('error_content_annotation_invalid', 'content');
            } else {
                foreach ($langs as $id => $value) {
                    $return["data"]['annotation_' . $id] = $value;
                }
            }
        }
        if (isset($data['content'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['content']);
            if ($langs === false) {
                $return["errors"]['content'] = l('error_content_content_invalid', 'content');
            } else {
                foreach ($langs as $id => $value) {
                    $return["data"]['content_' . $id] = $value;
                }
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

        if (isset($data["id_seo_settings"])) {
            $return["data"]["id_seo_settings"] = intval($data["id_seo_settings"]);
        }

        return $return;
    }

    /**
     * Validate page logo object for uploading to site
     *
     * @param string $file_name file name
     *
     * @return array
     */
    public function validateLogo($file_name)
    {
        $return = ['errors' => [], 'data' => []];

        if (
            empty($file_name) || !isset($_FILES[$file_name]) || !is_array($_FILES[$file_name]) ||
            !is_uploaded_file($_FILES[$file_name]["tmp_name"])
        ) {
            return $return;
        }

        $this->ci->load->model("Uploads_model");
        $img_return = $this->ci->Uploads_model->validate_upload($this->upload_config_id, $file_name);

        if (!empty($img_return["error"])) {
            $return["errors"][] = implode("<br>", $img_return["error"]);
        }

        return $return;
    }

    /**
     * Remove page object by identifier
     *
     * @param integer $page_id page identifier
     *
     * @return void
     */
    public function deletePage($page_id)
    {
        $page_data = $this->get_page_by_id($page_id);
        if (empty($page_data)) {
            return;
        }

        $this->ci->db->where('id', $page_id);
        $this->ci->db->delete(CONTENT_TABLE);
        $this->resort_pages($page_data["lang_id"], $page_data["parent_id"]);

        $data["parent_id"] = 0;
        $this->ci->db->where('parent_id', $page_id);
        $this->ci->db->update(CONTENT_TABLE, $data);

        if (!empty($page_data["img"]) && $this->ci->pg_module->is_module_installed('uploads')) {
            $page_data = $this->format_page($page_data);
            $this->ci->load->model("Uploads_model");
            $this->ci->Uploads_model->delete_upload($this->upload_config_id, $page_data["prefix"], $page_data["img"]);
        }

        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;
    }

    /**
     * Remove page logo
     *
     * @param integer $page_id page identifier
     *
     * @return void
     */
    public function deleteLogo($page_id)
    {
        $page_data = $this->get_page_by_id($page_id);

        if (empty($page_data["img"])) {
            return;
        }

        $is_uploads_install = $this->ci->pg_module->is_module_installed('uploads');
        if (!$is_uploads_install) {
            return;
        }

        $page_data = $this->format_page($page_data);
        $this->ci->load->model("Uploads_model");
        $this->ci->Uploads_model->delete_upload($this->upload_config_id, $page_data["prefix"], $page_data["img"]);
        $this->ci->cache->flush(CONTENT_TABLE);
    }

    /**
     * Activate/deactivate page object
     *
     * Available statuses: 1 - activate, 0 - deactivate
     *
     * @param integer $page_id page identifier
     * @param integer $status  page status
     *
     * @return void
     */
    public function activatePage($page_id, $status = 1)
    {
        $attrs["status"] = intval($status);
        $this->ci->db->where('id', $page_id);
        $this->ci->db->update(CONTENT_TABLE, $attrs);

        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;
    }

    /**
     * Resort pages order
     *
     * @param integer $lang_id   language identifier
     * @param integer $parent_id parent page identifier
     *
     * @return void
     */
    public function resortPages($lang_id, $parent_id = 0)
    {
        $results = $this->ci->db->select("id, sorter")
                            ->from(CONTENT_TABLE)
                            ->where("parent_id", $parent_id)
                            ->order_by('sorter ASC')
                            ->get()
                            ->result_array();
        if (!empty($results)) {
            $i = 1;
            foreach ($results as $r) {
                $data["sorter"] = $i;
                $this->ci->db->where('id', $r["id"]);
                $this->ci->db->update(CONTENT_TABLE, $data);
                ++$i;
            }
        }

        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;
    }

    /**
     * Make page as active
     *
     * @param integer $page_id page identifier
     *
     * @return boolean
     */
    public function setPageActive($page_id)
    {
        if (!is_numeric($page_id)) {
            $item = $this->get_page_by_id($page_id);
            $page_id = $item["id"];
        }
        if (!$page_id) {
            return false;
        }
        $this->current_active_item_id = $page_id;

    }

    ///// inner functions

    /**
     * Check page is active
     *
     * @param array $item page data
     *
     * @return boolean
     */
    public function isActiveItem($item)
    {
        if (!empty($this->current_active_item_id)) {
            if ($this->current_active_item_id == $item["id"]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate chain to active page object
     *
     * @param array $parent_ids parent page identifiers
     *
     * @return void
     */
    public function setActiveChain($parent_ids)
    {
        foreach ($parent_ids as $parent_id) {
            while ($parent_id > 0) {
                $this->temp_generate_raw_items[$parent_id]["in_chain"] = true;
                $parent_id = $this->temp_generate_raw_items[$parent_id]["parent_id"];
            }
        }
    }

    /**
     * Generate page tree
     *
     * @param integer $parent_id root page identifier
     *
     * @return array
     */
    public function generateTree($parent_id)
    {
        if (empty($this->temp_generate_raw_tree) || empty($this->temp_generate_raw_tree[$parent_id])) {
            return [];
        }

        $tree = [];
        foreach ($this->temp_generate_raw_tree[$parent_id] as $subitem) {
            if (isset($this->temp_generate_raw_tree[$subitem["id"]]) && !empty($this->temp_generate_raw_tree[$subitem["id"]])) {
                $subitem["sub"] = $this->_generate_tree($subitem["id"]);
            }
            $tree[] = $subitem;
        }

        return $tree;
    }

    ////// seo

    /**
     * Return seo settings of content module
     *
     * @param string  $method  method name
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        }
        $actions = ['index', 'view'];
        $return = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
        }

        return $return;
    }

    /**
     * Return seo settings of content module (internal)
     *
     * @param string  $method  method name
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    private function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == "index") {
            return [
                'templates'   => [],
                'url_vars'    => [],
                'url_postfix' => [],
                'optional'    => [],
            ];
        } elseif ($method == "view") {
            return [
                'templates' => ['title', 'gid'],
                'url_vars'  => [
                    'gid' => ['gid' => 'literal', 'id' => 'literal'],
                ],
                'url_postfix' => [],
                'optional'    => [
                    ['title' => 'literal'],
                ],
            ];
        }
    }

    /**
     * Transform seo value of request query
     *
     * @param string $var_name_from variable from name
     * @param string $var_name_to   variable to name
     * @param mixed  $value         parameter value
     *
     * @return mixed
     */
    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        $user_data = [];

        if ($var_name_from == $var_name_to) {
            return $value;
        }

        if ($var_name_from == "gid" && $var_name_to == "id") {
            $lang_id = $this->ci->pg_language->current_lang_id;
            $page_data = $this->get_page_by_gid($value);
            if (empty($page_data)) {
                show_404();
            }

            return $page_data["id"];
        }

        if ($var_name_from == "id" && $var_name_to == "gid") {
            $page_data = $this->get_page_by_id($value);
            if (empty($page_data)) {
                show_404();
            }

            return $page_data["gid"];
        }

        show_404();
    }

    /**
     * Return data for xml sitemap
     *
     * @return array
     */
    public function getSitemapXmlUrls($generate = true)
    {
        $this->ci->load->helper('seo');

        $lang_canonical = true;

        $is_seo_install = $this->ci->pg_module->is_module_installed('seo');
        if ($is_seo_install) {
            $lang_canonical = $this->ci->pg_module->get_module_config('seo', 'lang_canonical');
        }
        $languages = $this->ci->pg_language->languages;
        if ($lang_canonical) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_lang_code = $this->ci->pg_language->get_lang_code_by_id($default_lang_id);
            $langs[$default_lang_id] = $default_lang_code;
        } else {
            foreach ($languages as $lang_id => $lang_data) {
                $langs[$lang_id] = $lang_data['code'];
            }
        }

        $return = [];

        $user_settings = $this->ci->pg_seo->get_settings('user', 'content', 'index');
        if (!$user_settings['noindex']) {
            if ($generate === true) {
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($languages as $lang_id => $lang_data) {
                    if ($this->ci->pg_language->is_active($lang_id) === true) {
                        $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                        $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                        $return[] = [
                            "url"      => rewrite_link('content', 'index', [], false, $lang_code, $lang_canonical),
                            "priority" => $user_settings['priority'],
                            "page" => 'index',
                        ];
                    }
                }
            } else {
                $return[] = [
                        "url"      => rewrite_link('content', 'index', [], false, null, $lang_canonical),
                        "priority" => $user_settings['priority'],
                        "page" => 'index',
                    ];
            }
        }

        $user_settings = $this->ci->pg_seo->get_settings('user', 'content', 'view');
        if (!$user_settings['noindex']) {
            $fields_list = $this->fields_list;
            foreach ($languages as $lang_id => $lang_data) {
                $fields_list[] = 'title_' . $lang_id;
            }
            $this->ci->db->select(implode(", ", $fields_list))->from(CONTENT_TABLE)->where('status', '1');
            $results = $this->ci->db->get()->result_array();
            if ($generate === true) {
                $this->ci->pg_seo->set_lang_prefix('user');
                if (!empty($results) && is_array($results)) {
                    foreach ($results as $r) {
                        foreach ($languages as $lang_id => $lang_data) {
                            $r['title'] = $r['title_' . $lang_id];
                            $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                            $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                            $return[] = [
                                "url"      => rewrite_link('content', 'view', $r, false, $lang_code, $lang_canonical),
                                "priority" => $user_settings['priority'],
                                "page" => "view",
                            ];
                        }
                    }
                }
            } else {
                foreach ($results as $r) {
                    $return[] = [
                        "url"      => rewrite_link('content', 'view', $r, false, null, $lang_canonical),
                        "priority" => $user_settings['priority'],
                        "page" => "view",
                    ];
                }
            }
        }

        return $return;
    }

    /**
     * Return data for sitemap page
     *
     * @return array
     */
    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');

        $lang_id = $this->ci->pg_language->current_lang_id;
        $pages = $this->get_active_pages_list($lang_id, 0);
        $block = [];

        foreach ($pages as $page) {
            $sub = [];
            if (!empty($page["sub"])) {
                foreach ($page["sub"] as $sub_page) {
                    $sub[] = [
                        "name"      => $sub_page["title"],
                        "link"      => rewrite_link('content', 'view', $sub_page),
                        "clickable" => true,
                    ];
                }
            }
            $block[] = [
                "name"      => $page["title"],
                "link"      => rewrite_link('content', 'view', $page),
                "clickable" => true,
                "items"     => $sub,
            ];
        }

        return $block;
    }

    ////// banners callback method

    /**
     * Return available pages for banner replacements
     *
     * @return array
     */
    public function bannerAvailablePages()
    {
        $return[] = ["link" => "content/index", "name" => l('seo_tags_index_header', 'content')];
        $return[] = ["link" => "content/view", "name" => l('seo_tags_view_header', 'content')];

        return $return;
    }

    /**
     * Install content properties depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(CONTENT_TABLE, [
            'title_' . $lang_id => [
                'type' => 'varchar(255)',
                'null' => false
            ]
        ]);
        $this->ci->dbforge->add_column(CONTENT_TABLE, [
            'annotation_' . $lang_id => [
                'type' => 'text',
                'null' => false
            ]
        ]);
        $this->ci->dbforge->add_column(CONTENT_TABLE, [
            'content_' . $lang_id => [
                'type' => 'text',
                'null' => false
            ]
        ]);
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('title_' . $lang_id, 'title_' . $default_lang_id, false);
            $this->ci->db->set('annotation_' . $lang_id, 'annotation_' . $default_lang_id, false);
            $this->ci->db->set('content_' . $lang_id, 'content_' . $default_lang_id, false);
            $this->ci->db->update(CONTENT_TABLE);
        }
        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;
    }

    /**
     * Uninstall content properties depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(CONTENT_TABLE);
        $fields = ['title_' . $lang_id, 'annotation_' . $lang_id, 'content_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(CONTENT_TABLE, $field_name);
        }

        $this->ci->cache->flush(CONTENT_TABLE);

        $this->pages_all = null;
    }

    /**
     * Format info page data
     *
     * @param array $data      info page data
     * @param array $langs_ids languages identifier
     *
     * @return array
     */
    public function formatPage($data, $langs_ids = [])
    {
        $pages = $this->formatPages([$data], $langs_ids);

        return $pages[0];
    }

    /**
     * Format info pages data
     *
     * @param array $data info pages data
     *
     * @return array
     */
    public function formatPages($data, $langs_ids = [])
    {
        $is_uploads_install = $this->ci->pg_module->is_module_installed('uploads');
        if ($is_uploads_install) {
            $this->ci->load->model('Uploads_model');
        }

        if (empty($langs_ids)) {
            $langs_ids = [$this->ci->pg_language->current_lang_id];
        }

        foreach ($data as $key => $page) {
            if (!empty($page["id"])) {
                $page["prefix"] = $page["id"];
            }

            $lang_id = in_array($page['lang_id'], $langs_ids) ? $page['lang_id'] : current($langs_ids);
            $page['title'] = $page['title_' . $lang_id];
            $page['annotation'] = isset($page['annotation_' . $lang_id]) ? $page['annotation_' . $lang_id] : '';
            $page['content'] = isset($page['content_' . $lang_id]) ? $page['content_' . $lang_id] : '';

            if ($is_uploads_install) {
                if (!empty($page["img"])) {
                    $page["media"]["img"] = $this->ci->Uploads_model->format_upload(
                        $this->upload_config_id,
                        $page["prefix"],
                        $page["img"]
                    );
                }
            }

            $data[$key] = $page;
        }

        return $data;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'get_seo_settings' => 'getSeoSettings',
            'format_pages' => 'formatPages',
            'format_page' => 'formatPage',
            'delete_logo' => 'deleteLogo',
            'activate_page' => 'activatePage',
            '_set_active_chain' => 'setActiveChain',
            '_is_active_item' => 'isActiveItem',
            '_generate_tree' => 'generateTree',
            'get_active_pages_count' => 'getActivePagesCount',
            'get_active_pages_list' => 'getActivePagesList',
            'get_gid_list' => 'getGidList',
            'delete_page' => 'deletePage',
            'set_page_active' => 'setPageActive',
            'save_page' => 'savePage',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'get_page_by_gid' => 'getPageByGid',
            'get_page_by_id' => 'getPageById',
            'resort_pages' => 'resortPages',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'get_sitemap_urls' => 'getSitemapUrls',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_pages_list' => 'getPagesList',
            'get_pages_count' => 'getPagesCount',
            'upload_local_logo' => 'uploadLocalLogo',
            'upload_logo' => 'uploadLogo',
            'validate_logo' => 'validateLogo',
            'validate_page' => 'validatePage',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
