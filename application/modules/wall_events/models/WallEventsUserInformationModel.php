<?php

declare(strict_types=1);

namespace Pg\modules\wall_events\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Wall Events user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class WallEventsUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return WallEventsUserInformationModel
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
        
        $this->ci->load->model('Wall_events_model');
        $this->ci->view->assign('user', $user);
        
        $your = $this->ci->Wall_events_model->getEvents(['where' => ['id_poster' => $user['id']]]);
        $format_your = $this->ci->Wall_events_model->formatWallEvents($your);
        if (!empty($format_your)) {
            $ids = [];
            foreach ($format_your as &$v) {
                $ids[] = $v['id_wall'];
                if (!empty($v['data'])) {
                    foreach ($v['data'] as $k => $d) {
                        $v['data'][$k]['text'] = $this->format($d['text']);
                    }
                }
                if (!empty($v['media'])) {
                    foreach ($v['media'] as $k => $d) {
                        if (!empty($d['video'])) {
                            foreach ($d['video'] as $i => $vd) {
                                $v['media'][$k]['video'][$i]['embed'] = $this->format($vd['embed']);
                            }
                        }
                    }
                }
                if (!empty($v['media'])) {
                    foreach ($v['media'] as $m) {
                        if (!empty($m['img'])) {
                            foreach ($m['img'] as $img) {
                                $result['files']['wall_events/image/grand-' . $img['file_name']] = $img['thumbs_data']['grand']['file_path'];
                            }
                        } elseif (!empty($m['video'])) {
                            foreach ($m['video'] as &$video) {
                                if ($video['file_name'] != 'embed') {
                                    $result['files']['wall_events/video/' . $video['file_name']] = $video['file_path'];
                                } else {
                                    $video['embed'] = $this->format($video['embed']);
                                }
                            }
                        }
                    }
                }
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids);
                foreach ($format_your as &$v) {
                    $v['user'] = $users_list[$v['id_wall']];
                }
                $this->ci->view->assign('your', $format_your);
                $result['pages']['wall_events/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'wall_events');
                $pages['wall_events/your.html'] = l('field_usr_inf_link_your', 'wall_events');
            }
        }
        
        $about_you = $this->ci->Wall_events_model->getEvents(['where' => ['id_wall' => $user['id'], 'id_poster !=' => $user['id']]]);
        $format_about_you = $this->ci->Wall_events_model->formatWallEvents($about_you);
        if (!empty($format_about_you)) {
            $ids = [];
            foreach ($format_about_you as &$v) {
                $ids[] = $v['id_poster'];
                if (!empty($v['data'])) {
                    foreach ($v['data'] as $k => $d) {
                        $v['data'][$k]['text'] = $this->format($d['text']);
                    }
                }
                if (!empty($v['media'])) {
                    foreach ($v['media'] as $m) {
                        if (!empty($m['img'])) {
                            foreach ($m['img'] as $img) {
                                $result['files']['wall_events/image/grand-' . $img['file_name']] = $img['thumbs_data']['grand']['file_path'];
                            }
                        } elseif (!empty($m['video'])) {
                            foreach ($m['video'] as &$video) {
                                if ($video['file_name'] != 'embed') {
                                    $result['files']['wall_events/video/' . $video['file_name']] = $video['file_path'];
                                } else {
                                    $video['embed'] = $this->format($video['embed']);
                                }
                            }
                        }
                    }
                }
            }
            
            if (!empty($ids)) {
                $users_list = $this->ci->Users_model->getUsersListByKey(null, null, null, [], array_unique($ids));
                foreach ($format_about_you as &$v) {
                    $v['user'] = $users_list[$v['id_poster']];
                }
                $this->ci->view->assign('about_you', $format_about_you);
                $result['pages']['wall_events/about_you.html'] = $this->ci->view->fetch('user_information/about_you', 'user', 'wall_events');
                $pages['wall_events/about_you.html'] = l('field_usr_inf_link_about_you', 'wall_events');
            }
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'wall_events');
        return $result;
    }
    
    private function format($data)
    {
        return str_replace('src="//', 'src="https://', $data);
    }
}
