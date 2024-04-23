<?php

declare(strict_types=1);

namespace Pg\modules\users\helpers {

    use Pg\modules\users\models\UsersModel;

    if (!function_exists('loginForm')) {
        function loginForm()
        {
            $ci = &get_instance();
            if ($ci->session->userdata("auth_type") == "user") {
                $ci->load->model("Users_model");
                $user_data = $ci->Users_model->getUserById($ci->session->userdata("user_id"), true);
                $ci->view->assign('user_data', $user_data);
            }

            return $ci->view->fetch('helper_login_form', 'user', 'users');
        }
    }

    if (!function_exists('usersLangSelect')) {
        function usersLangSelect($attrs = [])
        {
            $ci = &get_instance();
            $count_active = 0;
            foreach ($ci->pg_language->languages as $language) {
                if ($language["status"]) {
                    ++$count_active;
                }
            }
            $ci->view->assign("type", $attrs['type'] ?? '');
            $ci->view->assign("count_active", $count_active);
            $ci->view->assign("current_lang", $ci->pg_language->current_lang_id);
            $ci->view->assign("languages", $ci->pg_language->languages);

            if (!empty($attrs['template'])) {
                $template = 'helper_lang_select_' . $attrs['template'];
            } else {
                $template = 'helper_lang_select';
            }

            return $ci->view->fetch($template, null, 'users');
        }
    }

    if (!function_exists('topMenu')) {
        function topMenu($params = [])
        {
            $ci = &get_instance();
            $type = empty($params['type']) ? '' : '_' . $params['type'];

            return $ci->view->fetch('helper_top_menu' . $type, 'user', 'users');
        }
    }

    if (!function_exists('authLinks')) {
        function authLinks(array $params = [])
        {
            $ci = &get_instance();

            if (empty($params['template'])) {
                $params['template'] = 'helper_auth_links';
            }

            if (!empty($params['is_mobile'])) {
                $ci->view->assign('is_mobile', 1);
            } else {
                $ci->view->assign('is_mobile', 0);
            }

            return $ci->view->fetch($params['template'], 'user', 'users');
        }
    }

    if (!function_exists('lastRegistered')) {
        function lastRegistered($params)
        {
            $ci = &get_instance();
            $ci->load->model('Users_model');
            $attrs["where_sql"][] = " id!='" . $ci->session->userdata("user_id") . "'";
            $attrs['order_by'] = ['field' => 'date_created', 'direction' => 'DESC',];
            $data['users'] = $ci->Users_model->getActiveUsers($params['count'], 0, $attrs);

            $user_types = $ci->Properties_model->get_property('user_type');
            $ci->view->assign('user_types', $user_types["option"]);

            if (empty($data['users'])) {
                return false;
            }

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

            if (empty($params['template'])) {
                $params['template'] = '';
            }

            if ($params['template'] == 'arundiana') {
                $recent_thumb['name'] = 'big';
            }

            $ci->view->assign('recent_thumb', $recent_thumb);
            $ci->view->assign('active_users_block_data', $data);

            if (!empty($params['template'])) {
                return $ci->view->fetch('helper_last_registered_' . $params['template'], 'user', 'users');
            }

            return $ci->view->fetch('helper_last_registered', 'user', 'users');

            return false;
        }
    }

    if (!function_exists('incorrectEmail')) {
        function incorrectEmail()
        {
            $ci = &get_instance();
            if ($ci->pg_module->get_module_config('users', 'user_advanced_email_validate')) {
                if ($ci->session->userdata("auth_type") != "user") {
                    return false;
                }
                $user_id = $ci->session->userdata('user_id');
                $ci->load->model('Users_model');
                $user = $ci->Users_model->getUserById($user_id, true);
                if ($user['checked_email'] && !$user['valid_email'] && !$ci->session->userdata('is_not_valid_email_show')) {
                    $ci->session->set_userdata('is_not_valid_email_show', 1);
                    $contact_us_url = $ci->pg_module->is_module_installed('tickets') ? 'tickets' : 'contact_us';
                    $ci->view->assign('contact_us_url', $contact_us_url);

                    return $ci->view->fetch('helper_not_valid_email', 'user', 'users');
                }
            } else {
                return false;
            }
        }
    }

    if (!function_exists('userSelect')) {
        function userSelect($selected = [], $max_select = 0, $var_name = 'id_user')
        {
            $ci = &get_instance();
            $ci->load->model("Users_model");

            if ($max_select === 1 && !empty($selected) && !is_array($selected)) {
                $selected = [$selected];
            }

            if (!empty($selected)) {
                $data["selected"] = $ci->Users_model->getUsersList(null, null, null, [], $selected, true);
                $data["selected_str"] = implode(",", $selected);
            } else {
                $data["selected_str"] = "";
            }

            $data["var_name"] = $var_name ?: "id_user";
            $data["max_select"] = $max_select ?: 0;

            $data["rand"] = rand(100000, 999999);

            $ci->view->assign('select_data', $data);

            return $ci->view->fetch('helper_user_select', null, 'users');
        }
    }

