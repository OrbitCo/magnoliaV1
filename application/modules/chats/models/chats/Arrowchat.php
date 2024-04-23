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
 * */
class Arrowchat extends ChatAbstract
{
    private $admin_url = 'admin/index.php';
    private $install_url = 'install/index.php';
    protected $_name = 'Arrowchat';
    protected $_gid = 'arrowchat';
    protected $_activities = ['include'];
    protected $_settings = [];

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('Chats_model');
        $this->_dir = SITE_VIRTUAL_PATH . $this->ci->Chats_model->path . $this->get_gid() . '/';
        $this->_rdir = SITE_PHYSICAL_PATH . $this->ci->Chats_model->path . $this->get_gid() . '/';
    }

    public function userPage()
    {
        return false;
    }

    public function includeBlock()
    {
        $this->view->assign('chat', $this->asArray());
        $this->view->assign('url', $this->_dir . $this->admin_url);

        return $this->view->fetch('arrowchat_include', 'user', 'chats');
    }

    public function adminPage()
    {
        $this->view->assign('chat', $this->asArray());
        $this->view->assign('url', $this->_dir . $this->admin_url);
        $this->view->assign('width', '100%');
        $this->view->assign('height', 756);

        return $this->view->fetch('arrowchat_admin', 'admin', 'chats');
    }

    public function installPage()
    {
        $this->view->assign('chat', $this->asArray());
        $this->view->assign('url', $this->_dir . $this->install_url);
        $this->view->assign('width', '100%');
        $this->view->assign('height', 756);

        if (file_exists($this->_rdir . 'includes/config.php')) {
            //chmod($this->_rdir.'includes/config.php', 0644);
            //rename($this->_rdir.'install', $this->_rdir.'install.bak');
            $this->ci->Chats_model->setInstalled($this->_gid);
            redirect(site_url() . 'admin/chats');
        }

        return $this->view->fetch('arrowchat_install', 'admin', 'chats');
    }

    public function validateSettings()
    {
        return true;
    }
}
