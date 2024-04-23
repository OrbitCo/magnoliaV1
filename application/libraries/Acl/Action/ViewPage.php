<?php

namespace Pg\Libraries\Acl\Action;

use Pg\Libraries\View;
use Pg\Libraries\Acl\Action;
use Pg\Libraries\Acl\Resource;

class ViewPage extends Action
{
    /**
     * Action gid.
     *
     * @var string
     */
    protected $gid = 'view_page';

    /**
     * Denied callback.
     */
    public function onDenied()
    {
        $ci = get_instance();
        if ($ci->router->is_admin_class) {
            // TODO: Add onDeniedINstaller or something
            $this->onDeniedAdmin();
        } else {
            $this->onDeniedUser();
        }
    }

    /**
     * Callback for admin.
     */
    protected function onDeniedAdmin()
    {
        $ci = get_instance();
        $res_login_page = new Resource\Page(
            ['module' => 'ausers', 'controller' => 'admin_controller', 'action' => 'login']
        );
        if ($ci->acl->checkSimple($this->gid, $res_login_page->getResourceType(), $res_login_page->getResourceId())) {
            $ci->view->setRedirect(site_url() . 'admin/ausers/login');
        } else {
            $ci->view->setRedirect();
        }
    }

    protected function onDeniedUser()
    {
        $ci = get_instance();
        $res_login_page = new Resource\Page(
            ['module' => 'users', 'controller' => 'users', 'action' => 'login']
        );
        if (!isset($ci->session->userdata['auth_type']) && $ci->router->is_api_class) {
            $error = &load_class('Exceptions');
            $error->show_403();
        }

        if (($ci->router->is_api_class || $ci->input->is_ajax_request()) && $ci->is_pjax !== true) {
            $ci->load->library('user_agent');
            if ($ci->agent->is_referral()) {
                $ci->session->set_userdata(['service_redirect' => $ci->agent->referrer()]);
            }
        } else {
            $ci->session->set_userdata(['service_redirect' => current_url()]);
        }

        $is_ap = $ci->pg_module->is_module_active('access_permissions');
        if (($ci->router->is_api_class || $ci->input->is_ajax_request() || $_SERVER['HTTP_ACCEPT'] == 'application/json') && $ci->is_pjax !== true) {
            if ($ci->session->userdata('auth_type') == 'user') {
                $ci->load->helper('access_permissions');
                $denided_data = \Pg\modules\access_permissions\helpers\isModule(['is_ajax' => true]);
                if ($denided_data !== false) {
                    exit(json_encode(['info' => ['access_denied' => $denided_data]]));
                }
                exit(json_encode(['info' => [
                        'access_denied' => str_replace(
                            '%access_permissions_page%',
                            site_url('access_permissions'),
                            $ci->router->is_api_class ?
                                    l('info_action_change_group_new_tab', 'access_permissions') :
                                    l('info_action_change_group', 'access_permissions')
                        ),
                        ]]));
            }
            header('HTTP/1.0 403 Forbidden', true, 403);
            exit(json_encode(['errors' => 'ajax_login_link']));
        } elseif ($ci->acl->checkSimple($this->gid, $res_login_page->getResourceType(), $res_login_page->getResourceId())) {
            if ($ci->session->userdata('auth_type') == 'user') {
                if ($is_ap) {
                    $ci->system_messages->addMessage(View::MSG_INFO, l('info_view_change_group', 'access_permissions'));
                    $ci->view->setRedirect(site_url() . 'access_permissions/index', 'hard');
                } else {
                    $error = &load_class('Exceptions');
                    $error->show_403();
                }
            } else {
                $lang_id = $ci->session->userdata('lang_id');
                $ci->load->model('users/models/Auth_model');
                $ci->session->sess_destroy();
                $ci->session->sess_create();
                $ci->session->set_userdata('lang_id', $lang_id);

                $authorize_text = l('info_authorized_user', 'access_permissions');
                if ($authorize_text != 'info_authorized_user') {
                    $ci->system_messages->addMessage(View::MSG_INFO, $authorize_text);
                }

                $ci->view->setRedirect(site_url() . 'users/login_form', 'hard');
            }
        } else {
            if ($ci->session->userdata('auth_type') == 'user' && $is_ap) {
                $ci->system_messages->addMessage(View::MSG_INFO, l('info_view_change_group', 'access_permissions'));
                $ci->view->setRedirect(site_url() . 'access_permissions/index', 'hard');
            } else {
                $error = &load_class('Exceptions');
                $error->show_403();
            }
        }
    }
}
