<?php

$module =[
    'module' => 'ausers',
    'install_name' => 'Administrators management',
    'install_descr' => 'This module lets you create, edit and delete administrator accounts',
    'version' => '6.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/hooks/autoload/post_controller_constructor-check_moderator_access.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/controllers/AdminAusers.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/models/AusersInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/ausers/models/AusersModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/ausers/langs',
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
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];