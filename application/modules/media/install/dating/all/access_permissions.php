<?php
return [
    [
        'module_gid' => 'media',
        'controller' => 'media',
        'method' => null,
        'methods' => null,
        'not_methods' => [
            'ajax_add_audio',
            'ajax_add_images',
            'ajax_add_media_in_album',
            'ajax_add_video',
            'ajax_delete_album',
            'ajax_delete_media',
            'ajax_delete_media_from_album',
            'ajax_edit_album',
            'ajax_get_list',
            'ajax_get_user_recent_media',
            'ajax_recrop',
            'ajax_rotate',
            'ajax_save_album',
            'ajax_save_audio_title',
            'ajax_save_description',
            'ajax_save_permissions',
            'ajax_view_media',
            'save_audio',
            'save_image',
            'save_video'
            ],
        'access' => 2
    ],
    [
        'module_gid' => 'media',
        'controller' => 'media',
        'method' => null,
        'methods' => null,
        'access' => 1
    ]
];
