<?php
/**
 * Notifications module
 *
 * @package PG_Dating
 * @copyright   Copyright (c) 2000-2017 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
declare(strict_types=1);

namespace Pg\modules\notifications\helpers {

    use Pg\modules\notifications\models\NotificationsModel;

    if (!function_exists('notificationsList')) {

        /**
         *  Block notifications list
         *
         * @return string
         */
        function notificationsList()
        {
            $ci = &get_instance();
            $ci->load->model('Notifications_model');
            $notifications = $ci->Notifications_model->getNotificationsList(
                null,
                null,
                null,
                ['where_in' => ['gid' => $ci->Notifications_model->notifications_list_settings]],
                null,
                true
             );
            $ci->view->assign('notifications_list', $notifications);
            return $ci->view->fetch('helper_notifications_list_settings', 'user', NotificationsModel::MODULE_GID);
        }
    }

}
