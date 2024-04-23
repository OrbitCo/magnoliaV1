<?php

namespace Pg\Libraries\Analytics\Integrations;

class Amplitude
{
    const HOST = 'https://api.amplitude.com/httpapi';
    
    public $ci;
    
    private $api_key;

    public function __construct($api_key)
    {
        $this->ci = &get_instance();
        
        $this->api_key = $api_key;
    }
    
    public function track($event, $data = [])
    {
        $this->sendEvent($event, $data);
    }

    public function sendEvent($event, $data = [])
    {
        try {
            $this->ci->analytics->getClient()->request('POST', self::HOST, [
                'form_params' => [
                    'api_key' => $this->api_key,
                    'event' => '[' . json_encode([
                        'user_id' => $this->ci->analytics->identify_id,
                        'event_type' => $event,
                        'ip' => $this->ci->input->server('REMOTE_ADDR'),
                        'user_agent' => $this->ci->agent->agent,
                        'time' => time(),
                        'platform' => $this->ci->agent->platform,
                        'os_name' => $this->ci->agent->browser,
                        'os_version' => $this->ci->agent->version
                    ]). ']',
                ],
            ]);
        } catch (\Exception $e) {
        }
    }
    
    public function getApiKey()
    {
        return $this->api_key;
    }
    
    public function __call($name, $args)
    {
        if (!$this->api_key) {
            return;
        }

        return call_user_func_array([$this, $name], $args);
    }
}
