<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Secret Gifts user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendVipUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return SendVipUserInformationModel
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
        
        $this->ci->load->model(['access_permissions/models/Access_permissions_groups_model', 'Send_vip_model']);
        $this->ci->view->assign('user', $user);
        
        $groups = $this->ci->Access_permissions_groups_model->getPaidGroups();
        $periods = $this->ci->Access_permissions_groups_model->getPeriodsList();
        $format_period = [];
        foreach ($periods as $period) {
            $format_period[$period['id']] = $period;
        }
        
        $your= $this->ci->Send_vip_model->getTransactionData(['where' => ['id_user' => $user['id']]], false);
        if (!empty($your)) {
            $ids = [];
            
            foreach ($your as $v) {
                $ids[] = $v['id_sender'];
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($your as &$v) {
                    $v['sender'] = $users_list[$v['id_sender']];
                    $m_obj = explode('_', $v['membership_obj']);
                    $v['group'] = $groups[$m_obj[0]]['current_name'];
                    $v['period'] = $format_period[$m_obj[1]]['period'] . ' ' . l("field_".$format_period[$m_obj[1]]['period_type'], 'access_permissions');
                    $v['price'] = $format_period[$m_obj[1]][$m_obj[0] . '_group'];
                }
                $this->ci->view->assign('your', $your);
                $result['pages']['send_vip/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'send_vip');
                $pages['send_vip/your.html'] = l('field_usr_inf_link_your', 'send_vip');
            }
        }
        
        $about_you = $this->ci->Send_vip_model->getTransactionData(['where' => ['id_sender' => $user['id']]], false);
        if (!empty($about_you)) {
            $ids = [];
            foreach ($about_you as $v) {
                $ids[] = $v['id_user'];
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($about_you as &$v) {
                    $v['sender'] = $users_list[$v['id_user']];
                    $m_obj = explode('_', $v['membership_obj']);
                    $v['group'] = $groups[$m_obj[0]]['current_name'];
                    $v['period'] = $format_period[$m_obj[1]]['period'] . ' ' . l("field_".$format_period[$m_obj[1]]['period_type'], 'access_permissions');
                    $v['price'] = $format_period[$m_obj[1]][$m_obj[0] . '_group'];
                }
                $this->ci->view->assign('about_you', $about_you);
                $result['pages']['send_vip/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'send_vip');
                $pages['send_vip/about_you.html'] = l('field_usr_inf_link_about_you', 'send_vip');
            }
        }

        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'send_vip');
        return $result;
    }
}
