<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

/**
 * Install module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Backup Model
 *
 * @package     PG_Core
 * @subpackage  Install
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BackupModel extends \Model
{
    /**
     * Backup folder
     *
     * @var string;
     */
    public const BACKUP_FOLDER = 'backup';

    /**
     * Backup path
     *
     * @var string
     */
    public const BACKUP_PATH = SITE_PHYSICAL_PATH . self::BACKUP_FOLDER;

    public function generate_module_settings_install($module_gid)
    {
        $this->ci->load->library('zip');
        $this->ci->zip->add_dir('application/modules/' . $module_gid . '/install');

        //lang back up
        $this->ci->load->model("Install_model");
        $model = $this->ci->Install_model->load_install_model($module_gid);
        $config = $this->ci->Install_model->get_module_config($module_gid);
        $linked_modules = (array) $config['linked_modules']['install'];
        $installed_modules = array_keys($this->ci->Install_model->get_installed_modules());
        $langs_path = 'application/modules/' . $module_gid . '/langs/';

        // Add langs data to the zip file
        $available_langs = $this->Install_model->get_available_langs();
        $langs = [];
        foreach ($available_langs as $avail_lang) {
            $langs[] = $avail_lang['code'];
        }

        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            if (!in_array($lang_data['code'], $langs)) {
                continue;
            }
            // pages
            $lang_install_code = $this->ci->pg_language->generate_install_module_lang($module_gid, $lang_id, "pages");
            if ($lang_install_code) {
                $this->ci->zip->add_data($langs_path . $lang_data['code'] . '/pages.php', $lang_install_code);
            }
            // ds
            $lang_install_code = $this->ci->pg_language->generate_install_module_lang($module_gid, $lang_id, 'ds');
            if ($lang_install_code) {
                $this->ci->zip->add_data($langs_path . $lang_data['code'] . '/ds.php', $lang_install_code);
            }
            // arbitrary
            // TODO: убрать проверку __call после приведения к PSR
            if (method_exists($model, '_arbitrary_lang_export') || method_exists($model, '__call')) {
                $langs_data = $this->ci->Install_model->execute_method($model, '_arbitrary_lang_export', null, (array) $lang_id);
                foreach ($langs_data as $lmodule => $ldata) {
                    $lang_install_code = $this->ci->pg_language->generate_install_linked_lang($ldata, $lang_id);
                    $this->ci->zip->add_data($langs_path . $lang_data['code'] . '/' . $lmodule . '.php', $lang_install_code);
                }
            }
            // linked modules
            foreach ($linked_modules as $linked_module => $linked_method) {
                if (in_array($linked_module, $installed_modules)) {
                    $method_name = (is_array($linked_method) ? $linked_method['name'] : $linked_method) . '_lang_export';
                    // TODO: убрать проверку __call после приведения к PSR
                    if (method_exists($model, $method_name) || method_exists($model, '__call')) {
                        $langs_data = $this->ci->Install_model->execute_method($model, $method_name, null, (array) $lang_id);
                        foreach ($langs_data as $lmodule => $ldata) {
                            $lang_install_code = $this->ci->pg_language->generate_install_linked_lang($ldata, $lang_id);
                            $this->ci->zip->add_data($langs_path . $lang_data['code'] . '/' . $lmodule . '.php', $lang_install_code);
                        }
                    }
                }
            }
        }

        $perm_install_code = $this->ci->pg_module->generate_install_module_permissions($module_gid);
        $this->ci->zip->add_data('application/modules/' . $module_gid . '/install/permissions.php', $perm_install_code);

        $sett_install_code = $this->ci->pg_module->generate_install_module_settings($module_gid);
        $this->ci->zip->add_data('application/modules/' . $module_gid . '/install/settings.php', $sett_install_code);
        $this->ci->zip->download($module_gid . '_settings_backup_' . date('ymd') . '.zip');
    }

    public function generate_product_permissions_install()
    {
        $this->ci->load->library('zip');

        $modules = $this->ci->pg_module->return_modules();
        if (empty($modules)) {
            return false;
        }

        $this->ci->zip->add_dir('application/modules');
        foreach ($modules as $module) {
            $perm_install_code = $this->ci->pg_module->generate_install_module_permissions($module["module_gid"]);
            $this->ci->zip->add_data('application/modules/' . $module["module_gid"] . '/install/permissions.php', $perm_install_code);
        }

        $this->ci->zip->download('permissions_install.zip');
    }

    public function generate_module_files_backup($module_gid)
    {
        $this->ci->load->library('zip');
        $this->ci->load->model("Install_model");
        $module = $this->ci->Install_model->get_module_config($module_gid);
        foreach ($module["files"] as $file) {
            if ($file[0] == 'file') {
                $content = file_get_contents(SITE_PHYSICAL_PATH . $file[2]);
                $this->ci->zip->add_data($file[2], $content);
            } else {
                $this->ci->zip->add_dir($file[2]);
            }
        }
        $this->ci->zip->download($module_gid . '_backup_' . date('ymd') . '.zip');
    }

    public function generate_product_modules_files_backup()
    {
        $modules = $this->get_product_setup_modules();

        $this->ci->load->library('zip');

        $this->ci->load->model('Install_model');

        foreach ($modules as $module_gid) {
            $module = $this->ci->Install_model->get_module_config($module_gid);
            foreach ($module["files"] as $file) {
                if ($file[0] == 'file') {
                    $content = file_get_contents(SITE_PHYSICAL_PATH . $file[2]);
                    $this->ci->zip->add_data(module_gid . "/" . $file[2], $content);
                } else {
                    $this->ci->zip->add_dir($module_gid . "/" . $file[2]);
                }
            }
        }
        $this->ci->zip->download('modules_backup_' . date('ymd') . '.zip');
    }

    /**
     * Backup files on server
     *
     * @param array $data
     *
     * @return void
     */
    public function backupFilesOnServer(array $data)
    {
        $backup_dir = self::BACKUP_FOLDER . InstallModel::DS . $data['backup_dir'];
        $backup_file = self::BACKUP_FOLDER . InstallModel::DS . $data['backup_file'];

        if (!file_exists(SITE_PHYSICAL_PATH . $backup_dir)) {
            mkdir(SITE_PHYSICAL_PATH . $backup_dir, 0777, true);
        }
        if (file_exists(SITE_PHYSICAL_PATH . $backup_file)) {
            unlink(SITE_PHYSICAL_PATH . $backup_file);
        }
        copy(SITE_PHYSICAL_PATH . $data['new_file'], SITE_PHYSICAL_PATH . $backup_file);
    }

    /**
     * Create Backup File Info
     *
     * @return void
     */
    public function createBackupFileInfo()
    {
        $product_version = $this->pg_module->get_module_config('start', 'product_version_code') ?? 'v1';
        $backup_dir = self::BACKUP_PATH . InstallModel::DS . $product_version;
        $file_info = "{$backup_dir}/info.php";
        if (!is_file($file_info)) {
            touch($file_info);
        }
        $data = ['backup_dir' => $product_version, 'info' => ['custom' => []]];
        $raw_files = $this->getFileList($backup_dir);
        $this->ci->load->model('install/models/UpdatesModel');
        foreach ($raw_files as $file) {
            $has_custom = $this->ci->UpdatesModel->hasCustomCode($file->getRealPath());
            if ($has_custom === true) {
                $data['info']['custom'][] = $file->getRealPath();
            }
        }

        $start = <<<'EOD'
<?php

return
EOD;

        file_put_contents($file_info, $start . (new SystemUtilityModel())->varExport($data, true) . ';');
    }

    /**
     * Filest list
     *
     * @param string $path
     *
     * @return array
     */
    protected function getFileList(string $path): array
    {
        $files = [];
        foreach (new \DirectoryIterator($path) as $file_info) {
            if ($file_info->isDot()) {
                continue;
            }
            if ($file_info->isDir()) {
                $files = array_merge($files, $this->getFileList($file_info->getRealPath()));
            } else {
                $files[] = clone $file_info;
            }
        }

        return $files;
    }
}
