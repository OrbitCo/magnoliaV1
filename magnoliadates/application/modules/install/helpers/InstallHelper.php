<?php

declare(strict_types=1);

namespace Pg\modules\install\helpers {

    /**
     * Install module
     *
     * @package     PG_Core
     *
     * @copyright   Copyright (c) 2000-2014 PG Core
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */

    /**
     * Install helpers management
     *
     * @package     PG_Core
     * @subpackage  Install
     * @category    models
     *
     * @copyright   Copyright (c) 2000-2014 PG Core
     * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
     */
    if (!function_exists('getInitialSetupMenu')) {
        /**
         * Return initial setup menu
         *
         * @param integer $step setup step
         *
         * @return string
         */
        function getInitialSetupMenu($step = 1)
        {
            $ci = &get_instance();
            $ci->view->assign("step", $step);

            return $ci->view->fetch("menu_initial_install", 'admin', 'install');
        }
    }

    if (!function_exists('getProductSetupMenu')) {
        /**
         * Return product setup menu
         *
         * @param integer $step setup step
         *
         * @return string
         */
        function getProductSetupMenu($step = 1)
        {
            $ci = &get_instance();
            $ci->view->assign("step", $step);

            return $ci->view->fetch("menu_product_install", 'admin', 'install');
        }
    }

    if (!function_exists('getModulesSetupMenu')) {
        /**
         * Return modules setup menu
         *
         * @param integer $step setup step
         *
         * @return string
         */
        function getModulesSetupMenu($step = "")
        {
            $ci = &get_instance();
            if (!$step) {
                $step = $ci->router->fetch_method();
            }

            if ($step != 'enable_modules') {
                $ci->load->model('Install_model');
                $enabled = count($ci->Install_model->get_enabled_modules());
                $ci->view->assign("enabled", $enabled);
            }

            if ($step != 'updates') {
                $ci->load->model('install/models/Updates_model');
                $updates = count($ci->Updates_model->get_enabled_updates());
                $ci->view->assign("updates", $updates);
            }

            if ($step != 'product_updates') {
                $ci->load->model('install/models/Updates_model');
                $product_updates = count($ci->Updates_model->get_enabled_product_updates());
                $ci->view->assign("product_updates", $product_updates);
            }

            if ($step != 'enable_libraries') {
                $ci->load->model('install/models/Libraries_model');
                $enabled_libraries = count($ci->Libraries_model->get_enabled_libraries());
                $ci->view->assign("enabled_libraries", $enabled_libraries);
            }

            if ($step != 'migrations') {
//                $ci->load->model('install/models/Libraries_model');
//                $enabled_libraries = count($ci->Libraries_model->get_enabled_libraries());
//                $ci->view->assign("enabled_libraries", $enabled_libraries);
            }

            $ci->view->assign("step", $step);

            return $ci->view->fetch("menu_modules_install", null, 'install');
        }
    }

    if (!function_exists('hasCustomFiles')) {
        /**
         * Has custom files
         *
         * @param array $params
         *
         * @return string
         */
        function hasCustomFiles(array $params): string
        {
            $ci = &get_instance();
            $backup_model = new \Pg\modules\install\models\BackupModel();
            $v = substr($params['config']['version_from'], strpos($params['config']['version_from'], '.') + 1);
            $file_info = $backup_model::BACKUP_PATH . "/{$v}/info.php";
            $info = [];
            if (file_exists($file_info)) {
                $info = require $file_info;
                if (!empty($info['info']['custom'])) {
                    foreach ($info['info']['custom'] as &$file) {
                        $file = str_replace($backup_model::BACKUP_PATH . "/{$v}", '', $file);
                    }
                }
            }
            $ci->view->assign('info', $info);

            return $ci->view->fetch("helper_has_custom_files", 'admin', 'install');
        }
    }

}

namespace {

    if (!function_exists('get_initial_setup_menu')) {
        function get_initial_setup_menu($step = 1)
        {
            return Pg\modules\install\helpers\getInitialSetupMenu($step);
        }
    }

    if (!function_exists('get_product_setup_menu')) {
        function get_product_setup_menu($step = 1)
        {
            return Pg\modules\install\helpers\getProductSetupMenu($step);
        }
    }

    if (!function_exists('get_modules_setup_menu')) {
        function get_modules_setup_menu($step = "")
        {
            return Pg\modules\install\helpers\getModulesSetupMenu($step);
        }
    }

    if (!function_exists('hasCustomFiles')) {
        function hasCustomFiles(array $params): string
        {
            return Pg\modules\install\helpers\hasCustomFiles($params);
        }
    }

}
