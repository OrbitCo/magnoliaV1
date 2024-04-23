<?php

return [
    'groups' => [
        'trial' => [
            'name' => [
                'en' => 'Trial',
            ],
            'description' => [
                'en' => 'The trial group',
            ],
            'is_trial' => true,
            'trial_period' => 0,
            'is_active' => true,
        ],
        'silver' => [
            'name' => [
                'en' => 'Silver',
            ],
            'description' => [
                'en' => 'The silver group',
            ],
            'is_active' => true,
        ],
        'premium' => [
            'name' => [
                'en' => 'Premium',
            ],
            'description' => [
                'en' => 'The premium group',
            ],
            'is_active' => true,
        ],
    ],
    'periods' => [
        30 => [
            'period' => 30,
            'trial_group' => 0,
            'silver_group' => 7,
            'premium_group' => 15,
        ],
        60 => [
            'period' => 60,
            'trial_group' => 0,
            'silver_group' => 12,
            'premium_group' => 29,
        ],
        90 => [
            'period' => 90,
            'trial_group' => 0,
            'silver_group' => 19,
            'premium_group' => 39,
        ],
    ],
    'acl' => [
        'associations' => [
            'module' => [
                'access' => 2,
                'method' => 'ajaxLoadAssociations',
                'module_gid' => 'associations',
                'permission' => 'associations_ajaxLoadAssociations',
            ],
            'permissions' => [
                'list' => [
                    'associations_ajaxLoadAssociations' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 0],
                        'silver' => ['status' => 0],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ],
        'favorites' => [
            'module' => [
                'access' => 2,
                'module_gid' => 'favorites',
                'permission' => 'favorites_favorites',
            ],
            'permissions' => [
                'list' => [
                    'favorites' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 0],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ],
        'mailbox' => [
            'module' => [
                'access' => 2,
                'module_gid' => 'mailbox',
                'permission' => 'mailbox_mailbox',
            ],
            'permissions' => [
                'list' => [
                    'mailbox' => [
                        'default' => ['status' => 1, 'count' => ['view' => 5, 'write' => 5]],
                        //'trial' => ['status' => 1, 'count' => ['view' => 0, 'write' => 0]],
                        'silver' => ['status' => 1, 'count' => ['view' => 50, 'write' => 50]],
                        'premium' => ['status' => 1, 'count' => ['view' => 0, 'write' => 0]],
                    ]
                ],
            ],
        ],
        'questions' => [
            'module' => [
                'access' => 2,
                'method' => 'ajax_get_questions',
                'module_gid' => 'questions',
                'permission' => 'questions_questions_ajax_get_questions',
            ],
            'permissions' => [
                'list' => [
                    'questions_ajax_get_questions' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ],
        'horoscope' => [
            'module' => [
                'access' => 2,
                'module_gid' => 'horoscope',
                'permission' => 'horoscope_horoscope',
            ],
            'permissions' => [
                'list' => [
                    'horoscope' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 1],
                        'silver' => ['status' => 0],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ],
        'virtual_gifts' => [
            'module' => [
                'access' => 2,
                'module_gid' => 'virtual_gifts',
                'permission' => 'virtual_gifts_virtual_gifts_ajax_get_gifts_form',
            ],
            'permissions' => [
                'list' => [
                    'virtual_gifts_ajax_get_gifts_form' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ],
        'ratings' => [
            'module' => [
                'access' => 2,
                'method' => 'topRated',
                'module_gid' => 'ratings',
                'permission' => 'ratings_ratings_topRated',
            ],
            'permissions' => [
                'list' => [
                    'ratings_topRated' => [
                        'default' => ['status' => 0],
                        //'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
            ],
        ]
    ],
];
