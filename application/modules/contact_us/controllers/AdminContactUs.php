<?php

declare(strict_types=1);

namespace Pg\modules\contact_us\controllers;

use Pg\Libraries\View;

/**
 * Contact us admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 **/
class AdminContactUs extends \Controller
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
        $this->load->model(['Contact_us_model', 'Menu_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'content_items');
    }

    public function index()
    {
        $reasons_count = $this->Contact_us_model->getReasonCount();

        if ($reasons_count > 0) {
            $reasons = $this->Contact_us_model->getReasonList();
            $this->view->assign('reasons', $reasons);
        }
        $this->load->helper("navigation");
        $url = site_url() . "admin/contact_us";
        $page_data = get_admin_pages_data($url, $reasons_count, ($reasons_count ? $reasons_count : 10), 1, 'briefPage');
        $this->view->assign('page_data', $page_data);

        $this->Menu_model->setMenuActiveItem('admin_contacts_menu', 'reasons_list_item');
        $this->view->setHeader(l('admin_header_reasons_list', 'contact_us'));
        $this->view->render('list');
    }

    public function edit($id = null)
    {
        $data = [];
        if ($id) {
            $data = $this->Contact_us_model->getReasonById($id);
        }

        if ($this->input->post('btn_save')) {
            $post_data = [
                'mails' => $this->input->post('mails', true),
                'name' => $this->input->post('name', true)
            ];
            $validate_data = $this->Contact_us_model->validateReason($id, $post_data);
            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
            } else {
                $flag_add = empty($id) ? true : false;
                $data["id"] = $id = $this->Contact_us_model->saveReason($id, $validate_data["data"], $validate_data["langs"]);

                if (!$flag_add) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_reason', 'contact_us'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_reason', 'contact_us'));
                }

                redirect(site_url() . "admin/contact_us");
            }
            $data = array_merge($data, $validate_data["data"]);
            $this->view->assign('validate_lang', $validate_data["langs"]);
            $temp = $this->Contact_us_model->formatReasons([$data]);
            $data = $temp[0];
        }

        $this->view->assign('data', $data);
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('languages_count', count($this->pg_language->languages));
        $this->view->assign('cur_lang', $this->pg_language->current_lang_id);

        $this->Menu_model->set_menu_active_item('admin_contacts_menu', 'reasons_list_item');
        $this->view->setHeader(l('admin_header_reasons_list', 'contact_us'));
        $this->view->render('edit');
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $this->Contact_us_model->delete_reason($id);
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_reason', 'contact_us'));
        }
        redirect(site_url() . "admin/contact_us");
    }

    public function settings()
    {
        $data = $this->Contact_us_model->get_settings();

        if ($this->input->post('btn_save')) {
            $post_data = [
                "default_alert_email" => $this->input->post('default_alert_email', true),
            ];

            $validate_data = $this->Contact_us_model->validate_settings($post_data);
            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
            } else {
                $this->Contact_us_model->set_settings($validate_data["data"]);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_settings_save', 'contact_us'));
                redirect(site_url() . "admin/contact_us/settings");
            }
        }

        $this->view->assign('data', $data);
        $this->Menu_model->set_menu_active_item('admin_contacts_menu', 'settings_list_item');
        $this->view->setHeader(l('admin_header_settings', 'contact_us'));
        $this->view->render('settings');
    }
}
