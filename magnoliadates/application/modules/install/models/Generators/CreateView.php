<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use League\Flysystem\FileNotFoundException;
use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Create Views
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateView extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.twig';

    /**
     * Themes list
     *
     * @var array
     */
    protected $views = [
        'admin' => 'gentelella',
        'user' => 'flatty'
    ];

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Theme folder
     *
     * @var string
     */
    private $current_folder;

    /**
     * Fields type
     *
     * @var array
     */
    private $fields_type = [
        'varchar' => ['el' => 'input', 'type' => 'text'],
        'string' => ['el' => 'input', 'type' => 'text'],
        'int' => ['el' => 'input', 'type' => 'number'],
        'float' => ['el' => 'input', 'type' => 'number'],
        'tinyint' => ['el' => 'input', 'type' => 'checkbox'],
        'boolean' => ['el' => 'input', 'type' => 'checkbox'],
        'datetime' => ['el' => 'input', 'type' => 'date'],
        'date' => ['el' => 'input', 'type' => 'date'],
        'time' => ['el' => 'input', 'type' => 'time'],
        'text' => ['el' => 'textarea']
    ];

    /**
     * CreateView constructor
     */
    public function __construct()
    {
        $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . "application/modules/install/install/crud/");
        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');
        $methods = $this->property_container->get('methods');
        $controller_side = $this->property_container->get('controller_side');
        if (!empty($controller_side)) {
            $this->views = [$controller_side => $this->views[$controller_side]];
        }
        foreach ($this->views as $folder) {
            $this->current_folder = $folder;
            $this->setPath($name, "views/{$folder}");
            foreach ($methods as $file => $data) {
                $this->setFile($file);
                $this->fileData($file);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '')
    {
        $view_name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $name));
        $file_path = "{$this->path}{$view_name}" . self::EXT;

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
        $view_name = strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $name));
        $array = (array)explode('_', $view_name);
        $name = end($array);
        $method = 'getContent' . ucfirst($name);

        $content = '';
        if (method_exists($this, $method)) {
            $content .= $this->{$method}($module_name);
        }
        $file_path = "{$this->path}{$view_name}" . self::EXT;
        file_put_contents($file_path, $content);
    }

    /**
     * Content index
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    private function getContentIndex(string $name): string
    {
        $content =  $this->filesystem->read("{$this->current_folder}/index.default");

        return  str_replace('%module_name_replace%', $name, $content);
    }

    /**
     * Content create
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    private function getContentCreate(string $name): string
    {
        $content =  $this->filesystem->read("{$this->current_folder}/create.default");
        $content =  str_replace('%module_name_replace%', $name, $content);

        return str_replace('%form_fields_replace%', $this->formFields(), $content);
    }

    /**
     * Content view
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    private function getContentView(string $name): string
    {
        $content =  $this->filesystem->read("{$this->current_folder}/view.default");

        return  str_replace('%module_name_replace%', $name, $content);
    }

    /**
     * Content edit
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    private function getContentEdit(string $name): string
    {
        $content =  $this->filesystem->read("{$this->current_folder}/edit.default");

        return  str_replace('%module_name_replace%', $name, $content);
    }

    /**
     * Content delete
     *
     * @param string $name
     *
     * @throws FileNotFoundException
     *
     * @return string
     */
    private function getContentDelete(string $name): string
    {
        $content =  $this->filesystem->read("{$this->current_folder}/delete.default");

        return  str_replace('%module_name_replace%', $name, $content);
    }

    /**
     * Form fields
     *
     * @return string
     */
    private function formFields(): string
    {
        $content = '';
        $module_name = $this->property_container->get('module_name');
        $fields = $this->property_container->get('sample_fields');

        foreach ($fields as $item) {
            if (!empty($item)) {
                $content .= "<div class='form-group'>\n";
                $content .= "    \t\t\t\t\t<label class='control-label col-md-3 col-sm-3 col-xs-12'>\n";
                $content .= "        \t\t\t\t\t{% helper lang.l('field_{$item['column_name']}', '{$module_name}') %}: </label>\n";
                $content .= "    \t\t\t\t\t<div class='col-md-9 col-sm-9 col-xs-12'>\n";
                $content .= "\t\t\t\t\t" . $this->formFieldsType($item);
                $content .= "    \t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t\t";
            }
        }

        return $content;
    }

    /**
     * Form Fields Type
     *
     * @param array $field
     *
     * @return string
     */
    private function formFieldsType(array $field): string
    {
        $content = '        ';
        $f_t = preg_replace('/[^a-z]/i', '', $field['type']);
        $f = $this->fields_type[$f_t] ?? [];
        if (!empty($f)) {
            if ($f['el'] == 'textarea') {
                $content .= "<textarea name='{$field['column_name']}' class='form-control'></textarea>\n";
            } else {
                $value = '';
                $style_class = '';
                if ($f['type'] == 'checkbox') {
                    $style_class = 'flat';
                    $value = 1;
                }
                $content .= "<input type='{$f['type']}' value='{$value}' name='{$field['column_name']}' class='form-control {$style_class}'>\n";
            }
        } else {
            $content .= "<input type='text' value='' name='{$field['column_name']}' class='form-control'>\n";
        }

        return $content;
    }
}
