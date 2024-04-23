<?php

$module =[
    'module' => 'content',
    'install_name' => 'Info pages',
    'install_descr' => 'Creating and editing info pages (posts and articles with media content on your site)',
    'version' => '4.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/controllers/AdminContent.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/controllers/ApiContent.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/controllers/Content.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/helpers/ContentHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/demo_content_dating.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/demo_content_social.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/module.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/permissions.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/structure_deinstall.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/install/structure_install.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/models/ContentInstallModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/models/ContentModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/content/models/ContentPromoModel.php',
        ],
        13 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/content/langs',
        ],
        14 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/info-page-logo/',
        ],
        15 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/promo-content-img/',
        ],
        16 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/promo-content-img/0',
        ],
        17 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/promo-content-img/0/0',
        ],
        18 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/promo-content-img/0/0/0',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'uploads' => [
            'version' => '1.03',
        ],
        'file_uploads' => [
            'version' => '1.03',
        ],
        'video_uploads' => [
            'version' => '1.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'site_map' => 'installSiteMap',
            'banners' => 'installBanners',
            'moderators' => 'installModerators',
            'uploads' => 'installUploads',
            'file_uploads' => 'installFileUploads',
            'social_networking' => 'installSocialNetworking',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'site_map' => 'deinstallSiteMap',
            'banners' => 'deinstallBanners',
            'moderators' => 'deinstallModerators',
            'uploads' => 'deinstallUploads',
            'file_uploads' => 'deinstallFileUploads',
            'social_networking' => 'deinstallSocialNetworking',
        ],
    ],
];