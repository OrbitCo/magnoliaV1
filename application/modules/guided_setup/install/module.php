<?php

$module =[
    'module' => 'guided_setup',
    'install_name' => 'Guided setup',
    'install_descr' => 'This quick setup tool makes it easier to manage the most important site options, directly from the admin dashboard',
    'category' => 'action',
    'version' => '2.06',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/controllers/AdminGuidedSetup.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/helpers/GuidedSetupHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/install/settings.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/install/structure_deinstall.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/install/structure_install.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/js/guided_setup.js',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/langs/en/pages.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/models/GuidedSetupInstallModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/models/GuidedSetupModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/guided_setup/views/gentelella/scss/style.scss',
        ],
    ],
    'dependencies' => [
        'menu' => [
            'version' => '1.01',
        ],
        'start' => [
            'version' => '1.01',
        ],
    ],
    'libraries' => [
    ],
    'linked_modules' => [
    ],
];
