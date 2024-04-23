<?php

$module =[
    'module' => 'social_networking',
    'install_name' => 'Social networking',
    'install_descr' => 'Authorization with social media accounts, social media widgets',
    'version' => '3.03',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/controllers/AdminSocialNetworking.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/helpers/SocialNetworkingHelper.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/install/module.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/install/permissions.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/install/structure_deinstall.sql',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/install/structure_install.sql',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/SocialNetworkingInstallModel.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/SocialNetworkingServicesModel.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/SocialNetworkingConnectionsModel.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/SocialNetworkingPagesModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/SocialNetworkingWidgetsModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/services/FacebookServiceModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/services/GoogleServiceModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/services/TwitterServiceModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/services/VkontakteServiceModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/widgets/FacebookWidgetsModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/widgets/GoogleWidgetsModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/widgets/LinkedinWidgetsModel.php',
        ],
        18 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/widgets/TwitterWidgetsModel.php',
        ],
        19 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/social_networking/models/widgets/VkontakteWidgetsModel.php',
        ],
        20 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/social_networking/langs',
        ],
    ],
    'dependencies' => [
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
        'cronjob' => [
            'version' => '1.04',
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