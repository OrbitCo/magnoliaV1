<?php

$module =[
    'module' => 'banners',
    'install_name' => 'Banners module',
    'install_descr' => 'Banners management, including prices, banner positions on pages',
    'version' => '6.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/controllers/AdminBanners.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/controllers/ApiBanners.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/controllers/Banners.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/helpers/BannersHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/js/admin_banner.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/js/banner-activate.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/js/banners.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/models/BannerGroupModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/models/BannerPlaceModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/models/BannersInstallModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/models/BannersModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/banners/models/BannersStatModel.php',
        ],
        17 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/banners/langs',
        ],
        18 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/banner',
        ],
        19 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/banner/0',
        ],
        20 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/banner/0/0',
        ],
        21 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/banner/0/0/0',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'moderation' => [
            'version' => '1.01',
        ],
        'uploads' => [
            'version' => '1.03',
        ],
        'notifications' => [
            'version' => '1.03',
        ],
        'cronjob' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'uploads' => 'installUploads',
            'services' => 'installServices',
            'cronjob' => 'installCronjob',
            'moderators' => 'installModerators',
            'notifications' => 'installNotifications',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'uploads' => 'deinstallUploads',
            'services' => 'deinstallServices',
            'cronjob' => 'deinstallCronjob',
            'moderators' => 'deinstallModerators',
            'notifications' => 'deinstallNotifications',
        ],
    ],
];
