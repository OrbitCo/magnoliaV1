<?php

declare(strict_types=1);

namespace Pg\modules\start\controllers;

/**
 * Start api controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiStart extends \Controller
{
    /**
    * @api {post} /start/backend Get backend data
    * @apiGroup Start
    * @apiParam {array} [data] post data
    */
    public function backend()
    {
        $id_user = intval($this->session->userdata('user_id'));
        $this->load->model("Users_model");
        if ((bool)$this->Users_model->isActivityUser($id_user) == false) {
            $this->load->model("users/models/Auth_model");
            if (isset($this->user_id)) {
                $this->Users_model->updateOnlineStatus($this->user_id, 0);
            }
            $this->session->token_destroy();
            $this->Auth_model->logoff();
            $this->session->sess_create();
            $token = $this->session->sess_create_token();
            $this->set_api_content('data', ['token' => $token, 'logout' => true]);
        } else {
            $post_data = (array) $this->input->post('data');
            $result = [];
            foreach ($post_data as $gid => $params) {
                if (empty($params['module']) || empty($params['model']) || empty($params['method'])) {
                    continue;
                }

                if (!$this->pg_module->is_module_installed($params['module'])) {
                    continue;
                }

                $model = $gid . 'BackendModel';
                $method = $params['method'];
                $this->load->model($params['module'] . '/models/' . $params['model'], $model, false, true, true);

                $params['id_user'] = $id_user;

                $result[$gid] = $this->{$model}->{$method}($params);
            }
            $this->set_api_content('data', $result);
        }
    }

    /**
    * @api {post} /start/getCaptcha Get captcha
    * @apiGroup Start
    */
    public function getCaptcha()
    {
        $this->load->model('start/models/Start_captcha_model');
        $captcha = $this->Start_captcha_model->formatCaptcha(
            $this->Start_captcha_model->getCaptcha()
        );
        $this->set_api_content('captcha', $captcha);
    }
}
