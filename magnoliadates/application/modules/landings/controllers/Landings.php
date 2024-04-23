<?php

declare(strict_types=1);

namespace Pg\modules\landings\controllers;

/**
 * Landings user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class Landings extends \Controller
{

    /**
     * Initialize
     *
     * @return void
     */
    public function init()
    {
        if ($this->session->userdata('auth_type') == 'user') {
            $user_id = intval($this->session->userdata('user_id'));
            $user = $this->Users_model->get_user_by_id($user_id, true, false);
            $this->view->assign('user', $user);
        }

        $lang = $this->pg_language->current_lang;
        $this->view->assign('lang', $lang);
    }

    /**
     * Output token for api
     *
     * @return void
     */
    public function getToken()
    {

        if ($this->session->userdata('auth_type') == 'user') {
            $user_id = intval($this->session->userdata('user_id'));
            $this->load->model("users/models/Auth_model");
            $this->Auth_model->login($user_id);
        }

        $token = $this->session->sess_create_token();
        $this->view->assign('token', $token);

        $this->view->assign('lang', $this->pg_language->current_lang);
    }
}
