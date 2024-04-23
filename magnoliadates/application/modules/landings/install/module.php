<?php

$module =[
    'module' => 'landings',
    'install_name' => 'Landings module',
    'install_descr' => 'Add landing pages to your website by uploading an archive with the landing page files or by connecting to an existing web page',
    'version' => '3.02',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/hooks/autoload/pre_system-get_landing_pages.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/controllers/AdminLandings.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/models/LandingsInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/landings/models/LandingsModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/landings/langs',
        ],
        9 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/config/landings_module_routes.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/landings',
        ],
        11 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/landings',
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
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
        ],
    ],
];