<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models\Services;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioRoom extends TwilioClient
{

    public $room = null;
    private $room_settings = [];

    /**
     * Room constructor.
     * @param $twilio_client
     * @param array $roomSettings
     */
    public function __construct($roomSettings = [])
    {
        parent::__construct();
        $this->room_settings = $roomSettings;
    }

    /**
     * if exist a room
     * function getExistRoom()
     * if not exist a room
     * function createRoom()
     * @throws Exception
     */
    public function generateRoom()
    {
        try {
            $this->room = $this->getExistRoom();
        } catch (\Exception $e) {
            if ($e->getCode() === 20404) {
                $this->room = $this->createRoom();
            } else {
                die($e->getMessage() . ' ' . $e->getCode());
            }
        }

        return $this->room;
    }

    /**
     * https://www.twilio.com/docs/video/api/rooms-resource?code-sample=code-create-a-room&code-language=PHP&code-sdk-version=6.x
     * @return mixed
     * @throws Exception
     */
    public function createRoom()
    {
        if ($this->twilio_client && !empty($this->room_settings)) {
            $room = $this->twilio_client
                ->video
                ->v1
                ->rooms
                ->create($this->room_settings);

            return $room;
        } else {
            throw new Exception('empty twilio client or settings');
        }
    }

    /**
     * https://www.twilio.com/docs/video/api/rooms-resource#get-instance
     * @param $roomName
     * @return mixed
     * @throws Exception
     */
    public function getExistRoom()
    {
        if ($this->twilio_client && !empty($this->room_settings['uniqueName'])) {
            $room = $this->twilio_client
                ->video
                ->v1
                ->rooms($this->room_settings['uniqueName'])
                ->fetch();

            return $room;
        } else {
            throw new Exception('empty twilio client or settings');
        }
    }

    /**
     * @param $sid_room
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function completedRoom($sid_room)
    {
        try {
            $this->twilio_client->video->v1->rooms($sid_room)
                ->update("completed");
        } catch (\Twilio\Exceptions\TwilioException $e) {
        }
    }

    /**
     * @param $sid_room
     * @return bool
     */
    public function isEmptyRoom($sid_room)
    {
        $participants_in_room = $this->twilio_client->video->rooms($sid_room)
            ->participants->read(['status' => 'connected']);

        return empty($participants_in_room);
    }

}