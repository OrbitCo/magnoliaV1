<?php

declare(strict_types=1);

namespace Pg\modules\properties\models;

use Pg\modules\access_permissions\models\AccessPermissionsSettingsModel;

/**
 * Properties main model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class PropertiesModel extends \Model
{
    
    /**
     * Module GUID
     *
     * @var string
     */
    const MODULE_GID = 'properties';
    
    public $properties = [
        'user_type',
        'user_type_plural',
        'looking_user_type'
    ];

    public $module_gid = 'properties';

    public function getProperty($ds_gid, $lang_id = null)
    {
        if (!$ds_gid) {
            return;
        }
        if (!$lang_id) {
            $lang_id = $this->ci->session->userdata('lang_id');
        }

        return $this->ci->pg_language->ds->get_reference($this->module_gid, $ds_gid, $lang_id);
    }

    /**
     * Is used user type
     *
     * @param string $gid
     *
     * @return boolean
     */
    public function isUserTypeUsed($gid)
    {
        $this->ci->load->model('Users_model');
        $is_used = (bool) $this->ci->Users_model->getUsersCount(['where' => ['user_type' => $gid]]);
        if ($is_used === false) {
            $this->ci->load->model('access_permissions/models/Access_permissions_settings_model');
            $subscription_type = $this->ci->Access_permissions_settings_model->getSubscriptionType(AccessPermissionsSettingsModel::TYPE);
            if ($subscription_type == 'user_types') {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_property' => 'getProperty',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
