<?php

declare(strict_types=1);

namespace Pg\modules\content\helpers {

    /**
     * Content module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */

    /**
     * Content management
     *
     * @package     PG_Dating
     * @subpackage  Content
     *
     * @category    helpers
     *
     * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    if (!function_exists('getContentTree')) {
        /**
         * Get content pages tree
         *
         * @param integer $parent_id parent page identifier
         *
         * @return string
         */
        function getContentTree($page_id = 0)
        {
            $ci = &get_instance();
            $ci->load->model('Content_model');
            $lang_id = $ci->pg_language->current_lang_id;

            $ci->load->model('Content_model');
            $lang_id = $ci->pg_language->current_lang_id;

            $ci->Content_model->set_page_active($page_id);

            $page_data = $ci->Content_model->get_page_by_id($page_id);
            $currents = $ci->Content_model->get_active_pages_list($lang_id, $page_data['parent_id']);

            if (!empty($page_data['parent_id'])) {
                $ci->Content_model->set_page_active($page_data['parent_id']);
            }

            $ci->view->assign("currents", $currents);
            $html = $ci->view->fetch("tree", 'user', 'content');
            echo $html;
        }
    }

    if (!function_exists('getContentPage')) {
        /**
         * Get content page
         *
         * @param string $gid page guid
         *
         * @return string
         */
        function getContentPage($gid)
        {
            $ci = &get_instance();
            $ci->load->model('Content_model');

            $page_data = $ci->Content_model->get_page_by_gid($gid);
            $ci->view->assign("page", $page_data);
            $html = $ci->view->fetch("show_block", 'user', 'content');
            echo $html;
        }
    }

    if (!function_exists('getContentPromo')) {
        /**
         * Get promo content
         *
         * @param string $view promo view
         *
         * @return string
         */
        function getContentPromo($view = 'default')
        {
            $ci = &get_instance();
            $ci->load->model('content/models/Content_promo_model');

            $lang_id = $ci->pg_language->current_lang_id;

            $ci->Content_promo_model->set_format_settings('get_output', true);
            $promo_data = $ci->Content_promo_model->get_promo($lang_id);
            $ci->Content_promo_model->set_format_settings('get_output', false);

            $ci->view->assign("promo", $promo_data);
            $ci->view->assign("view", $view);
            $html = $ci->view->fetch("show_promo_block", 'user', 'content');

            return $html;
        }
    }

    if (!function_exists('contentInfoPages')) {
        /**
         * Info pages widget
         *
         * @param string  $keyword page guid
         * @param string  $view    widget view
         * @param integer $width   block size
         *
         * @return string
         */
        function contentInfoPages($keyword = '', $view = 'default', $width = 100)
        {
            $ci = &get_instance();
            $ci->load->model('Content_model');

            if (func_num_args() == 1 && is_array($keyword)) {
                $params = $keyword;
                $keyword = isset($params['keyword']) ? $params['keyword'] : '';
                $view = isset($params['view']) ? $params['view'] : 'default';
                $width = isset($params['width']) ? $params['width'] : 100;
            }

            $lang_id = $ci->pg_language->current_lang_id;

            $parent_id = 0;

            if ($keyword) {
                $section = $ci->Content_model->get_page_by_gid($keyword);
                if ($section) {
                    $parent_id = $section["id"];
                    $ci->view->assign("section", $section);
                }
            }

            $params = ['where_sql' => ['(parent_id="' . $parent_id . '")']];
            $pages = $ci->Content_model->get_active_pages_list($lang_id, $parent_id, $params);
            if (empty($pages)) {
                return '';
            }

            foreach ($pages as $i => $page) {
                $page = $ci->Content_model->get_page_by_id($page['id']);
                $pages[$i]['content'] = strip_tags($page['content']);
            }

            $ci->view->assign("pages", $pages);

            $ci->view->assign('block_width', $width);

            return $ci->view->fetch("helper_info_pages", "user", "content");
        }
    }

    if (!function_exists('contentInfoPage')) {
        /**
         * Info page widget
         *
         * @param string  $keyword page guid
         * @param string  $view    widget view
         * @param integer $width   block size
         *
         * @return string
         */
        function contentInfoPage($keyword = '', $view = 'default', $width = 100)
        {
            $ci = &get_instance();
            $ci->load->model('Content_model');

            if (func_num_args() == 1 && is_array($keyword)) {
                $params = $keyword;
                $keyword = isset($params['keyword']) ? $params['keyword'] : '';
                $view = isset($params['view']) ? $params['view'] : 'default';
                $width = isset($params['width']) ? $params['width'] : 100;
            }

            if (!$keyword) {
                return '';
            }

            $info_page = $ci->Content_model->get_page_by_gid($keyword);
            if (empty($info_page)) {
                return '';
            }

            $block_data['data'] = $info_page;
            $ci->view->assign("info_page_data", $block_data);

            $ci->view->assign('block_width', $width);

            return $ci->view->fetch("helper_info_page", "user", "content");
        }
    }

    if (!function_exists('getPageLink')) {
        /**
         * Return link to page
         *
         * @param string  $page_gid page guid
         * @param integer $lang_id  language identifier
         *
         * @return string
         */
        function getPageLink($page_gid, $lang_id = null)
        {
            if (func_num_args() == 1 && is_array($page_gid)) {
                $params = $page_gid;
                $page_gid = isset($params['page_gid']) ? $params['page_gid'] : '';
                $lang_id = isset($params['lang_id']) ? $params['lang_id'] : null;
            }

            $ci = &get_instance();
            $ci->load->model('Content_model');

            if (empty($lang_id)) {
                $lang_id = $ci->pg_language->current_lang_id;
            }

            $page_data = $ci->Content_model->get_page_by_gid($page_gid, $lang_id);
            if (empty($page_data)) {
                return '';
            }

            $ci->load->helper('seo');

            return rewrite_link('content', 'view', $page_data);
        }
    }

}

namespace {

    if (!function_exists('get_content_tree')) {
        function get_content_tree($page_id = 0)
        {
            return Pg\modules\content\helpers\getContentTree($page_id);
        }
    }

    if (!function_exists('get_content_page')) {
        function get_content_page($gid)
        {
            return Pg\modules\content\helpers\getContentPage($gid);
        }
    }

    if (!function_exists('get_content_promo')) {
        function get_content_promo($view = 'default')
        {
            return Pg\modules\content\helpers\getContentPromo($view);
        }
    }

    if (!function_exists('content_info_pages')) {
        function content_info_pages($keyword = '', $view = 'default', $width = 100)
        {
            if (func_num_args() == 1) {
                return Pg\modules\content\helpers\contentInfoPages($keyword);
            } else {
                return Pg\modules\content\helpers\contentInfoPages($keyword, $view, $width);
            }
        }
    }

    if (!function_exists('content_info_page')) {
        function content_info_page($keyword = '', $view = 'default', $width = 100)
        {
            if (func_num_args() == 1) {
                return Pg\modules\content\helpers\contentInfoPage($keyword);
            } else {
                return Pg\modules\content\helpers\contentInfoPage($keyword, $view, $width);
            }
        }
    }

    if (!function_exists('get_page_link')) {
        function get_page_link($page_gid, $lang_id = null)
        {
            if (func_num_args() == 1) {
                return Pg\modules\content\helpers\getPageLink($page_gid);
            } else {
                return Pg\modules\content\helpers\getPageLink($page_gid, $lang_id);
            }
        }
    }

}
