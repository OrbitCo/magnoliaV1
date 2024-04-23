<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

class UpdaterBuilderModel extends \Model
{
    /**
     * DIRECTORY_SEPARATOR
     *
     * @var string
     */
    protected const DS = DIRECTORY_SEPARATOR;

    /**
     * application folder
     *
     * @var string
     */
    protected const DIR_APP = 'application';

    /**
     * install folder (module)
     *
     * @var string
     */
    protected const DIR_INST = 'install';

    /**
     * updates folder
     *
     * @var string
     */
    public const DIR_UPD = 'updates';

    /**
     * modules folder
     *
     * @var string
     */
    protected const DIR_MODULES = 'modules';

    /**
     * langs folder
     *
     * @var string
     */
    protected const DIR_LANGS = 'langs';

    /**
     * Configuration file module
     *
     * @var string
     */
    protected const FILE_MODULE = 'module.php';

    /**
     * Permissions file module
     *
     * @var string
     */
    protected const FILE_PERMISSIONS = 'permissions.php';

    /**
     * Settings file module
     *
     * @var string
     */
    protected const FILE_SETTINGS = 'settings.php';

    /**
     * Module location directory
     *
     * @var string
     */
    protected const SUB_DIR_MODULE = self::DIR_APP . self::DS . self::DIR_MODULES . self::DS;

    /**
     * File path for the main module file (install/module.php)
     *
     * @var string
     */
    protected const SUB_DIR_MODULE_PHP = self::DIR_INST . self::DS . self::FILE_MODULE;

    /**
     * File path for the permissions module file (install/permissions.php)
     *
     * @var string
     */
    protected const SUB_DIR_PERMISSIONS_PHP = self::DIR_INST . self::DS . self::FILE_PERMISSIONS;

    /**
     * File path for the settings module file (install/settings.php)
     *
     * @var string
     */
    protected const SUB_DIR_SETTINGS_PHP = self::DIR_INST . self::DS . self::FILE_SETTINGS;

    /**
     * Fill man (Don't fill this HERE, but in the actual update)
     *
     * @var string
     */
    protected const FILL_MAN = '[FILL_THIS]';

    /**
     * product_updates folder
     *
     * @var string
     */
    protected const PRODUCT_UPDATES = 'product_updates';

    /**
     * Other dir
     *
     * @var string
     */
    public const OTHER_DIR = 'other_data';

    /**
     * Temp modules folder
     *
     * @var string
     */
    protected const TEMP_MODULES = UpdaterDownloaderModel::TEMP_UPDATES_PATH . 'application' . self::DS . 'modules';

    /**
     * @var int|string
     */
    protected $current_folder;

    /**
     * Main update file
     *
     * @var string
     */
    protected $main_update_file_name;

    /**
     * Skip modules
     *
     * @var string[]
     */
    protected $skip_upd = ['install', self::OTHER_DIR];

    /**
     * Main update file name
     *
     * @var string
     */
    protected $name;

    /**
     * Description data
     *
     * @var string|void
     */
    protected $description;

    /**
     * From version
     *
     * @var string
     */
    protected $from_ver;

    /**
     * From directory
     *
     * @var string
     */
    protected $from_dir;

    /**
     * To version
     *
     * @var string
     */
    protected $to_ver;

    /**
     * Update data
     *
     * @var array
     */
    protected $update_data;

    /**
     * Update modules list
     *
     * @var array
     */
    protected $upd_modules = [];

    /**
     * Install modules list
     *
     * @var array
     */
    protected $inst_modules = [];

    /**
     * Set updater data
     *
     * @param array $data
     *
     * @return void
     */
    public function setUpdaterData(array $data)
    {
        $this->update_data = $data;
    }

    /**
     * Build updater
     *
     * @param array $data
     *
     * @return bool
     */
    public function buildUpdater(array $data): bool
    {
        $is_created = false;
        $is_collect = $this->collectFiles($data);
        if ($is_collect === true) {
            $this->createUpdateStructure();
            $this->createMainUpdateFile();
            $this->fillMainUpdateFile();
            $this->createUpdateFiles();
            $this->createOtherUpdateFile();
        }

        return $is_created;
    }

