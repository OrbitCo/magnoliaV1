<?php

$module =[
    'module' => 'statistics',
    'install_name' => 'Statistics',
    'install_descr' => 'Statistics management',
    'version' => '3.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/controllers/AdminStatistics.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/controllers/ApiStatistics.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/controllers/Statistics.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/models/StatisticsInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/statistics/models/StatisticsModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/statistics/langs',
        ],
        11 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/logs/statistics',
        ],
    ],
    'dependencies' => [
        'menu' => [
            'version' => '1.01',
        ],
        'start' => [
            'version' => '1.01',
        ],
    ],
    'libraries' => [
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'start' => 'installStart',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'start' => 'deinstallStart',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];
