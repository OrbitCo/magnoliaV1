<?php

declare(strict_types=1);

namespace Pg\modules\blacklist\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Blacklist user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BlacklistUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     *  Constructor
     *
     *  @return BlacklistUserInformationModel
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

        $this->ci->load->model('Blacklist_model');
        $this->ci->view->assign('user', $user);
        $your_count = $this->ci->Blacklist_model->getListCount($user['id']);
        if ($your_count) {
            $your = $this->ci->Blacklist_model->getList($user['id']);
            $this->ci->view->assign('your', $your);
            $result['pages']['blacklist/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'blacklist');
            $pages['blacklist/your.html'] = l('field_usr_inf_link_your', 'blacklist');
        }

        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'blacklist');
        return $result;
    }
}
