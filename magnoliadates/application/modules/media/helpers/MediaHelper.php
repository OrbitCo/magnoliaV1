<?php

declare(strict_types=1);

namespace Pg\modules\media\helpers {

    if (!function_exists('mediaBlock')) {
        function mediaBlock($params)
        {
            $ci = &get_instance();

            $location_base_url = !empty($params['location_base_url']) ? $params['location_base_url'] : '';
            $param = $params['param'] ? $params['param'] : 'all';
            $page = $params['page'] ? $params['page'] : 1;
            $template = (isset($params['template']) && !empty($params['template'])) ?
                    'user_gallery_' . $params['template'] : 'user_gallery';
            if (!empty($params['user_id'])) {
                $user_id = $params['user_id'];
                $is_owner = false;
            } else {
                $user_id = $ci->session->userdata('user_id');
                $is_owner = $user_id ? true : false;
            }

            $ci->load->model('Media_model');

            $media_sorter = [
                "order"     => !empty($params['order']) ? $params['order'] : 'date_add',
                "direction" => !empty($params['direction']) ? $params['direction'] : 'DESC',
                "links"     => [
                    "date_add"       => l('field_date_add', 'media'),
                    "views"          => l('field_views', 'media'),
                    "comments_count" => l('field_comments_count', 'media'),
                ],
            ];
            $order_by = [$media_sorter['order'] => $media_sorter['direction']];

            $ci->view->assign('is_owner', $is_owner);
            $ci->view->assign('media_sorter', $media_sorter);
            $ci->view->assign('profile_section', 'gallery');
            $ci->view->assign('gallery_param', $param);
            $ci->view->assign('page', $page);
            if ($param == 'albums') {
                $albums = $ci->Media_model->get_albums($user_id, $page);
                $albums['albums_select'] = $ci->Media_model->get_albums_select($user_id);
                $ci->view->assign('content', $albums);
            } else {
                $ci->view->assign('content', $ci->Media_model->get_list($user_id, $param, $page, 0, true, $order_by));
            }
            $ci->view->assign('albums', $ci->Media_model->get_albums_select($user_id));
            $ci->view->assign('id_user', $user_id);

            if (is_callable($location_base_url)) {
                $media_filters = [
                    'all'       => ['link' => $location_base_url('all', l('all', 'media')), 'name' => l('all', 'media')],
                    'photo'     => ['link' => $location_base_url('photo', l('photo', 'media')), 'name' => l('photo', 'media')],
                    'video'     => ['link' => $location_base_url('video', l('video', 'media')), 'name' => l('video', 'media')],
                    'audio'     => ['link' => $location_base_url('audio', l('audio', 'audio_uploads')), 'name' => l('audio', 'audio_uploads')],
                    'albums'    => ['link' => $location_base_url('albums', l('albums', 'media')), 'name' => l('albums', 'media')],
                    'favorites' => ['link' => $location_base_url('favorites', l('favorites', 'media')), 'name' => l('favorites', 'media')],
                ];
            } else {
                $media_filters = [
                    'all'       => ['link' => $location_base_url . '/all', 'name' => l('all', 'media')],
                    'photo'     => ['link' => $location_base_url . '/photo', 'name' => l('photo', 'media')],
                    'video'     => ['link' => $location_base_url . '/video', 'name' => l('video', 'media')],
                    'audio'     => ['link' => $location_base_url . '/audio', 'name' => l('audio', 'audio_uploads')],
                    'albums'    => ['link' => $location_base_url . '/albums', 'name' => l('albums', 'media')],
                    'favorites' => ['link' => $location_base_url . '/favorites', 'name' => l('favorites', 'media')],
                ];
            }

            $audio_uploads = $ci->pg_module->is_module_installed('audio_uploads');
            if (!$audio_uploads) {
                unset($media_filters['audio']);
            }

            if (!isset($params['filters'])) {
                $params['filters'] = $media_filters;
            }

            $ci->view->assign('audio_uploads', $audio_uploads);
            $ci->view->assign('media_filters', $params['filters']);
            return $ci->view->fetch($template, 'user', 'media');
        }
    }

