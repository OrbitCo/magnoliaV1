<?php

declare(strict_types=1);

namespace Pg\modules\network\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

class EventNetworkHandler extends EventHandler
{
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();

        $event_handler->addListener('network_join_bonus_action', function ($params) {
            $ci = &get_instance();
            $ci->load->model("network/models/Network_users_model");
            $data = $params->getData();
            $callback = $data['callback'];
             $method_exists = true;
            if (!method_exists($ci->Network_users_model, $callback)) {
                $chunks = explode('_', $callback);
                $callback = array_shift($chunks);
                foreach ($chunks as $chunk) {
                    $callback .= ucfirst($chunk);
                }

                if (!method_exists($ci->Network_users_model, $callback)) {
                    $method_exists = false;
                }
            }
            if ($method_exists) {
                $ci->Network_users_model->{$callback}($data);
            }
        });
    }
}
