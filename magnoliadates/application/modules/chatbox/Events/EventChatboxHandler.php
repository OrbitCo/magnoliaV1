<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

/**
 * Class EventChatbox.
 *
 * @package PG_Dating
 * @subpackage  chatbox
 * @category    events
 * @copyright   Copyright (c) 2000-2020 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class EventChatboxHandler extends EventHandler
{
    /**
     * Init handler
     *
     * return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $event_handler->addListener(
            'update_msg',
            function ($params) {
                $data = $params->getData();
                $ci = &get_instance();
                $ci->load->model("ChatboxModel");
                $id = $data['id'];
                $attrs = $data['attrs'];
                $ci->ChatboxModel->save($id, $attrs);
            }
        );
    }
}
