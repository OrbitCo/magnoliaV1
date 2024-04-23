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

/**
 * Content install model
 *
 * @package     PG_Dating
 * @subpackage  Content
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ContentInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * @var array
     */
    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'content_items' => [
                            'action' => 'none',
                            'items'  => [
                                'content_menu_item' => ['action' => 'create', 'link' => 'admin/content', 'status' => 1, 'sorter' => 3],
                            ],
                        ],
                    ],
                ],
            ],
        ],

        'user_footer_menu' => [
            'action' => 'none',
            'items'  => [
                'footer-menu-help-item'   => [
                    "action" => "none",
                    'link'   => '/',
                    'status' => 1,
                    'sorter' => 1
                ],
                'footer-menu-policy-item' => [
                    "action" => "none",
                    'link'   => '/content/view/privacy-and-security',
                    'status' => 1,
                    'sorter' => 3,
                    'items'  => [
                        'footer-menu-privacy-item' => ['action' => 'create', 'link' => 'content/view/privacy-and-security', 'status' => 1, 'sortet' => 1],
                        'footer-menu-terms-item'   => ['action' => 'create', 'link' => 'content/view/legal-terms', 'status' => 1, 'sortet' => 2],
                    ],
                ],
                'footer-menu-about-item'  => [
                    "action" => "none",
                    "link"   => '/content/view/about-us-item',
                    'status' => 1,
                    'sorter' => 2,
                    'items'  => [
                        'footer-menu-about-us-item' => ['action' => 'create', 'link' => 'content/view/about-us', 'status' => 1, 'sortet' => 1],
                    ],
                ],
                'footer-menu-links-item'  => [
                    "action" => "none",
                    'link'   => '/content/',
                    'status' => 1,
                    'sorter' => 4,
                ],
            ],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators_methods = [
        ['module' => 'content', 'method' => 'index', 'is_default' => 1, 'group_id' => 3, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Uploads configuration
     *
     * @var array
     */
    protected $uploads = [
        [
            'gid'          => 'promo-content-img',
            'name'         => 'Promo content image',
            'max_height'   => 2000,
            'max_width'    => 1200,
            'max_size'     => 1000000,
            'name_format'  => 'generate',
            'file_formats' => ["jpg", "gif", "png", 'webp'],
            'default_img'  => '',
        ],
        [
            'gid'          => 'info-page-logo',
            'name'         => 'Info page image',
            'min_height'   => 200,
            'min_width'    => 200,
            'max_height'   => 1000,
            'max_width'    => 1000,
            'max_size'     => 1000000,
            'name_format'  => 'generate',
            'file_formats' => ["jpg", "gif", "png", 'webp'],
            'default_img'  => '',
            'thumbs'       => [
                'big'    => ['width' => 300, 'height' => 300, 'effect' => 'none', 'watermark' => '', 'crop_param' => 'crop', 'crop_color' => "ffffff"],
                'middle' => ['width' => 200, 'height' => 200, 'effect' => 'none', 'watermark' => '', 'crop_param' => 'crop', 'crop_color' => "ffffff"],
                'small'  => ['width' => 100, 'height' => 100, 'effect' => 'none', 'watermark' => '', 'crop_param' => 'crop', 'crop_color' => "ffffff"],
            ],
        ],
    ];

    /**
     * Video uploads configuration
     *
     * @var array
     */
    protected $video_uploads = [
        [
            "gid"             => "promo-video",
            "name"            => "Promo video",
            "max_size"        => 1073741824,
            "file_formats"    => ["avi", "flv", "mkv", "asf", "mpeg", "mpg", "mov"],
            "default_img"     => "",
            "upload_type"     => "local",
            "use_convert"     => 1,
            "use_thumbs"      => 1,
            "module"          => "content",
            "model"           => "Content_promo_model",
            "method_status"   => "video_callback",
            "thumbs_settings" => [["gid" => "small", "width" => 100, "height" => 70, "animated" => 0]],
            "local_settings"  => ["width" => 980, "height" => 400, "audio_freq" => 22050, "audio_brate" => "64k", "video_brate" => "300k", "video_rate" => 100],
        ],
    ];

    /**
     * Seo pages
     *
     * @var array
     */
    private $_seo_pages = [
        'index',
        'view',
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module"        => "content",
            "model"         => "Content_model",
            "method_add"    => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ],
        [
            'module'        => 'content',
            'model'         => 'Content_promo_model',
            "method_add"    => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ],
    ];

    /**
     * Class constructor
     *
     * @return Content_install_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');
    }

    /**
     * Install data of menu module
     *
     * @return void
     */
    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    /**
     * Import languages of menu module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('content', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
        }

        return true;
    }

    /**
     * Export languages of menu module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

    /**
     * Uninstall data of menu module
     *
     * @return void
     */
    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]['items']);
            }
        }
    }

    /**
     * Install data of site map module
     *
     * @return void
     */
    public function installSiteMap()
    {
        ///// site map
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid'      => 'content',
            'model_name'      => 'Content_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('content', $site_map_data);
    }

    /**
     * Uninstall data of site map module
     *
     * @return void
     */
    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('content');
    }

    /**
     * Install data of banners module
     *
     * @return void
     */
    public function installBanners()
    {
        ///// add banners module
        $this->ci->load->model('Content_model');
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->load->model('banners/models/Banner_place_model');

        $group_id = $this->ci->Banner_group_model->createUniqueGroup([
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'price'         => 1,
            'gid'           => 'content_groups',
            'name'          => 'Content pages'
        ]);
        $all_places = $this->ci->Banner_place_model->getAllPlaces();
        if ($all_places) {
            foreach ($all_places as $key => $value) {
                if (
                    $value['keyword'] != 'bottom-banner' && $value['keyword'] != 'top-banner' &&
                    $value['keyword'] != 'banner-185x155' && $value['keyword'] != 'banner-185x75'
                ) {
                    continue;
                }
                $this->ci->Banner_place_model->save_place_group($value['id'], $group_id);
            }
        }

        $this->ci->Banner_group_model->set_module("content", "Content_model", "bannerAvailablePages");
        $pages = $this->ci->Content_model->bannerAvailablePages();
        if ($pages) {
            foreach ($pages as $key => $value) {
                $this->ci->Banner_group_model->addPage([
                    'group_id' => $group_id,
                    'name'     => $value['name'],
                    'link'     => $value['link']
                ]);
            }
        }
    }

    /**
     * Uninstall data of banners module
     *
     * @return void
     */
    public function deinstallBanners()
    {
        ///// delete banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->delete_module("content");
    }

    /**
     * Install data of moderators module
     *
     * @return void
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');

        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    /**
     * Import languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('content', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'content';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    /**
     * Export languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'content';
        $methods =  $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall data of moderators module
     *
     * @return void
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'content';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install data of uploads module
     *
     * @return void
     */
    public function installUploads()
    {
        // upload config
        $this->ci->load->model("uploads/models/Uploads_config_model");

        $watermark_ids = [];

        foreach ((array) $this->uploads as $upload_data) {
            $config_data = [
                "gid"          => $upload_data["gid"],
                "name"         => $upload_data["name"],
                "min_height"   => isset($upload_data["min_height"]) ? $upload_data["min_height"] : 0,
                "min_width"    => isset($upload_data["min_width"]) ? $upload_data["min_width"] : 0,
                "max_height"   => $upload_data["max_height"],
                "max_width"    => $upload_data["max_width"],
                "max_size"     => $upload_data["max_size"],
                "name_format"  => $upload_data["name_format"],
                "file_formats" => serialize((array) $upload_data["file_formats"]),
                "default_img"  => $upload_data["default_img"],
                "date_add"     => date("Y-m-d H:i:s"),
            ];
            $config_id = $this->ci->Uploads_config_model->save_config(null, $config_data);

            $wm_data = $this->ci->Uploads_config_model->get_watermark_by_gid("image-wm");
            $wm_id = isset($wm_data["id"]) ? $wm_data["id"] : 0;
            if (!empty($upload_data["thumbs"]) && is_array($upload_data['thumbs'])) {
                foreach ($upload_data["thumbs"] as $thumb_gid => $thumb_data) {
                    if (isset($thumb_data["watermark"])) {
                        if (!isset($watermark_ids[$thumb_data["watermark"]])) {
                            $wm_data = $this->ci->Uploads_config_model->get_watermark_by_gid($thumb_data["watermark"]);
                            $watermark_ids[$thumb_data["watermark"]] = isset($wm_data["id"]) ? $wm_data["id"] : 0;
                        }
                        $watermark_id = $watermark_ids[$thumb_data["watermark"]];
                    } else {
                        $watermark_id = 0;
                    }

                    $thumb_data["config_id"] = $config_id;
                    $thumb_data["prefix"] = $thumb_gid;
                    $thumb_data["effect"] = "none";
                    $thumb_data["watermark_id"] = $watermark_id;

                    $validate_data = $this->ci->Uploads_config_model->validate_thumb(null, $thumb_data);
                    if (!empty($validate_data["errors"])) {
                        continue;
                    }
                    $this->ci->Uploads_config_model->save_thumb(null, $validate_data["data"]);
                }
            }
        }
    }

    /**
     * Uninstall data of uploads module
     *
     * @return void
     */
    public function deinstallUploads()
    {
        $this->ci->load->model("uploads/models/Uploads_config_model");

        foreach ((array) $this->uploads as $upload_data) {
            $config_data = $this->ci->Uploads_config_model->get_config_by_gid($upload_data["gid"]);
            if (!empty($config_data["id"])) {
                $this->ci->Uploads_config_model->delete_config($config_data["id"]);
            }
        }
    }

    /**
     * Install data of file uploads module
     *
     * @return void
     */
    public function installFileUploads()
    {
        $this->ci->load->model('file_uploads/models/File_uploads_config_model');
        $file_formats =  [
            0 => 'swf',
        ];

        $config_data = [
            'gid'          => 'promo-content-flash',
            'name'         => 'Promo content flash',
            'max_size'     => 1000000,
            'name_format'  => 'generate',
            'file_formats' => serialize($file_formats),
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->File_uploads_config_model->save_config(null, $config_data);
    }

    /**
     * Uninstall data of file uploads module
     *
     * @return void
     */
    public function deinstallFileUploads()
    {
        $this->ci->load->model('file_uploads/models/File_uploads_config_model');
        $config_data = $this->ci->File_uploads_config_model->get_config_by_gid('promo-content-flash');
        if (!empty($config_data["id"])) {
            $this->ci->File_uploads_config_model->delete_config($config_data["id"]);
        }
    }

    /**
     * Install data of social networking module
     *
     * @return void
     */
    public function installSocialNetworking()
    {
        ///// add social netorking page
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $data =  [
            'like' =>  [
                'facebook'  => 'on',
                'vkontakte' => 'on',
                'google'    => 'on',
            ],
            'share' =>  [
                'facebook'  => 'on',
                'vkontakte' => 'on',
                'linkedin'  => 'on',
                'twitter'   => 'on',
            ],
            'comments' => '1',
        ];
        $page_data = [
            'controller' => 'content',
            'method'     => 'view',
            'name'       => 'View content page',
            'data'       => serialize($data),
        ];
        $this->ci->Social_networking_pages_model->save_page(null, $page_data);
    }

    /**
     * Uninstall data of social networking module
     *
     * @return void
     */
    public function deinstallSocialNetworking()
    {
        ///// delete social netorking page
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $this->ci->Social_networking_pages_model->delete_pages_by_controller('content');
    }

    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("Content_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Content_model->lang_dedicate_module_callback_add($lang_id);
        }

        $this->ci->load->model("content/models/Content_promo_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Content_promo_model->lang_dedicate_module_callback_add($lang_id);
        }
    }

    /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        // add entries for lang data updates
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }

        ///// seo
        $seo_data = [
            'module_gid'              => 'content',
            'model_name'              => 'Content_model',
            'get_settings_method'     => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('content', $seo_data);

        $this->ci->load->model("content/models/Content_promo_model");
        foreach ($this->ci->pg_language->languages as $id => $value) {
            $this->ci->Content_promo_model->lang_dedicate_module_callback_add($value['id']);
        }
        $this->addDemoContent();
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('content', 'demo', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty arbitrary langs data');

            return false;
        }

        $this->ci->load->model("content/models/Content_promo_model");
        foreach ($langs_ids as $lang_id) {
            $promo["promo_text"] = $langs_file["content"][$lang_id];
            $this->ci->Content_promo_model->save_promo($lang_id, $promo);
        }

        $langs_file = $this->ci->Install_model->language_file_read('content', 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty content arbitrary langs data');

            return false;
        }
        foreach ($this->_seo_pages as $page) {
            $post_data = [
                'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ?  $langs_file["seo_tags_{$page}_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
                'priority'       => 0.7,
            ];
            $this->ci->pg_seo->set_settings('user', 'content', $page, $post_data);
        }
    }

    /**
     * Export module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function arbitraryLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model("content/models/Content_promo_model");

        foreach ($langs_ids as $lang_id) {
            $promo = $this->ci->Content_promo_model->get_promo($lang_id);
            $langs["content"][$lang_id] = $promo["promo_text"];
        }

        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'content');
        $lang_ids = array_keys($this->ci->pg_language->languages);
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_' . $seo_page['method'];
            foreach ($lang_ids as $lang_id) {
                $meta = 'meta_' . $lang_id;
                $og = 'og_' . $lang_id;
                $arbitrary_return[$prefix . '_title'][$lang_id] = $seo_page[$meta]['title'];
                $arbitrary_return[$prefix . '_keyword'][$lang_id] = $seo_page[$meta]['keyword'];
                $arbitrary_return[$prefix . '_description'][$lang_id] = $seo_page[$meta]['description'];
                $arbitrary_return[$prefix . '_header'][$lang_id] = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix . '_og_title'][$lang_id] = $seo_page[$og]['og_title'];
                $arbitrary_return[$prefix . '_og_type'][$lang_id] = $seo_page[$og]['og_type'];
                $arbitrary_return[$prefix . '_og_description'][$lang_id] = $seo_page[$og]['og_description'];
            }
        }

        return ['demo' => $langs, "arbitrary" => $arbitrary_return];
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('content');

        /// delete entries in dedicate modules
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
        }
    }

    /**
     * Install demo content
     *
     * @return void
     */
    public function addDemoContent()
    {
        $this->ci->load->model('Content_model');

        $languages = $this->ci->pg_language->languages;

        if (PRODUCT_NAME == 'social') {
            $demo_content = include MODULEPATH . 'content/install/demo_content_social.php';
        } else {
            $demo_content = include MODULEPATH . 'content/install/demo_content_dating.php';
        }

        // Associating languages id with codes
        foreach ($languages as $l) {
            $lang[$l['code']] = $l['id'];
        }

        $set_data = [];
        // Pages
        foreach ($demo_content['pages'] as $key => $page) {
            $set_data[$key]['gid'] = $page['gid'];
            $set_data[$key]['lang_id'] = $lang[$page['lang_code']];
            $set_data[$key]['sorter'] = $page['sorter'];
            $set_data[$key]['status'] = $page['status'];
            $set_data[$key]['parent_id'] = $page['parent_id'];
            $set_data[$key]['date_created'] = $page['date_created'];
            $set_data[$key]['date_modified'] = $page['date_modified'];
            foreach ($lang as $code => $id) {
                $set_data[$key]['title'][$id] =  !empty($page['title'][$code]) ? $page['title'][$code] : $page['title']['en'];
                $set_data[$key]['content'][$id] =  !empty($page['content'][$code]) ? $page['content'][$code] : $page['content']['en'];
                $set_data[$key]['annotation'][$id] =  !empty($page['annotation'][$code]) ? $page['annotation'][$code] : $page['annotation']['en'];
            }
            $validate_data = $this->ci->Content_model->validatePage(null, $set_data[$key]);
            $page_id = $this->ci->Content_model->savePage(null, $validate_data['data']);
            if (isset($page['img'])) {
                $this->ci->Content_model->upload_local_logo($page_id, MODULEPATH . 'content/install/img/' . $page['img']);
            }
        }

        return true;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_prepare_installing' => 'prepareInstalling',
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_lang_install' => 'arbitraryLangInstall',
            '_arbitrary_lang_export' => 'arbitraryLangExport',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
        ];

        if (isset($methods[$name])) {
            $method = $methods[$name];
        } else {
            $search = ['_lang_update', '_lang_export'];
            $replace = ['LangUpdate', 'LangExport'];

            $method = str_replace($search, $replace, $name);
        }

        if (!method_exists($this, $method)) {
            return;
        }

        return call_user_func_array([$this, $method], $args);
    }
}
