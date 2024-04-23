<?php

declare(strict_types=1);

namespace Pg\modules\file_uploads\controllers;

use Pg\Libraries\View;

/**
 * android File uploads api controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiFileUploads extends \Controller
{

    private $file_config_id = 'android-exchange';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('file_uploads/models/File_uploads_android_model');
        $this->load->model('file_uploads/models/File_uploads_model');
        $this->load->model('Users_model');
        $this->load->model('Uploads_model');
        if ('user' === $this->session->userdata('auth_type')) {
            $this->_user_id = intval($this->session->userdata('user_id'));
        }
    }


    /**
    * @api {post} /file_uploads/upload Upload file
    * @apiGroup File uploads
    * @apiParam {int} user_id  user id
    */
    public function upload()
    {
        $user_id = $this->input->post("user_id", true);
        $sender_id = $this->_user_id;

        $file_return = $this->File_uploads_model->upload($this->file_config_id, $user_id . '/', 'file');
        if (!empty($file_return['errors'])) {
            if (is_array($file_return['errors'])) {
                $message['message'] = implode(". ", $file_return['errors']);
            } else {
                $message['message'] = $file_return['errors'];
            }
            $this->set_api_content('data', $message);
            return;
        }

        $message = $this->File_uploads_android_model->setUpload($file_return['file'], $user_id, $sender_id);

        $this->set_api_content('data', $message);
    }

    /**
    * @api {post} /file_uploads/getUploads Get upload files
    * @apiGroup File uploads
    * @apiParam {boolean} outgoing  outgoing uploads or incoming
    */
    public function getUploads()
    {
        $outgoing = $this->input->post("outgoing", true);

        $result = $this->File_uploads_android_model->getUploads($this->_user_id, $outgoing);
        if (empty($result)) {
            return;
        }

        $upload_config_id = $this->Users_model->upload_config_id;

        $i = 0;
        foreach ($result as $row) {
            $user = $outgoing ? $row['user_id'] : $row['sender_id'];
            $userinfo = $this->Users_model->get_user_by_id($user, true);
            $result[$i]["name"] = $userinfo['output_name'];
            $result[$i]["user_logo"] = $this->Uploads_model->format_upload($upload_config_id, $user, $userinfo["user_logo"]);
            if (!$outgoing) {
                $this->File_uploads_android_model->_mark_as_read($row['id'], ['is_new' => 0]);
            }
            ++$i;
        }

        $this->set_api_content('data', $result);
    }

    /**
    * @api {post} /file_uploads/getConfig Get upload configuration
    * @apiGroup File uploads
    */
    public function getConfig()
    {
        $config_data = $this->File_uploads_model->get_config($this->file_config_id);
        $this->set_api_content('data', $config_data);
    }
}
