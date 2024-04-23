<?php

class PutRemovedStatusAction extends AbstractAction
{
    public function run()
    {
        $net_ids = $this->localAction('getProcessedNetIds', 'remove');
        if (empty($net_ids)) {
            return ['log' => []];
        }
        $this->log('info', 'putRemovedStatus: ' . serialize($net_ids));
        $data = $this->send('putRemovedStatus', ['id' => serialize($net_ids)], 'POST');
        $this->localAction('deleteTempRecords', $net_ids, null, 'remove', 'out');
        return ['log' => $data];
    }
}
