<?php

use Pg\modules\favorites\models\FavoritesModel;

return [
    'acl' => [
        FavoritesModel::MODULE_GID => [
             'module' => [
                'access' => 2,
                'module_gid' => FavoritesModel::MODULE_GID,
                'permission' => FavoritesModel::MODULE_GID . '_' . FavoritesModel::MODULE_GID,
             ],
             'permissions' => [
                'list' => [
                    FavoritesModel::MODULE_GID => [
                        'default' => ['status' => 0],
                        'trial' => ['status' => 1],
                        'silver' => ['status' => 1],
                        'premium' => ['status' => 1],
                    ]
                ],
             ],
        ]
    ]
];
