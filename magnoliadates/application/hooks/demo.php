<?php

if (!function_exists('demoMode')) {
    /**
     * Check user access
     *
     * @return void
     * @subpackage  Hooks
     * @category    hooks
     * @copyright   Copyright (c) 2000-2016 PG Real Estate - php real estate listing software
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     *
     * @package PG_Core
     */
    function demoMode()
    {
        if (!INSTALL_DONE) {
            return;
        }

        $_ENV['GA_KEY'] = $_ENV['DEMO_GA_KEY'];
        $_ENV['AMPLITUDE_KEY'] = $_ENV['DEMO_AMPLITUDE_KEY'];
        $_ENV['MIXPANEL_TOKEN'] = $_ENV['DEMO_MIXPANEL_TOKEN'];
        $_ENV['ANALYTICS_PROFILES'] = $_ENV['DEMO_ANALYTICS_PROFILES'];
    }
}
