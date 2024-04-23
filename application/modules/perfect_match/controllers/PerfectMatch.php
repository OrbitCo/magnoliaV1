<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\controllers;

use Pg\Libraries\View;

/**
 * Perfect_match module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PerfectMatch extends \Controller
{
    private $_user_id = 0;
    /**
     * Constructor
     *
     * @return Perfect_match
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perfect_match_model');
        if ('user' === $this->session->userdata('auth_type')) {
            $this->_user_id = intval($this->session->userdata('user_id'));
        }
    }

    /**
     * $order string
     * $order_direction string
     * $page number
     */
    public function index($order = "default", $order_direction = "DESC", $page = 1)
    {
        $this->search($order, $order_direction, $page);
    }

    /**
     * $order string
     * $order_direction string
     * $page number
     */
    public function search($order = "default", $order_direction = "DESC", $page = 1)
    {
        $this->load->model('Field_editor_model');
        $this->load->model('field_editor/models/Field_editor_forms_model');
        $this->Field_editor_model->initialize($this->Perfect_match_model->form_editor_type);
        $form = $this->Field_editor_forms_model->get_form_by_gid($this->Perfect_match_model->perfect_match_form_gid, $this->Perfect_match_model->form_editor_type);
        $fields_for_search = $this->Field_editor_model->get_fields_names_for_search($form);
        $this->Perfect_match_model->setAdditionalFields($fields_for_search);
        if (empty($_POST)) {
            if ($this->session->userdata("perfect_match_full")) {
                $current_settings = $this->session->userdata("perfect_match_full");
            } else {
                $perfect_match_params = $this->Perfect_match_model->getUserParams($this->_user_id);
                $current_settings = !empty($perfect_match_params['full_criteria']) ? $perfect_match_params['full_criteria'] : [];
            }
            $data = (!empty($current_settings)) ? $current_settings : [];
        } else {
            foreach ($_POST as $key => $val) {
                $post_data[$key] = $this->input->post($key, true);
            }
            foreach ($fields_for_search as $field) {
                if ($this->input->post($field) !== false) {
                    $post_data[$field] = $this->input->post($field, true);
                }
            }
            $validate_data = $this->Perfect_match_model->validate($post_data);

            $data = $validate_data['data'];
            if (empty($validate_data['errors'])) {
                $this->Perfect_match_model->saveParams($this->_user_id, $validate_data['data'], 'all');
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
            }
        }

        $this->Menu_model->breadcrumbs_set_parent('perfectmatch_item');
        $this->view->assign('block', $this->searchListBlock($data, $order, $order_direction, $page));

        $this->load->helper('perfect_match');
        $perfect_match_form = perfect_match_form(['view' => 'horizontal']);
        $this->view->assign('perfect_match_form', $perfect_match_form);

        $view_mode = (!empty($_SESSION['search_view_mode']) && $_SESSION['search_view_mode'] == 'list') ? 'list' : 'gallery';
        $this->view->assign('view_mode', $view_mode);
        $this->view->render('list');
    }

    /**
     * $order string
     * $order_direction string
     * $page number
     */
    public function ajaxSearch($s = '', $order = "default", $order_direction = "DESC", $page = 1)
    {
        $post_data = !empty($_POST) ? $_POST : [];
        if (empty($post_data)) {
            $current_settings = $this->session->userdata("perfect_match_full") ? $this->session->userdata("perfect_match_full") : [];
            $data = (!empty($current_settings)) ? $current_settings : [];
        } else {
            $this->load->model(['Users_model', 'Field_editor_model']);
            $this->Field_editor_model->initialize($this->Users_model->form_editor_type);

            $this->load->model('field_editor/models/Field_editor_forms_model');
            $form = $this->Field_editor_forms_model->get_form_by_gid($this->Users_model->advanced_search_form_gid, $this->Users_model->form_editor_type);
            $fields_for_search = $this->Field_editor_model->get_fields_names_for_search($form);
            foreach ($post_data as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }

            foreach ($fields_for_search as $field) {
                if ($this->input->post($field) !== false) {
                    $data[$field] = $this->input->post($field, true);
                }
            }

            $this->Perfect_match_model->setAdditionalFields($fields_for_search);
            $validate_data = $this->Perfect_match_model->validate($data, 'save');

            if (empty($validate_data['errors'])) {
                $this->Perfect_match_model->saveParams($this->_user_id, $validate_data['data'], 'all');
            }
        }

        echo $this->searchListBlock($data, $order, $order_direction, $page);
    }

    /**
     *
     */
    public function ajaxSearchCounts()
    {
        $result = ['count' => 0, 'error' => '', 'string' => ''];
        if (!empty($_POST)) {
            $this->load->model('Users_model');
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }
            $criteria = $this->getCriteria($data);
            $criteria["where"]["id_user !="] = $this->_user_id;
            $result["count"] = $this->Perfect_match_model->getUsersCount($criteria);
            $result["string"] = str_replace("[count]", $result["count"], l('user_results_string', 'users'));
        }
        $this->view->assign('count', $result["count"]);
        $this->view->assign('string', $result["string"]);
        $this->view->render();
    }

    /**
     * $data array
     * $order sort order string
     * $order_direction order direction string
     * $page integer page number
     *
     * @return search_list_block
     **/
    private function searchListBlock($data = [], $order = "default", $order_direction = "DESC", $page = 1)
    {
        $current_settings = $this->session->userdata("perfect_match_full") ?: [];
        if (!empty($data)) {
            $current_settings = $data;
        }

        $this->session->set_userdata("perfect_match_full", $current_settings);
        $criteria = $this->getCriteria($current_settings);

        $search_url = site_url() . "perfect_match/search";
        $url = site_url() . "perfect_match/search/" . $order . "/" . $order_direction . "/";

        $order = trim(strip_tags($order));
        if (!$order) {
            $order = "id_user";
        }

        $order_direction = strtoupper(trim(strip_tags($order_direction)));
        if ($order_direction != 'DESC') {
            $order_direction = "ASC";
        }

        $items_count = $this->Perfect_match_model->getUsersCount($criteria);

        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $items_count, $items_on_page);

        $sort_data = [
            "url"       => $search_url,
            "order"     => $order,
            "direction" => $order_direction,
            "links"     => [
                "default"     => l('field_default_sorter', 'users'),
                "name"        => l('field_name', 'users'),
                "views_count" => l('field_views_count', 'users'),
                "id_user"     => l('field_date_created', 'users'),
            ],
        ];

        $users = [];
        $use_leader = false;
        if ($items_count > 0) {
            $order_array = [];
            if ($order == 'default') {
                $order_array = [
                    'date_last_activity' => 'DESC'
                ];
                if (!empty($data['id_region']) && intval($data['id_region'])) {
                    $order_array['leader_bid'] = 'DESC';
                }
                if (!empty($criteria['fields']) && intval($criteria['fields'])) {
                    $order_array["fields"] = 'DESC';
                }
                $use_leader = true;
            } else {
                if ($order == 'name') {
                    if ($this->pg_module->get_module_config('users', 'hide_user_names')) {
                        $order_array['nickname'] = $order_direction;
                    } else {
                        $order_array['fname'] = $order_direction;
                        $order_array['sname'] = $order_direction;
                    }
                } else {
                    $order_array[$order] = $order_direction;
                }
            }
            $lang_id = $this->pg_language->current_lang_id;
            $users = $this->Perfect_match_model->getUsersList($page, $items_on_page, $order_array, $criteria, [], true, false, $lang_id);
            $this->view->assign('users', $users);
            $this->view->assign('users_count', $items_count);
        }
        
        $user_ids = [];
        if (!empty($users)) {
            foreach ($users as $s_user) {
                if (isset($s_user['id'])) {
                    $user_ids[] = $s_user['id'];
                }
            }
        }
        
        \Pg\modules\users\models\UsersSearchIdsModel::updateUsersIdsEvent($user_ids);

        $this->load->helper("navigation");
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_literal', 'st');
        $page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $page_data["use_leader"] = $use_leader;
        $page_data["view_type"] = isset($_SESSION['search_view_mode']) ? $_SESSION['search_view_mode'] : 'gallery';
        $page_data["type"]       = 'scroll';
        $use_save_search = ($this->session->userdata("auth_type") == "user") ? true : false;

        $this->view->assign('search_type', "perfect_match");
        $this->view->assign('user_id', $this->_user_id);
        $this->view->assign('order', $order);
        $this->view->assign('order_direction', $order_direction);
        $this->view->assign('sort_data', $sort_data);
        $this->view->assign('page_data', $page_data);
        $this->view->assign('use_save_search', $use_save_search);

        return $this->view->fetch('users_list_block', 'user', 'users');
    }
    
    public function ajaxLoadUsers($order = 'date_last_activity')
    {
        $page = filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT);
        $hide_dir = filter_input(INPUT_POST, 'hide_dir', FILTER_SANITIZE_STRING);
        $data = $this->session->userdata("perfect_match_full") ?: [];
        $this->view->assign('hide_dir', $hide_dir);
        $result['content'] = $this->searchListBlock($data, $order, 'DESC', $page);
        $this->view->assign($result);
        $this->view->render();
    }

    /**
     *
     */
    private function getCriteria($data)
    {
        $this->load->model('field_editor/models/Field_editor_forms_model');
        $fe_criteria = $this->Field_editor_forms_model->getSearchCriteria($this->Perfect_match_model->perfect_match_form_gid, $data, $this->Perfect_match_model->form_editor_type, false);
        $common_criteria = $this->Perfect_match_model->getCommonCriteria($data);
        $criteria = array_merge_recursive($fe_criteria, $common_criteria);

        return $criteria;
    }

    /**
     *
     */
    public function setViewMode($view_mode)
    {
        if (in_array($view_mode, ['list', 'gallery'])) {
            $_SESSION['search_view_mode'] = $view_mode;
        }
    }
}
