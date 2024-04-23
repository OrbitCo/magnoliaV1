<?php

declare(strict_types=1);

namespace Pg\modules\users\helpers {

    use Pg\modules\users\models\UsersModel;

    if (!function_exists('usersRegistrationCustom')) {

        /**
         * Users registration
         *
         * @param array $params
         *
         * @return void
         */
        function usersRegistrationCustom(array $params)
        {
            $ci = &get_instance();
            $ci->load->model(['Properties_model', 'users/models/Users_fields_validation_model']);
            $page_data = [
                'reglang' => isset($params['lang']) ? $params['lang'] : l('link_register', UsersModel::MODULE_GID),
                'is_link' => !empty($params['is_link']) ? 1 : 0,
                'is_registration' => !empty($params['is_registration']) ? 1 : 0,
                'is_load_form' => $ci->Users_model->is_load_form
            ];
            if ($ci->Users_model->is_load_form === false) {
                $ci->Users_model->is_load_form = true;
                $page_data['form_action'] = site_url('users/stepByStepRegistration');
                $page_data['is_auth'] = ($ci->session->userdata('auth_type') == 'user') ? true : 0;
                $page_data['page'] = $params['page'] ? $params['page'] : 1;
                $page_data['lang'] = $ci->pg_language->get_lang_by_id($ci->pg_language->current_lang_id);
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
                    $use_email_confirmation = (bool) $ci->pg_module->get_module_config('users', 'user_confirm');
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
            /* <custom_R> */
            registrationFormFieldsCustom(['data' => $page_data['user']]);
            /* </custom_R> */
            $ci->view->assign('data', $page_data);
            return $ci->view->fetch('custom/helper_users_registration', 'user', UsersModel::MODULE_GID);
        }
    }

    /* <custom_R> */
    if (!function_exists('registrationFormFieldsCustom')) {

        /**
         * Registration form fields
         *
         * @param array $params
         *
         * @return void
         */
        function registrationFormFieldsCustom($params)
        {
            $ci = &get_instance();
            $ci->load->model(['Field_editor_model', 'Users_model']);
            $ci->Field_editor_model->initialize(UsersModel::MODULE_GID);
            $ci->load->model('field_editor/models/Field_editor_forms_model');
            $ci->load->model('users/models/UsersExtendedRegistrationModel');
            $form = $ci->Field_editor_forms_model->getFormByGid($ci->UsersExtendedRegistrationModel->registration_form_gid, UsersModel::MODULE_GID);
            $form = $ci->Field_editor_forms_model->formatOutputForm($form, $params['data']);
            $data = [];
            if (!empty($form['field_data'])) {
                foreach ($form['field_data'] as $key => $field_data) {
                    if (empty($field_data['section']['fields']) && empty($field_data['field'])) {
                        unset($form['field_data'][$key]);
                    } else {
                        $data[$field_data['field_content']['gid']] = $field_data['field_content'];
                    }
                }
                $ci->view->assign('fields_data', $data);
            }
        }
    }
    /* </custom_R> */

    if (!function_exists('registrationThirdPageCustom')) {

        /**
         * Registration third page
         *
         * @param array $params
         *
         * @return string
         */
        function registrationThirdPageCustom(array $params)
        {
            $ci = &get_instance();
            $ci->view->assign('data', $params['data']);
            $ci->view->assign('user_data', $params['user_data']);
            if ($ci->pg_module->is_module_installed('couples')) {
                $ci->load->helper('couples');
                return \Pg\modules\couples\helpers\registrationThirdPage();
            }
            return $ci->view->fetch('custom/registration/third_page', 'user', UsersModel::MODULE_GID);
        }
    }

    /* <custom_R> */
    if (!function_exists('indexUsersBlock')) {
        function indexUsersBlock(array $params = []): string
        {
            $ci = &get_instance();

            $selected_users = unserialize($ci->pg_module->get_module_config('users', 'index_users') ?: '');
            if (empty($selected_users)) {
                return '';
            }

            $max_users = 6;

            $ci->load->model('users/models/UsersModel');
            $users = $ci->UsersModel->getUsersListByKey(null, null, null, [
                'where' => [
                    'approved'  => 1,
                    'confirm'   => 1,
                ],
            ], $selected_users, false);

            if (count($users) > $max_users) {
                $users = array_slice($users, 0, $max_users);
            }

            $params['users'] = $ci->UsersModel->formatUsers($users);
            $ci->view->assign('h_data', $params);

            return $ci->view->fetch('custom/helper_index_users', 'user', 'users');
        }
    }
    /* </custom_R> */
}

namespace {

    if (!function_exists('users_registration')) {
        function users_registration($params)
        {
            return Pg\modules\users\helpers\usersRegistrationCustom($params);
        }
    }

    if (!function_exists('usersRegistration')) {
        function usersRegistration($params)
        {
            return Pg\modules\users\helpers\usersRegistrationCustom($params);
        }
    }

    if (!function_exists('registrationThirdPage')) {
        function registrationThirdPage($params)
        {
            return Pg\modules\users\helpers\registrationThirdPageCustom($params);
        }
    }

    if (!function_exists('registration_third_page')) {
        function registration_third_page($params)
        {
            return Pg\modules\users\helpers\registrationThirdPageCustom($params);
        }
    }

}
