<?php

$module =[
    'module' => 'start',
    'install_name' => 'User and Admin index pages',
    'install_descr' => 'Index pages for administrator and user area',
    'version' => '6.06',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/helpers/StartHelper.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/controllers/Start.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/controllers/AdminStart.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/admin-banners.js',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/admin_lang_inline_editor.js',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/checkbox.js',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/date_formats.js',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/hlbox.js',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/lang_inline_editor.js',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/search.js',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/selectbox.js',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/js/start_multi_request.js',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/models/StartInstallModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/start/models/StartModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/views/flatty/img/favicon/manifest.json',
        ],
        18 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/views/flatty/img/favicon/browserconfig.xml',
        ],
        19 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/views/gentelella/img/favicon/manifest.json',
        ],
        20 => [
            0 => 'file',
            1 => 'write',
            2 => 'application/views/gentelella/img/favicon/browserconfig.xml',
        ],
        21 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/start/langs',
        ],
        22 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/',
        ],
        23 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/cache/',
        ],
        24 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/captcha/',
        ],
        25 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/logs/',
        ],
        26 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/rss/',
        ],
        27 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/templates_c/',
        ],
        28 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/trash/',
        ],
        30 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/logo',
        ],
        31 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/sets',
        ],
        32 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/sets/default',
        ],
        33 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/sets/default/css',
        ],
        34 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/flatty/sets/default/img',
        ],
        35 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/gentelella/logo',
        ],
        36 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/views/gentelella/sets',
        ],
        37 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/wysiwyg',
        ],
    ],
    'dependencies' => [
        'menu' => [
            'version' => '2.03',
        ],
    ],
    'libraries' => [
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'banners' => 'installBanners',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'banners' => 'deinstallBanners',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];
