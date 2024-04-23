<?php

declare(strict_types=1);

namespace Pg\modules\fast_navigation\controllers;

use Pg\modules\fast_navigation\models\FastNavigationModel;

/**
 * Fast navigation module
 *
 * @package PG_Dating
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class AdminFastNavigation extends \Controller
{

    /**
     * AdminFastNavigation constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Fast_navigation_model");
    }

     /**
     * Search
     *
     * @return void
     */
    public function search()
    {
        $search_data = $this->Fast_navigation_model->validSearchData($this->input->post('keyword', true));
        if (empty($search_data['errors'])) {
            $search_data['data'] = $this->Fast_navigation_model->getRootWords($search_data);
            $return  = $this->Fast_navigation_model->getSearchResult($search_data['data']);
            $this->view->assign('data', $return);
        } else {
             $this->view->assign('error', $search_data['errors']);
        }
        $result['html'] = $this->view->fetch('list');
        $this->view->assign($result);
        $this->view->render();
    }
}
