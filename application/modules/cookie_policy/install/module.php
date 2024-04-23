<?php

$module =[
    'module' => 'cookie_policy',
    'install_name' => 'Cookie policy',
    'install_descr' => 'Cookie policy',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cookie_policy/helpers/CookiePolicyHelper.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cookie_policy/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cookie_policy/install/settings.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cookie_policy/js/cookie_policy.js',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/cookie_policy/models/CookiePolicyInstallModel.php',
        ],
        5 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/cookie_policy/langs',
        ],
    ],
    'dependencies' => [
    ],
    'linked_modules' => [
        'install' => [
            'content' => 'installContent',
        ],
        'deinstall' => [
            'content' => 'deinstallContent',
        ],
    ],
];