<?php

declare(strict_types=1);

namespace Pg\modules\statistics\models;

use Pg\Libraries\Setup;

/**
 * Statistics module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Statistics install model
 *
 * @package     PG_Dating
 * @subpackage  Statistics
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StatisticsInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * "<menu_gid>" => array(
     *     "action" => "<create|none>",
     *     "name" => "<menu_name>",
     *     "items" => array(
     *         "<menu_item_gid>" => array(
     *         "action" => "<create|none>",
     *         "name" => "<menu_item_gid>",
     *         "items" => array(
     *             ...
     *         )
     *     )
     * )
     *
     * @var array
     */
    protected $menu = [/*
        'admin_menu' => array(
            'action' => 'none',
            'items'  => array(
                'settings_items' => array(
                    'action' => 'none',
                    'items'  => array(
                        'system-items' => array(
                            'action' => 'none',
                            'items'  => array(
                                'statistics_sett_menu_item' => array(
                                    'action' => 'create',
                                    'link' => 'admin/statistics/index',
                                    'status' => 1,
                                    'sorter' => 15,
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    */];

    /**
     * Cronjobs configuration
     *
     * @var array
     */
    private $cronjobs = [
        [
            "name"     => "Statistics handler",
            "module"   => StatisticsModel::MODULE_GID,
            "model"    => "Statistics_model",
            "method"   => "parseStatistics",
            "cron_tab" => "*/10 * * * *",
            "status"   => "1",
        ],
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module" => StatisticsModel::MODULE_GID,
            "model" => "Statistics_forge_model",
            "method_add" => "langDedicateModuleCallbackAdd",
            "method_delete" => "langDedicateModuleCallbackDelete",
        ],
    ];

    /**
     * Class constructor
     *
     * @return Memberships_Install
     */
    public function __construct()
    {
        parent::__construct();
        $this->demo_content = Setup::getModuleData(
               StatisticsModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
    }

    /**
     * Install data of cronjobs module
     *
     * @return void
     */
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ((array) $this->cronjobs as $cron_data) {
            $this->ci->Cronjob_model->saveCron(null, $cron_data);
        }
    }

    /**
     * Uninstall data of cronjobs module
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $this->ci->Cronjob_model->deleteCronByParam([
            'where' => ['module' => StatisticsModel::MODULE_GID]
        ]);
    }

    /**
     * Install menu data of statistics
     *
     * @return void
     */
    public function installMenu()
    {
        if (!$_ENV['DEMO_MODE']) {
            $this->ci->load->helper("menu");
            foreach ($this->menu as $gid => $menu_data) {
                $this->menu[$gid]["id"] = linked_install_set_menu($gid, $menu_data["action"], isset($menu_data["name"]) ? $menu_data["name"] : '');
                linked_install_process_menu_items($this->menu, "create", $gid, 0, $this->menu[$gid]["items"]);
            }
        }
    }

    /**
     * Import menu languages of statistics
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

        $langs_file = $this->ci->Install_model->language_file_read("statistics", "menu", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty menu langs data of statistics");

            return false;
        }

        $this->ci->load->helper("menu");

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items(
                $this->menu,
                "update",
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_file);
        }

        return true;
    }

    public function installMenu_lang_update($langs_ids = null)
    {
        return $this->installMenuLangUpdate($langs_ids);
    }

    /**
     * Export menu languages of statistics
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
            $return = array_merge($return, linked_install_process_menu_items(
                $this->menu,
                "export",
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_ids));
        }

        return ["menu" => $return];
    }

    public function installMenu_lang_export($langs_ids = null)
    {
        return $this->installMenuLangExport($langs_ids);
    }

    /**
     * Uninstall menu data of statistics
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

    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("statistics/models/Statistics_forge_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Statistics_forge_model->langDedicateModuleCallbackAdd($lang_id);
        }
    }

    /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {

        // add entries for lang data updates
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }

        $this->installDemoContent();
    }
    
    public function _arbitrary_installing()
    {
        return $this->arbitraryInstalling();
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("statistics", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty arbitrary langs data of statistics");

            return false;
        }

        // TODO:
    }
    
    public function _arbitrary_lang_update($langs_ids = null)
    {
        return $this->arbitraryLangUpdate($langs_ids);
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
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $arbitrary_return = [];

        // TODO:

        return ["arbitrary" => $arbitrary_return];
    }
    
    public function _arbitrary_lang_export($langs_ids = null)
    {
        return $this->arbitraryLangExport($langs_ids);
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {

        // delete entries in dedicate modules
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $params = ['where' => $lang_dm_data];
            $this->ci->pg_language->delete_dedicate_modules_entry($params);
        }

        $this->clearLogs();
        $this->dropSystems();
    }

    protected function clearLogs()
    {
        if (file_exists(TEMPPATH . 'logs/statistics')) {
            foreach (glob(TEMPPATH . 'logs/statistics/*') as $file) {
                unlink($file);
            }
        }
    }

    protected function dropSystems()
    {
        $path = MODULEPATH . 'statistics/models/systems/';
        if (!is_dir($path)) {
            return;
        }

        $allFiles = scandir($path);
        $files = array_diff($allFiles, ['.', '..']);
        foreach ($files as $file) {
            $result = explode('.', $file);
            if (!empty($result[1])) {
                $system_model = NS_MODULES . "statistics\\models\\systems\\" . $result[0];
                if (class_exists($system_model)) {
                    (new $system_model())->uninstallSystem();
                } else {
                     throw new \Exception($result[0]. " not found!");
                }
            }
        }
    }

    /**
     * Install demo content
     *
     * @return type
     */
    protected function installDemoContent()
    {
        if (!empty($this->demo_content)) {
            foreach ($this->demo_content as $gid => $content) {
                if ($this->ci->pg_module->is_module_installed($gid) || $gid == 'visits') {
                    $system_model_name = "statistics_" . $gid . "_model";
                    $this->ci->load->model("statistics/models/systems/" . $system_model_name);
                    $is_install = $this->ci->{$system_model_name}->installSystem();
                    if ($is_install === true && !empty($content)) {
                        $namespace = "Pg\\modules\\statistics\\models\\systems\\Statistics" . ucfirst($gid) . "Model";
                        foreach ($content as $data) {
                            $sql = $this->ci->db->insert_string(DB_PREFIX . $namespace::MODULE_TABLE, $data);
                            $this->ci->db->query($sql);
                        }
                    }
                }
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
