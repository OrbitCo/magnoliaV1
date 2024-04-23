<?php

class SettingsAction extends AbstractAction
{
    public function run()
    {
        $settings = $this->localAction('getSettings');
        $this->log('info', 'settings: ' . serialize($settings));
        $data = $this->send('settings', $settings);
        return ['log' => $data];
    }
}
