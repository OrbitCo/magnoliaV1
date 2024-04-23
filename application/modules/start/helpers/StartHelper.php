<?php

declare(strict_types=1);

namespace Pg\modules\start\helpers {

    use Pg\modules\start\models\StartModel;

    if (!function_exists('productVersion')) {
        function productVersion()
        {
            if (INSTALL_MODULE_DONE) {
                $ci = &get_instance();

                if ($ci->pg_module->is_module_installed('start')) {
                    $current_version_code = $ci->pg_module->get_module_config('start', 'product_version_code');
                    $current_version_name = $ci->pg_module->get_module_config('start', 'product_version_name');
                    $cache_new_version_code = $ci->pg_module->get_module_config('start', 'product_version_code_update');
                    $cache_new_version_name = $ci->pg_module->get_module_config('start', 'product_version_name_update');
                    $is_new_update = $ci->pg_module->get_module_config('start', 'is_new_update');

                    $last_update = $ci->pg_module->get_module_config('start', 'product_version_last_update');
                    if (
                        (!$cache_new_version_code || $cache_new_version_code == $current_version_code) &&
                        (!$last_update || (time() - strtotime($last_update) > 24 * 60 * 60))
                    ) {
                        try {
                            $new_version = get_new_version();
                            $cache_new_version_code = intval($new_version['code']);
                            $cache_new_version_name = $new_version['name'];
                            $ci->pg_module->set_module_config('start', 'product_version_last_update', date('Y-m-d H:i:s'));
                        } catch (Exception $e) {
                        }
                    }

                    if ($cache_new_version_code && $current_version_code < $cache_new_version_code) {
                        $formatted_new_version = str_replace('_', '.', $cache_new_version_name);
                        $formatted_new_version = str_replace('[version]', $formatted_new_version, l('system_version_available', 'start'));
                    }

                    $update_data = [
                        'package' => PACKAGE_NAME,
                        'current_version_code' => $current_version_code,
                        'current_version_name' => $current_version_name,
                        'new_version_code' => $cache_new_version_code,
                        'new_version_name' => $cache_new_version_name,
                        'is_new_update' => $is_new_update,
                        'formatted_new_version' => $formatted_new_version ?? ''
                    ];

                    $ci->view->assign('update_data', $update_data);

                    return $ci->view->fetch("helper_product_version", 'admin', 'start');
                }
            } else {
                return "Dating Pro : Installation";
            }
        }
    }

    if (!function_exists('getNewVersion')) {
        function getNewVersion()
        {
            $feed_url = 'https://www.pilotgroup.net/feeder/datingpro/version.php';

            $ci = &get_instance();
            $ci->load->library('Snoopy');
            $ci->snoopy->read_timeout = 5;
            $ci->snoopy->rawheaders["Accept"] = "application/json";
            $ci->snoopy->fetch($feed_url);
            if ($ci->snoopy->status == '200') {
                $new_version = (array)json_decode($ci->snoopy->results);
                $ci->pg_module->set_module_config('start', 'product_version_code_update', $new_version['code']);
                $ci->pg_module->set_module_config('start', 'product_version_name_update', $new_version['name']);

                return $new_version;
            }
        }
    }

    if (!function_exists('mainSearchForm')) {
        function mainSearchForm($object = 'user', $type = 'line', $show_data = false, $params = [])
        {
            $ci = &get_instance();

            // если пользователь незалогинен  то отображаем  вкладки и кнопки
            $auth_type = $ci->session->userdata('auth_type');

            if ('user' === $object && $ci->pg_module->is_module_installed('users')) {
                $ci->load->helper('users');
                $form_block = users_search_form($object, $type, $show_data, $params);
            }

            if ($form_block) {
                $page_data = [
                    'form_id' => $object . '_' . $type,
                    'show_tabs' => false,
                    'show_resume_button' => false,
                    'show_vacancy_button' => false,
                    'object' => $object,
                    'type' => $type,
                    'hide_popup' => !empty($params['hide_popup']),
                    'popup_autoposition' => !empty($params['popup_autoposition']),
                    'view' => $params['view'] ?? '',
                    'load_users' => $params['load_users'] ?? 'users/ajaxLoadUsers/',
                    'form_url' => $params['form_url'] ?? 'users/search/',
                    'search_url' => $params['search_url'] ?? 'users/ajax_search/',
                    'count_url' => $params['count_url'] ?? 'users/ajax_search_counts/'
                ];
                if ($auth_type !== 'user' && $type != 'line') {
                    $ci->load->helper('seo');
                }
                $ci->view->assign('form_settings', $page_data);
                $ci->view->assign('form_block', $form_block);
            }

            return $ci->view->fetch("helper_search_form", 'user', 'start');
        }
    }

