<?php

$module =[
    'module' => 'seo',
    'install_name' => 'SEO settings',
    'install_descr' => 'Basic SEO tools including title, keywords, description meta tags and Open Graph tags',
    'version' => '4.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/controllers/AdminSeo.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/install/settings.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/models/SeoInstallModel.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo/models/SeoModel.php',
        ],
        6 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/seo/langs',
        ],
        7 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/config/seo_module_routes.php',
        ],
        8 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/config/seo_module_routes.xml',
        ],
        9 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/config/langs_route.php',
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