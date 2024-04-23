<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Install Create Events
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateEvents extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.php';

    /**
     * Create
     *
     * @param IPropertyContainer $property_container
     *
     * @return void
     */
    public function create(IPropertyContainer $property_container)
    {
        $name = $property_container->get('module_name');
        $this->setPath($name, 'Events');
        $this->setFile($name, 'Event', 'Handler');
        $this->fileData($name);
    }

    /**
     * Set file
     *
     * @param string $name
     * @param string $prefix
     * @param string $postfix
     *
     * @return void
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
     * Writing content to a file
     *
     * @param string $name
     *
     * @return void
     */
    public function fileData(string $name)
    {
        $content = "<?php\n\ndeclare(strict_types=1);\n\n";
        $content .= "namespace Pg\\modules\\{$name}\\Events;";
        $content .= "\n\nuse Pg\\Libraries\\EventDispatcher;";
        $content .= "\nuse Pg\\Libraries\\EventHandler;";
        $content .= "\nuse Pg\\Libraries\\Traits\\CiTrait;";
        $methods = "    public function init()\n    {\n        \$event_handler = EventDispatcher::getInstance();\n    }\n";
        $content .= "\n\nclass {$this->name} extends EventHandler\n{\n    use CiTrait;\n\n{$methods}}\n";
        $file_path = $this->path . $this->name . self::EXT;
        file_put_contents($file_path, $content);
    }
}
