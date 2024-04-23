<?php

$module =[
    'module' => 'polls',
    'install_name' => 'Polls management',
    'install_descr' => 'Managing polls and polls statistics',
    'version' => '2.09',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/controllers/AdminPolls.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/controllers/ApiPolls.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/controllers/Polls.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/helpers/PollsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/demo_content.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/settings.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/structure_deinstall.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/install/structure_install.sql',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/js/admin-polls.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/js/polls.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/models/PollsInstallModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/polls/models/PollsModel.php',
        ],
        14 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/polls/langs',
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
        'users' => [
            'version' => '3.01',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderation' => 'installModeration',
            'site_map' => 'installSiteMap',
            'moderators' => 'installModerators',
            'bonuses' => 'installBonuses',
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderation' => 'deinstallModeration',
            'site_map' => 'deinstallSiteMap',
            'moderators' => 'deinstallModerators',
            'bonuses' => 'deinstallBonuses',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
];
