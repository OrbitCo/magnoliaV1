<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models;

use Pg\modules\twilio_chat\models\Services\TwilioPayment;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioChatVideoModel extends \Model
{

    const TABLE = DB_PREFIX . 'twilio_video_chat';

    private $fields = [
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

    ];

    /**
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
     * @param $id
     * @return mixed
     */
    public function getRoomById($id)
    {
        return $this->ci->db
            ->select(implode(", ", $this->fields))
            ->from(self::TABLE)
            ->where("id", $id)
            ->get()->result_array();
    }

    /**
     * @param $where
     * @return mixed
     */
    public function getRoomByWhere($where)
    {
        $result = $this->ci->db
            ->select(implode(", ", $this->fields))
            ->from(self::TABLE)
            ->where($where)
            ->get()->result_array();

        return $result[0];
    }

    /**
     * @param $data
     * @param null $id
     * @return int
     */
    public function saveRoom($data, $id = null): int
    {
        $id = (int)$id;

        if (empty($id)) {
            $data['date_created'] = date(TwilioChatModel::DB_DATE_FORMAT);

            $has_room = $this->getRoomByWhere(['creator_id' => $data['creator_id'], 'sid' => $data['sid']]);

            if ($has_room) {
                $id = $has_room['id'];
                $this->ci->db->set('status', $data['status']);
                $this->ci->db->set('token', $data['token']);
                $this->ci->db->where(['id' => $id]);
                $this->ci->db->update(self::TABLE);
            } else {
                $this->ci->db->insert(self::TABLE, $data);
                $id = $this->ci->db->insert_id();
            }
        }

        return (int)$id;
    }

    /**
     * @return false|mixed
     */
    public function backendGetRequests()
    {
        $result = $this->ci->db
            ->select(implode(", ", $this->fields))
            ->from(self::TABLE)
            ->where("user_to_id", $this->ci->session->userdata('user_id'))
            ->where("status", "in-progress")
            ->get()->result_array();

        $count_chats = count($result);
        $last_chat = !empty($result) ? $result[$count_chats - 1] : [];
        if (!empty($last_chat)) {
            /*Проверка если в процессе больше чем 1 и не пустая комната.*/
            if ($count_chats > 1) {
                /*Закрываем остальные*/
                unset($result[$count_chats - 1]);
                foreach ($result as $chat) {
                    $this->updateRoomStatus($chat['id'], 'disconnected');
                }

                /*Если в комнате нет никого - закрываем её*/
                $twilio_room = new \Pg\modules\twilio_chat\models\Services\TwilioRoom();
                if ($twilio_room->isEmptyRoom($last_chat['sid'])) {
                    $this->updateRoomStatus($last_chat['id'], 'disconnected');
                    $last_chat['status'] = "disconnected";
                }
            }

            $data = $last_chat;
            $data['token'] = json_decode($data['token'], true)['participant_token'];
            $this->ci->load->model('UsersModel');
            $data['participant'] = $this->ci->UsersModel->getUserById($data['creator_id'], true);
            $data['user_id'] = (int)$this->ci->session->userdata('user_id');

            return $data;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function updateRoomStatus($id, $status)
    {
        $this->ci->db->set('status', $status);
        $this->ci->db->where(['id' => $id]);

        return $this->ci->db->update(self::TABLE);
    }

    /**
     * @param $room_data
     * @param $partner
     */
    public function updateTime($room_data, $partner)
    {
        $partTime = (int)$partner['ParticipantDuration'];

        $time = ($room_data['duration'] + $partTime);
        $room_data['duration'] = $time;

        $room_data['status'] = $partner['ParticipantStatus'];
        $this->ci->db->where(['id' => (int)$room_data['id']]);
        unset($room_data['amount']);
        $this->ci->db->update(self::TABLE, $room_data);
    }

    public function updatePay($room_data, $partner)
    {
        $settings = $this->ci->pg_module->get_module_config('twilio_chat', 'settings');
        $settings_payment = json_decode($settings, true)['payment'];

        $partTime = (int)$partner['ParticipantDuration'];

        $price = ($settings_payment['amount'] * $partTime);
        $room_data['amount'] += $price;

        $this->payProcess($room_data['creator_id'], $price);

        $room_data['status'] = $partner['ParticipantStatus'];
        $this->ci->db->where(['id' => (int)$room_data['id']]);
        $this->ci->db->update(self::TABLE, ['amount' => $room_data['amount'], 'status' => $room_data['status']]);
    }

    /**
     * @param $user_id
     * @param $price
     * @param null $msg
     */
    public function payProcess($user_id, $price, $msg = null)
    {
        $pay = new  TwilioPayment();
        $pay->writeOffForChat($user_id, $price, $msg);
    }

    public function participantConnectStatus($room_data, $status)
    {
        $this->ci->db->where(['id' => (int)$room_data['id']]);
        $this->ci->db->update(self::TABLE, ['participant_connect' => $status]);
    }
}
