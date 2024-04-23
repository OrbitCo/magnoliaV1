<?php

declare(strict_types=1);

namespace Pg\modules\users_payments\models;

/**
 * Users payments install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 *
 * @version $Revision: 1 $ $Date: 2012-09-12 15:24:47 +0300 (Ср, 12 сент 2012) $ $Author: abatukhtin $
 */
class UsersPaymentsInstallModel extends \Model
{
    private $payment_types = [
        ['gid' => 'account', 'callback_module' => 'users_payments', 'callback_model' => 'Users_payments_model', 'callback_method' => 'update_user_account'],
    ];

    private $notifications = [
        'notifications' => [
            ['gid' => 'users_update_account', 'send_type' => 'simple'],
        ],
        'templates' => [
            ['gid' => 'users_update_account', 'name' => 'Add funds on account', 'vars' => ['account', 'received', 'email', 'fname', 'sname', 'nickname'], 'content_type' => 'text'],
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

        $this->ci->load->model('Install_model');
    }

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

    public function installPaymentsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('users_payments', 'payments', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty payments langs data');

            return false;
        }
        $this->ci->load->model('Payments_model');
        $this->ci->Payments_model->update_langs($this->payment_types, $langs_file, $langs_ids);
    }

    public function installPaymentsLangExport($langs_ids = null)
    {
        $this->ci->load->model('Payments_model');

        return ['payments' => $this->ci->Payments_model->export_langs($this->payment_types, $langs_ids)];
    }

    public function deinstallPayments()
    {
        $this->ci->load->model('Payments_model');
        foreach ($this->payment_types as $payment_type) {
            $this->ci->Payments_model->delete_payment_type_by_gid($payment_type['gid']);
        }
    }

    public function installNotifications()
    {
        // add notification
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');

        foreach ($this->notifications['templates'] as $tpl) {
            $template_data = [
                'module' => UsersPaymentsModel::MODULE_GID,
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
                'module' => UsersPaymentsModel::MODULE_GID,
                'gid'                 => $notification['gid'],
                'send_type'           => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add'            => date("Y-m-d H:i:s"),
                'date_update'         => date("Y-m-d H:i:s"),
            ];
            $this->ci->Notifications_model->save_notification(null, $notification_data);
        }
    }

    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model('Notifications_model');

        $langs_file = $this->ci->Install_model->language_file_read('users_payments', 'notifications', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');

            return false;
        }

        $this->ci->Notifications_model->update_langs($this->notifications, $langs_file, $langs_ids);

        return true;
    }

    public function installNotificationsLangExport($langs_ids = null)
    {
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->export_langs($this->notifications, $langs_ids);

        return ['notifications' => $langs];
    }

    public function deinstallNotifications()
    {
        $this->ci->load->model('Notifications_model');
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($this->notifications['templates'] as $tpl) {
            $this->ci->Templates_model->delete_template_by_gid($tpl['gid']);
        }
        foreach ($this->notifications['notifications'] as $ntf) {
            $this->ci->Notifications_model->delete_notification_by_gid($ntf['gid']);
        }
    }

    public function arbitraryInstalling()
    {
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
