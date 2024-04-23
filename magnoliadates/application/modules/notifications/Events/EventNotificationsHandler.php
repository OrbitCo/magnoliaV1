<?php

namespace Pg\modules\notifications\Events;

use Pg\libraries\EventDispatcher;
use Pg\libraries\EventHandler;

class EventNotificationsHandler extends EventHandler
{
    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $ci = &get_instance();

        $event_handler->addListener('user_register', function ($params) use ($ci) {
            $ci->load->model(['notifications/models/Notifications_users_model', 'Notifications_model']);
            $notifications = $ci->Notifications_model->getSettingsGids();
            $ci->Notifications_users_model->saveUserNotifications($params->getSearchFrom(), $notifications);
        });
    }
}
