<?php

declare(strict_types=1);

namespace Pg\modules\kisses\models;

use Pg\Libraries\Setup;

/**
 * Kisses install model
 *
 * @package PG_DatingPro
 * @subpackage Kisses
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class KissesInstallModel extends \Model
{


    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Menu configuration
     */
    protected $menu = [
        'user_top_menu' => [
            'action' => 'none',
            'name'   => 'Kisses section menu',
            'items'  => [
                'user-menu-activities' => [
                    'action' => 'none',
                    'items'  => [
                        'kisses_item' => ['action' => 'create', 'link' => 'kisses/index', 'status' => 1, 'sorter' => 10],
                    ],
                ],
            ],
        ],

        'admin_menu' => [
            'action' => 'none',
            'name'   => 'Kisses section menu',
            'items'  => [
                'content_items' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        "add_ons_items" => [
                            "action" => "none",
                            'name'   => '',
                            "items"  => [
                                "kisses_menu_item" => ["action" => "create", "link" => "admin/kisses", "status" => 1, "sorter" => 4],
                            ],
                        ],
                    ],
                ],
            ],
        ],

        'admin_kisses_menu' => [
            'action' => 'create',
            'name'   => 'Kisses section menu',
            'items'  => [
                'kisses_list_item' => ['action' => 'create', 'link' => 'admin/kisses/', 'status' => 1],
                'kisses_settings'  => ['action' => 'create', 'link' => 'admin/kisses/settings', 'status' => 1],
            ],
        ],

        'user_alerts_menu' => [
            'action' => 'none',
            'items'  => [
                'kisses_new_item' => [
                    'action' => 'create',
                    'link'   => 'users/get_new_kisses',
                    'icon'   => 'smile-o',
                    'status' => 1,
                    'sorter' => 6,
                ],
            ],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @params
     */
    protected $moderators = [
        ['module' => 'kisses', 'method' => 'index', 'is_default' => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module"        => "kisses",
            "model"         => "Kisses_model",
            "method_add"    => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ],
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
                KissesModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
    }

    /**
     * Install menu data
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
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('kisses', 'menu', $langs_ids);

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
     * Export menu languages
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
     * Uninstall menu languages
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
     * Moderators module methods
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
     * Install moderators languages
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('kisses', 'moderators', $langs_ids);

        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'kisses';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    /**
     * Export moderators languages
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'kisses';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators methods
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'kisses';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install uploads config kisses
     *
     * @return void
     */
    public function installUploads()
    {
        // upload config
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid'          => 'kisses-file',
            'name'         => 'Kisses icon',
            'max_height'   => 2500,
            'max_width'    => 2500,
            'max_size'     => 1024000, //1000 kb
            'name_format'  => 'generate',
            'file_formats' => ['jpg', 'jpeg', 'gif', 'png', 'webp'],
            'default_img'  => '',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $config_data['file_formats'] = serialize($config_data['file_formats']);
        $config_id = $this->ci->Uploads_config_model->save_config(null, $config_data);

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'kisses',
            'width'        => 32,
            'height'       => 32,
            'effect'       => 'none',
            'watermark_id' => 0,
            'crop_param'   => 'crop',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);
    }

    /**
     * De-install uploads config kisses
     *
     * @return void
     */
    public function deinstallUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = $this->ci->Uploads_config_model->get_config_by_gid('kisses-file');
        if (!empty($config_data['id'])) {
            $this->ci->Uploads_config_model->delete_config($config_data['id']);
        }
    }

    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("Kisses_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Kisses_model->lang_dedicate_module_callback_add($lang_id);
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
        $this->addDemoContent();
        return;
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

    /**
     * Install demo kisses
     *
     * @return void
     */
    public function addDemoContent()
    {
        $demo_content = include MODULEPATH . 'kisses/install/demo_content.php';

        $this->ci->load->model('Kisses_model');
        foreach ($demo_content['kisses'] as $kisses) {
            $this->ci->Kisses_model->save(null, $kisses);
        }

        return true;
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
