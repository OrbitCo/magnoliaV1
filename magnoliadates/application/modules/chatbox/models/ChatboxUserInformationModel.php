<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * chatbox user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ChatboxUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     * ChatboxUserInformationModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return user information
     *
     * @param array $user
     *
     * @return array
     */
    public function getUserInformation($user)
    {
        $pages = [];
        $result = [];

        $this->ci->load->model([
            'chatbox/models/Chatbox_contact_list_model',
            'chatbox/models/Chatbox_model'
        ]);

        $this->ci->view->assign('user', $user);

        $contact_list = $this->ci->Chatbox_contact_list_model->getList(['user_id' => $user['id']]);
        $contacts = $this->ci->Chatbox_contact_list_model->formatArray($contact_list);

        if (!empty($contacts)) {
            $contact_users = [];
            $ids = [];
            foreach ($contacts as &$contact) {
                $ids[] = $contact['contact_id'];
                $contact_users[$contact['contact_id']]['contact'] = $contact['contact'];

                if ($contact['contact']['id'] == $user['id']) {
                    $contact['file_path'] = 'site-notification/msgs.html';
                } else {
                    $contact['file_path'] = $contact['contact']['id'] . '-' . $this->ci->pg_language->createGUID($contact['contact']['output_name'])['gid'] . '/msgs.html';
                }
            }
            $filters = [
                    'user_id'    => $user['id'],
                    'contact_id' => $ids
            ];
            $this->ci->view->assign('contacts', $contacts);

            $result['pages']['chatbox/index.html'] = $this->ci->view->fetch('user_information/contacts', 'user', 'chatbox');
            $pages['chatbox/index.html'] = l('field_usr_inf_link_your', 'chatbox');

            $msgs = $this->Chatbox_model->getList($filters, '', '', ['date_added' => 'ASC']);
            $msgs = $this->Chatbox_model->formatArray($msgs);

            foreach ($msgs as $msg) {
                $msg['message'] = json_decode(str_replace('\\\\u', '\\u', json_encode($msg['message'])));
                $contact_users[$msg['contact_id']]['msg'][] = $msg;
            }
            foreach ($contact_users as $user_data) {
                $this->ci->view->assign('msgs', $user_data);
                $subfolder =  $user_data['contact']['id'] . '-' . $this->ci->pg_language->createGUID($user_data['contact']['output_name'])['gid'];

                if ($user_data['contact']['id'] == $user['id']) {
                    $subfolder =  'site-notification';
                }

                $result['pages']['chatbox/' . $subfolder . '/msgs.html'] = $this->ci->view->fetch('user_information/msgs', 'user', 'chatbox');
            }
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'chatbox');
        return $result;
    }
}
