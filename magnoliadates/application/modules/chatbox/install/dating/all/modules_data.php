<?php

use Pg\modules\chatbox\models\ChatboxModel;

return [
    'push_notifications' => [
        'new_message' => [
            'gid' => 'new_message',
            'module' => ChatboxModel::MODULE_GID,
            'status' => 0
        ]
    ]
];
