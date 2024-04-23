<?php

declare(strict_types=1);

namespace Pg\modules\contact_us\controllers;

/**
 * Contact us api controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 **/
class ApiContactUs extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_us_model');
    }

    /**
     * Get reasons list
     */
    /**
    * @api {post} /contact_us/getReasons  Get reasons list
    * @apiGroup Contact us
    */
    public function getReasons()
    {
        $reasons = $this->Contact_us_model->get_reason_list();
        $this->set_api_content('data', ['reasons' => $reasons]);
    }

    /**
     * Send contact us form
     *
     * @param int    $id_reason
     * @param string $user_name
     * @param string $user_email
     * @param string $subject
     * @param string $message
     *
     * @todo Add antispam
     */
    /**
    * @api {post} /contact_us/sendForm  Send contact us form
    * @apiGroup Contact us
    * @apiParam {int} id_reason  id reason
    * @apiParam {string} user_name  user name
    * @apiParam {string} user_email  user email
    * @apiParam {string} subject  subject email
    * @apiParam {string} message message
    */
    public function sendForm()
    {
        $post_data = [
            'id_reason'  => $this->input->post('id_reason', true),
            'user_name'  => $this->input->post('user_name', true),
            'user_email' => $this->input->post('user_email', true),
            'subject'    => $this->input->post('subject', true),
            'message'    => $this->input->post('message', true),
        ];
        $validate_data = $this->Contact_us_model->validate_contact_form($post_data);

        if (!empty($validate_data['errors'])) {
            $this->set_api_content('errors', $validate_data['errors']);
            $this->set_api_content('data', ['post_data' => $post_data]);
        } else {
            $return = $this->Contact_us_model->send_contact_form($validate_data['data']);
            if (!empty($return['errors'])) {
                $this->set_api_content('errors', $return['errors']);
            } else {
                $this->set_api_content('messages', l('success_send_form', 'contact_us'));
            }
        }
    }
}
