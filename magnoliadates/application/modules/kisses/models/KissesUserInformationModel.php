<?php

declare(strict_types=1);

namespace Pg\modules\kisses\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Kisses user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class KissesUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return KissesUserInformationModel
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
        
        $this->ci->load->model('Kisses_model');
        $this->ci->view->assign('user', $user);
        
        $your_count = $this->ci->Kisses_model->getCountKissesUsers(['where' => ['user_to' => $user['id']]]);
        if ($your_count) {
            $your = $this->ci->Kisses_model->getListUserKisses(['where' => ['user_to' => $user['id']]]);
            $ids = [];
            foreach ($your as $item) {
                $ids[] = $item['user_from'];
            }
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, null, $ids);
            foreach ($your as &$item) {
                $item['user'] = $users[$item['user_from']];
            }
            $this->ci->view->assign('your', $your);
            $result['pages']['kisses/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'kisses');
            $pages['kisses/your.html'] = l('field_usr_inf_link_your', 'kisses');
        }
        
        $about_you_count = $this->ci->Kisses_model->getCountKissesUsers(['where' => ['user_from' => $user['id']]]);
        if ($about_you_count) {
            $about_you = $this->ci->Kisses_model->getListUserKisses(['where' => ['user_from' => $user['id']]]);
            $ids = [];
            foreach ($about_you as $item) {
                $ids[] = $item['user_to'];
            }
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, null, $ids);
            foreach ($about_you as &$item) {
                $item['user'] = $users[$item['user_to']];
            }
            $this->ci->view->assign('about_you', $about_you);
            $result['pages']['kisses/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'kisses');
            $pages['kisses/about_you.html'] = l('field_usr_inf_link_about_you', 'kisses');
        }
        
        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'kisses');
        return $result;
    }
}
