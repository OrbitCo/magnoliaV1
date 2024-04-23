<?php

$module =[
    'module' => 'perfect_match',
    'install_name' => 'Perfect match',
    'install_descr' => 'Perfect match adds \'looking for\' fields to user profile. It also does pre-search by gender, age, and location. You can add more criteria.',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/controllers/ApiPerfectMatch.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/controllers/PerfectMatch.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/helpers/PerfectMatchHelper.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/install/module.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/install/permissions.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/install/settings.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/install/structure_deinstall.sql',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/install/structure_install.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/models/PerfectMatchInstallModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/perfect_match/models/PerfectMatchModel.php',
        ],
        10 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/perfect_match/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.01',
        ],
        'menu' => [
            'version' => '1.01',
        ],
        'field_editor' => [
            'version' => '2.04',
        ],
        'users' => [
            'version' => '4.02',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'users' => 'installUsers',
            'field_editor' => 'installFieldEditor',
            'banners' => 'installBanners',
            'access_permissions' => 'installAccessPermissions',
            'mobile' => 'installMobile',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'users' => 'deinstallUsers',
            'field_editor' => 'deinstallFieldEditor',
            'banners' => 'deinstallBanners',
            'access_permissions' => 'deinstallAccessPermissions',
            'mobile' => 'deinstallMobile',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];