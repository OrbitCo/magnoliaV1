<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators\Interfaces;

/**
 * Interface IPropertyContainer
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
interface IPropertyContainer
{
    /**
     * Add Property
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function add(string $key, $value);

    /**
     * Delete Property
     *
     * @param string $key
     *
     * @return mixed
     */
    public function delete(string $key);

    /**
     * Get Property
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * Set Property
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function set(string $key, $value);
}
