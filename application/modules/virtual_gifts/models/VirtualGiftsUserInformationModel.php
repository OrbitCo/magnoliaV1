<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Virtual Gifts user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  DATING PRO LTD <http://www.pilotgroup.net/>
 */
class VirtualGiftsUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     *  Constructor
     *
     *  @return VirtualGiftsUserInformationModel
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

        $this->ci->load->model('Virtual_gifts_model');
        $this->ci->view->assign('user', $user);

        $your = $this->ci->Virtual_gifts_model->getGifts(null, null, null, ['where' => ['fk_sender_id' => $user['id']]]);
        if (!empty($your)) {
            $ids = [];
            foreach ($your as $v) {
                $ids[] = $v['fk_user_id'];
            }
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($your as &$v) {
                    $v['user'] = $users_list[$v['fk_user_id']];
                }
                $this->ci->view->assign('your', $your);
                $result['pages']['virtual_gifts/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'virtual_gifts');
                $pages['virtual_gifts/your.html'] = l('field_usr_inf_link_your', 'virtual_gifts');
            }
        }

        $about_you = $this->ci->Virtual_gifts_model->getGifts(null, null, null, ['where' => ['fk_user_id' => $user['id']]]);
        if (!empty($about_you)) {
            $ids = [];
            foreach ($about_you as $v) {
                $ids[] = $v['fk_sender_id'];
            }
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($about_you as &$v) {
                    $v['user'] = $users_list[$v['fk_sender_id']];
                }
                $this->ci->view->assign('about_you', $about_you);
                $result['pages']['virtual_gifts/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'virtual_gifts');
                $pages['virtual_gifts/about_you.html'] = l('field_usr_inf_link_about_you', 'virtual_gifts');
            }
        }

        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'virtual_gifts');
        return $result;
    }
}
