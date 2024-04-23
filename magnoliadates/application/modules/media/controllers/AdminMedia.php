<?php

declare(strict_types=1);

namespace Pg\modules\media\controllers;

use Pg\libraries\View;

/**
 * Media admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: mchernov $
 * */
class AdminMedia extends \Controller
{
    /**
     * link to CodeIgniter object
     *
     * @var object
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'media_menu_item');
        $this->load->model("Media_model");
    }

    public function index($param = 'photo', $page = 1)
    {
        if ($param == 'album') {
            $this->albumsList($page);
        } elseif ($param == 'avatar') {
            $this->avatarList($page);
        } else {
            $this->mediaList($param, $page);
        }
    }

    public function userMedia($user_id = null, $param = 'photo', $page = 1)
    {
        if (!$user_id) {
            $url = site_url() . "admin/media/index/" . $param . "";
            redirect($url);
        }

        $where = [];
        switch ($param) {
            case 'photo':
                $where['where']['upload_gid'] = $this->Media_model->file_config_gid;
                break;
            case 'video':
                $where['where']['upload_gid'] = $this->Media_model->video_config_gid;
                break;
            case 'audio':
                $where['where']['upload_gid'] = $this->Media_model->audio_config_gid;
                break;
        }
        $where['where']['id_user'] = $user_id;

        $this->load->helper('sort_order');
        $items_on_page = $this->pg_module->get_module_config('media', 'items_per_page');
        $media_count = $this->Media_model->get_media_count($where);
        $page = get_exists_page_number($page, $media_count, $items_on_page);

        $order_by = ['date_add' => 'DESC'];
        $this->Media_model->format_user = true;
        $media = $this->Media_model->get_media($page, $items_on_page, $order_by, $where);
        $this->view->assign('media', $media);

        $this->load->helper("navigation");
        $page_data = get_admin_pages_data(site_url() . "admin/media/user_media/" . $user_id . '/' . $param . '/', $media_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);

        $this->view->assign('user_id', $user_id);
        $this->view->assign('param', $param);
        $this->load->model('Field_editor_model');
        $this->load->model('Users_model');
        $this->Field_editor_model->initialize($this->Users_model->form_editor_type);
        $sections = $this->Field_editor_model->get_section_list();
        $sections_gids = array_keys($sections);
        $this->view->assign('sections', $sections);

        $cur_set = $_SESSION["users_list"];
        $back_url = site_url() . "admin/users/index/{$cur_set["filter"]}/{$cur_set['user_type']}/{$cur_set["order"]}/{$cur_set["order_direction"]}/{$cur_set["page"]}";
        $this->view->assign('back_url', $back_url);

        $this->view->setHeader(l('admin_header_users_edit', 'users'));
        $this->view->render('user_media_list');
    }

    public function mediaList($param = 'photo', $page = 1)
    {
        $where = [];
        switch ($param) {
            case 'photo':
                $where['where']['upload_gid'] = $this->Media_model->file_config_gid;
                break;
            case 'video':
                $where['where']['upload_gid'] = $this->Media_model->video_config_gid;
                break;
            case 'audio':
                $where['where']['upload_gid'] = $this->Media_model->audio_config_gid;
                break;
        }

        $this->load->helper('sort_order');
        $items_on_page = $this->pg_module->get_module_config('media', 'items_per_page');
        $media_count = $this->Media_model->get_media_count($where);
        $page = get_exists_page_number($page, $media_count, $items_on_page);

        $order_by = ['date_add' => 'DESC'];
        $this->Media_model->format_user = true;
        $media = $this->Media_model->get_media($page, $items_on_page, $order_by, $where);
        $this->view->assign('media', $media);

        $this->load->helper("navigation");
        $page_data = get_admin_pages_data(site_url() . "admin/media/index/" . $param . '/', $media_count, $items_on_page, $page, 'briefPage');
        $this->view->assign('page_data', $page_data);

        $this->view->assign('param', $param . "/" . $page);

        $this->Menu_model->set_menu_active_item('media_menu_item', $param . '_list_item');
        $this->view->setHeader(l('admin_header_media_list', 'media'));
        $this->view->render('media_list');
    }

    public function albumsList($page)
    {
        $this->load->model('media/models/Albums_model');
        $this->load->model('media/models/Album_types_model');

        $params['where']['id_album_type'] = $this->Album_types_model->getTypeIdByGid('media_type');

        $this->load->helper('sort_order');
        $items_on_page = $this->pg_module->get_module_config('media', 'items_per_page');
        $albums_count = $this->Albums_model->get_albums_count();
        $page = get_exists_page_number($page, $albums_count, $items_on_page);

        $order_by = ['date_add' => 'DESC'];
        $this->Albums_model->format_user = true;
        $lang_id = $this->pg_language->current_lang_id;

        $albums = $this->Albums_model->get_albums_list($params, null, null, $page, $items_on_page, true, $lang_id);
        $this->view->assign('albums', $albums);

        $this->load->helper("navigation");
        $page_data = get_admin_pages_data(site_url() . 'admin/media/index/album/', $albums_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');

        $this->view->assign('page_data', $page_data);
        $this->Menu_model->set_menu_active_item('media_menu_item', 'album_list_item');
        $this->view->setHeader(l('admin_header_album_list', 'media'));
        $this->view->render('albums_list');
    }
    
    public function avatarList($page)
    {
        $items_on_page = $this->pg_module->get_module_config('media', 'items_per_page');
        $params = ['where' => [
            'user_logo !=' => ''
        ]];
        $count = $this->Users_model->getUsersCount($params);
        if ($count > 0) {
            $users = $this->Users_model->getUsersList($page, $items_on_page, ['id' => 'DESC'], $params);
            $this->view->assign('avatars', $users);
            //echo"<pre>";print_r($users);echo"</pre>";
            $this->load->helper("navigation");
            $page_data = get_admin_pages_data(site_url() . 'admin/media/index/avatar/', $count, $items_on_page, $page, 'briefPage');
            $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
            $this->view->assign('page_data', $page_data);
        }
        
        $this->Menu_model->set_menu_active_item('media_menu_item', 'avatar_list_item');
        $this->view->setHeader(l('admin_header_avatar_list', 'media'));
        $this->view->render('avatar_list');
    }

    public function ajaxViewMedia($id, $user_id, $param = 'all', $album_id = 0)
    {
        $gallery_name = filter_input(INPUT_POST, 'gallery_name', FILTER_SANITIZE_STRING) ?: 'mediagallery';
        $selections = [];
        $this->load->model('Uploads_model');
        $upload_config = $this->Uploads_model->get_config($this->Media_model->file_config_gid);
        foreach ($upload_config['thumbs'] as $thumb_config) {
            $selections[$thumb_config['prefix']] = [
                'width' => $thumb_config['width'],
                'height' => $thumb_config['height'],
            ];
        }
        $this->view->assign('user_type', $this->session->userdata("auth_type"));
        $this->view->assign('selections', $selections);
        $this->view->assign('gallery_name', $gallery_name);
        $this->view->assign('media_id', $id);
        $this->view->assign('param', $param);
        $this->view->assign('album_id', $album_id);
        $this->view->assign('rand', rand(0, 999999));
        $this->view->assign(['content' => $this->view->fetchFinal('view_media', 'user', 'media')]);
        $this->view->render();
    }

    public function ajaxViewAlbum($album_id = null)
    {
    }

    public function deleteMedia($media_id = null, $message = true)
    {
        if (!empty($media_id)) {
            $result = $this->Media_model->delete_media($media_id);
            if (!empty($result['errors']) && $message) {
                $this->system_messages->addMessage(View::MSG_ERROR, $result['errors']);
            } elseif ($message) {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_media', 'media'));
            }
        }
        if ($message) {
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            return;
        }
    }

    public function deleteAlbum($album_id = null)
    {
        if (!empty($album_id)) {
            $this->load->model('media/models/Albums_model');
            $this->Albums_model->delete_album($album_id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_album', 'media'));
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function ajaxGetMediaContent($media_id, $gallery_param = 'all', $album_id = 0)
    {
        $return           = ['content' => '', 'position_info' => '', 'media_type' => '',
            'views_num' => ''];
        $media_id         = intval($media_id);
        $album_id         = intval($album_id);
        $place            = trim(strip_tags($this->input->post('place', true)));
        $gallery_param    = trim(strip_tags($gallery_param));
        $without_position = intval($this->input->post('without_position'));

        $order     = trim(strip_tags($this->input->post('order')));
        $direction = trim(strip_tags($this->input->post('direction')));
        if (!$order) {
            $order = 'date_add';
        }
        $order_by[$order] = ($direction == 'asc') ? 'ASC' : 'DESC';
        $filter_duplicate = ($place == 'site_gallery') ? 1 : intval($this->input->post('filter_duplicate',
                    true));

        $media                            = $this->Media_model->get_media_by_id($media_id,
            true,
            true);
        $user_id                          = ($place == 'site_gallery') ? 0 : $media['id_user'];
        $is_user_media_owner              = false;
        $is_user_media_user               = true;
        $is_access_permitted              = $this->Media_model->is_access_permitted($media_id,
            $media);
        $date_formats['date_format']      = $this->pg_date->get_format('date_literal',
            'st');
        $date_formats['date_time_format'] = $this->pg_date->get_format('date_time_literal',
            'st');

       // if ($is_access_permitted) {
           // $this->Media_model->increment_media_views($media_id);
            $this->view->assign('media', $media);
            //$return['views_num'] = $media['views'] + 1;
        //}

        $this->view->assign('is_user_media_owner', $is_user_media_owner);
        $this->view->assign('is_user_media_user', $is_user_media_user);
        $this->view->assign('is_access_permitted', $is_access_permitted);
        $this->view->assign('date_formats', $date_formats);

        $aviary_post_data = [
            'type' => $media['type_id'],
            'id' => $media_id,
            'user_id' => $user_id,
        ];
        $this->view->assign('aviary_post_data', $aviary_post_data);

        $this->view->assign('user_id', $media['id_owner']);
        $this->view->assign('responder_id', $media['id_user']);

        $this->view->assign('user_type', $this->session->userdata("auth_type"));

        $rand_param = intval($this->input->post('rand_param'));
        if ($rand_param) {
            $this->view->assign('vers', '?' . $rand_param);
        }

        $return['content'] = $this->view->fetchFinal('media_content', 'user', 'media');

        if (!$without_position) {
            $return['position_info'] = $this->Media_model->get_media_position_info($media_id,
                $gallery_param,
                $album_id,
                $user_id,
                true,
                $order_by,
                $filter_duplicate);
        }

        $return['media_type'] = $media['upload_gid'];

        $this->view->assign($return);
        $this->view->render();
    }

    public function commonAlbums($page = 1)
    {
        $this->load->model('media/models/Albums_model');
        $this->load->model('media/models/Album_types_model');

        $where['where']['id_user'] = 0;
        $where['where']['id_album_type'] = $this->Album_types_model->getTypeIdByGid('media_type');

        $this->load->helper('sort_order');
        $items_on_page = $this->pg_module->get_module_config('media', 'items_per_page');
        $albums_count = $this->Albums_model->get_albums_count($where);
        $page = get_exists_page_number($page, $albums_count, $items_on_page);

        $order_by = ['date_add' => 'DESC'];
        $this->Albums_model->format_user = true;
        $lang_id = $this->pg_language->current_lang_id;
        $albums = $this->Albums_model->get_albums_list($where, null, null, $page, $items_on_page, true, $lang_id);
        $this->view->assign('albums', $albums);

        $this->load->helper("navigation");
        $page_data = get_admin_pages_data(site_url() . 'admin/media/common_albums/', $albums_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');

        $this->view->assign('page_data', $page_data);
        $this->Menu_model->set_menu_active_item('media_menu_item', 'common_albums_item');
        $this->view->setHeader(l('admin_header_common_albums', 'media'));
        $this->view->render('common_albums');
    }

    public function albumEdit($album_id = null)
    {
        $this->load->model('media/models/Albums_model');
        $errors = false;
        $data = [];

        if (!empty($album_id)) {
            $data = $this->Albums_model->get_album_by_id($album_id, $this->pg_language->current_lang_id, $this->pg_language->languages);
        }

        foreach ($this->pg_language->languages as $lang_id => $lang_data) {
            $validate_lang[$lang_id] = isset($data['lang_' . $lang_id]) ? $data['lang_' . $lang_id] : '';
        }

        if (!empty($validate_lang)) {
            $this->view->assign('validate_lang', $validate_lang);
        }

        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('languages_count', count($this->pg_language->languages));
        $this->view->assign('cur_lang', $this->pg_language->current_lang_id);

        if ($this->input->post('btn_save')) {
            $post_data = [
                "name"        => $this->input->post("name", true),
                "description" => $this->input->post("description", true),
            ];

            $langs = $this->input->post("langs", true);
            if ($post_data['name'] == '') {
                $post_data['name'] = $langs[$this->pg_language->current_lang_id];
            }

            foreach ($langs as $key => $value) {
                if ($value == '') {
                    $langs[$key] = $post_data['name'];
                }
            }

            $validate_data = $this->Albums_model->validate_album($post_data);
            $validate_data['data']["id_album_type"] = $this->Media_model->album_type_id;
            $validate_data['data']['id_user'] = 0;

            if (!empty($validate_data["errors"])) {
                $errors = $validate_data["errors"];
                $data = array_merge($data, $validate_data["data"]);
            } else {
                $this->Albums_model->save($album_id, $validate_data['data'], $langs);

                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_album_save', 'media'));
                redirect(site_url() . "admin/media/common_albums");
            }
        }

        $this->view->assign('data', $data);

        if (!empty($errors)) {
            $this->system_messages->addMessage(View::MSG_ERROR, $errors);
        }

        $this->Menu_model->set_menu_active_item('media_menu_item', 'common_albums_item');
        $this->view->setHeader(l('admin_common_album_edit', 'media'));
        $this->view->render('album_edit');
    }

    public function ajaxConfirmSelect()
    {
        return $this->view->render('ajax_delete_select_block');
    }

    public function ajaxDeleteMedia()
    {
        $media_id = $this->input->post("file_ids", true);
        if (!empty($media_id)) {
            foreach ($media_id as $object_id) {
                $this->deleteMedia($object_id, false);
            }
        }

        $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_media', 'media'));
    }

    public function markAdultMedia($file_id = null)
    {
        if (!empty($file_id)) {
            $this->Media_model->mark_adult($file_id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_mark_adult', 'media'));
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function unmarkAdultMedia($file_id = null)
    {
        if (!empty($file_id)) {
            $this->Media_model->unmark_adult($file_id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_unmark_adult', 'media'));
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function ajaxMarkAdultSelect()
    {
        $media_id = $this->input->post("file_ids", true);
        if (!empty($media_id)) {
            foreach ($media_id as $object_id) {
                $this->Media_model->mark_adult($object_id);
            }
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_mark_adult', 'media'));
        }
    }

    public function ajaxUnmarkAdultSelect()
    {
        $media_id = $this->input->post("file_ids", true);
        if (!empty($media_id)) {
            foreach ($media_id as $object_id) {
                $this->Media_model->unmark_adult($object_id);
            }
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_unmark_adult', 'media'));
        }
    }

    public function ajaxRecrop($upload_id)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        $recrop_data = [
            'x1' => $this->input->post('x1', true),
            'y1' => $this->input->post('y1', true),
            'width' => $this->input->post('width', true),
            'height' => $this->input->post('height', true)
        ];
        $media = $this->Media_model->getMediaById($upload_id);

        if ($media) {
            $this->load->model('Uploads_model');
            $this->Uploads_model->recropUpload($this->Media_model->file_config_gid,
                $media['id_owner'],
                $media['mediafile'],
                $recrop_data);
            $result['data']['img_url'] = $media['media']['mediafile']['thumbs'];
            $result['data']['rand'] = rand(0, 999999);
            $result['msg'][] = l('preview_update_success', 'media');
        } else {
            $result['status']   = 0;
            $result['errors'][] = 'no media';
        }

        $this->view->assign($result);
        $this->view->render();
    }

    public function ajaxRotate($upload_id, $angle = 90)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        $media = $this->Media_model->get_media_by_id($upload_id);
        if ($angle < 0) {
            $angle += 360;
        } elseif ($angle != 'hor') {
            $angle = intval($angle);
        }

        if ($media) {
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
            $result['errors'][] = 'no media';
        }

        $this->view->assign($result);
        $this->view->render();
    }
}
