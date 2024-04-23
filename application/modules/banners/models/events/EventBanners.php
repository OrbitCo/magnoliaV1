<?php

declare(strict_types=1);

namespace Pg\modules\banners\models\events;

class EventBanners extends \Symfony\Component\EventDispatcher\Event
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