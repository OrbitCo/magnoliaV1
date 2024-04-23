<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IFileData;

/**
 * Abstract File Data
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
abstract class AbstractFileData implements IFileData
{
    /**
     * @var IPropertyContainer
     */
    protected $property_container;

    /**
     * File path
     *
     * @var string
     */
    protected $path;

    /**
     * File name
     *
     * @var string
     */
    protected $name;

    /**
     * Get module path
     *
     * @param string $name
     *
     * @return string
     */
    public function getModulesPath(string $name): string
    {
        return SITE_PATH . SITE_SUBFOLDER . 'application/modules/' . $name . '/';
    }

    /**
     * Set path
     *
     * @param string $name
     * @param string $path
     *
     * @return void
     */
    public function setPath(string $name, string $path)
    {
        $this->path = $this->getModulesPath($name) . $path . '/';

        if (!is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }
    }

    /**
     * Set name
     *
     * @param string $name
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function setName(string $name, string $prefix = '', string $postfix = ''): string
    {
        $data = '';
        if (strpos($name, '_') === false) {
            $data .= ucfirst($name);
        } else {
            $arr_name = explode('_', $name);
            foreach ($arr_name as $n) {
                $data .= ucfirst($n);
            }
        }

        return $prefix.$data.$postfix;
    }
}
