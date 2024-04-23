<?php

declare(strict_types=1);
namespace Pg\modules\services\models\events;

use Symfony\Component\EventDispatcher\Event;

class EventServices extends Event
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