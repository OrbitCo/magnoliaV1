<?php

declare(strict_types=1);

namespace Pg\modules\payments\Events;

use Pg\Libraries\Analytics;
use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;
use Pg\modules\payments\models\PaymentsModel;

class EventPaymentsHandler extends EventHandler
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

        if ($ci->pg_module->is_module_installed('statistics')) {
            $ci->load->model("Statistics_model");
            $events = $ci->Statistics_model->getSystemEvents(PaymentsModel::MODULE_GID);

            if (isset($events['payment_send']) && $events['payment_send'] == '1') {
                $event_handler->addListener(PaymentsModel::EVENT_PAYMENT_CHANGED, function ($params) use ($ci) {
                    $params = $params->getData();

                    if ($params['status'] != PaymentsModel::STATUS_PAYMENT_PROCESSED) {
                        return;
                    }

                    $ci->load->model("Statistics_model");
                    $file = $ci->Statistics_model->getStatisticsFile(PaymentsModel::MODULE_GID);
                    $log_path = TEMPPATH . 'logs/statistics/' . $file;

                    $stat_point_arr['gid'] = 'payment_send';
                    $stat_point_arr['params']['amount'] = $params['amount'];

                    $stat_point = json_encode($stat_point_arr);
                    $fp = fopen($log_path, "a");
                    fputs($fp, $stat_point . "\r\n");
                    fclose($fp);
                });
            }
        }

        if ($ci->pg_module->is_module_installed('special_offers')) {
            $event_handler->addListener('receive_payment_event', function ($event) use ($ci) {
                $ci->load->model("special_offers/models/Special_offers_model");
                $data = $event->getData();
                $ci->Special_offers_model->makeSpecialOffers($data);
            });
        }

    }
}
