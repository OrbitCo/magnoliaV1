<?php

declare(strict_types=1);

namespace Pg\modules\user_information\models\traits;

/**
 * User information trait
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
trait YourTrait
{
    /**
     * Information type
     *
     * @var string
     */
    protected $information_type = 'your';
    
    /**
     * Return information type
     *
     * @return string
     */
    public function getInformationType()
    {
        return $this->information_type;
    }
}
