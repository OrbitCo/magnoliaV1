<?php

declare(strict_types=1);

namespace Pg\modules\guided_setup\models;

/**
 * GuidedSetup module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

define("GUIDED_SETUP_MENU_TABLE", DB_PREFIX . "guided_setup_menu");
define("GUIDED_SETUP_PAGES_TABLE", DB_PREFIX . "guided_setup_pages");

/**
 * SecretGifts main model
 *
 * @package     PG_Dating
 * @subpackage  GuidedSetup
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class GuidedSetupModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    public const MODULE_GID = 'guided_setup';

    /**
     * GuidedSetup object properties
     *
     * @var array
     */
    protected $fields_pages = [
            'id',
            'guided_menu_id',
            'url',
            'sorter',
            'is_active',
            'is_configured',
            'is_new',
    ];

    /**
     * Guided Setup menu object properties
     *
     * @var array
     */
    protected $fields_menu = ['id', 'gid'];

    /**
     * Class constructor
     *
     * @return GuidedSetupModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(GUIDED_SETUP_MENU_TABLE);
        $this->ci->cache->registerService(GUIDED_SETUP_PAGES_TABLE);
    }

    /**
     * Get pages data
     *
     * @param array $params
     * @param boolean $format
     *
     * @return array
     */
    public function getPages($params = [], $format = true)
    {
        $this->ci->db->select();
        $this->ci->db->from(GUIDED_SETUP_PAGES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
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

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (isset($order_by) && is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields_all) || $field == 'fields') {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (isset($params['limit']) && $params['limit'] > 0) {
            $this->ci->db->limit($params['limit']);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            if ($format) {
                $results = $this->formatPages($results);
            }
        }

        return $results;
    }

    /**
     * Save page
     *
     * @param integer $page_id
     * @param array $data
     *
     * @return void
     */
    public function savePage($page_id, $data = [])
    {
        $this->ci->db->where('id', $page_id);
        $this->ci->db->update(GUIDED_SETUP_PAGES_TABLE, $data);
        $this->ci->cache->flush(GUIDED_SETUP_PAGES_TABLE);
    }

    /**
     * Format pages
     *
     * @param array $pages
     *
     * @return array
     */
    private function formatPages($pages)
    {
        $formatted = [];
        $this->ci->load->model('Menu_model');
        $lang_id = $this->ci->pg_language->current_lang_id;
        foreach ($pages as $key => $page) {
            $page_link = $this->formatLink($page['url']);
            if ($page_link) {
                $formatted[$key] = [
                    'name' => $page['name_' . $lang_id],
                    'description' => $page['name_description_' . $lang_id],
                    'page_id' => $page['id'],
                    'link' => $page_link,
                    'is_configured' => $page['is_configured'],
                    'is_new' => $page['is_new'],
                ];
            }
        }

        return $formatted;
    }

    private function formatLink($url)
    {
        if (strpos($url, 'http') !== false) {
            return $url;
        }
        $url_arr = explode('/', trim($url, '/'));
        $segments = $this->ci->router->_validate_request($url_arr);
        if ($this->ci->router->is_admin_class) {
            if ($this->ci->pg_module->is_module_installed($segments[0])) {
                switch ($segments[0]) {
                        case 'themes':
                            $active_settings = $this->ci->pg_theme->return_active_settings();
                            $scheme = $active_settings['user']['scheme_data'];
                            $url = str_replace(['[id_theme]', '[id_colorset]'], [$scheme['id_theme'], $scheme['id']], $url);

                            break;
                    }

                return site_url() . $url;
            }
            switch ($segments[0]) {
                        case 'tickets':
                            return site_url() . 'admin/contact_us/index';

                            break;
                    }
        }

    }

    public function getMenuByGid($gid = 'guided_pages')
    {
        $nameTable  = GUIDED_SETUP_MENU_TABLE;
        $result = $this->ci->cache->get(GUIDED_SETUP_MENU_TABLE, 'getMenuByGid_'.$gid, function () use ($gid, $nameTable) {
            $ci = &get_instance();
            $ci->db->select();
            $ci->db->from($nameTable);
            $ci->db->where('gid', $gid);

            return $ci->db->get()->result_array()[0];
        });

        return $result;
    }

    /**
     *  Callback languages add
     *
     *  @param integer $lang_id
     *
     *  @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields = [];
        $fields['name_' . $lang_id] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false];
        $this->ci->dbforge->add_column(GUIDED_SETUP_PAGES_TABLE, $fields);

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(GUIDED_SETUP_PAGES_TABLE);;
        }

        $fields = [];
        $fields['name_description_' . $lang_id] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false];
        $this->ci->dbforge->add_column(GUIDED_SETUP_PAGES_TABLE, $fields);

        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_description_' . $lang_id, 'name_description_' . $default_lang_id, false);
            $this->ci->db->update(GUIDED_SETUP_PAGES_TABLE);
        }
        $this->ci->cache->flush(GUIDED_SETUP_PAGES_TABLE);
    }

    /**
     *  Callback languages delete
     *
     *  @param integer $lang_id
     *
     *  @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(GUIDED_SETUP_PAGES_TABLE);
        $fields = ['name_' . $lang_id, 'name_description_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(GUIDED_SETUP_PAGES_TABLE, $field_name);
        }
        $this->ci->cache->flush(GUIDED_SETUP_PAGES_TABLE);
    }
}
