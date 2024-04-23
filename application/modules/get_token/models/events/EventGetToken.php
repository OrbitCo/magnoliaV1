<?php

declare(strict_types=1);

namespace Pg\modules\get_token\models\events;

class EventGetToken extends \Symfony\Component\EventDispatcher\Event
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
