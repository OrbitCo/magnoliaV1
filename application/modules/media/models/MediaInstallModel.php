<?php

declare(strict_types=1);

namespace Pg\modules\media\models;

use Pg\Libraries\Setup;

/**
 * Media install model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: mchernov $
 */
class MediaInstallModel extends \Model
{
    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    protected $action_config = [
        'media_upload_image' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'all'],
            ],
        'media_upload_video' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'all'],
            ],
        'media_upload_audio' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'all'],
            ],
    ];

    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'system_items' => [
                    'action' => 'none',
                    'items'  => [
                        'media_menu_item' => [
                            'action' => 'create',
                            'link' => 'admin/media',
                            'icon' => 'picture-o',
                            'material_icon' => 'camera',
                            'status' => 1,
                            'sorter' => 2],
                    ],
                ],
            ],
        ],
        'media_menu_item' => [
            'action' => 'create',
            'name'   => 'Media section menu',
            'items'  => [
                'avatar_list_item'   => ['action' => 'create', 'link' => 'admin/media/index/avatar', 'status' => 1, 'sorter' => 1],
                'photo_list_item'    => ['action' => 'create', 'link' => 'admin/media/index', 'status' => 1, 'sorter' => 2],
                'video_list_item'    => ['action' => 'create', 'link' => 'admin/media/index/video', 'status' => 1, 'sorter' => 3],
                'album_list_item'    => ['action' => 'create', 'link' => 'admin/media/index/album', 'status' => 1, 'sorter' => 4],
                'common_albums_item' => ['action' => 'create', 'link' => 'admin/media/common_albums', 'status' => 1, 'sorter' => 5]
            ],
        ],
        'user_top_menu' => [
            'action' => 'none',
            'items'  => [
                'user-menu-activities' => [
                    'action' => 'none',
                    'items'  => [
                        'media_gallery_item' => ['action' => 'create', 'link' => 'media/all', 'status' => 1, 'sorter' => 10],
                    ],
                ],
            ],
        ],
        /*'user_footer_menu' => [
            'action' => 'none',
            'items'  => [
                'footer-menu-links-item' => [
                    'action' => 'none',
                    'items'  => [
                        'footer-menu-media_gallery-item' => ['action' => 'create', 'link' => 'media/all',  'status' => 1, 'sorter' => 2],
                    ],
                ],
            ],
        ],*/
    ];

    /**
     * Ratings configuration
     *
     * @var array
     */
    protected $ratings = [
        "ratings_fields" => [
            "rating_data"      => ["type" => "TEXT", "null" => true],
            "rating_count"     => ["type" => "smallint(5)", "null" => false],
            "rating_sorter"    => ["type" => "decimal(5,3)", "null" => false],
            "rating_value"     => ["type" => "decimal(5,3)", "null" => false],
            "rating_type"      => ["type" => "varchar(20)", "null" => false],
        ],

        "ratings" => [
            ["gid" => "media_object", "name" => "Ratings for media content", "rate_type" => "stars", "module" => "media", "model" => "media", "callback" => "callback_ratings"],
        ],

        "rate_types" => [
            "stars" => [
                "main" => [1, 2, 3, 4, 5],
                "dop1" => [1, 2, 3, 4, 5],
                "dop2" => [1, 2, 3, 4, 5],
            ],
            /*
            "hands" => array(
                "main" => array(1, 5),
                "dop1" => array(1, 5),
                "dop2" => array(1, 5),
            ),
            */
        ],
    ];

    protected $moderation_types = [
        [
            'name'                 => 'media_content',
            'mtype'                => '0',
            'module'               => 'media',
            'model'                => 'Media_model',
            'check_badwords'       => '1',
            'method_get_list'      => '_moder_get_list',
            'method_set_status'    => '_moder_set_status',
            'method_delete_object' => '',
            'method_mark_adult'    => '_moder_mark_adult',
            'allow_to_decline'     => '1',
            'template_list_row'    => 'moder_block',
        ],
    ];

    protected $wall_events = [
        'video_upload' => [
            'gid'      => 'video_upload',
            'settings' => [
                'join_period' => 10, // minutes, do not use
                'permissions' => [
                    'permissions' => 3, // permissions 0 - only for me, 1 - for me and friends, 2 - for registered, 3 - for all
                    'feed'        => 1, // show friends events in user feed
                ],
            ],
        ],
        'image_upload' => [
            'gid'      => 'image_upload',
            'settings' => [
                'join_period' => 10, // minutes, do not use
                'permissions' => [
                    'permissions' => 3, // permissions 0 - only for me, 1 - for me and friends, 2 - for registered, 3 - for all
                    'feed'        => 1, // show friends events in user feed
                ],
            ],
        ],
    ];

    protected $pages = ["index", "all", "photo", "video", "albums", "audio"];

    /**
     * Spam configuration
     *
     * @var array
     */
    protected $spam = [
        ["gid" => "media_object", "form_type" => "select_text", "send_mail" => true, "status" => true, "module" => "media", "model" => "Media_model", "callback" => "spam_callback"],
    ];

    /**
     * Aviary configuration
     *
     * @var array
     */
    protected $aviary = [
        [
            'module_gid' => 'media',
            'model_name' => 'Media_model',
            'method'     => 'save_aviary',
        ],
    ];

    /**
     * Indicators configuration
     *
     * @var
     */
    protected $menu_indicators = [
        [
            'gid'               => 'new_moderation_item',
            'delete_by_cron'    => false,
            'auth_type'         => 'admin',
        ],
    ];

    private $moderators_methods = [
        ['module' => 'media', 'method' => 'index', 'is_default' => 1, 'group_id' => 1, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * MediaInstallModel
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');

        $this->access_permissions = Setup::getModuleData(
            MediaModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
    }

    public function installBonuses()
    {
    }

    public function installBonusesLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("bonuses/models/Bonuses_util_model");
        $langs_file = $this->ci->Install_model->language_file_read("bonuses", "ds", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty bonuses langs data");

            return false;
        }
        $this->ci->Bonuses_util_model->update_langs($langs_file);
        $this->ci->load->model("bonuses/models/Bonuses_actions_config_model");
        $this->ci->Bonuses_actions_config_model->setActionsConfig($this->action_config);

        return true;
    }

    public function installBonusesLangExport()
    {
    }

    public function uninstallBonuses()
    {
    }

    public function installUploads()
    {
        // upload config
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid'          => 'gallery_image',
            'name'         => 'Gallery image',
            'max_height'   => 8000,
            'max_width'    => 8000,
            'max_size'     => 20971520,
            'name_format'  => 'generate',
            'file_formats' => serialize(['jpg', 'jpeg', 'gif', 'png', 'webp']),
            'default_img'  => 'default-gallery-image.png',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $config_id = $this->ci->Uploads_config_model->save_config(null, $config_data);
        //$wm_data = $this->ci->Uploads_config_model->get_watermark_by_gid('image-wm');
        //$wm_id = isset($wm_data["id"]) ? $wm_data["id"] : 0;
        $wm_id = 0;
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
            'prefix'       => 'great',
            'width'        => 305,
            'height'       => 305,
            'effect'       => 'none',
            'watermark_id' => $wm_id,
            'crop_param'   => 'crop',
            'crop_color'   => 'ffffff',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_thumb(null, $thumb_data);

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'hgreat',
            'width'        => 305,
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
            'prefix'       => 'vgreat',
            'width'        => 200,
            'height'       => 305,
            'effect'       => 'none',
            'watermark_id' => $wm_id,
            'crop_param'   => 'crop',
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
        $config_data = $this->ci->Uploads_config_model->get_config_by_gid('gallery_image');
        if (!empty($config_data['id'])) {
            $this->ci->Uploads_config_model->delete_config($config_data['id']);
        }
    }

    public function installComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $comment_type = [
            'gid'           => 'media',
            'module'        => 'media',
            'model'         => 'Media_model',
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
        $langs_file = $this->ci->Install_model->language_file_read('media', 'comments', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->update_langs(['media'], $langs_file);
    }

    public function installCommentsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('comments/models/Comments_types_model');

        return ['comments' => $this->ci->Comments_types_model->export_langs(['media'], $langs_ids)];
    }

    public function deinstallComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->delete_comments_type('media');
    }

    /**
     * Install users data to ratings module
     *
     * @return void
     */
    public function installRatings()
    {
        $this->ci->load->model("Media_model");

        // add ratings type
        $this->ci->load->model("ratings/models/Ratings_type_model");

        $this->ci->Media_model->install_ratings_fields((array) $this->ratings["ratings_fields"]);

        foreach ((array) $this->ratings["ratings"] as $rating_data) {
            $validate_data = $this->ci->Ratings_type_model->validate_type(null, $rating_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Ratings_type_model->save_type(null, $validate_data["data"]);
        }
    }

    /**
     * Import users languages to ratings module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installRatingsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("Ratings_model");

        $langs_file = $this->ci->Install_model->language_file_read("media", "ratings", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty ratings langs data");

            return false;
        }

        foreach ((array) $this->ratings["ratings"] as $rating_data) {
            $this->ci->Ratings_model->update_langs($rating_data, $langs_file, $langs_ids);
        }

        foreach ($langs_ids as $lang_id) {
            foreach ((array) $this->ratings["rate_types"] as $type_gid => $type_data) {
                $types_data = [];
                foreach ($type_data as $rate_type => $votes) {
                    $votes_data = [];
                    foreach ($votes as $vote) {
                        $votes_data[$vote] = isset($langs_file[$type_gid . '_' . $rate_type . "_votes_" . $vote][$lang_id]) ?
                            $langs_file[$type_gid . '_' . $rate_type . "_votes_" . $vote][$lang_id] : $vote;
                    }
                    $types_data[$rate_type] = [
                        "header" => $langs_file[$type_gid . '_' . $rate_type . "_header"][$lang_id],
                        "votes"  => $votes_data,
                    ];
                }
                $this->ci->Ratings_model->add_rate_type($type_gid, $types_data, $lang_id);
            }
        }

        return true;
    }

    /**
     * Export users languages from ratings module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installRatingsLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("Ratings_model");
        $langs = [];
        foreach ((array) $this->ratings["ratings"] as $rating_data) {
            $langs = array_merge($langs, $this->ci->Ratings_model->export_langs($rating_data['gid'], $langs_ids));
        }

        return ["ratings" => $langs];
    }

    /**
     * Uninstall users data of ratings module
     *
     * @return void
     */
    public function deinstallRatings()
    {
        $this->ci->load->model("Media_model");

        //add ratings type
        $this->ci->load->model("ratings/models/Ratings_type_model");

        foreach ((array) $this->ratings["ratings"] as $rating_data) {
            $this->ci->Ratings_type_model->delete_type($rating_data["gid"]);
        }

        $this->ci->Media_model->deinstall_ratings_fields(array_keys((array) $this->ratings["ratings_fields"]));
    }

    public function installVideoUploads()
    {
        ///// add video settings
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');
        $thums_settings = [
            ['gid' => 'small', 'width' => 60, 'height' => 60, 'animated' => 0],
            ['gid' => 'middle', 'width' => 100, 'height' => 100, 'animated' => 0],
            ['gid' => 'big', 'width' => 200, 'height' => 200, 'animated' => 0],
            ['gid' => 'great', 'width' => 305, 'height' => 305, 'animated' => 0],
            ['gid' => 'hgreat', 'width' => 305, 'height' => 200, 'animated' => 0],
            ['gid' => 'vgreat', 'width' => 200, 'height' => 305, 'animated' => 0],
            ['gid' => 'grand', 'width' => 740, 'height' => 500, 'animated' => 0],
        ];
        $local_settings = [
            'width'       => 0,
            'height'      => 0,
            'audio_freq'  => '22050',
            'audio_brate' => '64k',
            'video_brate' => '800k',
            'video_rate'  => '100',
        ];
        $file_formats = ['avi', 'flv', 'mkv', 'asf', 'mpeg', 'mpg', 'mov', 'mp4'];
        $config_data = [
            'gid'             => 'gallery_video',
            'name'            => 'Gallery video',
            'max_size'        => 1073741824,
            'file_formats'    => serialize($file_formats),
            'default_img'     => 'media-video-default.png',
            'date_add'        => date('Y-m-d H:i:s'),
            'upload_type'     => 'local',
            'use_convert'     => '1',
            'use_thumbs'      => '1',
            'module'          => 'media',
            'model'           => 'Media_model',
            'method_status'   => 'video_callback',
            'thumbs_settings' => serialize($thums_settings),
            'local_settings'  => serialize($local_settings),
        ];
        $this->ci->Video_uploads_config_model->save_config(null, $config_data);
    }

    public function deinstallVideoUploads()
    {
        ///// delete video settings
        $this->ci->load->model('video_uploads/models/Video_uploads_config_model');
        $config_data = $this->ci->Video_uploads_config_model->get_config_by_gid('gallery_video');
        if (!empty($config_data["id"])) {
            $this->ci->Video_uploads_config_model->delete_config($config_data["id"]);
        }
    }

    public function installAudioUploads()
    {
        $this->ci->load->model('audio_uploads/models/Audio_uploads_config_model');
        $config_data = [
                        [
                                'gid'           => 'gallery_audio',
                                'name'          => 'Gallery audio',
                                'max_size'      => 10485760,
                                'file_formats'  => 'a:2:{i:0;s:3:"mp3";i:1;s:3:"wav";}',
                                'upload_type'   => 'local',
                                'date_add'      => date('Y-m-d H:i:s'),
                                'module'        => 'wall_events',
                                'model'         => 'Wall_events_model',
                                'method_status' => 'audio_callback',
                        ],
                        [
                                'gid'           => 'wall-audio',
                                'name'          => 'Wall audio',
                                'max_size'      => 10485760,
                                'file_formats'  => 'a:2:{i:0;s:3:"mp3";i:1;s:3:"wav";}',
                                'upload_type'   => 'local',
                                'date_add'      => date('Y-m-d H:i:s'),
                                'module'        => 'wall_events',
                                'model'         => 'Wall_events_model',
                                'method_status' => 'audio_callback',
                        ],
                    ];
        $this->ci->Audio_uploads_config_model->save_config(null, $config_data);
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
        $langs_file = $this->ci->Install_model->language_file_read('media', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'media';
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
        $params['where']['module'] = 'media';
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
        $params['where']['module'] = 'media';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], isset($menu_data["name"]) ? $menu_data["name"] : '');
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]["items"]);
        }
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->menu_indicators as $data) {
                $this->ci->Indicators_model->save_type(null, $data);
            }
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('media', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->model('Menu_model');
        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
        }
        // Indicators
        if (!empty($this->menu_indicators)) {
            $langs_file = $this->ci->Install_model->language_file_read('moderation', 'indicators', $langs_ids);
            if (!$langs_file) {
                log_message('info', '(resumes) Empty indicators langs data');

                return false;
            }
            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->update_langs($this->menu_indicators, $langs_file, $langs_ids);
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            $indicators_langs = $this->ci->Indicators_model->export_langs($this->menu_indicators, $langs_ids);
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->menu_indicators as $data) {
                $this->ci->Indicators_model->delete_type($data['gid']);
            }
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
        $langs_file = $this->ci->Install_model->language_file_read('media', 'moderation', $langs_ids);

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
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $type = $this->ci->Moderation_type_model->get_type_by_name($mtype["name"]);
            $this->ci->Moderation_type_model->delete_type($type['id']);
        }
    }

    public function installWallEvents()
    {
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        foreach ($this->wall_events as $wall_event) {
            $attrs = [
                'gid'                 => $wall_event['gid'],
                'status'              => '1',
                'module'              => 'media',
                'model'               => 'media_model',
                'method_format_event' => '_format_wall_events',
                'date_add'            => date("Y-m-d H:i:s"),
                'date_update'         => date("Y-m-d H:i:s"),
                'settings'            => $wall_event['settings'],
            ];
            $this->ci->Wall_events_types_model->add_wall_events_type($attrs);
        }

    }

    public function installWallEventsLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('media', 'wall_events', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        $this->ci->Wall_events_types_model->update_langs(array_keys($this->wall_events), $langs_file);
    }

    public function installWallEventsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('wall_events/models/Wall_events_types_model');

        return ['wall_events' => $this->ci->Wall_events_types_model->export_langs(array_keys($this->wall_events), $langs_ids)];
    }

    public function deinstallWallEvents()
    {
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        foreach ($this->wall_events as $wall_event) {
            $this->ci->Wall_events_types_model->delete_wall_events_type($wall_event['gid']);
        }
    }

    public function installSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid'      => 'media',
            'model_name'      => 'Media_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('media', $site_map_data);
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('media');
    }

    public function arbitraryInstalling()
    {
        $seo_data = [
            'module_gid'              => 'media',
            'model_name'              => 'Media_model',
            'get_settings_method'     => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('media', $seo_data);

        $lang_dm_data = [
            'module'        => 'media',
            'model'         => 'Albums_model',
            'method_add'    => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);

        $this->ci->load->model('media/models/Albums_model');

        foreach ($this->ci->pg_language->languages as $id => $value) {
            $this->ci->Albums_model->lang_dedicate_module_callback_add($value['id']);
        }

        $this->addDemoContent();

    }

    public function addDemoContent()
    {
        $demo_content = include MODULEPATH . 'media/install/demo_content.php';

        $langs = $this->ci->pg_language->languages;

        // Albums
        $this->ci->load->model('media/models/Albums_model');
        foreach ($demo_content['albums'] as $album) {
            // Replace language code with ID
            foreach ($langs as $lid => $lang_data) {
                if (empty($album['langs'][$lang_data['code']])) {
                    $album['langs'][$lang_data['code']] = $album['name'];
                }
                $album['lang_' . $lid] = $album['langs'][$lang_data['code']];
            }
            unset($album['langs']);
            $this->ci->Albums_model->save(null, $album);
        }

        return true;
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("media", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty media arbitrary langs data");

            return false;
        }

        foreach ($this->pages as $page) {
            $post_data = [
                    'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                    'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ? $langs_file["seo_tags_{$page}_keyword"] : null,
                    'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                    'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                    'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                    'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                    'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
                    'priority'       => 0.6,
                ];
            $this->ci->pg_seo->set_settings('user', 'media', $page, $post_data);
        }
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
        if (empty($langs_ids)) {
            return false;
        }

        //// arbitrary
        foreach ($this->pages as $page) {
            $settings = $this->ci->pg_seo->get_settings("user", "media", $page, $langs_ids);
            $arbitrary_return["seo_tags_{$page}_title"] = !empty($settings["title"]) ? $settings["title"] : null;
            $arbitrary_return["seo_tags_{$page}_keyword"] = !empty($settings["keyword"]) ? $settings["keyword"] : null; 
            $arbitrary_return["seo_tags_{$page}_description"] = !empty($settings["description"]) ? $settings["description"] : null; 
            $arbitrary_return["seo_tags_{$page}_header"] = !empty($settings["header"]) ? $settings["header"] : null;  
            $arbitrary_return["seo_tags_{$page}_og_title"] = !empty($settings["og_title"]) ? $settings["og_title"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_type"] = !empty($settings["og_type"]) ? $settings["og_type"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_description"] = !empty($settings["og_description"]) ? $settings["og_description"] : null; 
        }

        return ["arbitrary" => $arbitrary_return];
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('media');

        $lang_dm_data['where'] = [
            'module' => 'media',
            'model'  => 'Albums_model',
        ];
        $this->ci->pg_language->delete_dedicate_modules_entry($lang_dm_data);
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

        $langs_file = $this->ci->Install_model->language_file_read("media", "spam", $langs_ids);
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

    public function installUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->addCallback('media', 'Media_model', 'callback_user_delete', 'id_user', 'media_user');
        $this->ci->Users_delete_callbacks_model->addCallback('media', 'Media_model', 'callback_user_delete', 'id_owner', 'media_owner');
        $this->ci->Users_delete_callbacks_model->addCallback('media', 'Media_model', 'callback_user_delete', 'gallery', 'media_gallery');
        $this->ci->Users_blocked_callbacks_model->addCallback([
            'module' => 'media',
            'model' => 'Media_model',
            'callback' => 'callbackUserBLocked',
            'callback_gid' => 'media'
        ]);
    }

    public function deinstallUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->deleteCallbacksByModule('media');
        $this->ci->Users_blocked_callbacks_model->deleteCallbacksByModule('media');
    }

    /**
     * Install upload gallery data to aviary module
     *
     * @return void
     */
    public function installAviary()
    {
        $this->ci->load->model('Aviary_model');
        foreach ($this->aviary as $aviary) {
            $this->ci->Aviary_model->save_module(null, $aviary);
        }
    }

    /**
     * Uninstall upload gallery data from aviary module
     *
     * @return void
     */
    public function deinstallAviary()
    {
        $this->ci->load->model('Aviary_model');
        foreach ($this->aviary as $aviary) {
            $this->ci->Aviary_model->delete_module($aviary['module_gid']);
        }
    }

    public function installFriendlist()
    {
        //lang ds for friendlist
        if ($this->ci->pg_module->is_module_installed("media")) {
            $this->ci->load->model('Media_model');
            $this->ci->Media_model->addFriendsMenu();
        }
    }

    public function deinstallFriendlist()
    {
        //lang ds for friendlist
        if ($this->ci->pg_module->is_module_installed("media")) {
            $this->ci->load->model('Media_model');
            $this->ci->Media_model->deleteFriendsMenu();
        }
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
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            if (isset($value['data'])) {
                $value['data'] = serialize($value['data']);
            }
            $value['methods'] = (!empty($value['methods'])) ? serialize($value['methods']) : null;
            $value['not_methods'] = (!empty($value['not_methods'])) ? serialize($value['not_methods']) : null;
            $this->ci->Access_permissions_modules_model->saveModules($value);
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
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
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
