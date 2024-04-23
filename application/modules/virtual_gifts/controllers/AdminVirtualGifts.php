<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\controllers;

use Pg\modules\virtual_gifts\models\VirtualGiftsModel;

/**
 * VirtualGifts module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */

/**
 * VirtualGifts admin side controller
 *
 * @package     PG_Dating
 * @subpackage  VirtualGifts
 *
 * @category    controllers
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */
class AdminVirtualGifts extends \Controller
{
    /**
     * Constructor
     *
     * @return VirtualGifts_start
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Virtual_gifts_model']);
        $this->Menu_model->set_menu_active_item("admin_menu", "add_ons_items");
    }

    /**
     * Display index page
     *
     * @return void
     */
    public function index($order = "priority", $order_direction = "ASC", $page = 1)
    {
        $search_params = $search_param = [];
        $lang_id                             = $this->pg_language->current_lang_id;
        $current_settings                    = isset($_SESSION["gifts_list"]) ? $_SESSION["gifts_list"] : [];
        if (!isset($current_settings["order"])) {
            $current_settings["order"]           = $order;
        }
        if (!isset($current_settings["order_direction"])) {
            $current_settings["order_direction"] = $order_direction;
        }
        if (!isset($current_settings["page"])) {
            $current_settings["page"]            = $page;
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

        $products_count = $this->Virtual_gifts_model->getVirtualGiftsCount(); //1;//$filter_data[$filter]; //????????

        if (!$page) {
            $page = $current_settings["page"];
        }
        $items_on_page            = $this->pg_module->get_module_config('virtual_gifts', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page                     = get_exists_page_number($page, $products_count, $items_on_page);
        $current_settings["page"] = $page;

        $_SESSION["gifts_list"] = $current_settings;

        $sort_links = [
            "priority" => site_url() . "admin/virtual_gifts/index/priority/ASC",
            "price"    => site_url() . "admin/virtual_gifts/index/price/" . (($order != 'price' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];
        $this->view->assign('sort_links', $sort_links);
        if ($products_count > 0) {
            $products = $this->Virtual_gifts_model->getVirtualGiftsList([], $page, $items_on_page, [$order => $order_direction], $lang_id);
            $this->view->assign("gifts", $products);
        }
        $this->view->assign('section', 'index');
        $this->load->helper("navigation");
        $url                      = site_url() . "admin/virtual_gifts/index/{$order}/{$order_direction}/";
        $page_data                = get_admin_pages_data($url, $products_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);
        $this->system_messages->set_data('back_link', site_url() . 'admin/start/menu/add_ons_items');
        $this->system_messages->set_data('header', l('admin_header_gifts', 'virtual_gifts'));
        $this->view->render('list');
    }

    /**
     * Sort gifts in a list
     *
     * @param type $id
     * @param type $direction
     */
    public function sortGifts($id = null, $direction = '')
    {
        if (!empty($id) && !empty($direction)) {
            $this->Virtual_gifts_model->set_sort_gift($id, $direction);
            if ($direction == 'up') {
                $this->system_messages->add_message('success', l('admin_gift_priority_up', 'virtual_gifts'));
            } elseif ($direction == 'down') {
                $this->system_messages->add_message('success', l('admin_gift_priority_down', 'virtual_gifts'));
            }
        }
        $cur_set = $_SESSION["gifts_list"];
        $url     = site_url() . "admin/virtual_gifts/";
        redirect($url);
    }

    /**
     * Edit image of a gift
     *
     * @param type $id
     */
    public function upload()
    {
        $this->load->model('Uploads_model');
        $media_config = $this->Uploads_model->getConfig(VirtualGiftsModel::UPLOAD_GID);
        $this->view->assign('photo_config', $media_config);
        $settings = $this->Virtual_gifts_model->getSettings();
        $this->view->assign('back_url', site_url() . "admin/virtual_gifts/");
        $this->view->assign('price_default', $settings["price_default"]);
        $this->view->assign('section', 'media');
        $this->view->render('upload');
    }

    /**
     * Settings of a module
     */
    public function settings()
    {
        $data = $this->Virtual_gifts_model->get_settings();

        if ($this->input->post('btn_save')) {
            $post_data     = [
                "price_default"        => $this->input->post('price_default', true),
                "admin_items_per_page" => $this->input->post('admin_items_per_page', true),
                "user_items_per_page"  => $this->input->post('user_items_per_page', true),
                "payment_type"         => $this->input->post('payment_type', true),
            ];
            $validate_data = $this->Virtual_gifts_model->validate_settings($post_data);
            if (!empty($validate_data["errors"])) {
                $this->system_messages->add_message('error', $validate_data["errors"]);
            } else {
                $this->Virtual_gifts_model->set_settings($validate_data["data"]);
                $this->system_messages->add_message('success', l('settings_changed', 'virtual_gifts'));
                redirect(site_url() . "admin/virtual_gifts/settings");
            }
        }

        $this->view->assign('section', 'settings');
        $this->view->assign('data', $data);
        $this->system_messages->set_data('back_link', site_url() . 'admin/virtual_gifts/index/');
        $this->system_messages->set_data('header', l('module_settings', 'virtual_gifts'));
        $this->view->render('settings');
    }

    /**
     * Change status of a gift
     *
     * @param type $gift_id
     */
    public function giftStatus($gift_id, $status)
    {
        $cur_set = $_SESSION["gifts_list"];
        $gift_id = intval($gift_id);
        $status  = intval($status);
        if (!empty($gift_id)) {
            $return = $this->Virtual_gifts_model->update_gift_status($gift_id, $status);
            if ($return) {
                if ($return == 'active') {
                    $this->system_messages->add_message('success', l('gift_activated', 'virtual_gifts'));
                } else {
                    $this->system_messages->add_message('success', l('gift_deactivated', 'virtual_gifts'));
                }
            } else {
                $this->system_messages->add_message('error', l('error_changing_status', 'virtual_gifts'));
            }
        } else {
            $this->system_messages->add_message('error', l('error_changing_status', 'virtual_gifts'));
        }
        $url = site_url() . "admin/virtual_gifts/index/{$cur_set["order"]}/{$cur_set["order_direction"]}/{$cur_set["page"]}";
        redirect($url);
    }

    /**
     * Return form for price changing
     */
    public function ajaxChangePriceForm()
    {
        $this->view->render('price_form');
    }

    /**
     *
     */
    public function ajaxChangePrice()
    {
        $gift_ids = $this->input->post('gift_ids');
        $amount   = floatval($this->input->post('amount'));
        if (empty($amount)) {
            $this->system_messages->add_message('error', l('error_price', 'virtual_gifts'));

            return;
        }
        $count = 0;

        foreach ($gift_ids as $id) {
            $id = intval($id);
            if ($this->Virtual_gifts_model->update_gift_price($id, $amount)) {
                $count++;
            }
        }
        $this->system_messages->add_message('success', l('prices_changed', 'virtual_gifts') . ' (' . $count . ')');

        return;
    }

    public function delete($id)
    {
        $this->ajaxDeleteGifts($id);

        $url = site_url() . "admin/virtual_gifts/";

        return redirect($url);
    }

    /**
     * Delete selected gifts
     */
    public function ajaxDeleteGifts($id = null)
    {
        if (!empty($id)) {
            $gift_ids = [$id];
        } else {
            $gift_ids = $this->input->post('gift_ids');
        }

        foreach ($gift_ids as &$gift_id) {
            $gift_id = intval($gift_id);
        }
        $gifts_list = $this->Virtual_gifts_model->getVirtualGiftsList(["id" => $gift_ids]);
        $return     = $this->Virtual_gifts_model->deleteVirtualGifts($gifts_list);

        if ($return) {
            $this->system_messages->add_message('success', l('gifts_deleted', 'virtual_gifts') . ' (' . $return . ')');
        } else {
            $this->system_messages->add_message('error', l('error_while_deleting', 'virtual_gifts'));
        }

        return;
    }

    /**
     *  Save media by ajax
     *
     *  @param string $type
     *  @param integer $id_product
     *
     *  @return void
     */
    public function ajaxSaveGiftMedia($type = 'images')
    {
        $return = ['errors' => [], 'warnings' => [], 'name' => ''];

        $validate_data = $this->Virtual_gifts_model->validateImage('multiUpload');
        $price = floatval($this->input->post('price_reduced'));
        if ((empty($price) || $price < 0) || !empty($validate_data['errors'])) {
            $return['errors'][] = l('error_price', 'virtual_gifts');
            $this->system_messages->add_message('error', l('error_price', 'virtual_gifts'));
            //$this->view->setRedirect(site_url('virtual_gifts/upload'));
        } else {
            $save_data = $this->Virtual_gifts_model->saveImage('multiUpload', $price);
        }

        if (empty($save_data['errors'])) {
            if (!empty($save_data['file'])) {
                $return['name'] = $save_data['file'];
            }
        } else {
            $return['errors'][] = $save_data['errors'];
        }
        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxGetGiftImages()
    {
        $content = ['content' => ''];
        $this->view->assign($content);
    }
}
