<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models;

/**
 * Social networking connections model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SocialNetworkingConnectionsModel extends \Model
{
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->helper('social_networking');
    }

    public function curlPost($url, array $post = null, array $options = [])
    {
        if (function_exists('curl_init')) {
            $defaults = [
                CURLOPT_POST           => 1,
                CURLOPT_POSTFIELDS     => (string) http_build_query($post),
                CURLOPT_URL            => $url,
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 4,
                CURLOPT_SSL_VERIFYPEER => false,
            ];
            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            $result = curl_exec($ch);
            curl_close($ch);

            return $result;
        }
    }

    public function curlGet($url, array $get = null, array $options = [])
    {
        if (function_exists('curl_init')) {
            $defaults = [
                CURLOPT_URL => $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($get),
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 4,
                CURLOPT_SSL_VERIFYPEER => false,
            ];
            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
    }

    public function login($service_data = [], $redirect = '')
    {
        $return = ["result" => "", "error" => ""];
        // Данные
        $service_id = isset($service_data['id']) ? $service_data['id'] : false;
        if (isset($_GET['code'])) {
            if (isset($service_data['gid'])) {
                $namespace = NS_MODULES . 'social_networking\\models\\services\\';
                $service_model = $namespace . ucfirst($service_data['gid']) . 'ServiceModel';
                if (class_exists($service_model)) {
                    $service = new $service_model();
                    if (method_exists($service, 'getTokenParams')) {
                        $service_params = $service->getTokenParams($service_data, $redirect);
                    }
                }
            }
            if (!isset($service_params)) {
                $params = [
                    'client_id'     => isset($service_data['app_key']) ? $service_data['app_key'] : false,
                    'client_secret' => isset($service_data['app_secret']) ? $service_data['app_secret'] : false,
                    'code'          => $_GET['code'],
                    'redirect_uri'  => $redirect,
                ];
                ksort($params);
            } else {
                $params = $service_params;
                $params['code'] = $_GET['code'];
            }
            $res = $this->curl_post(isset($service_data['access_key_url']) ? $service_data['access_key_url'] : false, $params);
            $result = json_decode($res);
            if (!$result) {
                parse_str($res, $result);
            }
            $result = (array) $result;
            // Expires fix
            if (!isset($result['expires_in']) && isset($result['expires'])) {
                $result['expires_in'] = $result['expires'];
            }
            $return['result'] = $result;

            if (isset($result['error_description'])) {
                $return['error'] = $result['error_description'];
            }
            if (isset($result['error']->message)) {
                $return['error'] = $result['error']->message;
            }
        }

        return $return;
    }

    public function checkOauth2Connection($service_data = [], $redirect)
    {
        if (isset($service_data['gid'])) {
            $namespace = NS_MODULES . 'social_networking\\models\\services\\';
            $service_model = $namespace . ucfirst($service_data['gid']) . 'ServiceModel';
        } else {
            $service_model = false;
        }
        if ($service_model && class_exists($service_model)) {
            $service = new $service_model();

            if (method_exists($service, 'getAuthParams')) {
                $service_params = $service->getAuthParams($service_data, $redirect);
            }
        }
        $return = ["result" => "", "error" => ""];
        $app_key = isset($service_data['app_key']) ? $service_data['app_key'] : false;
        $service_id = isset($service_data['id']) ? $service_data['id'] : false;
        $login_result = (array) count($_GET) > 0 ? $this->login($service_data, $redirect) : ['result' => '', 'error' => ''];
        if ($login_result['error']) {
            return $login_result;
        }
        if (isset($login_result['result']['access_token'])) {
            return $login_result;
        }
        $link = isset($service_data['authorize_url']) ? $service_data['authorize_url'] : false;
        if (isset($service_params)) {
            $params = $service_params;
        } else {
            $params = [
                'client_id'     => $app_key,
                'redirect_uri'  => $redirect,
                'response_type' => 'code',
                'scope' => 'email'
            ];
            ksort($params);
        }
        $res = $this->curlGet($link, $params);
        $result = json_decode($res);
        if (isset($result->error_description)) {
            return ['result' => '', 'error' => $result->error_description];
        }
        if (isset($result->error->message)) {
            return ['result' => '', 'error' => $result->error->message];
        }
        if ($result == '') {
            $get = '';
            foreach ($params as $id => $value) {
                $get .= (strlen($get) == 0 ? '?' : '&') . $id . '=' . $value;
            }
            $link = $link . $get;
            redirect($link);
        }

        return $return;
    }

    public function checkOauthConnection($service_data = [], $redirect)
    {
        $return = ["result" => "", "error" => ""];
        $app_key = isset($service_data['app_key']) ? $service_data['app_key'] : false;
        $app_secret = isset($service_data['app_secret']) ? $service_data['app_secret'] : false;

        if (isset($service_data['gid'])) {
            $namespace = NS_MODULES . 'social_networking\\models\\services\\';
            $service_model = $namespace . ucfirst($service_data['gid']) . 'ServiceModel';
        } else {
            $service_model = false;
        }

        if ($service_model && class_exists($service_model)) {
            $service = new $service_model();
            $service->oauth(['key' => $app_key, 'secret' => $app_secret]);

         //  TODO - дополнить проверку, для твитера (иначе появляется ошибка)
         //  if ($this->ci->session->userdata($service_data['gid'] . '_token_secret') && isset($_GET['oauth_token'])) {

            if ($this->ci->session->userdata($service_data['gid'] . '_token_secret')) {
                $response = $service->getAccessToken(false, $this->ci->session->userdata($service_data['gid'] . '_token_secret'));
                $this->ci->session->unset_userdata($service_data['gid'] . '_token_secret');
                if (!isset($response['oauth_token_secret']) || $response['oauth_token_secret'] == '') {
                    $return['error'] = l('empty_application', 'social_networking');
                } else {
                    $return['result'] = (method_exists($service, 'getUserInfo')) ? $service->getUserInfo($response) : $response;
                }
            } else {
                $response = $service->getRequestToken($redirect);
                if (!isset($response['token_secret']) || $response['token_secret'] == '') {
                    $return['error'] = l('empty_application', 'social_networking');
                } else {
                    $this->ci->session->set_userdata($service_data['gid'] . '_token_secret', $response['token_secret']);
                    redirect($response['redirect']);
                }
            }
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_check_oauth2_connection' => 'checkOauth2Connection',
            '_check_oauth_connection' => 'checkOauthConnection',
            'curl_get' => 'curlGet',
            'curl_post' => 'curlPost',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
