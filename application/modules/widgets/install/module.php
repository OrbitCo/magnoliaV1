<?php

$module =[
    'module' => 'widgets',
    'install_name' => 'Widgets module',
    'install_descr' => 'This module is a hub that allows you to install and activate user widgets and other types of widgets on your site',
    'version' => '2.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/controllers/AdminWidgets.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/controllers/Widgets.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/install/settings.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/models/WidgetsInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/widgets/models/WidgetsModel.php',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '1.01',
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