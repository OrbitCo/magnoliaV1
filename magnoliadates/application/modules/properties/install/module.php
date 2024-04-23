<?php

$module =[
    'module' => 'properties',
    'install_name' => 'Properties management',
    'install_descr' => 'User types management, creating new user types',
    'version' => '3.06',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/controllers/AdminProperties.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/controllers/ApiProperties.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/controllers/Properties.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/helpers/PropertiesHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/models/PropertiesInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/properties/models/PropertiesModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/properties/langs',
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
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
        ],
    ],
];