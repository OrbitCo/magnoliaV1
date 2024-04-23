<?php

namespace Pg\Libraries\Analytics\Integrations;

class Google
{
    public const HOST = 'https://www.google-analytics.com/collect';

    /**
     *Google API key
     *
     * @var string
     */
    private $api_key;

    private $ci;

    private $cid;

    /**
     * Google construct
     */
    public function __construct($api_key)
    {
        $this->ci = &get_instance();

        $this->api_key = $api_key;

        $this->cid = $this->gaParseCookie();
    }

    private function gaParseCookie(): string
    {
        if (isset($_COOKIE['_ga'])) {
            list(, , $cid1, $cid2) = preg_split('/[\.]/', $_COOKIE["_ga"], 4);

            return $cid1 . '.' . $cid2;
        }

        return '';
    }

    /**
     * Track
     *
     * @param $event
     * @param array $data
     */
    public function track($event, array $data = [])
    {
        $this->sendEvent($event, $data);
    }

    /**
     * Send event
     *
     * @param $event
     * @param array $data
     */
    public function sendEvent($event, array $data = [])
    {
        if (!$this->cid) {
            return;
        }

        try {
            $this->ci->analytics->getClient()->request('POST', self::HOST, [
                'headers' => [
                    'User-Agent' => $this->ci->agent->agent,
                ],
                'form_params' => [
                    'v' => '1',
                    'tid' => $this->api_key,
                    'cid' => $this->cid,
                    't' => 'event',
                    'uip' => $this->ci->input->server('REMOTE_ADDR'),
                    'ec' => $data['category'],
                    'ea' => $data['action'] ?? $event,
                    'el' => $data['label'] ?? $this->ci->analytics->getEventType(),
                    'ev' => !empty($data['value']) ? (int)$data['value'] : 0,
                    'ua' => $this->ci->agent->agent,
                ],
            ]);
        } catch (\Exception $e) {
        }
    }

    /**
     * Get API key
     *
     * @return string
     */
    public function getApiKey(): string
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
