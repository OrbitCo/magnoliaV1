<?php

declare(strict_types=1);

namespace Pg\modules\payments\helpers {

    use Pg\Libraries\Analytics;

    if (!function_exists('sendPaymentApi')) {
        function sendPaymentApi($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data = [])
        {
            $ci = &get_instance();
            $ci->load->model('Payments_model');

            $ci->load->library('Analytics');
            $ci->analytics->track('dp_user_payments_purchase_attempt', [
                'category' => 'Payment',
                'label' => $system_gid,
                'value' => $amount,
            ]);

            $for_validate = [
                'payment_type_gid' => $payment_type_gid,
                'id_user' => $id_user,
                'amount' => $amount,
                'currency_gid' => $currency_gid,
                'system_gid' => $system_gid,
                'payment_data' => $payment_data,
            ];
            $pre_validate = $ci->Payments_model->validate_payment(null, $for_validate);
            if (!empty($pre_validate['errors'])) {
                $return['errors'] = $pre_validate['errors'];

                $ci->analytics->track('dp_user_payment_purchase_fail', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);

                return $return;
            }

            $ci->load->model('payments/models/Payment_systems_model');
            $validate_by_system = $ci->Payment_systems_model->actionValidate($system_gid, $payment_data);
            if (!empty($validate_by_system['errors'])) {
                $ci->analytics->track('dp_user_payment_purchase_fail', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
                return $validate_by_system;
            }
            $for_validate['payment_data'] = $validate_by_system['data'];

            $post_validate = $ci->Payments_model->validate_payment(null, $for_validate);
            if (!empty($post_validate['errors'])) {
                $return['errors'] = $post_validate['errors'];

                $ci->analytics->track('dp_user_payment_purchase_fail', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
            } else {
                $payment_data = $post_validate['data'];
                $payment_id = $ci->Payments_model->add_payment($payment_data);
                $payment = $ci->Payments_model->get_payment_by_id($payment_id);
                $payment['id_payment'] = $payment['id'];
                $return = $ci->Payment_systems_model->action_request($payment['system_gid'], $payment);

                $ci->analytics->track('dp_user_payment_purchase_success', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
            }

            return $return;
        }
    }

    if (!function_exists('sendPayment')) {
        function sendPayment($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data = [], $check_html_action = false)
        {
            $return = ['errors' => [], 'info' => []];
            $operation_type = ($payment_type_gid == 'account') ? 'add' : 'spend';
            $is_event_dashboard = ($payment_data['lang'] === 'added_by_admin') ? 0 : 1;
            $ci = &get_instance();
            $ci->load->model('Payments_model');

            $ci->load->library('Analytics');
            $ci->analytics->track('dp_user_payments_purchase_attempt', [
                'category' => 'Payment',
                'label' => $system_gid,
                'value' => $amount,
            ]);

            $for_validate = [
                'payment_type_gid' => $payment_type_gid,
                'id_user' => $id_user,
                'amount' => $amount,
                'currency_gid' => $currency_gid,
                'system_gid' => $system_gid,
                'payment_data' => $payment_data,
            ];

            $validate_data = $ci->Payments_model->validatePayment(null, $for_validate);

            if (!empty($validate_data['errors'])) {
                $return['errors'] = $validate_data['errors'];
                $ci->analytics->track('dp_user_payment_purchase_fail', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
                return $return;
            }

            $ci->load->model('payments/models/Payment_systems_model');

            if ($check_html_action == 'form') {
                $post_data = [
                    'payment_type_gid' => $validate_data['data']['payment_type_gid'],
                    'id_user' => $validate_data['data']['id_user'],
                    'amount' => $validate_data['data']['amount'],
                    'currency_gid' => $validate_data['data']['currency_gid'],
                    'system_gid' => $validate_data['data']['system_gid'],
                    'payment_data' => $payment_data,
                ];

                if ($ci->Payment_systems_model->actionHtml($system_gid)) {
                    post_location_request(site_url().'payments/form', $post_data);

                    return;
                }
                if ($ci->Payment_systems_model->actionJs($system_gid)) {
                    $validate_data['data']['operation_type'] = $operation_type;
                    $payment_id = $ci->Payments_model->addPayment($validate_data['data'], $is_event_dashboard);
                    redirect(site_url().'payments/js/'.$payment_id.'/1', 'hard');

                    return;
                }
            }

            if ($check_html_action == 'validate' && $ci->Payment_systems_model->actionHtml($system_gid)) {
                $validate = $ci->Payment_systems_model->actionValidate($system_gid, $payment_data);
                if (!empty($validate['errors'])) {
                    $ci->analytics->track('dp_user_payment_purchase_fail', [
                        'category' => 'Payment',
                        'label' => $system_gid,
                        'value' => $amount,
                    ]);
                    return $validate;
                }
                $payment_data = $validate['data'];
            }

            $validate_data = $ci->Payments_model->validatePayment(null, [
                'payment_type_gid' => $payment_type_gid,
                'id_user' => $id_user,
                'amount' => $amount,
                'currency_gid' => $currency_gid,
                'system_gid' => $system_gid,
                'payment_data' => $payment_data,
            ]);

            if (!empty($validate_data['errors'])) {
                $return['errors'] = $validate_data['errors'];

                $ci->analytics->track('dp_user_payment_purchase_fail', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
            } else {
                $payment = $validate_data['data'];
                $payment['operation_type'] = $operation_type;

                $payment_id = $ci->Payments_model->addPayment($payment, $is_event_dashboard);
                $payment = $ci->Payments_model->getPaymentById($payment_id);
                $payment['id_payment'] = $payment['id'];

                $return = $ci->Payment_systems_model->actionRequest($payment['system_gid'], $payment);

                $ci->analytics->track('dp_user_payment_purchase_success', [
                    'category' => 'Payment',
                    'label' => $system_gid,
                    'value' => $amount,
                ]);
            }

            return $return;
        }
    }

    if (!function_exists('receivePayment')) {
        function receivePayment($system_gid, $request_data)
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_systems_model');

            $payment_data = $ci->Payment_systems_model->actionResponce($system_gid, $request_data);

            $data = $payment_data['data'];
            $ci->load->model('Payments_model');
            $ci->Payments_model->changePaymentStatus($data['id_payment'], $data['status']);

            $event_status = $data['status'] ? 'success' : 'fail';
            $ci->load->library('Analytics');
            $ci->analytics->track('dp_user_payment_purchase_' . $event_status, [
                'category' => 'Payment ' . $event_status,
                'action' => $data['payment_data']['name'],
                'label' => $data['payment_data']['offline_line_2']??''.'('.$data['amount'].' '.$data['currency_gid'].')',
                'value' => $data['amount'],
            ]);

            return $payment_data;
        }
    }

    if (!function_exists('postLocationRequest')) {
        function postLocationRequest($url, $data)
        {
            $ci = &get_instance();
            $params = explode('&', urldecode(http_build_query($data)));
            $retHTML = '';
            if (!$ci->is_pjax) {
                $retHTML .= "<html>\n<body onLoad=\"document.send_form.submit();\">\n";
            }
            $retHTML .= '<form method="post" name="send_form" id="send_form"  action="'.$url.'">';
            foreach ($params as $string) {
                list($key, $value) = explode('=', $string);
                $retHTML .= '<input type="hidden" name="'.$key.'" value="'.addslashes($value)."\">\n";
            }
            if ($ci->is_pjax) {
                $retHTML .= '</form><script>'
                    .' var form = document.getElementById("send_form");'
                    .' var defaults = {
                                type: form.method.toUpperCase(),
                                url: form.action,
                                data: $(form).serializeArray(),
                                container: \'#pjaxcontainer\',
                                target: form
                            };'
                    .'$.pjax($.extend({}, defaults));'
                    .'</script>';
            } else {
                $retHTML .= "</form>\n</body>\n</html>";
            }
            echo $retHTML;
            exit();
        }
    }

    if (!function_exists('adminHomePaymentsBlock')) {
        function adminHomePaymentsBlock()
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata('auth_type');
            if ($auth_type != 'admin') {
                return '';
            }

            $user_type = $ci->session->userdata('user_type');

            $show = true;
            if ($user_type == 'moderator') {
                $show = false;
                $ci->load->model('Moderators_model');
                $methods = $ci->Moderators_model->get_module_methods('payments');
                $permission_data = $ci->session->userdata('permission_data');
                if (isset($permission_data['payments']['paymentsList']) && $permission_data['payments']['paymentsList'] == 1) {
                    $show = true;
                }
            }

            if (!$show) {
                return '';
            }

            $ci->load->model('Payments_model');
            $stat_payments = [
                'all' => $ci->Payments_model->get_payment_count(),
                'wait' => $ci->Payments_model->get_payment_count(['where' => ['status' => 0]]),
                'approve' => $ci->Payments_model->get_payment_count(['where' => ['status' => 1]]),
                'decline' => $ci->Payments_model->get_payment_count(['where' => ['status' => -1]]),
            ];

            $ci->load->model('payments/models/Payment_currency_model');
            $ci->view->assign('currency', $ci->Payment_currency_model->default_currency);

            $ci->view->assign('stat_payments', $stat_payments);

            return $ci->view->fetch('helper_admin_home_block', 'admin', 'payments');
        }
    }

    if (!function_exists('currencyFormat')) {

        /**
         * Returns formatted currency string.
         *
         * @param int    $params['cur_id']   currency id
         * @param string $params['cur_gid']  currency gid
         * @param int    $params['value']    amount
         * @param string $params['template'] [abbr][value|dec_part:2|dec_sep:.|gr_sep: ])
         * @param bool   $params['no_tags']
         *
         * @return string
         */
        function currencyFormat($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_currency_model');
            $pattern_value = '/\[value\|([^]]*)\]/';

            $default_cur = $ci->Payment_currency_model->getCurrencyDefault();
            // $default_cur = $ci->Payment_currency_model->getCurrencyByGid('USD');

            //  сейчас зациклено , что база всегда USD = 1 , убрать если переделывать на пересчет валюты в зависимости от изменяемой базы по курсу.
            // $default_cur['id'] = 1;
            // Make sure value is numeric
            if (!empty($params['value']) && is_string($params['value'])) {
                $params['value'] *= 1;
            }

            // Get specified or default currency
            if (!empty($params['cur_gid'])) {
                if ($params['cur_gid'] != $default_cur['gid']) {
                    $cur = $ci->Payment_currency_model->get_currency_by_gid($params['cur_gid']);
                    if ($cur['per_base'] && (float) $default_cur['per_base'] && empty($params['use_gid'])) {
                        if (!empty($params['value'])) {
                            $params['value'] *= $cur['per_base'] / $default_cur['per_base'];
                        }
                    } else {
                        $default_cur = $cur;
                    }
                }
            } elseif (!empty($params['cur_id'])) {
                if ($params['cur_id'] != $default_cur['id']) {
                    $cur = $ci->Payment_currency_model->get_currency_by_id($params['cur_id']);
                    if ($cur['per_base'] && $default_cur['per_base']) {
                        if (!empty($params['value'])) {
                            $params['value'] *= $cur['per_base'] / $default_cur['per_base'];
                        }
                    } else {
                        $default_cur = $cur;
                    }
                }
            }

            if (!empty($params['template'])) {
                $template = $params['template'];
            } else {
                $template = $default_cur['template'];
            }

            if (isset($params['value'])) {
                $matches = [];
                // Parse the number format
                preg_match($pattern_value, $template, $matches);
                $value_params = explode('|', $matches[1]);
                foreach ($value_params as $param) {
                    $param_arr = explode(':', $param);
                    $number_arr[$param_arr[0]] = $param_arr[1];
                }
                // Format number

                if ('-' == $number_arr['dec_part'] || '–' == $number_arr['dec_part']) {
                    $value = number_format($params['value'], 0, $number_arr['dec_sep'], $number_arr['gr_sep']);
                    $value .= $number_arr['dec_sep'].'–';
                } else {
                    if (!is_double($params['value'])) {
                        $params['value'] = (float) $params['value'].'.00';
                    }
                    $value = number_format((float) $params['value'], (int) $number_arr['dec_part'], $number_arr['dec_sep'], $number_arr['gr_sep']);
                }
            } else {
                $value = '';
            }

            if (!empty($params['disable_abbr'])) {
                $default_cur['abbr'] = '';
                $params['abbr'] = '';
                $default_cur['gid'] = '';
            }

            $str = preg_replace([$pattern_value, '/(\[abbr\])/', '/(\[gid\])/', '/\s/'],
                [$value, $default_cur['abbr'], $default_cur['gid'], ' '],
                $template);

            if (empty($params['no_tags']) || false == $params['no_tags']) {
                return '<span dir="ltr">'.$str.'</span>';
            }

            return $str;
        }
    }

    if (!function_exists('userPaymentsHistory')) {
        function userPaymentsHistory($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_currency_model');
            if ($ci->session->userdata('auth_type') != 'user') {
                return false;
            }
            $page = !empty($params['page']) ? $params['page'] : 1;
            $base_url = !empty($params['base_url']) ? $params['base_url'] : '';
            $back_link = (isset($params['back_link']) && !empty($params['back_link'])) ? $params['back_link'] : '';
            $back_link_text = (isset($params['back_link_text']) && !empty($params['back_link_text'])) ? $params['back_link_text'] : '';
            $user_id = $ci->session->userdata('user_id');
            $ci->load->model('Payments_model');
            $params['where']['id_user'] = $user_id;
            $payments_count = $ci->Payments_model->get_payment_count($params);

            $items_on_page = $ci->pg_module->get_module_config('payments', 'items_per_page');
            $ci->load->helper('sort_order');
            $page = get_exists_page_number($page, $payments_count, $items_on_page);

            $payments = $ci->Payments_model->get_payment_list($page, $items_on_page, ['date_add' => 'DESC'], $params);
            $ci->view->assign('payments_helper_payments', $payments);

            $ci->load->helper('navigation');
            $page_data = get_user_pages_data($base_url, $payments_count, $items_on_page, $page, 'briefPage');
            $page_data['date_format'] = $ci->pg_date->get_format('date_time_literal', 'st');
            $ci->view->assign('page_data', $page_data);
            $ci->view->assign('back_link', $back_link);
            $ci->view->assign('back_link_text', $back_link_text);

            return $ci->view->fetch('helper_statistic', 'user', 'payments');
        }
    }

    if (!function_exists('currency')) {

        /**
         * Returns formatted currency string.
         *
         * @param int    $params['cur_id']   currency id
         * @param string $params['cur_gid']  currency gid
         * @param int    $params['value']    amount
         * @param string $params['template'] [abbr][value|dec_part:2|dec_sep:.|gr_sep: ])
         *
         * @return string
         */
        function currency($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_currency_model');
            $pattern_value = '/\[value\|([^]]*)\]/';

            $default_cur = $ci->Payment_currency_model->default_currency;

            // Get specified or default currency
            if (!empty($params['cur_gid'])) {
                if ($params['cur_gid'] != $default_cur['gid']) {
                    $cur = $ci->Payment_currency_model->get_currency_by_gid($params['cur_gid']);
                    if ($cur['per_base'] && (float) $default_cur['per_base'] && empty($params['use_gid'])) {
                        if (isset($params['value']) && !empty($params['value'])) {
                            $params['value'] *= $cur['per_base'] / $default_cur['per_base'];
                        }
                    } else {
                        $default_cur = $cur;
                    }
                }
            } elseif (!empty($params['cur_id'])) {
                if ($params['cur_id'] != $default_cur['id']) {
                    $cur = $ci->Payment_currency_model->get_currency_by_id($params['cur_id']);
                    if ($cur['per_base'] && $default_cur['per_base']) {
                        if (isset($params['value']) && !empty($params['value'])) {
                            $params['value'] *= $cur['per_base'] / $default_cur['per_base'];
                        }
                    } else {
                        $default_cur = $cur;
                    }
                }
            }

            if (!empty($params['template'])) {
                $template = $params['template'];
            } else {
                $template = $default_cur['template'];
            }

            if (!empty($params['disable_abbr'])) {
                $default_cur['abbr'] = '';
                $default_cur['gid'] = '';
            }

            if (empty($params['value'])) {
                $params['value'] = '';
            }

            $str = preg_replace([$pattern_value, '/(\[abbr\])/', '/(\[gid\])/', '/\s/'],
                [$params['value'], $default_cur['abbr'], $default_cur['gid'], ' '],
                $template
            );

            return '<span dir="ltr">'.$str.'</span>';
        }
    }

    if (!function_exists('currencyFormatRegexp')) {

        /**
         * Returns formatted currency regexp string.
         *
         * @return string
         */
        function currencyFormatRegexp($params = [])
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_currency_model');
            $pattern_value = '/\[value\|([^]]*)\]/';
            $value = '';

            $default_cur = $ci->Payment_currency_model->default_currency;

            if (!empty($params['template'])) {
                $template = $params['template'];
            } else {
                $template = $default_cur['template'];
            }

            $matches = [];
            // Parse the number format
            preg_match($pattern_value, $template, $matches);
            $value_params = explode('|', $matches[1]);
            foreach ($value_params as $param) {
                $param_arr = explode(':', $param);
                $number_arr[$param_arr[0]] = $param_arr[1];
            }
            $ci->view->assign('pattern_value', $pattern_value);

            // Format number
            if ('-' == $number_arr['dec_part'] || '–' == $number_arr['dec_part']) {
                $value = 'number_format(value, 0, \''.$number_arr['dec_sep'].'\', \''.$number_arr['gr_sep'].'\') + \''.$number_arr['dec_sep'].'–\'';
            } else {
                $value = 'number_format(value, '.((int) $number_arr['dec_part']).', \''.$number_arr['dec_sep'].'\', \''.$number_arr['gr_sep'].'\')';
            }
            $ci->view->assign('value', $value);

            $template = preg_replace(['/(\[abbr\])/', '/(\[gid\])/', '/\s/'],
                [$default_cur['abbr'], $default_cur['gid'], ' '],
                $template);
            $ci->view->assign('template', $template);

            return $ci->view->fetch('helper_currency_regexp', 'user', 'payments');
        }
    }

    if (!function_exists('siteCurrencySelect')) {
        /**
         * Returns currency selector.
         *
         * @return string
         */
        function siteCurrencySelect()
        {
            $ci = &get_instance();
            $ci->load->model('payments/models/Payment_currency_model');
            $currencies = $ci->Payment_currency_model->get_currency_list();
            $ci->view->assign('currencies', $currencies);

            return $ci->view->fetch('helper_currency_select', 'user', 'payments');
        }
    }

    if (!function_exists('cardForm')) {
        /**
         * Card form.
         *
         * @return string
         */
        function cardForm()
        {
            $ci = &get_instance();
            return $ci->view->fetch('helper_card_form', 'user', 'payments');
        }
    }

}

namespace {

