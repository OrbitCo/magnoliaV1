<?php
require_once __DIR__ . '/../../install/config.php';

class Api
{
    private $key    = '';
    private $domain = '';
    private $url    = NETWORK_SLOW_SERVER;
    private $format = 'json';

    public function __construct($key, $domain)
    {
        $this->key    = $key;
        $this->domain = $domain;
    }

    public function send($action, $data = [], $method = 'get')
    {
        if ($method != 'get') {
            $method = 'post';
        }
        if (!empty($data['format'])) {
            $format = $data['format'];
        } else {
            $format = $this->format;
        }

        $func_name = 'curl_' . $method;

        $result = $this->{$func_name}($this->url . $this->formatMethodName($action), $data);

        return $this->prepare($result, $format);
    }

    /**
     * camelCase to under_score
     *
     * @param string $action
     *
     * @return string
     */
    private function formatMethodName($action)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $action));
    }

    private function prepare($data, $format = 'json')
    {
        switch ($format) {
            case 'json':
                $data = json_decode($data, true);
                break;
            default:
                break;
        }

        return $data;
    }

    private function curl_post($url, array $post = null, array $options = [])
    {
        if (function_exists('curl_init')) {
            $defaults = [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => (string) http_build_query($post),
                CURLOPT_URL => $url,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_CONNECTTIMEOUT => 60,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TRANSFERTEXT => false,
                CURLOPT_HTTPHEADER => [
                    'x-pgn-key: ' . $this->key,
                    'x-pgn-domain: ' . $this->domain,
                ],
            ];
            $ch       = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            $result   = curl_exec($ch);
            curl_close($ch);

            return $result;
        }
    }

    private function curl_get($url, array $get = null, array $options = [])
    {
        if (function_exists('curl_init')) {
            $defaults = [
                CURLOPT_URL => $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($get),
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 4,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => [
                    'x-pgn-key: ' . $this->key,
                    'x-pgn-domain: ' . $this->domain,
                ],
            ];
            $ch       = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            $result   = curl_exec($ch);
            curl_close($ch);

            return $result;
        }
    }
}
