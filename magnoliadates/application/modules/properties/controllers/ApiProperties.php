<?php

declare(strict_types=1);

namespace Pg\modules\properties\controllers;

/**
 * Properties api controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 * */
class ApiProperties extends \Controller
{
    /**
    * @api {post} /properties/getProperty Get property
    * @apiGroup Properties
    * @apiParam {string} gid property gid
    * @apiParam {int} lang_id language id
    */
    public function getProperty()
    {
        $gid = trim(strip_tags($this->input->post('gid', true)));
        $lang_id = filter_input(INPUT_POST, 'lang_id');
        $this->load->model('Properties_model');
        $property = $this->Properties_model->get_property($gid, $lang_id);
        $this->set_api_content('data', $property);
    }
}
