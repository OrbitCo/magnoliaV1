<?php

declare(strict_types=1);

namespace Pg\modules\network\controllers;

use Pg\Libraries\View;
use Pg\modules\network\models\NetworkModel;

/**
 * Network admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 **/
class AdminNetwork extends \Controller
{

    /**
     * AdminNetwork constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Network_model']);
        $this->Menu_model->setMenuActiveItem('admin_menu', 'system-items');
    }

    /**
     * Save data
     *
     * @return array|false|null
     */
    private function saveData()
    {
        $post_data = NetworkModel::filterData();
        $this->load->model('network/models/Network_users_model');
        $errors = $this->Network_users_model->validateSettings($post_data);
        if (!empty($errors)) {
            $this->system_messages->addMessage(View::MSG_ERROR, $errors);
        } else {
            if (isset($post_data['is_upload_photos'])) {
                $post_data['is_upload_photos'] = $post_data['is_upload_photos'] ? 1 : 0;
            }
            $data = $this->Network_model->setConfig($post_data);
            if (false === $data) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('admin_error_save', NetworkModel::MODULE_GID));
            } else {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('admin_success_save', NetworkModel::MODULE_GID));
                if (!$this->Network_model->isRegistered()) {
                    $this->Network_model->setRegistered(true);
                    $this->view->setRedirect(site_url() . 'admin/network');
                    $this->view->render();
                }
            }
        }
        return $post_data;
    }

    /**
     * Format selected options
     *
     * @param array $form_params
     * @param array $selected
     *
     * @return array
     */
    private function formatSelectedOptions(array $form_params, array $selected): array
    {
        $form_params_selected = [];
        foreach ($form_params as $params) {
            foreach (array_keys($params) as $param) {
                if (isset($selected[$param])) {
                    $form_params_selected[$param] = $selected[$param];
                }
            }
        }
        return $form_params_selected;
    }

    /**
     * Index action
     */
    public function index()
    {
        $requirements = $this->Network_model->validateRequirementsCli();
        $this->view->assign('requirements', $requirements);

        $this->load->model('network/models/Network_users_model');
        if ($this->input->post('btn-save')) {
            $data = $this->saveData();
            $_SESSION['show_help'] = (bool) filter_input(INPUT_POST, 'show_help');
        } else {
            $data = $this->Network_users_model->getConfig();
        }
        $is_started = $this->Network_model->isStarted();
        if (!empty($data['domain']) && !empty($data['key'])) {
            $data_is_correct = $this->Network_model->checkAuthData($data['domain'], $data['key']);
        } else {
            if (empty($data['domain'])) {
                $data['domain'] = $this->Network_model->getDefaultDomain();
            }
            $data_is_correct = false;
        }
        $both_clients_started = $is_started[NetworkModel::CLIENT_FAST] && $is_started[NetworkModel::CLIENT_SLOW];
        if (!$data_is_correct && $both_clients_started) {
            $this->Network_model->stop();
        }
        $form_fields = $this->Network_users_model->getFormFields($this->pg_language->current_lang_id);
        $form_limits = $this->Network_users_model->getFormLimits();
        $selected_options = $this->formatSelectedOptions($form_fields, $data);

        $this->view->setHeader(l('admin_header_network', NetworkModel::MODULE_GID));
        $this->pg_theme->add_js('admin-network.js', NetworkModel::MODULE_GID);
        $this->view->assign('age_min', $this->pg_module->get_module_config('users', 'age_min'));
        $this->view->assign('age_max', $this->pg_module->get_module_config('users', 'age_max'));
        $this->view->assign('form_fields', $form_fields);
        $this->view->assign('selected_options', $selected_options);
        $this->view->assign('form_limits', $form_limits);
        $this->view->assign('back_url', site_url() . 'admin/start/menu/system-items');
        $this->view->assign('data_is_correct', $data_is_correct);
        $this->view->assign('clients_started', $both_clients_started);
        $this->view->assign('is_registered', $this->Network_model->isRegistered());
        $this->view->assign('show_help', isset($_SESSION['show_help']) && $_SESSION['show_help']);
        $this->view->assign('data', $data);
        // Logging should be enabled with threshold "debug" or "info".
        $this->view->assign('net_show_log', NetworkModel::NET_SHOW_LOG);
        $this->view->render('index');
    }

    /**
     * Start connection
     *
     * @return void
     */
    public function start()
    {
        $result = $this->Network_model->start();
        $response = [];
        if (empty($result[NetworkModel::CLIENT_SLOW])) {
            $response['error'][] = l('error_slow_service_start', 'network');
        }

        if (empty($result[NetworkModel::CLIENT_FAST])) {
            $response['error'][] = l('error_fast_service_start', 'network');
        }

        if (empty($errors)) {
            $response['success'][] = l('success_services_start', 'network');
        }

        $this->view->assign($response);
        $this->view->render();
    }

    /**
     * Stop connection
     *
     * @return void
     */
    public function stop()
    {
        $result = $this->Network_model->stop();
        $response = [];
        if (!$result[NetworkModel::CLIENT_SLOW]) {
            $response['error'][] = l('error_slow_service_stop', 'network');
        }
        if (!$result[NetworkModel::CLIENT_FAST]) {
            $response['error'][] = l('error_fast_service_stop', 'network');
        }

        if (empty($errors)) {
            $response['success'][] = l('success_services_stop', 'network');
        }

        $this->view->assign($response);
        $this->view->render();
    }

    /**
     * Process temp
     *
     * @return void
     */
    public function processTemp()
    {
        $this->load->model('network/models/Network_users_model');
        $this->Network_users_model->processTemp();
    }

    /**
     * Get status
     *
     * @return void
     */
    public function ajaxGetStatus()
    {
        $status = $this->Network_model->getStatus(20);
        $this->view->assign($status);
    }

    /**
     * Get access
     *
     * @throws \Exception
     *
     * @return void
     */
    public function getAccess()
    {
        $error = [];
        $current_data = $this->Network_model->getAuthData();
        if (!empty($current_data['domain'])) {
            $domain = $current_data['domain'];
        } else {
            $domain = $this->Network_model->getDefaultDomain();
        }
        if (!empty($current_data['key'])) {
            $key = $current_data['key'];
        } else {
            if (empty($domain)) {
                throw new \Exception('Empty domain');
            }
            $key_request = $this->Network_model->requestKey($domain);
            if (!empty($key_request[View::MSG_ERROR])) {
                $error[] = l('admin_error_' . $key_request[View::MSG_ERROR], 'network');
            }
            $key = $key_request['code'];
        }
        $is_correct = $key && $this->Network_model->checkAuthData($domain, $key);
        if ($is_correct) {
            $this->Network_model->setConfig([
                'key'    => $key,
                'domain' => $domain,
            ]);
        }
        $this->view->assign('access', [
            'domain'     => $domain,
            'key'        => $key,
            'is_correct' => $is_correct,
            'error'      => $error
        ]);
        $this->view->render();
    }

    /**
     * Unregister
     *
     * @return void
     */
    public function unregister()
    {
        $this->Network_model->unregister();
        $this->view->setRedirect('admin/network');
    }
}
