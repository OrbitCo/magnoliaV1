<?php

declare(strict_types=1);
namespace Pg\modules\mobile\controllers;

/**
 * Mobile version controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Mobile extends \Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mobile_model');
    }
    
    /**
     * Authorize user by oauth
     * TODO: remove it from mobile module
     *
     * @param string $service_id service identifier
     * @param string $redirect   redirect url
     *
     * @return void
     */
    public function oauthLogin($service_id, $redirect = null)
    {
        $user_type = 0;

        if ($redirect) {
            $redirect = base64_decode($redirect);
        } else {
            $redirect = $this->input->get('redirect');
        }

        // Грузим модели
        $this->load->model('social_networking/models/Social_networking_services_model');
        $this->load->model('social_networking/models/Social_networking_connections_model');
        $this->load->model('Users_connections_model');
        // Данные
        $service = $this->Social_networking_services_model->get_service_by_id($service_id);

        // Проверка подключения
        if ($service['oauth_version'] == 2) {
            $method = '_check_oauth2_connection';
        } else {
            $method = '_check_oauth_connection';
        }
        $result = $this->Social_networking_connections_model->{$method}(
          $service,
            site_url('mobile/oauth_login/' . $service_id . '/' . base64_encode($redirect))
        );

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
                $service_user_email = '';
                $service_model = $service['gid'] . 'ServiceModel';
                $service_file = APPPATH . 'modules/social_networking/models/services/' . $service_model . '.php';
                if (file_exists($service_file)) {
                    include_once $service_file;
                    $this->service = new $service_model();
                    if (method_exists($this->service, 'get_user_data')) {
                        $user_data = $this->service->get_user_data(
                          $service_user_id,
                            $result['result']['access_token'],
                            $result['result']['access_secret']
                        );
                        if (($user_data) && isset($user_data['id'])) {
                            $service_user_id = $user_data['id'];
                            $service_user_fname = $user_data['fname'];
                            $service_user_sname = $user_data['sname'];
                            $service_user_email = $user_data['email'];
                        }
                    }
                }

                if ($service_user_id) {
                    $connection = $this->Users_connections_model->get_connection_by_data($service_id, $service_user_id);

                    if ($connection && isset($connection['id'])) {
                        $this->Users_connections_model->delete_connection($connection['id']);
                        $user_id = $connection['user_id'];

                        $this->load->model("users/models/Auth_model");
                        $auth_data = $this->Auth_model->login($user_id);
                        if (empty($auth_data["errors"])) {
                            $connection = [
                                'service_id'          => $service_id,
                                'user_id'             => $user_id,
                                'access_token'        => $result['result']['access_token'],
                                'access_token_secret' => $result['result']['access_secret'],
                                'data'                => $service_user_id,
                                'date_end'            => date('Y-m-d H:i:s', time() + $result['result']['expires_in']),
                            ];
                            $this->Users_connections_model->save_connection(null, $connection);
                            $user_type = $auth_data['user_data']['user_type'];
                        }
                    }
                }
            }
        }

        redirect($redirect . '#!/account/oauth/' . $service_id . '/' . intval($service_user_id) . '/' . ($user_type ?: 0));
    }
    
    /*
    //LINK to get tokens:    https://accounts.google.com/o/oauth2/auth?client_id=293520605434-7j7noghqof6d25lk7mm3ngvqfr4fiuo9.apps.googleusercontent.com&response_type=code&redirect_uri=http://androidapp.pilotteam.net/mobile/oauthCallback&scope=https://www.googleapis.com/auth/androidpublisher&approval_prompt=force&access_type=offline
    */
    
    public function oauthCallback()
    {
        
        if (!isset($_GET['code'])) {
            return;
        }
        
        $client_id = $this->pg_module->get_module_config('mobile', 'client_id');
        $client_secret = $this->pg_module->get_module_config('mobile', 'client_secret');
        $redirect_uri = SITE_SERVER . SITE_SUBFOLDER . "mobile/oauthCallback";
        
        $result = false;

        $params = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => $redirect_uri,
            'grant_type'    => 'authorization_code',
            'code'          => $_GET['code'],
        ];

        $url = 'https://accounts.google.com/o/oauth2/token';
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        
        $token_info = json_decode($result, true);
        
        $this->load->model('Mobile_model');
        $is_updated = $this->Mobile_model->setUpdateTokenInfo($token_info);
        
        if ($is_updated) {
            echo "Token was successfully updated!";
        } else {
            echo "Something went wrong, token could not be updated. Please try again.";
        }
    }
    
    public function setFcmRegistrationToken()
    {
        $user_id = (int)$this->session->userdata('user_id');
        $device_id = filter_input(INPUT_POST, 'device_id');
        $reg_id = filter_input(INPUT_POST, 'registration_id');
        if (empty($reg_id)) {
            return;
        }
        $this->Mobile_model->setFcmRegistrationId($user_id, $reg_id, $device_id);
    }

    public function deleteFcmRegistrationToken()
    {
        $user_id = (int)filter_input(INPUT_POST, 'user_id');
        $device_id = filter_input(INPUT_POST, 'device_id');
        $registration_id = filter_input(INPUT_POST, 'registration_id');
        if (empty($user_id)) {
            return;
        }
        $this->Mobile_model->deleteFcmRegistrationId($user_id, $device_id, $registration_id);
    }
}
