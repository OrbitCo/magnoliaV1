<?php
declare(strict_types=1);

namespace Pg\modules\social_networking\models\services;

use Pg\modules\users\models\UsersModel;

/**
 * Social networking facebook service model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class FacebookServiceModel extends \Model
{

    const SERVICE = 'facebook.com';

    public $api_url = 'https://graph.facebook.com/';

    public function getUserData($user_id = 0, $access_key = '', $secret)
    {
        $this->ci->load->model('Social_networking_connections_model');
        $params = [
            'access_token' => $access_key,
            'fields' => 'id,first_name,last_name,email,gender,picture',
            'appsecret_proof' => hash_hmac("sha256", $access_key, $secret),
        ];
        $response = $this->ci->Social_networking_connections_model->curlGet($this->api_url . 'me', $params);
        $user_data = (array) @json_decode($response);

        $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
        $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
        $user_age = ($user_data["birthday"]) ? UsersModel::getUserAge($user_data["birthday"]) : 0;

        if (isset($user_data['id'])) {
            $data = [
                'id' => $user_data['id'],
            ];

            if (!empty($user_data['first_name'])) {
                $data['fname'] = $user_data['first_name'];
            }

            if (!empty($user_data['last_name'])) {
                $data['sname'] = $user_data['last_name'];
            }

            if ($user_age != 0) {
                $data['birth_date'] = strftime(UsersModel::HIDDEN_DATE_FORMAT, strtotime($user_data["birthday"]));
            }

            if ($user_data['gender']) {
                $this->ci->load->model('Users_model');
                $user_types = $this->ci->Users_model->getUserTypes();
                $gender = strtolower($user_data['gender']);
                foreach ($user_types as $user_type) {
                    if (strtolower($user_type) == $gender) {
                        $data['user_type'] = $user_type;
                        break;
                    }
                }
            }

            if (!empty($user_data['email'])) {
                $data['email'] = $user_data['email'];
            }

            if (!empty($user_data['picture'])) {
                $data['picture'] = $user_data['picture'];
            }

            if ($user_age < $age_min && $user_age) {
                $error = str_replace(['%site%', '%age%'], [self::SERVICE, $age_min], l('error_age_min', 'users_connections'));
                $data['error'] = $error;
            } elseif ($user_age > $age_max && $user_age) {
                $error = str_replace(['%site%', '%age%'], [self::SERVICE, $age_max], l('error_age_max', 'users_connections'));
                $data['error'] = $error;
            }

            return $data;
        }

        return false;
    }

    /**
     * Return auth parameters
     *
     * @param array  $service_data service data
     * @param string $redirect     redirect urk
     */
    public function getAuthParams($service_data = [], $redirect)
    {
        $app_key = isset($service_data['app_key']) ? $service_data['app_key'] : false;
        $params = [
            'client_id' => $app_key,
            'redirect_uri' => $redirect,
            'response_type' => 'code',
            'scope' => 'email',
        ];
        ksort($params);

        return $params;
    }
}