    /**
     * Collect files into a single structure
     *
     * @param array $data
     *
     * @return bool
     */
    protected function collectFiles(array $data): bool
    {
        ksort($data['list']);
        foreach ($data['list'] as $k => $name) {
            $this->current_folder = $k;
            $this->dirWalk(UpdaterDownloaderModel::TEMP_UPDATES_PATH . $k, [], [$this, 'cbMoveFile'], function ($iterator) {
                return $iterator->isFile();
            });

            $this->deletePath(UpdaterDownloaderModel::TEMP_UPDATES_PATH . $k);
        }

        return true;
    }

    /**
     * Assemble the structure for the updater
     *
     * @return void
     */
    protected function createUpdateStructure()
    {
        if (!is_dir(self::TEMP_MODULES)) {
            mkdir(self::TEMP_MODULES, 0777, true);
        }

        $modules_path = new \DirectoryIterator(self::TEMP_MODULES);
        foreach ($modules_path as $file_info) {
            if ($file_info->isDot() || !$file_info->isDir() || in_array($file_info->getFilename(), $this->skip_upd)) {
                continue;
            }
            $module = [];
            $module_cfg = realpath($file_info->getRealPath() . self::DS . self::SUB_DIR_MODULE_PHP);
            if (!$module_cfg) {
                continue;
            }
            require $module_cfg;
            if (1.01 === (float) $module['version'] || [] === $this->getModulePrevious($module['module']) || in_array($module['module'], $this->skip_upd)) {
                // TODO: проверить наличие всех файлов. Если не все, значит это всё-таки апдейт.
                // New module
                continue;
            }

            if (!is_dir(UPDPATH)) {
                mkdir(UPDPATH);
            }
            $update_struct = UPDPATH . $module['module'] . '_v' . $module['version'] . self::DS . self::SUB_DIR_MODULE;
            mkdir($update_struct, 0777, true);
            rename($file_info->getRealPath(), $update_struct . $module['module']);
        }
    }

    /**
     * Get module configuration
     *
     * @param string $module_name
     *
     * @return array
     */
    protected function getModulePrevious(string $module_name): array
    {
        $module = [];
        $module_file = SITE_PHYSICAL_PATH . self::DS . self::SUB_DIR_MODULE .
            $module_name . self::DS . self::DIR_INST . self::DS . self::FILE_MODULE;
        if (file_exists($module_file)) {
            require $module_file;
        }

        return $module;
    }

    /**
     * Create main update file
     *
     * @return $this
     */
    protected function createMainUpdateFile(): UpdaterBuilderModel
    {
        $dir_name = UPDPATH . self::PRODUCT_UPDATES . self::DS;
        if (!is_dir($dir_name)) {
            mkdir($dir_name, 0777, true);
        }
        $full_name = $dir_name . $this->getMainUpdateFileName();
        if (!is_file($full_name)) {
            touch($full_name);
        }

        return $this;
    }

    /**
     * Get the main update file
     *
     * @return string
     */
    protected function getMainUpdateFileName(): string
    {
        if (empty($this->main_update_file_name)) {
            $this->main_update_file_name = $this->getName() . '.php';
        }

        return $this->main_update_file_name;
    }

    /**
     * Main update file name
     *
     * @return string
     */
    protected function getName(): string
    {
        return $this->name ?: $this->getFromVer() . '_to_' . $this->getToVer();
    }

    /**
     * From version
     *
     * @return string
     */
    public function getFromVer(): string
    {
        if (empty($this->from_ver)) {
            $this->from_ver = "{$this->update_data['version']['name']}.{$this->update_data['range'][0]}";
        }

        return $this->from_ver;
    }

