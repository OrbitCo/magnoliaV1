<?php

namespace Pg\Libraries;

use GuzzleHttp\Client;
use Pg\Libraries\Analytics\Integrations;

class Analytics
{
    public const EVENTS_PATH = 'analytics/';

    public $ci;
    public $identify_id;
    public $analytics = [];
    public $events_list = [];
    public $events_type = 'user';
    private $is_loaded = false;
    private $client;

    public function __construct($params = [])
    {
        $this->ci = &get_instance();

        $this->identify_id = $this->getUserId();

        $this->initGoogle();
        $this->initAmplitude();
        $this->initMixpanel();
    }

    public function getClient(): Client
    {
        if (!$this->client) {
            $this->client = new Client(['timeout' => 2.0,]);
        }

        return $this->client;
    }

    private function loadEvents(): array
    {
        if (empty($this->analytics)) {
            return [];
        }

        if (empty($_ENV['ANALYTICS_PROFILES'])) {
            return [];
        }

        $list = ['events' => [], 'categories' => []];

        $profiles = explode(',', $_ENV['ANALYTICS_PROFILES']);

        foreach ($profiles as $profile) {
            $categories = file_get_contents(SITE_PHYSICAL_PATH . self::EVENTS_PATH . $profile . '.json');

            $categories = (array)json_decode($categories, true);

            foreach ($categories as $category => $events) {
                foreach ($events as $event) {
                    $list['events'][$event] = ['gid' => $event, 'category' => $category];
                }
            }

            $list['categories'] = array_merge_recursive($list['categories'], $categories);
        }

        return $list;
    }

    private function initGoogle()
    {
        if (!$this->ci->pg_module->is_module_active('seo_advanced')) {
            return;
        }

        $api_key = $this->ci->pg_module->get_module_config('seo_advanced', 'seo_ga_default_account_id');

        if (!$api_key) {
            if (!empty($_ENV['GA_KEY'])) {
                $api_key = $_ENV['GA_KEY'];
            }
        }

        if ($api_key) {
            $this->analytics['google'] = new Integrations\Google($api_key);
        }

        if (!empty($_ENV['DEMO_GA_KEY'])) {
            $this->analytics['demo_google'] = new Integrations\Google($_ENV['DEMO_GA_KEY']);
        }
    }

    private function initAmplitude()
    {
        if (!empty($_ENV['AMPLITUDE_KEY'])) {
            $api_key = $_ENV['AMPLITUDE_KEY'];
        } else {
            $api_key = '';
        }

        if ($api_key) {
            $this->analytics['amplitude'] = new Integrations\Amplitude($api_key);
        }

        if (!empty($_ENV['DEMO_AMPLITUDE_KEY'])) {
            $this->analytics['demo_amplitude'] = new Integrations\Amplitude($_ENV['DEMO_AMPLITUDE_KEY']);
        }
    }

    private function initMixpanel()
    {
        if (!empty($_ENV['MIXPANEL_TOKEN'])) {
            $token = $_ENV['MIXPANEL_TOKEN'];
        } else {
            $token = '';
        }

        if ($token) {
            $this->analytics['mixpanel'] = new Integrations\Mixpanel($token);
        }

        if (!empty($_ENV['DEMO_MIXPANEL_TOKEN'])) {
            $this->analytics['demo_mixpanel'] = new Integrations\Mixpanel($_ENV['DEMO_MIXPANEL_TOKEN']);
        }
    }

    public function track($event, $data = [])
    {
        if (!$this->is_loaded) {
            $this->events_list = $this->loadEvents();
            $this->setEventType();
            $this->is_loaded = true;
        }

        if (!array_key_exists($event, $this->events_list['events'])) {
            return;
        }

        foreach ($this->analytics as $analytic) {
            $analytic->track($event, array_merge($this->events_list['events'][$event], $data));
        }
    }

    private function getUserId()
    {
        if (ANALYTIC_USER_EMAIL) {
            $user_row = ANALYTIC_USER_EMAIL;
        } else {
            $auth_type = $this->ci->session->userdata('auth_type');
            if ($auth_type == 'user') {
                $user_id = $this->ci->session->userdata('user_id');
            } else {
                $user_id = $auth_type ?: 'guest';
            }

            $user_row = $_SERVER['HTTP_HOST'] . '-' . $user_id;
        }

        return $user_row;
    }

    public function getEvent($category, $gid, $type = '')
    {
        if (!$this->is_loaded) {
            $this->events_list = $this->loadEvents();
            $this->setEventType($type);
            $this->is_loaded = true;
        }

        if (empty($this->events_list['events'])) {
            return;
        }

        return $this->events_list['categories'][$category][$gid] ?? '';
    }

    public function setEventType(string $type = ''): string
    {
        return $type ?? substr($this->ci->router->fetch_class(true), 0, 6) == 'admin_' ? 'admin' : 'user';
    }

    public function getEventType(): string
    {
        return $this->events_type;
    }

    public function getApiKey($integration)
    {
        return $this->analytics[$integration]->getApiKey();
    }

    public function getApiKeys(): array
    {
        $result = [];

        foreach ($this->analytics as $system => $analytics) {
            $result[$system]['api_key'] = $analytics->getApiKey();
        }

        return $result;
    }
}
