<?php

return [
    'fe_sections' => [
        ["data" => ["gid" => "about-me", "editor_type_gid" => "users"]],
        ["data" => ["gid" => "my-interests", "editor_type_gid" => "users"]],
    ],

    'fe_fields' => [
        ["data" => ["gid" => "iphone_android",     "section_gid" => "about-me",     "editor_type_gid" => "users", "field_type" => "select",      "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";i:0;s:9:"view_type";s:6:"select";s:12:"empty_option";b:1;}', "sorter" => "1", "options" => ['1', '2', '3', '4', '5', '6', '7', '8']]],
        ["data" => ["gid" => "windows_mac",        "section_gid" => "about-me",     "editor_type_gid" => "users", "field_type" => "select",      "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";i:0;s:9:"view_type";s:6:"select";s:12:"empty_option";b:1;}', "sorter" => "2", "options" => ['1', '2', '3', '4', '5', '6']]],
        ["data" => ["gid" => "facebook_twitter",   "section_gid" => "about-me",     "editor_type_gid" => "users", "field_type" => "select",      "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";i:0;s:9:"view_type";s:6:"select";s:12:"empty_option";b:1;}', "sorter" => "3", "options" => ['1', '2', '3', '4', '5', '6', '7', '8']]],
        ["data" => ["gid" => "style",              "section_gid" => "about-me",     "editor_type_gid" => "users", "field_type" => "multiselect", "fts" => "1", "settings_data" => 'a:2:{s:13:"default_value";s:0:"";s:9:"view_type";s:8:"checkbox";}',                    "sorter" => "5", "options" => ['1', '2', '3', '4', '5', '6']]],
        ["data" => ["gid" => "favorite_films",    "section_gid" => "my-interests", "editor_type_gid" => "users", "field_type" => "textarea",    "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";s:0:"";s:8:"min_char";i:0;s:8:"max_char";i:0;}',             "sorter" => "1", "options" => []]],
        ["data" => ["gid" => "favorite_tv_shows", "section_gid" => "my-interests", "editor_type_gid" => "users", "field_type" => "textarea",    "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";s:0:"";s:8:"min_char";i:0;s:8:"max_char";i:0;}',             "sorter" => "2", "options" => []]],
        ["data" => ["gid" => "favorite_music",    "section_gid" => "my-interests", "editor_type_gid" => "users", "field_type" => "textarea",    "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";s:0:"";s:8:"min_char";i:0;s:8:"max_char";i:0;}',             "sorter" => "3", "options" => []]],
        ["data" => ["gid" => "favorite_books",    "section_gid" => "my-interests", "editor_type_gid" => "users", "field_type" => "textarea",    "fts" => "1", "settings_data" => 'a:3:{s:13:"default_value";s:0:"";s:8:"min_char";i:0;s:8:"max_char";i:0;}',             "sorter" => "4", "options" => []]],
    ],

    'fe_forms' => [
        [
            'data' => [
                'gid'             => 'advanced_search',
                'editor_type_gid' => 'users',
                'name'            => 'Search form',
                'field_data'      => '',
                'is_system'       => 1,
            ],
        ],
    ],
];
