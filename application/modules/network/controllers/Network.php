<?php

declare(strict_types=1);

namespace Pg\modules\network\controllers;

use Pg\modules\network\models\NetworkUsersModel;

/**
 * Network user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Network extends \Controller
{
    private $user_id;

    /**
     * Network constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('network/models/NetworkUsersModel');
        $this->user_id = (int)$this->session->userdata('user_id');
    }

    /**
     * Contact URL
     *
     * @return string|void
     */
    private function getContactUrl()
    {
        if ($this->pg_module->is_module_installed('tickets')) {
            return site_url() . 'tickets';
        } elseif ($this->pg_module->is_module_installed('contact_us')) {
            return site_url() . 'contact_us';
        } else {
            return;
        }
    }

    /**
     * Register user to network
     *
     * @return void
     */
    public function register()
    {
        if ($this->input->post('btn_agree')) {
            // Agree
            $this->NetworkUsersModel->saveUserDecision(
                $this->user_id,
                NetworkUsersModel::DECISION_AGREE);
            $this->view->setRedirect($this->input->post('redirect'), 'hard');
        } elseif ($this->input->post('btn_not_agree')) {
            // Not agree
            $this->NetworkUsersModel->saveUserDecision(
                $this->user_id,
                NetworkUsersModel::DECISION_DISAGREE);
            $this->NetworkUsersModel->userDeleted(['id' => $this->user_id]);
            $this->NetworkUsersModel->saveNotAgree($this->user_id);
            $this->view->setRedirect($this->input->post('redirect'), 'hard');
        } elseif ($this->input->post('btn_skip')) {
            $this->view->setRedirect(site_url() . 'tickets/index/', 'hard');
        } elseif (NetworkUsersModel::DECISION_UNKNOWN !== $this->NetworkUsersModel->getUserDecision($this->user_id)) {
            // Already answered
            $this->view->setRedirect(site_url() . 'users/search', 'hard');
        } else {
            // Show form
            $this->view->assign('redirect', site_url() . 'users/search');
            $this->view->assign('header_type', 'network');
            $this->view->assign('contact_url', $this->getContactUrl());

            $this->view->render('register');
        }
    }

    /**
     * Check network state
     *
     * @return void
     */
    public function cron()
    {
        $this->load->model('NetworkModel');
        $this->NetworkModel->cronCheckStarted();
    }
}