    if (!function_exists('mediaCarousel')) {
        function mediaCarousel($params)
        {
            $ci = &get_instance();

            $data['header'] = !empty($params['header']) ? $params['header'] : '';
            $data['media'] = $params['media'];
            $data['carousel']['media_count'] = count($params['media']);
            $data['rand'] = $data['carousel']['rand'] = rand(1, 999999);
            $data['carousel']['visible'] = !empty($params['visible']) ? intval($params['visible']) : 3;
            $data['carousel']['scroll'] = (!empty($params['scroll']) && $params['scroll'] != 'auto') ? intval($params['scroll']) : 'auto';
            $data['carousel']['class'] = !empty($params['class']) ? $params['class'] : '';
            $data['carousel']['thumb_name'] = !empty($params['thumb_name']) ? $params['thumb_name'] : 'middle';
            if (!$data['carousel']['scroll']) {
                $data['carousel']['scroll'] = 1;
            }

            $ci->view->assign('media_carousel_data', $data);

            return $ci->view->fetch('helper_media_carousel', 'user', 'media');
        }
    }

    if (!function_exists('userMediaBlock')) {
        function userMediaBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model('Media_model');

            $user_id = intval($params['user_id']);
            $current_user = $ci->session->userdata('user_id');
            if (!empty($user_id)) {
                $params['template'] = (isset($params['template']) && !empty($params['template'])) ?
                    $params['template'] : '';

                $where = [
                    'where' => [
                        'id_user' => $user_id
                    ],
                    'where_in' => [
                        'upload_gid' => [
                            $ci->Media_model->file_config_gid,
                            $ci->Media_model->video_config_gid
                        ]
                    ]
                ];
                if ($ci->pg_module->is_module_installed("audio_uploads")) {
                    $where['where_in']['upload_gid'][] = $ci->Media_model->audio_config_gid;
                }

                $data = $ci->Media_model->getRecentMedia($params['count'], null, $where);
                $data['id_user'] = $user_id;
                if (!empty($data['media'])) {
                    if (empty($params['media_size'])) {
                        $media_count = 16 - count($data['media']);
                        switch ($media_count) {
                            case 13:
                                $recent_thumb['name'] = 'middle';
                                $recent_thumb['width'] = '82px';
                                break;
                            case 14:
                                $recent_thumb['name'] = 'big';
                                $recent_thumb['width'] = '125px';
                                break;
                            case 15:
                                $recent_thumb['name'] = 'great';
                                $recent_thumb['width'] = '255px';
                                break;
                            default:
                                $recent_thumb['name'] = 'small';
                                $recent_thumb['width'] = '60px';
                        }
                    } else {
                        switch ($params['media_size']) {
                            case 'middle':
                                $recent_thumb['name'] = 'middle';
                                $recent_thumb['width'] = '82px';
                                break;
                            case 'big':
                                $recent_thumb['name'] = 'big';
                                $recent_thumb['width'] = '125px';
                                break;
                            case 'great':
                                $recent_thumb['name'] = 'great';
                                $recent_thumb['width'] = '255px';
                                break;
                            default:
                                $recent_thumb['name'] = 'small';
                                $recent_thumb['width'] = '60px';
                        }
                    }

                    $current_user = $ci->session->userdata('user_id');
                    $gallery_link = site_url() . "users/view/{$user_id}/gallery";
                    if ($current_user == $user_id) {
                        $gallery_link = site_url() . 'users/profile/gallery';
                    }

                    if ($ci->pg_module->is_module_installed('access_permissions')) {
                        $is_gallery = $ci->acl->checkSimple('view_page', 'users_users_user_gallery');
                        if (!$is_gallery && $current_user != $user_id) {
                            $ci->view->assign('no_acces_gallery', 1);
                            $ci->view->assign('access_permissions_link', site_url() . 'access_permissions/index');
                        }
                    }

                    $ci->view->assign('gallery_link', $gallery_link);

                    if ($params['template'] == 'magazine') {
                        $ci->view->assign('user_media_count', 3);
                    } else {
                        $ci->view->assign('user_media_count', $data['media_count']);
                    }
                    $ci->view->assign('recent_photos_data', $data);
                    $ci->view->assign('recent_thumb', $recent_thumb);
                    $ci->view->assign('id_user', $user_id);
                    if (isset($params['template'])) {
                        $ci->view->assign('recent_template', $params['template']);
                    }

                    if (!empty($params['template'])) {
                        $ci->view->assign('user_media_block', $ci->view->fetch('user_media_block_' . $params['template'], 'user', 'media'));
                    } else {
                        $ci->view->assign('user_media_block', $ci->view->fetch('user_media_block', 'user', 'media'));
                    }

                    return $ci->view->fetch('helper_user_media_block', 'user', 'media');
                } else {
                    if ($params['template'] == 'magazine') {
                        $ci->view->assign('id_user', $user_id);
                        $ci->view->assign('user_media_count', 3);
                        $ci->view->assign('recent_template', $params['template']);
                        if ($current_user == $user_id) {
                            $ci->view->assign('gallery_link', site_url() . 'users/profile/gallery');
                        }
                        $ci->view->assign('user_media_block', $ci->view->fetch('user_media_block_' . $params['template'], 'user', 'media'));
                        return $ci->view->fetch('helper_user_media_block', 'user', 'media');
                    }
                }
            }

            return false;
        }
    }

    if (!function_exists('eventsMediaBlock')) {
        function eventsMediaBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model('Media_model');
            $ci->load->model('Events_model');
            $ci->Media_model->initialize($ci->Events_model->album_type);

            $album_id = intval($params['album_id']);

            if (!empty($album_id)) {
                $where = [];
                $where['where_in']['upload_gid'][] = $ci->Media_model->file_config_gid;
                $where['where_in']['upload_gid'][] = $ci->Media_model->video_config_gid;

                $ci->load->model('media/models/Media_album_model');
                $media_count = $ci->Media_album_model->get_album_media_count($album_id);

                $data = $ci->Media_model->get_gallery_list($params['count'], 'events', null, $album_id, ['date_add' => 'DESC'], $where);
                if (!empty($data['media'])) {
                    if (empty($params['media_size'])) {
                        $media_count = 16 - count($data['media']);
                        switch ($media_count) {
                            case 13:
                                $recent_thumb['name'] = 'middle';
                                $recent_thumb['width'] = '82px';
                                break;
                            case 14:
                                $recent_thumb['name'] = 'big';
                                $recent_thumb['width'] = '125px';
                                break;
                            case 15:
                                $recent_thumb['name'] = 'great';
                                $recent_thumb['width'] = '255px';
                                break;
                            default:
                                $recent_thumb['name'] = 'small';
                                $recent_thumb['width'] = '60px';
                        }
                    } else {
                        switch ($params['media_size']) {
                            case 'middle':
                                $recent_thumb['name'] = 'middle';
                                $recent_thumb['width'] = '82px';
                                break;
                            case 'big':
                                $recent_thumb['name'] = 'big';
                                $recent_thumb['width'] = '125px';
                                break;
                            case 'great':
                                $recent_thumb['name'] = 'great';
                                $recent_thumb['width'] = '255px';
                                break;
                            default:
                                $recent_thumb['name'] = 'small';
                                $recent_thumb['width'] = '60px';
                        }
                    }
                    $ci->view->assign('recent_thumb', $recent_thumb);
                }

                $ci->view->assign('album_id', $album_id);
                $ci->view->assign('recent_photos_data', $data);
                $ci->view->assign('event_media_count', $media_count);
                $ci->view->assign('event_media_block', $ci->view->fetch('event_media_block', 'user', 'media'));
            }

            return $ci->view->fetch('helper_event_media_block', 'user', 'media');
        }
    }

    if (!function_exists('recentMediaBlock')) {
        function recentMediaBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model('Media_model');
            $data = $ci->Media_model->get_recent_media($params['count'], $params['upload_gid']);
            if (!empty($data['media'])) {
                $media_count = 16 - count($data['media']);
                switch ($media_count) {
                    case 13:
                        $recent_thumb['name'] = 'middle';
                        $recent_thumb['width'] = '82px';
                        break;
                    case 14:
                        $recent_thumb['name'] = 'big';
                        $recent_thumb['width'] = '125px';
                        break;
                    case 15:
                        $recent_thumb['name'] = 'great';
                        $recent_thumb['width'] = '255px';
                        break;
                    default:
                        $recent_thumb['name'] = 'small';
                        $recent_thumb['width'] = '60px';
                }
                $ci->view->assign('recent_photos_data', $data);
                $ci->view->assign('recent_thumb', $recent_thumb);
                $ci->view->assign('current_user', $ci->session->userdata('user_id'));

                if ($ci->pg_module->is_module_installed('access_permissions')) {
                        $is_gallery = $ci->acl->checkSimple('view_page', 'users_users_user_gallery');
                    if (!$is_gallery) {
                        $ci->view->assign('no_acces_gallery', 1);
                        $ci->view->assign('access_permissions_link', site_url() . 'access_permissions/index');
                    }
                }

                return $ci->view->fetch('helper_recent_media', 'user', 'media');
            }

            return false;
        }
    }

    if (!function_exists('getAlbumsForMedia')) {
        function getAlbumsForMedia($params)
        {
            $ci = &get_instance();
            $ci->load->model('Media_model');
            $ci->load->model('media/models/Media_album_model');
            $ci->load->model('media/models/Albums_model');

            $media_id = $params['id'];
            $user_id = $params['user_id'];
            $section = trim($params['section']);
            $media = $ci->Media_model->get_media_by_id($media_id);
            $is_access_permitted = $ci->Media_model->is_access_permitted($media_id, $media);
            $is_user_media_user = ($media['id_user'] == $user_id);
            $is_user_media_owner = ($media['id_owner'] == $user_id);
            $ci->view->assign('is_user_media_owner', $is_user_media_owner);
            $ci->view->assign('is_user_media_user', $is_user_media_user);
            $ci->view->assign('is_access_permitted', $is_access_permitted);
            $ci->view->assign('media', $media);
            $albums = [];

            if ($is_user_media_user) {
                $media_in_album = $ci->Media_album_model->get_albums_by_media_id($media_id);
            } elseif ($is_access_permitted) {
                $media_parent_id = $media['id_parent'] ? $media['id_parent'] : $media_id;
                $parent_ids = $ci->Media_model->get_parent_media_list_ids($media_parent_id);
                $media_in_album = $ci->Media_album_model->get_albums_by_media_id(array_merge($parent_ids, (array) $media_id, (array) $media_parent_id));
            }

            $param['where']['id_user'] = $user_id;
            $param["where"]["id_album_type"] = $ci->Media_model->album_type_id;
            $albums['user'] = ($user_id) ? $ci->Albums_model->get_albums_list($param) : [];
            $param['where']['id_user'] = '0';
            $albums['common'] = $ci->Albums_model->get_albums_list($param, null, null, null, null, true, $ci->pg_language->current_lang_id);

            $ci->view->assign('media_albums', $albums);
            $ci->view->assign('media_in_album', $media_in_album);

            return $ci->view->fetch('section_albums', 'user', 'media');
        }
    }

    if (!function_exists('mediaAddPhoto')) {
        function mediaAddPhoto(array $params = [])
        {
            $ci = &get_instance();

            $ci->view->assign('user', ['id' => $ci->session->userdata('user_id')]);

            return $ci->view->fetch('helper_add_photo', 'user', 'media');
        }
    }
    if (!function_exists('loadPicture')) {

        function loadPicture($params)
        {
            $ci = &get_instance();

            $picture_params = [
                'size_name' => $params['size'],
                'src' => $params['thumbs'][$params['size']],
                'alt' => !empty($params['alt']) ? $params['alt'] : (!empty($params['text']) ? $params['text'] : '')
            ];
            if (!empty($params['class'])) {
                $picture_params['class'] = $params['class'];
            }
            if (!empty($params['id'])) {
                $picture_params['id'] = $params['id'];
            }
            if (!empty($params['width'])) {
                $picture_params['width'] = $params['width'];
            }
            if (!empty($params['height'])) {
                $picture_params['height'] = $params['height'];
            }
            $ci->view->assign('picture_params', $picture_params);
            return $ci->view->fetch('picture', 'user', 'media');
        }
    }

}

