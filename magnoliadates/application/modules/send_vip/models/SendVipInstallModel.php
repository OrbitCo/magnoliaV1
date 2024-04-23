<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\models;

/**
 * send_vip module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Install model
 *
 * @package     PG_Dating
 * @subpackage  Send_vip
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendVipInstallModel extends \Model
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
                "other_items" => [
                    "action"  => "none",
                    "items"   => [
                        "add_ons_items" => [
                            "action"    => "none",
                            "items"     => [
                                "send_vip_menu_item" => ["action" => "create", "link" => "admin/send_vip/index", "status" => 1, "sorter" => 1],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_send_vip_menu' => [
            'action' => 'create',
            'name'   => 'Admin mode - Add-ons - Send vip menu',
            'items'  => [
                'send_vip_settings_item' => ['action' => 'create', 'link' => 'admin/send_vip/settings', 'status' => 1, "sorter" => 10],
                'send_vip_view_item'     => ['action' => 'create', 'link' => 'admin/send_vip/view', 'status' => 1, "sorter" => 20],
            ],
        ],
    ];

    /**
     * Moderators configuration
     *
     * @var array
     */
    protected $moderators_methods = [
        ["module" => "send_vip", "method" => "index", "is_default" => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module" => "send_vip",
            "model" => "send_vip_model",
            "method_add" => "langDedicateModuleCallbackAdd",
            "method_delete" => "langDedicateModuleCallbackDelete",
        ],
    ];

    /**
     * Payment configuration
     *
     * @var array
     */
    protected $payment_types = [
        [
            'gid'             => 'send_vip',
            'callback_module' => 'send_vip',
            'callback_model'  => 'Send_vip_model',
            'callback_method' => 'paymentSendVipStatus',
        ],
    ];

    /**
     * Notifications configuration
     */
    protected $notifications = [
        "templates" => [
            ["gid" => "send_vip_msg", "name" => "Send VIP message", "vars" => ["membership", "approve", "decline", "id", "sender"], "content_type" => "html"],
        ],
        "notifications" => [
            ['gid' => 'send_vip_msg', 'send_type' => 'simple'],
        ],
    ];

    /**
     * Class constructor
     *
     * @return Send_vip_Install
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('Install_model');
    }

    /**
     * Install menu data of Send_vip
     *
     * @return void
     */
    public function installMenu()
    {
        $this->ci->load->helper("menu");
        foreach ($this->menu as $gid => $menu_data) {
            $this->menu[$gid]["id"] = linked_install_set_menu($gid, $menu_data["action"], isset($menu_data["name"]) ? $menu_data["name"] : '');
            linked_install_process_menu_items($this->menu, "create", $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    /**
     * Import menu languages of send_vip
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
        $langs_file = $this->ci->Install_model->language_file_read("send_vip", "menu", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty menu langs data (send_vip)");

            return false;
        }

        $this->ci->load->helper("menu");

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, "update", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
        }

        return true;
    }

    /**
     * Export menu languages of send_vip
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
        $this->ci->load->helper("menu");

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, "export", $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
    }

    /**
     * Uninstall menu data of video chats
     *
     * @return void
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
     * Install data of moderators module
     *
     * @return void
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('Moderators_model');

        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    /**
     * Import languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('send_vip', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'send_vip';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    /**
     * Export languages of moderators module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'send_vip';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    /**
     * Uninstall data of moderators module
     *
     * @return void
     */
    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('Moderators_model');
        $params['where']['module'] = 'send_vip';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install data of payments module
     */
    public function installPayments()
    {
        // add account payment type
        $this->ci->load->model("Payments_model");
        foreach ($this->payment_types as $payment_type) {
            $data = [
                'gid'             => $payment_type['gid'],
                'callback_module' => $payment_type['callback_module'],
                'callback_model'  => $payment_type['callback_model'],
                'callback_method' => $payment_type['callback_method'],
            ];
            $id = $this->ci->Payments_model->save_payment_type(null, $data);
        }
    }

    /**
     * Import data of payment module depended on language
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installPaymentsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('send_vip', 'payments', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty payments langs data (send_vip)');

            return false;
        }
        $this->ci->load->model('Payments_model');
        $this->ci->Payments_model->update_langs($this->payment_types, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export data of payment module depended on language
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installPaymentsLangExport($langs_ids = null)
    {
        $this->ci->load->model('Payments_model');
        $return = $this->ci->Payments_model->export_langs($this->payment_types, $langs_ids);

        return ["payments" => $return];
    }

    /**
     * Uninstall data of payments module
     *
     * @return void
     */
    public function deinstallPayments()
    {
        $this->ci->load->model('Payments_model');
        foreach ($this->payment_types as $payment_type) {
            $this->ci->Payments_model->delete_payment_type_by_gid($payment_type['gid']);
        }
    }
    /**
     * Install links to notifications module
     */
    public function installNotifications()
    {
        // add notification
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        $tpl_ids = [];

        foreach ($this->notifications['templates'] as $tpl) {
            $template_data = [
                'module' => SendVipModel::MODULE_GID,
                'gid'          => $tpl['gid'],
                'name'         => $tpl['name'],
                'vars'         => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add'     => date('Y-m-d H:i:s'),
                'date_update'  => date('Y-m-d H:i:s'),
                ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->save_template(null, $template_data);
        }

        foreach ($this->notifications['notifications'] as $notification) {
            $notification_data = [
                'module' => SendVipModel::MODULE_GID,
                'gid'                 => $notification['gid'],
                'send_type'           => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add'            => date("Y-m-d H:i:s"),
                'date_update'         => date("Y-m-d H:i:s"),
                ];
            $this->ci->Notifications_model->save_notification(null, $notification_data);
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

        $langs_file = $this->ci->Install_model->language_file_read("send_vip", "notifications", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty notifications langs data (send_vip)");

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
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model("Notifications_model");
        $langs = $this->ci->Notifications_model->export_langs((array) $this->notifications, $langs_ids);

        return ["notifications" => $langs];
    }

    /**
     * Uninstall links to notifications module
     */
    public function deinstallNotifications()
    {
        ////// add notification
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        foreach ((array) $this->notifications["templates"] as $template_data) {
            $this->ci->Templates_model->delete_template_by_gid($template_data["gid"]);
        }
        foreach ($this->notifications['notifications'] as $notification) {
            $this->ci->Notifications_model->delete_notification_by_gid($notification['gid']);
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
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("send_vip", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty send_vip arbitrary langs data");

            return false;
        }

        return false;
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
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $arbitrary_return = [];

        return ["arbitrary" => $arbitrary_return];
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('send_vip');

        /// delete entries in dedicate modules
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
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
