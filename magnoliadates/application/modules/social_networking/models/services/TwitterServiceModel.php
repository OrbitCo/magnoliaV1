<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\services;

use Pg\modules\social_networking\models\SocialNetworkingModel;

// РµСЃР»Рё twitteroauth РїРѕРґРєР»СЋС‡РёР»Рё РЅРµ С‡РµСЂРµР· РєРѕРјРїРѕР·РµСЂ
//require_once SITE_PATH . SITE_SUBFOLDER . "application/libraries/twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Social networking twitter service model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class TwitterServiceModel extends \Model
{
    const SCHEME = 'https';
    const HOST = 'api.twitter.com';
    const AUTHORIZE_URI = '/oauth/authorize';
    const REQUEST_URI = '/oauth/request_token';
    const ACCESS_URI = '/oauth/access_token';
    const CREDENTIALS = '/1.1/account/verify_credentials.json';

    private $consumer = false;

    public function getUserInfo($data)
    {
        $token = (!$data['oauth_token']) ? $_GET['oauth_token'] : $data['oauth_token'];
        $verifier = (!$data['oauth_verifier']) ? $_GET['oauth_verifier'] : $data['oauth_verifier'];

        if ($token === false && $verifier === false) {
            $uri = $_SERVER['REQUEST_URI'];
            $uriparts = explode('?', $uri);
            $authfields = [];
            parse_str($uriparts[1], $authfields);
            $token = $authfields['oauth_token'];
            $verifier = $authfields['oauth_verifier'];
        }
        
        $connection = new TwitterOAuth($this->consumer['key'], $this->consumer['secret'], $token, $data['oauth_token_secret']);
        $user_data = (array)$connection->get("account/verify_credentials", array('include_email' => 'true'));

        $data['user_data']['id'] = $user_data['id'];
        $data['user_data']['nickname'] = $user_data['screen_name'];
        $data['user_data']['location_str'] = $user_data['location'];
        $name = explode(' ', $user_data['name']);
        $data['user_data']['fname'] = $name[0];
        $data['user_data']['sname'] = $name[1];
        $data['user_data']['email'] = $user_data['email'];
      
        return $data;
    }
    
    public function oauth($params)
    {
        if (!array_key_exists('method', $params)) {
            $params['method'] = 'GET';
        }
        if (!array_key_exists('algorithm', $params)) {
            $params['algorithm'] = SocialNetworkingModel::OAUTH_ALGORITHM_HMAC_SHA1;
        }
        $this->consumer = $params;
    }

    public function getRequestToken($callback)
    {
        $baseurl = self::SCHEME . '://' . self::HOST . self::REQUEST_URI;
        $auth = build_auth_array(
            $baseurl,
            $this->consumer['key'],
            $this->consumer['secret'],
            [
            'oauth_callback' => urlencode($callback),
            ],
            $this->consumer['method'],
            $this->consumer['algorithm']
        );

        $str = "";
        foreach ($auth as $key => $value) {
            $str .= ",{$key}=\"{$value}\"";
        }
        $str = 'Authorization: OAuth ' . substr($str, 1);
        $response = $this->connect($baseurl, $str);
        $resarray = [];
        parse_str($response, $resarray);
        $redirect = self::SCHEME . '://' . self::HOST . self::AUTHORIZE_URI . "?oauth_token={$resarray['oauth_token']}";
       
        if ($this->consumer['algorithm'] == SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1) {
            return $redirect;
        } else {
            return [
                'token_secret' => $resarray['oauth_token_secret'],
                'redirect'     => $redirect,
            ];
        }
    }

    public function getAccessToken($token = false, $secret = false, $verifier = false)
    {
        if ($token === false && isset($_GET['oauth_token'])) {
            $token = $_GET['oauth_token'];
        }
        if ($verifier === false && isset($_GET['oauth_verifier'])) {
            $verifier = $_GET['oauth_verifier'];
        }
        if ($token === false && $verifier === false) {
            $uri = $_SERVER['REQUEST_URI'];
            $uriparts = explode('?', $uri);
            $authfields = [];
            parse_str($uriparts[1], $authfields);
            $token = $authfields['oauth_token'];
            $verifier = $authfields['oauth_verifier'];
        }
                
        $connection = new TwitterOAuth($this->consumer['key'], $this->consumer['secret']);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $verifier, "oauth_token" => $token]);
        
        return $access_token;
    }

    private function connect($url, $auth, $is_debug = false, $oauth_verifier = "")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [$auth]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
