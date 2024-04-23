<?php

use Pg\modules\users\models\UsersModel;

return [
    'action_config' => [
        'users_site_visit' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'everymonth', 'everyyear', 'multiple'],
        ],
        'users_update_user_profile' => [
            'is_percent' => 1,
            'once' => 1,
            'available_period' => [
                'once'],
        ],
        'users_add_profile_logo' => [
            'is_percent' => 0,
            'once' => 1,
            'available_period' => [
                'once'],
        ],
        'users_add_location' => [
            'is_percent' => 0,
            'once' => 1,
            'available_period' => [
                'once'],
        ],
    ],
    'menu' => [
        'user_top_menu' => [
            'action' => 'none',
            'name' => '',
            'items' => [
                'user-menu-people' => [
                    'action' => 'none',
                    'items' => [
                        'guests_item' => [
                            'action' => 'create',
                            'link' => 'users/my_guests',
                            'status' => 1,
                            'sorter' => 6,
                        ],
                    ],
                ]
            ],
        ],
        'admin_menu' => [
            'action' => 'none',
            'name' => '',
            'items' => [
                'main_items' => [
                    'action' => 'none',
                    'items' => [
                        'users_menu_item' => [
                            'action' => 'create',
                            'link' => 'admin/users',
                            'icon' => 'users',
                            'material_icon' => 'supervisor_account',
                            'status' => 1,
                            'sorter' => 2,
                        ],
                    ],
                ],
            ],
        ],
        'admin_users_menu' => [
            'action' => 'create',
            'name' => 'Users section menu',
            'items' => [
                'users_list_item' => [
                    'action' => 'create',
                    'link' => 'admin/users',
                    'status' => 1,
                    'sorter' => 1,
                ],
                'system-users-item' => [
                    'action' => 'create',
                    'link' => 'admin/users/settings',
                    'status' => 1,
                    'sorter' => 3,
                ],
            ],
        ],
        'settings_menu' => [
            'name' => 'Settings menu',
            'action' => 'none',
            'items' => [
                'my-profile-item' => [
                    'action' => 'create',
                    'link' => 'users/profile/view',
                    'status' => 1,
                    'sorter' => 20,
                ],
                'account-item' => [
                    "action" => "create",
                    'link' => 'users/account',
                    'status' => 1,
                    'sorter' => 30,
                ],
                'settings-item' => [
                    "action" => "create",
                    'link' => 'users/settings',
                    'status' => 1,
                    'sorter' => 40,
                ],
                'logout-item' => [
                    "action" => "create",
                    'link' => 'users/logout',
                    'status' => 1,
                    'sorter' => 50,
                ],
            ],
        ],
        'user_alerts_menu' => [
            'action' => 'none',
            'items' => [
                'visitors_new_item' => [
                    'action' => 'create',
                    'link' => 'users/get_user_visitors',
                    'icon' => 'user',
                    'status' => 1,
                    'sorter' => 5,
                ],
            ],
        ],
    ],
    'moderators_methods' => [
        ['module' => 'users', 'method' => 'index', 'is_default' => 1, 'group_id' => 6, 'is_hidden' => 0, 'parent_module' => '']
    ],
    'notifications' => [
        'notifications' => [
            ['gid' => 'users_fogot_password', 'send_type' => 'simple'],
            ['gid' => 'users_change_password', 'send_type' => 'simple'],
            ['gid' => 'users_change_email', 'send_type' => 'simple'],
            ['gid' => 'users_change_email_confirm', 'send_type' => 'simple'],
            ['gid' => 'users_registration', 'send_type' => 'simple'],
            ['gid' => 'users_view', 'send_type' => 'que'],
            ['gid' => 'users_count_registration', 'send_type' => 'simple'],
            ['gid' => 'users_approved', 'send_type' => 'simple'],
            ['gid' => 'users_restore_password', 'send_type' => 'simple'],
            ['gid' => 'users_restore_password_success', 'send_type' => 'simple'],
            ['gid' => 'user_no_exists_restore', 'send_type' => 'simple'],
            ['gid' => 'user_unconfirmed_restore', 'send_type' => 'simple'],
            ['gid' => 'user_is_blocked_restore', 'send_type' => 'simple']
        ],
        'templates' => [
            ['gid' => 'users_fogot_password', 'name' => 'Forgot password mail',
                'vars' => ['password', 'email', 'fname', 'sname'], 'content_type' => 'text'],
            ['gid' => 'users_change_password', 'name' => 'Change password notification',
                'vars' => ['password', 'email', 'fname', 'sname', 'nickname', 'contact_us'],
                'content_type' => 'text'],
            ['gid' => 'users_change_email', 'name' => 'Email changed', 'vars' => [
                    'password', 'email', 'fname', 'sname', 'nickname', 'tickets'], 'content_type' => 'html'],
            ['gid' => 'users_change_email_confirm', 'name' => 'Email changed, confirm please', 'vars' => [
                    'password', 'email', 'fname', 'sname', 'nickname', 'code'], 'content_type' => 'html'],
            ['gid' => 'users_registration', 'name' => 'User registration letter',
                'vars' => ['password', 'email', 'fname', 'sname', 'nickname',
                    'confirm_code', 'confirm_block'], 'content_type' => 'text'],
            ['gid' => 'users_view', 'name' => 'Someone has visited my page',
                'vars' => ['fname', 'sname', 'nickname', 'image', 'link_1', 'link_2'], 'content_type' => 'html'],
            ['gid' => 'users_count_registration', 'name' => 'User count registration letter',
                'vars' => ['count'], 'content_type' => 'html'],
            ['gid' => 'users_approved', 'name' => 'User approved',
                'vars' => ['name'], 'content_type' => 'text'],
            ['gid' => 'users_restore_password', 'name' => 'Restore password', 'vars' => [
                    'nickname', 'restore_link', 'is_admin'], 'content_type' => 'html'],
            ['gid' => 'users_restore_password_success', 'name' => 'Password Change Successful', 'vars' => [
                    'nickname','contact_us'], 'content_type' => 'html'],
            ['gid' => 'user_no_exists_restore', 'name' => 'User no exists', 'vars' => ['nickname'], 'content_type' => 'html'],
            ['gid' => 'user_unconfirmed_restore', 'name' => 'User unconfirmed', 'vars' => [
                'nickname'], 'content_type' => 'html'],
            ['gid' => 'user_is_blocked_restore', 'name' => 'User is blocked', 'vars' => [
                    'nickname'], 'content_type' => 'html']
        ],
    ],
    'moderation_types' => [
        [
            "name" => "user_logo",
            "mtype" => "0",
            "module" => "users",
            "model" => "Users_model",
            "check_badwords" => "0",
            "method_get_list" => "_moder_get_list",
            "method_set_status" => "_moder_set_status",
            "method_delete_object" => "",
            "allow_to_decline" => "1",
            "template_list_row" => "moder_block",
        ],
        [
            "name" => "user_data",
            "mtype" => "-1",
            "module" => "users",
            "model" => "Users_model",
            "check_badwords" => "1",
            "method_get_list" => "",
            "method_set_status" => "",
            "method_delete_object" => "",
            "allow_to_decline" => "0",
            "template_list_row" => "",
        ],
    ],
    'services' => [
        [
            'template' => [
                'gid' => "users_featured_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_users_featured",
                'callback_validate_method' => "service_validate_users_featured",
                'price_type' => 1,
                'data_admin' => ['period' => 'int'],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 1,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "users_featured",
                    "template_gid" => "users_featured_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => 1,
                    "type" => "tariff",
                    "data_admin" => ['period' => '30'],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "user_activate_in_search_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_user_activate_in_search",
                'callback_validate_method' => "service_validate_user_activate_in_search",
                'price_type' => 1,
                'data_admin' => ['period' => 'int'],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 1,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "user_activate_in_search",
                    "template_gid" => "user_activate_in_search_template",
                    "pay_type" => 2,
                    "status" => 0,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => "0",
                    "type" => "tariff",
                    "data_admin" => ['period' => '30'],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "admin_approve_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_admin_approve",
                'callback_validate_method' => "service_validate_admin_approve",
                'price_type' => 1,
                'data_admin' => [],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 0,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "admin_approve",
                    "template_gid" => "admin_approve_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => 0,
                    "type" => "tariff",
                    "data_admin" => [],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "hide_on_site_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_hide_on_site",
                'callback_validate_method' => "service_validate_hide_on_site",
                'price_type' => 1,
                'data_admin' => ['period' => 'int'],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 1,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "hide_on_site",
                    "template_gid" => "hide_on_site_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => 1,
                    "type" => "tariff",
                    "data_admin" => ['period' => '30'],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "highlight_in_search_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_highlight_in_search",
                'callback_validate_method' => "service_validate_highlight_in_search",
                'price_type' => 1,
                'data_admin' => ['period' => 'int'],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 1,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "highlight_in_search",
                    "template_gid" => "highlight_in_search_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => 1,
                    "type" => "tariff",
                    "data_admin" => ['period' => '30'],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "up_in_search_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_up_in_search",
                'callback_validate_method' => "service_validate_up_in_search",
                'price_type' => 1,
                'data_admin' => ['period' => 'int'],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 1,
                'data_membership' => [],
                'alert_activate' => 0,
            ],
            'services' => [
                [
                    "gid" => "up_in_search",
                    "template_gid" => "up_in_search_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => "0",
                    "price" => 10,
                    "can_free" => 1,
                    "type" => "tariff",
                    "data_admin" => ['period' => '30'],
                ],
            ],
        ],
        [
            'template' => [
                'gid' => "ability_delete_template",
                'callback_module' => "users",
                'callback_model' => "Users_model",
                'callback_buy_method' => "service_buy",
                'callback_activate_method' => "service_activate_ability_delete",
                'callback_validate_method' => "service_validate_ability_delete",
                'price_type' => 1,
                'data_admin' => [],
                'data_user' => [],
                'moveable' => 0,
                'is_membership' => 0,
                'data_membership' => [],
                'alert_activate' => 1,
            ],
            'services' => [
                [
                    "gid" => "ability_delete",
                    "template_gid" => "ability_delete_template",
                    "pay_type" => 2,
                    "status" => 1,
                    "cant_activate_from_services" => 0,
                    "price" => 10,
                    "can_free" => 1,
                    "type" => "tariff",
                    "data_admin" => [],
                ],
            ],
        ],
    ],
    'lang_services' => [
        'service' => [
            'user_activate_in_search',
            'users_featured',
            'admin_approve',
            'hide_on_site',
            'highlight_in_search',
            'up_in_search',
            'ability_delete',
        ],
        'service_description' => [
            'user_activate_in_search_description',
            'users_featured_description',
            'admin_approve_description',
            'hide_on_site_description',
            'highlight_in_search_description',
            'up_in_search_description',
            'ability_delete_description',
        ],
        'template' => [
            'user_activate_in_search_template',
            'users_featured_template',
            'admin_approve_template',
            'hide_on_site_template',
            'highlight_in_search_template',
            'up_in_search_template',
            'ability_delete_template',
        ],
        'admin_param' => [
            'user_activate_in_search_template' => ['period'],
            'users_featured_template' => ['period'],
            'hide_on_site_template' => ['period'],
            'highlight_in_search_template' => ['period'],
            'up_in_search_template' => ['period'],
        ],
        'user_param' => [
        ],
    ],
    'spam' => [
        ["gid" => "users_object", "form_type" => "select_text", "send_mail" => true,
            "status" => true, "module" => "users", "model" => "Users_model", "callback" => "spam_callback"],
    ],
    'geomap' => [
        [
            'map_settings' => [
                'use_type_selector' => 1,
                'use_panorama' => 0,
                'use_router' => 0,
                'use_searchbox' => 0,
                'use_search_radius' => 1,
                'use_search_auto' => 1,
                'use_show_details' => 1,
                'use_amenities' => 1,
                'amenities' => [],
            ],
            'settings' => [
                'map_gid' => 'googlemapsv3',
                'id_user' => 0,
                'id_object' => 0,
                'gid' => 'profile_view',
            ],
        ],
        [
            'map_settings' => [
                'use_type_selector' => 1,
                'use_router' => 0,
                'use_searchbox' => 0,
                'use_tools' => 1,
                'use_clusterer' => 0,
                'use_click_zoom' => 1,
            ],
            'settings' => [
                'map_gid' => 'yandexmapsv2',
                'id_user' => 0,
                'id_object' => 0,
                'gid' => 'profile_view',
            ],
        ],
        [
            'map_settings' => [
                'use_type_selector' => 1,
                'use_router' => 0,
                'use_searchbox' => 0,
            ],
            'settings' => [
                'map_gid' => 'bingmapsv7',
                'id_user' => 0,
                'id_object' => 0,
                'gid' => 'profile_view',
            ],
        ],
    ],
    'network_event_handlers' => [
        [
            'event' => 'active',
            'module' => 'users',
            'model' => 'Users_model',
            'method' => 'handler_active',
        ],
        [
            'event' => 'inactive',
            'module' => 'users',
            'model' => 'Users_model',
            'method' => 'handler_inactive',
        ],
    ],
    'cron_jobs' => [
        [
            "name" => "Update users offline status",
            "module" => "users",
            "model" => "Users_model",
            "method" => "cron_set_offline_status",
            "cron_tab" => "*/19 * * * *",
            "status" => "1",
        ],
        [
            "name" => "Clean after expiration - Activity in search",
            "module" => "users",
            "model" => "Users_model",
            "method" => "service_cron_user_activate_in_search",
            "cron_tab" => "12 1 * * *",
            "status" => "1",
        ],
        [
            "name" => "Clean after expiration - Stealth mode",
            "module" => "users",
            "model" => "Users_model",
            "method" => "service_cron_hide_on_site",
            "cron_tab" => "14 1 * * *",
            "status" => "1",
        ],
        [
            "name" => "Clean after expiration - Highlight in search",
            "module" => "users",
            "model" => "Users_model",
            "method" => "service_cron_highlight_in_search",
            "cron_tab" => "16 1 * * *",
            "status" => "1",
        ],
        [
            "name" => "Clean after expiration - Lift up in search",
            "module" => "users",
            "model" => "Users_model",
            "method" => "service_cron_up_in_search",
            "cron_tab" => "18 1 * * *",
            "status" => "1",
        ],
        [
            "name" => "Delete users content",
            "module" => "users",
            "model" => "Users_model",
            "method" => "clear_user_content_cron",
            "cron_tab" => "20 1 * * *",
            "status" => "1",
        ],
        [
            "name" => "Number of user registrations",
            "module" => "users",
            "model" => "Users_model",
            "method" => "cronCountUsersRegistration",
            "cron_tab" => "17 */12 * * *",
            "status" => "1",
        ],
        [
            "name" => "Validate email addresses",
            "module" => "users",
            "model" => "Users_model",
            "method" => "cron_validate_emails",
            "cron_tab" => "35 * * * *",
            "status" => "1",
        ],
        [
            "name" => "Block inactive users",
            "module" => "users",
            "model" => "Users_model",
            "method" => "cron_block_inactive_users",
            "cron_tab" => "0 0 * * *",
            "status" => "1",
        ],
    ],
    'ratings' => [
        "ratings_fields" => [
            "rating_data" => ["type" => "TEXT", "null" => true],
            "rating_count" => ["type" => "smallint(5)", "null" => false],
            "rating_sorter" => ["type" => "decimal(5,3)", "null" => false],
            "rating_value" => ["type" => "decimal(5,3)", "null" => false],
            "rating_type" => ["type" => "varchar(20)", "null" => false],
        ],
        "ratings" => [
            ["gid" => "users_object", "name" => "Ratings in user profiles",
                "rate_type" => "stars", "module" => "users", "model" => "users",
                "callback" => "callback_ratings"],
        ],
        "rate_types" => [
            "stars" => [
                "main" => [1, 2, 3, 4, 5],
                "dop1" => [1, 2, 3, 4, 5],
                "dop2" => [1, 2, 3, 4, 5],
            ],
        ],
    ],
    'user_types' => [
        [
            'name' => 'male',
            'parent_id' => 0,
        ],
        [
            'name' => 'female',
            'parent_id' => 0,
        ],
    ],
    'push_notifications' => [
        'view_profile' => [
            'gid' => 'view_profile',
            'module' => UsersModel::MODULE_GID,
            'status' => 0
        ]
    ]
];
