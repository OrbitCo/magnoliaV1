<?php


use Phinx\Seed\AbstractSeed;

class ThemesColoursetsMainSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            0 => [
                'id' => 1,
                'set_name' => 'Default',
                'set_gid' => 'default',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"EEEEF4";s:7:"main_bg";s:6:"EE2C55";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"EE2C55";s:9:"footer_bg";s:6:"EEEEF4";s:15:"index_footer_bg";s:6:"322B37";s:11:"input_color";s:6:"EE2C55";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"00A11A";s:10:"link_color";s:6:"EE2C55";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"00A11A";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"DDDDDD";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"EEEEF4";s:7:"main_bg";s:6:"EE2C55";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"EE2C55";s:9:"footer_bg";s:6:"EEEEF4";s:15:"index_footer_bg";s:6:"322B37";s:11:"input_color";s:6:"EE2C55";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"00A11A";s:10:"link_color";s:6:"EE2C55";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"00A11A";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"DDDDDD";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 1,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 1,
            ],
            1 => [
                'id' => 2,
                'set_name' => 'Honey',
                'set_gid' => 'honey',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"EDEDED";s:7:"main_bg";s:6:"FDB502";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"FDB502";s:9:"footer_bg";s:6:"EDEDED";s:15:"index_footer_bg";s:6:"322B37";s:11:"input_color";s:6:"FD8502";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"FD8502";s:10:"link_color";s:6:"0031B0";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"2AAE34";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"DDDDDD";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"EDEDED";s:7:"main_bg";s:6:"FDB502";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"FDB502";s:9:"footer_bg";s:6:"EDEDED";s:15:"index_footer_bg";s:6:"322B37";s:11:"input_color";s:6:"FD8502";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"FD8502";s:10:"link_color";s:6:"0031B0";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"2AAE34";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"DDDDDD";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => '',
                'is_generated' => 0,
            ],
            2 => [
                'id' => 3,
                'set_name' => 'Default color scheme',
                'set_gid' => 'default',
                'id_theme' => 4,
                'color_settings' => 'a:23:{s:7:"html_bg";s:6:"F7F7F7";s:7:"main_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"FFFFFF";s:9:"footer_bg";s:6:"FFFFFF";s:8:"popup_bg";s:6:"363537";s:14:"input_main_btn";s:6:"32b44a";s:20:"input_additional_btn";s:6:"1479B8";s:10:"font_color";s:6:"73879C";s:10:"link_color";s:6:"5A738E";s:14:"contrast_color";s:6:"ECF0F1";s:11:"font_family";s:57:"\'Helvetica Neue\', Roboto, Arial, \'Droid Sans\', sans-serif";s:14:"main_font_size";s:2:"14";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:8:"index_bg";s:0:"";s:13:"index_bg_size";s:9:"auto auto";s:14:"index_bg_image";s:0:"";s:21:"index_bg_image_scroll";s:1:"0";s:27:"index_bg_image_adjust_width";s:1:"0";s:28:"index_bg_image_adjust_height";s:1:"0";s:23:"index_bg_image_repeat_x";s:1:"0";s:23:"index_bg_image_repeat_y";s:1:"0";s:18:"index_bg_image_ver";s:0:"";}',
                'default_color_settings' => 'a:23:{s:7:"html_bg";s:6:"F7F7F7";s:7:"main_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"FFFFFF";s:9:"footer_bg";s:6:"FFFFFF";s:8:"popup_bg";s:6:"363537";s:14:"input_main_btn";s:6:"32b44a";s:20:"input_additional_btn";s:6:"1479B8";s:10:"font_color";s:6:"73879C";s:10:"link_color";s:6:"5A738E";s:14:"contrast_color";s:6:"ECF0F1";s:11:"font_family";s:57:"\'Helvetica Neue\', Roboto, Arial, \'Droid Sans\', sans-serif";s:14:"main_font_size";s:2:"14";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:8:"index_bg";s:0:"";s:13:"index_bg_size";s:9:"auto auto";s:14:"index_bg_image";s:0:"";s:21:"index_bg_image_scroll";s:1:"0";s:27:"index_bg_image_adjust_width";s:1:"0";s:28:"index_bg_image_adjust_height";s:1:"0";s:23:"index_bg_image_repeat_x";s:1:"0";s:23:"index_bg_image_repeat_y";s:1:"0";s:18:"index_bg_image_ver";s:0:"";}',
                'active' => 1,
                'scheme_type' => 'light',
                'preset' => '',
                'is_generated' => 1,
            ],
            3 => [
                'id' => 4,
                'set_name' => 'arundiana',
                'set_gid' => 'arundiana',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"F0F0F0";s:7:"main_bg";s:6:"FF7F66";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"7ECEFD";s:9:"footer_bg";s:6:"FFFFFF";s:15:"index_footer_bg";s:6:"FFFFFF";s:11:"input_color";s:6:"7ECEFD";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"2185C5";s:10:"link_color";s:6:"2185C5";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"2185C5";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"F0F0F0";s:7:"main_bg";s:6:"FF7F66";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"7ECEFD";s:9:"footer_bg";s:6:"FFFFFF";s:15:"index_footer_bg";s:6:"FFFFFF";s:11:"input_color";s:6:"7ECEFD";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"2185C5";s:10:"link_color";s:6:"2185C5";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"2185C5";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 0,
            ],
            4 => [
                'id' => 5,
                'set_name' => 'luisia',
                'set_gid' => 'luisia',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"FFFFFF";s:7:"main_bg";s:6:"1A1A1A";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"1A1A1A";s:9:"footer_bg";s:6:"FFFFFF";s:15:"index_footer_bg";s:6:"1A1A1A";s:11:"input_color";s:6:"1A1A1A";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"C59D5F";s:10:"link_color";s:6:"C59D5F";s:10:"font_color";s:6:"1A1A1A";s:12:"header_color";s:6:"1A1A1A";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"C59D5F";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"FFFFFF";s:7:"main_bg";s:6:"1A1A1A";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"1A1A1A";s:9:"footer_bg";s:6:"FFFFFF";s:15:"index_footer_bg";s:6:"1A1A1A";s:11:"input_color";s:6:"1A1A1A";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"C59D5F";s:10:"link_color";s:6:"C59D5F";s:10:"font_color";s:6:"1A1A1A";s:12:"header_color";s:6:"1A1A1A";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"C59D5F";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 0,
            ],
            5 => [
                'id' => 6,
                'set_name' => 'listera',
                'set_gid' => 'listera',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"F5F5F5";s:7:"main_bg";s:6:"111111";s:21:"index_promo_text_main";s:6:"111111";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"111111";s:9:"footer_bg";s:6:"EEEEF4";s:15:"index_footer_bg";s:6:"FFFFFF";s:11:"input_color";s:6:"F20505";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"FCF8E3";s:10:"link_color";s:6:"F20505";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"EEEEEE";s:15:"indicator_color";s:6:"F20505";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"F5F5F5";s:7:"main_bg";s:6:"111111";s:21:"index_promo_text_main";s:6:"111111";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"111111";s:9:"footer_bg";s:6:"EEEEF4";s:15:"index_footer_bg";s:6:"FFFFFF";s:11:"input_color";s:6:"F20505";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"FCF8E3";s:10:"link_color";s:6:"F20505";s:10:"font_color";s:6:"111111";s:12:"header_color";s:6:"111111";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"EEEEEE";s:15:"indicator_color";s:6:"F20505";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 0,
            ],
            6 => [
                'id' => 7,
                'set_name' => 'dendrobium',
                'set_gid' => 'dendrobium',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"202228";s:7:"main_bg";s:6:"CB3289";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"CB3289";s:9:"footer_bg";s:6:"202228";s:15:"index_footer_bg";s:6:"202228";s:11:"input_color";s:6:"CB3289";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"7A77E9";s:10:"link_color";s:6:"B4E1FD";s:10:"font_color";s:6:"FFFFFF";s:12:"header_color";s:6:"FFFFFF";s:11:"descr_color";s:6:"C4CAD0";s:14:"contrast_color";s:6:"2F323B";s:15:"delimiter_color";s:6:"3B3836";s:15:"indicator_color";s:6:"7471DE";s:10:"content_bg";s:6:"2F323B";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"202228";s:7:"main_bg";s:6:"CB3289";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"CB3289";s:9:"footer_bg";s:6:"202228";s:15:"index_footer_bg";s:6:"202228";s:11:"input_color";s:6:"CB3289";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"7A77E9";s:10:"link_color";s:6:"B4E1FD";s:10:"font_color";s:6:"FFFFFF";s:12:"header_color";s:6:"FFFFFF";s:11:"descr_color";s:6:"C4CAD0";s:14:"contrast_color";s:6:"2F323B";s:15:"delimiter_color";s:6:"3B3836";s:15:"indicator_color";s:6:"7471DE";s:10:"content_bg";s:6:"2F323B";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 0,
            ],
            7 => [
                'id' => 8,
                'set_name' => 'bonatea',
                'set_gid' => 'bonatea',
                'id_theme' => 3,
                'color_settings' => 'a:33:{s:7:"html_bg";s:6:"F5F5F5";s:7:"main_bg";s:6:"129876";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"129876";s:9:"footer_bg";s:6:"F5F5F5";s:15:"index_footer_bg";s:6:"F5F5F5";s:11:"input_color";s:6:"129876";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"84DAFE";s:10:"link_color";s:6:"129876";s:10:"font_color";s:6:"0A0C1D";s:12:"header_color";s:6:"0A0C1D";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"0A0C1D";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'default_color_settings' => 'a:33:{s:7:"html_bg";s:6:"F5F5F5";s:7:"main_bg";s:6:"129876";s:21:"index_promo_text_main";s:6:"FFFFFF";s:22:"index_promo_text_on_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"129876";s:9:"footer_bg";s:6:"F5F5F5";s:15:"index_footer_bg";s:6:"F5F5F5";s:11:"input_color";s:6:"129876";s:14:"input_bg_color";s:6:"FFFFFF";s:12:"status_color";s:6:"84DAFE";s:10:"link_color";s:6:"129876";s:10:"font_color";s:6:"0A0C1D";s:12:"header_color";s:6:"0A0C1D";s:11:"descr_color";s:6:"777777";s:14:"contrast_color";s:6:"AAAAAA";s:15:"delimiter_color";s:6:"DDDDDD";s:15:"indicator_color";s:6:"0A0C1D";s:10:"content_bg";s:6:"FFFFFF";s:11:"font_family";b:0;s:14:"main_font_size";s:2:"14";s:15:"input_font_size";s:2:"15";s:12:"h1_font_size";s:2:"20";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:14:"alert_error_bg";s:6:"F2DEDE";s:17:"alert_error_color";s:6:"A94442";s:16:"alert_success_bg";s:6:"DFF0D8";s:19:"alert_success_color";s:6:"3C763D";s:13:"alert_info_bg";s:6:"FFFFFF";s:17:"alert_info_border";s:6:"BCE8F1";s:16:"alert_info_color";s:6:"111111";s:16:"alert_warning_bg";s:6:"FCF8E3";s:19:"alert_warning_color";s:6:"8A6D3B";}',
                'active' => 0,
                'scheme_type' => 'light',
                'preset' => 'default',
                'is_generated' => 0,
            ],
        ];

        $this->table(DB_PREFIX . 'themes_colorsets')
            ->insert($data)
            ->saveData();
    }
}
