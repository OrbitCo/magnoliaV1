<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\controllers;

/**
 * Perfect_match api
 *
 * @package     PG_Dating
 * @subpackage  Perfect_match
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ApiPerfectMatch extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->user_id = intval($this->session->userdata('user_id'));
    }
}
