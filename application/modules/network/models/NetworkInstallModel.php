<?php

declare(strict_types=1);

namespace Pg\modules\network\models;

use Pg\Libraries\Setup;
use Pg\Libraries\EventDispatcher;
use Pg\modules\network\models\events\EventNetwork;

/**
 * Network install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class NetworkInstallModel extends \Model
{

    /**
     * Module data Network object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * NetworkInstallModel constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('InstallModel');
        $this->modules_data = Setup::getModuleData(
            NetworkModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->modules_data['menu'][$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->modules_data['menu'], 'create', $gid, 0, $this->modules_data['menu'][$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null): bool
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->InstallModel->language_file_read(NetworkModel::MODULE_GID, 'menu', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }
        $this->ci->load->helper('menu');
        foreach (array_keys($this->modules_data['menu']) as $gid) {
            linked_install_process_menu_items($this->modules_data['menu'], 'update', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_file);
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
        foreach (array_keys($this->modules_data['menu']) as $gid) {
            $temp = linked_install_process_menu_items($this->modules_data['menu'], 'export', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_ids);
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
     * Install bonuses
     *
     * @return void
     */
    public function installBonuses()
    {
        $this->sendEvents('install_network', ['bonuses' => $this->modules_data['action_config']]);
    }

    public function installBonusesLangUpdate($langs_ids = null): bool
    {
        if (empty($langs_ids)) {
            return false;
        }

        $langs_file = $this->ci->InstallModel->language_file_read("bonuses", "ds", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty bonuses langs data");
            return false;
        }

        $this->ci->load->model("bonuses/models/BonusesUtilModel");
        $this->ci->BonusesUtilModel->updateLangs($langs_file);

        return true;
    }

    public function deinstallBonuses()
    {
        $this->sendEvents('deinstall_network', ['bonuses' => $this->modules_data['action_config']]);
    }

    public function installFieldEditor()
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize('users');
        include MODULEPATH . 'network/install/user_fields_data.php';
        $this->ci->Field_editor_model->import_type_structure($this->ci->Users_model->form_editor_type, $fe_sections, $fe_fields, $fe_forms);
    }

    public function installFieldEditorLangUpdate()
    {
        $langs_file = $this->ci->InstallModel->language_file_read(NetworkModel::MODULE_GID, 'field_editor');
        if (!$langs_file) {
            log_message('info', 'Empty field_editor langs data');

            return false;
        }
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        include MODULEPATH . 'network/install/user_fields_data.php';
        $this->ci->Field_editor_model->update_sections_langs($fe_sections, $langs_file);
        $this->ci->Field_editor_model->update_fields_langs($this->ci->Users_model->form_editor_type, $fe_fields, $langs_file);

        return true;
    }

    public function installFieldEditorLangExport($langs_ids = null)
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        list($fe_sections, $fe_fields, $fe_forms) = $this->ci->Field_editor_model->export_type_structure($this->ci->Users_model->form_editor_type, 'application/modules/network/install/user_fields_data.php');
        $sections = $this->ci->Field_editor_model->export_sections_langs($fe_sections, $langs_ids);
        $fields = $this->ci->Field_editor_model->export_fields_langs($this->ci->Users_model->form_editor_type, $fe_fields, $langs_ids);

        return ['field_editor' => array_merge($sections, $fields)];
    }

    public function deinstallFieldEditor()
    {
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        include MODULEPATH . 'network/install/user_fields_data.php';
        if (!empty($fe_fields)) {
            foreach ($fe_fields as $field) {
                $this->ci->Field_editor_model->delete_field_by_gid($field['data']['gid']);
            }
        }
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        if (!empty($fe_sections)) {
            foreach ($fe_sections as $section) {
                $this->ci->Field_editor_model->delete_section_by_gid($section['data']['gid']);
            }
        }
        if (!empty($fe_forms)) {
            foreach ($fe_forms as $form) {
                $this->ci->Field_editor_forms_model->delete_form_by_gid($form['data']['gid']);
            }
        }

        return true;
    }

    public function installCronjob()
    {
        $this->ci->load->model('CronjobModel');
        $this->ci->CronjobModel->saveCron(null, $this->modules_data['cron']);
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('CronjobModel');
        $this->ci->CronjobModel->deleteCronByParam([
            'where' => ['module' => $this->modules_data['cron']['module']]
        ]);
    }

    /**
     * Install moderation
     *
     * @return void
     */
    public function installModeration()
    {
        $this->sendEvents('install_network', ['moderation' => $this->modules_data['moderation_types']]);
    }

    /**
     * Install Moderation Lang Update
     *
     * @param null $langs_ids
     *
     * @return boolean
     */
    public function installModerationLangUpdate($langs_ids = null): bool
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array)$langs_ids;
        }
        $langs_file = $this->ci->InstallModel->language_file_read('network', 'moderation', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/ModerationTypeModel');
        $this->ci->ModerationTypeModel->updateLangs($this->modules_data['moderation_types'], $langs_file);

        return true;
    }

    /**
     * Install Moderation Lang Export
     *
     * @param array|null $langs_ids
     *
     * @return array
     */
    public function installModerationLangExport(array $langs_ids = null): array
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array)$langs_ids;
        }
        $this->ci->load->model('moderation/models/ModerationTypeModel');

        return ['moderation' => $this->ci->ModerationTypeModel->exportLangs(
            $this->modules_data['moderation_types'], $langs_ids)];
    }

    /**
     * Deinstall Moderation
     *
     * @return void
     */
    public function deinstallModeration()
    {
        $this->sendEvents('deinstall_network', ['moderation' => $this->modules_data['moderation_types']]);
    }

    private function sendEvents($action_gid, $data)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventNetwork();
        $event->setData($data);
        $event_handler->dispatch($event, $action_gid);
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
