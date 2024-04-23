<?php

declare(strict_types=1);

namespace Pg\modules\network\models;

/**
 * Network actions model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class NetworkActionsModel extends \Model
{

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('network/models/Network_users_model');
    }

    public function getSettings()
    {
        return $this->ci->Network_users_model->getConfig($this->ci->Network_users_model->cfg_filter);
    }

    public function getProfiles($count = 100)
    {
        return $this->ci->Network_users_model->getProfiles($count);
    }

    public function getTempProfiles($action, $field = 'net_id')
    {
        if (!is_array($field)) {
            $field = [$field];
        }
        return $this->ci->Network_users_model->getTempRecords(null, null, $action, 'out', $field);
    }

    public function getProcessedNetIds($action, $field = 'net_id')
    {
        $temp_profiles = $this->getTempProfiles($action, $field);
        $net_ids =[];
        foreach ($temp_profiles as $temp_profile) {
            $net_ids[] = $temp_profile[$field];
        }
        return $net_ids;
    }

    public function setTempProfilesAdd($profiles)
    {
        foreach ($profiles as &$profile) {
            $profile['net_id'] = $profile['id'];
            unset($profile['id']);
            $profile['photos'] = serialize($profile['photos']);
            $profile['profile_data'] = serialize($profile['profile_data']);
        }
        return $this->ci->Network_users_model->setTempProfiles(
                $profiles,
                NetworkUsersModel::ACTION_ADD,
                NetworkUsersModel::TYPE_IN);
    }

    public function setTempProfilesRemove($net_ids)
    {
        $profiles = [];
        foreach ($net_ids as $net_id) {
            $profiles[]['net_id'] = $net_id;
        }

        return $this->ci->Network_users_model->setTempProfiles(
                $profiles,
                NetworkUsersModel::ACTION_REMOVE,
                NetworkUsersModel::TYPE_IN);
    }

    public function setTempProfilesUpdate($profiles)
    {
        return $this->ci->Network_users_model->setTempProfiles(
                $profiles,
                NetworkUsersModel::ACTION_UPDATE,
                NetworkUsersModel::TYPE_IN);
    }

    public function setProfilesStatus($data)
    {
        return $this->ci->Network_users_model->setProfilesStatus($data);
    }

    public function getLastId()
    {
        return $this->ci->Network_users_model->getLastId();
    }

    public function processTemp()
    {
        return $this->ci->Network_users_model->processTemp();
    }

    public function deleteTempRecords($net_id = null, $local_id = null, $action = null, $type = null)
    {
        return $this->ci->Network_users_model->deleteTempRecords($net_id, $local_id, $action, $type);
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_temp_records' => 'deleteTempRecords',
            'get_last_id' => 'getLastId',
            'get_processed_net_ids' => 'getProcessedNetIds',
            'get_profiles' => 'getProfiles',
            'get_settings' => 'getSettings',
            'get_temp_profiles' => 'getTempProfiles',
            'process_temp' => 'processTemp',
            'set_profiles_status' => 'setProfilesStatus',
            'set_temp_profiles_add' => 'setTempProfilesAdd',
            'set_temp_profiles_remove' => 'setTempProfilesRemove',
            'set_temp_profiles_update' => 'setTempProfilesUpdate',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
