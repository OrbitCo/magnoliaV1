<?php

$module =[
    'module' => 'chats',
    'install_name' => 'Chats module',
    'install_descr' => 'This module is a hub that lets you install and activate (video) chat solutions from third parties',
    'category' => 'communication',
    'version' => '4.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/controllers/AdminChats.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/controllers/Chats.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/helpers/ChatsHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chats/install/structure_install.sql',
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
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];