    if (!function_exists('selectbox')) {
        function selectbox($params)
        {
            $ci = &get_instance();
            if (empty($params['class'])) {
                $params['class'] = '';
            }
            foreach ($params as $key => $value) {
                $ci->view->assign("sb_" . $key, $value);
            }

            return $ci->view->fetch("helper_selectbox", 'user', 'start');
        }
    }

    if (!function_exists('radio')) {
        function radio($params)
        {
            $ci = &get_instance();
            if (empty($params['class'])) {
                $params['class'] = '';
            }
            if ($params['default'] === true) {
                $params['default_value'] = l('option_no_select', 'users');
            }
            foreach ($params as $key => $value) {
                $ci->view->assign("sb_" . $key, $value);
            }

            return $ci->view->fetch("helper_radio", 'user', 'start');
        }
    }

    if (!function_exists('hlbox')) {
        function hlbox($params)
        {
            $ci = &get_instance();
            foreach ($params as $key => $value) {
                $ci->view->assign("hlb_" . $key, $value);
            }

            return $ci->view->fetch("helper_hlbox", 'user', 'start');
        }
    }

    if (!function_exists('checkbox')) {
        function checkbox($params)
        {
            $ci = &get_instance();

            $cb_count = (!empty($params['value'])) ? count($params['value']) : 0;
            $ci->view->assign("cb_count", $cb_count);

            $params['display_group_methods'] = false;
            if (isset($params['value'])) {
                $values = [];
                $selected = (!empty($params['selected'])) ? $params['selected'] : [];
                if (!is_array($selected)) {
                    $selected = [$selected];
                }

                if (is_array($params['value'])) {
                    foreach ($params['value'] as $key => $value) {
                        $values[$key] = ['name' => $value, 'checked' => (in_array($key, $selected)) ? 1 : 0];
                    }
                } else {
                    $values[1] = ['name' => '', 'checked' => $params['value']];
                }

                if (count($values) > 1 && !empty($params['group_methods'])) {
                    $params['display_group_methods'] = true;
                }

                $params['value'] = $values;
            }

            unset($params['selected']);

            foreach ($params as $key => $value) {
                $ci->view->assign("cb_" . $key, $value);
            }

            return $ci->view->fetch("helper_checkbox", 'user', 'start');
        }
    }

    if (!function_exists('slider')) {
        function slider($params)
        {
            $ci = &get_instance();

            $slider['id'] = isset($params['id']) ? $params['id'] : 'slider' . substr(md5(microtime()), 0, 5);
            usleep(2);
            $slider['single'] = isset($params['single']) ? intval($params['single']) : 0;
            $slider['active_always'] = isset($params['active_always']) ? intval($params['active_always']) : 0;
            $slider['min'] = !is_null($params['min']) ? floatval($params['min']) : 0;
            $slider['max'] = !is_null($params['max']) ? floatval($params['max']) : 1000;
            $slider['value'] = isset($params['value']) ? floatval($params['value']) : floor(($slider['max'] - $slider['min']) / 2);
            $slider['value_min'] = isset($params['value_min']) ? floatval($params['value_min']) : $slider['min'];
            $slider['value_max'] = isset($params['value_max']) ? floatval($params['value_max']) : $slider['max'];
            $slider['use'] = (!empty($params['value_min']) || !empty($params['value_max']));
            if ($slider['value'] < $slider['min']) {
                $slider['value'] = $slider['min'];
            }
            if ($slider['value'] > $slider['max']) {
                $slider['value'] = $slider['max'];
            }
            if ($slider['value_min'] < $slider['min']) {
                $slider['value_min'] = $slider['min'];
            }
            if ($slider['value_max'] > $slider['max']) {
                $slider['value_max'] = $slider['max'];
            }
            $slider['field_name'] = isset($params['field_name']) ? $params['field_name'] : 'slider_field';
            $slider['field_name_min'] = isset($params['field_name_min']) ? $params['field_name_min'] : 'slider_field_min';
            $slider['field_name_max'] = isset($params['field_name_max']) ? $params['field_name_max'] : 'slider_field_max';

            $ci->view->assign('slider_data', $slider);

            return $ci->view->fetch('helper_slider', 'user', 'start');
        }
    }

