<?php

declare(strict_types=1);

namespace Pg\modules\kisses\helpers {

    if (!function_exists("kissesList")) {
        /**
         * Show mark as spam button
         *
         * @param array $data
         *
         * @return html
         */
        function kissesList($data)
        {
            $ci = &get_instance();

            if (empty($data["user_id"])) {
                return '';
            }

            $ci->view->assign('user_id', $data["user_id"]);

            $user_id = $ci->session->userdata("user_id");
            if (!$user_id) {
                $ci->view->assign('is_user', 0);
            } else {
                $ci->view->assign('is_user', 1);
            }

            $ci->load->model('Kisses_model');
            $count = $ci->Kisses_model->get_count();
            if ($count == 0) {
                return '';
            }

            $ci->view->assign('kisses_button_rand', rand(100000, 999999));

            if (empty($data['view_type'])) {
                $data['view_type'] = 'button';
            }

            return $ci->view->fetch("helper_kisses_" . $data['view_type'], "user", "kisses");
        }
    }
    
    /**
     * Echo count kisses
     *
     * @param array $data
     *
     * @return html
     */
    if (!function_exists('newKisses')) {
        function newKisses($attrs)
        {
            $ci = &get_instance();
            if ('user' != $ci->session->userdata("auth_type")) {
                return false;
            }

            $user_id = $ci->session->userdata("user_id");

            if (!$user_id) {
                log_message('Empty user id');

                return false;
            }

            /* deprecation: use view_type */
            if (!empty($attrs['template'])) {
                $attrs['view_type'] = $attrs['template'];
            }
            /* deprecation: use view_type */

            if (empty($attrs['view_type'])) {
                $attrs['view_type'] = 'header';
            }

            $ci->load->model('Kisses_model');
            $count = $ci->Kisses_model->newKissesCount($user_id);
            $ci->view->assign('kisses_count', $count);

            return $ci->view->fetch('helper_new_kisses_' . $attrs['view_type'], 'user', 'kisses');
        }
    }

}

namespace {
    
    if (!function_exists("kisses_list")) {
        function kisses_list($data)
        {
            return Pg\modules\kisses\helpers\kissesList($data);
        }
    }

    if (!function_exists('new_kisses')) {
        function new_kisses($attrs)
        {
            return Pg\modules\kisses\helpers\newKisses($attrs);
        }
    }
    
}
