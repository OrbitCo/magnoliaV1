<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models;

use Pg\Libraries\View;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioChatAdminModel extends \Model
{

    const TABLE = DB_PREFIX . 'twilio_video_chat';

    private $fields = array(
        'id',
        'creator_id ',
        'user_to_id',
        'sid',
        'room_name',
        'status',
        'token',
        'duration',
        'amount',
        'participant_connect',

    );

    /**
     * Save settings
     * @param $settings
     * @return bool
     */
    public function saveSettings($settings)
    {
        $return = $this->validSettings($settings['keys']);
        if (empty($return['errors'])){
            $this->validSettings($settings['keys']);
            $this->ci->pg_module->set_module_config('twilio_chat', 'settings', json_encode($settings));
            return true;
        }else{
            return $return;
        }
    }

    /**
     * Set status
     * @param $id
     * @param $status
     */
    public function setStatus($id, $status)
    {
        $this->ci->db->set('status', $status);
        $this->ci->db->where(['id' => $id]);
        $this->ci->db->update(self::TABLE);
    }

    /**
     * All chats
     * @return mixed
     */
    public function getAllChats()
    {
        return $this->ci->db
            ->select(implode(',', $this->fields))
            ->from(self::TABLE)
            ->order_by('id', 'DESC')
            ->get()->result_array();
    }

    /**
     * @param $settings
     * @return array
     */
    public function validSettings($settings)
    {
        $errors = [];
        foreach ($settings as $kye => $val) {
            if (empty($val)) {
                $errors['errors'][] = l("admin_feild_" . $kye, 'twilio_chat') . " " . l("errors_empty", 'twilio_chat');
            }
        }
        return $errors;
    }
}
