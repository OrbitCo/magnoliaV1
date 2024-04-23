<?php

$module =[
    'module' => 'languages',
    'install_name' => 'Languages',
    'install_descr' => 'Editing language files (words and phrases that are used on the site), adding new language versions, doing translations',
    'version' => '3.10',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/controllers/AdminLanguages.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/controllers/ApiLanguages.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/controllers/Languages.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/helpers/LanguagesHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/js/lang-edit.js',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/install/module.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/install/permissions.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/models/LanguagesInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/languages/models/LanguagesModel.php',
        ],
        9 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/languages/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderators' => 'installModerators',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
        ],
    ],
];
