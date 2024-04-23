<?php

/**
 * Libraries
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2015 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

define('THEMES_TABLE', DB_PREFIX . 'themes');
define('THEMES_COLORSETS_TABLE', DB_PREFIX . 'themes_colorsets');

/**
 * PG Themes Model
 *
 * @package     PG_Core
 * @subpackage  Libraries
 * @category    libraries
 *
 * @copyright   Copyright (c) 2000-2015 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CI_Pg_theme
{
    /**
     * Link to CodeIgniter object
     *
     * @var object
     */
    public $ci;

    /**
     * Settings, stored in base, changable by admin if theme module installed
     *
     * @var array
     */
    public $active_settings = [];

    /**
     * Default settings, preinstalled settings (if install module not installed and/or database settings not valid)
     *
     * @var array
     */
    public $default_settings = [
        'admin' => [
            'theme' => 'gentelella',
            'scheme' => 'default',
            'setable' => 0,
            'logo' => 'logo.png',
            'logo_width' => '180',
            'logo_height' => '150',
            'mini_logo' => 'mini_logo.png',
            'mini_logo_width' => '30',
            'mini_logo_height' => '30',
            'mobile_logo' => 'mobile_logo.png',
            'mobile_logo_width' => '160',
            'mobile_logo_height' => '32',
        ],
        'user' => [
            'theme' => 'flatty',
            'scheme' => 'default',
            'setable' => 0,
            'logo' => 'logo.png',
            'logo_width' => '111',
            'logo_height' => '21',
            'mini_logo' => 'mini_logo.png',
            'mini_logo_width' => '30',
            'mini_logo_height' => '30',
            'mobile_logo' => 'mobile_logo.png',
            'mobile_logo_width' => '160',
            'mobile_logo_height' => '32',
        ],
    ];

    /**
     * Base data of theme
     *
     * @var array
     */
    public $theme_base_data = [];

    /**
     * Default path to theme files
     *
     * @var string
     */
    public $theme_default_path = '';

    /**
     * Default full path to theme files
     *
     * @var string
     */
    public $theme_default_full_path = '';

    /**
     * Full default path to theme files
     *
     * @var string
     */
    public $theme_default_url = '';

    /**
     * CSS links for theme
     *
     * @var string
     */
    public $css = [];

    /**
     * CSS links by theme
     *
     * @var string
     */
    public $theme_css = [];

    /**
     * Javascript links for theme
     *
     * @var string
     */
    public $js = [];

    /**
     * Print type
     *
     * default|pdf
     *
     * @var string
     */
    public $print_type = 'default';
    private $fields = [
        THEMES_TABLE => [
            'id',
            'theme',
            'theme_type',
            'active',
            'setable',
            'logo_width',
            'template_engine',
            'logo_height',
            'logo_default',
            'mini_logo_width',
            'mini_logo_height',
            'mini_logo_default',
            'mobile_logo_width',
            'mobile_logo_height, mobile_logo_default',
        ],
        THEMES_COLORSETS_TABLE => [
            'id',
            'set_name',
            'set_gid',
            'id_theme',
            'color_settings',
            'active',
            'scheme_type',
            'preset',
            'is_generated',
        ],
    ];

    /**
     * Constructor
     *
     * @return CI_PG_Theme Object
     */
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->theme_default_full_path = APPPATH . "views/";
        $this->theme_default_path = APPLICATION_FOLDER . "views/";
        $this->theme_default_url = APPPATH_VIRTUAL . "views/";

        if (!empty($_ENV['THEME_ADMIN_DEFAULT'])) {
            $this->default_settings['admin']['theme'] = $_ENV['THEME_ADMIN_DEFAULT'];
        }

        if (!empty($_ENV['THEME_ADMIN_DEFAULT_LOGO_WIDTH'])) {
            $this->default_settings['admin']['logo_width'] = $_ENV['THEME_ADMIN_DEFAULT_LOGO_WIDTH'];
        }

        if (!empty($_ENV['THEME_ADMIN_DEFAULT_LOGO_HEIGHT'])) {
            $this->default_settings['admin']['logo_height'] = $_ENV['THEME_ADMIN_DEFAULT_LOGO_HEIGHT'];
        }

        $this->ci->cache->registerService(THEMES_TABLE);
        $this->ci->cache->registerService(THEMES_COLORSETS_TABLE);
    }

    /**
     * Return settings by default
     *
     * @param string $theme_type theme type
     *
     * @return array
     */
    public function get_default_settings($theme_type = '')
    {
        if (!empty($theme_type)) {
            return $this->default_settings[$theme_type];
        }

        return $this->default_settings;
    }

    /**
     * Return active settings
     *
     * @return array
     */
    public function get_active_settings()
    {
        $this->active_settings = $this->get_default_settings();

        if (!INSTALL_MODULE_DONE) {
            return $this->active_settings;
        }

        $template_preview_mode = $this->ci->input->get('template_preview_mode', true);
        if (!empty($_SESSION["preview_theme"]) && $_SESSION["preview_scheme"]) {
            $results = $this->getColorsetsByGid($_SESSION["preview_scheme"]);

            $colorsets = [];

            foreach ($results as $result) {
                $result['color_settings'] = unserialize($result['color_settings']);
                $colorsets[$result["id_theme"]] = $result;
            }

            $result = $this->getThemeByGid($_SESSION["preview_theme"]);

            if (!empty($result)) {
                $lang_id = $this->ci->pg_language->current_lang_id;

                $logo = (!empty($result['logo_' . $lang_id])) ? $result['logo_' . $lang_id] : $result['logo_default'];
                $mini_logo = (!empty($result['mini_logo_' . $lang_id])) ? $result['mini_logo_' . $lang_id] : $result['mini_logo_default'];
                $mobile_logo = (!empty($result['mobile_logo_' . $lang_id])) ? $result['mobile_logo_' . $lang_id] : $result['mobile_logo_default'];
                $this->active_settings[$result["theme_type"]] = [
                    "theme" => $result["theme"],
                    "scheme" => $colorsets[$result["id"]]['set_gid'],
                    "scheme_data" => $colorsets[$result["id"]],
                    "setable" => intval($result["setable"]),
                    "logo_width" => $result["logo_width"],
                    "logo_height" => $result["logo_height"],
                    "logo" => $logo,
                    "mini_logo_width" => $result["mini_logo_width"],
                    "mini_logo_height" => $result["mini_logo_height"],
                    "mini_logo" => $mini_logo,
                    "mobile_logo_width" => $result["mobile_logo_width"],
                    "mobile_logo_height" => $result["mobile_logo_height"],
                    "mobile_logo" => $mobile_logo,
                    "template_engine" => $result["template_engine"],
                ];
            }
        } else {
            $colorsets = [];
            $results = $this->getAllColorsets();
            if (!empty($results)) {
                foreach ($results as $index => $result) {
                    if ($result['active'] == 1) {
                        $result['color_settings'] = unserialize($result['color_settings']);
                        $colorsets[$result["id_theme"]] = $result;
                    } else {
                        unset($results[$index]);
                    }
                }
            }

            $results = $this->getAllThemes();
            if (!empty($results)) {
                foreach ($results as $result) {
                    if ($result['active'] != 1) {
                        continue;
                    }

                    if (empty($colorsets[$result["id"]])) {
                        log_message('error', $result["theme"] . ' theme has no colorset');

                        continue;
                    }

                    $lang_id = $this->ci->pg_language->current_lang_id;

                    $logo = (!empty($result['logo_' . $lang_id])) ? $result['logo_' . $lang_id] : $result['logo_default'];
                    $mini_logo = (!empty($result['mini_logo_' . $lang_id])) ? $result['mini_logo_' . $lang_id] : $result['mini_logo_default'];
                    $mobile_logo = (!empty($result['mobile_logo_' . $lang_id])) ? $result['mobile_logo_' . $lang_id] : $result['mobile_logo_default'];

                    $this->active_settings[$result["theme_type"]] = [
                        "theme" => $result["theme"],
                        "scheme" => $colorsets[$result["id"]]['set_gid'],
                        "scheme_data" => $colorsets[$result["id"]],
                        "setable" => intval($result["setable"]),
                        "logo_width" => $result["logo_width"],
                        "logo_height" => $result["logo_height"],
                        "logo" => $logo,
                        "mini_logo_width" => $result["mini_logo_width"],
                        "mini_logo_height" => $result["mini_logo_height"],
                        "mini_logo" => $mini_logo,
                        "mobile_logo_width" => $result["mobile_logo_width"],
                        "mobile_logo_height" => $result["mobile_logo_height"],
                        "mobile_logo" => $mobile_logo,
                        "template_engine" => $result["template_engine"],
                    ];
                }
            }
        }

        return $this->active_settings;
    }

    /**
     * Return active settings from cache
     *
     * @param string $theme_type theme type
     *
     * @return array
     */
    public function return_active_settings($theme_type = '')
    {
        if (empty($this->active_settings[$theme_type])) {
            $this->get_active_settings();
        }

        if (!empty($theme_type)) {
            return $this->active_settings[$theme_type];
        }

        return $this->active_settings;
    }

    private function getAllThemes()
    {
        $fields = $this->fields[THEMES_TABLE];

        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            $fields[] = 'logo_' . $lang_id;
            $fields[] = 'mini_logo_' . $lang_id;
            $fields[] = 'mobile_logo_' . $lang_id;
        }

        return $this->ci->cache->get(THEMES_TABLE, 'all', function () use ($fields) {
            $ci = &get_instance();

            $results_raw = $ci->db->select(implode(", ", $fields))
                                    ->from(THEMES_TABLE)
                                    ->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                return [];
            }

            return $results_raw;
        });
    }

    private function getAllColorsets()
    {
        $fields = $this->fields[THEMES_COLORSETS_TABLE];

        return $this->ci->cache->get(THEMES_COLORSETS_TABLE, 'all', function () use ($fields) {
            $ci = &get_instance();

            $results_raw = $ci->db->select(implode(", ", $fields))
                                    ->from(THEMES_COLORSETS_TABLE)
                                    ->get()->result_array();

            return $results_raw ?? [];
        });
    }

    private function getThemeByGid($theme_gid)
    {
        $themes_raw = $this->getAllThemes();

        foreach ($themes_raw as $theme_raw) {
            if ($theme_raw['theme'] == $theme_gid) {
                return $theme_raw;
            }
        }

        return false;
    }

    private function getColorsetsByTheme($theme_id)
    {
        $colorsets_raw = $this->getAllColorsets();

        $theme_colorsets = [];
        foreach ($colorsets_raw as $colorset_raw) {
            if ($colorset_raw['id_theme'] == $theme_id) {
                $theme_colorsets[] = $colorset_raw;
            }
        }

        return $theme_colorsets;
    }

    private function getColorsetsByGid($set_gid)
    {
        $colorsets_raw = $this->getAllColorsets();

        foreach ($colorsets_raw as $index => $colorset_raw) {
            if ($colorset_raw['set_gid'] != $set_gid) {
                unset($colorsets_raw[$index]);
            }
        }

        return $colorsets_raw;
    }

    /**
     * Return base data of theme
     *
     * @return array
     */
    public function get_theme_base_data($theme_gid)
    {
        if (INSTALL_MODULE_DONE) {
            $theme_raw = $this->getThemeByGid($theme_gid);

            if (empty($theme_raw)) {
                throw new \Exception('Incorrect theme');
            }

            $lang_id = $this->ci->pg_language->current_lang_id;

            $logo = (!empty($theme_raw['logo_' . $lang_id])) ? $theme_raw['logo_' . $lang_id] : $theme_raw['logo_default'];
            $mini_logo = (!empty($theme_raw['mini_logo_' . $lang_id])) ? $theme_raw['mini_logo_' . $lang_id] : $theme_raw['mini_logo_default'];
            $mobile_logo = (!empty($theme_raw['mobile_logo_' . $lang_id])) ? $theme_raw['mobile_logo_' . $lang_id] : $theme_raw['mobile_logo_default'];

            $this->theme_base_data[$theme_gid] = [
                "theme" => $theme_raw["theme"],
                "logo_width" => $theme_raw["logo_width"],
                "logo_height" => $theme_raw["logo_height"],
                "logo" => $logo,
                "mini_logo_width" => $theme_raw["mini_logo_width"],
                "mini_logo_height" => $theme_raw["mini_logo_height"],
                "mini_logo" => $mini_logo,
                "mobile_logo_width" => $theme_raw["mobile_logo_width"],
                "mobile_logo_height" => $theme_raw["mobile_logo_height"],
                "mobile_logo" => $mobile_logo,
            ];

            $colorsets_raw = $this->getColorsetsByTheme($theme_raw['id']);

            foreach ($colorsets_raw as $colorset_raw) {
                if ($colorset_raw['active'] == 1) {
                    $this->theme_base_data[$theme_gid]["scheme"] = $colorset_raw['set_gid'];
                    $this->theme_base_data[$theme_gid]["scheme_data"] = unserialize($colorset_raw['color_settings']);

                    break;
                }
            }
        }

        return $this->theme_base_data;
    }

    /**
     * Return base data of theme from cache
     *
     * @param string $theme theme guid
     *
     * @return array
     */
    public function return_theme_base_data($theme)
    {
        if (empty($this->theme_base_data[$theme])) {
            $this->get_theme_base_data($theme);
        }

        return $this->theme_base_data[$theme];
    }

    /**
     * Check Themes module is installed
     *
     * @param string $theme  theme guid
     * @param string $module module name
     *
     * @return string
     */
    public function is_module_theme_exists($theme, $module)
    {
        $module_theme_path = MODULEPATH . $module . "/views/" . $theme;

        if (!is_dir($module_theme_path)) {
            $theme_data = $this->get_theme_data($theme);
            if (!empty($theme_data)) {
                $theme_type = $theme_data["type"];
            } else {
                $theme_type = $this->get_current_theme_type();
            }
            $theme = $this->default_settings[$theme_type]["theme"];
        }

        return $theme;
    }

    /**
     * Load theme data
     *
     * @param string $theme theme guid
     *
     * @return array
     */
    public function get_theme_data($theme)
    {
        $theme_settings_file = $this->theme_default_full_path . $theme . "/theme.php";
        if (!file_exists($theme_settings_file)) {
            return false;
        }
        require $theme_settings_file;
        if (empty($_theme)) {
            return false;
        }

        return $_theme;
    }

    /**
     * Return current theme type
     *
     * @return void
     */
    public function get_current_theme_type()
    {
        if ($this->ci->router->is_admin_class) {
            return "admin";
        }

        return "user";
    }

    /**
     * Format theme settings
     *
     * @param string $module     module name
     * @param string $theme_type theme type
     * @param string $theme      theme guid
     * @param string $scheme     scheme guid
     *
     * @return array
     */
    public function format_theme_settings($module = '', $theme_type = '', $theme = '', $scheme = '')
    {
        $theme_data = [];

        if (empty($theme_type)) {
            $theme_type = $this->get_current_theme_type();
        }

        if (!empty($theme)) {
            $theme_data = $this->get_theme_data($theme);

            if ($theme_data === false) {
                $theme = $scheme = '';
            } else {
                $active_settings = $this->return_theme_base_data($theme);
            }
        }

        if (empty($theme_data)) {
            $active_settings = $this->return_active_settings($theme_type);
            $theme = $active_settings["theme"];
            $scheme = $active_settings["scheme"];

            if (empty($theme)) {
                return false;
            }

            $theme_data = $this->get_theme_data($theme);
        }

        if (empty($scheme)) {
            $scheme = $active_settings["scheme"];
        }

        $theme_path = $this->theme_default_path . $theme . '/';
        $img_path = $this->theme_default_path . $theme . '/img/';
        $img_set_path = $this->theme_default_path . $theme . '/sets/' . $scheme . '/img/';
        $css_path = $this->theme_default_path . $theme . '/sets/' . $scheme . '/css/';
        $logo_path = $this->theme_default_path . $theme . '/logo/';

        $logo_path_mini = $this->theme_default_path . $theme . '/logo/';
        $logo_path_default = $this->theme_default_path . $theme . '/logo/';
        $logo_path_colour_set = $this->theme_default_path . $theme . '/logo/';
        if (isset($active_settings['scheme_data']['id'])) {
            $logo_path_colour_set .= $active_settings['scheme_data']['id'] . '/';
        }

        $mobile_logo_path = $this->theme_default_path . $theme . '/mobile-logo/';

        if (INSTALL_MODULE_DONE) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        } else {
            $lang_id = 0;
        }

        if ($lang_id && !empty($active_settings['scheme_data']['id'])) {
            $this->ci->load->model('Themes_model');
            $params = ['where' => [
                    'id_lang' => $lang_id,
                    'id_set' => $active_settings['scheme_data']['id'],
            ]];

            $logos = $this->ci->Themes_model->getColoursetLogo($params);

            if ($logos) {
                $res = current($logos);
            }
            if (!empty($res)) {
                $active_settings["logo_width"] = (!empty($res['logo_width'])) ? $res['logo_width'] : $active_settings["logo_width"];
                $active_settings["logo_height"] = (!empty($res['logo_height'])) ? $res['logo_height'] : $active_settings["logo_height"];
                $active_settings["mini_logo_width"] = (!empty($res['mini_logo_width'])) ? $res['mini_logo_width'] : $active_settings["mini_logo_width"];
                $active_settings["mini_logo_height"] = (!empty($res['mini_logo_height'])) ? $res['mini_logo_height'] : $active_settings["mini_logo_height"];
                $active_settings["logo"] = (!empty($res['logo'])) ? $res['logo'] : $active_settings["logo"];
                $active_settings["mini_logo"] = (!empty($res['mini_logo'])) ? $res['mini_logo'] : $active_settings["mini_logo"];

                $text_logo = isset($active_settings['text_logo']) ? $active_settings['text_logo'] : '';
                $text_logo_mini = isset($active_settings['text_logo_mini']) ? $active_settings['text_logo_mini'] : '';
                $active_settings["text_logo"] = isset($res['text_logo']) ? $res['text_logo'] : $text_logo;
                $active_settings["text_logo_mini"] = isset($res['text_logo_mini']) ? $res['text_logo_mini'] : $text_logo_mini;
            }
            $mini_logo_phys_path = SITE_PHYSICAL_PATH . $logo_path_colour_set . $active_settings["mini_logo"];
            $logo_phys_path = SITE_PHYSICAL_PATH . $logo_path_colour_set . $active_settings["logo"];

            if (file_exists($mini_logo_phys_path)) {
                $logo_path_mini = $logo_path_colour_set;
            }
            if (file_exists($logo_phys_path)) {
                $logo_path = $logo_path_colour_set;
            }
        }

        $active_settings["text_logo"] = isset($active_settings["text_logo"]) ? $active_settings["text_logo"] : '';
        $active_settings["text_logo_mini"] = isset($active_settings["text_logo_mini"]) ? $active_settings["text_logo_mini"] : '';
        $format = [
            "theme" => $theme,
            "type" => $theme_type,
            "scheme" => $scheme,
            "img_path" => $img_path,
            "img_set_path" => $img_set_path,
            "css_path" => $css_path,
            "theme_path" => $theme_path,
            "logo" => [
                "width" => $active_settings["logo_width"],
                "height" => $active_settings["logo_height"],
                "name" => $active_settings["logo"],
                "path" => $logo_path . $active_settings["logo"],
                "path_colour_set" => $logo_path_colour_set . $active_settings["logo"],
                'text_logo' => $active_settings["text_logo"]
            ],
            "mini_logo" => [
                "width" => $active_settings["mini_logo_width"],
                "height" => $active_settings["mini_logo_height"],
                "name" => $active_settings["mini_logo"],
                "path" => $logo_path_mini . $active_settings["mini_logo"],
                "path_colour_set" => $logo_path_colour_set . $active_settings["mini_logo"],
                'text_logo_mini' => $active_settings["text_logo_mini"]
            ],
            "mobile_logo" => [
                "width" => $active_settings["mobile_logo_width"],
                "height" => $active_settings["mobile_logo_height"],
                "name" => $active_settings["mobile_logo"],
                "path" => $mobile_logo_path . $active_settings["mobile_logo"],
                'text_logo' => $active_settings["text_logo"]
            ],
        ];

        if (!empty($module)) {
            $module_theme = $this->is_module_theme_exists($theme, $module);
            $module_theme_path = MODULEPATH_RELATIVE . $module . "/views/" . $module_theme . '/';
            $format["theme_module_path"] = $module_theme_path;
            $format["css_module_path"] = $module_theme_path . 'css/';
        }

        return $format;
    }

    /**
     * Add css file
     *
     * @param string $path_to_file path to css file
     *
     * @return boolean
     */
    public function add_css($path_to_file)
    {
        if (!in_array($path_to_file, $this->css)) {
            $this->css[] = $path_to_file;
        }

        return true;
    }

    /**
     * Add css file
     *
     * @param string $path_to_file path to css file
     *
     * @return boolean
     */
    public function add_theme_css($filename, $media = 'all')
    {
        if (!isset($this->theme_css[$media])) {
            $this->theme_css[$media] = [];
        }
        if (!in_array($filename, $this->theme_css[$media])) {
            $this->theme_css[$media][] = $filename;
        }

        return true;
    }

    /**
     * Return html to include css files
     *
     * find router theme_type and include active theme css at first
     *
     * @param string $theme  theme guid
     * @param string $scheme scheme guid
     *
     * @return string
     */
    public function get_include_css_code($theme = '', $scheme = '')
    {
        $html = "";
        $theme_type = $this->get_current_theme_type();

        if (!$theme && !$scheme) {
            $active_settings = $this->return_active_settings($theme_type);
            $theme = $active_settings["theme"];
            $scheme = $active_settings["scheme"];
        }

        $css_url = $this->theme_default_url . $theme . '/sets/' . $scheme . '/css/';
        $css_path = $this->theme_default_full_path . $theme . '/sets/' . $scheme . '/css/';

        if (INSTALL_MODULE_DONE) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        } else {
            $lang_id = 0;
        }

        if ($lang_id) {
            $lang_data = $this->ci->pg_language->get_lang_by_id($lang_id);
        } else {
            $lang_data['rtl'] = 'ltr';
        }
        $file_version = '';

        if (INSTALL_MODULE_DONE && $this->ci->pg_module->is_module_installed('themes')) {
            $style_prefix = $this->ci->router->is_admin_class ? 'admin' : 'user';
            $file_version = '?' . $this->ci->pg_module->get_module_config('themes', $style_prefix . '_style_version');
        }

        if (!empty($this->css)) {
            foreach ($this->css as $css_file) {
                $css_file = str_replace(['[rtl]', '[dir]'], $lang_data["rtl"], $css_file);
                $html .= '<link href="' . SITE_VIRTUAL_PATH . $css_file . $file_version . '" rel="stylesheet" type="text/css" media="all">' . "\n";
            }
        }

        if (!empty($this->theme_css)) {
            foreach ($this->theme_css as $media => $css_files) {
                foreach ($css_files as $css_file) {
                    $css_file = str_replace(['[rtl]', '[dir]'], $lang_data["rtl"], $css_file);
                    $html .= '<link href="' . $css_url . $css_file . $file_version . '" rel="stylesheet" type="text/css" media="' . $media . '">' . "\n";
                }
            }
        } else {
            $theme_data = $this->get_theme_data($theme);
            unset($theme_data['css']['mobile']);

            $css_default_url = $this->theme_default_url . $theme . '/sets/' . $theme_data["default_scheme"] . '/css/';
            $css_default_path = $this->theme_default_full_path . $theme . '/sets/' . $theme_data["default_scheme"] . '/css/';

            if (isset($theme_data["css"]) && !empty($theme_data["css"])) {
                if ($this->print_type == 'pdf') {
                    // get only print css
                    foreach ($theme_data["css"] as $css_data) {
                        $css_data["file"] = str_replace(['[rtl]', '[dir]'], $lang_data["rtl"], $css_data["file"]);
                        if ($css_data["media"] != 'print') {
                            continue;
                        }
                        if (file_exists($css_path . $css_data["file"])) {
                            $html .= '  <link href="' . $css_url . $css_data["file"] . $file_version . '" rel="stylesheet" type="text/css" media="all">' . "\n";
                        } elseif (file_exists($css_default_path . $css_data["file"])) {
                            $html .= '  <link href="' . $css_default_url . $css_data["file"] . $file_version . '" rel="stylesheet" type="text/css" media="all">' . "\n";
                        }
                    }
                } else {
                    foreach ($theme_data["css"] as $css_data) {
                        $css_data["file"] = str_replace(['[rtl]', '[dir]'], $lang_data["rtl"], $css_data["file"]);
                        if (file_exists($css_path . $css_data["file"])) {
                            $html .= "  <link href='" . $css_url . $css_data["file"] . $file_version . "' rel='stylesheet' type='text/css' " . ($css_data["media"] ? ("media='" . $css_data["media"] . "'") : "") . ">\n";
                        } elseif (file_exists($css_default_path . $css_data["file"])) {
                            $html .= "  <link href='" . $css_default_url . $css_data["file"] . $file_version . "' rel='stylesheet' type='text/css' " . ($css_data["media"] ? ("media='" . $css_data["media"] . "'") : "") . ">\n";
                        }
                    }
                }
            }
        }

        return $html;
    }

    /**
     * Adds javascript file to an array whose elements are added to the page.
     *
     * @param string $path_to_file path to javascript file
     * @param string $module       module guid
     *
     * @return boolean
     */
    public function add_js($path_to_file, $module = null)
    {
        if (is_null($module)) {
            if (!in_array($path_to_file, $this->js)) {
                $this->js[] = $path_to_file;
            }
        } else {
            if (!isset($this->js[$module])) {
                $this->js[$module] = [];
            }
            if (!in_array($path_to_file, $this->js[$module])) {
                $this->js[$module][] = $path_to_file;
            }
        }

        return true;
    }

    /**
     * Return html to include js files
     *
     * @return string
     */
    public function get_include_js_code()
    {
        $html = "";

        $js_url = APPPATH_VIRTUAL . 'js/';

        if (!empty($this->js)) {
            foreach ($this->js as $module => $js_file) {
                if (is_array($js_file)) {
                    foreach ($js_file as $js_file) {
                        $js_module_url = APPPATH_VIRTUAL . 'modules/' . $module . '/js/';
                        $html .= "  <script type='text/javascript' src='" . $js_module_url . $js_file . "'></script>\n";
                    }
                } else {
                    $html .= "  <script type='text/javascript' src='" . $js_url . $js_file . "'></script>\n";
                }
            }
        }

        return $html;
    }

    /**
     * Install theme properties related to langauge
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function lang_dedicate_module_callback_add($lang_id)
    {
        $this->ci->load->dbforge();
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        $this->ci->dbforge->add_column(THEMES_TABLE, [
            'logo_' . $lang_id => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('logo_' . $lang_id, 'logo_' . $default_lang_id, false);
            $this->ci->db->update(THEMES_TABLE);
        }
        $this->ci->dbforge->add_column(THEMES_TABLE, [
            'mini_logo_' . $lang_id => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('mini_logo_' . $lang_id, 'mini_logo_' . $default_lang_id, false);
            $this->ci->db->update(THEMES_TABLE);
        }
        $this->ci->dbforge->add_column(THEMES_TABLE, [
            'mobile_logo_' . $lang_id => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('mobile_logo_' . $lang_id, 'mobile_logo_' . $default_lang_id, false);
            $this->ci->db->update(THEMES_TABLE);
        }

        $this->ci->cache->flush(THEMES_TABLE);

    }

    /**
     * Uninstall theme properties related to langauge
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function lang_dedicate_module_callback_delete($lang_id)
    {
        $this->ci->load->dbforge();
        $this->ci->dbforge->drop_column(THEMES_TABLE, "logo_" . $lang_id);
        $this->ci->dbforge->drop_column(THEMES_TABLE, "mini_logo_" . $lang_id);
        $this->ci->dbforge->drop_column(THEMES_TABLE, "mobile_logo_" . $lang_id);

        $this->ci->cache->flush(THEMES_TABLE);

    }

    public function generateCssForCurrentThemes()
    {
        //TODO: пренести метод generate_css из модуля themes
        if (INSTALL_MODULE_DONE && $this->ci->pg_module->is_module_active("themes")) {
            $settings = $this->return_active_settings();
            $this->ci->load->model('themes/models/Themes_model');
            foreach ($settings as $role => $data) {
                if (!$settings[$role]['scheme_data']['is_generated']) {
                    $color_settings = serialize($settings[$role]['scheme_data']['color_settings']);
                    $this->ci->Themes_model->save_set($settings[$role]['scheme_data']['id'], ['color_settings' => $color_settings]);
                    $this->setIsGenerated($settings[$role]['scheme_data']['id'], 1);
                }
            }
        }
    }

    public function setIsGenerated($set_id, $is_generated)
    {
        if (INSTALL_MODULE_DONE) {
            if ($set_id) {
                $this->ci->db->where('id', $set_id);
            }
            $this->ci->db->set('is_generated', $is_generated);
            $this->ci->db->update(THEMES_COLORSETS_TABLE);

            $this->ci->cache->flush(THEMES_COLORSETS_TABLE);
        }
    }
}
