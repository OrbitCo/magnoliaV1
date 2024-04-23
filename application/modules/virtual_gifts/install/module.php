<?php

$module =[
    'module' => 'virtual_gifts',
    'install_name' => 'Virtual gifts',
    'install_descr' => 'The module will let your site users send each other virtual gifts. You have control over gifts images and prices.',
    'category' => 'action',
    'version' => '3.09',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/controllers/AdminVirtualGifts.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/controllers/ApiVirtualGifts.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/controllers/VirtualGifts.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/helpers/VirtualGiftsHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/js/receipt_gifts.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/js/send_gift.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/js/virtual_gifts_multi_request.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/langs/en/menu.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/langs/en/pages.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/models/VirtualGiftsInstallModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/virtual_gifts/models/VirtualGiftsModel.php',
        ],
    ],
    'dependencies' => [
        'menu' => [
            'version' => '1.01',
        ],
        'notifications' => [
            'version' => '1.01',
        ],
        'start' => [
            'version' => '1.01',
        ],
        'uploads' => [
            'version' => '1.01',
        ],
        'users' => [
            'version' => '1.01',
        ],
    ],
    'libraries' => [
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'notifications' => 'installNotifications',
            'payments' => 'installPayments',
            'uploads' => 'installUploads',
            'access_permissions' => 'installAccessPermissions',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'notifications' => 'deinstallNotifications',
            'payments' => 'deinstallPayments',
            'uploads' => 'deinstallUploads',
            'access_permissions' => 'deinstallAccessPermissions',
            'moderators' => 'deinstallModerators',
        ],
    ],
];