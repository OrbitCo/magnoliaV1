<?php

$module =[
    'module' => 'news',
    'install_name' => 'News module',
    'install_descr' => 'Managing site news, including RSS feeds',
    'version' => '4.01',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/controllers/AdminNews.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/controllers/ApiNews.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/controllers/News.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/helpers/NewsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/models/NewsInstallModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/models/NewsModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/news/models/FeedsModel.php',
        ],
        12 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/news/langs',
        ],
        13 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video-default',
        ],
        14 => [
            0 => 'file',
            1 => 'write',
            2 => 'uploads/video-default/news-video-default.jpg',
        ],
        15 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/news-logo',
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
        'video_uploads' => [
            'version' => '1.03',
        ],
    ],
    'libraries' => [
        0 => 'SimplePie',
        1 => 'Rssfeed',
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'uploads' => 'installUploads',
            'site_map' => 'installSiteMap',
            'cronjob' => 'installCronjob',
            'banners' => 'installBanners',
            'subscriptions' => 'installSubscriptions',
            'video_uploads' => 'installVideoUploads',
            'social_networking' => 'installSocialNetworking',
            'moderators' => 'installModerators',
            'comments' => 'installComments',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'uploads' => 'deinstallUploads',
            'video_uploads' => 'deinstallVideoUploads',
            'site_map' => 'deinstallSiteMap',
            'cronjob' => 'deinstallCronjob',
            'banners' => 'deinstallBanners',
            'social_networking' => 'deinstallSocialNetworking',
            'moderators' => 'deinstallModerators',
            'subscriptions' => 'deinstallSubscriptions',
            'comments' => 'deinstallComments',
        ],
    ],
];
