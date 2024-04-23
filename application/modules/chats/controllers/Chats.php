<?php

declare(strict_types=1);

namespace Pg\modules\chats\controllers;

use Pg\Libraries\View;

/**
 * Chats controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 * */
class Chats extends \Controller
{
    protected $active;

    protected $user_id;

    /**
     * Controller
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Chats_model');

        $this->active = $this->Chats_model->getActive();

        if (empty($this->active)) {
            show_404();
        }

        $this->user_id = $this->session->userdata('user_id');
    }

    public function call($chat_gid, $method_name)
    {
        $method_exists = true;

        $method = 'call_' . $method_name;
        if (!method_exists($chat, $method)) {
            $chunks = explode('_', $method_name);
            $method = 'call';
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }

            if (!method_exists($chat, $method)) {
                $method_exists = false;
            }
        }

        if (func_num_args() > 2) {
            $args = array_slice(func_get_args(), 2);
        } else {
            $args = [];
        }
        call_user_func_array([$chat, $method], $args);
        exit;
    }

    public function index($subpage = '', $page = 1)
    {
        $this->Menu_model->breadcrumbs_set_active(l('chat', 'chats'));
        $this->view->assign('chat_block', $this->active->userPage($subpage, $page));
        $this->view->render('chat');
    }

    public function ajaxInviteForm($user_id)
    {
        $this->load->model('Users_model');

        $contact_user = $this->Users_model->getUserById($user_id);
        if ($contact_user['online_status'] == 0) {
            $this->view->assign('error_online');
            $this->view->render();

            return;
        }

        $settings = $this->active->getSettings();

        if ($settings['fee_type'] == 'payed') {
            $user_data = $this->Users_model->getUserById($this->user_id);

            if ((float)$user_data['account'] < (float)$settings['amount']) {
                $this->load->helper('seo');

                $link = rewrite_link('users', 'account', ['action' => 'update']);
                $lang_add_money = str_replace('[link]', $link, l('pg_videochat_text_add_funds', 'chats'));

                $this->view->assign('not_money', 1);
                $this->view->assign('lang_add_money', $lang_add_money);
            } elseif ($settings['chat_type'] == 'now') {
                $chat_key = $this->active->generateKey();
            }
        } elseif ($settings['chat_type'] == 'now') {
            $chat_key = $this->active->generateKey();
        }

        if (isset($chat_key)) {
            $this->active->saveChat(null, [
                'invite_user_id'                => $this->user_id,
                'invited_user_id'               => $user_id,
                'date_time'                     => date('Y-m-d H:i:00'),
                'date_created'                  => date('Y:m:d H:i:s'),
                'chat_key'                      => $chat_key,
                'status'                        => 'approve',
                'last_change_date_time_user_id' => $this->user_id,
            ]);

            $this->view->render();

            return;
        }

        $timezone_offset = timezone_offset_get(timezone_open(date_default_timezone_get()), new \DateTime());
        if ($timezone_offset) {
            $timezone_offset = sprintf('%02d', ceil($timezone_offset / 3600));
        }
        $this->view->assign('timezone_offset', $timezone_offset);

        $proposed_time = time() + 3600;

        $this->view->assign('proposedDate', date('Y-m-d', $proposed_time));
        $this->view->assign('proposedHours', date('H', $proposed_time));
        $this->view->assign('proposedMinutes', floor(((int) date('i', $proposed_time)) / 15) * 15);

        $this->view->assign('minDate', date('Y-m-d'));
        $this->view->assign('settings', $settings);
        $this->view->assign('user_id', $user_id);

        $this->view->render('ajax_invite_form');
    }

    public function ajaxCheckInvite($user_id)
    {
        if ((!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $post_data = [
            'date' => $this->input->post("date", true),
            'time' => $this->input->post("time", true),
        ];

        $post_data['date'] = $this->pg_date->strTranslate($post_data['date']);

        $validate_data = $this->active->validateInviteForm($post_data);
        if (!empty($validate_data['errors'])) {
            $this->view->assign('error', $validate_data['errors']);
        }

        $this->view->render();
    }

    public function invite($user_id)
    {
        if (empty($user_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $date = $this->input->post("date", true);
        $time = $this->input->post("time", true);

        $save_data = [
            'invite_user_id'  => $this->user_id,
            'invited_user_id' => $user_id,
            'date_time'       => $date . ' ' . $time . ':00',
            'date_created'    => date('Y:m:d H:i:s'),
        ];

        $message = l('message_new_invite', 'chats');
        $user_name = '<a href="' . site_url() . 'user/view/' . $this->user_id . '">'
                   . $this->session->userdata('output_name') . '</a>';
        $message = str_replace(
            ['[user_name]', '[date_time]', '[invite_link]'],
            [$user_name, $save_data['date_time'], site_url() . 'chats/index/inbox'],
            $message
        );

        //$this->load->model("Mailbox_model");

        // $message_data = array(
        //     'id_to_user'   => $user_id,
        //     'subject'      => l('subject_new_invite', 'chats'),
        //     'message'      => $message,
        //     'id_user'      => $this->user_id,
        //     'id_from_user' => $this->user_id,
        //     'is_new'       => 0,
        //     'folder'       => 'drafts',
        // );

        //$message_id = $this->Mailbox_model->save_message(null, $message_data);
        //$is_send = $this->Mailbox_model->send_message($message_id);

        $is_send = null;

        if ($this->pg_module->is_module_installed('chatbox')) {
            $this->load->model('chatbox/models/Chatbox_model');
            $is_send = $this->Chatbox_model->addMessage($user_id, $user_id, $message, true, true)['o_msg_id'];
        }

        $save_data['invite_message_id'] = $is_send;
        $save_data['last_change_date_time_user_id'] = $this->user_id;
        $chat_id = $this->active->save_chat(null, $save_data);

        $this->system_messages->addMessage('success', l('success_add_chat', 'chats'));

        redirect($_SERVER["HTTP_REFERER"], 'hard');
    }

    public function discuss($chat_id)
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $chat = $this->active->getChatById($chat_id, false);
        if (empty($chat)) {
            show_404();
        }

        if (!in_array($this->user_id, [$chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        if ($chat['status'] != 'send') {
            show_404();
        }

        $this->active->save_chat($chat_id, ['status' => 'discussed']);

        redirect(site_url() . 'chatbox/chat/' . $chat['invite_user_id'], 'hard');

        //redirect(site_url() . 'mailbox/view/' . $chat['invite_message_id'], 'hard');
    }

    public function accept($chat_id)
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');

        $chat = $this->active->getChatById($chat_id, false);
        if (empty($chat)) {
            show_404();
        }

        if ($chat['invited_user_id'] != $user_id) {
            show_404();
        }

        if ($chat['status'] != 'send') {
            show_404();
        }

        $this->active->saveChat($chat_id, ['status' => 'approve']);

        redirect($_SERVER["HTTP_REFERER"], 'hard');
    }

    public function decline($chat_id = '')
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');

        $chat = $this->active->getChatById($chat_id, false);
        if (empty($chat)) {
            show_404();
        }

        if ($chat['invited_user_id'] != $user_id) {
            show_404();
        }

        if ($chat['status'] != 'send' && $chat['status'] != 'discussed') {
            show_404();
        }

        $this->active->saveChat($chat_id, ['status' => 'decline']);

        redirect($_SERVER["HTTP_REFERER"], 'hard');
    }

    public function delete($chat_id = '')
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');

        $chat = $this->active->getChatById($chat_id, false);
        if (empty($chat)) {
            show_404();
        }

        if (!in_array($user_id, [$chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        $this->active->deleteChat($chat_id);

        $this->view->setRedirect($_SERVER["HTTP_REFERER"], 'hard');
    }

    public function ajaxChangeTimeForm($chat_id)
    {
        $chat = $this->active->getChatById($chat_id, false);

        $timezone_offset = timezone_offset_get(timezone_open(date_default_timezone_get()), new \DateTime());
        if ($timezone_offset) {
            $timezone_offset = sprintf('%02d', ceil($timezone_offset / 3600));
        }
        $this->view->assign('timezone_offset', $timezone_offset);

        $data_time_array = explode(' ', $chat['date_time']);
        $time_array  = explode(':', $data_time_array[1]);

        $this->view->assign('current_date', $data_time_array[0]);
        $this->view->assign('current_hours', intval($time_array[0]));
        $this->view->assign('current_minutes', intval($time_array[1]));
        $this->view->assign('chat_id', $chat_id);
        $this->view->assign('minDate', date('Y-m-d'));

        $this->view->render('ajax_change_time_form');
    }

    public function ajaxCheckChange($chat_id)
    {
        if (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat'])) {
            show_404();
        }

        $post_data = [
            'date' => $this->input->post("date", true),
            'time' => $this->input->post("time", true),
        ];

        $post_data['date'] = $this->pg_date->strTranslate($post_data['date']);

        $validate_data = $this->active->validateInviteForm($post_data);
        if (!empty($validate_data['errors'])) {
            $this->view->assign('error', $validate_data['errors']);
        }

        $this->view->render();
    }

    public function change($chat_id)
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $chat = $this->active->getChatById($chat_id, false);
        if (empty($chat) || ($chat['status'] != 'send' && $chat['status'] != 'discussed')) {
            show_404();
        }

        $is_inviter = $chat['invite_user_id'] == $this->user_id;
        $is_invited = $chat['invited_user_id'] == $this->user_id;

        if ($is_inviter) {
            $user_id = $chat['invited_user_id'];
        } elseif ($is_invited) {
            $user_id = $chat['invite_user_id'];
        } else {
            show_404();
        }

        $date = $this->input->post('date', true);
        $time = $this->input->post("time", true);

        $save_data = ['date_time' => $date . ' ' . $time . ':00'];

        $message = l('message_change_time_invite', 'chats');
        $user_name = '<a href="' . site_url() . 'user/view/' . $this->user_id . '">' . $this->session->userdata("output_name") . '</a>';
        $message = str_replace(['[user_name]', '[date_time]', '[invite_link]'], [$user_name, $save_data['date_time'], site_url() . "chats/index"], $message);

        //$this->load->model("Mailbox_model");

        // $message_id = $this->Mailbox_model->saveMessage(null, [
        //     'id_to_user'   => $user_id,
        //     'subject'      => l('subject_change_time_invite', 'chats'),
        //     'message'      => $message,
        //     'id_user'      => $this->user_id,
        //     'id_from_user' => $this->user_id,
        //     'is_new'       => 0,
        //     'folder'       => 'drafts',
        // ]);

        //$is_send = $this->Mailbox_model->sendMessage($message_id);

        $is_send = null;

        if ($this->pg_module->is_module_installed('chatbox')) {
            $this->load->model('chatbox/models/Chatbox_model');
            $is_send = $this->Chatbox_model->addMessage($user_id, $user_id, $message, true, true)['o_msg_id'];
        }

        $save_data['invite_message_id'] = $is_send;
        $save_data['last_change_date_time_user_id'] = $this->user_id;

        if ($chat['status'] == 'send') {
            $save_data['status'] = 'discussed';
        }

        $this->active->saveChat($chat_id, $save_data);

        $this->system_messages->addMessage('success', l('success_updated_chat', 'chats'));
        /* Если есть и если не первая*/
        if (strripos($_SERVER['HTTP_REFERER'], 'outbox')) {
            redirect(site_url() . 'chats/index/outbox/');
        }
        redirect(site_url() . 'chats/index/inbox/');
    }

    public function complete($chat_id)
    {
        if (empty($chat_id) || (!in_array($this->active->getGid(), ['pg_videochat', 'oovoochat']))) {
            show_404();
        }

        $chat = $this->active->getChatById($chat_id);
        if (empty($chat)) {
            show_404();
        }

        $my_user_id = $this->session->userdata('user_id');

        if (!in_array($this->user_id, [$chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        if ($chat['status'] == 'current') {
            $save_data = $this->processDuration($chat, true);
        } else {
            $save_data = [];
        }

        $save_data['status'] = 'completed';

        $this->active->saveChat($chat_id, $save_data);

        $this->system_messages->addMessage('success', l('success_updated_chat', 'chats'));

        $this->view->setRedirect(site_url() . 'chats');
    }

    public function goToChat($chat_id = 0, $is_oovoo_session = 0)
    {
        $chat_gid = $this->active->getGid();

        if (empty($chat_id) || (!in_array($chat_gid, ['pg_videochat', 'oovoochat']))) {
            redirect(site_url() . 'chats');
        }

        $settings = $this->active->getSettings();
        if ($settings['chat_type'] == 'now') {
            $chat = $this->active->getChatByKey($chat_id);
        } else {
            $chat = $this->active->getChatById($chat_id);
        }

        if (empty($chat) || !in_array($this->user_id, [$chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        if (!in_array($chat['status'], ['approve', 'current', 'paused'])) {
            redirect(site_url() . 'chats');
        }

        $count_sessions = $this->active->getLastChatsCount([
            'where'     => ['id !=' => $chat_id],
            'where_sql' => [
                " (invite_user_id='" . $this->user_id . "' OR invited_user_id='" . $this->user_id . "')",
                " (status='current' OR status='paused')",
            ],
        ]);

        if ($count_sessions > 1) {
            $this->system_messages->addMessage('error', l('error_max_sessions', 'chats'));
            redirect(site_url() . 'chats');
        }

        if ($chat['invite_user_id'] == $this->user_id) {
            $save_data['inviter_is_online'] = 1;
        } else {
            $save_data['invited_is_online'] = 1;
        }

        $save_data['status'] = 'approve';

        $this->active->saveChat($chat_id, $save_data);

        $this->view->assign('settings_chat', $settings);
        $this->view->assign('settings_json_data', json_encode($settings));

        $this->view->assign('last_chat', $chat);
        $this->view->assign('chat_json_data', json_encode($chat));

        $this->view->assign('complete_lang', str_replace(
            '[link]',
            site_url() . 'chats',
            l('text_complete_lang', 'chats')
        ));

        if ($chat_gid == 'pg_videochat') {
            $this->view->render('show_chat');
        } elseif ($chat_gid == 'oovoochat') {
            $this->view->assign('participantId', $this->user_id);
            $this->view->assign('participantName', $this->session->userdata('output_name'));

            if ($is_oovoo_session) {
                $session_token = urlencode($chat['session_token'][$this->user_id]);
            } else {
                $session_token = '';
            }

            $this->view->assign('sessionToken', $session_token);

            $this->view->render('oovoochat');
        }
    }

    public function ajaxCheckStatus($chat_id)
    {
        $chat = $this->active->getChatById($chat_id);

        if (!in_array($this->user_id, [ $chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        $this->view->assign($chat);

        $this->view->render();
    }

    // TODO: по факту это проверка статуса и подсчет времени
    public function ajaxChangeStatus($chat_id)
    {
        $chat = $this->active->getChatById($chat_id);

        if (empty($chat)) {
            show_404();
        }

        if (!in_array($this->user_id, [ $chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        if ($chat['status'] == 'current') {
            $save_data = $this->processDuration($chat);
        } else {
            $save_data = [];
        }

        $is_inviter = $chat['invite_user_id'] == $this->user_id;
        $is_invited = $chat['invited_user_id'] == $this->user_id;

        if ($is_inviter) {
            $save_data['inviter_peer_id'] = $this->input->post("inviter_peer_id", true);
            $save_data['inviter_is_online'] = 1;

            if ($chat['inviter_peer_id'] && $chat['inviter_peer_id'] != $save_data['inviter_peer_id'] && $chat['status'] != 'completed') {
                $chat['inviter_peer_id'] = $save_data['inviter_peer_id'] = '';
                $chat['invited_peer_id'] = $save_data['invited_peer_id'] = '';
                $chat['status'] = $save_data['status'] = 'approve';
            } else {
                $chat['inviter_peer_id'] = $save_data['inviter_peer_id'];
            }
        }

        if ($is_invited) {
            $save_data['invited_peer_id'] = $this->input->post("invited_peer_id", true);
            $save_data['invited_is_online'] = 1;

            if ($chat['invited_peer_id'] && $chat['invited_peer_id'] != $save_data['invited_peer_id'] && $chat['status'] != 'completed') {
                $chat['inviter_peer_id'] = $save_data['inviter_peer_id'] = '';
                $chat['invited_peer_id'] = $save_data['invited_peer_id'] = '';
                $chat['status'] = $save_data['status'] = 'approve';
            } else {
                $chat['invited_peer_id'] = $save_data['invited_peer_id'];
            }
        }

        $this->active->saveChat($chat_id, $save_data);

        $chat = array_merge($chat, $save_data);

        $this->view->assign('chat', $chat);

        $this->view->render();
    }

    public function sendCommand($chat_id)
    {
        $chat = $this->active->getChatById($chat_id);

        if (empty($chat)) {
            show_404();
        }

        if (!in_array($this->user_id, [ $chat['invite_user_id'], $chat['invited_user_id']])) {
            show_404();
        }

        $command = $this->input->post('command', true);

        if ($chat['status'] == 'current') {
            $save_data = $this->processDuration($chat, $command == 'stop');
        } else {
            $save_data = [];
        }

        $is_inviter = $chat['invite_user_id'] == $this->user_id;
        $is_invited = $chat['invited_user_id'] == $this->user_id;

        switch ($command) {
            case 'start':
                if (!$is_inviter || !$chat['inviter_peer_id'] || !$chat['invited_peer_id']) {
                    break;
                }

                $save_data['status'] = 'current';
                $save_data['date_time_start'] = time();

                break;

            case 'pause':
                $save_data['status'] = 'paused';

                if ($is_inviter) {
                    $save_data['inviter_is_paused'] = 1;
                }

                if ($is_invited) {
                    $save_data['invited_is_paused'] = 1;
                }

                break;

            case 'resume':
                if ($is_inviter) {
                    $save_data['inviter_is_paused'] = 0;
                }

                if ($is_invited) {
                    $save_data['invited_is_paused'] = 0;
                }

                $save_data['status'] = 'current';

                break;

            case 'stop':
                $save_data['status'] = 'completed';

                break;

            case 'reconnect':
                $save_data['inviter_peer_id'] = '';
                $save_data['invited_peer_id'] = '';
                $save_data['status'] = 'approve';

                break;
        }

        $save_data['date_time_start'] = time();

        $this->active->saveChat($chat_id, $save_data);

        $chat = array_merge($chat, $save_data);

        $this->view->assign('chat', $chat);

        $this->view->render();
    }

    private function processDuration($chat, $disable_amount_warning = false)
    {
        $save_data = [];

        $tstamp = time();

        $duration = $tstamp - $chat['date_time_start'];

        $save_data['date_time_start'] = $tstamp;

        $save_data['duration'] = $chat['duration'] + $duration;

        $settings = $this->active->getSettings();

        if ($settings['fee_type'] == 'payed') {
            $amount = $chat['amount_per_second'] * $duration;

            if (
                $this->active->writeOffForChat(
                    $chat['invite_user_id'],
                    $amount,
                    str_replace(['[with_name]', '[date_chat]'], [$chat['invited']['output_name'], date('Y-m-d')], l('service_payment', 'chats'))
                ) !== true
            ) {
                $save_data['status'] = 'completed';
            }

            $save_data['amount'] = $chat['amount'] + $amount;

            if (!$disable_amount_warning && !empty($chat['available_time'])) {
                $available_time = $chat['available_time'] - $save_data['duration'];
                if ($available_time <= 30) {
                    $this->system_messages->addMessage(
                        View::MSG_ERROR,
                        str_replace(
                            '[available_time]',
                            $available_time,
                            l('pg_videochat_text_add_funds_current', 'chats')
                        )
                    );
                }
            }
        }

        return $save_data;
    }

    public function ajaxGetMessages($chat_id)
    {
        $this->view->assign('messages', $this->active->getMessages(
            $chat_id,
            (int)$this->input->post("message_max_id", true)
        ));

        $this->view->render();
    }

    public function ajaxSendMessage($chat_id)
    {
        $message_max_id = (int)$this->input->post('message_max_id', true);

        $add_message = [
            'id_chat' => $chat_id,
            'id_user' => $this->user_id,
            'message' => $this->input->post("message", true),
        ];
        $this->active->addMessage($add_message);

        $this->view->assign('messages', $this->active->getMessages($chat_id, $message_max_id));

        $this->view->render();
    }

    public function saveSession($chat_id)
    {
        $chat = $this->active->getChatById($chat_id);
        if (empty($chat)) {
            show_404();
        }

        $chat['session_token'][$this->user_id] = $this->input->get('t');

        $this->active->saveChat($chat_id, ['session_token' => serialize($chat['session_token'])]);

        redirect(site_url() . 'chats/go_to_chat/' . $chat_id . '/1');
    }
}
