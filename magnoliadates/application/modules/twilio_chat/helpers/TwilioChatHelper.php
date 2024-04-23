<?php

declare(strict_types=1);

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

namespace Pg\modules\twilio_chat\helpers {

    if (!function_exists('twilioVideoChat')) {
        function twilioVideoChat($params = [])
        {
            $ci = &get_instance();
            return $ci->view->fetch('helper_video_chat', 'user', 'twilio_chat');
        }
    }

    if (!function_exists('videoButton')) {
        function videoButton($params = [])
        {
            $ci = &get_instance();
            $ci->view->assign('params', $params);
            return $ci->view->fetch('helper_video_btn', 'user', 'twilio_chat');
        }
    }

}

namespace {

    if (!function_exists('twilio_video_chat')) {
        function twilio_video_chat($attrs = [])
        {
            return Pg\modules\twilio_chat\helpers\twilioVideoChat($attrs);
        }
    }

    if (!function_exists('video_button')) {
        function video_button($attrs = [])
        {
            return Pg\modules\twilio_chat\helpers\videoButton($attrs);
        }
    }

}
