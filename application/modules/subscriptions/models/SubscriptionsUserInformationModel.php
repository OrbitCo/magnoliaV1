<?php

declare(strict_types=1);

namespace Pg\modules\subscriptions\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Subscriptions user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SubscriptionsUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return SubscriptionsUserInformationModel
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
        
        $this->ci->load->model(['Subscriptions_model', 'subscriptions/models/Subscriptions_users_model']);
        $this->ci->view->assign('user', $user);
        
        $subscriptions_ids= $this->ci->Subscriptions_users_model->getSubscriptionsByIdUser($user['id']);
        if (!empty($subscriptions_ids)) {
            $subscriptions = $this->ci->Subscriptions_model->getSubscriptionsList(null, null, null, null, array_keys($subscriptions_ids));
            $this->ci->view->assign('your', $subscriptions);
            $result['pages']['subscriptions/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'subscriptions');
            $pages['subscriptions/your.html'] = l('field_usr_inf_link_your', 'subscriptions');
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'subscriptions');
        return $result;
    }
}
