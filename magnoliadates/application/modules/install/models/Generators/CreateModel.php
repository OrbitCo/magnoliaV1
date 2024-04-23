<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Create Model
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateModel extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.php';

    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');
        $model_list = $this->property_container->get('model_list');
        foreach ($model_list as $type => $postfix) {
            $this->setPath($name, 'models');
            $this->setFile($name, '', $postfix);
            $this->fileData($type);
        }
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '')
    {
        $this->name = $this->setName($name, $prefix, $postfix);
        $file_path = $this->path . $this->name . self::EXT;

        if (!is_file($file_path)) {
            touch($file_path);
        }
    }

    /**
     * @inheritDoc
     */
    public function fileData(string $name)
    {
        $module_name = $this->property_container->get('module_name');
        $method = 'getContent' . ucfirst($name);
        $content = "";
        if (method_exists($this, $method)) {
            $content .= $this->{$method}($module_name);
        } else {
            $content .= $this->getContent($module_name);
        }
        $file_path = $this->path . $this->name . self::EXT;
        file_put_contents($file_path, $content);
    }

    /**
     * Content Main
     *
     * @param string $name
     *
     * @return string
     */
    private function getContent(string $name): string
    {
        $keys = array_keys($this->property_container->get('sample_fields'));
        $table_name = $this->property_container->get('table_name');
        $fields_list = implode("', '", $keys);
        $content = "<?php\n\ndeclare(strict_types=1);\n\n";
        $content .= "namespace Pg\\modules\\{$name}\\models;\n\n";
        $content .= "use Pg\\Libraries\\Traits\\QueryTrait;";
        $traits = "    use QueryTrait;\n\n";
        $constants = '';
        if ($name == $table_name) {
            $constants .= "    public const MODULE_GID = '{$name}';\n\n";
        }
        $constants .= "    public const DB_TABLE = DB_PREFIX . '{$table_name}';\n\n";
        $variables = "    protected \$fields = ['{$fields_list}'];\n\n";
        $methods = $this->getMethods();
        $content .= "\n\nclass {$this->name} extends \Model\n{\n{$traits}{$constants}{$variables}{$methods}}\n";

        return $content;
    }

    /**
     * Content Install
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentInstall(string $name): string
    {
        $content = "<?php\n\ndeclare(strict_types=1);\n\n";
        $content .= "namespace Pg\\modules\\{$name}\\models;";
        $content .= "\n\nuse Pg\Libraries\Setup;";
        $variables = "    protected \$access_permissions;\n";
        $variables .= "    protected \$modules_data;";
        $methods = "    public function __construct()\n    {\n        parent::__construct();\n";
        $methods .= "        \$this->modules_data = Setup::getModuleData(\n";
        $methods .= "            '{$name}',\n";
        $methods .= "            Setup::TYPE_MODULES_DATA\n";
        $methods .= "        );\n";
        $methods .= "        \$this->access_permissions = Setup::getModuleData(\n";
        $methods .= "            '{$name}',\n";
        $methods .= "            Setup::TYPE_ACCESS_PERMISSIONS\n";
        $methods .= "        );\n";
        $methods .= "        \$this->ci->load->model('InstallModel');\n";
        $methods .= "    }\n";
        $methods .= $this->linkedModules($name);
        $content .= "\n\nclass {$this->name} extends \Model\n{\n{$variables}\n\n{$methods}}\n";

        return $content;
    }

    /**
     * Content linked modules
     *
     * @param string $name
     *
     * @return string
     */
    private function linkedModules(string $name): string
    {
        $content = "\n    public function installMenu()\n    {\n";
        $content .= "        \$this->ci->load->helper('menu');\n";
        $content .= "        foreach (\$this->modules_data['menu'] as \$gid => \$menu_data) {\n";
        $content .= "            \$name = \$menu_data['name'] ?? '';\n";
        $content .= "            \$this->modules_data['menu'][\$gid]['id'] = linked_install_set_menu(\$gid, \$menu_data['action'], \$name);\n";
        $content .= "            linked_install_process_menu_items(\$this->modules_data['menu'], 'create', \$gid, 0, \$this->modules_data['menu'][\$gid]['items']);\n";
        $content .= "        }\n";
        $content .= "    }\n";
        $content .= "\n    public function installMenuLangUpdate(\$langs_ids = null)\n    {\n";
        $content .= "        if (empty(\$langs_ids)) {\n            return false;\n        }\n";
        $content .= "        \$langs_file = \$this->ci->InstallModel->language_file_read('{$name}', 'menu', \$langs_ids);\n";
        $content .= "        if (!\$langs_file) {\n";
        $content .= "            log_message('info', 'Empty menu langs data');\n            return false;\n";
        $content .= "        }\n\n";
        $content .= "        \$this->ci->load->helper('menu');\n";
        $content .= "        foreach (\$this->modules_data['menu'] as \$gid => \$menu_data) {\n";
        $content .= "            linked_install_process_menu_items(\$this->modules_data['menu'], 'update', \$gid, 0, \$this->modules_data['menu'][\$gid]['items'], \$gid, \$langs_file);\n";
        $content .= "        }\n\n";
        $content .= "        return true;\n";
        $content .= "    }\n";
        $content .= "\n    public function installMenuLangExport(\$langs_ids)\n    {\n";
        $content .= "        if (empty(\$langs_ids)) {\n            return false;\n        }\n";
        $content .= "        \$this->ci->load->helper('menu');\n\n        \$return = [];\n";
        $content .= "        foreach (\$this->modules_data['menu'] as \$gid => \$menu_data) {\n";
        $content .= "            \$temp = linked_install_process_menu_items(\$this->modules_data['menu'], 'export', \$gid, 0, \$this->modules_data['menu'][\$gid]['items'], \$gid, \$langs_ids);\n";
        $content .= "            \$return = array_merge(\$return, \$temp);\n";
        $content .= "        }\n\n";
        $content .= "        return ['menu' => \$return];\n";
        $content .= "    }\n";
        $content .= "\n    public function deinstallMenu()\n    {\n";
        $content .= "        \$this->ci->load->helper('menu');\n";
        $content .= "        foreach (\$this->modules_data['menu'] as \$gid => \$menu_data) {\n";
        $content .= "            if (\$menu_data['action'] == 'create') {\n";
        $content .= "                linked_install_set_menu(\$gid, 'delete');\n";
        $content .= "            } else {\n";
        $content .= "                linked_install_delete_menu_items(\$gid, \$this->modules_data['menu'][\$gid]['items']);\n";
        $content .= "            }\n";
        $content .= "        }\n";
        $content .= "    }\n";

        return $content;
    }

    /**
     * Methods model
     *
     * @return string
     */
    private function getMethods(): string
    {
        $methods = "    public function __construct()\n    {\n";
        $methods .= "        parent::__construct();\n";
        $methods .= "        \$this->applyOptions();\n";
        $methods .= "    }\n\n";
        $methods .= "    public function applyOptions()\n    {\n";
        $methods .= "        \$this->setTable(self::DB_TABLE);\n";
        $methods .= "        \$this->ci->cache->registerService(self::DB_TABLE);\n";
        $methods .= "    }\n\n";

        return $methods;
    }
}
