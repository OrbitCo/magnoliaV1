<?php

return [
    'menu' => [
        'admin_menu' => [
            'admin_menu' => [
                'action' => 'none',
                'name'   => 'Mobile section menu',
                'items'  => [
                    'content_items' => [
                        'action' => 'none',
                        'name'   => '',
                        'items'  => [
                            'add_ons_items' => [
                                'action' => 'none',
                                'name'   => '',
                                'items'  => [
                                    'mobile_menu_item' => [
                                        'action' => 'create',
                                        'link'   => 'admin/mobile',
                                        'status' => 1,
                                        'sorter' => 9,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ],
    ],
    'moderators_methods' => [
        ['module' => 'mobile', 'method' => 'index', 'is_default' => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
    ],
    'cron_jobs' => [
        [
            "name" => "Check In-app subscriptions",
            "module" => "mobile",
            "model" => "Mobile_model",
            "method" => "cronInappReceipt",
            "cron_tab" => "0 */3 * * *",
            "status" => "1",
        ]
    ]
];
