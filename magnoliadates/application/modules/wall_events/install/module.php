<?php

$module =[
    'module' => 'wall_events',
    'install_name' => 'Wall events module',
    'install_descr' => 'The module displays different events on the user walls',
    'version' => '3.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/controllers/AdminWallEvents.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/controllers/ApiWallEvents.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/controllers/WallEvents.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/helpers/WallEventsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/demo_structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/settings.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/structure_deinstall.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/install/structure_install.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/js/wall.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/models/WallEventsInstallModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/models/WallEventsModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/models/WallEventsPermissionsModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/wall_events/models/WallEventsTypesModel.php',
        ],
        15 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/wall_events/langs',
        ],
        16 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/wall-image',
        ],
        17 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/wall-image/0',
        ],
        18 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/wall-image/0/0',
        ],
        19 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/wall-image/0/0/0',
        ],
        20 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/video/wall-video',
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
        'video_uploads' => [
            'version' => '1.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'comments' => 'installComments',
            'uploads' => 'installUploads',
            'video_uploads' => 'installVideoUploads',
            'spam' => 'installSpam',
            'users' => 'installUsers',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'comments' => 'deinstallComments',
            'uploads' => 'deinstallUploads',
            'video_uploads' => 'deinstallVideoUploads',
            'spam' => 'deinstallSpam',
            'users' => 'deinstallUsers',
        ],
    ],
];