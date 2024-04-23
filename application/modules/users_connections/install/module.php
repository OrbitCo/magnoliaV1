<?php

$module =[
    'module' => 'users_connections',
    'install_name' => 'Users connections module',
    'install_descr' => 'The users connections module has to do with authorization methods including OAuth',
    'version' => '3.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/controllers/UsersConnections.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/helpers/UsersConnectionsHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/models/UsersConnectionsModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_connections/models/UsersConnectionsInstallModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/users_connections/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'social_networking' => [
            'version' => '1.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
        ],
        'deinstall' => [
        ],
    ],
];
