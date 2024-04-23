<?php

declare(strict_types=1);

namespace Pg\modules\send_money\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Secret Gifts user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendMoneyUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return SendMoneyUserInformationModel
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
        
        $this->ci->load->model('Send_money_model');
        $this->ci->view->assign('user', $user);
        
        $your= $this->ci->Send_money_model->getTransactionData(['where' => ['id_user' => $user['id']]], false);
        if (!empty($your)) {
            $ids = [];
            foreach ($your as $v) {
                $ids[] = $v['id_sender'];
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($your as &$v) {
                    $v['user'] = $users_list[$v['id_sender']];
                }
                $this->ci->view->assign('your', $your);
                $result['pages']['send_money/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'send_money');
                $pages['send_money/your.html'] = l('field_usr_inf_link_your', 'send_money');
            }
        }
        
        $about_you = $this->ci->Send_money_model->getTransactionData(['where' => ['id_sender' => $user['id']]], false);
        if (!empty($about_you)) {
            $ids = [];
            foreach ($about_you as $v) {
                $ids[] = $v['id_user'];
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($about_you as &$v) {
                    $v['sender'] = $users_list[$v['id_user']];
                }
                $this->ci->view->assign('about_you', $about_you);
                $result['pages']['send_money/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'send_money');
                $pages['send_money/about_you.html'] = l('field_usr_inf_link_about_you', 'send_money');
            }
        }

        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'send_money');
        return $result;
    }
}
