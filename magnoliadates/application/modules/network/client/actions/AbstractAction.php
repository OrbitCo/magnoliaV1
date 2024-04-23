<?php

abstract class AbstractAction
{
    private $_local;

    abstract public function run();

    public function __construct(Local $local = null)
    {
        $this->_local = $local;
    }

    protected function send($action, $data = [], $method = 'get')
    {
        $result = Loader::getInstance()->api->send($action, $data, $method);

        return ['log' => $result];
    }

    protected function localAction($action)
    {
        $params = array_slice(func_get_args(), 1);

        return $this->_local->action($action, $params ?: null);
    }

    protected function log($level, $message)
    {
        $this->_local->log($level, $message, 'slow');
    }
}
