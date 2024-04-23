<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\helpers {

    use Pg\modules\social_networking\models\SocialNetworkingModel;

    if (!function_exists('signHmacSha1')) {
        function signHmacSha1($method, $baseurl, $secret, array $parameters)
        {
            $data = $method . '&';
            $data .= urlencode($baseurl) . '&';
            $oauth = '';
            ksort($parameters);
            if (!array_key_exists('oauth_token_secret', $parameters)) {
                $parameters['oauth_token_secret'] = '';
            }
            foreach ($parameters as $key => $value) {
                if (strtolower($key) != 'oauth_token_secret') {
                    $oauth .= "&{$key}={$value}";
                }
            }
            $data .= urlencode(substr($oauth, 1));
            $secret .= '&' . $parameters['oauth_token_secret'];

            return base64_encode(hash_hmac('sha1', $data, $secret, true));
        }
    }

    if (!function_exists('signRsaSha1')) {
        function signRsaSha1($method, $baseurl, $certfile, array $parameters)
        {
            $fp = fopen($certfile, "r");
            $private = fread($fp, 8192);
            fclose($fp);
            $data = $method . '&';
            $data .= urlencode($baseurl) . '&';
            $oauth = '';
            ksort($parameters);
            foreach ($parameters as $key => $value) {
                $oauth .= "&{$key}={$value}";
            }
            $data .= urlencode(substr($oauth, 1));
            $keyid = openssl_get_privatekey($private);
            openssl_sign($data, $signature, $keyid);
            openssl_free_key($keyid);

            return base64_encode($signature);
        }
    }

    if (!function_exists('buildAuthString')) {
        function buildAuthString(array $authparams)
        {
            $header = "Authorization: OAuth ";
            $auth = '';
            foreach ($authparams as $key => $value) {
                if ($key != 'oauth_token_secret') {
                    $auth .= ", {$key}=\"{$value}\"";
                }
            }

            return $header . substr($auth, 2) . "\r\n";
        }
    }

    if (!function_exists('buildAuthArray')) {
        function buildAuthArray($baseurl, $key, $secret, $extra = [], $method = 'GET', $algo = SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1)
        {
            $auth['oauth_consumer_key'] = $key;
            $auth['oauth_signature_method'] = $algo;
            $auth['oauth_timestamp'] = time();
            $auth['oauth_nonce'] = md5(uniqid(rand(), true));
            $auth['oauth_version'] = '1.0';
            $auth = array_merge($auth, $extra);
            $urlsegs = explode("?", $baseurl);
            $baseurl = $urlsegs[0];
            $signing = $auth;
            if (count($urlsegs) > 1) {
                preg_match_all("/([\w\-]+)\=([\w\d\-\%\.\$\+\*]+)\&?/", $urlsegs[1], $matches);
                $signing = $signing + array_combine($matches[1], $matches[2]);
            }
            if (strtoupper($algo) == SocialNetworkingModel::OAUTH_ALGORITHM_HMAC_SHA1) {
                $auth['oauth_signature'] = sign_hmac_sha1($method, $baseurl, $secret, $signing);
            } elseif (strtoupper($algo) == SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1) {
                $auth['oauth_signature'] = sign_rsa_sha1($method, $baseurl, $secret, $signing);
            }
            $auth['oauth_signature'] = urlencode($auth['oauth_signature']);

            return $auth;
        }
    }

    if (!function_exists('getAuthHeader')) {
        function getAuthHeader($baseurl, $key, $secret, $extra = [], $method = 'GET', $algo = SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1)
        {
            $auth = build_auth_array($baseurl, $key, $secret, $extra, $method, $algo);

            return build_auth_string($auth);
        }
    }

    if (!function_exists('showSocialNetworksHead')) {
        function showSocialNetworksHead()
        {
            $ci = &get_instance();
            $ci->load->model('social_networking/models/Social_networking_widgets_model');

            return $ci->Social_networking_widgets_model->get_header();
        }
    }

    if (!function_exists('showSocialNetworksLike')) {
        function showSocialNetworksLike()
        {

            $ci = &get_instance();
            $ci->load->model('social_networking/models/Social_networking_pages_model');
            $page_data = $ci->Social_networking_pages_model->get_pages_list(['id' => 'desc'], ['where' => ['controller' => $ci->router->class, 'method' => $ci->router->method]]);
            if (is_array($page_data) && count($page_data) > 0) {
                foreach ($page_data as $id => $value) {
                    $page_data = $value;
                    break;
                }
            }
            if ($page_data) {
                $ci->load->model('social_networking/models/Social_networking_widgets_model');
                $like = $ci->Social_networking_widgets_model->getWidgets('like', isset($page_data['data']['like']) ? $page_data['data']['like'] : []);

                $ci->view->assign('like', $like);
                $ci->view->render('like', 'user', 'social_networking');
            }
        }
    }

    if (!function_exists('showSocialNetworksShare')) {
        function showSocialNetworksShare()
        {
            $ci = &get_instance();
            $ci->load->model('social_networking/models/Social_networking_pages_model');
            $page_data = $ci->Social_networking_pages_model->get_pages_list(['id' => 'desc'], ['where' => ['controller' => $ci->router->class, 'method' => $ci->router->method]]);
            if (is_array($page_data) && count($page_data) > 0) {
                foreach ($page_data as $id => $value) {
                    $page_data = $value;
                    break;
                }
            }
            if ($page_data) {
                $ci->load->model('social_networking/models/Social_networking_widgets_model');
                $share = $ci->Social_networking_widgets_model->get_widgets('share', isset($page_data['data']['share']) ? $page_data['data']['share'] : []);
                $ci->view->assign('share', $share);
                $ci->view->render('share', 'user', 'social_networking');
            }
        }
    }

    if (!function_exists('showSocialNetworksComments')) {
        function showSocialNetworksComments()
        {
            $ci = &get_instance();
            $ci->load->model('social_networking/models/Social_networking_pages_model');
            $page_data = $ci->Social_networking_pages_model->get_pages_list(['id' => 'desc'], ['where' => ['controller' => $ci->router->class, 'method' => $ci->router->method]]);
            if (is_array($page_data) && count($page_data) > 0) {
                foreach ($page_data as $id => $value) {
                    $page_data = $value;
                    break;
                }
            }
            if ($page_data) {
                $ci->load->model('social_networking/models/Social_networking_widgets_model');
                $comments = $ci->Social_networking_widgets_model->get_widgets('comments', isset($page_data['data']['comments']) ? $page_data['data']['comments'] : [], 'column');
                $ci->view->assign('comments', $comments);
                $ci->view->render('comments', 'user', 'social_networking');
            }
        }
    }

}

