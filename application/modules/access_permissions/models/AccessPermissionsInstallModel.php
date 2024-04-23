<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\models;

use Pg\Libraries\Setup;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AccessPermissionsInstallModel extends \Model
{

    /**
     * Module data Access_permissions object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Demo content Access_permissions object
     *
     * @var array
     */
    protected $demo_content;

    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Access Control List
     *
     * @var array
     */
    protected $acl_data;

    /**
     * AccessPermissionsInstallModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(
            AccessPermissionsModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
        $this->demo_content = Setup::getModuleData(
            AccessPermissionsModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
        $this->access_permissions = Setup::getModuleData(
            AccessPermissionsModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
        $this->acl_data = Setup::getModuleData(
            AccessPermissionsModel::MODULE_GID,
            Setup::TYPE_ACL
        );
    }

    /**
     * Install data of menu module
     *
     * @return void
     */
    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $this->modules_data['menu'][$gid]['id'] = linked_install_set_menu(
                $gid,
                $menu_data["action"],
                isset($menu_data["name"]) ? $menu_data["name"] : ''
            );
            linked_install_process_menu_items(
                $this->modules_data['menu'],
                'create',
                $gid,
                0,
                $this->modules_data['menu'][$gid]['items']
            );
        }
        if (!empty($this->modules_data['menu_indicators'])) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->modules_data['menu_indicators'] as $data) {
                $this->ci->Indicators_model->saveType(null, $data);
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
        $langs_file = $this->ci->Install_model->language_file_read(
            AccessPermissionsModel::MODULE_GID,
            'menu',
            $langs_ids
        );
        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');
            return false;
        }
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items(
                $this->modules_data['menu'],
                'update',
                $gid,
                0,
                $this->modules_data['menu'][$gid]['items'],
                $gid,
                $langs_file
            );
        }
        if (!empty($this->modules_data['menu_indicators'])) {
            $langs_file = $this->ci->Install_model->language_file_read(
                AccessPermissionsModel::MODULE_GID,
                'indicators',
                $langs_ids
            );
            if (!$langs_file) {
                log_message('info', '(resumes) Empty indicators langs data');
                return false;
            } else {
                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->updateLangs($this->modules_data['menu_indicators'], $langs_file, $langs_ids);
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp   = linked_install_process_menu_items(
                $this->modules_data['menu'],
                'export',
                $gid,
                0,
                $this->modules_data['menu'][$gid]['items'],
                $gid,
                $langs_ids
            );
            $return = array_merge($return, $temp);
        }
        if (!empty($this->modules_data['menu_indicators'])) {
            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->exportLangs($this->modules_data['menu_indicators'], $langs_ids);
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items(
                    $gid,
                    $this->modules_data['menu'][$gid]['items']
                );
            }
        }
        if (!empty($this->modules_data['menu_indicators'])) {
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($this->modules_data['menu_indicators'] as $data) {
                $this->ci->Indicators_model->deleteType($data['gid']);
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

        foreach ($this->modules_data['moderators_methods'] as $method) {
            $this->ci->Moderators_model->saveMethod(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('access_permissions', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'access_permissions';
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
        $params['where']['module'] = 'access_permissions';
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
        $params['where']['module'] = 'access_permissions';
        $this->ci->Moderators_model->delete_methods($params);
    }

    /**
     * Install data of payments module
     *
     * @return void
     */
    public function installPayments()
    {
        $this->ci->load->model('Payments_model');
        foreach ($this->modules_data['payment_types'] as $payment_type) {
            $this->ci->Payments_model->savePaymentType(null, [
                'gid' => $payment_type['gid'],
                'callback_module' => $payment_type['callback_module'],
                'callback_model'  => $payment_type['callback_model'],
                'callback_method' => $payment_type['callback_method'],
            ]);
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
        $langs_file = $this->ci->Install_model->language_file_read(AccessPermissionsModel::MODULE_GID, 'payments', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty payments langs data (memberships)');
            return false;
        }
        $this->ci->load->model('Payments_model');
        $this->ci->Payments_model->updateLangs($this->modules_data['payment_types'], $langs_file, $langs_ids);
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
        return [
            "payments" => $this->ci->Payments_model->exportLangs($this->modules_data['payment_types'], $langs_ids)
        ];
    }

    /**
     * Uninstall data of payments module
     *
     * @return void
     */
    public function deinstallPayments()
    {
        $this->ci->load->model('Payments_model');
        foreach ($this->modules_data['payment_types'] as $payment_type) {
            $this->ci->Payments_model->deletePaymentTypeByGid($payment_type['gid']);
        }
    }

    /**
     * Install cronjob data
     *
     * @return void
     */
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ($this->modules_data['cron_data'] as $cronjob) {
            $this->ci->Cronjob_model->saveCron(null, $cronjob);
        }
    }

    /**
     * Uninstall cronjob data
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $this->ci->Cronjob_model->deleteCronByParam([
            'where' => ['module' => AccessPermissionsModel::MODULE_GID]
        ]);
    }

    /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        $this->installDemoContent();
    }

    /**
     * Deinstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
        $this->ci->load->model([
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
            'Users_model'
        ]);
        $data = [
            'groups' => $this->ci->Access_permissions_groups_model->getPaidGroups(),
            'user_types' => $this->ci->Users_model->getUserTypes()
        ];
        $roles = [];
        foreach ($data['groups'] as $group) {
            $roles[] = 'user_' . $group['gid'];
            $this->ci->Access_permissions_groups_model->deleteSubscription($group['id']);
            foreach ($data['user_types'] as $type) {
                $roles[] = 'user_' . $group['gid'] . '_' . $type;
            }
        }
        if (!empty($roles)) {
            $this->ci->db->where_in('role', $roles);
            $this->ci->db->delete(PERMISSIONS_TABLE);
        }
        $this->ci->db->where('type', \BeatSwitch\Lock\Permissions\Restriction::TYPE);
        $this->ci->db->update(
            PERMISSIONS_TABLE,
            ['type' => \BeatSwitch\Lock\Permissions\Privilege::TYPE]
        );
        $this->ci->Access_permissions_groups_model->deleteAllGroups();
    }

    /**
     * Add Access Control List
     *
     * @return void
     */
    protected function addACL()
    {
        if (!empty($this->acl_data)) {
            $action_view_page = new \Pg\Libraries\Acl\Action\ViewPage();
            foreach ($this->acl_data as $module => $data) {
                foreach ($data[AccessPermissionsModel::USER] as $method) {
                    $res_page = new \Pg\Libraries\Acl\Resource\Page(
                        ['module' => $module, 'controller' => $module, 'action' => $method]
                    );
                    $this->ci->acl->getManager()
                            ->role(AccessPermissionsModel::USER)
                            ->allow($action_view_page->getGid(), $res_page->getResourceType(), $res_page->getResourceId());
                }
            }
        }
    }

    /**
     * Install demo content
     *
     * @return boolean/void
     */
    protected function installDemoContent()
    {
        if (empty($this->demo_content)) {
            return false;
        } else {
            $this->ci->load->model([
                'Access_permissions_model',
                AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_groups_model',
                AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model'
            ]);
            $access = $this->ci->Access_permissions_model->roles[AccessPermissionsModel::USER];
            foreach ($this->demo_content['groups'] as $group) {
                foreach ($this->ci->pg_language->languages as $l) {
                    $group['name_' . $l['id']] = isset($group['name'][$l['code']]) ? $group['name'][$l['code']] : $group['name']['en'];
                    $group['description_' . $l['id']] = isset($group['description'][$l['code']]) ? $group['description'][$l['code']] : $group['description']['en'];
                }
                $validate_data = $this->ci->Access_permissions_groups_model->validateSubscription(null, $group);
                if (empty($validate_data['errors'])) {
                    $this->ci->Access_permissions_groups_model->saveSubscription(null, $validate_data['data']);
                    $this->ci->Access_permissions_groups_model->addPeriod($validate_data['data']['gid']);
                    $this->ci->Access_permissions_model->callbackGroupAdd($validate_data['data']['gid']);
                }
            }
            foreach ($this->demo_content['periods'] as $period) {
                $this->ci->Access_permissions_settings_model
                    ->getAccessData($access)->savePeriod(null, $period);
            }
            $this->addDemoAcl($this->demo_content['acl']);
        }
    }

    /**
     * Add demo acl
     *
     * @param array $demo_content
     *
     * @return void
     */
    public function addDemoAcl(array $demo_content)
    {
        $this->ci->load->model([
            'Access_permissions_model',
            AccessPermissionsModel::MODULE_GID . '/models/Access_permissions_settings_model'
        ]);
        $access = $this->ci->Access_permissions_model->roles[AccessPermissionsModel::USER];
        foreach ($demo_content as $acl) {
            $validate_data = $this->ci->Access_permissions_settings_model->getAccessData($access)->validatePermissions($acl['permissions'], $acl['module'], true);
            if (empty($validate_data["errors"])) {
                foreach ($validate_data['data'] as $data) {
                    $this->ci->Access_permissions_settings_model->getAccessData($access)
                        ->savePermissions($data['attrs'], $data['params']);
                    if (isset($data['settings'])) {
                        $this->ci->Access_permissions_settings_model->getAccessData($access)
                            ->savePermissionsSettings($data['settings']);
                    }
                }
            }
        }
    }
}
