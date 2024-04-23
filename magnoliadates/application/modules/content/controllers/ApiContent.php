<?php

declare(strict_types=1);

namespace Pg\modules\content\controllers;

/**
 * Content module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Content api controller
 *
 * @package     PG_Dating
 * @subpackage  Content
 *
 * @category    controllers
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ApiContent extends \Controller
{
    /**
     * Class constructor
     *
     * @return Api_Content
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Content_model");
    }

    /**
     * Get page content
     *
     * @param string $gid page guid
     *
     * @return void
     */
    /**
    * @api {post} /content/get  Get page content
    * @apiGroup Content
    * @apiParam {string} gid  page gid
    */
    public function get()
    {
        $gid = $this->input->post('gid', true);
        if (!$gid) {
            log_message('error', 'content API: Empty content gid');
            $this->set_api_content('errors', l('error_content_gid_invalid', 'content'));

            return false;
        }
        $page_data = $this->Content_model->get_page_by_gid($gid);
        $this->set_api_content('data', ['page_data' => $page_data]);
    }

    /**
     * Get content pages tree
     *
     * @return void
     */
    /**
    * @api {post} /content/tree  Get content pages tree
    * @apiGroup Content
    * @apiParam {string} gid  page gid
    * @apiParam {array} params selection parameters
    */
    public function tree()
    {
        $lang_id = $this->pg_language->current_lang_id;
        $parent_id = (int) $this->input->post('gid', true);
        $params = (array) $this->input->post('params', true);
        $page_data = $this->Content_model->get_pages_list($lang_id, $parent_id, $params);
        $this->set_api_content('data', ['page_data' => $page_data]);
    }

    /**
     * Load quick page
     *
     * @return string
     */
        /**
    * @api {post} /content/quickPage  Load quick page
    * @apiGroup Content
    * @apiParam {string} gid  page gid
    */
    public function quickPage()
    {
        $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);
        if (!empty($gid)) {
            $page_data = $this->Content_model->getPageByGid($gid, $this->pg_language->current_lang_id);
            $this->set_api_content('data', ['page_data' => $page_data]);
        }
    }
}
