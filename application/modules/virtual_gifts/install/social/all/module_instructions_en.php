<?php

use Pg\modules\virtual_gifts\models\VirtualGiftsModel;

return [
    'admin' => [
        1 => [
            'page' => false,
            'selector' => '#virtual-gifts',
            'attr' => 'box-shadow: 2px 2px 10px #d9534f;',
            'title' => 'Events list',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ],
        2 => [
            'page' => 'admin/' . VirtualGiftsModel::MODULE_GID . '/settings',
            'selector' => '.x_panel',
            'attr' => 'box-shadow: 2px 2px 10px #d9534f;',
            'title' => 'Quick stats',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ],
    ]
];
