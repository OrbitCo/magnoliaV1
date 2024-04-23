<?php

declare(strict_types=1);

namespace Pg\modules\social_networking\models\services;

use Pg\modules\users\models\UsersModel;

/**
 * Social networking vkontakte service model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class VkontakteServiceModel extends \Model
{
    const SERVICE = 'vk.com';
    public $api_url = 'https://api.vk.com/method/';
    private $user_type = [
        1 => 'female',
        2 => 'male'
    ];

    public function getUserData($user_id = 0, $access_key = '')
    {
        $this->ci->load->model('Social_networking_connections_model');
        $params   = [
            'access_key' => $access_key,
            'uid' => $user_id,
            'fields' => 'bdate,email,sex'
        ];
        $response = $this->ci->Social_networking_connections_model->curlGet($this->api_url . 'users.get', $params);
        $data     = @json_decode($response);
        $data     = isset($data->response[0]) ? (array) $data->response[0] : false;
        $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
        $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
        $user_age = ($data["bdate"]) ? UsersModel::getUserAge($data["bdate"]) : 0;
        if ($user_age < $age_min && $user_age) {
            $error = str_replace(['%site%', '%age%'], [self::SERVICE, $age_min], l('error_age_min', 'users_connections'));
            return ['error' => $error];
        } elseif ($user_age > $age_max && $user_age) {
            $error = str_replace(['%site%', '%age%'], [self::SERVICE, $age_max], l('error_age_max', 'users_connections'));
            return ['error' => $error];
        } else {
            if (isset($data['uid']) && isset($data['first_name']) && isset($data['last_name'])) {
                return [
                    'id' => $data['uid'],
                    'fname' => $data['first_name'],
                    'sname' => $data['last_name'],
                    'birth_date' => ($user_age != 0) ? strftime(UsersModel::HIDDEN_DATE_FORMAT, strtotime($data["bdate"])) : '',
                    'user_type' => ($data['sex'] != 0) ? $this->user_type[$data['sex']] : false
                ];
            }
        }
        return false;
    }
}
