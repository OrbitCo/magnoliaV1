<?php

declare(strict_types=1);

namespace Pg\modules\user_information\helpers {
    
    if (!function_exists('downloadPage')) {

        /**
         * Block for creating and downloading an archive with personal information
         *
         * @return mixed
         */
        function downloadPage()
        {
            $ci = &get_instance();
            $ci->load->model('User_information_model');
            $data = $ci->User_information_model->getArchive((int)$ci->session->userdata('user_id'));
            $ci->view->assign('data', $data);
            return $ci->view->fetch('helper_download_page', 'user', 'user_information');
        }
    }
    
    if (!function_exists('archiveStatus')) {

        /**
         * Status of the archive with personal information
         *
         * @return string
         */
        function archiveStatus()
        {
            $ci = &get_instance();
            $ci->load->model('User_information_model');
            return $ci->User_information_model->getArchive((int)$ci->session->userdata('user_id'))['status'];
        }
    }
    
    if (!function_exists('modulesList')) {

        /**
         * Block for creating and downloading an archive with personal information
         *
         * @return mixed
         */
        function modulesList()
        {
            $ci = &get_instance();
            $ci->load->model('user_information/models/User_information_modules_model');
            $modules_data = '';
            $modules = $ci->pg_module->get_modules();
            foreach ($modules as $module_data) {
                $module = $module_data['module_gid'];
                $ucfirst_module = $ci->User_information_modules_model->ucfirstModule($module);
                if (class_exists(NS_MODULES . $module . '\\models\\' . $ucfirst_module . 'UserInformationModel') !== false) {
                    $ci->view->assign('is_not_archive', 1);
                    $modules_data .= $ci->view->fetch('user_information/main', 'user', $module);
                }
            }

            $ci->view->assign('modules_data', $modules_data);
            return $ci->view->fetch('helper_modules_list', 'user', 'user_information');
        }
    }
}

namespace {

    if (!function_exists('downloadPage')) {

        function downloadPage()
        {
            return Pg\modules\user_information\helpers\downloadPage();
        }
    }
    
    if (!function_exists('modulesList')) {

        function modulesList()
        {
            return Pg\modules\user_information\helpers\modulesList();
        }
    }
}
