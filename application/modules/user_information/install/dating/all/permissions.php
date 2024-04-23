<?php
/**
 * user_information module
 */
return [
    /**
     * Admin permissions
     */
    'admin_user_information' => [
        'index' => 3
    ],
    /**
     * API permissions
     */
    'api_user_informations' => [
        'index' => 2
    ],
    /**
     * Users permissions (guests and authorized)
     */
    'user_information' => [
        'index' => 2,
        'create' => 2,
        'delete' => 2,
        'download' => 2,
        'view_user_info' => 2
    ],
];
