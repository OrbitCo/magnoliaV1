<?php

declare(strict_types=1);

namespace Pg\modules\likes\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Likes user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class LikesUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return LikesUserInformationModel
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
        
        $this->ci->load->model('Likes_model');
        $this->ci->view->assign('user', $user);

        $your = $this->ci->Likes_model->getLikesByUser($user['id']);
        if (!empty($your)) {
            $this->ci->view->assign('your', $this->formatLikes($your));
            $result['pages']['likes/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'likes');
            $pages['likes/your.html'] = l('field_usr_inf_link_your', 'likes');
        }
   
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'likes');
        return $result;
    }
    
    private function formatLikes($data)
    {
        $result = [];
        $this->ci->load->model(['Comments_model', 'Media_model', 'Wall_events_model']);
        $users = [];
        foreach ($data as $v) {
            $arr = preg_split('/(?<=[a-z])(?=[0-9]+)/i', $v);
            switch ($arr[0]) {
                case 'cmnt':
                    $cmnt = $this->ci->Comments_model->getCommentById($arr[1]);
                    if (!empty($cmnt['comments'][0]['user']['output_name'])) {
                        $result[] = l('field_usr_inf_comments', 'likes') . ' ' . $cmnt['comments'][0]['user']['output_name'];
                    }
                    break;
                case 'media':
                    $media = $this->ci->Media_model->getMediaById($arr[1], false);
                    $type_data = explode('_', $media['upload_gid']);
                    $user = !empty($users[$media['id_user']]) ? $users[$media['id_user']] : $this->ci->Users_model->getUserById($media['id_user'], true);
                    $users[$media['id_user']] = $user;
                    $result[] = l('field_usr_inf_' . $type_data[1], 'likes') . ' ' . $user['output_name'];
                    break;
                case 'wevt':
                    $wevt = $this->ci->Wall_events_model->getEventById($arr[1]);
                    $user = !empty($users[$wevt['id_wall']]) ? $users[$wevt['id_wall']] : $this->ci->Users_model->getUserById($wevt['id_wall'], true);
                    $users[$wevt['id_wall']] = $user;
                    $result[] = l('field_usr_inf_wall_events', 'likes') . ' ' . $user['output_name'];
                    break;
            }
        }
        return $result;
    }
}
