<?php

return [
    'menu' => [
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
                                    'link' => 'admin/mobile',
                                    'status' => 1,
                                    'sorter' => 9,
                                    'items'  => [
                                        'app_links_item' => [
                                            'action' => 'create',
                                            'link'   => 'admin/mobile/appLinks',
                                            'status' => 1,
                                            'sorter' => 1
                                        ],
                                        'android_app_item' => [
                                            'action' => 'create',
                                            'link'   => 'admin/mobile/billingSettings',
                                            'status' => 1,
                                            'sorter' => 2
                                        ],
                                        'fcm_item' => [
                                            'action' => 'create',
                                            'link' => 'admin/mobile/push_notifications_settings',
                                            'status' => 1,
                                            'sorter' => 3
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
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
