<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models;

class TwilioChatModel extends \Model
{
    /**
     * Module gid
     * @var string
     */
    const MODULE_GID = 'twilio_chat';

    const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Duration pattern format
     * @var string
     */
    const DURATION_FORMAT = '%02d:%02d:%02d';

    /**
     * Duration format
     * @param int $sec
     * @return string
     */
    public static function durationFormat(int $sec): string
    {
        return sprintf(
            self::DURATION_FORMAT,
            ($sec / 3600),
            ($sec / 60 % 60),
            $sec % 60
        );
    }
}
