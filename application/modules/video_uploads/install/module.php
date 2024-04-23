<?php

$module =[
    'module' => 'video_uploads',
    'install_name' => 'Video settings management',
    'install_descr' => 'Managing parameters of video uploads',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/controllers/AdminVideoUploads.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/controllers/VideoUploads.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/install/settings.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsConfigModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsLocalModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsProcessModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsSettingsModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/video_uploads/models/VideoUploadsYoutubeModel.php',
        ],
        14 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/video_uploads/langs',
        ],
        15 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads',
        ],
        16 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video-default',
        ],
        17 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'cronjob' => [
            'version' => '1.04',
        ],
    ],
    'libraries' => [
        0 => 'Zend',
        1 => 'VideoEmbed',
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'video_uploads' => 'installVideoUploads',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];