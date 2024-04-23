<?php

declare(strict_types=1);

namespace Pg\modules\spam\models\events;

class EventSpam extends \Symfony\Component\EventDispatcher\Event
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
