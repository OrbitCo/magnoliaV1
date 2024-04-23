<?php

$module =[
    'module' => 'spam',
    'install_name' => 'Spam',
    'install_descr' => 'The spam module lets site members flag users, comments and media content. It also includes administration panel settings',
    'version' => '3.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/controllers/AdminSpam.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/controllers/ApiSpam.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/controllers/Spam.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/helpers/SpamHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/js/spam.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/models/SpamAlertModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/models/SpamInstallModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/models/SpamReasonModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/spam/models/SpamTypeModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'dir',
            2 => 'application/modules/spam/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '1.01',
        ],
        'moderation' => [
            'version' => '1.01',
        ],
        'notifications' => [
            'version' => '1.03',
        ],
        'users' => [
            'version' => '2.02',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'notifications' => 'installNotifications',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'notifications' => 'deinstallNotifications',
            'moderators' => 'deinstallModerators',
        ],
    ],
];
