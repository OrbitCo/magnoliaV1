<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

use Pg\Libraries\Traits\ModuleModel;

/**
 * Install module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Install Updates Model
 *
 * @package     PG_Core
 * @subpackage  Install
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UpdatesModel extends \Model
{
    use ModuleModel;

    /**
     * Custom prefix
     * example (<custom_ns>...code...</custom_ns>)
     *
     * @return string
     */
    public const CUSTOM_PREFIX_TAG = '<custom_';

    /**
     * Prepare updating method
     *
     * @var string
     */
    public $prepare_updating_method = 'prepareUpdating';

    /**
     * Arbitrary updating method
     *
     * @var string
     */
    public $arbitrary_updating_method = 'arbitraryUpdating';

    /**
     * Arbitrary update language method
     *
     * @var string
     */
    public $arbitrary_lang_update_method = 'arbitraryLangUpdate';

    /**
     * Class constructor
     *
     * @retrun Updates_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model("Install_model");
    }

    /**
     * Return modules with available update as array
     *
     * @return array
     */
    public function getEnabledProductUpdates(): array
    {
        $dir_path = UPDPATH . 'product_updates';
        if (!file_exists($dir_path)) {
            $this->ci->load->model('install/models/UpdaterDownloaderModel');

            return $this->ci->UpdaterDownloaderModel->getLastVersionUpdater();
        }
        $updates = [];
        $d = dir($dir_path);
        while (false !== ($entry = $d->read())) {
            if (substr($entry, 0, 1) === '.' || 'index.html' === $entry) {
                continue;
            }
            $conf = $this->getUpdateProductConfig($entry, 'product_updates');
            $updates[$entry] = $conf;
        }
        $d->close();

        return $updates;
    }

    /**
     * Check module is need updating
     *
     * @param array $module_conf module configuration
     *
     * @return int
     */
    public function isUpdateActual(array $module_conf): int
    {
        $installed_modules = $this->ci->Install_model->get_installed_modules();
        $need_update = 0;
        foreach ($module_conf as $module_gid => $action) {
            if (!is_array($action)) {
                if ($action == 'delete') {
                    if (isset($installed_modules[$module_gid])) {
                        $need_update = 1;

                        break;
                    }
                }
                if ($action == 'install') {
                    if (!isset($installed_modules[$module_gid])) {
                        $need_update = 1;

                        break;
                    }
                }
            } else {
                if (isset($action['update'])) {
                    if (isset($installed_modules[$module_gid]) && ($action['update']['version_from'] == $installed_modules[$module_gid]["version"])) {
                        $need_update = 1;

                        break;
                    }
                }
            }
        }

        return $need_update;
    }

    /**
     * Return enabled updates
     *
     * @return array
     */
    public function getEnabledUpdates(): array
    {
        $updates = [];
        $installed_modules = $this->ci->Install_model->get_installed_modules();

        $dir_path = UPDPATH;
        if (!is_dir($dir_path)) {
            return $updates;
        }
        $d = dir($dir_path);
        while (false !== ($entry = $d->read())) {
            if (substr($entry, 0, 1) == '.') {
                continue;
            }

            $module = $this->isModuleForUpdate($entry);
            if (!$module['available']) {
                continue;
            }
            $update_data = $this->getUpdateConfig($entry);
            if (empty($update_data) || $update_data['version_from'] != $installed_modules[$module['name']]["version"]) {
                continue;
            }
            $updates[$entry] = array_merge($installed_modules[$module['name']], $update_data);
        }
        $d->close();

        return $updates;
    }

    /**
     * Return module path by path name
     *
     * @param string $path_name path name
     *
     * @return string/false
     */
    public function getModuleByPath(string $path_name)
    {
        $path_name = mb_strrchr($path_name, '_', true);
        $installed_modules = $this->ci->Install_model->get_installed_modules();
        if (in_array($path_name, array_keys($installed_modules))) {
            return $path_name;
        }

        return false;
    }

    /**
     * Check module is need updating
     *
     * @param string $path_name path name
     *
     * @return array
     */
    public function isModuleForUpdate(string $path_name): array
    {
        $path_name = mb_strrchr($path_name, '_', true);
        $installed_modules = $this->ci->Install_model->get_installed_modules();

        return [
            'name' => $path_name,
            'available' => in_array($path_name, array_keys($installed_modules)),
        ];
    }

    /**
     * Return update configuration
     *
     * @param string $module_gid module guid
     * @param string $path module path
     *
     * @return array/false
     */
    public function getUpdateConfig(string $module_gid, string $path = ''): array
    {
        if (!$path) {
            $path = $module_gid;
        }
        $update = [];
        $update_config = UPDPATH . $path . '/update.php';
        if (file_exists($update_config)) {
            require $update_config;
        }

        return $update;
    }

    /**
     * Return product update configuration
     *
     * @param string $file update file name
     * @param string $path path to update
     * @reutrn array/false
     */
    public function getUpdateProductConfig(string $file, string $path = ''): array
    {
        $update = [];

        $product_update_config = UPDPATH . $path . '/' . $file;
        if (file_exists($product_update_config)) {
            require $product_update_config;
        }

        return $update;
    }

    /**
     * Return files of module has changed
     *
     * @param string $module_gid module guid
     *
     * @return array
     */
    public function getModuleChangedFiles(string $module_gid): array
    {
        $files = [];
        $module = $this->ci->pg_module->get_module_by_gid($module_gid);
        $module_config = $this->ci->Install_model->get_module_config($module_gid);
        $uts = strtotime($module["date_update"]);
        if (strtotime($module["date_add"]) > $uts) {
            $uts = strtotime($module["date_add"]);
        }

        foreach ($module_config["files"] as $file) {
            if ($file[0] == 'file' && file_exists(SITE_PHYSICAL_PATH . $file[2])) {
                $mtime = filemtime(SITE_PHYSICAL_PATH . $file[2]);
                if ($mtime > $uts) {
                    $files[] = ['file' => $file[2], 'date' => date("Y-m-d H:i:s", $mtime)];
                }
            }
        }

        return $files;
    }

    /**
     * Update module database
     *
     * @param string $module_gid module guid
     *
     * @return void
     */
    public function migrate(string $module_gid)
    {
        $this->ci->load->model('install/models/InstallMigrateModel');
        $this->ci->InstallMigrateModel->setModule($module_gid)->execute('migrate', ENVIRONMENT);
        $this->ci->InstallMigrateModel->setModule($module_gid)->execute('seed:run', ENVIRONMENT);
    }

    /**
     * Update module languages
     *
     * @param string $module_gid module guid
     * @param string $path to update file
     *
     * @return boolean
     */
    public function updateLanguageInstall(string $module_gid, string $path = ''): bool
    {
        $path = $path ?? $module_gid;

        $lang_file = UPDPATH . $path . '/lang.php';
        if (!file_exists($lang_file)) {
            return false;
        }

        $install_lang = [];

        require $lang_file;

        if (empty($install_lang)) {
            return false;
        }

        foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
            if (!isset($install_lang[$lang_data['code']])) {
                continue;
            }
            $lang_data = $install_lang[$lang_data['code']];

            if (!empty($lang_data['pages'])) {
                $this->ci->pg_language->pages->set_strings($module_gid, $lang_data['pages'], $lang_id);
            }

            if (!empty($lang_data['ds'])) {
                foreach ($lang_data['ds'] as $ref_gid => $value) {
                    $this->ci->pg_language->ds->set_module_reference($module_gid, $ref_gid, $value, $lang_id);
                }
            }
        }

        return true;
    }

    /**
     * Update module settings
     *
     * @param string $module_gid module guid
     * @param string $path path to module
     *
     * @return boolean
     */
    public function updateSettingsInstall(string $module_gid, string $path = ''): bool
    {
        $path = $path ?? $module_gid;
        $settings_file = UPDPATH . $path . '/settings.php';
        if (!file_exists($settings_file)) {
            return false;
        }
        $install_settings = [];

        require $settings_file;
        if (empty($install_settings)) {
            return false;
        }

        foreach ($install_settings as $config_gid => $value) {
            $this->ci->pg_module->set_module_config($module_gid, $config_gid, $value);
        }

        return true;
    }

    /**
     * Update module permissions
     *
     * @param string $module_gid module guid
     * @param string $path path to module
     *
     * @return boolean
     */
    public function updatePermissionsInstall(string $module_gid, string $path = ''): bool
    {
        $path = $path ?? $module_gid;
        $permissions_file = UPDPATH . $path . '/permissions.php';
        if (!file_exists($permissions_file)) {
            return false;
        }
        $_permissions = [];

        require $permissions_file;
        if (empty($_permissions)) {
            return false;
        }

        foreach ($_permissions as $controller => $data) {
            $this->ci->pg_module->set_module_methods_access($module_gid, $controller, $data);
        }

        return true;
    }

    /**
     * Update module data
     *
     * @param string $module_gid module guid
     * @param string $path path to module
     *
     * @return void
     */
    public function updateArbitraryInstall(string $module_gid, string $path = '')
    {
        $path = $path ?? $module_gid;
        $model_name = ucfirst($module_gid) . 'UpdateModel';
        $model_file = UPDPATH . $path . InstallModel::DS . $model_name . EXT;

        if (file_exists($model_file)) {
            require_once $model_file;
            // TODO: Это вряд ли будет работать с неймспейсами. Проверить и пофиксить.
            $update_model = new $model_name();

            $method_name = $this->prepare_updating_method;

            // TODO: убрать проверку __call после приведения к PSR
            $validate_exists = method_exists($update_model, $method_name) || method_exists($update_model, '__call');
            if ($validate_exists) {
                $update_model->{$method_name}();
            }

            $config = $this->ci->Install_model->get_module_config($module_gid);
            $linked_modules = (array)$config['linked_modules']['install'];
            $installed_modules = array_keys($this->ci->Install_model->get_installed_modules());
            $langs_ids = array_keys($this->ci->pg_language->languages);
            foreach ($linked_modules as $linked_module => $linked_method) {
                if (strpos($linked_module, ';') !== false) {
                    $linked_modules = explode(';', $linked_module);
                } else {
                    $linked_modules = [$linked_module];
                }
                if (count(array_diff($linked_modules, $installed_modules)) == 0) {
                    $method_name = (is_array($linked_method) ? $linked_method['name'] : $linked_method) . '_update';
                    // TODO: убрать проверку __call после приведения к PSR
                    if (method_exists($update_model, $method_name) || method_exists($update_model, '__call')) {
                        $update_model->{$method_name}();
                    }
                }
            }

            $method_name = $this->arbitrary_updating_method;
            // TODO: убрать проверку __call после приведения к PSR
            $validate_exists = method_exists($update_model, $method_name) || method_exists($update_model, '__call');
            if ($validate_exists) {
                $update_model->{$method_name}();
            }
        }
    }

    /**
     * Load update model for the module
     *
     * @param string $module_gid module guid
     * @param string $path path to update
     *
     * @return Model/false
     */
    public function loadUpdateModel(string $module_gid, string $path = '')
    {
        if (!$path) {
            $path = $module_gid;
        }
        $model_name = ucfirst($module_gid . 'UpdateModel');
        $model_file = UPDPATH . $path . '/' . strtolower($model_name) . EXT;
        if (file_exists($model_file)) {
            require_once $model_file;

            return new $model_name();
        }

        return false;
    }

    /**
     * Update module information
     *
     * @param string $module_gid module guid
     * @param array $data update data
     *
     * @return void
     */
    public function updateModuleInformation(string $module_gid, array $data)
    {
        $this->ci->pg_module->set_module_update($module_gid, $data);
    }

    /**
     * Update product information
     *
     * @param string $version_name
     * @param string|null $version_code
     *
     * @return void
     */
    public function updateProductInformation(string $version_name, string $version_code = null)
    {
        if (strripos($version_name, '.')) {
            list($version_name, $version_code) = explode('.', $version_name, 2);
        }
        $this->ci->pg_module->set_module_config('start', 'product_version_name', $version_name);
        $this->ci->pg_module->set_module_config('start', 'product_version_name_update', $version_name);
        if (!empty($version_code)) {
            $this->ci->pg_module->set_module_config('start', 'product_version_code', $version_code);
            $this->ci->pg_module->set_module_config('start', 'product_version_code_update', $version_code);
        }
        $this->ci->pg_module->set_module_config('start', 'is_new_update', 0);
    }

    /**
     * Copy and backup files
     *
     * @param array $data
     *
     * @return array
     */
    public function copyAndBackupFiles(array $data): array
    {
        $errors = [];

        $product_version = $this->pg_module->get_module_config('start', 'product_version_code') ?? 'v1';
        $this->ci->load->model('install/models/BackupModel');
        foreach ($data['files'] as $file) {
            $new_file_type = $file[0];
            $new_file_access = $file[1];
            $new_file = $file[2];
            $new_file_path = SITE_PHYSICAL_PATH . $file[2];

            if ($new_file_type == 'file') {
                $old_file = UPDATES_FOLDER . $data['path'] . '/' . $file[2];
                $old_file_path = UPDPATH . $data['path'] . '/' . $file[2];

                if (!file_exists($old_file_path) && file_exists($new_file_path)) {
                    $result = true;
                } else {
                    $new_file_data = pathinfo($new_file);
                    // Backup old version
                    if (file_exists($new_file_path)) {
                        $this->ci->BackupModel->backupFilesOnServer([
                            'backup_dir' => $product_version . '/' . $new_file_data['dirname'],
                            'backup_file' => $product_version . '/' . $new_file_data['dirname'] . '/' . $new_file_data['basename'],
                            'new_file' => $new_file
                        ]);
                    } elseif (!is_dir(SITE_PHYSICAL_PATH . $new_file_data['dirname'])) {
                        mkdir(SITE_PHYSICAL_PATH . $new_file_data['dirname'], 0777, true);
                    }
                    $has_custom = $this->hasCustomCode($new_file);
                    if ($has_custom === true) {
                        copy($old_file, $new_file . '.orig');
                    } else {
                        if (file_exists($new_file)) {
                            unlink($new_file);
                        }
                        copy($old_file, $new_file);
                    }
                }
            } elseif ($new_file_type == 'dir') {
                if (!file_exists($new_file_path)) {
                    mkdir($new_file, 0777, true);
                }
            }
        }

        return $errors;
    }

    /**
     * Search custom code
     *
     * @param string $file
     *
     * @return boolean
     */
    public function hasCustomCode(string $file): bool
    {
        $has_custom = false;
        if (file_exists($file) === true && basename($file) != 'UpdatesModel.php') {
            $content = (string) file_get_contents($file);
            if (strpos($content, self::CUSTOM_PREFIX_TAG) !== false) {
                $has_custom = true;
            }
        }

        return $has_custom;
    }

    //TODO (nsavanaev) удалитиь после приведения к PSR
    public function __call($name, $args)
    {
        return call_user_func_array([$this, $this->ucfirstModule($name)], $args);
    }
}
