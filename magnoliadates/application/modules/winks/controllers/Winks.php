<?php

declare(strict_types=1);

namespace Pg\modules\winks\controllers;

use Pg\modules\blacklist\models\BlacklistModel;

/**
 * Winks admin side controller
 *
 * @package PG_DatingPro
 * @subpackage Winks
 * @category    controllers
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Winks extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Winks_model']);
    }

    public function index($page = 1)
    {
        $params = [
            'where' => [
                'id_to' => $this->session->userdata('user_id'),
                'type !=' => 'ignored',
            ]
        ];
        $winks_count = $this->Winks_model->getCount($params);
        if ($winks_count) {
            $this->load->helper('sort_order');
            $this->load->helper('navigation');
            $items_on_page = $this->pg_module->get_module_config('winks', 'items_per_page');
            $page = get_exists_page_number($page, $winks_count, $items_on_page);
            $winks = $this->Winks_model->format($this->Winks_model->get($params, $page, $items_on_page, ['date' => 'DESC']));

            $viewed_winks = [];

            foreach ($winks as $value) {
                $viewed_winks[] = $value['id'];
            }

            $this->Winks_model->setIsViewed($viewed_winks);

            $this->config->load('date_formats', true);
            $page_data = get_user_pages_data(site_url() . 'winks/index/', $winks_count, $items_on_page, $page, 'briefPage');
            $page_data['date_time_format'] = $this->pg_date->get_format('date_time_literal', 'st');
            $this->view->assign('page_data', $page_data);
            $this->view->assign('winks', $winks);

        }
        $this->Menu_model->breadcrumbs_set_active(l('winks', 'winks'));
        $this->view->assign('user_id', $this->session->userdata('user_id'));
        $this->view->render('list');
    }

    public function ajaxWink()
    {
        $id_user = $this->session->userdata('user_id');
        $id_to = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        if (empty($id_to)) {
            log_message('error', '(winks) Empty recipient id');
            $errors[] = l('error_unauthorized', 'winks');
        } elseif ($id_to == $id_user) {
            $errors[] = l('error_wink_someone_else', 'winks');
        }

        if ((new BlacklistModel())->isBlocked($id_to, $id_user)) {
            $errors[] = l('you_in_blacklist', 'blacklist');
        }

        if (empty($errors)) {
            $wink = $this->Winks_model->getByPair($id_user, $id_to);
            if (!empty($wink)) {
                return $this->ajaxReply('replied');
            }
            $result = $this->Winks_model->save([
                'id_from' => $id_user,
                'id_to' => $id_to,
                'type' => 'new'
            ]);
            if ($result) {
                $this->view->assign(['success' => 'ok']);
            } else {
                $this->view->assign(['errors' => 'error']);
            }
        } else {
            $this->view->assign(['errors' => $errors]);
        }
    }

    public function ajaxReply($type = null)
    {
        $id_to = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        if (!$id_to) {
            log_message('error', '(winks) Empty recipient id');
            $errors[] = l('error_unauthorized', 'winks');
        }
        if (is_null($type)) {
            $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        }
        if (empty($type)) {
            $type = 'replied';
        } elseif (!in_array($type, $this->Winks_model->types)) {
            log_message('error', '(winks) Wrong type');
            $this->view->assign('error');

            return false;
        }
        if (empty($errors)) {
            $wink = $this->Winks_model->getByPair($this->session->userdata('user_id'), $id_to);
            $wink['id_from'] = $this->session->userdata('user_id');
            $wink['id_to'] = $id_to;
            $wink['type'] = $type;
            $wink['is_viewed'] = 0;
            $result = $this->Winks_model->save($wink, $wink['id']);
            if ($result) {
                $this->view->assign(['success' => 'ok']);
            } else {
                $this->view->assign(['error' => 'error']);
            }
        } else {
            $this->view->assign($errors);
        }
    }

    private function getCriteria($search_string, $except_ids = null)
    {
        $params = [];
        if (empty($search_string)) {
            return $params;
        }

        if ($this->pg_module->get_module_config('users', 'hide_user_names')) {
            $params['where']['nickname LIKE'] = '%' . $search_string . '%';
        } else {
            $search_string_escape = $this->db->escape('%' . $search_string . '%');
            $params['where_sql'][] = '(nickname LIKE ' . $search_string_escape
                . ' OR fname LIKE ' . $search_string_escape
                . ' OR sname LIKE ' . $search_string_escape . ')';
        }
        if (!empty($except_ids)) {
            $params['where_sql'][] = 'id NOT IN (' . implode(', ', $except_ids) . ')';
        }

        return $params;
    }

    private function searchFriendlist($search_string, $except_ids)
    {
        $return = [];
        $return['all'] = 0;
        $this->load->model('Friendlist_model');
        $friends_ids = $this->Friendlist_model->get_friendlist_users_ids($this->session->userdata('user_id'));
        if (empty($friends_ids)) {
            return $return;
        }
        $params = $this->getCriteria($search_string, $except_ids);
        $params['where_in']['id'] = $friends_ids;

        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $return['all'] = $this->Users_model->get_users_count($params);
        if ($return['all']) {
            $this->load->model('Users_model');
            $return['items'] = $this->Users_model->get_users_list_by_key(1, $items_on_page, ['nickname' => 'asc'], $params, [], true, true);
        } else {
            $return['items'] = [];
        }

        return $return;
    }

    private function searchFriends($search_string, $except_ids)
    {
        if ($this->pg_module->is_module_installed('friendlist')) {
            return $this->searchFriendlist($search_string, $except_ids);
        }
    }

    public function ajaxGetUsersData()
    {
        $search_string = $this->input->post('search', true);

        $winkers_ids = $this->Winks_model->get_winkers($this->session->userdata('user_id'));
        $return = $this->searchFriends($search_string, $winkers_ids);
        if (!empty($return)) {
            $except_ids = array_merge($winkers_ids, array_keys($return['items']));
            $except_ids[] = $this->session->userdata('user_id');
            $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
            if ($return['all'] < $items_on_page) {
                $items_on_page -= $return['all'];
                $params = $this->getCriteria($search_string, $except_ids);

                $items = $this->Users_model->get_users_list(1, $items_on_page, ['nickname' => 'asc'], $params, [], true, true);

                foreach ($items as $user) {
                    $return['items'][] = $user;
                }
                $return['all'] += $this->Users_model->get_users_count($params);
            }
        }

        $this->view->assign($return);
    }
}
