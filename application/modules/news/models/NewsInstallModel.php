<?php

declare(strict_types=1);

namespace Pg\modules\news\models;

use Pg\Libraries\View;
use Pg\Libraries\Setup;

/**
 * News module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * News install model
 *
 * @package     PG_Dating
 * @subpackage  News
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class NewsInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * @var array
     */
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items' => [
                'settings_items' => [
                    'action' => 'none',
                    'items' => [
                        'content_items' => [
                            'action' => 'none',
                            'items' => [
                                'news_menu_item' => ['action' => 'create', 'link' => 'admin/news',
                                    'status' => 1, 'sorter' => 5],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_news_menu' => [
            'action' => 'create',
            'name' => 'News section menu',
            'items' => [
                'news_list_item' => ['action' => 'create', 'link' => 'admin/news',
                    'status' => 1],
                'feeds_list_item' => ['action' => 'create', 'link' => 'admin/news/feeds',
                    'status' => 1],
                'settings_list_item' => ['action' => 'create', 'link' => 'admin/news/settings',
                    'status' => 1],
            ],
        ],
        // 'guest_main_menu' => array(
        //     'action' => 'none',
        //     'items' => array(
        //         'main-menu-news-item' => array('action' => 'create', 'link' => 'news',
        //             'status' => 1, 'sorter' => 3),
        //     ),
        // ),
        'user_footer_menu' => [
            'action' => 'none',
            'items' => [
                'footer-menu-about-item' => [
                    'action' => 'none',
                    'items' => [
                        'footer-menu-news-item' => ['action' => 'create', 'link' => 'news',
                            'status' => 1, 'sorter' => 2],
                    ],
                ],
            ],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    private $moderators_methods = [
        ['module' => 'news', 'method' => 'index', 'is_default' => 1, 'group_id' => 3, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Notification configuration
     *
     * @var array
     */
    private $notifications = [
        'templates' => [
            ['gid' => 'last_news', 'name' => 'Last News', 'vars' => ["content"]],
        ],
    ];

    /**
     * Subscription configuration
     *
     * @var array
     */
    private $subscriptions = [
        'types' => [
            ['gid' => 'last_news', 'module' => 'news', 'model' => 'news_model',
                'method' => 'get_last_news'],
        ],
        'subscriptions' => [
            ['gid' => 'last_news', 'template' => 'last_news', 'type' => 'user',
                'content_type' => 'last_news', 'scheduler' => 'a:2:{s:4:"type";i:1;s:13:"date_for_cron";i:0;}'],
        ],
    ];

    /**
     * Seo configuration
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
            "module" => "news",
            "model" => "News_model",
            "method_add" => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ],
    ];

     /**
     * Demo content Access_permissions object
     *
     * @var array
     */
    protected $demo_content = [];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');
        $this->demo_content = Setup::getModuleData(
                NewsModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
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
     * @return boolean
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'menu',
            $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu,
                'update',
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_file);
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
            $temp   = linked_install_process_menu_items($this->menu,
                'export',
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_ids);
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
                linked_install_delete_menu_items($gid,
                    $this->menu[$gid]['items']);
            }
        }
    }

    /**
     * Install data of uploads module
     *
     * @return void
     */
    public function installUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid' => 'news-logo',
            'name' => 'News icon',
            'max_height' => 500,
            'max_width' => 500,
            'max_size' => 100000,
            'name_format' => 'generate',
            'file_formats' => serialize(["jpg", "jpeg", "gif", "png", "webp"]),
            'default_img' => 'default_news-logo.jpg',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $config_id   = $this->ci->Uploads_config_model->save_config(null,
            $config_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'big',
            'width' => 160,
            'height' => 120,
            'effect' => 'none',
            'watermark_id' => 0,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'small',
            'width' => 80,
            'height' => 60,
            'effect' => 'none',
            'watermark_id' => 0,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $config_data = [
            'gid' => 'rss-logo',
            'name' => 'News rss logo',
            'max_height' => 600,
            'max_width' => 800,
            'max_size' => 512000,
            'name_format' => 'generate',
            'file_formats' => serialize(["jpg", "jpeg", "gif", "png", "webp"]),
            'default_img' => '',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $config_id   = $this->ci->Uploads_config_model->save_config(null,
            $config_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'rss',
            'width' => 120,
            'height' => 80,
            'effect' => 'none',
            'watermark_id' => 0,
            'crop_param' => 'resize',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);
    }

    /**
     * Unintsall data of uploads module
     *
     * @return void
     */
    public function deinstallUploads()
    {
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
            'module_gid' => 'news',
            'model_name' => 'News_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('news', $site_map_data);
    }

    /**
     * Uninstall data of site map module
     *
     * @return void
     */
    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('news');
    }

    /**
     * Install data of cronjob module
     *
     * @return void
     */
    public function installCronjob()
    {
        ///// cronjob
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            "name" => "Feed parser",
            "module" => "news",
            "model" => "Feeds_model",
            "method" => "cron_feed_parser",
            "cron_tab" => "12 8 * * *",
            "status" => "1",
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);
    }

    /**
     * Uninstall data of cronjob module
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data                    = [];
        $cron_data["where"]["module"] = "news";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

    /**
     * Install data of banners module
     *
     * @return void
     */
    public function installBanners()
    {
        ///// add banners module
        $this->ci->load->model('News_model');
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->load->model('banners/models/Banner_place_model');

        $this->ci->Banner_group_model->set_module("news",
            "News_model",
            "_banner_available_pages");

        $group_id = $this->ci->Banner_group_model->get_group_id_by_gid('content_groups');
        ///add pages in group
        $pages    = $this->ci->News_model->_banner_available_pages();
        if ($pages) {
            foreach ($pages as $key => $value) {
                $page_attrs = [
                    'group_id' => $group_id,
                    'name' => $value['name'],
                    'link' => $value['link'],
                ];
                $this->ci->Banner_group_model->add_page($page_attrs);
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
        $this->ci->Banner_group_model->delete_module("news");
    }

    /**
     * Install data of subscriptions module
     *
     * @return void
     */
    public function installSubscriptions()
    {
        $this->ci->load->model('Subscriptions_model');
        $this->ci->load->model('subscriptions/models/Subscriptions_types_model');

        // Create template
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($this->notifications['templates'] as $tpl) {
            $template_data = [
                'module' => NewsModel::MODULE_GID,
                'gid' => $tpl['gid'],
                'name' => $tpl['name'],
                'vars' => serialize($tpl['vars']),
                'content_type' => 'text',
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $this->ci->Templates_model->save_template(null, $template_data);
        }

        foreach ($this->subscriptions['types'] as $type) {
            $subscr_data = [
                'gid' => $type['gid'],
                'module' => $type['module'],
                'model' => $type['model'],
                'method' => $type['method'],
            ];
            $this->ci->Subscriptions_types_model->save_subscriptions_type(null,
                $subscr_data);
        }
        foreach ($this->subscriptions['subscriptions'] as $subscription) {
            $subscr_type     = $this->ci->Subscriptions_types_model->get_subscriptions_type_by_gid($subscription['content_type']);
            $subscr_template = $this->ci->Templates_model->get_template_by_gid($subscription['template']);
            $subsc_data      = [
                'gid' => $subscription['gid'],
                'id_template' => $subscr_template['id'],
                'subscribe_type' => $subscription['type'],
                'id_content_type' => $subscr_type['id'],
                'scheduler' => $subscription['scheduler'],
            ];
            $this->ci->Subscriptions_model->save_subscription(null, $subsc_data);
        }
    }

    /**
     * Import languages of subscriptions module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installSubscriptionsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Subscriptions_model');
        $this->ci->load->model('Notifications_model');
        $no_data = false;

        // Update notifications' langs
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'notifications',
            $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');
            $no_data = true;
        } else {
            $this->ci->Notifications_model->update_langs($this->notifications,
                $langs_file,
                $langs_ids);
        }

        // Update subscriptions' langs
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'subscriptions',
            $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty subscriptions langs data');
            $no_data = true;
        } else {
            $this->ci->Subscriptions_model->update_langs('news',
                $this->subscriptions['subscriptions'],
                $langs_file,
                $langs_ids);
        }

        return !$no_data;
    }

    /**
     * Export languages of subscriptions module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installSubscriptionsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('Subscriptions_model');

        $langs['notifications'] = $this->ci->Notifications_model->export_langs($this->notifications,
            $langs_ids);
        $langs['subscriptions'] = $this->ci->Subscriptions_model->export_langs($this->subscriptions['subscriptions'],
            $langs_ids);

        return $langs;
    }

    /**
     * Uninstall data of subscriptions module
     *
     * @return void
     */
    public function deinstallSubscriptions()
    {
        $this->ci->load->model('Subscriptions_model');
        $this->ci->load->model('subscriptions/models/Subscriptions_types_model');

        // Delete template
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($this->notifications['templates'] as $tpl) {
            $this->ci->Templates_model->delete_template_by_gid($tpl['gid']);
        }

        foreach ($this->subscriptions['types'] as $type) {
            $this->ci->Subscriptions_types_model->delete_subscriptions_type_by_gid($type['gid']);
        }
        foreach ($this->subscriptions['subscriptions'] as $subscription) {
            $this->ci->Subscriptions_model->delete_subscription_by_gid($subscription['gid']);
        }
    }

    /**
     * Install data of video uploads module
     *
     * @return void
     */
    public function installVideoUploads()
    {
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');

        $thumbs_settings  = [
            0 => [
                'gid' => 'small', 'width' => 100, 'height' => 70, 'animated' => 0,
            ],
            1 => [
                'gid' => 'middle', 'width' => 200, 'height' => 140, 'animated' => 0,
            ],
            2 => [
                'gid' => 'big', 'width' => 480, 'height' => 360, 'animated' => 0,
            ],
        ];
        $local_settings   = [
            'width' => 0,
            'height' => 0,
            'audio_freq' => '22050',
            'audio_brate' => '64k',
            'video_brate' => '300k',
            'video_rate' => '50',
        ];
        $youtube_settings = [
            'width' => 480,
            'height' => 360,
        ];

        $config_data = [
            'gid' => 'news-video',
            'name' => 'News video',
            'max_size' => 1073741824,
            'file_formats' => serialize(["avi", "flv", "mkv", "asf", "mpeg",
                "mpg"]),
            'default_img' => 'news-video-default.jpg',
            'date_add' => date('Y-m-d H:i:s'),
            'upload_type' => 'local',
            'use_convert' => '1',
            'use_thumbs' => '1',
            'module' => 'news',
            'model' => 'News_model',
            'method_status' => 'video_callback',
            'thumbs_settings' => serialize($thumbs_settings),
            'local_settings' => serialize($local_settings),
            'youtube_settings' => serialize($youtube_settings),
        ];
        $this->ci->Video_uploads_config_model->save_config(null, $config_data);
    }

    /**
     * Uninstall data of video uploads modules
     *
     * @return void
     */
    public function deinstallVideoUploads()
    {
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');
        $config_data = $this->ci->Video_uploads_config_model->get_config_by_gid('news-video');
        if (!empty($config_data["id"])) {
            $this->ci->Video_uploads_config_model->delete_config($config_data["id"]);
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
        $data      = [
            'like' => [
                'facebook' => 'on',
                'vkontakte' => 'on',
                'google' => 'on',
            ],
            'share' => [
                'facebook' => 'on',
                'vkontakte' => 'on',
                'linkedin' => 'on',
                'twitter' => 'on',
            ],
            'comments' => '1',
        ];
        $page_data = [
            'controller' => 'news',
            'method' => 'view',
            'name' => 'View news page',
            'data' => serialize($data),
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
        $this->ci->Social_networking_pages_model->delete_pages_by_controller('news');
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
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'moderators',
            $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'news';
        $methods                   = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'],
                    [],
                    $langs_file[$method['method']]);
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
        $params['where']['module'] = 'news';
        $methods                   = $this->ci->Moderators_model->get_methods_lang_export($params,
            $langs_ids);
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
        $params['where']['module'] = 'news';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install data of comments module
     *
     * @return void
     */
    public function installComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $comment_type = [
            'gid' => 'news',
            'module' => 'news',
            'model' => 'News_model',
            'method_count' => 'comments_count_callback',
            'method_object' => 'comments_object_callback',
        ];
        $this->ci->Comments_types_model->add_comments_type($comment_type);
    }

    /**
     * Import languages of comments module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installCommentsLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'comments',
            $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->update_langs(['news'], $langs_file);
    }

    /**
     * Export languages of comments module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installCommentsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('comments/models/Comments_types_model');

        return ['comments' => $this->ci->Comments_types_model->export_langs([
                'news'], $langs_ids)];
    }

    /**
     * Unistall data of comments module
     *
     * @return void
     */
    public function deinstallComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->delete_comments_type('news');
    }

    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("News_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->News_model->lang_dedicate_module_callback_add($lang_id);
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
            'module_gid' => 'news',
            'model_name' => 'News_model',
            'get_settings_method' => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('news', $seo_data);
        $this->addDemoContent();

        $this->ci->load->model('news/models/Feeds_model');
        $feeds_list = $this->ci->Feeds_model->getFeedsList();
        foreach ($feeds_list as $feed) {
            $content = $this->ci->Feeds_model->getFeedContent($feed["link"],
                $feed["max_news"]);
            if (!empty($content["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $content["errors"]);
            } else {
                $saved_news = $this->Feeds_model->saveFeedNews($feed['id'], $content["items"]);
            }
        }
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('news',
            'arbitrary',
            $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty news arbitrary langs data');

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
                'priority' => 0.7,
            ];
            $this->ci->pg_seo->set_settings('user', 'news', $page, $post_data);
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
        if (empty($langs_ids)) {
            return false;
        }
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user',
            'news');
        $lang_ids     = array_keys($this->ci->pg_language->languages);
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_' . $seo_page['method'];
            foreach ($lang_ids as $lang_id) {
                $meta                                                    = 'meta_' . $lang_id;
                $og                                                      = 'og_' . $lang_id;
                $arbitrary_return[$prefix . '_title'][$lang_id]          = $seo_page[$meta]['title'];
                $arbitrary_return[$prefix . '_keyword'][$lang_id]        = $seo_page[$meta]['keyword'];
                $arbitrary_return[$prefix . '_description'][$lang_id]    = $seo_page[$meta]['description'];
                $arbitrary_return[$prefix . '_header'][$lang_id]         = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix . '_og_title'][$lang_id]       = $seo_page[$og]['og_title'];
                $arbitrary_return[$prefix . '_og_type'][$lang_id]        = $seo_page[$og]['og_type'];
                $arbitrary_return[$prefix . '_og_description'][$lang_id] = $seo_page[$og]['og_description'];
            }
        }

        return ['arbitrary' => $arbitrary_return];
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('news');

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
        $this->ci->load->model(['News_model', 'news/models/Feeds_model']);

        $languages = $this->ci->pg_language->languages;
        foreach ($languages as $l) {
            $lang[$l['code']] = $l['id'];
        }

        $set_data = [];
        foreach ($this->demo_content['news'] as $key => $news) {
            $set_data[$key]['gid'] = $news['gid'];
            $set_data[$key]['lang_id'] = $lang[$news['lang_code']];

            $set_data[$key]['status'] = $news['status'];
            $set_data[$key]['news_type'] = $news['news_type'];
            $set_data[$key]['date_add'] = $news['date_add'];
            $set_data[$key]['feed_link'] = $news['feed_link'];
            $set_data[$key]['feed_id'] = $news['feed_id'];
            $set_data[$key]['set_to_subscribe'] = $news['set_to_subscribe'];
            $set_data[$key]['comments_count'] = $news['comments_count'];

            foreach ($lang as $id) {
                $set_data[$key]['name'][$id] =  $news['name'];
                $set_data[$key]['content'][$id] =  $news['content'];
                $set_data[$key]['annotation'][$id] =  $news['annotation'];
            }

            $validate_data = $this->ci->News_model->validateNews(null, $set_data[$key]);

            if (!empty($validate_data['errors'])) {
                continue;
            }
            if (!empty($news['img'])) {
                $validate_data['data']['img'] = $news['img'];
            }
            if (!empty($news['date_add'])) {
                $validate_data['data']['date_add'] = $news['date_add'];
            }
            $this->ci->News_model->saveNews(null, $validate_data['data']);
        }

        foreach ($this->demo_content['feeds'] as $feed) {
            if (empty($news['lang_code'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, 'Language does not exist');
            }
            $lang_id = $this->ci->pg_language->get_lang_id_by_code($feed['lang_code']);
            if (empty($lang_id)) {
                 $this->system_messages->addMessage(View::MSG_ERROR, 'Language does not exist');
            }
            $feed['id_lang'] = $lang_id;
            unset($feed['lang_code']);

            $this->ci->Feeds_model->saveFeed(null, $feed);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            '_prepare_installing' => 'prepareInstalling',
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_lang_install' => 'arbitraryLangInstall',
            '_arbitrary_lang_export' => 'arbitraryLangExport',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
            '_validate_requirements' => 'validateRequirements',
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
