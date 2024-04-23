<?php

$module =[
    'module' => 'im',
    'install_name' => 'Instant messenger module',
    'install_descr' => 'The module installs the one-on-one communication tool on your site',
    'category' => 'communication',
    'version' => '5.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/controllers/AdminIm.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/controllers/ApiIm.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/controllers/ClassIm.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/controllers/Im.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/helpers/ImHelper.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/demo_structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/module.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/permissions.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/settings.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/structure_deinstall.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/install/structure_install.sql',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/js/im.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/models/ImContactListModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/models/ImInstallModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/models/ImMessagesModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/im/models/ImModel.php',
        ],
        16 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/im/langs',
        ],
    ],
    'dependencies' => [
        'moderation' => [
            'version' => '1.01',
        ],
        'start' => [
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
            'users' => 'installUsers',
            'friendlist' => 'installFriendlist',
            'network' => 'installNetwork',
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'users' => 'deinstallUsers',
            'friendlist' => 'deinstallFriendlist',
            'network' => 'deinstallNetwork',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
];