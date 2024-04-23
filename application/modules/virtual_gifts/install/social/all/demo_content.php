<?php
return [
    'acl' => [
        'virtual_gifts' => [
            'module' => [
                'access' => 2,
                'module_gid' => 'virtual_gifts',
                'permission' => 'virtual_gifts_virtual_gifts',
            ],
            'permissions' => [
                'list' => [
                    'virtual_gifts' => [
                        'default' => ['status' => 0],
                        'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ]
    ]
];
