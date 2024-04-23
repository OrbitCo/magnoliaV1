<?php

declare(strict_types=1);

namespace Pg\modules\spam\models;

/**
 * Spam install model
 *
 * @package PG_RealEstate
 * @subpackage Spam
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SpamInstallModel extends \Model
{
    /**
     * Menu configuration
     *
     * @var array
     */
    protected $menu = [
        "admin_menu" => [
            "action" => "none",
            "items"  => [
                "settings_items" => [
                    "action" => "none",
                    "items"  => [
                        'system-items' => [
                            "action" => "none",
                            "items"  => [
                                "spam_sett_menu_item" => ["action" => "create", "link" => "admin/spam/types", "status" => 1, "sorter" => 7],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        "admin_spam_menu" => [
            "action" => "create",
            "name"   => "Admin mode - Content - Spam",
            "items"  => [
                "spam_alerts_item"   => ["action" => "create", "link" => "admin/spam/index", "status" => 1, "sorter" => 1],
                "spam_types_item"    => ["action" => "create", "link" => "admin/spam/types", "status" => 1, "sorter" => 2],
                "spam_reasons_item"  => ["action" => "create", "link" => "admin/spam/reasons", "status" => 1, "sorter" => 3],
                "spam_settings_item" => ["action" => "create", "link" => "admin/spam/settings", "status" => 1, "sorter" => 4],
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
            ['module' => SpamModel::MODULE_GID, "gid" => "spam_object", "name" => "Spam object", "vars" => ["type", "poster", "object_id", "reason", "message"], "content_type" => "text"],
        ],
        "notifications" => [
            ['module' => SpamModel::MODULE_GID, "gid" => "spam_object", "template" => "spam_object", "send_type" => "simple"],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators = [
        ["module" => "spam", "method" => "index", "is_default" => 1, 'group_id' => 1, 'is_hidden' => 0, 'parent_module' => '']
    ];
    
    private $moderation_types = [
        [
            "name"                 => "spam",
            "mtype"                => "-1",
            "module"               => "spam",
            "model"                => "Spam_alert_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * Install links to menu module
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
     * Update languages
     *
     * @param array $langs_ids
     */
    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read("spam", "menu", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty menu langs data");

            return false;
        }

        $this->ci->load->helper("menu");

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, "update", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
        }

        return true;
    }

    /**
     * Export languages
     *
     * @param array $langs_ids
     */
    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper("menu");

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, "export", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

    /**
     * Uninstall menu
     */
    public function deinstallMenu()
    {
        $this->ci->load->helper("menu");
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data["action"] == "create") {
                linked_install_set_menu($gid, "delete");
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]["items"]);
            }
        }
    }

    /**
     * Install notifications links
     */
    public function installNotifications()
    {
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        $templates_ids = [];

        foreach ((array) $this->notifications["templates"] as $template_data) {
            if (is_array($template_data["vars"])) {
                $template_data["vars"] = implode(",", $template_data["vars"]);
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
     * Import notifications languages
     *
     * @param array $langs_ids
     */
    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $this->ci->load->model("Notifications_model");

        $langs_file = $this->ci->Install_model->language_file_read("spam", "notifications", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty notifications langs data");

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->notifications, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export notifications languages
     *
     * @param array $langs_ids
     */
    public function installNotificationsLangExport($langs_ids = null)
    {
        $this->ci->load->model("Notifications_model");
        $langs = $this->ci->Notifications_model->export_langs($this->notifications, $langs_ids);

        return ["notifications" => $langs];
    }

    /**
     * Uninstall notifications links
     */
    public function deinstallNotifications()
    {
        //add notification
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        foreach ((array) $this->notifications["notifications"] as $notification_data) {
            $this->ci->Notifications_model->delete_notification_by_gid($notification_data["gid"]);
        }

        foreach ((array) $this->notifications["templates"] as $template_data) {
            $this->ci->Templates_model->delete_template_by_gid($template_data["gid"]);
        }
    }

    /**
     * Install moderators links
     */
    public function installModerators()
    {
        //install moderators permissions
        $this->ci->load->model("Moderators_model");

        foreach ((array) $this->moderators as $method_data) {
            $validate_data = ["errors" => [], "data" => $method_data];
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Moderators_model->save_method(null, $validate_data["data"]);
        }
    }

    /**
     * Import moderators languages
     *
     * @param array $langs_ids
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("spam", "moderators", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty moderators langs data");

            return false;
        }

        // install moderators permissions
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "spam";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method["method"]])) {
                $this->ci->Moderators_model->save_method($method["id"], [], $langs_file[$method["method"]]);
            }
        }
    }

    /**
     * Export moderators languages
     *
     * @param array $langs_ids
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "spam";
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method["method"]] = $method["langs"];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall moderators links
     */
    public function deinstallModerators()
    {
        $this->ci->load->model("Moderators_model");
        $params = [];
        $params["where"]["module"] = "spam";
        $this->ci->Moderators_model->delete_methods($params);
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
        $langs_file = $this->ci->Install_model->language_file_read('spam', 'moderation', $langs_ids);

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

    /**
     * Install model
     */
    public function arbitraryInstalling()
    {
        //get administrator email
        if ($this->ci->pg_module->is_module_installed('moderators')) {
            $this->ci->load->model("Moderators_model");
            $users = $this->ci->Moderators_model->get_users_list(null, 1, null, ['where' => ['user_type' => 'admin']]);
            if (!empty($users)) {
                $this->ci->pg_module->set_module_config("spam", 'send_alert_to_email', $users[0]["email"]);
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
