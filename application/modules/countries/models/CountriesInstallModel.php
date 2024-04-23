<?php

declare(strict_types=1);

namespace Pg\modules\countries\models;

use Pg\Libraries\Setup;

/**
 * Countries install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class CountriesInstallModel extends \Model
{

    /**
     * Module data Countries object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators_methods = [
        ['module' => 'countries', 'method' => 'index', 'is_default' => 1, 'group_id' => 3, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(
            CountriesModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->modules_data['menu'][$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->modules_data['menu'], 'create', $gid, 0, $this->modules_data['menu'][$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('countries', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items($this->modules_data['menu'], 'update', $gid, 0, $this->modules_data['menu'][$gid]["items"], $gid, $langs_file);
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->modules_data['menu'], 'export', $gid, 0, $this->modules_data['menu'][$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

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
        $langs_file = $this->ci->Install_model->language_file_read('countries', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'countries';
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
        $params['where']['module'] = 'countries';
        $methods =  $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    /**
     * Install cronjob data
     *
     * @return void
     */
    public function installCronjob()
    {
        /*if (!empty($this->modules_data['cron_data'])) {
            $this->ci->load->model('Cronjob_model');
            foreach ($this->modules_data['cron_data'] as $cronjob) {
                $this->ci->Cronjob_model->saveCron(null, $cronjob);
            }
        }*/
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
            'where' => ['module' => CountriesModel::MODULE_GID]
        ]);
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
        $params['where']['module'] = 'countries';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function arbitraryInstalling()
    {
        // add entries for lang data updates
        $lang_dm_data = [
            'module'        => 'countries',
            'model'         => 'Countries_model',
            'method_add'    => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);

        $this->ci->load->model('Countries_model');
        foreach ($this->ci->pg_language->languages as $value) {
            $this->ci->Countries_model->lang_dedicate_module_callback_add($value['id']);
        }

        return;
    }

    public function arbitraryDeinstalling()
    {
        // delete entries in dedicate modules
        $lang_dm_data['where'] = [
            'module' => 'countries',
            'model'  => 'Countries_model',
        ];
        $this->ci->pg_language->delete_dedicate_modules_entry($lang_dm_data);
    }

    /**
     * Countries install form
     * @param bool $submit
     * @return mixed
     */
    public function getSettingsForm($submit = false)
    {
        if ($submit) {
            return false;
        }
        $this->ci->load->model('Countries_model');
        $countries_list = $this->ci->Countries_model->get_cache_countries();

        $filter_data = ['all' => count($countries_list)];

        $list = $this->ci->Countries_model->groupByName($countries_list);

        $this->view->assign('list', $list);
        $this->view->assign('filter_data', $filter_data);
        $this->view->setHeader(l('admin_header_install_countries_list', 'countries'));
        return  $this->ci->view->fetch('install_settings_form', 'admin', 'countries');
    }

    public function __call($name, $args)
    {
        $methods = [
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling'
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
