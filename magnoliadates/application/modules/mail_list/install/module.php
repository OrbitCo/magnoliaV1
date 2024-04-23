<?php

$module =[
    'module' => 'mail_list',
    'install_name' => 'Mailing lists management',
    'install_descr' => 'Manage mailing lists for users',
    'version' => '2.06',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/js/admin-mail-list.js',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/controllers/AdminMailList.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/models/MailListInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/mail_list/models/MailListModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/mail_list/langs',
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
        'subscriptions' => [
            'version' => '1.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'ausers' => 'installAusers',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
        ],
    ],
];