<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

class StartInstallModel extends \Model
{
    protected $menu = [];
    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module"        => "start",
            "model"         => "Start_Copyright_model",
            "method_add"    => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ]
    ];

    /**
     * StartInstallModel constructor
     */
    public function __construct()
    {
        parent::__construct();

        // load langs
        $this->ci->load->model('Install_model');
        $this->menu = include MODULEPATH . 'start/install/menu_dating.php';
    }

    public function validateRequirements()
    {
        return ['data' => [], 'result' => true];
    }

    public function validateSettingsForm($data)
    {
        $return = ["data" => [], "errors" => []];

        if (isset($data["product_order_key"])) {
            $return["data"]["product_order_key"] = trim(strip_tags($data["product_order_key"]));
            if (empty($return["data"]["product_order_key"])) {
                $this->ci->pg_language->get_string('start', 'error_product_key_incorrect');
            }
        } else {
            $return['errors'][] = $this->ci->pg_language->get_string('start', 'error_product_key_incorrect');
        }

        return $return;
    }

    public function saveSettingsForm($data)
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('start', $setting, $value);
        }
    }

    public function getSettingsForm($submit = false)
    {
        $data = [
            'product_order_key' => $this->ci->pg_module->get_module_config('start', 'product_order_key'),
        ];

        if (empty($data['product_order_key'])) {
            if (file_exists(SITE_PHYSICAL_PATH . 'order_key.txt')) {
                $data['product_order_key'] = file_get_contents(SITE_PHYSICAL_PATH . 'order_key.txt');
                if (!empty($data['product_order_key'])) {
                    $submit = true;
                }
            }
        } elseif ($submit) {
            $data["product_order_key"] = $this->ci->input->post('product_order_key', true);
        }

        if ($submit) {
            $validate = $this->_validate_settings_form($data);
            if (!empty($validate["errors"])) {
                $this->ci->view->assign('settings_errors', $validate["errors"]);
                $data = $validate["data"];
            } else {
                $this->_save_settings_form($validate["data"]);

                return false;
            }
        }

        $this->ci->view->assign('settings_data', $data);
        $html = $this->ci->view->fetch('install_settings_form', 'admin', 'start');

        return $html;
    }

    /*
     * Menu module methods
     *
     */

    public function installMenu()
    {
        $this->ci->load->model('Menu_model');
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
        $langs_file = $this->ci->Install_model->language_file_read('start', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->model('Menu_model');
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
        $this->ci->load->model('Menu_model');
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

    public function deinstallMenu()
    {
        $this->ci->load->model('Menu_model');

        foreach ($this->menu as $gid => $menu_data) {
            $menu = $this->ci->Menu_model->get_menu_by_gid($gid);
            if ($menu["id"]) {
                $this->ci->Menu_model->delete_menu($menu["id"]);
            }
        }
    }

    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("start/models/Start_Copyright_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Start_Copyright_model->lang_dedicate_module_callback_add($lang_id);
        }
    }

    /*
     * Arbitrary methods
     *
     */

    public function arbitraryInstalling()
    {
        // add entries for lang data updates
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }
        $this->generateFaviconData();
        $this->addDemoContent();
    }

    public function arbitraryLangInstall($langs_ids)
    {
        // admin_home_page
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $langs_file = $this->ci->Install_model->language_file_read('start', 'admin_home_page', $langs_ids);

        foreach ($langs_file as $gid => $ldata) {
            if (!empty($ldata)) {
                $this->ci->pg_language->pages->set_string_langs('admin_home_page', $gid, $ldata, array_keys($ldata));
            }
        }

        //admin_instructions_page
        $langs_file = $this->ci->Install_model->language_file_read('start', 'admin_instructions_page', $langs_ids);

        foreach ($langs_file as $gid => $ldata) {
            if (!empty($ldata)) {
                $this->ci->pg_language->pages->set_string_langs('admin_instructions_page', $gid, $ldata, array_keys($ldata));
            }
        }

        $langs_file = $this->ci->Install_model->language_file_read("start", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty arbitrary langs data");

            return false;
        }

        $post_data = [
            "title"          => $langs_file["seo_tags_index_title"],
            "keyword"        => $langs_file["seo_tags_index_keyword"],
            "description"    => $langs_file["seo_tags_index_description"],
            "header"         => $langs_file["seo_tags_index_header"],
            "og_title"       => $langs_file["seo_tags_index_og_title"],
            "og_type"        => $langs_file["seo_tags_index_og_type"],
            "og_description" => $langs_file["seo_tags_index_og_description"],
            "url_template"   => "",
        ];
        $this->ci->pg_seo->set_settings("user", "", "", $post_data);

        $post_data = [
            "title"          => $langs_file["seo_tags_admin_title"],
            "keyword"        => $langs_file["seo_tags_admin_keyword"],
            "description"    => $langs_file["seo_tags_admin_description"],
            "header"         => $langs_file["seo_tags_admin_header"],
            "og_title"       => $langs_file["seo_tags_admin_og_title"],
            "og_type"        => $langs_file["seo_tags_admin_og_type"],
            "og_description" => $langs_file["seo_tags_admin_og_description"],
            "url_template"   => "",
        ];
        $this->ci->pg_seo->set_settings("admin", "", "", $post_data);
    }

    public function arbitraryLangExport($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $admin_home_page_return = [];

        // admin_home_page
        foreach ($langs_ids as $lang_id) {
            $mod_langs = $this->ci->pg_language->pages->return_module('admin_home_page', $lang_id);
            foreach ($mod_langs as $gid => $value) {
                $admin_home_page_return[$gid][$lang_id] = $value;
            }

            $mod_langs = $this->ci->pg_language->pages->return_module('admin_instructions_page', $lang_id);
            foreach ($mod_langs as $gid => $value) {
                $admin_instructions_page_return[$gid][$lang_id] = $value;
            }
        }

        // arbitrary
        $seo_page = $this->ci->pg_seo->get_settings("user", "", "", $langs_ids);
        $all_lang_ids = array_keys($this->ci->pg_language->languages);

        $prefix = 'seo_tags_index';
        foreach ($all_lang_ids as $lang_id) {
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

        $seo_page = $this->ci->pg_seo->get_settings("admin", "", "", $langs_ids);
        $prefix = 'seo_tags_admin';
        foreach ($all_lang_ids as $lang_id) {
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

        return ["admin_home_page" => $admin_home_page_return, "arbitrary" => $arbitrary_return, "admin_instructions_page" => $admin_instructions_page_return];
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_language->pages->delete_module('admin_home_page');
        $this->ci->pg_language->pages->delete_module('admin_instructions_page');
    }

    /*
     * Banners module methods
     *
     * @return void
     */
    public function installBanners()
    {
        // add banners module
        $this->ci->load->model('Start_model');
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->load->model('banners/models/Banner_place_model');

        $group_id = $this->ci->Banner_group_model->createUniqueGroup([
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'price'         => 1,
            'gid'           => 'start_groups',
            'name'          => 'Start pages'
        ]);

        $all_places = $this->ci->Banner_place_model->getAllPlaces();
        if ($all_places) {
            foreach ($all_places as $key => $value) {
                if ($value['keyword'] != 'bottom-banner') {
                    continue;
                }
                $this->ci->Banner_place_model->save_place_group($value['id'], $group_id);
            }
        }

        $this->ci->Banner_group_model->set_module("start", "Start_model", "bannerAvailablePages");
        $pages = $this->ci->Start_model->bannerAvailablePages();
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

    public function installBannersLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $langs_file = $this->ci->Install_model->language_file_read('start', 'banners', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty banners langs data');

            return false;
        }
        $this->ci->load->model('banners/models/Banner_group_model');

        $banners_groups[] = 'banners_group_contact_groups';
        $banners_groups[] = 'banners_group_content_groups';
        $banners_groups[] = 'banners_group_users_groups';
        $banners_groups[] = 'banners_group_start_groups';

        $this->ci->Banner_group_model->update_langs($banners_groups, $langs_file, $langs_ids);

        return true;
    }

    public function installBannersLangExport($langs_ids)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('banners/models/Banner_group_model');
        $banners_groups[] = 'banners_group_contact_groups';
        $banners_groups[] = 'banners_group_content_groups';
        $banners_groups[] = 'banners_group_users_groups';
        $banners_groups[] = 'banners_group_start_groups';
        $langs = $this->ci->Banner_group_model->export_langs($banners_groups, $langs_ids);

        return ['banners' => $langs];
    }

    public function deinstallBanners()
    {
        // delete banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->delete_module("start");
    }

    /**
     * Install cronjob data
     *
     * @return void
     */
    public function installCronjob()
    {
    }

    /**
     * Uninstall cronjob data
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $this->ci->Cronjob_model->deleteCronByParam([
            'where' => ['module' => 'start']
        ]);
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
            '_get_settings_form' => 'getSettingsForm',
            '_save_settings_form' => 'saveSettingsForm',
            '_validate_settings_form' => 'validateSettingsForm',
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

    /**
     * Install demo content
     *
     * @return void
     */
    public function addDemoContent()
    {
        $languages = $this->ci->pg_language->languages;
        $demo_content = include MODULEPATH . 'start/install/demo_content.php';

        // Associating languages id with codes
        foreach ($languages as $l) {
            $lang[$l['code']] = $l['id'];
            if (!empty($l['is_default'])) {
                $default_lang = $l;
            }
        }
        foreach ($demo_content['copyright'] as $gid => $cr_data) {
            foreach ($cr_data['value'] as $key_l => $name_l) {
                if (isset($lang[$key_l])) {
                    if (!empty($name_l)) {
                        $data[$gid . '_' . $lang[$key_l]] = $name_l;
                    }
                } else {
                    $data[$gid . '_' . $lang[$key_l]] = $demo_content['copyright'][$gid]['value'][$default_lang['code']];
                }
            }
        }
        $this->ci->load->model("start/models/Start_Copyright_model");
        $validate_data = $this->ci->Start_Copyright_model->validateCopyright(['lang_id' => $default_lang['id'], 'data' => $data]);

        if (empty($validate_data['errors'])) {
            $this->ci->Start_Copyright_model->saveCopyright($validate_data['data']);
        }

        return true;
    }

    public function generateFaviconData()
    {
        $favicon_path = SITE_PHYSICAL_PATH . APPLICATION_FOLDER . 'views/';
        $favicon_url = SITE_VIRTUAL_PATH .  APPLICATION_FOLDER . 'views/';
        $files = [
            [
                'path'    => $favicon_path . 'flatty/img/favicon/manifest.json',
                'replace' => [
                    '[favicon_url]' => $favicon_url . 'flatty/img/favicon/'
                ],
            ],
            [
                'path'    => $favicon_path . 'flatty/img/favicon/browserconfig.xml',
                'replace' => [
                    '[favicon_url]' => $favicon_url . 'flatty/img/favicon/'
                ],
            ],
            [
                'path'    => $favicon_path . 'gentelella/img/favicon/manifest.json',
                'replace' => [
                    '[favicon_url]' => $favicon_url . 'gentelella/img/favicon/'
                ],
            ],
            [
                'path'    => $favicon_path . 'gentelella/img/favicon/browserconfig.xml',
                'replace' => [
                    '[favicon_url]' => $favicon_url . 'gentelella/img/favicon/'
                ],
            ]
        ];
        foreach ($files as $file) {
            $file_contents = file_get_contents($file['path']);
            if ($file_contents) {
                $file_contents = str_replace(array_keys($file['replace']), array_values($file['replace']), $file_contents);
                file_put_contents($file['path'], $file_contents);
            }
        }
    }
}
