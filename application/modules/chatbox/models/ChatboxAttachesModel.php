<?php

declare(strict_types=1);

namespace Pg\modules\chatbox\models;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Messaging Center module
 * Attaches model
 *
 * @package     PG_Dating
 * @subpackage  Chatbox
 * @category    models
 *
 * @copyright   Pilot Group <http://www.pilotgroup.net/>
 * @author      Renat Gabdrakhmanov <renatgab@pilotgroup.eu>
 */
class ChatboxAttachesModel extends \Model
{
    public const MODULE_GID      = 'chatbox';
    public const TABLE           = DB_PREFIX . 'chatbox_attaches';
    public const DB_DATE_FORMAT  = 'Y-m-d H:i:s';
    public const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    protected $fields = [
        'id',
        'message_id',
        'user_id',
        'contact_id',
        'filename',
        'mime',
        'date_added',
    ];

    protected $format_settings  = [];
    protected $image_upload_gid = 'chatbox-image';

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::TABLE);
    }

    protected function getObject($data = [])
    {
        $fields     = $this->fields;
        $fields_str = implode(', ', $fields);

        $this->ci->db->select($fields_str)
            ->from(self::TABLE);

        foreach ($data as $field => $value) {
            $this->ci->db->where($field, $value);
        }

        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    public function getById($id)
    {
        return $this->getObject(['id' => $id]);
    }

    public function save($id = null, $save_raw = [])
    {
        if (is_null($id)) {
            $save_raw['date_added'] = date(self::DB_DATE_FORMAT);
            $this->ci->db->insert(self::TABLE, $save_raw);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(self::TABLE, $save_raw);
        }
        $this->ci->cache->flush(self::TABLE);

        return $id;
    }

    public function updateAttachesMessageId($ids, $message_id = 0)
    {
        if (is_array($ids) && !empty($ids)) {
            $this->ci->db->where_in('id', $ids);
            $this->ci->db->set('message_id', $message_id);
            $this->ci->db->update(self::TABLE);
        }
        $this->ci->cache->flush(self::TABLE);

        return true;
    }

    public function getAttachesByMessageId($message_id)
    {
        $fields     = $this->fields;
        $fields_str = implode(', ', $fields);

        $dbTable = self::TABLE;
        $results =  $this->ci->cache->get(self::TABLE, 'attachesByMessageId' . $message_id, function () use ($message_id, $fields_str, $dbTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields_str)
                ->from($dbTable)
                ->where('message_id', $message_id)
                ->get()
                ->result_array();

            return $result;
        });

        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    protected function getCriteriaInternal($filters)
    {
        $filters = ['data' => $filters, 'table' => self::TABLE, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : self::TABLE;

        $fields = array_flip($this->fields);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (!is_array($filter_data)) {
                $filter_data = trim(/* <bugfix> */strval($filter_data)/* </bugfix> */);
            }
            switch ($filter_name) {
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

    protected function getListInternal($page = null, $limits = null, $order_by = null, $params = [])
    {
        $table      = self::TABLE;
        $fields     = $this->fields;

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
            $page = intval($page) ? intval($page) : 1;
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
            return intval($results[0]['cnt']);
        }

        return 0;
    }

    public function getList($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getListInternal($page, $items_on_page, $order_by, $params);
    }

    public function getListByKey($filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list   = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $key => $item) {
            $return[$item['id']] = $item;
        }

        return $return;
    }

    public function getListByField($field, $filters = [], $page = null, $items_on_page = null, $order_by = null)
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list   = $this->getListInternal($page, $items_on_page, $order_by, $params);
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

    public function validate($id = null, $data = [], $file_name = '')
    {
        $return = ['errors' => [], 'data' => []];

        $attach_limit = $this->ci->pg_module->get_module_config(self::MODULE_GID, 'attach_limit');
        $user_id      = 0;
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
        }

        if (isset($data['id'])) {
            $return['data']['id'] = intval($data['id']);
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (isset($data['user_id'])) {
            $return['data']['user_id'] = intval($data['user_id']) ?: $user_id;
            if (empty($return['data']['user_id'])) {
                // $return['data']['user_id'] = $this->ci->session->userdata('user_id');
                $return['errors'][] = l('error_invalid_sender', self::MODULE_GID);
            }
        }

        if (isset($data['contact_id'])) {
            $return['data']['contact_id'] = intval($data['contact_id']);
            if (empty($return['data']['contact_id'])) {
                $return['errors'][] = l('error_invalid_recipient', self::MODULE_GID);
            } else {
                $attach_count = $this->getCount([
                    'user_id'    => $return['data']['user_id'],
                    'contact_id' => $return['data']['contact_id'],
                    'message_id' => 0,
                ]);
                if ($attach_count + 1 > $attach_limit) {
                    $return['errors'][] = l('error_max_attaches_reached', self::MODULE_GID);
                }
            }
        }

        if (isset($data['message_id'])) {
            $return['data']['message_id'] = intval($data['message_id']);
        }

        if (isset($data['filename'])) {
            $return['data']['filename'] = trim(strip_tags($data['filename']));
        }

        if (!empty($file_name)) {
            if (isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && !($_FILES[$file_name]['error'])) {
                $this->ci->load->model('Uploads_model');
                $file_return = $this->ci->Uploads_model->validateUpload($this->image_upload_gid, $file_name);
                if (!empty($file_return['error'])) {
                    $return['errors'][] = (is_array($file_return['error']))
                        ? implode('<br>', $file_return['error'])
                        : $file_return['error'];
                }
                $return['data']['mime'] = $_FILES[$file_name]['type'];
            } elseif (!empty($_FILES[$file_name]['error'])) {
                $return['errors'][] = $_FILES[$file_name]['error'];
            }
        }

        return $return;
    }

    public function upload($id = null, $save_raw = [], $file_name = '')
    {
        $this->ci->load->model('Uploads_model');
        $upload_return = $this->ci->Uploads_model->upload($this->image_upload_gid, $save_raw['contact_id'] . '/', $file_name);
        if (empty($upload_return['errors'])) {
            $save_raw['filename']  = $upload_return['file'];
            $id                    = $this->save(null, $save_raw);
            $return                = $save_raw;
            $return['id']          = $id;
        } else {
            $return['errors'][] = $upload_return['errors'];
        }
        $this->ci->cache->flush(self::TABLE);

        return $return;
    }

    public function getImageSettings()
    {
        $this->ci->load->model('Uploads_model');

        return $this->ci->Uploads_model->get_config($this->image_upload_gid);
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

        $this->ci->load->model('Uploads_model');

        foreach ($data as $key => $item) {
            $item['format'] = $this->ci->Uploads_model->formatUpload($this->image_upload_gid, $item['contact_id'] . '/', $item['filename']);
            $return[$key]   = $item;
        }

        return $return;
    }

    public function getNotSendAttaches($user_id, $contact_id)
    {
        $attaches = $this->getList([
            'user_id'    => $user_id,
            'contact_id' => $contact_id,
            'message_id' => 0,
        ]);

        if (!empty($attaches)) {
            return $this->formatArray($attaches);
        }

        return $attaches;
    }

    public function getAttachesForMessages($messages_ids = [])
    {
        $return = [];

        $list = $this->getList(['message_id' => $messages_ids]);
        if (!empty($list)) {
            foreach ($list as $item) {
                $return[$item['message_id']][] = $this->format($item);
            }
        }

        return $return;
    }
}
