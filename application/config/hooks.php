<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  | http://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook['post_controller_constructor'][] = [
    'class'    => '',
    'function' => 'seo_replace_vars',
    'filename' => 'seo_vars.php',
    'filepath' => 'hooks',
];

$hook['post_controller_constructor'][] = [
    'class'    => '',
    'function' => 'check_access',
    'filename' => 'access.php',
    'filepath' => 'hooks',
];

/* Autoload hooks */

if (is_dir(APPPATH . 'hooks/autoload')) {
    $files = scandir(APPPATH . 'hooks/autoload');
    if (count($files) > 0) {
        foreach ($files as $id => $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $path_parts = pathinfo($file);
            if ($path_parts['extension'] != 'php') {
                continue;
            }

            $file_data = explode('-', substr(basename($file), 0, strrpos(basename($file), '.')));
            if (count($file_data) == 2) {
                $hook_type = isset($file_data[0]) ? $file_data[0] : '';
                $hook_function = isset($file_data[1]) ? $file_data[1] : '';
                if ($hook_type && $hook_function) {
                    $hook[$hook_type][] = [
                        'class'    => '',
                        'function' => $hook_function,
                        'filename' => $file,
                        'filepath' => 'hooks/autoload',
                    ];
                }
            }
        }
    }
}

if ($_ENV['USE_PROFILING']) {
    $hook['pre_system'][] = [
        'class'    => '',
        'function' => 'set_profiling',
        'filename' => 'set_profiling.php',
        'filepath' => 'hooks',
    ];

    $hook['post_system'][] = [
        'class'    => '',
        'function' => 'show_dbdata',
        'filename' => 'show_dbdata.php',
        'filepath' => 'hooks',
    ];
}

if (!empty($_ENV['DEMO_MODE'])) {
    $hook['pre_system'][] = [
        'class'    => '',
        'function' => 'demoMode',
        'filename' => 'demo.php',
        'filepath' => 'hooks',
    ];
}

/*if (TRIAL_MODE) {
    $hook['post_controller_constructor'][] = array(
        'class'    => '',
        'function' => 'trial_pages',
        'filename' => 'trial_pages.php',
        'filepath' => 'hooks',
    );
}*/
/* End of file hooks.php */
/* Location: ./system/application/config/hooks.php */
