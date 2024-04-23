<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\models;

use Pg\Libraries\Setup;

/**
 * Perfect_match install model
 *
 * @package     PG_Dating
 * @subpackage  Perfect_match
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PerfectMatchInstallModel extends \Model
{


    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;


    /**
     *Modules data
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Menu configuration
     *
     * @var array
     */
    private $menu = [
        'user_top_menu' => [
            'action' => 'none',
            'name'   => 'Perfect match',
            'items'  => [
                'user-menu-people' => [
                    'action' => 'none',
                    'items'  => [
                        'perfectmatch_item' => ['action' => 'create', 'link' => 'perfect_match/index', 'status' => 1, 'sorter' => 2],
                    ],
                ],
            ],
        ],
    ];

    protected $seo_pages = [
        'index',
        'search',
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
                PerfectMatchModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
        $this->modules_data = Setup::getModuleData(PerfectMatchModel::MODULE_GID, Setup::TYPE_MODULES_DATA);
    }

    /**
     * Install menu data of perfect_match
     *
     * @return void
     */
    public function installMenu()
    {
        $this->ci->load->helper("menu");
        foreach ($this->menu as $gid => $menu_data) {
            $this->menu[$gid]["id"] = linked_install_set_menu($gid, $menu_data["action"], isset($menu_data["name"]) ? $menu_data["name"] : '');
            linked_install_process_menu_items($this->menu, "create", $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    /**
     * Import menu languages of perfect_match
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
        $langs_file = $this->ci->Install_model->language_file_read("perfect_match", "menu", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty menu langs data");

            return false;
        }

        $this->ci->load->helper("menu");

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, "update", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
        }

        return true;
    }

    /**
     * Export menu languages of perfect_match
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
        $this->ci->load->helper("menu");

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, "export", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

    /**
     * Uninstall menu data of perfect_match
     *
     * @return void
     */
    public function deinstallMenu()
    {
        $this->ci->load->helper("menu");
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data["action"] == "create") {
                linked_install_set_menu($gid, "delete");
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]["items"]);
            }
        }
    }

    public function installFieldEditor()
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        include MODULEPATH . 'perfect_match/install/user_fields_data.php';
        $this->ci->Field_editor_model->import_type_structure($this->ci->Users_model->form_editor_type, $fe_sections, $fe_fields, $fe_forms);
    }

    public function installFieldEditorLangUpdate()
    {
        $langs_file = $this->ci->Install_model->language_file_read('perfect_match', 'field_editor');
        if (!$langs_file) {
            log_message('info', 'Empty field_editor langs data');

            return false;
        }
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        include MODULEPATH . 'perfect_match/install/user_fields_data.php';
        $this->ci->Field_editor_model->update_sections_langs($fe_sections, $langs_file);
        if (isset($fe_fields) && !empty($fe_fields)) {
            $this->ci->Field_editor_model->update_fields_langs($this->ci->Users_model->form_editor_type, $fe_fields, $langs_file);
        }

        return true;
    }

    public function installFieldEditorLangExport($langs_ids = null)
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        list($fe_sections, $fe_fields, $fe_forms) = $this->ci->Field_editor_model->export_type_structure($this->ci->Users_model->form_editor_type, 'application/modules/perfect_match/install/user_fields_data.php');
        $sections = $this->ci->Field_editor_model->export_sections_langs($fe_sections, $langs_ids);
        $fields = $this->ci->Field_editor_model->export_fields_langs($this->ci->Users_model->form_editor_type, $fe_fields, $langs_ids);

        return ['field_editor' => array_merge($sections, $fields)];
    }

    public function deinstallFieldEditor()
    {
        $this->ci->load->model('Field_editor_model');
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');

        include MODULEPATH . 'perfect_match/install/user_fields_data.php';

        foreach ($fe_fields as $field) {
            $this->ci->Field_editor_model->delete_field_by_gid($field['data']['gid']);
        }
        $this->ci->load->model('Users_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        foreach ($fe_sections as $section) {
            $this->ci->Field_editor_model->delete_section_by_gid($section['data']['gid']);
        }

        foreach ($fe_forms as $form) {
            $this->ci->Field_editor_forms_model->delete_form_by_gid($form['data']['gid']);
        }

        return;
    }

    public function installUsers()
    {
        $this->ci->load->model('users/models/Users_delete_callbacks_model');
        $this->ci->Users_delete_callbacks_model->addCallback('perfect_match', 'Perfect_match_model', 'callback_user_delete', '', 'perfect_match');

        // add fields
        $this->ci->load->model('Field_editor_model');
        $fields_list = $this->ci->Field_editor_model->getFieldsList();

        if (!empty($fields_list)) {
            foreach ($fields_list as $fields => $field) {
                $this->ci->Field_editor_model->pmFieldCreate(DB_PREFIX . 'perfect_match', 'looking_' . $field['field_name'], $field);
                $fields_arr[] = $this->ci->Field_editor_model->pmFieldCreate(DB_PREFIX . 'perfect_match', $field['field_name'], $field);
            }
            $this->ci->Field_editor_model->pmUpdateFields($fields_arr, DB_PREFIX . 'perfect_match');
        }

        $this->addDemoContent();
    }

    public function addDemoContent()
    {
        include MODULEPATH . 'perfect_match/install/demo_content.php';

        $this->ci->load->model('Users_model');
        foreach ($demo_users as $user) {
            $user_data = $this->ci->Users_model->getUserByLogin($user['nickname']);
            $user_id = array_intersect_key($user_data, ['id' => 0]);
            unset($user_data);
            $this->ci->Users_model->saveUser($user_id['id'], $user['data']);
        }

        $this->transferUserData();
    }

    /**
     * Data transfer from USERS_TABLE in PERFECT_MATCH_TABLE
     */
    public function transferUserData()
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Perfect_match_model');

        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_user_type`=`" . USERS_TABLE . "`.`looking_user_type`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_id_country`=`" . USERS_TABLE . "`.`id_country`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_id_region`=`" . USERS_TABLE . "`.`id_region`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_id_city`=`" . USERS_TABLE . "`.`id_city`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_lat`=`" . USERS_TABLE . "`.`lat`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`looking_lon`=`" . USERS_TABLE . "`.`lon`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`age_min`=`" . USERS_TABLE . "`.`age_min`");
        $this->ci->db->simple_query("UPDATE `" . PERFECT_MATCH_TABLE . "` INNER JOIN `" . USERS_TABLE . "` ON `" . USERS_TABLE . "`.`id` = `" . PERFECT_MATCH_TABLE . "`.`id_user` SET `" . PERFECT_MATCH_TABLE . "`.`age_max`=`" . USERS_TABLE . "`.`age_max`");
    }

    public function deinstallUsers()
    {
        $this->ci->load->model('users/models/Users_delete_callbacks_model');
        $this->ci->Users_delete_callbacks_model->delete_callbacks_by_module('perfect_match');
    }

    public function installBanners()
    {
        // add banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->set_module("perfect_match", "Perfect_match_model", "bannerAvailablePages");

        $this->addBanners();
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
            'gid'           => 'perfect_match_groups',
            'name'          => 'Perfect match pages',
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
        $this->ci->load->model("Perfect_match_model");
        $pages = $this->ci->Perfect_match_model->bannerAvailablePages();
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

        $banners_groups = ['banners_group_perfect_match_groups'];
        $langs_file = $this->ci->Install_model->language_file_read('perfect_match', 'pages', $langs_ids);
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->Banner_group_model->update_langs($banners_groups, $langs_file, $langs_ids);
    }

    public function deinstallBanners()
    {
        // delete banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->delete_module("perfect_match");
        $this->removeBanners();
    }

    public function removeBanners()
    {
        $this->ci->load->model('banners/models/Banner_group_model');
        $group_id = $this->ci->Banner_group_model->get_group_id_by_gid('perfect_match_groups');
        $this->ci->Banner_group_model->delete($group_id);
    }

    public function arbitraryInstalling()
    {
        // SEO
        $seo_data = [
            'module_gid'              => 'perfect_match',
            'model_name'              => 'Perfect_match_model',
            'get_settings_method'     => 'getSeoSettings',
            'get_rewrite_vars_method' => 'requestSeoRewrite',
            'get_sitemap_urls_method' => 'getSitemapXmlUrls',
        ];
        $this->ci->pg_seo->set_seo_module('perfect_match', $seo_data);
    }

    /**
     * Unistall data of users module
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module("perfect_match");
    }

    public function arbitraryLangInstall($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('perfect_match', 'arbitrary');
        if (!$langs_file) {
            log_message('info', 'Empty arbitrary langs data');

            return false;
        }
        foreach ($this->seo_pages as $page) {
            $post_data = [
                'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ?  $langs_file["seo_tags_{$page}_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
            ];
            $this->ci->pg_seo->set_settings('user', 'perfect_match', $page, $post_data);
        }
    }

    public function arbitraryLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        foreach ($this->seo_pages as $page) {
            $settings = $this->ci->pg_seo->get_settings("user", "perfect_match", $page, $langs_ids);
            $arbitrary_return["seo_tags_{$page}_title"] = !empty($settings["title"]) ? $settings["title"] : null;
            $arbitrary_return["seo_tags_{$page}_keyword"] = !empty($settings["keyword"]) ? $settings["keyword"] : null; 
            $arbitrary_return["seo_tags_{$page}_description"] = !empty($settings["description"]) ? $settings["description"] : null; 
            $arbitrary_return["seo_tags_{$page}_header"] = !empty($settings["header"]) ? $settings["header"] : null;  
            $arbitrary_return["seo_tags_{$page}_og_title"] = !empty($settings["og_title"]) ? $settings["og_title"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_type"] = !empty($settings["og_type"]) ? $settings["og_type"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_description"] = !empty($settings["og_description"]) ? $settings["og_description"] : null; 
        }

        return ['arbitrary' => $arbitrary_return];
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

    /**
     * Install mobile module
     *
     * @return void
     */
    protected function installMobile()
    {
        if (!empty($this->modules_data['push_notifications'])) {
            $this->ci->load->model("mobile/models/MobilePushNotificationsModel");
            $this->ci->MobilePushNotificationsModel->callbackAddPushNotifications($this->modules_data['push_notifications']);
        }
    }

    /**
     * Deinstall mobile module
     *
     * @return void
     */
    protected function deinstallMobile()
    {
        if (!empty($this->modules_data['push_notifications'])) {
            $this->ci->load->model("mobile/models/MobilePushNotificationsModel");
            foreach ($this->modules_data['push_notifications'] as $notification) {
                $gids[] = $notification['gid'];
            }
            $this->ci->MobilePushNotificationsModel->callbackDeletePushNotifications($gids);
        }
    }
    
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ($this->modules_data['cron_jobs'] as $cron) {
            $this->ci->Cronjob_model->save_cron(null, $cron);
        }
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data                    = [];
        $cron_data["where"]["module"] = "perfect_match";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
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
}
