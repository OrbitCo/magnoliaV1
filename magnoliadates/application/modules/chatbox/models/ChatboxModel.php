<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\models;

use Pg\Libraries\Analytics;
use Pg\Libraries\Cache\Manager as CacheManager;
use Pg\Libraries\EmojiMap;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Messaging Center module
 * Messages model
 *
 * @package     PG_Dating
 * @subpackage  Chatbox
 * @category    models
 *
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 * @author      Renat Gabdrakhmanov <renatgab@pilotgroup.eu>
 */
class ChatboxModel extends \Model
{
    public const MODULE_GID      = 'chatbox';
    public const TABLE           = DB_PREFIX . 'chatbox';
    public const DB_DATE_FORMAT  = 'Y-m-d H:i:s';
    public const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    //const READ_SERVICE = 'read_message_service';
    public const SEND_SERVICE = 'send_message_service';

    public $services_buy_gids = [
        //'view' => self::READ_SERVICE,
        'send' => self::SEND_SERVICE
    ];

    public const INBOX  = 'i';
    public const OUTBOX = 'o';

    protected $fields = [
        'id',
        'linked_id',
        'user_id',
        'contact_id',
        'message',
        'dir',
        'is_read',
        'full_load',
        'date_added',
        'date_readed',
        'attaches_count',
        'is_notify',
        'is_system_msg',
        'search_field',
    ];

    protected $format_settings = [
        'get_attaches' => true,
        'get_contact' => false,
    ];

    public $emoji_raws = ['map' => [], 'revert_map' => [], 'names' => [], 'codes' => [], 'regexp' => ['names', 'codes']];
    private $moderation_type = self::MODULE_GID;
    public $messages_per_page = 15;
    public $messages_max_count_header = 3;
    public const CACHE_NAME = 'ChatboxModel';

    public function __construct()
    {
        parent::__construct();
        $this->initEmojiMap();
        $this->ci->cache->registerService(self::TABLE);
    }

    protected function getObject($data = [])
    {
        $fields_str = implode(', ', $this->fields);

        if (empty($data)) {
            $dbTable = self::TABLE;
            $results =  $this->ci->cache->get(self::TABLE, 'getObject', function () use ($fields_str, $dbTable) {
                $ci = &get_instance();
                $ci->db->select($fields_str)->from($dbTable);
                return $ci->db->get()->result_array();
            });
        } else {
            $this->ci->db->select($fields_str)->from(self::TABLE);
            foreach ($data as $field => $value) {
                $this->ci->db->where($field, $value);
            }
            $results = $this->ci->db->get()->result_array();
        }

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    public function getById($id)
    {
        return $this->getObject(['id' => $id]);
    }

    public function initEmojiMap()
    {
        $em = new EmojiMap();
        foreach ($em->emoji_data as $key => $emoji) {
            $this->emoji_raws['map'][':' . $emoji[3][0] . ':'] = $emoji[0][0];
            $this->emoji_raws['revert_map'][$emoji[0][0]] = ':' . $emoji[3][0] . ':';
            array_push($this->emoji_raws['names'], ':' . $emoji[3][0] . ':');
            array_push($this->emoji_raws['codes'], $emoji[0][0]);
        }

        $this->emoji_raws['regexp']['names'] = '/(' . implode("|", $this->emoji_raws['names']) . ')/';
        $this->emoji_raws['regexp']['codes'] = '/(' . implode("|", $this->emoji_raws['codes']) . ')/';

        return $this->emoji_raws;
    }

    protected function getCriteriaInternal($filters)
    {
        $filters = ['data' => $filters, 'table' => self::TABLE, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : self::TABLE;

        $fields = array_flip($this->fields);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (is_string($filter_data)) {
                $filter_data = trim($filter_data);
            }
            switch ($filter_name) {
                case 'ids':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where_in' => ['id' => $filter_data]]);

                    break;
                case 'max_msg_id':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['id <' => $filter_data]]);

                    break;
                case 'min_msg_id':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['id >' => $filter_data]]);

