<?php

declare(strict_types=1);

namespace Pg\modules\favorites\controllers;

/**
 * Class ApiFavorites
 *
 * @package Pg\modules\favorites\controllers
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiFavorites extends \Controller
{
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Favorites_model');
        if ('user' === $this->session->userdata('auth_type')) {
            $this->user_id = (int)$this->session->userdata('user_id');
        }
    }

    public function index()
    {
        $this->favorites();
    }

    /**
    * @api {post} /favorites/favorites Get favorites page
    * @apiGroup Favorites
    * @apiParam {boolean} formatted  for return formated data
    * @apiParam {int} page  page count
    * @apiParam {string} action  action
    */
    public function favorites()
    {
        $action = trim(strip_tags((string) $this->input->post('action', true)));
        if (!$action) {
            $action = 'view';
        }

        $items_count = $this->Favorites_model->get_list_count($this->user_id);
        $list = [];
        if ($items_count) {
            $formatted = filter_input(INPUT_POST, 'formatted', FILTER_VALIDATE_BOOLEAN);
            $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
            $this->load->helper('sort_order');
            $page = get_exists_page_number(filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT), $items_count, $items_on_page);
            $list = $this->Favorites_model->get_list($this->user_id, $page, $items_on_page, ['date_update' => 'DESC'], '', $formatted);
        }

        $this->set_api_content('data', $list);
    }

    /**
    * @api {post} /favorites/count Get count favorites
    * @apiGroup Favorites
    */
    public function count()
    {
        $count = $this->Favorites_model->get_list_count($this->user_id);
        $this->set_api_content('data', $count);
    }

    /**
    * @api {post} /favorites/add Add in favorites
    * @apiGroup Favorites
    * @apiParam {int} id_dest_user id user
    */
    public function add()
    {
        $id_dest_user = (int)$this->input->post('id_dest_user');
        $this->Favorites_model->add($this->user_id, $id_dest_user);
        $data['success'] = l('success_favorites_add', 'favorites');
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /favorites/remove Remove from favorites
    * @apiGroup Favorites
    * @apiParam {int} id_dest_user id user
    */
    public function remove($id_dest_user)
    {
        $data = [];

        $id_user = $this->session->userdata('user_id');

        if ($id_dest_user) {
            $this->Favorites_model->remove($id_user, intval($id_dest_user));
            $data['success'] = l('success_favorites_remove', 'favorites');
        } else {
            $id_dest_user = $this->input->post('id_dest_user', true);
            if (!empty($id_dest_user)) {
                foreach ((array)$id_dest_user as $id) {
                    $this->Favorites_model->remove($id_user, $id);
                }
                $data['success'] = l('success_favorites_remove', 'favorites');
            }
        }

        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /favorites/get_status Get status user from favorites
    * @apiGroup Favorites
    * @apiParam {int} id_dest_user id user
    */
    public function get_status($id_dest_user)
    {
        $user_id = $this->session->userdata('user_id');

        // TODO: проверять в базе а не перебором
        if (in_array($id_dest_user, $this->Favorites_model->get_list_users_ids($user_id))) {
            $status = 1;
        } else {
            $status = 0;
        }

        $this->set_api_content('status', $status);
    }
}
