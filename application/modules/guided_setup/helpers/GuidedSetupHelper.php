<?php

declare(strict_types=1);

namespace Pg\modules\guided_setup\helpers {

    if (!function_exists('guidePageBtn')) {
        function guidePageBtn($params)
        {
            if (!isset($params['menu_gid'])) {
                return;
            }
            
            $ci = &get_instance();
            $ci->load->model("Guided_setup_model");
            $menu = $ci->Guided_setup_model->getMenuByGid($params['menu_gid']);
            $ci->view->assign('guided_menu', $menu);
            return $ci->view->fetch('helper_btn_' . $params['menu_gid'], 'admin', 'guided_setup');
        }
    }
    
}