namespace {

    use Pg\modules\social_networking\models\SocialNetworkingModel;

    if (!function_exists('sign_hmac_sha1')) {
        function sign_hmac_sha1($method, $baseurl, $secret, array $parameters)
        {
            return Pg\modules\social_networking\helpers\signHmacSha1($method, $baseurl, $secret, $parameters);
        }
    }

    if (!function_exists('sign_rsa_sha1')) {
        function sign_rsa_sha1($method, $baseurl, $certfile, array $parameters)
        {
            return Pg\modules\social_networking\helpers\signRsaSha1($method, $baseurl, $certfile, $parameters);
        }
    }

    if (!function_exists('build_auth_string')) {
        function build_auth_string(array $authparams)
        {
            return Pg\modules\social_networking\helpers\buildAuthString($authparams);
        }
    }

    if (!function_exists('build_auth_array')) {
        function build_auth_array($baseurl, $key, $secret, $extra = [], $method = 'GET', $algo = SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1)
        {
            return Pg\modules\social_networking\helpers\buildAuthArray($baseurl, $key, $secret, $extra, $method, $algo);
        }
    }

    if (!function_exists('get_auth_header')) {
        function get_auth_header($baseurl, $key, $secret, $extra = [], $method = 'GET', $algo = SocialNetworkingModel::OAUTH_ALGORITHM_RSA_SHA1)
        {
            return Pg\modules\social_networking\helpers\getAuthHeader($baseurl, $key, $secret, $extra, $method, $algo);
        }
    }

    if (!function_exists('show_social_networks_head')) {
        function show_social_networks_head()
        {
            return Pg\modules\social_networking\helpers\showSocialNetworksHead();
        }
    }

    if (!function_exists('show_social_networks_like')) {
        function show_social_networks_like()
        {
            return Pg\modules\social_networking\helpers\showSocialNetworksLike();
        }
    }

    if (!function_exists('show_social_networks_share')) {
        function show_social_networks_share()
        {
            return Pg\modules\social_networking\helpers\showSocialNetworksShare();
        }
    }

    if (!function_exists('show_social_networks_comments')) {
        function show_social_networks_comments()
        {
            return Pg\modules\social_networking\helpers\showSocialNetworksComments();
        }
    }

}
