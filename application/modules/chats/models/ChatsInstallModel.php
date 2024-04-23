<?php

declare(strict_types=1);

namespace Pg\modules\chats\models;

/**
 * Chats install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 */
class ChatsInstallModel extends \Model
{
    private $menu = [
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
                            'name'   => '',
                            "items"  => [
                                "chats_menu_item" => ["action" => "create", "link" => "admin/chats", 'icon' => 'video-camera', "status" => 1, "sorter" => 3],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'user_top_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'user-menu-communication' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        'chat_item' => [
                            'action' => 'create',
                            'link'   => 'chats/',
                            'status' => 0,
                            'sorter' => 11,
                        ],
                    ],
                ],
            ],
        ],
    ];

    private $_chats = [
        'Cometchat',
        //'Flashchat',
        //'Oovoochat',
        'Arrowchat',
        'PgVideochat',
    ];

    private $_chat_models = [];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        foreach ($this->_chats as $chat) {
            if (file_exists(__DIR__ . "/chats/$chat" . EXT)) {
                $this->ci->load->model("chats/models/chats/$chat");
                $this->_chat_models[] = $this->ci->{$chat};
            }
        }
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
        $langs_file = $this->ci->Install_model->language_file_read('chats', 'menu', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }
        $this->ci->load->helper('menu');
        foreach (array_keys($this->menu) as $gid) {
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
        foreach (array_keys($this->menu) as $gid) {
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

    private function addChats()
    {
        $this->ci->load->model('Chats_model');
        foreach ($this->_chat_models as $chat) {
            $this->ci->Chats_model->save($chat->as_array(true));
        }
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
            "name"     => "Canceled Video chats",
            "module"   => "chats",
            "model"    => "Chats_model",
            "method"   => "cron_canceled_chats",
            "cron_tab" => "15 * * * *",
            "status"   => "1",
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);
        $cron_data = [
            "name"     => "Time alert for video chat",
            "module"   => "chats",
            "model"    => "Chats_model",
            "method"   => "cron_send_alert_per_hour",
            "cron_tab" => "*/16 * * * *",
            "status"   => "1",
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
        $cron_data = [];
        $cron_data["where"]["module"] = "chats";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

    public function arbitraryInstalling()
    {
        $this->addChats();

        $seo_data = [
            'module_gid' => 'chats',
            'model_name' => 'Chats_model',
            'get_settings_method' => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('chats', $seo_data);
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
        $langs_file = $this->ci->Install_model->language_file_read('chats', 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty chats arbitrary langs data');

            return false;
        }

        $post_data = [
                'title'          => isset($langs_file["seo_tags_index_title"]) ? $langs_file["seo_tags_index_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_index_keyword"]) ?  $langs_file["seo_tags_index_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_index_description"]) ? $langs_file["seo_tags_index_description"] : null,
                'header'         => isset($langs_file["seo_tags_index_header"]) ? $langs_file["seo_tags_index_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_index_og_title"]) ? $langs_file["seo_tags_index_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_index_og_type"]) ? $langs_file["seo_tags_index_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_index_og_description"]) ? $langs_file["seo_tags_index_og_description"] : null,
        ];
        $this->ci->pg_seo->set_settings('user', 'chats', 'index', $post_data);
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

        // arbitrary
        $arbitrary_return = [];
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'chats');
        $lang_ids = array_keys($this->ci->pg_language->languages);
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_' . $seo_page['method'];
            foreach ($lang_ids as $lang_id) {
                $meta = 'meta_' . $lang_id;
                $arbitrary_return[$prefix . '_header'][$lang_id] = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix . '_title'][$lang_id] = $seo_page[$meta]['title'];
            }
        }

        return ['arbitrary' => $arbitrary_return];
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('chats');
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
