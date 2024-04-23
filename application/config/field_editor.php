<?php

$config["editor_type"]["users"] = [
    "gid"    => "users",
    "module" => "users",
    "name"   => "Users",
    "tables" => [
        "user" => DB_PREFIX . 'users',
    ],
    "field_prefix"   => 'fe_',
    'fulltext_use'   => true,
    'fulltext_field' => [
        "user" => 'search_field',
    ],
    'fulltext_model'    => "Users_model",
    'fulltext_callback' => "get_fulltext_data",
];
