<?php

declare(strict_types=1);

namespace Pg\modules\twilio_chat\controllers;

use Pg\modules\twilio_chat\models\TwilioChatModel;
use Pg\modules\twilio_chat\models\Services\TwilioRoom;
use Pg\Libraries\View;

/**
 * twilio_chat
 *
 * @package     PG_Dating
 * @subpackage  twilio_chat
 * @category    controllers
 * @copyright   Copyright (c) 2000-2021 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class AdminTwilioChat extends \Controller
{

    /**
     * AdminTwilioChat constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('twilio_chat/models/TwilioChatAdminModel');
        $this->load->model('MenuModel');
        $this->MenuModel->setMenuActiveItem('admin_menu', 'add_ons_items');
    }

    /**
     * Settings page data
     *
     * @return mixed
     */
    public function settings()
    {
        if (isset($_POST['btn_save'])) {
            $this->saveSettings();
            $this->view->assign('settings', $_POST);
        } else {
            $settings = $this->ci->pg_module->get_module_config('twilio_chat', 'settings');
            if (!empty($settings)) {
                $settings_data = json_decode($settings, true);
                $this->view->assign('settings', $settings_data);
            }
        }

        $all_chats = $this->TwilioChatAdminModel->getAllChats();

        try {
            $room = new TwilioRoom();

            $all_sum = 0;
            foreach ($all_chats as $key => $caht) {
                $names = explode('_', $caht['room_name']);
                $all_chats[$key]['name_creator'] = $names[0];
                $all_chats[$key]['name_invaded'] = $names[2];
                $all_chats[$key]['duration'] = TwilioChatModel::durationFormat((int)$all_chats[$key]['duration']);

                $all_sum += $caht['amount'];
                if ($caht['status'] == 'in-progress') {
                    if ($room->isEmptyRoom($caht['sid'])) {
                        $this->TwilioChatAdminModel->setStatus($caht['id'], 'disconnected');
                    }
                }
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }

        $callbackurl = site_url() . 'twilio_chat/callback_room_status/';
        $this->view->assign('all_sum', $all_sum);
        $this->view->assign('callbackurl', $callbackurl);
        $this->view->assign('chats', $all_chats);

        $this->view->setHeader(l('admin_header_settings', 'twilio_chat'));
        $this->view->setBackLink(site_url() . "admin/start/menu/add_ons_items");
        $this->view->render('settings');
    }


    /**
     * Save settings
     *
     * @return void
     */
    public function saveSettings()
    {
        $settings = [];

        foreach ($this->ci->input->post('keys') as $key => $value) {
            $settings['keys'][$key] = trim($value);
        }

        $settings['payment'] = $this->input->post('payment');

        $result = $this->TwilioChatAdminModel->saveSettings($settings);

        if ($result === true){
            $this->system_messages->addMessage(View::MSG_SUCCESS, l("success_save", 'twilio_chat'));
        }else{
            $this->system_messages->addMessage(View::MSG_ERROR, implode('<br>',$result['errors'] ?: [] ));

        }
    }
}
