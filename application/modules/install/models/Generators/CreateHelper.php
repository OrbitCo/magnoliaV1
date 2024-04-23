<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Install Create Helper
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateHelper extends AbstractFileData
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

        $this->setPath($name, 'helpers');
        $this->setFile($name, '', 'Helper');
        $this->fileData($name);
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
        $content = "<?php\n\ndeclare(strict_types=1);\n\n";
        $content .= "namespace Pg\\modules\\{$name}\\helpers {";
        $content .= "\n\n}\n";
        $file_path = $this->path . $this->name . self::EXT;
        file_put_contents($file_path, $content);
    }
}
