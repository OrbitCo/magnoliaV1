<?php

declare(strict_types=1);

namespace Pg\modules\banners\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\AboutYouTrait;

/**
 * Banners user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BannersUserInformationModel extends \Model implements IUserInformation
{
    use AboutYouTrait;

    /**
     *  Constructor
     *
     *  @return BannersUserInformationModel
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

        $this->ci->load->model('Banners_model');
        $this->ci->view->assign('user', $user);
        $your_count = $this->ci->Banners_model->cntBanners(['where' => ['user_id' => $user['id']]]);
        if ($your_count) {
            $your = $this->ci->Banners_model->getBanners(null, null, ['id' => 'DESC'], ['where' => ['user_id' => $user['id']]]);
            $this->ci->view->assign('your', $your);
            foreach ($your as $v) {
                $result['files']['banners/images/' . $v['banner_image']] = $v['media']['banner_image']['file_path'];
            }
            $result['pages']['banners/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'banners');
            $pages['banners/your.html'] = l('field_usr_inf_link_your', 'banners');
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'banners');
        return $result;
    }
}
