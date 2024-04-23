<?php

declare(strict_types=1);

namespace Pg\modules\users_connections\controllers;

/**
 * Users connections user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiUsersConnections extends \Controller
{

    /**
    * @api {post} /users_connections/socialApps Social apps list
    * @apiGroup Users connections
    */
    public function socialApps()
    {
        $this->load->model('Users_connections_model');
        $apps = $this->Users_connections_model->getMobileApps(
            $this->session->userdata('user_id')
        );
        $this->view->assign('social_apps', $apps);
    }

    /**
    * @api {post} /users_connections/oauthLogin Login
    * @apiGroup Users connections
    * @apiParam {string} service_gid service gid
    * @apiParam {int} service_user_id service user id
    */
    public function oauthLogin()
    {
        $service_gid = filter_input(INPUT_POST, 'service_gid');
        $service_user_id = filter_input(INPUT_POST, 'service_user_id');
        $data = [];
        $errors = [];
        if (empty($service_gid)) {
            $errors[] = 'empty_service_gid';
        }
        if (empty($service_user_id)) {
            $errors[] = 'empty_service_user_id';
        }
        if (empty($errors)) {
            $this->load->model('social_networking/models/Social_networking_services_model');
            $service = $this->Social_networking_services_model->getServiceByGid($service_gid);
        }
        if (empty($service)) {
            $errors[] = 'wrong_service_gid';
        }
        if (empty($errors)) {
            $this->load->model('users_connections/models/Users_connections_model');
            $connection = $this->Users_connections_model->getConnectionByData(
                $service['id'],
                $service_user_id
            );
            if (empty($connection)) {
                $errors[] = 'connection_not_found';
            } else {
                $this->load->model('users/models/Auth_model');
                $auth_data = $this->Auth_model->login($connection['user_id']);
                $data['auth_data'] = $auth_data;
                if (!empty($auth_data['errors'])) {
                    $errors = $auth_data['errors'];
                } elseif ($auth_data['invalid_data']) {
                    $errors[] = 'invalid_data';
                } elseif ($auth_data['blocked']) {
                    $errors[] = 'blocked';
                } elseif (!empty($auth_data["login"])) {
                    $data['token'] = $this->session->sess_create_token();
                }
            }
        }

        $this->view->assign('data', $data);
        $this->view->assign('errors', $errors);
    }

    /**
    * @api {post} /users_connections/oauthRegister Registration user
    * @apiGroup Users connections
    * @apiParam {string} service_gid service gid
    * @apiParam {string} access_token access token
    * @apiParam {string} access_token_secret access token secret
    * @apiParam {date} date_end date end
    * @apiParam {int} service_user_id  user id
    * @apiParam {string} service_user_fname user first name
    * @apiParam {string} service_user_sname user surname
    * @apiParam {string} service_user_email user email
    * @apiParam {date} birth_date service user birth date
    * @apiParam {string} user_type service user type
    * @apiParam {string} nickname service user nickname
    * @apiParam {string} country_code country code
    * @apiParam {int} region_id service region id
    * @apiParam {int} city_id service city id
    */
    public function oauthRegister()
    {
        $post_data = [
            'service_gid' => $this->input->post('service_gid', true),
            'access_token' => $this->input->post('access_token', false),
            'access_token_secret' => $this->input->post('access_token_secret', false),
            'date_end' => $this->input->post('date_end', false),
            'service_user_id' => $this->input->post('service_user_id', false),
            'service_user_fname' => $this->input->post('service_user_fname', false),
            'service_user_sname' => $this->input->post('service_user_sname', false),
            'service_user_email' => $this->input->post('service_user_email', false),
            'service_birth_date' => $this->input->post('birth_date', true),
            'user_type' => $this->input->post('user_type', true),
            'nickname' =>  $this->input->post('nickname', true),
            'id_country' => $this->input->post('country_code', true),
            'id_region' => $this->input->post('region_id', true),
            'id_city' => $this->input->post('city_id', true),
            'looking_user_type' => $this->input->post('looking_user_type', true)
        ];
        
        if (empty($post_data['service_user_email'])) {
            $post_data['service_user_email'] = $post_data['nickname'] . '@mail.com';
        }
        
        $this->load->model('Users_connections_model');
        $validate = $this->Users_connections_model->validateUser($post_data);
        
        if (!empty($validate['errors'])) {
            // TODO: user registration by social
            $this->load->library('Analytics');
            $this->analytics->track('user_register_fail', ['source' => 'social', 'controller' => 'api_users_connections', 'service' => $validate['data']['service']]);
            $this->view->assign('errors', !empty($validate['errors_gids']) ? $validate['errors_gids'] : array_values($validate['errors']));
            return false;
        } else {
            $this->load->model('users_connections/models/Users_connections_model');
            $existing_connection = $this->Users_connections_model->getConnectionByData(
                $service['id'],
                $validate['data']['connection']['data']);
            
            if ($existing_connection) {
                $existing_connection['token'] = $this->session->sess_create_token();
                $existing_connection['registered'] = false;
                $this->view->assign('data', $existing_connection);
                return false;
            }
            
            $user_id = $this->Users_model->saveUser(null, $validate['data']['user']);
        
            // Authorize user
            $this->load->model('users/models/Auth_model');
            $auth_data = $this->Auth_model->login($user_id);
            if (!empty($auth_data["errors"])) {
                $this->view->assign('errors', $auth_data["errors"]);
                return false;
            }
            
            // Save connection with social app
            $validate['data']['connection']['user_id'] = $user_id;
            $this->Users_connections_model->saveConnection(null, $validate['data']['connection']);

            $result = $connection;
            $result['token'] = $this->session->sess_create_token();
            $result['registered'] = true;
            
            $messages[] = l('please_set_email', 'users_connections');
            
            // TODO: user registration by social
            $this->load->library('Analytics');
            $this->analytics->track('user_register_success', ['source' => 'social', 'controller' => 'api_users_connections', 'service' => $validate['data']['service']]);
            
            $this->view->assign('data', $result);
            $this->view->assign('messages', $messages);
        }
    }
}
