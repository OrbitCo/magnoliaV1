<?php

declare(strict_types=1);

namespace Pg\modules\like_me\models;

use Pg\Libraries\Setup;

/**
 * Like me install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
 */
class LikeMeInstallModel extends \Model
{

    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Menu configuration
     *
     * @params
     */
    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'other_items' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        "add_ons_items" => [
                            "action" => "none",
                            "items"  => [
                                "like_me_menu_item" => ["action" => "create", "link" => "admin/like_me", "status" => 1, "sorter" => 9],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'user_top_menu' => [
            'name'   => 'Like Me',
            "action" => "none",
            "items"  => [
                'like_me' => ["action" => "create", 'icon' => '',
                    'link' => 'like_me/index', 'status' => 1, 'sorter' => 1]
            ]
        ]
    ];

    /**
     * Lang dedicated configuration
     *
     * @params
     */
    protected $lang_dm_data = [
        [
            'module'        => 'like_me',
            'model'         => 'Like_me_products_model',
            'method_add'    => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ],
    ];

    /**
     * Seo pages configuration
     *
     * @params
     */
    protected $_seo_pages = [
        'index',
        'like_me_profiles'
    ];

    /**
     * Notifications configuration
     *
     * @params
     */
    protected $_notifications = [
        'notifications' => [
            ['gid' => 'like_me_overlap', 'send_type' => 'que'],
        ],
        'templates' => [
            ['gid' => 'like_me_overlap', 'name' => 'Like Me', 'vars' => ['user_nickname', 'profile_nickname', 'image', 'link_1', 'link_2'], 'content_type' => 'html'],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @params
     */
    protected $moderators = [
        ['module' => 'like_me', 'method' => 'index', 'is_default' => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->access_permissions = Setup::getModuleData(
                LikeMeModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data['action']);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]['items']);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('like_me', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_file);
        }

        return true;
    }

    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

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

    public function installNotifications()
    {
        // add notification
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');

        foreach ($this->_notifications['templates'] as $tpl) {
            $template_data = [
                'module' => LikeMeModel::MODULE_GID,
                'gid'          => $tpl['gid'],
                'name'         => $tpl['name'],
                'vars'         => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add'     => date('Y-m-d H:i:s'),
                'date_update'  => date('Y-m-d H:i:s'),
            ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->save_template(null, $template_data);
        }

        foreach ($this->_notifications['notifications'] as $notification) {
            $notification_data = [
                'module' => LikeMeModel::MODULE_GID,
                'gid'                 => $notification['gid'],
                'send_type'           => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add'            => date("Y-m-d H:i:s"),
                'date_update'         => date("Y-m-d H:i:s"),
            ];
            $this->ci->Notifications_model->save_notification(null, $notification_data);
        }
    }

    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');

        $langs_file = $this->ci->Install_model->language_file_read('like_me', 'notifications', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->_notifications, $langs_file, $langs_ids);

        return true;
    }

    public function installNotificationsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->export_langs($this->_notifications, $langs_ids);

        return ['notifications' => $langs];
    }

    public function deinstallNotifications()
    {
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($this->_notifications['templates'] as $tpl) {
            $this->ci->Templates_model->delete_template_by_gid($tpl['gid']);
        }
        foreach ($this->_notifications['notifications'] as $notification) {
            $this->ci->Notifications_model->delete_notification_by_gid($notification['gid']);
        }
    }

