<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('get_landing_pages')) {
    function get_landing_pages()
    {
        if (!INSTALL_MODULE_DONE) {
            return;
        }

        $landing_pages_links_file = SITE_PHYSICAL_PATH . APPLICATION_FOLDER . 'config/landings_module_routes.php';

        include_once $landing_pages_links_file;

        $config = &load_class('Config');

        $URI = &load_class('URI');
        $URI->_fetch_uri_string();

        $uri_string = $URI->uri_string();

        $uri_string = rtrim($uri_string, '/') . '/';

        $langs = $config->item('langs_route');

        foreach ($langs as $lang) {
            $uri_string = preg_replace('#^/' . preg_quote($lang, '#') . '/#i', '/', $uri_string);
        }

        if ($uri_string == '/admin' && strpos($uri_string, '/admin/') == 0) {
            return;
        }

        $uri_string = rtrim($uri_string, '/');

        $uri_string = preg_replace('#/index$#i', '', $uri_string);

        if (empty($uri_string)) {
            $uri_string = "/start";
        }

        if (isset($landing_data[$uri_string])) {
            include LIBPATH . 'Landing.php';
            $CI = new Pg\Libraries\Landing();

            if ($CI->session->userdata('auth_type') == 'user') {
                redirect(site_url() . 'users/search');
            }

            $CI->load->helper('theme');

            if ($CI->pg_module->is_module_installed('landings')) {
                $CI->load->model('Landings_model');
                $link = rtrim(ltrim($uri_string, '/'), '/');
                $landing = $CI->Landings_model->getLandingsList(null, null, null, ['where' => ['link' => $link]]);
                if ($landing) {
                    if ($landing[0]['url_page']) {
                        $cur_page_url = $landing[0]['url_page'];
                        $content = file_get_contents($cur_page_url);
                        $content = str_replace("<head>", '<head>
                                 <base href="' . base_url() . '">
                                 <link rel="dns-prefetch" href="' . base_url() . '">', $content);
                        $content = str_replace(
                            ['<body>', '</body>'],
                            [
                                '<body><div id="pjaxcontainer">',
                                '<script>var site_url = "' . site_url() . '"; var base_url = "' . base_url() . '";  var is_webpack = true;</script>'
                                . load(['name' => 'main', 'ext' => 'js'])
                                . load(['name' => 'modules', 'ext' => 'js'])
                                .'<script type="text/javascript" src="' . MODULEPATH_VIRTUAL . 'users/js/UsersRegistrationWidget.js"></script><div id="url_landing"></div>'
                                . '</div></body>'],
                            $content
                        );
                        if (strpos($cur_page_url, 'tilda') !== false) {
                            $content .= '<style>
                                            #tilda-popup-for-error, .t-input-error{display: none !important;}
                                        </style>'
                                        . '<script>
                                                $(".t-tildalabel").remove();
                                                $("img[data-original]").each(function(){
                                                    $(this).attr("src", $(this).data("original"));
                                                });
                                                $(".t-bgimg[data-original]").each(function(){
                                                    let url = "url(" + $(this).data("original") + ")";
                                                    $(this).css("background-image", url);
                                                });
                                                $(".t-cover__carrier[data-content-cover-bg]").each(function(){
                                                    let url = "url(" + $(this).data("content-cover-bg") + ")";
                                                    $(this).css("background-image", url);
                                                });
                                                $(`[rel="shortcut icon"]`).attr("href", "/application/views/flatty/img/favicon/favicon.ico")
                                            </script>';
                        }
                        echo $content;
                        exit;
                    }
                }
            }

            $value = $landing_data[$uri_string];

            if (substr($value, -4, 4) == '.php') {
                include SITE_PHYSICAL_PATH . UPLOAD_DIR . 'landings/' . $value;
            } else {
                $content =  file_get_contents(SITE_PHYSICAL_PATH . UPLOAD_DIR . 'landings/' . $value);
                $content = str_replace(
                    ['<body>', '</body>'],
                    [
                        '<body><div id="pjaxcontainer">',
                        '<script>var site_url = "' . site_url() . '"; var base_url = "' . base_url() . '";  var is_webpack = true;</script>'
                        . load(['name' => 'main', 'ext' => 'js'])
                        . load(['name' => 'modules', 'ext' => 'js'])
                        . '<script type="text/javascript" src="' . MODULEPATH_VIRTUAL . 'users/js/UsersRegistrationWidget.js"></script>'
                                . '</div></body>'],
                    $content
                );
                echo $content;
            }
            exit;
        }
    }
}