    if (!function_exists('pagination')) {
        function pagination($params)
        {
            $ci = &get_instance();
            foreach ($params as $key => $value) {
                $ci->view->assign("page_" . $key, $value);
            }

            return $ci->view->fetch("helper_pagination", 'user', 'start');
        }
    }

    if (!function_exists('sorter')) {
        function sorter($params)
        {
            $ci = &get_instance();
            if (empty($params["module"])) {
                $params["module"] = "start";
            }

            $params["rand"] = rand(0, 9999);
            foreach ($params as $key => $value) {
                $ci->view->assign("sort_" . $key, $value);
            }

            return $ci->view->fetch("helper_sorter", 'user', 'start');
        }
    }

    if (!function_exists('availableBrowsers')) {
        function availableBrowsers()
        {
            $ci = &get_instance();
            $html = $ci->view->fetch("available_browsers", 'user');
            echo $html;
        }
    }

    if (!function_exists('currencyFormatOutput')) {

        /**
         * Returns formatted currency string
         * Or unformatted if payments is not installed
         *
         * @param int    $params['cur_id']                                                         currency id
         * @param string $params['cur_gid']                                                        currency gid
         * @param int    $params['value']                                                          amount
         * @param string $params['template']&nbsp;[abbr][value|dec_part:2|dec_sep:.|gr_sep:&nbsp;]
         * @param bool   $params['no_tags']
         *
         * @return string
         */
        function currencyFormatOutput($params = [])
        {
            $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('payments')) {
                $ci->load->helper('payments');

                return \Pg\modules\payments\helpers\currencyFormat($params);
            } elseif (empty($params['no_tags'])) {
                return '<span dir="ltr">' . number_format((float)$params['value'], 2) . '&nbsp;USD</span>';
            }

            return number_format((float)$params['value'], 2) . '&nbsp;USD';
        }
    }

    if (!function_exists('langInlineEditor')) {
        function langInlineEditor($params)
        {
            $ci = &get_instance();
            $ci->view->assign('multiple', (!empty($params['multiple']) ? 1 : 0));
            if (isset($params['textarea']) && $params['textarea']) {
                $ci->view->assign('textarea', true);
            }
            $ci->view->assign('rand', rand(100000, 999999));

            return $ci->view->fetch("helper_lang_inline_editor_js", null, 'start');
        }
    }

    if (!function_exists('currencyOutput')) {

        /**
         * Returns unformatted currency string
         * Or unformatted if payments is not installed
         *
         * @param int    $params['cur_id']                                                         currency id
         * @param string $params['cur_gid']                                                        currency gid
         * @param int    $params['value']                                                          amount
         * @param string $params['template']&nbsp;[abbr][value|dec_part:2|dec_sep:.|gr_sep:&nbsp;]
         *
         * @return string
         */
        function currencyOutput($params = [])
        {
            $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('payments')) {
                $ci->load->helper('payments');

                return currency($params);
            }

            return '<span dir="ltr">' . $params['value'] . '&nbsp;USD</span>';
        }
    }

    if (!function_exists('currencyFormatRegexpOutput')) {

        /**
         * Returns formatted currency string
         * Or unformatted if payments is not installed
         *
         * @param int    $params['cur_id']                                                         currency id
         * @param string $params['cur_gid']                                                        currency gid
         * @param int    $params['value']                                                          amount
         * @param string $params['template']&nbsp;[abbr][value|dec_part:2|dec_sep:.|gr_sep:&nbsp;]
         *
         * @return string
         */
        function currencyFormatRegexpOutput($params = [])
        {
            $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('payments')) {
                $ci->load->helper('payments');

                return currency_format_regexp($params);
            }

            return 'function(value){return value+\' USD\'}';
        }
    }

    if (!function_exists('multiselect')) {
        function multiselect($params)
        {
            $ci = &get_instance();
            $rand = rand(100000, 999999);

            $filtered_params = filter_var_array($params, [
                'fields' => ['flags' => FILTER_REQUIRE_ARRAY],
                'selected' => ['flags' => FILTER_REQUIRE_ARRAY],
                'limits' => ['flags' => FILTER_REQUIRE_ARRAY],
                'all_text' => FILTER_SANITIZE_STRING,
                'all_value' => FILTER_SANITIZE_STRING,
                'min' => FILTER_VALIDATE_INT,
                'max' => FILTER_VALIDATE_INT,
            ]);
            if (!isset($filtered_params['all_text'])) {
                $filtered_params['all_text'] = l('multiselect_all_text', 'start');
            }
            if (!isset($filtered_params['all_value'])) {
                $filtered_params['all_value'] = 'all';
            }
            $selected = [];
            $fields = array_keys($filtered_params['fields']);
            $all_selected = [];
            $selected_values = [];
            foreach (array_filter($filtered_params['selected']) as $field => $values) {
                if (!in_array($field, $fields)) {
                    continue;
                }
                foreach ((array) $values as $value) {
                    $selected_values[$field][$value] = $value;
                    if ($filtered_params['all_value'] === $value) {
                        $selected[$field][$value] = $filtered_params['all_text'];
                        $all_selected[$field] = true;

                        break;
                    } elseif (!empty($filtered_params['fields'][$field]['option'][$value])) {
                        $selected[$field][$value] = $filtered_params['fields'][$field]['option'][$value];
                    }
                }
            }
            $has_selected = array_keys($selected ?: $filtered_params['fields']);
            $helper_data = array_merge($filtered_params, [
                'rand' => $rand,
                'selected' => $selected,
                'selected_keys' => $selected_values,
                'active_field' => array_shift($has_selected),
                'all_selected' => $all_selected,
            ]);
            $ci->view->assign('multiselect_helper_data', $helper_data);

            return $ci->view->fetch('helper_multiselect', null, 'start');
        }
    }

    if (!function_exists('ad')) {
        function ad()
        {
            if (PACKAGE_NAME == 'free') {
                $ci = &get_instance();
                $langs = $ci->pg_language->languages;
                $lang_id = $ci->pg_language->current_lang_id;
                $ci->view->assign('lang_code', $langs[$lang_id]['code']);

                return $ci->view->fetch('helper_admin_banner', null, 'start');
            }
        }
    }

    if (!function_exists('widgets')) {
        function widgets($side = 'left')
        {
            $ci = &get_instance();

            return $ci->view->fetch('left_panel', 'user', 'start');
        }
    }

    if (!function_exists('donate')) {
        function donate($action)
        {
            $ci = &get_instance();
            if ($ci->pg_module->is_module_installed('send_money')) {
                $send_money = true;
            } else {
                $send_money = false;
            }
            if ($ci->pg_module->is_module_installed('send_vip')) {
                $send_vip = true;
            } else {
                $send_vip = false;
            }
            if ($send_money || $send_vip) {
                $html = '<a data-pjax-no-scroll="1" href="' .
                    seolink('users', 'account', 'donate') . '"';

                if ($action == 'donate') {
                    $html .= ' class="active"';
                }
                $html .= ">" . l('donate', 'start') . '</a>';

                return $html;
            }

            return '&nbsp;';
        }
    }

    if (!function_exists('donateViewBlock')) {
        function donateViewBlock($view_type = 'general')
        {
            $ci = &get_instance();
            $ci->view->assign('user_id', $ci->session->userdata('user_id'));
            $ci->load->model('payments/models/Payment_currency_model');
            $ci->view->assign('currency', $ci->Payment_currency_model->get_currency_default(true));
            $send_money = false;
            $send_vip = false;
            if ($ci->pg_module->is_module_installed('send_money')) {
                $ci->load->helper('send_money');
                $transactions = $money_transactions = \Pg\modules\send_money\helpers\sendMoneyViewBlock();
                $send_money = true;
            }
            if ($ci->pg_module->is_module_installed('send_vip')) {
                $ci->load->helper('send_vip');
                $transactions = $vip_transactions = \Pg\modules\send_vip\helpers\sendVipViewBlock();
                $send_vip = true;
            }
            if ($send_money && $send_vip) {
                if (!empty($money_transactions) && !empty($vip_transactions)) {
                    $transactions = array_merge($money_transactions, $vip_transactions);
                    foreach ($transactions as $value) {
                        $date[] = $value['date_created'];
                    }
                    if (!empty($date)) {
                        array_multisort($date, SORT_DESC, $transactions);
                    }
                } elseif (!isset($vip_transactions) || empty($vip_transactions)) {
                    $transactions = $money_transactions;
                } elseif (!isset($money_transactions) || empty($money_transactions)) {
                    $transactions = $vip_transactions;
                }
                if (!empty($transactions)) {
                    foreach ($transactions as $key => $value) {
                        switch ($value['declined_by_sender']) {
                            case '1': {
                                if ($ci->session->userdata('user_id') == $value['id_sender']) {
                                    $transactions[$key]['declined_by_me'] = 1;
                                } else {
                                    $transactions[$key]['declined_by_me'] = 0;
                                }

                                break;
                            }
                            default: {
                                if ($ci->session->userdata('user_id') == $value['id_sender']) {
                                    $transactions[$key]['declined_by_me'] = 0;
                                } else {
                                    $transactions[$key]['declined_by_me'] = 1;
                                }

                                break;
                            }
                        }
                    }
                }
            }
            if ($send_money || $send_vip) {
                $page_data['date_format'] = $ci->pg_date->get_format('date_literal', 'st');
                $page_data['date_time_format'] = $ci->pg_date->get_format('date_time_literal', 'st');

                $ci->view->assign('transactions', $transactions);
                $ci->view->assign('rand', mt_rand(1, 999999));
                $ci->view->assign('send_money', $send_money);
                $ci->view->assign('send_vip', $send_vip);
                $ci->view->assign('page_data', $page_data);
                $ci->view->assign('view_type', $view_type);

                return $ci->view->fetch('helper_donate_view_block', 'user', 'start');
            }

            return '&nbsp;';
        }
    }

    if (!function_exists('getErrorPage')) {
        function getErrorPage()
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            $ci->Menu_model->breadcrumbs_set_active(l('header_error', 'start'));
            $ci->view->assign('user_session_data', $ci->session->userdata);

            return $ci->view->fetch('error', 'user', 'start');
        }
    }

    if (!function_exists('getCalendarInput')) {
        function getCalendarInput($name, $value, array $attrs = [])
        {
            $ci = &get_instance();
            $locale = [
                'months' => $ci->pg_language->ds->get_reference('start', 'month_full', $ci->pg_language->current_lang['id'])['option'],
                'days' => $ci->pg_language->ds->get_reference('start', 'week_day_short', $ci->pg_language->current_lang['id'])['option'],
            ];
            ksort($locale['months']);
            $ci->view->assign('locale', $locale);
            $ci->view->assign('name', $name);
            $ci->view->assign('value', $value);
            $ci->view->assign('attrs', $attrs);

            return $ci->view->fetch('helper_calendar_input', null, 'start');
        }
    }

    if (!function_exists('intercom')) {
        function intercom()
        {
            if (!INSTALL_DONE) {
                return;
            }

            $ci = &get_instance();
            $ci->load->model('start/models/Intercom_model');

            if (!$ci->Intercom_model->is_used) {
                return false;
            }

            $ci->view->assign('app_id', $ci->Intercom_model->app_id);
            $ci->view->assign('user_id', $ci->Intercom_model->user_id);
            $ci->view->assign('user_email', $ci->Intercom_model->user_email);
            $ci->view->assign('user_name', $ci->Intercom_model->user_name);
            $ci->view->assign('custom_domain', SITE_SERVER);

            return $ci->view->fetch('helper_intercom', null, 'start');
        }
    }

    if (!function_exists('moduleInstructions')) {
        function moduleInstructions($params = [])
        {
            $ci = &get_instance();
            $display_instructions = include MODULEPATH . 'start/install/' . PRODUCT_NAME . '/all/display_instructions.php';
            $module = $ci->router->class;
            $method = $ci->router->method;
            $is_open = false;

            if ($is_open !== false) {
                return moduleGuide(['module' => $module]);
            }
            $uri_string = $ci->router->is_admin_class ? '/admin/' . $module . '/' . $method . '/' : '';

            if ($uri_string) {
                if (isset($display_instructions[$module])) {
                    if (
                        $display_instructions[$module]['display_on_all'] ||
                        in_array($uri_string, $display_instructions[$module]['pages'])
                    ) {
                        $method = $display_instructions[$module]['display_on_all'] ? 'index' : $method;
                        $instruction_text = l('admin_' . $module . '_' . $method . '_instruction_text', 'admin_instructions_page');
                        if (!$instruction_text && !empty($ci->uri->segments[4])) {
                            $instruction_text = l('admin_' . $module . '_' . $method . '_' . $ci->uri->segments[4] . '_instruction_text', 'admin_instructions_page');
                        }
                        if (!$instruction_text) {
                            $instruction_text = l('admin_' . $module . '_index_instruction_text', 'admin_instructions_page');
                        }
                        if ($instruction_text) {
                            $ci->view->assign('is_open', $is_open);
                            $ci->view->assign('instruction_text', htmlspecialchars($instruction_text));

                            return $ci->view->fetch('helper_module_instructions', null, 'start');
                        }
                    }
                }
            }

        }
    }

    if (!function_exists('analytics')) {
        function analytics()
        {
            $profiles = 'ANALYTICS_PROFILES';

            if (empty(getenv($profiles)) || INSTALL_DONE === false) {
                return false;
            }

            $ci = &get_instance();
            $ci->load->library('Analytics');
            $ci->view->assign('analytics', $ci->analytics->getApiKeys());
            $ci->view->assign('analytics_user_id', $ci->analytics->identify_id);
            $ci->view->assign('analytics_profiles', json_encode(explode(',', getenv($profiles))));

            return $ci->view->fetch('helper_analytics', null, 'start');
        }
    }

    if (!function_exists('setAnalytics')) {
        function setAnalytics($category, $gid)
        {
            $ci = &get_instance();
            $ci->load->library('Analytics');

            return "sendAnalytics('" . $ci->analytics->getEvent($category, $gid) . "', '{$category}', '{$gid}');";
        }
    }

    if (!function_exists('isAllowed')) {
        function isAllowed($params = [])
        {
            $route = explode('/', $params['guide'][$_SESSION['guide_' . $params['mode']]['step']]['page']);

            if (!empty($route)) {
                $ci = &get_instance();
                $allowed = $ci->acl->check(new \Pg\Libraries\Acl\Action\ViewPage(
                    new \Pg\Libraries\Acl\Resource\Page(
                        ['module' => $route[0], 'controller' => $route[0], 'action' => $route[1]]
                    )
                ), false);
                if ($allowed !== true) {
                    $_SESSION['guide_' . $params['mode']]['step'] = $_SESSION['guide_' . $params['mode']]['step'] + 1;
                    guide($route[0]);
                } else {
                    return true;
                }
            }

            return true;
        }
    }

    if (!function_exists('moduleGuide')) {
        function moduleGuide($params = [])
        {
            $ci = &get_instance();
            if (!empty($params['module'])) {
                $controller = $ci->router->fetch_class(true);
                $mode = (strtolower(substr($controller, 0, 6)) == "admin_") ? 'admin' : 'user';
                if (empty($_SESSION[$params['module'] . '_guide_' . $mode])) {
                    $_SESSION[$params['module'] . '_guide_' . $mode] = ['autoshow' => true];
                }
                if (empty($_SESSION[$params['module'] . '_guide_' . $mode]['step']) || !$_SESSION[$params['module'] . '_guide_' . $mode]['autoshow']) {
                    $_SESSION[$params['module'] . '_guide_' . $mode]['step'] = 1;
                }
                $filepath = MODULEPATH . $params['module'] . '/install/dating/all/module_instructions_' . $ci->pg_language->current_lang['code'] . '.php';
                if (!file_exists($filepath)) {
                    $filepath = MODULEPATH . $params['module'] . '/install/dating/all/module_instructions_en.php';
                }
                $guide = include $filepath;
                $ci->view->assign('module_autoshow', $_SESSION[$params['module'] . '_guide_' . $mode]['autoshow']);
                $ci->view->assign('module_step', (int) $_SESSION[$params['module'] . '_guide_' . $mode]['step']);
                $ci->view->assign('module_guide', json_encode($guide[$mode]));
                $ci->view->assign('module', $params['module']);

                return $ci->view->fetch('helper_module_guide', null, 'start');
            }
        }
    }

    if (!function_exists('captcha')) {

        /**
         * CAPTCHA
         *
         * @param array $params
         *
         * @return void
         */
        function captcha($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('start/models/Start_captcha_model');
            $captcha = $ci->Start_captcha_model->formatCaptcha(
                $ci->Start_captcha_model->getCaptcha()
            );
            $captcha['input_name'] = $params['input_name'] ?: 'captcha_confirmation';
            $ci->view->assign('captcha', $captcha);

            return $ci->view->fetch('helper_captcha', null, 'start');
        }
    }

    if (!function_exists('notificationsList')) {

        /**
         *  Block notifications list
         *
         * @return string
         */
        function notificationsList()
        {
            $ci = &get_instance();
            $ci->load->model('start/models/Start_desktop_notifications_model');
            $notifications = $ci->Start_desktop_notifications_model->getNotificationsList();
            $ci->view->assign('notifications_list', $notifications);

            return $ci->view->fetch('helper_notifications_list_settings', 'user', StartModel::MODULE_GID);
        }
    }
    if (!function_exists('upgradePackage')) {

        /**
         * Module package
         *
         *  @param array $params
         *
         * @return string
         */
        function upgradePackage($params)
        {
            if (INSTALL_DONE === false) {
                return false;
            }
            $ci = &get_instance();
            $data = \Pg\modules\start\models\StartDemoModel::getUpgradePackageData($params);
            if ($data !== false) {
                $ci->view->assign('upgrade_packages_data', $data);

                return $ci->view->fetch('helper_upgrade_package', 'admin', StartModel::MODULE_GID);
            }

            return false;
        }
    }

    if (!function_exists('getCopyright')) {

        /**
         * @param string $place
         *
         * @return string
         */
        function getCopyright(string $place)
        {
            if (!INSTALL_DONE) {
                return false;
            }

            $ci = &get_instance();

            $ci->load->model("start/models/Start_copyright_model");
            $copyrights = $ci->Start_copyright_model->getCopyrightByLang((int)$ci->pg_language->current_lang_id);
            foreach ($copyrights as $gid => $copyright) {
                if ($place === $gid) {
                    return $copyright;
                }
            }

            return false;
        }
    }

    if (!function_exists('favicon')) {
        function favicon($params)
        {
            $ci = &get_instance();

            switch ($params['type']) {
                case 'admin':
                    break;
                case 'user':
                    break;
            }

            return $ci->view->fetch('helper_favicon', null, 'start');
        }
    }

    if (!function_exists('logo')) {
        function logo($params)
        {
            $ci = &get_instance();
            $data_logo = [];
            if (empty($params['settings']['text_logo'])) {
                switch ($params['type']) {
                    case 'admin':
                        $data_logo['logo_settings'] = $params['settings'];
                        $data_logo['mini_logo_settings'] = $params['settings_mini'];

                        break;
                    case 'user':
                        $data_logo['path'] = $params['settings']['path'];
                        $data_logo['width'] = $params['settings']['width'];
                        $data_logo['height'] = $params['settings']['height'];

                        break;
                }
            } else {
                $data_logo['text_logo'] = $params['settings']['text_logo'];
            }

            $ci->view->assign('data_logo', $data_logo);

            return $ci->view->fetch('helper_logo', null, 'start');
        }
    }
}

