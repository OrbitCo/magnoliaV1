<?php

declare(strict_types=1);

namespace Pg\modules\network\controllers;

/**
 * Network admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiNetwork extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * @api {post} /network/getStat Network users statistic
    * @apiGroup Network
    */
    public function getStat()
    {
        $this->load->model("network/models/Network_users_model");
        $this->set_api_content('data', [$this->Network_users_model->getStat()]);
    }
}
