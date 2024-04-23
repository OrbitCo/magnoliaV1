<?php

$module =[
    'module' => 'comments',
    'install_name' => 'Comments module',
    'install_descr' => 'This module lets site members post comments on the site ',
    'version' => '3.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/controllers/AdminComments.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/controllers/ApiComments.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/controllers/Comments.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/helpers/CommentsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/demo_structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/settings.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/structure_deinstall.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/install/structure_install.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/js/comments.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/models/CommentsInstallModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/models/CommentsModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/comments/models/CommentsTypesModel.php',
        ],
        14 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/comments/langs',
        ],
    ],
    'demo_content' => [
        'reinstall' => false,
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'moderation' => [
            'version' => '1.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'spam' => 'installSpam',
            'users' => 'installUsers',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'spam' => 'deinstallSpam',
            'users' => 'deinstallUsers',
        ],
    ],
];