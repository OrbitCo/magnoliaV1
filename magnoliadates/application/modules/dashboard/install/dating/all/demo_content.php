<?php

return [
    'payments' => [
        'status' => \Pg\modules\payments\models\PaymentsModel::STATUS_PAYMENT_SENDED,
        'type' => \Pg\modules\payments\models\PaymentsModel::TYPE_PAYMENT,
        'data' => [
            'getPaymentsData' => [
                'where' => [
                    'status' => 0,
                ],
            ],
        ],
    ],
    'moderation' => [
        'type' => \Pg\modules\moderation\models\ModerationModel::TYPE_MODERATION_ITEM,
        'status' => \Pg\modules\moderation\models\ModerationModel::STATUS_ADDED,
        'data' => [
            'getModerationData' => 'media_content',
        ],
    ],
];
