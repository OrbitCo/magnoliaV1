<?php

declare(strict_types=1);

namespace Pg\modules\im\models;

use Pg\Libraries\Setup;

if (!defined('TABLE_IM')) {
    define('TABLE_IM', DB_PREFIX . 'im');
}

/**
 * IM model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 */
class ImModel extends \Model
{

    /**
     * Module GID
     *
     * @var string
     */
    const MODULE_GID = 'im';

    /**
     * Date format
     *
     * @var string
     */
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Im attributes
     *
     * @var array
     */
    private $fields = [
        'id_user',
        'date_add',
        'date_update',
        'date_end',
    ];

    /**
     * Im attributes
     *
     * @var string
     */
    private $fields_str;

    /**
     * Services buy GIDS
     *
     * @var array
     */
    public $services_buy_gids = [self::MODULE_GID];

    /**
     * Class constructor
     *
     * @return ImModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->fields_str = implode(', ', $this->fields);
    }

    /**
     * Get user IM
     *
     * @param integer $id_user
     *
     * @return array
     */
    public function getUserIm($id_user)
    {
        $result = $this->ci->db->select($this->fields_str)
            ->from(TABLE_IM)
            ->where('id_user', $id_user)
            ->get()->result_array();
        return !empty($result) ? $result[0] : [];
    }

    /**
     * Save user
     *
     * @param array $data
     *
     * @return boolean
     */
    private function save($data)
    {
        $fields_upd = [];
        foreach ($data as $field => $val) {
            $fields_upd[] = "`{$field}` = " . $this->ci->db->escape($val);
        }
        $update_str = implode(', ', $fields_upd);
        $sql = $this->ci->db->insert_string(TABLE_IM, $data) . " ON DUPLICATE KEY UPDATE {$update_str}";
        $this->ci->db->query($sql);
        return $this->ci->db->affected_rows();
    }

