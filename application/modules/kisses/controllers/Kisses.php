<?php

declare(strict_types=1);

namespace Pg\modules\kisses\controllers;

use Pg\modules\blacklist\models\BlacklistModel;

/**
 * Kisses admin side controller
 *
 * @package PG_DatingPro
 * @subpackage Kisses
 * @category    controllers
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Kisses extends \Controller
{
    private $user_id;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kisses_model', 'Menu_model', 'Uploads_model', 'Users_model']);
        if ('user' === $this->session->userdata('auth_type')) {
            $this->user_id = (int) $this->session->userdata('user_id');
        }
    }

    /**
     * Return page with list kisses
     *
     * @param string $folder type page
     * @param integer $page   number page
     *
     * @return void
     */
    private function view(string $folder, int $page = 1): void
    {
        $user_key_id = 'user_from';
        $params = [];
        $kisses_ids = [];

        $blocked_ids = (new BlacklistModel())->getBlockedIds($this->user_id);
        dump($blocked_ids);
        switch ($folder) {
            case 'inbox':
                    $params['where']['user_to'] = $this->user_id;
                    $user_key_id = 'user_from';

                break;
            case 'outbox':
                    $params['where']['user_from'] = $this->user_id;
                    $user_key_id = 'user_to';

                break;
        }
        $kisses_count = $this->Kisses_model->getCountKissesUsers($params);

        if (!$this->pg_module->get_module_config('kisses', 'system_settings_page')) {
            $items_on_page = $this->pg_module->get_module_config('kisses', 'items_per_page');
        } else {
            $items_on_page = $this->pg_module->get_module_config('start', 'index_items_per_page');
        }

        if ($kisses_count > 0) {
            $kisses = $this->Kisses_model->getListUserKisses($params, $page, $items_on_page, ['date_created' => 'DESC']);
            switch ($folder) {
                case 'inbox':
                        $users_ids = array_column($kisses, 'user_from');

                    break;
                case 'outbox':
                        $users_ids = array_column($kisses, 'user_to');

                    break;
            }

            $users = $this->Users_model->getUsersListByKey(null, null, null, null, array_unique($users_ids));

            foreach ($kisses as $key => $kiss) {
                $kisses[$key]['output_name'] = $users[$kiss[$user_key_id]]["output_name"];
                $kisses[$key]["image"] = "kisses-" . $kiss["image"];
                $kisses[$key]["user_logo"] = $users[$kiss[$user_key_id]]['media']["user_logo"]['thumbs'];
                $kisses[$key]['images'] = $this->Uploads_model->formatUpload($this->Kisses_model->image_upload_gid, $kiss['user_from'], $kiss['image']);
                if ($kiss['mark'] != 1 && $folder == 'inbox') {
                    $kisses_ids[] = $kiss['id'];
                }
            }
            if (!empty($kisses_ids)) {
                $this->Kisses_model->markAsRead($kisses_ids);
            }

            $this->view->assign('kisses', $kisses);
        }

        $this->load->helper("navigation");
        $url = site_url() . 'kisses/' . $folder . '/';
        $page_data = get_user_pages_data($url, $kisses_count, $items_on_page, $page, 'briefPage');
        $this->config->load('date_formats', true);
        $page_data["date_format"] = $this->pg_date->get_format('date_literal', 'st');

        /// breadcrumbs
        $this->Menu_model->breadcrumbsSetParent('kisses_item');
        $this->Menu_model->breadcrumbsSetActive(l($folder, 'kisses'));

        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('page_data', $page_data);
        $this->view->assign('kiss_section', $folder);
        $this->view->render('index');
    }

    public function index()
    {
        $this->inbox();
    }
    public function inbox($page = 1)
    {
        $this->view('inbox', $page);
    }
    public function outbox($page = 1)
    {
        $this->view('outbox', $page);
    }

    /**
     * Return list kisses
     *
     * @return string
     */
    public function ajaxGetKisses($object_id = null)
    {
        if (empty($object_id)) {
            $result['errors'][] = l('error_invalid_user_to', 'kisses');
        } elseif ((new BlacklistModel())->isBlocked($object_id, $this->user_id)) {
            $result['errors'][] = l('you_in_blacklist', 'blacklist');
        }

        if (empty($result['errors'])) {
            $kisses = $this->Kisses_model->getList(1, 0); // 0 - unlimited
            if (!empty($kisses)) {
                $image_upload_config = $this->Uploads_model->get_config($this->Kisses_model->image_upload_gid);
                $mediafile = [];
                $file_url = '';
                foreach ($kisses as $media) {
                    $mediafile[0] = $this->Uploads_model->format_upload($image_upload_config['gid'], '', $media['image']);
                    $file_url = $mediafile[0]['url'] . "kisses-";

                    break;
                }
                $maxlength = $this->pg_module->get_module_config('kisses', 'number_max_symbols');
                $this->view->assign('maxlength', $maxlength);
                $this->view->assign('lang_id', $this->session->userdata('lang_id'));
                $this->view->assign('kisses', $kisses);
                $this->view->assign('file_url', $file_url);
                $this->view->assign('object_id', $object_id);
                $result['html'] = $this->view->fetch('list_kisses');
            } else {
                $result['errors'][] = l('no_kisses', 'kisses');
            }
        }
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Save cheked kiss
     *
     * @echo json array
     */
    public function ajaxSetKisses()
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
                    $return['success'] = l('success_send_kiss', 'kisses');
                } else {
                    $return['error'] = l('error_send_kiss', 'kisses');
                }
            }
        } else {
            $return['error'] = implode('<br>', $validate_data['errors']);
        }

        $this->view->assign($return);
        $this->view->render();
    }
}
