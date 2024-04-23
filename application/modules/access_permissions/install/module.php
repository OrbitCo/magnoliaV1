<?php

$module =[
    'module' => 'access_permissions',
    'install_name' => 'Access permissions',
    'install_descr' => 'Access permissions for guests vs authorized members, or men vs women, etc.',
    'version' => '5.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/controllers/AdminAccessPermissions.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/controllers/ApiAccessPermissions.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/controllers/AccessPermissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/helpers/AccessPermissionsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/models/AccessPermissionsInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/models/AccessPermissionsModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/views/gentelella/index.twig',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/access_permissions/views/flatty/index.twig',
        ],
        11 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/access_permissions/langs/',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'services' => [
            'version' => '3.01',
        ],
        'users' => [
            'version' => '5.02',
        ],
        'users_payments' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'payments' => 'installPayments',
            'cronjob' => 'installCronjob',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'payments' => 'deinstallPayments',
            'cronjob' => 'deinstallCronjob',
            'moderators' => 'deinstallModerators',
        ],
    ],
];
