<?php

declare(strict_types=1);

namespace Pg\modules\like_me\controllers;

use Pg\Libraries\Analytics;
use Pg\Libraries\View;
use Pg\modules\like_me\models\LikeMeModel;

/**
 * Like me controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
 **/
class LikeMe extends \Controller
{
    public const LAST_IDS_COOKIE_NAME = 'last_like_me_id';

    /**
     * LikeMe constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model(['Like_me_model','Menu_model']);
        if ($this->ci->Like_me_model->isAccess() === false) {
            if ($this->ci->input->is_ajax_request()) {
                show_404();
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_photo', LikeMeModel::MODULE_GID));
                $this->view->setRedirect(site_url() . 'users/profile/view');
            }
        }
        $this->view->assign('page_type', LikeMeModel::MODULE_GID);
    }

    /**
     * Index
     *
     * @param string $action
     * @param integer $is_registr
     *
     * @return void
     */
    public function index($action = 'play_global', $is_registr = 0)
    {
        $this->view->assign('is_registr', $is_registr);
        $this->play($action, $is_registr);
    }

    public function likeMeProfiles($is_registr = 0)
    {
        $this->view->assign('is_registr', $is_registr);
        $this->play('like_me', $is_registr);
    }

    /**
     *Play
     *
     * @param string $action
     *
     * @return void
     */
    public function play($action = 'play_global')
    {
        $this->ci->pg_language->pages->load('like_me');

        $this->ci->Menu_model->breadcrumbs_set_active(l('header_main', 'like_me'));

        $this->view->assign('action', $action);
        $this->view->assign('data', $this->ci->Like_me_model->getSettings());

        $this->view->render('play');
    }

    /**
     *  Remove matches
     *
     *  @param integer $profile_id
     *
     *  @return void
     */
    public function remove($profile_id = null)
    {
        if (!is_null($profile_id)) {
            $user_id = intval($this->session->userdata('user_id'));
            $this->Like_me_model->removeMatches($user_id, $profile_id);
        }
        $this->view->setRedirect(site_url() . 'like_me/index/matches');
    }

    /**
     *  Selected actions
     *
     *  @param array $action
     *
     *  @return array
     */
    private function selAction($action = [], $page = 1)
    {
        switch ($action['type']) {
            case 'play_local':
                $data = $this->userListLocal($action);

                break;
            case 'matches':
                $data = $this->userListMatches($page);

                break;
            case 'like':
                $data = $this->userListLike($page);

                break;
            case 'like_me':
                $data = $this->userListLikeMe($page);

                break;
            default:
                $data = $this->userListGlobal($action);

                break;
        }

        return $data;
    }

    /**
     * LIke list
     *
     * @param integer $page
     *
     * @return array
     */
    private function userListLike($page)
    {
        $user_id = intval($this->session->userdata("user_id"));
        $count_data = $this->Like_me_model->getCountProfilesListByUserId($user_id);
        $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');
        $this->load->helper('sort_order');
        $exists_page = get_exists_page_number($page, $count_data, $items_on_page);
        $next_page = get_exists_page_number($exists_page + 1, $count_data, $items_on_page);
        if ($next_page > $exists_page) {
            $user_list = ['have_more' => 1];
        }
        $user_list['content'] = $this->Like_me_model->getLikeList($page, $items_on_page, $user_id);

        return $user_list;
    }

    /**
     * LIke me list
     *
     * @param integer $page
     *
     * @return array
     */
    private function userListLikeMe($page)
    {
        $user_id = intval($this->session->userdata("user_id"));
        $count_data = $this->Like_me_model->getCountUsersListByProfileId($user_id);
        $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');
        $this->load->helper('sort_order');
        $exists_page = get_exists_page_number($page, $count_data, $items_on_page);
        $next_page = get_exists_page_number($exists_page + 1, $count_data, $items_on_page);
        if ($next_page > $exists_page) {
            $user_list = ['have_more' => 1];
        }
        $user_list['content'] = $this->Like_me_model->getLikeMeList($page, $items_on_page, $user_id);

        return $user_list;
    }

    /**
     * Play global list
     *
     * @param array $data
     *
     * @return array
     */
    private function userListGlobal($data = [])
    {
        $params = $this->getParams($data);
        $order = ['id' => 'ASC'];
        $user_list = $this->Users_model->getUsersList(1, 1, $order, $params);

        return (!empty($user_list[0])) ? $user_list[0] : [];
    }

    /**
     * Play matches list
     *
     * @param array $data
     *
     * @return array
     */
    private function userListMatches($page = 1)
    {
        $user_id = intval($this->session->userdata("user_id"));
        $count_data = $this->Like_me_model->getCountMatchesList($user_id);
        $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');
        $this->load->helper('sort_order');
        $exists_page = get_exists_page_number($page, $count_data, $items_on_page);
        $next_page = get_exists_page_number($exists_page + 1, $count_data, $items_on_page);
        if ($next_page > $exists_page) {
            $user_list = ['have_more' => 1];
        }
        $user_list['content'] = array_values($this->Like_me_model->getMatchesList($page, $items_on_page, $user_id));

        return $user_list;
    }

    /**
     * Play local list
     *
     * @param array $data
     *
     * @return array
     */
    private function userListLocal($data = [])
    {
        $params = $this->getParams($data);

        $area = $this->pg_module->get_module_config('like_me', 'play_local_area');
        $user_id = intval($this->session->userdata('user_id'));
        $this->load->model('Users_model');
        $user_data = $this->Users_model->getUserById($user_id);
        $params['where'][$area] = $user_data[$area];
        $order = ['id' => 'ASC'];
        $user_list = $this->Users_model->getUsersList(1, 1, $order, $params);

        return (!empty($user_list[0])) ? $user_list[0] : [];
    }

