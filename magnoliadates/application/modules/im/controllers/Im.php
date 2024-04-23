<?php

declare(strict_types=1);

namespace Pg\modules\im\controllers;

/**
 * IM controller
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
class Im extends \Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = intval($this->session->userdata('user_id'));
        $this->load->model([
            'im/models/Im_model',
            'im/models/Im_contact_list_model',
            'im/models/Im_messages_model'
        ]);
    }

    protected function checkNewMessages()
    {
        $im_status = $this->Im_model->im_status($this->user_id);
        if ($im_status['im_on']) {
            $result = $this->Im_contact_list_model->checkNewMessages($this->user_id);
        }
        $result['im_status'] = $im_status;

        return $result;
    }

    protected function getContactList($with_messages = false)
    {
        $im_status = $this->Im_model->imStatus($this->user_id);
        if ($im_status['im_on']) {
            $params['formatted'] = intval($this->input->get_post('formatted'));
            $result = $this->Im_contact_list_model->backendGetContactList($params);
        }
        if ($with_messages) {
            $result['im_messages'] = $this->Im_messages_model->getLastMessages($this->user_id);
        }
        $result['im_status'] = $im_status;
        return $result;
    }

    protected function setSiteStatus()
    {
        $site_status = intval($this->input->get_post('site_status'));
        $this->load->model('users/models/Users_statuses_model');
        $result = $this->Users_statuses_model->setStatus($this->user_id, $site_status);

        return $result;
    }

    protected function getImStatus()
    {
        return $this->Im_model->imStatus($this->user_id);
    }

    private function getMessagesInternal($type = '')
    {
        $id_contact = intval($this->input->get_post('id_contact', true));
        $from_id = ($type == 'history') ? intval($this->input->get_post('min_id', true)) : intval($this->input->get_post('max_id', true));
        if ($type == 'history') {
            $result['msg'] = $this->Im_messages_model->getHistory($this->user_id, $id_contact, $from_id);
        } else {
            if (!$from_id) {
                $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
                $result['msg'] = $this->Im_messages_model->getLastMessages($this->user_id, $id_contact, $count);
            } else {
                $result['msg'] = $this->Im_messages_model->getNewMessages($this->user_id, $id_contact, $from_id);
            }
        }
        $this->Im_messages_model->checkIsRead($this->user_id, $id_contact);

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
                $result['history_exists'] = count($this->Im_messages_model->getHistory($this->user_id, $id_contact, $result['min_id'], 1));
            }
        }

        return $result;
    }

    protected function getMessages()
    {
        $im_status = $this->Im_model->imStatus($this->user_id);
        if ($im_status['im_on']) {
            $result = $this->getMessagesInternal();
        }
        $result['im_status'] = $im_status;

        return $result;
    }

    protected function postMessage()
    {
        $result = [];
        $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => 'im', 'controller' => 'im', 'action' => 'ajax_get_messages']
                )), false);
        if (!$is_allowed) {
            $result['info']['access_denied'] = str_replace('%access_permissions_page%',
                site_url('access_permissions'),
                l('info_action_change_group', 'access_permissions'));
        } else {
            $post_access = true;
            $im_status = $this->Im_model->imStatus($this->user_id);
            if ($im_status['im_on']) {
                $text = $this->input->post('text', true);
                $id_contact = intval($this->input->post('id_contact', true));
                if ($this->pg_module->is_module_installed('blacklist')) {
                    $this->load->model('Blacklist_model');
                    // if you are in blacklist
                    if ($this->Blacklist_model->isBlocked($id_contact, $this->user_id)) {
                        $post_access = false;
                        $result['errors'][] = l('post_denied', 'im');
                        // if user in your blacklist
                    } elseif ($this->Blacklist_model->isBlocked($this->user_id, $id_contact)) {
                        $result['notices'][] = l('user_cant_answer', 'im');
                    }
                }
                if ($post_access) {
                    $result = array_merge_recursive($this->Im_messages_model->addMessage($this->user_id, $id_contact, $text), $result);
                    $result['messages'] = $this->getMessagesInternal();
                }
            }
            $result['im_status'] = $im_status;
        }

        return $result;
    }

    protected function getHistory()
    {
        $im_status = $this->Im_model->imStatus($this->user_id);
        if ($im_status['im_on']) {
            $result = $this->getMessagesInternal('history');
        }
        $result['im_status'] = $im_status;

        return $result;
    }

    protected function clearHistory()
    {
        $id_contact = intval($this->input->get_post('id_contact', true));
        if (!empty($id_contact) && $id_contact != 0) {
            $result = $this->Im_messages_model->deleteMessages($this->user_id, $id_contact);
        } else {
            $result['errors'] = 'error';
        }

        return $result;
    }

    protected function getInit()
    {
        $data['new_msgs'] = ['count_new' => 0, 'contacts' => []];
        if ($this->session->userdata('auth_type') == 'user') {
            $data['id_user'] = $this->session->userdata('user_id');
            $this->load->model('users/models/Users_statuses_model');
            $data['user_status'] = $this->Users_statuses_model->getUserStatuses($data['id_user']);
            if ($data['user_status']['current_site_status']) {
                $this->load->model('im/models/Im_contact_list_model');
                $data['new_msgs'] = $this->Im_contact_list_model->checkNewMessages($data['id_user']);
            }
            $data['user_name'] = $this->session->userdata('output_name');
        } else {
            $data['id_user'] = 0;
        }

        return $data;
    }

    public function ajaxCheckNewMessages()
    {
        $this->view->assign($this->checkNewMessages());
    }

    public function ajaxGetContactList()
    {
        $this->view->assign($this->getContactList());
    }

    public function ajaxSetSiteStatus()
    {
        $this->view->assign($this->setSiteStatus());
    }

    public function ajaxGetMessages()
    {
        $this->view->assign($this->getMessages());
    }

    public function ajaxPostMessage()
    {
        $this->view->assign($this->postMessage());
    }

    public function ajaxGetHistory()
    {
        $this->view->assign($this->getHistory());
    }

    public function ajaxClearHistory()
    {
        $this->view->assign($this->clearHistory());
    }

    public function ajaxGetImStatus()
    {
        $this->view->assign($this->getImStatus());
    }

    public function ajaxGetInit()
    {
        $this->view->assign($this->getInit());
    }

    public function ajaxAvailableIm()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        $id_user = $this->session->userdata('user_id');
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Im_model->serviceAvailableImAction($id_user);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($id_user, 'im_template');
            }
            $return['gid'] = 'im';
        }
        $this->view->assign($return);
    }

    public function ajaxActivateIm($id_user_service)
    {
        $id_user = $this->session->userdata('user_id');
        $return = $this->Im_model->serviceActivateIm($id_user, $id_user_service);
        $this->view->assign($return);
    }
}
