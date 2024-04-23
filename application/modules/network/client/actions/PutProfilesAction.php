<?php

class PutProfilesAction extends AbstractAction
{
    public function run()
    {
        $profiles = $this->localAction('getProfiles');
        $data = $this->send('putProfiles', ['profiles' => serialize($profiles)], 'POST');
        if (!empty($data['log']['profiles'])) {
            $this->log('info', 'putProfiles: ' . serialize($data['log']['profiles']));
            $this->localAction('setProfilesStatus', $data['log']['profiles']);
        }
        return ['log' => $data];
    }
}
