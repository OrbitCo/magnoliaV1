<?php

$module =[
    'module' => 'send_money',
    'install_name' => 'Money gifts',
    'install_descr' => 'The module lets users make money gifts to other site members.',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/controllers/AdminSendMoney.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/controllers/ApiSendMoney.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/controllers/SendMoney.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/models/SendMoneyInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/send_money/models/SendMoneyModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/send_money/langs',
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