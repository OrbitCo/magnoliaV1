<?php

declare(strict_types=1);

namespace Pg\modules\notifications\models;

/**
 * Notifications install model
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
class NotificationsInstallModel extends \Model
{
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'content_items' => [
                    'action' => 'none',
                    'items'  => [
                        'notifications_menu_item' => ['action' => 'create', 'link' => 'admin/notifications', 'status' => 1, 'sorter' => 4],
                    ],
                ],
            ],
        ],
        'admin_notifications_menu' => [
            'action' => 'create',
            'name'   => 'Notifications section menu',
            'items'  => [
                'nf_settings_item'  => ['action' => 'create', 'link' => 'admin/notifications/settings', 'status' => 1],
                'nf_items'          => ['action' => 'create', 'link' => 'admin/notifications', 'status' => 1],
                'nf_templates_item' => ['action' => 'create', 'link' => 'admin/notifications/templates', 'status' => 1],
                'nf_pool_item'      => ['action' => 'create', 'link' => 'admin/notifications/pool', 'status' => 1,
                ],
            ],
        ],
    ];
    
    private $moderators_methods = [
        ['module' => 'notifications', 'method' => 'index', 'is_default' => 1, 'group_id' => 3, 'is_hidden' => 0, 'parent_module' => '']
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

    public function validateSettingsForm()
    {
        $errors = [];
        $data["mail_charset"]       = trim($this->ci->input->post('mail_charset', true));
        $data["mail_protocol"]      = trim($this->ci->input->post('mail_protocol', true));
        $data["mail_mailpath"]      = trim($this->ci->input->post('mail_mailpath', true));
        $data["mail_smtp_host"]     = trim($this->ci->input->post('mail_smtp_host', true));
        $data["mail_smtp_user"]     = trim($this->ci->input->post('mail_smtp_user', true));
        $data["mail_smtp_pass"]     = trim(htmlspecialchars($this->input->post('mail_smtp_pass', true)));
        $data["mail_smtp_port"]     = trim($this->ci->input->post('mail_smtp_port', true));
        $data["mail_useragent"]     = trim($this->ci->input->post('mail_useragent', true));
        $data["mail_from_email"]    = trim($this->ci->input->post('mail_from_email', true));
        $data["mail_from_name"]     = trim($this->ci->input->post('mail_from_name', true));

        $openssl_loaded = extension_loaded('openssl');
        if ($openssl_loaded) {
            $data["dkim_private_key"] = $this->ci->input->post('dkim_private_key', true);
            $data["dkim_domain_selector"] = $this->ci->input->post('dkim_domain_selector', true);
        }

        if (empty($data["mail_charset"])) {
            $errors[] = $this->ci->pg_language->get_string('notifications', 'error_charset_incorrect');
        }

        if (empty($data["mail_protocol"]) || !in_array($data["mail_protocol"], ['mail', 'sendmail', 'smtp'])) {
            $errors[] = $this->ci->pg_language->get_string('notifications', 'error_protocol_incorrect');
        }

        if (empty($data["mail_useragent"])) {
            $errors[] = $this->ci->pg_language->get_string('notifications', 'error_useragent_incorrect');
        }

        if (empty($data["mail_from_email"])) {
            $errors[] = $this->ci->pg_language->get_string('notifications', 'error_from_email_incorrect');
        }

        if (empty($data["mail_from_name"])) {
            $errors[] = $this->ci->pg_language->get_string('notifications', 'error_from_name_incorrect');
        }

        $return = [
            "data"   => $data,
            "errors" => $errors,
        ];

        return $return;
    }

    public function saveSettingsForm($data)
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('notifications', $setting, $value);
        }

        return;
    }

    public function getSettingsForm($submit = false)
    {
        $data = [
            'mail_charset'    => $this->ci->pg_module->get_module_config('notifications', 'mail_charset'),
            'mail_protocol'   => $this->ci->pg_module->get_module_config('notifications', 'mail_protocol'),
            'mail_mailpath'   => $this->ci->pg_module->get_module_config('notifications', 'mail_mailpath'),
            'mail_smtp_host'  => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_host'),
            'mail_smtp_user'  => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_user'),
            'mail_smtp_pass'  => htmlspecialchars_decode($this->ci->pg_module->get_module_config('notifications', 'mail_smtp_pass')),
            'mail_smtp_port'  => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_port'),
            'mail_useragent'  => $this->ci->pg_module->get_module_config('notifications', 'mail_useragent'),
            'mail_from_email' => $this->ci->pg_module->get_module_config('notifications', 'mail_from_email'),
            'mail_from_name'  => $this->ci->pg_module->get_module_config('notifications', 'mail_from_name'),
        ];

        // Check if openssl extension is loaded. It is required for DKIM.
        $openssl_loaded = extension_loaded('openssl');
        if ($openssl_loaded) {
            $data['dkim_private_key'] = $this->ci->pg_module->get_module_config('notifications', 'dkim_private_key');
            $data['dkim_domain_selector'] = $this->ci->pg_module->get_module_config('notifications', 'dkim_domain_selector');
            $this->view->assign('openssl_loaded', true);
        }

        if ($submit) {
            $validate = $this->_validate_settings_form();
            if (!empty($validate["errors"])) {
                $this->ci->view->assign('settings_errors', $validate["errors"]);
                $data = $validate["data"];
            } else {
                $this->_save_settings_form($validate["data"]);

                return false;
            }
        }

        $this->ci->view->assign('protocol_lang', ld('protocol', 'notifications'));
        $this->ci->view->assign('settings_data', $data);
        $html = $this->ci->view->fetch('install_settings_form', 'admin', 'notifications');

        return $html;
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data['action'], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]['items']);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('notifications', 'menu', $langs_ids);

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

    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            "name"     => "Notification sender",
            "module"   => "notifications",
            "model"    => "Sender_model",
            "method"   => "cron_que_sender",
            "cron_tab" => "*/25 * * * *",
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
        $langs_file = $this->ci->Install_model->language_file_read('notifications', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'notifications';
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
        $params['where']['module'] = 'notifications';
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
        $params['where']['module'] = 'notifications';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function arbitraryInstalling()
    {
        // add entries for lang data updates
        $lang_dm_data = [
            'module'        => 'notifications',
            'model'         => 'Templates_model',
            'method_add'    => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data["where"]["module"] = "notifications";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

    public function arbitraryDeinstalling()
    {
        /// delete entries in dedicate modules
        $lang_dm_data['where'] = [
            'module' => 'notifications',
            'model'  => 'Templates_model',
        ];
        $this->ci->pg_language->delete_dedicate_modules_entry($lang_dm_data);
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
