<?php

$module =[
    'module' => 'moderators',
    'install_name' => 'Moderators management',
    'install_descr' => 'This module lets you create, edit and delete moderators accounts',
    'version' => '3.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/hooks/autoload/post_controller_constructor-check_moderator_access.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/controllers/AdminModerators.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/helpers/ModeratorsHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/models/ModeratorsInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/moderators/models/ModeratorsModel.php',
        ],
        9 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/moderators/langs',
        ],
    ],
    'dependencies' => [
        'ausers' => [
            'version' => '2.03',
        ],
    ],
];