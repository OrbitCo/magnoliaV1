<?php

$module =[
    'module' => 'notifications',
    'install_name' => 'Site alerts management',
    'install_descr' => 'Managing templates, texts and settings of email notifications',
    'version' => '4.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/controllers/AdminNotifications.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/install/settings.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/models/NotificationsInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/models/NotificationsModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/models/TemplatesModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/notifications/models/SenderModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/notifications/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
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