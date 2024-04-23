<?php

$module =[
    'module' => 'chatbox',
    'install_name' => 'Messaging center',
    'category' => 'communication',
    'install_descr' => 'The module installs messaging center on your site',
    'version' => '1.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/controllers/Chatbox.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/helpers/ChatboxHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/install/settings.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/js/chatbox_multi_request.js',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/js/chatbox.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/models/ChatboxModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/models/ChatboxContactListModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/models/ChatboxAttachesModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/models/ChatboxInstallModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/chatbox/models/ChatboxUserInformationModel.php',
        ],
        14 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/chatbox/langs',
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
            'version' => '1.03',
        ],
        'users' => [
            'version' => '3.01',
        ],
        'notifications' => [
            'version' => '1.04',
        ],
        'im' => [
            'version' => '5.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'notifications' => 'installNotifications',
            'site_map' => 'installSiteMap',
            'file_uploads' => 'installFileUploads',
            'uploads' => 'installUploads',
            'banners' => 'installBanners',
            'access_permissions' => 'installAccessPermissions',
            'mobile' => 'installMobile',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'notifications' => 'deinstallNotifications',
            'site_map' => 'deinstallSiteMap',
            'file_uploads' => 'deinstallFileUploads',
            'uploads' => 'deinstallUploads',
            'banners' => 'deinstallBanners',
            'access_permissions' => 'deinstallAccessPermissions',
            'mobile' => 'deinstallMobile',
        ],
    ],
];
