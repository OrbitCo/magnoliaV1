<?php

declare(strict_types=1);

namespace Pg\modules\media\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Media user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class MediaUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;
    
    /**
     *  Constructor
     *
     *  @return MediaUserInformationModel
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
        
        $this->ci->load->model('Media_model');
        $this->ci->view->assign('user', $user);
        
        $media = $this->ci->Media_model->getMedia(null, null, null, ['where' => ['id_user' => $user['id']]]);
        if (!empty($media)) {
            $audio = [];
            $image = [];
            $video = [];
            foreach ($media as $v) {
                if ($v['upload_gid'] == 'gallery_audio') {
                    $audio[] = $v;
                } elseif ($v['upload_gid'] == 'gallery_image') {
                    $image[] = $v;
                } elseif ($v['upload_gid'] == 'gallery_video') {
                    $video[] = $v;
                }
            }
            if (!empty($audio)) {
                $this->ci->view->assign('audio', $audio);
                foreach ($audio as $v) {
                    if ($v['media_video'] != 'embed') {
                        $result['files']['media/audio/' . $v['mediafile']] = $v['media']['mediafile']['file_path'];
                    }
                }
                $result['pages']['media/audio.html'] = $this->ci->view->fetch('user_information/audio', 'user', 'media');
                $pages['media/audio.html'] = l('field_usr_inf_link_audio', 'media');
            }
            if (!empty($image)) {
                $this->ci->view->assign('image', $image);
                foreach ($image as $v) {
                    $result['files']['media/image/grand-' . $v['mediafile']] = $v['media']['mediafile']['thumbs_data']['grand']['file_path'];
                }
                $result['pages']['media/image.html'] = $this->ci->view->fetch('user_information/image', 'user', 'media');
                $pages['media/image.html'] = l('field_usr_inf_link_image', 'media');
            }
            if (!empty($video)) {
                foreach ($video as &$v) {
                    if ($v['media_video'] != 'embed') {
                        $result['files']['media/video/' . $v['media_video']] = $v['video_content']['file_path'];
                    } else {
                        $v['video_content']['embed'] = $this->format($v['video_content']['embed']);
                    }
                }
                $this->ci->view->assign('video', $video);
                $result['pages']['media/video.html'] = $this->ci->view->fetch('user_information/video', 'user', 'media');
                $pages['media/video.html'] = l('field_usr_inf_link_video', 'media');
            }
        }
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'media');
        return $result;
    }
    
    private function format($data)
    {
        return str_replace('src="//', 'src="https://', $data);
    }
}
