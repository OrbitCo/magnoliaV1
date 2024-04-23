<?php

use Pg\modules\network\models\NetworkModel;
use Pg\modules\network\models\NetworkUsersModel;

return [
    'menu' => [
        'admin_menu' => [
            'action' => 'none',
            'items' => [
                'settings_items' => [
                    'action' => 'none',
                    'items' => [
                        'system-items' => [
                            'action' => 'none',
                            'items' => [
                                'network_menu_item' => [
                                    'action' => 'create',
                                    'link' => 'admin/network/',
                                    'status' => 1,
                                    'sorter' => 12,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'moderation_types' => [
        [
            'name' => NetworkUsersModel::MODERATION_TYPE,
            'module' => NetworkModel::MODULE_GID,
            'model' => 'NetworkUsersModel',
            'method_get_list' => 'moderationList',
            'method_set_status' => 'moderationSetStatus',
            'allow_to_decline' => '1',
            'template_list_row' => 'moderation_block',
            'mtype' => '2',
        ],
    ],
    'action_config' => [
        'network_join' => [
            'is_percent' => 0,
            'once' => 1,
            'available_period' => ['once'],
        ],
    ],
    'cron' => [
        'name' => 'Process network temp',
        'module' => NetworkModel::MODULE_GID,
        'model' => 'NetworkUsersModel',
        'method' => 'process_temp',
        'cron_tab' => '*/21 * * * *',
        'status' => true,
    ]
];
