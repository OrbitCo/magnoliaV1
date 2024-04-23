<?php

$module =[
    'module' => 'blacklist',
    'install_name' => 'Blacklist module',
    'install_descr' => 'The module manages blacklist',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/controllers/ApiBlacklist.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/controllers/Blacklist.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/helpers/BlacklistHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/js/blacklist.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/models/BlacklistCallbacksModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/models/BlacklistInstallModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/blacklist/models/BlacklistModel.php',
        ],
        12 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/blacklist/langs',
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
            'site_map' => 'installSiteMap',
            'banners' => 'installBanners',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'site_map' => 'deinstallSiteMap',
            'banners' => 'deinstallBanners',
        ],
    ],
];