    /**
     * Querying
     *
     * @param array $data
     *
     * @return array
     */
    private function getParams($data = [])
    {
        if (!empty($data['profile_id'])) {
            if (!empty($_COOKIE[self::LAST_IDS_COOKIE_NAME])) {
                $exclude_ids = (array)unserialize($_COOKIE[self::LAST_IDS_COOKIE_NAME]);
            } else {
                $exclude_ids = [];
            }

            $exclude_ids[] = $data['profile_id'];

            $this->ci->load->helper('cookie');
            $cookie = [
                'name'         => self::LAST_IDS_COOKIE_NAME,
                'value'        => serialize(array_unique($exclude_ids)),
                'expire'       => time() + '604800',
                'domain'       => COOKIE_SITE_SERVER,
                'path'         => '/' . SITE_SUBFOLDER,
            ];
            set_cookie($cookie);
        }

        if (empty($data['reload'])) {
            if (!empty($_COOKIE[self::LAST_IDS_COOKIE_NAME])) {
                $profile_ids = (array)unserialize($_COOKIE[self::LAST_IDS_COOKIE_NAME]);
            } else {
                $profile_ids = [];
            }
        } else {
            $profile_ids = [];
        }

        return $this->ci->Like_me_model->getParams($data, $profile_ids);
    }

    /**
     * Play list
     *
     * @param array $data
     * @param int $page
     *
     * @return void
     */
    private function getUserData($data = [], $page = 1)
    {
        $data['user'] = $this->selAction($data, $page);
        $this->view->assign('data', $data);
        $result = ['html' => $this->view->fetch('ajax_like_me')];

        $this->view->assign($result);
        $this->view->render();
    }

    /**
     *  Save play action
     *
     *  @param array $data
     *
     *  @return array
     */
    private function setPlayAction($data = [])
    {
        $result = ['errors' => []];

        $validate_data = $this->Like_me_model->validatePlayAction($data);
        if (!empty($validate_data['errors'])) {
            $result['errors'] = $validate_data['errors'];
        } else {
            $like_id = $this->Like_me_model->savePlayAction($validate_data['data']);
            if (isset($like_id)) {
                if (!empty($validate_data['data'])) {
                    $this->ci->Like_me_model->sendMessage($validate_data['data'], true);
                }

                if (empty($validate_data['data']['status_match'])) {
                    return $this->getUserData($data);
                }
                $this->ci->Like_me_model->changeStatus($validate_data['data']);
                $this->ci->Like_me_model->sendMessage($validate_data['data']);
            }

            $this->view->assign($result);
            $this->view->render();
        }
    }

    /**
     * Load congratulations
     *
     * @param array $data
     *
     * @return void
     */
    private function loadCongratulations(array $data = [])
    {

        $this->load->library('Analytics');
        $event = $this->analytics->getEvent('like_me', 'engaged_matched', 'user');
        $this->analytics->track($event);

        $lang_id = $this->pg_language->current_lang_id;
        $data['settings'] = $this->Like_me_model->getSettings();
        $this->load->model('Users_model');
        $user_id = intval($this->session->userdata('user_id'));
        $ids = [$user_id, $data['profile_id']];
        $data['users'] = $this->Users_model->getUsersList(null, null, null, [], $ids);
        $this->view->assign('user_data', $data);
        $this->view->assign('lang_id', $lang_id);
        $this->view->render('ajax_notify');
    }

    /**
     * Ajax user list
     *
     * @retrun mixed
     */
    public function ajaxGetUsers()
    {
        $post_data = [
            'type'   => (trim(strip_tags($this->input->post('type', true))) ?: 'play_global'),
            'reload' => intval($this->input->post('reload', true)),
            'exclude_user_id' => intval($this->input->post('exclude_user_id', true))
        ];
        if (!empty($post_data['reload'])) {
            $this->load->helper('cookie');
            $cookie = [
                'name'        => self::LAST_IDS_COOKIE_NAME,
                'domain'      => COOKIE_SITE_SERVER,
                'path'        => '/' . SITE_SUBFOLDER,
            ];
            delete_cookie($cookie);
        }
        $this->getUserData($post_data);
    }

    /**
     *  Ajax play action
     *
     *  @return void
     */
    public function ajaxPlayAction()
    {
        $post_data = [
            'type' => filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING),
            'action' => filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING),
            'profile_id' => filter_input(INPUT_POST, 'profile_id', FILTER_VALIDATE_INT)
        ];

        $this->setPlayAction($post_data);
    }

    /**
     *  Ajax load congratulations
     *
     *  @return void
     */
    public function ajaxCongratulations()
    {
        $post_data = [
            'profile_id' => intval($this->input->post('profile_id', true)),
        ];
        $this->loadCongratulations($post_data);
    }

    /**
     *  Ajax load match list
     *
     *  @param integer $page
     *
     *  @return void
     */
    public function ajaxLoadMatches($page = null)
    {
        if (!is_null($page)) {
            $page = intval($page);
            $data = ['type' => 'matches'];
            $this->getUserData($data, $page);
        }
    }

    /**
     *  Ajax load like list
     *
     *  @param integer $page
     *
     *  @return void
     */
    public function loadLikeProfiles($page = null)
    {
        if (!is_null($page)) {
            $this->getUserData(['type' => 'like'], $page);
        }
    }

    /**
     *  Ajax load like me list
     *
     *  @param integer $page
     *
     *  @return void
     */
    public function loadLikeMeProfiles($page = null)
    {
        if (!is_null($page)) {
            $this->getUserData(['type' => 'like_me'], $page);
        }
    }
}
