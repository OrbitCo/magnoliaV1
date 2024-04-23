<?php

declare(strict_types=1);

namespace Pg\modules\im\helpers {

    if (!function_exists('imChatButton')) {
        function imChatButton()
        {
            $ci = &get_instance();
            $ci->load->model('Im_model');

            $controller = $ci->router->fetch_class(true);
            if ($controller == 'chatbox') {
                return false;
            }
            $im_status = $ci->Im_model->imStatus();
            if (!$im_status['im_on']) {
                return false;
            }
            $data = [
                'id_user' => 0,
                'user_name' => '',
                'statuses' => [],
                'age_lang' => l('age', 'im'),
                'history_lang' => l('show_history', 'im'),
                'clear_confirm_lang' => l('clear_confirm', 'im'),
                'new_msgs' => [
                    'count_new' => 0,
                    'contacts' => []
                 ],
                'user_status' => [
                    'current_site_status'      => '',
                    'current_site_status_text' => '',
                    'site_status' => '',
                ],
            ];
            $ci->load->model('users/models/Users_statuses_model');
            if ($ci->session->userdata('auth_type') == 'user') {
                $data['id_user'] = $ci->session->userdata('user_id');
                $data['user_status'] = $ci->Users_statuses_model->get_user_statuses($data['id_user']);
                if ($data['user_status']['current_site_status']) {
                    $ci->load->model('im/models/Im_contact_list_model');
                    $data['new_msgs'] = $ci->Im_contact_list_model->checkNewMessages($data['id_user']);
                }
                $data['user_name'] = $ci->session->userdata('output_name');
            }
            foreach ($ci->Users_statuses_model->statuses as $key => $status) {
                $data['statuses'][$key]['val'] = $key;
                $data['statuses'][$key]['text'] = $status;
                $data['statuses'][$key]['lang'] = l('status_site_' . $key, 'users');
            }
            $ci->view->assign('im_data', $data);
            $ci->view->assign('im_json_data', json_encode($data));

            return $ci->view->fetch('helper_im', 'user', 'im');
        }
    }

    if (!function_exists('imChatAddButton')) {
        function imChatAddButton($params)
        {
            $id_contact = $params['id_contact'];
            $ci = &get_instance();
            $ci->load->model('Im_model');
            $im_status = $ci->Im_model->im_status(0);
            if ($ci->session->userdata('auth_type') != 'user' || !$im_status['im_on']) {
                return false;
            }

            $ci->load->model('im/models/Im_contact_list_model');
            $list[0] = is_array($id_contact) ? ['id_contact' => intval($id_contact['id_contact'])] : ['id_contact' => $id_contact];
            $data['contact_list']['list'] = $ci->Im_contact_list_model->formatList($list);
            $data['contact_list']['time'] = time();
            $data['id_contact'] = $list[0]['id_contact'];
            $data['id_user'] = $ci->session->userdata('user_id');
            $ci->view->assign('im_data', $data);
            $ci->view->assign('im_json_data', json_encode($data));

            if (empty($params['view_type'])) {
                $params['view_type'] = 'button';
            }
            $ci->view->assign('class', (isset($params['class']) && !empty($params['class'])) ? $params['class'] : '');
            
            return $ci->view->fetch('helper_im_add_' . $params['view_type'], 'user', 'im');
        }
    }
    if (!function_exists('imMobileBlock')) {
        function imMobileBlock()
        {
            $ci = &get_instance();
            $ci->load->model('Im_model');
            $im_status = $ci->Im_model->imStatus();
            if (!$im_status['im_on'] || !$im_status['id_user']) {
                return false;
            }
            return $ci->view->fetch('helper_mobile_block', 'user', 'im');
        }
    }

}

namespace {
    
    if (!function_exists('im_chat_button')) {
        function im_chat_button()
        {
            return Pg\modules\im\helpers\imChatButton();
        }
    }

    if (!function_exists('im_chat_add_button')) {
        function im_chat_add_button($params)
        {
            return Pg\modules\im\helpers\imChatAddButton($params);
        }
    }
    if (!function_exists('imMobileBlock')) {
        function imMobileBlock()
        {
            return Pg\modules\im\helpers\imMobileBlock();
        }
    }

    
}
