<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\models\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class TwilioClient
{
    /**
     * @var Client|null
     */
    protected $twilio_client = null;

    /**
     * @var mixed|null
     */
    protected $account_sid = null;

    /**
     * @var mixed|null
     */
    protected $token = null;

    /**
     * @var mixed|null
     */
    protected $api_key_sid = null;

    /**
     * @var mixed|null
     */
    protected $api_key_secret = null;


    /**
     * TwilioClient constructor.
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $ci = &get_instance();
        $settings = $ci->pg_module->get_module_config('twilio_chat', 'settings');

        if (!empty($settings)) {
            $settings_data = json_decode($settings, true);
            $this->account_sid = $settings_data['keys']['account_sid'];
            $this->token = $settings_data['keys']['auth_token'];
            $this->api_key_sid = $settings_data['keys']['api_key_sid'];
            $this->api_key_secret = $settings_data['keys']['api_key_secret'];
        } else {
            return l('twilio_not_setting', 'twilio_chat');
        }

        try {
            TwilioValidation::isSettingsEmpty($settings);
        } catch (\Exception $e) {
            return (l('twilio_not_setting', 'twilio_chat'));
        }

        $this->twilio_client = new Client($this->account_sid, $this->token);
    }

    /**
     * @return Client
     * @throws ConfigurationException
     */
    public function getTwilioClient(): Client
    {
        return $this->twilio_client;
    }

    /**
     * @return mixed|string
     */
    public function getAccountSid()
    {
        return $this->account_sid;
    }

    /**
     * @return mixed|string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed|string
     */
    public function getApiKeySid()
    {
        return $this->api_key_sid;
    }

    /**
     * @return mixed|string
     */
    public function getApiKeySecret()
    {
        return $this->api_key_secret;
    }

    /**
     * @param $room_name
     * @param null $nickname
     * @param int $ttl
     * @return string | die with Exception
     */

    public function createToken($room_name, $nickname = null, $ttl = 3600)
    {
        try {
            $token = new AccessToken($this->account_sid, $this->api_key_sid, $this->api_key_secret, $ttl, $nickname);
            $grant = new VideoGrant();
            $grant->setRoom($room_name);
            $token->addGrant($grant);
            return $token->toJWT();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
