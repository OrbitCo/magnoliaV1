<?php

return [
    'menu' => [
        'admin_menu' => [
            'action' => 'none',
            'items' => [
                'system_items' => [
                    'action' => 'none',
                    'items' => [
                        'moderation_menu_item' => [
                            'action' => 'create',
                            'link' => 'admin/moderation',
                            'icon' => 'flag',
                            'material_icon' => 'thumb_up_alt',
                            'status' => 1,
                            'sorter' => 3,
                            'indicator_gid' => 'new_moderation_item'
                        ],
                    ]
                ]
            ]
        ],
        'admin_moderation_menu' => [
            'action' => 'create',
            'name' => 'Moderation section menu',
            'items' => [
                'object_list_item' => [
                    'action' => 'create',
                    'link' => 'admin/moderation/index',
                    'status' => 1
                ],
                'moder_settings_item' => [
                    'action' => 'create',
                    'link' => 'admin/moderation/settings',
                    'status' => 1
                ],
                'badwords_item' => [
                    'action' => 'create',
                    'link' => 'admin/moderation/badwords',
                    'status' => 1
                ]
            ]
        ]
    ],
    'moderators_methods' => [
        [
            'module' => 'moderation',
            'method' => 'index',
            'is_default' => 1,
            'group_id' => 1,
            'is_hidden' => 0,
            'parent_module' => ''
        ]
    ],
    'notifications' => [
        'notifications' => [
            [
                'gid' => 'moderation_status',
                'send_type' => 'simple'
            ]
        ],
        'templates' => [
            [
                'gid' => 'moderation_status',
                'name' => 'Moderation status',
                'vars' => [
                    'fname',
                    'sname',
                    'status',
                    'preview'
                ],
                'content_type' => 'html'
            ]
        ]
    ]
];
