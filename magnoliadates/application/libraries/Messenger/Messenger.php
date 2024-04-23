<?php

declare(strict_types=1);

namespace Pg\Libraries\Messenger;

/**
 * Messenger
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class Messenger implements IMessanger
{

    /**
     * @var IMessanger
     */
    private $messenger;

    public function setMessenger(IMessanger $messenger): Messenger
    {
        $this->messenger = $messenger;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSender($value): IMessanger
    {
        $this->messenger->setSender($value);

        return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function setRecipient($value): IMessanger
    {
        $this->messenger->setRecipient($value);

        return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function setMessageData($value): IMessanger
    {
        $this->messenger->setMessageData($value);

        return $this->messenger;
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        $this->messenger->send();
    }
}
