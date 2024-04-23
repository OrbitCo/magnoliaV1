<?php

$module =[
    'module' => 'fast_navigation',
    'install_name' => 'Fast navigation',
    'install_descr' => 'Quickly find admin panel sections by headline keywords',
    'version' => '2.00',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/controllers/AdminFastNavigation.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/helpers/FastNavigationHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/install/structure_install.sql',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/install/dating/all/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/install/dating/all/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/fast_navigation/langs',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/fast_navigation/models/FastNavigationModel.php',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];
