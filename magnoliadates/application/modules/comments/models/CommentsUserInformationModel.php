<?php

declare(strict_types=1);

namespace Pg\modules\comments\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Comments user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CommentsUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     *  Constructor
     *
     *  @return CommentsUserInformationModel
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

        $this->ci->load->model('Comments_model');
        $this->ci->view->assign('user', $user);
        $your_count = $this->ci->Comments_model->getCommentsCount(['where' => ['id_user' => $user['id']]]);
        if ($your_count) {
            $your = $this->ci->Comments_model->getComments(null, null, ['id' => 'DESC'], ['where' => ['id_user' => $user['id']]]);
            $this->ci->view->assign('your', $your);
            $result['pages']['comments/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'comments');
            $pages['comments/your.html'] = l('field_usr_inf_link_your', 'comments');
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'comments');
        return $result;
    }
}
