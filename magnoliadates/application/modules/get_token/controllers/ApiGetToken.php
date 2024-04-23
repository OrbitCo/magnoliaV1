<?php

declare(strict_types=1);

namespace Pg\modules\get_token\controllers;

/**
 * Users user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 * */
class ApiGetToken extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * @api {post} /get_token/index Get token
    * @apiGroup Get token
    * @apiParam {string} email email
    * @apiParam {string} password password
    */
    public function index()
    {
        $errors = [];
        $data = [
            "email"    => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
            "password" => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)
        ];

        if (empty($data['email']) && empty($data['password'])) {
            $token = $this->session->sess_create_token();
            $this->set_api_content('data', ['token' => $token]);
        } else {
            $this->load->model("users/models/Auth_model");
            $login_return = $this->Auth_model->loginByEmailPassword($data["email"], $data["password"]);
            if (empty($login_return["errors"])) {
                if (isset($login_return['login']) && isset($login_return['blocked'])) {
                    if (!$login_return['login'] && $login_return['blocked']) {
                        $login_return['errors'] = l('error_user_is_blocked', 'users');
                    }
                }
            }
            if (!empty($login_return["errors"])) {
                $errors = $login_return["errors"];
                $this->set_api_content('errors', $errors);
                $token = $this->session->sess_destroy();
            } else {
                $this->load->model("Get_token_model");
                $this->Get_token_model->mobileAuth($login_return['user_data']['id']);
                $token = $this->session->sess_create_token();
                $this->set_api_content('data', ['token' => $token, 'user_data' => $login_return['user_data']]);
            }
        }
    }
}
