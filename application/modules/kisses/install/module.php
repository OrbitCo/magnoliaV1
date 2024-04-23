<?php

$module =[
    'module' => 'kisses',
    'install_name' => 'Kisses module',
    'install_descr' => 'This module will let site members exchange kisses. Site admin can upload their own kisses images',
    'category' => 'action',
    'version' => '2.09',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/controllers/AdminKisses.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/controllers/Kisses.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/helpers/KissesHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/js/kisses.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/js/kisses_multi_request.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/langs/en/menu.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/langs/en/pages.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/models/KissesInstallModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/kisses/models/KissesModel.php',
        ],
        14 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/kisses-file',
        ],
    ],
    'demo_content' => [
        'reinstall' => false,
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.04',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'users' => [
            'version' => '3.02',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderators' => 'installModerators',
            'uploads' => 'installUploads',
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
            'uploads' => 'deinstallUploads',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
];
