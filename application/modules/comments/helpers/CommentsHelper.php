<?php

declare(strict_types=1);

namespace Pg\modules\comments\helpers {

    /*
     * Comments helper
     *
     * @package PG_Dating
     * @subpackage application
     *
     * @category    helpers
     *
     * @copyright Pilot Group <http://www.pilotgroup.net/>
     * @author Dmitry Popenov
     *
     * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
     **/
    if (!function_exists('commentsForm')) {
        function commentsForm($params)
        {
            if (!(isset($params['gid']) && $params['gid'] && isset($params['id_obj']) && $params['id_obj'])) {
                return false;
            }
            $ci = &get_instance();
            $ci->load->model('comments/models/Comments_types_model');
            $comments_type = $ci->Comments_types_model->get_comments_type_by_gid($params['gid']);
            if (!($comments_type && $comments_type['status'])) {
                return '<span>' . l('comments_disabled', 'comments') . '</span>';
            }
            $tpl = &$ci->view;
            $tpl->assign('date_format', $ci->pg_date->get_format('date_time_literal', 'st'));

            $params['calc_count'] = isset($params['calc_count']) ? intval($params['calc_count']) : 1;
            $ci->load->model('comments/models/Comments_model');
            if (!empty($params['hidden'])) {
                $comments['hidden'] = 1;
                $comments['gid'] = $params['gid'];
                $comments['id_obj'] = $params['id_obj'];
                if (isset($params['count'])) {
                    $comments['count_all'] = $params['count'];
                    $comments['calc_count'] = 1;
                } elseif ($params['calc_count'] == 1) {
                    $comments['calc_count'] = $params['calc_count'];
                    $comments['count_all'] = $ci->Comments_model->getCommentsCnt($params['gid'], $params['id_obj']);
                }
            } else {
                if ($comments_type['gid'] == 'wall_events' && !empty($params['asc_order'])) {
                }

                $params['order_by'] = isset($params['order_by']) ? $params['order_by'] : 'desc';
                $comments = $ci->Comments_model->getCommentsByGidObj($params['gid'], $params['id_obj'], null, $params['order_by']);
                $comments['hidden'] = 0;
            }
            if (!empty($params['max_height'])) {
                $comments['max_height'] = (strstr((string) $params['max_height'], '%') !== false) ? intval($params['max_height']) . '%' : intval($params['max_height']) . 'px';
            }
            $comments['view'] = (isset($params['view']) && !empty($params['view'])) ? $params['view'] : '';
            $comments['btn_view_class'] = (isset($params['btn_view_class']) && !empty($params['btn_view_class'])) ? $params['btn_view_class'] : '';
            $comments['btn_send_class'] = (isset($params['btn_send_class']) && !empty($params['btn_send_class'])) ? $params['btn_send_class'] : '';

            $js_lng = [
                'error' => l('error', 'comments'),
                'error_comment_text' => l('error_comment_text', 'comments'),
                'error_user_name' => l('error_user_name', 'comments'),
                'added' => l('added', 'comments'),
                'added_moderation' => l('added_moderation', 'comments'),
                'deleted' => l('deleted', 'comments'),
            ];

            $tpl->assign('js_lng', json_encode($js_lng));

            $comments['show_form'] = ($ci->session->userdata('auth_type') == 'user' || ($comments_type['settings']['guest_access'] && $ci->session->userdata('auth_type') != 'admin')) ? 1 : 0;

            if (isset($comments['comments'])) {
                foreach ($comments['comments'] as $key => $value) {
                    if ($value['status'] == 0) {
                        unset($comments['comments'][$key]);
                        if (!$comments['comments']) {
                            unset($comments['min_id']);
                            unset($comments['max_id']);
                        }
                    }
                }
            }
            if (!isset($comments['comments']) && !$comments['show_form']) {
                $tpl->assign('show_login', 1);
            }

            $tpl->assign('comments', $comments);
            $tpl->assign('comments_type', $comments_type);
            $tpl->assign('ajax', 0);
            $comments_html = $tpl->fetch('comments_form', 'user', 'comments');

            return $comments_html;
        }
    }

}

namespace {

    if (!function_exists('comments_form')) {
        function comments_form($params)
        {
            return Pg\modules\comments\helpers\commentsForm($params);
        }
    }

}
