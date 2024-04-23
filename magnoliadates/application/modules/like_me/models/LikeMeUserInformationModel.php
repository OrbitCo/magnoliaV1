<?php

declare(strict_types=1);

namespace Pg\modules\like_me\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Like me user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class LikeMeUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return LikeMeUserInformationModel
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
        
        $this->ci->load->model('Like_me_model');
        $this->ci->view->assign('user', $user);
        
        
        $ids = $this->ci->Like_me_model->getLikedProfileIds($user['id']);
        if (!empty($ids)) {
            $your = $this->ci->Users_model->getUsersList(null, null, null, null, $ids);
            $this->ci->view->assign('your', $your);
            $result['pages']['like_me/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'like_me');
            $pages['like_me/your.html'] = l('field_usr_inf_link_your', 'like_me');
        }
        
        $your_match_count = $this->ci->Like_me_model->getCountMatchesList($user['id']);
        if ($your_match_count) {
            $your_match = $this->ci->Like_me_model->getMatchesList(null, null, $user['id']);
            $this->ci->view->assign('your_match', $your_match);
            $result['pages']['like_me/your_match.html'] = $this->ci->view->fetch('user_information/your_match', 'user', 'like_me');
            $pages['like_me/your_match.html'] = l('field_usr_inf_link_your_match', 'like_me');
        }
        
        
        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'like_me');
        return $result;
    }
}
