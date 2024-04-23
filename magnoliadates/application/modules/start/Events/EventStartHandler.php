<?php

declare(strict_types=1);

namespace Pg\modules\start\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

class EventStartHandler extends EventHandler
{
    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $ci = &get_instance();

        $ci->load->model('start/models/Intercom_model');
        
        if ($ci->Intercom_model->is_used) {
            $event_handler->addListener('user_register', function ($data) {
                $ci = &get_instance();
                $ci->Intercom_model->sendUserEvent('user_register', $data->getSearchFrom(), $data->getData());
            });
            
            $event_handler->addListener('user_login', function ($data) {
                $ci = &get_instance();
                $ci->Intercom_model->sendUserEvent('user_login', $data->getSearchFrom(), $data->getData());
            });
            
            $event_handler->addListener('profile_view', function ($data) {
                $ci = &get_instance();
                $ci->Intercom_model->sendUserEvent('profile_view', $data->getProfileViewFrom(), $data->getData());
            });
            
            $event_handler->addListener('media_upload_image', function ($data) {
                $ci = &get_instance();                
                
                $data = $data->getData();
                
                $ci->load->model('Users_model');
                
                $user_raw = $ci->Users_model->getUserById($data['id']);
                
                $ci->Intercom_model->sendUserEvent('gallery_photo_upload', $user_raw['id']);
            });
        }
    }
}
