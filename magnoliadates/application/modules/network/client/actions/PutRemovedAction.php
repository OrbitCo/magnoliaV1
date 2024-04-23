<?php

use Pg\modules\network\models\NetworkUsersModel;

class PutRemovedAction extends AbstractAction
{
    public function run()
    {
        $net_ids = $this->localAction('getProcessedNetIds', NetworkUsersModel::ACTION_REMOVE, 'net_id');
        if (!empty($net_ids)) {
            $this->log('info', 'putRemoved: ' . serialize($net_ids));
        }
        $data = $this->send('putRemoved', ['id' => serialize($net_ids)], 'POST');
        $this->localAction('deleteTempRecords',
                $net_ids,
            null,
            NetworkUsersModel::ACTION_REMOVE,
            NetworkUsersModel::TYPE_OUT);
        return ['log' => $data];
    }
}
