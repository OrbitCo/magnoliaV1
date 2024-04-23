<?php

declare(strict_types=1);

namespace Pg\modules\winks\helpers {

    if (!function_exists('wink')) {
        function wink($params)
        {
            $ci = &get_instance();
            if ('user' !== $ci->session->userdata('auth_type')) {
                return false;
            }
            $current_user = (int) $ci->session->userdata('user_id');
            $target_user = (int) $params['user_id'];
            if (!$current_user || !$target_user || $current_user === $target_user) {
                return false;
            }

            $ci->load->model('Winks_model');
            $wink = $ci->Winks_model->getByPair($current_user, $target_user);
            $is_pending = false;
            if ($wink) {
                if ((int) $wink['id_from'] === $current_user) {
                    $is_pending = true;
                } else {
                    $ci->view->assign('wink_back', ($wink['type'] != 'ignored'));
                }
            } else {
                $ci->view->assign('is_new', true);
            }
            $ci->view->assign('is_pending', $is_pending);
            $ci->view->assign('wink', $wink);
            $ci->view->assign('current_id', $current_user);
            $ci->view->assign('partner_id', $target_user);
            $ci->view->assign('wink_button_rand', rand(100000, 999999));

            if (empty($params['view_type'])) {
                $params['view_type'] = 'button';
            }
            return $ci->view->fetch('helper_wink_' . $params['view_type'], 'user', 'winks');
        }
    }

    if (!function_exists('winksCount')) {
        function winksCount($attrs)
        {
            $ci = &get_instance();
            $ci->load->model('Winks_model');
            $winks = $ci->Winks_model->backendWinksCount();
            $ci->view->assign('winks_count', $winks['count']);

            return $ci->view->fetch('helper_winks_' . $attrs['template'], 'user', 'winks');
        }
    }

}

namespace {
    
    if (!function_exists('wink')) {
        function wink($params)
        {
            return Pg\modules\winks\helpers\wink($params);
        }
    }

    if (!function_exists('winks_count')) {
        function winks_count($attrs)
        {
            return Pg\modules\winks\helpers\winksCount($attrs);
        }
    }

}
