<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['openid_storepath'] = 'temp/openid';
$config['openid_policy'] = 'users/openid_policy';
$config['openid_required'] = ['nickname', 'email'];
$config['openid_optional'] = ['fullname', 'dob', 'gender', 'country'];
$config['openid_request_to'] = 'users/openid_response';
