<?php

return [
    'menu' => [
        'user_top_menu' => [
            'action' => 'none',
            'items' => [
                'user-menu-people' => [
                    'action' => 'none',
                    'items' => [
                        'favorites_item' => [
                            'action' => 'create',
                            'link' => 'favorites/index',
                            'status' => 1,
                            'sorter' => 1
                        ]
                    ]
                ]
            ]
        ]
    ],
    'seo_pages' => [
        'index',
        'i_am_their_fav',
        'my_favs'
    ],
    'notifications' => [
        'notifications' => [
            [
                'gid' => 'favorites_add',
                'send_type' => 'que'
            ]
        ],
        'templates' => [
            [
                'gid' => 'favorites_add',
                'name' => 'Favorites add',
                'vars' => [
                    'fname',
                    'sname',
                    'user',
                    'image',
                    'link_1',
                    'link_2'
                ],
                'content_type' => 'html'
            ]
        ]
    ]
];
