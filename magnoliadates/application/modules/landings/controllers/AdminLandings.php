<?php

declare(strict_types=1);

namespace Pg\modules\landings\controllers;

use Pg\Libraries\View;
use Pg\modules\landings\models\LandingsModel;

/* *
 * Landings admin side controller
 * @package     PG_Dating
 * @subpackage  application
 * @category	modules
 * @copyright 	Copyright (c) 2000-2015 PG_Dating - php dating software
 * @author 		Pilot Group Ltd <http://www.pilotgroup.net/>
 * */

class AdminLandings extends \Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Landings_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'add_ons_items');
    }

    public function index($order = 'name', $order_direction = 'ASC', $page = 1)
    {
        $landings_settings = isset($_SESSION['landings']) ? $_SESSION['landings'] : [];

        if (!isset($landings_settings['order'])) {
            $landings_settings['order'] = 'date_created';
        }
        if (!isset($landings_settings['order_direction'])) {
            $landings_settings['order_direction'] = 'DESC';
        }
        if (!isset($landings_settings['page'])) {
            $landings_settings['page'] = 1;
        }

        $order = strval($order);
        $order_direction = strval($order_direction);
        $sort_links = [
            'name' => site_url() . 'admin/landings/index/name/' . (($order != 'name' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'link' => site_url() . 'admin/landings/index/link/' . (($order != 'link' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'date_created' => site_url() . 'admin/landings/index/date_created/' . (($order != 'date_created' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'status' => site_url() . 'admin/landings/index/status/' . (($order != 'status' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'default' => site_url() . 'admin/landings/index/status/' . (($order != 'status' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];
        $this->view->assign('sort_links', $sort_links);

        switch ($order) {
            case 'date_created':
                $order_array = ['id' => $order_direction];
                break;
            default:
                $order_array = [$order => $order_direction];
                break;
        }
        $page = intval($page);

        $this->load->helper('sort_order');
        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');

        if (!$order) {
            $order = $landings_settings['order'];
        }
        $this->view->assign('order', $order);
        $landings_settings['order'] = $order;

        if (!$order_direction) {
            $order_direction = $landings_settings['order_direction'];
        }

        $this->view->assign('order_direction', $order_direction);
        $landings_settings['order_direction'] = $order_direction;
        $landings_settings['page'] = $page;
        $_SESSION['landings'] = $landings_settings;

        $items_count = $this->Landings_model->getLandingsCount();
        $page = get_exists_page_number($page, $items_count, $items_on_page);

        if ($items_count > 0) {
            $landings = $this->Landings_model->getLandingsList($page, $items_on_page, $order_array);
            $this->view->assign('landings', $landings);
        }

        $this->load->helper('navigation');
        $page_data = get_admin_pages_data(site_url() . 'admin/landings/index/' . $order . '/' . $order_direction . '/',
                                          $items_count,
            $items_on_page,
            $page,
            'briefPage');
        $this->view->assign('page_data', $page_data);

        $this->load->library('pg_date');
        $date_format = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('date_format', $date_format);

        $this->view->setHeader(l('admin_header_landings_list', 'landings'));
        $this->view->render('list');
    }

    public function edit($landing_id = null)
    {
        $landings_settings = isset($_SESSION['landings']) ? $_SESSION['landings'] : [];
        $errors = false;
        $land_index = null;
        $upload_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . 'landings/';

        if ($landing_id) {
            $landing = $this->Landings_model->getLandingById($landing_id);
            $land_index = $upload_path . $landing_id . '/' . $landing['index_path'];
            if (file_exists($land_index)) {
                $landing['upload_file'] = true;
            }
        } else {
            $landing = [];
        }

        if ($this->input->post('btn_save', true)) {
            $post_data['id'] = $landing_id;
            $post_data['gid'] = $this->input->post('landing_gid');
            $post_data['name'] = $this->input->post('landing_name');
            $parse_url = parse_url($this->input->post('landing_link'));
            $post_data['link'] = str_replace(SITE_SUBFOLDER, '', $parse_url['path']);
            $post_data['is_active'] = $this->input->post('landing_is_active');
            $post_data['url_page'] = $this->input->post('landing_page_url');
            $post_data['upload_delete'] = $this->input->post('landing_upload_delete');
            $post_data['is_default_land'] = $this->input->post('landing_is_default');
            

            $validate_data = $this->Landings_model->validate($landing_id, $post_data);

            if (isset($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
            } else {
                $save_data = $validate_data["data"];
                $landing_id = $this->Landings_model->saveLanding($landing_id, $save_data);

                if (!$save_data['url_page']) {
                    $upload_data = $this->Landings_model->uploadLandingArchive($landing_id);
                    if ($upload_data) {
                        if (isset($upload_data["errors"])) {
                            $errors = true;
                            if (!isset($landing['upload_file'])) {
                                $landing_path = $upload_path . $landing_id;
                                $this->Landings_model->removeDirectoryRecursive($landing_path);
                            }
                            $this->system_messages->addMessage(View::MSG_ERROR, $upload_data["errors"]);
                        } else {
                            $this->Landings_model->saveLanding($landing_id, ['index_path' => $upload_data['data']['file']]);
                        }
                    }
                }

                if (!$errors) {
                    $message = ($landing_id) ? l('success_landing_edit', 'landings') : l('success_add_landing', 'landings');
                    $this->system_messages->addMessage(View::MSG_SUCCESS, $message);
                }

                $landing_after = $this->Landings_model->getLandingById($landing_id);
               
                if ($landing_after) {
                    $land_index = $upload_path . $landing_id . '/' . $landing_after['index_path'];
                    if (!file_exists($land_index) && !$landing_after['url_page'] && $landing_after['is_active']) {
                        $this->Landings_model->saveLanding($landing_id, ['is_active' => 0]);
                    }
                }

                $url = site_url() . 'admin/landings/edit/' . $landing_id;
                redirect($url);
            }

            $landing = array_merge($landing, $post_data);
        }

        $landings_manager_text = l('landings_manager_text', 'landings');

        $this->view->assign('landing', $landing);

        if (!empty($landing['id'])) {
            $this->view->setHeader(l('admin_header_landing_edit', 'landings'));
            $landings_manager_text = str_replace('[directory]', $upload_path . $landing_id, $landings_manager_text);
        } elseif ($landing_id == null) {
            $this->view->setHeader(l('admin_header_landing_add', 'landings'));
            $landings_manager_text = str_replace('[directory]', $upload_path . 'id', $landings_manager_text);
        }
        
        $this->view->assign('land_index', $land_index);
        $this->view->setBackLink(site_url('admin/landings'));
        $this->view->assign('landings_manager_text', $landings_manager_text);
        $this->view->assign('landings_settings', $landings_settings);
        $this->view->render('edit');
    }

    public function delete($landing_id = null)
    {
        if (!is_null($landing_id)) {
            $this->Landings_model->deleteLanding($landing_id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_landing_delete', 'landings'));
        }
        $landings_settings = isset($_SESSION['landings']) ? $_SESSION['landings'] : [];

        if (!isset($landings_settings['order'])) {
            $landings_settings['order'] = 'date_created';
        }
        if (!isset($landings_settings['order_direction'])) {
            $landings_settings['order_direction'] = 'DESC';
        }
        if (!isset($landings_settings['page'])) {
            $landings_settings['page'] = 1;
        }

        $url = site_url() . 'admin/landings/index/' . $landings_settings['order'] . '/' . $landings_settings['order_direction'] . '/' . $landings_settings['page'];
        redirect($url);
    }

    public function ajaxDeleteSelect()
    {
        $response = ['status' => 'error', 'message' => l('error_landings_delete', 'landings')];

        $landings_data = $this->input->post('landings_ids', true);

        if ($landings_data != []) {
            foreach ($landings_data as $value) {
                $this->Landings_model->deleteLanding($value);
            }

            $response['status'] = 'success';
            $response['message'] = l('success_landings_delete', 'landings');
        }

        $this->view->assign($response);
        $this->view->render();
    }

    public function activate($landing_id, $status = 0)
    {
        if (!empty($landing_id)) {
            $this->Landings_model->activateLanding($landing_id, $status);
            if ($status == 1) {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_activate_landing', 'landings'));
            } else {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_deactivate_landing', 'landings'));
            }
        }

        $landings_settings = isset($_SESSION['landings']) ? $_SESSION['landings'] : [];

        if (!isset($landings_settings['order'])) {
            $landings_settings['order'] = 'date_created';
        }
        if (!isset($landings_settings['order_direction'])) {
            $landings_settings['order_direction'] = 'DESC';
        }
        if (!isset($landings_settings['page'])) {
            $landings_settings['page'] = 1;
        }

        $url = site_url() . 'admin/landings/index/' . $landings_settings['order'] . '/' . $landings_settings['order_direction'] . '/' . $landings_settings['page'];
        redirect($url);
    }
}
