<?php

return [
    'acl' => [
        'chatbox' => [
             'module' => [
                'access' => 2,
                'module_gid' => 'chatbox',
                'permission' => 'chatbox_chatbox',
             ],
             'permissions' => [
                'list' => [
                    'chatbox' => [
                        'default' => ['status' => 0],
                        'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
             ],
        ]
    ],
];
