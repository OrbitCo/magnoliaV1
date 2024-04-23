<?php

return [
    'menu' => [
        'admin_menu' => [
            'action' => 'none',
            'name' => 'Twilio section menu',
            'items' => [
                'content_items' => [
                    'action' => 'none',
                    'name' => '',
                    'items' => [
                        'add_ons_items' => [
                            'action' => 'none',
                            'name' => '',
                            'items' => [
                                'twilio_chat_menu_item' => [
                                    'action' => 'create',
                                    'link' => 'admin/twilio_chat/settings',
                                    'status' => 1,
                                    'sorter' => 2
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ]
    ],
    'moderators' => [
        [
            'module' => 'twilio_chat',
            'method' => 'index',
            'is_default' => 1,
            'group_id' => 7,
            'is_hidden' => 0,
            'parent_module' => ''
        ]
    ],
    'lang_dm_data' => [
        'module' => 'twilio_chat',
        'model' => 'twilio_video_chat',
        'method_add' => 'lang_dedicate_module_callback_add',
        'method_delete' => 'lang_dedicate_module_callback_delete'
    ]
];
