<?php

declare(strict_types=1);

namespace Pg\modules\winks\models;

use Pg\Libraries\Setup;

/**
 * Winks install model.
 *
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WinksInstallModel extends \Model
{
    /**
     * Access permissions list.
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Menu configuration.
     */
    protected $menu = [
        'user_top_menu' => [
            'action' => 'none',
            'name' => 'Winks section menu',
            'items' => [
                'user-menu-activities' => [
                    'action' => 'none',
                    'items' => [
                        'winks_item' => ['action' => 'create', 'link' => 'winks/index', 'status' => 1, 'sorter' => 10],
                    ],
                ],
            ],
        ],
        'user_alerts_menu' => [
            'action' => 'none',
            'items' => [
                'winks_new_item' => [
                    'action' => 'create',
                    'link' => 'winks/get_winks_count',
                    'icon' => 'eye',
                    'status' => 1,
                    'sorter' => 4,
                ],
            ],
        ],
    ];

    /**
     * Moderators configuration.
     *
     * @params
     */
    protected $moderators = [];

    private $seo_pages = [
        'index',
    ];

    /**
     * Constructor.
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->access_permissions = Setup::getModuleData(
                WinksModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
    }

    /**
     * Install menu data.
     */
    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data['name'])) {
                $name = $menu_data['name'];
            }
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data['action'], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]['items']);
        }
    }

    /**
     * Install menu languages.
     *
     * @param null $langs_ids
     *
     * @return bool
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('winks', 'menu', $langs_ids);

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

    /**
     * Export menu languages.
     * @param $langs_ids
     * @return array[]|bool
     */
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

    /**
     * Uninstall menu languages.
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
     * Moderators module methods.
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('Moderators_model');

        foreach ($this->moderators as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    /**
     * Install moderators languages.
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('winks', 'moderators', $langs_ids);

        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'winks';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    /**
     * Export moderators languages.
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'winks';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators methods.
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'winks';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install module data.
     */
    public function arbitraryInstalling()
    {
        $this->ci->pg_seo->set_seo_module('winks', [
            'module_gid' => 'winks',
            'model_name' => 'Winks_model',
            'get_settings_method' => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ]);
    }

    /**
     * Import module languages.
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('winks', 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty winks arbitrary langs data');

            return false;
        }
        foreach ($this->seo_pages as $page) {
            $post_data = [
                 'title' => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword' => isset($langs_file["seo_tags_{$page}_keyword"]) ? $langs_file["seo_tags_{$page}_keyword"] : null,
                'description' => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header' => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title' => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type' => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
                'priority' => 0.5,
            ];
            $this->ci->pg_seo->set_settings('user', 'winks', $page, $post_data);
        }
    }

    /**
     * Export module languages.
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
        $arbitrary_return = [];
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'winks');
        $lang_ids = array_keys($this->ci->pg_language->languages);
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_'.$seo_page['method'];
            foreach ($lang_ids as $lang_id) {
                $meta = 'meta_'.$lang_id;
                $og = 'og_'.$lang_id;
                $arbitrary_return[$prefix.'_title'][$lang_id] = $seo_page[$meta]['title'];
                $arbitrary_return[$prefix.'_keyword'][$lang_id] = $seo_page[$meta]['keyword'];
                $arbitrary_return[$prefix.'_description'][$lang_id] = $seo_page[$meta]['description'];
                $arbitrary_return[$prefix.'_header'][$lang_id] = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix.'_og_title'][$lang_id] = $seo_page[$og]['og_title'];
                $arbitrary_return[$prefix.'_og_type'][$lang_id] = $seo_page[$og]['og_type'];
                $arbitrary_return[$prefix.'_og_description'][$lang_id] = $seo_page[$og]['og_description'];
            }
        }

        return ['arbitrary' => $arbitrary_return];
    }

    /**
     * Uninstall module data.
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('winks');
    }

    /**
     * Install access permissions.
     *
     * @return void
     */
    protected function installAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            if (isset($value['data'])) {
                $value['data'] = serialize($value['data']);
            }
            $this->ci->Access_permissions_modules_model->saveModules($value);
        }
    }

    /**
     * Install access permissions.
     *
     * @return void
     */
    protected function deinstallAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
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
