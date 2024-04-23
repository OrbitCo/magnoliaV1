<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

/**
 * Install Create Migration
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateInstallerMigration extends AbstractFileData
{
    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');
        $this->setPath($name, 'install/db/migrations');
        $migration = $this->setName($name, '', 'MainMigration');
        shell_exec("./vendor/bin/phinx create {$migration} --path {$this->path}");
        $this->fileData($name);
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '')
    {
        // TODO: Implement setFile() method.
    }

    /**
     * @inheritDoc
     *
     * @throws FileNotFoundException
     */
    public function fileData(string $name)
    {
        $adapter = new Local($this->path);
        $filesystem = new Filesystem($adapter);
        $file_data = $filesystem->listContents(null, true);
        if (!empty($file_data)) {
            $file = current($file_data)['path'];
            $content = $this->getContent($name);
            if (!empty($content)) {
                $sample_content = $filesystem->read($file);
                $content = str_replace("    {\n        //\n    }\n", "    {\n        {$content}    }\n", $sample_content);
                $filesystem->update($file, $content);
            }
        }
    }

    /**
     * Content file
     *
     * @param string $name
     *
     * @return string
     */
    protected function getContent(string $name): string
    {
        $fields = $this->property_container->get('sample_fields');
        $content = "\$table = \$this->table(DB_PREFIX . '{$name}');\n        \$table\n";
        foreach ($fields as $column_data) {
            if (!empty($column_data)) {
                $content .= "            ->addColumn('{$column_data['column_name']}', '{$column_data['type']}'";
                $content .= !empty($column_data['options']) ? ", {$column_data['options']})\n" : ")\n";
            }
        }
        $content .= "            ->create();\n";

        return $content;
    }
}
