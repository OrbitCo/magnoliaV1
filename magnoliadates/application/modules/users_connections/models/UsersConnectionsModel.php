<?php

declare(strict_types=1);

namespace Pg\modules\users_connections\models;

if (!defined('USER_CONNECTIONS_TABLE')) {
    define('USER_CONNECTIONS_TABLE', DB_PREFIX . 'user_connections');
}

/**
 * User connections(social networking) model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class UsersConnectionsModel extends \Model
{

    const MODULE_GID = 'users_connections';

    const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    public $fields_all = [
        'id',
        'user_id',
        'service_id',
        'access_token',
        'access_token_secret',
        'data',
        'date_end',
    ];

    public function saveConnection($connection_id = false, $data = [])
    {
        if (!$connection_id) {
            $this->ci->db->insert(USER_CONNECTIONS_TABLE, $data);
            $connection_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $connection_id);
            $this->ci->db->update(USER_CONNECTIONS_TABLE, $data);
        }

        return $connection_id;
    }
    
    /**
     * Connections data by user_id
     *
     * @param integer $user_id
     *
     * @return array
     */
    public function getDataByUserId($user_id)
    {
        $result = [];
        $data = $this->ci->db->select(implode(", ", $this->fields_all))
                                ->from(USER_CONNECTIONS_TABLE)
                                ->where(['user_id' => $user_id])
                                ->get()->result_array();
        if (!empty($data)) {
            $this->ci->load->model('social_networking/models/Social_networking_services_model');
            foreach ($data as $v) {
                $result[] = $this->ci->Social_networking_services_model->getServiceById($v['service_id']);
            }
        }
        return $result;
    }

    public function getConnectionByUserId($service_id = false, $user_id = false)
    {
        $data = [];
        $select_attrs = $this->fields_all;
        $this->ci->db->select(implode(", ", $select_attrs))->from(USER_CONNECTIONS_TABLE)->where(['service_id' => $service_id, 'user_id' => $user_id])->order_by('id ASC');
        $result = $this->ci->db->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    /**
     * Get connections by user ID
     *
     * @param integer $user_id
     * @param array $services
     *
     * @return array
     */
    public function getConnectionsUserId($user_id, $services)
    {
        $this->db->select(implode(", ", $this->fields_all))->from(USER_CONNECTIONS_TABLE)
                 ->where(['user_id' => $user_id])
                 ->order_by('id ASC');
        $result = $this->db->get()->result_array();
        return $this->formatUserConnections($result, $services);
    }

    public function getConnectionById($connection_id = false)
    {
        $data = [];
        $select_attrs = $this->fields_all;
        $this->ci->db->select(implode(", ", $select_attrs))->from(USER_CONNECTIONS_TABLE)->where(['id' => $connection_id])->order_by('id ASC');
        $result = $this->ci->db->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function getConnectionByData($service_id = false, $odata = false)
    {
        $data = [];
        $select_attrs = $this->fields_all;
        $this->ci->db->select(implode(", ", $select_attrs))->from(USER_CONNECTIONS_TABLE)->where(['service_id' => $service_id, 'data' => $odata])->order_by('id ASC');
        $result = $this->ci->db->get()->result_array();
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function deleteConnection($connection_id = false)
    {
        $data = $this->get_connection_by_id($connection_id);
        if (empty($data)) {
            return false;
        }
        $this->ci->db->where('id', $connection_id);
        $this->ci->db->delete(USER_CONNECTIONS_TABLE);

        return;
    }

    public function deleteUserConnections($user_id)
    {
        $this->ci->db->where('user_id', $user_id)->delete(USER_CONNECTIONS_TABLE);

        return;
    }

    public function getMobileApps($user_id = null)
    {
        $this->ci->load->model('social_networking/models/Social_networking_services_model');
        $this->ci->load->model('Users_connections_model');
        $used_apps = ['vkontakte', 'facebook'];
        $services = $this->ci->Social_networking_services_model->get_services_list(
            null,
            [
            'where'    => ['oauth_status' => 1],
            'where_in' => ['gid'          => $used_apps],
            ]
        );
        $apps = [];
        foreach ($services as $id => $val) {
            if (!empty($user_id)) {
                $connection = $this->ci->Users_connections_model->get_connection_by_user_id($val['id'], $user_id);
            }
            if (!isset($connection['id'])) {
                $apps[$id] = $val;
            }
            $apps[$id]['link'] = site_url() . 'mobile/oauth_login/' . $id;
        }

        return $apps;
    }

    /**
     * Format user connections
     *
     * @param array $data
     * @param array $services
     *
     * @return array
     */
    private function formatUserConnections($data, $services)
    {
        foreach ($services as $key => $service) {
            $services[$key] = $service;
            $services[$key]['is_disabled'] = false;
            foreach ($data as $connection) {
                if ($service['id'] == $connection['service_id']) {
                    $services[$key]['is_disabled'] = true;
                }
            }
        }
        return $services;
    }
    /**
     * Validate user data
     *
     * @param array $data
     *
     * @return array
     */
    public function validateUser(array $data)
    {
        $this->ci->config->load('reg_exps', true);
        
        $this->ci->load->model(['users/models/Groups_model', 'Users_model']);
        $return = [
            'data' => [
                'user' => [
                    'lang_id' => $this->ci->pg_language->current_lang_id,
                    'group_id' => $this->ci->Groups_model->getDefaultGroupId(),
                    'approved' => $this->pg_module->get_module_config('users', 'user_approve') ? 0 : 1,
                    'confirm' => 1,
                    'online_status' => 1,
                    'date_last_activity' => date(self::DB_DATE_FORMAT)
                ]
            ],
            'errors' => [],
            'errors_gids' => [],
        ];
        
        $service_ok = true;
        
        if (!empty($data['service_id'])) {
            $this->ci->load->model('social_networking/models/Social_networking_services_model');
            $service = $this->ci->Social_networking_services_model->getServiceById($data['service_id']);
            if (empty($service)) {
                $service_ok = true;
            }
        } elseif (!empty($data['service_gid'])) {
            $this->ci->load->model('social_networking/models/Social_networking_services_model');
            $service = $this->ci->Social_networking_services_model->getServiceByGid($data['service_gid']);
            if (empty($service)) {
                $service_ok = true;
                $return['errors_gids'][] = 'service_not_found';
            }
        } else {
            $service_ok = true;
            $return['errors_gids'][] = 'empty_service_gid';
        }
        
        if (empty($data['access_token'])) {
            $service_ok = true;
            $return['errors_gids'][] = 'empty_access_token';
        }
        
        if (empty($data['date_end'])) {
            $service_ok = true;
            $return['errors_gids'][] = 'empty_date_end';
        }
    
        if (empty($data['service_user_id'])) {
            $service_ok = true;
            $return['errors_gids'][] = 'empty_service_user_id';
        }
        
        if ($service_ok) {
             $return['data']['service'] = $service['name'];
             $return['data']['connection']['service_id'] = $service['id'];
             $return['data']['connection']['access_token'] = $data['access_token'];
             $return['data']['connection']['access_token_secret'] = $data['access_token_secret'];
             $return['data']['connection']['date_end'] = $data['date_end'];
             $return['data']['connection']['data'] = $data['service_user_id'];
        } else {
             $return['errors'][] = l('error_system', self::MODULE_GID);
        }

        if (!empty($data['service_user_email'])) {
            $count  = $this->ci->Users_model->getUsersCount([
                'where' => ['email' => $data['service_user_email']]
            ]);
            if ($count > 0) {
                $return['errors'][] = l('error_email', self::MODULE_GID);
            } else {
                $return['data']['user']['email'] = $data['service_user_email'];
            }
        } else {
            $return['errors'][] = l('error_email_empty', self::MODULE_GID);
        }

        $this->ci->load->library('Translit');
        if (!empty($data['service_user_fname'])) {
            $return['data']['user']['fname'] = $this->ci->translit->convert('ru', $data['service_user_fname']);
        }
         
        if (!empty($data['service_user_sname'])) {
            $return['data']['user']['sname'] = $this->ci->translit->convert('ru', $data['service_user_sname']);
        }

        if (!empty($data['nickname'])) {
            $login_expr = $this->ci->config->item('nickname', 'reg_exps');
            $return['data']['user']['nickname'] = strip_tags($data['nickname']);
            if (empty($return["data"]['user']["nickname"]) || !preg_match($login_expr, $return["data"]['user']["nickname"])) {
                $return["errors"]["nickname"] = l('error_nickname_incorrect', 'users');
            }
            $count = $this->ci->Users_model->getUsersCount([
                'where' => ['nickname' => $return['data']['user']['nickname']]
            ]);
            if ($count > 0) {
                $return["errors"]["nickname"] = l('error_nickname_already_exists', self::MODULE_GID);
            }
        } else {
            $return['data']['user']['nickname'] = $this->setNickname($return['data']['user']);
        }
        
        if (!empty($data['service_birth_date'])) {
            $return['data']['user']['birth_date'] = $this->ci->pg_date->strTranslate($data['service_birth_date']);
            $datetime = date_create($return['data']['user']['birth_date']);
            $user_age = ($datetime) ? $datetime->diff(date_create('today'))->y : 0;
            $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
            $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
            if ($user_age < $age_min) {
                $return["errors"][] = str_replace("[age]", $age_min, l("error_user_too_young", "users"));
            } elseif ($user_age > $age_max) {
                $return["errors"][] = str_replace("[age]", $age_max, l("error_user_too_old", "users"));
            }
        } else {
            $return['data']['user']['birth_date'] = $this->defaultBDate();
        }

        if (!empty($data["user_type"])) {
            $return["data"]['user']["user_type"] = $data["user_type"];
        }
        if (!empty($data["looking_user_type"])) {
            $return["data"]['user']["looking_user_type"] = $data["looking_user_type"];
        }
        
        if (!empty($data["id_country"])) {
            $return["data"]['user']['id_country'] = $data['id_country'];
        }
        
        if (!empty($data["id_region"])) {
            $return["data"]['user']['id_region'] = $data['id_region'];
        }
        
        if (!empty($data["id_city"])) {
            $return["data"]['user']['id_city'] = $data['id_city'];
        }

        return $return;
    }

    private function setNickname(array $data)
    {
        if ($this->isUserNickname(mb_strtolower($data['fname'].$data['sname'])) === false) {
            $nickname = mb_strtolower($data['fname'].$data['sname']);
        } elseif ($this->isUserNickname(mb_strtolower($data['sname'].$data['fname'])) === false) {
            $nickname = mb_strtolower($data['sname'].$data['fname']);
        } else {
            $nickname = explode('@', $data['email'])[0];
        }
        return $nickname;
    }

    public function isUserEmail($email)
    {
        if (!empty($email)) {
            $this->ci->load->model('Users_model');
            $count  = $this->ci->Users_model->getUsersCount([
                'where' => ['email' => $email]
            ]);
            return ($count > 0) ? true : false;
        } else {
            return false;
        }
    }

    public function isUserNickname($nickname)
    {
        if (!empty($nickname)) {
            $this->ci->load->model('Users_model');
            $count  = $this->ci->Users_model->getUsersCount([
                'where' => ['nickname' => $nickname]
            ]);
            return ($count > 0) ? true : false;
        } else {
            return false;
        }
    }

    private function defaultBDate()
    {
        $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
        $min_year = date("Y") - $age_min;
        return $min_year . '-01' . '-01';
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_connection' => 'deleteConnection',
            'delete_user_connections' => 'deleteUserConnections',
            'get_connection_by_data' => 'getConnectionByData',
            'get_connection_by_id' => 'getConnectionById',
            'get_connection_by_user_id' => 'getConnectionByUserId',
            'save_connection' => 'saveConnection',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
