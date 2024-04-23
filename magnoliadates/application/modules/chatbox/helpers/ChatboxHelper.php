<?php

declare(strict_types=1);

/**
 * Messaging Center module
 * Helper
 *
 * @package     PG_Dating
 * @subpackage  Chatbox
 * @category    helpers
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 * @author      Renat Gabdrakhmanov <renatgab@pilotgroup.eu>
 */

namespace Pg\modules\chatbox\helpers {

    if (!function_exists('newMessagesChatbox')) {
        function newMessagesChatbox($attrs)
        {
            $ci = &get_instance();
            if ('user' != $ci->session->userdata("auth_type")) {
                return false;
            }
            $user_id = $ci->session->userdata("user_id");
            if (!$user_id) {
                log_message('Empty user id');

                return false;
            }
            if (empty($attrs['template'])) {
                $attrs['template'] = 'header';
            }
            $ci->load->model('Chatbox_model');
            $filters = [
                'user_id'   => $user_id,
                'is_read'   => 0,
                'dir'       => 'i',
            ];
            $messages_count = $ci->Chatbox_model->getCount($filters);
            $messages = $ci->Chatbox_model->getList($filters, 1, $ci->Chatbox_model->messages_max_count_header, ['date_added' => 'DESC']);
            $ci->Chatbox_model->setFormatSettings('get_contact', true);
            $messages = $ci->Chatbox_model->formatArray($messages);
            $ci->Chatbox_model->setFormatSettings('get_contact', false);

            $ci->view->assign('messages', $messages);
            $ci->view->assign('messages_count', $messages_count);
            $ci->view->assign('messages_max_count', $ci->Chatbox_model->messages_max_count_header);

            return $ci->view->fetch('helper_new_messages_' . $attrs['template'], 'user', 'chatbox');
        }
    }

    if (!function_exists('miniChatbox')) {
        function miniChatbox($params = [])
        {
            $ci = &get_instance();
            if ('user' != $ci->session->userdata("auth_type")) {
                return false;
            }
            $user_id = $ci->session->userdata("user_id");
            if (!$user_id) {
                log_message('Empty user id');

                return false;
            }


            $ci->load->model([
                    'Chatbox_model',
                    'chatbox/models/Chatbox_contact_list_model'
                ]);
            $contact_list = $ci->Chatbox_contact_list_model->getList(
                ['user_id' => $user_id],
                1,
                $ci->Chatbox_contact_list_model->items_per_page,
                ['date_update' => 'DESC']
            );

            $is_notification_contact = false;

            if ($contact_id == $user_id) {
                $is_notification_contact = true;
            }

            $im_list = [];

            if ($ci->pg_module->is_module_installed('im')) {
                $ci->load->model(['im/models/Im_contact_list_model', 'im/models/Im_messages_model']);
                $im_list = $ci->Im_contact_list_model->getContactList($user_id);
            }

            $contact_list = $ci->Chatbox_contact_list_model->formatArray($contact_list);

            $contact_list_dump = $ci->Chatbox_contact_list_model->mergeDataContacts($contact_list, $im_list, $user_id, false);

            foreach ($contact_list_dump as $key => $value) {
                if (isset($value['contact']['is_deleted'])) {
                    if ($value['contact']['is_deleted']) {
                        unset($contact_list_dump[$key]);
                    }
                }
            }

            $ci->view->assign('contact_list', $contact_list_dump);
            $ci->view->assign('is_notification_contact', $is_notification_contact);
            $ci->view->assign('user_id', $user_id);
            $ci->view->assign('l_time', strtotime(date('Y-m-d H:i:s')));
            $ci->view->assign('contact_id', $contact_id);

            return $ci->view->fetch('helper_chatbox', 'user', 'chatbox');
        }
    }


    if (!function_exists('sendMessageChatbox')) {
        function sendMessageChatbox($params)
        {
            $ci = &get_instance();

            if (!isset($params['id_user'])) {
                return '';
            }

            if ($ci->session->userdata('auth_type') == 'user') {
                $user_id = $ci->session->userdata('user_id');
                if ($params['id_user'] == $user_id) {
                    return '';
                }
            }

            $ci->view->assign('user_id', $params['id_user']);
            $ci->view->assign('message_button_rand', rand(100000, 999999));

            if (empty($params['view_type'])) {
                $params['view_type'] = 'button';
            }
            $ci->view->assign('class', (isset($params['class']) && !empty($params['class'])) ? $params['class'] : '');
            $ci->view->assign('text_type', (isset($params['text_type']) && !empty($params['text_type'])) ? $params['text_type'] : 'send');

            if (isset($params['new_tab'])) {
                $ci->view->assign('new_tab', $params['new_tab']);
            }

            switch ($params['view_type']) {
                case 'link':
                    return $ci->view->fetch('helper_message_link', 'user', 'chatbox');
                    break;

                case 'icon':
                    return $ci->view->fetch('helper_message_icon', 'user', 'chatbox');
                    break;

                case 'button':
                default:
                    $type = (!empty($params['type'])) ? trim(strip_tags($params['type'])) . '_' : '';

                    return $ci->view->fetch('helper_' . $type . 'message_button', 'user', 'chatbox');
                    break;
            }
        }
    }

    if (!function_exists('chatboxCounter')) {
        function chatboxCounter()
        {
            $ci = &get_instance();

            $counter_model = new \Pg\modules\chatbox\models\ChatboxCounterModel();

            $counter = [
                'day' => $counter_model->getCountDays(1),
                '48h' => $counter_model->getCountHours(48),
                'week' => $counter_model->getCountWeeks(1),
                'month' => $counter_model->getCountMonths(1),
            ];

            $ci->view->assign('counter', $counter);

            return $ci->view->fetch('helper_counter_widget', 'admin', 'chatbox');
        }
    }
}

namespace {

    if (!function_exists('new_messages_chatbox')) {
        function new_messages_chatbox($attrs)
        {
            return Pg\modules\chatbox\helpers\newMessagesChatbox($attrs);
        }
    }

    if (!function_exists('mini_chatbox')) {
        function mini_chatbox($attrs = [])
        {
            return Pg\modules\chatbox\helpers\miniChatbox($attrs);
        }
    }

    if (!function_exists('send_message_chatbox')) {
        function send_message_chatbox($params)
        {
            return Pg\modules\chatbox\helpers\sendMessageChatbox($params);
        }
    }

    if (!function_exists('chatboxCounter')) {
        function chatboxCounter()
        {
            return Pg\modules\chatbox\helpers\chatboxCounter();
        }
    }
}
