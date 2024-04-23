<?php
return [
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'my_guests',
        'access' => 2
    ],
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'view',
        'access' => 2
    ],
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'user_gallery',
        'access' => 2
    ],
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'user_gallery',
        'access' => 1
    ],
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'search',
        'access' => 1
    ],
    [
        'module_gid' => 'users',
        'controller' => 'users',
        'method' => 'view',
        'access' => 1,
        'data' => [
            'view' => 10
        ]
    ],
];
