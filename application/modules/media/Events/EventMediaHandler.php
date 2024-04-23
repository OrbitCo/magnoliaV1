<?php

declare(strict_types=1);

namespace Pg\modules\media\Events;

use Pg\modules\media\models\MediaModel;
use Pg\libraries\EventDispatcher;
use Pg\libraries\EventHandler;

class EventMediaHandler extends EventHandler
{
    /**
     * Init handler
     *
     * return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $event_handler->addListener(MediaModel::EVENT_UPLOAD_IMAGE, function ($params) {
            $data = $params->getData();
            $ci = &get_instance();
            $ci->load->model("Media_model");
            $ci->Media_model->{$data['callback']}($data);
        });
        $event_handler->addListener(MediaModel::EVENT_UPLOAD_AUDIO, function ($params) {
            $data = $params->getData();
            $ci = &get_instance();
            $ci->load->model("Media_model");
            $ci->Media_model->{$data['callback']}($data);
        });
        $event_handler->addListener(MediaModel::EVENT_UPLOAD_VIDEO, function ($params) {
            $data = $params->getData();
            $ci = &get_instance();
            $ci->load->model("Media_model");
            $ci->Media_model->{$data['callback']}($data);
        });
    }
}
