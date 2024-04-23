<?php

$module =[
    'module' => 'countries',
    'install_name' => 'Countries module',
    'install_descr' => 'Locations management (editing countries, regions, cities, geo-coordinates); installation from a ready database',
    'version' => '9.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/controllers/AdminCountries.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/controllers/ApiCountries.php',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/controllers/Countries.php',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/helpers/CountriesHelper.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/js/admin-countries.js',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/js/location-autocomplete.js',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/js/location-popup.js',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/install/module.php',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/install/settings.php',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/install/permissions.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/install/structure_deinstall.sql',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/install/structure_install.sql',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/models/CountriesInstallModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/models/CountriesLocationSelectModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/countries/models/CountriesModel.php',
        ],
        15 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/countries/langs',
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
    'libraries' => [
    ],
    'linked_modules' => [
        'install' => [
            'menu' => 'installMenu',
            'moderators' => 'installModerators',
            'cronjob' => 'installCronjob',
        ],
        'deinstall' => [
            'menu' => 'deinstallMenu',
            'moderators' => 'deinstallModerators',
            'cronjob' => 'deinstallCronjob',
        ],
    ],
];