    /**
     * To version
     *
     * @return string
     */
    public function getToVer(): string
    {
        if (empty($this->to_ver)) {
            $this->to_ver = "{$this->update_data['version']['name']}.{$this->update_data['range'][1]}";
        }

        return $this->to_ver;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Dir walk
     *
     * @param $dir
     * @param $skip
     * @param callable $cbAction
     * @param callable|null $cbCondition
     *
     * @retun void
     */
    protected function dirWalk($dir, $skip, callable $cbAction, callable $cbCondition = null)
    {
        foreach (new \DirectoryIterator($dir) as $iterator) {
            if ($iterator->isDot() || in_array($iterator->getFilename(), $skip)) {
                continue;
            } elseif (!is_callable($cbCondition) || $cbCondition($iterator)) {
                call_user_func_array($cbAction, [$iterator]);
            } elseif ($iterator->isDir()) {
                $this->dirWalk($dir . self::DS . $iterator->getFilename(), $skip, $cbAction, $cbCondition);
            }
        }
    }

    /**
     * @throws \Exception
     */
    protected function cbMoveFile(\SplFileInfo $iterator): bool
    {
        if (!$iterator->isReadable()) {
            throw new \Exception("Can't read:\n\t" + $iterator->getRealPath());
        }

        $to_file = str_replace($this->current_folder . self::DS, '', $iterator->getRealPath());
        $to_dir = substr($to_file, 0, -(strlen($iterator->getBaseName()) + 1));
        if (!is_dir($to_dir)) {
            mkdir($to_dir, 0777, true);
        }

        rename($iterator->getRealPath(), $to_file);

        return true;
    }

    /**
     * Delete path
     *
     * @param string $path
     *
     * @return bool
     */
    protected function deletePath(string $path, $all = false): bool
    {
        $is_delete = false;
        if (is_dir($path)) {
            foreach (scandir($path) as $p) {
                if (($p != '.') && ($p != '..')) {
                    $this->deletePath($path . self::DS . $p, $all);
                }
            }

            $is_delete = rmdir($path);
        } elseif ($all === true) {
            unlink($path);
        }

        return $is_delete;
    }

    /**
     * Delete updater
     *
     * @return void
     */
    public function deleteUpdater()
    {
        $this->deletePath(UPDPATH, true);
    }

    /**
     * Fill main update file
     *
     * @return $this
     */
    protected function fillMainUpdateFile(): UpdaterBuilderModel
    {
        $update = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'version_from' => $this->getFromVer(),
            'version_to' => $this->getToVer(),
            'libraries' => [],
            'modules' => []
        ];
        /* foreach($this->getUpdatingLibraries() as $lib) {
          TODO
          } */

        foreach ($this->getUpdatingModules() as $module) {
            $update['modules'][$module['module']] = [
                'update' => [
                    'path' => $module['module'] . '_v' . $module['version'],
                    'version_from' => $this->getModulePrevious($module['module'])['version'],
                    'version_to' => $module['version'],
                ],
            ];
        }
        //TODO (nsavanaev) ???
//        foreach ($this->getInstallingModules() as $module) {
//            $update['modules'][$module['module']] = 'install';
//        }
        $file_name = UPDPATH . self::PRODUCT_UPDATES . self::DS . $this->main_update_file_name;
        $start = <<<'EOD'
<?php

$update =
EOD;
        file_put_contents($file_name, $start . $this->varExport($update) . ';');

        return $this;
    }

