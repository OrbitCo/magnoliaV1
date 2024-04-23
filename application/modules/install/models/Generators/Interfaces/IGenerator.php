<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators\Interfaces;

/**
 * Interface IGenerator
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
interface IGenerator
{
    /**
     * Generate
     *
     * @return mixed
     */
    public function generate();
}
