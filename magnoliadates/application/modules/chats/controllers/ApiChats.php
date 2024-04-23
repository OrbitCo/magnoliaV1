<?php

declare(strict_types=1);

namespace Pg\modules\chats\controllers;

/**
 * Mobile version API controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiChats extends \Controller
{
    protected $active;

    protected $user_id;

    /**
     * Constructor
     *
     * @return Api_Mobile
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('chats/models/Chats_model');

        $this->active = $this->Chats_model->getActive();

        if (empty($this->active)) {
            show_404();
        }

        $this->user_id = $this->session->userdata('user_id');
    }

    /**
    * @api {post} /chats/setChat Set chat
    * @apiGroup Chats
    * @apiParam {int} user_id  user id
    * @apiParam {int} chat_key  chat key
    * @apiParam {int} inviter_peer_id inviter id
    * @apiParam {int} invited_peer_id invited id
    */
    public function setChat($chat_id = null)
    {
        if (is_null($chat_id)) {
            $data = [
                'invite_user_id'    => $this->session->userdata('user_id'),
                'invited_user_id'   => $this->input->post("user_id", true),
                'status'            => 'approve',
                'chat_key'          => $this->input->post("chat_key", true),
                'inviter_peer_id'   => $this->input->post("inviter_peer_id", true),
                'date_time'         => date('Y-m-d H:i:00'),
                'date_created'      => date('Y:m:d H:i:s'),
                'last_change_date_time_user_id' => $this->session->userdata('user_id'),
            ];
        } else {
            $data = [
                'invited_peer_id'   => $this->input->post("invited_peer_id", true),
                'is_notified'       => '1',
            ];
        }

        $id_chat = $this->active->saveChat($chat_id, $data);

        $this->view->assign('data', ['id_chat' => $id_chat]);

        $this->view->render();
    }

    /**
    * @api {post} /chats/setCompleted Set status Completed for chat
    * @apiGroup Chats
    * @apiParam {int} id_chat  chat id
    */
    public function setCompleted($id_chat = null)
    {
        $data = [
            'status' => 'completed',
        ];

        if (!is_null($id_chat)) {
            $id_chat = $this->active->saveChat($id_chat, $data);
        }

        $this->view->assign('data', ['id_chat' => $id_chat]);

        $this->view->render();
    }

    /**
    * @api {post} /chats/getChat Get chat
    * @apiGroup Chats
    * @apiParam {int} id_chat  chat id
    */
    public function getChat($id_chat = null)
    {
        $data = [
            'id' => $id_chat,
        ];

        $chat = $this->active->getLastChatsList(0, 1, null, ['where' => $data], []);

        $this->view->assign('data', ['chat' => $chat[0]]);

        $this->view->render();
    }

    /**
    * @api {post} /chats/getChatsList Get chats list
    * @apiGroup Chats
    */
    public function getChatsList()
    {
        $params = [
            'where_in' => ['status' => ['approve', 'current']],
            'where_sql' => ["(invite_user_id='" . $this->user_id . "' OR invited_user_id='" . $this->user_id . "')"],
        ];

        $chats = $this->active->get_last_chats_list(1, 30, null, $params);

        $this->view->assign('data', ['chats' => $chats]);

        $this->view->render();
    }

    /**
    * @api {post} /chats/getHistory Get chats history
    * @apiGroup Chats
    */
    public function getHistory()
    {
        $user_id = $this->session->userdata('user_id');

        $data['where_sql'] = ["(invited_user_id = '$user_id' OR invite_user_id = '$user_id')"];

        $data['where'] = [
            'status'            => 'completed',
        ];
        $order_by = [
            "id"    => 'DESC',
        ];

        $chats = $this->active->get_last_chats_list(null, null, $order_by, $data, []);

        $this->view->assign('data', ['chats' => $chats]);

        $this->view->render();
    }

    /**
    * @api {post} /chats/ajaxInviteForm Invite form
    * @apiGroup Chats
    * @apiParam {int} user_id  user id
    */
    public function ajaxInviteForm($user_id)
    {
        $this->load->model('Users_model');

        $contact_user = $this->Users_model->getUserById($user_id);
        /*if ($contact_user['online_status'] == 0) {
            $this->view->assign('error_online');
            $this->view->render();
            return;
        }*/

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
            $this->view->assign("chat_id", $this->active->saveChat(null, [
                'invite_user_id'                => $this->user_id,
                'invited_user_id'               => $user_id,
                'date_time'                     => date('Y-m-d H:i:00'),
                'date_created'                  => date('Y:m:d H:i:s'),
                'chat_key'                      => $chat_key,
                'status'                        => 'approve',
                'last_change_date_time_user_id' => $this->user_id,
            ]));

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

        $this->view->render();
    }

    /**
    * @api {post} /chats/ajaxCheckInvite  Check invite
    * @apiGroup Chats
    * @apiParam {int} user_id  user id
    * @apiParam {date} date  date
    * @apiParam {time} time  time
    */
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

    // TODO: по факту это проверка статуса и подсчет времени
    /**
    * @api {post} /chats/ajaxChangeStatus  Check status and process duration
    * @apiGroup Chats
    * @apiParam {int} chat_id  chat id
    * @apiParam {int} inviter_peer_id  inviter id
    * @apiParam {int} invited_peer_id  invited_id
    */
    public function ajaxChangeStatus($chat_id)
    {
        $chat = $this->active->getChatById($chat_id);

        if (empty($chat)) {
            show_404();
        }

        if (!in_array($this->user_id, [$chat['invite_user_id'], $chat['invited_user_id']])) {
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

    /**
    * @api {post} /chats/sendCommand  Send command for chat
    * @apiGroup Chats
    * @apiParam {int} chat_id  chat id
    * @apiParam {string} command  command of chat
    */
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
                !$this->active->writeOffForChat($chat['invite_user_id'], str_replace(
                    ['[with_name]', '[date_chat]'],
                    [$chat['invited']['output_name'], date('Y-m-d')],
                    l('service_payment', 'chats')
                ))
            ) {
                $save_data['status'] = 'completed';
            }

            $save_data['amount'] = $chat['amount'] = $amount;

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
}
