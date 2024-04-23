<?php

use Pg\modules\network\models\NetworkUsersModel;

class PutUpdatedAction extends AbstractAction
{
    public function run()
    {
        $update_records = $this->localAction('getTempProfiles',
            NetworkUsersModel::ACTION_UPDATE,
            ['data', 'local_id']
        );
        $updated_data = [];
        $local_ids = [];
        foreach ($update_records as $update_record) {
            $updated_data[] = unserialize($update_record['data']);
            $local_ids[] = $update_record['local_id'];
        }
        if (!empty($updated_data)) {
            $this->log('info', 'putUpdated: ' . serialize($updated_data));
        }
        $data = $this->send('putUpdated', ['profiles' => serialize($updated_data)], 'POST');
        $this->localAction('deleteTempRecords',
                null,
            $local_ids,
            NetworkUsersModel::ACTION_UPDATE,
            NetworkUsersModel::TYPE_OUT);
        return ['log' => $data];
    }
}
