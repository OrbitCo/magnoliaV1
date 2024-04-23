<?php

declare(strict_types=1);

namespace Pg\modules\start\controllers;

use Pg\Libraries\View;

/**
 * Start user side controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <https://www.pilotgroup.net/>
 * */
class Start extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }

    public function index($page = null, $code = false)
    {
        \Pg\modules\users\models\UsersModel::siteVisits($this->session->userdata);
        $this->getHeaderImage();

        if ($this->session->userdata("auth_type") == "user" && $this->session->userdata('user_id')) {
            $this->homepage();
        } else {
            if (empty($page) && $this->pg_module->is_module_installed('landings')) {
                $this->load->model('Landings_model');
                $landing = $this->Landings_model->getLandingsList(null, null, null, ['where' => ['is_active' => 1, 'is_default_land' => 1]]);

                if ($landing) {
                    $landing[0]['upload_file'] = false;
                    if ($landing[0]['index_path']) {
                        $upload_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . 'landings/';
                        $land_index = $upload_path . $landing[0]['id'] . '/' . $landing[0]['index_path'];
                        if (file_exists($land_index)) {
                            $landing[0]['upload_file'] = true;
                        }
                    }

                    if ($landing[0]['upload_file'] || $landing[0]['url_page']) {
                        $this->view->setRedirect(site_url($landing[0]['link']));
                    }
                }
            }

            $this->load->model('Start_model');
            $template_name = $this->Start_model->templateName();
            $this->view->assign('mobile_url', $this->config->site_url() . 'm');
            $this->view->assign('use_pjax', 0);
            if (!empty($page) && $page === 'registration') {
                if (!empty($code) && strlen($code) === 15) {
                    $this->view->assign('referral_code', $code);
                }
                $this->view->assign('is_registration', 1);
            }
            $this->view->render($template_name);
        }
    }

    public function homepage()
    {
        $this->Menu_model->breadcrumbs_set_parent('user-main-home-item');
        $this->view->assign('user_id', $this->session->userdata('user_id'));
        $this->view->render('homepage');
    }

    /**
     * set assign style of header
     */
    public function getHeaderImage()
    {
        $id_set = $this->pg_theme->active_settings['user']['scheme_data']['id'];
        $header_image_array = json_decode($this->ci->pg_module->get_module_config('theme', 'header_image_' . $id_set) ?: '', true);
        if (!empty($header_image_array)) {
            $theme_default_url = $this->pg_theme->theme_default_url;
            $theme_name = $this->pg_theme->active_settings['user']['theme'];

            $header_style = $header_image_array;
            $header_style['base_path'] = $theme_default_url . $theme_name;
            $this->view->assign('header_style', $header_style);
        }
    }

    public function error()
    {
        header("HTTP/1.0 404 Not Found");
        $this->Menu_model->breadcrumbs_set_active(l('header_error', 'start'));
        $this->view->assign('header_type', 'error_page');
        $this->view->render('error');
    }

    public function printVersion()
    {
        echo $this->pg_module->get_module_config('start', 'product_version');
    }

    // test methods
    public function testFileUpload()
    {
        $this->load->model("file_uploads/models/File_uploads_config_model");

        $configs = $this->File_uploads_config_model->get_config_list();
        $this->view->assign('configs', $configs);

        if ($this->input->post('btn_save') && $this->input->post('config')) {
            $config = $this->input->post('config');
            $file_name = 'file';

            if (isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
                $this->load->model("File_uploads_model");
                $return = $this->File_uploads_model->upload($config, '', $file_name);

                if (!empty($return["errors"])) {
                    $this->system_messages->addMessage(View::MSG_ERROR, $return["errors"]);
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, $return["file"]);
                }
            }
        }

        $this->view->render('test_file_upload');
    }

    public function ajaxBackend()
    {
        $data = (array)$this->input->post('data');

        $user_session_id = 0;
        if ($this->session->userdata('auth_type') == 'user') {
            $user_session_id = intval($this->session->userdata('user_id'));
            if ($this->session->userdata('online_status') == 0) {
                $this->Users_model->updateOnlineStatus($user_session_id, 1);
            }
        }
        $return_arr = ['user_session_id' => $user_session_id];

        $this->load->model('start/models/StartDesktopNotificationsModel');
        foreach ($data as $gid => $params) {
            if ($this->StartDesktopNotificationsModel->isNotification($gid) === false) {
                continue;
            }

            $return_arr[$gid] = [];
            if (empty($params['module']) || empty($params['model']) || empty($params['method'])) {
                continue;
            }

            if (!$this->pg_module->is_module_installed($params['module'])) {
                continue;
            }

            $model = $gid . 'BackendModel';
            $method = $params['method'];
            $this->load->model($params['module'] . '/models/' . $params['model'], $model, false, true, true);

            $return_arr[$gid] = $this->{$model}->{$method}($params);
            $return_arr[$gid]['user_session_id'] = $user_session_id;
        }

        $this->view->assign($return_arr);

    }

    public function aclCheck()
    {
        $url_data = explode('/', filter_input(INPUT_POST, 'url_data'));
        $module = $url_data[0];
        $action = $url_data[1];
        $errors = [];
        if (empty($module)) {
            $errors[] = 'Empty module';
            if (empty($action)) {
                $errors[] = 'Empty action';
            }
        }
        $allowed = false;
        if (empty($errors)) {
            $allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => $module, 'controller' => $module, 'action' => $action,]
                )
            ), false);
        }
        $this->view->assign(View::MSG_ERROR, $errors);
        $this->view->assign('is_allowed', $allowed);
        $this->view->render();
    }
}
