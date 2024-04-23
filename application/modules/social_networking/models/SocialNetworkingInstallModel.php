<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models;

/**
 * Social networking install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SocialNetworkingInstallModel extends \Model
{
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'system-items' => [
                            'action' => 'none',
                            'items'  => [
                                'social_networking_menu_item' => ['action' => 'create', 'link' => 'admin/social_networking/services/', 'status' => 1, 'sorter' => 1],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_social_networking_menu' => [
            'action' => 'create',
            'name'   => 'Services section menu',
            'items'  => [
                'sn_services_item' => ['action' => 'create', 'link' => 'admin/social_networking/services/', 'status' => 1],
                'sn_pages_item'    => ['action' => 'create', 'link' => 'admin/social_networking/pages/', 'status' => 1],
            ],
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // load langs
        $this->ci->load->model('Install_model');
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
        $langs_file = $this->ci->Install_model->language_file_read('social_networking', 'menu', $langs_ids);

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

    private function addServices()
    {
        $this->ci->load->model('social_networking/models/Social_networking_services_model');
        $serivces = include MODULEPATH . 'social_networking/install/services_data.php';
        
        if ($serivces) {
            foreach ($serivces as $service) {
                if (TRIAL_MODE) {
                    $service['status'] = 1;
                    $service['oauth_status'] = 1;
                }
                $this->ci->Social_networking_services_model->save_service(null, $service);
            }
        }
    }

    public function arbitraryInstalling()
    {
        $this->addServices();

        // add social netorking page
        /*
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $page_data = array(
            'controller' => 'start',
            'method'     => 'index',
            'name'       => 'Index page',
        );
        $this->ci->Social_networking_pages_model->save_page(null, $page_data);
        */
    }

    public function arbitraryDeinstalling()
    {
    }

    public function arbitraryLangInstall($langs_ids)
    {
    }

    public function arbitraryLangExport($langs_ids = null)
    {
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
