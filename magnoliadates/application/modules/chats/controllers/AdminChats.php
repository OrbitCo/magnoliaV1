<?php

declare(strict_types=1);

namespace Pg\modules\chats\controllers;

use Pg\modules\chats\models\ChatsModel;

/**
 * Admin chats controller.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 * */
class AdminChats extends \Controller
{
    /**
     * AdminChats constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('ChatsModel');
        $this->MenuModel->setMenuActiveItem('admin_menu', 'add_ons_items');
    }

    public function index()
    {
        $chats = $this->ChatsModel->getList(true);
        $this->view->setHeader(l('admin_header_chats', 'chats'));
        $this->view->assign('chats', $chats);
        $this->view->render('list');
    }

    public function settings($gid, $subpage = '')
    {
        $chat = $this->ChatsModel->get($gid);
        if ($this->input->post('btn_save')) {
            $post_data = filter_input_array(INPUT_POST, ['settings' => ['flags' => FILTER_REQUIRE_ARRAY]]);
            $chat->set_settings($post_data['settings']);
            if ($chat->validate_settings()) {
                $this->ChatsModel->save($chat->as_array(true), $chat->get_id());
            }
        }
        $this->view->assign('chat_block', $chat->admin_page($subpage));

        if ($gid == 'pg_videochat') {
            $this->view->setHeader('PG videochat');
        }

        $this->view->render('view');
    }

    public function activate($gid)
    {
        $this->ChatsModel->set_active($gid, true);
        redirect(site_url() . 'admin/chats');
    }

    public function deactivate($gid)
    {
        $this->ChatsModel->set_active($gid, false);
        redirect(site_url() . 'admin/chats');
    }

    public function installation($gid)
    {
        $chat = $this->ChatsModel->get($gid);
        $tpl = $chat->install_page();
        if (is_null($tpl)) {
            redirect(site_url() . 'admin/chats');
        } else {
            $this->view->assign('chat_block', $tpl);
            $this->view->render('install');
        }
    }

    public function setInstall($gid)
    {
        $this->ChatsModel->set_installed($gid);
        redirect(site_url() . 'admin/chats');
    }
}
