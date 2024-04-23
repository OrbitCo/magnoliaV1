<?php

use Pg\modules\countries\models\CountriesModel;

return [
    'menu' => [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'content_items' => [
                            'action' => 'none',
                            'items'  => [
                                'countries_menu_item' => ['action' => 'create', 'link' => 'admin/countries', 'status' => 1, 'sorter' => 1],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_countries_menu' => [
            'action' => 'create',
            'name'   => 'Countries section menu',
            'items'  => [
                'countries_list_item'    => ['action' => 'create', 'link' => 'admin/countries', 'status' => 1],
                'countries_install_item' => ['action' => 'create', 'link' => 'admin/countries/install', 'status' => 1],
            ],
        ],
    ],

    'cron_data' => [
        /*[
            'name'     => 'Full install USA cities',
            'module'   => CountriesModel::MODULE_GID,
            'model'    => 'Countries_model',
            'method'   => 'cronOneTimeTasks',
            'cron_tab' => '0 12 * * *',
            'status'   => '1',
            'is_kill'  => '1'
        ]*/
    ]
];
