<?php

class GetProfilesAction extends AbstractAction
{
    public function run()
    {
        $last_id = $this->localAction('getLastId');
        $users = $this->send('getProfiles', ['last_id' => $last_id]);
        if (!empty($users['log']['profiles'])) {
            $this->log('info', 'getProfiles: ' . serialize($users['log']['profiles']));
            $this->localAction('setTempProfilesAdd', $users['log']['profiles']);
        }
        return ['log' => $users];
    }
}
