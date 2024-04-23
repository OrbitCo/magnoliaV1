<?php

$return = ['data' => [], 'result' => true];
$check_list = [
    [
        'func' => function () {
            return (bool) (string) function_exists('curl_init');
        },
        'msg' => 'cURL is available',
    ],
    [
        'func' => function () {
            if (version_compare(PHP_VERSION, '7.2') >= 0) {
                return true;
            }

            return false;
        },
        'msg' => 'PHP version >= 7.2',
    ],
    [
        'func' => function () {
            $output = shell_exec('php -v');
            if (!empty($output)) {
                $php_cli_v = explode(' ', $output)[1];
                if (version_compare($php_cli_v, '7.2') >= 0) {
                    return true;
                }

                return false;
            }
        },
        'msg' => 'PHP (Cli) version >= 7.2',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('shell_exec');
        },
        'msg' => 'shell_exec is available',
    ],
    [
        'func' => function () {
            return (bool) (string) extension_loaded('pcntl');
        },
        'msg' => 'PCNTL extension is loaded',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('pcntl_fork');
        },
        'msg' => 'pcntl_fork() function is available',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('pcntl_signal');
        },
        'msg' => 'pcntl_signal() function is available',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('pcntl_signal_dispatch');
        },
        'msg' => 'pcntl_signal_dispatch() function is available',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('posix_setsid');
        },
        'msg' => 'posix_setsid() function is available',
    ],
    [
        'func' => function () {
            return (bool) (string) function_exists('posix_kill');
        },
        'msg' => 'posix_kill() function is available',
    ],
];

foreach ($check_list as $ckeck) {
    $suit = $ckeck['func']();
    $return['data'][] = [
        'name'   => $ckeck['msg'],
        'value'  => $suit ? 'Yes' : 'No',
        'result' => $suit,
    ];
    $return['result'] = $return['result'] && $suit;
}

echo json_encode($return);
