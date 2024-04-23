<?php

class Loader
{
    private $config_data = [];
    private $models_data = [];
    private static $instance;
    public $api;
    private $local = null;

    public function __construct(Local &$local = null)
    {
        if ($local) {
            $this->local = $local;
        }
        self::$instance = $this;
    }

    public static function &getInstance()
    {
        return self::$instance;
    }

    public function loadApi($key, $domain)
    {
        if (empty($this->api)) {
            include_once NET_CLIENT_PATH . '/libs/Api.php';
            $this->api = new Api($key, $domain);
        }
        return $this->api;
    }

    public function model($name, $load = 'dyn')
    {
        $name = trim(str_replace('_model', '', strtolower($name)));
        if (!isset($this->models_data[$name])) {
            include_once NET_CLIENT_PATH . '/libs/' . ucfirst($name) . 'Model.php';
            if ($load == 'static') {
                $this->models_data[$name] = true;
            } else {
                $model_name = $name . '_model';
                $Model_name = ucfirst($name) . 'Model';
                $this->models_data[$name] = $this->{$model_name} = new $Model_name();
            }
        }

        return $this->models_data[$name];
    }

    public function staticModel($name)
    {
        return $this->model($name, 'static');
    }

    public function config($name)
    {
        if (!isset($this->config_data[$name])) {
            $config = [];
            include_once NET_CLIENT_PATH . '/configs/' . $name . '.php';
            $this->config_data[$name] = $config;
            unset($config);
        }

        return $this->config_data[$name];
    }

    public function action($name)
    {
        $class = $this->formatFileName($name);
        include_once NET_CLIENT_PATH . '/actions/AbstractAction.php';
        $action_file = NET_CLIENT_PATH . '/actions/' . $class . '.php';
        if (!is_file($action_file)) {
            throw new Exception('Wrong action (' . $name . ')');
        }
        include_once $action_file;
        $action = new $class($this->local);
        return $action->run();
    }

    private function formatFileName($name)
    {
        $data = explode('_', $name);
        $class = '';
        foreach ($data as $item) {
            $class .= ucfirst($item);
        }
        return $class . 'Action';
    }
}
