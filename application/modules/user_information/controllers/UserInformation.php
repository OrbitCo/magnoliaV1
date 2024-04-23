<?php

declare(strict_types=1);

namespace Pg\modules\user_information\controllers;

/**
 * user_information module
 *
 * @package PG_Dating
 * @copyright   Copyright (c) 2000-2019 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

use Pg\modules\user_information\models\UserInformationModel;

/**
 * UserInformation user side controller
 *
 * @property  UserInformationModel
 * @package PG_Dating
 * @subpackage  user_information
 * @category    controllers
 * @copyright   Copyright (c) 2000-2019 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class UserInformation extends \Controller
{

    /**
     * UserInformation constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserInformationModel');
        $this->UserInformationModel->user_id = (int)$this->ci->session->userdata('user_id');
    }

    /**
     * Create archive user information
     *
     * @return mixed
     */
    public function create()
    {
        $return = [];
        if ($this->input->post('create')) {
            $modules = $this->input->post('modules', true);
            $return = $this->UserInformationModel->create($modules);
        }
        $this->view->assign($return);
        $this->view->render();
    }

    /**
     * Delete archive user information
     *
     * @return mixed
     */
    public function delete()
    {
        $return = [];
        if ($this->input->post('delete')) {
            $return = $this->UserInformationModel->delete();
        }
        $this->view->assign($return);
        $this->view->render();
    }

    /**
     * Download user information
     *
     * @return void
     */
    public function download()
    {
        $archive_data = $this->UserInformationModel->getArchive((int)$this->session->userdata('user_id'));
        $this->load->model('UploadsModel');
        $file = $this->UploadsModel->getMediaPath(
            UserInformationModel::MODULE_GID,
            UserInformationModel::secretPath($archive_data)
        ) .
            UserInformationModel::nameArchive($this->session->userdata('nickname'));
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }
}
