<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\models;

use Pg\Libraries\Setup;

/**
 * VirtualGifts module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */

/**
 * VirtualGifts install model
 *
 * @package     PG_Dating
 * @subpackage  VirtualGifts
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */
class VirtualGiftsInstallModel extends \Model
{
    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Menu configuration
     *
     * "<menu_gid>" => array(
     *     "action" => "<create|none>",
     *     "name" => "<menu_name>",
     *     "items" => array(
     *         "<menu_item_gid>" => array(
     *         "action" => "<create|none>",
     *         "name" => "<menu_item_gid>",
     *         "items" => array(
     *             ...
     *         )
     *     )
     * )
     *
     * @var array
     */
    protected $menu = [
        'admin_page_menu' => [
            'action' => 'none',
            'items' => [
                'more-matches-items' => [
                    'action' => 'none',
                    'items' => [
                        "virtual_gifts_menu_item" => [
                            "action" => "create",
                            "link" => "admin/virtual_gifts",
                            'material_icon' => 'redeem',
                            "status" => 1,
                            "sorter" => 8
                        ],
                    ]
                ],
            ],
        ],
        'admin_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'other_items' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        "add_ons_items" => [
                            "action" => "none",
                            "items"  => [
                                "virtual_gifts_menu_item" => ["action" => "create", "link" => "admin/virtual_gifts", "status" => 1, "sorter" => 11],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_virtual_gifts_menu' => [
            'action' => 'create',
            'name'   => 'Virtual Gifts section menu',
            'items'  => [
                'virtual_gifts_list_item'     => ['action' => 'create', 'link' => 'admin/virtual_gifts/index', 'status' => 1, 'sorter' => 1],
                'virtual_gifts_settings_item' => ['action' => 'create', 'link' => 'admin/virtual_gifts/settings', 'status' => 1, 'sorter' => 2],
            ],
        ],
    ];

    /**
     * Indicators configuration
     *
     *    array(
     *        "gid"             => "<indicator_gid>",
     *        "delete_by_cron"  => <true|false>,
     *        "auth_type"       => "<admin|user>",
     *    ),
     *
     * @var array
     */
    private $menu_indicators = [

    ];

    /**
     * Notifications configuration
     *
     * templates:
     *
     *    array(
     *        "gid" => "<template_gid>",
     *        "name" => "<template_name>",
     *        "vars" => array("<template_var>", "<template_var>", ...),
     *        "content_type" => "<text|html>",
     *    )
     *
     * notifications:
     *
     *    array(
     *        "gid" => "<notification_gid>",
     *        "template" => "<template_gid>",
     *        "send_type" => "<simple|que>",
     *    )
     *
     * @var array
     */
    protected $notifications = [
        "templates" => [
            ['gid' => 'virtual_gifts', 'name' => 'Virtual Gifts', 'vars' => ['gift_icon_link', 'user_nickname', 'profile_nickname', 'image', 'link_1', 'link_2'], 'content_type' => 'html'],
        ],
        "notifications" => [
            ['gid' => 'virtual_gifts', 'send_type' => 'que'],
        ],
    ];

    /**
     * Fields depended on languages
     *
     * @var array
     */
    protected $lang_dm_data = [
        [
            "module"        => "virtual_gifts",
            "model"         => "Virtual_gifts_forge_model",
            "method_add"    => "langDedicateModuleCallbackAdd",
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
            'gid'             => 'virtual_gifts',
            'callback_module' => 'virtual_gifts',
            'callback_model'  => 'Virtual_gifts_model',
            'callback_method' => 'paymentServiceStatus',
        ],
    ];

    /**
     * Demo content object
     *
     * @var array
     */
    protected $demo_content;

    private $moderators_methods = [
        ['module' => 'virtual_gifts', 'method' => 'index', 'is_default' => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
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
            VirtualGiftsModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
        $this->demo_content = Setup::getModuleData(
            VirtualGiftsModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
    }

    /**
     * Install menu data of virtual_gifts
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
     * Import menu languages of virtual_gifts
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

        $langs_file = $this->ci->Install_model->language_file_read("virtual_gifts", "menu", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty menu langs data of virtual_gifts");

            return false;
        }

        $this->ci->load->helper("menu");

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items(
                $this->menu,
                "update",
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_file
            );
        }

        return true;
    }

    /**
     * Export menu languages of virtual_gifts
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
            $return = array_merge($return, linked_install_process_menu_items(
                $this->menu,
                "export",
                $gid,
                0,
                $this->menu[$gid]["items"],
                $gid,
                $langs_ids
            ));
        }

        return ["menu" => $return];
    }

    /**
     * Uninstall menu data of virtual_gifts
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
     * Install data of notifications module
     *
     * @return void
     */
    public function installNotifications()
    {
        // add notification
        $this->ci->load->model("Notifications_model");
        $this->ci->load->model("notifications/models/Templates_model");

        $tpl_ids = [];

        foreach ($this->notifications['templates'] as $tpl) {
            $template_data = [
                'module' => VirtualGiftsModel::MODULE_GID,
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
                'module' => VirtualGiftsModel::MODULE_GID,
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
     * Import languages of notifiactions module
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

        $langs_file = $this->ci->Install_model->language_file_read("virtual_gifts", "notifications", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty notifications langs data (virtual_gifts)");

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->notifications, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export languages of notifications module
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
     * Unistall data of notifications module
     *
     * @return void
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
        // upload config
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = [
            'gid'          => 'virtual-gifts',
            'name'         => 'Virtual gifts photo',
            'max_height'   => 5000,
            'max_width'    => 5000,
            'max_size'     => 10485760,
            'name_format'  => 'generate',
            'file_formats' => ['jpg', 'jpeg', 'gif', 'png', 'webp'],
            'default_img'  => '',
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $config_data['file_formats'] = serialize($config_data['file_formats']);
        $config_id = $this->ci->Uploads_config_model->save_config(null, $config_data);
        $wm_data = $this->ci->Uploads_config_model->get_watermark_by_gid('image-wm');
        $wm_id = isset($wm_data["id"]) ? $wm_data["id"] : 0;

        $thumb_data = [
            'config_id'    => $config_id,
            'prefix'       => 'big',
            'width'        => 150,
            'height'       => 150,
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
        $config_data = $this->ci->Uploads_config_model->get_config_by_gid('virtual-gifts');
        if (!empty($config_data['id'])) {
            $this->ci->Uploads_config_model->delete_config($config_data['id']);
        }
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
            $this->ci->Payments_model->save_payment_type(null, $data);
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
        $langs_file = $this->ci->Install_model->language_file_read('virtual_gifts', 'payments', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty payments langs data (virtual_gifts)');

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
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {

        /*$this->ci->load->model("virtual_gifts/models/Virtual_gifts_forge_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Virtual_gifts_forge_model->langDedicateModuleCallbackAdd($lang_id);
        }*/
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
        $langs_file = $this->ci->Install_model->language_file_read("virtual_gifts", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty arbitrary langs data of virtual_gifts");

            return false;
        }

        // TODO:
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

        // TODO:

        return ["arbitrary" => $arbitrary_return];
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {

        // delete entries in dedicate modules
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $params = ['where' => $lang_dm_data];
            $this->ci->pg_language->delete_dedicate_modules_entry($params);
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
            $this->ci->Access_permissions_modules_model->saveModules($value);
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_install_model');
        $this->ci->Access_permissions_install_model->addDemoAcl($this->demo_content['acl']);
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

    /**
     * Install moderators links
     */
    public function installModerators()
    {
        //install moderators permissions
        $this->ci->load->model("Moderators_model");
        foreach ((array) $this->moderators_methods as $method_data) {
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
        $langs_file = $this->ci->Install_model->language_file_read("virtual_gifts", "moderators", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty moderators langs data");

            return false;
        }
        // install moderators permissions
        $this->ci->load->model("Moderators_model");
        $params["where"]["module"] = "virtual_gifts";
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
        $params["where"]["module"] = "virtual_gifts";
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
        $params["where"]["module"] = "virtual_gifts";
        $this->ci->Moderators_model->delete_methods($params);
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
