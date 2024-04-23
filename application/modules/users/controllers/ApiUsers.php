<?php

declare(strict_types=1);

namespace Pg\modules\users\controllers;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\View;
use Pg\modules\users\models\events\EventUsers;
use Pg\modules\users\models\FieldEditorModel;
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
class ApiUsers extends \Controller
{
    public $use_email_confirmation = false;
    public $use_approve = false;
    private $user_id;
    private $subsections = [
        'default' => 'all',
        'photo',
        'video',
        'albums',
        'favorites'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model("Users_model");
        $this->use_email_confirmation = (bool) $this->ci->pg_module->get_module_config('users', 'user_confirm');
        $this->use_approve = (bool)$this->ci->pg_module->get_module_config('users', 'user_approve');
        $this->user_id = (int)$this->ci->session->userdata('user_id');
    }

    /**
     * @api {post} /users/logout Logout
     * @apiGroup Users
    */
    public function logout()
    {
        $this->load->model("users/models/Auth_model");

        $this->Auth_model->logoff();
        $this->session->sess_create();
        $token = $this->session->sess_create_token();
        $this->set_api_content('data', ['token' => $token]);
    }

    /**
    * @api {post} /users/logout Get user
    * @apiGroup Users
    * @apiParam {int} [id] user id
    */
    public function get()
    {
        $user_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (empty($user_id)) {
            $user_id = $this->user_id;
        }
        $user = $this->Users_model->getUserById($user_id, true);
        if ($user) {
            // for notifications
            $theme_data = $this->view->getThemeSettings();
            $user['notification_logo'] = site_url() . $theme_data['mini_logo']['path'];
            $user['notification_output_name'] = l('site_notification', 'chatbox');
            $user['notification_class'] = 'site_logo';

            $this->set_api_content('data', $user);
        } else {
            $this->set_api_content('errors', l('error_not_found', 'users'));
        }
    }

    /**
    * @api {post} /users/view View a user
    * @apiGroup Users
    * @apiParam {int} id user id
    * @apiParam {int} [lang_id] language id
    * @apiParam {string} [section] type page
    */
    public function view()
    {
        $viewer_id = $this->user_id;
        $user_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$this->ci->Users_model->checkGuestAccess($user_id, $viewer_id)) {
            $this->system_messages->addMessage(View::MSG_ERROR, l('error_guest_limit', 'users'), 'users');
            $this->set_api_content('code', 403);
        }

        $event_handler = EventDispatcher::getInstance();
        $event         = new EventUsers();
        $event->setProfileViewFrom($viewer_id);
        $event->setProfileViewTo($user_id);
        $event_handler->dispatch($event, 'profile_view');

