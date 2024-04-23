<?php

class GetUpdatedAction extends AbstractAction
{
    public function run()
    {
        $users = $this->send('getUpdated', [], 'GET');
        if (!empty($users['log']['profiles'])) {
            $this->log('info', 'get_updated: ' . serialize($users['log']['profiles']));
            $this->localAction('set_temp_profiles_update', $users['log']['profiles']);
        }

        return ['log' => $users];
    }
}
