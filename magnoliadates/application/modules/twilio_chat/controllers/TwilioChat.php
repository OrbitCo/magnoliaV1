<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\controllers;

use Pg\modules\twilio_chat\models\Services\TwilioRoom as Troom;
use Pg\modules\twilio_chat\models\Services\TwilioClient as PilotTwilio;
use Pg\modules\twilio_chat\models\Services\TwilioPayment;
use Pg\modules\twilio_chat\models\TwilioChatModel;
use Twilio\Exceptions\ConfigurationException;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class TwilioChat extends \Controller
{
    public $chat_client = null;
    public $user_id = 0;
    public $participant_id = null;
    public $participant = null;
    public $settions = [];

    /**
     * TwilioChat constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setSettings();
    }

    private function setSettings()
    {
        $this->settions = $this->ci->pg_module->get_module_config('twilio_chat', 'settings');
        if (!empty($this->settions)) {
            $this->load->model("twilio_chat/models/TwilioChatVideoModel");
            $this->chat_client = new PilotTwilio();
        }
    }

    private function allowed(): array
    {
        $result = [];
        if ($_SERVER['SERVER_ADDR'] == "127.0.0.1"){
            $result['errors'][] = l('local_not_allowed', 'twilio_chat');
        } elseif (empty($this->settions)) {
            $result['errors'][] = l('twilio_not_setting', 'twilio_chat');
        }

        return $result;
    }

    public function getRoom($participant_id)
    {
        $result = $this->allowed();

        $this->user_id = (int)$this->ci->session->userdata('user_id');
        $this->participant_id = $participant_id;

        if (!$this->isEnoughMoney()) {
            $result['errors'][] = l('errors_not_enought_money', 'twilio_chat');
            $this->view->assign($result);
            $this->view->render();
            return false;
        }

        $this->participant = $this->Users_model->getUserById($participant_id, true);

        if ($this->chat_client) {
            $roomSettings = [
                "statusCallback" => site_url() . 'twilio_chat/callback_room_status/',
                "uniqueName" => $this->ci->session->userdata('nickname') . "_to_" . $this->participant['nickname']
            ];

            $room = (new Troom($roomSettings))->generateRoom();

            if (!empty($room)) {
                $tokens = [
                    'creator_token' => $this->chat_client->createToken($room->uniqueName, (string)$this->user_id),
                    'participant_token' => $this->chat_client->createToken(
                        $room->uniqueName,
                        (string)$this->participant['id']
                    ),
                ];

                $arraySave = [
                    'creator_id' => $this->user_id,
                    'user_to_id' => (int)$this->participant_id,
                    'sid' => $room->sid,
                    'room_name' => $room->uniqueName,
                    'status' => 'in-progress',
                    'token' => json_encode($tokens),
                    'duration' => 0,
                ];

                $result['data']['participant'] = $this->participant;
                $result['data']['my_token'] = $tokens['creator_token'];
                $result['data']['room_name'] = $room->uniqueName;
                $result['data']['track_id'] = $this->TwilioChatVideoModel->saveRoom($arraySave);
                $result['data']['user_id'] = $this->user_id;
            } else {
                $result['errors'][] = l('errors_empty_room', 'twilio_chat');
            }
        } else {
            $result['errors'][] = l('errors_service_is_unavailable', 'twilio_chat');
        }

        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Status room
     *
     * @return mixed
     * @throws ConfigurationException
     */
    public function getStatusRoom()
    {
        $result = $this->allowed();

        $track_id = (int)$this->ci->input->post('track_id', true);
        $partner_id = (int)$this->ci->input->post('partner_id', true);
        $type = $this->ci->input->post('type', true);

        if ($this->isEnoughMoney) {
            $result['errors'][] = l('errors_not_enought_money', 'twilio_chat');
            $this->view->assign($result);
            $this->view->render();
            return false;
        }

        $room_data = $this->TwilioChatVideoModel->getRoomById($track_id)[0];
        $result = array_merge($result, $room_data);
        if (!empty($result)) {
            if ($type === 'partner') {
                $participant = new \Pg\modules\twilio_chat\models\Services\TwilioParticipant();
                $caller_status = $participant->getInfoParticipants($result['sid'], ['identity' => $partner_id]);

                if ($caller_status->status === "disconnected" || $caller_status->status === "reconnecting") {
                    $this->TwilioChatVideoModel->setStatus($result['id'], 'disconnected');
                    $result['status'] = 'disconnected';
                }
            }

            if ($result['status'] == 'decline') {
                $result['status_decline'] = l('user_decline', 'twilio_chat');
            } else {
                if ($result['status'] == 'disconnected') {
                    $result['status_decline'] = l('user_disconnected', 'twilio_chat');
                }
            }
        }

        unset($result['amount']);
        $this->view->assign(['track' => $result]);
        $this->view->render();
    }

    /**
     * Is enough money
     *
     * @return bool
     */
    public function isEnoughMoney(): bool
    {

      if (!empty($this->settings_payment) && !empty($this->settings_payment['type']) && $this->settings_payment['type'] === 'payed') {
            $pay = new  TwilioPayment();
            return (($this->settings_payment['amount'] * $pay->getUserAccount($this->user_id)) < 0.005);
        }

      return true;
    }

    /**
     * Set status room
     *
     * @return mixed
     */
    public function setStatusRoom()
    {
        $id = (int)$this->ci->input->post('track_id', true);
        $status = $this->ci->input->post('status', true);

        $this->TwilioChatVideoModel->updateRoomStatus($id, $status);

        $this->view->render();
    }


    /**
     * https://www.twilio.com/docs/video/api/status-callbacks#rooms-callback-events
     *  callBackRoomStatus
     */
    public function callbackRoomStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            show_404();
        }

        $participant_event = $this->ci->input->post('StatusCallbackEvent', true);
        $room_sid = $this->ci->input->post('RoomSid', true);
        $participant_identity = $this->ci->input->post('ParticipantIdentity', true);

        if ($participant_event == "participant-connected") {
            $this->load->model("twilio_chat/models/TwilioChatVideoModel");
            $room_data = $this->TwilioChatVideoModel->getRoomByWhere(['sid' => $room_sid]);

            if ((int)$room_data['creator_id'] == (int)$participant_identity) {
                $this->TwilioChatVideoModel->participantConnectStatus($room_data, 'desconnect');
            }

            if ((int)$room_data['user_to_id'] == (int)$participant_identity) {
                $this->TwilioChatVideoModel->participantConnectStatus($room_data, 'connect');
            }
        }

        /*Платит только тот, кто звонил */
        if ($participant_event == "participant-disconnected") {
            $settings = $this->ci->pg_module->get_module_config('twilio_chat', 'settings');
            $settings_payment = json_decode($settings, true)['payment'];
            $this->load->model("twilio_chat/models/TwilioChatVideoModel");
            $room_data = $this->TwilioChatVideoModel->getRoomByWhere(['sid' => $room_sid]);

            if ((int)$room_data['user_to_id'] == (int)$participant_identity) {
                if ($settings_payment['type'] && $settings_payment['type'] == "payed") {
                    $this->TwilioChatVideoModel->updatePay($room_data, $_POST);
                }
                $this->TwilioChatVideoModel->updateTime($room_data, $_POST);
                $user_from = $this->getUser((int)$room_data['creator_id']);
                $user_to = $this->getUser((int)$room_data['user_to_id']);
                $this->receivedCall($room_data, $_POST['ParticipantDuration'], $user_from, $user_to);
            }

            if ($room_data['participant_connect'] != 'connect') {
                if ((int)$room_data['creator_id'] == (int)$participant_identity) {
                    $user_from = $this->getUser((int)$room_data['creator_id']);
                    $user_to = $this->getUser((int)$room_data['user_to_id']);
                    $this->missedCall($room_data, $user_from, $user_to);
                    $this->ci->session->unset_userdata("partner_connected");
                }
            }
        }
    }

    public function receivedCall($room_data, $duration, $user_from, $user_to)
    {
        $sec = TwilioChatModel::durationFormat((int)$duration);
        $this->setCall($room_data, $user_from, $user_to, $sec);
    }

    public function missedCall($room_data, $user_from, $user_to)
    {
        $this->setCall($room_data, $user_from, $user_to);
    }

    private function setCall($room_data, $user_from, $user_to, $sec = '00:00:00')
    {
        $this->view->assign('sec', $sec);
        $this->view->assign('user_from', $user_from);
        $this->view->assign('user_to', $user_to);

        $html_creator = $this->view->fetch('outgoing_call', 'user', 'twilio_chat');
        $html_user_to = $this->view->fetch('incoming_call', 'user', 'twilio_chat');

        $model = new \Pg\modules\chatbox\models\ChatboxModel();
        $model->addMessage($room_data['creator_id'], $room_data['user_to_id'], $html_creator, false, true, false);
        $model->addMessage($room_data['user_to_id'], $room_data['creator_id'], $html_user_to, false, true, false);
    }

    public function getUser($id)
    {
        $this->load->model('UsersModel');
        return $this->UsersModel->getUserById($id, true);
    }

    public function callbackRoomSettings()
    {
        //TODO
    }
}
