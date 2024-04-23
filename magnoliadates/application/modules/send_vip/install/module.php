<?php

$module =[
    'module' => 'send_vip',
    'install_name' => 'Gift of membership',
    'install_descr' => 'The module allows users to make a gift of paid membership to other members of the site.',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/controllers/AdminSendVip.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/controllers/ApiSendVip.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/controllers/SendVip.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/models/SendVipInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_vip/models/SendVipModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/send_vip/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '2.05',
        ],
        'users_payments' => [
            'version' => '1.04',
        ],
        'payments' => [
            'version' => '2.03',
        ],
        'notifications' => [
            'version' => '1.06',
        ],
        'access_permissions' => [
            'version' => '1.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'notifications' => 'installNotifications',
            'payments' => 'installPayments',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'notifications' => 'deinstallNotifications',
            'payments' => 'deinstallPayments',
            'moderators' => 'deinstallModerators',
        ],
    ],
];