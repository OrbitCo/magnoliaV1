<?php

declare(strict_types=1);

namespace Pg\modules\access_permissions\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

/**
 * Access_permissions event handler
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class EventAccessPermissionsHandler extends EventHandler
{
    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $event_handler->addListener(
            'users_buy_group',
            function ($event) {
                $ci = &get_instance();
                if ($ci->pg_module->is_module_installed('special_offers')) {
                    $ci->load->model("Special_offers_model");
                    $ci->Special_offers_model->makeSpecialOffers(
                        $event->getData()
                    );
                }
            }
        );
    }
}
