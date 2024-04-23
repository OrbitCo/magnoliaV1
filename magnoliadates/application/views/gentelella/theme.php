<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$_theme["gid"] = "gentelella";
$_theme["type"] = "admin";
$_theme["name"] = "Admin area theme";
$_theme["description"] = "Default admin template; PilotGroup";
$_theme["default_scheme"] = "default";
$_theme["setable"] = "1";
$_theme["scss"] = "1";
$_theme["template_engine"] = "twig";

$_theme["logo_width"] = "160";
$_theme["logo_height"] = "160";
$_theme["logo_default"] = "logo.png";

$_theme["mini_logo_width"] = "160";
$_theme["mini_logo_height"] = "160";
$_theme["mini_logo_default"] = "logo.png";

$_theme["mobile_logo_default"] = "mobile_logo.png";
$_theme["mobile_logo_width"] = "160";
$_theme["mobile_logo_height"] = "32";

$_theme["schemes"] = [
    "default" => [
            "name"           => "Default color scheme",
            "active"         => "1",
            "color_settings" => 'a:23:{s:7:"html_bg";s:6:"F7F7F7";s:7:"main_bg";s:6:"FFFFFF";s:9:"header_bg";s:6:"EDEDED";s:9:"footer_bg";s:6:"FFFFFF";s:8:"popup_bg";s:6:"2A3F54";s:14:"input_main_btn";s:6:"1ABB9C";s:20:"input_additional_btn";s:6:"1479B8";s:10:"font_color";s:6:"73879C";s:10:"link_color";s:6:"5A738E";s:14:"contrast_color";s:6:"ECF0F1";s:11:"font_family";s:57:"\'Helvetica Neue\', Roboto, Arial, \'Droid Sans\', sans-serif";s:14:"main_font_size";s:2:"13";s:12:"h2_font_size";s:2:"14";s:15:"small_font_size";s:2:"12";s:8:"index_bg";s:0:"";s:13:"index_bg_size";s:9:"auto auto";s:14:"index_bg_image";s:0:"";s:21:"index_bg_image_scroll";s:1:"0";s:27:"index_bg_image_adjust_width";s:1:"0";s:28:"index_bg_image_adjust_height";s:1:"0";s:23:"index_bg_image_repeat_x";s:1:"0";s:23:"index_bg_image_repeat_y";s:1:"0";s:18:"index_bg_image_ver";s:0:"";}',
            "scheme_type"    => 'light',
            "dynamic_blocks" => '',
        ],
];

$_theme["css"] = [
    "custom" => ["file"=>"custom-[dir].css", "media"=>"screen"],
];
