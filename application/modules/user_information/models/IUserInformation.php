<?php

declare(strict_types=1);

namespace Pg\modules\user_information\models;

/**
 * user_information module
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

interface IUserInformation
{

    /**
     * Return information type
     *
     * @return string
     */
    public function getInformationType();
    
    /**
     * User information
     *
     * @param array $user
     *
     * @return mixed
     */
    public function getUserInformation($user);
}
