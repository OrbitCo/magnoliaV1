<?php

$module =[
    'module' => 'moderation',
    'install_name' => 'Moderation module',
    'install_descr' => 'Moderating different types of content including users\' uploads, comments',
    'version' => '5.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/controllers/AdminModeration.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/install/structure_deinstall.sql',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/install/structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/models/ModerationBadwordsModel.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/models/ModerationInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/models/ModerationModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderation/models/ModerationTypeModel.php',
        ],
        9 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/moderation/langs',
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
    ],
    'linked_modules' => [
        'install' => [
            'moderators' => 'installModerators',
            'menu' => 'installMenu',
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'moderators' => 'deinstallModerators',
            'menu' => 'deinstallMenu',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];