    if (!function_exists('adminHomeUsersBlock')) {
        function adminHomeUsersBlock()
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata("auth_type");
            if ($auth_type != "admin") {
                return '';
            }

            $user_type = $ci->session->userdata("user_type");

            $show = true;

            $stat_users = [
                'index_method' => true,
                'moderation_method' => true,
            ];

            if ($user_type == 'moderator') {
                $show = false;
                $ci->load->model('Moderators_model');
                $methods_users = $ci->Moderators_model->getModuleMethods('users');
                $methods_moderation = $ci->Moderators_model->getModuleMethods('moderation');
                if (
                    (is_array($methods_users) && !in_array('index', $methods_users, true))
                    || (is_array($methods_moderation) && !in_array('index', $methods_moderation, true))
                ) {
                    $show = true;
                } else {
                    $permission_data = $ci->session->userdata("permission_data");
                    if (
                        (isset($permission_data['users']['index']) && (int)$permission_data['users']['index'] === 1)
                        || (isset($permission_data['moderation']['index']) && (int)$permission_data['moderation']['index'] === 1)
                    ) {
                        $show = true;
                        $stat_users['index_method'] = isset($permission_data['users']) ? (bool)$permission_data['users']['index'] : false;
                        $stat_users['moderation_method'] = isset($permission_data['moderation']) ? (bool)$permission_data['moderation']['index'] : false;
                    }
                }
            }

            if (!$show) {
                return '';
            }

            $ci->load->model(['Users_model', 'Moderation_model']);
            $stat_users["all"] = $ci->Users_model->getUsersCount();
            $stat_users["active"] = $ci->Users_model->getActiveUsersCount();
            $stat_users["blocked"] = $ci->Users_model->getUsersCount(["where" => ['approved' => 0]]);
            $stat_users["unconfirm"] = $ci->Users_model->getUsersCount(["where" => ['confirm' => 0]]);
            $stat_users["icons"] = $ci->Moderation_model->getModerationListCount('user_logo');

            $ci->view->assign("stat_users", $stat_users);

            return $ci->view->fetch('helper_admin_home_block', 'admin', 'users');
        }
    }

    if (!function_exists('usersSearchForm')) {
        function usersSearchForm($object = 'user', $type = 'line', $show_data = false, $params = [])
        {
            $ci = &get_instance();

            $ci->load->model(['Users_model', 'Field_editor_model']);

            $form_settings = [
                'type' => $type,
                'form_id' => $object . '_' . $type,
                'use_advanced' => false,
                'action' => $params['action'] ?? site_url() . 'users/search',
                'object' => $object,
                'hide_popup' => !empty($params['hide_popup']),
                'view' => !empty($params['view']),
                'is_full_page' => !empty($params['is_full_page']),
                'load_users' => $params['load_users'] ?? 'users/ajaxLoadUsers/',
                'form_url' => $params['form_url'] ?? 'users/search/',
                'search_url' => $params['search_url'] ?? 'users/ajax_search/',
                'count_url' => $params['count_url'] ?? 'users/ajax_search_counts/'
            ];

            $min_age = $ci->pg_module->get_module_config('users', 'age_min');
            $max_age = $ci->pg_module->get_module_config('users', 'age_max');

            for ($i = $min_age; $i <= $max_age; ++$i) {
                $age_range[$i] = $i;
            }
            $ci->view->assign('age_range', $age_range);

            if ($type != 'line') {
                $ci->load->model('Properties_model');
                $user_types = $ci->Properties_model->getProperty('user_type');
                $ci->view->assign('user_types', $user_types);

                $looking_user_types = $ci->Properties_model->getProperty('looking_user_type');
                $ci->view->assign('looking_user_types', $looking_user_types);
            }

            $validate_settings = ['data' => []];
            if ($show_data) {
                $ci->Field_editor_model->initialize($ci->Users_model->form_editor_type);
                $fields_for_select = $ci->Field_editor_model->getFieldsForSelect();
                $ci->Users_model->setAdditionalFields($fields_for_select);

                $current_settings = $ci->session->userdata('users_search');
                if (empty($current_settings)) {
                    $current_settings = $ci->Users_model->getDefaultSearchData();
                }

                $validate_settings = $ci->Users_model->validate(0, $current_settings, '', '', 'select');
                foreach ($fields_for_select as $field) {
                    if (
                        !empty($validate_settings['data'][$field]) || !empty($validate_settings['data'][$field . '_min'])
                        || !empty($validate_settings['data'][$field . '_max'])
                    ) {
                        $form_settings["type"] = 'full';

                        break;
                    }
                }

                $validate_settings['data']['age_min'] = $ci->session->userdata("users_search")['age_min'] ?: $min_age;
                $validate_settings['data']['age_max'] = $ci->session->userdata("users_search")['age_max'] ?: $max_age;
            }

            if ($object == 'user' && $type == 'advanced') {
                $ci->Field_editor_model->initialize($ci->Users_model->form_editor_type);
                $ci->load->model('field_editor/models/Field_editor_forms_model');
                $form = $ci->Field_editor_forms_model->getFormByGid(
                    $ci->Users_model->advanced_search_form_gid,
                    $ci->Users_model->form_editor_type
                );
                $form = $ci->Field_editor_forms_model->formatOutputForm($form, $validate_settings['data']);

                if (!empty($form['field_data'])) {
                    foreach ($form['field_data'] as $key => $field_data) {
                        if (!empty($field_data['section']['fields'])) {
                            $form_settings["use_advanced"] = true;

                            break;
                        } elseif (!empty($field_data['field'])) {
                            $form_settings["use_advanced"] = true;

                            break;
                        }
                        unset($form['field_data'][$key]);
                    }

                    $ci->view->assign('advanced_form', $form['field_data']);
                }

                $form_settings["type"] = ($form_settings["type"] == 'full') ? 'full' : 'short';
            }
            if (!empty($current_settings['online_status'])) {
                $validate_settings["data"]['online_status'] = $current_settings['online_status'];
            }
            if (!empty($current_settings['region_name'])) {
                $validate_settings["data"]['region_name'] = $current_settings['region_name'];
            }
            if (!empty($current_settings['radius'])) {
                $validate_settings["data"]['radius'] = $current_settings['radius'];
            }

            if (isset($current_settings['withPhotoActive']) && $current_settings['withPhotoActive']) {
                $ci->view->assign('withPhotoActive', $current_settings['withPhotoActive']);
                $ci->view->assign('withPhoto', $current_settings['withPhoto']);
            }
            $ci->view->assign('data', $validate_settings["data"] ?: []);
            $ci->view->assign('form_settings', $form_settings);

            if (!empty($params['view']) && $params['view'] == 'horizontal') {
                $html = $ci->view->fetch("helper_search_form_horizontal", 'user', 'users');
            } else {
                $html = $ci->view->fetch("helper_search_form", 'user', 'users');
            }

            return $html;
        }
    }

    if (!function_exists('userInput')) {
        function userInput($params)
        {
            $ci = &get_instance();
            $ci->load->model('Users_model');

            if (!empty($params['id_user'])) {
                $data['user'] = $ci->Users_model->getUser($params['id_user']);
            }

            $data['var_user_name'] = isset($params['var_user_name']) ? $params['var_user_name'] : 'id_user';
            $data['var_js_name'] = isset($params['var_js_name']) ? $params['var_js_name'] : '';
            $data['autocomplete'] = isset($params['autocomplete']) ? (bool)$params['autocomplete'] : false;
            $data['placeholder'] = isset($params['placeholder']) ? $params['placeholder'] : '';

            $data['rand'] = rand(100000, 999999);

            $ci->view->assign('user_helper_data', $data);

            return $ci->view->fetch('helper_user_input', 'user', 'users');
        }
    }

    if (!function_exists('usersCarousel')) {
        function usersCarousel($params)
        {
            $ci = &get_instance();

            if (empty($params['users'])) {
                return '';
            }

            $rand = rand(1, 999999);

            $data = [
                'header' => !empty($params['header']) ? $params['header'] : '',
                'users' => $params['users'],
                'rand' => $rand,
                'carousel' => [
                    'rand' => $rand,
                    'visible' => !empty($params['visible']) ? (int)$params['visible'] : 3,
                    'scroll' => (!empty($params['scroll']) && $params['scroll'] != 'auto') ? (int)$params['scroll'] : 'auto',
                    'class' => !empty($params['class']) ? $params['class'] : '',
                    'thumb_name' => !empty($params['thumb_name']) ? $params['thumb_name'] : 'middle'
                ]
            ];
            $ci->view->assign('users_carousel_data', $data);

            return $ci->view->fetch('helper_users_carousel', 'user', 'users');
        }
    }

    if (!function_exists('featuredUsers')) {
        function featuredUsers($is_default = true, $params = [])
        {
            if ($is_default) {
                return \Pg\modules\users\helpers\featuredUsersDefault();
            }

            $ci = &get_instance();
            $ci->load->model('Users_model');

            if (!empty($params['count'])) {
                $userscount = $params['count'];
            } else {
                $userscount = '50';
            }

            $users = $ci->Users_model->getFeaturedUsers($userscount);
            if (empty($users)) {
                return false;
            }
            $data = [
                'rand' => rand(1, 999999),
                'users' => $users,
                'buy_ability' => false
            ];

            if (!empty($params['size'])) {
                $thumb_name = $params['size'];
            } else {
                $thumb_name = 'big';
            }

            if ($ci->session->userdata("auth_type") == "user") {
                $user = $ci->Users_model->getUserById($ci->session->userdata("user_id"), true);
                if (!empty($user)) {
                    $data['service_status'] = $ci->Users_model->serviceStatusUsersFeatured($user);
                    $data['buy_ability'] = $data['service_status']['status'];
                    $ci->view->assign('user', $user);
                }
            }

            $ci->view->assign('thumb_name', $thumb_name);
            $ci->view->assign('helper_featured_users_data', $data);

            if (isset($params['center_block'])) {
                $ci->view->assign('center_block', 1);
            }

            if (!empty($params['template'])) {
                return $ci->view->fetch('helper_featured_users_' . $params['template'], 'user', 'users');
            }

            return $ci->view->fetch('helper_featured_users', 'user', 'users');
        }
    }

    if (!function_exists('featuredUsersDefault')) {
        function featuredUsersDefault()
        {
            $ci = &get_instance();
            $ci->load->model('Users_model');

            $users = $ci->Users_model->getFeaturedUsers(50);
            if (empty($users)) {
                return '';
            }

            $data['rand'] = rand(1, 999999);
            $data['buy_ability'] = false;
            $data['users'] = $users;

            if ($ci->session->userdata("auth_type") == "user") {
                $user_id = $ci->session->userdata("user_id");
                $user = $ci->Users_model->getUserById($user_id);
                $user = $ci->Users_model->formatUser($user);
                if (!empty($user)) {
                    $data['service_status'] = $ci->Users_model->serviceStatusUsersFeatured($user);
                    $data['buy_ability'] = $data['service_status']['status'];
                    if ($data['buy_ability']) {
                        $user['carousel_data']['class'] = 'with-overlay-add';
                        $user['carousel_data']['icon_class'] = 'fa-plus edge icon-big w';
                        $user['carousel_data']['id'] = 'featured_add_' . $data['rand'];
                        $data['user_id'] = $user['id'];
                        array_unshift($data['users'], $user);
                    }
                }
            }

            $ci->view->assign('helper_featured_users_data', $data);

            return $ci->view->fetch('helper_featured_users', 'user', 'users');
        }
    }

    if (!function_exists('activeUsersBlock')) {
        function activeUsersBlock($params)
        {
            $ci = &get_instance();
            $ci->load->model('Users_model');

            $attrs["where_sql"][] = " id!='" . $ci->session->userdata("user_id") . "'";
            $data['users'] = $ci->Users_model->getActiveUsers($params['count'], 0, $attrs);

            $user_types = $ci->Properties_model->getProperty('user_type');
            $ci->view->assign('user_types', $user_types["option"]);

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
                $ci->view->assign('recent_thumb', $recent_thumb);
                $ci->view->assign('active_users_block_data', $data);

                return $ci->view->fetch('helper_active_users_block', 'user', 'users');
            }

            return false;
        }
    }

    if (!function_exists('deleteSelectBlock')) {
        function deleteSelectBlock($params)
        {
            $ci = &get_instance();

            $display = true;
            $params['title_text'] = l('link_delete_user', 'users');
            if (!empty($params['deleted']) && $params['deleted'] == 1) {
                $params['title_text'] = l('link_delete_data_user', 'users');

                $ci->load->model("users/models/Users_delete_callbacks_model");
                $callbacks = $ci->Users_delete_callbacks_model->getAllCallbacksGid();

                $diff_callback = array_diff($callbacks, unserialize($params['callback_user']));
                if (empty($diff_callback)) {
                    return;
                }
            }
            $ci->view->assign('params', $params);

            return $ci->view->fetch('helper_delete_select_block', 'admin', 'users');
        }
    }

    if (!function_exists('visitors')) {
        function visitors($attrs)
        {
            $ci = &get_instance();

            $ci->load->model('users/models/Users_views_model');
            $count = count($ci->Users_views_model->getViewersDailyUnique(
                $ci->session->userdata('user_id'),
                null,
                null,
                ['view_date' => 'DESC'],
                [],
                'all',
                1
            ));
            $ci->view->assign('visitors_count', $count);

            return $ci->view->fetch('helper_visitors_' . $attrs['template'], 'user', 'users');
        }
    }

    if (!function_exists('reFormatUsers')) {
        function reFormatUsers($attrs)
        {
            $ci = &get_instance();

            $ci->load->model('Users_model');
            $users = $ci->Users_model->reFormatUsers($attrs['users']);

            if (!empty($attrs['return'])) {
                return $users;
            }
            $ci->view->assign('users', $users);
        }
    }

    if (!function_exists('quickSearch')) {
        function quickSearch()
        {
            $ci = &get_instance();

            return $ci->view->fetch('helper_quick_search', 'user', 'users');
        }
    }

    if (!function_exists('shortInformation')) {
        function shortInformation()
        {
            $ci = &get_instance();

            if ($ci->session->userdata("auth_type") != "user") {
                return '';
            }

            $ci->view->assign('user_short', $ci->session->userdata);

            return $ci->view->fetch('helper_short_information', 'user', 'users');
        }
    }

    if (!function_exists('getLogoutLink')) {
        function getLogoutLink()
        {
            $ci = &get_instance();

            if ($ci->session->userdata("auth_type") != "user") {
                return false;
            }

            $ci->load->helper('seo');

            return [
                'link' => rewrite_link('users', 'logout'),
                'icon' => 'sign-out',
                'label' => l('link_logout', 'users'),
            ];
        }
    }

    if (!function_exists('getPreview')) {
        function getPreview($params = [])
        {
            $ci = &get_instance();

            if ($ci->session->userdata("auth_type") != "user") {
                return false;
            }

            $user_id = $ci->session->userdata('user_id');
            $ci->load->model('Users_model');
            $user = $ci->Users_model->getUserById($user_id, true);
            $user['services_status'] = $ci->Users_model->servicesStatus($user);
            $is_services_button = false;
            $services = ['highlight_in_search', 'up_in_search', 'hide_on_site'];
            foreach ($services as $service) {
                if (!empty($user['services_status'][$service]) && $user['services_status'][$service]['status'] == 1) {
                    $is_services_button = true;

                    continue;
                }
            }

            $ci->view->assign('data', $user);
            $ci->view->assign('is_services_button', $is_services_button);
            if (!empty($params['sidebar'])) {
                $ci->view->assign('sidebar', $params['sidebar']);
            }
            $ci->view->assign('is_owner', true);

            if ($ci->Users_model->is_couples_installed === true) {
                if ($user['user_type'] === \Pg\modules\couples\models\CouplesModel::USER_TYPE) {
                    return $ci->view->fetch('user_preview', 'user', 'couples');
                }
            }

            return $ci->view->fetch('user_preview', 'user', 'users');
        }
    }

    if (!function_exists('availableActivation')) {
        function availableActivation()
        {
            $ci = &get_instance();

            if ($ci->session->userdata("auth_type") != "user") {
                return false;
            }

            return $ci->view->fetch('helper_available_activation', 'user', 'users');
        }
    }

    if (!function_exists('formatAvatar')) {
        function formatAvatar(array $params)
        {
            $ci = &get_instance();

            $logo_data = '';
            $logo_thumbs = [];
            $logo_max_width = 0;
            if (isset($params['user']['media']['user_logo'])) {
                if (isset($params['get_original_file_url']) && !empty($params['get_original_file_url'])) {
                    $logo_data = $params['user']['media']['user_logo']['file_url'];
                } else {
                    $logo_data = $params['user']['media']['user_logo']['thumbs'][$params['size']];
                    $logo_thumbs = $params['user']['media']['user_logo']['thumbs_data'];
                    $logo_max_width = $params['user']['media']['user_logo']['thumbs_data'][$params['size']]['file_width'];
                }
            } elseif (!empty($params['user']['media']['user_logo_moderation'])) {
                $logo_data = $params['user']['media']['user_logo_moderation']['thumbs'][$params['size']];
                $logo_thumbs = $params['user']['media']['user_logo_moderation']['thumbs_data'];
                $logo_max_width = $params['user']['media']['user_logo_moderation']['thumbs_data'][$params['size']]['file_width'];
            }

            $logo_params = [
                'size_name' => $params['size'],
                'src' => $logo_data,
                'alt' => !empty($params['user']['output_name']) ? l('text_user_logo', 'users', null, 'button', ['name' => $params['user']['output_name']]) : '',
                'title' => !empty($params['user']['output_name']) ? l('text_user_logo', 'users', null, 'button', ['name' => $params['user']['output_name']]) : '',
                'thumbs' => $logo_thumbs,
                'max_width' => $logo_max_width,
                'online_status' => isset($params['user']['online_status']) ? (int)$params['user']['online_status'] : 0,
            ];

            if (!empty($params['user']['user_logo_mime'])) {
                $logo_params['mime'] = $params['user']['user_logo_mime'];
            }

            if (!empty($params['user']['media']['user_logo']['webp'])) {
                if (isset($params['get_original_file_url']) && !empty($params['get_original_file_url'])) {
                } else {
                    $logo_params['thumbs_webp'] = $params['user']['media']['user_logo']['webp']['thumbs_data'];
                }
            } elseif (!empty($params['user']['media']['user_logo_moderation']['webp'])) {
                $logo_params['thumbs_webp'] = $params['user']['media']['user_logo_moderation']['webp']['thumbs_data'];
            }

            if (!empty($params['class'])) {
                $logo_params['class'] = $params['class'];
            }
            if (!empty($params['id'])) {
                $logo_params['id'] = $params['id'];
            }
            if (!empty($params['width'])) {
                $logo_params['width'] = $params['width'];
            }
            if (!empty($params['height'])) {
                $logo_params['height'] = $params['height'];
            }

            $ci->view->assign('logo_params', $logo_params);
            $format_avatar = $ci->view->fetch('decorator_user_logo', 'user', 'users');
            if ($ci->session->userdata("auth_type") != "user") {
                return $format_avatar;
            }
            if ($ci->pg_module->is_module_installed('birthdays') && (!empty($params['user']['birth_date_raw']) || !empty($params['user']['birth_date']))) {
                if ($ci->pg_module->get_module_config('birthdays', 'is_active')) {
                    $ci->load->helper("birthdays");
                    $format_avatar = \Pg\modules\birthdays\helpers\formatBirthdayLogo([
                        'logo' => $format_avatar,
                        'birth_date' => (!empty($params['user']['birth_date_raw']) ? $params['user']['birth_date_raw'] : $params['user']['birth_date']),
                        'size' => $params['size'],
                        'online_status' => $logo_params['online_status'],
                    ]);
                }
            }

            return $format_avatar;
        }
    }

    if (!function_exists('onUserAccount')) {
        function onUserAccount($params = [])
        {
            $ci = &get_instance();

            $params['output_type'] = (isset($params['output_type']) && !empty($params['output_type'])) ?
                $params['output_type'] : 'short';

            if ($ci->session->userdata("auth_type") != "user") {
                return false;
            }

            $user_id = $ci->session->userdata('user_id');
            $ci->load->model('Users_model');
            $user = $ci->Users_model->getUserById($user_id);
            $user_account = $user['account'];
            $ci->view->assign('user_account', $user_account);
            $ci->view->assign('output_type', $params['output_type']);

            return $ci->view->fetch('helper_user_account', 'user', 'users');
        }
    }

    if (!function_exists('usersRegistration')) {

        /**
         * Users registration
         *
         * @param array $params
         *
         * @return string
         */
        function usersRegistration(array $params)
        {
            $ci = &get_instance();
            $lang = $ci->pg_language->get_lang_by_id($ci->pg_language->current_lang_id);
            $ci->load->model(['Properties_model', 'users/models/Users_fields_validation_model']);
            $page_data = [
                'reglang' => isset($params['lang']) ? $params['lang'] : l('link_register', UsersModel::MODULE_GID),
                'gotoform' => !empty($params['gotoform']) ? 1 : 0,
                'withoutform' => !empty($params['withoutform']) ? 1 : 0,
                'is_link' => !empty($params['is_link']) ? 1 : 0,
                'is_load_form' => $ci->Users_model->is_load_form,
                'class' => (isset($params['class']) && !empty($params['class'])) ? $params['class'] : '',
                'is_registration' => !empty($params['is_registration']) ? 1 : 0,
                'datepicker_lang_script' => file_exists(APPLICATION_FOLDER . 'js/datepicker-langs/jquery.ui.datepicker-' . $lang['code'] . '.js') ?
                    'datepicker-langs/jquery.ui.datepicker-' . $lang['code'] . '.js' : 'datepicker-langs/jquery.ui.datepicker-en.js'
            ];

            if ($page_data['withoutform'] == 1) {
                $page_data['is_load_form'] = true;
            } else {
                if ($ci->Users_model->is_load_form === false) {
                    $ci->Users_model->is_load_form = true;
                    $page_data['form_action'] = site_url('users/registration');
                    $page_data['is_auth'] = ($ci->session->userdata('auth_type') == 'user') ? true : 0;
                    $page_data['page'] = $params['page'] ? $params['page'] : 1;
                    $page_data['lang'] = $lang;
                    $page_data['user_types'] = $ci->Properties_model->getProperty('user_type');
                    $page_data['looking_user_type'] = $ci->Properties_model->getProperty('looking_user_type');
                    $page_data['rules'] = $ci->Users_fields_validation_model->getRules(array_keys($ci->Users_fields_validation_model->fields));
                    $page_data['min_date'] = UsersModel::getDefaultDateByYear($ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min'));
                    $page_data['user'] = ($ci->session->userdata('auth_type') == 'user') ?
                        $ci->Users_model->getUserById($ci->session->userdata('user_id'), true) : [];
                    $page_data['age'] = [
                        'min' => $ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min'),
                        'max' => $ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_max')
                    ];
                    if ($ci->session->userdata('auth_type') == 'user') {
                        $use_email_confirmation = (bool)$ci->pg_module->get_module_config('users', 'user_confirm');
                        if ($use_email_confirmation) {
                            $page_data['links'] = [
                                'like_me' => rewrite_link('users', 'confirm'),
                                'skip' => rewrite_link('users', 'confirm')
                            ];
                        } else {
                            $page_data['links'] = [
                                'like_me' => $ci->pg_module->is_module_installed('like_me') ? rewrite_link('like_me', 'index', 'play_global/1') : rewrite_link('users', 'search'),
                                'skip' => rewrite_link('users', 'search')
                            ];
                        }
                    }
                }
            }

            $ci->view->assign('data', $page_data);

            return $ci->view->fetch('helper_users_registration', 'user', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('registrationThirdPage')) {

        /**
         * Registration third page
         *
         * @param array $params
         *
         * @return string
         */
        function registrationThirdPage(array $params)
        {
            $ci = &get_instance();
            $ci->view->assign('data', $params['data']);
            $ci->view->assign('user_data', $params['user_data']);
            if ($ci->pg_module->is_module_installed('couples')) {
                $ci->load->helper('couples');

                return \Pg\modules\couples\helpers\registrationThirdPage();
            }

            return $ci->view->fetch('registration/third_page', 'user', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('menuSettings')) {

        /**
         * Menu settings
         *
         * @return string
         */
        function menuSettings($params)
        {
            $ci = &get_instance();
            $alert = [];
            $data = [];
            foreach (UsersModel::$fields_settings as $field) {
                $data[$field] = l('field_menu_settings_' . $field, UsersModel::MODULE_GID);
            }
            if ($ci->pg_module->is_module_installed('user_information')) {
                $ci->load->model('User_information_model');
                $archive = $ci->User_information_model->status((int)$params['user']['id']);
                $alert['download_my_data'] = !empty($archive['status']) ? $archive['status'] == 'ready' ? 1 : 0 : 0;
                $data['download_my_data'] = l('field_download_my_data', 'user_information');
            }
            if ($ci->pg_module->is_module_installed('services')) {
                $ci->load->model('Services_model');
                if ($ci->Services_model->isServiceActive('ability_delete') === 1) {
                    $data['delete_account'] = l('field_menu_settings_delete_account', UsersModel::MODULE_GID);
                }
            }
            $ci->view->assign('menu_settings', $data);
            $ci->view->assign('menu_settings_alert', $alert);

            return $ci->view->fetch('menu_settings', 'user', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('servicesButton')) {

        /**
         * Services Button
         *
         * @return string
         */
        function servicesButton($params)
        {
            $ci = &get_instance();
            $data = ['is_long' => false, 'count_services' => 0];
            if ($ci->pg_module->is_module_installed('access_permissions')) {
                $ci->load->model('access_permissions/models/Access_permissions_groups_model');
                $data['is_long'] = (bool)$ci->Access_permissions_groups_model->getCountActivePaidGroups();
            }
            $data['count_services'] = 0;
            foreach (['highlight_in_search', 'up_in_search', 'hide_on_site'] as $service) {
                if (!empty($params['data']['services_status'][$service]) && $params['data']['services_status'][$service]['status'] == 1) {
                    $data['current_service'] = $params['data']['services_status'][$service]['service'];
                    $data['count_services']++;
                }
            }
            if ($data['is_long'] === false && $data['count_services'] === 0) {
                return false;
            }
            $ci->view->assign('services_data', $data);

            return $ci->view->fetch('helper_services_button', 'user', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('userName')) {

        /**
         * Return format user name
         *
         * @param array $params
         *
         * @return mixed
         */
        function userName($params)
        {
            $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('couples')) {
                if ($params['user']['user_type'] === 'couple') {
                    $ci->load->helper('couples');

                    return \Pg\modules\couples\helpers\userName($params);
                }
            }
            $ci->view->assign('data_name', $params);

            return $ci->view->fetch('helper_user_name', 'user', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('isTerms')) {

        /**
         * User consent with Terms and conditions
         *
         * @return mixed
         */
        function isTerms()
        {
            $ci = &get_instance();
            if ($ci->session->userdata("auth_type") == "user" && $ci->session->userdata("is_terms") == 0) {
                $contact_us_url = $ci->pg_module->is_module_installed('tickets') ? 'tickets' : 'contact_us';

                $ci->view->assign('data_terms', l('text_i_agree', 'users', '', '', [
                    'delete' => site_url('users/settings/delete_account'),
                    'privacy' => site_url('content/view/privacy-and-security'),
                    'contact_us' => site_url($contact_us_url)
                ]));

                return $ci->view->fetch('helper_is_terms', 'user', 'users');
            }

            return false;
        }
    }

    if (!function_exists('actionsSettings')) {

        /**
         * Actions user settings
         *
         * @return mixed
         */
        function actionsSettings($params = [])
        {
            $ci = &get_instance();
            $data = ['is_access_permissions' => false, 'is_highlight_in_search' => false, 'up_in_search' => false, 'hide_on_site' => false];
            if ($ci->pg_module->is_module_installed('access_permissions')) {
                $ci->load->model('access_permissions/models/Access_permissions_groups_model');
                $data['is_access_permissions'] = (bool)$ci->Access_permissions_groups_model->getCountActivePaidGroups();
            }
            $user_id = $ci->session->userdata('user_id');
            $ci->load->model('Users_model');
            $user = $ci->Users_model->getUserById($user_id, true);
            $services_status = $ci->Users_model->servicesStatus($user);
            foreach (['highlight_in_search', 'up_in_search', 'hide_on_site'] as $service) {
                if (!empty($services_status[$service]) && $services_status[$service]['status'] == 1) {
                    $data['is_' . $service] = true;
                    $data[$service] = $services_status[$service];
                }
            }

            $ci->view->assign('services_data', $data);

            $params['template'] = (isset($params['template']) && !empty($params['template'])) ?
                $params['template'] : 'helper_actions_settings';

            return $ci->view->fetch($params['template'], 'user', 'users');
        }
    }

    if (!function_exists('flippingProfiles')) {

        /**
         * Flipping Profiles
         *
         * @param array $params
         *
         * @return mixed
         */
        function flippingProfiles($params)
        {
            $ci = &get_instance();
            if ($ci->session->userdata("auth_type") == "user" && !empty($params['navigation'])) {
                if ($params['profile_id'] == $ci->session->userdata('user_id')) {
                    return false;
                }
                $is_like_me = false;
                if ($ci->pg_module->is_module_installed('like_me')) {
                    $ci->load->model('Like_me_model');
                    $is_like_me = $ci->Like_me_model->isAccess();
                }
                $module = $is_like_me ? 'like_me' : 'users';
                $ci->view->assign('profile_id', $params['profile_id']);
                $ci->view->assign('flipping_navigation', $params['navigation']);

                return $ci->view->fetch('helper_flipping_profiles', 'user', $module);
            }

            return false;
        }
    }

    if (!function_exists('onlineNow')) {

        /**
         * User online now
         *
         * @return mixed
         */
        function onlineNow()
        {
            $ci = &get_instance();
            $ci->load->model('Users_model');
            $all = $ci->Users_model->getUsersCount();
            $online = $ci->Users_model->getUsersCount(['where' => ['online_status' => 1]]);
            $online_counter = [
                l('status_online_0', 'users') => $all - $online,
                l('status_online_1', 'users') => $online
            ];
            $ci->view->assign('online_now', $online);
            $ci->view->assign('online_counter', $online_counter);

            return $ci->view->fetch('helper_online_now', 'admin', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('usersCounter')) {
        function usersCounter()
        {
            $ci = &get_instance();
            $user_types = $ci->pg_language->ds->get_reference(
                'properties',
                'user_type_plural',
                $ci->pg_language->current_lang_id
            );
            $users = new UsersModel();
            $counter = [];
            foreach ($user_types['option'] as $user_type => $name) {
                $counter[$name] = $users->getUsersCount(['where' => [
                    'user_type' => $user_type
                ]]);
            }
            $ci->view->assign('counter', $counter);

            return $ci->view->fetch('helper_counter_users_widget', 'admin', UsersModel::MODULE_GID);
        }
    }

    if (!function_exists('usersFieldsExample')) {
        function usersFieldsExample($params)
        {
            $ci = &get_instance();
            $return = '...';
            $ci->load->model('users/models/UsersFieldsModel');
            $fields_data = $ci->UsersFieldsModel->getFieldData($params['field']);
            if (!empty($fields_data['data']['option'][$params['field']])) {
                $options = $fields_data['data']['option'][$params['field']];
                $count_options = count($options);
                if ($count_options < 5) {
                    $return = $options[1];
                } elseif ($count_options >= 5 && $count_options <= 9) {
                    $return = "{$options[1]}, {$options[2]}";
                } elseif ($count_options > 9) {
                    $return = "{$options[1]}, {$options[2]}, {$options[3]}";
                }
            }

            return $return;
        }
    }

}

namespace {

    if (!function_exists('login_form')) {
        function login_form()
        {
            return Pg\modules\users\helpers\loginForm();
        }
    }

    if (!function_exists('users_lang_select')) {
        function users_lang_select($attrs = [])
        {
            return Pg\modules\users\helpers\usersLangSelect($attrs);
        }
    }

    if (!function_exists('top_menu')) {
        function top_menu($params = [])
        {
            return Pg\modules\users\helpers\topMenu($params);
        }
    }

    if (!function_exists('auth_links')) {
        function auth_links(array $params = [])
        {
            return Pg\modules\users\helpers\authLinks($params);
        }
    }

    if (!function_exists('last_registered')) {
        function last_registered($params)
        {
            return Pg\modules\users\helpers\lastRegistered($params);
        }
    }

    if (!function_exists('user_select')) {
        function user_select($selected = [], $max_select = 0, $var_name = 'id_user')
        {
            return Pg\modules\users\helpers\userSelect($selected, $max_select, $var_name);
        }
    }

    if (!function_exists('incorrect_email')) {
        function incorrect_email()
        {
            return Pg\modules\users\helpers\incorrectEmail();
        }
    }

    if (!function_exists('admin_home_users_block')) {
        function admin_home_users_block()
        {
            return Pg\modules\users\helpers\AdminHomeUsersBlock();
        }
    }

    if (!function_exists('users_search_form')) {
        function users_search_form($object = 'user', $type = 'line', $show_data = false, $params = [])
        {
            return Pg\modules\users\helpers\usersSearchForm($object, $type, $show_data, $params);
        }
    }

    if (!function_exists('user_input')) {
        function user_input($params)
        {
            return Pg\modules\users\helpers\userInput($params);
        }
    }

    if (!function_exists('users_carousel')) {
        function users_carousel($params)
        {
            return Pg\modules\users\helpers\usersCarousel($params);
        }
    }

    if (!function_exists('featured_users')) {
        function featured_users($is_default = true)
        {
            return Pg\modules\users\helpers\featuredUsers($is_default);
        }
    }

    if (!function_exists('featured_users_default')) {
        function featured_users_default()
        {
            return Pg\modules\users\helpers\featuredUsersDefault();
        }
    }

    if (!function_exists('active_users_block')) {
        function active_users_block($params)
        {
            return Pg\modules\users\helpers\ActiveUsersBlock($params);
        }
    }

    if (!function_exists('delete_select_block')) {
        function delete_select_block($params)
        {
            return Pg\modules\users\helpers\deleteSelectBlock($params);
        }
    }

    if (!function_exists('visitors')) {
        function visitors($attrs)
        {
            return Pg\modules\users\helpers\visitors($attrs);
        }
    }

    if (!function_exists('re_format_users')) {
        function re_format_users($attrs)
        {
            return Pg\modules\users\helpers\reFormatUsers($attrs);
        }
    }

    if (!function_exists('quickSearch')) {
        function quickSearch()
        {
            return Pg\modules\users\helpers\quickSearch();
        }
    }

    if (!function_exists('shortInformation')) {
        function shortInformation()
        {
            return Pg\modules\users\helpers\shortInformation();
        }
    }

    if (!function_exists('get_logout_link')) {
        function get_logout_link()
        {
            return Pg\modules\users\helpers\getLogoutLink();
        }
    }

    if (!function_exists('get_preview')) {
        function get_preview($params = [])
        {
            return Pg\modules\users\helpers\getPreview($params);
        }
    }

    if (!function_exists('availableActivation')) {
        function availableActivation()
        {
            return Pg\modules\users\helpers\availableActivation();
        }
    }

    if (!function_exists('formatAvatar')) {
        function formatAvatar(array $params)
        {
            return Pg\modules\users\helpers\formatAvatar($params);
        }
    }

    if (!function_exists('onUserAccount')) {
        function onUserAccount($params = [])
        {
            return Pg\modules\users\helpers\onUserAccount($params);
        }
    }

    if (!function_exists('isTerms')) {
        function isTerms()
        {
            return Pg\modules\users\helpers\isTerms();
        }
    }

    if (!function_exists('onlineNow')) {
        function onlineNow()
        {
            return Pg\modules\users\helpers\onlineNow();
        }
    }

    if (!function_exists('actionsSettings')) {
        function actionsSettings($params = [])
        {
            return Pg\modules\users\helpers\actionsSettings($params);
        }
    }

    if (!function_exists('flippingProfiles')) {
        function flippingProfiles()
        {
            return Pg\modules\users\helpers\flippingProfiles();
        }
    }

    if (!function_exists('usersRegistration')) {
        function usersRegistration($params)
        {
            return Pg\modules\users\helpers\usersRegistration($params);
        }
    }

    if (!function_exists('usersCounter')) {
        function usersCounter()
        {
            return Pg\modules\users\helpers\usersCounter();
        }
    }

    if (!function_exists('usersFieldsExample')) {
        function usersFieldsExample($params)
        {
            return Pg\modules\users\helpers\usersFieldsExample($params);
        }
    }
}
