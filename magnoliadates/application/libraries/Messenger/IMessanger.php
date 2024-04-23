<?php

declare(strict_types=1);

namespace Pg\Libraries\Messenger;

/**
 * Messenger interface
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
interface IMessanger
{
    /**
     * @param $value
     * @return IMessanger
     */
    public function setSender($value): IMessanger;

    /**
     * @param $value
     * @return IMessanger
     */
    public function setRecipient($value): IMessanger;

    /**
     * @param $value
     * @return IMessanger
     */
    public function setMessageData($value): IMessanger;

    /**
     * @return bool
     */
    public function send(): bool;
}
