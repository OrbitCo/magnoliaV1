<?php

use Pg\modules\user_information\models\UserInformationModel;

return [
    'cron_data' => [
        [
            "name"     => "Create an archive with user information",
            "module"   => UserInformationModel::MODULE_GID,
            "model"    => "User_information_model",
            "method"   => "cronArchiveCreate",
            "cron_tab" => "*/10 * * * *",
            "status"   => "1",
        ],
        [
            "name"     => "Delete an archive with user information",
            "module"   => UserInformationModel::MODULE_GID,
            "model"    => "User_information_model",
            "method"   => "cronArchiveDelete",
            "cron_tab" => "0 0 */2 * *",
            "status"   => "1",
        ]
    ]
];
