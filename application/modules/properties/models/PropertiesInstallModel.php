<?php

declare(strict_types=1);

namespace Pg\modules\properties\models;

class PropertiesInstallModel extends \Model
{
    protected $menu = [
        // admin menu
        'admin_menu' => [
            'name'   => 'Admin area menu',
            "action" => "none",
            "items"  => [
                'content_items' => [
                    "action" => "none",
                    "items"  => [
                        // 'properties_items' => array("action" => "create", 'link' => 'admin/properties/property/user_type', 'status' => 1, 'sorter' => 3),
                        'properties_items' => ["action" => "create", 'link' => 'admin/properties', 'status' => 1, 'sorter' => 3],
                    ],
                ],
            ],
        ],
    ];
    protected $moderators_methods = [];

    /**
     * Menu module methods
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
        $langs_file = $this->ci->Install_model->language_file_read('properties', 'menu', $langs_ids);

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

    public function deinstallMenu()
    {
        $this->ci->load->model('Menu_model');
        $this->ci->load->helper('menu');
        linked_install_delete_menu_items($menu_gid, $items);
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data["action"] == "create") {
                linked_install_set_menu($gid, "delete");
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]["items"]);
            }
        }
    }

    /**
     * Moderators module methods
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
        $langs_file = $this->ci->Install_model->language_file_read('properties', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model("moderators/models/Moderators_model");
        $params['where']['module'] = 'properties';
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
        $params['where']['module'] = 'properties';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        $return = [];
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model("moderators/models/Moderators_model");
        $params['where']['module'] = 'properties';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /*
     * Arbitrary methods
     *
     */

    public function arbitraryInstalling()
    {
    }

    public function arbitraryLangInstall($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $this->ci->load->model("Install_model");
        $this->ci->load->model("Properties_model");

        // install properties
        $langs_file = $this->ci->Install_model->language_file_read('properties', 'demo', $langs_ids);

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        $module_gid = $this->ci->Properties_model->module_gid;
        $properties = $this->ci->Properties_model->properties;

        foreach ($properties as $ref_gid) {
            foreach ($langs_ids as $lang_id) {
                if (!empty($langs_file[$ref_gid][$lang_id])) {
                    $value = $langs_file[$ref_gid][$lang_id];
                } elseif (!empty($langs_file[$ref_gid][$default_lang_id])) {
                    $value = $langs_file[$ref_gid][$default_lang_id];
                } else {
                    $value = [];
                }
                if (!empty($value)) {
                    $this->ci->pg_language->ds->set_module_reference($module_gid, $ref_gid, $value, $lang_id);
                }
            }
        }
    }

    public function arbitraryLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $this->ci->load->model("Properties_model");
        $module_gid = $this->ci->Properties_model->module_gid;
        $properties = $this->ci->Properties_model->properties;
        $demo_return = [];

        // properties
        foreach ($langs_ids as $lang_id) {
            foreach ($properties as $ref_gid) {
                $demo_return[$ref_gid][$lang_id] = $this->ci->pg_language->ds->get_reference($module_gid, $ref_gid, $lang_id);
            }
        }

        return ["demo" => $demo_return];
    }

    public function arbitraryDeinstalling()
    {
        // delete entries in dedicate modules
        $this->ci->load->model("Install_model");
        $this->ci->Install_model->_language_deinstall('properties');
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