    /**
     * IM status
     *
     * @return array
     */
    public function imStatus()
    {
        return [
            'id_user' => ($this->ci->session->userdata('auth_type') == 'user') ? $this->ci->session->userdata('user_id') : 0,
            'im_on' => $this->ci->pg_module->get_module_config(self::MODULE_GID, 'status'),
            'im_service_access' => $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => self::MODULE_GID, 'controller' => self::MODULE_GID, 'action' => 'ajax_check_new_messages']
                )
            ), false)
        ];
    }

    /**
     * Service available IM action
     *
     * @param integer $id_user
     *
     * @return array
     */
    public function serviceAvailableImAction($id_user)
    {
        $return = [
            'available' => 0,
            'content' => '',
            'content_buy_block' => false,
        ];
        $this->ci->load->model('Services_model');
        $services_count = $this->ci->Services_model->get_service_count([
            'where' => [
                'gid' => self::MODULE_GID,
                'status' => 1,
            ],
        ]);
        if ($services_count) {
            $return['content_buy_block'] = true;
        } else {
            $return['content'] = 'services not found';
            $return['available'] = 1;
        }
        return $return;
    }

    /**
     * Service validate IM
     *
     * @param integer $id_user
     * @param array $data
     * @param array $service_data
     * @param float $price
     *
     * @return array
     */
    public function serviceValidateIm($id_user, $data, $service_data = [], $price = '')
    {
        return ['errors' => [], 'data' => $data];
    }

    /**
     * Service buy IM
     *
     * @param integer $id_user
     * @param float $price
     * @param array $service
     * @param array $template
     * @param array $payment_data
     * @param integer $users_package_id
     * @param integer $count
     *
     * @return boolean
     */
    public function serviceBuyIm($id_user, $price, $service, $template, $payment_data, $users_package_id = 0, $count = 1)
    {
        $service_data = [
            'id_user' => $id_user,
            'service_gid' => $service['gid'],
            'template_gid' => $template['gid'],
            'service' => $service,
            'template' => $template,
            'payment_data' => $payment_data,
            'id_users_package' => $users_package_id,
            'id_users_membership' => !empty($payment_data['id_users_membership']) ? (int) $payment_data['id_users_membership'] : 0,
            'status' => 1,
            'count' => $count,
        ];
        $this->ci->load->model('services/models/Services_users_model');
        return $this->ci->Services_users_model->save_service(null, $service_data);
    }

    /**
     * Service activate IM
     *
     * @param integer $id_user
     * @param integer $id_user_service
     *
     * @return type
     */
    public function serviceActivateIm($id_user, $id_user_service)
    {
        $return = ['status' => 0, 'message' => ''];
        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id($id_user, $id_user_service);
        if (empty($user_service) || !$user_service["status"] || $user_service['count'] < 1 || !isset($user_service['service']['data_admin']['period'])) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->service_set_im($id_user, $user_service['service']['data_admin']['period']);
            if (--$user_service['count'] < 1) {
                $user_service['status'] = 0;
                $user_service['count'] = 0;
            }
            $this->ci->Services_users_model->save_service($id_user_service, $user_service);
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }
        return $return;
    }

    /**
     * Service set IM
     *
     * @param int $id_user
     * @param int $period
     *
     * @return type
     */
    public function serviceSetIm($id_user, $period)
    {
        if (empty($id_user)) {
            throw new \Exception('Empty user id');
        } elseif (empty($period)) {
            throw new \Exception('Empty period');
        }
        $user_im = $this->getUserIm($id_user);
        if (!empty($user_im)) {
            if (strtotime($user_im['date_end']) > time()) {
                $data['date_end'] = date(self::DATE_FORMAT, strtotime($user_im['date_end'] . ' +' . $period . ' day'));
            } else {
                $data['date_end'] = date(self::DATE_FORMAT, strtotime('+' . $period . ' day'));
            }
        } else {
            $data['date_add'] = date(self::DATE_FORMAT);
            $data['date_end'] = date(self::DATE_FORMAT, strtotime('+' . $period . ' day'));
        }
        $data['date_update'] = date(self::DATE_FORMAT);
        $data['id_user'] = $id_user;
        $this->save($data);
        return $data['date_end'];
    }

    /**
     * Validate settings
     *
     * @param array $data
     *
     * @return array
     */
    public function validateSettings($data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['status'])) {
            $return['data']['status'] = $data['status'] ? 1 : 0;
        }

        if (isset($data['message_max_chars'])) {
            $return['data']['message_max_chars'] = intval($data['message_max_chars']);
            if ($return['data']['message_max_chars'] <= 0) {
                $return['errors'][] = l('error_message_max_chars', 'im');
            }
        }

        return $return;
    }

    /**
     * Install or Deinstall
     *
     * @param integer $status
     *
     * @return void
     */
    public function statusAccessPermissions($status)
    {
        // if ($status == 1) {
        //     $this->installAccessPermissions();
        // } else {
        //     $this->deinstallAccessPermissions();
        // }
    }


     /**
     * Install access permissions
     *
     * @return void
     */
    public function installAccessPermissions()
    {
        /*
        $access_permissions = Setup::getModuleData(
                self::MODULE_GID, Setup::TYPE_ACCESS_PERMISSIONS
        );
        if (!empty($access_permissions)) {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($access_permissions as $value) {
                if (isset($value['data'])) {
                    $value['data'] = serialize($value['data']);
                }
                $this->ci->Access_permissions_modules_model->saveModules($value);
            }
        }
        */
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    public function deinstallAccessPermissions()
    {
        /*
        $access_permissions = Setup::getModuleData(
                self::MODULE_GID, Setup::TYPE_ACCESS_PERMISSIONS
        );
        if (!empty($access_permissions)) {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($access_permissions as $value) {
                $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
            }
        }
        */
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_user_im' => 'getUserIm',
            'im_status' => 'imStatus',
            'service_activate_im' => 'serviceActivateIm',
            'service_available_im_action' => 'serviceAvailableImAction',
            'service_buy_im' => 'serviceBuyIm',
            'service_set_im' => 'serviceSetIm',
            'service_validate_im' => 'serviceValidateIm',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
