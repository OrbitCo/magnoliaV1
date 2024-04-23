<?php

$module =[
    'module' => 'twilio_chat',
    'install_name' => 'Twilio Chat',
    'install_descr' => 'Twilio chat module',
    'version' => '2.02',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/controllers/AdminTwilioChat.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/controllers/TwilioChat.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/models/TwilioChatInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/twilio_chat/models/TwilioChatVideoModel.php',
        ],
        8 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/twilio_chat/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.04',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'users' => [
            'version' => '3.02',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'access_permissions' => 'installAccessPermissions',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'access_permissions' => 'deinstallAccessPermissions',
        ],
    ],
    'demo_content' => [
        'reinstall' => false,
    ],
];