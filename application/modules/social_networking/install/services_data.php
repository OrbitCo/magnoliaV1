<?php

$date = date('Y-m-d H:i:s');

return [
    [
        'id' => 1,
        'gid' => 'facebook',
        'name' => 'Facebook',
        'authorize_url' => 'https://www.facebook.com/dialog/oauth',
        'access_key_url' => 'https://graph.facebook.com/oauth/access_token',
        'oauth_enabled' => 1,
        'oauth_version' => 2,
        'app_enabled' => 1,
        'status' => 0,
        'date_add' => $date
    ],
    [
        'id' => 2,
        'gid' => 'vkontakte',
        'name' => 'Vk.com',
        'authorize_url' => 'http://oauth.vk.com/authorize',
        'access_key_url' => 'https://api.vk.com/oauth/access_token',
        'oauth_enabled' => 1,
        'oauth_version' => 2,
        'app_enabled' => 1,
        'status' => 0,
        'date_add' => $date
    ],
    [
        'id' => 3,
        'gid' => 'google',
        'name' => 'Google',
        'authorize_url' => 'https://accounts.google.com/o/oauth2/auth',
        'access_key_url' => 'https://accounts.google.com/o/oauth2/token',
        'oauth_enabled' => 1,
        'oauth_version' => 2,
        'app_enabled' => 1,
        'status' => 0,
        'date_add' => $date
    ],
    [
        'id' => 4,
        'gid' => 'linkedin',
        'name' => 'LinkedIn',
        'oauth_enabled' => 0,
        'status' => 0,
        'app_enabled' => 0,
        'date_add' => $date
    ],
    [
        'id' => 5,
        'gid' => 'twitter',
        'name' => 'Twitter',
        'oauth_enabled' => 1,
        'oauth_version' => 1,
        'status' => 0,
        'app_enabled' => 1,
        'date_add' => $date
    ]
];
