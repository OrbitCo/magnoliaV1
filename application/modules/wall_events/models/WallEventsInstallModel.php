<?php

declare(strict_types=1);

namespace Pg\modules\wall_events\models;

/**
 * Wall events install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WallEventsInstallModel extends \Model
{
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        'system-items' => [
                            'action' => 'none',
                            'name'   => '',
                            'items'  => [
                                "add_ons_items" => [
                                    "action" => "none",
                                    'name'   => '',
                                    "items"  => [
                                        "wall_events_menu_item" => ["action" => "create", "link" => "admin/wall_events", "status" => 1, "sorter" => 4],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_wall_events_menu' => [
            'action' => 'create',
            'name'   => 'Wall events menu',
            'items'  => [
                'wall_events_list_item' => ['action' => 'create', 'link' => 'admin/wall_events/', 'status' => 1, "sorter" => 1],
                'wall_events_settings'  => ['action' => 'create', 'link' => 'admin/wall_events/settings', 'status' => 1, "sorter" => 2],
            ],
        ],
    ];
    private $moderation_types = [
        [
            "name"                 => "wall_events",
            "mtype"                => "-1",
            "module"               => "wall_events",
            "model"                => "Wall_events_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * Spam configuration
     *
     * @var array
     */
    private $spam = [
        ["gid" => "wall_events_object", "form_type" => "select_text", "send_mail" => true, "status" => true, "module" => "wall_events", "model" => "Wall_events_model", "callback" => "spam_callback"],
    ];

    /**
     * Check system requirements of module
     */
    public function validateRequirements()
    {
        $result = ["data" => [], "result" => true];

        // check for Mbstring
        $good = function_exists("mb_substr");
        $result["data"][] = [
            "name"   => "Mbstring extension (required for feeds parsing) is installed",
            "value"  => $good ? "Yes" : "No",
            "result" => $good,
        ];
        $result["result"] = $result["result"] && $good;

        return $result;
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
        $langs_file = $this->ci->Install_model->language_file_read('wall_events', 'menu', $langs_ids);

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
        $this->ci->load->model('Wall_events_model');
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        $attrs = [
            'gid'                 => $this->ci->Wall_events_model->wall_event_gid,
            'status'              => '1',
            'module'              => 'wall_events',
            'model'               => 'wall_events_model',
            'method_format_event' => '_format_wall_events',
            'date_add'            => date("Y-m-d H:i:s"),
            'date_update'         => date("Y-m-d H:i:s"),
            'settings'            => [
                'join_period' => 0, // minutes, 0 = do not use
                'permissions' => [
                    'permissions' => 3, // permissions 0 - only for me, 1 - for me and friends, 2 - for registered, 3 - for all
                    'feed'        => 1, // show friends events in user feed
                    'post_allow'  => 1, // allow post on the wall for other users
                ],
            ],
        ];
        $this->ci->Wall_events_types_model->add_wall_events_type($attrs);

        return;
    }

    public function arbitraryDeinstalling()
    {
    }

    public function installComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $comment_type = [
            'gid'           => 'wall_events',
            'module'        => 'wall_events',
            'model'         => 'Wall_events_model',
            'method_count'  => 'comments_count_callback',
            'method_object' => 'comments_object_callback',
        ];
        $this->ci->Comments_types_model->add_comments_type($comment_type);
    }

    public function installCommentsLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('wall_events', 'comments', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->update_langs(['wall_events'], $langs_file);
    }

    public function installCommentsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('comments/models/Comments_types_model');

        return ['comments' => $this->ci->Comments_types_model->export_langs(['wall_events'], $langs_ids)];
    }

    public function deinstallComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->delete_comments_type('wall_events');
    }

    public function installUploads()
    {
        // upload config
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid'          => 'wall-image',
            'name'         => 'Wall image',
            'max_height'   => 2000,
            'max_width'    => 2000,
            'max_size'     => 10485760,
            'name_format'  => 'generate',
            'file_formats' => ['jpg', 'jpeg', 'gif', 'png', 'webp'],
            'default_img'  => '',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $config_data['file_formats'] = serialize($config_data['file_formats']);
        $config_id = $this->ci->Uploads_config_model->save_config(null, $config_data);
        //$wm_data = $this->ci->Uploads_config_model->get_watermark_by_gid('image-wm');
        $wm_id = 0;//isset($wm_data["id"]) ? $wm_data["id"] : 0;

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'grand',
            'width'        => 960,
            'height'       => 720,
            'effect'       => 'none',
            'watermark_id' => $wm_id,
            'crop_param'   => 'resize',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'big',
            'width'        => 200,
            'height'       => 200,
            'effect'       => 'none',
            'watermark_id' => $wm_id,
            'crop_param'   => 'crop',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'middle',
            'width'        => 100,
            'height'       => 100,
            'effect'       => 'none',
            'watermark_id' => 0,
            'crop_param'   => 'crop',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'small',
            'width'        => 60,
            'height'       => 60,
            'effect'       => 'none',
            'watermark_id' => 0,
            'crop_param'   => 'crop',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);
    }

    public function deinstallUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = $this->ci->Uploads_config_model->get_config_by_gid('wall-image');
        if (!empty($config_data['id'])) {
            $this->ci->Uploads_config_model->delete_config($config_data['id']);
        }
    }

    public function installVideoUploads()
    {
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');
        $config_data = [
            'gid'           => 'wall-video',
            'name'          => 'Wall video',
            'max_size'      => 104857600,
            'file_formats'  => 'a:5:{i:0;s:3:"avi";i:1;s:3:"flv";i:2;s:3:"mkv";i:3;s:3:"asf";i:4;s:4:"mpeg";}',
            'default_img'   => '',
            'date_add'      => date('Y-m-d H:i:s'),
            'upload_type'   => 'local',
            'use_convert'   => '1',
            'use_thumbs'    => '1',
            'module'        => 'wall_events',
            'model'         => 'Wall_events_model',
            'method_status' => 'video_callback',
            /* 'thumbs_settings' => 'a:3:{i:0;a:4:{s:3:"gid";s:5:"small";s:5:"width";i:100;s:6:"height";i:70;s:8:"animated";i:0;}i:1;a:4:{s:3:"gid";s:6:"middle";s:5:"width";i:200;s:6:"height";i:140;s:8:"animated";i:0;}i:2;a:4:{s:3:"gid";s:3:"big";s:5:"width";i:480;s:6:"height";i:360;s:8:"animated";i:0;}}', */
            'thumbs_settings'  => 'a:4:{i:0;a:4:{s:3:"gid";s:5:"small";s:5:"width";i:100;s:6:"height";i:70;s:8:"animated";i:0;}i:1;a:4:{s:3:"gid";s:6:"middle";s:5:"width";i:200;s:6:"height";i:140;s:8:"animated";i:0;}i:2;a:4:{s:3:"gid";s:3:"big";s:5:"width";i:480;s:6:"height";i:360;s:8:"animated";i:0;}i:3;a:4:{s:3:"gid";s:5:"grand";s:5:"width";i:960;s:6:"height";i:720;s:8:"animated";i:0;}}',
            'local_settings'   => 'a:6:{s:5:"width";i:480;s:6:"height";i:360;s:10:"audio_freq";s:5:"22050";s:11:"audio_brate";s:3:"64k";s:11:"video_brate";s:4:"300k";s:10:"video_rate";s:2:"50";}',
            'youtube_settings' => 'a:2:{s:5:"width";i:480;s:6:"height";i:360;}',
        ];
        $this->ci->Video_uploads_config_model->save_config(null, $config_data);
    }

    public function deinstallVideoUploads()
    {
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');
        $config_data = $this->ci->Video_uploads_config_model->get_config_by_gid('wall-video');
        if (!empty($config_data["id"])) {
            $this->ci->Video_uploads_config_model->delete_config($config_data["id"]);
        }
    }

    /**
     * Install spam links
     */
    public function installSpam()
    {
        // add spam type
        $this->ci->load->model("spam/models/Spam_type_model");

        foreach ((array) $this->spam as $spam_data) {
            $validate_data = $this->ci->Spam_type_model->validate_type(null, $spam_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Spam_type_model->save_type(null, $validate_data["data"]);
        }
    }

    /**
     * Import spam languages
     *
     * @param array $langs_ids
     */
    public function installSpamLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $this->ci->load->model("spam/models/Spam_type_model");

        $langs_file = $this->ci->Install_model->language_file_read("wall_events", "spam", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty spam langs data");

            return false;
        }

        $this->ci->Spam_type_model->update_langs($this->spam, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export spam languages
     *
     * @param array $langs_ids
     */
    public function installSpamLangExport($langs_ids = null)
    {
        $this->ci->load->model("spam/models/Spam_type_model");
        $langs = $this->ci->Spam_type_model->export_langs((array) $this->spam, $langs_ids);

        return ["spam" => $langs];
    }

    /**
     * Uninstall spam links
     */
    public function deinstallSpam()
    {
        //add spam type
        $this->ci->load->model("spam/models/Spam_type_model");

        foreach ((array) $this->spam as $spam_data) {
            $this->ci->Spam_type_model->delete_type($spam_data["gid"]);
        }
    }

    public function installModeration()
    {
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $mtype['date_add'] = date("Y-m-d H:i:s");
            $this->ci->Moderation_type_model->save_type(null, $mtype);
        }
    }

    public function installModerationLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('wall_events', 'moderation', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $this->ci->Moderation_type_model->update_langs($this->moderation_types, $langs_file);
    }

    public function installModerationLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');

        return ['moderation' => $this->ci->Moderation_type_model->export_langs($this->moderation_types, $langs_ids)];
    }

    public function deinstallModeration()
    {
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $type = $this->ci->Moderation_type_model->get_type_by_name($mtype["name"]);
            $this->ci->Moderation_type_model->delete_type($type['id']);
        }
    }

    public function installUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->addCallback('wall_events', 'Wall_events_model', 'callback_user_delete', '', 'wall_events');
        $this->ci->Users_blocked_callbacks_model->addCallback([
            'module' => 'wall_events',
            'model' => 'Wall_events_model',
            'callback' => 'callbackUserBLocked',
            'callback_gid' => 'wall_events'
        ]);
    }

    public function deinstallUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->deleteCallbacksByModule('wall_events');
        $this->ci->Users_blocked_callbacks_model->deleteCallbacksByModule('wall_events');
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
