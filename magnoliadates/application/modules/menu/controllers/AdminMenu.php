<?php

declare(strict_types=1);

namespace Pg\modules\menu\controllers;
 
use Pg\Libraries\View;

/**
 * Menu admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class AdminMenu extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Menu_model");
        $this->Menu_model->setMenuActiveItem('admin_menu', 'interface-items');
    }

    public function index($order = "name", $order_direction = "ASC", $page = 1)
    {
        $attrs = [];
        $current_settings = isset($_SESSION["menu_list"]) ? $_SESSION["menu_list"] : [];
        if (!isset($current_settings["order"])) {
            $current_settings["order"] = "nickname";
        }
        if (!isset($current_settings["order_direction"])) {
            $current_settings["order_direction"] = "ASC";
        }
        if (!isset($current_settings["page"])) {
            $current_settings["page"] = 1;
        }

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

        $menu_count = $this->Menu_model->get_menus_count();

        if (!$page) {
            $page = $current_settings["page"];
        }
        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $menu_count, $items_on_page);
        $current_settings["page"] = $page;

        $_SESSION["menu_list"] = $current_settings;

        $sort_links = [
            "name"         => site_url() . "admin/menu/index/name/" . (($order != 'name' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            "gid"          => site_url() . "admin/menu/index/gid/" . (($order != 'gid' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            "date_created" => site_url() . "admin/menu/index/date_created/" . (($order != 'date_created' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];

        $this->view->assign('sort_links', $sort_links);

        if ($menu_count > 0) {
            $menus = $this->Menu_model->get_menus_list($page, $items_on_page, [$order => $order_direction]);
            $this->view->assign('menus', $menus);
        }
        $this->load->helper("navigation");
        $url = site_url() . "admin/menu/index/" . $order . "/" . $order_direction . "/";
        $page_data = get_admin_pages_data($url, $menu_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);

        $this->view->setHeader(l('admin_header_menu_list', 'menu'));
        $this->view->render('list');
    }

    public function edit($menu_id = null)
    {
        if ($menu_id) {
            $data = $this->Menu_model->get_menu_by_id($menu_id);
        } else {
            $data = [];
        }

        if ($this->input->post('btn_save')) {
            $post_data = [
                "name"              => $this->input->post('name', true),
                "gid"               => $this->input->post('gid', true),
                "check_permissions" => intval($this->input->post('check_permissions')),
            ];
            $validate_data = $this->Menu_model->validate_menu($menu_id, $post_data);
            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                $data = array_merge($data, $validate_data["data"]);
            } else {
                $data = $validate_data["data"];
                $this->Menu_model->save_menu($menu_id, $data);

                if ($menu_id) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_menu', 'menu'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_menu', 'menu'));
                }

                $current_settings = $_SESSION["menu_list"];
                $url = site_url() . "admin/menu/index/" . $current_settings["order"] . "/" . $current_settings["order_direction"] . "/" . $current_settings["page"] . "";
                $this->view->setRedirect($url);
            }
        }

        $this->view->assign('data', $data);

        $this->view->setHeader(l('admin_header_menu_edit', 'menu'));
        $this->view->render('edit_form');
    }

    public function delete($menu_id)
    {
        if (!empty($menu_id)) {
            $this->Menu_model->delete_menu($menu_id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_menu', 'menu'));
        }
        $current_settings = $_SESSION["menu_list"];
        $url = site_url() . "admin/menu/index/" . $current_settings["order"] . "/" . $current_settings["order_direction"] . "/" . $current_settings["page"] . "";
        $this->view->setRedirect($url);
    }

    public function items($menu_id)
    {
        $current_settings = isset($_SESSION["menu_list"]) ? $_SESSION["menu_list"] : [];

        if (!$menu_id) {
            $url = site_url() . "admin/menu/index/" . $current_settings["order"] . "/" . $current_settings["order_direction"] . "/" . $current_settings["page"] . "";
            $this->view->setRedirect($url);

            return false;
        }

        $menu_data = $this->Menu_model->getMenuById($menu_id);
        $this->view->assign("menu_data", $menu_data);

        $menu_items = $this->Menu_model->getMenuItemsList($menu_id);
        $this->view->assign("menu", $menu_items);

        $current_settings = isset($_SESSION["menu_list"]) ? $_SESSION["menu_list"] : [];
        if ($current_settings) {
            $back_url = site_url() . "admin/menu/index/" . $current_settings["order"] . "/" . $current_settings["order_direction"] . "/" . $current_settings["page"] . "";
        } else {
            $back_url = site_url() . "admin/menu/index";
        }

        $this->pg_theme->add_js('admin-multilevel-sorter.js');
        $this->view->setHeader(l('admin_header_menu_items', 'menu') . $menu_data["name"]);
        $this->view->setBackLink($back_url);
        $this->view->render('items_list');
    }

    public function itemsEdit($menu_id, $parent_id = 0, $item_id = null)
    {
        if ($item_id) {
            $data = $this->Menu_model->getMenuItemById($item_id, true);
        } else {
            $data = [];
        }
        $this->load->model("modules/menu/Indicators_model");
        if ($this->input->post('btn_save')) {
            $link_on = $this->input->post('link_on');
            $link = null;

            if ($link_on) {
                $link_type = $this->input->post('link_type');
                switch ($link_type) {
                    case "out":
                        $link = $this->input->post('link_out');
                        break;
                    case "in":
                        $link = str_replace(site_url(), "", $this->input->post('link_in'));
                        break;
                    default:
                        $link = $this->input->post('link_out');
                }
            }
            
            $post_data = [
                "gid" => $this->input->post('gid', true),
                "is_external" => ($link_type == "out") ? 1 : 0,
                "link" => $link,
                "link_on" => ($link_on == "on") ? 1 : 0,
                "menu_id" => $menu_id,
                "parent_id" => $parent_id,
                "indicator_gid" => (string) $this->input->post('indicator_gid'),
                "names" => $this->input->post('langs', true)
            ];
            
            $validate_data = $this->Menu_model->validateMenuItem($item_id, $post_data);

            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                $data = array_merge($data, $validate_data["data"]);
            } else {
                $data = $validate_data["data"];
                $this->Menu_model->saveMenuItem($item_id, $data, $validate_data['names']);

                if ($menu_id) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_menu_item', 'menu'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_menu_item', 'menu'));
                }

                $url = site_url() . 'admin/menu/items/' . $menu_id;
                $this->view->setRedirect($url);

                return false;
            }
        }

        $this->view->assign('data', $data);
        $this->view->assign('indicators', $this->Indicators_model->get_types());
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('menu_id', $menu_id);
        $this->view->assign('parent_id', $parent_id);
        $this->view->setHeader(l('admin_header_menu_item_edit', 'menu'));
        $this->view->render('edit_item_form');
    }

    public function ajaxSaveItemSorter()
    {
        $sorter = $this->input->post('sorter');
        $return = ["errors" => "", "success" => l('success_update_menu', 'menu')];
        foreach ($sorter as $parent_str => $items_data) {
            $parent_id = intval(str_replace('parent_', '', $parent_str));
            foreach ($items_data as $item_str => $sort_index) {
                $item_id = intval(str_replace('item_', '', $item_str));
                $data = [
                    'parent_id' => $parent_id,
                    'sorter'    => $sort_index,
                ];
                $this->Menu_model->save_menu_item($item_id, $data);
            }
        }
        $this->view->assign($return);
    }

    public function ajaxItemActivate($status, $item_id)
    {
        $data = [
            'status' => intval($status),
        ];
        $this->Menu_model->save_menu_item($item_id, $data);
    }

    public function ajaxItemDelete($item_id)
    {
        $this->Menu_model->delete_menu_item($item_id);
        $return = ["errors" => "", "success" => l('success_delete_menu_item', 'menu')];
        $this->view->assign($return);
    }
}
