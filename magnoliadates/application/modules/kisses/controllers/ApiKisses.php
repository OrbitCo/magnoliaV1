<?php

declare(strict_types=1);
namespace Pg\modules\kisses\controllers;

/**
 * Mobile version API controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiKisses extends \Controller
{
    
    /**
     * Constructor
     *
     * @return Api_Mobile
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kisses_model');
        $this->load->model('Uploads_model');
    }

    /**
    * @api {post} /kisses/getKisses Get kisses
    * @apiGroup Kisses
    */
    public function getKisses($user_id = null)
    {
        if (is_null($user_id)) {
            return [];
        }
        
        $kisses = $this->Kisses_model->get_list(1, 0); // 0 - unlimited
        
        $this->set_api_content('data', ['kisses' => $kisses]);
    }

    /**
    * @api {post} /kisses/setKisses Set kisses
    * @apiGroup Kisses
    * @apiParam {int} kiss kiss id
    * @apiParam {int} object_id object id
    * @apiParam {string} [message] message
    */
    public function setKisses()
    {
        $return = [];

        $post_data['id'] = $this->input->post("kiss", true);
        $post_data['object_id'] = $this->input->post("object_id", true);
        $post_data['message'] = trim(strip_tags($this->input->post("message", true)));

        $validate_data = $this->Kisses_model->validate_kisses($post_data['id'], $post_data);

        if (empty($validate_data['errors'])) {
            $user_id = $this->session->userdata("user_id");
            $image_upload_config = $this->Uploads_model->get_config($this->Kisses_model->image_upload_gid);

            $file_path = $this->Uploads_model->format_upload($image_upload_config['gid'], '', $validate_data['data']['kisses']['image']);

            $return = $this->Uploads_model->upload_exist($this->Kisses_model->image_upload_gid, $user_id, $file_path['file_path']);

            if (empty($return['error']) && !empty($return['file'])) {
                $data['image'] = $return['file'];
                $data['user_to'] = $validate_data['data']['object_id'];
                $data['user_from'] = $user_id;
                if (!empty($validate_data['data']['message'])) {
                    $data['message'] = $validate_data['data']['message'];
                }
                $return['save'] = $this->Kisses_model->save_user_kisses($data);
                if ($return['save']) {
                    // TODO: send kiss
                    $this->load->library('Analytics');
                    $this->analytics->track('kisses_send_kiss', ['controller' => 'api_kisses', 'sender' => $data['user_from'], 'recipient' => $data['user_to']]);
                    
                    $return['message'] = l('success_send_kiss', 'kisses');
                } else {
                    $return['message'] = l('error_send_kiss', 'kisses');
                }
            }
        } else {
            $return['message'] = implode('. ', $validate_data['errors']);
        }
        
        $this->set_api_content('message', $return['message']);
    }

    /**
    * @api {post} /kisses/index Kisses page
    * @apiGroup Kisses
    * @apiParam {int} [page] page count
    * @apiParam {string} [folder] inbox/outbox
    */
    public function index($folder, $page = 1)
    {
        $user_id = $this->session->userdata('user_id');
        $user_key_id = 'user_from';
        $params = [];
        $kisses_ids = [];
        switch ($folder) {
            case 'inbox':
                    $params['where']['user_to'] = $user_id;
                    $user_key_id = 'user_from';
                break;
            case 'outbox':
                    $params['where']['user_from'] = $user_id;
                    $user_key_id = 'user_to';
                break;
        }
        $kiss_count = $this->Kisses_model->getCountKissesUsers($params);
        if ($kiss_count > 0) {
            if (!$this->pg_module->get_module_config('kisses', 'system_settings_page')) {
                $items_on_page = $this->pg_module->get_module_config('kisses', 'items_per_page');
            } else {
                $items_on_page = $this->pg_module->get_module_config('start', 'index_items_per_page');
            }

            $kisses = $this->Kisses_model->getListUserKisses($params, $page, $items_on_page, ['date_created' => 'DESC']);
            switch ($folder) {
                case 'inbox':
                        $users_ids = array_column($kisses, 'user_from');
                    break;
                case 'outbox':
                        $users_ids = array_column($kisses, 'user_to');
                    break;
            }
            $users = $this->Users_model->getUsersListByKey($page, $items_on_page, null, null, $users_ids);
            foreach ($kisses as $key => $kiss) {
                $kisses[$key]['output_name'] = $users[$kiss[$user_key_id]]["output_name"];
                $kisses[$key]["image"] = "kisses-" . $kiss["image"];
                $kisses[$key]["user_logo"] = $users[$kiss[$user_key_id]]['media']["user_logo"]['thumbs'];
                $kisses[$key]['images'] = $this->Uploads_model->formatUpload($this->Kisses_model->image_upload_gid, $kiss['user_from'], $kiss['image']);
                if ($kiss['mark'] != 1 && $folder == 'inbox') {
                    $kisses_ids = $kiss['id'];
                }
            }
            if (!empty($kisses_ids)) {
                $this->Kisses_model->markAsRead($kisses_ids);
            }

            $data = [
                'list' => $kisses,
                'items_on_page' => $items_on_page
            ];
        }
        $data['count'] = $kiss_count;
        $this->set_api_content('data', $data);
    }
}
