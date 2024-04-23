<?php

declare(strict_types=1);

namespace Pg\modules\video_uploads\models;

/**
 * Video uploads install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class VideoUploadsInstallModel extends \Model
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
                                'video_menu_item' => ['action' => 'create', 'link' => 'admin/video_uploads', 'status' => 1, 'sorter' => 3],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_video_menu' => [
            'action' => 'create',
            'name'   => 'Video uploads section menu',
            'items'  => [
                'configs_list_item'     => ['action' => 'create', 'link' => 'admin/video_uploads', 'status' => 1],
                'system_list_item'      => ['action' => 'create', 'link' => 'admin/video_uploads/system_settings', 'status' => 1],
                'youtube_settings_item' => ['action' => 'create', 'link' => 'admin/video_uploads/youtube_settings', 'status' => 1],
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
        $langs_file = $this->ci->Install_model->language_file_read('video_uploads', 'menu', $langs_ids);

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

    public function installVideoUploads()
    {
        //// reculc system settings
        $this->ci->load->model('video_uploads/models/Video_uploads_settings_model');
        $this->ci->Video_uploads_settings_model->reculc_settings();
        $this->ci->Video_uploads_settings_model->write_settings();

        if ((extension_loaded("fileinfo")) && function_exists('finfo_open')) {
            $this->ci->pg_module->set_module_config('video_uploads', 'use_fileinfo', true);
        }
    }

    public function installCronjob()
    {
        ///// add cronjob ()
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            "name"     => "Video processing",
            "module"   => "video_uploads",
            "model"    => "Video_uploads_process_model",
            "method"   => "cron_processing_method",
            "cron_tab" => "*/23 * * * *",
            "status"   => "1",
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);

        $cron_data = [
            "name"     => "Video image cropping",
            "module"   => "video_uploads",
            "model"    => "Video_uploads_process_model",
            "method"   => "cron_images_method",
            "cron_tab" => "*/23 * * * *",
            "status"   => "1",
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);

        $cron_data = [
            "name"     => "Video check youtube status",
            "module"   => "video_uploads",
            "model"    => "Video_uploads_process_model",
            "method"   => "cron_waiting_method",
            "cron_tab" => "*/23 * * * *",
            "status"   =>  ($_ENV['YOUTUBE_SETTINGS'] == 1) ?: 0,
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);
    }

    public function arbitraryInstalling()
    {
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data["where"]["module"] = "video_uploads";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
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