namespace {

    if (!function_exists('product_version')) {
        function product_version()
        {
            return Pg\modules\start\helpers\productVersion();
        }
    }

    if (!function_exists('get_new_version')) {
        function get_new_version()
        {
            return Pg\modules\start\helpers\getNewVersion();
        }
    }

    if (!function_exists('main_search_form')) {
        function main_search_form($object = 'user', $type = 'line', $show_data = false, $params = [])
        {
            return Pg\modules\start\helpers\mainSearchForm($object, $type, $show_data, $params);
        }
    }

    if (!function_exists('selectbox')) {
        function selectbox($params)
        {
            return Pg\modules\start\helpers\selectbox($params);
        }
    }

    if (!function_exists('hlbox')) {
        function hlbox($params)
        {
            return Pg\modules\start\helpers\hlbox($params);
        }
    }

    if (!function_exists('checkbox')) {
        function checkbox($params)
        {
            return Pg\modules\start\helpers\checkbox($params);
        }
    }

    if (!function_exists('slider')) {
        function slider($params)
        {
            return Pg\modules\start\helpers\slider($params);
        }
    }

    if (!function_exists('pagination')) {
        function pagination($params)
        {
            return Pg\modules\start\helpers\pagination($params);
        }
    }

    if (!function_exists('sorter')) {
        function sorter($params)
        {
            return Pg\modules\start\helpers\sorter($params);
        }
    }

