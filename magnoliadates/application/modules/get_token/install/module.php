<?php

$module =[
    'module' => 'get_token',
    'install_name' => 'Product Api',
    'install_descr' => 'This module lets you access tokens and use API methods',
    'version' => '3.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/helpers/api_helper.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/controllers/ApiGetToken.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/get_token/models/GetTokenInstallModel.php',
        ],
    ],
    'dependencies' => [
        'users' => [
            'version' => '3.01',
        ],
    ],
    'libraries' => [
        0 => 'Array2XML',
    ],
    'linked_modules' => [
        'install' => [
            'bonuses' => 'installBonuses',
        ],
        'deinstall' => [
            'bonuses' => 'deinstallBonuses',
        ],
    ],
];
