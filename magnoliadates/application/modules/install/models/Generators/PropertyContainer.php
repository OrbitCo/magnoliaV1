<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Property Container
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PropertyContainer implements IPropertyContainer
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function add(string $key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function delete(string $key)
    {
        unset($this->container[$key]);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->container[$key] ?? null;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        if (!isset($this->container[$key])) {
            throw new \RuntimeException("Property [{$key}] not found");
        }

        $this->container[$key] = $value;
    }
}