    if (!function_exists('available_browsers')) {
        function available_browsers()
        {
            return Pg\modules\start\helpers\availableBrowsers();
        }
    }

    if (!function_exists('currency_format_output')) {
        function currency_format_output($params = [])
        {
            return Pg\modules\start\helpers\currencyFormatOutput($params);
        }
    }

    if (!function_exists('lang_inline_editor')) {
        function lang_inline_editor($params)
        {
            return Pg\modules\start\helpers\langInlineEditor($params);
        }
    }

    if (!function_exists('currency_output')) {
        function currency_output($params = [])
        {
            return Pg\modules\start\helpers\currencyOutput($params);
        }
    }

    if (!function_exists('currency_format_regexp_output')) {
        function currency_format_regexp_output($params = [])
        {
            return Pg\modules\start\helpers\currencyFormatRegexpOutput($params);
        }
    }

    if (!function_exists('multiselect')) {
        function multiselect($params)
        {
            return Pg\modules\start\helpers\multiselect($params);
        }
    }

    if (!function_exists('ad')) {
        function ad()
        {
            return Pg\modules\start\helpers\ad();
        }
    }

    if (!function_exists('widgets')) {
        function widgets($side = 'left')
        {
            return Pg\modules\start\helpers\widgets($side);
        }
    }

