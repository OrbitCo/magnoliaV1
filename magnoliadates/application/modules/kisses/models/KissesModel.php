<?php

declare(strict_types=1);

namespace Pg\modules\kisses\models;

define('KISSES_TABLE', DB_PREFIX . 'kisses');
define('KISSES_USERS_TABLE', DB_PREFIX . 'kisses_users');

/**
 * Kisses model
 *
 * @package PG_DatingPro
 * @subpackage Kisses
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @developer Andrey Kopaev <akopaev@pilotgroup.net>
 */
class KissesModel extends \Model
{
    public const MODULE_GID = 'kisses';

    /**
     * Table fields kisses
     *
     * @var array
     */
    private $_fields_kisses = [
        'id',
        'image',
        'sorter',
        'date_created',
    ];

    /**
     * Table fields users kisses
     *
     * @var array
     */
    private $_fields_user_kisses = [
        'id',
        'image',
        'user_to',
        'user_from',
        'message',
        'date_created',
        'mark',
    ];

    public $image_upload_gid = 'kisses-file';

    private $upload_config;

    private $moderation_type = "kisses";

    private $kisses_all = null;

    private $new_kisses_count_by_user = [];

    /**
     * Constructor
     *
     * @return Kisses_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('uploads/models/Uploads_config_model');
        $upload_config = $this->ci->Uploads_config_model->get_config_by_gid($this->image_upload_gid);
        $this->upload_config[$this->image_upload_gid] = $this->ci->Uploads_config_model->format_config($upload_config);

        foreach ($this->ci->pg_language->languages as $id => $value) {
            $this->_fields_kisses[] = 'name_' . $value['id'];
        }

        $this->ci->cache->registerService(KISSES_TABLE);
        $this->ci->cache->registerService(KISSES_USERS_TABLE);
    }

    public function getAllKisses()
    {
        if ($this->kisses_all === null) {
            $fields = $this->_fields_kisses;

            $this->kisses_all = $this->ci->cache->get(KISSES_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();
                $results = $ci->db->select(implode(", ", $fields))
                        ->from(KISSES_TABLE)
                        ->order_by('sorter ASC')
                        ->get()->result_array();

                if (empty($results) || !is_array($results)) {
                    return [];
                }

                return $results;
            });
        }

        return $this->kisses_all;
    }

    /**
     * Save kisses
     *
     * @param array   $data
     * @param integer $id
     *
     * @return bool
     */
    public function save($id = null, $data)
    {
        if (is_null($id)) {
            if (empty($data["date_created"])) {
                $data["date_created"] = date(self::DB_DATE_FORMAT);
            }

            $this->ci->db->insert(KISSES_TABLE, $data);
        } else {
            $this->ci->db->where('id', $id)
                    ->update(KISSES_TABLE, $data);
        }

        $this->ci->cache->flush(KISSES_TABLE);

        return true;
    }

