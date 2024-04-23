<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('event_handler')) {
    function event_handler()
    {
        if (!INSTALL_MODULE_DONE) {
            return;
        }
        $CI = &get_instance();
        $modules = $CI->pg_module->return_modules();
        foreach ($modules as $module) {
            $class = 'Event' . str_replace(' ', '', ucwords(str_replace('_', ' ', $module['module_gid']))) . 'Handler';
            $handler_class = NS_MODULES . $module['module_gid'] . '\Events\\' . $class;
            $handler_file = SITE_PHYSICAL_PATH . 'application/modules/' . $module['module_gid'] . '/Events/' . $class . '.php';
            if (file_exists($handler_file)) {
                $handler = new $handler_class();
                $handler->init();
            }
        }
    }
}
