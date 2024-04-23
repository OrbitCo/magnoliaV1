<?php

declare(strict_types=1);

namespace Pg\modules\network\helpers {

    if (!function_exists('networkEmit')) {
        function networkEmit($event, $data)
        {
            $ci = &get_instance();
            $ci->load->model('network/models/Network_events_model');

            return $ci->Network_events_model->emit($event, $data);
        }
    }

    if (!function_exists('switchBtn')) {
        function switchBtn()
        {
            $ci = &get_instance();

            return $ci->view->fetch("helper_switch_btn_block", "user", "network");
        }
    }

}

namespace {

    if (!function_exists('network_emit')) {
        function network_emit($event, $data)
        {
            return Pg\modules\network\helpers\networkEmit($event, $data);
        }
    }

    if (!function_exists('switchBtn')) {
        function switchBtn()
        {
            return Pg\modules\network\helpers\switchBtn();
        }
    }

}
