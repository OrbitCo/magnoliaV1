<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Do not change ids!!!
 */
$config['cron_periods'][1] = [
    'id'       => 1,
    'name'     => l('every_15_minutes', 'cronjob'),
    'cron_tab' => '00,15,30,45 * * * *',
];
$config['cron_periods'][2] = [
    'id'       => 2,
    'name'     => l('every_30_minutes', 'cronjob'),
    'cron_tab' => '00,30 * * * *',
];
