<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\controllers;

/**
 * Chatbox module
 *
 * @package	PG_Dating
 *
 * @copyright	Copyright (c) 2000-2019 PG Dating Pro - php dating software
 * @author	Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * ApiChatbox user side controller
 *
 * @package	PG_Dating
 * @subpackage	chatbox
 * @category	controllers
 *
 * @copyright	Copyright (c) 2000-2019 PG Dating Pro - php dating software
 * @author	Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ApiChatbox extends \Controller
{
    protected $user_id = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Chatbox_model',
            'chatbox/models/Chatbox_contact_list_model'
        ]);
        if ($this->session->userdata('auth_type') == 'user') {
            $this->user_id = $this->session->userdata('user_id');
        }
    }

    public function getContactList()
    {
        $contact_list = $this->Chatbox_contact_list_model->getList(
            ['user_id' => $this->user_id, 'where' => ['contact_id !=' => $this->user_id]],
            1,
            $this->Chatbox_contact_list_model->items_per_page,
            ['date_update' => 'DESC']
        );

        $this->Chatbox_contact_list_model->setFormatSettings(['get_contact' => true]);
        $contact_list = $this->Chatbox_contact_list_model->formatArray($contact_list);
        $this->Chatbox_contact_list_model->setFormatSettings(['get_contact' => false]);

        foreach ($contact_list as $key => $value) {
            if (isset($value['contact']['is_deleted'])) {
                if ($value['contact']['is_deleted']) {
                    unset($contact_list[$key]);
                }
            }
        }

        $data['list'] = array_values($contact_list);

        $this->view->assign('data', $data);

        $this->view->render();
    }

    public function getMessages()
    {
        $contact_id = (int)$this->input->get_post('id_contact', true);
        $from_id = (int)$this->input->get_post('max_id', true);
        $count = (int)$this->input->get_post('count', true);

        if (empty($contact_id)) {
            show_404();
        }

        $message_filters = [
            'user_id'        => $this->user_id,
            'contact_id'     => $contact_id,
            'id >' => $from_id,
        ];

        $return['msg'] = $this->getMessagesInternal(
            $contact_id,
            $message_filters,
            1,
            $count ?: $this->Chatbox_model->messages_per_page,
            ['id' => 'DESC']
        );
        $return['count']    = count($return['msg']);

        foreach ($return['msg'] as &$msg) {
            $msg['message'] = str_replace('<br />', "\n", $msg['message']);
        }

        $this->view->assign('data', $return);

        $this->view->render();
    }

    public function postMessage()
    {
        $result = [];

        $post_access = true;
        $message     = $this->input->post('text', true);
        $contact_id  = $this->input->post('id_contact', true);
        $from_id = $this->input->post('max_id', true);

        if ($this->pg_module->is_module_installed('blacklist')) {
            $this->load->model('Blacklist_model');
            // if you are in blacklist
            if ($this->Blacklist_model->is_blocked($contact_id, $this->user_id)) {
                $post_access        = false;
                $this->system_messages->addMessage('error', l('post_denied', 'chatbox'));
            // if user in your blacklist
            } elseif ($this->Blacklist_model->is_blocked($this->user_id, $contact_id)) {
                $result['notices'][] = l('user_cant_answer', 'chatbox');
            }
        }

        if ($post_access) {
            $result = array_merge_recursive($this->Chatbox_model->addMessage($this->user_id, $contact_id, $message, true), $result);

            $message_filters = [
                'user_id'        => $this->user_id,
                'contact_id'     => $contact_id,
                'id >' => $from_id,
            ];
            $result['messages'] = $this->getMessagesInternal($contact_id, $message_filters, null, null, ['date_added' => 'DESC']);

            $this->view->assign('data', $result);
        }

        $this->view->render();
    }

    public function uploadImage()
    {
        $result = [];

        $post_access = true;
        $message     = $this->input->post('text', true);
        $contact_id  = $this->input->post('id_contact', true);
        $from_id = $this->input->post('max_id', true);

        if ($this->pg_module->is_module_installed('blacklist')) {
            $this->load->model('Blacklist_model');
            // if you are in blacklist
            if ($this->Blacklist_model->is_blocked($contact_id, $this->user_id)) {
                $post_access        = false;
                $this->system_messages->addMessage('error', l('post_denied', 'chatbox'));
            // if user in your blacklist
            } elseif ($this->Blacklist_model->is_blocked($this->user_id, $contact_id)) {
                $result['notices'][] = l('user_cant_answer', 'chatbox');
            }
        }

        $this->load->model('chatbox/models/Chatbox_attaches_model');
        $post_data = [
            'user_id'    => $this->user_id,
            'contact_id' => $contact_id,
        ];
        $validate_data = $this->Chatbox_attaches_model->validate(null, $post_data, 'attach');
        if (!empty($validate_data['errors'])) {
            $this->system_messages->addMessage('error', $validate_data['errors']);
            $post_access = false;
        } elseif (!$validate_data['data']['mime']) {
            $this->system_messages->addMessage('error', 'Error');
        }

        if ($post_access) {
            $return_message = $this->Chatbox_model->addMessage($this->user_id, $contact_id, $message);
            if (!empty($return_message['errors'])) {
                $this->system_messages->addMessage('error', $return_message['errors']);
            } else {
                $message_id = $return_message['o_msg_id'];
                $validate_data['data']['message_id'] = $message_id;

                $return_attach = $this->Chatbox_attaches_model->upload(null, $validate_data['data'], 'attach');

                if (!empty($return_attach['errors'])) {
                    $this->system_messages->addMessage('error', $return_attach['errors']);
                } else {
                    $attaches_count = $this->Chatbox_attaches_model->getCount(['message_id' => $message_id]);
                    $this->Chatbox_model->save($message_id, ['attaches_count' => $attaches_count]);
                    $message_data = $this->Chatbox_model->getById($message_id);
                    $this->Chatbox_model->save($message_data['linked_id'], ['attaches_count' => $attaches_count]);
                }

                $message_filters = [
                    'user_id'        => $this->user_id,
                    'contact_id'     => $contact_id,
                    'id >' => $from_id,
                ];
                $result['messages'] = $this->getMessagesInternal($contact_id, $message_filters, null, null, ['date_added' => 'DESC']);

                $this->view->assign('data', $result);
            }
        }

        $this->view->render();
    }

    protected function getMessagesInternal($contact_id, $filters = [], $page = null, $limits = null, $order_by = ['date_added' => 'DESC'])
    {
        $messages = $this->Chatbox_model->getList($filters, $page, $limits, $order_by);
        if (!empty($messages)) {
            $messages = array_reverse($this->Chatbox_model->formatArray($messages));

            if ($contact_id) {
                $this->Chatbox_model->checkIsRead($this->user_id, $contact_id);
            }

            return $messages;
        }

        return [];
    }
}
