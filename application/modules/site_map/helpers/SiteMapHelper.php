<?php

declare(strict_types=1);

namespace Pg\modules\site_map\helpers {

    if (!function_exists('getSitemap')) {
        function getSitemap()
        {
            $ci = &get_instance();
            $ci->load->model('Site_map_model');
            $url_blocks = $ci->Site_map_model->get_sitemap_links();
            $ci->view->assign("blocks", $url_blocks);

            return $ci->view->fetch('helper_sitemap', null, 'site_map');
        }
    }

}

namespace {
    
    if (!function_exists('getSitemap')) {
        function getSitemap()
        {
            return Pg\modules\site_map\helpers\getSitemap();
        }
    }

}
