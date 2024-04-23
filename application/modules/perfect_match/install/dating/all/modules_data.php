<?php

use Pg\modules\perfect_match\models\PerfectMatchModel;

return [
    'push_notifications' => [
        'match' => [
            'gid'=> 'match',
            'module' => PerfectMatchModel::MODULE_GID,
            'status' => 0
        ]
    ],
    'cron_jobs' => [
        [
            "name" => "Perfect match",
            "module" => "perfect_match",
            "model" => "Perfect_match_model",
            "method" => "cronSendMatches",
            "cron_tab" => "24 */6 * * *",
            "status" => "1",
        ],
    ],
];
