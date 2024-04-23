<?php

$module =[
    'module' => 'winks',
    'install_name' => 'Winks module',
    'install_descr' => 'This module will let site members exchange winks as a means of attracting attention or establishing first contact.',
    'category' => 'action',
    'version' => '3.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/controllers/AdminWinks.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/controllers/Winks.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/helpers/WinksHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/js/winks.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/js/winks_multi_request.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/en/arbitrary.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/en/menu.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/en/pages.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/ru/arbitrary.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/ru/menu.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/langs/ru/pages.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/models/WinksInstallModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/winks/models/WinksModel.php',
        ],
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
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
];
