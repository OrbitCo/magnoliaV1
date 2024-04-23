<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\controllers;

use Pg\Libraries\View;
use Pg\modules\chatbox\models\ChatboxModel;

/**
 * Chatbox module
 * User side controller
 *
 * @package     PG_Dating
 * @subpackage  Chatbox
 * @category    controllers
 *
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 * @author      Renat Gabdrakhmanov <renatgab@pilotgroup.eu>
 */
class Chatbox extends \Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Chatbox_model',
            'chatbox/models/Chatbox_contact_list_model'
        ]);
        $this->user_id = (int)$this->session->userdata('user_id');
        $this->view->assign('page_type', ChatboxModel::MODULE_GID);
    }

    public function index($contact_id = 0)
    {
        $this->chat((int)$contact_id);
    }

    public function chat(int $contact_id = 0)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            $blocked_ids = $this->ci->Blacklist_model->getBlockedIds($this->user_id);
            if (!empty($blocked_ids) && in_array($contact_id, $blocked_ids, true)) {
                $contact_id = 0;
                $this->system_messages->addMessage(View::MSG_ERROR, l('user_in_blacklist', 'chatbox'));
            }
        }

        $contact_list = $this->Chatbox_contact_list_model->getList(
            ['user_id' => $this->user_id],
            1,
            $this->Chatbox_contact_list_model->items_per_page,
            ['date_update' => 'DESC']
        );

        $is_notification_contact = false;

        if ($contact_id === $this->user_id) {
            $is_notification_contact = true;
        }

        $im_list = [];

        if ($this->pg_module->is_module_installed('im')) {
            $this->load->model(['im/models/Im_contact_list_model', 'im/models/Im_messages_model']);
            $im_list = $this->Im_contact_list_model->getContactList($this->user_id);
        }

        $contact_list = $this->Chatbox_contact_list_model->formatArray($contact_list);

        $contact_list_dump = $this->Chatbox_contact_list_model->mergeDataContacts($contact_list, $im_list, $this->user_id, false);

        foreach ($contact_list_dump as $key => $value) {
            if (isset($value['contact']['is_deleted']) && $value['contact']['is_deleted']) {
                unset($contact_list_dump[$key]);
            }
        }

        $js_send_btn = 'enter';
        if ($this->pg_module->get_module_config('chatbox', 'chatbox_settings_send_btn') == 1) {
            $js_send_btn = 'shift+enter';
        }

        $this->view->assign('js_send_btn', $js_send_btn);
        $this->view->assign('contact_list', $contact_list_dump);
        $this->view->assign('is_notification_contact', $is_notification_contact);
        $this->view->assign('user_id', $this->user_id);
        $this->view->assign('l_time', strtotime(date('Y-m-d H:i:s')));
        $this->view->assign('contact_id', $contact_id);

        $this->load->model('Menu_model');
        $this->Menu_model->breadcrumbs_set_parent('chatbox_item');

        $this->view->render('index');
    }

    public function ajaxAddContactForm()
    {
        $this->view->assign('users_block', $this->searchUsersListBlock());
        echo $this->view->fetch('ajax_user_select_form');
        exit;
    }

    public function ajaxSearchUsers($type = 'search', $order = 'default', $order_direction = 'DESC', $page = 1)
    {
        $this->load->model('Users_model');

        if (empty($_POST)) {
            $current_settings = ($this->session->userdata("users_chatbox_search")) ? $this->session->userdata("users_chatbox_search") : [];
            $data = (!empty($current_settings)) ? $current_settings : [];
        } else {
            foreach ($_POST as $key => $val) {
                $data[$key] = $this->input->post($key, true);
            }

            $data = array_merge($this->Users_model->getMinimumSearchData(), $data);
            $this->session->set_userdata("users_chatbox_search", $data);
        }

        echo $this->searchUsersListBlock($data, $order, $order_direction, $page);
    }

    protected function searchUsersListBlock($data = [], $order = 'default', $order_direction = 'DESC', $page = 1)
    {
        $this->load->model('Users_model');

        $current_settings = $data;
        $criteria = $this->getAdvancedSearchCriteria($current_settings);

        $search_url = site_url() . 'users/search';
        $url = site_url() . 'users/search/' . $order . '/' . $order_direction . '/';

        $order = trim(strip_tags($order));
        if (!$order) {
            $order = 'date_created';
        }
        $this->view->assign('order', $order);

        $order_direction = strtoupper(trim(strip_tags($order_direction)));
        if ($order_direction != 'DESC') {
            $order_direction = 'ASC';
        }
        $this->view->assign('order_direction', $order_direction);

        $items_count = $this->Users_model->getUsersCount($criteria);

        if (!$page) {
            $page = 1;
        }
        $items_on_page = $this->pg_module->get_module_config('users', 'items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $items_count, $items_on_page);

        $sort_data = [
            'url' => $search_url,
            'order' => $order,
            'direction' => $order_direction,
            'links' => [
                'default' => l('field_default_sorter', 'users'),
                'name' => l('field_name', 'users'),
                'views_count' => l('field_views_count', 'users'),
                'date_created' => l('field_date_created', 'users'),
            ],
        ];
        $this->view->assign('sort_data', $sort_data);

        $use_leader = false;
        if ($items_count > 0) {
            $order_array = [];
            if ($order == 'default') {
                if (!empty($data['id_region']) && (int)$data['id_region']) {
                    $order_array['leader_bid'] = 'DESC';
                }
                if (!empty($criteria['fields']) && (int)$criteria['fields']) {
                    $order_array['fields'] = 'DESC';
                } else {
                    $order_array['up_in_search_end_date'] = 'DESC';
                    $order_array['date_created'] = $order_direction;
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

            $lang_id = $this->pg_language->current_lang_id;
            $users = $this->Users_model->getUsersList($page, $items_on_page, $order_array, $criteria, [], true, false, $lang_id);

            $this->view->assign('users', $users);
        }

        $this->load->helper('navigation');
        $page_data = get_user_pages_data($url, $items_count, $items_on_page, $page, 'briefPage');
        $page_data['date_format'] = $this->pg_date->get_format('date_literal', 'st');
        $page_data['date_time_format'] = $this->pg_date->get_format('date_time_literal', 'st');
        $page_data['use_leader'] = $use_leader;
        $page_data["view_type"] = 'gallery';
        $page_data["type"] = 'scroll';
        $this->view->assign('page_data', $page_data);

        $use_save_search = ($this->session->userdata('auth_type') == 'user') ? true : false;
        $this->view->assign('use_save_search', $use_save_search);

        $pm_installed = $this->pg_module->is_module_installed('perfect_match');
        $this->view->assign('pm_installed', $pm_installed);

        return $this->view->fetch('add_new_contact_users_block');
    }

    private function getAdvancedSearchCriteria($data)
    {
        $this->load->model('Users_model');
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

    public function ajaxOpenDialog()
    {
        $return = ['contact_id' => 0, 'content' => ''];

        $contact_id = (int)$this->input->post('contact_id', true);

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                if (in_array($contact_id, $blocked_ids)) {
                    $contact_id = 0;
                    $return['errors'] = l('user_in_blacklist', 'chatbox');
                    exit(json_encode($return));
                }
            }
        }

        $this->load->model('Users_model');
        $contact = $this->Users_model->getUserById($contact_id, true);
        if (!empty($contact)) {
            $return['contact_id'] = $contact_id;
            $filters = [
                'user_id' => $this->user_id,
                'contact_id' => $contact_id,
            ];

            $messages = $this->getMessages($contact_id, $filters, 1, $this->Chatbox_model->messages_per_page, ['date_added' => 'DESC'], false);

            //im messages
            $from_date = '';

            if ($messages) {
                $from_date = $messages[0]['date_added'];
            }

            $this->load->model('im/models/Im_messages_model');
            $messages = $this->Im_messages_model->getLastMessagesChatbox($messages, $this->user_id, $contact_id, $this->Chatbox_model->messages_per_page, $from_date);
            $this->Im_messages_model->checkIsRead($this->user_id, $contact_id);

            $this->view->assign('message_max_chars', $this->pg_module->get_module_config('im', 'message_max_chars'));
            $this->view->assign('messages', $messages);

            $this->load->model('chatbox/models/Chatbox_attaches_model');
            $attach_settings = $this->Chatbox_attaches_model->getImageSettings();
            $this->view->assign('attach_settings', $attach_settings);

            $user = $this->Users_model->getUserById($this->user_id, true);
            $this->view->assign('user', $user);

            $this->view->assign('is_mini_logo', 1);  // set 0 for full logo

            $contact = $this->Users_model->getUserById($contact_id, true);
            $this->view->assign('contact', $contact);

            $return['content'] = $this->view->fetch('dialog');
        }

        exit(json_encode($return));
    }

    public function ajaxGetDialogs()
    {
        $return = ['count' => 0, 'dialogs' => []];

        $search = trim(strip_tags($this->input->post('search', true)));
        $l_date = trim(strip_tags($this->input->post('l_date', true)));
        $filters = [
            'user_id' => $this->user_id,
            'max_date_update' => $l_date,
        ];

        $l_id = (int)$this->input->post('l_id', true);
        if ($l_id) {
            $filters['max_id'] = $l_id;
        }

        if (!empty($search)) {
            $this->load->model('Users_model');
            $contact_ids = [];
            $all_contact_list = $this->Chatbox_contact_list_model->getList(['user_id' => $this->user_id]);
            foreach ($all_contact_list as $item) {
                $contact_ids[] = $item['contact_id'];
            }

            $users_params = [];
            $hide_user_names = $this->pg_module->get_module_config('users', 'hide_user_names');
            if ($hide_user_names) {
                $users_params['where']['nickname LIKE'] = '%' . $search . '%';
            } else {
                $search_string_escape = $this->db->escape('%' . $search . '%');
                $users_params['where_sql'][] = '(nickname LIKE ' . $search_string_escape
                    . ' OR fname LIKE ' . $search_string_escape
                    . ' OR sname LIKE ' . $search_string_escape . ')';
            }

            $users = $this->Users_model->getUsersList(null, null, null, $users_params, $contact_ids, false);
            $contact_ids = [0];
            foreach ($users as $user) {
                $contact_ids[] = $user['id'];
            }

            $filters['contact_id'] = $contact_ids;
        }

        $contact_list = $this->Chatbox_contact_list_model->getList($filters, 1, $this->Chatbox_contact_list_model->items_per_page, ['date_update' => 'DESC']);
        $contact_list = $this->Chatbox_contact_list_model->formatArray($contact_list);

        foreach ($contact_list as $key => $contact) {
            $this->view->assign('contact_list', [0 => $contact]);
            $contact_list[$key]['html'] = $this->view->fetch('users');
        }

        $return['count'] = count($contact_list);
        $return['dialogs'] = $contact_list;

        exit(json_encode($return));
    }

    public function ajaxDeleteDialog()
    {
        $return = ['success' => 0];
        $contact_id = (int)$this->input->post('contact_id', true);
        if (!empty($contact_id)) {
            $this->Chatbox_model->clearHistory($this->user_id, $contact_id);
            $this->Chatbox_contact_list_model->deleteByUserIdAndContactId($this->user_id, $contact_id);

            if ($this->pg_module->is_module_installed('im')) {
                $this->load->model('im/models/Im_contact_list_model');
                $this->Im_contact_list_model->removeContact($this->user_id, $contact_id);
            }

            $return['success'] = 1;
        }
        exit(json_encode($return));
    }

    public function ajaxSendMessage()
    {
        $result = ['service_access' => 1, 'messages' => []];
        $post_access = true;
        $message = $this->input->post('message', true);
        $contact_id = $this->input->post('contact_id', true);

        if ($this->pg_module->is_module_installed('blacklist')) {
            $this->load->model('Blacklist_model');
            if ($this->Blacklist_model->is_blocked($contact_id, $this->user_id)) {
                $post_access = false;
                $result['errors'][] = l('post_denied', 'chatbox');
            } elseif ($this->Blacklist_model->is_blocked($this->user_id, $contact_id)) {
                $result['notices'][] = l('user_cant_answer', 'chatbox');
            }
        }

        if ($post_access) {
            $result = array_merge_recursive($this->Chatbox_model->addMessage($this->user_id, $contact_id, $message, true), $result);

            $l_adate = trim(strip_tags($this->input->post('l_adate', true) ?: ""));
            $message_filters = [
                'user_id' => $this->user_id,
                'contact_id' => $contact_id,
                'min_date_added' => $l_adate,
            ];
            $result['messages'] = $this->getMessages($contact_id, $message_filters, null, null, ['date_added' => 'DESC'], true);

            $last_mess = end($result['messages']);

            $this->load->model('Users_model');

            $last_mess['contact'] = $this->Users_model->get_user_by_id($last_mess['contact_id'], true);
            $last_mess['contact']['contact_id'] = $last_mess['contact_id'];

            $last_mess['last_message'] = $last_mess;

            $result['contact'] = [
                'id' => $last_mess['contact_id'],
                'is_read_mess' => $last_mess['is_read_mess'],
                'html' => '',
            ];

            $this->view->assign('is_mini_logo', 1);  // set 0 for full logo
            $this->view->assign('user_id', $this->user_id);
            $this->view->assign('contact_list', [0 => $last_mess]);

            $result['contact']['html'] = $this->view->fetch('users', 'user', ChatboxModel::MODULE_GID);
        }

        exit(json_encode($result));
    }

    protected function getMessages($contact_id, $filters = [], $page = null, $limits = null, $order_by = ['date_added' => 'DESC'], $with_html = false)
    {
        $messages = $this->Chatbox_model->getList($filters, $page, $limits, $order_by);

        if (!empty($messages)) {
            $messages = array_reverse($this->Chatbox_model->formatArray($messages));

            if ($with_html) {
                $user = $this->Users_model->getUserById($this->user_id, true);
                $contact = $this->Users_model->getUserById($contact_id, true);
                foreach ($messages as $key => $message) {
                    $this->view->assign('messages', [0 => $message]);
                    $this->view->assign('user', $user);
                    $this->view->assign('contact', $contact);
                    $messages[$key]['html'] = $this->view->fetch('messages');
                }
            }

            if ($contact_id) {
                $this->Chatbox_model->checkIsRead($this->user_id, $contact_id);
            }

            return $messages;
        }

        return [];
    }

    public function ajaxGetMessages()
    {
        $return = ['count' => 0, 'messages' => []];
        $contact_id = (int)$this->input->post('contact_id', true);

        if (!empty($contact_id)) {
            $message_filters = [
                'user_id' => $this->user_id,
                'contact_id' => $contact_id,
            ];

            if (!empty($this->input->post('f_adate'))) {
                $f_adate = trim(strip_tags($this->input->post('f_adate', true)));
                $message_filters['max_date_added'] = $f_adate;
            }

            $return['messages'] = $this->getMessages($contact_id, $message_filters, 1, $this->Chatbox_model->messages_per_page, ['date_added' => 'DESC'], true);
            $return['count'] = count($return['messages']);
        }

        exit(json_encode($return));
    }

    public function ajaxDeleteMessage()
    {
        $return = ['success' => 0, 'error' => '', 'msg_count' => ''];
        $message_id = (int)$this->input->post('message_id', true);

        $message = $this->Chatbox_model->getById($message_id);
        if (!empty($message) && $message['user_id'] == $this->user_id) {
            $this->Chatbox_model->delete($message_id);
            $return['success'] = 1;

            $return['msg_count'] = $this->Chatbox_model->getCount(['user_id' => $this->user_id, 'contact_id' => $message['contact_id']]);
            if (!$return['msg_count']) {
                $this->Chatbox_contact_list_model->deleteByUserIdAndContactId($this->user_id, $message['contact_id']);
            }
        }

        exit(json_encode($return));
    }

    public function postUploadComplete()
    {
        $message_id = (int)$this->input->post('complete_id', true);
        if ($message_id) {
            $this->Chatbox_model->save($message_id, ['full_load' => 1]);
            $message_data = $this->Chatbox_model->getById($message_id);
            $this->Chatbox_model->save($message_data['linked_id'], ['full_load' => 1]);
            $return['complete_status'] = true;
        } else {
            $return['complete_status'] = false;
        }

        exit(json_encode($return));
    }

    public function ajaxMessagesStatus()
    {
        $contacts = $this->input->post('contacts', true);
        $messages = [];

        if ($contacts) {
            foreach ($contacts as $key => $contact) {
                $params = [
                    'where' => [
                        'user_id' => $contact,
                        'contact_id' => $this->user_id,
                        'dir' => 'i'
                    ]
                ];
                $res = $this->Chatbox_model->getListInternal(1, 1, ['id' => 'DESC'], $params);
                $messages[$contact] = current($res);
            }
        }

        $return['last_status_messages'] = $messages;
        exit(json_encode($return));
    }

    public function postUpload()
    {
        $return = ['errors' => '', 'success' => '', 'message_id' => 0, 'service_access' => 1];

        $this->load->model('chatbox/models/Chatbox_attaches_model');

        $contact_id = (int)$this->input->post('contact_id', true);
        if (empty($contact_id)) {
            $return['errors'][] = l('error_invalid_recipient', 'chatbox');
        } else {
            $post_data = [
                'user_id' => $this->user_id,
                'contact_id' => $contact_id,
            ];

            $validate_data = $this->Chatbox_attaches_model->validate(null, $post_data, 'attach');
            if (!empty($validate_data['errors'])) {
                $return['errors'] = implode('<br>', $validate_data['errors']);
            } else {
                $message_id = (int)$this->input->post('id', true);
                if (empty($message_id)) {
                    $message = $this->input->post('message', true);

                    $return_message = $this->Chatbox_model->addMessage($this->user_id, $contact_id, $message, false, false, false, ['newMsgCounter' => true]);
                    if (!empty($return_message['errors'])) {
                        $return['errors'] = $return_message['errors'];
                    } else {
                        $message_id = $return_message['o_msg_id'];
                    }
                }
                $return['message_id'] = $validate_data['data']['message_id'] = $message_id;

                $return_attach = $this->Chatbox_attaches_model->upload(null, $validate_data['data'], 'attach');

                if (!empty($return_attach['errors'])) {
                    $return['errors'] = implode('<br/>', $return_attach['errors']);
                } else {
                    $attaches_count = $this->Chatbox_attaches_model->getCount(['message_id' => $message_id]);
                    $this->Chatbox_model->save($message_id, ['attaches_count' => $attaches_count]);
                    $message_data = $this->Chatbox_model->getById($message_id);
                    $this->Chatbox_model->save($message_data['linked_id'], ['attaches_count' => $attaches_count]);

                    $this->Chatbox_model->updateContactNewMsgStatus($contact_id, $this->user_id);
                }

                $message_filters = [
                    'user_id' => $this->user_id,
                    'contact_id' => $contact_id,
                ];

                $return['messages'] = $this->getMessages($contact_id, $message_filters, 1, $this->Chatbox_model->messages_per_page, ['date_added' => 'DESC'], true);
            }
        }

        exit(json_encode($return));
    }
}
