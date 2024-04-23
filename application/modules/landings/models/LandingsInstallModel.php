<?php

declare(strict_types=1);

namespace Pg\modules\landings\models;

class LandingsInstallModel extends \Model
{
    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'name' => 'Landings menu',
            'items' => [
                'content_items' => [
                    'action' => 'none',
                    'name' => '',
                    'items' => [
                        'add_ons_items' => [
                            'action' => 'none',
                            'items' => [
                                'landings_menu_item' => ['action' => 'create', 'link' => 'admin/landings/', 'status' => 1, 'sorter' => 9],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_landings_menu' => [
            'action' => 'create',
            'name' => 'Landings section menu',
            'items' => [
                'admin_landings_menu_item' => ['action' => 'create', 'link' => 'admin/landings/', 'status' => 1],
            ],
        ],
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            'module' => 'landings',
            'model' => 'Landings_model',
            'method_add' => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ],
    ];

    /**
     * Constructor
     *
     * @return landings_install_model
     */
    public function __construct()
    {
        parent::__construct();

        // load langs
        $this->ci->load->model('Install_model');
    }

    /**
     * Install data of menu module
     *
     * @return void
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
     * Install menu languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return bool
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('landings', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu,
                'update',
                $gid,
                0,
                $this->menu[$gid]['items'],
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
     * Export menu languages
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
            $temp = linked_install_process_menu_items($this->menu,
                'export',
                $gid,
                0,
                $this->menu[$gid]['items'],
                $gid,
                                                      $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function installMenu_lang_export($langs_ids = null)
    {
        return $this->installMenuLangExport($langs_ids);
    }

    /**
     * Uninstall menu languages
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

        return;
    }

    protected function installDemoContent()
    {
        $demo = include MODULEPATH . 'landings/install/demo_content.php';
        $this->ci->load->model('Landings_model');

        if (!empty($demo)) {
            if (isset($demo['trial_landings']) && !empty($demo['trial_landings']) && TRIAL_MODE) {
                foreach ($demo['trial_landings'] as $landing) {
                    $this->ci->Landings_model->saveLanding(null, $landing);
                }
            }
        }

        return;
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
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
        }
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
