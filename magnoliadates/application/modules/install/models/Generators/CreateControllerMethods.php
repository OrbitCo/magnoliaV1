<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Create controller methods
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateControllerMethods extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.php';

    /**
     * Generate current controller
     *
     * @var bool
     */
    protected $is_api_controller = false;

    /**
     * @inheritDoc
     * @throws FileNotFoundException
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $module_name = $property_container->get('module_name');
        $access = $property_container->get('controller_side');
        $acl_prefix_controller = $property_container->get('acl_prefix_controller');
        $this->setPath($module_name, 'controllers');
        $this->is_api_controller = $access == 'api';
        $this->setFile($module_name, $acl_prefix_controller[$access]);
        $this->fileData($module_name);
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
     * @throws FileNotFoundException
     */
    public function fileData(string $name)
    {
        $adapter = new Local($this->path);
        $filesystem = new Filesystem($adapter);
        $content =  $filesystem->read($this->name . self::EXT);
        $methods = $this->getMethods($content);
        $data = $this->insertMethods($content, $methods);
        $filesystem->update($this->name . self::EXT, $data);
    }

    /**
     * Controller methods
     *
     * @param string $content
     *
     * @return string
     */
    protected function getMethods(string $content): string
    {
        $methods = '';
        $crud_methods = $this->property_container->get('methods');
        foreach ($crud_methods as $crud_method => $attrs) {
            if (stristr($content, "public function {$crud_method}({$attrs})") === false) {
                $methods .= "\n    public function {$crud_method}({$attrs})\n    {\n";
                if ($this->is_api_controller === true) {
                    $methods .= "        \$this->set_api_content('data', []);\n";
                } else {
                    $view_name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $crud_method));
                    $methods .= "        \$this->view->render('{$view_name}');\n";
                }
                $methods .= "    }\n";
            }
        }

        return $methods;
    }

    /**
     * Insert methods
     *
     * @param string $content
     * @param string $methods
     *
     * @return string
     */
    protected function insertMethods(string $content, string $methods): string
    {
        $content = substr(rtrim($content), 0, -1);

        return "{$content}{$methods}}\n";
    }
}
