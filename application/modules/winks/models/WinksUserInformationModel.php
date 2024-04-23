<?php

declare(strict_types=1);

namespace Pg\modules\winks\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Winks user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class WinksUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return WinksUserInformationModel
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
        
        $this->ci->load->model('Winks_model');
        $this->ci->view->assign('user', $user);
        
        $your_count = $this->ci->Winks_model->getCount(['where' => ['id_from' => $user['id']]]);
        if ($your_count) {
            $your = $this->ci->Winks_model->get(['where' => ['id_from' => $user['id']]]);
            $this->ci->view->assign('your', $this->ci->Winks_model->format($your));
            $result['pages']['winks/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'winks');
            $pages['winks/your.html'] = l('field_usr_inf_link_your', 'winks');
        }
        
        $about_you_count = $this->ci->Winks_model->getCount(['where' => ['id_to' => $user['id']]]);
        if ($about_you_count) {
            $about_you = $this->ci->Winks_model->get(['where' => ['id_to' => $user['id']]]);
            $this->ci->view->assign('about_you', $this->ci->Winks_model->format($about_you));
            $result['pages']['winks/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'winks');
            $pages['winks/about_you.html'] = l('field_usr_inf_link_about_you', 'winks');
        }
        
        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'winks');
        return $result;
    }
}
