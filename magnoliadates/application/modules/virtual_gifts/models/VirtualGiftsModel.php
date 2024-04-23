<?php

declare(strict_types=1);

namespace Pg\modules\virtual_gifts\models;

use Pg\Libraries\Analytics;
use Pg\modules\users\models\UsersModel;

define("VIRTUAL_GIFTS_TABLE", DB_PREFIX . "virtual_gifts");
define("VIRTUAL_GIFTS_USERS_TABLE", DB_PREFIX . "virtual_gifts_users");

/**
 * VirtualGifts main model
 *
 * @package     PG_Dating
 * @subpackage  VirtualGifts
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      DATING PRO LTD <http://www.pilotgroup.net/>
 */
class VirtualGiftsModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    public const MODULE_GID = 'virtual_gifts';

    public const UPLOAD_GID = 'virtual-gifts';

    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * VirtualGifts object properties
     *
     * @var array
     */
    protected $fields = [
        VIRTUAL_GIFTS_TABLE => [
            'id',
            'img',
            'is_special_price',
            'price',
            'fk_currency_gid',
            'priority',
            'is_active',
            'created_date'
        ],
        VIRTUAL_GIFTS_USERS_TABLE => [
            'id',
            'fk_user_id',
            'fk_sender_id',
            'gift_id',
            'is_new',
            'img',
            'img_thumb',
            'is_private',
            'comment',
            'status',
            'receipt_date'
        ]
    ];
    public $file_config_gid = "virtual-gifts";
    protected $fields_priority = ["id", "priority"];

    /**
     * Settings for formatting virtual_gifts object
     *
     * @var array
     */
    protected $format_settings = [
        'get_gift' => false,
        'get_user' => false,
        'get_sender' => true
    ];

    /**
     * Return virtual_gifts object by idnetifier
     *
     * @param string $field_name  field name
     * @param mixed  $field_value field value
     * @param array  $langs_ids   languages' idnetifiers
     *
     * @return array/false
     */
    private function getVirtualGiftsObject($field_name, $field_value, $langs_ids = null)
    {
        if (empty($langs_ids)) {
            $langs_ids = [$this->ci->pg_language->current_lang_id];
        }

        $fields = $this->fields[VIRTUAL_GIFTS_TABLE];
        $fields = implode(', ', $fields);

        $results = $this->ci->db->select($fields)
            ->from(VIRTUAL_GIFTS_TABLE)
            ->where($field_name, $field_value)
            ->get()
            ->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    /**
     * Return virtual_gifts object by idnetifier
     *
     * @param integer $virtual_gifts_id virtual_gifts identifier
     * @param array   $langs_ids        languages' identifiers
     *
     * @return array/false
     */
    public function getVirtualGiftsById($virtual_gifts_id, $langs_ids = null)
    {
        $gift = $this->getVirtualGiftsObject('id', $virtual_gifts_id, $langs_ids);
        $gift = $this->formatVirtualGifts([$gift]);

        return $gift[0];
    }

    /**
     * Return virtual_gifts object by guid
     *
     * @param string $virtual_gifts_gid virtual_gifts guid
     * @param array  $langs_ids         languages' identifiers
     *
     * @return array/false
     */
    public function getVirtualGiftsByGid($virtual_gifts_gid, $langs_ids = null)
    {
        return $this->getVirtualGiftsObject('gid', $virtual_gifts_gid, $langs_ids);
    }

    /**
     * Return sql criteria for searching virtual_gifts as array
     *
     * @param array $filter filters data
     *
     * @return array
     */
    public function getVirtualGiftsCriteria($filter)
    {
        $filters = ['data' => $filter, 'table' => VIRTUAL_GIFTS_TABLE, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : VIRTUAL_GIFTS_TABLE;

        $fields = array_flip($this->fields[VIRTUAL_GIFTS_TABLE]);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (is_string($filter_data) !== false) {
                $filter_data = trim($filter_data);
            }
            switch ($filter_name) {
                case 'ids': {
                    if (empty($filter_data)) {
                        break;
                    }
                        $params = array_merge_recursive($params, ['where_in' => ['id' => $filter_data]]);

                    break;
                }
                default: {
                    if (isset($fields[$filter_name])) {
                        if (is_array($filter_data)) {
                            $params = array_merge_recursive(
                                $params,
                                ['where_in' => [$filter_name => $filter_data]]
                            );
                        } else {
                            $params = array_merge_recursive(
                                $params,
                                ['where' => [$filter_name => $filter_data]]
                            );
                        }
                    }

                    break;
                }
            }
        }

        return $params;
    }

    /**
     * Return virtual_gifts object from data source as array
     *
     * @param integer $page     page of results
     * @param string  $limits   results per page
     * @param array   $order_by sorting data
     * @param array   $params   sql criteria
     * @param array   $lang_ids languages' identifiers
     *
     * @return array
     */
    protected function getVirtualGiftsListInternal($page = null, $limits = null, $order_by = null, $params = [], $lang_ids = null)
    {
        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        $table = VIRTUAL_GIFTS_TABLE;

        if (isset($params['table']) && $params['table'] != $table) {
            $table = $params['table'];
        }

        $fields = $this->fields[$table];

        $fields = implode(', ', $fields);

        $this->ci->db->select($fields);
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

        if (isset($params['where_sql'])) {
            if (!is_array($params['where_sql'])) {
                $params['where_sql'] = [$params['where_sql']];
            }
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (isset($params['limit'])) {
            $params['limit'] = intval($params['limit']);
            if (!empty($params['limit'])) {
                $this->ci->db->limit($params['limit']);
            }
        }
        // order by todo properly

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();

        $results = $this->formatVirtualGifts($results);

        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    /**
     * Return number of virtual_gifts in data source
     *
     * @param array $params sql criteria
     *
     * @return integer
     */
    protected function getVirtualGiftsCountInternal($params = null)
    {
        $table = isset($params['table']) ? $params['table'] : VIRTUAL_GIFTS_TABLE;

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

    /**
     * Return filtered virtual_gifts objects from data source as array
     *
     * @param array   $filters       filters data
     * @param integer $page          page of results
     * @param integer $items_on_page results per page
     * @param string  $order_by      sorting data
     * @param array   $langs_ids     languages' identifier
     *
     * @return array
     */
    public function getVirtualGiftsList($filters = [], $page = null, $items_on_page = null, $order_by = null, $langs_ids
                              = null, $params = [])
    {
        $params = $this->getVirtualGiftsCriteria($filters);
        $gifts  = $this->getVirtualGiftsListInternal($page, $items_on_page, $order_by, $params, $langs_ids);

        return $this->formatGiftsPriorities($gifts);
    }

    /**
     * Return number of filtered virtual_gifts objects in data source
     *
     * @param array $filters filters data
     *
     * @return array
     */
    public function getVirtualGiftsCount($filters = [])
    {
        $params = $this->getVirtualGiftsCriteria($filters);

        return $this->getVirtualGiftsCountInternal($params);
    }

    /**
     * Change settings for formatting virtual_gifts object
     *
     * @param string $name  parameter name
     * @param mixed  $value parameter value
     *
     * @return void
     */
    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    /**
     * Format data of virtual_gifts object
     *
     * @param array $virtual_gifts_data virtual_gifts data
     *
     * @return array
     */
    public function formatVirtualGifts($virtual_gifts_data)
    {
        $this->ci->load->model("Uploads_model");

        foreach ($virtual_gifts_data as &$gift) {
            if (!empty($gift["img"]) && empty($gift["img_thumb"])) {
                $img_path          = substr(str_replace("-", "/", $gift["created_date"]), 0, 10) . "/" . $gift["id"];
                $gift["mediafile"] = $this->ci->Uploads_model->formatUpload($this->file_config_gid, $img_path, $gift["img"]);
            } elseif (!empty($gift["img_thumb"])) {
                $gift["img"]       = SITE_VIRTUAL_PATH . $gift["img"];
                $gift["img_thumb"] = SITE_VIRTUAL_PATH . $gift["img_thumb"];
            }
        }

        return $virtual_gifts_data;
    }

    /**
     * Format data of virtual_gifts' objects
     *
     * @param array $virtual_gifts_arr virtual_gifts' data
     * @param array $languages_ids     languages' identifiers
     *
     * @return array
     */
    public function formatVirtualGiftsArr($virtual_gifts_arr, $languages_ids = null)
    {
        $result = [];

        foreach ($virtual_gifts_arr as $virtual_gifts) {
            $result[$virtual_gifts['id']] = $virtual_gifts;
        }

        return $result;
    }

    // TODO: метод делает то же что и предыдущий. подобыне методы вынести в utils
    public function convertToListByIds($data)
    {
        $data_by_ids = [];

        foreach ($data as $value) {
            $data_by_ids[$value['id']] = $value;
        }

        return $data_by_ids;
    }

    public function formatUserGiftList($gifts_data = [])
    {
        $gift_ids     = [];
        $user_ids     = [];

        foreach ($gifts_data as $gift) {
            $gift_ids[]   = $gift['gift_id'];
            $user_ids[]   = $gift['fk_user_id'];
            $user_ids[] = $gift["fk_sender_id"];
        }

        if (!empty($gift_ids) && $this->format_settings['get_gift']) {
            $gifts = $this->convertToListByIds(
                $this->getVirtualGiftsList(['ids' => array_unique($gift_ids)])
            );
            foreach ($gifts_data as &$gift) {
                if (isset($gifts[$gift['id']])) {
                    $gift['gift_is_special_price'] = $gifts[$gift['id']]['is_special_price'];
                    $gift['gift_price']            = $gifts[$gift['id']]['price'];
                }
            }
        }

        if (!empty($user_ids) && ($this->format_settings['get_user'] || $this->format_settings['get_sender'])) {
            $this->ci->load->model(['Users_model', 'users/models/Users_deleted_model']);

            $user_ids = array_unique($user_ids);

            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [
                "where_in" => ["id" => $user_ids],
            ]);
            $default_user     = $this->ci->Users_model->formatDefaultUser(1);
            $deleted_users = $this->ci->Users_deleted_model->getUsersList(null, null, null, [
                'where_in' => ['id_user' => $user_ids],
            ]);

            foreach ($user_ids as $uid) {
                if (!isset($users[$uid]['id'])) {
                    $users[$uid] = $default_user;
                    foreach ($deleted_users as $deleted_user) {
                        if ($uid == $deleted_user['id_user']) {
                            $users[$uid] = array_merge($users[$uid], $deleted_user);

                            break;
                        }
                    }
                }
            }

            foreach ($gifts_data as &$gift) {
                if (isset($users[$gift["fk_user_id"]])) {
                    $gift["user_name"]  = $users[$gift["fk_user_id"]]["output_name"];
                    $gift["user_fname"] = $users[$gift["fk_user_id"]]["fname"];
                    $gift["user_thumb"] = $users[$gift["fk_user_id"]]["media"]["user_logo"]["thumbs"]["small"];
                }

                if (isset($users[$gift["fk_sender_id"]])) {
                    $gift["sender_name"]  = $users[$gift["fk_sender_id"]]["output_name"];
                    $gift["sender_fname"] = $users[$gift["fk_sender_id"]]["fname"];
                    $gift["sender_thumb"] = $users[$gift["fk_sender_id"]]["media"]["user_logo"]["thumbs"]["small"];
                }
            }
        }

        return $gifts_data;
    }

    /**
     * Validate virtual_gifts object for saving to data source
     *
     * @param integer $virtual_gifts_id virtual_gifts identifier
     * @param array   $virtual_gifts    virtual_gifts data
     *
     * @return array
     */
    public function validateVirtualGifts($virtual_gifts_id, $virtual_gifts)
    {
        $return = ['errors' => [], 'data' => [], 'services_data' => []];

        if (isset($virtual_gifts['id'])) {
            $return['data']['id'] = intval($virtual_gifts['id']);
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (isset($virtual_gifts['gid'])) {
            $return['data']['gid'] = strip_tags($virtual_gifts['gid']);
            $return['data']['gid'] = preg_replace("/[^a-z0-9\-_]+/i", '', $return['data']['gid']);
            if (empty($return['data']['gid'])) {
                $return['errors'][] = l('error_gid_empty', self::MODULE_GID);
            } elseif (strlen($return['data']['gid']) > 50) {
                $return['errors'][] = l('error_gid_length', self::MODULE_GID);
            } else {
                if ($virtual_gifts['gid'] !== $return['data']['gid']) {
                    $return['info']['gid'] = l('info_gid_filtered', self::MODULE_GID);
                }
                $param['where']['gid'] = $return['data']['gid'];
                if ($virtual_gifts_id) {
                    $param['where']['id <>'] = $virtual_gifts_id;
                }
                $gid_counts = $this->getVirtualGiftsCountInternal($param);
                if ($gid_counts > 0) {
                    $return['errors'][] = l('error_gid_exists', self::MODULE_GID);
                }
            }
        }

        if (isset($virtual_gifts['date_created'])) {
            $value = strtotime($virtual_gifts['date_created']);
            if ($value) {
                $return['data']['date_created'] = date('Y-m-d H:i:s');
            } else {
                $return['data']['date_created'] = '0000-00-00 00:00:00';
            }
        }

        return $return;
    }

    public function getSettings()
    {
        $data = [
            "price_default" => $this->ci->pg_module->get_module_config('virtual_gifts', 'price_default'),
            "admin_items_per_page" => $this->ci->pg_module->get_module_config('virtual_gifts', 'admin_items_per_page'),
            "user_items_per_page" => $this->ci->pg_module->get_module_config('virtual_gifts', 'user_items_per_page'),
            "payment_type" => $this->ci->pg_module->get_module_config('virtual_gifts', 'payment_type'),
        ];

        return $data;
    }

    public function setSettings($data)
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('virtual_gifts', $setting, $value);
        }

    }

    /**
     * Validates payment data
     *
     * @param type $data
     *
     * @return type
     */
    public function validatePaymentData($data)
    {
        $return = ['errors' => [], 'data' => []];

        $comment = trim(strip_tags($data['comment']));
        if (strlen($comment) > 130) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["comment"] = $comment;
        }

        $return["data"]["is_private"] = intval($data["is_private"]);

        $sender_id = intval($data["sender_id"]);
        if (empty($sender_id)) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["sender_id"] = $sender_id;
        }

        $gift_id = intval($data["gift_id"]);
        if (empty($gift_id)) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $gift_data = $this->getVirtualGiftsById($gift_id);
            if (empty($gift_data) || empty($gift_data["is_active"])) {
                $return['errors'][] = l('error_payment', 'virtual_gifts');
            } else {
                $return["data"]["price"]     = $gift_data["price"];
                $return["data"]["gift_id"]   = $gift_data["id"];
                $return["data"]["gift_data"] = $gift_data;
            }
        }

        return $return;
    }

    public function accountPayment($id_sender, $price, $payment_data)
    {
        if ($this->ci->pg_module->is_module_installed('users_payments')) {
            $this->ci->load->model("Users_payments_model");

            $message = l('gifts_payment_name', self::MODULE_GID);

            $is_paid = $this->ci->Users_payments_model->writeOffUserAccount(
                $id_sender,
                $price,
                $message,
                self::MODULE_GID,
                ['lang' => 'payment_stat_virtual_gift', 'module' => self::MODULE_GID]
            );
            if ($is_paid === true) {
                $this->paymentServiceStatus($payment_data, 1);

                $this->ci->load->library('Analytics');
                $event = $this->ci->analytics->getEvent('payments', 'purchase_virtual_gift', 'user');
                $this->ci->analytics->track($event);

                return true;
            }
        }

        return false;
    }

    public function systemPayment($system_gid, $id_user, $payment_data, $price)
    {
        $this->ci->load->model("payments/models/Payment_currency_model");
        $currency_gid               = $this->ci->Payment_currency_model->default_currency["gid"];
        $payment_data["name"]       = l('gifts_payment_name', 'virtual_gifts');
        $payment_data["my_comment"] = $payment_data["comment"];
        $payment_data["comment"]    = l('gifts_payment_name', 'virtual_gifts');
        $payment_data["lang"]       = 'gifts_payment_name';
        $payment_data["module"]     = 'virtual_gifts';
        $this->ci->load->helper('payments');
        $result = send_payment('virtual_gifts', $id_user, $price, $currency_gid, $system_gid, $payment_data, true);
        if (empty($result['errors'])) {
            $this->ci->load->library('Analytics');
            $event = $this->ci->analytics->getEvent('payments', 'purchase_virtual_gift', 'user');
            $this->ci->analytics->track($event);
        }

        return $result;
    }

    // callback method for payment module
    public function paymentServiceStatus($payment_data, $payment_status)
    {
        if ($payment_status != 1) {
            return;
        }

        if (!isset($payment_data["gift_data"])) {
            $payment_data = $payment_data["payment_data"];
        }

        $site_url = base_url();
        $site_url_length  =  strlen($site_url);

        $gift_data = $payment_data["gift_data"];

        $this->ci->load->model(["Users_model", "Uploads_model", "Notifications_model"]);

        $img_path = substr(str_replace("-", "/", $gift_data["created_date"]), 0, 10) . "/" . $gift_data["id"];
        $image_info = $this->ci->Uploads_model->formatUpload($this->file_config_gid, $img_path, $gift_data["img"]);

        if (array_key_exists('my_comment', $payment_data)) {
            $comment = $payment_data['my_comment'];
        } else {
            $comment = $payment_data['comment'];
        }

        $this->saveUserGift([
            'gift_id' => $gift_data["id"],
            'img_path' => substr($image_info["file_url"], $site_url_length),
            'img_thumb' => substr($image_info["thumbs_data"]["big"]["file_url"], $site_url_length),
            'receiver_id' => $payment_data["user_id"],
            'sender_id' => $payment_data["sender_id"],
            'comment' => $comment,
            'is_private' => $payment_data['is_private'],
            'is_new' => 1,
            'status' => 'pending',
        ]);

        $receiver = $this->ci->Users_model->getUserById($payment_data["user_id"]);
        $sender   = $this->ci->Users_model->getUserById($payment_data["sender_id"], true);

        $alert = [
            'gift_icon_link' => $image_info["file_url"],
            'user_nickname' => UsersModel::formatUserName($sender),
            'profile_nickname' => UsersModel::formatUserName($receiver),
            'link_1' => $sender['link'],
            'link_2' => $site_url,
            'image' => $sender['media']['user_logo']['thumbs']['middle']
        ];

        $this->ci->Notifications_model->sendNotification(
            $receiver['email'],
            'virtual_gifts',
            $alert,
            '',
            $receiver['lang_id']
        );
    }

    /**
     * Return backend notifications
     */
    public function backendGetRequestNotifications()
    {
        $user_id = $this->ci->session->userdata('user_id');
        $params = [];
        $params['where']['fk_user_id'] = $user_id;
        $params['where']['is_new'] = 1;
        $new_gifts = $this->formatUserGiftList(
            $this->getUserGiftsList($user_id, true, $params)
        );
        $result = ['notifications' => [], 'inbox_new_message' => 0];
        foreach ($new_gifts as $gift) {
            $result['notifications'][] = [
                'title' => l('user_notify_title', 'virtual_gifts'),
                'text' => l('gift_receipt_from_user', 'virtual_gifts') . ' ' . $gift['sender_name'],
                'id' => $gift['id'],
                'comment' => $gift["comment"],
                'user_id' => $gift['fk_sender_id'],
                'user_name' => $gift['sender_name'],
                'user_icon' => $gift['sender_thumb'],
                'user_link' => rewrite_link('users', 'view', $gift['fk_sender_id']),
                'more' => 'more',
            ];
        }
        $this->ci->db->set('is_new', '0')->where($params['where'])->update(VIRTUAL_GIFTS_USERS_TABLE);

        $result['inbox_new_message'] = 1;

        return $result;
    }

    /**
     * Returns an array of validated settings
     *
     * @param type $data
     */
    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["price_default"])) {
            $return["data"]["price_default"] = number_format(floatval($data["price_default"]), 2);
            if (empty($return["data"]["price_default"]) || $return["data"]["price_default"] < 0) {
                $return["errors"][] = l('error_price', 'virtual_gifts');

                return $return;
            }
        }

        if (isset($data["admin_items_per_page"])) {
            $return["data"]["admin_items_per_page"] = intval($data["admin_items_per_page"]);
            if (empty($return["data"]["admin_items_per_page"]) || $return["data"]["admin_items_per_page"] <= 0) {
                $return["errors"][] = l('error_admin_items_per_page', 'virtual_gifts');

                return $return;
            }
        }

        if (isset($data["user_items_per_page"])) {
            $return["data"]["user_items_per_page"] = intval($data["user_items_per_page"]);
            if (empty($return["data"]["user_items_per_page"]) || $return["data"]["user_items_per_page"] <= 0) {
                $return["errors"][] = l('error_user_items_per_page', 'virtual_gifts');

                return $return;
            }
        }

        if (isset($data["payment_type"])) {
            switch ($data["payment_type"]) {
                case 'account': {
                        $return["data"]["payment_type"] = 'account';

                        break;
                }
                case 'direct': {
                        $return["data"]["payment_type"] = 'direct';

                        break;
                }
                case 'account_and_direct': {
                        $return["data"]["payment_type"] = 'account_and_direct';

                        break;
                }
                default: {
                        $return["errors"][] = l('error_paytype', 'virtual_gifts');
                }
            }
        }

        return $return;
    }

    /**
     * Sort gifts
     *
     * @param type $id
     * @param type $direction
     */
    public function setSortGift($id, $direction)
    {
        $data_priority = $this->get_gift_priority_by_id($id);

        if ($direction === 'up') {
            $params["where_sql"][]          = " priority<'" . $data_priority['priority'] . "' AND priority>0 ";
            $params["order_by"]["priority"] = " DESC ";
        } elseif ($direction === 'down') {
            $params["where_sql"][]          = " priority>'" . $data_priority['priority'] . "' ";
            $params["order_by"]["priority"] = " ASC ";
        } else {
            return;
        }
        $data_previous_priority = $this->getPreviousPriority($params);
        if (!empty($data_previous_priority['id'])) {
            $attrs['priority'] = $data_priority['priority'];
            $this->setPriority($data_previous_priority['id'], $attrs);
            $attrs['priority'] = $data_previous_priority['priority'];
            $this->setPriority($data_priority['id'], $attrs);
        }

    }

    private function getGiftPriorityById($gift_id)
    {
        $result = $this->ci->db->select(implode(", ", $this->fields_priority))
                ->from(VIRTUAL_GIFTS_TABLE)
                ->where("id", $gift_id)
                ->get()->result_array();
        if (empty($result)) {
            return false;
        }

        return $result[0];
    }

    private function getPreviousPriority($params = [])
    {
        $this->ci->db->select(implode(", ", $this->fields_priority));
        $this->ci->db->from(VIRTUAL_GIFTS_TABLE);

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        if (isset($params["order_by"]) && is_array($params["order_by"]) && count($params["order_by"])) {
            foreach ($params["order_by"] as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }
        $results = $this->ci->db->get()->result_array();

        return $results[0];
    }

    public function getLastPriority($add = 0)
    {
        $result = $this->ci->db->select('MAX(priority) AS max_priority')->from(VIRTUAL_GIFTS_TABLE)->get()->result_array();
        foreach ($result as $row) {
            $return = intval($row['max_priority']) + $add;
        }

        return $return;
    }

    public function getFirstPriority()
    {
        $result = $this->ci->db->select('MIN(priority) AS min_priority')->from(VIRTUAL_GIFTS_TABLE)->get()->result_array();

        return $result[0]['min_priority'];
    }

    private function setPriority($id = null, $attrs = [])
    {
        if (!empty($id)) {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(VIRTUAL_GIFTS_TABLE, $attrs);
        }

    }

    /**
     * Format gifts list
     *
     * TODO: move to format method
     *
     * @param type $data
     */
    public function formatGiftsPriorities($data)
    {
        foreach ($data as &$gift) {
            if ($gift["priority"] == $this->get_first_priority()) {
                $gift["sort"]["first"] = 1;
            }
            if ($gift["priority"] == $this->get_last_priority(0)) {
                $gift["sort"]["last"] = 1;
            }
        }

        return $data;
    }

    /**
     * Update gift's price
     *
     * @param type $id
     * @param type $price
     */
    public function updateGiftPrice($id = null, $price = null)
    {
        if (!empty($id)) {
            $gift_data          = $this->getVirtualGiftsById($id);
            $gift_data["price"] = $price;
            if (isset($gift_data["mediafile"])) {
                unset($gift_data["mediafile"]);
            }
            unset($gift_data["id"]);

            return $this->saveVirtualGifts($id, $gift_data);
        }
    }

    /**
     * Update gift status
     *
     * @param type $gift_id
     * @param type $status
     *
     * @return type
     */
    public function update_gift_status($id, $status)
    {
        if (!empty($id)) {
            $gift_data["is_active"] = $status;
            unset($gift_data["id"]);
            if ($this->saveVirtualGifts($id, $gift_data)) {
                return ($status == '1') ? 'active' : 'deactive';
            }
        }
    }

    /**
     * Validate uploaded image
     *
     * @param type $file_name
     *
     * @return string
     */
    public function validateImage($file_name = '')
    {
        $return = ['errors' => [], 'data' => [], 'form_error' => 0];
        if (!empty($file_name)) {
            if (isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && !($_FILES[$file_name]["error"])) {
                $this->ci->load->model("Uploads_model");
                $file_return = $this->ci->Uploads_model->validate_upload($this->file_config_gid, $file_name);

                if (!empty($file_return["error"])) {
                    $return["errors"][] = (is_array($file_return["error"])) ? implode("<br>", $file_return["error"]) : $file_return["error"];
                }
                $return["data"]['mime'] = $_FILES[$file_name]["type"];
            } elseif ($_FILES[$file_name]["error"]) {
                $return["errors"][] = $_FILES[$file_name]["error"];
            } else {
                $return["errors"][] = "empty file";
            }
        }

        return $return;
    }

    /**
     * Save image object
     *
     * @param array $attrs
     *
     * @return bool
     */
    public function saveImage($file_name = "", $price = 0)
    {
        $return = ['errors' => ''];

        $data = [
            "img" => "",
            "is_special_price" => "0",
            "price" => $price,
            "fk_currency_gid" => "USD",
            "priority" => $this->get_last_priority(1),
            "is_active" => 1,
            "created_date" => date('Y/m/d H:i:s', time()),
        ];
        $id   = $this->saveVirtualGifts(null, $data);

        if (!empty($file_name) && !empty($id) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $img_path = substr($data["created_date"], 0, 10) . "/" . $id;

            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->upload($this->file_config_gid, $img_path, $file_name);

            if (empty($img_return["errors"])) {
                $img_data["img"] = $img_return["file"];
                $this->saveVirtualGifts($id, $img_data);
            } else {
                $upload = ["errors" => $img_return["errors"]];

                return $upload;
            }
        }

        return $return;
    }

    public function updateUserGiftStatus($gift_id = null, $user_id = null, $status = null)
    {
        if (empty($gift_id) || empty($user_id)) {
            return false;
        }

        $this->ci->db->where('id', $gift_id);

        switch (trim(strtolower($status))) {
            case 'approved': {
                    $this->ci->db->update(VIRTUAL_GIFTS_USERS_TABLE, ['status' => 'approved']);
                    $return_message = l('gift_receipt_accepted', 'virtual_gifts');

                    break;
            }
            case 'decline': {
                    $this->ci->db->update(VIRTUAL_GIFTS_USERS_TABLE, ['status' => 'decline']);
                    $return_message = l('gift_receipt_declined', 'virtual_gifts');

                    break;
            }
            default: {
                    return false;
            }
        }

        return $return_message;
    }

    /**
     * Save virtual_gifts object to data source
     *
     * @param integer $virtual_gifts_id  virtual_gifts identifier
     * @param array   $virtual_gifts_raw virtual_gifts raw data
     *
     * @return integer
     */
    public function saveVirtualGifts($virtual_gifts_id, $virtual_gifts_raw)
    {
        if (empty($virtual_gifts_id)) {
            $this->ci->db->insert(VIRTUAL_GIFTS_TABLE, $virtual_gifts_raw);
            $virtual_gifts_id = $this->ci->db->insert_id();
            $this->incGidIndex();
        } else {
            $this->ci->db->where('id', $virtual_gifts_id);
            $this->ci->db->update(VIRTUAL_GIFTS_TABLE, $virtual_gifts_raw);
        }

        return $virtual_gifts_id;
    }

    /**
     * @param type $params
     */
    public function getUserGiftsList($user_id, $is_mine = true, $params = [], $order_by = [], $page = null, $limits = null)
    {
        $user_id = intval($user_id);

        if (!empty($user_id)) {
            $params["where"]["fk_user_id"] = $user_id;
            if (!$is_mine) {
                $params["where"]["status"] = 'approved';
            }
            $params["table"] = VIRTUAL_GIFTS_USERS_TABLE;

            return $this->getVirtualGiftsListInternal($page, $limits, $order_by, $params);
        }

        return [];
    }

    public function getGifts($page = null, $limits = null, $order_by = null, $params = [])
    {
        $params["table"] = VIRTUAL_GIFTS_USERS_TABLE;

        return $this->getVirtualGiftsListInternal($page, $limits, $order_by, $params);
    }

    /**
     * @param type $params
     */
    public function getUserGiftById($gift_id, $params = [])
    {
        $gift_id = intval($gift_id);

        if (!empty($gift_id)) {
            $params["where"]["id"] = $gift_id;
            $params["table"]       = VIRTUAL_GIFTS_USERS_TABLE;
            $result                = $this->getVirtualGiftsListInternal(null, null, [], $params);
            if (!empty($result[0])) {
                return $result[0];
            }
        }

        return [];
    }

    /**
     * @param type $params
     */
    public function getUserGiftsCount($user_id, $params = [])
    {
        $user_id = intval($user_id);

        if (!empty($user_id)) {
            $params["where"]["fk_user_id"] = $user_id;
            $params["table"]               = VIRTUAL_GIFTS_USERS_TABLE;

            return $this->getVirtualGiftsCountInternal($params);
        }

        return false;
    }

    public function saveUserGift($data)
    {
        $gift_data     = [
            "img" => $data["img_path"],
            "img_thumb" => $data["img_thumb"],
            "fk_user_id" => $data["receiver_id"],
            "fk_sender_id" => $data["sender_id"],
            "gift_id" => $data["gift_id"],
            "comment" => $data["comment"],
            "is_new" => 1,
            "is_private" => $data["is_private"],
            "status" => $data["status"],
            "receipt_date" => date(self::DB_DATE_FORMAT)
        ];
        $validate_data = $this->validateUserGift($gift_data);

        if (empty($validate_data['errors'])) {
            $this->ci->db->insert(VIRTUAL_GIFTS_USERS_TABLE, $validate_data["data"]);

            return 'ok';
        }

        return $validate_data['errors'];
    }

    public function validateUserGift($data)
    {
        $return = ['errors' => [], 'data' => []];

        $data["fk_user_id"] = intval($data["fk_user_id"]);

        if (empty($data["fk_user_id"])) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["fk_user_id"] = $data["fk_user_id"];
        }

        $data["fk_sender_id"] = intval($data["fk_sender_id"]);

        if (empty($data["fk_user_id"])) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["fk_sender_id"] = $data["fk_sender_id"];
        }

        $return["data"]["comment"] = strip_tags($data["comment"]);

        $return["data"]["is_private"] = intval($data["is_private"]);

        $return["data"]["is_new"] = 1;

        if ($data["status"] != 'approved' && $data["status"] != 'declined' && $data["status"] != 'pending') {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["status"] = $data["status"];
        }

        $return["data"]["gift_id"] = intval($data["gift_id"]);

        if (empty($data["img"])) {
            $return['errors'][] = l('error_payment', 'virtual_gifts');
        } else {
            $return["data"]["img"] = $data["img"];
        }

        $return["data"]["img_thumb"] = $data["img_thumb"];
        $return['data']['receipt_date'] = $data['receipt_date'];

        return $return;
    }

    /**
     * Remove virtual_gifts object from data source by identifier
     *
     * @param integer $virtual_gifts_id virtual_gifts identifier
     *
     * @return void
     */
    public function deleteVirtualGifts($virtual_gifts)
    {
        $this->ci->load->model("Uploads_model");
        $count = 0;

        $delete_gift_ids = [];

        foreach ($virtual_gifts as $gift) {
            $delete_gift_ids[] = $gift["id"];
        }

        $this->ci->db->where_in('id', $delete_gift_ids);
        $this->ci->db->delete(VIRTUAL_GIFTS_TABLE);

        $this->ci->db->where_in('gift_id', $delete_gift_ids);
        $this->ci->db->delete(VIRTUAL_GIFTS_USERS_TABLE);

        foreach ($virtual_gifts as $gift) {
            $img_path = substr(str_replace("-", "/", $gift["created_date"]), 0, 10) . "/" . $gift["id"];
            $this->ci->Uploads_model->delete_upload($this->file_config_gid, $img_path, $gift["img"]);
            ++$count;
        }

        return $count;
    }

    /**
     * Remove virtual_gifts' objects from data source
     *
     * @param integer $virtual_gifts_arr_ids virtual_gifts' identifiers
     *
     * @return void
     */
    public function deleteVirtualGiftsArr(array $virtual_gifts_arr_ids)
    {
        foreach ($virtual_gifts_arr_ids as $virtual_gifts_id) {
            $this->deleteVirtualGifts($virtual_gifts_id);
        }
    }

    /**
     * Return data for generating sitemap page
     *
     * @return array
     */
    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');

        $block[] = [
            "name" => l('header_virtual_gifts_index', self::MODULE_GID),
            "link" => rewrite_link(self::MODULE_GID, 'index'),
            "clickable" => true,
        ];

        return $block;
    }

    /**
     * Return current virtual_gifts counter
     *
     * @return integer
     */
    public function generateGUID()
    {
        $virtual_gifts_counter = $this->ci->pg_module->get_module_config('virtual_gifts', 'virtual_gifts_counter');
        $virtual_gifts_counter = (int) $virtual_gifts_counter + 1;

        return self::GUID_PREFIX . $virtual_gifts_counter;
    }

    /**
     * Increase virtual_gifts counter
     *
     * @return void
     */
    public function incGidIndex()
    {
        $virtual_gifts_counter = $this->ci->pg_module->get_module_config('virtual_gifts', 'virtual_gifts_counter');
        $virtual_gifts_counter = (int) $virtual_gifts_counter + 1;
        $this->ci->pg_module->set_module_config('virtual_gifts', 'virtual_gifts_counter', $virtual_gifts_counter);
    }

    public function __call($name, $args)
    {
        $methods = [
            '_getVirtualGiftsCriteria' => 'getVirtualGiftsCriteria',
            'backend_get_request_notifications' => 'backendGetRequestNotifications',
            'format_gifts_priorities' => 'formatGiftsPriorities',
            'get_first_priority' => 'getFirstPriority',
            'get_gift_priority_by_id' => 'getGiftPriorityById',
            'get_last_priority' => 'getLastPriority',
            'save_image' => 'saveImage',
            'get_settings' => 'getSettings',
            'set_settings' => 'setSettings',
            'set_sort_gift' => 'setSortGift',
            'update_gift_price' => 'updateGiftPrice',
            'validate_image' => 'validateImage',
            'validate_settings' => 'validateSettings',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
