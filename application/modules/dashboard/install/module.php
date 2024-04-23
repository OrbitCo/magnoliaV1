<?php

$module =[
    'module' => 'dashboard',
    'install_name' => 'Admin dashboard',
    'install_descr' => 'The admin dashboard lets you review and moderate all types of content that require moderation or your approval (user profiles, photos, payments, etc.)',
    'version' => '4.04',
    'files' => [
        0 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/dashboard/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
    ],
    'libraries' => [
    ],
    'linked_modules' => [
        'install' => [
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];