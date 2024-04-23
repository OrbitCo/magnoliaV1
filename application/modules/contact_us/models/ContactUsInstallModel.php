<?php

declare(strict_types=1);

namespace Pg\modules\contact_us\models;

/**
 * Contact us install model
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
class ContactUsInstallModel extends \Model
{
    protected $menu = [
        'user_footer_menu' => [
            'action' => 'none',
            'items'  => [
                'footer-menu-help-item' => [
                    'action' => 'none',
                    'items'  => [
                        'footer-menu-contact-item' => ['action' => 'create', 'link' => 'contact_us', 'status' => 1, 'sorter' => 1],
                    ],
                ],
            ],
        ],
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'content_items' => [
                            'action' => 'none',
                            'items'  => [
                                'contactus_menu_item' => ['action' => 'create', 'link' => 'admin/contact_us', 'status' => 1, 'sorter' => 7],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_contacts_menu' => [
            'action' => 'create',
            'name'   => 'Contact section menu',
            'items'  => [
                'reasons_list_item'  => ['action' => 'create', 'link' => 'admin/contact_us', 'status' => 1],
                'settings_list_item' => ['action' => 'create', 'link' => 'admin/contact_us/settings', 'status' => 1],
            ],
        ],
    ];

    private $notifications = [
        'notifications' => [
            ['gid' => 'contact_us_form', 'send_type' => 'simple'],
        ],
        'templates' => [
            ['gid' => 'contact_us_form', 'name' => 'Contact us form mail', 'vars' => ["user_name", "user_email", "subject", "message", "reason", "form_date"], 'content_type' => 'text'],
        ],
    ];

    private $_moderation_types = [
        [
            "name"                 => "contact_us",
            "mtype"                => "-1",
            "module"               => "contact_us",
            "model"                => "Contact_us_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');
    }

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

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('contact_us', 'menu', $langs_ids);

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

    public function installSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid'      => 'contact_us',
            'model_name'      => 'Contact_us_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('contact_us', $site_map_data);
    }

    public function installBanners()
    {
        ///// add banners module
        $this->ci->load->model('Contact_us_model');
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->load->model('banners/models/Banner_place_model');

        $group_id = $this->ci->Banner_group_model->createUniqueGroup([
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'price'         => 1,
            'gid'           => 'contact_groups',
            'name'          => 'Contact pages'
        ]);

        $all_places = $this->ci->Banner_place_model->getAllPlaces();
        if ($all_places) {
            foreach ($all_places as $key => $value) {
                if (
                    $value['keyword'] != 'bottom-banner' && $value['keyword'] != 'top-banner' &&
                    $value['keyword'] != 'banner-320x250' && $value['keyword'] != 'banner-320x75'
                ) {
                    continue;
                }
                $this->ci->Banner_place_model->savePlaceGroup($value['id'], $group_id);
            }
        }

        $this->ci->Banner_group_model->set_module("contact_us", "Contact_us_model", "bannerAvailablePages");
        ///add pages in group
        $pages = $this->ci->Contact_us_model->bannerAvailablePages();
        if ($pages) {
            foreach ($pages as $key => $value) {
                $this->ci->Banner_group_model->add_page([
                    'group_id' => $group_id,
                    'name'     => $value['name'],
                    'link'     => $value['link']
                ]);
            }
        }
    }

    public function installNotifications()
    {
        // add notification
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');

        foreach ($this->notifications['templates'] as $tpl) {
            $template_data = [
                'module' => ContactUsModel::MODULE_GID,
                'gid'          => $tpl['gid'],
                'name'         => $tpl['name'],
                'vars'         => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add'     => date('Y-m-d H:i:s'),
                'date_update'  => date('Y-m-d H:i:s'),
            ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->save_template(null, $template_data);
        }

        foreach ($this->notifications['notifications'] as $notification) {
            $notification_data = [
                'module' => ContactUsModel::MODULE_GID,
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
        $this->ci->load->model('Notifications_model');

        $langs_file = $this->ci->Install_model->language_file_read('contact_us', 'notifications', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->notifications, $langs_file, $langs_ids);

        return true;
    }

    public function installNotificationsLangExport($langs_ids = null)
    {
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->export_langs($this->notifications, $langs_ids);

        return ['notifications' => $langs];
    }

    public function deinstallNotifications()
    {
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($this->notifications['templates'] as $tpl) {
            $this->ci->Templates_model->delete_template_by_gid($tpl['gid']);
        }
        foreach ($this->notifications['notifications'] as $notification) {
            $this->ci->Notifications_model->delete_notification_by_gid($notification['gid']);
        }
    }

    public function installSocialNetworking()
    {
        ///// add social netorking page
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $page_data = [
            'controller' => 'contact_us',
            'method'     => 'index',
            'name'       => 'Contact us page',
            'data'       => 'a:3:{s:4:"like";a:3:{s:8:"facebook";s:2:"on";s:9:"vkontakte";s:2:"on";s:6:"google";s:2:"on";}s:5:"share";a:4:{s:8:"facebook";s:2:"on";s:9:"vkontakte";s:2:"on";s:8:"linkedin";s:2:"on";s:7:"twitter";s:2:"on";}s:8:"comments";s:1:"1";}',
        ];
        $this->ci->Social_networking_pages_model->save_page(null, $page_data);
    }

    public function arbitraryInstalling()
    {
        //// load langs
        $seo_data = [
            'module_gid'              => 'contact_us',
            'model_name'              => 'Contact_us_model',
            'get_settings_method'     => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('contact_us', $seo_data);
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('contact_us');
    }

    public function deinstallBanners()
    {
        ///// delete banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->delete_module("contact_us");
    }

    public function deinstallSocialNetworking()
    {
        ///// delete social netorking page
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $this->ci->Social_networking_pages_model->delete_pages_by_controller('contact_us');
    }

    public function installModeration()
    {
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->_moderation_types as $mtype) {
            $mtype['date_add'] = date('Y-m-d H:i:s');
            $this->ci->Moderation_type_model->save_type(null, $mtype);
        }
    }

    public function installModerationLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('contact_us', 'moderation', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $this->ci->Moderation_type_model->update_langs($this->_moderation_types, $langs_file);
    }

    public function installModerationLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');

        return ['moderation' => $this->ci->Moderation_type_model->export_langs($this->_moderation_types, $langs_ids)];
    }

    private $_seo_pages = [
        'index',
    ];

    /**
     * Import module languages
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('contact_us', 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty contact_us arbitrary langs data');

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
            $this->ci->pg_seo->set_settings('user', 'contact_us', $page, $post_data);
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
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'contact_us');
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
        $this->ci->load->model('Menu_model');
        $this->ci->pg_seo->delete_seo_module('contact_us');
    }

    public function __call($name, $args)
    {
        $methods = [
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
