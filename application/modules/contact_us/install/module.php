<?php

$module =[
    'module' => 'contact_us',
    'install_name' => 'Contact module',
    'install_descr' => 'Contact us form for users, and special settings in administration panel (editing reasons for contact, email addresses that messages will be forwarded to)',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/controllers/AdminContactUs.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/controllers/ApiContactUs.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/controllers/ContactUs.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/models/ContactUsInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/contact_us/models/ContactUsModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/contact_us/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'banners' => 'installBanners',
            'notifications' => 'installNotifications',
            'site_map' => 'installSiteMap',
            'social_networking' => 'installSocialNetworking',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'banners' => 'deinstallBanners',
            'notifications' => 'deinstallNotifications',
            'site_map' => 'deinstallSiteMap',
            'social_networking' => 'deinstallSocialNetworking',
        ],
    ],
];