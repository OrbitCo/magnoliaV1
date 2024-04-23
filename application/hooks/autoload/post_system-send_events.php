<?php

use Pg\Libraries\EventDispatcher;
use Pg\modules\users\models\events\EventUsers;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('send_events')) {

    function send_events()
    {
        if (INSTALL_DONE) {
            $event_handler = EventDispatcher::getInstance();
            $event = new EventUsers();
            $event_handler->dispatch($event, 'user_visit');
        }
    }
}
