<?php

declare(strict_types=1);

namespace Pg\modules\users_payments\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\AboutYouTrait;

/**
 * Users_payments user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UsersPaymentsUserInformationModel extends \Model implements IUserInformation
{
    use AboutYouTrait;
    
    /**
     *  Constructor
     *
     *  @return UsersPaymentsUserInformationModel
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
        
        $this->ci->load->model('Users_payments_model');
        $this->ci->view->assign('user', $user);
        
        $count_your = $this->ci->Users_payments_model->getAccountCountByUserId($user['id']);
        if ($count_your) {
            $your = $this->ci->Users_payments_model->getAccountListByUserId($user['id']);
            $this->ci->view->assign('your', $your);
            $result['pages']['users_payments/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'users_payments');
            $pages['users_payments/your.html'] = l('field_usr_inf_link_your', 'users_payments');
            $this->ci->view->assign('pages', $pages);
        }
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'users_payments');
        return $result;
    }
}
