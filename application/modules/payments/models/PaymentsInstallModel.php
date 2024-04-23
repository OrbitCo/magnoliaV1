<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

use Pg\Libraries\Setup;
use Pg\Libraries\EventDispatcher;
use Pg\modules\payments\models\events\EventPayments;

/**
 * Payments install model
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
class PaymentsInstallModel extends \Model
{

    /**
     * Demo content Access_permissions object
     *
     * @var array
     */
    protected $demo_content;

    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'system_items' => [
                    'action' => 'none',
                    'items'  => [
                        'payments_menu_item' => [
                            'action' => 'create',
                            'link' => 'admin/start/menu/payments_menu_item',
                            'icon' => 'money',
                            'material_icon' => 'monetization_on',
                            'status' => 1,
                            'sorter' => 4,
                            'indicator_gid' => 'new_payment_item',
                            'items'  => [
                                'systems_list_item'  => ['action' => 'create', 'link' => 'admin/payments/systems', 'status' => 1],
                                'payments_list_item' => ['action' => 'create', 'link' => 'admin/payments/paymentsList', 'status' => 1],
                                'settings_list_item' => ['action' => 'create', 'link' => 'admin/payments/settings', 'status' => 1],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    /**
     * Indicators configuration
     */
    private $menu_indicators = [
        [
            'gid'            => 'new_payment_item',
            'delete_by_cron' => false,
            'auth_type'      => 'admin',
        ],
    ];
    private $moderators_methods = [
        ['module' => 'payments', 'method' => 'paymentsList', 'is_default' => 1, 'group_id' => 5, 'is_hidden' => 0, 'parent_module' => ''],
        ['module' => 'payments', 'method' => 'systems', 'is_default' => 0, 'group_id' => 5, 'is_hidden' => 0, 'parent_module' => ''],
        ['module' => 'payments', 'method' => 'settings', 'is_default' => 0, 'group_id' => 5, 'is_hidden' => 0, 'parent_module' => ''],
    ];

    /**
     * Notifications configuration
     */
    private $notifications = [
        "templates" => [
            ['module' => PaymentsModel::MODULE_GID, "gid" => "payment_status_updated", "name" => "Payment status updated", "vars" => ["user", "payment", "status"], "content_type" => "text"],
        ],
        "notifications" => [
            ['module' => PaymentsModel::MODULE_GID, "gid" => "payment_status_updated", "template" => "payment_status_updated", "send_type" => "simple"],
        ],
    ];

    /**
     * Fields depended of languages
     */
    private $lang_dm_data = [
        [
            "module"        => "payments",
            "model"         => "Payment_systems_model",
            "method_add"    => "lang_dedicate_module_callback_add",
            "method_delete" => "lang_dedicate_module_callback_delete",
        ],
    ];
    private $moderation_types = [
        [
            "name"                 => "payments",
            "mtype"                => "-1",
            "module"               => "payments",
            "model"                => "Payments_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->demo_content = Setup::getModuleData(
                PaymentsModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
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
        $langs_file = $this->ci->Install_model->language_file_read('payments', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

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
            } else {
                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->update_langs($this->menu_indicators, $langs_file, $langs_ids);
            }
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            $indicators_langs = $this->ci->Indicators_model->export_langs($this->menu_indicators, $langs_ids);
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
        if (!empty($this->menu_indicators)) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->menu_indicators as $data) {
                $this->ci->Indicators_model->delete_type($data['gid']);
            }
        }
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
        $langs_file = $this->ci->Install_model->language_file_read('payments', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'payments';
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
        $params['where']['module'] = 'payments';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'payments';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install links to notifications module
     */
    public function installNotifications()
    {
        // add notification
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
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $this->ci->load->model("Notifications_model");

        $langs_file = $this->ci->Install_model->language_file_read("payments", "notifications", $langs_ids);
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
        // add notification
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
     * Install links to cronjob module
     */
    public function installCronjob()
    {
        $this->ci->load->model("Cronjob_model");
        $this->ci->Cronjob_model->save_cron(null, [
            "name"     => "Currency rates updater",
            "module"   => "payments",
            "model"    => "payments_model",
            "method"   => "cron_update_currency_rates",
            "cron_tab" => "0 0 1 * *",
            "status"   => "0",
            "settings" => '{"time":"30"}'
        ]);
    }

    /**
     * Uninstall links to cronjob module
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model("Cronjob_model");
        $cron_data = [];
        $cron_data["where"]["module"] = "payments";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
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
        $langs_file = $this->ci->Install_model->language_file_read('payments', 'moderation', $langs_ids);

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
     * Install fields
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("payments/models/Payment_systems_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Payment_systems_model->lang_dedicate_module_callback_add($lang_id);
        }
    }

    public function arbitraryInstalling()
    {
        // add entries for lang data updates
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }
        $this->installDemoContent();
    }

    public function arbitraryDeinstalling()
    {
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->delete_dedicate_modules_entry(['where' => $lang_dm_data]);
        }
    }

   /**
     * Install demo content
     *
     * @return void
     */
    protected function installDemoContent()
    {
        if (!empty($this->demo_content)) {
            $this->ci->load->model([
                'Payments_model',
                'payments/models/Payment_systems_model',
                'menu/models/Indicators_model'
            ]);
            foreach ($this->demo_content['users_payments'] as $content) {
                $payment_id = $this->ci->Payments_model->savePayment(null, $content);
                $this->sendEvent(PaymentsModel::EVENT_PAYMENT_CHANGED, [
                    'id' => $payment_id,
                    'type' => PaymentsModel::TYPE_PAYMENT,
                    'status' => ($content['status'] === 0) ? PaymentsModel::STATUS_PAYMENT_SENDED : PaymentsModel::STATUS_PAYMENT_PROCESSED,
                ]);
                $payment = $this->ci->Payments_model->getPaymentById($payment_id);
                $payment["id_payment"] = $payment["id"];
                $status = ($payment["status"] == 0) ? 'request' : 'responce';
                $this->ci->Payment_systems_model->logData($payment["system_gid"], $status, $payment);
                $this->ci->load->model('menu/models/Indicators_model');
                if ($content['status'] === 1) {
                    $this->ci->Indicators_model->delete('new_payment_item', $payment_id, true);
                }
            }
            if (!empty($this->demo_content['payment_system_install'])) {
                $systems = $this->ci->Payment_systems_model->getInstallSystemData();
                foreach ($systems as $system) {
                    if (array_key_exists($system['gid'], $this->demo_content['payment_system_install']) === true) {
                        $system['in_use'] = $this->demo_content['payment_system_install'][$system['gid']];
                        $this->ci->Payment_systems_model->saveSystem(null, $system);
                    }
                }
            }
            if (TRIAL_MODE && !empty($this->demo_content['payment_system_trial_install'])) {
                $systems = $this->ci->Payment_systems_model->getInstallSystemData();
                foreach ($systems as $system) {
                    if (array_key_exists($system['gid'], $this->demo_content['payment_system_trial_install']) === true) {
                        $system['in_use'] = $this->demo_content['payment_system_trial_install'][$system['gid']];
                        $this->ci->Payment_systems_model->saveSystem(null, $system);
                    }
                }
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
