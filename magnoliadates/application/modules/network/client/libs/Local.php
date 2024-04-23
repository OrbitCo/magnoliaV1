<?php

use Pg\modules\network\models\NetworkModel;

class Local
{
    private static $obj;
    private $ci;

    public function __construct()
    {
        $this->getCi();
        $this->ci->load->model(['Network_model',
            'network/models/Network_events_model', 'network/models/Network_actions_model']);
    }

    public static function single()
    {
        if (empty(self::$obj)) {
            self::$obj = new self();
        }
        return self::$obj;
    }

    private function getCi()
    {
        $uri = 'start';
        $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'] = $uri;
        $index = realpath(__DIR__ . '/../../../../../index.php');
        ob_start();
        include $index;
        ob_end_clean();
        $this->ci = &get_instance();
        if (empty($this->ci)) {
            throw new Exception('Can\'t init codeigniter');
        }
        $this->ci->db->initialize();
    }

    public function action($action, $params = [])
    {
        return call_user_func_array([$this->ci->Network_actions_model, $action], $params ?: []);
    }

    public function getEventsDir()
    {
        return $this->ci->Network_events_model->getEventsDir();
    }

    public function getLogsDir()
    {
        return $this->ci->Network_model->getLogsDir();
    }

    public function getEvents()
    {
        return $this->ci->Network_events_model->getEvents();
    }

    public function getHandler($event)
    {
        return $this->ci->Network_events_model->getCache($event);
    }

    public function handle($event, $data)
    {
        return $this->ci->Network_events_model->handle($event, $data);
    }

    public function getConnectionData()
    {
        $data = $this->ci->Network_events_model->getConnectionData();
        $url_arr = parse_url($data['url']);

        return [
            'url' => $url_arr['scheme'] . '://' . $url_arr['host']
                . (isset($url_arr['port']) ? ':' . $url_arr['port'] : ''),
            'namespace' => rtrim($url_arr['path'], '/'),
            'key'       => $data['key'],
            'domain'    => $data['domain'],
        ];
    }

    public function saveDaemonPid($pid)
    {
        $this->ci->Network_model->setConfig(['daemon_pid' => $pid]);
    }

    public function isDebug()
    {
        return (bool) $_ENV['DISPLAY_ERRORS'];
    }

    public function log($level, $message, $file = 'log')
    {
        log_message($level, $message, NetworkModel::MODULE_GID, $file);
        return $this;
    }
}
