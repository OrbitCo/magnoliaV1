<?php

declare(strict_types=1);

namespace Pg\modules\users\controllers;

use Pg\Libraries\Analytics;
use Pg\Libraries\EventDispatcher;
use Pg\Libraries\View;
use Pg\modules\users\models\events\EventUsers;
use Pg\modules\users\models\UsersModel;

/**
 * Users user side controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class Users extends \Controller
{
    /**
     * link to CodeIgniter object
     *
     * @var object
     */
    public $use_email_confirmation = false;
    public $use_approve = false;
    protected $user_id = 0;
    protected $subsections = [
        'default' => 'all',
        'photo',
        'video',
        'audio',
        'albums',
        'favorites'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model(["Users_model", "Menu_model"]);
        $this->use_email_confirmation = (bool)$this->ci->pg_module->get_module_config('users', 'user_confirm');
        $this->use_approve = (bool)$this->ci->pg_module->get_module_config('users', 'user_approve');
        if ('user' === $this->ci->session->userdata('auth_type')) {
            $this->user_id = (int)$this->ci->session->userdata('user_id');
        }
    }

    public function ajaxLoginForm()
    {
        $this->load->library('user_agent');
        if ($this->agent->is_referral()) {
            $this->session->set_userdata(['service_redirect' => $this->agent->referrer()]);
        }
        $this->view->render('ajax_login_form');
    }

    public function loginForm()
    {
        $this->Menu_model->breadcrumbsSetActive(l('header_login', 'users'));
        if (!empty($this->user_id)) {
            $this->view->setRedirect(site_url('users/search'));
        }
        $this->load->library('user_agent');
        if ($this->agent->is_referral()) {
            $this->session->set_userdata(['service_redirect' => $this->agent->referrer()]);
        }

        $this->view->render('login_form');
    }

    public function login()
    {
        if (!empty($this->user_id)) {
            $this->view->setRedirect('users/search', 'hard');
        }

        $errors = [];

        $this->load->model("users/models/Auth_model");

        $data = [
            "email" => trim(strip_tags($this->input->post('email', true))),
            "password" => trim(strip_tags($this->input->post('password', true))),
        ];

        $validate = $this->Auth_model->validateLoginData($data);

        if (!empty($validate["errors"])) {
            $errors = array_merge($errors, $validate["errors"]);
        } else {
            $login_return = $this->Auth_model->loginByEmailPassword($validate["data"]["email"], $validate["data"]["password"]);
            if (!empty($login_return["errors"])) {
                $errors = array_merge($errors, $login_return["errors"]);
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                $this->system_messages->addMessage(View::MSG_ERROR, $error);
            }
            if (isset($login_return['user_data']['confirm']) && !$login_return['user_data']['confirm']) {
                $this->view->setRedirect(site_url() . 'users/confirm', 'hard');
            } else {
                $this->view->setRedirect(site_url() . 'users/login_form');
            }
        }

        $this->session->set_flashdata('js_events', 'users:login');

        $this->load->library('Analytics');
        if ($this->input->post('ajax_modal', true)) {
            $this->analytics->track('user_modal_login_success', ['controller' => 'users']);
        } else {
            $this->analytics->track('user_form_login_success', ['controller' => 'users']);
        }

        if ($this->session->userdata('service_redirect') &&
            $this->session->userdata('service_redirect') != site_url() &&
            $this->session->userdata('service_redirect') != site_url() . 'users/login') {
            $this->view->setRedirect($this->session->userdata('service_redirect'), 'hard');
        } else {
            if (PRODUCT_NAME == 'social') {
                $this->view->setRedirect('', 'hard');
            } else {
                $this->view->setRedirect('users/search', 'hard');
            }
        }
    }

    public function logout()
    {
        $this->load->model("users/models/Auth_model");

        // перенесено в Аuth_model->logoff
        //$this->Users_model->updateOnlineStatus($this->user_id, 0);

        $lang_id = $this->session->userdata('lang_id');
        $this->Auth_model->logoff();
        $this->clearCookies('available_activation');
        $this->session->sess_create();
        if ($this->session->userdata('lang_id') != $lang_id) {
            $this->session->set_userdata("lang_id", $lang_id);
        }
        $this->session->set_flashdata('js_events', 'users:logout');

        if ($this->pg_module->is_module_installed('logout_page')) {
            $this->load->model('logout_page/models/Logout_page_model');
            $logout_page = $this->Logout_page_model->getRandomPage();
            if (isset($logout_page['gid'])) {
                redirect(site_url() . 'logout_page/index/' . $logout_page['gid']);
            }
        }

        redirect('', 'hard');
    }

    public function changeLanguage($lang_id)
    {
        $lang_id = (int)$lang_id;
        $this->session->set_userdata("lang_id", $lang_id);
        $old_code = $this->pg_language->languages[$this->pg_language->current_lang_id]["code"];
        $this->pg_language->current_lang_id = $lang_id;
        $code = $this->pg_language->languages[$lang_id]["code"];
        $_SERVER["HTTP_REFERER"] = str_replace("/" . $old_code . "/", "/" . $code . "/", $_SERVER["HTTP_REFERER"]);
        $site_url = str_replace("/" . $code . "/", "", site_url());

        $auth_type = $this->session->userdata('auth_type');

        switch ($auth_type) {
            case 'admin':
                if ($this->pg_module->is_module_installed('ausers')) {
                    $this->load->model('Ausers_model');
                    $save_data['lang_id'] = $lang_id;
                    $this->Ausers_model->saveUser($this->session->userdata('user_id'), $save_data);
                }

                break;
            case 'user':
                $save_data['lang_id'] = $lang_id;
                $this->Users_model->save_user($this->user_id, $save_data);

                break;
        }

        if (strpos($_SERVER["HTTP_REFERER"], $site_url) !== false) {
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            redirect();
        }
    }

    public function settings($page = 'email')
    {
        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($this->user_id);

        $user = $this->Users_model->getUserById($this->user_id);
        if (!$user['confirm'] && $page != 'email') {
            $this->load->helper('seo');
            $url = rewrite_link('users', 'settings', 'email');
            $this->system_messages->addMessage(View::MSG_INFO, l('info_please_checkout_mailbox', 'users'));
            redirect($url);
        }

        switch ($page) {
            case 'adult':
                if ($this->input->post('btn_save')) {
                    $post_data = ['show_adult' => filter_input(INPUT_POST, 'show_adult', FILTER_VALIDATE_INT)];
                    $validate_data = $this->Users_model->validate($this->user_id, $post_data);
                    if (!empty($validate_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                    } else {
                        $user_data = $this->Users_model->getUserById($this->user_id);
                        $this->Users_model->saveUser($this->user_id, $validate_data["data"]);
                        $this->Auth_model->updateUserSessionData($this->user_id);
                        $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_user_updated', 'users'));
                    }
                }

                break;
            case 'notifications':
                $this->load->model(['notifications/models/Notifications_users_model',
                    'start/models/Start_desktop_notifications_model']);
                if ($this->input->post('btn_save')) {
                    $user_notifications = $this->input->post('notification', true);
                    if ($this->pg_module->get_module_config('users', 'user_advanced_email_validate')) {
                        $user_data = $this->Users_model->getUserById($this->user_id);
                        if ($user_data['checked_email'] && !$user_data['valid_email'] && !empty($user_notifications)) {
                            $user_notifications = null;
                            $this->session->set_userdata('is_not_valid_email_show', 0);
                            $this->load->helper('users');
                            $this->view->assign('not_valid_email_show', incorrect_email());
                        }
                    }
                    $this->Notifications_users_model->saveUserNotifications($this->user_id, $user_notifications);
                }
                $notifications_gids = $this->Notifications_users_model->getUserNotifications($this->user_id);
                $this->view->assign('notifications_gids', $notifications_gids);
                if ($this->input->post('btn_save_desctop')) {
                    $user_desktop_notifications = $this->input->post('desktop_notification', true);
                    $this->Start_desktop_notifications_model->saveUserNotifications($this->user_id, $user_desktop_notifications);
                }
                $desktop_notifications_gids = $this->Start_desktop_notifications_model->getUserNotifications($this->user_id);
                $this->view->assign('desktop_notifications_gids', $desktop_notifications_gids);

                break;
            case 'subscriptions':
                if ($this->input->post('btn_subscriptions_save')) {
                    $user_subscriptions_list = $this->input->post('user_subscriptions_list', true);
                    $this->load->model('subscriptions/models/Subscriptions_users_model');
                    $this->Subscriptions_users_model->saveUserSubscriptions($this->user_id, $user_subscriptions_list);
                }

                break;
            case 'delete_account':
                if ($this->pg_module->is_module_installed('services')) {
                    $this->load->model('Services_model');
                    if ($this->Services_model->isServiceActive('ability_delete') === 0) {
                        show_404();
                    }
                }

                break;
            default:
                if ($this->input->post('btn_contact_save')) {
                    $post_data = [
                        "email" => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                        "email_confirmation_code" => filter_input(INPUT_POST, 'email_confirmation_code', FILTER_SANITIZE_STRING),
                        //"phone" => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING)
                    ];

                    $validate_data = $this->Users_model->validate($this->user_id, $post_data);
                    if (!empty($validate_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                    } else {
                        $user_data = $this->Users_model->getUserById($this->user_id);
                        $new_email = false;
                        $validate_code_error = false;
                        $confirmed_email = false;

                        if ($user_data["email"] !== $validate_data["data"]["email"]) {
                            $code = substr(md5(date("Y-m-d H:i:s") . $user_data['id'] . $validate_data["data"]["email"]), 0, 15);
                            if (isset($validate_data["data"]["email_confirmation_code"]) && !empty($validate_data["data"]["email_confirmation_code"])) {
                                $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_no_exists_confirm_code', 'users'));
                                unset($validate_data["data"]["email_confirmation_code"]);
                                $validate_code_error = true;
                            }
                            $validate_data["data"]["code"] = $code;
                            $validate_data["data"]["changed_email"] = $user_data["email"];
                            $validate_data["data"]["valid_email"] = 0;
                            $new_email = true;
                        } else {
                            if (isset($validate_data["data"]["email_confirmation_code"])) {
                                if ($validate_data["data"]["email_confirmation_code"] == $user_data['confirm_code_new_email']) {
                                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_email_confirm', 'users'));
                                    $validate_data["data"]["valid_email"] = 1;
                                    $validate_data["data"]["checked_email"] = 0;
                                    $validate_data["data"]["last_checked_email_date"] = date(UsersModel::DB_DATE_FORMAT);
                                    $validate_data["data"]['confirm'] = 1;
                                    if (!$user_data['confirm']) {
                                        $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_confirm', 'users'));
                                    }
                                    unset($validate_data["data"]["email_confirmation_code"]);
                                    $confirmed_email = true;
                                } else {
                                    $validate_code_error = true;
                                    $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_no_exists_confirm_code', 'users'));
                                }
                            }
                        }
                        if (!$validate_code_error) {
                            $this->Users_model->saveUser($this->user_id, $validate_data["data"]);

                            if ($new_email) {
                                $this->load->model('Notifications_model');
                                $user_data["old_email"] = $user_data["email"];
                                $user_data = array_merge($user_data, $validate_data["data"]);
                                $user_data["fname"] = UsersModel::formatUserName($user_data);
                                $this->Notifications_model->sendNotification($user_data["email"], 'users_change_email_confirm', $user_data, '', $user_data['lang_id']);
                                $temp_data = $user_data;
                                if ($this->pg_module->is_module_installed('tickets')) {
                                    $temp_data['tickets'] = "<a href=\"" . site_url() . "tickets" . "\" target=\"_blank\">" . l('header_contact_us_form', 'contact_us') . "</a>";
                                } else {
                                    $temp_data['tickets'] = "<a href=\"" . site_url() . "contact_us" . "\">" . l('header_contact_us_form', 'contact_us') . "</a>";
                                }
                                $this->Notifications_model->sendNotification($user_data["old_email"], 'users_change_email', $temp_data, '', $user_data['lang_id']);
                                $this->system_messages->addMessage(View::MSG_SUCCESS, l('text_confirm', 'users'));
                            }

                            $this->Auth_model->updateUserSessionData($this->user_id);
                            if (!$confirmed_email) {
                                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_user_updated', 'users'));
                            }
                        }
                    }
                }
                $use_repassword = $this->pg_module->get_module_config('users', 'use_repassword');
                if ($this->input->post('btn_password_save')) {
                    $post_data = ['password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)];
                    if ($use_repassword) {
                        $post_data['repassword'] = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);
                    }
                    $validate_data = $this->Users_model->validate($this->user_id, $post_data);
                    if (!empty($validate_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $validate_data["errors"]);
                    } else {
                        $save_data = $validate_data["data"];
                        $save_password = $save_data["password"];
                        $save_data["password"] = password_hash($save_data["password"], PASSWORD_DEFAULT);
                        $this->Users_model->saveUser($this->user_id, $save_data);
                        $this->load->model('Notifications_model');
                        $user_data = $this->Users_model->getUserById($this->user_id);
                        $user_data["password"] = $save_password;
                        $user_data["fname"] = UsersModel::formatUserName($user_data);
                        $user_data['contact_us'] = $this->ci->pg_module->is_module_installed('tickets') ? site_url('tickets') : site_url('contact_us');
                        $this->Notifications_model->sendNotification($user_data["email"], 'users_change_password', $user_data, '', $user_data['lang_id']);
                        $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_user_updated', 'users'));
                    }
                }
                $this->view->assign('use_repassword', $use_repassword);
        }

        $user = $this->Users_model->getUserById($this->user_id);
        $this->pg_seo->set_seo_data($user);

        $this->load->helper('seo');
        $this->session->set_userdata(['service_redirect' => rewrite_link('users', 'settings')]);

        // breadcrumbs
        $this->Menu_model->breadcrumbsSetParent('settings-item');
        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('user', $user);
        $this->view->assign('page', ['gid' => $page]);
        $this->view->render('settings');
    }

    public function account($action = 'services', $page = 1)
    {
        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($this->user_id);
        $user = $this->Users_model->getUserById($this->user_id);
        $this->pg_seo->set_seo_data($user);

        // breadcrumbs
        $this->Menu_model->breadcrumbsSetParent('account-item');

        $this->load->helper('seo');
        $this->setAccountMenu($action);

        $this->view->assign('page', $page);
        $this->view->assign('action', $action);
        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('user', $user);
        $this->view->render('account');
    }

    protected function setAccountMenu($action)
    {
        switch ($action) {
            case 'services':
                $this->session->set_userdata(['service_redirect' => rewrite_link('users', 'account', ['action' => 'services'])]);
                $this->session->set_userdata(['service_activate_redirect' => rewrite_link('users', 'account', ['action' => 'services'])]);
                $this->Menu_model->breadcrumbsSetActive(l('header_services', 'users'));

                break;
            case 'update':
                $this->Menu_model->breadcrumbsSetActive(l('header_account_update', 'users'));

                break;
            case 'payments_history':
                $this->Menu_model->breadcrumbsSetActive(l('header_my_payments_statistic', 'payments'));

                break;
            case 'banners':
                $this->Menu_model->breadcrumbsSetActive(l('header_my_banners', 'banners'));

                break;
            case 'memberships':
                $this->Menu_model->breadcrumbsSetActive(l('header_memberships', 'users'));

                break;
            case 'donate':
                $this->Menu_model->breadcrumbsSetActive(l('donate', 'start'));

                break;
        }
    }

    public function ajaxViewMapUserLocation()
    {
        $return = ["errors" => "", "html" => ""];

        if (!$this->pg_module->is_module_installed('geomap')) {
            $this->view->assign($return);

            return false;
        }

        $id_user = $this->input->post('id', true);
        $load_map_scripts = $this->input->post('load_map_scripts', true);

        if ($id_user) {
            $user = $this->Users_model->getUserById($id_user, true);

            $markers[] = [
                'gid' => $user['id'],
                'country' => $user['country'],
                'region' => $user['region'],
                'city' => $user['city'],
                'address' => $user['address'],
                'lat' => (float)$user['lat'],
                'lon' => (float)$user['lon'],
                'info' => $user['output_name'] . ", " . $user['age'],
            ];
            $this->view->assign('markers', $markers);
            $this->view->assign('header', $user["location"]);
            $this->view->assign('load_map_scripts', $load_map_scripts);

            $return['html'] = $this->view->fetch('ajax_view_map_user_location', 'user', 'users');
        }
        $this->view->assign($return);
    }

    public function profile($profile_section = '', $subsection = 'all')
    {
        $this->view->assign('magazine_close_url', magazine_close_url());
        $this->view->assign('is_user_owner', 1);

        $subsection = trim(strip_tags($subsection));
        if (!$profile_section) {
            $profile_section = $this->pg_module->is_module_installed('wall_events') ? 'wall' : 'view';
        }
        if ($profile_section == 'gallery' && !in_array($subsection, $this->subsections)) {
            $subsection = $this->subsections['default'];
        }

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');

        $this->load->model('Field_editor_model');
        $this->Field_editor_model->initialize($this->Users_model->form_editor_type);
        $fields_for_select = [];
        $sections = [];
        if ($profile_section != 'view' && $profile_section != 'wall' && $profile_section != 'gallery' && $profile_section != 'subscriptions') {
            $section = $this->Field_editor_model->getSectionByGid($profile_section);
            if (!empty($section)) {
                $fields_for_select = $this->Field_editor_model->get_fields_for_select($section['gid']);
            }
            $page_data['form_action'] = site_url() . 'users/profile/' . $profile_section;
        } elseif ($profile_section == 'view') {
            $sections = $this->Field_editor_model->getSectionList();
            $sections_gids = array_keys($sections);
            $fields_for_select = $this->Field_editor_model->getFieldsForSelect($sections_gids);
        }
        $this->Users_model->setAdditionalFields($fields_for_select);

        $data = $this->Users_model->getUserById($this->user_id);
        if ($this->Users_model->is_couples_installed === true && $data['couple_id']) {
            $data['couple'] = $this->Users_model->getUserById($data['couple_id']);
        }

        if ($this->input->post('btn_register')) {
            $post_data = [];
            $validate_section = null;

            if ($profile_section == 'personal') {
                $post_data = [
                    'nickname' => $this->input->post('nickname', true),
                    'fname' => $this->input->post('fname', true),
                    'sname' => $this->input->post('sname', true),
                    'id_country' => $this->input->post('id_country', true),
                    'id_region' => $this->input->post('id_region', true),
                    'id_city' => $this->input->post('id_city', true),
                    'birth_date' => $this->input->post('birth_date', true),
                    'lat' => $this->input->post('lat', true),
                    'lon' => $this->input->post('lon', true),
                ];

                if ($this->Users_model->is_couples_installed === true && $data['couple_id']) {
                    foreach (\Pg\modules\couples\models\CouplesModel::$personal_fields as $f => $cf) {
                        $post_data[$f] = $this->input->post($f, true);
                    }
                }

                if ($pm_installed) {
                    $post_data['looking_user_type'] = $this->input->post('looking_user_type', true);
                    $post_data['age_min'] = $this->input->post('age_min', true);
                    $post_data['age_max'] = $this->input->post('age_max', true);
                }
            } else {
                foreach ($fields_for_select as $field) {
                    $post_data[$field] = $this->input->post($field, true);
                    if ($this->Users_model->is_couples_installed === true && $data['couple_id']) {
                        \Pg\modules\couples\models\CouplesModel::addPersonalFields($fields_for_select);
                        $post_data[$field . \Pg\modules\couples\models\CouplesModel::POSTFIX] = $this->input->post($field . \Pg\modules\couples\models\CouplesModel::POSTFIX, true);
                    }
                }
                $validate_section = $profile_section;
            }
            $validate_data = $this->Users_model->validate($this->user_id, $post_data, 'user_icon', $validate_section);
            if (!empty($validate_data['errors'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                $data = array_merge($data, $post_data);
            } else {
                if ($this->input->post('user_icon_delete') || (isset($_FILES['user_icon']) &&
                        is_array($_FILES['user_icon']) && is_uploaded_file($_FILES['user_icon']['tmp_name']))) {
                    $this->load->model('Uploads_model');
                    if ($data['user_logo_moderation']) {
                        $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id, $data['user_logo_moderation'], UsersModel::ORIGINAL_IMG_PATH);
                        $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id, $data['user_logo_moderation']);
                        $validate_data['data']['user_logo'] = '';
                        $validate_data['data']['user_logo_moderation'] = '';
                        $this->load->model('menu/models/Indicators_model');
                        $this->Indicators_model->delete('new_moderation_item', $this->user_id, true);
                    } elseif ($data['user_logo']) {
                        $validate_data['data']['user_logo'] = '';
                    }
                    $this->load->model('Moderation_model');
                    $this->Moderation_model->deleteModerationItemByObj($this->Users_model->moderation_type[0], $this->user_id);
                    $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id, $data['user_logo']);
                }
                if ($this->Users_model->saveUser($this->user_id, $validate_data['data'], 'user_icon')) {
                    if ($this->Users_model->is_couples_installed === true) {
                        if (!empty($validate_data['couple'])) {
                            $this->load->model("Couples_model");
                            $this->Couples_model->saveUser($validate_data['couple'], 'user_icon');
                        }
                    }
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_user', 'users'));
                }

                $this->load->model('users/models/Auth_model');
                $this->Auth_model->updateUserSessionData($this->user_id);

                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                if ($subsection != 'all') {
                    $seo_data['subsection'] = $subsection;
                    $seo_data['subsection-code'] = $subsection;
                    $seo_data['subsection-name'] = l($subsection, 'media');
                }

                $this->load->helper('seo');
                $url = rewrite_link('users', 'profile', 'view');
                redirect($url);
            }
        }

        $this->view->assign('action', $profile_section);

        $lang_id = $this->pg_language->current_lang_id;
        $data = $this->Users_model->formatUser($data, false, $lang_id);
        $data['have_avatar'] = ($data['user_logo'] || $data['user_logo_moderation']);

        if (empty($data['activity'])) {
            $data['available_activation'] = $this->Users_model->checkAvailableUserActivation($this->user_id);
            $service_status = $this->Users_model->serviceAvailableUserActivateInSearchAction($this->user_id);
            if (!$service_status["content_buy_block"] && $data['have_avatar'] && $data['id_region']) {
                $data['activity'] = 1;
            }
        }
        if ($profile_section == 'view') {
            foreach ($sections as $sgid => $sdata) {
                $params["where"]["section_gid"] = $sgid;
                $sections[$sgid]['fields'] = $this->Field_editor_model->formatItemFieldsForView($params, $data, '', true);
                if ($this->Users_model->is_couples_installed === true && !empty($data['couple'])) {
                    $sections[$sgid]['couple']['fields'] = $this->Field_editor_model->formatItemFieldsForView($params, $data['couple']);
                }
            }
        } elseif (!empty($section)) {
            $params["where"]["section_gid"] = $section['gid'];
            $fields_data = $this->Field_editor_model->getFormFieldsList($data, $params);
            $this->view->assign('fields_data', $fields_data);
            if ($this->Users_model->is_couples_installed === true && !empty($data['couple'])) {
                $fields_data_couple = $this->Field_editor_model->getFormFieldsList($data['couple'], $params);
                $this->view->assign('fields_data_couple', $fields_data_couple);
            }
        }
        if ($profile_section == 'personal') {
            $this->load->model('Properties_model');
            $user_types = $this->Properties_model->getProperty('user_type');
            $this->view->assign('user_types', $user_types);
            $age_range = range($this->pg_module->get_module_config('users', 'age_min'), $this->pg_module->get_module_config('users', 'age_max'));
            $this->view->assign('age_range', $age_range);
        }

        $this->load->helper('seo');

        if ($profile_section == 'gallery') {
            $gallery_filters = [];

            foreach ($this->subsections as $subsection_code) {
                $subsection_name = l($subsection_code, 'media');

                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                $seo_data['subsection'] = $subsection_code;
                $seo_data['subsection-code'] = $subsection_code;
                $seo_data['subsection-name'] = $subsection_name;
                $subsection_link = rewrite_link('users', 'view', $seo_data);
                $gallery_filters[$subsection_code] = ['link' => $subsection_link, 'name' => $subsection_name];
            }

            $this->view->assign('gallery_filters', $gallery_filters);

            $location_base_url = function ($subsection_code, $subsection_name) use ($data, $profile_section) {
                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                $seo_data['subsection'] = $subsection_code;
                $seo_data['subsection-code'] = $subsection_code;
                $seo_data['subsection-name'] = $subsection_name;

                $subsection_link = rewrite_link('users', 'profile', $seo_data);

                return $subsection_link;
            };
            $this->view->assign('location_base_url', $location_base_url);
        }

        $this->pg_seo->set_seo_data($data);

        if (!empty($section)) {
            $section_name = $section['name'];
        } else {
            $section_name = l("filter_section_" . $profile_section, "users");
        }

        // breadcrumbs
        $this->Menu_model->breadcrumbsSetParent('my-profile-item');
        $this->Menu_model->breadcrumbsSetActive($section_name);

        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        $page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');

        $not_editable_fields = $this->Users_model->fields_not_editable;
        foreach ($not_editable_fields as $field) {
            $not_editable_fields[$field] = 1;
        }

        $data['services_status'] = $this->Users_model->servicesStatus($data);

        if (!empty($data['services_status']['user_activate_in_search']) && $data['services_status']['user_activate_in_search']['status'] == 1) {
            if (strtotime($data['activated_end_date']) > date("U")) {
                $data['activity_in_search'] = 1;
            } else {
                $data['activity_in_search'] = 0;
            }
        } else {
            $data['services_status']['user_activate_in_search']['status'] = 0;
        }
        $is_services_button = false;
        $services = ['highlight_in_search', 'up_in_search', 'hide_on_site'];
        foreach ($services as $service) {
            if (!empty($data['services_status'][$service]) && $data['services_status'][$service]['status'] == 1) {
                $is_services_button = true;

                continue;
            }
        }
        $this->view->assign('is_services_button', $is_services_button);
        if ($profile_section == 'gallery') {
            $gallery_filters = [];

            foreach ($this->subsections as $subsection_code) {
                $subsection_name = l($subsection_code, 'media');

                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                $seo_data['subsection'] = $subsection_code;
                $seo_data['subsection-code'] = $subsection_code;
                $seo_data['subsection-name'] = $subsection_name;
                $subsection_link = rewrite_link('users', 'profile', $seo_data);
                $gallery_filters[$subsection_code] = ['link' => $subsection_link, 'name' => $subsection_name];
            }

            $this->view->assign('gallery_filters', $gallery_filters);
        }

        $seo_data = $data;
        $seo_data['section'] = $profile_section;
        $seo_data['section-code'] = $profile_section;
        $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

        if ($subsection != 'all') {
            $seo_data['subsection'] = $subsection;
            $seo_data['subsection-code'] = $subsection;
            $seo_data['subsection-name'] = l($subsection, 'media');
        }

        $url = rewrite_link('users', 'profile', $seo_data);
        $location_full_url = rewrite_link('users', 'profile', $seo_data);
        $this->session->set_userdata(['service_redirect' => $location_full_url]);

        if ($pm_installed) {
            $age_min = $this->pg_module->get_module_config('users', 'age_min');
            $age_max = $this->pg_module->get_module_config('users', 'age_max');
            $this->view->assign('age_min', $age_min);
            $this->view->assign('age_max', $age_max);
        } else {
            $not_editable_fields['looking_user_type'] = 1;
            $not_editable_fields['age_min'] = 1;
            $not_editable_fields['age_max'] = 1;
            $not_editable_fields['birth_date'] = 1;
        }

        $this->view->assign('not_editable_fields', $not_editable_fields);
        $this->view->assign('page_data', $page_data);
        $this->view->assign('sections', $sections);
        $this->view->assign('subsection', $subsection);
        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('edit_mode', 1);

        if ($this->Users_model->is_couples_installed === true) {
            if ($data['user_type'] === \Pg\modules\couples\models\CouplesModel::USER_TYPE) {
                return $this->Couples_model->getProfile($data);
            }
        }
        $template = getenv('THEME_MODE');
        if ($template) {
            //to show location field for editing
            if (empty($data['location'])) {
                $data['location'] = ' ';
            }
        }

        $this->view->assign('is_owner', true);
        $this->view->assign('data', $data);

        if (empty($template)) {
            $this->view->render('profile');
        } elseif ($template) {
            $this->view->assign('header_type', 'view_' . $template);
            $this->view->assign('body_class', ($profile_section != 'gallery') ? 'mod-' . $template : '');
            $this->view->render('profile_' . $template);
        }
    }

    public function restore($code = false)
    {
        if ($this->session->userdata("auth_type") == "user") {
            $this->view->setRedirect(site_url() . 'users/search');
        }
        $this->load->model('users/models/Users_restore_password');
        if ($this->input->post('btn_save')) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $this->Users_restore_password->sendUserLink($email);
            $this->system_messages->addMessage(
                View::MSG_SUCCESS,
                l('success_restore_instructions_sent', 'users', '', '', ['email' => $email])
            );
            $this->view->setRedirect(site_url() . "users/restore");
        } elseif ($code !== false) {
            $data = $this->Users_restore_password->getDataByCode($code);
            if (!empty($data)) {
                $this->Menu_model->breadcrumbsSetActive(l('header_restore_password', 'users'));
                $this->view->assign('code', $code);
                $this->view->render('restore_password');
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_code_no_exist', 'users'));
                $this->view->setRedirect(site_url() . "users/restore");
            }
        } elseif ($this->input->post('btn_restore')) {
            $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);
            if ($password != $repassword) {
                $this->system_messages->addMessage(View::MSG_INFO, l('error_pass_repass_not_equal', 'users'));
                $this->view->setRedirect(site_url() . "users/restore/" . $code);
            }
            $is_reset = $this->Users_restore_password->updatePassword($code, $password);
            if ($is_reset != false) {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_password_reset', 'users'));
                $this->view->setRedirect(site_url() . "users/login_form");
            }
        }
        $this->Menu_model->breadcrumbsSetActive(l('header_restore_password', 'users'));
        $this->view->render('forgot_form');
    }

    public function confirm($code = '')
    {
        $code = !empty($code) ? trim(strip_tags($code)) : $this->input->post('code', true);
        $email_confirm_check_text = str_replace("%settings_url%", site_url() . "users/settings/email", l('email_confirm_check', 'users'));
        $this->view->assign('email_confirm_check_text', $email_confirm_check_text);
        $this->session->unset_userdata('is_reg');

        if ($this->user_id) {
            $user = $this->Users_model->getUserById($this->user_id);
            if (isset($user["confirm"]) && $user["confirm"]) {
                redirect(site_url() . "users/profile", 'hard');
            }
        }

        if (!$code) {
            $this->Menu_model->breadcrumbsSetActive(l('header_confirm_email', 'users'));
            $this->view->render('confirm_form');

            return;
        }

        $user = $this->Users_model->getUserByConfirmCode($code);
        if (empty($user)) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_no_exists_confirm_code', 'users'));
        //redirect();
        } elseif ($user["confirm"]) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_already_confirm', 'users'));
            redirect(site_url() . "users/profile", 'hard');
        } else {
            $data["confirm"] = 1;
            $this->Users_model->saveUser($user["id"], $data);
            $this->Users_model->sendEvent('email_confirm', ['email_confirm_data' => $user]);

            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_confirm', 'users'));

            $this->load->model("users/models/Auth_model");
            $auth_data = $this->Auth_model->login($user["id"]);
            if (!empty($auth_data["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $auth_data["errors"]);
            }
            redirect(site_url() . "users/profile", 'hard');
        }
    }

    public function ajaxGetUsersData($page = 1)
    {
        $params = $return = [];
        $page = !empty($this->input->post('page', true)) ? $this->input->post('page', true) : $page;

        $search_string = trim(strip_tags($this->input->post('search', true)));
        if (!empty($search_string)) {
            $hide_user_names = $this->pg_module->get_module_config('users', 'hide_user_names');
            if ($hide_user_names) {
                $params["where"]["nickname LIKE"] = "%" . $search_string . "%";
            } else {
                $search_string_escape = $this->db->escape("%" . $search_string . "%");
                $params["where_sql"][] = "(nickname LIKE " . $search_string_escape
                    . " OR fname LIKE " . $search_string_escape
                    . " OR sname LIKE " . $search_string_escape . ")";
            }
        }

        $selected = $this->input->post('selected', true);
        if (!empty($selected)) {
            if (!is_array($selected)) {
                $selected = [$selected];
            }
            $params["where_sql"][] = "id NOT IN (" . implode($selected) . ")";
        }

        $user_type = $this->input->post('user_type', true);
        if ($user_type) {
            $params["where"]["user_type"] = $user_type;
        }
        if ($this->Users_model->is_couples_installed === true) {
            $params["where"]["is_coupled !="] = 1;
        }

        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $items = $this->Users_model->getUsersListByKey($page, $items_on_page, ["nickname" => "asc"], $params, [], true, true);

        $return["all"] = $this->Users_model->getUsersCount($params);
        $return["items"] = $items;
        $return["current_page"] = $page;
        $return["pages"] = ceil($return["all"] / $items_on_page);

        $this->view->assign($return);
    }

    public function ajaxGetSelectedUsers()
    {
        $selected = $this->input->post('selected', true);
        $selected = array_slice(array_unique(array_map('intval', (array)$selected)), 0, 1000);
        if (!empty($selected)) {
            $return['selected'] = $this->Users_model->getUsersList(null, null, ["nickname" => "asc"], [], $selected, true, true);
        } else {
            $return['selected'] = [];
        }
        $this->view->assign($return);

    }

    public function ajaxGetUsersForm($max_select = 1)
    {
        $selected = $this->input->post('selected', true);

        if (!empty($selected)) {
            $data["selected"] = $this->Users_model->getUsersList(null, null, ["nickname" => "asc"], [], $selected, false);
        } else {
            $data["selected"] = [];
        }
        $data["max_select"] = $max_select ? $max_select : 0;

        $this->view->assign('select_data', $data);
        $this->view->render('ajax_user_select_form');
    }

    public function search($order = "default", $order_direction = "DESC", $page = 1)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event->setSearchFrom($this->user_id);
        $event_handler->dispatch($event, 'user_search');

        $show_list_buttons = 1;
        if ($this->user_id) {
            $viewer = $this->Users_model->getUserById($this->user_id, true);
            if ($viewer['activity'] == '0') {
                $show_list_buttons = 0;
            }
        }
        $this->view->assign('show_list_buttons', $show_list_buttons);
        if (empty($_POST)) {
            if ($this->session->userdata("users_search")) {
                $data = $this->session->userdata("users_search");
            } else {
                $data = [];
            }
            /*Проверка, если пользователь вошел в первый раз, получаем данные из профиля*/
            if (isset($viewer) && !isset($data['logged'])) {
                $data['age_min'] = $viewer['age_min'];
                $data['age_max'] = $viewer['age_max'];
                $data['user_type'] = [];
                $data['user_type'][] = $viewer['looking_user_type'];
            }
        } else {
            foreach ($_POST as $key => $val) {
                $value = $this->input->post($key, true);
                if (is_string($value)) {
                    $data[$key] = trim(strip_tags($value));
                } else {
                    $data[$key] = $value;
                }
            }
            $data = array_merge($this->Users_model->getMinimumSearchData(), $data);
        }
        $this->view->assign('block', $this->searchListBlock($data, $order, $order_direction, $page, 'advanced'));

        if (!empty($data['search'])) {
            $this->view->assign('search_text', $data['search']);
        }

        $view_mode = (!empty($_SESSION['search_view_mode']) && $_SESSION['search_view_mode'] == 'list') ? 'list' : 'gallery';
        $this->view->assign('view_mode', $view_mode);

        $this->Menu_model->breadcrumbsSetActive(l('header_find_people', 'users'));
        $this->view->render('users_list');
    }

    public function ajaxLoadUsers($order = 'date_last_activity')
    {
        $page = filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT);
        $hide_dir = filter_input(INPUT_POST, 'hide_dir', FILTER_SANITIZE_STRING);
        $data = $this->session->userdata("users_search") ?: [];
        $this->view->assign('hide_dir', $hide_dir);
        $result['content'] = $this->searchListBlock($data, $order, 'DESC', $page);
        $this->view->assign($result);
        $this->view->render();
    }

    public function ajaxSearch($s = '', $order = '', $order_direction = "DESC", $page = 1)
    {
        if (empty($_POST)) {
            $current_settings = ($this->session->userdata("users_search")) ? $this->session->userdata("users_search") : [];
            $data = (!empty($current_settings)) ? $current_settings : [];
        } else {
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }

            $data = array_merge($this->Users_model->getMinimumSearchData(), $data);
        }
        echo $this->searchListBlock($data, $order, $order_direction, $page, 'advanced');
    }

    public function ajaxSearchCounts()
    {
        $result = ['count' => 0, 'error' => '', 'string' => ''];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }
            $criteria = $this->getAdvancedSearchCriteria($data);
            $result["count"] = $this->Users_model->getUsersCount($criteria);
            $result["string"] = str_replace("[count]", $result["count"], l('user_results_string', 'users'));
        }
        $this->view->assign($result);
    }

    protected function searchListBlock($data = [], $order = "default", $order_direction = "DESC", $page = 1, $search_type = 'advanced')
    {
        $this->view->assign('user_id', $this->user_id);
        $current_settings = $this->session->userdata("users_search") ? $this->session->userdata("users_search") : $this->Users_model->getDefaultSearchData();

        if (!empty($data)) {
            $current_settings = $data;
        }
        if ($this->user_id) {
            $current_settings['logged'] = true;
        }
        $criteria = $this->getAdvancedSearchCriteria($current_settings);
        /** Делаем фото необязательным в поиске **/
        $withPhoto = (bool)$this->ci->pg_module->get_module_config('users', 'without_photo');
        if ($withPhoto) {
            $current_settings['withPhotoActive'] = true;
            if (!$current_settings['withPhoto']) {
                unset($criteria['where']['activity']);
                $criteria['where_in']['activity'] = [1, 0];
            }
        } else {
            unset($current_settings['withPhoto']);
            unset($current_settings['withPhotoActive']);
        }

        $this->session->set_userdata("users_search", $current_settings);

        $search_url = site_url() . "users/search";
        $url = site_url() . "users/search/" . $order . "/" . $order_direction . "/";

        $hl_data = [
            'service_highlight' => [
                'status' => false,
                'service' => [],
                'user_service' => []
            ]
        ];

        if ($this->user_id) {
            $user = $this->Users_model->getUserById($this->user_id, true);
            /* highligth in search */
            $hl_data['service_highlight'] = $this->Users_model->serviceStatusHighlightInSearch($user);
            if ($hl_data['service_highlight']['status']) {
                $this->load->helper('seo');
                $this->session->set_userdata(['service_redirect' => rewrite_link('users', 'search')]);
            }
        }
        $this->view->assign('hl_data', $hl_data);

        $this->view->assign('search_type', $search_type);
        $order = trim(strip_tags($order));
        if (!$order) {
            $order = "date_created";
        }
        $this->view->assign('order', $order);

        $order_direction = strtoupper(trim(strip_tags($order_direction)));
        if ($order_direction != 'DESC' && $order_direction != "ASC") {
            $order_direction = "DESC";
        }
        $this->view->assign('order_direction', $order_direction);

        $items_count = $this->Users_model->getUsersCount($criteria);
        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $items_count, $items_on_page);

        $sort_data = [
            "url" => $search_url,
            "order" => $order,
            "direction" => $order_direction,
            "links" => [
                "default" => l('field_default_sorter', 'users'),
                "name" => l('field_name', 'users'),
                "views_count" => l('field_views_count', 'users'),
                "date_created" => l('field_date_created', 'users'),
            ],
        ];
        $this->view->assign('sort_data', $sort_data);

        $use_leader = false;
        if ($items_count > 0) {
            $order_array = ['up_in_search_end_date' => 'DESC'];
            if ($order == 'default') {
                if (!empty($data['id_region']) && (int)$data['id_region']) {
                    $order_array['leader_bid'] = 'DESC';
                }
                if (!empty($criteria['fields']) && (int)$criteria['fields']) {
                    $order_array["fields"] = 'DESC';
                }
                $use_leader = true;
            } else {
                if ($order == 'name') {
                    if ($this->pg_module->get_module_config('users', 'hide_user_names')) {
                        $order_array['nickname'] = $order_direction;
                    } else {
                        $order_array['fname'] = $order_direction;
                        $order_array['sname'] = $order_direction;
                    }
                } else {
                    $order_array[$order] = $order_direction;
                }
            }
            $order_array['date_created'] = 'DESC';

            $users = $this->Users_model->getUsersList($page, $items_on_page, $order_array, $criteria);
            $this->view->assign('users', $users);
            $this->view->assign('users_count', $items_count);
        }

        //write search result ids to the session
        $user_ids = [];
        if (!empty($users)) {
            foreach ($users as $s_user) {
                $user_ids[] = $s_user['id'];
            }
        }

        \Pg\modules\users\models\UsersSearchIdsModel::updateUsersIdsEvent($user_ids);

        $this->load->helper("navigation");
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_literal', 'st');
        $page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $page_data["use_leader"] = $use_leader;
        $page_data["view_type"] = $_SESSION['search_view_mode'] ?? 'gallery';
        $page_data["type"] = 'scroll';
        $this->view->assign('page_data', $page_data);

        $use_save_search = ($this->session->userdata("auth_type") == "user") ? true : false;
        $this->view->assign('use_save_search', $use_save_search);

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');
        $this->view->assign('pm_installed', $pm_installed);

        return $this->view->fetch('users_list_block');
    }

    protected function getAdvancedSearchCriteria($data)
    {
        $this->load->model('field_editor/models/Field_editor_forms_model');
        $fe_criteria = $this->Field_editor_forms_model->getSearchCriteria(
            $this->Users_model->advanced_search_form_gid,
            $data,
            $this->Users_model->form_editor_type,
            false
        );
        if (!empty($data["search"])) {
            $data["search"] = trim(strip_tags($data["search"]));
            $this->load->model('Field_editor_model');
            $this->Field_editor_model->initialize($this->Users_model->form_editor_type);
            if (strlen($data["search"]) > 3) {
                $temp_criteria = $this->Field_editor_model->returnFulltextCriteria($data["search"], 'BOOLEAN MODE');
                $fe_criteria['fields'][] = $temp_criteria['user']['field'];
                $fe_criteria['where_sql'][] = $temp_criteria['user']['where_sql'];
            } else {
                $search_text_escape = $this->db->escape($data["search"] . "%");
                $fe_criteria['where_sql'][] = "(nickname LIKE " . $search_text_escape . ")";
            }
        }
        $common_criteria = $this->Users_model->getCommonCriteria($data);
        $advanced_criteria = $this->Users_model->getAdvancedSearchCriteria($data);

        return array_merge_recursive($fe_criteria, $common_criteria, $advanced_criteria);
    }

    public function view($user_id = null, $profile_section = 'wall', $subsection = 'all')
    {
        $this->view->assign('magazine_close_url', magazine_close_url());

        $viewer_id = $this->user_id;
        $template = getenv('THEME_MODE');

        if ((int)$user_id != (int)$viewer_id) {
            $this->load->model('users/models/Users_views_model');
            $this->Users_views_model->saveProfileViewer($user_id);
            $this->view->assign('is_user_owner', 0);
            $this->view->assign('magazine_navigation', magazine_navigation($user_id, $profile_section));
        } elseif (empty($template)) {
            $this->view->setRedirect(site_url() . 'users/profile');
        }

        if (!$this->ci->Users_model->checkGuestAccess($user_id, $viewer_id)) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_guest_limit', 'users'), 'users');
            $this->view->setRedirect(site_url() . 'users/login_form');
        }

        $subsection = trim(strip_tags($subsection));

        if (!$profile_section || 'wall' === $profile_section) {
            $profile_section = $this->pg_module->is_module_active('wall_events') ? 'wall' : 'profile';
        }
        if ($profile_section == 'gallery') {
            if ($this->pg_module->is_module_installed('access_permissions')) {
                $is_gallery = $this->acl->checkSimple('view_page', 'users_users_user_gallery');
                if (!$is_gallery) {
                    if (!isset($this->session->userdata['auth_type'])) {
                        $this->system_messages->addMessage(View::MSG_INFO, l('info_authorized_user', 'access_permissions'));
                        $this->view->setRedirect($this->agent->referrer());
                    } else {
                        $this->view->setRedirect(site_url('access_permissions/index'));
                    }
                }
            }
            if (!in_array($subsection, $this->subsections)) {
                $subsection = $this->subsections['default'];
            }
        }

        if ($profile_section == 'profile') {
            $this->load->model('Field_editor_model');
            $this->Field_editor_model->initialize($this->Users_model->form_editor_type);
            $sections = $this->Field_editor_model->getSectionList();
            $sections_gids = array_keys($sections);
            $fields_for_select = $this->Field_editor_model->getFieldsForSelect($sections_gids);
            $this->Users_model->setAdditionalFields($fields_for_select);
        }

        $data = $this->Users_model->getUserById($user_id);
        if (empty($data)) {
            $this->view->setRedirect(site_url() . 'users/untitled/');
        } elseif ($data['approved'] == 0) {
            $this->view->setRedirect(site_url() . 'users/untitled/' . $user_id);
        }

        if ($viewer_id) {
            $viewer_raw = $this->Users_model->getUserById($viewer_id);
            $viewer_raw['services_status'] = $this->Users_model->servicesStatus($viewer_raw);

            if (!$viewer_raw['activity'] && $viewer_raw['services_status']['user_activate_in_search']['service']['status']) {
                $viewer_raw['available_activation'] = $this->Users_model->checkAvailableUserActivation($viewer_id);
                if ($viewer_raw['available_activation']['status'] == 0 && !empty($viewer_raw['available_activation']['fields'])) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('text_register', 'users'));
                    redirect(site_url() . 'users/profile/view');
                } elseif ($viewer_raw['available_activation']['status'] == 0 && empty($viewer_raw['available_activation']['fields'])) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('text_register_activate', 'users'));
                    redirect(site_url() . 'users/profile/view');
                }
            }

            if ($user_id != $viewer_id) {
                $event_handler = EventDispatcher::getInstance();
                $event = new EventUsers();
                $event->setProfileViewFrom($viewer_id);
                $event->setProfileViewTo($user_id);
                $event->setData($data);
                $event_handler->dispatch($event, 'profile_view');
            }

            $viewer = $this->Users_model->formatUser($viewer_raw);
        } else {
            $viewer = [];
        }

        if ((!$viewer_id || !$viewer['is_hide_on_site']) && $user_id != $viewer_id) {
            $this->load->model('users/models/Users_views_model');
            $this->Users_views_model->updateViews($user_id, $viewer_id);
        }

        $lang_id = $this->pg_language->current_lang_id;
        $data = $this->Users_model->formatUser($data, false, $lang_id);

        if ($profile_section == 'profile') {
            foreach ($sections as $sgid => $sdata) {
                $params["where"]["section_gid"] = $sgid;
                $sections[$sgid]['fields'] = $this->Field_editor_model->formatItemFieldsForView($params, $data);
            }
            $this->view->assign('sections', $sections);
        }

        $this->load->helper('seo');

        $link = rewrite_link('users', 'view', $data);

        // breadcrumbs
        $this->Menu_model->breadcrumbsSetActive($data['output_name'], $link);
        $this->Menu_model->breadcrumbsSetActive(l("filter_section_" . $profile_section, "users"));

        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');

        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        if ($profile_section == 'gallery') {
            $gallery_filters = [];

            foreach ($this->subsections as $subsection_code) {
                $subsection_name = l($subsection_code, 'media');

                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                $seo_data['subsection'] = $subsection_code;
                $seo_data['subsection-code'] = $subsection_code;
                $seo_data['subsection-name'] = $subsection_name;
                $subsection_link = rewrite_link('users', 'view', $seo_data);
                $gallery_filters[$subsection_code] = ['link' => $subsection_link, 'name' => $subsection_name];
            }

            $this->view->assign('gallery_filters', $gallery_filters);

            $location_base_url = function ($subsection_code, $subsection_name) use ($data, $profile_section) {
                $seo_data = $data;
                $seo_data['section'] = $profile_section;
                $seo_data['section-code'] = $profile_section;
                $seo_data['section-name'] = l('filter_section_' . $profile_section, 'users');

                $seo_data['subsection'] = $subsection_code;
                $seo_data['subsection-code'] = $subsection_code;
                $seo_data['subsection-name'] = $subsection_name;
                $subsection_link = rewrite_link('users', 'view', $seo_data);

                return $subsection_link;
            };
            $this->view->assign('location_base_url', $location_base_url);
        }

        $lang_canonical = true;

        if ($this->pg_module->is_module_installed('seo')) {
            $lang_canonical = $this->pg_module->get_module_config('seo', 'lang_canonical');
        }

        if ($data['id_seo_settings']) {
            $this->load->model('Seo_advanced_model');
            $seo_settings = $this->Seo_advanced_model->parseSeoTags($data['id_seo_settings']);
            $seo_settings['canonical'] = rewrite_link('users', 'view', $data, false, null, $lang_canonical);
            $seo_settings['image'] = $data['media']['user_logo']['thumbs']['big'];
            $this->pg_seo->set_seo_tags($seo_settings);
        } else {
            $seo_settings = $data;
            $seo_settings['canonical'] = rewrite_link('users', 'view', $data, false, null, $lang_canonical);
            $seo_settings['image'] = $data['media']['user_logo']['thumbs']['big'];
            $seo_settings['section_code'] = $profile_section;
            $seo_settings['section_name'] = l('filter_section_' . $profile_section, 'users', $this->pg_language->current_lang_id);
            $this->pg_seo->set_seo_data($seo_settings);
        }

        $this->view->assign('page_data', $page_data);

        $this->view->assign('seodata', $data);
        $this->view->assign('profile_section', $profile_section);
        $this->view->assign('subsection', $subsection);
        $this->view->assign('user_id', $user_id);

        if ($this->Users_model->is_couples_installed === true) {
            if ($data['user_type'] === \Pg\modules\couples\models\CouplesModel::USER_TYPE) {
                return $this->Couples_model->getProfile($data, 'view');
            }
        }
        $this->view->assign('data', $data);
        if (empty($template)) {
            $this->view->render('view');
        } else {
            $this->view->assign('is_owner', $user_id == $this->user_id);
            $this->view->assign('header_type', 'view_' . $template);
            $this->view->assign('body_class', ($profile_section != 'gallery') ? 'mod-' . $template : '');
            $this->view->render('view_' . $template);
        }
    }

    public function myGuests($period = 'all', $page = 1)
    {
        $this->Menu_model->breadcrumbsSetParent('user-menu-people');
        $this->Menu_model->breadcrumbsSetActive(l('header_my_guests', 'users'));
        $this->views($period, 'my_guests', $page);

    }

    public function myVisits($period = 'all', $page = 1)
    {
        $this->Menu_model->breadcrumbsSetParent('user-menu-people');
        $this->Menu_model->breadcrumbsSetActive(l('header_my_visits', 'users'));
        $this->views($period, 'my_visits', $page);

    }

    protected function views($period = 'all', $type = 'my_guests', $page = 1)
    {
        if (!in_array($period, ['today', 'week', 'month', 'all'])) {
            $period = 'all';
        }
        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $this->load->model(['users/models/Users_views_model', 'users/models/Users_deleted_model']);
        $order_by = ['view_date' => 'DESC'];
        if ($type == 'my_guests') {
            $all_viewers = $this->Users_views_model->getViewersDailyUnique($this->user_id, $page, $items_on_page, $order_by, [], $period);
            $this->Users_views_model->removeViewersCounter($all_viewers);
            $items_count = $this->Users_views_model->getViewersCountDailyUnique($this->user_id, $period);
        } else {
            $all_viewers = $this->Users_views_model->getViewsDailyUnique($this->user_id, $page, $items_on_page, $order_by, [], $period);
            $items_count = $this->Users_views_model->getViewsCountDailyUnique($this->user_id, $period);
        }
        $user_ids = [];
        $need_ids = $view_dates = [];
        $key = ($type == 'my_guests') ? 'id_viewer' : 'id_user';
        foreach ($all_viewers as $viewer) {
            $need_ids[$viewer[$key]] = $viewer[$key];
            $view_dates[$viewer[$key]] = ($viewer['view_date'] != UsersModel::DB_DEFAULT_DATE) ? $viewer['view_date'] : 0;
        }
        $this->load->helper('sort_order');
        $this->load->helper("navigation");
        $page = get_exists_page_number($page, $items_count, $items_on_page);
        $url = site_url() . "users/{$type}/{$period}/";
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');

        if ($items_count) {
            $users_list = $this->Users_model->getUsersListByKey(null, null, $order_by, [], $need_ids);
            $users = [];

            foreach ($need_ids as $uid) {
                if (isset($users_list[$uid]['id'])) {
                    $users[$uid] = $users_list[$uid];
                    $user_ids[] = $uid;
                } else {
                    $default = $this->Users_model->formatDefaultUser($uid);
                    $deleted = $this->Users_deleted_model->getUserByUserId($uid, true);
                    $users[$uid] = array_merge($default, $deleted);
                }
            }

            $this->view->assign('users', $users);
            $this->view->assign('view_dates', $view_dates);
        }

        \Pg\modules\users\models\UsersSearchIdsModel::updateUsersIdsEvent($user_ids);

        $this->view->assign('views_type', $type);
        $this->view->assign('period', $period);
        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        $page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);
        $this->view->assign('page', $page);
        $this->view->render('visits');
    }

    /* USERS SERVICES */

    public function ajaxAvailableUserActivateInSearch()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableUserActivateInSearchAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'user_activate_in_search_template');
                $this->load->helper('seo');
                $this->session->set_userdata(['service_redirect' => rewrite_link('users', 'profile')]);
            } elseif ($return['available'] == 1 && isset($return['activated_end_date'])) {
                $return['info'] = l('user_activate_in_search_is_already_activated', 'users');
            }
            $return['gid'] = 'user_activate_in_search';
        }
        $this->view->assign($return);

    }

    public function ajaxActivateUserActivateInSearch($id_user_service)
    {
        $return = $this->Users_model->serviceActivateUserActivateInSearch($this->user_id, $id_user_service);
        $this->view->assign($return);

    }

    /**
     * The method checks the availability of featured user.
     *
     * @param int $id_user
     */
    public function ajaxAvailableUsersFeatured()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableUsersFeaturedAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'users_featured_template');
            }
            $return['gid'] = 'users_featured';
        }
        $this->view->assign($return);

    }

    public function ajaxActivateUsersFeatured($id_user_service)
    {
        $return = $this->Users_model->serviceActivateUsersFeatured($this->user_id, $id_user_service);
        $this->view->assign($return);

    }

    /**
     * The method checks the availability of approve user.
     *
     * @param int $id_user
     */
    public function ajaxAvailableAdminApprove()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableAdminApproveAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'admin_approve_template');
            }
            $return['gid'] = 'admin_approve';
        }
        $this->view->assign($return);

    }

    public function ajaxActivateAdminApprove($id_user_service)
    {
        $this->view->assign($this->Users_model->serviceActivateAdminApprove($this->user_id, $id_user_service));
    }

    /**
     * The method checks the availability of hide user on site.
     *
     * @param int $id_user
     */
    public function ajaxAvailableHideOnSite()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableHideOnSiteAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'hide_on_site_template');
            }
            $return['gid'] = 'hide_on_site';
        }
        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxActivateHideOnSite($id_user_service)
    {
        $return = $this->Users_model->serviceActivateHideOnSite($this->user_id, $id_user_service);
        $this->view->assign($return);

    }

    /**
     * The method checks the availability of highlight user in search.
     *
     * @param int $id_user
     */
    public function ajaxAvailableHighlightInSearch()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableHighlightInSearchAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'highlight_in_search_template');
            }
            $return['gid'] = 'highlight_in_search';
        }
        $this->view->assign($return);

    }

    public function ajaxActivateHighlightInSearch($id_user_service)
    {
        $this->view->assign($this->Users_model->serviceActivateHighlightInSearch($this->user_id, $id_user_service));
    }

    /**
     * The method checks the availability of up user in search.
     *
     * @param int $id_user
     */
    public function ajaxAvailableUpInSearch()
    {
        $return = ['available' => 0, 'content' => '', 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableUpInSearchAction($this->user_id);
            if ($return["content_buy_block"] == true) {
                $this->load->model('services/models/Services_users_model');
                $return["content"] = $this->Services_users_model->availableServiceBlock($this->user_id, 'up_in_search_template');
            }
            $return['gid'] = 'up_in_search';
        }
        $this->view->assign($return);

    }

    public function ajaxActivateUpInSearch($id_user_service)
    {
        $this->view->assign($this->Users_model->serviceActivateUpInSearch($this->user_id, $id_user_service));
    }

    /**
     * The method checks the availability of up user in search.
     *
     * @param int $id_user
     */
    public function ajaxAvailableAbilityDelete()
    {
        $return = ['available' => 0, 'content' => '', 'content_buy_block' => false, 'display_login' => 0];
        if ($this->session->userdata('auth_type') != 'user') {
            $return['display_login'] = 1;
        } else {
            $return = $this->Users_model->serviceAvailableAbilityDeleteAction($this->user_id);
        }
        $this->view->assign($return);

    }

    public function ajaxActivateAbilityDelete($id_user_service)
    {
        $this->view->assign($this->Users_model->serviceActivateAbilityDelete($this->user_id, $id_user_service, 1));
    }

    public function accountDelete()
    {
        if ($this->pg_module->is_module_installed('services')) {
            $this->load->model('Services_model');
            if ((int)$this->Services_model->isServiceActive('ability_delete') === 1) {
                $this->load->model('services/models/Services_users_model');
                $service_access = $this->Services_users_model->isServiceAccess($this->user_id, 'ability_delete_template');
                if ($service_access['service_status'] && !$service_access['activate_status']) {
                    show_404();
                }
            } else {
                show_404();
            }
        }
        if ($this->input->post('btn_delete')) {
            $this->Users_model->deleteUser($this->user_id);
            $this->load->model("users/models/Auth_model");
            $this->Auth_model->logoff();
            $this->view->setRedirect();
        } else {
            // breadcrumbs
            $this->Menu_model->breadcrumbsSetParent('settings-item');
            $this->Menu_model->breadcrumbsSetActive(l('field_menu_settings_delete_account', 'users'));
            $this->view->render('account_delete_block');
        }
    }

    public function ajaxLoadAvatar($uploader = false)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        $id_user = (int)$this->input->post('id_user', true);
        if (empty($id_user)) {
            $id_user = $this->user_id;
        }

        $data = [
            'user' => $this->Users_model->getUserById($id_user, true),
            'is_owner' => ($id_user == $this->user_id)
        ];
        if (!$id_user || !$data['user'] || (!$data['is_owner'] && !($data['user']['user_logo'] || $data['user']['user_logo_moderation']))) {
            $result['status'] = 0;
            $result['errors'][] = l('error_access_denied', 'users');
            $this->view->assign($result);

            return;
        }
        $data['have_avatar'] = ($data['user']['user_logo'] || $data['user']['user_logo_moderation']);
        if ($data['is_owner']) {
            $this->load->model('uploads/models/Uploads_config_model');
            $data['upload_config'] = $this->Uploads_model->getConfig($this->Users_model->upload_config_id);
            $data['selections'] = [];
            foreach ($data['upload_config']['thumbs'] as $thumb_config) {
                $data['selections'][$thumb_config['prefix']] = [
                    'width' => $thumb_config['width'],
                    'height' => $thumb_config['height'],
                ];
            }
        }

        $this->view->assign('avatar_data', $data);
        $this->view->assign('uploader', $uploader);
        $result['data']['html'] = $this->view->fetchFinal('ajax_user_avatar');
        if (isset($data['selections'])) {
            $result['data']['selections'] = $data['selections'];
        }
        $this->view->assign($result);
        $this->view->render();
    }

    public function ajaxRecropAvatar($user_id = null)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];
        $user = $this->Users_model->getUserById($this->user_id, true);
        if (!$user || !($user['user_logo'] || $user['user_logo_moderation'])) {
            $result['status'] = 0;
            $result['errors'][] = l('error_access_denied', UsersModel::MODULE_GID);
            $this->view->assign($result);

            return;
        }
        $logo_name = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        $recrop_data = [
            'x1' => $this->input->post('x1', true),
            'y1' => $this->input->post('y1', true),
            'width' => $this->input->post('width', true),
            'height' => $this->input->post('height', true)
        ];
        $this->load->model('Uploads_model');
        $new_file = $this->Uploads_model->recropUpload($this->Users_model->upload_config_id, $this->user_id, $user[$logo_name], $recrop_data);

        $this->Users_model->simplyUpdateUser($this->user_id, [$logo_name => $new_file['file']]);

        $path =  $user['media'][$logo_name]['url'];
        $new_img_array = [];
        foreach ($result['data']['img_url'] = $user['media'][$logo_name]['thumbs'] as $kye => $link) {
            $new_img_array[$kye] = $path.$kye.'-'.$new_file['file'];
        }

        $result['data']['img_url'] = $new_img_array;
        $result['data']['rand'] = rand(0, 999999);
        $result['msg'][] = l('photo_successfully_saved', UsersModel::MODULE_GID);

        $this->view->assign($result);
        $this->view->render();
    }

    public function uploadAvatar()
    {
        $return = ['errors' => [], 'warnings' => [], 'name' => '', 'logo' => [], 'old_logo' => []];
        $validate_data = $this->Users_model->validate($this->user_id, [], 'avatar');
        if (!empty($validate_data['errors'])) {
            $return['errors'] = $validate_data['errors'];
        } else {
            $data = $this->Users_model->getUserById($this->user_id, true);

            if (!empty($data['media']['user_logo'])) {
                $return['old_logo'] = $data['media']['user_logo'];
            } else {
                $return['old_logo'] = '';
            }

            if (!empty($data['media']['user_logo_moderation'])) {
                $return['old_logo_moderation'] = $data['media']['user_logo_moderation'];
            } else {
                $return['old_logo_moderation'] = '';
            }

            if ($this->input->post('user_icon_delete') || (isset($_FILES['avatar']) && is_array($_FILES['avatar']) && is_uploaded_file($_FILES['avatar']['tmp_name']))) {
                $this->load->model('Uploads_model');
                if ($data['user_logo_moderation']) {
                    $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id . '/', $data['user_logo_moderation'], UsersModel::ORIGINAL_IMG_PATH);
                    $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id . '/', $data['user_logo_moderation']);
                    $validate_data['data']['user_logo_moderation'] = '';
                    $this->load->model('Moderation_model');
                    $this->Moderation_model->deleteModerationItemByObj($this->Users_model->moderation_type[0], $this->user_id);
                } elseif ($data['user_logo']) {
                    $validate_data['data']['user_logo'] = '';
                }
                $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id, $data['user_logo']);

                $this->load->model('menu/models/Indicators_model');
                $this->Indicators_model->delete('new_moderation_item', $this->user_id, true);
            }

            $this->Users_model->saveUser($this->user_id, $validate_data['data'], 'avatar');
            $this->Users_model->serviceAvailableUserActivateInSearchAction($this->user_id);
            $data = $this->Users_model->getUserById($this->user_id, true);

            if ($data['user_logo_moderation']) {
                $return['warnings'][] = l('file_uploaded_and_moderated', 'media');
            }
            if ($this->input->post('user_icon_delete') && !isset($_FILES['avatar'])) {
                $return['logo'] = $this->Uploads_model->formatUpload($this->Users_model->upload_config_id, $this->Users_model->upload_config_id);
            } else {
                $return['logo'] = $data['user_logo_moderation'] ? $data['media']['user_logo_moderation'] : $data['media']['user_logo'];
            }

            $this->load->model('users/models/Auth_model');
            $this->Auth_model->updateUserSessionData($this->user_id);
        }

        $this->view->assign($return);
        $this->view->render();

    }

    public function untitled($id = null)
    {
        $this->view->assign('data', ['id' => $id]);
        if ($id) {
            $this->Menu_model->breadcrumbsSetActive(l('success_deactivate_user', 'users'));
        } else {
            $this->Menu_model->breadcrumbsSetActive(l('user_deleted', 'users'));
        }
        $this->view->render('profile_untitled');
    }

    public function ajaxRefreshActiveUsers()
    {
        $attrs["where_sql"][] = " id!='" . $this->session->userdata("user_id") . "'";
        $params['count'] = (int)($this->input->post('count', true));
        $this->load->model('Properties_model');
        $user_types = $this->Properties_model->getProperty('user_type');
        $this->view->assign('user_types', $user_types["option"]);

        $filter_user_type = $this->input->post('user_type');
        if (!empty($filter_user_type)) {
            foreach ($user_types["option"] as $key => $value) {
                if ($key == $filter_user_type) {
                    $attrs["where_sql"][] = " user_type='" . $key . "'";
                    $this->view->assign('active_user_type', $key);
                }
            }
        }

        $data['users'] = $this->Users_model->getActiveUsers($params['count'], 0, $attrs);

        if (!empty($data['users'])) {
            $users_count = 16 - count($data['users']);
            switch ($users_count) {
                case 13:
                    $recent_thumb['name'] = 'middle';
                    $recent_thumb['width'] = '82px';

                    break;
                case 14:
                    $recent_thumb['name'] = 'big';
                    $recent_thumb['width'] = '125px';

                    break;
                case 15:
                    $recent_thumb['name'] = 'great';
                    $recent_thumb['width'] = '255px';

                    break;
                default:
                    $recent_thumb['name'] = 'small';
                    $recent_thumb['width'] = '60px';
            }
            $this->view->assign('recent_thumb', $recent_thumb);
        }

        $this->view->assign('active_users_block_data', $data);
        exit($this->view->fetch('helper_active_users_block', 'user', 'users'));
    }

    public function ajaxRefreshLastRegisteredUsers()
    {
        $attrs["where_sql"][] = " id!='" . $this->session->userdata("user_id") . "'";
        $params['count'] = (int)($this->input->post('count', true));
        $this->load->model('Properties_model');
        $user_types = $this->Properties_model->getProperty('user_type');
        $this->view->assign('user_types', $user_types["option"]);

        $filter_user_type = $this->input->post('user_type');
        if (!empty($filter_user_type)) {
            foreach ($user_types["option"] as $key => $value) {
                if ($key == $filter_user_type) {
                    $attrs["where_sql"][] = " user_type='" . $key . "'";
                    $this->view->assign('active_user_type', $key);
                }
            }
        }

        $attrs['order_by'] = ['field' => 'date_created',
            'direction' => 'DESC',];

        $data['users'] = $this->Users_model->getActiveUsers($params['count'], 0, $attrs);

        if (!empty($data['users'])) {
            $users_count = 16 - count($data['users']);
            switch ($users_count) {
                case 13:
                    $recent_thumb['name'] = 'middle';
                    $recent_thumb['width'] = '82px';

                    break;
                case 14:
                    $recent_thumb['name'] = 'big';
                    $recent_thumb['width'] = '125px';

                    break;
                case 15:
                    $recent_thumb['name'] = 'great';
                    $recent_thumb['width'] = '255px';

                    break;
                default:
                    $recent_thumb['name'] = 'small';
                    $recent_thumb['width'] = '60px';
            }
            $this->view->assign('recent_thumb', $recent_thumb);
        }

        $this->view->assign('active_users_block_data', $data);
        exit($this->view->fetch('helper_last_registered', 'user', 'users'));
    }

    /**
     * If user not approve
     *
     * @return void
     * */
    public function blocked()
    {
        if ($this->session->userdata('auth_type') == 'user') {
            redirect(site_url() . 'start/homepage');
        }

        $module = 'contact_us';
        if ($this->pg_module->is_module_installed('tickets')) {
            $module = 'tickets';
        }

        $this->view->assign('module', $module);
        $this->view->render('user_blocked');
    }

    public function inactive()
    {
        if ($this->session->userdata('auth_type') == 'user') {
            redirect(site_url() . 'start/homepage');
        }

        $module = 'contact_us';
        if ($this->pg_module->is_module_installed('tickets')) {
            $module = 'tickets';
        }
        $this->view->assign('module', $module);
        $this->view->render('user_inactive');
    }

    public function setViewMode($view_mode)
    {
        if (in_array($view_mode, ['list', 'gallery'])) {
            $_SESSION['search_view_mode'] = $view_mode;
        }
    }

    public function preventView()
    {
        $data['available_activation'] = $this->Users_model->checkAvailableUserActivation($this->user_id);
        $service_status = $this->Users_model->serviceAvailableUserActivateInSearchAction($this->user_id);

        if (in_array('user_logo', $data['available_activation']['fields']) || in_array('id_region', $data['available_activation']['fields']) || in_array('id_country', $data['available_activation']['fields'])) {
            if (in_array('user_logo', $data['available_activation']['fields'])) {
                $this->view->assign('user_logo_button', '1');
            }
            if (in_array('id_region', $data['available_activation']['fields']) || in_array('id_country', $data['available_activation']['fields'])) {
                $this->view->assign('user_location_button', '1');
            }
        } else {
            if ($service_status["content_buy_block"] == true) {
                $this->view->assign('user_service_button', '1');
            }
        }

        exit($this->view->fetch('prevent_view', 'user', 'users'));
    }

    public function getChangeLocationForm()
    {
        if ($this->user_id) {
            $user = $this->Users_model->getUserById($this->user_id, true);
            $this->view->assign('user', $user);
            $this->view->output($this->view->fetchFinal('change_location_form'));
            $this->view->render();
        }
    }

    public function setChangeLocationForm()
    {
        if ($this->user_id) {
            $post_data = [
                'id_country' => $this->input->post('id_country', true),
                'id_region' => $this->input->post('id_region', true),
                'id_city' => $this->input->post('id_city', true),
                'lat' => $this->input->post('lat', true),
                'lon' => $this->input->post('lon', true),
            ];
            $validate_data = $this->Users_model->validate($this->user_id, $post_data);
            if (empty($validate_data['errors'])) {
                $this->Users_model->saveUser($this->user_id, $validate_data['data']);
                $validate_data['success'] = l('success_update_user', 'users');
            }
            exit(json_encode($validate_data));
        }
    }

    /**
     *  Clear cookies
     *
     * @return void
     */
    protected function clearCookies($cookie)
    {
        setcookie(
            $cookie,
            '',
            (time() - 31500000),
            '/' . SITE_SUBFOLDER,
            COOKIE_SITE_SERVER
        );
    }

    /**
     *  Get user site status
     *
     * @return void
     */
    public function getAvailableActivation()
    {
        $return = [];
        if ($this->user_id) {
            $this->load->helper('cookie');
            $cookie = get_cookie('available_activation', true);
            if (!$cookie) {
                $available_activation = $this->Users_model->checkAvailableUserActivation($this->user_id);
                if (!$available_activation['status']) {
                    if ($available_activation['logout']) {
                        $this->logout();
                    }
                    $return['info']['title'] = l('text_inactive_in_search', 'users');
                    $return['info']['subtitle'] = l('text_need_for_activation', 'users');
                    foreach ($available_activation['fields'] as $field) {
                        if ($field == 'user_logo_moderation') {
                            $return['info']['items'][$field]['text'] = l('wait_image_approve', 'users');
                        } elseif ($field == 'user_logo') {
                            $return['info']['items'][$field]['text'] = l('upload_photo', 'users');
                            $return['info']['items'][$field]['button'] = l('upload_photo', 'users');
                        } elseif (in_array($field, ['id_region', 'id_country']) === true) {
                            $return['info']['items']['location']['text'] = l('user_location_button', 'users');
                            $return['info']['items']['location']['button'] = l('user_location_button', 'users');
                        } else {
                            $return['info']['items'][$field]['text'] = l('fill_field', 'users') . ":&nbsp;" . l('field_' . $field, 'users');
                            $return['info']['items'][$field]['button'] = l('btn_edit', 'start') . "&nbsp;" . l('field_' . $field, 'users');
                        }
                    }
                }
            }
        }
        exit(json_encode($return));
    }

    public function ajaxAccount($action = 'services', $page = 1)
    {
        $page = (int)($page);

        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($this->user_id);

        $user = $this->Users_model->getUserById($this->user_id);
        $this->pg_seo->set_seo_data($user);

        // breadcrumbs
        $this->Menu_model->breadcrumbsSetParent('account-item');

        $this->load->helper('seo');
        $base_url = rewrite_link('users', 'account', ['action' => $action]);
        $this->setAccountMenu($action);

        $this->view->assign('base_url', $base_url);
        $this->view->assign('page', $page);
        $this->view->assign('action', $action);
        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('user', $user);
        $return['content'] = $this->view->fetch('ajax_account');

        $this->view->assign($return);
        $this->view->render();
    }

    /**
     * User field data
     *
     * @return mixed
     */
    public function getUserField()
    {
        $field = filter_input(INPUT_POST, 'field', FILTER_SANITIZE_STRING);
        $this->load->model(UsersModel::MODULE_GID . '/models/UsersFieldsModel');

        if ($this->Users_model->is_couples_installed === true && $this->session->userdata['couple_id']) {
            $this->load->model('couples/models/CouplesFieldsModel');
            $return = $this->CouplesFieldsModel->getFieldData($field);
        } else {
            $return = $this->UsersFieldsModel->getFieldData($field);
        }

        if (!empty($return['data']['option'][$field])) {
            $sorter = 0;
            foreach ($return['data']['option'][$field] as $key => $value) {
                $return['data']['sort'][++$sorter] = $key;
            }
        }

        $this->view->assign($return);
        $this->view->render();
    }

    /**
     * Save user field data
     *
     * @return string
     */
    public function setUserField()
    {
        $post_data = [];
        if ($this->Users_model->is_couples_installed === true && $this->session->userdata['couple_id']) {
            $this->load->model([UsersModel::MODULE_GID . '/models/Users_fields_model',
                'couples/models/Couples_fields_model']);
            $fields = $this->Couples_fields_model->fields;
            $this->load->model('Field_editor_model');
            $fields_for_select = $this->Field_editor_model->getFieldsForSelect();
            \Pg\modules\couples\models\CouplesModel::addPersonalFields($fields_for_select);
        } else {
            $this->load->model(UsersModel::MODULE_GID . '/models/Users_fields_model');
            $fields = $this->Users_fields_model->fields;
        }
        $field_name = $this->input->post('field_name', true);
        foreach ($fields as $field => $data) {
            if ($this->input->post($field, true) !== false) {
                $post_data[$field] = $this->input->post($field, true);
            }
        }
        $return = [];
        $validate = $this->Users_model->validate($this->user_id, $post_data, null, '', 'save');

        //Save empty field values
        //except field group, like fname_sname
        if (!empty($field_name)) {
            if (in_array($field_name, array_keys($post_data)) && !isset($validate['data'][$field_name])) {
                $validate['data'][$field_name] = false;
            }
        }
        //empty field
        foreach ($post_data as $f_name => $f_value) {
            if (!isset($validate['data'][$f_name])) {
                $validate['data'][$f_name] = '';
            }
        }

        if (!empty($validate["errors"])) {
            $return['status'] = View::MSG_ERROR;
            $return['msg'] = $validate["errors"];
        } else {
            if ($this->input->post('save') == 1) {
                //to save empty location, if user unset location field
                unset($validate['data']['region_name']);

                $user_id = $this->Users_model->saveUser($this->user_id, $validate['data']);
                if ($this->Users_model->is_couples_installed === true) {
                    if (!empty($validate['couple'])) {
                        $this->Couples_model->saveUser($validate['couple'], 'user_icon');
                    }
                }
                $this->Users_fields_model->updateSessionByFields($validate['data']);
                if ($this->user_id == $user_id) {
                    $return['status'] = View::MSG_SUCCESS;
                    $return['msg'] = l('success_update_user', UsersModel::MODULE_GID);
                    $return['data'] = $this->Users_fields_model->getFieldDataStr($validate["data"], true);
                    if ($this->Users_model->is_couples_installed === true) {
                        if (!empty($validate['couple'])) {
                            $return['couple'] = $this->Couples_fields_model->getFieldDataStr($validate["couple"]['data'], true);
                        }
                    }
                }
            } else {
                $return['data'] = $this->Users_fields_model->getFieldDataStr($validate["data"]);
                if ($this->Users_model->is_couples_installed === true) {
                    if (!empty($validate['couple'])) {
                        $return['couple'] = $this->Couples_fields_model->getFieldDataStr($validate["couple"]['data'], true);
                    }
                }
            }

            if (empty($return['data'])) {
                $this->load->helper('users');
                $return['example'] = l('field_add', 'users') . ': ' . usersFieldsExample(['field' => $field_name]);
            }

            /*Очищаем данные форм для поисков (сбрасываем)*/
            $this->session->unset_userdata("users_search");
            $this->session->unset_userdata("perfect_match_full");
        }
        exit(json_encode($return));
    }

    /**
     * Registration
     */
    public function registration()
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            return $this->photoUpload();
        }

        $post = $this->input->post('data', true);
        if (!isset($post['captcha_confirmation'])) {
            $post['captcha_confirmation'] = $this->input->post('g-recaptcha-response', true);
        }

        $post['referral_code'] = $this->input->post('referral_code', true);

        $validate = $this->Users_model->validate(null, $post);

        $data = $validate["data"];
        if (!empty($validate["errors"])) {
            $dump_validate = [];
            if (isset($validate["errors"]['email'])) {
                $dump_validate["errors"]['email'] = $validate["errors"]['email'];
            }
            if (isset($validate["errors"]['password'])) {
                $dump_validate["errors"]['password'] = $validate["errors"]['password'];
            }
            if (isset($validate["errors"]['confirmation'])) {
                $dump_validate["errors"]['confirmation'] = $validate["errors"]['confirmation'];
            }

            if (!empty($dump_validate["errors"])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $dump_validate["errors"]);
                $this->view->assign('errors_data', $dump_validate["errors"]);
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate["errors"]);
                $this->view->assign('errors_data', $validate["errors"]);
            }

            // TODO: user registration by email
            $this->load->library('Analytics');
            $this->analytics->track('user_email_register_fail', ['controller' => 'users']);

            $this->view->assign(['errors' => $validate["errors"]]);
            $this->view->render();

            return;
        }
        $data['activity'] = 0;
        if ($this->use_email_confirmation) {
            $data["confirm"] = 0;
            $data["confirm_code"] = substr(md5(date(UsersModel::DB_DATE_FORMAT) . $data["nickname"]), 0, 10);
        } else {
            $data["confirm"] = 1;
            $data["confirm_code"] = "";
        }
        $data["approved"] = $this->use_approve ? 0 : 1;
        $saved_password = $data["password"];
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $data["lang_id"] = $this->session->userdata("lang_id");
        if (!$data["lang_id"]) {
            $data["lang_id"] = $this->pg_language->get_default_lang_id();
        }

        $user_id = $this->Users_model->registerUser($data);
        if ($this->Users_model->is_couples_installed === true) {
            $this->load->model("Couples_model");
            $this->Couples_model->registerUser($user_id, $data, $validate);
        }

        if ($this->ci->pg_module->is_module_installed('subscriptions')) {
            $this->ci->load->model("subscriptions/models/Subscriptions_users_model");
            $this->ci->Subscriptions_users_model->saveUserSubscriptions($user_id, $this->ci->input->post('user_subscriptions_list'));
        }

        $this->load->model('Notifications_model');
        $data["password"] = $saved_password;
        if ($this->use_email_confirmation) {
            $link = site_url("users/confirm/" . $data["confirm_code"]);
            $data["confirm_block"] = l('confirmation_code', UsersModel::MODULE_GID) . ': ' . $data["confirm_code"] . "\n\n" . str_replace("[link]", $link, l('confirm_block_text', 'users'));
        }
        $data['fname'] = UsersModel::formatUserName($data);
        $this->Notifications_model->sendNotification($data["email"], 'users_registration', $data, '', $data['lang_id']);

        $this->load->library('Analytics');
        $event = $this->analytics->getEvent('registration', 'email', 'user');
        $this->analytics->track($event);

        $this->load->model("users/models/Auth_model");
        $auth_data = $this->Auth_model->login($user_id, true);
        if (!empty($auth_data["errors"])) {
            $this->view->assign(['errors' => [l('error_access_denied', UsersModel::MODULE_GID)]]);
            $this->view->render();

            return;
        }
        $this->view->assign(['redirect' => site_url('users/photoUpload')]);
        $this->view->render();

        return;

        $this->view->assign('user_data', $data);
        $this->load->model('Start_model');
        $template_name = $this->Start_model->templateName();
        $this->view->render($template_name, 'user', 'start');
    }

    /**
     * Field validation
     *
     * @return void
     */
    public function fieldValidation()
    {
        $post = $this->input->post('data', true);
        if (!empty($post)) {
            $this->load->model("users/models/Users_fields_validation_model");
            $result = $this->Users_fields_validation_model->fieldValidation($post);
            $this->view->assign($result);
            $this->view->render();
        }
    }

    /**
     * Photo upload page
     *
     * @return void
     */
    public function photoUpload()
    {
        $this->view->assign('page_type', 'photo_upload');
        $this->view->render('user_photo_uploader');
    }

    /**
     * Rotate upload
     *
     * @param integer/string $angle     rotate angle
     *
     * @return void
     */
    public function photoRotate($angle = 90)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];
        $user = $this->Users_model->getUserById($this->user_id, true);
        $logo_name = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        if ($angle < 0) {
            $angle += 360;
        } elseif ($angle != 'hor') {
            $angle = (int)($angle);
        }

        if ($user[$logo_name]) {
            $this->load->model('Uploads_model');
            $this->Uploads_model->rotateUpload($this->Users_model->upload_config_id, $this->user_id, $user[$logo_name], $angle);
            $result['data']['img_url'] = $user['media']['user_logo']['file_url'];
            $result['data']['thumbs'] = $user['media']['user_logo']['thumbs'];
            $result['data']['rand'] = rand(0, 999999);
            $result['msg'][] = l('photo_successfully_saved', UsersModel::MODULE_GID);
        } else {
            $result['status'] = 0;
            $result['errors'][] = 'access denied';
        }

        $this->view->assign($result);
        $this->view->render();
    }

    /**
     * Is service activation
     *
     * return string
     */
    public function isActiveService()
    {
        $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);
        if (!empty($gid)) {
            $result = $this->Users_model->isActiveService($gid);
            $this->view->assign($result);
            $this->view->render();
        }
    }

    public function iAgreeTerms()
    {
        $is_agree = filter_input(INPUT_POST, 'agree', FILTER_VALIDATE_INT);
        if ($this->ci->session->userdata('auth_type') === 'user' && !empty($is_agree)) {
            $this->Users_model->saveUser($this->user_id, ['is_terms' => 1]);
            $this->load->model("users/models/Auth_model");
            $this->Auth_model->updateUserSessionData($this->user_id);
            $this->view->assign(['success' => l('success_user_updated', 'users')]);
            $this->view->render();
        }
    }

    public function setUserIds()
    {
        $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);
        if (!empty($gid)) {
            $this->load->model('users/models/Users_search_ids_model');
            $this->Users_search_ids_model->resetUserIds($gid);
            $this->view->render();
        }
    }

    /**
     * Load registration form
     *
     * @return mixed
     */
    public function loadRegForm()
    {
        $this->load->helper('users');
        $this->view->assign('content', \Pg\modules\users\helpers\usersRegistration(['page' => 1, 'is_link' => 1]));
        $return['html'] = $this->view->fetch('registration_widget', 'user', 'users');
        exit(json_encode($return));
    }
}
