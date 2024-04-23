<?php

declare(strict_types=1);

namespace Pg\modules\favorites\controllers;

use Pg\Libraries\View;
use Pg\modules\blacklist\models\BlacklistModel;
use Pg\modules\users\models\UsersSearchIdsModel;

/**
 * Users lists controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Favorites extends \Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Favorites_model']);
    }

    private function view($tab = 'my_favs', $page = 1)
    {
        if (!in_array($tab, ['i_am_their_fav', 'my_favs'])) {
            show_404();
        }
        $list = [];
        $user_id = $this->session->userdata('user_id');
        $search = $this->input->post('search', true);
        $incoming = $tab === 'i_am_their_fav';
        if ($search) {
            $this->session->set_userdata('favorites_search', $search);
        } else {
            $search = $this->session->set_userdata('favorites_search', $search);
        }
        $order_by = ['date_add' => 'DESC'];
        $items_count = $this->Favorites_model->getListCount($user_id, $search, $incoming);

        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number(intval($page), $items_count, $items_on_page);
        if ($items_count) {
            $list = $this->Favorites_model->getList($user_id, $page, $items_on_page, $order_by, $search, true, $incoming);
        }

        $user_ids = [];
        if (!empty($list)) {
            foreach ($list as $s_user) {
                $user_ids[] = $s_user['user']['id'];
            }
        }
        UsersSearchIdsModel::updateUsersIdsEvent($user_ids);

        $url = site_url() . 'favorites/' . $tab . '/';
        $this->load->helper('navigation');
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');
        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        $page_data['date_time_format'] = $this->pg_date->get_format('date_time_literal', 'st');
        if ($search) {
            $items_count = $this->Favorites_model->getListCount($user_id, '', $incoming);
        }
        $this->Menu_model->breadcrumbs_set_active(l('favorites', 'favorites'));
        $this->view->assign('count', $items_count);
        $this->view->assign('search', $search);
        $this->view->assign('tab', $tab);
        $this->view->assign('page_data', $page_data);
        $this->view->assign('list', $list);
        $this->view->render('list');
    }

    public function index($page = 1)
    {
        $this->myFavs($page);
    }

    public function iAmTheirFav($page = 1)
    {
        $this->view('i_am_their_fav', $page);
    }

    public function myFavs($page = 1)
    {
        $this->view('my_favs', $page);
    }

    public function add($id_dest_user, $ajax = false)
    {
        $id_user = $this->session->userdata('user_id');

        $result = [];
        if ((new BlacklistModel())->isBlocked($id_dest_user, $id_user)) {
            if ($ajax != false) {
                $result['errors'] = l('you_in_blacklist', 'blacklist');
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, l('you_in_blacklist', 'blacklist'));
            }
        } else {
            $result = $this->Favorites_model->add($id_user, $id_dest_user);
        }

        if ($ajax != false) {
            return $result;
        }

        redirect(site_url() . 'favorites/index/');
    }

    public function remove($id_dest_user, $ajax = false)
    {
        $id_user = $this->session->userdata('user_id');
        $result = $this->Favorites_model->remove($id_user, intval($id_dest_user));
        if ($ajax) {
            return $result;
        }
        redirect(site_url() . 'favorites/index/');

        return true;
    }

    public function ajaxAdd($id_dest_user)
    {
        $result = $this->add($id_dest_user, true);
        $this->view->assign($result);
    }

    public function ajaxRemove($id_dest_user)
    {
        if ($this->remove($id_dest_user, true)) {
            $result = ['success' => l('success_favorites_remove', 'favorites')];
        } else {
            $result = ['errors' => 'error'];
        }
        $this->view->assign($result);
    }
}
