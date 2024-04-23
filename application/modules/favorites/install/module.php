<?php

$module = [
    'module' => 'favorites',
    'install_name' => 'Favorites module',
    'install_descr' => 'The module lets site members mark each other as favorites. No confirmation is required',
    'category' => 'action',
    'version' => '4.02',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/controllers/ApiFavorites.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/controllers/Favorites.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/helpers/FavoritesHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/js/favorites.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/models/FavoritesCallbacksModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/models/FavoritesInstallModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/favorites/models/FavoritesModel.php',
        ],
        12 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/favorites/langs',
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
        'notifications' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'site_map' => 'installSiteMap',
            'banners' => 'installBanners',
            'access_permissions' => 'installAccessPermissions',
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'site_map' => 'deinstallSiteMap',
            'banners' => 'deinstallBanners',
            'access_permissions' => 'deinstallAccessPermissions',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];
