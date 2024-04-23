<?php

declare(strict_types=1);

namespace Pg\modules\banners\models;

/**
 * Banners install model
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BannersInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * @var array
     */
    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'system_items' => [
                    'action' => 'none',
                    'items'  => [
                        'banners_menu_item' => [
                            'action' => 'create',
                            'link' => 'admin/banners',
                            'icon' => 'th-large',
                            'material_icon' => 'view_quilt',
                            'status' => 1,
                            'sorter' => 5,
                            'indicator_gid' => 'new_banner_item'],
                    ],
                ],
            ],
        ],
        'admin_banners_menu' => [
            'action' => 'create',
            'name'   => 'Banners section menu',
            'items'  => [
                'banners_list_item'     => ['action' => 'create', 'link' => 'admin/banners', 'status' => 1],
                'groups_list_item'      => ['action' => 'create', 'link' => 'admin/banners/groups_list', 'status' => 1],
                'places_list_item'      => ['action' => 'create', 'link' => 'admin/banners/places_list', 'status' => 1],
                'banners_settings_item' => ['action' => 'create', 'link' => 'admin/banners/settings', 'status' => 1],
            ],
        ],
    ];

    /**
     * Notifications configuration
     *
     * @var array
     */
    protected $notifications = [
        "templates" => [
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_need_moderate", "name" => "New banner awaiting moderation", "vars" => [], "content_type" => "text"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_approved", "name" => "Banner approved", "vars" => ["user", "banner"], "content_type" => "text"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_declined", "name" => "Banner declined", "vars" => ["user", "banner"], "content_type" => "text"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_expired", "name" => "Banner status expired", "vars" => ["user", "banner"], "content_type" => "text"],
        ],
        "notifications" => [
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_need_moderate", "template" => "banner_need_moderate", "send_type" => "simple"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_approved", "template" => "banner_status_approved", "send_type" => "simple"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_declined", "template" => "banner_status_declined", "send_type" => "simple"],
            ["module" => BannersModel::MODULE_GID, "gid" => "banner_status_expired", "template" => "banner_status_expired", "send_type" => "simple"],
        ],
    ];

    private $lang_services = [
        'service'  => ['banner_service'],
        'template' => ['banner_template'],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators_methods = [
        ['module' => 'banners', 'method' => 'index', 'is_default' => 1, 'group_id' => 1, 'is_hidden' => 0, 'parent_module' => '']
    ];

    private $moderation_types = [
        [
            "name"                 => "banners",
            "mtype"                => "-1",
            "module"               => "banners",
            "model"                => "Banners_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * Indicators configuration
     */
    private $menu_indicators = [
        [
            'gid'               => 'new_banner_item',
            'delete_by_cron'    => false,
            'auth_type'         => 'admin',
        ],
    ];

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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->menu_indicators as $data) {
                $this->ci->Indicators_model->save_type(null, $data);
            }
        }
    }

    /**
     * Import languages of menu module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('banners', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_file);
        }
        // Indicators
        if (!empty($this->menu_indicators)) {
            $langs_file = $this->ci->Install_model->language_file_read('moderation', 'indicators', $langs_ids);
            if (!$langs_file) {
                log_message('info', '(resumes) Empty indicators langs data');

                return false;
            } else {
                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->update_langs($this->menu_indicators, $langs_file, $langs_ids);
            }
        }

        return true;
    }

    /**
     * Export languages of menu module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installMenuLangExport($langs_ids = null)
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            $indicators_langs = $this->ci->Indicators_model->export_langs($this->menu_indicators, $langs_ids);
        }

        return ['menu' => $return];
    }

    /**
     * Uninstall data of menu module
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->menu_indicators as $data) {
                $this->ci->Indicators_model->delete_type($data['gid']);
            }
        }
    }

    /**
     * Install notifications of banners
     *
     * @return void
     */
    public function installNotifications()
    {
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        $templates_ids = [];

        foreach ((array) $this->notifications["templates"] as $template_data) {
            if (is_array($template_data["vars"])) {
                $template_data["vars"] = implode(", ", $template_data["vars"]);
            }
            $validate_data = $this->ci->Templates_model->validate_template(null, $template_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $templates_ids[$template_data['gid']] = $this->ci->Templates_model->save_template(null, $validate_data["data"]);
        }

        foreach ((array) $this->notifications["notifications"] as $notification_data) {
            if (!isset($templates_ids[$notification_data["template"]])) {
                $template = $this->ci->Templates_model->get_template_by_gid($notification_data["template"]);
                $templates_ids[$notification_data["template"]] = $template["id"];
            }
            $notification_data["id_template_default"] = $templates_ids[$notification_data["template"]];
            $validate_data = $this->ci->Notifications_model->validate_notification(null, $notification_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Notifications_model->save_notification(null, $validate_data["data"]);
        }
    }

    /**
     * Import notifiactions languages of banners
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("Notifications_model");

        $langs_file = $this->ci->Install_model->language_file_read("banners", "notifications", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty notifications langs data");

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->notifications, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export notifications languages of banners
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installNotificationsLangExport($langs_ids = null)
    {
        $this->ci->load->model("Notifications_model");
        $langs = $this->ci->Notifications_model->export_langs($this->notifications, $langs_ids);

        return ["notifications" => $langs];
    }

    /**
     * Unistall notifacations data of banners
     *
     * @return array
     */
    public function deinstallNotifications()
    {
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        foreach ((array) $this->notifications["notifications"] as $notification_data) {
            $this->ci->Notifications_model->delete_notification_by_gid($notification_data["gid"]);
        }

        foreach ((array) $this->notifications["templates"] as $template_data) {
            $this->ci->Templates_model->delete_template_by_gid($template_data["gid"]);
        }
    }

    public function installUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid'          => 'banner',
            'name'         => 'Banner image file',
            'max_height'   => 1000,
            'max_width'    => 1000,
            'max_size'     => 100000,
            'name_format'  => 'generate',
            'file_formats' => serialize(["jpg", "jpeg", "gif", "png", "webp"]),
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->save_config(null, $config_data);
    }

    public function installServices()
    {
        // add service type and service
        // create service template and service
        $this->ci->load->model("Services_model");
        $template_data = [
            'gid'                      => "banner_template",
            'callback_module'          => "banners",
            'callback_model'           => "Banners_model",
            'callback_buy_method'      => "service_buy_banner",
            'callback_activate_method' => "service_activate_banner",
            'callback_validate_method' => "service_validate_banner",
            'price_type'               => 3,
            'data_admin'               => "",
            'data_user'                => serialize(["id_banner_payment" => "hidden"]),
            'date_add'                 => date("Y-m-d H:i:s"),
            'moveable'                 => 0,
            'alert_activate'           => 0,
        ];
        $this->ci->Services_model->save_template(null, $template_data);

        $service_data = [
            "gid"          => "banner_service",
            "template_gid" => "banner_template",
            "pay_type"     => 2,
            "status"       => 1,
            "price"        => 0,
            "type"         => "internal",
            "data_admin"   => "",
            "date_add"     => date("Y-m-d H:i:s"),
        ];
        $this->ci->Services_model->save_service(null, $service_data);
    }

    public function installServicesLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Services_model');
        $langs_file = $this->ci->Install_model->language_file_read('banners', 'services', $langs_ids);
        $this->ci->Services_model->update_langs($this->lang_services, $langs_file);

        return true;
    }

    public function installServicesLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Services_model');

        return ['services' => $this->ci->Services_model->export_langs($this->lang_services, $langs_ids)];
    }

    public function installCronjob()
    {
        ///// add cronjob ()
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            "name"     => "Update banner statistic",
            "module"   => "banners",
            "model"    => "Banners_model",
            "method"   => "update_statistic",
            "cron_tab" => "23 */6 * * *",
            "status"   => "1",
        ];
        $this->ci->Cronjob_model->save_cron(null, $cron_data);
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
        $langs_file = $this->ci->Install_model->language_file_read('banners', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'banners';
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
        $params['where']['module'] = 'banners';
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
        $params['where']['module'] = 'banners';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function arbitraryInstalling()
    {
        if (SITE_SERVER == 'https://demo.datingpro.com/') {
            $this->addBannersToSite();
        }
    }

    public function deinstallUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = $this->ci->Uploads_config_model->get_config_by_gid('banner');
        if (!empty($config_data["id"])) {
            $this->ci->Uploads_config_model->delete_config($config_data["id"]);
        }
    }

    public function deinstallServices()
    {
        $this->ci->load->model("Services_model");
        $this->ci->Services_model->delete_template_by_gid('banner_template');
        $this->ci->Services_model->delete_service_by_gid('banner_service');
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data["where"]["module"] = "banners";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

    public function arbitraryDeinstalling()
    {
    }

    public function addBannersToSite()
    {
        $this->ci->load->model('banners/models/Banner_group_model');
        $this->ci->load->model('Banners_model');
        $all_groups_ids = array_keys($this->ci->Banner_group_model->getAllGroupsKeyId());

        $banners = [
            [
                'alt_text'        => 'PG Dating Pro',
                'approve'         => 1,
                'banner_image'    => 'placeholder_185x75.gif',
                'banner_place_id' => 3,
                'banner_type'     => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? 2 : 1,
                'decline_reason'  => '',
                'expiration_date' => '0000-00-00 00:00:00',
                'html'            => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DP Demo -->
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7776361119486928"
                    data-ad-slot="7843012345"
                    data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                ' : '',
                'link'               => 'https://www.datingpro.com/',
                'name'               => 'Left banner',
                'new_window'         => 1,
                'is_admin'           => 1,
                'number_of_clicks'   => 0,
                'number_of_views'    => 0,
                'status'             => 1,
                'user_id'            => 0,
                'stat_clicks'        => 0,
                'stat_views'         => 0,
                'user_activate_info' => '',
                'banner_groups'      => $all_groups_ids,
            ],
            [
                'alt_text'        => 'PG Dating Pro',
                'approve'         => 1,
                'banner_image'    => 'placeholder_980x90.gif',
                'banner_place_id' => 1,
                'banner_type'     => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? 2 : 1,
                'decline_reason'  => '',
                'expiration_date' => '0000-00-00 00:00:00',
                'html'            => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DP Demo -->
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7776361119486928"
                    data-ad-slot="7843012345"
                    data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                ' : '',
                'link'               => 'https://www.datingpro.com/',
                'name'               => 'Bottom banner',
                'new_window'         => 1,
                'is_admin'           => 1,
                'number_of_clicks'   => 0,
                'number_of_views'    => 0,
                'status'             => 1,
                'user_id'            => 0,
                'stat_clicks'        => 1,
                'stat_views'         => 846,
                'user_activate_info' => '',
                'banner_groups'      => $all_groups_ids,
            ],
            [
                'alt_text'        => 'PG Dating Pro',
                'approve'         => 1,
                'banner_image'    => 'placeholder_185x155.gif',
                'banner_place_id' => 2,
                'banner_type'     => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? 2 : 1,
                'decline_reason'  => '',
                'expiration_date' => '0000-00-00 00:00:00',
                'html'            => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DP Demo -->
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7776361119486928"
                    data-ad-slot="7843012345"
                    data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                ' : '',
                'link'               => 'https://www.datingpro.com/',
                'name'               => 'Big left banner',
                'new_window'         => 1,
                'is_admin'           => 1,
                'number_of_clicks'   => 0,
                'number_of_views'    => 0,
                'status'             => 1,
                'user_id'            => 0,
                'stat_clicks'        => 0,
                'stat_views'         => 0,
                'user_activate_info' => '',
                'banner_groups'      => $all_groups_ids,
            ],
            [
                'alt_text'        => 'PG Dating Pro',
                'approve'         => 1,
                'banner_image'    => 'placeholder_320x75.gif',
                'banner_place_id' => 6,
                'banner_type'     => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? 2 : 1,
                'decline_reason'  => '',
                'expiration_date' => '0000-00-00 00:00:00',
                'html'            => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DP Demo -->
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7776361119486928"
                    data-ad-slot="7843012345"
                    data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                ' : '',
                'link'               => 'https://www.datingpro.com/',
                'name'               => 'Right banner',
                'new_window'         => 1,
                'is_admin'           => 1,
                'number_of_clicks'   => 0,
                'number_of_views'    => 0,
                'status'             => 1,
                'user_id'            => 0,
                'stat_clicks'        => 0,
                'stat_views'         => 0,
                'user_activate_info' => '',
                'banner_groups'      => $all_groups_ids,
            ],
            [
                'alt_text'        => 'PG Dating Pro',
                'approve'         => 1,
                'banner_image'    => 'placeholder_320x250.gif',
                'banner_place_id' => 5,
                'banner_type'     => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? 2 : 1,
                'decline_reason'  => '',
                'expiration_date' => '0000-00-00 00:00:00',
                'html'            => ($_ENV['DEMO_MODE'] || TRIAL_MODE) ? '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DP Demo -->
                    <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-7776361119486928"
                    data-ad-slot="7843012345"
                    data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                ' : '',
                'link'               => 'https://www.datingpro.com/',
                'name'               => 'Big right banner',
                'new_window'         => 1,
                'is_admin'           => 1,
                'number_of_clicks'   => 0,
                'number_of_views'    => 0,
                'status'             => 1,
                'user_id'            => 0,
                'stat_clicks'        => 0,
                'stat_views'         => 0,
                'user_activate_info' => '',
                'banner_groups'      => $all_groups_ids,
            ],
        ];

        foreach ($banners as $banner) {
            $this->ci->Banners_model->save(null, $banner);
        }

        return true;
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
        $langs_file = $this->ci->Install_model->language_file_read('banners', 'moderation', $langs_ids);

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
