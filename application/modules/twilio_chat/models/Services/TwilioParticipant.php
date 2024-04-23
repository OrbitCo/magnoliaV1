<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Video\V1\Room\ParticipantInstance;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioParticipant extends TwilioClient
{
    /**
     * TwilioParticipant constructor.
     * @throws ConfigurationException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $sid_room
     * @param $where
     * @return ParticipantInstance[]
     * @throws ConfigurationException
     */
    public function getInfoParticipants($sid_room,$where)
    {
        $participants = $this->twilio_client->video->rooms($sid_room)
            ->participants->read($where);

        return $participants[count($participants) - 1];
    }

}