<?php

declare(strict_types=1);

namespace Pg\modules\menu\models;

/**
 * Menu install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class MenuInstallModel extends \Model
{
    protected $menu = [
        // admin menu
        'admin_menu' => [
            "action" => "none",
            "items"  => [
                'interface-items' => [
                    "action" => "none",
                    "items"  => [
                        'admin-menus-item' => ["action" => "create", 'link' => 'admin/menu', 'icon' => '', 'status' => 1, 'sorter' => 4],
                    ],
                ],
            ],
        ],
    ];
    protected $moderators_methods = [
        ["module" => 'menu', 'method' => 'index', 'is_default' => 1, 'group_id' => 2, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');
    }

    /*
     * Moderators module methods
     *
     * @return void
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model("moderators/models/Moderators_model");

        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('menu', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model("moderators/models/Moderators_model");
        $params['where']['module'] = 'menu';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method["id"], [], $langs_file[$method['method']]);
            }
        }
    }

    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model("moderators/models/Moderators_model");
        $params['where']['module'] = 'menu';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model("moderators/models/Moderators_model");
        $params['where']['module'] = 'menu';
        $this->ci->Moderators_model->delete_methods($params);
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
        $langs_file = $this->ci->Install_model->language_file_read('menu', 'menu', $langs_ids);

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

    public function arbitraryInstalling()
    {
        $lang_dm_data = [
            'module'        => 'menu',
            'model'         => 'Indicators_model',
            'method_add'    => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        $this->ci->load->model("menu/models/Indicators_model");
        foreach ($this->ci->pg_language->languages as $value) {
            $this->ci->Indicators_model->lang_dedicate_module_callback_add($value['id']);
        }

        return;
    }

    public function arbitraryDeinstalling()
    {
        $lang_dm_data['where'] = [
            'module' => 'menu',
            'model'  => 'Indicators_model',
        ];
        $this->ci->pg_language->delete_dedicate_modules_entry($lang_dm_data);
    }

    public function installCronjob()
    {
        // Remove old indicators
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            'name'     => 'Remove old menu indicators',
            'module'   => 'menu',
            'model'    => 'Indicators_model',
            'method'   => 'delete_old',
            'cron_tab' => '11 12 */3 * *',
            'status'   => '0',
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data['where']['module'] = 'menu';
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
