<?php

declare(strict_types=1);

namespace Pg\modules\im\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Im user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ImUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return ImUserInformationModel
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
            'im/models/Im_model',
            'im/models/Im_contact_list_model',
            'im/models/Im_messages_model'
        ]);
        $this->ci->view->assign('user', $user);
        
        $contacts = $this->ci->Im_contact_list_model->getContactList($user['id'], null, null);
        if (!empty($contacts)) {
            $contact_users = [];
            $ids = [];
            foreach ($contacts as &$contact) {
                $ids[] = $contact['id_contact'];
                $contact_users[$contact['id_contact']]['contact'] = $contact['contact_user'];
                $contact['file_path'] = $this->setFileName($contact['contact_user']) . '/msgs.html';
            }
            $this->ci->view->assign('contacts', $contacts);
            $result['pages']['im/index.html'] = $this->ci->view->fetch('user_information/contacts', 'user', 'im');
            $pages['im/index.html'] = l('field_usr_inf_link_your', 'im');
            $msgs = $this->ci->Im_messages_model->getUserMsgs(['where' => ['id_user' => $user['id']], 'where_in' => ['id_contact' => $ids]]);
            
            foreach ($msgs as $msg) {
                $contact_users[$msg['id_contact']]['msg'][] = $msg;
            }
            foreach ($contact_users as $user_data) {
                 $this->ci->view->assign('msgs', $user_data);
                 $result['pages']['im/' . $this->setFileName($user_data['contact']) . '/msgs.html'] = $this->ci->view->fetch('user_information/msgs', 'user', 'im');
            }
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'im');
        return $result;
    }
    
    private function setFileName($contact)
    {
        return $contact['id'] . '-' . $this->ci->pg_language->createGUID($contact['output_name'])['gid'];
    }
}
