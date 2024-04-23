<?php

declare(strict_types=1);

namespace Pg\modules\users_connections\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Users connections user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UsersConnectionsUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return UsersConnectionsUserInformationModel
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
        
        $this->ci->load->model('Users_connections_model');
        $this->ci->view->assign('user', $user);
        
        $your= $this->ci->Users_connections_model->getDataByUserId($user['id']);
        if (!empty($your)) {
                $this->ci->view->assign('your', $your);
                $result['pages']['users_connections/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'users_connections');
                $pages['users_connections/your.html'] = l('field_usr_inf_link_your', 'users_connections');
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'users_connections');
        return $result;
    }
}
