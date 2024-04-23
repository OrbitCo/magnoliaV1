<?php

declare(strict_types=1);

namespace Pg\modules\users_connections\controllers;

use Pg\Libraries\Analytics;
use Pg\Libraries\View;
use Pg\modules\users\models\UsersModel;
use Pg\modules\users_connections\models\UsersConnectionsModel;

/**
 * Users connections user side controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class UsersConnections extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function joinAccount($service_id = false)
    {
        $this->load->model([
            'social_networking/models/Social_networking_services_model',
            'social_networking/models/Social_networking_connections_model',
            'Users_connections_model'
        ]);
        $user_id = intval($this->session->userdata('user_id'));
        if ($service_id !== false) {
            $service = $this->Social_networking_services_model->getServiceById($service_id);
            if ($service['oauth_version'] == 2) {
                $result = $this->Social_networking_connections_model->checkOauth2Connection($service, site_url('users_connections/joinAccount/' . $service_id));
            } else {
                $result = $this->Social_networking_connections_model->checkOauthConnection($service, site_url('users_connections/joinAccount/' . $service_id));
            }
            if ($result['result']) {
                if (isset($result['result']['oauth_token'])) {
                    $result['result']['access_token'] = $result['result']['oauth_token'];
                }
                if (isset($result['result']['access_token'])) {
                    $result['result']['access_secret'] = isset($result['result']['oauth_token_secret']) ? $result['result']['oauth_token_secret'] : '';
                    $result['result']['expires_in'] = isset($result['result']['expires_in']) ? $result['result']['expires_in'] : 0;
                    $service_user_id = isset($result['result']['user_id']) ? $result['result']['user_id'] : false;
                }
                if (isset($service_user_id)) {
                    $connection = [
                        'service_id' => $service_id,
                        'user_id' => $user_id,
                        'access_token' => $result['result']['access_token'],
                        'access_token_secret' => $result['result']['access_secret'],
                        'data' => $service_user_id,
                        'date_end' => date(UsersModel::DB_DATE_FORMAT, time() + $result['result']['expires_in']),
                    ];
                    $this->Users_connections_model->saveConnection(null, $connection);
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('please_set_email', UsersConnectionsModel::MODULE_GID));
                }
            }
        }

        $services = $this->Social_networking_services_model->getServicesList(null, ['where' => ['oauth_status' => 1]]);
        $connections = $this->Users_connections_model->getConnectionsUserId($user_id, $services);
        $this->view->assign("connections", $connections);
        $this->view->render('add_social_account');
    }

    public function oauthLogin($service_id = false, $user_type = false, $service_user_id = false)
    {
        $this->load->model([
            'social_networking/models/Social_networking_services_model',
            'social_networking/models/Social_networking_connections_model',
            'Users_connections_model', 'Users_model'
        ]);
        $service = $this->Social_networking_services_model->getServiceById($service_id);
        // Проверка подключения
        if ($service['oauth_version'] == 2) {
            $result = $this->Social_networking_connections_model->checkOauth2Connection($service, site_url('users_connections/oauth_login/' . $service_id . '/' . $user_type));
        } else {
            $result = $this->Social_networking_connections_model->checkOauthConnection($service, site_url('users_connections/oauth_login/' . $service_id . '/' . $user_type));
        }

        // Авторизуем или посылаем на авторизацию
        if ($result['result']) {
            // Если получен ключ ответа
            if (isset($result['result']['oauth_token'])) {
                $result['result']['access_token'] = $result['result']['oauth_token'];
            }
            if (isset($result['result']['access_token'])) {
                $result['result']['access_secret'] = isset($result['result']['oauth_token_secret']) ? $result['result']['oauth_token_secret'] : '';
                $result['result']['expires_in'] = isset($result['result']['expires_in']) ? $result['result']['expires_in'] : 0;
                $user_id = $this->session->userdata('user_id');
                $service_user_id = isset($result['result']['user_id']) ? $result['result']['user_id'] : false;
                $service_user_fname = '';
                $service_user_sname = '';
                $service_user_email = $result['result']['email'];
                $namespace = NS_MODULES . 'social_networking\\models\\services\\';
                $service_model = $namespace . ucfirst($service['gid']) . 'ServiceModel';
                if (class_exists($service_model)) {
                    $this->service = new $service_model();
                    if (method_exists($this->service, 'getUserData')) {
                        $user_data = $this->service->getUserData($service_user_id, $result['result']['access_token'], !empty($result['result']['access_secret']) ? $result['result']['access_secret'] : $service['app_secret']);
                        if (($user_data) && isset($user_data['id'])) {
                            $service_user_id = $user_data['id'];
                            $service_user_fname = $user_data['fname'];
                            $service_user_sname = $user_data['sname'];
                            $service_user_email = isset($user_data['email']) ? $user_data['email'] : $service_user_email;
                            $user_data['birth_date'] = empty($user_data['birth_date']) ?
                                UsersModel::getDefaultDateByYear($this->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min')) : $user_data['birth_date'];
                        }
                    } elseif ($result['result']['user_data']) {
                        $service_user_id = $result['result']['user_data']['id'];
                        $service_user_fname = $result['result']['user_data']['fname'];
                        $service_user_sname = $result['result']['user_data']['sname'];
                        $service_user_email = isset($result['result']['user_data']['email']) ? $result['result']['user_data']['email'] : $service_user_email;
                        $user_data['birth_date'] = empty($user_data['birth_date']) ?
                                UsersModel::getDefaultDateByYear($this->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min')) : $user_data['birth_date'];
                    }
                }

                if ($service_user_id) {
                    $connection = $this->Users_connections_model->getConnectionByData($service_id, $service_user_id);
                    if ($connection && isset($connection['id'])) {
                        $this->Users_connections_model->deleteConnection($connection['id']);
                        $user_id = $connection['user_id'];
                    } else {
                        if (!empty($_ENV['DEMO_MODE'])) {
                            // TODO: вынести в отдельный метод
                            $lang_id = $this->pg_language->current_lang_id;
                            $this->load->model('users/models/Groups_model');
                            $group_id = $this->Groups_model->getDefaultGroupId();

                            $user_id = $this->Users_model->saveUser(null, [
                                'fname' => $service_user_fname,
                                'sname' => $service_user_sname,
                                'nickname' => $service_user_fname . $service_user_sname,
                                'email' => $service_user_email,
                                'birth_date' => UsersModel::getDefaultDateByYear($this->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min')),
                                'confirm' => 1,
                                'user_type' => 'male',
                                'lang_id' => $lang_id,
                                'group_id' => $group_id,
                                'approved' => (intval($this->pg_module->get_module_config('users', 'user_approve')) ? 0 : 1),
                            ]);

                            $this->load->model("users/models/Auth_model");
                            $auth_data = $this->Auth_model->login($user_id);
                            if (!empty($auth_data["errors"])) {
                                $this->system_messages->addMessage(View::MSG_ERROR, $auth_data["errors"]);
                                $redirect_url = site_url();

                                if (!empty($_ENV['DEMO_MODE'])) {
                                    $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
                                }

                                redirect($redirect_url);
                            } else {
                                $connection = [
                                    'service_id' => $service_id,
                                    'user_id' => $user_id,
                                    'access_token' => $result['result']['access_token'],
                                    'access_token_secret' => $result['result']['access_secret'],
                                    'data' => $service_user_id,
                                    'date_end' => date(UsersModel::DB_DATE_FORMAT, time() + $result['result']['expires_in']),
                                ];
                                $this->Users_connections_model->saveConnection(null, $connection);
                                $this->system_messages->addMessage(View::MSG_SUCCESS, l('please_set_email', UsersConnectionsModel::MODULE_GID));

                                if (!empty($_ENV['DEMO_MODE'])) {
                                    $redirect_url = str_replace('/dating/', '/demo/', site_url() . '?path=users/search');
                                } else {
                                    $redirect_url = site_url("users/search");
                                }

                                redirect($redirect_url);
                            }
                        } else {
                            $is_user_email = $this->Users_connections_model->isUserEmail($service_user_email);
                            if ($is_user_email === true) {
                                $this->system_messages->addMessage(View::MSG_INFO, l('error_email', UsersConnectionsModel::MODULE_GID));
                            }
                            $this->load->model('Properties_model');
                            $this->view->assign('user_type', $this->Properties_model->getProperty('user_type'));
                            $this->view->assign('looking_user_type', $this->Properties_model->getProperty('looking_user_type'));
                            $this->view->assign('service_id', $service_id);
                            $this->view->assign('service_name', $service['name']);
                            $this->view->assign('access_token', $result['result']['access_token']);
                            $this->view->assign('access_token_secret', $result['result']['access_secret']);
                            $this->view->assign('date_end', date("Y-m-d H:i:s", time() + $result['result']['expires_in']));
                            $this->view->assign('service_user_id', $service_user_id);
                            $this->view->assign('service_user_fname', $service_user_fname);
                            $this->view->assign('service_user_sname', $service_user_sname);
                            $this->view->assign('service_user_email', $service_user_email);
                            $this->view->assign('is_user_email', $is_user_email);
                            $this->view->assign('data', $user_data);

                            $age_min = $this->pg_module->get_module_config('users', 'age_min');
                            $age_max = $this->pg_module->get_module_config('users', 'age_max');
                            $this->view->assign('age_min', $age_min);
                            $this->view->assign('age_max', $age_max);

                            $this->view->render('oauth_usertype');
                            exit;
                        }
                    }
                    $this->load->model("users/models/Auth_model");
                    $auth_data = $this->Auth_model->updateUserSessionData($user_id);
                    $this->Users_model->updateOnlineStatus($user_id, 1);
                    if (!empty($auth_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $auth_data["errors"]);
                        $redirect_url = site_url();

                        if (!empty($_ENV['DEMO_MODE'])) {
                            $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
                        }

                        redirect($redirect_url);
                    } else {
                        $connection = [
                            'service_id' => $service_id,
                            'user_id' => $user_id,
                            'access_token' => $result['result']['access_token'],
                            'access_token_secret' => $result['result']['access_secret'],
                            'data' => $service_user_id,
                            'date_end' => date("Y-m-d H:i:s", time() + $result['result']['expires_in']),
                        ];
                        $this->Users_connections_model->saveConnection(null, $connection);

                        if (!empty($_ENV['DEMO_MODE'])) {
                            $redirect_url = str_replace('/dating/', '/demo/', site_url() . '?path=users/search');
                        } else {
                            $redirect_url = site_url("users/search");
                        }

                        redirect($redirect_url);
                    }
                }
            }
        }
        if ($result['error']) {
            $this->system_messages->addMessage(View::MSG_ERROR, $result['error']);
        }

        $redirect_url = site_url();

        if (!empty($_ENV['DEMO_MODE'])) {
            $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
        }

        redirect($redirect_url);
    }

    public function oauthRegister()
    {
        $post_data = [
            'service_id' => $this->input->post('service_id', true),
            'access_token' => $this->input->post('access_token', false),
            'access_token_secret' => $this->input->post('access_token_secret', false),
            'date_end' => $this->input->post('date_end', false),
            'service_user_id' => $this->input->post('service_user_id', false),
            'service_user_fname' => $this->input->post('service_user_fname', false),
            'service_user_sname' => $this->input->post('service_user_sname', false),
            'service_user_email' => $this->input->post('service_user_email', false),
            'service_birth_date' => $this->input->post('birth_date', true),
            'user_type' => $this->input->post('user_type', true),
            'looking_user_type' => $this->input->post('looking_user_type', true)
        ];

        $this->load->model('Users_connections_model');
        $validate = $this->Users_connections_model->validateUser($post_data);

        if (!empty($validate['errors'])) {
            // TODO: user registration by social
            $this->load->library('Analytics');
            $this->analytics->track('user_social_register_fail', ['source' => 'social', 'controller' => 'users_connections', 'service' => $validate['data']['service']]);
            $this->system_messages->addMessage(View::MSG_ERROR, $validate["errors"]);
        } else {
            $user_id = $this->Users_model->saveUser(null, $validate['data']['user']);

            $connection = $validate['data']['connection'];
            $connection['user_id'] = $user_id;
            $this->Users_connections_model->saveConnection(null, $connection);

            $this->system_messages->addMessage(View::MSG_SUCCESS, l('please_set_email', UsersConnectionsModel::MODULE_GID));
            $this->load->model("users/models/Auth_model");
            $this->Auth_model->updateUserSessionData($user_id);
            $this->Users_model->updateOnlineStatus($user_id, 1);

            $this->load->library('Analytics');
            $event = $this->analytics->getEvent('registration', 'social_connection', 'user');
            $this->analytics->track($event);

            if (!empty($_ENV['DEMO_MODE'])) {
                $redirect_url = str_replace('/dating/', '/demo/', site_url() . '?path=users_connections/joinAccount');
            } else {
                $redirect_url = site_url() . "users_connections/joinAccount";
            }

            redirect($redirect_url);
        }

        $redirect_url = site_url();
        if (!empty($_ENV['DEMO_MODE'])) {
            $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
        }

        redirect($redirect_url);
    }

    public function oauthLink($service_id = false)
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            // Грузим модели
            $this->load->model('social_networking/models/Social_networking_services_model');
            $this->load->model('social_networking/models/Social_networking_connections_model');
            $this->load->model('users_connections/models/Users_connections_model');
            // Данные
            $service = $this->Social_networking_services_model->getServiceById($service_id);
            // Проверка подключения
            if ($service['oauth_version'] == 2) {
                $result = $this->Social_networking_connections_model->checkOauth2Connection($service, site_url('users_connections/oauth_link/' . $service_id));
            } else {
                $result = $this->Social_networking_connections_model->checkOauthConnection($service, site_url('users_connections/oauth_link/' . $service_id));
            }
            // Авторизуем или посылаем на авторизацию
            if ($result['result']) {
                // Если получен ключ ответа
                if (isset($result['result']['oauth_token'])) {
                    $result['result']['access_token'] = $result['result']['oauth_token'];
                }
                if (isset($result['result']['access_token'])) {
                    $result['result']['access_secret'] = isset($result['result']['oauth_token_secret']) ? $result['result']['oauth_token_secret'] : '';
                    $result['result']['expires_in'] = isset($result['result']['expires_in']) ? $result['result']['expires_in'] : 0;
                    $service_user_id = isset($result['result']['user_id']) ? $result['result']['user_id'] : false;
                    $namespace = NS_MODULES . 'social_networking\\models\\services\\';
                    $service_model = $namespace . ucfirst($service['gid']) . 'ServiceModel';
                    if (class_exists($service_model)) {
                        $this->service = new $service_model();
                        if (method_exists($this->service, 'getUserData')) {
                            $user_data = $this->service->getUserData($service_user_id, $result['result']['access_token'], $result['result']['access_secret']);
                            if (($user_data) && isset($user_data['id'])) {
                                $service_user_id = $user_data['id'];
                            }
                        }
                    }
                    if ($service_user_id) {
                        $connection = $this->Users_connections_model->getConnectionByData($service_id, $service_user_id);
                        if ($connection && isset($connection['id'])) {
                            $this->Users_connections_model->deleteConnection($connection['id']);
                        }
                        $connection = [
                            'service_id' => $service_id,
                            'user_id' => $user_id,
                            'access_token' => $result['result']['access_token'],
                            'access_token_secret' => $result['result']['access_secret'],
                            'data' => $service_user_id,
                            'date_end' => date("Y-m-d H:i:s", time() + $result['result']['expires_in']),
                        ];
                        $this->Users_connections_model->saveConnection(null, $connection);
                        if (isset($service['name'])) {
                            $this->system_messages->addMessage(View::MSG_SUCCESS, l('account_link_to', UsersConnectionsModel::MODULE_GID) . ' ' . $service['name']);
                        }
                        if (!empty($_ENV['DEMO_MODE'])) {
                            $redirect_url = str_replace('/dating/', '/demo/', site_url() . '?path=users/settings');
                        } else {
                            $redirect_url = site_url("users/settings");
                        }

                        redirect($redirect_url);
                    }
                }
            }
            if ($result['error']) {
                $this->system_messages->addMessage(View::MSG_ERROR, $result['error']);
            }
        }

        $redirect_url = site_url();

        if (!empty($_ENV['DEMO_MODE'])) {
            $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
        }

        redirect($redirect_url);
    }

    public function oauthUnlink($service_id = false)
    {
        // Грузим модели
        $this->load->model('social_networking/models/Social_networking_services_model');
        $this->load->model('users_connections/models/Users_connections_model');
        $user_id = $this->session->userdata('user_id');
        $service = $this->Social_networking_services_model->getServiceById($service_id);
        if ($user_id && $service) {
            $connection = $this->Users_connections_model->getConnectionByUserId($service_id, $user_id);
            if ($connection && isset($connection['id'])) {
                $this->Users_connections_model->deleteConnection($connection['id']);
                if (isset($service['name'])) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('account_unlink_from', UsersConnectionsModel::MODULE_GID) . ' ' . $service['name']);
                }

                if (!empty($_ENV['DEMO_MODE'])) {
                    $redirect_url = str_replace('/dating/', '/demo/', site_url() . '?path=users/settings');
                } else {
                    $redirect_url = site_url("users/settings");
                }

                redirect($redirect_url);
            }
        }

        $redirect_url = site_url();

        if (!empty($_ENV['DEMO_MODE'])) {
            $redirect_url = str_replace('/dating/', '/demo/', $redirect_url);
        }

        redirect($redirect_url);
    }
}
