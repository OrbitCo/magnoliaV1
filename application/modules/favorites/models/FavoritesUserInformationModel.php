<?php

declare(strict_types=1);

namespace Pg\modules\favorites\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Favorites user information model
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class FavoritesUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     * Return user information
     *
     * @param array $user
     *
     * @return array|mixed
     */
    public function getUserInformation($user)
    {
        $pages = [];
        $result = [];

        $this->ci->load->model('Favorites_model');
        $this->ci->view->assign('user', $user);

        $your_count = $this->ci->Favorites_model->getListCount($user['id'], null, 0);
        if ($your_count) {
            $your = $this->ci->Favorites_model->getList($user['id'], null, null, null, null, true, 0);
            $this->ci->view->assign('your', $your);
            $result['pages']['favorites/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'favorites');
            $pages['favorites/your.html'] = l('field_usr_inf_link_your', 'favorites');
        }

        $about_you_count = $this->ci->Favorites_model->getListCount($user['id'], null, 1);
        if ($about_you_count) {
            $about_you = $this->ci->Favorites_model->getList($user['id'], null, null, null, null, true, 1);
            $this->ci->view->assign('about_you', $about_you);
            $result['pages']['favorites/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'favorites');
            $pages['favorites/about_you.html'] = l('field_usr_inf_link_about_you', 'favorites');
        }

        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'favorites');

        return $result;
    }
}
