<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\helpers {

    /**
     * VirtualGifts module
     *
     * @package     PG_Dating
     *
     * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
     * @author      DATING PRO LTD <http://www.pilotgroup.net/>
     */

    if (!function_exists('giftsMedia')) {
        function giftsMedia($params)
        {
            $ci = &get_instance();
            $ci->load->model("store/models/Store_products_model");
            if (!empty($params['id_product'])) {
                if ($params['type'] == 'photo') {
                    $media_id = !empty($params['id_media']) ? $params['id_media'] : 0;
                    $media    = $ci->Store_products_model->get_images_product(
                        $params['id_product'],
                        $params['amount'],
                        $media_id
                    );
                } else {
                    $media = [$ci->Store_products_model->get_product_by_id($params['id_product'])];
                }
                $data = $ci->Store_products_model->format_media(
                    $params['id_product'],
                    $media,
                    $params['type'],
                    $params['size']
                );
            }
            $ci->view->assign('media', $data);

            return $ci->view->fetch('helper_gift_media', 'admin', 'virtual_gifts');
        }
    }

    if (!function_exists('giftsAddPhotosForm')) {
        function giftsAddPhotosForm($params)
        {
            $ci                        = &get_instance();
            $ci->load->model("virtual_gifts/models/Virtual_gifts_model");
            $ci->load->model('Uploads_model');
            $media_config              = $ci->Uploads_model->get_config('store');
            $media_config['max_count'] = 4; //$ci->Store_products_model->max_photo_count;
            $ci->view->assign('photo_config', $media_config);

            return $ci->view->fetch('helper_gift_form', 'admin', 'virtual_gifts');
        }
    }

    if (!function_exists('menuLevel2Inc')) {
        function menuLevel2Inc($params)
        {
            $ci = &get_instance();
            switch ($params) {
                case 'index':
                    $ci->view->assign('settings', 'index');

                    break;
                case 'settings':
                    $ci->view->assign('settings', 'settings');

                    break;
            }

            return $ci->view->fetch('helper_menu_inc', 'admin', 'virtual_gifts');
        }
    }

    if (!function_exists('sendGift')) {
        function sendGift($params)
        {
            $ci        = &get_instance();
            $user_id   = intval($params['user_id']);
            $sender_id = $ci->session->userdata('user_id');
            if ($user_id != $sender_id) {
                $ci->load->model("virtual_gifts/models/Virtual_gifts_model");
                $gifts_count = $ci->Virtual_gifts_model->getVirtualGiftsCount(['is_active' => 1]);
                if (!empty($gifts_count)) {
                    if (!empty($params['class'])) {
                        $ci->view->assign('virtual_gifts_class', $params['class']);
                    }
                    $ci->view->assign('user_id', $user_id);
                    $ci->view->assign('virtual_gifts_button_rand', rand(100000, 999999));
                    $ci->view->assign('virtual_params', $params);
                    $template = (isset($params['template']) && !empty($params['template'])) ?
                        'helper_send_gift_' . $params['template'] : 'helper_send_gift';

                    return $ci->view->fetch($template, 'user', 'virtual_gifts');
                }
            }

            return false;
        }
    }

    if (!function_exists('userGiftsBlock')) {
        function userGiftsBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model("virtual_gifts/models/Virtual_gifts_model");
            $ci->load->model("users/models/Users_model");
            $ci->load->model("users/models/Users_deleted_model");
            $ci->load->model("Uploads_model");

            if (isset($params["id_wall"])) {
                $attrs = [];
                $is_mine = (isset($params["is_mine"]) && $params["is_mine"] == 'true')
                        ? true : false;
                $is_limit_cnt = (isset($params['is_limit_cnt'])) ?
                    boolval($params['is_limit_cnt']) : true;
                if ($is_limit_cnt) {
                    //limit count of displayed gifts in the block
                    $attrs['limit'] = '8';
                }

                $gifts_count = $ci->Virtual_gifts_model->getUserGiftsCount(
                    $params["id_wall"],
                    ['where' => ['status' => 'approved']]
                );

                $ci->view->assign('gifts_count', $gifts_count);
                $ci->view->assign('user_id', intval($params["id_wall"]));

                if (isset($params['user_profile_page'])) {
                    $ci->view->assign('user_profile_page', 'true');
                }

                $order_by = ['receipt_date' => 'DESC'];

                $ci->view->assign('is_mine', $is_mine);
                $gifts = $ci->Virtual_gifts_model->getUserGiftsList($params["id_wall"], false, $attrs, $order_by);

                if (isset($params["display_type"])) {
                    switch ($params["display_type"]) {
                        case 'homepage':
                            $display_type = 'homepage';

                            break;
                        default:
                            $display_type = 'block';

                            break;
                    }
                    $ci->view->assign('display_type', $display_type);
                }

                if (!empty($gifts)) {
                    $gift_sender_ids = [];
                    $formatted_users = [];
                    foreach ($gifts as $gift) {
                        $gift_sender_ids[] = $gift["fk_sender_id"];
                    }
                    $gift_sender_ids = array_unique($gift_sender_ids);
                    $users = $ci->Users_model->getUsersListByKey(null, null, null, [], $gift_sender_ids);
                    foreach ($gift_sender_ids as $id) {
                        if (!empty($users[$id]['id'])) {
                            $formatted_users[$id]["name"] =
                                \Pg\modules\users\helpers\userName(['format' => 'age', 'user' => $users[$id], 'is_link' => 1]);
                            $formatted_users[$id]["age"]  = $users[$id]["age"] ?? '';
                            $formatted_users[$id]["logo"] = $users[$id]["media"]["user_logo"]["thumbs"]["middle"];
                            $formatted_users[$id]["city"] = $users[$id]["city"] ?? '';
                        } else {
                            $default = $ci->Users_model->formatDefaultUser($id);
                            $deleted = $ci->Users_deleted_model->getUserByUserId($id, true);
                            $formatted_users[$id] = array_merge($default, $deleted);
                            $formatted_users[$id]["logo"] = $formatted_users[$id]["media"]["user_logo"]["thumbs"]["middle"];
                            $formatted_users[$id]["name"] = $formatted_users[$id]["output_name"];
                        }
                    }

                    foreach ($gifts as &$gift) {
                        $gift['comment'] = trim($gift['comment'], "'");
                        //json_decode for emojies
                        $text            = json_decode('["' . $gift['comment'] . '"]', true);
                        $gift['comment'] = $text[0];

                        $gift["sender"]["name"] = $formatted_users[$gift["fk_sender_id"]]["name"];
                        $gift["sender"]["age"]  = $formatted_users[$gift["fk_sender_id"]]["age"];
                        $gift["sender"]["logo"] = $formatted_users[$gift["fk_sender_id"]]["logo"];
                        $gift["sender"]["city"] = $formatted_users[$gift["fk_sender_id"]]["city"];
                    }
                }
                $ci->view->assign('gifts', $gifts);
                $ci->view->assign('site_url', site_url());
            }

            $template = (isset($params['template']) && !empty($params['template'])) ?
                'helper_user_gifts_block_' . $params['template'] : 'helper_user_gifts_block';

            return $ci->view->fetch($template, 'user', 'virtual_gifts');
        }
    }

    if (!function_exists('userGiftsMenuNotifier')) {
        function userGiftsMenuNotifier($params)
        {
            $ci = &get_instance();
            if ('user' === $ci->session->userdata('auth_type')) {
                $user_id = intval($ci->session->userdata('user_id'));
                $ci->load->model(['Users_model', 'Virtual_gifts_model']);

                $gifts = $ci->Virtual_gifts_model->getUserGiftsList($user_id, true, [
                    'where' => ['status' => 'pending',]
                ]);
                $ci->Virtual_gifts_model->backendGetRequestNotifications();

                if (!empty($gifts)) {
                    $ids = [];
                    foreach ($gifts as $gift) {
                        $ids[] = $gift['fk_sender_id'];
                    }
                    $sender_ids = array_unique($ids);
                    $senders = $ci->Users_model->getUsersListByKey(null, null, null, [], $sender_ids);
                    foreach ($gifts as &$gift) {
                        foreach ($senders as $sender) {
                            if ($gift['fk_sender_id'] == $sender['id']) {
                                $gift['sender_name'] = $sender['output_name'];
                                $gift['sender_media'] = $sender['media'];
                            }
                        }
                    }
                }
                $ci->load->helpers('cookie');
                $ci->view->assign('gifts', $gifts);
                $ci->view->assign('gift_opened', get_cookie('gift_opened'));
                $ci->view->assign('rand', rand(100000, 999999));

                return $ci->view->fetch('helper_receipt_gifts_menu', 'user', 'virtual_gifts');
            }

            return false;
        }
    }
}

namespace {

    if (!function_exists('gifts_media')) {
        function gifts_media($params)
        {
            return Pg\modules\virtual_gifts\helpers\giftsMedia($params);
        }
    }

    if (!function_exists('gifts_add_photos_form')) {
        function gifts_add_photos_form($params)
        {
            return Pg\modules\virtual_gifts\helpers\giftsAddPhotosForm($params);
        }
    }

    if (!function_exists('menu_level2_inc')) {
        function menu_level2_inc($params)
        {
            return Pg\modules\virtual_gifts\helpers\menuLevel2Inc($params);
        }
    }

    if (!function_exists('send_gift')) {
        function send_gift($params)
        {
            return Pg\modules\virtual_gifts\helpers\sendGift($params);
        }
    }

    if (!function_exists('user_gifts_block')) {
        function user_gifts_block($params)
        {
            return Pg\modules\virtual_gifts\helpers\userGiftsBlock($params);
        }
    }

    if (!function_exists('user_gifts_menu_notifier')) {
        function user_gifts_menu_notifier($params)
        {
            return Pg\modules\virtual_gifts\helpers\userGiftsMenuNotifier($params);
        }
    }
}