    public function installSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid'      => 'like_me',
            'model_name'      => 'Like_me_model',
            'get_urls_method' => 'getSitemapUrls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('like_me', $site_map_data);
    }

    /**
     * Install banners links
     */
    public function installBanners()
    {
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->set_module("like_me", "Like_me_model", "bannerAvailablePages");
        $this->addBanners();
    }

    /**
     * Import banners languages
     */
    public function installBannersLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $banners_groups = ['banners_group_like_me_groups'];
        $langs_file = $this->ci->Install_model->language_file_read('like_me', 'pages', $langs_ids);
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->Banner_group_model->update_langs($banners_groups, $langs_file, $langs_ids);
    }

    /**
     * Unistall banners links
     */
    public function deinstallBanners()
    {
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->delete_module("like_me");
        $this->removeBanners();
    }

    /**
     * Add default banners
     */
    public function addBanners()
    {
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->load->model("banners/models/Banner_place_model");

        $group_attrs = [
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'price'         => 1,
            'gid'           => 'like_me_groups',
            'name'          => 'Like me pages',
        ];
        $group_id = $this->ci->Banner_group_model->create_unique_group($group_attrs);
        $all_places = $this->ci->Banner_place_model->get_all_places();
        if ($all_places) {
            foreach ($all_places as $key => $value) {
                if ($value['keyword'] != 'bottom-banner' && $value['keyword'] != 'top-banner') {
                    continue;
                }
                $this->ci->Banner_place_model->save_place_group($value['id'], $group_id);
            }
        }

        ///add pages in group
        $this->ci->load->model("Like_me_model");
        $pages = $this->ci->Like_me_model->bannerAvailablePages();
        if ($pages) {
            foreach ($pages as $key => $value) {
                $page_attrs = [
                    "group_id" => $group_id,
                    "name"     => $value["name"],
                    "link"     => $value["link"],
                ];
                $this->ci->Banner_group_model->add_page($page_attrs);
            }
        }
    }

    /**
     * Remove banners
     */
    public function removeBanners()
    {
        $this->ci->load->model("banners/models/Banner_group_model");
        $group_id = $this->ci->Banner_group_model->get_group_id_by_gid("like_me_groups");
        $this->ci->Banner_group_model->delete($group_id);
    }

    /**
     * Install moderators links
     */
    public function installModerators()
    {
        //install ausers permissions
        $this->ci->load->model("Moderators_model");
        foreach ((array) $this->moderators as $method_data) {
            $validate_data = ["errors" => [], "data" => $method_data];
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Moderators_model->save_method(null, $validate_data["data"]);
        }
    }

    /**
     * Import moderators languages
     *
     * @param array $langs_ids
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("like_me", "moderators", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty moderators langs data");

            return false;
        }
        // install moderators permissions
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "like_me";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method["method"]])) {
                $this->ci->Moderators_model->save_method($method["id"], [], $langs_file[$method["method"]]);
            }
        }
    }

    /**
     * Export moderators languages
     *
     * @param array $langs_ids
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "like_me";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method["method"]] = $method["langs"];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators links
     */
    public function deinstallModerators()
    {
        $this->ci->load->model("Moderators_model");
        $params = [];
        $params["where"]["module"] = "like_me";
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install fields
     */
    public function prepareInstalling()
    {
    }

    public function arbitraryInstalling()
    {
        ///// add entries for lang data updates
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }

        $seo_data = [
            'module_gid'              => 'like_me',
            'model_name'              => 'Like_me_model',
            'get_settings_method'     => 'getSeoSettings',
            'get_rewrite_vars_method' => 'requestSeoRewrite',
            'get_sitemap_urls_method' => 'getSitemapXmlUrls',
        ];
        $this->ci->pg_seo->set_seo_module('like_me', $seo_data);
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
        $langs_file = $this->ci->Install_model->language_file_read('like_me', 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty like_me arbitrary langs data');

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
            ];
            $this->ci->pg_seo->set_settings('user', 'like_me', $page, $post_data);
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
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'like_me');
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

        return ['arbitrary' => $arbitrary_return];
    }

    public function arbitraryDeinstalling()
    {
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
        }
        $this->ci->pg_seo->delete_seo_module('like_me');
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('like_me');
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function installAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        } else {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($this->access_permissions as $value) {
                if (isset($value['data'])) {
                    $value['data'] = serialize($value['data']);
                }
                $value['methods'] = (!empty($value['methods'])) ?serialize($value['methods']) : null;
                $value['not_methods'] = (!empty($value['not_methods'])) ? serialize($value['not_methods']) : null;
                $this->ci->Access_permissions_modules_model->saveModules($value);
            }
        }
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function deinstallAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        } else {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($this->access_permissions as $value) {
                $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
            }
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
