<?php

declare(strict_types=1);

namespace Pg\modules\polls\models;

use Pg\modules\user_information\models\IUserInformation;
use Pg\modules\user_information\models\traits\AboutYouTrait;

/**
 * Polls user information model
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class PollsUserInformationModel extends \Model implements IUserInformation
{
    use AboutYouTrait;
    
    /**
     *  Constructor
     *
     *  @return PollsUserInformationModel
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
        
        $this->ci->load->model('Polls_model');
        $this->ci->view->assign('user', $user);
        
        $count_your = $this->ci->Polls_model->getResultsCount(['where' => ['user_id' => $user['id']]]);
        if ($count_your) {
            $your = $this->ci->Polls_model->getResultsList(null, null, null, ['where' => ['user_id' => $user['id']]]);
            $ids = [];
            $format_polls = [];
            foreach ($your as $v) {
                $ids[] = $v['poll_id'];
            }
            $polls = $this->ci->Polls_model->getPollsList(null, null, null, null, $ids);
            foreach ($polls as $poll) {
                $format_polls[$poll['id']] = $poll;
            }
            foreach ($your as &$v) {
                $v['poll'] = $format_polls[$v['poll_id']]['question'][$user['lang_id']];
                foreach ($format_polls[$v['poll_id']]['results'] as $k => $a) {
                    if ($v['answer_' . $k] !=0) {
                        $v['answers'][$k] = $format_polls[$v['poll_id']]['answers_languages'][$k . '_' . $user['lang_id']];
                    }
                }
            }
            $this->ci->view->assign('your', $your);
            $result['pages']['polls/your.html'] = $this->ci->view->fetch('user_information/your', 'user', 'polls');
            $pages['polls/your.html'] = l('field_usr_inf_link_your', 'polls');
        }
        
        $this->ci->view->assign('pages', $pages);
        $result['html'] = $this->ci->view->fetch('user_information/main', 'user', 'polls');
        return $result;
    }
}
