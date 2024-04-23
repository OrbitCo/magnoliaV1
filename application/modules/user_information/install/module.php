<?php

$module =[
    'module' => 'user_information',
    'install_name' => 'User information module',
    'install_descr' => 'Use this module to give your site members the opportunity to download their personal data from your site',
    'version' => '1.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/controllers/AdminUserInformation.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/controllers/ApiUserInformation.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/controllers/UserInformation.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/models/UserInformationInstallModel.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/user_information/models/UserInformationModel.php',
        ],
        6 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/user_information/langs/',
        ],
    ],
    'dependencies' => [
        'menu' => [
            'version' => '4.02',
        ],
        'properties' => [
            'version' => '3.02',
        ],
        'users' => [
            'version' => '7.01',
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
