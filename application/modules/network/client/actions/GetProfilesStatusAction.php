<?php

class GetProfilesStatusAction extends AbstractAction
{
    public function run()
    {
        $data = $this->send('getProfilesStatus');
        if (!empty($data['log']['status'])) {
            $this->log('info', 'setProfilesStatus: ' . serialize($data['log']['status']));
            $this->localAction('setProfilesStatus', $data['log']['status']);
        }
        return ['log' => $data];
    }
}
