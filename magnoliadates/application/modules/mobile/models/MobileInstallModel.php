<?php

declare(strict_types=1);

namespace Pg\modules\mobile\models;

use Pg\Libraries\Setup;

/**
 * Mobile install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class MobileInstallModel extends \Model
{
    /**
     * Module data
     *
     * @var array
     */
    protected $modules_data = [];

    /**
     * MobileInstallModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(MobileModel::MODULE_GID, Setup::TYPE_MODULES_DATA);
    }

    /**
     * Set path mobile version
     *
     * @return void
     */
    protected function setPaths()
    {
        $mobile_path = SITE_PHYSICAL_PATH . 'm/';
        $files = [
            [
                'path'    => $mobile_path . 'index.html',
                'replace' => [
                    '[m_subfolder]' => '/' . SITE_SUBFOLDER . 'm',
                    '[favicon_folder]' => '/' . SITE_SUBFOLDER . 'm'
                ],
            ],
            [
                'path'    => $mobile_path . 'scripts/app.js',
                'replace' => [
                    '[api_virtual_path]' => preg_replace('#https?:#', '', SITE_VIRTUAL_PATH) . 'api',
                ],
            ],
            [
                'path'    => $mobile_path . 'images/favicon/manifest.json',
                'replace' => [
                    '[favicon_url]' => SITE_VIRTUAL_PATH,
                ],
            ],
            [
                'path'    => $mobile_path . 'images/favicon/browserconfig.xml',
                'replace' => [
                    '[favicon_url]' => SITE_VIRTUAL_PATH,
                ],
            ],
        ];
        foreach ($files as $file) {
            $file_contents = file_get_contents($file['path']);
            if ($file_contents) {
                $file_contents = str_replace(array_keys($file['replace']), array_values($file['replace']), $file_contents);
                file_put_contents($file['path'], $file_contents);
            }
        }
    }

    /**
     * Arbitrary Installing
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        //$this->setPaths();
    }

    /**
     * Arbitrary Lang Install
     *
     * @param array $langs_ids
     *
     * @return bool
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('mobile', 'mobile_app', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty mobile app langs data');

            return false;
        }

        foreach ($langs_file as $gid => $ldata) {
            if (!empty($ldata)) {
                $this->ci->pg_language->pages->set_string_langs('mobile_app', $gid, $ldata, array_keys($ldata));
            }
        }
    }

    /**
     * Arbitrary Lang Export
     *
     * @param array $langs_ids
     *
     * @return array
     */
    public function arbitraryLangExport($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('mobile', 'mobile_app', $langs_ids);

        $gids = [];
        foreach ($langs_file as $key => $lang) {
            $gids[] = $key;
        }

        $return = $this->ci->pg_language->export_langs('mobile_app', $gids, $langs_ids);

        return ['mobile_app' => $return];
    }

    /**
     * Install menu data
     *
     * @return void
     */
    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $name = !empty($menu_data["name"]) ? $menu_data["name"] : '';
            $this->modules_data['menu'][$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->modules_data['menu'], 'create', $gid, 0, $this->modules_data['menu'][$gid]["items"]);
        }
    }

    /**
     * Install menu languages
     *
     * @return bool
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read(MobileModel::MODULE_GID, 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items($this->modules_data['menu'], 'update', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_file);
        }

        return true;
    }

    /**
     * Export menu languages
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->modules_data['menu'], 'export', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    /**
     * Uninstall menu languages
     *
     * @return void
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
     * Install moderators links
     *
     * @return void
     */
    public function installModerators()
    {
        //install moderators permissions
        $this->ci->load->model("Moderators_model");
        foreach ((array) $this->modules_data['moderators_methods'] as $method_data) {
            $validate_data = ["errors" => [], "data" => $method_data];
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Moderators_model->save_method(null, $validate_data["data"]);
        }
    }

    /**
     * Install Moderators Lang Update
     *
     * @param array $langs_ids
     *
     * @return bool
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("mobile", "moderators", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty moderators langs data");

            return false;
        }
        // install moderators permissions
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "mobile";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method["method"]])) {
                $this->ci->Moderators_model->save_method($method["id"], [], $langs_file[$method["method"]]);
            }
        }
    }

    /**
     * Install Moderators Lang Export
     *
     * @param array $langs_ids
     *
     * @return array
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "mobile";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method["method"]] = $method["langs"];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators links
     *
     * @return void
     */
    public function deinstallModerators()
    {
        $this->ci->load->model("Moderators_model");
        $params = [];
        $params["where"]["module"] = "mobile";
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install Cron job
     *
     * @return void
     */
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ($this->modules_data['cron_jobs'] as $cron) {
            $this->ci->Cronjob_model->saveCron(null, $cron);
        }
    }

    /**
     * Deinstall Cron job
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $this->ci->Cronjob_model->deleteCronByParam([
            'where' => [
                'module' => 'mobile'
            ]
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
