<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models\Services;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioValidation
{

    /**
     * проверка ключей.
     * @param string $settings
     * @throws \Exception
     */
    public static function isSettingsEmpty(string $settings)
    {
        $settings_data = json_decode($settings,true);

        if (empty($settings_data))
            throw new \Exception('empty settings');

        if (empty($settings_data['keys']['account_sid']))
            throw new \Exception('empty account sid');

        if (empty($settings_data['keys']['auth_token']))
            throw new \Exception('empty token');

        if (empty($settings_data['keys']['api_key_sid']))
            throw new \Exception('empty api key sid');

        if (empty($settings_data['keys']['api_key_secret']))
            throw new \Exception('empty api key secret');
    }


}