<?php

use Pg\modules\favorites\models\FavoritesModel;

return [
    [
        'module_gid' => FavoritesModel::MODULE_GID,
        'controller' => FavoritesModel::MODULE_GID,
        'method' => null,
        'access' => 2,

        // TODO: не применять изменения к указанным методам
        'exclude' => [
            'favorites_favorites_get_status',
            'favorites_api_favorites_get_status',
        ],
    ]
];
