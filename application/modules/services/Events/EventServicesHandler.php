<?php

declare(strict_types=1);

namespace Pg\modules\services\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

class EventServicesHandler extends EventHandler
{
    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $event_handler->addListener('users_get_service', function ($event) {
                $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('special_offers')) {
                $ci->load->model("special_offers/models/Special_offers_model");
                $data = $event->getData();
                $ci->Special_offers_model->makeSpecialOffers($data);
            }
        });

        if ($_ENV['DEMO_MODE']) {
            $event_handler->addListener('users_get_service', function ($event) {
                $ci = &get_instance();
                $data = $event->getData();
                $ci->load->library('Analytics');
                $ci->load->model("services/models/Services_model");
                if (!isset($data['payment_data']['service_gid'])) {
                    $service = $ci->Services_model->getServiceById($data['payment_data']['id_service']);
                    $gid = $service['gid'];
                } else {
                    $gid =  $data['payment_data']['service_gid'];
                }
                $event = $ci->analytics->getEvent('payments', $gid, 'user');
                $ci->analytics->track($event);
            });
        }
    }
}
