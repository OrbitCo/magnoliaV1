<?php

$module =[
    'module' => 'cronjob',
    'install_name' => 'Cronjob module',
    'install_descr' => 'This module lets you set up and manage cron jobs',
    'version' => '3.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/controllers/AdminCronjob.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/controllers/Cronjob.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/messages.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/models/CronjobModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cronjob/models/CronjobInstallModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/cronjob/langs',
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
    'libraries' => [
        0 => 'Cronparser',
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
        ],
    ],
];
