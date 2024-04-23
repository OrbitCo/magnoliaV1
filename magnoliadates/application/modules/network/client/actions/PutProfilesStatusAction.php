<?php

use Pg\modules\network\models\NetworkUsersModel;

class PutProfilesStatusAction extends AbstractAction
{
    public function run()
    {
        $net_ids = $this->localAction('getProcessedNetIds', 'add');
        if (!empty($net_ids)) {
            $this->log('info', 'putProfilesStatus: ' . serialize($net_ids));
            $data = $this->send('putProfilesStatus', ['id' => $net_ids], 'POST');
            $this->localAction('deleteTempRecords',
                    $net_ids,
                null,
                NetworkUsersModel::ACTION_ADD,
                NetworkUsersModel::TYPE_OUT);
        } else {
            $data = [];
        }
        return ['log' => $data];
    }
}
