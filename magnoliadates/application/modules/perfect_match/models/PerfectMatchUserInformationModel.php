<?php

declare(strict_types=1);

namespace Pg\modules\perfect_match\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\YourTrait;

/**
 * Perfect match user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PerfectMatchUserInformationModel extends \Model implements IUserInformation
{
    use YourTrait;

    /**
     * PerfectMatchUserInformationModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return user information
     *
     * @param array $user
     *
     * @return array
     */
    public function getUserInformation($user)
    {
        $pages = [];
        $result = [];
        
        $this->ci->load->model(['field_editor/models/Field_editor_forms_model', 'Perfect_match_model']);
        $this->ci->view->assign('user', $user);
        
        $perfect_match_params = $this->ci->Perfect_match_model->getUserParams($user['id']);
        $data = (!empty($perfect_match_params['full_criteria'])) ? $perfect_match_params['full_criteria'] : [];
        $fe_criteria = $this->ci->Field_editor_forms_model->getSearchCriteria(
            $this->ci->Perfect_match_model->perfect_match_form_gid,
            $data,
            $this->ci->Perfect_match_model->form_editor_type,
            false);
        $common_criteria = $this->ci->Perfect_match_model->getCommonCriteria($data);
        $criteria = array_merge_recursive($fe_criteria, $common_criteria);
        $your_count = $this->ci->Perfect_match_model->getUsersCount($criteria);
        if ($your_count) {
            $your = $this->ci->Perfect_match_model->getUsersList(null, null, null, $criteria);
            $this->ci->view->assign('your', $your);
            $result['pages']['perfect_match/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'perfect_match');
            $pages['perfect_match/your.html'] = l('field_usr_inf_link_your', 'perfect_match');
        }
        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'perfect_match');
        return $result;
    }
}
