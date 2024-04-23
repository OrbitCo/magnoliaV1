<?php

if (!function_exists('trial_pages')) {
    function trial_pages()
    {
        if (INSTALL_DONE && defined('ANALYTIC_USER_EMAIL') && ANALYTIC_USER_EMAIL) {
            $ci = &get_instance();
            $views = (int)$ci->pg_module->get_module_config('start', 'seen_pages_count') + 1;
            $ci->pg_module->set_module_config('start', 'seen_pages_count', $views);
            if ($views == 3) {
                $url = 'https://marketplace.pilotgroup.net';
                $client = new GuzzleHttp\Client(['timeout' => 3]);

                try {
                    $client->request('POST', $url, [
                        'query' => [
                            'route' => 'common/home/personal_demo',
                        ],
                        'form_params' => [
                            'user_id' => ANALYTIC_USER_ID,
                            'user_email' => ANALYTIC_USER_EMAIL,
                            'host' => $_SERVER['HTTP_HOST'],
                            'views' => $views,
                        ],
                    ]);
                } catch (\Exception $e) {
                }
            }
        }
    }
}