    if (!function_exists('send_payment_api')) {
        function send_payment_api($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data = [])
        {
            return Pg\modules\payments\helpers\sendPaymentApi($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data);
        }
    }

    if (!function_exists('send_payment')) {
        function send_payment($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data = [], $check_html_action = false)
        {
            return Pg\modules\payments\helpers\sendPayment($payment_type_gid, $id_user, $amount, $currency_gid, $system_gid, $payment_data, $check_html_action);
        }
    }

    if (!function_exists('receive_payment')) {
        function receive_payment($system_gid, $request_data)
        {
            return Pg\modules\payments\helpers\receivePayment($system_gid, $request_data);
        }
    }

    if (!function_exists('post_location_request')) {
        function post_location_request($url, $data)
        {
            return Pg\modules\payments\helpers\postLocationRequest($url, $data);
        }
    }

    if (!function_exists('admin_home_payments_block')) {
        function admin_home_payments_block()
        {
            return Pg\modules\payments\helpers\adminHomePaymentsBlock();
        }
    }

    if (!function_exists('currency_format')) {
        function currency_format($params = [])
        {
            return Pg\modules\payments\helpers\currencyFormat($params);
        }
    }

    if (!function_exists('user_payments_history')) {
        function user_payments_history($params = [])
        {
            return Pg\modules\payments\helpers\userPaymentsHistory($params);
        }
    }

    if (!function_exists('currency_format_regexp')) {
        function currency_format_regexp($params = [])
        {
            return Pg\modules\payments\helpers\currencyFormatRegexp($params);
        }
    }

    if (!function_exists('site_currency_select')) {
        function site_currency_select()
        {
            return Pg\modules\payments\helpers\siteCurrencySelect();
        }
    }

    if (!function_exists('currency')) {
        function currency($params)
        {
            return Pg\modules\payments\helpers\currency($params);
        }
    }

    if (!function_exists('cardForm')) {
        function cardForm()
        {
            return Pg\modules\payments\helpers\cardForm();
        }
    }

}