                    break;
                case 'current_month':
                    if (empty($filter_data)) {
                        break;
                    }
                    $curr_month = date('Y-m');
                    $params = array_merge_recursive($params, ['where' => ['date_added >=' => $curr_month . '-01 00:00:00', 'date_added <=' => $curr_month . '-31 23:59:59']]);
                    break;
                case 'min_date_added':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['date_added >=' => $filter_data]]);

                    break;
                case 'max_date_added':
                    if (empty($filter_data)) {
                        break;
                    }
                    $params = array_merge_recursive($params, ['where' => ['date_added <=' => $filter_data]]);

                    break;
                case 'where':
                case 'where_in':
                case 'where_not_in':
                case 'where_sql':
                    if (empty($filter_data) || !is_array($filter_data)) {
                        break;
                    }
                    if (!array_key_exists($filter_name, $params)) {
                        $params[$filter_name] = [];
                    }
                    $params[$filter_name] = array_merge_recursive($params[$filter_name], $filter_data);

                    break;
                default:
                    if (isset($fields[$filter_name])) {
                        if (is_array($filter_data)) {
                            $params = array_merge_recursive($params, ['where_in' => [$filter_name => $filter_data]]);
                        } else {
                            $params = array_merge_recursive($params, ['where' => [$filter_name => $filter_data]]);
                        }
                    }

                    break;
            }
        }

        return $params;
    }

    public function getListInternal($page = null, $limits = null, $order_by = null, $params = [])
    {
        $table = self::TABLE;
        $fields = $this->fields;

        $fields_str = $table . '.' . implode(', ' . $table . '.', $fields);

        $this->ci->db->select($fields_str);
        $this->ci->db->from($table);

        if (isset($params['join'])) {
            foreach ($params['join'] as $j_table => $j_sett) {
                $this->ci->db->join($j_table, $j_sett, 'left');
            }
        }

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql'])) {
            if (!is_array($params['where_sql'])) {
                $params['where_sql'] = [$params['where_sql']];
            }
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                } elseif ($field == 'order_str') {
                    if (is_array($dir)) {
                        foreach ($dir as $f => $d) {
                            $this->ci->db->order_by($f . ' ' . $d);
                        }
                    } else {
                        $this->ci->db->order_by($dir);
                    }
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = (int)$page ?: 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    protected function getCountInternal($params = null)
    {
        $table = isset($params['table']) ? $params['table'] : self::TABLE;

        $this->ci->db->select('COUNT(*) AS cnt');
        $this->ci->db->from($table);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return (int)$results[0]['cnt'];
        }

        return 0;
    }

    public function getList($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getListInternal($page, $items_on_page, $order_by, $params);
    }

    public function formatImToChatbox($data)
    {
        $data['user_id'] = $data['id_user'];
        $data['linked_id'] = $data['id_linked'];
        $data['contact_id'] = $data['id_contact'];
        $data['message'] = $data['text'];
        $data['short_message'] = $data['text'];
        $data['date_added'] = $data['date_add'];
        unset($data['id_user'], $data['id_linked'], $data['id_contact'], $data['text'], $data['date_add']);

        return $data;
    }

    public function formatChatboxToIm($data)
    {
        $data['id_user'] = $data['user_id'];
        $data['id_linked'] = $data['linked_id'];
        $data['id_contact'] = $data['contact_id'];
        $data['text'] = $data['message'];
        $data['date_add'] = $data['date_added'];
        unset($data['user_id'], $data['linked_id'], $data['contact_id'], $data['message'], $data['date_added']);

        return $data;
    }

    public function getListIm($id_user, $contact, $from_id = null)
    {
        $message_filters = [
            'user_id' => $id_user,
            'contact_id' => $contact,
            'full_load' => 1
        ];

        if ($from_id) {
            $message_filters['min_msg_id'] = $from_id;
        }
        $messages_chatbox = $this->getList($message_filters, null, null, ['date_added' => 'DESC']);

        if (!empty($messages_chatbox)) {
            $messages_chatbox = array_reverse($this->formatArray($messages_chatbox));
            foreach ($messages_chatbox as $key => $value) {
                $messages_chatbox[$key] = $this->formatChatboxToIm($messages_chatbox[$key]);
            }

            return $messages_chatbox;
        }

        return false;
    }

    public function getListByKey($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $key => $item) {
            $return[$item['id']] = $item;
        }

        return $return;
    }

    public function getListByField($field, $filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $key => $item) {
            $return[$item[$field]] = $item;
        }

        return $return;
    }

    public function getCount($filters = [])
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getCountInternal($params);
    }

    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    public function format($data)
    {
        if (empty($data) || !is_array($data)) {
            return [];
        }

        return current($this->formatArray([0 => $data]));
    }

    public function formatArray($data)
    {
        $return = [];

        if (empty($data) || !is_array($data)) {
            return [];
        }

        $for_users = $for_attaches = [];

        foreach ($data as $key => $item) {
            if (!empty($item['contact_id'])) {
                $for_users[] = $item['contact_id'];
            }
            $item['date_added_time'] = strtotime($item['date_added']);
            $item['message'] = $item['is_system_msg'] ? $item['message'] : nl2br($item['message']);

            if ($item['dir'] == 'o') {
                $item['is_read_mess'] = $this->getById($item['linked_id'])['is_read'];
            }

            if (empty($item['message']) && $item['attaches_count']) {
                $item['short_message'] = ($item['attaches_count'] > 1)
                    ? l('text_images', self::MODULE_GID)
                    : l('text_image', self::MODULE_GID);
            } else {
                $message = trim(strip_tags($item['message']));
                if (strlen($message) > 90) {
                    $message = mb_substr($message, 0, 90, 'UTF-8') . '...';
                }
                $item['short_message'] = $message;
            }

            if ($item['attaches_count']) {
                $for_attaches[] = ($item['dir'] == self::OUTBOX) ? $item['id'] : $item['linked_id'];
            }

            $return[$key] = $item;
        }

        if (!empty($for_users) && $this->format_settings['get_contact']) {
            $this->ci->load->model('Users_model');
            $contacts = $this->ci->Users_model->getUsersListByKey(null, null, null, [], array_unique($for_users));
            foreach ($return as $key => $item) {
                $return[$key]['contact'] = !empty($contacts[$item['contact_id']])
                    ? $this->ci->Users_model->formatUser($contacts[$item['contact_id']])
                    : $this->ci->Users_model->formatDefaultUser($item['contact_id']);
            }
        }

        if (!empty($for_attaches) && $this->format_settings['get_attaches']) {
            $this->ci->load->model('chatbox/models/Chatbox_attaches_model');
            $attaches = $this->ci->Chatbox_attaches_model->getAttachesForMessages(array_unique($for_attaches));
            foreach ($return as $key => $item) {
                $msg_id = ($item['dir'] == self::OUTBOX) ? $item['id'] : $item['linked_id'];
                if (array_key_exists($msg_id, $attaches)) {
                    $return[$key]['attaches'] = $attaches[$msg_id];
                }
            }
        }

        return $return;
    }

    public function formatDefault(): array
    {
        return [];
    }

    public function validate($id = null, $data = []): array
    {
        $return = ['errors' => [], 'data' => [], 'services_data' => []];

        if (isset($data['id'])) {
            $return['data']['id'] = (int)$data['id'];
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (isset($data['linked_id'])) {
            $return['data']['linked_id'] = (int)$data['linked_id'];
        }

        if (isset($data['user_id'])) {
            $return['data']['user_id'] = (int)$data['user_id'];
            if (empty($return['data']['user_id'])) {
                $return['errors'][] = l('error_empty_user', self::MODULE_GID);
            }
        }

        if (isset($data['contact_id'])) {
            $return['data']['contact_id'] = (int)$data['contact_id'];
            if (empty($return['data']['contact_id'])) {
                $return['errors'][] = l('error_invalid_recipient', self::MODULE_GID);
            }
        }

        if (isset($data['message']) && $data['message']) {
            if (isset($data['is_notify']) && $data['is_notify']) {
                $return['data']['message'] = $data['message'];
            } elseif (isset($data['is_system_msg']) && !empty($data['is_system_msg'])) {
                $return['data']['message'] = $data['message'];
            } else {
                $return['data']['message'] = trim(strip_tags($data['message']));
                if (!empty($return['data']['message'])) {
                    $this->ci->load->model('moderation/models/Moderation_badwords_model');
                    $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']['message']);
                    if ($bw_count) {
                        $return['errors'][] = l('error_badwords_message', self::MODULE_GID);
                    }
                }
            }
        }

        if (isset($data['dir'])) {
            $return['data']['dir'] = trim($data['dir']);
            if (empty($return['data']['dir']) || !in_array($return['data']['dir'], [self::INBOX, self::OUTBOX], true)) {
                $return['data']['dir'] = self::INBOX;
            }
        }

        if (isset($data['is_read'])) {
            $return['data']['is_read'] = $data['is_read'] ? 1 : 0;
        }

        if (isset($data['date_added'])) {
            $value = strtotime($data['date_added']);
            if ($value) {
                $return['data']['date_added'] = date(self::DB_DATE_FORMAT);
            } else {
                $return['data']['date_added'] = self::DB_DEFAULT_DATE;
            }
        }

        if (isset($data['date_readed'])) {
            $value = strtotime($data['date_readed']);
            if ($value) {
                $return['data']['date_readed'] = date(self::DB_DATE_FORMAT);
            } else {
                $return['data']['date_readed'] = self::DB_DEFAULT_DATE;
            }
        }

        if (isset($data['attaches_count'])) {
            $return['data']['attaches_count'] = (int)$data['attaches_count'];
        }

        if (isset($data['search_field'])) {
            $return['data']['search_field'] = trim(strip_tags($data['search_field']));
        }

        return $return;
    }

    public function save($id = null, $save_raw = [])
    {
        if (empty($id)) {
            if (empty($save_raw['date_added'])) {
                $save_raw['date_added'] = date(self::DB_DATE_FORMAT);
            }
            $this->ci->db->insert(self::TABLE, $save_raw);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(self::TABLE, $save_raw);
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $id;
    }

    public function delete($id)
    {
        if (is_array($id)) {
            foreach ($id as $i) {
                $this->delete($i);
            }
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->delete(self::TABLE);
        }
        $this->ci->cache->flush(self::TABLE);
    }

    public function clearHistory($user_id, $contact_id)
    {
        $this->ci->db->where('user_id', $user_id);
        $this->ci->db->where('contact_id', $contact_id);
        $this->ci->db->delete(self::TABLE);
        $this->ci->cache->flush(self::TABLE);
    }

    public function serviceSetSendMessage($user_id, $message_count)
    {
        $this->ci->load->model('chatbox/models/Chatbox_service_model');

        $chatbox_service = $this->ci->Chatbox_service_model->get_service_by_user_service($user_id, self::SEND_SERVICE);
        if (!empty($chatbox_service['service_data']) && isset($chatbox_service['service_data']['message_count'])) {
            $save_data = ['service_data' => $chatbox_service['service_data']];
            $save_data['service_data']['message_count'] += $message_count;
        } else {
            $save_data = ['id_user' => $user_id, 'gid_service' => self::SEND_SERVICE];
            $save_data['service_data'] = ['message_count' => $message_count];
            $chatbox_service['id'] = null;
        }

        $validate_data = $this->ci->Chatbox_service_model->validate_service($chatbox_service['id'], $save_data);
        $this->ci->Chatbox_service_model->save_service($chatbox_service['id'], $validate_data['data']);
    }

    public function setWriteCount($user_id, $message_count)
    {
        if (!$message_count) {
            $this->ci->load->model('chatbox/models/Chatbox_service_model');

            return $this->ci->Chatbox_service_model->removeService($user_id, self::SEND_SERVICE);
        }

        return $this->serviceSetSendMessage($user_id, $message_count);
    }

    public function moduleCategoryAction()
    {
        return [
            'name' => l('chat_now', 'chatbox'),
            'helper' => 'send_message_chatbox',
        ];
    }

    public function addMessage($user_id, $contact_id, $message, bool $is_full_load = false, bool $is_notify = false, bool $is_system_msg = false, array $settings = []): array
    {
        $return = ['errors' => [], 'data' => []];

        $data = [
            'user_id' => $user_id,
            'contact_id' => $contact_id,
            'dir' => self::OUTBOX,
            'is_read' => 1,
            'is_notify' => 0
        ];

        if (!empty($message) && $is_notify === false && $is_system_msg === true) {
            $temp_mess = preg_replace_callback(
                $this->emoji_raws['regexp']['names'],
                static function ($matches) {
                    return '';
                },
                $message
            );
            $emoji_count = 0;
            $data['message'] = preg_replace_callback(
                $this->emoji_raws['regexp']['names'],
                function ($matches) {
                    return $this->emoji_raws['map'][$matches[0]];
                },
                $message,
                -1,
                $emoji_count
            );
        } else {
            $data['message'] = $message;
        }

        if ($is_notify === true) {
            $data['is_notify'] = true;
        }

        $validate = $this->validate(null, $data);
        if (!empty($validate['errors'])) {
            $return['errors'] = implode('<br/>', $validate['errors']);

            return $return;
        }
        $data = $validate['data'];
        $data['is_system_msg'] = $is_system_msg;
        if ($is_full_load !== false) {
            $data['full_load'] = 1;
        }

        $return['o_msg_id'] = $this->save(null, $data);

        $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
        if ($is_notify !== true) {
            $this->ci->Chatbox_contact_list_model->updateContact($validate['data']['user_id'], $validate['data']['contact_id']);
        }

        if (!empty($return['o_msg_id'])) {

            $this->ci->load->library('Analytics');
            $event = $this->ci->analytics->getEvent('chatbox', 'engaged', 'user');
            $this->ci->analytics->track($event);

            $data['user_id'] = $validate['data']['contact_id'];
            $data['contact_id'] = $validate['data']['user_id'];
            $data['linked_id'] = $return['o_msg_id'];
            $data['dir'] = self::INBOX;
            $data['is_read'] = 0;
            $data['is_notify'] = 1;
            $return['i_msg_id'] = $this->save(null, $data);
            if (!empty($return['i_msg_id'])) {
                $this->save($return['o_msg_id'], ['linked_id' => $return['i_msg_id']]);

                if (!isset($settings['newMsgCounter'])) {
                    $contact_data = $this->ci->Chatbox_contact_list_model->getByUserIdAndContactId($contact_id, $user_id);

                    if (!empty($contact_data['count_new'])) {
                        $count_new = $contact_data['count_new'] + 1;
                    } else {
                        $count_new = 1;
                    }
                    $this->ci->Chatbox_contact_list_model->updateContact($validate['data']['contact_id'], $validate['data']['user_id'], $count_new);
                }

                $message_data = $this->format($this->getById($return['o_msg_id']));
                $this->ci->load->model('Users_model');
                $sender = $this->ci->Users_model->getUserById($user_id, true);
                $recipient = $this->ci->Users_model->getUserById($contact_id, true);

                $mail_data = [
                    'fname'   => $recipient['output_name'],
                    'sname'   => $recipient['sname'],
                    'sender'  => $sender['output_name'],
                    'message' => $message_data['message'],
                ];

                if ($is_notify !== false) {
                    $mail_data['sender'] = '  ' . l('site_notification', 'chatbox');
                }

                if (
                    $this->ci->pg_module->is_module_installed('mobile') &&
                    $this->ci->pg_module->get_module_config('mobile', 'use_notifications')
                ) {
                    $this->ci->load->model('mobile/models/MobileUsersPushNotificationsModel');

                    $new_msg_count = $this->getUnreadCount($contact_id, 'i', $user_id);
                    $all_msg_count = $this->getUnreadCount($contact_id, 'i');
                    $title = str_replace("[sender]", $sender['nickname'], l('im_new_message', 'mobile_app', $recipient['lang_id']));
                    $this->ci->MobileUsersPushNotificationsModel->pushNotification([
                        'id_user' => (int)$contact_id,
                        'title' => (string)$title,
                        'body' => (string)$message_data['message'],
                        'activity' => 'ChatActivity',
                        'module' => 'chatbox',
                        'gid' => 'new_message',
                        'contact_id' => (int)$user_id,
                        'contact_name' => (string)$sender['output_name'],
                        'msg_count' => (int)$new_msg_count,
                        'all_msg_count' => (int)$all_msg_count
                    ]);
                }

                if (empty($recipient['online_status'])) {
                    $this->ci->load->model('Notifications_model');
                    $this->ci->Notifications_model->sendNotification($recipient['email'], 'chatbox_new_message', $mail_data, '', $recipient['lang_id']);
                }
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $return;
    }

    /**
     * @param $contact_id
     * @param $user_id
     */
    public function updateContactNewMsgStatus($contact_id, $user_id)
    {
        $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
        $contact_data = $this->ci->Chatbox_contact_list_model->getByUserIdAndContactId($contact_id, $user_id);

        if (!empty($contact_data['count_new'])) {
            $count_new = $contact_data['count_new'] + 1;
        } else {
            $count_new = 1;
        }
        $this->ci->Chatbox_contact_list_model->updateContact($contact_id, $user_id, $count_new);
    }

    public function getUnreadCount($id_user, $dir = null, $id_contact = null)
    {
        $this->ci->db->where('user_id', $id_user)->where('is_read', 0);
        if (!empty($id_contact)) {
            $this->ci->db->where('contact_id', $id_contact);
        }
        if (!empty($dir)) {
            $this->ci->db->where('dir', $dir);
        }
        $result = current($this->ci->db->select('COUNT(id) as cnt')
            ->from(self::TABLE)->get()->result_array());

        return $result['cnt'];
    }

    public function simpleAddMessage($user_id, $contact_id, $message, $add_outbox = true)
    {
        $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');

        // inbox msg
        $message_data = [
            'user_id' => $contact_id,
            'contact_id' => $user_id,
            'dir' => self::INBOX,
            'message' => $message,
            'attaches_count' => 0,
            'linked_id' => 0,
            'is_read' => 0,
            'is_notify' => 1,
        ];
        $input_msg_id = $this->save(null, $message_data);
        if ($input_msg_id) {
            $contact_data = $this->ci->Chatbox_contact_list_model->getByUserIdAndContactId($contact_id, $user_id);
            if (!empty($contact_data)) {
                $count_new = $contact_data['count_new'] + 1;
            } else {
                $count_new = 1;
            }
            $this->ci->Chatbox_contact_list_model->updateContact($contact_id, $user_id, $count_new);

            // outbox msg
            if ($add_outbox) {
                $output_message_data = [
                    'user_id' => $user_id,
                    'contact_id' => $contact_id,
                    'dir' => self::OUTBOX,
                    'message' => $message,
                    'attaches_count' => 0,
                    'linked_id' => $input_msg_id,
                    'is_read' => 1,
                    'is_notify' => 0,
                ];
                $output_msg_id = $this->save(null, $message_data);
                $this->ci->Chatbox_contact_list_model->updateContact($message_data['user_id'], $message_data['contact_id']);

                $this->save($input_msg_id, ['linked_id' => $output_msg_id]);
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return true;
    }

    public function checkIsRead($user_id, $contact_id, $id_msg = null)
    {
        $user_id = (int)$user_id;
        $contact_id = (int)$contact_id;
        $update = [
            'is_read' => 1,
            'date_readed' => date(self::DB_DATE_FORMAT)
        ];
        $this->ci->db->where('user_id', $user_id);
        $this->ci->db->where('contact_id', $contact_id);
        if (!empty($id_msg)) {
            $this->ci->db->where('id <', $id_msg);
        }
        $this->ci->db->update(self::TABLE, $update);

        $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
        $contact_data = $this->ci->Chatbox_contact_list_model->getByUserIdAndContactId($user_id, $contact_id);
        if (!empty($contact_data) && $contact_data['count_new']) {
            $this->ci->Chatbox_contact_list_model->checkIsRead($user_id, $contact_id);
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return true;
    }

    public function getLastMessage($user_id, $contact_id)
    {
        $fields = $this->fields;
        $fields = implode(', ', $fields);
        $dbTable = self::TABLE;
        $result =  $this->ci->cache->get(self::TABLE, 'getLastMessageU' . $user_id . 'C' . $contact_id, function () use ($fields, $user_id, $contact_id, $dbTable) {
            $ci = &get_instance();

            return $ci->db->select($fields)
                ->from($dbTable)
                ->where('user_id', $user_id)
                ->where('contact_id', $contact_id)
                ->order_by('date_added DESC')
                ->get()
                ->result_array();

            return $result;
        });
        if (!empty($result) && is_array($result)) {
            return $result[0];
        }

        return false;
    }

    public function getRequestNotifications()
    {
        $result = ['notifications' => []];

        $user_id = $this->ci->session->userdata('user_id');
        $filters = [
            'user_id' => $user_id,
            'is_read' => 0,
            'dir' => self::INBOX,
            'is_notify' => 1,
        ];
        $messages = $this->getList($filters);
        $this->setFormatSettings('get_contact', true);
        $messages = $this->formatArray($messages);
        $this->setFormatSettings('get_contact', false);

        foreach ($messages as $message) {
            $text = str_replace('[sender]', $message['contact']['output_name'], l('notify_text', self::MODULE_GID));
            $user_icon = $message['contact']['media']['user_logo']['thumbs']['small'];

            if ($message['user_id'] == $message['contact_id']) {
                $text = l('site_notification', self::MODULE_GID) . ' [more]';
                // $theme_data =  $this->ci->view->getThemeSettings();
                $user_icon = site_url() . $this->ci->view->getThemeSettings()['mini_logo']['path'];
            }

            $link = site_url() . 'chatbox/chat/' . $message['contact_id'];
            $result['notifications'][] = [
                'title' => l('notify_title', self::MODULE_GID),
                'text' => $text,
                'id' => $message['id'],
                'comment' => '',
                'user_id' => $message['user_id'],
                'user_name' => $message['contact']['output_name'],
                'user_icon' => $user_icon,
                'user_link' => $link,
                'more' => '<a href="' . $link . '">' . l('link_message_show', self::MODULE_GID) . '</a>',
            ];
        }
        $this->ci->db->set('is_notify', '0')->where($filters)->update(self::TABLE);

        //messages block in header alerts
        $filters = [
            'user_id' => $user_id,
            'is_read' => 0,
            'dir' => self::INBOX,
        ];
        $messages = $this->getList($filters, 1, $this->messages_max_count_header, ['date_added' => 'DESC']);
        $this->setFormatSettings('get_contact', true);
        $messages = $this->formatArray($messages);
        $this->setFormatSettings('get_contact', false);
        $this->ci->view->assign('messages', $messages);
        $result['new_message_alert_html'] = $this->ci->view->fetch('new_messages_header', 'user', self::MODULE_GID);
        $result['max_messages_count'] = $this->messages_max_count_header;

        return $result;
    }

    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        }
        $actions = ['index', 'chat'];
        $return  = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
        }

        return $return;
    }

    private function getSeoSettingsInternal($method, $lang_id = '')
    {
        switch ($method) {
            case 'index':
                return [
                    'templates' => [],
                    'url_vars' => [],
                ];

                break;
            case 'chat':
                return [
                    'templates' => [],
                    'url_vars' => [
                        'id' => ['id' => 'literal'],
                    ],
                ];

                break;
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }

        return $value;
    }

    public function getSitemapXmlUrls(): array
    {
        $this->ci->load->helper('seo');

        return [];
    }

    public function getSitemapUrls(): array
    {
        return [];
    }

    public function bannerAvailablePages()
    {
        $return[] = ['link' => 'chatbox/index', 'name' => l('header_chatbox', self::MODULE_GID)];
        $return[] = ['link' => 'chatbox/chat', 'name' => l('chat_now', self::MODULE_GID)];

        return $return;
    }

    public function backendMessagesStatus(array $params = []): array
    {
        $contacts = $params['contacts'];

        $messages = [];
        $user_id = (int)$this->ci->session->userdata('user_id');
        if ($contacts) {
            foreach ($contacts as $key => $contact) {
                $params = [
                    'where' => [
                        'user_id' => (int)$contact,
                        'contact_id' => $user_id,
                        'dir' => 'i'
                    ]
                ];

                $messages[$contact] = current((array)$this->getListInternal(1, 1, ['id' => 'DESC'], $params));
            }
        }

        return [
            'last_status_messages' => $messages
        ];
    }

    public function backendGetNewMessages($params)
    {
        $id_user = $this->ci->session->userdata('user_id');

        if (!empty($params['contact_id'])) {
            if (empty($params['from_id'])) {
                $params['from_id'] = 0;
            }

            $result['messages'] = $this->getNewMessages($id_user, $params['contact_id'], $params['from_id']);

            $this->checkIsRead($id_user, $params['contact_id']);
        } else {
            $result['messages'] = [];
        }

        return $result;
    }

    public function getNewMessages($id_user, $id_contact, $from_id = null, $from_date_add = [])
    {
        $params['where']['user_id'] = (int)$id_user;
        $params['where']['contact_id'] = (int)$id_contact;
        if ($from_id) {
            $params['where']['id >'] = (int)$from_id;
        }
        if ($from_date_add) {
            $params['where']['date_add >'] = $from_date_add;
        }

        $order_by['id'] = 'DESC';

        $messages = $this->getList($params, 1, 1000, $order_by);

        if ($messages) {
            $messages = $this->formatArray($messages);
        }

        return $messages;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
