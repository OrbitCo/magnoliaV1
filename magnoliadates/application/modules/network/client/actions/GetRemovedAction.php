<?php

class GetRemovedAction extends AbstractAction
{
    public function run()
    {
        $data = $this->send('getRemoved');
        if (!empty($data['log']['removed'])) {
            $this->log('info', 'getRemoved: ' . serialize($data['log']['removed']));
            $this->localAction('setTempProfilesRemove', $data['log']['removed']);
        }
        return ['log' => $data];
    }
}
