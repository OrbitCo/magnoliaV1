<?php

declare(strict_types=1);

namespace Pg\modules\site_map\models;

define('SITEMAP_MODULES_TABLE', DB_PREFIX . 'sitemap_modules');

/**
 * Site map main model
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
class SiteMapModel extends \Model
{
    private $sitemap_module_cache = [];

    public function getSitemapModuleByGid($module_gid)
    {
        if (empty($this->sitemap_module_cache[$module_gid])) {
            $this->ci->db->select('id, module_gid, model_name, get_urls_method')->from(SITEMAP_MODULES_TABLE)->where("module_gid", $module_gid);
            $results = $this->ci->db->get()->result_array();
            if (!empty($results)) {
                $this->sitemap_module_cache[$module_gid] = $results[0];
            }
        }

        return (!empty($this->sitemap_module_cache[$module_gid])) ? $this->sitemap_module_cache[$module_gid] : false;
    }

    public function getSitemapModules()
    {
        $this->ci->db->select('id, module_gid, model_name, get_urls_method')->from(SITEMAP_MODULES_TABLE);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results)) {
            foreach ($results as $r) {
                $this->sitemap_module_cache[$r["module_gid"]] = $r;
            }
        }

        return $this->sitemap_module_cache;
    }

    public function setSitemapModule($module_gid, $data = [])
    {
        $module_data = $this->get_sitemap_module_by_gid($module_gid);
        if (empty($module_data)) {
            $this->ci->db->insert(SITEMAP_MODULES_TABLE, $data);
        } else {
            $this->ci->db->where("module_gid", $module_gid);
            $this->ci->db->update(SITEMAP_MODULES_TABLE, $data);
        }
    }

    public function deleteSitemapModule($module_gid)
    {
        $this->ci->db->where("module_gid", $module_gid);
        $this->ci->db->delete(SITEMAP_MODULES_TABLE);
    }

    public function getSitemapLinks()
    {
        $modules = $this->get_sitemap_modules();
        $blocks = [];

        foreach ($modules as $module) {
            $this->ci->load->model($module["module_gid"] . "/models/" . $module["model_name"]);
            $blocks[] = $this->ci->{$module["model_name"]}->{$module["get_urls_method"]}();
        }

        return $blocks;
    }

    ////// seo
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        } else {
            $actions = ['index'];
            $return = [];
            foreach ($actions as $action) {
                $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
            }

            return $return;
        }
    }

    public function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == "index") {
            return [
                "templates"   => [],
                "url_vars"    => [],
                'url_postfix' => [],
                'optional'    => [],
            ];
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }

        show_404();
    }

    public function getSitemapXmlUrls($generate = true)
    {
        $this->ci->load->helper('seo');
        $return = [];

        $lang_canonical = true;

        if ($this->ci->pg_module->is_module_installed('seo')) {
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

        $user_settings = $this->ci->pg_seo->get_settings('user', 'site_map', 'index');
        if (!$user_settings['noindex']) {
            if ($generate === true) {
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($languages as $lang_id => $lang_data) {
                    $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                    $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                    $return[] = [
                        "url"      => rewrite_link('site_map', 'index', [], false, $lang_code),
                        "priority" => $user_settings['priority'],
                        "page" => "view",
                    ];
                }
            } else {
                $return[] = [
                    "url"      => rewrite_link('site_map', 'index', [], false, null, $lang_canonical),
                    "priority" => $user_settings['priority'],
                    "page" => "view",
                ];
            }
        }

        return $return;
    }

    ////// banners callback method
    public function bannerAvailablePages()
    {
        $return[] = ["link" => "site_map/index", "name" => l('seo_tags_index_header', 'site_map')];

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'get_seo_settings' => 'getSeoSettings',
            'delete_sitemap_module' => 'deleteSitemapModule',
            'get_sitemap_links' => 'getSitemapLinks',
            'get_sitemap_module_by_gid' => 'getSitemapModuleByGid',
            'get_sitemap_modules' => 'getSitemapModules',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'set_sitemap_module' => 'setSitemapModule',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
