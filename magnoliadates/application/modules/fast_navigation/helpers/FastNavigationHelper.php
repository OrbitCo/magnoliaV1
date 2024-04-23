<?php

declare(strict_types=1);

namespace Pg\modules\fast_navigation\helpers {

    if (!function_exists('fastNavigationHelper')) {
        /**
         * Fast navigation helper function
         *
         * @return void
         */
        function fastNavigationHelper()
        {
            $ci = &get_instance();
            return $ci->view->fetch('form', 'admin', 'fast_navigation');
        }
    }

}

namespace {

    if (!function_exists('fast_navigation_helper')) {
        function fast_navigation_helper()
        {
            return Pg\modules\fast_navigation\helpers\fastNavigationHelper();
        }
    }

}
