<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Install Create Installer Structure
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateInstallerStructure extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.php';

    /**
     * Generate file list
     *
     * @var array
     */
    protected $install_files = [
        'access_permissions' => 'dating/all',
        'modules_data' => 'dating/all',
        'permissions' => 'dating/all',
        'settings' => 'dating/all',
        'module' => ''
    ];

    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');

        foreach ($this->install_files as $file => $dir) {
            $this->setPath($name, "install/{$dir}");
            $this->setFile($file);
            $this->fileData($file);
        }
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '')
    {
        $file_path = $this->path . $name . self::EXT;

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

        $method = 'getContent';
        if (strpos($name, '_') === false) {
            $method .= ucfirst($name);
        } else {
            $arr_name = explode('_', $name);
            foreach ($arr_name as $n) {
                $method .= ucfirst($n);
            }
        }

        $content = '';
        if (method_exists($this, $method)) {
            $content .= $this->{$method}($module_name);
        }
        $file_path = $this->path . $name . self::EXT;
        file_put_contents($file_path, $content);
    }

    /**
     * Access Permission Content file
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentAccessPermissions(string $name): string
    {
        return "<?php\n\nreturn [];\n";
    }

    /**
     * Modules Data Content file
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentModulesData(string $name): string
    {
        $content = "<?php\n\nreturn [\n";
        $content .= "    'menu' => [\n";
        $content .= "        'admin_menu' => [\n";
        $content .= "            'action' => 'none',\n";
        $content .= "            'name' => '{$name} section menu',\n";
        $content .= "            'items' => [\n";
        $content .= "                'other_items' => [\n";
        $content .= "                    'action' => 'none',\n";
        $content .= "                    'name' => '',\n";
        $content .= "                    'items' => [\n";
        $content .= "                        'add_ons_items' => [\n";
        $content .= "                            'action' => 'none',\n";
        $content .= "                            'items' => [\n";
        $content .= "                                '{$name}_menu_item' => [\n";
        $content .= "                                    'action' => 'create',\n";
        $content .= "                                    'link' => 'admin/{$name}',\n";
        $content .= "                                    'status' => '1',\n";
        $content .= "                                    'sorter' => '10'\n";
        $content .= "                                ],\n";
        $content .= "                            ],\n";
        $content .= "                        ],\n";
        $content .= "                    ],\n";
        $content .= "                ],\n";
        $content .= "            ],\n";
        $content .= "        ],\n";
        $content .= "    ],\n";
        $content .= "];\n";

        return $content;
    }

    /**
     * Permissions Content file
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentPermissions(string $name): string
    {
        $methods = $this->property_container->get('methods');
        $content = "<?php\n\nreturn [\n";
        $content .= "    'admin_{$name}' => " . $this->methodsList($methods, 3);
        $content .= "    'api_{$name}' => " . $this->methodsList($methods, 2);
        $content .= "    '{$name}' => " . $this->methodsList($methods, 2);
        $content .= "];\n";

        return $content;
    }

    /**
     * Add permission
     *
     * @param IPropertyContainer $property_container
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function addContentPermissions(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');
        $controller_side = $this->property_container->get('controller_side');
        $methods = $this->property_container->get('methods');

        $this->setPath($name, "install/dating/all");
        if (!file_exists("{$this->path}permissions.php")) {
            file_put_contents("{$this->path}permissions.php", "<?php\n\nreturn [];");
            $_permissions = [];
            $permissions_file = $this->getModulesPath($name) . 'install/permissions.php';
            require $permissions_file;
            $permissions =  $_permissions ?? [];
        } else {
            $permissions = require "{$this->path}permissions.php";
        }

        $perm_key = $controller_side == 'user' ? $name : "{$controller_side}_{$name}";
        $permissions[$perm_key] = array_merge($permissions[$perm_key], $methods);

        $content = "<?php\n\nreturn [\n";
        if (!empty($permissions["admin_{$name}"])) {
            $content .= "    'admin_{$name}' => " . $this->methodsList($permissions["admin_{$name}"], 3);
        }
        if (!empty($permissions["api_{$name}"])) {
            $content .= "    'api_{$name}' => " . $this->methodsList($permissions["api_{$name}"], 2);
        }
        if (!empty($permissions[$name])) {
            $content .= "    '{$name}' => " . $this->methodsList($permissions[$name], 2);
        }
        $content .= "];\n";

        $adapter = new Local($this->path);
        $filesystem = new Filesystem($adapter);
        $filesystem->update("permissions.php", $content);
    }

    /**
     * Methods list
     *
     * @param array $methods
     * @param int $access
     *
     * @return string
     */
    private function methodsList(array $methods, int $access): string
    {
        $content = "[\n";
        foreach ($methods as $method => $attrs) {
            $content .= "        '{$method}' => {$access},\n";
        }
        $content .= "    ],\n";

        return $content;
    }

    /**
     * Settings Content file
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentSettings(string $name): string
    {
        return "<?php\n\nreturn [];\n";
    }

    /**
     * Module Content file
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentModule(string $name): string
    {
        $content = "<?php\n\n\$module = [\n";
        $content .= "    'module' => '{$name}',\n";
        $content .= "    'install_name' => '{$name} module',\n";
        $content .= "    'install_descr' => '{$name} module description',\n";
        $content .= "    'version' => '1.01',\n";
        $content .= $this->filesList($name);
        $content .= $this->dependencies();
        $content .= $this->linkedModules();
        $content .= "];\n";

        return $content;
    }

    /**
     * Files List
     *
     * @param string $name
     *
     * @return string
     */
    private function filesList(string $name): string
    {
        $adapter = new Local(
            $this->getModulesPath($name)
        );

        $filesystem = new Filesystem($adapter);
        $list = $filesystem->listContents(null, true);
        $files = "    'files' => [\n";
        $key = 0;
        foreach ($list as $data) {
            if ($data['type'] == 'file') {
                $files .= "        {$key} => [\n";
                $files .= "            0 => 'file',\n";
                $files .= "            1 => 'read',\n";
                $files .= "            2 => 'application/modules/{$name}/{$data['path']}'\n";
                $files .= "        ],\n";
                $key++;
            }
        }
        $files .= "    ],\n";

        return $files;
    }

    /**
     * Dependencies modules
     *
     * @return string
     */
    private function dependencies(): string
    {
        $content = "    'dependencies' => [\n";
        $content .= "        'menu' => [\n            'version' => '1.01'\n        ],\n";
        $content .= "    ],\n";

        return $content;
    }

    /**
     * Linked modules
     *
     * @return string
     */
    private function linkedModules(): string
    {
        $content = "    'linked_modules' => [\n";
        $content .= "        'install' => [\n            'menu' => 'installMenu'\n        ],\n";
        $content .= "        'deinstall' => [\n            'menu' => 'deinstallMenu'\n        ],\n";
        $content .= "    ],\n";

        return $content;
    }
}
