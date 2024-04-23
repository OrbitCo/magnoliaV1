<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\models\events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class EventChatbox.
 *
 * @package PG_Dating
 * @subpackage  chatbox
 * @category    events
 * @copyright   Copyright (c) 2000-2020 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class EventChatbox extends Event
{
    protected $data = [];

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
