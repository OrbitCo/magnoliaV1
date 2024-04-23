<?php

declare(strict_types=1);

namespace Pg\Libraries\Messenger;

/**
 * AbstractMessenger
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AbstractMessenger extends \Model implements IMessanger
{
    /**
     * @var string
     */
    protected $sender;

    /**
     * @var string
     */
    protected $recipient;

    /**
     * @var string
     */
    protected $message;

    /**
     * AbstractMessenger class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function setSender($value): IMessanger
    {
        $this->sender = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRecipient($value): IMessanger
    {
        $this->recipient = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessageData($value): IMessanger
    {
        $this->message = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        return true;
    }
}
