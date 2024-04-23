<?php

$module =[
    'module' => 'linker',
    'install_name' => 'Linker module',
    'install_descr' => 'This module stores information about links between different objects ',
    'version' => '2.07',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/controllers/AdminLinker.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/install/module.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/install/permissions.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/install/structure_deinstall.sql',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/install/structure_install.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/models/LinkerInstallModel.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/models/LinkerModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/linker/models/LinkerTypeModel.php',
        ],
    ],
    'dependencies' => [
    ],
];