        $lang_id = filter_input(INPUT_POST, 'lang_id', FILTER_VALIDATE_INT);
        $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);

        if (!$section) {
            if ($this->ci->pg_module->is_module_active('wall_events')) {
                $section = 'wall';
            } else {
                $section = 'view';
            }
        }

        if ($viewer_id) {
            $viewer_raw = $this->Users_model->getUserById($viewer_id);
            $viewer = $this->Users_model->formatUser($viewer_raw);
        } else {
            $viewer = [];
        }

        if ($viewer_id && $viewer_id != $user_id && !$viewer['is_hide_on_site']) {
            $this->ci->load->model('users/models/Users_views_model');
            $this->ci->Users_views_model->updateViews($user_id, $viewer_id);
        }

        $field_editor = new FieldEditorModel();

        $api_data['user'] = $field_editor->getUserById($user_id, $lang_id);
        if (empty($api_data['user'])) {
            show_404();
        }

        $api_data['user'] = $this->ci->Users_model->formatUser($api_data['user'], false, $lang_id);

        // TODO: загружать в отдельном метода который грузит настройки и сохранять в кэше
        $api_data['sections'] = $field_editor->formatSections($api_data['user'], $lang_id);

        $api_data['profile_section'] = $section;
        // END TODO
        $this->ci->view->assign('data', $api_data);

        $this->ci->view->render();
    }

    /**
    * @api {post} /users/userStatus Status of my profile
    * @apiGroup Users
    */
    public function userStatus()
    {
        $id_user = intval($this->session->userdata('user_id'));
        $this->set_api_content('data', ['is_active' => $this->Users_model->isActivityUser($id_user)]);
    }

    /**
    * @api {post} /users/profile View my profile
    * @apiGroup Users
    * @apiParam {string} [section] profile section
    * @apiParam {string} [subsection] profile subsection
    * @apiParam {int} lang_id language id
    */
    public function profile()
    {
        $user_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$user_id) {
            $user_id = $this->user_id;
        } elseif ($user_id != $this->user_id) {
            $is_allowed = $this->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                new \Pg\Libraries\Acl\Resource\Page(
                    ['module' => 'users', 'controller' => 'users', 'action' => 'view']
                )
            ), false);
            if (!$is_allowed) {
                $this->set_api_content('info', ['access_denied' => str_replace(
                    '%access_permissions_page%',
                    site_url('access_permissions'),
                    l('info_action_change_group', 'access_permissions')
                )]);
            }
        }
        $is_my_profile = filter_input(INPUT_POST, 'is_my_profile', FILTER_VALIDATE_BOOLEAN);
        $profile_section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
        $subsection = filter_input(INPUT_POST, 'subsection', FILTER_SANITIZE_STRING);
        $lang_id = filter_input(INPUT_POST, 'lang_id', FILTER_VALIDATE_INT);
        if (empty($profile_section)) {
            $profile_section = $this->pg_module->is_module_installed('wall_events') ? 'wall' : 'view';
        } elseif ($profile_section == 'gallery') {
            if (!in_array($subsection, $this->subsections)) {
                $subsection = $this->subsections['default'];
            }
        }

        $this->load->model('Field_editor_model');
        $this->Field_editor_model->initialize($this->Users_model->form_editor_type);

        $fields_for_select = [];
        if ($profile_section != 'view' && $profile_section != 'wall' && $profile_section != 'gallery' && $profile_section != 'subscriptions') {
            $section = $this->Field_editor_model->getSectionByGid($profile_section);
            if (!empty($section)) {
                $fields_for_select = $this->Field_editor_model->getFieldsForSelect($section['gid']);
            }
        } elseif ($profile_section == 'view' || $profile_section == 'wall') {
            $sections = $this->Field_editor_model->getSectionList();
            $sections_gids = array_keys($sections);
            $fields_for_select = $this->Field_editor_model->getFieldsForSelect($sections_gids);
        }
        $this->Users_model->setAdditionalFields($fields_for_select);
        $data = $this->Users_model->formatUser(
            $this->Users_model->getUserById($user_id),
            false,
            $lang_id
        );

        $my_data = [];

        if ($user_id != $this->user_id) {
            $my_data = $this->Users_model->formatUser(
                $this->Users_model->getUserById($this->user_id),
                false,
                $lang_id
            );
        } else {
            $my_data = $data;
        }

        if ($user_id == $this->user_id) {
            if (!$data['activity']) {
                $data['available_activation'] = $this->Users_model->checkAvailableUserActivation($user_id);
            }
        }

        if ($profile_section == 'view' || $profile_section == 'wall') {
            foreach ($sections as $sgid => $sdata) {
                $params["where"]["section_gid"] = $sgid;
                $sections[$sgid]['fields'] = $this->Field_editor_model->formatItemFieldsForView($params, $data, $lang_id);
            }
        } elseif (!empty($section)) {
            $params["where"]["section_gid"] = $section['gid'];
            $fields_data = $this->Field_editor_model->getFormFieldsList($data, $params, null, [], $lang_id);
            $data['fields_data'] = $fields_data;
        }
        if ($profile_section == 'personal') {
            $this->load->model('Properties_model');
            $user_types = $this->Properties_model->getProperty('user_type');
            $data['user_types'] = $user_types;
            $age_range = range($this->pg_module->get_module_config('users', 'age_min'), $this->pg_module->get_module_config('users', 'age_max'));
            $data['age_range'] = $age_range;
        }

        if ($is_my_profile) {
            $result['user'] = $data;
            $result['sections'] = $sections;
            $result['profile_section'] = $profile_section;
            $result['my_data'] = $my_data;
            $this->set_api_content('data', $result);
        } else {
            $this->set_api_content('data', $data);
        }
    }

    /**
    * @api {post} /users/settings User settings page
    * @apiGroup Users
    * @apiParam {boolean} [password_save] if you change password
    * @apiParam {string} [password] password
    * @apiParam {string} [repassword] repassword
    * @apiParam {boolean} [contact_save] if you change contact information
    * @apiParam {string} [email] email
    * @apiParam {string} [phone] phone
    * @apiParam {boolean} [btn_subscriptions_save] if you change subscriptions
    * @apiParam {boolean} [show_adult] if check show adult
    * @apiParam {array} [user_subscriptions_list] user subscriptions list
    */
    public function settings()
    {
        $user_id = $this->user_id;

        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($user_id);
        $errors = [];
        $messages = [];
        if ($this->input->post('password_save')) {
            $post_data = [
                "password"   => $this->input->post('password', true),
                "repassword" => $this->input->post('repassword', true),
            ];
            $validate_data = $this->Users_model->validate($user_id, $post_data);

            if (!empty($validate_data["errors"])) {
                $errors[] = $validate_data["errors"];
            } else {
                $save_data = $validate_data["data"];
                $save_password = $save_data["password"];
                $save_data["password"] = password_hash($save_data["password"], PASSWORD_DEFAULT);
                $user_id = $this->Users_model->saveUser($user_id, $save_data);

                // send notification
                $this->load->model('Notifications_model');
                $user_data = $this->Users_model->getUserById($user_id);
                $user_data["password"] = $save_password;
                $user_data["fname"] = UsersModel::formatUserName($user_data);
                $user_data['contact_us'] = $this->ci->pg_module->is_module_installed('tickets') ? site_url('tickets') : site_url('contact_us');
                $data['sending_result'] = $this->Notifications_model->sendNotification($user_data["email"], 'users_change_password', $user_data, '', $user_data['lang_id']);
                $messages[] = l('success_user_updated', 'users');
            }
        }

        if ($this->input->post('contact_save')) {
            $post_data = [
                "email"      => $this->input->post('email', true),
                "phone"      => $this->input->post('phone', true),
                "show_adult" => $this->input->post('show_adult', true),
            ];
            $validate_data = $this->Users_model->validate($user_id, $post_data);

            if (!empty($validate_data["errors"])) {
                $errors[] = $validate_data["errors"];
            } else {
                $user_data = $this->Users_model->getUserById($user_id);
                $save_data = $validate_data["data"];
                $user_id = $this->Users_model->saveUser($user_id, $save_data);

                // send notification
                if ($user_data["email"] != $save_data["email"]) {
                    $this->load->model('Notifications_model');
                    $user_data["new_email"] = $save_data["email"];
                    $user_data["fname"] = UsersModel::formatUserName($user_data);
                    $this->Notifications_model->sendNotification($user_data["email"], 'users_change_email', $save_data, '', $user_data['lang_id']);
                    $this->Notifications_model->sendNotification($user_data["new_email"], 'users_change_email', $save_data, '', $user_data['lang_id']);
                }

                $this->load->model('users/models/Auth_model');
                $this->Auth_model->updateUserSessionData($user_id);
                $messages[] = l('success_user_updated', 'users');
            }
        }

        if ($this->input->post('btn_subscriptions_save') && $this->pg_module->is_module_installed('subscriptions')) {
            // Save user subscribers
            $user_subscriptions_list = $this->input->post('user_subscriptions_list', true);
            $this->load->model('subscriptions/models/Subscriptions_users_model');
            $this->Subscriptions_users_model->saveUserSubscriptions($user_id, $user_subscriptions_list);
        }

        $user = $this->Users_model->getUserById($user_id);

        $data['user_id'] = $user_id;
        $data['user'] = $user;
        $this->set_api_content('data', $data);
        $this->set_api_content('errors', $errors);
        $this->set_api_content('messages', $messages);
    }

    /**
    * @api {post} /users/user User data
    * @apiGroup Users
    */
    public function user()
    {
        $this->load->model('users/models/Auth_model');
        $this->Auth_model->updateUserSessionData($this->user_id);
        $user = $this->Users_model->formatUser($this->Users_model->getUserById($this->user_id));
        $data = [
            'user_id' => $this->user_id,
            'user'    => $user,
        ];
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /users/validate Validate user data before save
    * @apiGroup Users
    * @apiParam {string} [nickname] nickname
    * @apiParam {string} [password] password
    * @apiParam {string} [repassword] repassword
    * @apiParam {date} [birth_date] birthdate
    * @apiParam {string} [email] email
    * @apiParam {string} [user_type] user type
    * @apiParam {boolean} [confirmation] if you check confirmation
    */
    public function validate()
    {
        $data = [];
        $errors = [];
        $filter_args = [
            'email'        => FILTER_VALIDATE_EMAIL,
            'password'     => FILTER_SANITIZE_STRING,
            'repassword'   => FILTER_SANITIZE_STRING,
            'birth_date'   => FILTER_SANITIZE_STRING,
            'user_type'    => FILTER_SANITIZE_STRING,
            'confirmation' => FILTER_VALIDATE_BOOLEAN,
        ];

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');
        if ($pm_installed) {
            $filter_args['looking_user_type'] = FILTER_SANITIZE_STRING;
        }

        $post_data = filter_input_array(INPUT_POST, $filter_args);
        if ($pm_installed) {
            $post_data['age_min'] = $this->pg_module->get_module_config('users', 'age_min');
            $post_data['age_max'] = $this->pg_module->get_module_config('users', 'age_max');
        }

        $this->Users_model->fields_register = ['email', 'password', 'user_type'];
        if (false === filter_input(INPUT_POST, 'strict', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
            $this->Users_model->fields_register = [];
        }
        $validate_data = $this->Users_model->validate(null, $post_data, 'user_icon');
        if (!empty($validate_data['errors'])) {
            $errors[] = $validate_data['errors'];
            $data = $validate_data['data'];
        }

        $this->set_api_content('errors', $errors);
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /users/registration Registration
    * @apiGroup Users
    * @apiParam {string} [nickname] nickname
    * @apiParam {string} [password] password
    * @apiParam {string} [repassword] repassword
    * @apiParam {date} [birth_date] birthdate
    * @apiParam {string} [email] email
    * @apiParam {string} [user_type] user type
    * @apiParam {boolean} [confirmation] if you check confirmation
    * @apiParam {string} [id_country] country code
    * @apiParam {int} [id_region] region id
    * @apiParam {int} [id_city] city id
    * @apiParam {float} [lat] latitude
    * @apiParam {float} [lon] longitude
    * @apiParam {string} [captcha_confirmation] captcha confirmation
    * @apiParam {string} [looking_user_type] looking user type
    * @apiParam {int} [age_min] age min for looking
    * @apiParam {int} [age_max] age max for looking
    */
    public function registration()
    {
        if (isset($this->session->userdata['auth_type'])) {
            if ($this->session->userdata['auth_type'] == 'user') {
                $this->set_api_content('errors', l('error_access_denied', 'users'));

                return false;
            }
        }

        $errors = [];
        $messages = [];
        $post_data = filter_input_array(INPUT_POST, [
            'email'        => FILTER_SANITIZE_STRING,
            'password'     => FILTER_SANITIZE_STRING,
            'repassword'   => FILTER_SANITIZE_STRING,
            'nickname'     => FILTER_SANITIZE_STRING,
            'birth_date'   => FILTER_SANITIZE_STRING,
            'user_type'    => FILTER_SANITIZE_STRING,
            'confirmation' => FILTER_VALIDATE_BOOLEAN,
            'id_country'   => FILTER_SANITIZE_STRING,
            'id_region'    => FILTER_VALIDATE_INT,
            'id_city'      => FILTER_VALIDATE_INT,
            'lat'          => FILTER_VALIDATE_FLOAT,
            'lon'          => FILTER_VALIDATE_FLOAT,
            'captcha_confirmation' => FILTER_SANITIZE_STRING,
            'is_app' => FILTER_VALIDATE_BOOLEAN
        ]);

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');
        if ($pm_installed) {
            $post_data_pm = filter_input_array(INPUT_POST, [
                'looking_user_type' => FILTER_SANITIZE_STRING,
                'age_min'           => FILTER_VALIDATE_INT,
                'age_max'           => FILTER_VALIDATE_INT,
            ]);

            $post_data = array_merge($post_data, $post_data_pm);
        }

        $this->Users_model->fields_register = ['birth_date','email','password','user_type'];
        $validate_data = $this->Users_model->validate(null, $post_data, 'user_icon');

        $data = $validate_data["data"];
        if (!empty($validate_data["errors"])) {
            $errors[] = $validate_data["errors"];
        } else {
            $data['activity'] = 0;
            if ($this->use_email_confirmation) {
                $data["confirm"] = 0;
                $data["confirm_code"] = substr(md5(date("Y-m-d H:i:s") . $data["nickname"]), 0, 10);
            } else {
                $data["confirm"] = 1;
                $data["confirm_code"] = "";
            }
            $data["approved"] = $this->use_approve ? 0 : 1;
            $opened_password = $data["password"];
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
            $data["lang_id"] = $this->session->userdata("lang_id");
            if (!$data["lang_id"]) {
                $data["lang_id"] = $this->pg_language->get_default_lang_id();
            }

            $user_id = $this->Users_model->registerUser($data);

            $this->load->model('Notifications_model');
            $data['password'] = $opened_password;
            $data['user_id'] = $user_id;
            if ($this->use_email_confirmation) {
                $data["confirm_block"] = l('confirmation_code', 'users') . ': ' . $data["confirm_code"];
                $this->load->model("users/models/Auth_model");
                $auth_data = $this->Auth_model->login($user_id);
                if (!empty($auth_data["errors"])) {
                    $messages = array_merge($messages, $auth_data["errors"]);
                }
            } else {
                $messages[] = l('info_please_checkout_mailbox', 'users');
            }
            $data["fname"] = UsersModel::formatUserName($data);
            $this->Notifications_model->sendNotification($data["email"], 'users_registration', $data, '', $data['lang_id']);
        }

        $data['token'] = $this->session->sess_create_token();
        $this->set_api_content('errors', $errors);
        $this->set_api_content('messages', $messages);
        $this->set_api_content('data', $data);
    }

    /**
    * @api {post} /users/restore Restore password
    * @apiGroup Users
    * @apiParam {string} code user email
     * @apiParam {string} email user email
    */
    public function restore($code = false)
    {
        if ($this->session->userdata('auth_type') === 'user') {
            return true;
        }
        $errors = [];
        $messages = [];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $user_data = $this->Users_model->getUserByEmail($email);
        $this->load->model('users/models/Users_restore_password');
        if (empty($user_data) || !$user_data["id"]) {
            $this->Users_restore_password->userNoExists($email);
            $errors[] = l('error_user_no_exists', 'users');
        } elseif (!$user_data["confirm"]) {
            $this->Users_restore_password->userUnconfirmed($user_data);
            $errors[] = l('error_unconfirmed_user', 'users');
        } elseif (!$user_data["approved"]) {
            $this->Users_restore_password->userIsBlocked($user_data);
            $errors[] = l('error_user_is_blocked', 'users');
        } else {
            $this->Users_restore_password->restore($user_data);
            $messages[] = l('success_restore_mail_sent', 'users');
        }
        $this->set_api_content('messages', $messages);
        $this->set_api_content('errors', $errors);
    }

    /**
    * @api {post} /users/confirm Confirmation user
    * @apiGroup Users
    * @apiParam {string} [code] confirmation code
    */
    public function confirm($code = '')
    {
        $code = trim(strip_tags($code));
        if (!$code) {
            $code = $this->input->post('code', true);
        }
        if (!$code) {
            return;
        }
        $errors = [];
        $messages = [];
        $user = $this->Users_model->getUserByConfirmCode($code);
        if (empty($user)) {
            $errors[] = l('error_user_no_exists_confirm_code', 'users');
            $this->set_api_content('errors', $errors);

            return false;
        } elseif ($user["confirm"]) {
            $errors[] = l('error_user_already_confirm', 'users');
            $this->set_api_content('errors', $errors);

            return false;
        }
        $data["confirm"] = 1;
        $this->Users_model->saveUser($user["id"], $data);

        $messages[] = l('success_confirm', 'users');

        $this->load->model("users/models/Auth_model");
        $auth_data = $this->Auth_model->login($user["id"]);
        if (!empty($auth_data["errors"])) {
            $errors[] = $auth_data["errors"];
        }
        $token = $this->session->sess_create_token();
        $this->set_api_content('data', ['token' => $token]);

        $this->set_api_content('errors', $errors);
        $this->set_api_content('messages', $messages);
    }

    /**
    * @api {post} /users/getUsersData Get users data
    * @apiGroup Users
    * @apiParam {string} [search] search string
    * @apiParam {array} [selected] selected ids
    * @apiParam {string} [user_type] user type
    * @apiParam {int} [page] page of results
    */

    public function getUsersData()
    {
        $return = [];

        $params = [];

        $search_string = trim(strip_tags((string) $this->input->post('search', true)));
        if (!empty($search_string)) {
            $params["where"]["nickname LIKE"] = "%" . $search_string . "%";
        }

        $selected = $this->input->post('selected', true);

        if (!empty($selected)) {
            $params["where_sql"][] = "id NOT IN (" . implode(', ', $selected) . ")";
        }

        $user_type = $this->input->post('user_type', true);

        if ($user_type) {
            $params["where"]["user_type"] = $user_type;
        }

        $page = intval($this->input->post('page', true));
        if (!$page) {
            $page = 1;
        }

        $items_on_page = 20;

        $items = $this->Users_model->getUsersListByKey($page, $items_on_page, ["id" => "desc", "nickname" => "asc"], $params, [], true, true);

        $return["all"] = $this->Users_model->getUsersCount($params);
        $return["items"] = array_values($items);
        $return["current_page"] = $page;
        $return["pages"] = ceil($return["all"] / $items_on_page);

        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/getSelectedUsers Get selected users data
    * @apiGroup Users
    * @apiParam {array} [selected] selected ids
    */
    public function getSelectedUsers()
    {
        $selected = $this->input->post('selected', true);
        if (!empty($selected)) {
            $params["where_in"]["id"] = $selected;
            $return = $this->Users_model->getUsersList(null, null, ["nickname" => "asc"], $params, null, true, true);
        } else {
            $return = [];
        }
        $this->set_api_content('data', $return);

    }

    /**
    * @api {post} /users/search Search users
    * @apiGroup Users
    * @apiParam {string} [order] sorting order
    * @apiParam {string} [order_direction] sorting direction
    * @apiParam {int} [page] page of results
    * @apiParam {array} [post_data] post data
    * @apiParam {float} [circle_center_lat] circle center latitude
    * @apiParam {float} [circle_center_lon] circle center longtitude
    * @apiParam {int} [circle_radius] circle radius
    */
    public function search()
    {
        if (empty($this->session->userdata['user_agent'])) {
            $this->session->set_userdata("user_agent", "Mobile application");
        }
        UsersModel::siteVisits($this->session->userdata);

        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event->setSearchFrom($this->user_id);
        $event_handler->dispatch($event, 'user_search');

        $order = filter_input(INPUT_POST, 'order', FILTER_SANITIZE_STRING);
        if (!$order) {
            $order = 'default';
        }
        $order_direction = filter_input(INPUT_POST, 'order_direction', FILTER_SANITIZE_STRING);
        if (!$order_direction) {
            $order_direction = 'DESC';
        }
        $page = filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT);
        if (!$page) {
            $page = 1;
        }
        $data = [];
        $post_data = filter_input_array(INPUT_POST);
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_value) {
                $data[$key] = $post_value;
            }
            $data = array_merge($this->Users_model->getMinimumSearchData(), $data);
        } elseif ($this->session->userdata('users_search')) {
            $data = $this->session->userdata('users_search');
        }

        if ($this->input->post('circle_radius', true) && $this->pg_module->is_module_installed('nearest_users')) {
            $this->load->model('Nearest_users_model');
            $circle['center_lat'] = $this->input->post('circle_center_lat', true);
            $circle['center_lon'] = $this->input->post('circle_center_lon', true);
            $circle['search_radius'] = $this->input->post('circle_radius', true);
            $data = array_merge($data, $this->Nearest_users_model->getSearchData($circle));
        }

        $this->searchListBlock($data, $order, $order_direction, $page, 'advanced');
    }

    /**
    * @api {post} /users/searchCounts Number of users found
    * @apiGroup Users
    * @apiParam {string} [type] search type
    * @apiParam {array} [post_data] post data
    */
    public function searchCounts()
    {
        $type = trim(strip_tags($this->input->post('type', true)));
        if (!$type) {
            $type = 'advanced';
        }

        $result = ['count' => 0, 'error' => '', 'string' => ''];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }
            $criteria = $this->getAdvancedSearchCriteria($data);
            $result["count"] = $this->Users_model->getUsersCount($criteria);
            $result["string"] = str_replace("[count]", $result["count"], l('user_results_string', 'users'));
        }
        $this->set_api_content('data', $result);
    }

    private function searchListBlock($data = [], $order = "default", $order_direction = "DESC", $page = 1, $search_type = 'advanced')
    {
        $api_data['user_id'] = $this->user_id;

        if (!empty($data)) {
            $current_settings = $data;
        } elseif ($this->session->userdata("users_search")) {
            $current_settings = $this->session->userdata("users_search");
        } else {
            $current_settings = $this->Users_model->getDefaultSearchData();
        }

        $this->session->set_userdata("users_search", $current_settings);

        $criteria = $this->getAdvancedSearchCriteria($current_settings);

        if (isset($criteria['where']['id']) && isset($criteria['where']['id !='])) {
            unset($criteria['where']['id']);
        }

        if (isset($current_settings['distance']) && $this->pg_module->is_module_installed('nearest_users')) {
            $this->load->model('Nearest_users_model');
            $criteria =  array_replace_recursive($this->Nearest_users_model->getSearchCriteria($current_settings), $criteria);
        }

        $search_url = site_url() . "users/search";
        $url = site_url() . "users/search/" . $order . "/" . $order_direction . "/";

        $api_data['search_type'] = $search_type;
        $order = trim(strip_tags($order));
        if (!$order) {
            $order = 'date_created';
        }
        $api_data['order'] = $order;

        $order_direction = strtoupper(trim(strip_tags($order_direction)));
        if ($order_direction !== 'DESC') {
            $order_direction = "ASC";
        }
        $api_data['order_direction'] = $order_direction;

        $items_count = $this->Users_model->getUsersCount($criteria);

        if (!$page) {
            $page = 1;
        }
        $items_on_page = filter_input(INPUT_POST, 'items_on_page', FILTER_VALIDATE_INT);
        if (!$items_on_page) {
            $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        }
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $items_count, $items_on_page);

        $sort_data = [
            "url"       => $search_url,
            "order"     => $order,
            "direction" => $order_direction,
            "links"     => [
                "default"      => l('field_default_sorter', 'users'),
                "name"         => l('field_name', 'users'),
                "views_count"  => l('field_views_count', 'users'),
                "date_created" => l('field_date_created', 'users'),
            ],
        ];
        $api_data['sort_data'] = $sort_data;

        $use_leader = false;
        if ($items_count > 0) {
            $order_array = [];
            if ($order == 'default') {
                if (!empty($data['id_region']) && (int)$data['id_region']) {
                    $order_array['leader_bid'] = 'DESC';
                }
                if (!empty($criteria['fields']) && (int)$criteria['fields']) {
                    $order_array["fields"] = 'DESC';
                } else {
                    $order_array["up_in_search_end_date"] = 'DESC';
                    $order_array["date_created"] = $order_direction;
                }
                $use_leader = true;
            } elseif ($order == 'name') {
                if ($this->pg_module->get_module_config('users', 'hide_user_names')) {
                    $order_array['nickname'] = $order_direction;
                } else {
                    $order_array['fname'] = $order_direction;
                    $order_array['sname'] = $order_direction;
                }
            } else {
                $order_array[$order] = $order_direction;
            }

            $users = $this->Users_model->getUsersList($page, $items_on_page, $order_array, $criteria, [], true, true);

            $api_data['users'] = $users;
        }
        $this->load->helper("navigation");
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');
        $page_data["date_format"] = $this->pg_date->get_format('date_literal', 'st');
        $page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $page_data["use_leader"] = $use_leader;
        $api_data['page_data'] = $page_data;
        $use_save_search = ($this->session->userdata("auth_type") == "user") ? true : false;
        $api_data['use_save_search'] = $use_save_search;
        $this->set_api_content('data', $api_data);
    }

    private function getAdvancedSearchCriteria($data)
    {
        $this->load->model('field_editor/models/Field_editor_forms_model');
        $fe_criteria = $this->Field_editor_forms_model->getSearchCriteria($this->Users_model->advanced_search_form_gid, $data, $this->Users_model->form_editor_type, false);
        if (!empty($data["search"])) {
            $data["search"] = trim(strip_tags($data["search"]));
            $this->load->model('Field_editor_model');
            $this->Field_editor_model->initialize($this->Users_model->form_editor_type);
            $temp_criteria = $this->Field_editor_model->returnFulltextCriteria($data["search"]);
            $fe_criteria['fields'][] = $temp_criteria['user']['field'];
            $fe_criteria['where_sql'][] = $temp_criteria['user']['where_sql'];
        }
        $common_criteria = $this->Users_model->getCommonCriteria($data);
        $advanced_criteria = $this->Users_model->getAdvancedSearchCriteria($data);
        $criteria = array_merge_recursive($fe_criteria, $common_criteria, $advanced_criteria);

        return $criteria;
    }

    /**
    * @api {post} /users/myGuests Get users visited my profile
    * @apiGroup Users
    * @apiParam {string} [period] period of visit
    * @apiParam {int} [page] page of results
    */
    public function myGuests()
    {
        $period = trim(strip_tags($this->input->post('period', true)));
        if (!$period) {
            $period = 'all';
        }
        $page = (int)$this->input->post('page');
        if (!$page) {
            $page = 1;
        }
        $this->views($period, 'my_guests', $page);
    }

    /**
    * @api {post} /users/myVisits Get users whom i visited
    * @apiGroup Users
    * @apiParam {string} [period] period of visit
    * @apiParam {int} [page] page of results
    */
    public function myVisits()
    {
        $period = trim(strip_tags($this->input->post('period', true)));
        if (!$period) {
            $period = 'all';
        }
        $page = (int)$this->input->post('page');
        if (!$page) {
            $page = 1;
        }
        $this->views($period, 'my_visits', $page);
    }

    private function views($period = 'all', $type = 'my_guests', $page = 1)
    {
        if (!in_array($period, ['today', 'week', 'month', 'all'])) {
            $period = 'all';
        }
        $this->load->model('users/models/Users_views_model');

        $criteria = [
            'where' => [
                'hide_on_site_end_date <' => date(UsersModel::DB_DATE_FORMAT),
                'id !=' => $this->user_id
            ]
        ];

        $order_by['view_date'] = 'DESC';
        if ($type == 'my_guests') {
            $all_viewers = $this->Users_views_model->getViewersDailyUnique($this->user_id, null, null, $order_by, [], $period);
            $this->Users_views_model->removeViewersCounter($all_viewers);
        } else {
            $all_viewers = $this->Users_views_model->getViewsDailyUnique($this->user_id, null, null, $order_by, [], $period);
        }
        $need_ids = $view_dates = [];
        $key = ($type == 'my_guests') ? 'id_viewer' : 'id_user';
        foreach ($all_viewers as $viewer) {
            $need_ids[] = $viewer[$key];
            $view_dates[$viewer[$key]] = $viewer['view_date'];
        }

        $items_count = $need_ids ? $this->Users_model->getUsersCount($criteria, $need_ids) : 0;
        $items_on_page = $this->pg_module->get_module_config('start', 'items_per_page');
        $this->load->helper('sort_order');
        $this->load->helper("navigation");
        $page = get_exists_page_number($page, $items_count, $items_on_page);
        $url = site_url() . "users/{$type}/{$period}/";
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');

        if ($items_count) {
            unset($criteria["where"]["activity"]);
            $users_list = $this->Users_model->getUsersListByKey($page, $items_on_page, $order_by, $criteria, $need_ids, true, false);
            $users = [];
            foreach ($need_ids as $uid) {
                if (isset($users_list[$uid])) {
                    $users[$uid] = $users_list[$uid];
                }
            }
            $api_data['users'] = array_values($users);
            $api_data['view_dates'] = $view_dates;
        }
        $api_data['views_type'] = $type;
        $api_data['period'] = $period;
        //$page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        //$page_data["date_time_format"] = $this->pg_date->get_format('date_time_literal', 'st');
        $api_data['page_data']['total_rows'] = $page_data['total_rows'];
        $this->set_api_content('data', $api_data);
    }

    /* USERS SERVICES */
    /**
    * @api {post} /users/availableUserActivateInSearch Checks the availability of activate in search
    * @apiGroup Users
    */
    public function availableUserActivateInSearch()
    {
        $return = $this->Users_model->serviceAvailableUserActivateInSearchAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateUserActivateInSearch Activate service activate in search
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateUserActivateInSearch()
    {
        $id_user_service = (int)$this->input->post('id_user_service', true);
        $return = $this->Users_model->serviceActivateUserActivateInSearch($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
     * The method checks the availability of featured user.
     *
     * @param int $id_user
     */

    /**
    * @api {post} /users/availableUsersFeatured Checks the availability of featured user
    * @apiGroup Users
    */
    public function availableUsersFeatured()
    {
        $return = $this->Users_model->serviceAvailableUsersFeaturedAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateUsersFeatured  Activate service featured user
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateUsersFeatured()
    {
        $id_user_service = (int)$this->input->post('id_user_service', true);
        $return = $this->Users_model->serviceActivateUsersFeatured($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
     * The method checks the availability of approve user.
     *
     * @param int $id_user
     */

    /**
    * @api {post} /users/availableAdminApprove  Checks the availability of admin approve
    * @apiGroup Users
    */
    public function availableAdminApprove()
    {
        $return = $this->Users_model->serviceAvailableAdminApproveAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateAdminApprove  Activate service admin approve
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateAdminApprove()
    {
        $id_user_service = intval($this->input->post('id_user_service', true));
        $return = $this->Users_model->serviceActivateAdminApprove($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
     * The method checks the availability of hide user on site.
     *
     * @param int $id_user
     */

    /**
    * @api {post} /users/availableHideOnSite  Checks the availability of hide user on site
    * @apiGroup Users
    */
    public function availableHideOnSite()
    {
        $return = $this->Users_model->serviceAvailableHideOnSiteAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateHideOnSite  Activate service hide user on site
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateHideOnSite()
    {
        $id_user_service = (int)$this->input->post('id_user_service', true);
        $return = $this->Users_model->serviceActivateHideOnSite($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
     * The method checks the availability of highlight user in search.
     *
     * @param int $id_user
     */

    /**
    * @api {post} /users/availableHighlightInSearch  Checks the availability of highlight user in search
    * @apiGroup Users
    */
    public function availableHighlightInSearch()
    {
        $return = $this->Users_model->serviceAvailableHighlightInSearchAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/availableHideOnSite  Activate service highlight user in search
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateHighlightInSearch()
    {
        $id_user_service = (int)$this->input->post('id_user_service', true);
        $return = $this->Users_model->serviceActivateHighlightInSearch($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
     * The method checks the availability of up user in search.
     *
     * @param int $id_user
     */

    /**
    * @api {post} /users/availableUpInSearch  Checks the availability of up user in search.
    * @apiGroup Users
    */
    public function availableUpInSearch()
    {
        $return = $this->Users_model->service_available_up_in_search_action($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateUpInSearch  Activate service up user in search.
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateUpInSearch()
    {
        $id_user_service = intval($this->input->post('id_user_service', true));
        $return = $this->Users_model->serviceActivateUpInSearch($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/availableAbilityDelete  Checks the availability of ability delete
    * @apiGroup Users
    */
    public function availableAbilityDelete()
    {
        $return = $this->Users_model->serviceAvailableAbilityDeleteAction($this->user_id);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/activateAbilityDelete  Activate service ability delete
    * @apiGroup Users
    * @apiParam {int} id_user_service service id
    */
    public function activateAbilityDelete()
    {
        $id_user_service = (int)$this->input->post('id_user_service', true);
        $return = $this->Users_model->serviceActivateAbilityDelete($this->user_id, $id_user_service);
        $this->set_api_content('data', $return);
    }

    /**
    * @api {post} /users/saveProfile  Save user
    * @apiGroup Users
    * @apiParam {string} [profile_section] profile section type
    * @apiParam {string} looking_user_type looking user type
    * @apiParam {string} nickname nickname
    * @apiParam {string} fname first name
    * @apiParam {string} sname surname
    * @apiParam {string} [id_country] country code
    * @apiParam {int} [id_region] region id
    * @apiParam {int} [id_city] city id
    * @apiParam {string} birth_date birth date
    * @apiParam {int} age_min age min for looking users
    * @apiParam {int} age_max age max for looking users
    * @apiParam {float} [lat] latitude
    * @apiParam {float} [lon] longtitude
    */
    public function saveProfile($profile_section = 'view')
    {
        if ($profile_section == 'personal') {
            $validate_section = null;
        } else {
            $validate_section = $profile_section;
        }
        $fields = [
            'looking_user_type',
            'nickname',
            'fname',
            'sname',
            'id_country',
            'id_region',
            'id_city',
            'birth_date',
            'age_min',
            'age_max',
            'lat',
            'lon',
        ];
        foreach ($fields as $field) {
            $post_data[$field] = filter_input(INPUT_POST, $field);
        }

        $validate_data = $this->Users_model->validate($this->user_id, $post_data, 'user_icon', $validate_section);
        if ($this->Users_model->saveUser($this->user_id, $validate_data['data'], 'user_icon')) {
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_user', 'users'));
        }
    }

    /**
    * @api {post} /users/save  Save profile data
    * @apiGroup Users
    * @apiParam {string} [section] profile section
    * @apiParam {string} looking_user_type looking user type
    * @apiParam {string} nickname nickname
    * @apiParam {string} fname first name
    * @apiParam {string} sname surname
    * @apiParam {string} [id_country] country code
    * @apiParam {int} [id_region] region id
    * @apiParam {int} [id_city] city id
    * @apiParam {string} birth_date birth date
    * @apiParam {int} age_min age min for looking users
    * @apiParam {int} age_max age max for looking users
    * @apiParam {float} [lat] latitude
    * @apiParam {float} [lon] longtitude
    * @apiParam {string} [user_logo] user logo file name
    */
    public function save()
    {
        $profile_section = FILTER_INPUT(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
        $post_data = [];
        $validate_section = null;
        $fields_for_select = [];

        $this->load->model('Field_editor_model');
        $this->Field_editor_model->initialize($this->Users_model->form_editor_type);

        if ($profile_section != 'view' && $profile_section != 'wall' && $profile_section != 'gallery' && $profile_section != 'subscriptions') {
            $section = $this->Field_editor_model->getSectionByGid($profile_section);
            if (!empty($section)) {
                $fields_for_select = $this->Field_editor_model->getFieldsForSelect($section['gid']);
            }
        } elseif ($profile_section == 'view') {
            $sections = $this->Field_editor_model->getSectionList();
            $sections_gids = array_keys($sections);
            $fields_for_select = $this->Field_editor_model->getFieldsForSelect($sections_gids);
        }
        $this->Users_model->setAdditionalFields($fields_for_select);

        if ($profile_section == 'personal') {
            $args = [
                'looking_user_type' => FILTER_SANITIZE_STRING,
                'nickname'          => FILTER_SANITIZE_STRING,
                'fname'             => FILTER_SANITIZE_STRING,
                'sname'             => FILTER_SANITIZE_STRING,
                'id_country'        => FILTER_SANITIZE_STRING,
                'id_region'         => FILTER_VALIDATE_INT,
                'id_city'           => FILTER_VALIDATE_INT,
                'lat'               => FILTER_VALIDATE_FLOAT,
                'lon'               => FILTER_VALIDATE_FLOAT,
                'birth_date'        => FILTER_SANITIZE_STRING,
                'age_min'           => FILTER_VALIDATE_INT,
                'age_max'           => FILTER_VALIDATE_INT,
                'user_logo'         => FILTER_SANITIZE_STRING,
            ];
            $post_data = filter_input_array(INPUT_POST, $args);
        } else {
            foreach ($fields_for_select as $field) {
                $post_data[$field] = $this->input->post($field, true);
            }
            $validate_section = $profile_section;
        }

        $country = isset($post_data['id_country']) ? $post_data['id_country'] : null;
        $region = isset($post_data['id_region']) ? $post_data['id_region'] : null;
        $city = isset($post_data['id_city']) ? $post_data['id_city'] : null;

        if ($country) {
            if ($this->pg_module->is_module_installed('geomap')) {
                $this->load->model('Geomap_model');
                $this->load->helper('countries');

                $location = country($country, $region, $city);
                $driver_settings = $this->Geomap_model->getDefaultDriver();
                if (!empty($driver_settings["regkey"])) {
                    $coordinates = $this->Geomap_model->getCoordinates($location, $driver_settings["regkey"]);
                    $post_data['lat'] = $coordinates['lat'];
                    $post_data['lon'] = $coordinates['lon'];
                }
            }
        }

        $validate_data = $this->Users_model->validate($this->user_id, $post_data, 'user_icon', $validate_section, 'save');

        //$data = $validate_data['data'];
        $data = $this->Users_model->getUserById($this->user_id);

        if (!empty($validate_data['errors'])) {
            $this->set_api_content('errors', array_values($validate_data['errors']));
        } else {
            if ($this->input->post('user_icon_delete') || (isset($_FILES['user_icon']) && is_array($_FILES['user_icon']) && is_uploaded_file($_FILES['user_icon']['tmp_name']))) {
                $this->load->model('Uploads_model');
                if (!empty($data['user_logo_moderation'])) {
                    $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id . '/', $data['user_logo_moderation']);
                    $validate_data['data']['user_logo_moderation'] = '';
                    $this->load->model('Moderation_model');
                    $this->Moderation_model->deleteModerationItemByObj($this->Users_model->moderation_type, $this->user_id);
                } elseif (!empty($data['user_logo'])) {
                    $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $this->user_id . '/', $data['user_logo']);
                    $validate_data['data']['user_logo'] = '';
                }
            }
            $this->Users_model->saveUser($this->user_id, $validate_data['data'], 'user_icon');
            $this->load->model('users/models/Auth_model');
            $this->Auth_model->updateUserSessionData($this->user_id);
        }
        $this->set_api_content('validate_data', $validate_data);
    }

    /**
    * @api {post} /users/getNew  Get new users
    * @apiGroup Users
    * @apiParam {string} user_type user type
    * @apiParam {int} count count users for view
    */
    public function getNew()
    {
        $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
        $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);
        $users = $this->Users_model->getNewUsers($count, $user_type);
        $this->set_api_content('data', $users);
    }

    /**
    * @api {post} /users/getgetFeaturedNew  Get Featured users
    * @apiGroup Users
    * @apiParam {string} user_type user type
    * @apiParam {int} count count users for view
    */
    public function getFeatured()
    {
        $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
        $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);
        $users = $this->Users_model->getFeaturedUsers($count, $user_type);
        $this->set_api_content('data', ['items' => $users]);
    }

    /**
    * @api {post} /users/getTopList  Get top list
    * @apiGroup Users
    * @apiParam {string} user_type user type
    * @apiParam {int} count count users for view
    */
    public function getTopList()
    {
        $users = [];
        $count = filter_input(INPUT_POST, 'count', FILTER_VALIDATE_INT);
        $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_STRING);
        $criteria = $this->Users_model->getCommonCriteria(null);
        if (!empty($user_type)) {
            $criteria['where']['user_type'] = $user_type;
        }
        $items_count = $this->Users_model->getUsersCount($criteria);
        if ($items_count) {
            $users = $this->Users_model->getUsersListByKey(1, min($items_count, $count), ["rating_sorter" => "desc", "date_created" => "desc"], $criteria, [], true);
        }
        $this->set_api_content('data', ['items' => $users]);
    }

    /**
    * @api {post} /users/loadAvatar  Load Avatar
    * @apiGroup Users
    * @apiParam {int} id_user user id
    */
    public function loadAvatar()
    {
        $id_user = $this->input->post('id_user') ? intval($this->input->post('id_user', true)) : $this->user_id;
        $data    = [
            'user' => $this->Users_model->getUserById($id_user, true),
            'is_owner' => ($id_user == $this->user_id)
        ];
        if (!$id_user || !$data['user'] || (!$data['is_owner'] && !($data['user']['user_logo'] || $data['user']['user_logo_moderation']))) {
            $result['errors'][] = l('error_access_denied', 'users');
            $this->set_api_content('errors', $result['errors']);

            return;
        }

        if (!empty($data['user']['media']['user_logo']['file_url'])) {
            $result['image_url'] = $data['user']['media']['user_logo']['file_url'];
        } elseif (!empty($data['user']['media']['user_logo_moderation']['file_url'])) {
            $result['image_url'] = $data['user']['media']['user_logo_moderation']['file_url'];
        }

        if (empty($result['image_url'])) {
            $result['errors'][] = "No photo.";
            $this->set_api_content('errors', $result['errors']);

            return;
        }

        $this->set_api_content('data', $result);
    }

    /**
     * Rotate upload
     *
     * @param integer/string $angle     rotate angle
     *
     * @return void
     */

    /**
    * @api {post} /users/photoRotate  Rotate my avatar
    * @apiGroup Users
    * @apiParam {int} [angle] angle of rotate
    */
    public function photoRotate($angle = 90)
    {
        $user = $this->Users_model->getUserById($this->user_id, true);
        $logo_name = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        if ($angle < 0) {
            $angle += 360;
        } elseif ($angle != 'hor') {
            $angle = intval($angle);
        }

        if ($user[$logo_name]) {
            $this->load->model('Uploads_model');
            $this->Uploads_model->rotateUpload($this->Users_model->upload_config_id, $this->user_id, $user[$logo_name], $angle);
            $return['success'] = l('photo_successfully_saved', 'users');
            $this->set_api_content('success', $return['success']);
        } else {
            $return['errors'][] = l('error_access_denied', 'users');
            $this->set_api_content('errors', $return['errors']);
        }
    }

    /**
    * @api {post} /users/recropAvatar  Recrop my avatar
    * @apiGroup Users
    * @apiParam {float} x1 position x
    * @apiParam {float} y1 position y
    * @apiParam {int} width width avatar
    * @apiParam {int} height height avatar
    */
    public function recropAvatar()
    {
        $user   = $this->Users_model->getUserById($this->user_id, true);
        if (!$user || !($user['user_logo'] || $user['user_logo_moderation'])) {
            $return['errors'][] = l('error_access_denied', 'users');
            $this->set_api_content('errors', $return['errors']);

            return;
        }
        $logo_name                 = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        $recrop_data               = [
            'x1' => $this->input->post('x1', true),
            'y1' => $this->input->post('y1', true),
            'width' => $this->input->post('width', true),
            'height' => $this->input->post('height', true)
        ];
        $this->load->model('Uploads_model');
        $this->Uploads_model->recropUpload(
            $this->Users_model->upload_config_id,
            $this->user_id,
            $user[$logo_name],
            $recrop_data
        );
        $return['success'] = l('photo_successfully_saved', 'users');

        $this->set_api_content('success', $return['success']);
    }

    /**
     * Is service activation
     *
     * return string
     */

    /**
    * @api {post} /users/isActiveService  Checks the activity of service
    * @apiGroup Users
    * @apiParam {string} gid service gid
    */
    public function isActiveService()
    {
        $gid = filter_input(INPUT_POST, 'gid', FILTER_SANITIZE_STRING);
        if (!empty($gid)) {
            $result = $this->Users_model->isActiveService($gid);

            if ($gid == "user_activate_in_search") {
                $this->session->set_userdata("activity", 1);
            }

            $this->set_api_content('data', $result);
        }
    }

    /**
    * @api {post} /users/checkAvailableUserActivation  Checks the availability of user activation
    * @apiGroup Users
    */
    public function checkAvailableUserActivation()
    {
        $result = $this->Users_model->checkAvailableUserActivation($this->user_id);
        $this->set_api_content('data', $result);
    }

    /**
     * @api {post} /users/deleteAccount  Remove user account
     * @apiGroup Users
     */
    public function deleteAccount()
    {
        if ($this->pg_module->is_module_installed('services')) {
            $this->load->model('Services_model');
            if ($this->Services_model->isServiceActive('ability_delete') === 1) {
                $this->load->model('services/models/Services_users_model');
                $service_access = $this->Services_users_model->isServiceAccess($this->user_id, 'ability_delete_template');
                if ($service_access['service_status'] && !$service_access['activate_status']) {
                    $this->view->assign('info', ['access_denied' => l('error_delete_account_need_buy', 'users')]);
                    $this->view->render();

                    return;
                }
            }
        }

        $this->Users_model->deleteUser($this->user_id);
        $this->load->model("users/models/Auth_model");
        $this->Auth_model->logoff();

        $this->view->assign('success', 1);
    }
}
