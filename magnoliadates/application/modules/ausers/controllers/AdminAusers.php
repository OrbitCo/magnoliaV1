<?php

declare(strict_types=1);

namespace Pg\modules\ausers\controllers;

/**
 * Ausers module
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

use Pg\Libraries\View;

/**
 * Administrators admin side controller
 *
 * @package     PG_Core
 * @subpackage  Ausers
 * @category    controllers
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AdminAusers extends \Controller
{
    /**
     * Constructor
     *
     * @return Admin_Ausers
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Ausers_model', 'Menu_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'ausers_item');
    }

    /**
     * Get admninistrators list
     *
     * @param string  $filter          filter data
     * @param string  $order           sorting data
     * @param string  $order_direction sorting direction
     * @param integer $page            page of results
     *
     * @return void
     */
    public function index($filter = null, $order = null, $order_direction = null, $page = null)
    {
        $is_add_available = $this->pg_module->get_module_config('ausers', 'is_add_available');
        if (!$is_add_available) {
            $this->edit(1);

            return;
        }

        $current_settings = isset($_SESSION["ausers_list"]) ? $_SESSION["ausers_list"] : [];
        if (!isset($current_settings["filter"])) {
            $current_settings["filter"] = "all";
        }
        if (!isset($current_settings["order"])) {
            $current_settings["order"] = "nickname";
        }
        if (!isset($current_settings["order_direction"])) {
            $current_settings["order_direction"] = "ASC";
        }
        if (!isset($current_settings["page"])) {
            $current_settings["page"] = 1;
        }

        $filter_data = [
            "all" => $this->Ausers_model->getUsersCount(),
            "not_active" => $this->Ausers_model->getUsersCount(["where" => ["status"    => 0]]),
            "active"     => $this->Ausers_model->getUsersCount(["where" => ["status"    => 1]]),
            "admin"      => $this->Ausers_model->getUsersCount(["where" => ["user_type" => 'admin']]),
            "moderator"  => $this->Ausers_model->getUsersCount(["where" => ["user_type" => 'moderator']]),
        ];
        $active_count = $this->Ausers_model->getUsersCount(['where' => ['status' => 1]]);
        $attrs = [];
        switch ($filter) {
            case 'active':
                $attrs["where"]['status'] = 1;

                break;
            case 'not_active':
                $attrs["where"]['status'] = 0;

                break;
            case 'admin':
                $attrs["where"]['user_type'] = 'admin';

                break;
            case 'moderator':
                $attrs["where"]['user_type'] = 'moderator';

                break;
            case 'all':
                break;
            default:
                $filter = $current_settings["filter"];
        }

        $current_settings["filter"] = $filter;

        $this->view->assign('filter', $filter);
        $this->view->assign('filter_data', $filter_data);
        $current_settings["page"] = $page;

        if (!$order) {
            $order = $current_settings["order"];
        }
        $this->view->assign('order', $order);
        $current_settings["order"] = $order;

        if (!$order_direction) {
            $order_direction = $current_settings["order_direction"];
        }
        $this->view->assign('order_direction', $order_direction);
        $current_settings["order_direction"] = $order_direction;

        $users_count = $filter_data[$filter];

        if (!$page) {
            $page = $current_settings["page"];
        }
        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $users_count, $items_on_page);
        $current_settings["page"] = $page;

        $_SESSION["ausers_list"] = $current_settings;

        $sort_links = [
            "name"         => site_url() . "admin/ausers/index/" . $filter . "/name/" . (($order != 'name' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            "nickname"     => site_url() . "admin/ausers/index/" . $filter . "/nickname/" . (($order != 'nickname' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            "email"        => site_url() . "admin/ausers/index/" . $filter . "/email/" . (($order != 'email' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            "date_created" => site_url() . "admin/ausers/index/" . $filter . "/date_created/" . (($order != 'date_created' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];

        $this->view->assign('sort_links', $sort_links);

        if ($users_count > 0) {
            $users = $this->Ausers_model->get_users_list($page, $items_on_page, [$order => $order_direction], $attrs);
            $this->view->assign('users', $users);
            $this->view->assign('users_count', $users_count);
            $this->view->assign('active_count', $active_count);
        }
        $this->load->helper("navigation");
        $url = site_url() . "admin/ausers/index/" . $filter . "/" . $order . "/" . $order_direction . "/";
        $page_data = get_admin_pages_data($url, $users_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);

        $this->view->setHeader(l('admin_header_ausers_list', 'ausers'));
        $this->view->render('list');
    }

    /**
     * Edit administrator data
     *
     * @param integer $user_id administrator identifier
     *
     * @return void
     */
    public function edit($user_id = null)
    {
        $is_add_available = $this->pg_module->get_module_config('ausers', 'is_add_available');

        if ($user_id) {
            $data = $this->Ausers_model->get_user_by_id($user_id);
        } else {
            $data["lang_id"] = $this->pg_language->current_lang_id;
        }

        if ($this->input->post('btn_save')) {
            $post_data = [
                "name"            => $this->input->post('name', true),
                "nickname"        => $this->input->post('nickname', true),
                "password"        => $this->input->post('password', true),
                "repassword"      => $this->input->post('repassword', true),
                "update_password" => intval($this->input->post('update_password')),
                "email"           => $this->input->post('email', true),
                "description"     => $this->input->post('description', true),
                "user_type"       => $this->input->post('user_type', true),
                "permission_data" => $this->input->post('permission_data', true),
                "lang_id"         => intval($this->input->post('lang_id')),
            ];
            $validate_data = $this->Ausers_model->validateUser($user_id, $post_data);
            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                $validate_data["data"]['permission_data'] = unserialize($validate_data["data"]['permission_data']);
                $data = array_merge($data, $validate_data["data"]);
            } else {
                $data = $validate_data["data"];

                $new_user_id = $this->Ausers_model->save_user($user_id, $data, $post_data['password']);

                if ($user_id) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_user', 'ausers'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_user', 'ausers'));
                }

                $current_settings = $_SESSION["ausers_list"];

                if (!$is_add_available) {
                    $url = site_url() . "admin/ausers/index";
                } else {
                    $url = site_url() . "admin/ausers/edit/" . $new_user_id;
                }
                redirect($url);
            }
        }

        $this->view->assign('is_add_available', $is_add_available);

        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('data', $data);

        $this->view->setHeader(l('admin_header_ausers_edit', 'ausers'));
        $this->view->render('edit_form');
    }

    /**
     * Remove administrator
     *
     * @param integer $user_id administrator identifier
     *
     * @return void
     */
    public function delete($user_id)
    {
        if (!empty($user_id)) {
            if ($_ENV['DEMO_MODE']) {
                if ($user_id == 1) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('error_demo_mode', 'start'));
                    $this->view->setRedirect(site_url() . "admin/ausers/index");
                }
            }
            $params = [
                'where' => ['user_type' => $this->Ausers_model->user_type],
            ];
            $user_count = $this->Ausers_model->get_users_count($params);
            if ($user_count > 1) {
                $this->Ausers_model->delete_user($user_id);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_user', 'ausers'));
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_delete_user', 'ausers'));
            }
        }
        $this->view->setRedirect(site_url() . "admin/ausers/index");
    }

    /**
     * Activate/de-activate administrator
     *
     * @param integer $user_id administrator identifier
     * @param integer $status  administrator status
     *
     * @return void
     */
    public function activate($user_id, $status = 0)
    {
        if (!empty($user_id)) {
            if ($_ENV['DEMO_MODE']) {
                if ($user_id == 1) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('error_demo_mode', 'start'));
                    $this->view->setRedirect(site_url() . "admin/ausers/index");
                }
            }
            if (!$status) {
                $active_count = $this->Ausers_model->getUsersCount(['where' => ['status' => 1]]);
                if ($active_count < 2) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('error_deactivate_user', 'ausers'));
                    $this->view->setRedirect(site_url() . "admin/ausers/index");
                }
            }

            $this->Ausers_model->activate_user($user_id, $status);
            if ($status) {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_activate_user', 'ausers'));
            } else {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_deactivate_user', 'ausers'));
            }
        }
        $this->view->setRedirect(site_url() . "admin/ausers/index");
    }

    /**
     * Log in to account
     *
     * @return void
     */
    public function login()
    {
        if ($this->session->userdata("auth_type") == 'admin') {
            redirect(site_url() . "admin/ausers/index");
        }

        $data["action"] = site_url() . "admin/ausers/login";

        $is_simple_login = false;

        if (defined('ANALYTIC_DEMO_VERSION')) {
            if ((int) ANALYTIC_DEMO_VERSION == 77) {
                $is_simple_login = true;
            }
        }

        if ($this->input->post('btn_login') || $is_simple_login) {
            $data["nickname"] = $nickname = trim(strip_tags($this->input->post('nickname', true)));
            $password = trim(strip_tags($this->input->post('password', true)));

            if ($is_simple_login) {
                $data["nickname"] = $nickname = 'admin';
                $password = 'admin1';
            }

            $user_data = $this->Ausers_model->getUserByLoginPassword($nickname, $password);

            if (empty($user_data) || !$user_data["status"]) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_login_password_incorrect', 'ausers'));
            } else {
                $user_data["permission_data"]["start"] = [
                    'index' => 1,
                    'menu'  => 1,
                    'error' => 1,
                ];
                $session = [
                    "auth_type"       => 'admin',
                    "user_id"         => $user_data["id"],
                    "name"            => $user_data["name"],
                    "nickname"        => $user_data["nickname"],
                    "email"           => $user_data["email"],
                    "user_type"       => $user_data["user_type"],
                    "permission_data" => $user_data["permission_data"],
                ];
                $this->session->set_userdata($session);
                $this->view->setRedirect(site_url() . "admin/start");
            }
        }

        $this->view->assign("data", $data);

        $this->view->assign('product_name', PRODUCT_NAME);
        $this->view->setHeader(l('admin_header_login', 'ausers'));
        $this->view->assign('login_page', 1);
        $this->view->assign('hide_page_header', 1);
        $this->view->render('login_form');
    }

    /**
     * Log off from account
     *
     * @return void
     */
    public function logoff()
    {
        $this->session->sess_destroy();
        $this->view->setRedirect();
    }
}
