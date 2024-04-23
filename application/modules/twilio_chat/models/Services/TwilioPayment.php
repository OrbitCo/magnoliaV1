<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models\Services;

use Pg\modules\users_payments\models\UsersPaymentsModel;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioPayment
{
    /**
     * @param null $id_user
     * @param int $price
     * @param string $message
     * @return mixed
     */
    public function writeOffForChat($id_user = null, $price = 0, $message = '')
    {
        return (new UsersPaymentsModel())->writeOffUserAccount($id_user, $price, $message);
    }

    /**
     * @param $id_user
     * @return mixed
     */
    public function getUserAccount($id_user)
    {
        return (new UsersPaymentsModel())->getUserAccount($id_user);
    }
}