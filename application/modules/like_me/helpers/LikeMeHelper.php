<?php

declare(strict_types=1);

namespace Pg\modules\like_me\helpers {

    use Pg\modules\couples\models\CouplesModel;

    /**
     * like me helper
     *
     * @package PG_Dating
     * @subpackage application
     *
     * @category    helpers
     *
     * @copyright Pilot Group <http://www.pilotgroup.net/>
     * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
     **/
    if (!function_exists('play')) {
        function play($params)
        {
            $ci = &get_instance();

            $user_data = [];
            if (!empty($params['value']['user'])) {
                $user_data = $params['value']['user'];
                $ci->view->assign('user_data', $user_data);
            } else {
                $play_more = unserialize($ci->pg_module->get_module_config('like_me', 'play_more'));
                if (!$ci->pg_module->is_module_installed('perfect_match')) {
                    unset($play_more['perfect']);
                }
                $ci->view->assign('play_more', $play_more);
            }
            $module = 'like_me';
            if ($ci->Users_model->is_couples_installed === true) {
                if (!empty($user_data['user_type']) && $user_data['user_type'] === CouplesModel::USER_TYPE) {
                    $module = 'couples';
                }
            }
            if ($params['value']['type'] == 'matches') {
                $module_gid = $ci->pg_module->get_module_config('like_me', 'chat_more');
                $ci->load->model('LikeMeModel');
                $settings = $ci->LikeMeModel->getActionModules($module_gid);
                $ci->view->assign('settings', $settings);

                $return = $ci->view->fetch('like_me_matches', 'user', $module);
            } elseif (in_array($params['value']['type'], ['like', 'like_me'])) {
                $return = $ci->view->fetch('like_me_profiles', 'user', $module);
            } else {
                $return = $ci->view->fetch('helper_play', 'user', $module);
            }

            return $return;
        }
    }

    if (!function_exists('likeMeStart')) {
        
        function likeMeStart($params)
        {
            $ci = &get_instance();

            return $ci->view->fetch('helper_start', 'user', 'like_me');
        }
    }
    
    if (!function_exists('isLiked')) {
        /**
         * Is liked
         * @param array $params
         *
         * @return boolean
         */
        function isLiked($params)
        {
            $ci = &get_instance();
            $ci->load->model('LikeMeModel');
            return (bool) $ci->LikeMeModel->getLikedCheck([
                'id_user' => $params['profile_id'],
                'id_profile' => $ci->session->userdata('user_id')
            ]);
        }
    }

}

namespace {

    if (!function_exists('play')) {
        function play($params)
        {
            return Pg\modules\like_me\helpers\play($params);
        }
    }

    if (!function_exists('like_me_start')) {
        function like_me_start($params)
        {
            return Pg\modules\like_me\helpers\likeMeStart($params);
        }
    }
    
    if (!function_exists('isLiked')) {
        function isLiked($params)
        {
            return Pg\modules\like_me\helpers\isLiked($params);
        }
    }
    
}