    if (!function_exists('donate')) {
        function donate($action)
        {
            return Pg\modules\start\helpers\donate($action);
        }
    }

    if (!function_exists('donate_view_block')) {
        function donate_view_block($view_type = 'general')
        {
            return Pg\modules\start\helpers\donateViewBlock($view_type);
        }
    }

    if (!function_exists('getErrorPage')) {
        function getErrorPage()
        {
            return Pg\modules\start\helpers\getErrorPage();
        }
    }

    if (!function_exists('getCalendarInput')) {
        function getCalendarInput($name, $value, array $attrs = [])
        {
            return Pg\modules\start\helpers\getCalendarInput($name, $value, $attrs);
        }
    }

    if (!function_exists('moduleInstructions')) {
        function moduleInstructions($params = [])
        {
            return Pg\modules\start\helpers\moduleInstructions($params);
        }
    }

    if (!function_exists('analytics')) {
        function analytics()
        {
            return Pg\modules\start\helpers\analytics();
        }
    }

    if (!function_exists('setAnalytics')) {
        function setAnalytics($category, $gid)
        {
            return Pg\modules\start\helpers\setAnalytics($category, $gid);
        }
    }

    if (!function_exists('get_copyright')) {
        function get_copyright($gid)
        {
            return Pg\modules\start\helpers\getCopyright($gid);
        }
    }
    if (!function_exists('favicon')) {
        function favicon($params)
        {
            return Pg\modules\start\helpers\favicon($params);
        }
    }
    if (!function_exists('logo')) {
        function logo()
        {
            return Pg\modules\start\helpers\logo();
        }
    }
}
