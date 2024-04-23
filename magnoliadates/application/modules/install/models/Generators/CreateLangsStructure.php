<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Create Langs Packages
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateLangsStructure extends AbstractFileData
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
        $langs = $this->property_container->get('langs');
        $lang_files = $this->property_container->get('lang_files');
        foreach ($langs as $code) {
            foreach ($lang_files as $file) {
                $this->setPath($name, "langs/{$code}");
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
        $method = 'getContent' . ucfirst($name);
        $content = "";
        if (method_exists($this, $method)) {
            $content .= $this->{$method}($module_name);
        }
        $file_path = $this->path . $name . self::EXT;
        file_put_contents($file_path, $content);
    }

    /**
     * Content Arbitrary
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentArbitrary(string $name): string
    {
        return "<?php\n";
    }

    /**
     * Content DS
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentDs(string $name): string
    {
        return "<?php\n";
    }

    /**
     * Content Menu
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentMenu(string $name): string
    {
        $format_name = ucfirst(str_replace('_', ' ', $name));
        $content = "<?php\n\n";
        $content .= "\$install_lang['admin_menu_other_items_add_ons_items_{$name}_menu_item'] = '{$format_name}';\n";
        $content .= "\$install_lang['admin_menu_other_items_add_ons_items_{$name}_menu_item_tooltip'] = '{$format_name} module settings';\n";

        return $content;
    }

    /**
     * Content Pages
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentPages(string $name): string
    {
        $sample_fields = $this->property_container->get('sample_fields');
        $content = "<?php\n\n";
        $content .= "\$install_lang['list_empty'] = 'List empty';\n";
        foreach ($sample_fields as $field => $data) {
            $format_name = ucfirst(str_replace('_', ' ', $field));
            $content .= "\$install_lang['field_{$field}'] = '{$format_name}';\n";
        }

        return $content;
    }

    /**
     * Content Services
     *
     * @param string $name
     *
     * @return string
     */
    private function getContentServices(string $name): string
    {
        return "<?php\n";
    }
}
