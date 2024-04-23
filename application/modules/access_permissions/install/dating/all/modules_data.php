<?php

use Pg\modules\access_permissions\models\AccessPermissionsModel;

return [
    'menu' => [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'system_items' => [
                    'action' => 'none',
                    'items'  => [
                        'payments_menu_item' => [
                            'action' => 'none',
                            'items' => [
                                'access_permissions_menu_item' => ['action' => 'create', 'link' => 'admin/' . AccessPermissionsModel::MODULE_GID . '/registered', 'status' => 1],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_access_all_users_menu' => [
            'action' => 'create',
            'name'   => 'Access permissions section menu',
            'items'  => [
                'registered'     => ['action' => 'create', 'link' => 'admin/' . AccessPermissionsModel::MODULE_GID . '/registered', 'status' => 1, 'sorter' => 1],
                'guest' => ['action' => 'create', 'link' => 'admin/' . AccessPermissionsModel::MODULE_GID . '/guest', 'status' => 1, 'sorter' => 2],
            ],
        ],
        'admin_access_user_types_menu' => [
            'action' => 'create',
            'name'   => 'Access permissions section menu',
            'items'  => [
                'guest' => ['action' => 'create', 'link' => 'admin/' . AccessPermissionsModel::MODULE_GID . '/guest', 'status' => 1, 'sorter' => 1],
            ],
        ],
        'settings_menu' => [
            'action' => 'none',
            'items'  => [
                'account-item' => [
                    'action' => 'none',
                    'items'  => [
                        'access_permissions_menu_item' => ["action" => "create", 'link' => AccessPermissionsModel::MODULE_GID . '/index', 'status' => 1, 'sorter' => 1],
                    ],
                ],
            ],
        ],
    ],
    'payment_types' => [
        [
            'gid' => AccessPermissionsModel::MODULE_GID,
            'callback_module' => AccessPermissionsModel::MODULE_GID,
            'callback_model'  => 'Access_permissions_model',
            'callback_method' => 'paymentStatus',
        ],
    ],
    'cron_data' => [
        [
            "name"     => "Update users group",
            "module"   => AccessPermissionsModel::MODULE_GID,
            "model"    => "Access_permissions_users_model",
            "method"   => "cronUpdateGroups",
            "cron_tab" => "18 */6 * * *",
            "status"   => "1",
        ],
    ],
    'menu_indicators' => [],
    'services' => [],
    'moderators_methods' => [
        ['module' => AccessPermissionsModel::MODULE_GID, 'method' => 'registered', 'is_default' => 1, 'group_id' => 5, 'is_hidden' => 0, 'parent_module' => '']
    ]
];
