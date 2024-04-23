<?php

declare(strict_types=1);

namespace Pg\modules\users\controllers;

use Pg\Libraries\View;
use Pg\modules\users\models\UsersModel;

/**
 * Users admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class AdminUsers extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Users_model', 'Menu_model']);
        $this->Menu_model->setMenuActiveItem('admin_menu', 'users_menu_item');
    }

    public function index($filter = null, $user_type = 'all', $order = null, $order_direction = null, $page = null)
    {
        $attrs            = [];
        $search_params    = [];
        $current_settings = isset($_SESSION['users_list']) ? $_SESSION['users_list'] : [];

        if (!isset($current_settings['filter'])) {
            $current_settings['filter']      = 'all';
            $current_settings['last_active'] = ['from' => '', 'to' => ''];
        }
        if (!isset($current_settings['user_type'])) {
            $current_settings['user_type'] = 'all';
        }
        if (!isset($current_settings['order'])) {
            $current_settings['order'] = 'date_created';
        }
        if (!isset($current_settings['order_direction'])) {
            $current_settings['order_direction'] = 'DESC';
        }
        if (!isset($current_settings['page'])) {
            $current_settings['page'] = 1;
        }
        if ($this->uri->segment(4) === false) {
            $current_settings['search_text'] = '';
            $current_settings['search_type'] = 'all';
            $current_settings['last_active'] = ['from' => '', 'to' => ''];
        }
        if ($this->input->post('btn_search', true)) {
            $user_type                               = $this->input->post('user_type', true) ?: $user_type;
            $current_settings['search_type']         = $this->input->post('type_text', true);
            $current_settings['search_text']         = $this->input->post('val_text', true);
            $current_settings['last_active']['from'] = $this->input->post('last_active_from', true);
            $current_settings['last_active']['to']   = $this->input->post('last_active_to', true);
        }
        $current_settings['user_type'] = $user_type;

        if ($this->Users_model->is_couples_installed === true) {
            $this->load->model('Couples_model');
            $attrs = $search_params = $this->Couples_model->getSearchParams([]);
        }

        if ($current_settings['search_text']) {
            $search_text_escape = $this->db->escape('%' . $current_settings['search_text'] . '%');
            if ($current_settings['search_type'] != 'all') {
                $attrs['where_sql'][] = $search_params['where_sql'][] = $current_settings['search_type'] . ' LIKE ' . $search_text_escape;
            } else {
                $attrs['where_sql'][]  = $search_params['where_sql'][] = '(nickname LIKE ' . $search_text_escape . ' OR fname LIKE ' . $search_text_escape . ' OR sname LIKE ' . $search_text_escape . ' OR email LIKE ' . $search_text_escape . ')';
            }
        }

        if (!empty($current_settings['last_active']['from'])) {
            $attrs['where_sql'][]         = $search_params['where_sql'][] = "date_last_activity >= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['last_active']['from'])
            ) . "'";
        }
        if (!empty($current_settings['last_active']['to'])) {
            $attrs['where_sql'][]         = $search_params['where_sql'][] = "date_last_activity <= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['last_active']['to'])
            ) . " 23:59:59'";
        }

        if ($user_type != 'all' && $user_type) {
            $attrs['where']['user_type']         = $search_params['where']['user_type']
                                                 = $user_type;
        }

        $search_param = [
            'text'        => $current_settings['search_text'],
            'type'        => $current_settings['search_type'],
            'last_active' => $current_settings['last_active'],
        ];

        $filter_data['all']                 = $this->Users_model->getUsersCount($search_params);
        $search_params['where']['approved'] = 0;
        $filter_data['not_active']          = $this->Users_model->getUsersCount($search_params);
        $search_params['where']['approved'] = 1;
        $filter_data['active']              = $this->Users_model->getUsersCount($search_params);
        $search_params['where']['confirm']  = 0;
        $filter_data['not_confirm']         = $this->Users_model->getUsersCount($search_params);
        $this->load->model('users/models/Users_deleted_model');
        $filter_data['deleted']             = $this->Users_deleted_model->getUsersCount();

        if (!$filter) {
            $filter = $current_settings['filter'];
        }

        switch ($filter) {
            case 'active':
                $attrs['where']['approved'] = 1;
                break;
            case 'not_active':
                $attrs['where']['approved'] = 0;
                break;
            case 'not_confirm':
                $attrs['where']['confirm '] = 0;
                break;
            case 'all':
                break;
            default:
                $filter                     = $current_settings['filter'];
        }

        $current_settings['filter'] = $filter;

        $this->load->model('Properties_model');
        $user_types = $this->Properties_model->getProperty('user_type');
        $this->view->assign('user_types', $user_types);

        $this->view->assign('search_param', $search_param);
        $this->view->assign('user_type', $user_type);
        $this->view->assign('filter', $filter);
        $this->view->assign('filter_data', $filter_data);
        $current_settings['page'] = $page;

        if (!$order) {
            $order = $current_settings['order'];
        }
        $this->view->assign('order', $order);
        $current_settings['order'] = $order;

        if (!$order_direction) {
            $order_direction = $current_settings['order_direction'];
        }
        $this->view->assign('order_direction', $order_direction);
        $current_settings['order_direction'] = $order_direction;

        $users_count = $filter_data[$filter];

        if (!$page) {
            $page = $current_settings['page'];
        }
        $items_on_page            = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page                     = get_exists_page_number($page, $users_count, $items_on_page);
        $current_settings['page'] = $page;

        $_SESSION['users_list'] = $current_settings;

        $sort_links = [
            'nickname' => site_url() . "admin/users/index/{$filter}/{$user_type}/nickname/" . (($order
            != 'nickname' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'user_type' => site_url() . "admin/users/index/{$filter}/{$user_type}/user_type/" . (($order
            != 'user_type' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'email' => site_url() . "admin/users/index/{$filter}/{$user_type}/email/" . (($order
            != 'email' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'account' => site_url() . "admin/users/index/{$filter}/{$user_type}/account/" . (($order
            != 'account' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'date_created' => site_url() . "admin/users/index/{$filter}/{$user_type}/date_created/" . (($order
            != 'date_created' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];

        $this->view->assign('sort_links', $sort_links);
        if ($users_count > 0) {
            $users = $this->Users_model->getUsersList($page, $items_on_page, [$order => $order_direction], $attrs);
            $this->view->assign('users', $users);
        }

        $this->load->helper('navigation');
        $url                      = site_url() . "admin/users/index/{$filter}/{$user_type}/{$order}/{$order_direction}/";
        $page_data                = get_admin_pages_data($url, $users_count, $items_on_page, $page, 'briefPage');
        $page_data['date_format'] = $this->pg_date->get_format('date_time_literal', 'st');
        $this->view->assign('page_data', $page_data);

        $this->load->model('users/models/Groups_model');
        $groups = $this->Groups_model->getGroupsList();
        $this->view->assign('groups', $groups);

        $this->view->setHeader(l('admin_header_users_list', 'users'));
        $this->view->render('list');
    }

    public function edit($section = 'personal', $user_id = null)
    {
        $is_new_user                            = is_null($user_id);
        $this->Users_model->fields_not_editable = [];
        $this->load->model('Field_editor_model');
        $this->Field_editor_model->initialize($this->Users_model->form_editor_type);

        $current_settings = isset($_SESSION['users_deleted_list']) ? $_SESSION['users_deleted_list'] : [];
        if (isset($current_settings['filter'])) {
            $this->view->assign('filter', $current_settings['filter']);
        }

        $sections   = $this->Field_editor_model->getSectionList();
        $this->view->assign('sections', $sections);
        $this->load->model('Properties_model');
        $user_types = $this->Properties_model->getProperty('user_type');
        if ($section == 'personal') {
            $age_min   = $this->pg_module->get_module_config('users', 'age_min');
            $age_max   = $this->pg_module->get_module_config('users', 'age_max');
            $age_range = range($age_min, $age_max);
            $min_date  = UsersModel::getDefaultDateByYear($this->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min'));
            $this->view->assign('age_min', $age_min);
            $this->view->assign('age_max', $age_max);
            $this->view->assign('age_range', $age_range);
            $this->view->assign('user_types', $user_types);
            $this->view->assign('min_date', $min_date);
        } else {
            $fe_section = $this->Field_editor_model->getSectionByGid($section);
            if (!empty($fe_section)) {
                $fields_for_select = $this->Field_editor_model->getFieldsForSelect($fe_section['gid']);
                $this->Users_model->setAdditionalFields($fields_for_select);
            }
        }

        if ($user_id) {
            $data = $this->Users_model->getUserById($user_id);
            if ($this->Users_model->is_couples_installed === true && !empty($data['couple_id'])) {
                $data['couple'] = $this->Users_model->getUserById($data['couple_id']);
            }
            if (!empty($data['net_is_incomer'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('network_error_edit_user', 'users'));
                redirect(site_url() . 'admin/users');
            }
        } else {
            $data['lang_id'] = $this->pg_language->current_lang_id;
        }

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');

        $use_repassword = $this->pg_module->get_module_config('users', 'use_repassword');
        if ($this->input->post('btn_save')) {
            $post_data        = [];
            $validate_section = null;

            switch ($section) {
                case 'personal':
                    $post_data = [
                        'email'      => $this->input->post('email', true),
                        'confirm'    => $this->input->post('confirm', true),
                        'nickname'   => $this->input->post('nickname', true),
                        'fname'      => $this->input->post('fname', true),
                        'sname'      => $this->input->post('sname', true),
                        'id_country' => $this->input->post('id_country', true),
                        'id_region'  => $this->input->post('id_region', true),
                        'id_city'    => $this->input->post('id_city', true),
                        'birth_date' => $this->input->post('birth_date', true),
                        'phone'      => $this->input->post('phone', true),
                        'lat'        => $this->input->post('lat', true),
                        'lon'        => $this->input->post('lon', true),
                    ];
                    if ($pm_installed) {
                        $post_data['looking_user_type'] = $this->input->post('looking_user_type', true);
                        $post_data['age_min']           = $this->input->post('age_min', true);
                        $post_data['age_max']           = $this->input->post('age_max', true);
                    }
                    $post_data['user_type'] = $this->input->post('user_type', true);
                    if ($this->Users_model->is_couples_installed === true && $post_data['user_type'] == 'couple') {
                        if (!empty($data['couple_id'])) {
                            $this->load->model('Couples_model');
                            $this->Couples_model->setCoupleId($data['couple_id']);
                        }
                        foreach (\Pg\modules\couples\models\CouplesModel::$personal_fields as $f => $cf) {
                            $post_data[$f] = $this->input->post($f, true);
                        }
                    }
                    break;
                case 'seo':
                    $this->load->model('Seo_advanced_model');
                    $seo_fields = $this->Seo_advanced_model->getSeoFields();
                    foreach ($seo_fields as $key => $section_data) {
                        if ($this->input->post('btn_save_' . $section_data['gid'])) {
                            $post_data[$section_data['gid']] = $this->input->post($section_data['gid'], true);
                            $validate_data                   = $this->Seo_advanced_model->validateSeoTags($user_id, $post_data);
                            if (!empty($validate_data['errors'])) {
                                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                            } else {
                                $user_data['id_seo_settings'] = $this->Seo_advanced_model->saveSeoTags($data['id_seo_settings'], $validate_data['data']);
                                if (!$data['id_seo_settings']) {
                                    $data['id_seo_settings'] = $user_data['id_seo_settings'];
                                    $this->Users_model->saveUser($user_id, $user_data, false);
                                }
                                $this->system_messages->addMessage(
                                    View::MSG_SUCCESS,
                                    l('success_settings_updated', 'seo')
                                );
                            }
                            $data = array_merge($data, $post_data);
                            break;
                        }
                    }
                    break;
                default:
                    foreach ($fields_for_select as $field) {
                        $post_data[$field] = $this->input->post($field, true);
                        if ($this->Users_model->is_couples_installed === true) {
                            if (!empty($data['couple_id'])) {
                                $this->load->model('Couples_model');
                                $this->Couples_model->setCoupleId($data['couple_id']);
                            }
                            \Pg\modules\couples\models\CouplesModel::addPersonalFields($fields_for_select);
                            $post_data[$field . \Pg\modules\couples\models\CouplesModel::POSTFIX] =
                                $this->input->post($field . \Pg\modules\couples\models\CouplesModel::POSTFIX, true);
                        }
                    }
                    $validate_section = $section;
                    break;
            }
            if (intval($this->input->post('update_password')) || $is_new_user) {
                $post_data['password'] = $this->input->post('password', true);
                if ($use_repassword) {
                    $post_data['repassword'] = $this->input->post('repassword', true);
                }
            }

            $validate_data = $this->Users_model->validate($user_id, $post_data, 'user_icon', $validate_section);
            if (!empty($validate_data['errors'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                $data = $validate_data['data'];
            } else {
                $save_data = $validate_data['data'];
                if ($this->input->post('user_icon_delete') || (isset($_FILES['user_icon'])
                    && is_array($_FILES['user_icon']) && is_uploaded_file($_FILES['user_icon']['tmp_name']))) {
                    $this->load->model('Uploads_model');
                    if (!empty($data['user_logo_moderation'])) {
                        $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $user_id . '/', $data['user_logo_moderation']);
                        $save_data['user_logo_moderation'] = '';
                        $this->load->model('Moderation_model');
                        $this->Moderation_model->deleteModerationItemByObj($this->Users_model->moderation_type, $user_id);
                        $this->Indicators_model->delete('new_moderation_item', $user_id, true);
                    } elseif (!empty($data['user_logo'])) {
                        $this->Uploads_model->deleteUpload($this->Users_model->upload_config_id, $user_id . '/', $data['user_logo']);
                        $save_data['user_logo'] = '';
                    }
                }

                if (!empty($save_data['password'])) {
                    $save_password         = $save_data['password'];
                    $save_data['password'] = password_hash($save_data['password'], PASSWORD_DEFAULT);
                }
                if ($is_new_user) {
                    $save_data['confirm']  = 1;
                    $save_data['approved'] = 1;

                    /* DPC-4989 */
                    $save_data['lang_id']            = $this->pg_language->current_lang_id;
                    $save_data['date_last_activity'] = date(UsersModel::DB_DATE_FORMAT);
                    /* /DPC-4989 */
                }

                $this->load->model('Notifications_model');
                if (!empty($save_data['password']) && $user_id) {
                    // send notification password
                    $data['password'] = $save_password;
                    $this->load->model('users/models/Users_restore_password');
                    $this->Users_restore_password->restore($data, true);
                }
                if (!empty($save_data['email']) && !empty($data['email']) && $data['email'] != $save_data['email']) {
                    $data['old_email']          = $data['email'];
                    $data['email']              = $save_data['email'];
                    $save_data['checked_email'] = 0;
                    $save_data['valid_email']   = 1;
                    $data['fname']              = UsersModel::formatUserName($data);
                    $temp_data                  = $data;

                    if ($this->pg_module->is_module_installed('tickets')) {
                        $temp_data['tickets'] = '<a href="' . site_url() . 'tickets' . '" target="_blank">' . l('header_contact_us_form', 'contact_us') . '</a>';
                    } else {
                        $temp_data['tickets'] = '<a href="' . site_url() . 'contact_us' . '">' . l('header_contact_us_form', 'contact_us') . '</a>';
                    }
                    $this->Notifications_model->sendNotification($data['email'], 'users_change_email', $temp_data, '', $data['lang_id']);
                    $this->Notifications_model->sendNotification($data['old_email'], 'users_change_email', $temp_data, '', $data['lang_id']);
                    unset($data['old_email']);
                }

                if ($is_new_user) {
                    $validate_data['data']['id'] = $user_id = $this->Users_model->registerUser($save_data);
                } else {
                    $validate_data['data']['id'] = $user_id = $this->Users_model->saveUser($user_id, $save_data, 'user_icon', false);
                }
                if ($this->Users_model->is_couples_installed === true) {
                    if (!empty($validate_data['couple'])) {
                        if ($is_new_user === true) {
                            $this->Couples_model->registerUser($user_id, $save_data, $validate_data);
                        } else {
                            $this->Couples_model->updateUser($user_id, $save_data, $validate_data);
                        }
                    }
                }

                if ($user_id) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_user', 'users'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_user', 'users'));
                }

                $cur_set = $_SESSION['users_list'];

                $url = site_url() . 'admin/users/edit/' . $section . '/' . $user_id;
                redirect($url);
            }
            $data = array_merge($data, $validate_data['data']);
        }

        if (!isset($data['user_type']) && !empty($user_types['option'])) {
            $data['user_type'] = key($user_types['option']);
        }

        // Differ looking_user_type from user_type
        if ($pm_installed) {
            if (isset($data['user_type']) && !isset($data['looking_user_type']) && count($user_types['option'])) {
                $data['looking_user_type'] = key(array_slice(
                    $user_types['option'],
                    1,
                    1
                ));
            }

            if (!isset($data['age_max'])) {
                $data['age_max'] = $age_max;
            }
        } else {
            $not_editable_fields['looking_user_type'] = 1;
            $not_editable_fields['partner_age']       = 1;
            $this->view->assign('not_editable_fields', $not_editable_fields);
        }

        $data = $this->Users_model->formatUser($data);
        $this->view->assign('use_repassword', $use_repassword);
        $this->view->assign('langs', $this->pg_language->languages);
        $data['action'] = '';
        $this->view->assign('data', $data);
        $this->view->assign('section', $section);

        switch ($section) {
            case 'personal':
                break;
            case 'seo':
                $this->load->model('Seo_advanced_model');
                $seo_fields = $this->Seo_advanced_model->getSeoFields();
                $this->view->assign('seo_fields', $seo_fields);

                $languages = $this->pg_language->languages;
                $this->view->assign('languages', $languages);

                $current_lang_id = $this->pg_language->current_lang_id;
                $this->view->assign('current_lang_id', $current_lang_id);

                if ($data['id_seo_settings']) {
                    $seo_settings = $this->Seo_advanced_model->getSeoTags($data['id_seo_settings']);
                    $this->view->assign('seo_settings', $seo_settings);
                }
                break;
            default:
                $params['where']['section_gid'] = $fe_section['gid'];
                $fields_data                    = $this->Field_editor_model->getFormFieldsList($data, $params);
                $this->view->assign('fields_data', $fields_data);
                if ($this->Users_model->is_couples_installed === true && !empty($data['couple'])) {
                    $fields_data_couple = $this->Field_editor_model->getFormFieldsList($data['couple'], $params);
                    $this->view->assign('fields_data_couple', $fields_data_couple);
                }
                break;
        }

        if (!empty($_SESSION['users_list'])) {
            $back_url = site_url() . 'admin/users/index';
        } else {
            $back_url = '';
        }
        $this->view->assign('back_url', $back_url);
        $this->view->setHeader(l('admin_header_users_edit', 'users'));

        $current_settings = $_SESSION['users_list'] ?? [];
        $this->view->setBackLink(site_url() . 'admin/users/index/' . $current_settings['filter']);

        if ($this->Users_model->is_couples_installed === true) {
            return $this->Couples_model->getProfile($data, 'edit_form');
        } else {
            $this->view->render('edit_form');
        }
    }

    public function delete()
    {
        if ($this->Users_model->is_couples_installed === true) {
            $this->load->model('Couples_model');
            $user_ids = $this->Couples_model->getCouplesIds($this->input->post('user_ids', true));
        } else {
            $user_ids = $this->input->post('user_ids', true);
        }
        if (!empty($user_ids)) {
            $action_user = trim(strip_tags((string)$this->input->post('action_user', true)));
            if (!empty($action_user) && $action_user == 'block_user') {
                foreach ($user_ids as $user_id) {
                    $this->Users_model->activateUser($user_id, 0);
                }
                $this->system_messages->addMessage(
                    View::MSG_SUCCESS,
                    l('success_deactivate_user', 'users')
                );
            } else {
                $callbacks_gid = [];
                $modules       = $this->input->post('module', true);
                foreach ($modules as $module) {
                    $callbacks_gid[] = trim(strip_tags($module));
                }
                foreach ($user_ids as $user_id) {
                    $this->Users_model->deleteUser((int) $user_id, $callbacks_gid);
                }
                if (in_array('users_delete', $callbacks_gid, true)) {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_delete_user', 'users')
                    );
                } else {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_clear_user', 'users')
                    );
                }
            }
        }

        $url     = site_url() . 'admin/users/index';
        redirect($url);
    }

    public function activate($user_id, $status = 0, $is_dashboard = 1)
    {
        if (!empty($user_id)) {
            $this->Users_model->is_dashboard = ($is_dashboard == 0 && $status == 0) ? false : true;
            $return                          = $this->Users_model->activateUser($user_id, $status, $is_dashboard);
            $this->Users_model->is_dashboard = true;
            if (empty($return['error'])) {
                if ($status) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_activate_user', 'users'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_deactivate_user', 'users'));
                }
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $return['error']);
            }
        }
        if (!$this->input->get('is_not_redirect')) {
            $current_settings = isset($_SESSION['users_list']) ? $_SESSION['users_list'] : [];

            if (!isset($current_settings['filter'])) {
                $current_settings['filter'] = 'all';
            }
            if (!isset($current_settings['user_type'])) {
                $current_settings['user_type'] = 'all';
            }
            if (!isset($current_settings['order'])) {
                $current_settings['order'] = 'date_created';
            }
            if (!isset($current_settings['order_direction'])) {
                $current_settings['order_direction'] = 'DESC';
            }
            if (!isset($current_settings['page'])) {
                $current_settings['page'] = 1;
            }

            redirect(site_url() . "admin/users/index/{$current_settings['filter']}/{$current_settings['user_type']}/{$current_settings['order']}/{$current_settings['order_direction']}/{$current_settings['page']}");
        }
    }

    public function ajaxChangeUserGroup($user_id, $group_gid)
    {
        $this->load->model('users/models/Groups_model');
        $group_gid  = strval($group_gid);
        $group_data = $this->Groups_model->getGroupByGid($group_gid);
        $group_id   = (!empty($group_data)) ? $group_data['id'] : 0;

        $user_id = (int)$user_id;
        if ($user_id && $group_id) {
            $save_data['group_id'] = $group_id;
            $this->Users_model->saveUser($user_id, $save_data);
        }
    }

    public function ajaxChangeUsersGroup($group_gid)
    {
        $this->load->model('users/models/Groups_model');
        $group_gid  = (string)$group_gid;
        $group_data = $this->Groups_model->getGroupByGid($group_gid);
        $group_id   = (!empty($group_data)) ? $group_data['id'] : 0;

        $user_ids = $this->input->post('user_ids');
        if (!empty($user_ids) && $group_id) {
            $save_data['group_id'] = $group_id;
            foreach ($user_ids as $user_id) {
                $this->Users_model->saveUser($user_id, $save_data);
            }
            $this->system_messages->addMessage(
                View::MSG_SUCCESS,
                l('error_user_successfully_change_group', 'users')
            );
        }
    }

    public function ajaxMakeInvalidEmail()
    {
        $user_ids = $this->input->post('user_ids');
        $data     = [
            'checked_email'           => 1,
            'valid_email'             => 0,
            'last_checked_email_date' => date(UsersModel::DB_DATE_FORMAT)
        ];
        $this->load->model('notifications/models/Notifications_users_model');

        foreach ($user_ids as $user_id) {
            $this->Notifications_users_model->saveUserNotifications($user_id, null);
            $this->Users_model->saveUser($user_id, $data);
        }

        $return = ['info' =>  l('email_not_valid_info', 'users')];
        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxDeleteSelect($id_user = null, $deleted = 0)
    {
        if ($_ENV['DEMO_MODE']) {
            $login_settings = $this->config->item('login_settings', 'demo_data');
            $user           = $this->Users_model->getUserByEmail($login_settings['user']['login']);
            if ($user['id'] == $id_user || $id_user == 16) {
                $return = ['error' => l('error_demo_mode', 'start')];
                exit(json_encode($return));
            }
        }

        $this->load->model(['users/models/Users_deleted_model',
            'users/models/Users_delete_callbacks_model']);
        $callbacks = $this->Users_delete_callbacks_model->getCallbacks();

        foreach ($callbacks as $key => $value) {
            if ($value['module'] == 'perfect_match') {
                unset($callbacks[$key]);
                break;
            }
        }

        if ($id_user) {
            $callbacks_data   = $this->Users_deleted_model->getUserCallbacks((int)$id_user, $callbacks);
            $data['user_ids'] = [(int)$id_user];
        } else {
            $callbacks_data   = $this->Users_deleted_model->getUserCallbacks(0, $callbacks);
            $data['user_ids'] = $this->input->post('user_ids', true);
        }
        foreach ($data['user_ids'] as $id_user) {
            $user_data            = $this->Users_model->getUserById($id_user);
            $data['user_names'][] = $user_data['nickname'];
        }
        $data['action']  = site_url() . 'admin/users/delete/';
        $data['deleted'] = (int)$deleted;
        $this->view->assign('data', $data);
        $this->view->assign('callbacks_data', $callbacks_data);
        $return = ['content' => $this->view->fetch('ajax_delete_select_block')];
        $this->view->assign($return);
        $this->view->render();
    }

    public function groups($page = 1)
    {
        $this->load->model('users/models/Groups_model');
        $current_settings['page'] = $page;
        if (!isset($current_settings['page'])) {
            $current_settings['page'] = 1;
        }

        $group_count = $this->Groups_model->getGroupsCount();

        if (!$page) {
            $page = $current_settings['page'];
        }
        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page                     = get_exists_page_number($page, $group_count, $items_on_page);
        $current_settings['page'] = $page;

        $_SESSION['groups_list'] = $current_settings;

        if ($group_count > 0) {
            $groups = $this->Groups_model->getGroupsList(
                $page,
                $items_on_page,
                ['date_created' => 'DESC']
            );
            $this->view->assign('groups', $groups);
        }
        $this->load->helper('navigation');
        $url       = site_url() . 'admin/users/groups/';
        $page_data = get_admin_pages_data(
            $url,
            $group_count,
            $items_on_page,
            $page,
            'briefPage'
        );
        $page_data['date_format'] = $this->pg_date->get_format(
            'date_time_literal',
            'st'
        );
        $this->view->assign('page_data', $page_data);

        $this->Menu_model->setMenuActiveItem('admin_users_menu', 'groups_list_item');
        $this->view->setHeader(l('admin_header_groups_list', 'users'));
        $this->view->render('groups_list');
    }

    public function groupEdit($group_id = null)
    {
        $this->load->model('users/models/Groups_model');
        if ($group_id) {
            $data = $this->Groups_model->getGroupById($group_id);
        } else {
            $data = [];
        }

        if ($this->input->post('btn_save')) {
            $post_data = [
                'gid' => $this->input->post('gid', true),
            ];

            $langs_data    = $this->input->post('langs', true);
            $validate_data = $this->Groups_model->validateGroup($group_id, $post_data);
            if (!empty($validate_data['errors'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate_data['errors']);
                $data = array_merge($data, $validate_data['data']);
            } else {
                $data     = $validate_data['data'];
                $group_id = $this->Groups_model->saveGroup($group_id, $data, $langs_data);

                if ($group_id) {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_update_group', 'users')
                    );
                } else {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_add_group', 'users')
                    );
                }

                $url = site_url() . 'admin/users/groups';
                redirect($url);
            }
        }

        $data          = $this->Groups_model->formatGroup($data);
        $data['langs'] = $this->Groups_model->getGroupStringData($group_id);

        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('data', $data);

        $this->view->setHeader(l('admin_header_groups_edit', 'users'));
        $this->view->render('group_edit_form');
    }

    public function groupSetDefault($group_id)
    {
        if (!empty($group_id)) {
            $this->load->model('users/models/Groups_model');
            $this->Groups_model->setDefault($group_id);
            $this->system_messages->addMessage(
                View::MSG_SUCCESS,
                l('success_defaulted_group', 'users')
            );
        }
        $current_settings = $_SESSION['groups_list'];
        $url              = site_url() . 'admin/users/groups/' . $current_settings['page'] . '';
        redirect($url);
    }

    public function groupDelete($group_id)
    {
        if (!empty($group_id)) {
            $this->load->model('users/models/Groups_model');
            $group_data = $this->Groups_model->getGroupById($group_id);
            if ($group_data['is_default']) {
                $this->system_messages->addMessage(
                    View::MSG_ERROR,
                    l('error_cant_delete_default_group', 'users')
                );
            } else {
                $this->Groups_model->deleteGroup($group_id);
                $this->system_messages->addMessage(
                    View::MSG_SUCCESS,
                    l('success_delete_group', 'users')
                );
            }
        }
        $current_settings = $_SESSION['groups_list'];
        $url              = site_url() . 'admin/users/groups/' . $current_settings['page'] . '';
        redirect($url);
    }

    public function deleted($filter = 'deleted', $order = 'nickname', $order_direction = 'ASC', $page = 1)
    {
        $attrs         = [];
        $search_param  = [];
        $search_params = [];

        $current_settings = isset($_SESSION['users_deleted_list']) ? $_SESSION['users_deleted_list'] : [];
        if (!isset($current_settings['filter'])) {
            $current_settings['filter'] = $filter;
        }
        if (!isset($current_settings['order'])) {
            $current_settings['order'] = $order;
        }
        if (!isset($current_settings['order_direction'])) {
            $current_settings['order_direction'] = $order_direction;
        }
        if (!isset($current_settings['page'])) {
            $current_settings['page'] = $page;
        }
        if ($this->input->post('btn_search', true)) {
            $current_settings['search_text']          = $this->input->post(
                'val_text',
                true
            );
            $current_settings['date_deleted']['from'] = $this->input->post(
                'date_deleted_from',
                true
            );
            $current_settings['date_deleted']['to']   = $this->input->post(
                'date_deleted_to',
                true
            );
        }
        if (!empty($current_settings['search_text'])) {
            $search_text_escape   = $this->db->escape('%' . $current_settings['search_text'] . '%');
            $attrs['where_sql'][] = $search_params['where_sql'][] = '(nickname LIKE ' .
                $search_text_escape . ' OR fname LIKE ' .
                $search_text_escape . ' OR sname LIKE ' .
                $search_text_escape . ' OR email LIKE ' .
                $search_text_escape . ')';
        }

        if (!empty($current_settings['date_deleted']['from'])) {
            $attrs['where_sql'][]         = $search_params['where_sql'][] = "date_deleted >= '" . $current_settings['date_deleted']['from'] . "'";
            $search_param['text']         = $current_settings['search_text'];
        }
        if (!empty($current_settings['date_deleted']['to'])) {
            $attrs['where_sql'][]         = $search_params['where_sql'][] = "date_deleted <= '" . $current_settings['date_deleted']['to'] . " 23:59:59'";
            $search_param['date_deleted'] = $current_settings['date_deleted'];
        }

        $this->load->model('users/models/Users_deleted_model');
        $filter_data['all']                = $this->Users_model->getUsersCount();
        $search_attrs['where']['approved'] = 0;
        $filter_data['not_active']         = $this->Users_model->getUsersCount($search_attrs);
        $search_attrs['where']['approved'] = 1;
        $filter_data['active']             = $this->Users_model->getUsersCount($search_attrs);
        $search_attrs['where']['confirm']  = 0;
        $filter_data['not_confirm']        = $this->Users_model->getUsersCount($search_attrs);
        $filter_data['deleted']            = $this->Users_deleted_model->getUsersCount($search_params);

        $this->view->assign('search_param', $search_param);
        $this->view->assign('filter', $filter);
        $this->view->assign('filter_data', $filter_data);
        $current_settings['page'] = $page;

        if (!$order) {
            $order = $current_settings['order'];
        }
        $this->view->assign('order', $order);
        $current_settings['order'] = $order;

        if (!$order_direction) {
            $order_direction = $current_settings['order_direction'];
        }
        $this->view->assign('order_direction', $order_direction);
        $current_settings['order_direction'] = $order_direction;

        $users_count = $filter_data[$filter];

        if (!$page) {
            $page = $current_settings['page'];
        }
        $items_on_page            = $this->pg_module->get_module_config(
            'start',
            'admin_items_per_page'
        );
        $this->load->helper('sort_order');
        $page                     = get_exists_page_number(
            $page,
            $users_count,
            $items_on_page
        );
        $current_settings['page'] = $page;

        $_SESSION['users_deleted_list'] = $current_settings;

        $sort_links = [
            'nickname' => site_url() . "admin/users/deleted/{$filter}/nickname/" . (($order
            != 'nickname' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
            'date_deleted' => site_url() . "admin/users/deleted/{$filter}/date_deleted/" . (($order
            != 'date_deleted' xor $order_direction == 'DESC') ? 'ASC' : 'DESC'),
        ];

        $this->view->assign('sort_links', $sort_links);

        if ($users_count > 0) {
            $users = $this->Users_deleted_model->getUsersList(
                $page,
                $items_on_page,
                [$order => $order_direction],
                $attrs
            );
            $this->view->assign('users', $users);
        }

        $this->load->helper('navigation');
        $url                      = site_url() . "admin/users/deleted/{$filter}/{$order}/{$order_direction}/";
        $page_data                = get_admin_pages_data(
            $url,
            $users_count,
            $items_on_page,
            $page,
            'briefPage'
        );
        $page_data['date_format'] = $this->pg_date->get_format(
            'date_time_literal',
            'st'
        );
        $this->view->assign('page_data', $page_data);

        $this->view->setHeader(l('admin_header_users_list', 'users'));
        $this->view->render('deleted_list');
    }

    public function settings()
    {
        $settings = [];
        $fields   = [
            'user_approve'                 => ['filter' => FILTER_VALIDATE_INT],
            'user_confirm'                 => ['filter' => FILTER_VALIDATE_BOOLEAN],
            'use_repassword'               => ['filter' => FILTER_VALIDATE_BOOLEAN],
            'hide_user_names'              => ['filter' => FILTER_VALIDATE_BOOLEAN],
            'age_min'                      => ['filter' => FILTER_VALIDATE_INT],
            'age_max'                      => ['filter' => FILTER_VALIDATE_INT],
            'user_advanced_email_validate' => ['filter' => FILTER_VALIDATE_BOOLEAN],
            'without_photo'                => ['filter' => FILTER_VALIDATE_BOOLEAN],
        ];

        $this->load->model('Services_model');
        if ($this->input->post('btn_save')) {
            $validate = $this->Users_model->validateSettings(filter_input_array(INPUT_POST, $fields, false));
            if (!empty($validate['errors'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate['errors']);
                foreach (array_keys($fields) as $key) {
                    $settings[$key] = $this->pg_module->get_module_config('users', $key);
                }
            } else {
                $this->Users_model->saveSettings($validate['data']);
                $settings = $validate['data'];
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_save_settings', 'users'));
            }
        } else {
            foreach (array_keys($fields) as $key) {
                $settings[$key] = $this->pg_module->get_module_config('users', $key);
            }
        }
        $this->view->assign('users_settings', $settings);
        $this->view->setHeader(l('header_settings', 'users'));

        $current_settings = $_SESSION['users_list'] ?? [];
        $filter           = $current_settings['filter'] ?? '';
        $this->view->setBackLink(site_url() . 'admin/users/index/' . $filter);

        $this->view->render('settings');
    }

    public function ajaxGetUsersData($page = 1)
    {
        $return = [];
        $params = [];
        if (!$page) {
            $page = intval($this->input->post('page', true));
            if (!$page) {
                $page = 1;
            }
        }

        $search_string = trim(strip_tags((string)$this->input->post('search', true)));
        if (!empty($search_string)) {
            $hide_user_names = $this->pg_module->get_module_config(
                'users',
                'hide_user_names'
            );
            if ($hide_user_names) {
                $params['where']['nickname LIKE'] = '%' . $search_string . '%';
            } else {
                $search_string_escape  = $this->db->escape('%' . $search_string . '%');
                $params['where_sql'][] = '(nickname LIKE ' . $search_string_escape
                    . ' OR fname LIKE ' . $search_string_escape
                    . ' OR sname LIKE ' . $search_string_escape . ')';
            }
        }

        $selected = $this->input->post('selected', true);
        if (!empty($selected)) {
            $params['where_sql'][] = 'id NOT IN (' . implode($selected) . ')';
        }

        $user_type = $this->input->post('user_type', true);
        if ($user_type) {
            $params['where']['user_type'] = $user_type;
        }

        $items_on_page = $this->pg_module->get_module_config(
            'start',
            'admin_items_per_page'
        );
        $items         = $this->Users_model->getUsersListByKey(
            $page,
            $items_on_page,
            ['nickname' => 'asc'],
            $params,
            [],
            true,
            true
        );

        $return['all']          = $this->Users_model->getUsersCount($params);
        $return['items']        = $items;
        $return['current_page'] = $page;
        $return['pages']        = ceil($return['all'] / $items_on_page);

        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxGetSelectedUsers()
    {
        $selected = $this->input->post('selected', true);
        $selected = array_slice(array_unique(array_map(
            'intval',
            (array) $selected
        )), 0, 1000);
        if (!empty($selected)) {
            $return['selected'] = $this->Users_model->getUsersList(
                null,
                null,
                ['nickname' => 'asc'],
                [],
                $selected,
                true,
                true
            );
        } else {
            $return['selected'] = [];
        }
        $this->view->assign($return);
        $this->view->render();
    }

    public function ajaxGetUsersForm($max_select = 1)
    {
        $selected = $this->input->post('selected', true);

        if (!empty($selected)) {
            $data['selected'] = $this->Users_model->getUsersList(
                null,
                null,
                ['nickname' => 'asc'],
                [],
                $selected,
                false
            );
        } else {
            $data['selected'] = [];
        }
        $data['max_select'] = $max_select ? $max_select : 0;

        $this->view->assign('select_data', $data);
        $this->view->render('ajax_user_select_form');
    }

    public function ajaxLoadAvatar($uploader = false)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        $id_user = (int)$this->input->post('id_user', true);

        $data = [
            'user'     => $this->Users_model->getUserById($id_user, true),
            'is_owner' => true
        ];

        $data['have_avatar'] = ($data['user']['user_logo'] || $data['user']['user_logo_moderation']);
        if ($data['is_owner']) {
            $this->load->model('uploads/models/Uploads_config_model');
            $data['upload_config'] = $this->Uploads_model->getConfig($this->Users_model->upload_config_id);
            $data['selections']    = [];
            foreach ($data['upload_config']['thumbs'] as $thumb_config) {
                $data['selections'][$thumb_config['prefix']] = [
                    'width'  => $thumb_config['width'],
                    'height' => $thumb_config['height'],
                ];
            }
        }
        $this->view->assign('user_type_logo', $this->session->userdata('auth_type'));

        $this->view->assign('avatar_data', $data);
        $this->view->assign('uploader', $uploader);
        $result['data']['html'] = $this->view->fetchFinal('ajax_user_avatar', null, 'users');
        if (isset($data['selections'])) {
            $result['data']['selections'] = $data['selections'];
        }
        $this->view->assign($result);
        $this->view->render();
    }

    public function ajaxRecropAvatar($user_id = null)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        if (!$user_id) {
            $result['status']   = 0;
            $result['errors'][] = l('error_access_denied', UsersModel::MODULE_GID);
            $this->view->assign($result);
            return;
        }

        $user = $this->Users_model->getUserById($user_id, true);

        $logo_name   = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        $recrop_data = [
            'x1'     => $this->input->post('x1', true),
            'y1'     => $this->input->post('y1', true),
            'width'  => $this->input->post('width', true),
            'height' => $this->input->post('height', true)
        ];
        $this->Users_model->simplyUpdateUser($user_id, ['date_modified' => date(UsersModel::DB_DATE_FORMAT)]);
        $this->load->model('Uploads_model');

        $this->load->model('moderation/models/Moderation_type_model');
        $moder_type = $this->Moderation_type_model->getTypeByName('user_logo');
        $postfix    = $user_id;
        $path_img   = $user['media'][$logo_name]['file_url'];

        $is_premoderation = strpos($path_img, '/' . UsersModel::ORIGINAL_IMG_PATH);
        if ((intval($moder_type['mtype']) == 2) && ($is_premoderation !== false)) {
            $postfix .= '/' . UsersModel::ORIGINAL_IMG_PATH;
        }
        $this->Uploads_model->recropUpload($this->Users_model->upload_config_id, $postfix, $user[$logo_name], $recrop_data, null, true);

        $result['data']['img_url'] = $user['media'][$logo_name]['thumbs'];
        $result['data']['rand']    = rand(0, 999999);
        $result['msg'][]           = l('success_update_user', UsersModel::MODULE_GID);

        $this->view->assign($result);
        $this->view->render();
    }

    public function photoRotate($angle = 90, $user_id = null)
    {
        $result = ['status' => 1, 'errors' => [], 'msg' => [], 'data' => []];

        if (!$user_id) {
            $result['status']   = 0;
            $result['errors'][] = l('error_access_denied', UsersModel::MODULE_GID);
            $this->view->assign($result);
            return;
        }

        $user      = $this->Users_model->getUserById($user_id, true);
        $logo_name = $user['user_logo_moderation'] ? 'user_logo_moderation' : 'user_logo';
        if ($angle < 0) {
            $angle += 360;
        } elseif ($angle != 'hor') {
            $angle = (int)($angle);
        }

        if ($user[$logo_name]) {
            $this->Users_model->simplyUpdateUser($user_id, ['date_modified' => date(UsersModel::DB_DATE_FORMAT)]);
            $this->load->model('Uploads_model');

            $this->load->model('moderation/models/Moderation_type_model');
            $moder_type = $this->Moderation_type_model->getTypeByName('user_logo');
            $postfix    = $user_id;
            $path_img   = $user['media'][$logo_name]['file_url'];

            $is_premoderation = strpos($path_img, '/' . UsersModel::ORIGINAL_IMG_PATH);
            if ((intval($moder_type['mtype']) == 2) && ($is_premoderation !== false)) {
                $postfix .= '/' . UsersModel::ORIGINAL_IMG_PATH;
            }

            $this->Uploads_model->rotateUpload($this->Users_model->upload_config_id, $postfix, $user[$logo_name], $angle, true);
            $result['data']['img_url'] = $user['media'][$logo_name]['file_url'];
            $result['data']['thumbs']  = $user['media'][$logo_name]['thumbs'];

            $result['data']['rand'] = rand(0, 999999);
            $result['msg'][]        = l('success_update_user', UsersModel::MODULE_GID);
        } else {
            $result['status']   = 0;
            $result['errors'][] = 'access denied';
        }

        $this->view->assign($result);
        $this->view->render();
    }

    /* <custom_R> */
    public function indexUsers($page = null)
    {
        $current_settings   = $this->session->userdata('index_users_list') ?: [];

        if (!isset($current_settings['order'])) {
            $current_settings['order'] = 'nickname';
        }
        if (!isset($current_settings['order_direction'])) {
            $current_settings['order_direction'] = 'ASC';
        }
        if (!isset($current_settings['page'])) {
            $current_settings['page'] = 1;
        }

        if ($this->uri->segment(4) === false) {
            $current_settings['filters'] = [];
        }

        if ($this->input->post('btn_search', true)) {
            $current_settings['filters'] = [
                'user_type'     => $this->input->post('user_type', true),
                'search_type'   => $this->input->post('search_type', true),
                'search_text'   => $this->input->post('search_text', true),
                'last_active'   => [
                    'from'      => $this->input->post('last_active_from', true),
                    'to'        => $this->input->post('last_active_to', true),
                ],
                'date_created'   => [
                    'from'      => $this->input->post('date_created_from', true),
                    'to'        => $this->input->post('date_created_to', true),
                ],
                'id_country'    => $this->input->post('id_country', true),
                'id_region'     => $this->input->post('id_region', true),
                'id_city'       => $this->input->post('id_city', true),
                'with_photo'    => $this->input->post('with_photo', true),
            ];

            $page = 1;
        }

        $criteria           = [
            'where' => [
                'approved'  => 1,
                'confirm'   => 1,
            ],
        ];
        if (!empty($current_settings['filters']['user_type'])) {
            $user_type = trim(strip_tags($current_settings['filters']['user_type']));
            $criteria['where']['user_type'] = $user_type;
        }
        if (!empty($current_settings['filters']['search_text'])) {
            $search_text_escape = $this->db->escape('%' . $current_settings['filters']['search_text'] . '%');
            if (in_array($current_settings['filters']['search_type'], ['email', 'fname', 'sname', 'nickname'])) {
                $criteria['where_sql'][] = $current_settings['filters']['search_type'] . ' LIKE ' . $search_text_escape;
            } else {
                $criteria['where_sql'][] = '(nickname LIKE ' . $search_text_escape . ' OR fname LIKE ' . $search_text_escape . ' OR sname LIKE ' . $search_text_escape . ' OR email LIKE ' . $search_text_escape . ')';
            }
        }
        if (!empty($current_settings['filters']['last_active']['from'])) {
            $criteria['where_sql'][] = "date_last_activity >= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['filters']['last_active']['from'])
            ) . "'";
        }
        if (!empty($current_settings['filters']['last_active']['to'])) {
            $criteria['where_sql'][] = "date_last_activity <= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['filters']['last_active']['to'])
            ) . " 23:59:59'";
        }
        if (!empty($current_settings['filters']['date_created']['from'])) {
            $criteria['where_sql'][] = "date_created >= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['filters']['date_created']['from'])
            ) . "'";
        }
        if (!empty($current_settings['filters']['date_created']['to'])) {
            $criteria['where_sql'][] = "date_created <= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings['filters']['date_created']['to'])
            ) . " 23:59:59'";
        }
        if (!empty($current_settings['filters']['id_country'])) {
            $criteria['where']['id_country'] = trim(strip_tags($current_settings['filters']['id_country']));
            if (!empty($current_settings['filters']['id_region'])) {
                $criteria['where']['id_region'] = (int) $current_settings['filters']['id_region'];
                if (!empty($current_settings['filters']['id_city'])) {
                    $criteria['where']['id_city'] = (int) $current_settings['filters']['id_city'];
                }
            }
        }
        if (!empty($current_settings['filters']['with_photo'])) {
            $criteria['where']['user_logo !='] = '';
        }

        $filter_data['all']                 = $this->Users_model->getUsersCount();
        $filter_data['not_active']          = $this->Users_model->getUsersCount(['where' => ['approved' => 0]]);
        $filter_data['active']              = $this->Users_model->getUsersCount(['where' => ['approved' => 1]]);
        $filter_data['not_confirm']         = $this->Users_model->getUsersCount(['where' => ['confirm' => 0]]);

        $this->load->model('users/models/UsersDeletedModel');
        $filter_data['deleted']             = $this->UsersDeletedModel->getUsersCount();

        $this->load->model('PropertiesModel');
        $user_types = $this->PropertiesModel->getProperty('user_type');
        $this->view->assign('user_types', $user_types);

        $this->view->assign('search_params', $current_settings['filters']);
        $this->view->assign('filter_data', $filter_data);

        $users_count = $this->Users_model->getUsersCount($criteria);

        if (!$page) {
            $page = $current_settings['page'];
        }
        $this->load->helper('sort_order');
        $items_on_page            = 60; // $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $page                     = get_exists_page_number($page, $users_count, $items_on_page);
        $current_settings['page'] = $page;

        $this->session->set_userdata('index_users_list', $current_settings);

        if ($users_count > 0) {
            $users = $this->Users_model->getUsersList($page, $items_on_page, ['nickname' => 'ASC'], $criteria);
            $this->view->assign('users', $users);
        }

        $this->load->helper('navigation');
        $url        = site_url() . 'admin/users/index_users/';
        $page_data  = get_admin_pages_data($url, $users_count, $items_on_page, $page, 'briefPage');
        $this->view->assign('page_data', $page_data);

        $selected_users = unserialize($this->pg_module->get_module_config('users', 'index_users') ?: '');
        $this->view->assign('selected_users', $selected_users);

        $this->view->setHeader(l('admin_header_index_users', 'users'));
        $this->view->render('index_users');
    }

    public function ajaxSetIndexUser()
    {
        $return     = ['status' => 1, 'message' => ''];

        $user_id    = (int) $this->input->post('user_id', true);
        $action     = trim(strip_tags($this->input->post('action', true)));

        if (empty($user_id)) {
            $return['status']   = 0;
            $return['message']  = l('error_no_users_to_change_group', 'users');
            exit(json_encode($return));
        }

        $selected_users = unserialize($this->pg_module->get_module_config('users', 'index_users') ?: '');

        switch ($action) {
            case 'add':
                $selected_users[] = $user_id;
                break;
            case 'remove':
            default:
                $selected_users = array_diff($selected_users, [$user_id]);
                break;
        }

        $this->pg_module->set_module_config('users', 'index_users', serialize($selected_users));

        exit(json_encode($return));
    }
    /* </custom_R> */
}
