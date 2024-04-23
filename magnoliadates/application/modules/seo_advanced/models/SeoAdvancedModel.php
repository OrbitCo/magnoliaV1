<?php

declare(strict_types=1);

namespace Pg\modules\seo_advanced\models;

/**
 * Seo advanced module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Seo advanced model
 *
 * @package     PG_Core
 * @subpackage  Seo
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SeoAdvancedModel extends \Model
{
    /**
     * Meta fields
     *
     * @param array
     */
    private $_meta_fields = [
        ['name' => 'title', 'type' => 'text'],
        ['name' => 'keyword', 'type' => 'textarea'],
        ['name' => 'description', 'type' => 'textarea'],
        ['name' => 'header', 'type' => 'text'],
        ['name' => 'noindex', 'type' => 'checkbox'],
    ];

    /**
     * Open graph fields
     *
     * @param array
     */
    private $_og_fields = [
        ['name' => 'og_title', 'type' => 'text'],
        ['name' => 'og_type', 'type' => 'text'],
        ['name' => 'og_description', 'type' => 'textarea'],
    ];

    /**
     * Routes xml
     *
     * @var string
     */
    public $route_xml_file = "config/seo_module_routes.xml";

    /**
     * Routes php
     *
     * @var string
     */
    public $route_php_file = "config/seo_module_routes.php";

    /**
     * Load routes from xml file
     *
     * @return array
     */
    public function getXmlRouteFileContent()
    {
        if (!function_exists('simplexml_load_file')) {
            return [];
        }

        $file = APPPATH . $this->route_xml_file;
        $xml  = simplexml_load_file($file);
        if (!is_object($xml)) {
            return [];
        }
        $return = [];
        foreach ($xml as $module => $module_data) {
            $module_name = strval($module);
            foreach ($module_data->method as $key => $method) {
                $method_name                        = strval($method["name"]);
                $link                               = strval($method["link"]);
                $return[$module_name][$method_name] = $link;
            }
        }

        return $return;
    }

    /**
     * Save routes to xml file
     *
     * @param array $data routes data
     *
     * @return void
     */
    public function setXmlRouteFileContent($data)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
        $xml .= "<routes>\n";
        foreach ($data as $model => $model_data) {
            $xml .= "<" . $model . ">\n";
            foreach ($model_data as $method => $pattern) {
                if (!empty($pattern)) {
                    $xml .= '<method name="' . $method . '" link="' . $pattern . '" />' . "\n";
                }
            }
            $xml .= "</" . $model . ">\n";
        }
        $xml .= "</routes>\n";
        $file = APPPATH . $this->route_xml_file;
        $h    = fopen($file, "w");
        if ($h) {
            fwrite($h, $xml);
            fclose($h);
        }
    }

    /**
     * Save routes to php file
     *
     * @return void
     */
    public function rewriteRoutePhpFile()
    {
        $data = $this->get_xml_route_file_content();
        if (empty($data)) {
            return false;
        }

        $php = '<?php' . "\n\n";
        foreach ($data as $model => $model_data) {
            foreach ($model_data as $method => $pattern) {
                if (!empty($pattern)) {
                    $string = $this->ci->pg_seo->url_template_transform($model, $method, $pattern, 'xml', 'rule');
                    $php .= $string . "\n";
                }
            }
        }

        $file = APPPATH . $this->route_php_file;
        $h    = fopen($file, "w");
        if ($h) {
            fwrite($h, $php);
            fclose($h);
        }
    }

    /**
     * Validate tracker data for savaing to data source
     *
     * @param array $data tracker data
     *
     * @return array
     */
    public function validateTracker($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["seo_ga_default_activate"])) {
            $return["data"]["seo_ga_default_activate"] = intval($data["seo_ga_default_activate"]);
        }

        if (isset($data["seo_ga_default_account_id"]) && (boolean) $data["seo_ga_default_account_id"]) {
            $return["data"]["seo_ga_default_account_id"] = strip_tags($data["seo_ga_default_account_id"]);
        }

        if (isset($data["seo_ga_manual_activate"])) {
            $return["data"]["seo_ga_manual_activate"] = intval($data["seo_ga_manual_activate"]);
        }

        if (isset($data["seo_ga_manual_placement"])) {
            $return["data"]["seo_ga_manual_placement"] = strval($data["seo_ga_manual_placement"]);
        }

        if (isset($data["seo_ga_manual_tracker_code"]) && (boolean) $data["seo_ga_manual_tracker_code"]) {
            $return["data"]["seo_ga_manual_tracker_code"] = trim($data["seo_ga_manual_tracker_code"]);
        }

        if ($return["data"]["seo_ga_default_activate"] && empty($return["data"]["seo_ga_default_account_id"])) {
            $return["errors"][] = l('error_ga_account_id_empty', 'seo');
        }

        if ($return["data"]["seo_ga_manual_activate"] && empty($return["data"]["seo_ga_manual_tracker_code"])) {
            $return["errors"][] = l('error_tracker_code_empty', 'seo');
        }

        return $return;
    }

    /**
     * Return html code of tracker
     *
     * Available placement are top and bottom
     *
     * @param string $placement tracker placement
     *
     * @return string
     */
    public function getTrackerHtml($placement = 'top', $is_admin = false)
    {
        $output = false;

        if (!empty($_ENV['GA_KEY']) && $placement == 'top') {
            $this->ci->view->assign('ga_default_account_id', $_ENV['GA_KEY']);
            $output = true;
        }

        if (!$is_admin) {
            $ga_default_activate = $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_default_activate');
            if ($ga_default_activate && $placement == 'top') {
                $this->ci->view->assign('ga_default_account_id',
                    $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_default_account_id'));
                $output = true;
            }

            $manual_activate = $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_manual_activate');
            if ($manual_activate) {
                $manual_placement = $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_manual_placement');
                if ($manual_placement == $placement) {
                    $this->ci->view->assign('tracker_code',
                        $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_manual_tracker_code'));
                    $output = true;
                }
            }
        }

        return ($output) ? $this->ci->view->fetch('tracker_block', 'user', 'seo_advanced') : "";
    }

    /**
     * Return robots content
     *
     * @return array
     */
    public function getRobotsContent()
    {
        $return = ["errors" => [], "data" => ''];
        $file   = SITE_PHYSICAL_PATH . 'robots.txt';
        $error  = false;

        if (!file_exists($file)) {
            $return['errors'][] = l('error_robots_txt_not_exist', 'seo');
            $error              = true;
        }

        // check writable
        if (!is_writable($file)) {
            $return['errors'][] = l('error_robots_txt_not_writable', 'seo');
            $error              = true;
        }

        // create handler
        if (!$error) {
            $fp = fopen($file, 'r');
            if (filesize($file) > 0) {
                $return["data"] = trim(fread($fp, filesize($file)));
            }
            fclose($fp);
        }

        return $return;
    }

    /**
     * Save robots content
     *
     * @param string $content content text
     *
     * @return array
     */
    public function setRobotsContent($content)
    {
        $return = ["errors" => []];
        $file   = SITE_PHYSICAL_PATH . 'robots.txt';
        $error  = false;

        if (!file_exists($file)) {
            $return['errors'][] = l('error_robots_txt_not_exist', 'seo');
            $error              = true;
        }

        // check writable
        if (!is_writable($file)) {
            $return['errors'][] = l('error_robots_txt_not_writable', 'seo');
            $error              = true;
        }

        if (!$error) {
            $fp     = fopen($file, 'w+');
            $result = (bool) fwrite($fp, $content);
            fclose($fp);

            if (!empty($content) && !$result) {
                $return['errors'][] = l('error_robots_txt_error_save', 'seo');
            }
        }

        return $return;
    }

    /**
     * Return sitemap data
     *
     * @return array
     */
    public function getSitemapData()
    {
        $return = ["errors" => [], "data" => []];
        $file   = SITE_PHYSICAL_PATH . 'sitemap.xml';
        $error  = false;

        if (!file_exists($file)) {
            $return['errors'][] = l('error_sitemap_xml_not_exist', 'seo');
            $error              = true;
        }

        // check writable
        if (!is_writable($file)) {
            $return['errors'][] = l('error_sitemap_xml_not_writable', 'seo');
            $error              = true;
        }

        // create handler
        if (!$error) {
            $data                    = stat($file);
            $return["data"]["mtime"] = $data["mtime"];
        }

        return $return;
    }

    /**
     * Generate sitemap xml
     *
     * @param array $params sitemap settings
     *
     * @return array
     */
    public function generateSitemapXml($params)
    {
        $return = ["errors" => [], "data" => ''];

        $page_limit = 50000;

        $sitemap_data = $this->getSitemapData();

        if (!empty($sitemap_data["errors"])) {
            $return["errors"] = $sitemap_data["errors"];

            return $return;
        }

        if (strtotime($params['lastmod_date']) <= 0) {
            $params['lastmod_date'] = date('Y-m-d H:i:s');
        }
        $params["lastmod_date"] = date('c', strtotime($params["lastmod_date"]));
        $this->clearSitemapXml();

        $search  = ['&', "'", '"', '>', '<'];
        $replace = ['&amp;', '&apos;', '&quot;', '&gt;', '&lt;'];

        $file = SITE_PHYSICAL_PATH . 'sitemap.xml';
        $fp   = fopen($file, 'w');

        $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
        $output .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
        fwrite($fp, $output);

        $modules = $this->ci->pg_seo->get_seo_modules();

        $this->ci->load->helper('seo');

        $default_lang_id   = $this->ci->pg_language->get_default_lang_id();
        $default_lang_code = $this->ci->pg_language->get_lang_code_by_id($default_lang_id);

        $page_count = 0;

        $output = "\t<url>\r\n";
        $output .= "\t\t<loc>" . str_replace($search,
            $replace,
                rewrite_link('', '', [], false, $default_lang_code, true)) . "</loc>\r\n";

        if ($params["lastmod"] == 1) {
            $output .= "\t\t<lastmod>" . str_replace($search, $replace, date('c')) . "</lastmod>\r\n";
        } elseif ($params["lastmod"] == 2) {
            $output .= "\t\t<lastmod>" . str_replace($search, $replace, $params["lastmod_date"]) . "</lastmod>\r\n";
        }

        $output .= "\t\t<priority>1</priority>\r\n";

        if ($params["changefreq"]) {
            $output .= "\t\t<changefreq>" . str_replace($search, $replace, $params["changefreq"]) . "</changefreq>\r\n";
        }

        $output .= "\t</url>\r\n";
        fwrite($fp, $output);

        ++$page_count;
        $is_lang_code = (bool) $this->ci->pg_seo->get_settings('user')['lang_in_url'];
        foreach ($modules as $module) {
            if (!empty($module["get_sitemap_urls_method"])) {
                $this->ci->load->model($module["module_gid"] . "/models/" . $module["model_name"]);
                $urls = $this->ci->{$module["model_name"]}->{$module["get_sitemap_urls_method"]}($is_lang_code, true);
                if (!empty($urls)) {
                    $current_date = date('c');
                    foreach ($urls as $key => $url_data) {
                        if ($this->isAccess($url_data["url"]) === true) {
                            if ($page_count % $page_limit == 0) {
                                if ($page_count == $page_limit) {
                                    $file   = SITE_PHYSICAL_PATH . 'sitemap_index.xml';
                                    $fpi    = fopen($file, 'w');
                                    $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
                                    $output .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
                                    $output .= "\t<sitemap>\r\n";
                                    $output .= "\t\t<loc>" . SITE_VIRTUAL_PATH . 'sitemap.xml' . "</loc>\r\n";
                                    $output .= "\t\t<lastmod>" . str_replace($search, $replace, date('c')) . "</lastmod>\r\n";
                                    $output .= "\t</sitemap>\r\n";
                                    fwrite($fpi, $output);
                                }

                                $output = "\t<sitemap>\r\n";
                                $output .= "\t\t<loc>" . SITE_VIRTUAL_PATH . 'sitemap' . (intval($page_count / $page_limit) + 1) . '.xml' . "</loc>\r\n";
                                $output .= "\t\t<lastmod>" . str_replace($search, $replace, date('c')) . "</lastmod>\r\n";
                                $output .= "\t</sitemap>\r\n";
                                fwrite($fpi, $output);

                                $file   = SITE_PHYSICAL_PATH . 'sitemap' . (intval($page_count / $page_limit) + 1) . '.xml';
                                $fp     = fopen($file, 'a+');
                                $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
                                $output .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
                                fwrite($fp, $output);
                            }

                            $output = "\t<url>\r\n";
                            $output .= "\t\t<loc>" . str_replace($search, $replace, $url_data["url"]) . "</loc>\r\n";

                            if ($params["lastmod"] == 1) {
                                $output .= "\t\t<lastmod>" . str_replace($search, $replace, $current_date) . "</lastmod>\r\n";
                            } elseif ($params["lastmod"] == 2) {
                                $output .= "\t\t<lastmod>" . str_replace($search, $replace, $params["lastmod_date"]) . "</lastmod>\r\n";
                            }

                            if ($params["priority"] && $url_data["priority"]) {
                                $output .= "\t\t<priority>" . str_replace($search, $replace, $url_data["priority"]) . "</priority>\r\n";
                            } else {
                                if (!empty($params["priorities"]) && !empty($url_data['page'])) {
                                    $priority_data = ['priority' => $params["priorities"][$module['module_gid']][$url_data['page']]];
                                    $this->ci->pg_seo->set_settings('user',
                                        $module['module_gid'],
                                        $url_data['page'],
                                        $priority_data);
                                    $output .= "\t\t<priority>" . $params["priorities"][$module['module_gid']][$url_data['page']] . "</priority>\r\n";
                                } else {
                                    $output .= "\t\t<priority>" . $url_data['priority'] . "</priority>\r\n";
                                }
                            }

                            if ($params["changefreq"]) {
                                $output .= "\t\t<changefreq>" . str_replace($search, $replace, $params["changefreq"]) . "</changefreq>\r\n";
                            }

                            $output .= "\t</url>\r\n";
                            fwrite($fp, $output);
                            ++$page_count;

                            if ($page_count % $page_limit == 0) {
                                $output = "</urlset>";
                                fwrite($fp, $output);
                                fclose($fp);
                            }
                        }
                    }
                }
            }
        }

        if ($page_count % $page_limit != 0) {
            $output = "</urlset>";
            fwrite($fp, $output);
        }

        if ($page_count > $page_limit) {
            $output = "</sitemapindex>";
            fwrite($fpi, $output);
            fclose($fpi);
        }

        fclose($fp);

        return $return;
    }
    
    private function isAccess($url)
    {
        $segments = $this->getUriSegmentsFromString($url);

        $module = $segments[0];
        $action = $segments[1];

        $errors = [];
        if (empty($module)) {
            $errors[] = 'Empty module';
            if (empty($action)) {
                $errors[] = 'Empty action';
            }
        }
        $allowed = false;
        if (empty($errors)) {
            $this->ci->acl->getManager()->setRole('guest');
            $allowed = $this->ci->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => $module, 'controller' => $module, 'action' => $action,]
                )), false);
        }
        return $allowed;
    }

    /**
     * Get uri segments from string
     *
     * @param string $uri
     *
     * @return array
     */
    private function getUriSegmentsFromString($url)
    {
        $segments = [];

        $uri = str_replace(site_url(), '', $url);

        if (empty($uri)) {
            return $segments;
        }

        global $route;
        $routes = (!isset($route) or !is_array($route)) ? [] : $route;
        unset($route);

        foreach ($routes as $key => $val) {
            $key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));
            if (preg_match('#^' . trim($key, '/') . '$#iu', $uri)) {
                if (strpos($val, '$') !== false and strpos($key, '(') !== false) {
                    $val = preg_replace('#^' . trim($key, '/') . '$#iu', $val, $uri);
                }
                
                $segments = explode('/', $val);
            }
        }

        if (empty($segments)) {
            $segments = explode('/', $uri);
        }

        return $segments;
    }

    /**
     * Generate sitemap xml by cron
     *
     * @return void
     */
    public function generateSitemapXmlCron()
    {
        $params                 = [];
        $params['changefreq']   = $this->ci->pg_module->get_module_config('seo', 'sitemap_sitemap_changefreq');
        $params['lastmod']      = $this->ci->pg_module->get_module_config('seo', 'sitemap_lastmod');
        $params['lastmod_date'] = date('Y-m-d H:i:s');
        $params['priority']     = $this->ci->pg_module->get_module_config('seo', 'sitemap_priority');
        $this->generateSitemapXml($params);
    }

    /**
     * Clear sitemap xml
     *
     * Remove content from sitemap xml.
     *
     * @return void
     */
    public function clearSitemapXml()
    {
        $file   = SITE_PHYSICAL_PATH . 'sitemap.xml';
        $fp     = fopen($file, 'w');
        $result = (bool) fwrite($fp, '');
        fclose($fp);
    }

    /**
     * Add routes fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        $this->update_route_langs();
    }

    /**
     * Remove routes fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        $this->update_route_langs();
    }

    /**
     * Update or create file config/langs_route.php
     *
     * @return boolean
     */
    private function updateRouteLangs()
    {
        $langs = $this->ci->pg_language->get_langs();
        if (0 == count($langs)) {
            return false;
        }
        foreach ($langs as $lang) {
            $content_langs[] = "'" . $lang['code'] . "'";
        }

        $file_content = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";
        $file_content .= "\$config['langs_route'] = array(";
        $file_content .= implode(", ", $content_langs);
        $file_content .= ');';

        $file = APPPATH . 'config/langs_route' . EXT;
        try {
            $handle = fopen($file, 'w');
            fwrite($handle, $file_content);
            fclose($handle);
        } catch (Exception $e) {
            log_message('error',
                'Error while updating langs_route' . EXT . '(' . $e->getMessage() . ') in ' . $e->getFile());
            throw $e;
        }

        return true;
    }

    /**
     * Return seo fields by sections
     *
     * @return array
     */
    public function getSeoFields()
    {
        $seo_data = [];

        $fields_data = [];

        foreach ($this->_meta_fields as $field_data) {
            $fields_data[] = [
                'gid' => $field_data['name'],
                'name' => l('field_' . $field_data['name'], 'seo'),
                'type' => $field_data['type'],
                'tooltip' => l('text_help_' . $field_data['name'], 'seo'),
            ];
        }

        $seo_data[] = [
            'gid' => 'meta',
            'name' => l('header_section_meta', 'seo'),
            'fields' => $fields_data,
            'tooltip' => l('text_help_meta', 'seo'),
        ];

        $fields_data = [];

        foreach ($this->_og_fields as $field_data) {
            $fields_data[] = [
                'gid' => $field_data['name'],
                'name' => l('field_' . $field_data['name'], 'seo'),
                'type' => $field_data['type'],
                'tooltip' => l('text_help_' . $field_data['name'], 'seo'),
            ];
        }

        $seo_data[] = [
            'gid' => 'og',
            'name' => l('header_section_og', 'seo'),
            'fields' => $fields_data,
            'tooltip' => l('text_help_og', 'seo'),
        ];

        return $seo_data;
    }

    /**
     * Validate data of seo tags for saving to data source
     *
     * @param integer $setting_id setting identifier
     * @param array   $data       seo data
     *
     * @return array
     */
    public function validateSeoTags($setting_id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        $return['data']['controller'] = 'custom';

        if (isset($data['meta']['title'])) {
            foreach ($data['meta']['title'] as $id => $value) {
                $return['data']['meta_' . $id]['title'] = $value;
            }
        }

        if (isset($data['meta']['keyword'])) {
            foreach ($data['meta']['keyword'] as $id => $value) {
                $return['data']['meta_' . $id]['keyword'] = $value;
            }
        }
        if (isset($data['meta']['description'])) {
            foreach ($data['meta']['description'] as $id => $value) {
                $return['data']['meta_' . $id]['description'] = $value;
            }
        }
        if (isset($data['meta']['header'])) {
            foreach ($data['meta']['header'] as $id => $value) {
                $return['data']['meta_' . $id]['header'] = $value;
            }
        }

        if (isset($data['meta']['noindex'])) {
            $return['data']['noindex'] = $data['meta']['noindex'] ? 1 : 0;
        }
        if (isset($data['og']['og_title'])) {
            foreach ($data['og']['og_title'] as $id => $value) {
                $return['data']['og_' . $id]['og_title'] = $value;
            }
        }
        if (isset($data['og']['og_type'])) {
            foreach ($data['og']['og_type'] as $id => $value) {
                $return['data']['og_' . $id]['og_type'] = $value;
            }
        }
        if (isset($data['og']['og_description'])) {
            foreach ($data['og']['og_description'] as $id => $value) {
                $return['data']['og_' . $id]['og_description'] = $value;
            }
        }
        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            if (!empty($return['data']['meta_' . $lang_id])) {
                $return['data']['meta_' . $lang_id] = serialize($return['data']['meta_' . $lang_id]);
            } elseif (!empty($return['data']['og_' . $lang_id])) {
                $return['data']['og_' . $lang_id] = serialize($return['data']['og_' . $lang_id]);
            }
        }


        return $return;
    }

    /**
     * Validate data of seo tags for saving to data source
     *
     * @param string $controller user mode controller
     * @param string $module_gid module gid
     * @param string $method     method_name
     * @param array  $data       seo data
     *
     * @return array
     */
    public function validateSeoSettings($controller, $module_gid, $method, $data)
    {
        $return = ['errors' => [], 'data' => []];

        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            if (isset($data['title'])) {
                $return['data']['title'][$lang_id] = trim(strip_tags($data['title'][$lang_id]));
            }
            if (isset($data['keyword'])) {
                $return['data']['keyword'][$lang_id] = trim(strip_tags($data['keyword'][$lang_id]));
            }
            if (isset($data['description'])) {
                $return['data']['description'][$lang_id] = trim(strip_tags($data['description'][$lang_id]));
            }
            if (isset($data['header'])) {
                $return['data']['header'][$lang_id] = trim(strip_tags($data['header'][$lang_id]));
            }
            if (isset($data['og_title'])) {
                $return['data']['og_title'][$lang_id] = trim(strip_tags($data['og_title'][$lang_id]));
            }
            if (isset($data['og_type'])) {
                $return['data']['og_type'][$lang_id] = trim(strip_tags($data['og_type'][$lang_id]));
            }
            if (isset($data['og_description'])) {
                $return['data']['og_description'][$lang_id] = trim(strip_tags($data['og_description'][$lang_id]));
            }
        }

        if (isset($data['noindex'])) {
            $return['data']['noindex'] = $data['noindex'] ? 1 : 0;
        }

        if (isset($data['lang_in_url'])) {
            $return['data']['lang_in_url'] = $data['lang_in_url'] ? 1 : 0;
        }

        return $return;
    }

    /**
     * Return data of seo tags by identifier
     *
     * @param string $setting_id setting identifier
     *
     * @return array
     */
    public function getSeoTags($setting_id)
    {
        $data = $this->ci->pg_seo->get_settings_by_id($setting_id);

        return $this->format_seo_tags($data);
    }

    /**
     * Save data of seo tags to data source
     *
     * @param string $settings_id setting identifier
     * @param array  $data        seo data
     *
     * @return integer
     */
    public function saveSeoTags($settings_id, $data)
    {
        return $this->ci->pg_seo->save_settings($settings_id, $data);
    }

    /**
     * Fromat data of seo tags
     *
     * @param array $data seo data
     *
     * @return integer
     */
    public function formatSeoTags($data)
    {
        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            if ($data['meta_' . $lang_id]) {
                $data['meta_' . $lang_id] = (array) unserialize($data['meta_' . $lang_id]);
            } else {
                $data['meta_' . $lang_id] = [];
            }

            if ($data['og_' . $lang_id]) {
                $data['og_' . $lang_id] = (array) unserialize($data['og_' . $lang_id]);
            } else {
                $data['og_' . $lang_id] = [];
            }
        }

        return $data;
    }

    /**
     * Parse seo tags
     *
     * @param integer $settings_id settings identifier
     *
     * @return array
     */
    public function parseSeoTags($settings_id)
    {
        $settings = $this->get_seo_tags($settings_id);
        if (empty($settings)) {
            return $settings;
        }
        $data            = [];
        $current_lang_id = $this->ci->pg_language->current_lang_id;
        foreach ($this->_meta_fields as $meta_field) {
            $data[$meta_field['name']] = !empty($settings['meta_' . $current_lang_id][$meta_field['name']]) ? $settings['meta_' . $current_lang_id][$meta_field['name']] : '';
        }
        foreach ($this->_og_fields as $og_field) {
            $data[$og_field['name']] = !empty($settings['og_' . $current_lang_id][$og_field['name']]) ? $settings['og_' . $current_lang_id][$og_field['name']] : '';
        }
        $data['noindex'] = $settings['noindex'];

        return $data;
    }

    public function __call($name, $args)
    {
        $methods = [
            'clear_sitemap_xml' => 'clearSitemapXml',
            'format_seo_tags' => 'formatSeoTags',
            'generate_sitemap_xml' => 'generateSitemapXml',
            'generate_sitemap_xml_cron' => 'generateSitemapXmlCron',
            'get_robots_content' => 'getRobotsContent',
            'get_seo_fields' => 'getSeoFields',
            'get_seo_tags' => 'getSeoTags',
            'get_sitemap_data' => 'getSitemapData',
            'get_tracker_html' => 'getTrackerHtml',
            'get_xml_route_file_content' => 'getXmlRouteFileContent',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'parse_seo_tags' => 'parseSeoTags',
            'rewrite_route_php_file' => 'rewriteRoutePhpFile',
            'save_seo_tags' => 'saveSeoTags',
            'set_robots_content' => 'setRobotsContent',
            'set_xml_route_file_content' => 'setXmlRouteFileContent',
            'update_route_langs' => 'updateRouteLangs',
            'validate_seo_settings' => 'validateSeoSettings',
            'validate_seo_tags' => 'validateSeoTags',
            'validate_tracker' => 'validateTracker',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
