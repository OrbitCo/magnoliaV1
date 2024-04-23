<?php

$module =[
    'module' => 'users_payments',
    'install_name' => 'Users payments module',
    'install_descr' => 'This module applies the payments module options to users, for example lets site users have money added to their internal accounts',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/controllers/AdminUsersPayments.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/controllers/ApiUsersPayments.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/controllers/UsersPayments.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/helpers/UsersPaymentsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/install/demo_structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/models/UsersPaymentsInstallModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users_payments/models/UsersPaymentsModel.php',
        ],
        11 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/users_payments/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
        'payments' => [
            'version' => '2.01',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'payments' => 'installPayments',
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'payments' => 'deinstallPayments',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];