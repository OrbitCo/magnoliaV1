<?php

declare(strict_types=1);

namespace Pg\modules\get_token\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\get_token\models\events\EventGetToken;

class GetTokenModel extends \Model
{
    const MODULE_GID = 'get_token';
    const EVENT_ACTION = 'get_token_mobile_auth';

    public function mobileAuth($id = null)
    {
        if ($id) {
            $event_handler = EventDispatcher::getInstance();
            $event = new EventGetToken();
            $event->setData([
                'id' => $id,
                'action' => self::EVENT_ACTION,
                'module' => self::MODULE_GID
            ]);
            $event_handler->dispatch($event, self::EVENT_ACTION);
        }
    }

    public function bonusCounterCallback($counter = [])
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventGetToken();
        $event->setData($counter);
        $event_handler->dispatch($event, 'bonus_counter');
    }

    public function bonusActionCallback($data = [])
    {
        if (!empty($data)) {
            $counter = $data['counter'];
            $counter['count'] = $counter['count'] + 1;
            $counter['is_new_counter'] = $data['is_new_counter'];
            $counter['repetition'] = $data['bonus']['repetition'];
            $this->bonusCounterCallback($counter);
        }
    }
}
