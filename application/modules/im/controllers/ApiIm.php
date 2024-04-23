<?php

declare(strict_types=1);

namespace Pg\modules\im\controllers;

use Pg\Libraries\View;

/**
 * IM API controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 * */
class ApiIm extends ClassIm
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = intval($this->session->userdata('user_id'));
        $this->load->model([
            'Im_model',
            'im/models/Im_messages_model',
            'im/models/Im_contact_list_model'
         ]);
    }

    private function getMessagesInternal($type = '')
    {
        $id_contact = intval($this->input->get_post('id_contact', true));
        $from_id = ($type == 'history') ? intval($this->input->get_post('min_id', true)) : intval($this->input->get_post('max_id', true));

        if ($type == 'history') {
            $result['msg'] = $this->Im_messages_model->get_history($this->user_id, $id_contact, $from_id);
        } else {
            if (!$from_id) {
                $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
                $result['msg'] = $this->Im_messages_model->getLastMessages($this->user_id, $id_contact, $count);
            } else {
                $result['msg'] = $this->Im_messages_model->getNewMessages($this->user_id, $id_contact, $from_id);
            }
        }
        $this->Im_messages_model->check_is_read($this->user_id, $id_contact);

        if ($this->pg_module->is_module_installed('chatbox')) {
            $this->load->model('chatbox/models/Chatbox_contact_list_model');
            $result_chatbox = $this->Chatbox_contact_list_model->checkIsRead($this->user_id, $id_contact);
        }

        $result['min_id'] = $result['max_id'] = 0;
        foreach ($result['msg'] as $msg) {
            if (intval($msg['id']) > $result['max_id']) {
                $result['max_id'] = intval($msg['id']);
            }
            if (intval($msg['id']) < $result['min_id'] || !$result['min_id']) {
                $result['min_id'] = intval($msg['id']);
            }
        }

        if (!$from_id || $type == 'history') {
            if (!$result['min_id']) {
                $result['history_exists'] = 0;
            } else {
                $result['history_exists'] = count($this->Im_messages_model->get_history($this->user_id, $id_contact, $result['min_id'], 1));
            }
        }

        $result['message_max_chars'] = $this->ci->pg_module->get_module_config('im', 'message_max_chars');

        return $result;
    }

    protected function getInit()
    {
        $data['new_msgs'] = ['count_new' => 0, 'contacts' => []];
        if ($this->session->userdata('auth_type') == 'user') {
            $data['id_user'] = $this->session->userdata('user_id');
            $this->load->model('users/models/Users_statuses_model');
            $data['user_status'] = $this->Users_statuses_model->get_user_statuses($data['id_user']);
            if ($data['user_status']['current_site_status']) {
                $this->load->model('im/models/Im_contact_list_model');
                $data['new_msgs'] = $this->Im_contact_list_model->check_new_messages($data['id_user']);
            }
            $data['user_name'] = $this->session->userdata('output_name');
        } else {
            $data['id_user'] = 0;
        }

        return $data;
    }

    /**
    * @api {post} /im/checkNewMessages Check new messages
    * @apiGroup IM
    */
    public function checkNewMessages()
    {
        $im_status = $this->Im_model->im_status($this->user_id);
        if ($im_status['im_on'] && $im_status['im_service_access']) {
            $result = $this->Im_contact_list_model->check_new_messages($this->user_id);
        }
        $result['im_status'] = $im_status;

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /im/getContactList Contact list
    * @apiGroup IM
    * @apiParam {boolean} [formatted] return formatted data
    * @apiParam {boolean} [with_messages] if need get last messages data
    */
    public function getContactList()
    {

        $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                // new \Pg\Libraries\Acl\Resource\Page(
                //     ['module' => 'im', 'controller' => 'im', 'action' => 'ajax_get_messages']
                // )), false);
            new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => 'chatbox', 'controller' => 'chatbox', 'action' => 'ajax_get_messages']
            )), false);

        if (!$is_allowed) {
            $this->set_api_content('info', ['access_denied' => str_replace('%access_permissions_page%',
                    site_url('access_permissions'),
                l('info_action_change_group', 'access_permissions'))]);
        } else {
            $with_messages = filter_input(INPUT_POST, 'with_messages', FILTER_VALIDATE_BOOLEAN);
            $im_status = $this->Im_model->im_status($this->user_id);

            if ($im_status['im_on'] && $im_status['im_service_access']) {
                $params['formatted'] = intval($this->input->get_post('formatted'));
                $result = $this->Im_contact_list_model->backendGetContactList($params);
            }

            $contacts_ids = [];
            if (!empty($result['list'])) {
                foreach ($result['list'] as $item) {
                    $contacts_ids[] = $item['id_contact'];
                }
            }

            if ($with_messages && !empty($contacts_ids)) {
                //$result['im_messages'] = $this->Im_messages_model->getLastMessages($this->user_id, $contacts_ids, 100);
                $result['im_messages'] = $this->Im_messages_model->getNewMessagesByContactList($this->user_id, $contacts_ids);

                //for chatbox messages
                if ($this->pg_module->is_module_installed('chatbox')) {
                    $this->load->model('chatbox/models/Chatbox_contact_list_model');
                    $result = $this->Chatbox_contact_list_model->getListIm($this->user_id, null, $result);

                    foreach ($result['list'] as $key => $value) {
                        if ($value['id_contact'] == $value['id_user'] && $value['id_user'] == $this->user_id) {
                            $theme_data =  $this->view->getThemeSettings();
                            $result['list'][$key]['contact_user']['thumbs']['middle'] = site_url() . $theme_data['mini_logo']['path'];
                            $result['list'][$key]['contact_user']['output_name'] = '♡  ' . l('site_notification', 'chatbox');
                            $result['list'][$key]['contact_user']['thumbs']['class'] = 'site_logo';
                        }
                    }
                }
            } else {
                $result['im_messages']  = [];
            }
            $result['im_status'] = $im_status;

            $this->set_api_content('data', $result);
        }
    }

    /**
    * @api {post} /im/setSiteStatus Set site status
    * @apiGroup IM
    * @apiParam {int} site_status site status
    */
    public function setSiteStatus()
    {
        $site_status = intval($this->input->get_post('site_status'));
        $this->load->model('users/models/Users_statuses_model');
        $result = $this->Users_statuses_model->set_status($this->user_id, $site_status);
        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /im/getMessages Get Messages
    * @apiGroup IM
    */
    public function getMessages()
    {
        $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => 'im', 'controller' => 'im', 'action' => 'ajax_get_messages']
                )), false);
        if (!$is_allowed) {
            $this->set_api_content('info', ['access_denied' => str_replace('%access_permissions_page%',
                    site_url('access_permissions'),
                l('info_action_change_group', 'access_permissions'))]);
        } else {
            $im_status = $this->Im_model->im_status($this->user_id);
            if ($im_status['im_on'] && $im_status['im_service_access']) {
                $result = $this->getMessagesInternal();
            }
            $result['im_status'] = $im_status;

            if (!$result['im_status']['im_on']) {
                $this->set_api_content('code', 503);
            }

            if ($this->pg_module->is_module_installed('chatbox')) {
                foreach ($result['msg'] as $key => $value) {
                    if ($value['id_contact'] == $value['id_user'] && $value['dir'] == 'o') {
                        unset($result['msg'][$key]);
                    }
                }
            }
            $this->set_api_content('data', $result);
        }
    }

    /**
    * @api {post} /im/postMessage Send Message
    * @apiGroup IM
    * @apiParam {int} id_contact contact id
    * @apiParam {string} text message text
    */
    public function postMessage()
    {
        $result = [];
        $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => 'im', 'controller' => 'im', 'action' => 'ajax_get_messages']
                )), false);
        if (!$is_allowed) {
            $this->set_api_content('info', ['access_denied' => str_replace('%access_permissions_page%',
                    site_url('access_permissions'),
                l('info_action_change_group', 'access_permissions'))]);
        } else {
            if ($this->pg_module->is_module_installed('chatbox')) {
                return $this->chatBoxPost();
            } else {
                $post_access = true;
                $im_status = $this->Im_model->im_status($this->user_id);
                if ($im_status['im_on'] && $im_status['im_service_access']) {
                    $text = $this->input->post('text', true);
                    $text = str_replace('\"', '"', $text);
                    $id_contact = intval($this->input->post('id_contact', true));
                    if ($this->pg_module->is_module_installed('blacklist')) {
                        $this->load->model('Blacklist_model');
                        // if you are in blacklist
                        if ($this->Blacklist_model->is_blocked($id_contact, $this->user_id)) {
                            $post_access = false;
                            $result['errors'][] = l('post_denied', 'im');
                            // if user in your blacklist
                        } elseif ($this->Blacklist_model->is_blocked($this->user_id, $id_contact)) {
                            $result['notices'][] = l('user_cant_answer', 'im');
                        }
                    }
                    if ($post_access) {
                        $result = array_merge_recursive($this->Im_messages_model->addMessage($this->user_id, $id_contact, $text), $result);
                        $result['messages'] = $this->getMessagesInternal();
                    }
                }
                $result['im_status'] = $im_status;
                $this->set_api_content('data', $result);
            }
        }
    }

    /**
    * @api {post} /im/getHistory Get messages history
    * @apiGroup IM
    */
    public function getHistory()
    {
        $im_status = $this->Im_model->im_status($this->user_id);
        if ($im_status['im_on'] && $im_status['im_service_access']) {
            $result = $this->getMessagesInternal('history');
        }
        $result['im_status'] = $im_status;

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /im/clearHistory Clear messages history
    * @apiGroup IM
    */
    public function clearHistory()
    {
        $id_contact = intval($this->input->get_post('id_contact', true));
        if (!empty($id_contact) && $id_contact != 0) {
            $result = $this->Im_messages_model->delete_messages($this->user_id, $id_contact);

            if ($this->pg_module->is_module_installed('chatbox')) {
                $this->load->model(['Chatbox_model', 'chatbox/models/ChatboxModel']);
                $this->Chatbox_model->clearHistory($this->user_id, $id_contact);
            }

        } else {
            $result['errors'] = 'error';
        }

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /im/getImStatus Get IM status
    * @apiGroup IM
    */
    public function getImStatus()
    {
        $this->set_api_content('data', $this->Im_model->imStatus($this->user_id));
    }

    public function chatBoxPost()
    {
        $return = ['errors' => '', 'success' => '', 'message_id' => 0, 'service_access' => 1];

        $im_status = $this->Im_model->im_status($this->user_id);
        if ($im_status['im_on'] && $im_status['im_service_access']) {
            $this->load->model(['Chatbox_model', 'chatbox/models/Chatbox_attaches_model']);

            $contact_id = intval($this->input->post('id_contact', true));
            if (empty($contact_id)) {
                $return['errors'][] = l('error_invalid_recipient', 'chatbox');
            } else {
                $post_data = [
                    'user_id' => $this->user_id,
                    'contact_id' => $contact_id,
                ];

                $validate_data = $this->Chatbox_attaches_model->validate(null, $post_data, 'attach');
                if (!empty($validate_data['errors'])) {
                    $return['errors'] = implode('<br>', $validate_data['errors']);
                } else {
                    $message_id = intval($this->input->post('id', true));
                    if (empty($message_id)) {
                        $message = $this->input->post('text', true);

                        $return_message = $this->Chatbox_model->addMessage($this->user_id, $contact_id, $message, true);
                        if (!empty($return_message['errors'])) {
                            $return['errors'] = $return_message['errors'];
                        } else {
                            $message_id = $return_message['o_msg_id'];
                        }
                    }
                    $return['message_id'] = $validate_data['data']['message_id'] = $message_id;

                    if ($this->input->post('is_attach', true)) {
                        $return_attach = $this->Chatbox_attaches_model->upload(null, $validate_data['data'], 'attach');
                        if (!empty($return_attach['errors'])) {
                            $return['errors'] = implode('<br/>', $return_attach['errors']);
                        } else {
                            $attaches_count = $this->Chatbox_attaches_model->getCount(['message_id' => $message_id]);
                            $this->Chatbox_model->save($message_id, ['attaches_count' => $attaches_count]);
                            $message_data = $this->Chatbox_model->getById($message_id);
                            $this->Chatbox_model->save($message_data['linked_id'], ['attaches_count' => $attaches_count]);
                        }
                    }

                    $return['messages'] = $this->getMessagesInternal();
                }
            }
        }
        $return['im_status'] = $im_status;
        $this->set_api_content('data', $return);
    }

    protected function getChatboxMessages($contact_id, $filters = [], $page = null, $limits = null, $order_by = ['date_added' => 'DESC'], $with_html = false)
    {
        $this->load->model('Chatbox_model');
        $messages = $this->Chatbox_model->getList($filters, $page, $limits, $order_by);
        if (!empty($messages)) {
            $messages = array_reverse($this->Chatbox_model->formatArray($messages));
            if ($with_html) {
                $user    = $this->Users_model->getUserById($this->user_id, true);
                $contact = $this->Users_model->getUserById($contact_id, true);
                foreach ($messages as $key => $message) {
                    $this->view->assign('messages', [0 => $message]);
                    $this->view->assign('user', $user);
                    $this->view->assign('contact', $contact);
                    $messages[$key]['html'] = $this->view->fetch('messages');
                }
            }

            if ($contact_id) {
                $this->Chatbox_model->checkIsRead($this->user_id, $contact_id);
            }

            return $messages;
        }

        return [];
    }
}
