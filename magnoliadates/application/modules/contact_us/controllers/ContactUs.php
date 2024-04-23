<?php

declare(strict_types=1);

namespace Pg\modules\contact_us\controllers;

use Pg\Libraries\View;

/**
 * Contact us user side controller
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
class ContactUs extends \Controller
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
        $this->load->model("Contact_us_model");
    }

    public function index()
    {
        $reasons = $this->Contact_us_model->get_reason_list();
        $this->view->assign('reasons', $reasons);
        $data = [];

        if ($this->input->post('btn_save')) {
            $post_data = [
                "id_reason"    => $this->input->post('id_reason', true),
                "user_name"    => $this->input->post('user_name', true),
                "user_email"   => $this->input->post('user_email', true),
                "subject"      => $this->input->post('subject', true),
                "message"      => $this->input->post('message', true),
                "captcha_code" => $this->input->post('captcha_code', true),
            ];

            if (empty($post_data['captcha_code'])) {
                $post_data['captcha_code'] = $this->input->post('g-recaptcha-response', true);
            }
            $validate_data = $this->Contact_us_model->validateContactForm($post_data);
            $data = $validate_data["data"];

            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
            } else {
                $return = $this->Contact_us_model->send_contact_form($validate_data["data"]);
                if (!empty($return["errors"])) {
                    $this->system_messages->addMessage(View::MSG_ERROR, $return["errors"]);
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_send_form', 'contact_us'));
                }
            }
        }

        $this->view->assign('data', $data);

        $this->load->model('Menu_model');
        $this->Menu_model->breadcrumbs_set_active(l('header_contact_us_form', 'contact_us'));

        $this->view->render('form');
    }

    public function ajaxSendMessage()
    {
        $return = ['errors' => '', 'content' => '', 'success' => ''];
        if ($this->input->post('id_reason')) {
            $post_data = [
                "id_reason"    => $this->input->post('id_reason', true),
                "user_name"    => $this->input->post('user_name', true),
                "user_email"   => $this->input->post('user_email', true),
                "subject"      => $this->input->post('subject', true),
                "message"      => $this->input->post('message', true),
                "captcha_code" => $this->input->post('captcha_code', true),
            ];
            if (empty($post_data['captcha_code'])) {
                $post_data['captcha_code'] = $this->input->post('g-recaptcha-response', true);
            }
            $validate_data = $this->Contact_us_model->validateContactForm($post_data);

            if (!empty($validate_data["errors"])) {
                $return['errors'] = $validate_data["errors"];
            } else {
                $return = $this->Contact_us_model->send_contact_form($validate_data["data"]);

                if (empty($return["errors"])) {
                    $return["success"] = l('success_send_form', 'contact_us');
                }
            }
        }
        $this->view->assign($return);
        $this->view->render();
    }
}
