<?php

declare(strict_types=1);

namespace Pg\modules\moderators\helpers {

    /**
     * Show moderators
     *
     * @package PG_Core
     * @subpackage application
     *
     * @category    helpers
     *
     * @copyright Pilot Group <http://www.pilotgroup.net/>
     * @author Nikita Savanaev <nsavanaev@pilotgroup>
     * */
    if (!function_exists('countAusers')) {
        function countAusers()
        {
            $ci = &get_instance();
            $ci->load->model('moderators/models/Moderators_model');
            $data["all"] = $ci->Moderators_model->get_users_count();
            $data["moderators"] = $ci->Moderators_model->get_users_count(["where" => ["user_type" => 'moderator']]);
            $ci->view->assign('count_data', $data);

            return $ci->view->fetch('helper_count', 'admin', 'moderators');
        }
    }

    if (!function_exists('addModerator')) {
        function addModerator()
        {
            $ci = &get_instance();
            $ci->load->model('moderators/models/Moderators_model');

            return $ci->view->fetch('helper_add_button', 'admin', 'moderators');
        }
    }

}

namespace {
    
    if (!function_exists('count_ausers')) {
        function count_ausers()
        {
            return Pg\modules\moderators\helpers\countAusers();
        }
    }

    if (!function_exists('add_moderator')) {
        function add_moderator()
        {
            return Pg\modules\moderators\helpers\addModerator();
        }
    }
    
}
