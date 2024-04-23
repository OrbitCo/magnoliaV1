<?php

declare(strict_types=1);

namespace Pg\modules\news\helpers {

    /**
     * News module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */

    /**
     * News management
     *
     * @package     PG_Dating
     * @subpackage  News
     *
     * @category    helpers
     *
     * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    if (!function_exists('newsBlock')) {
        /**
         * Last added news block
         *
         * @param integer $count max news count
         * @param integer $width block width
         *
         * @return string
         */
        function newsBlock($count, $width = 100)
        {
            $ci = &get_instance();
            $ci->load->model('News_model');

            if (func_num_args() == 1 && is_array($count)) {
                $params = $count;
                $count = isset($params['count']) ? $params['count'] : 8;
                $width = isset($params['width']) ? $params['width'] : 100;
            }

            $count = intval($count);
            if (!$count) {
                $count = 8;
            }

            $attrs = ["status" => 1];
            $news = $ci->News_model->get_news_list(1, $count, ["id" => "DESC"], $attrs);

            if (empty($news)) {
                return '';
            }

            $ci->view->assign("news", $news);

            $ci->view->assign("block_width", $width);

            return $ci->view->fetch("helper_news_block", "user", "news");
        }
    }

    if (!function_exists('newsRelated')) {
        /**
         * Last added news block
         *
         * @param integer $count max news count
         * @param integer $width block width
         *
         * @return string
         */
        function newsRelated($params)
        {
            $ci = &get_instance();
            $ci->load->model('News_model');
            $attrs = [];

            $count = intval($params['count']);
            if (!$count) {
                $count = 10;
            }

            $attrs = ["status" => 1];
            $news_related = $ci->News_model->get_news_list(1, $count, ["id" => "DESC"], $attrs);

            if (empty($news_related)) {
                return '';
            }

            $ci->view->assign("news_related", $news_related);

            return $ci->view->fetch("helper_news_related", "user", "news");
        }
    }

}

namespace {

    if (!function_exists('news_last_added')) {
        function news_block($count, $width = 100)
        {
            if (func_num_args() == 1) {
                return Pg\modules\news\helpers\newsBlock($count);
            } else {
                return Pg\modules\news\helpers\newsBlock($count, $width);
            }
        }
    }

    if (!function_exists('newsRelated')) {
        function newsRelated($params)
        {
            return Pg\modules\news\helpers\newsRelated($params);
        }
    }

}
