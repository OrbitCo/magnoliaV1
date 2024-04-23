<?php

return [
    'menu' => [
        'admin_menu' => [
            'name' => 'Admin area menu',
            "action" => "none",
            "items" => [
                'main_items' => [
                    "action" => "none",
                    "items" => [
                        'ausers_item' => [
                            "action" => "create",
                            'link' => 'admin/ausers',
                            'icon' => 'eye',
                            'material_icon' => 'contacts',
                            'status' => 1,
                            'sorter' => 2],
                    ],
                ],
            ],
        ],
    ],
    'notifications' => [
        "templates" => [
            ["module" => "ausers", "gid" => "auser_account_create_by_admin", "name" => "Administrator created by admin mail", "vars" => ["user", "username", "email", "password", "user_type"], "content_type" => "text"],
        ],
        "notifications" => [
            ["module" => "ausers", "gid" => "auser_account_create_by_admin", "template" => "auser_account_create_by_admin", "send_type" => "simple"],
        ],
    ],
];
