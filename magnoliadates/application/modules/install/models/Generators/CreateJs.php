<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Install Create Js
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateJs extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.js';

    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $name = $property_container->get('module_name');
        $this->setPath($name, 'js');
        $this->setFile($name);
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
        $content = "\n'use strict';\n";
        $content .= "function {$this->name}(optionArr)\n{\n";
        $content .= "    this.properties = {\n        siteUrl: '/',\n        errorObj: new Errors()\n    }\n\n";
        $content .= "    const _self = this;\n\n";
        $content .= "    this.Init = function (options) {\n";
        $content .= "        _self.properties = \$.extend(_self.properties, options);\n";
        $content .= "        _self.initControls();\n    }\n\n";
        $content .= "    this.initControls = function () {\n    }\n\n";
        $content .= "    _self.Init(optionArr);\n";
        $content .= "}\n\n";
        $content .= "if (typeof exports === 'object') {\n";
        $content .= "    exports.__esModule = true;\n";
        $content .= "    exports.{$this->name} = {$this->name};\n";
        $content .= "}";
        $file_path = $this->path . $this->name . self::EXT;
        file_put_contents($file_path, $content);
    }
}
