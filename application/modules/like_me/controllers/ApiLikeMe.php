<?php

declare(strict_types=1);

namespace Pg\modules\like_me\controllers;

use Pg\Libraries\View;
use Pg\modules\like_me\models\LikeMeModel;

/**
 * Api Like me controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
 **/
class ApiLikeMe extends \Controller
{

    /**
     * ApiLikeMe constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('like_me/models/Like_me_model');
        $this->Like_me_model->users_per_page = 10;
    }

    /**
     * @api {post} /like_me/play Play Like me game page
     * @apiGroup Like me
     * @apiParam {boolean} [reload] reload game
     * @apiParam {int} [from_id] start from id
     */
    public function play($play_location = LikeMeModel::PLAY_LOCATION_GLOBAL)
    {
        $reload = $this->input->post('reload', true);
        if ($reload == "true") {
            $reload = true;
        } else {
            $reload = false;
        }
        $from_id = (int) $this->input->post('from_id', true);
        $this->Like_me_model->setPlayLocation($play_location);
        $users = $this->Like_me_model->getUsers($from_id, $reload);
        $this->view->assign('users', $this->Like_me_model->formatUsers($users));
        $this->view->render();
    }

    /**
     * @api {post} /like_me/matches Matches page
     * @apiGroup Like me
     * @apiParam {int} [page] page count
     */
    public function matches()
    {
        $page = (int) $this->input->post('page');

        $user_id = intval($this->session->userdata('user_id'));

        $count = $this->Like_me_model->getCountMatchesList($user_id);

        if ($count > 0) {
            $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');

            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $count, $items_on_page);

            $users = array_values($this->Like_me_model->getMatchesList($page, $items_on_page, $user_id));
        } else {
            $users = [];
        }

        $this->view->assign('count', $count);
        $this->view->assign('users', $users);
        $this->view->render();
    }

    /**
     * @api {post} /like_me/settings Settings page
     * @apiGroup Like me
     */
    public function settings()
    {
        $this->view->assign($this->Like_me_model->getSettings());
        $this->view->render();
    }

    /**
     * @api {post} /like_me/like Set like on user
     * @apiGroup Like me
     * @apiParam {int} type type
     * @apiParam {string} action action type
     * @apiParam {int} profile_id user id
     */
    public function like()
    {
        $post_data = [
            'type'       => trim(strip_tags($this->input->post('type', true))),
            'action'     => trim(strip_tags($this->input->post('action', true))),
            'profile_id' => intval($this->input->post('profile_id', true)),
            'page' => intval($this->input->post('page', true))
        ];

        $validate_data = $this->Like_me_model->validatePlayAction($post_data);
        if (!empty($validate_data['errors'])) {
            $this->view->assign('errors', $validate_data['errors']);
        } else {
            $like_id = $this->Like_me_model->savePlayAction($validate_data['data']);
            if (isset($like_id)) {
                if ($validate_data['data']['status_match'] == 0) {
                    switch ($post_data['type']) {
                        case 'play_local':
                            $data['user'] = $this->userListLocal($post_data['action']);
                            break;
                        case 'matches':
                            $data['user'] = $this->userListMatches($post_data['page']);
                            break;
                        default:
                            $data['user'] = $this->userListGlobal($post_data['action']);
                            break;
                    }
                    $this->view->assign('match', false);
                    $this->view->assign('data', $post_data);
                } else {
                    $this->ci->Like_me_model->changeStatus($validate_data['data']);
                    $this->ci->Like_me_model->sendMessage($validate_data['data']);
                    $this->view->assign('match', true);
                }
            }
        }

        $this->view->render();
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
        $params = $this->ci->Like_me_model->getParams($data);
        $order = ['id' => 'ASC'];
        $user_list = $this->Users_model->getUsersList(1, 1, $order, $params);
        $return = (!empty($user_list[0])) ? $user_list[0] : [];

        return $return;
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
        $params = $this->ci->Like_me_model->getParams($data);
        $area = $this->pg_module->get_module_config('like_me', 'play_local_area');
        $user_id = intval($this->session->userdata('user_id'));
        $this->load->model('Users_model');
        $user_data = $this->Users_model->get_user_by_id($user_id);
        $params['where'][$area] = $user_data[$area];
        $order = ['id' => 'ASC'];
        $user_list = $this->Users_model->get_users_list(1, 1, $order, $params);
        $return = (!empty($user_list[0])) ? $user_list[0] : [];
        return $return;
    }

    public function iLiked()
    {
        $page = (int) $this->input->post('page');
        $user_id = intval($this->session->userdata('user_id'));
        $count = $this->Like_me_model->getCountProfilesListByUserId($user_id);

        if ($count > 0) {
            $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $count, $items_on_page);
            $users = array_values($this->Like_me_model->getLikeList($page, $items_on_page, $user_id));
        } else {
            $users = [];
        }

        $this->view->assign('count', $count);
        $this->view->assign('users', $users);
        $this->view->render();
    }

    public function likedMe()
    {
        $page = (int) $this->input->post('page');
        $user_id = intval($this->session->userdata('user_id'));
        $count = $this->Like_me_model->getCountUsersListByProfileId($user_id);

        if ($count > 0) {
            $items_on_page = $this->pg_module->get_module_config('like_me', 'matches_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number($page, $count, $items_on_page);
            $users = array_values($this->Like_me_model->getLikeMeList($page, $items_on_page, $user_id));
        } else {
            $users = [];
        }

        $this->view->assign('count', $count);
        $this->view->assign('users', $users);
        $this->view->render();
    }
}
