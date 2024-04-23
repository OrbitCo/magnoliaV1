<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\users\models\events\EventUsers;

if (!defined('SESSIONS_TABLE')) {
    define('SESSIONS_TABLE', DB_PREFIX . 'sessions');
}

/**
 * User auth model
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
 * */
class AuthModel extends \Model
{
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model("Users_model");
    }

    public function login($id, $is_reg = false)
    {
        $decline_login = false;
        $data = [
            'errors' => [],
            'user_data' => [],
            'login' => false,
            'invalid_data' => false,
            'blocked' => false,
        ];
        $user_data = $this->ci->Users_model->getUserById($id);
        if (empty($user_data)) {
            $data["errors"][] = l('error_login_invalid_data', 'users');
        } else {
            if ($user_data["confirm"] == 0 && $is_reg !== true) {
                $data["errors"][] = l('error_unconfirmed_user', 'users', $user_data['lang_id']);
                $data["user_data"]["confirm"] = 0;
            } elseif ($user_data["approved"] == 0 && $is_reg !== true &&
                    $this->ci->pg_module->get_module_config('users', 'user_approve') != 2) {
                if (!$this->ci->router->is_api_class) {
                    $this->view->setRedirect(site_url() . 'users/inactive');
                }
                $data["blocked"] = true;
                $decline_login = true;
            }
        }

        if (!$decline_login) {
            $this->ci->Users_model->updateOnlineStatus($id, 1);
            $this->updateUserSessionData($id, $user_data);
            $data["user_data"] = $user_data;
            $data["login"] = true;

            $event_handler = EventDispatcher::getInstance();
            $event = new EventUsers();
            $event->setSearchFrom((int)$id);
            $event->setData($user_data);
            $event_handler->dispatch($event, 'user_login');
        }

        return $data;
    }

    public function updateUserSessionData($id, $user_data = [])
    {
        if (empty($user_data)) {
            $user_data =  $this->ci->Users_model->getUserById($id, false);
        }

        if ($user_data) {
            $session = [
                "auth_type"     => 'user',
                "approved"      => $user_data['approved'],
                "confirm"      => $user_data['confirm'],
                "user_id"       => $user_data["id"],
                "user_type"     => $user_data["user_type"],
                "email"         => $user_data["email"],
                "fname"         => $user_data["fname"],
                "sname"         => $user_data["sname"],
                "name"          => $user_data["fname"] . ' ' . $user_data["sname"],
                "nickname"      => $user_data["nickname"],
                "output_name"   => $user_data["output_name"],
                "lang_id"       => $this->ci->pg_language->current_lang_id,
                "online_status" => $user_data["online_status"],
                "site_status"   => $user_data["site_status"],
                "show_adult"    => $user_data["show_adult"],
                'activity'      => $user_data['activity'],
                'age_min'      => $user_data['age_min'],
                'age_max'      => $user_data['age_max'],
                'is_terms'      => $user_data['is_terms'],
                'date_modified' => strtotime($user_data['date_modified'])
            ];

            $logo_field = !empty($user_data['user_logo_moderation']) ? 'user_logo_moderation' : 'user_logo';
            $this->ci->load->model('Uploads_model');
            $session['logo'] = [$logo_field => $this->ci->Uploads_model->formatUpload($this->ci->Users_model->upload_config_id, $user_data["id"], $user_data[$logo_field])];
            if (!empty($session['logo'])) {
                $session['user_logo_mime'] = $user_data['user_logo_mime'];
            }
            if ($this->ci->pg_module->is_module_installed('couples')) {
                $session['couple_id'] = $user_data['couple_id'];
            }

            if ($this->ci->session->userdata('service_redirect')) {
                $session['service_redirect'] = $this->ci->session->userdata('service_redirect');
            }
        } else {
            $session = [];
        }

        $this->ci->session->set_userdata($session);
        $this->ci->view->assign('user_session_data', $this->ci->session->all_userdata());

        return $session;
    }

    public function loginByEmailPassword($email, $password)
    {
        $user_data = $this->ci->Users_model->getUserByEmailPassword($email, $password);
        if (empty($user_data)) {
            $data["errors"][] = l('error_login_invalid_data', 'users');
        } else {
            $data = $this->login($user_data["id"]);
        }

        return $data;
    }

    public function logoff()
    {
        $this->ci->load->model("Users_model");
        $user_id = $this->ci->session->userdata('user_id');
        $user_id_length = strlen((string)$user_id);

        $like = '\'%s:9:"auth_type";s:4:"user"%\'';
        $like_2 = '\'%s:7:"user_id";s:' . $user_id_length . ':"' . $user_id . '"%\' ';

        $result = $this->ci->db->select('COUNT(*) AS cnt')
                ->from(SESSIONS_TABLE)
                ->where('`user_data` LIKE' . $like . ' and `user_data` LIKE ' . $like_2, null, false)
                ->get()->result_array();
        if ((int)$result[0]['cnt'] === 1) {
            $this->Users_model->updateOnlineStatus($user_id, 0);
        }

        $this->ci->session->sess_destroy();
    }

    public function validateLoginData($data)
    {
        $return = ["errors" => [], "data" => []];

        if (!empty($data["email"]) && !empty($data["password"])) {
            $this->ci->config->load('reg_exps', true);
            $return["data"]["email"] = strip_tags($data["email"]);
            $password_expr = $this->ci->config->item('password', 'reg_exps');
            $return["data"]["password"] = trim(strip_tags($data["password"]));

            if (!filter_var($return["data"]["email"], FILTER_VALIDATE_EMAIL)) {
                $return["errors"][] = l('error_email_incorrect', 'users');
            }
            if (!preg_match($password_expr, $return["data"]["password"])) {
                $return["errors"][] = l('error_login_invalid_data', 'users');
            }
        } else {
            $return["errors"][] = l('error_login_invalid_data', 'users');
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'login_by_email_password' => 'loginByEmailPassword',
            'update_user_session_data' => 'updateUserSessionData',
            'validate_login_data' => 'validateLoginData',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
