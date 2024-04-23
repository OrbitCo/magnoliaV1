<?php

$module =[
    'module' => 'payments',
    'install_name' => 'Payments module',
    'install_descr' => 'Payments settings including payment systems activation, payments history, manual payments moderation',
    'version' => '7.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/controllers/AdminPayments.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/controllers/ApiPayments.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/controllers/Payments.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/helpers/PaymentsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/js/admin-payments-settings.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/js/admin-payments.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/js/payment-system-tarifs.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/systems/OfflineModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/PaymentCurrencyModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/PaymentDriverModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/PaymentSystemsModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/PaymentsInstallModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/PaymentsModel.php',
        ],
        18 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/XeCurrencyRatesModel.php',
        ],
        19 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/payments/models/YahooCurrencyRatesModel.php',
        ],
        20 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/payments/langs',
        ],
        21 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/payments-logo',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'moderation' => [
            'version' => '1.01',
        ],
        'users' => [
            'version' => '3.01',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'moderators' => 'installModerators',
            'cronjob' => 'installCronjob',
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'moderators' => 'deinstallModerators',
            'cronjob' => 'deinstallCronjob',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];