namespace {

    if (!function_exists('media_block')) {
        function media_block($params)
        {
            return Pg\modules\media\helpers\mediaBlock($params);
        }
    }

    if (!function_exists('media_carousel')) {
        function media_carousel($params)
        {
            return Pg\modules\media\helpers\mediaCarousel($params);
        }
    }

    if (!function_exists('user_media_block')) {
        function user_media_block($params)
        {
            return Pg\modules\media\helpers\userMediaBlock($params);
        }
    }

    if (!function_exists('events_media_block')) {
        function events_media_block($params)
        {
            return Pg\modules\media\helpers\eventsMediaBlock($params);
        }
    }

    if (!function_exists('recent_media_block')) {
        function recent_media_block($params)
        {
            return Pg\modules\media\helpers\recentMediaBlock($params);
        }
    }

    if (!function_exists('get_albums_for_media')) {
        function get_albums_for_media($params)
        {
            return Pg\modules\media\helpers\getAlbumsForMedia($params);
        }
    }

    if (!function_exists('media_add_photo')) {
        function media_add_photo(array $params = [])
        {
            return Pg\modules\media\helpers\mediaAddPhoto($params);
        }
    }
    if (!function_exists('load_picture')) {
        function load_picture($params)
        {
            return Pg\modules\media\helpers\loadPicture($params);
        }
    }

}
