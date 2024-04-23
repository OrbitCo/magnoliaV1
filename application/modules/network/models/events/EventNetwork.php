<?php

declare(strict_types=1);

namespace Pg\modules\network\models\events;

use Symfony\Component\EventDispatcher\Event;

class EventNetwork extends Event
{
    protected $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }
}
