<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators\Interfaces;

/**
 * Interface IFileData
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
interface IFileData
{
    /**
     * Create
     *
     * @param IPropertyContainer $property_container
     *
     * @return mixed
     */
    public function create(IPropertyContainer $property_container);

    /**
     * Get modules path
     *
     * @param string $name
     *
     * @return string
     */
    public function getModulesPath(string $name): string;

    /**
     * Set path
     *
     * @param string $name
     * @param string $path
     *
     * @return mixed
     */
    public function setPath(string $name, string $path);

    /**
     * Set file
     *
     * @param string $name
     * @param string $prefix
     * @param string $postfix
     *
     * @return mixed
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '');

    /**
     * Set name
     *
     * @param string $name
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function setName(string $name, string $prefix = '', string $postfix = ''): string;

    /**
     * File data
     *
     * @param string $name
     *
     * @return mixed
     */
    public function fileData(string $name);
}
