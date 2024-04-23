<?php

declare(strict_types=1);

namespace Pg\modules\media\controllers;

/**
 * Media controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (РЎСЂ, 02 Р°РїСЂ 2010) $ $Author: mchernov $
 * */
class ApiMedia extends \Controller
{
    private $user_id = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Media_model");
        $this->user_id = intval($this->session->userdata('user_id'));
    }

    /**
    * @api {post} /media/getMediaContent Get media content
    * @apiGroup Media
    * @apiParam {int} media_id Media id
    * @apiParam {boolean} [without_position] filter
    * @apiParam {boolean} [filter_duplicate] filter
    * @apiParam {string}  [place] filter for sorting
    * @apiParam {string}  [order] filter for sorting
    * @apiParam {string}  [gallery_param] filter
    * @apiParam {string}  [direction] order by (ASC or DESC)
    * @apiParam {int}  [album_id] album id
    */
    public function getMediaContent()
    {
        $data = ['content' => '', 'position_info' => '', 'media_type' => ''];

        $media_id = filter_input(INPUT_POST, 'media_id', FILTER_VALIDATE_INT);
        $media = $this->Media_model->get_media_by_id($media_id, true, true);

        $data['is_user_media_owner'] = ($media['id_owner'] == $this->user_id);
        $data['is_user_media_user'] = ($media['id_user'] == $this->user_id);
        $data['date_formats']['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        $data['date_formats']['date_time_format'] = $this->pg_date->get_format('date_time_literal', 'st');

        $data['is_access_permitted'] = $this->Media_model->is_access_permitted($media_id, $media);
        if ($data['is_access_permitted']) {
            $this->Media_model->increment_media_views($media_id);
            $data['media'] = $media;
        }

        if (!filter_input(INPUT_POST, 'without_position', FILTER_VALIDATE_BOOLEAN)) {
            $place = filter_input(INPUT_POST, 'place', FILTER_SANITIZE_STRING);
            $filter_duplicate = ($place == 'site_gallery') ? true : intval(filter_input(INPUT_POST, 'filter_duplicate', FILTER_VALIDATE_BOOLEAN));
            $user_id = ($place == 'site_gallery') ? 0 : $media['id_user'];
            $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
            if (!$order) {
                $order = 'date_add';
            }
            $direction = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_STRING);
            $order_by[$order] = ($direction == 'asc') ? 'ASC' : 'DESC';
            $gallery_param = filter_input(INPUT_POST, 'gallery_param', FILTER_SANITIZE_STRING) || 'all';
            $album_id = filter_input(INPUT_POST, 'album_id', FILTER_VALIDATE_INT) || 0;
            $data['position_info'] = $this->Media_model->get_media_position_info($media_id, $gallery_param, $album_id, $user_id, true, $order_by, $filter_duplicate);
        }
        $data['media_type'] = $media['upload_gid'];

        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /media/getList Media page
    * @apiGroup Media
    * @apiParam {int} [user_id] user id
    * @apiParam {string} [order] filter for sorting
    * @apiParam {string}  [param] filter for sorting
    * @apiParam {string}  [page] for pagination
    * @apiParam {boolean}  [get_likes] if need view likes of media
    * @apiParam {string}  [direction] order by (ASC or DESC)
    * @apiParam {int}  [album_id] album id
    */
    public function getList()
    {
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        if (!$user_id) {
            $user_id = $this->user_id;
        } elseif ($user_id != $this->user_id) {
            $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                    new \Pg\Libraries\Acl\Resource\Page(
                        ['module' => 'users', 'controller' => 'users', 'action' => 'user_gallery']
                    )), false);
            if (!$is_allowed) {
                $this->set_api_content('info', ['access_denied' => str_replace('%access_permissions_page%',
                    site_url('access_permissions'),
                    l('info_action_change_group', 'access_permissions'))]);
            }
        }
        $param = filter_input(INPUT_POST, 'param', FILTER_SANITIZE_STRING);
        $page = filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT);
        $album_id = filter_input(INPUT_POST, 'album_id', FILTER_VALIDATE_INT);
        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
        $direction = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_STRING);
        $get_likes = filter_input(INPUT_POST, 'get_likes', FILTER_VALIDATE_BOOLEAN);

        $order = $order ?: 'date_add';
        
        $order_by[$order] = ('asc' === $direction) ? 'ASC' : 'DESC';
        if ('albums' === $param && !$album_id) {
            $albums = $this->Media_model->get_albums($user_id, $page);
            $albums['albums_select'] = $this->Media_model->get_albums_select($user_id);
            $this->set_api_content('data', $albums);
        } else {
            $list = $this->Media_model->getList($user_id, $param, $page, $album_id, true, $order_by);
            if ($get_likes && $this->pg_module->is_module_installed('likes')) {
                if ($list['media_count'] > 0) {
                    $this->getLikes($list);
                }
            }
            
            $this->load->model('spam/models/Spam_alert_model');
            foreach ($list['media'] as $key => $value) {
                $object_id = $value['id'];
                $is_spam_marked = $this->Spam_alert_model->isAlertFromPoster('media_object', $this->session->userdata('user_id'), $object_id);
                if ($is_spam_marked) {
                    $list['media'][$key]['is_spam_marked'] = 1;
                } else {
                    $list['media'][$key]['is_spam_marked'] = 0;
                }
            }
            
            $this->set_api_content('data', $list);
        }
    }

    private function getLikes(&$media_list)
    {
        $like_ids = [];
        foreach ($media_list['media'] as $media) {
            $like_ids[] = 'media' . $media['id'];
        }
        $this->load->model('Likes_model');
        $likes = $this->Likes_model->get_count($like_ids);
        if ($this->user_id) {
            $my_likes = $this->Likes_model->get_likes_by_user($this->user_id);
        } else {
            $my_likes = [];
        }
        foreach ($media_list['media'] as &$media) {
            $like_id = 'media' . $media['id'];
            $media['likes'] = [
                'id'       => $like_id,
                'count'    => isset($likes[$like_id]) ? $likes[$like_id] : 0,
                'has_mine' => in_array($like_id, $my_likes),
            ];
        }
    }


    /**
    * @api {post} /media/getGalleryList Gallery list
    * @apiGroup Media
    * @apiParam {int} [user_id] user id
    * @apiParam {string} [order] filter for sorting
    * @apiParam {string} [param] filter for sorting
    * @apiParam {string} [page] for pagination
    * @apiParam {int} [loaded_count] if need view likes of media
    * @apiParam {string} [direction] order by (ASC or DESC)
    * @apiParam {int} [album_id] album id
    */

    public function getGalleryList()
    {
        $album_id = filter_input(INPUT_POST, 'album_id', FILTER_VALIDATE_INT);
        $param = filter_input(INPUT_POST, 'param', FILTER_SANITIZE_STRING);
        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
        $direction = filter_input(INPUT_POST, 'direction', FILTER_SANITIZE_STRING);
        $page = filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT);
        if (!$order) {
            $order = 'date_add';
        }
        $order_by[$order] = ('asc' === $direction) ? 'ASC' : 'DESC';
        if ('albums' === $param && !$album_id) {
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            if (!$user_id) {
                $user_id = 0;
            }
            $gallery = $this->Media_model->get_albums($user_id, $page);
        } else {
            $count = filter_input(INPUT_POST, 'count');
            $loaded_count = filter_input(INPUT_POST, 'loaded_count', FILTER_VALIDATE_INT);
            $gallery = $this->Media_model->get_gallery_list($count, $param, $loaded_count, $album_id, $order_by);
        }
        $this->set_api_content('data', $gallery);
    }

    /**
    * @api {post} /media/addMediaInAlbum Add media in album
    * @apiGroup Media
    * @apiParam {int} media_id media id
    * @apiParam {int} album_id album id
    */
    public function addMediaInAlbum($media_id, $album_id)
    {
        if (!$this->Media_model->is_access_permitted($media_id)) {
            $this->set_api_content('data', ['status' => 0]);

            return false;
        }
        $this->load->model('media/models/Media_album_model');
        $this->load->model('media/models/Albums_model');

        $media = $this->Media_model->get_media_by_id($media_id);
        $album = $this->Albums_model->get_album_by_id($album_id);
        if (!$album) {
            $this->set_api_content('data', ['status' => 0]);

            return false;
        }
        $is_album_owner = ($album['id_user'] == $this->user_id);
        $is_common_album = ($album['id_user'] == 0);

        if ($media['id_owner'] == $this->user_id && $media['id_parent'] == 0) { //user is media owner && user
            if ($is_album_owner || $is_common_album) {
                $add_status = $this->Media_album_model->add_media_in_album($media_id, $album_id);
            }
        } elseif ($media['id_owner'] == $this->user_id && $media['id_parent'] != 0) { //user is media owner && !user
            if ($is_album_owner || $is_common_album) {
                $add_status = $this->Media_album_model->add_media_in_album($media['id_parent'], $album_id); //original media
            }
        } elseif ($media['id_owner'] != $this->user_id && $media['id_user'] == $this->user_id) { //user is media user && !owner
            if ($is_album_owner) {
                $add_status = $this->Media_album_model->add_media_in_album($media_id, $album_id);
            }
        } elseif ($media['id_owner'] != $this->user_id && $media['id_user'] != $this->user_id && $media['id_parent'] != 0) { //foreign media on foreign gallery
            if ($is_album_owner) {
                $param['where']['id_user'] = $this->user_id;
                $param['where']['id_parent'] = $media['id_parent'];
                $m = $this->Media_model->get_media(null, null, null, $param);
                if (count($m)) {
                    $add_status = $this->Media_album_model->add_media_in_album($m[0]['id'], $album_id);
                } else {
                    $new_media_id = $this->Media_model->copy_media($media_id);
                    $add_status = $this->Media_album_model->add_media_in_album($new_media_id, $album_id);
                }
            }
        } else {
            if ($is_album_owner) {
                $param['where']['id_user'] = $this->user_id;
                $param['where']['id_parent'] = $media_id;
                $m = $this->Media_model->get_media(null, null, null, $param);
                if (count($m)) {
                    $add_status = $this->Media_album_model->add_media_in_album($m[0]['id'], $album_id);
                } else {
                    $new_media_id = $this->Media_model->copy_media($media_id);
                    $add_status = $this->Media_album_model->add_media_in_album($new_media_id, $album_id);
                }
            }
        }
        if (!empty($add_status['status'])) {
            $this->set_api_content('data', ['status' => 1]);
        } else {
            $this->set_api_content('data', ['status' => 0]);
            $this->set_api_content('errors', !empty($add_status['error']) ? $add_status['error'] : l('error_add_in_ablum', 'media'));
        }
    }

    /**
    * @api {post} /media/deleteMediaFromAlbum Delete media from album
    * @apiGroup Media
    * @apiParam {int} media_id media id
    * @apiParam {int} album_id album id
    */
    public function deleteMediaFromAlbum($media_id, $album_id)
    {
        $this->load->model('media/models/Albums_model');
        $album = $this->Albums_model->get_album_by_id($album_id);
        if (!$album) {
            $this->set_api_content('data', ['status' => 0]);

            return false;
        }
        $is_album_owner = ($album['id_user'] == $this->user_id);
        $is_common_album = ($album['id_user'] == 0);

        if ($is_album_owner || $is_common_album) {
            $this->load->model('media/models/Media_album_model');
            $this->load->model('Media_model');
            $is_user_media_user = $this->Media_model->is_user_media_user($media_id);
            if ($is_user_media_user) {
                $this->Media_album_model->delete_media_from_album($media_id, $album_id);
            } else {
                $media = $this->Media_model->get_media_by_id($media_id);
                if (!$media) {
                    $this->set_api_content('data', ['status' => 0]);

                    return false;
                }
                if ($media['id_parent']) {
                    $media_id = $media['id_parent'];
                }
                $params['where']['id_parent'] = $media_id;
                $params['where']['id_user'] = $this->user_id;
                $media_list = $this->Media_model->get_media(null, null, null, $params);
                if (isset($media_list[0]['id'])) {
                    $this->Media_album_model->delete_media_from_album($media_list[0]['id'], $album_id);
                } else {
                    unset($params['where']['id_parent']);
                    $params['where']['id'] = $media_id;
                    $media_list = $this->Media_model->get_media(null, null, null, $params);
                    if (isset($media_list[0]['id'])) {
                        $this->Media_album_model->delete_media_from_album($media_list[0]['id'], $album_id);
                    }
                }
            }
        }
        $this->set_api_content('data', ['status' => 1]);
    }

    /**
    * @api {post} /media/saveDescription Save description
    * @apiGroup Media
    * @apiParam {int} id media id
    * @apiParam {int} fname file name
    * @apiParam {int} description file description
    */
    public function saveDescription()
    {
        $photo_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$this->Media_model->is_user_media_user($photo_id)) {
            $this->set_api_content('data', ['status' => 0]);

            return false;
        }

        $post_data = [
            "fname"       => filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING),
            "description" => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
        ];
        $validate_data = $this->Media_model->validate_image($post_data);
        $data['status'] = 0;
        if (empty($validate_data["errors"])) {
            $save_data = $this->Media_model->save_image($photo_id, $validate_data["data"]);
            $data['status'] = 1;
            $data['save_data'] = $save_data;
            if (!empty($save_data['errors'])) {
                $this->set_api_content('data', ['status' => 0]);
                $this->set_api_content('errors', $save_data["errors"]);
            }
        } else {
            $this->set_api_content('errors', $validate_data["errors"]);
        }
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /media/saveAlbum Save album
    * @apiGroup Media
    * @apiParam {int} [permissions] permission
    * @apiParam {string} [mode] 'small' - if not need save description
    * @apiParam {int} [album_id] album id
    * @apiParam {string} name album name
    */
    public function saveAlbum($mode = 'small', $album_id = null)
    {
        $return = ['errors' => '', 'data' => ['status' => 0]];
        $this->load->model('media/models/Albums_model');
        if ($_POST) {
            if ($mode == 'small') {
                $post_data = [
                    "name"        => $this->input->post("name", true),
                    "permissions" => 1,
                ];
            } else {
                $post_data = [
                    "name"        => $this->input->post("name", true),
                    "permissions" => $this->input->post("permissions", true),
                    "description" => $this->input->post("description", true),
                ];
            }
            $validate_data = $this->Albums_model->validate_album($post_data);
            $validate_data['data']["id_album_type"] = $this->Media_model->album_type_id;
            if (empty($validate_data["errors"])) {
                $new_album_id = $this->Albums_model->save($album_id, $validate_data['data']);
                if ($new_album_id) {
                    $return['data']['status'] = 1;
                    $return['data']['album_id'] = $new_album_id;
                }
            } else {
                $return['errors'] = $validate_data["errors"];
            }
        } else {
            $return['errors'] = l('no_data_sended', 'media');
        }
        $this->set_api_content('data', $return['data']);
        $this->set_api_content('errors', $return['errors']);
    }

    /**
    * @api {post} /media/getPermissionsList Permissions list
    * @apiGroup Media
    */
    public function getPermissionsList()
    {
        $this->set_api_content('data', ld('permissions', 'media', $this->session->userdata("lang_id")));
    }

    /**
    * @api {post} /media/getPhotoEdit Photo edit configurations
    * @apiGroup Media
    */
    public function getPhotoEdit()
    {
        $this->load->model('Uploads_model');
        $upload_config = $this->Uploads_model->get_config($this->Media_model->file_config_gid);
        $selections = [];
        foreach ($upload_config['thumbs'] as $thumb_config) {
            $selections[$thumb_config['prefix']] = [
                'width' => $thumb_config['width'],
                'height' => $thumb_config['height'],
            ];
        }
        $this->set_api_content('data', ['selections' => $selections]);
    }

    /**
    * @api {post} /media/savePhoto Save photo
    * @apiGroup Media
    * @apiParam {int} id media id
    * @apiParam {string} [rotate] rotate angle
    * @apiParam {string} prefix prefix
    * @apiParam {int} height current height
    * @apiParam {int} width current width
    * @apiParam {int} orig_height original height
    * @apiParam {int} orig_width original width
    * @apiParam {int} x1 coordinate x
    * @apiParam {int} y1 coordinate y
    */
    public function savePhoto()
    {
        $photo_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $rotate = filter_input(INPUT_POST, 'rotate', FILTER_SANITIZE_STRING);
        if (!empty($rotate)) {
            $data = $this->Media_model->rotation($photo_id, $rotate);
        } else {
            $data = [
                'prefix' => filter_input(INPUT_POST, 'prefix', FILTER_SANITIZE_STRING),
                'height' => filter_input(INPUT_POST, 'height', FILTER_VALIDATE_INT),
                'width' => filter_input(INPUT_POST, 'width', FILTER_VALIDATE_INT),
                'orig_height' => filter_input(INPUT_POST, 'orig_height', FILTER_VALIDATE_INT),
                'orig_width' => filter_input(INPUT_POST, 'orig_width', FILTER_VALIDATE_INT),
                'x1' => filter_input(INPUT_POST, 'x1', FILTER_VALIDATE_INT),
                'y1' => filter_input(INPUT_POST, 'y1', FILTER_VALIDATE_INT),
            ];
        }
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /media/savePermissions Save media permissions
    * @apiGroup Media
    * @apiParam {int} photo_id photo id
    * @apiParam {int} permissions permission
    */
    public function savePermissions()
    {
        $return = ['errors' => '', 'data' => ['status' => 0]];

        $photo_id = filter_input(INPUT_POST, 'photo_id', FILTER_VALIDATE_INT);
        if (!$this->Media_model->is_user_media_owner($photo_id)) {
            $this->set_api_content('data', ['status' => 0]);

            return false;
        }

        $post_data = [
            "permissions" => filter_input(INPUT_POST, 'permissions', FILTER_VALIDATE_INT),
        ];

        $validate_data = $this->Media_model->validate_image($post_data);
        if (empty($validate_data["errors"])) {
            $save_data = $this->Media_model->save_image($photo_id, $validate_data["data"]);
            $this->Media_model->update_children_permissions($photo_id, $validate_data["data"]["permissions"]);
            $return['data']["status"] = 1;
        } else {
            $return["errors"] = $validate_data["errors"];
            $return['data']["status"] = 0;
        }
        if (!empty($save_data['errors'])) {
            $return["errors"] += $save_data['errors'];
            $return['data']["status"] = 0;
        }
        $this->set_api_content('data', $return['data']);
        $this->set_api_content('errors', $return['errors']);
    }

    /**
    * @api {post} /media/saveImage Save image
    * @apiGroup Media
    * @apiParam {int} [description] description
    * @apiParam {int} [permissions] permission
    * @apiParam {int} [id_albums] album id
    * @apiParam {int} [image_id] image id
    */
    public function saveImage($image_id = null)
    {
        $post_data = [
            'permissions' => filter_input(INPUT_POST, 'permissions', FILTER_VALIDATE_INT),
            'description' => filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING),
        ];
        $validate_data = $this->Media_model->validate_image($post_data, 'multiUpload');
        $validate_data['data']['id_user'] = $this->user_id;
        $validate_data['data']['id_owner'] = $this->user_id;
        $validate_data['data']['type_id'] = $this->Media_model->album_type_id;
        $validate_data['data']['upload_gid'] = $this->Media_model->file_config_gid;

        if (empty($validate_data['errors'])) {
            $save_data = $this->Media_model->save_image($image_id, $validate_data['data'], 'multiUpload');
            $this->load->model('Moderation_model');
            $mstatus = intval($this->Moderation_model->get_moderation_type_status($this->Media_model->moderation_type));
            $this->Moderation_model->add_moderation_item($this->Media_model->moderation_type, $save_data['id']);
            $status_data['status'] = $mstatus;
            $this->Media_model->save_image($save_data['id'], $status_data);

            $id_album = filter_input(INPUT_POST, 'id_albums', FILTER_VALIDATE_INT);
            if ($id_album) {
                $this->load->model('media/models/Albums_model');
                $is_user_can_add = $this->Albums_model->is_user_can_add_to_album($id_album);
                if ($is_user_can_add['status']) {
                    $this->load->model('media/models/Media_album_model');
                    $this->Media_album_model->add_media_in_album($save_data['id'], $id_album);
                }
            }
        }
        $return['errors']['form_error'] = $validate_data['form_error'];
        if (!empty($validate_data['errors'])) {
            $return['errors'] = $validate_data['errors'];
        }
        if (empty($save_data['errors'])) {
            if (!empty($save_data['file'])) {
                $return['data']['name'] = $save_data['file'];
            }
        } else {
            $return['errors'][] = $save_data['errors'];
        }
        if (!empty($is_user_can_add['error'])) {
            $return['errors'][] = $is_user_can_add['error'];
        }

        $this->set_api_content('data', $return['data']);
        $this->set_api_content('errors', $return['errors']);
    }

    /**
    * @api {post} /media/saveVideo Save video
    * @apiGroup Media
    * @apiParam {int} [description] description
    * @apiParam {int} [permissions] permission
    * @apiParam {int} [id_albums] album id
    */
    public function saveVideo()
    {
        if ($_POST) {
            $post_data = [
                "permissions" => $this->input->post("permissions", true),
                "description" => $this->input->post("description", true),
            ];
        }
        $validate_data = $this->Media_model->validate_video($post_data, 'videofile');
        $validate_data['data']["id_user"] = $this->user_id;
        $validate_data['data']["id_owner"] = $this->user_id;
        $validate_data['data']["type_id"] = $this->Media_model->album_type_id;
        $validate_data['data']["upload_gid"] = $this->Media_model->video_config_gid;
        if (empty($validate_data["errors"])) {
            $save_data = $this->Media_model->save_video(null, $validate_data["data"], 'videofile');

            $this->load->model('Moderation_model');
            $mstatus = intval($this->Moderation_model->get_moderation_type_status($this->Media_model->moderation_type));
            $this->Moderation_model->add_moderation_item($this->Media_model->moderation_type, $save_data['id']);
            $status_data['status'] = $mstatus;
            $this->Media_model->save_video($save_data['id'], $status_data);

            $id_album = intval($this->input->post('id_album'));
            if ($id_album) {
                $this->load->model('media/models/Albums_model');
                $is_user_can_add = $this->Albums_model->is_user_can_add_to_album($id_album);
                if ($is_user_can_add['status']) {
                    $this->load->model('media/models/Media_album_model');
                    $this->Media_album_model->add_media_in_album($save_data['id'], $id_album);
                }
            }
        }
        $return['errors']["form_error"] = $validate_data['form_error'];

        if (!empty($validate_data["errors"])) {
            $return["errors"] = $validate_data["errors"];
        }
        if (empty($save_data['errors'])) {
            if (!empty($save_data['file'])) {
                $return['data']["name"] = $save_data['file'];
            }
        } else {
            $return["errors"][] = $save_data['errors'];
        }
        if (!empty($is_user_can_add['error'])) {
            $return['errors'][] = $is_user_can_add['error'];
        }

        $this->set_api_content('data', $return['data']);
        $this->set_api_content('errors', $return['errors']);
    }

    /**
    * @api {post} /media/deleteMedia Delete media
    * @apiGroup Media
    * @apiParam {int} [id] media id
    */
    public function deleteMedia()
    {
        $media_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $data = ['status' => 0];
        $messages = [];
        if (!empty($media_id) && $this->Media_model->is_user_media_user($media_id)) {
            $this->Media_model->delete_media($media_id);
            $data['status'] = 1;
            $messages[] = l('success_delete_media', 'media');
        }
        $this->set_api_content('data', $data);
        $this->set_api_content('messages', $messages);
    }

    /**
    * @api {post} /media/deleteAlbum Delete album
    * @apiGroup Media
    * @apiParam {int} [id_album] album id
    */
    public function deleteAlbum($id_album = 0)
    {
        $data = ['status' => 0, 'message' => ''];
        $id_album = intval($id_album);
        $this->load->model('media/models/Albums_model');
        if ($id_album && $this->Albums_model->is_user_album_owner($id_album)) {
            $this->Albums_model->delete_album($id_album);
            $data['status'] = 1;
            $data['message'] = l('success_delete_media', 'media');
            $data['albums_select'] = $this->Media_model->get_albums_select($this->user_id);
            $data['id_user'] = $this->user_id;
        }
        $this->set_api_content(['data' => $data]);
    }

    /**
     * Recrop upload
     *
     * @return void
     */
    /**
    * @api {post} /media/recrop Recrop upload
    * @apiGroup Media
    * @apiParam {int} upload_id upload id
    * @apiParam {int} height current height
    * @apiParam {int} width current width
    * @apiParam {int} x1 coordinate x
    * @apiParam {int} y1 coordinate y
    */
    public function recrop()
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];
        $upload_id = intval($this->input->post('upload_id', true));
        $recrop_data = [
            'x1' => $this->input->post('data', true)['x1'],
            'y1' => $this->input->post('data', true)['y1'],
            'width' => $this->input->post('data', true)['width'],
            'height' => $this->input->post('data', true)['height'],
        ];
        $media = $this->Media_model->getMediaById($upload_id);
        if ($media && $media['id_owner'] == $this->user_id) {
            $this->load->model('Uploads_model');
            $this->Uploads_model->recropUpload($this->Media_model->file_config_gid, $media['id_owner'], $media['mediafile'], $recrop_data);
            $result['data']['thumbs'] = $media['media']['mediafile']['thumbs'];
            $result['data']['rand'] = rand(0, 999999);
            $result['msg'][] = l('image_update_success', 'media');
        } else {
            $result['status'] = 0;
            $result['errors'][] = 'access denied';
        }

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /media/getMediaCount Media count
    * @apiGroup Media
    * @apiParam {array} user_ids users ids
    */
    public function getMediaCount()
    {
        $user_ids = filter_input(INPUT_POST, 'user_ids', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
        $media_list = $this->Media_model->getMedia(1, 9999, null, [
            'where_in' => ['id_user' => $user_ids, 'status' => 1]
        ], null, false);
        $permissions = [];
        $data = [];
        foreach ($media_list as $media) {
            if (empty($permissions[$media['id_user']])) {
                $permissions[$media['id_user']] = $this->Media_model->getUserPermissions($media['id_user']);
            }
            if ($media['permissions'] >= $permissions[$media['id_user']]) {
                if (isset($data[$media['id_user']])) {
                    ++$data[$media['id_user']];
                } else {
                    $data[$media['id_user']] = 1;
                }
            }
        }
        $this->set_api_content('data', $data);
    }
    
    /**
    * @api {post} /media/getPhoto Get photo
    * @apiGroup Media
    * @apiParam {int} id photo id
    */
    public function getPhoto()
    {
        $photo_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $photo = $this->Media_model->getMediaById($photo_id);
        $this->set_api_content('data', $photo);
    }
    
    /**
     * Rotate upload
     *
     * @param integer        $upload_id upload identifier
     * @param integer/string $angle     rotate angle
     *
     * @return void
     */
    /**
    * @api {post} /media/rotate Rotate upload
    * @apiGroup Media
    * @apiParam {int} upload_id upload id
    * @apiParam {int} angle rotate angle
    */
    public function rotate($upload_id, $angle = 90)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        $media = $this->Media_model->get_media_by_id($upload_id);
        if ($angle < 0) {
            $angle += 360;
        } elseif ($angle != 'hor') {
            $angle = intval($angle);
        }

        if ($media && $media['id_owner'] == $this->user_id) {
            $this->load->model('Uploads_model');
            $this->Uploads_model->rotate_upload($this->Media_model->file_config_gid,
                $media['id_owner'],
                $media['mediafile'],
                $angle);
            $result['data']['img_url'] = $media['media']['mediafile']['file_url'];
            $result['data']['thumbs']  = $media['media']['mediafile']['thumbs'];
            $result['data']['rand']    = rand(0, 999999);
            $result['msg'][]           = l('image_update_success', 'media');
        } else {
            $result['status']   = 0;
            $result['errors'][] = 'access denied';
        }

        $this->set_api_content('data', $result);
    }
}
