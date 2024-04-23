<?php

declare(strict_types=1);

namespace Pg\modules\moderation\models;

use Pg\Libraries\Setup;

/**
 * Moderation install model
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
class ModerationInstallModel extends \Model
{

    /**
     *Modules data
     *
     * @var array
     */
    public $modules_data;

    /**
     * Demo content
     *
     * @var array
     */
    public $demo_content;

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(ModerationModel::MODULE_GID, Setup::TYPE_MODULES_DATA);
        $this->demo_content = Setup::getModuleData(ModerationModel::MODULE_GID, Setup::TYPE_DEMO_CONTENT);
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $this->modules_data['menu'][$gid]['id'] = \Pg\modules\menu\helpers\linkedInstallSetMenu($gid,
                $menu_data["action"],
                isset($menu_data["name"]) ? $menu_data["name"] : '');
            linked_install_process_menu_items($this->modules_data['menu'], 'create', $gid, 0, $this->modules_data['menu'][$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('moderation', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');
            return false;
        }

        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items($this->modules_data['menu'], 'update', $gid, 0, $this->modules_data['menu'][$gid]["items"], $gid, $langs_file);
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->modules_data['menu'], 'export', $gid, 0, $this->modules_data['menu'][$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->modules_data['menu'][$gid]['items']);
            }
        }
    }

    /**
     * Moderators module methods
     */
    public function installModerators()
    {
        $this->ci->load->model('Moderators_model');
        foreach ($this->modules_data['moderators_methods'] as $method) {
            $this->ci->Moderators_model->saveMethod(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('moderation', 'moderators', $langs_ids);
        $this->ci->load->model('Moderators_model');
        $methods = $this->ci->Moderators_model->getMethodsLangExport([
            'where' => ['module' => 'moderation']
        ]);
        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->saveMethod($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('Moderators_model');
        $methods =  $this->ci->Moderators_model->get_methods_lang_export([
            'where' => ['module' => 'moderation']
        ], $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }
        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        $this->ci->load->model('Moderators_model');
        $this->ci->Moderators_model->delete_methods([
            'where' => ['module' => 'moderation']
        ]);
    }

    public function arbitraryInstalling()
    {
        $this->installDemoContent();
    }

    public function arbitraryDeinstalling()
    {
    }

    /**
     * Install demo content
     *
     * @return type
     */
    protected function installDemoContent()
    {
        if (!empty($this->demo_content)) {
            $this->ci->load->model('Moderation_model');
            $this->ci->Moderation_model->installBatch($this->demo_content);
        }
    }

     /**
     * Install notifications module
     *
     * @return void
     */
    public function installNotifications()
    {
        $this->ci->load->model(['Notifications_model', 'notifications/models/Templates_model']);
        foreach ($this->modules_data['notifications']['templates'] as $tpl) {
            $template_data = [
                'module' => ModerationModel::MODULE_GID,
                'gid' => $tpl['gid'],
                'name' => $tpl['name'],
                'vars' => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->saveTemplate(null, $template_data);
        }
        foreach ($this->modules_data['notifications']['notifications'] as $notification) {
            $notification_data = [
                'module' => ModerationModel::MODULE_GID,
                'gid' => $notification['gid'],
                'send_type' => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $this->ci->Notifications_model->saveNotification(null, $notification_data);
        }
    }

    /**
     * Install notifications lang update
     *
     * @param array $langs_ids
     *
     * @return boolean
     */
    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs_file = $this->ci->Install_model->language_file_read(ModerationModel::MODULE_GID, 'notifications', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');
            return false;
        }
        $this->ci->Notifications_model->updateLangs($this->modules_data['notifications'], $langs_file, $langs_ids);
        return true;
    }

    /**
     * Install notifications lang export
     *
     * @param array $langs_ids
     *
     * @return array
     */
    public function installNotificationsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->exportLangs($this->modules_data['notifications'], $langs_ids);

        return ['notifications' => $langs];
    }

    /**
     * Deinstall notifications
     *
     * @return void
     */
    public function deinstallNotifications()
    {
        $this->ci->load->model(['Notifications_model', 'notifications/models/Templates_model']);
        foreach ($this->modules_data['notifications']['templates'] as $tpl) {
            $this->ci->Templates_model->deleteTemplateByGid($tpl['gid']);
        }
        foreach ($this->modules_data['notifications']['notifications'] as $notification) {
            $this->ci->Notifications_model->deleteNotificationByGid($notification['gid']);
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
