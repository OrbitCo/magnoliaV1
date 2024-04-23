<?php

$module =[
    'module' => 'file_uploads',
    'install_name' => 'File uploads management',
    'install_descr' => 'This module lets you manage the types and sizes of the files in promo content block and in mailbox',
    'version' => '2.08',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/controllers/AdminFileUploads.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/install/settings.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/models/FileUploadsConfigModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/models/FileUploadsInstallModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/file_uploads/models/FileUploadsModel.php',
        ],
        9 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/file_uploads/langs',
        ],
        10 => [
            0 => 'dir',
            1 => 'write',
            2 => 'uploads/file-uploads/',
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
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
        ],
    ],
];