    /**
     * Return list kisses
     *
     * @param array   $params
     * @param integer $page
     * @param integer $items_on_page
     * @param array   $order_by
     * @param array   $filter_object_ids
     * @param array   $filter_object_not_ids
     *
     * @return array
     */
    public function getList($page = 1, $items_on_page = 100, $params = [], $order_by = ['sorter' => 'ASC'], $filter_object_ids = null, $filter_object_not_ids = null)
    {
        if (empty($page) && empty($params) && $order_by == ['sorter' => 'ASC']) {
            $results = $this->getAllKisses();

            if (!empty($filter_object_ids)) {
                foreach ($results as $index => $result) {
                    if (!in_array($result['id'], $filter_object_ids)) {
                        unset($results[$index]);
                    }
                }
            }

            if (!empty($filter_object_not_ids)) {
                foreach ($results as $index => $result) {
                    if (in_array($result['id'], $filter_object_not_ids)) {
                        unset($results[$index]);
                    }
                }
            }
        } else {
            $this->ci->db->select(implode(', ', $this->_fields_kisses))->from(KISSES_TABLE);

            if (!empty($params['where']) && is_array($params['where'])) {
                foreach ($params['where'] as $field => $value) {
                    $this->ci->db->where($field, $value);
                }
            }

            if (!empty($params['where_in']) && is_array($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
                }
            }

            if (!empty($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
                foreach ($params['where_sql'] as $value) {
                    $this->ci->db->where($value, null, false);
                }
            }

            if (is_array($filter_object_ids) && count($filter_object_ids)) {
                $this->ci->db->where_in('id', $filter_object_ids);
            }

            if (is_array($filter_object_not_ids) && count($filter_object_not_ids)) {
                $this->ci->db->where_not_in('id', $filter_object_not_ids);
            }

            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->_fields_kisses)) {
                        $this->ci->db->order_by($field . ' ' . $dir);
                    }
                }
            }

            if (!empty($page) && $items_on_page > 0) {
                $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
            }

            $results = $this->ci->db->get()->result_array();
        }

        return $results;
    }

    /**
     * Return number of kisses
     *
     * @param array $params
     *
     * @return array
     */
    public function getCount($params = [])
    {
        if (empty($params)) {
            return count($this->getAllKisses());
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
        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        return $this->ci->db->count_all_results(KISSES_TABLE);
    }

    public function format($kisses)
    {
        return $kisses;
    }

    private function getUploadGid($file_name)
    {
        $array = explode('.', $file_name);
        $extension = strtolower(end($array));
        $result = '';

        foreach ($this->upload_config as $upload_gid => $upload_config) {
            foreach ($upload_config['file_formats'] as $file_format) {
                if ($file_format == $extension) {
                    $result = $upload_gid;

                    break 2;
                }
            }
        }

        return $result;
    }

    /**
     * Method validate data
     *
     * @var
     * @var
     * return error or succes
     */
    public function validate($file_name)
    {
        if (isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && !($_FILES[$file_name]["error"])) {
            $upload_gid = $this->getUploadGid($_FILES[$file_name]['name']);

            if ($upload_gid == $this->image_upload_gid) {
                $this->ci->load->model("Uploads_model");
                $file_return = $this->ci->Uploads_model->validate_upload($this->image_upload_gid, $file_name);

                if (!empty($file_return["error"])) {
                    $validate_data["errors"][] = $file_return["error"][0];
                }
            } else {
                $validate_data["errors"][] = l('error_invalid_file_type', 'kisses');
            }

            $validate_data["data"]['mime'] = $_FILES[$file_name]["type"];
        } elseif (!empty($_FILES[$file_name]["error"])) {
            $validate_data["errors"][] = $_FILES[$file_name]["error"];
        }

        return $validate_data;
    }

    /**
     * Method upload and save files
     *
     * @var
     * @var
     * return error or succes
     */
    public function postUpload($file_name)
    {
        $result = [];
        $data = [];

        $this->ci->load->model('Uploads_model');
        $upload_return = $this->ci->Uploads_model->upload($this->image_upload_gid, '', $file_name);

        if (empty($upload_return['errors'])) {
            $data['image'] = $upload_return['file'];
            $data['date_created'] = date("Y-m-d H:i:s");
            $result['name'] = $upload_return['file'];
        } else {
            $result['errors'][] = $upload_return["errors"];

            return $result;
        }
        $result['is_saved'] = $this->saveKissesInternal($data, []);

        return $result;
    }

    /**
     * Method upload and save files
     *
     * @var
     * @var
     * return error or succes
     */
    private function saveKissesInternal($attrs, $where = [])
    {
        if (!empty($where) && is_array($where)) {
            $this->ci->db->where($where)->update(KISSES_TABLE, $attrs);

            $this->ci->cache->flush(KISSES_TABLE);

            return $this->ci->db->affected_rows();
        }
        $this->ci->db->insert(KISSES_TABLE, $attrs);
        $return = $this->ci->db->insert_id();

        $this->ci->db->set('sorter', 'sorter + 1', false);
        $this->ci->db->update(KISSES_TABLE);

        $this->ci->cache->flush(KISSES_TABLE);

        return $return;
    }

    /**
     * Method deleted kisses files
     *
     * @var integer kisses id
     *              return string
     */
    public function deleteKisses($kisses_id)
    {
        $result = [];

        $kisses = $this->get_kisses_by_id($kisses_id);
        if (!$kisses) {
            return false;
        }

        $this->ci->db->where('id', $kisses['id']);
        $this->ci->db->delete(KISSES_TABLE);
        $this->ci->load->model('Uploads_model');
        $result = $this->ci->Uploads_model->delete_upload($this->image_upload_gid, '', $kisses['image']);

        $this->ci->cache->flush(KISSES_TABLE);

        return true;
    }

    /**
     * Method return info about kisses record
     *
     * @var integer kisses id
     *              return array
     */
    public function getKissesById($kisses_id)
    {
        $kisses_raw = $this->getAllKisses();

        foreach ($kisses_raw as $kiss_raw) {
            if ($kiss_raw['id'] == $kisses_id) {
                return $kiss_raw;
            }
        }

        return [];
    }

    /**
     * Install wish list fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(KISSES_TABLE, [
            'name_' . $lang_id => [
                'type' => 'TEXT',
                'null' => true
            ]
        ]);
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(KISSES_TABLE);
        }

        $this->ci->cache->flush(KISSES_TABLE);
    }

    /**
     * Uninstall wish list fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(KISSES_TABLE);

        $fields = ['name_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(KISSES_TABLE, $field_name);
        }

        $this->ci->cache->flush(KISSES_TABLE);
    }

    /**
     * Validate kisses object for saving to data source
     *
     * @param integer $kisses_id wish list identifier
     * @param array   $data      kisses data
     *
     * @return array
     */
    public function validateKisses($kisses_id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['id'])) {
            $return['data']['id'] = intval($data['id']);
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (!$data['object_id']) {
            $return['errors'][] = l('error_invalid_user_to', 'kisses');
        } else {
            $return['data']['object_id'] = $data['object_id'];
        }

        $kisses = $this->get_kisses_by_id($kisses_id);

        if (empty($kisses)) {
            $return['errors'][] = l('error_empty_record', 'kisses');
        } else {
            $return['data']['kisses'] = $kisses;
        }

        if (!empty($data['message'])) {
            $return['data']['message'] = mb_substr((string)$data['message'], 0, (int)$this->ci->pg_module->get_module_config('kisses', 'number_max_symbols'), 'UTF-8');
            $this->ci->load->model('moderation/models/Moderation_badwords_model');
            $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']['message']);
            if ($bw_count) {
                $return["errors"][] = l('error_badwords_message', 'kisses');
            }
        }

        if (isset($data['date_created'])) {
            $value = strtotime($data['date_created']);
            if ($value > 0) {
                $return['data']['date_created'] = date('Y-m-d', $value);
            }
        }

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        if (isset($data['name_' . $default_lang_id])) {
            $return['data']['name_' . $default_lang_id] = trim(strip_tags($data['name_' . $default_lang_id]));
            if (empty($return['data']['name_' . $default_lang_id])) {
                $return['errors'][] = l('error_empty_kisses_name', 'kisses');
            } else {
                foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                    if ($lid == $default_lang_id) {
                        continue;
                    }
                    if (!isset($data['name_' . $lid]) || empty($data['name_' . $lid])) {
                        $return['data']['name_' . $lid] = $return['data']['name_' . $default_lang_id];
                    } else {
                        $return['data']['name_' . $lid] = trim(strip_tags($data['name_' . $lid]));
                        if (empty($return['data']['name_' . $lid])) {
                            $return['errors'][] = l('error_empty_kisses_name', 'kisses');

                            break;
                        }
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Save kisses object to data source
     *
     * @param integer $kisses_id wish list identifier
     * @param array   $data      wish list data
     *
     * @return integer
     */
    public function saveKisses($kisses_id, $data)
    {
        $this->ci->db->where('id', $kisses_id);
        $this->ci->db->update(KISSES_TABLE, $data);

        $this->ci->cache->flush(KISSES_TABLE);

        return $kisses_id;
    }

    /**
     * Save kisses object to data source from user
     *
     * @param integer $kisses_id wish list identifier
     * @param array   $data      wish list data
     *
     * @return integer
     */
    public function saveUserKisses($data)
    {
        $this->ci->load->library('Analytics');
        $event = $this->ci->analytics->getEvent('kisses', 'engaged', 'user');
        $this->ci->analytics->track($event);

        $data['date_created'] = date("Y-m-d H:i:s");

        $this->ci->db->insert(KISSES_USERS_TABLE, $data);

        return $this->ci->db->insert_id();
    }

    /**
     * Return number of new kisses for user
     *
     * @param integer $id_user user identifier
     *
     * @return integer
     */
    public function newKissesCount($id_user = null)
    {
        if (!$id_user) {
            $id_user = (int)$this->ci->session->userdata("user_id");
        }

        if (!isset($this->new_kisses_count_by_user[$id_user])) {
            if ($this->ci->session->userdata('auth_type') == 'user') {
                $this->ci->load->model('Blacklist_model');

                if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($id_user, true)) {
                    $this->ci->db->where_not_in("user_from", $blocked_ids);
                }
            }

            $this->ci->db->select('COUNT(id) AS cnt')
                 ->from(KISSES_USERS_TABLE)
                 ->where('user_to', $id_user)
                 ->where('mark', 0);

            $results = $this->ci->db->get()->result_array();
            $this->new_kisses_count_by_user[$id_user] = (!empty($results) && is_array($results)) ? $results[0]["cnt"] : 0;
        }

        return $this->new_kisses_count_by_user[$id_user];
    }

    /**
     * Return number of new kisses for user
     *
     * @return array
     */
    public function backendKissesCount()
    {
        $id_user = $this->ci->session->userdata('user_id');
        $kisses_count = $this->newKissesCount($id_user);

        return ['count' => $kisses_count];
    }

    /**
     * Return list kisses
     *
     * @param array   $params
     * @param integer $page
     * @param integer $items_on_page
     * @param array   $order_by
     * @param array   $filter_object_ids
     *
     * @return array
     */
    public function getListUserKisses($params = [], $page = 1, $items_on_page = 20, $order_by = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("user_from", $blocked_ids);
                $this->ci->db->where_not_in("user_to", $blocked_ids);
            }
        }

        $this->ci->db->select(implode(', ', $this->_fields_user_kisses))->from(KISSES_USERS_TABLE);

        if (!empty($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->_fields_user_kisses)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        $page = intval($page);
        if (!empty($page)) {
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();

        return $results;
    }

    /**
     * Return number of kisses for user
     *
     * @param array $params
     *
     * @return array
     */
    public function getCountKissesUsers($params = [])
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("user_from", $blocked_ids);
                $this->ci->db->where_not_in("user_to", $blocked_ids);
            }
        }

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        return $this->ci->db->count_all_results(KISSES_USERS_TABLE);
    }

    /**
     * Mark as read
     *
     * @param integer $kisses_id id record
     * @param array   $data
     *
     * @return array
     */
    public function markAsRead($kisses_ids)
    {
        $this->ci->db->where_in('id', $kisses_ids);
        $this->ci->db->update(KISSES_USERS_TABLE, ['mark' => 1]);
    }

    /**
     * Save position on page
     *
     * @param integer $page_id id record
     * @param array   $data
     *
     * @return integer
     */
    public function savePage($page_id, $attrs)
    {
        $this->ci->db->where('id', $page_id);
        $this->ci->db->update(KISSES_TABLE, $attrs);

        $this->ci->cache->flush(KISSES_TABLE);

        return $page_id;
    }

    /**
     *  Module category action
     *
     *  @return array
     */
    public function moduleCategoryAction()
    {
        $action = [
            'name'     => l('kiss', 'kisses'),
            'helper'   => 'kisses_list',
        ];

        return $action;
    }

    public function validateSettings($data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['admin_items_per_page'])) {
            $return['data']['admin_items_per_page'] = intval($data['admin_items_per_page']);
            if ($return['data']['admin_items_per_page'] <= 0) {
                $return['errors'][] = l("error_admin_items_per_page", "kisses");
            }
        }

        if (isset($data['items_per_page'])) {
            $return['data']['items_per_page'] = intval($data['items_per_page']);
            if ($return['data']['items_per_page'] <= 0) {
                $return['errors'][] = l("error_items_per_page", "kisses");
            }
        }

        if (isset($data['system_settings_page'])) {
            $return['data']['system_settings_page'] = $data['system_settings_page'] ? 1 : 0;
        }

        if (isset($data['number_max_symbols'])) {
            $return['data']['number_max_symbols'] = intval($data['number_max_symbols']);
            if ($return['data']['number_max_symbols'] <= 0) {
                $return['errors'][] = l("error_number_max_symbols", "kisses");
            }
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_mark_as_read' => 'markAsRead',
            '_post_upload' => 'postUpload',
            'backend_kisses_count' => 'backendKissesCount',
            'delete_kisses' => 'deleteKisses',
            'get_count' => 'getCount',
            'get_count_kisses_users' => 'getCountKissesUsers',
            'get_kisses_by_id' => 'getKissesById',
            'get_list' => 'getList',
            'get_list_user_kisses' => 'getListUserKisses',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'new_kisses_count' => 'newKissesCount',
            'save_kisses' => 'saveKisses',
            'save_page' => 'savePage',
            'save_user_kisses' => 'saveUserKisses',
            'validate_kisses' => 'validateKisses',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
