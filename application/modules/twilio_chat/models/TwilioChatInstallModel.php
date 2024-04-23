<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models;

use Pg\Libraries\Setup;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioChatInstallModel extends \Model
{


    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Module data twilio chat object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->access_permissions = Setup::getModuleData(
            TwilioChatModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
        $this->modules_data = Setup::getModuleData(
            TwilioChatModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
    }

    /**
     * Install menu data
     */
    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->modules_data['menu'][$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items(
                $this->modules_data['menu'],
                'create',
                $gid,
                0,
                $this->modules_data['menu'][$gid]["items"]
            );
        }
    }

    /**
     * Install menu languages
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model('InstallModel');
        $langs_file = $this->ci->InstallModel->language_file_read(TwilioChatModel::MODULE_GID, 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items(
                $this->modules_data['menu'],
                'update',
                $gid,
                0,
                $this->modules_data['menu'][$gid]['items'],
                $gid,
                $langs_file
            );
        }

        return true;
    }

    /**
     * Export menu languages
     */
    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp = linked_install_process_menu_items(
                $this->modules_data['menu'],
                'export',
                $gid,
                0,
                $this->modules_data['menu'][$gid]['items'],
                $gid,
                $langs_ids
            );
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    /**
     * Uninstall menu languages
     */
    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->modules_data['menu'][$gid]['items']);
            }
        }
    }

    /**
     * Moderators module methods
     */
    public function installModerators()
    {
        $this->ci->load->model('ModeratorsModel');

        foreach ($this->modules_data['moderators'] as $method) {
            $this->ci->ModeratorsModel->saveMethod(null, $method);
        }
    }

    /**
     * Install moderators languages
     * @param null $langs_ids
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read(
            TwilioChatModel::MODULE_GID,
            'moderators',
            $langs_ids
        );

        $this->ci->load->model('ModeratorsModel');
        $methods = $this->ci->ModeratorsModel->getMethodsLangExport(
            [
                'where' => ['module' => TwilioChatModel::MODULE_GID]
            ]
        );

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->ModeratorsModel->saveMethod($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    /**
     * Export moderators languages
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('ModeratorsModel');
        $methods = $this->ci->ModeratorsModel->getMethodsLangExport(
            [
                'where' => ['module' => TwilioChatModel::MODULE_GID]
            ],
            $langs_ids
        );
        $return = [];
        if (!empty($methods)) {
            foreach ($methods as $method) {
                $return[$method['method']] = $method['langs'];
            }
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators methods
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('ModeratorsModel');
        $params['where']['module'] = TwilioChatModel::MODULE_GID;
        $this->ci->ModeratorsModel->deleteDethods(
            [
                'where' => ['module' => TwilioChatModel::MODULE_GID]
            ]
        );
    }


    /**
     * Install module data
     * add entries for lang data updates
     * @return void
     */
    public function arbitraryInstalling()
    {
        foreach ($this->modules_data['lang_dm_data'] as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }
    }

    /**
     * Uninstall module data
     * delete entries in dedicate modules
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        foreach ($this->modules_data['lang_dm_data'] as $lang_dm_data) {
            if (empty($lang_dm_data)) {
                continue;
            }
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
        }
    }

    protected function installAccessPermissions()
    {
        if (!empty($this->access_permissions)) {
            $this->ci->load->model('access_permissions/models/AccessPermissionsModulesModel');
            foreach ($this->access_permissions as $value) {
                if (isset($value['data'])) {
                    $value['data'] = serialize($value['data']);
                }
                $value['methods'] = (!empty($value['methods'])) ? serialize($value['methods']) : null;
                $value['not_methods'] = (!empty($value['not_methods'])) ? serialize($value['not_methods']) : null;
                $this->ci->AccessPermissionsModulesModel->saveModules($value);
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
        if (!empty($this->access_permissions)) {
            $this->ci->load->model('access_permissions/models/AccessPermissionsModulesModel');
            foreach ($this->access_permissions as $value) {
                $this->ci->AccessPermissionsModulesModel->deleteModule($value['module_gid']);
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
