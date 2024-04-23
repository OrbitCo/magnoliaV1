<?php

$module =[
    'module' => 'like_me',
    'install_name' => 'LikeMe module',
    'install_descr' => 'The module lets site members rate people by liking/skipping them and be notified when there is a match',
    'version' => '5.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/controllers/AdminLikeMe.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/controllers/ApiLikeMe.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/controllers/LikeMe.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/helpers/LikeMeHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/js/like_me.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/js/match_me.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/models/LikeMeInstallModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/like_me/models/LikeMeModel.php',
        ],
        13 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/like_me/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '1.01',
        ],
        'users' => [
            'version' => '1.01',
        ],
        'notifications' => [
            'version' => '1.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'ausers' => 'installAusers',
            'bonuses' => 'installBonuses',
            'menu' => 'installMenu',
            'notifications' => 'installNotifications',
            'moderators' => 'installModerators',
            'start' => 'installStart',
            'users' => 'installUsers',
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'ausers' => 'deinstallAusers',
            'bonuses' => 'deinstallBonuses',
            'menu' => 'deinstallMenu',
            'notifications' => 'deinstallNotifications',
            'moderators' => 'deinstallModerators',
            'start' => 'deinstallStart',
            'users' => 'deinstallUsers',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
];
