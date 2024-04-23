<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config["login_settings"] = [
    'admin' => [
        'login' => "admin",
        'password' => "admin1",
    ],
    'user' => [
        'login' => "walter@mail.com",
        'password' => "123456",
    ],
];

if (PRODUCT_NAME == 'social') {
    $config['copyright']       = '&copy;&nbsp;2000-' . date('Y') . '&nbsp;<a href="https://www.pilotgroup.net">PilotGroup.NET</a> Powered by <a href="https://www.socialbiz.pro/">PG SocialBiz</a>';
    $config['social_settings'] = [];
} else {
    $config['copyright']       = '&copy;&nbsp;2000-' . date('Y') . '&nbsp;<a href="https://www.pilotgroup.net">PilotGroup.NET</a> Powered by <a href="https://www.datingpro.com/">PG Dating Pro</a>';
    $config['social_settings'] = [
        'facebook' => [
            'app_key' => '1449141928677180',
            'app_secret' => '47d3f91bf9d9433f1777566922737888',
        ],
        'vkontakte' => [
            'app_key' => '5205247',
            'app_secret' => 'cYljdMuiXRzXgF68onix',
        ],
        'google' => [
            'app_key' => '423241544898-ej06tetls509a4fba5cb7cjni2hn8kbg.apps.googleusercontent.com',
            'app_secret' => 'b17voB5OAug57HlVvOUa894D',
        ],
        'twitter' => [
            'app_key' => 'kyLrmI3vdnAFFz8bNJ2o3NcRy',
            'app_secret' => 'Cz0reYAUxVlAhUFx27G9nZYxzhV3bYEExOV4SVFkeUfCxHmQjS',
        ],
    ];
}
