<?php

$module =[
    'module' => 'services',
    'install_name' => 'Services module',
    'install_descr' => 'The module stores the settings and logs of paid services',
    'version' => '4.09',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/controllers/AdminServices.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/controllers/ApiServices.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/controllers/Services.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/helpers/ServicesHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/install/demo_content.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/js/services.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/models/ServicesInstallModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/models/ServicesModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/services/models/ServicesUsersModel.php',
        ],
        13 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/services/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'payments' => [
            'version' => '2.01',
        ],
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'payments' => 'installPayments',
            'memberships' => 'installMemberships',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'payments' => 'deinstallPayments',
            'memberships' => 'deinstallMemberships',
            'moderators' => 'deinstallModerators',
        ],
    ],
];
