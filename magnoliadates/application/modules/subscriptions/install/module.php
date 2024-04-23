<?php

$module =[
    'module' => 'subscriptions',
    'install_name' => 'Users subscriptions management',
    'install_descr' => 'Managing user subscriptions',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/controllers/AdminSubscriptions.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/helpers/SubscriptionsHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/models/SubscriptionsInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/models/SubscriptionsModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/models/SubscriptionsTypesModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/subscriptions/models/SubscriptionsUsersModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/subscriptions/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
        'users' => [
            'version' => '3.01',
        ],
        'cronjob' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'cronjob' => 'installCronjob',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'cronjob' => 'deinstallCronjob',
            'moderators' => 'deinstallModerators',
        ],
    ],
];