<?php

declare(strict_types=1);

namespace Pg\modules\moderation\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;
use Pg\modules\moderation\models\ModerationModel;
use Pg\Libraries\Traits\CiTrait;

/**
 * Moderation event handler
 *
 * @copyright   Copyright (c) 2000-2020
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class EventModerationHandler extends EventHandler
{
    use CiTrait;

    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $event_handler->addListener(
            ModerationModel::EVENT_OBJECT_CHANGED,
            static function ($event) {
                $data = $event->getData();
                if ($data['status'] === ModerationModel::STATUS_DECLINED) {
                    (new ModerationModel())->sendNotification(
                        $data['obj'],
                        $data['status'],
                        $data['reason']
                    );
                }
            }
        );
        $event_handler->addListener(
            'install_network',
            function ($params) {
                $data = $params->getData()['moderation'];
                if (!empty($data)) {
                    $this->ci()->load->model('moderation/models/ModerationTypeModel');
                    foreach ($data as $mtype) {
                        $mtype['date_add'] = date("Y-m-d H:i:s");
                        $this->ci->ModerationTypeModel->saveType(null, $mtype);
                    }
                }
            }
        );

        $event_handler->addListener(
            'deinstall_network',
            function ($params) {
                $data = $params->getData()['moderation'];
                if (!empty($data)) {
                    $this->ci()->load->model('moderation/models/ModerationTypeModel');
                    foreach ($data as $mtype) {
                        $this->ci->ModerationTypeModel->deleteTypeByName($mtype["name"]);
                    }
                }
            }
        );
    }
}
