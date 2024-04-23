<?php

$module =[
    'module' => 'media',
    'install_name' => 'Media module',
    'install_descr' => 'Multimedia uploads and site galleries',
    'version' => '4.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/controllers/AdminMedia.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/controllers/ApiMedia.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/controllers/Media.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/helpers/MediaHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/demo_structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/settings.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/structure_deinstall.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/install/structure_install.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/js/albums.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/js/edit_media.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/js/gallery.js',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/js/media.js',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/models/AlbumTypesModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/models/AlbumsModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/models/MediaAlbumModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/models/MediaInstallModel.php',
        ],
        18 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/media/models/MediaModel.php',
        ],
        19 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/media/langs',
        ],
        20 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/gallery_image/',
        ],
        21 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video-default',
        ],
        22 => [
            0 => 'file',
            1 => 'write',
            2 => 'uploads/video-default/media-video-default.png',
        ],
        23 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/default',
        ],
        24 => [
            0 => 'file',
            1 => 'write',
            2 => 'uploads/default/default-gallery-image.png',
        ],
        25 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video/gallery_video',
        ],
        26 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/gallery_image',
        ],
        27 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/gallery_image/0',
        ],
        28 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/gallery_image/0/0',
        ],
        29 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/gallery_image/0/0/0',
        ],
    ],
    'demo_content' => [
        'reinstall' => false,
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'uploads' => 'installUploads',
            'comments' => 'installComments',
            'video_uploads' => 'installVideoUploads',
            'moderation' => 'installModeration',
            'wall_events' => 'installWallEvents',
            'site_map' => 'installSiteMap',
            'spam' => 'installSpam',
            'users' => 'installUsers',
            'aviary' => 'installAviary',
            'ratings' => 'installRatings',
            'friendlist' => 'installFriendlist',
            'bonuses' => 'installBonuses',
            'access_permissions' => 'installAccessPermissions',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'uploads' => 'deinstallUploads',
            'comments' => 'deinstallComments',
            'video_uploads' => 'deinstallVideoUploads',
            'moderation' => 'deinstallModeration',
            'wall_events' => 'deinstallWallEvents',
            'site_map' => 'deinstallSiteMap',
            'spam' => 'deinstallSpam',
            'users' => 'deinstallUsers',
            'aviary' => 'deinstallAviary',
            'ratings' => 'deinstallRatings',
            'friendlist' => 'deinstallFriendlist',
            'bonuses' => 'deinstallBonuses',
            'access_permissions' => 'deinstallAccessPermissions',
            'moderators' => 'deinstallModerators',
        ],
    ],
];
