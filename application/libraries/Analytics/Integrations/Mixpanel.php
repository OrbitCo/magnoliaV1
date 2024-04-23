<?php

namespace Pg\Libraries\Analytics\Integrations;

class Mixpanel
{
    const HOST = 'https://api.mixpanel.com/';

    public $ci;

    private $token;


    public function __construct($token)
    {
        $this->ci = &get_instance();

        $this->token = $token;
    }

    public function track($event, $data = [])
    {
        $this->sendEvent($event, $data);
    }

    public function sendEvent($event, $data = [])
    {
        try {
            $this->ci->analytics->getClient()->request('POST', self::HOST . 'track', [
                'form_params' => [
                    'data' => base64_encode(json_encode([
                        'event' => $event,
                        'properties' => [
                            'distinct_id' => $this->ci->analytics->identify_id,
                            'token' => $this->token,
                            'ip' => $this->ci->input->server('REMOTE_ADDR'),
                            'time' => time(),
                            '$device' => $this->ci->agent->platform,
                            '$browser' => $this->ci->agent->browser,
                            '$browser_version' => $this->ci->agent->version,
                        ]
                    ])),
                ],
            ]);
        } catch (\Exception $e) {
        }
    }

    public function getApiKey()
    {
        return $this->token;
    }

    public function __call($name, $args)
    {
        if (!$this->token) {
            return;
        }

        return call_user_func_array([$this, $name], $args);
    }
}
