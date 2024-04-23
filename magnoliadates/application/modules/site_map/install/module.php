<?php

$module =[
    'module' => 'site_map',
    'install_name' => 'Sitemap generation',
    'install_descr' => 'The module gets modules links and generates the sitemap page ',
    'version' => '2.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/controllers/SiteMap.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/install/structure_deinstall.sql',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/install/structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/models/SiteMapInstallModel.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/site_map/models/SiteMapModel.php',
        ],
        7 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/site_map/langs',
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
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
        ],
    ],
];