<?php

$module =[
    'module' => 'likes',
    'install_name' => 'Likes module',
    'install_descr' => 'This module lets site members \'like\' different objects such as photos, wall posts etc.',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/hooks/autoload/pre_view-get_likes.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/controllers/ApiLikes.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/controllers/Likes.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/helpers/LikesHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/js/likes.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/models/LikesInstallModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/likes/models/LikesModel.php',
        ],
        11 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/likes/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'bonuses' => 'installBonuses',
            'users' => 'installUsers',
        ],
        'deinstall' => [
            'bonuses' => 'deinstallBonuses',
            'users' => 'deinstallUsers',
        ],
    ],
];
