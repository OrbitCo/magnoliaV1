<?php

$module =[
    'module' => 'seo_advanced',
    'install_name' => 'Advanced SEO settings',
    'install_descr' => 'Advanced SEO settings including analytics, trackers, robots.txt and site map',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/controllers/AdminSeoAdvanced.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/helpers/SeoAdvancedHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/helpers/SeoAnalyticsHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/js/seo-url-creator.js',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/models/SeoAdvancedInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/seo_advanced/models/SeoAdvancedModel.php',
        ],
        9 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/seo_advanced/langs',
        ],
        10 => [
            0 => 'file',
            1 => 'write',
            2 => 'robots.txt',
        ],
        11 => [
            0 => 'file',
            1 => 'write',
            2 => 'sitemap.xml',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '1.01',
        ],
        'seo' => [
            'version' => '2.01',
        ],
    ],
    'libraries' => [
        0 => 'Whois',
        1 => 'Googlepr',
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderators' => 'installModerators',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];