    /**
     * Var export (psr)
     *
     * @param array $expression
     *
     * @return string
     */
    private function varExport(array $expression): string
    {
        $export = var_export($expression, true);
        $export = preg_replace('/^([ ]*)(.*)/m', '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [null, ']$1', ' => ['], $array);

        return join(PHP_EOL, array_filter(['['] + $array));
    }

    /**
     * Description data
     *
     * @return string|void
     */
    protected function getDescription()
    {
        return $this->description;
    }

    /**
     * Updating modules
     *
     * @return array
     */
    protected function getUpdatingModules(): array
    {
        if (empty($this->upd_modules)) {
            $modules = [];
            foreach (new \DirectoryIterator(UPDPATH) as $file_info) {
                if ($file_info->isDot()) {
                    continue;
                }
                $moduleName = $this->omitVersion($file_info->getBasename());
                $module = $this->getModule($file_info->getRealPath(), $moduleName);
                if (empty($module)) {
                    continue;
                }
                $modules[$module['module']] = $module;
            }
            $this->upd_modules = $modules;
        }

        return $this->upd_modules;
    }

    /**
     * Omit version
     *
     * @param string $module_dir
     *
     * @return false|string
     */
    protected function omitVersion(string $module_dir)
    {
        return substr($module_dir, 0, strrpos($module_dir, '_'));
    }

    /**
     * Module data
     *
     * @param string $root
     * @param string $module_name
     *
     * @return array
     */
    protected function getModule(string $root, string $module_name): array
    {
        $module = [];
        $module_dir = $root . self::DS . self::SUB_DIR_MODULE;
        if (!is_dir($module_dir)) {
            return $module;
        }
        $module_file = realpath($module_dir . $module_name . self::DS . self::SUB_DIR_MODULE_PHP);
        if (is_file($module_file)) {
            require $module_file;
        }

        return $module;
    }

    /**
     * Installing modules
     *
     * @return array
     */
    protected function getInstallingModules(): array
    {
        if (empty($this->inst_modules)) {
            $this->inst_modules = $this->getModules(SITE_PHYSICAL_PATH);
        }

        return $this->inst_modules;
    }

    /**
     * Modules
     *
     * @param string $root
     *
     * @return array
     */
    protected function getModules(string $root): array
    {
        $modules = [];
        $module_dir = $root . self::DS . self::SUB_DIR_MODULE;
        foreach (new \DirectoryIterator($module_dir) as $file_info) {
            if ($file_info->isDot()) {
                continue;
            }
            $module_file = realpath($module_dir . $file_info->getBasename() . self::DS . self::SUB_DIR_MODULE_PHP);
            $module = [];
            if (!empty($module_file) && is_file($module_file)) {
                require $module_file;
                $modules[] = $module;
            }
        }

        return $modules;
    }

    /**
     * Create update files
     *
     * @return $this
     */
    protected function createUpdateFiles(): UpdaterBuilderModel
    {
        foreach (new \DirectoryIterator(UPDPATH) as $file_info) {
            if (
                $file_info->isDot() || !$file_info->isDir() ||
                self::PRODUCT_UPDATES === $file_info->getBasename() ||
                self::OTHER_DIR === $file_info->getBasename() ||
                in_array($this->omitVersion($file_info->getBasename()), $this->skip_upd)
            ) {
                continue;
            }
            $this->createModuleUpdateFile($file_info->getBasename());
            $this->createModulePermissionsFile($file_info->getBasename());
            $this->createModuleSettingsFile($file_info->getBasename());
            $this->createModuleMigrationFile($file_info->getBasename());
            //TODO (nsavanaev) возможно модель тут не нужна
            $this->createModuleUpdateModelFile($file_info->getBasename());
            $this->createModuleLangFile($file_info->getBasename());
        }

        return $this;
    }

    /**
     * Create module update file
     *
     * @param string $module_dir
     *
     * @return void
     */
    protected function createModuleUpdateFile(string $module_dir)
    {
        $module_name = $this->omitVersion($module_dir);
        $module = $this->getUpdatingModules()[$module_name];

        $raw_files = $this->getFileList(UPDPATH . $module_dir . self::DS . self::SUB_DIR_MODULE);
        $files = [];
        $to_replace = [
            'replace' => [UPDPATH . $module_dir . self::DS, self::DS],
            'with' => ['', '/'],
        ];
        foreach ($raw_files as $file) {
            $files[] = [
                'file',
                'read',
                str_replace($to_replace['replace'], $to_replace['with'], $file->getRealPath()),
            ];
        }
        $version_from = $this->getModulePrevious($module['module'])['version'];
        $update = [
            'module' => $module['module'],
            'update_name' => 'Update ' . $module['module'] . ' module from V' . $version_from . ' to V' . $module['version'],
            'update_description' => 'main features in update description',
            'version_from' => $version_from,
            'version_to' => $module['version'],
            'files' => $files,
            'dependencies' => [],
        ];
        $file_path = UPDPATH . $module_dir . self::DS . 'update.php';
        $start = <<<'EOD'
<?php

$update =
EOD;
        file_put_contents($file_path, $start . $this->varExport($update) . ';');
    }

    /**
     * Create module settings file
     *
     * @param string $module_dir
     *
     * @return void
     */
    protected function createModuleSettingsFile(string $module_dir)
    {
        $settings = $this->getSettings($module_dir);
        $file_path = UPDPATH . $module_dir . self::DS . self::FILE_SETTINGS;

        $start = <<<'EOD'
<?php

$install_settings =
EOD;
        file_put_contents($file_path, $start . $this->varExport($settings) . ';');
    }

    /**
     * Get new settings
     *
     * @param string $upd_dir
     *
     * @return array
     */
    protected function getSettings(string $upd_dir): array
    {
        $module_gid = $this->omitVersion($upd_dir);
        $old_settings = SITE_PHYSICAL_PATH . self::SUB_DIR_MODULE . $module_gid . self::DS . self::SUB_DIR_SETTINGS_PHP;
        $new_settings = UPDPATH . $upd_dir . self::DS . self::SUB_DIR_MODULE . $module_gid . self::DS . self::SUB_DIR_SETTINGS_PHP;
        $result = [];
        if (!file_exists($new_settings)) {
            return $result;
        }
        if (file_exists($old_settings)) {
            $result = $this->compareSettingsFiles($old_settings, $new_settings);
        } else {
            $result = $this->getSettingsFileContents($new_settings);
        }

        return $result;
    }

    /**
     * Compare settings files
     *
     * @param string $old_file
     * @param string $new_file
     *
     * @return array
     */
    protected function compareSettingsFiles(string $old_file, string $new_file): array
    {
        $old_settings = $this->getSettingsFileContents($old_file);
        $new_settings = $this->getSettingsFileContents($new_file);

        return $this->arrayDiffAssocRecursive($new_settings, $old_settings);
    }

    /**
     * Settings file contents
     *
     * @param string $file_path
     *
     * @return array
     */
    protected function getSettingsFileContents(string $file_path): array
    {
        $install_settings = [];
        require $file_path;

        return $install_settings;
    }

    /**
     * Create module permissions file
     *
     * @param string $module_dir
     *
     * @return void
     */
    protected function createModulePermissionsFile(string $module_dir)
    {
        $permissions = $this->getPermissions($module_dir);
        $file_path = UPDPATH . $module_dir . self::DS . self::FILE_PERMISSIONS;

        $start = <<<'EOD'
<?php

$_permissions =
EOD;
        file_put_contents($file_path, $start . $this->varExport($permissions) . ';');
    }

    /**
     * Get new permissions
     *
     * @param string $upd_dir
     *
     * @return array
     */
    protected function getPermissions(string $upd_dir): array
    {
        $module_gid = $this->omitVersion($upd_dir);
        $old_permissions = SITE_PHYSICAL_PATH . self::SUB_DIR_MODULE . $module_gid . self::DS . self::SUB_DIR_PERMISSIONS_PHP;
        $new_permissions = UPDPATH . $upd_dir . self::DS . self::SUB_DIR_MODULE . $module_gid . self::DS . self::SUB_DIR_PERMISSIONS_PHP;

        $result = [];
        if (!file_exists($new_permissions)) {
            return $result;
        }

        if (file_exists($old_permissions)) {
            $result = $this->comparePermissionsFiles($old_permissions, $new_permissions);
        } else {
            $result = $this->getPermissionsFileContents($new_permissions);
        }

        return $result;
    }

    /**
     * Compare permissions files
     *
     * @param string $old_file
     * @param string $new_file
     *
     * @return array
     */
    protected function comparePermissionsFiles(string $old_file, string $new_file): array
    {
        $old_permissions = $this->getPermissionsFileContents($old_file);
        $new_permissions = $this->getPermissionsFileContents($new_file);

        return $this->arrayDiffAssocRecursive($new_permissions, $old_permissions);
    }

    /**
     * Permissions file contents
     *
     * @param string $file_path
     *
     * @return array
     */
    protected function getPermissionsFileContents(string $file_path): array
    {
        $_permissions = [];
        require $file_path;

        return $_permissions;
    }

    protected function createModuleMigrationFile(string $module_dir)
    {
        //TODO (nsavanaev) сделать через миграции
    }

    /**
     * Create module update model file
     *
     * @param string $module_dir
     *
     * @return void
     */
    protected function createModuleUpdateModelFile(string $module_dir)
    {
        $this->load->model('install/models/UpdatesModel');
        $module_name = $this->omitVersion($module_dir);
        $ucf_module_name = ucfirst($module_name);
        $file_path = UPDPATH . $module_dir . self::DS . $ucf_module_name . 'UpdateModel.php';
        $use_str = "use Pg\\modules\\{$module_name}\\models\\{$ucf_module_name}InstallModel;";

        $model_methods = "public function {$this->ci->UpdatesModel->prepare_updating_method}()\n{\n\n\n}\n";
        $model_methods .= "public function {$this->ci->UpdatesModel->arbitrary_updating_method}()\n{\n\n\n}\n";
        $model_methods .= "public function {$this->ci->UpdatesModel->arbitrary_lang_update_method}()\n{\n\n\n}\n";

        $content = "<?php\n\n$use_str\n\nclass {$ucf_module_name}UpdateModel extends {$ucf_module_name}InstallModel\n{\n\n{$model_methods}\n\n}\n";
        file_put_contents($file_path, $content);
    }

    /**
     * Create module lang file
     *
     * @param string $module_dir
     *
     * @return void
     */
    protected function createModuleLangFile(string $module_dir)
    {
        $install_lang = $this->getNewLangs($module_dir);
        $file_path = UPDPATH . $module_dir . self::DS . 'lang.php';
        $start = <<<'EOD'
<?php

$install_lang =
EOD;
        file_put_contents($file_path, $start . $this->varExport($install_lang) . ';');
    }

    /**
     * New langs
     *
     * @param string $upd_dir
     *
     * @return void
     */
    protected function getNewLangs(string $upd_dir): array
    {
        $module_gid = $this->omitVersion($upd_dir);
        $from_langs = SITE_PHYSICAL_PATH . self::DS . self::SUB_DIR_MODULE . $module_gid . self::DS . self::DIR_LANGS . self::DS;
        $to_langs = UPDPATH . $upd_dir . self::DS . self::SUB_DIR_MODULE . $module_gid . self::DS . self::DIR_LANGS . self::DS;
        $result = [];
        if (!is_dir($to_langs)) {
            return $result;
        }
        foreach (new \DirectoryIterator($to_langs) as $lang_dir) {
            // Skip new langs
            if ($lang_dir->isDot() || !is_dir($from_langs . $lang_dir->getBasename())) {
                continue;
            }
            foreach (new \DirectoryIterator($lang_dir->getRealPath()) as $lang_file) {
                if ($lang_file->isDot()) {
                    continue;
                }
                $old_lang_file = $from_langs . $lang_dir->getBasename() . self::DS . $lang_file->getBasename();
                if (file_exists($old_lang_file)) {
                    $langs_to_update = $this->compareLangFiles($old_lang_file, $lang_file->getRealpath());
                } else {
                    $langs_to_update = $this->getLangFileContents($lang_file->getRealpath());
                }
                if (!empty($langs_to_update)) {
                    $result[$lang_dir->getBaseName()][$lang_file->getBaseName('.php')] = $langs_to_update;
                }
            }
        }

        return $result;
    }

    /**
     * Lang file contents
     *
     * @param string $file_path
     *
     * @return array
     */
    protected function getLangFileContents(string $file_path): array
    {
        $install_lang = [];
        require $file_path;

        return $install_lang;
    }

    /**
     * Compare lang files
     *
     * @param string $old_file
     * @param string $new_file
     *
     * @return array
     */
    protected function compareLangFiles(string $old_file, string $new_file): array
    {
        $old_langs = $this->getLangFileContents($old_file);
        $new_langs = $this->getLangFileContents($new_file);

        return $this->arrayDiffAssocRecursive($new_langs, $old_langs);
    }

    /**
     * Array diff assoc recursive
     *
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    protected function arrayDiffAssocRecursive(array $array1, array $array2): array
    {
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!is_array($array2[$key])) {
                    $difference[$key] = $value;
                } else {
                    $new_diff = $this->arrayDiffAssocRecursive($value, $array2[$key]);

                    if ($new_diff !== []) {
                        $difference[$key] = $new_diff;
                    }
                }
            } elseif (!isset($array2[$key]) || $array2[$key] != $value) {
                $difference[$key] = $value;
            }
        }

        // Search missing items
        foreach ($array2 as $key => $value) {
            if (!isset($array1[$key])) {
                $difference[$key] = null;
            }
        }

        return !isset($difference) ? [] : $difference;
    }

    /**
     * File list
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

    /**
     * Create other update file
     *
     * @return void
     */
    protected function createOtherUpdateFile()
    {
        $update_struct = UPDPATH . self::OTHER_DIR . self::DS;
        if (!is_dir($update_struct)) {
            mkdir($update_struct, 0777, true);
        }

        $files_path = new \DirectoryIterator(UpdaterDownloaderModel::TEMP_UPDATES_PATH);
        foreach ($files_path as $file_info) {
            rename($file_info->getRealPath(), $update_struct . $file_info->getFilename());
        }

        $raw_files = $this->getFileList(UPDPATH . self::OTHER_DIR);
        $files = [];
        $to_replace = [
            'replace' => [UPDPATH . self::OTHER_DIR . self::DS],
            'with' => [''],
        ];
        foreach ($raw_files as $file) {
            $files[] = [
                'file',
                'read',
                str_replace($to_replace['replace'], $to_replace['with'], $file->getRealPath()),
            ];
        }
        $update = [
            'files' => $files
        ];
        $file_path = UPDPATH . self::OTHER_DIR . self::DS . 'update.php';
        $start = <<<'EOD'
<?php

$update =
EOD;
        file_put_contents($file_path, $start . $this->varExport($update) . ';');
    }
}
