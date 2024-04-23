<?php

declare(strict_types=1);

namespace Pg\modules\file_uploads\models;

/**
 * File uploads install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FileUploadsInstallModel extends \Model
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
                                'file_uploads_menu_item' => ['action' => 'create', 'link' => 'admin/file_uploads', 'status' => 1, 'sorter' => 3],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

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
        $langs_file = $this->ci->Install_model->language_file_read('file_uploads', 'menu', $langs_ids);

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

    public function arbitraryInstalling()
    {
        if ((extension_loaded('fileinfo')) && function_exists('finfo_open')) {
            $this->ci->pg_module->set_module_config('file_uploads', 'use_fileinfo', true);
        }

        $this->installFileUploads();
    }

    public function arbitraryDeinstalling()
    {
        $this->deinstallFileUploads();
    }

    /**
     * Install data of file uploads module
     *
     * @return void
     */
    public function installFileUploads()
    {
        $this->ci->load->model('file_uploads/models/File_uploads_config_model');
        $file_formats =  [
            0 => 'swf',
        ];

        $config_data = [
            'gid'          => 'android-exchange',
            'name'         => 'Android file exchange',
            'max_size'     => 10485760,
            'name_format'  => 'generate',
            'file_formats' => serialize($file_formats),
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->File_uploads_config_model->save_config(null, $config_data);
    }

    /**
     * Uninstall data of file uploads module
     *
     * @return void
     */
    public function deinstallFileUploads()
    {
        $this->ci->load->model('file_uploads/models/File_uploads_config_model');
        $config_data = $this->ci->File_uploads_config_model->get_config_by_gid('android-exchange');
        if (!empty($config_data["id"])) {
            $this->ci->File_uploads_config_model->delete_config($config_data["id"]);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
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
