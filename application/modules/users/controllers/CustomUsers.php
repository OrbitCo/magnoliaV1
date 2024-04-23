<?php

declare(strict_types=1);

namespace Pg\modules\users\controllers;

use Pg\libraries\EventDispatcher;
use Pg\libraries\View;
use Pg\modules\users\models\events\EventUsers;
use Pg\modules\users\models\UsersModel;

/**
 * Users user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class CustomUsers extends Users
{
    /**
     * Users registration
     *
     * @return array
     */
    public function registration()
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            return $this->photoUpload();
        }

        $post = $this->input->post('data', true);
        if (!isset($post['captcha_confirmation'])) {
            $post['captcha_confirmation'] = $this->input->post('g-recaptcha-response', true);
        }

        $post['referral_code'] = $this->input->post('referral_code', true);

        $this->load->model('Field_editor_model');
        $this->Field_editor_model->initialize(UsersModel::MODULE_GID);
        $sections = $this->Field_editor_model->getSectionList();
        $sections_gids = array_keys($sections);
        $fields_for_select = $this->Field_editor_model->getFieldsForSelect($sections_gids);

        foreach ($fields_for_select as $field) {
            if ($this->input->post($field)) {
                $post[$field] = $this->input->post($field, true);
            }
        }

        $this->load->model('users/models/UsersExtendedRegistrationModel');
        $validate = $this->UsersExtendedRegistrationModel->validate(null, $post, '', $sections_gids);

        $data = $validate["data"];
        if (!empty($validate["errors"])) {
            $dump_validate = [];
            if (isset($validate["errors"]['email'])) {
                $dump_validate["errors"]['email'] = $validate["errors"]['email'];
            }
            if (isset($validate["errors"]['password'])) {
                $dump_validate["errors"]['password'] = $validate["errors"]['password'];
            }
            if (isset($validate["errors"]['confirmation'])) {
                $dump_validate["errors"]['confirmation'] = $validate["errors"]['confirmation'];
            }

            if (!empty($dump_validate["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $dump_validate["errors"]);
                $this->view->assign('errors_data', $dump_validate["errors"]);
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate["errors"]);
                $this->view->assign('errors_data', $validate["errors"]);
            }

            // TODO: user registration by email
            $this->load->library('Analytics');
            $this->analytics->track('user_email_register_fail', ['controller' => 'users']);


            $this->view->assign(['errors' => $validate["errors"]]);
            $this->view->render();
            return;
        } else {

            $data['activity'] = 0;
            if ($this->use_email_confirmation) {
                $data["confirm"] = 0;
                $data["confirm_code"] = substr(md5(date(UsersModel::DB_DATE_FORMAT) . $data["nickname"]), 0, 10);
            } else {
                $data["confirm"] = 1;
                $data["confirm_code"] = "";
            }
            $data["approved"] = $this->use_approve ? 0 : 1;
            $saved_password = $data["password"];
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
            $data["lang_id"] = $this->session->userdata("lang_id");
            if (!$data["lang_id"]) {
                $data["lang_id"] = $this->pg_language->get_default_lang_id();
            }

            $user_id = $this->Users_model->registerUser($data);
            if ($this->Users_model->is_couples_installed === true) {
                $this->load->model("Couples_model");
                $this->Couples_model->registerUser($user_id, $data, $validate);
            }
            if ($this->pg_module->is_module_installed('incomplete_signup')) {
                $this->load->model("incomplete_signup/models/Incomplete_signup_model");
                $this->Incomplete_signup_model->deleteUnregisteredUserByEmail($data['email']);
            }
            if ($this->pg_module->is_module_installed('subscriptions')) {
                $this->load->model("subscriptions/models/Subscriptions_users_model");
                $this->Subscriptions_users_model->saveUserSubscriptions($user_id, $this->input->post('user_subscriptions_list'));
            }

            $this->load->model('Notifications_model');
            $data["password"] = $saved_password;
            if ($this->use_email_confirmation) {
                $link = site_url("users/confirm/" . $data["confirm_code"]);
                $data["confirm_block"] = l('confirmation_code', UsersModel::MODULE_GID) . ': ' . $data["confirm_code"] . "\n\n" . str_replace("[link]", $link, l('confirm_block_text', 'users'));
            }
            $data['fname'] = UsersModel::formatUserName($data);
            $this->Notifications_model->sendNotification($data["email"], 'users_registration', $data, '', $data['lang_id']);

            // TODO: user registration by email
            $this->load->library('Analytics');
            $this->analytics->track('user_email_register_success', ['controller' => 'users']);

            $this->load->model("users/models/Auth_model");
            $auth_data = $this->Auth_model->login($user_id, true);
            if (!empty($auth_data["errors"])) {
                $this->view->assign(['errors' => [l('error_access_denied', UsersModel::MODULE_GID)]]);
            } else {
                $this->view->assign(['redirect' => site_url('users/photoUpload')]);
            }
            $this->view->render();
            return;
        }
        $this->view->assign('user_data', $data);
        $this->load->model('Start_model');
        $template_name = $this->Start_model->templateName();
        $this->view->render($template_name, 'user', 'start');
    }
}
