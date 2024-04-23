<?php

declare(strict_types=1);

namespace Pg\modules\banners\helpers {

    /**
     * Banners module
     *
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    /**
     * Banners management
     *
     * @subpackage  Banners
     *
     * @category    helpers
     *
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    if (!function_exists('bannerInitialize')) {

        /**
         * Return banners initialization code
         *
         * @return string
         */
        function bannerInitialize()
        {
            $ci = &get_instance();
            $banner_html = $ci->view->fetch('show_banner_setup', 'user', 'banners');
            return $banner_html;
        }

    }

    if (!function_exists('showBannerPlace')) {

        /**
         * Return banners for place
         *
         * @param integer|string $place_id place identifier
         *
         * @return string
         */
        function showBannerPlace($place_id)
        {
            $ci = &get_instance();

            if (func_num_args() == 1 && is_array($place_id)) {
                $params = $place_id;
                $place_id = isset($params['place_id']) ? $params['place_id'] : 0;
            }

            $ci->load->model(['banners/models/BannerPlaceModel',
                'banners/models/BannerGroupModel', 'BannersModel']);
            if (!is_numeric($place_id)) {
                $place = $ci->BannerPlaceModel->getByKeyword($place_id);
                $place_id = !empty($place) ? (int)$place['id'] : 0;
            } else {
                $place_id = (is_numeric($place_id) and $place_id > 0) ? intval($place_id) : 0;
                $place = $ci->BannerPlaceModel->get($place_id);
            }
            if (!is_array($place) or !$place) {
                return;
            }
            $place['places_in_rotation'] = intval($place['places_in_rotation']);

            $ci->uri->_fetch_uri_string();
            $uri = $ci->uri->ruri_string();
            $uri = trim(substr($uri, 1));

            if (empty($uri) || count(explode('/', $uri)) <= 3) {
                $uri = $ci->router->fetch_class(true) . '/' . $ci->router->fetch_method();
            }

            if (PRODUCT_NAME == 'social') {
                if ($place['keyword'] == 'bottom-banner' && trim($uri, '/') == 'start/index') {
                    return '';
                }
            }
            $group_id = $ci->BannerGroupModel->getGroupIdByPageLink($uri);
            if (!$group_id) {
                $group_ids = $ci->BannerGroupModel->searchGroupsIdByPageLink($uri);
                if (empty($group_ids)) {
                    return;
                }
            } else {
                $group_ids[] = $group_id;
            }

            $banners = $ci->BannersModel->showRotationBanners($group_ids, $place_id, $place['places_in_rotation']);

            // don't show banner place without banners
            if (empty($banners)) {
                return;
            }

            $ci->view->assign('place', $place);
            $ci->view->assign('banners', $banners);

            // show template from banners module default user theme
            return $ci->view->fetch('show_banner_place', 'user', 'banners');
        }

    }

    if (!function_exists('adminHomeBannersBlock')) {

        /**
         * Return banners information block for admin homepage
         *
         * @return string
         */
        function adminHomeBannersBlock()
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata("auth_type");
            if ($auth_type != "admin") {
                return '';
            }

            $user_type = $ci->session->userdata("user_type");

            $show = true;

            if ($user_type == 'moderator') {
                $show = false;
                $ci->load->model('Moderators_model');
                $methods = $ci->Moderators_model->get_module_methods('banners');
                if (is_array($methods) && !in_array('index', $methods)) {
                    $show = true;
                } else {
                    $permission_data = $ci->session->userdata("permission_data");
                    if (isset($permission_data['banners']['index']) && $permission_data['banners']['index'] == 1) {
                        $show = true;
                    }
                }
            }

            if (!$show) {
                return '';
            }

            $ci->load->model('Banners_model');
            $stat_banners['users'] = $ci->Banners_model->cnt_banners(["where" => ['user_id !=' => 0, "approve" => 0]]);

            $ci->view->assign("stat_banners", $stat_banners);

            return $ci->view->fetch('helper_admin_home_block', 'admin', 'banners');
        }

    }

    if (!function_exists('myBanners')) {
        function myBanners($params)
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata("auth_type");
            if ($auth_type != "user") {
                return '';
            }

            $ci->load->model('Banners_model');

            if (isset($params['page'])) {
                $page = intval($params['page']);
            }

            $page = max($page, 1);

            $params["where"]["user_id"] = $ci->session->userdata("user_id");
            $cnt_banners = $ci->Banners_model->cnt_banners($params);

            $items_on_page = $ci->pg_module->get_module_config('banners', 'items_per_page');
            $ci->load->helper('sort_order');
            $page = get_exists_page_number($page, $cnt_banners, $items_on_page);

            $banners = $ci->Banners_model->get_banners($page, $items_on_page, ["id" => "DESC"], $params);
            // get place objects for banner
            if ($banners) {
                $ci->load->model('banners/models/Banner_place_model');
                foreach ($banners as $key => $banner) {
                    $banners[$key]['banner_place_obj'] = $banner['banner_place_id'] ? $ci->Banner_place_model->get($banner['banner_place_id']) : null;
                }
            }
            $ci->view->assign('banners', $banners);

            $ci->load->helper("navigation");
            $page_data = get_user_pages_data(site_url() . "users/account/banners/", $cnt_banners, $items_on_page, $page, 'briefPage');
            $page_data['date_format'] = $ci->pg_date->get_format('date_literal', 'st');
            $ci->view->assign('page_data', $page_data);

            $ci->Menu_model->breadcrumbs_set_parent('my_banners_item');

            $ci->view->render('my_list_block', 'user', 'banners');
        }
    }

}

namespace {

    if (!function_exists('banner_initialize')) {
        function banner_initialize()
        {
            return Pg\modules\banners\helpers\bannerInitialize();
        }
    }

    if (!function_exists('show_banner_place')) {
        function show_banner_place($place_id)
        {
            return Pg\modules\banners\helpers\showBannerPlace($place_id);
        }
    }

    if (!function_exists('admin_home_banners_block')) {
        function admin_home_banners_block()
        {
            return Pg\modules\banners\helpers\adminHomeBannersBlock();
        }
    }

    if (!function_exists('my_banners')) {
        function my_banners($params)
        {
            return Pg\modules\banners\helpers\myBanners($params);
        }
    }

}
