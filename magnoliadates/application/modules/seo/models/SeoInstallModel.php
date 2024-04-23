<?php

declare(strict_types=1);

namespace Pg\modules\seo\models;

/**
 * Seo module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Seo install model
 *
 * @package     PG_Core
 * @subpackage  Seo
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SeoInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * @var array
     */
    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'name' => 'Admin menu',
            'items' => [
                'settings_items' => [
                    'action' => 'none',
                    'items' => [
                        'system-items' => [
                            'action' => 'none',
                            'items' => [
                                'seo_menu_item' => ['action' => 'create', 'link' => 'admin/seo', 'status' => 1, 'sorter' => 3],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_seo_menu' => [
            'action' => 'create',
            'name' => 'Admin mode - System - SEO settings',
            'items' => [
                'seo_default_list_item' => ['action' => 'create', 'link' => 'admin/seo/index', 'status' => 1],
            ],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators_methods = [
        ['module' => 'seo', 'method' => 'index', 'is_default' => 1, 'group_id' => 1, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Install data of menu module
     *
     * @var array
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
        $langs_file = $this->ci->Install_model->language_file_read('seo', 'menu', $langs_ids);

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
    
    public function installMenu_lang_update($langs_ids = null)
    {
        return $this->installMenuLangUpdate($langs_ids);
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

    public function installMenu_lang_export($langs_ids = null)
    {
        return $this->installMenuLangExport($langs_ids);
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
     * Install data of moderators module
     *
     * @return void
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('Moderators_model');

        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    /**
     * Import languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('seo', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'seo';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }

        return true;
    }

    public function installModerators_lang_update($langs_ids = null)
    {
        return $this->installModeratorsLangUpdate($langs_ids);
    }

    /**
     * Import languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'seo';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }
    
    public function installModerators_lang_export($langs_ids = null)
    {
        return $this->installModeratorsLangExport($langs_ids);
    }

    /**
     * Uninstall data of moderators module
     *
     * @return void
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'seo';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        // Update file config/langs_route.php
        $lang_dm_data = [
            'module' => 'seo',
            'model' => 'Seo_model',
            'method_add' => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);

        $this->ci->load->model('Seo_model');

        $this->ci->Seo_model->lang_dedicate_module_callback_add();
    }
    
    public function _arbitrary_installing()
    {
        return $this->arbitraryInstalling();
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        /// delete entries in dedicate modules
        $lang_dm_data['where'] = ['module' => 'seo', 'model' => 'Seo_model'];
        $this->ci->pg_language->delete_dedicate_modules_entry($lang_dm_data);
    }
    
    public function _arbitrary_deinstalling()
    {
        return $this->arbitraryDeinstalling();
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
