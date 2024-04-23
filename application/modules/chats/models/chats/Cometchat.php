<?php

declare(strict_types=1);

namespace Pg\modules\chats\models\chats;

/**
 * Chats model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 */
class Cometchat extends ChatAbstract
{
    private $admin_url = 'admin/index.php';
    private $install_url = 'install.php';
    protected $_name = 'Cometchat';
    protected $_gid = 'cometchat';
    protected $_activities = ['include'];
    protected $_settings = [];

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('Chats_model');
        $this->_dir = SITE_VIRTUAL_PATH . $this->ci->Chats_model->path . $this->get_gid() . '/';
    }

    public function userPage()
    {
        return false;
    }

    public function includeBlock()
    {
        $this->view->assign('chat', $this->as_array());
        $this->view->assign('url', $this->_dir . $this->admin_url);

        return $this->view->fetch('cometchat_include', 'user', 'chats');
    }

    public function adminPage()
    {
        $this->view->assign('chat', $this->as_array());
        $this->view->assign('url', $this->_dir . $this->admin_url);
        $this->view->assign('width', '100%');

        return $this->view->fetch('cometchat_admin', 'admin', 'chats');
    }

    public function installPage()
    {
        $this->view->assign('chat', $this->as_array());
        $this->view->assign('url', $this->_dir . $this->install_url);
        $this->view->assign('width', '100%');

        return $this->view->fetch('cometchat_install', 'admin', 'chats');
    }

    public function validateSettings()
    {
        return true;
    }
}
