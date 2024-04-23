<?php

declare(strict_types=1);

namespace Pg\modules\mail_list\models;

class MailListInstallModel extends \Model
{
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'content_items' => [
                            'action' => 'none',
                            'items'  => [
                                'mail_list_menu_item' => ['action' => 'create', 'link' => 'admin/mail_list/users', 'status' => 1, 'sorter' => 9],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_mail_list_menu' => [
            'action' => 'create',
            'name'   => 'Mailing lists section menu',
            'items'  => [
                'mail_list_users_item'   => ['action' => 'create', 'link' => 'admin/mail_list/users', 'status' => 1],
                'mail_list_filters_item' => ['action' => 'create', 'link' => 'admin/mail_list/filters', 'status' => 1],
            ],
        ],
    ];

    private $moderators_methods = [
        ['module' => 'mail_list', 'method' => 'users', 'is_default' => 1, 'group_id' => 3, 'is_hidden' => 0, 'parent_module' => '']
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

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            $name = !empty($menu_data["name"]) ? $menu_data["name"] : '';
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('mail_list', 'menu', $langs_ids);

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

        return ["menu" => $return];
    }

    /**
     * Moderators module methods
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');

        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('mail_list', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'mail_list';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'mail_list';
        $methods =  $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'mail_list';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function arbitraryInstalling()
    {
    }

    public function deinstall_menu()
    {
        $this->ci->load->model('Menu_model');

        $menu = $this->ci->Menu_model->get_menu_by_gid('admin_menu');
        $item = $this->ci->Menu_model->get_menu_item_by_gid('mail_list_menu_item', $menu['id']);
        $this->ci->Menu_model->delete_menu_item($item['id']);

        $menu = $this->ci->Menu_model->get_menu_by_gid('admin_mail_list_menu');
        $this->ci->Menu_model->delete_menu($menu['id']);
    }

    public function arbitraryDeinstalling()
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
