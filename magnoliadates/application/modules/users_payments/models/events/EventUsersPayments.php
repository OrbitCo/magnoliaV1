<?php

declare(strict_types=1);

namespace Pg\modules\users_payments\models\events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Postbacks module
 * Postbacks for affiliate programs
 *
 * @package     PG_Dating
 * @subpackage  Postbacks
 * @category    events
 *
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 */
class EventUsersPayments extends Event
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set data
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
