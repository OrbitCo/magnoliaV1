<?php

declare(strict_types=1);

namespace Pg\modules\themes\helpers {

    if (!function_exists('preview')) {

        /**
         * Preview user themes.
         *
         * @return mixed
         */
        function preview()
        {
            $ci = &get_instance();
            $ci->load->model('Themes_model');
            $theme_id = current($ci->Themes_model->getInstalledThemesList(['where' => [
                'theme_type' => 'user', 'active' => 1,
            ]]))['id'];
            $data = $ci->Themes_model->getSetsList($theme_id);

            $demo_path_img = SITE_PHYSICAL_PATH.'application/views/flatty/img/demo/';
            foreach ($data as $key => $theme) {
                if (isset($theme['set_gid'])) {
                    if (!file_exists($demo_path_img.$theme['set_gid'].'.png')) {
                        unset($data[$key]);
                    }
                }
            }
            $ci->view->assign('theme_id', $theme_id);
            $ci->view->assign('themes_list', $data);

            return $ci->view->fetch('helper_themes_list', 'user', 'themes');
        }
    }
}

namespace {

    if (!function_exists('preview')) {
        function preview()
        {
            return Pg\modules\themes\helpers\preview();
        }
    }

}
