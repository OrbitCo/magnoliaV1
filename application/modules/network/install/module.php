<?php

$module =[
    'module' => 'network',
    'install_name' => 'Network module',
    'install_descr' => 'Connect your dating site to the Dating Pro Network and populate it with members from the Network partner websites',
    'version' => '3.05',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/AbstractAction.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/GetProfilesAction.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/GetProfilesStatusAction.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/GetRemovedAction.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/GetUpdatedAction.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/PutProfilesAction.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/PutProfilesStatusAction.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/PutRemovedAction.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/PutRemovedStatusAction.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/PutUpdatedAction.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/actions/SettingsAction.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/configs/settings.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/ElephantIO/Client.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/ElephantIO/Payload.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/Api.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/Daemon.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/Loader.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/libs/Local.php',
        ],
        18 => [
            0 => 'dir',
            1 => 'write',
            2 => 'application/modules/network/client/logs',
        ],
        19 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/fast-client-service.php',
        ],
        20 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/slow-client-service.sh',
        ],
        21 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/slow-client.php',
        ],
        22 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/slow-client.start',
        ],
        23 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/slow-client.stop',
        ],
        24 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/client/slow-client.test',
        ],
        25 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/controllers/AdminNetwork.php',
        ],
        26 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/controllers/ApiNetwork.php',
        ],
        27 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/controllers/Network.php',
        ],
        28 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/module.php',
        ],
        29 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/permissions.php',
        ],
        30 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/settings.php',
        ],
        31 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/structure_deinstall.sql',
        ],
        32 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/structure_install.sql',
        ],
        33 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/install/user_fields_data.php',
        ],
        34 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/js/admin-network.js',
        ],
        35 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/network/langs',
        ],
        36 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/models/NetworkActionsModel.php',
        ],
        37 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/models/NetworkEventsModel.php',
        ],
        38 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/models/NetworkInstallModel.php',
        ],
        39 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/models/NetworkModel.php',
        ],
        40 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/network/models/NetworkUsersModel.php',
        ],
        41 => [
            0 => 'dir',
            1 => 'write',
            2 => 'temp/network/events',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.05',
        ],
        'menu' => [
            'version' => '2.04',
        ],
        'field_editor' => [
            'version' => '2.02',
        ],
        'users' => [
            'version' => '3.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'field_editor' => 'installFieldEditor',
            'cronjob' => 'installCronjob',
            'bonuses' => 'installBonuses',
            'moderation' => 'installModeration',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'field_editor' => 'deinstallFieldEditor',
            'cronjob' => 'deinstallCronjob',
            'bonuses' => 'deinstallBonuses',
            'moderation' => 'deinstallModeration',
        ],
    ],
];
