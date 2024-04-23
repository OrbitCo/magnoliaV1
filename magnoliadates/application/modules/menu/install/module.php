<?php

$module =[
    'module' => 'menu',
    'install_name' => 'Menu management',
    'install_descr' => 'The module allows you to create and edit user and admin menus on the site',
    'version' => '5.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/controllers/AdminMenu.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/helpers/MenuHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/install/settings.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/js/menu-bookmark.js',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/models/MenuInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/models/MenuModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/menu/models/IndicatorsModel.php',
        ],
        11 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/menu/langs',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/hooks/autoload/post_controller_constructor-fetch_menu_indicators.php',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'moderators' => 'installModerators',
            'start' => 'installMenu',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'moderators' => 'deinstallModerators',
            'start' => 'deinstallMenu',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];