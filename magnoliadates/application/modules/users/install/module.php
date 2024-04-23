<?php

$module =[
    'module' => 'users',
    'install_name' => 'Site users management',
    'install_descr' => 'This module lets you manage site users including their contact info, profile details and so on',
    'version' => '9.11',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/controllers/AdminUsers.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/controllers/ApiUsers.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/controllers/Users.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/helpers/UsersHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/AuthModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/GroupsModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersInstallModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersDeletedModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersDeleteCallbacksModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersStatusesModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/models/UsersViewsModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/js/users-avatar.js',
        ],
        18 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/js/users-input.js',
        ],
        19 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/js/users-list.js',
        ],
        20 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/js/users-select.js',
        ],
        21 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/users/js/users_multi_request.js',
        ],
        22 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/user-logo',
        ],
        23 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/user-logo/0',
        ],
        24 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/user-logo/0/0',
        ],
        25 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/user-logo/0/0/0',
        ],
        26 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/start/langs',
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
        'uploads' => [
            'version' => '1.03',
        ],
        'moderation' => [
            'version' => '1.03',
        ],
        'properties' => [
            'version' => '1.03',
        ],
        'countries' => [
            'version' => '2.03',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
        'linker' => [
            'version' => '1.01',
        ],
        'field_editor' => [
            'version' => '2.01',
        ],
        'cronjob' => [
            'version' => '1.04',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'uploads' => 'installUploads',
            'site_map' => 'installSiteMap',
            'banners' => 'installBanners',
            'linker' => 'installLinker',
            'moderation' => 'installModeration',
            'moderators' => 'installModerators',
            'notifications' => 'installNotifications',
            'social_networking' => 'installSocialNetworking',
            'field_editor' => 'installFieldEditor',
            'cronjob' => 'installCronjob',
            'services' => 'installServices',
            'geomap' => 'installGeomap',
            'comments' => 'installComments',
            'spam' => 'installSpam',
            'network' => 'installNetwork',
            'ratings' => 'installRatings',
            'bonuses' => 'installBonuses',
            'access_permissions' => 'installAccessPermissions',
            'mobile' => 'installMobile',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'uploads' => 'deinstallUploads',
            'content' => 'deinstallContent',
            'site_map' => 'deinstallSiteMap',
            'banners' => 'deinstallBanners',
            'linker' => 'deinstallLinker',
            'moderation' => 'deinstallModeration',
            'moderators' => 'deinstallModerators',
            'notifications' => 'deinstallNotifications',
            'social_networking' => 'deinstallSocialNetworking',
            'field_editor' => 'deinstallFieldEditor',
            'cronjob' => 'deinstallCronjob',
            'services' => 'deinstallServices',
            'geomap' => 'deinstallGeomap',
            'comments' => 'deinstallComments',
            'spam' => 'deinstallSpam',
            'network' => 'deinstallNetwork',
            'ratings' => 'deinstallRatings',
            'bonuses' => 'deinstallBonuses',
            'access_permissions' => 'deinstallAccessPermissions',
            'mobile' => 'deinstallMobile',
        ],
    ],
];
