<?php

$module =[
    'module' => 'themes',
    'install_name' => 'Themes management',
    'install_descr' => 'The module allows you to install, activate, edit site themes',
    'version' => '8.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/controllers/AdminThemes.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/controllers/Themes.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/install/structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/models/ThemesInstallModel.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/themes/models/ThemesModel.php',
        ],
        7 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/themes/langs',
        ],
        8 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/logo',
        ],
        9 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/sets',
        ],
        10 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/gentelella/logo',
        ],
        11 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/gentelella/sets',
        ],
        12 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/scss',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
        ],
    ],
];