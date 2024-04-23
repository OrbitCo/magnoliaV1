<?php

declare(strict_types=1);

namespace Pg\modules\likes\helpers {

    if (!function_exists('likeBlock')) {
        function likeBlock($attrs)
        {
            $ci = &get_instance();

            if (empty($attrs['gid'])) {
                log_message('Empty gid');

                return false;
            }
            $ci->load->model('Likes_model');
            $ci->Likes_model->remember_gid($attrs['gid']);

            $attrs['block_class'] = !empty($attrs['block_class']) ? $attrs['block_class'] . ' pointer' : 'pointer';
            $attrs['template'] = $attrs['template'] ?? '';

            $block_class = !empty($attrs['block_class']) ? ' ' . $attrs['block_class'] : '';
            $num_class = !empty($attrs['num_class']) ? ' ' . $attrs['num_class'] : '';
            $btn_class = !empty($attrs['btn_class']) ? ' ' . $attrs['btn_class'] : '';
            $ci->view->assign('likes_helper_block_class', $block_class);
            $ci->view->assign('likes_helper_num_class', $num_class);
            $ci->view->assign('likes_helper_btn_class', $btn_class);
            $ci->view->assign('likes_helper_gid', $attrs['gid']);
            $ci->view->assign('template', $attrs['template']);
            return $ci->view->fetch('helper_button', 'user', 'likes');
        }
    }

    if (!function_exists('likes')) {
        function likes()
        {
            $ci = &get_instance();
            $data['can_like'] = ($ci->session->userdata('auth_type') == 'user');
            $data['like_title'] = l('like', 'likes');
            $ci->view->assign('likes_helper_data', $data);

            return $ci->view->fetch('helper_likes', 'user', 'likes');
        }
    }

}

namespace {

    if (!function_exists('like_block')) {
        function like_block($attrs)
        {
            return Pg\modules\likes\helpers\likeBlock($attrs);
        }
    }

    if (!function_exists('likes')) {
        function likes()
        {
            return Pg\modules\likes\helpers\likes();
        }
    }

}
