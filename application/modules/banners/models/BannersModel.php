<?php

declare(strict_types=1);

namespace Pg\modules\banners\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\banners\models\events\EventBanners;

/**
 * Banners main model
 *
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('TABLE_BANNERS')) {
    define('TABLE_BANNERS', DB_PREFIX . 'banners');
}

if (!defined('TABLE_BANNERS_BANNER_GROUP')) {
    define('TABLE_BANNERS_BANNER_GROUP', DB_PREFIX . 'banners_banner_group');
}

/**
 * Banners main model
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>$
 */
class BannersModel extends \Model
{
    public const MODULE_GID = 'banners';

    public const EVENT_BANNER_CHANGED = 'banners_object_changed';

    public const STATUS_ITEM_ADDED = 'banner_added';
    public const STATUS_ITEM_APPROVED = 'banner_approved';
    public const STATUS_ITEM_DECLINED = 'banner_declined';
    public const STATUS_ITEM_DELETED = 'banner_deleted';

    public const TYPE_USER_BANNER = 'user_banner';

    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Banners list
     *
     * @var array
     */
    private $banners_all = null;

    /**
     * Positions list
     *
     * @var array
     */
    private $positions_all = null;

    public $dashboard_events = [
        self::EVENT_BANNER_CHANGED,
    ];

    /**
     * Properties of banner object in data source
     *
     * @var array
     */
    protected $fields = [
        'id',
        'date_created',
        'date_modified',
        'alt_text',
        'approve',
        'banner_image',
        'banner_place_id',
        'banner_type',
        'decline_reason',
        'expiration_date',
        'html',
        'link',
        'name',
        'new_window',
        'is_admin',
        'number_of_clicks',
        'number_of_views',
        'stat_clicks',
        'stat_views',
        'status',
        'user_id',
    ];

    protected $positions_fields = [
        'id', 'banner_id', 'group_id', 'place_id', 'is_admin', 'positions',
    ];

    /**
     * Banner upload config (GUID)
     *
     * @var string
     */
    public $upload_config_id = "banner";

    private $moderation_type = "banners";

    /**
     * Settings for formatting banner object
     *
     * @var array
     */
    protected $format_settings = [
        'use_format' => true,
        'get_user'   => false,
    ];

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('banners/models/Banner_group_model');

        $this->ci->cache->registerService(TABLE_BANNERS);
        $this->ci->cache->registerService(TABLE_BANNERS_BANNER_GROUP);
    }

    /**
     * Update existing banner object
     *
     * @param integer $id   banner identifier
     * @param array   $data banner data
     * @param string  $file_name file name of upload
     *
     * @return integer
     */
    public function save($id, $data, $file_name = "", $change = true)
    {
        if (isset($data["banner_groups"])) {
            $groups_copy_attrs = $data["banner_groups"];
            unset($data["banner_groups"]);
        } else {
            $groups_copy_attrs = false;
        }

        if (!empty($id)) {
            $data["date_modified"] = date(self::DB_DATE_FORMAT);
            $this->ci->db->where('id', $id);
            $this->ci->db->update(TABLE_BANNERS, $data);

            if ($this->ci->session->userdata("auth_type") == "admin" && $change) {
                $this->ci->load->model('menu/models/Indicators_model');
                $this->Indicators_model->delete('new_banner_item', $id, true);
            }
        } else {
            if ($this->ci->session->userdata("auth_type") == "user") {
                $data["user_id"] = $this->ci->session->userdata('user_id');
            } else {
                $data["user_id"] = 0;
            }
            $data["date_created"] = date(self::DB_DATE_FORMAT);
            $data["date_modified"] = date(self::DB_DATE_FORMAT);
            $this->ci->db->insert(TABLE_BANNERS, $data);
            $id = $this->ci->db->insert_id();

            if ($this->ci->session->userdata("auth_type") == "user") {
                $this->ci->load->model('menu/models/Indicators_model');
                $this->ci->Indicators_model->add('new_banner_item', $id);
            }
        }

        if (!empty($groups_copy_attrs)) {
            $this->add_banner_groups($id, $groups_copy_attrs, $data["banner_place_id"], $data["is_admin"]);
        }

        if (!empty($file_name) && !empty($id) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $banner_data = $this->get($id);

            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->upload($this->upload_config_id, $banner_data["prefix"], $file_name);

            if (empty($img_return["errors"])) {
                $img_data["banner_image"] = $img_return["file"];
                $this->save($id, $img_data);
            }
        }

        $this->ci->cache->flush(TABLE_BANNERS);

        return $id;
    }

    public function saveUserBanner($banner_id, $banner_data, $file_name = "", $change = true)
    {
        $banner_id = $this->save($banner_id, $banner_data, $file_name, $change);

        $this->sendEvent(self::EVENT_BANNER_CHANGED, [
            'id' => $banner_id,
            'type' => self::TYPE_USER_BANNER,
            'status' => self::STATUS_ITEM_ADDED,
        ]);

        return $banner_id;
    }

    /**
     * Save activity status of banner object
     *
     * Available statuses:
     * 1 - activate banner
     * 0 - de-activate banner
     *
     * @param integer $id banner identifier
     * @param integer $status    banner status
     *
     * @return void
     */
    public function saveBannerStatus($id, $status)
    {
        if (empty($id)) {
            return;
        }
        $banner = $this->get($id);
        $this->ci->load->model('banners/models/Banner_place_model');
        $is_rotation = $this->ci->Banner_place_model->isRotationByPlaceID($banner["banner_place_id"]);
        if ($banner["banner_type"] == 2 && $is_rotation === true && $status == 1) {
            $this->ci->Banner_place_model->savePlace($banner["banner_place_id"], ['rotate_time' => 0]);
        }

        $attrs = [
            'status' => intval($status),
            'approve' => intval($status),
            'date_modified' => date(self::DB_DATE_FORMAT)
        ];
        $this->ci->db->where('id', $id);
        $this->ci->db->update(TABLE_BANNERS, $attrs);
        if (0 === $attrs["status"]) {
            $this->saveBannerViews($id, 0);
            $this->saveBannerClicks($id, 0);
        }

        $this->ci->cache->flush(TABLE_BANNERS);
    }

    /**
     * Return banners statistics as array
     *
     * @param array $banner_ids banners identifiers
     *
     * @return array
     */
    public function getBannersOverallStat($banner_ids)
    {
        if (empty($banner_ids) || !is_array($banner_ids)) {
            return false;
        }
        $this->ci->db->select('id, stat_views, stat_clicks')->from(TABLE_BANNERS)->where_in("id", $banner_ids);
        $results = $this->ci->db->get()->result();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $objects[$result->id] = get_object_vars($result);
            }

            return $objects;
        }

        return false;
    }

    /**
     * Return banner statistics as array
     *
     * @param array $banner_id banner identifier
     *
     * @return array
     */
    public function getBannerOverallStat($banner_id)
    {
        if (empty($banner_id)) {
            return false;
        }
        $this->ci->db->select('id, stat_views, stat_clicks')->from(TABLE_BANNERS)->where("id", $banner_id);
        $results = $this->ci->db->get()->result();
        if (!empty($results) && is_array($results)) {
            $object = get_object_vars($results[0]);

            return $object;
        }

        return false;
    }

    /**
     * Save banner hits
     *
     * @param integer $id banner identifier
     * @param integer $views     hits value
     *
     * @return void
     */
    public function saveBannerViews($id, $views)
    {
        if (empty($id)) {
            return;
        }

        $banners_raw = $this->getAllBanners();

        foreach ($banners_raw as &$banner_raw) {
            if ($banner_raw['id'] == $id) {
                $banner_raw["stat_views"] = $views;
                $this->ci->cache->set(TABLE_BANNERS, 'all', $banners_raw, function () use ($id, $views) {
                    $ci = &get_instance();
                    $ci->db->where('id', $id)
                        ->update(TABLE_BANNERS, ["stat_views" => $views]);
                });

                return;
            }
        }
    }

    /**
     * Save banner clicks
     *
     * @param integer $banner_id banner identifier
     * @param integer $clicks    clicks value
     *
     * @return void
     */
    public function saveBannerClicks($id, $clicks)
    {
        if (empty($id)) {
            return;
        }

        $banners_raw = $this->getAllBanners();

        foreach ($banners_raw as &$banner_raw) {
            if ($banner_raw['id'] == $id) {
                $banner_raw["stat_clicks"] = $clicks;
                $this->ci->cache->set(TABLE_BANNERS, 'all', $banners_raw, function () use ($id, $clicks) {
                    $ci = &get_instance();
                    $ci->db->where('id', $id)
                        ->update(TABLE_BANNERS, ["stat_clicks" => $clicks]);
                });

                return;
            }
        }
    }

    /**
     * Validate banner data for saving to data source
     *
     * @param integer $id banner identifier
     * @param array   $data      banner data
     * @param string  $file_name file name of upload
     *
     * @return array
     */
    public function validateBanner($id, $data, $file_name = "")
    {
        $return = ["errors" => [], "data" => []];

        $this->ci->config->load('reg_exps', true);

        if (isset($data["name"])) {
            $return["data"]["name"] = trim(strip_tags($data["name"]));
            $name_expr = $this->ci->config->item('banner_name', 'reg_exps');
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('banner_edit_error_name_empty', 'banners');
            } elseif (!preg_match($name_expr, $return["data"]["name"])) {
                $return["errors"][] = l('banner_edit_name_incorrect', 'banners');
            } else {
                $this->ci->load->model('moderation/models/Moderation_badwords_model');
                $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']['name']);
                if ($bw_count) {
                    $return['errors'][] = l('error_badwords_name', 'banners');
                }
            }
        }

        if (isset($data["banner_type"])) {
            $return["data"]["banner_type"] = intval($data["banner_type"]);

            if (empty($return["data"]["banner_type"])) {
                $return["errors"][] = l('banner_edit_error_type_empty', 'banners');
            }
        }

        if (isset($data["banner_place_id"])) {
            $this->ci->load->model('banners/models/Banner_place_model');
            $is_rotation = $this->ci->Banner_place_model->isRotationByPlaceID($data["banner_place_id"]);

            if (
                $return["data"]["banner_type"] == 2 && $is_rotation === true
                && (isset($data["status"]) && $data["status"] == 1)
            ) {
                $this->ci->Banner_place_model->savePlace($data["banner_place_id"], ['rotate_time' => 0]);
            }

            $return["data"]["banner_place_id"] = intval($data["banner_place_id"]);
            if (empty($return["data"]["banner_place_id"])) {
                $return["errors"][] = l('banner_edit_error_place_empty', 'banners');
            }
        }

        if (isset($data["status"])) {
            $return["data"]["status"] = intval($data["status"]);
        }

        if (isset($data["banner_groups"])) {
            $return["data"]["banner_groups"] = $data["banner_groups"];
        }

        //// IMAGE
        if ($return["data"]["banner_type"] == 1) {
            if (isset($data["link"])) {
                $return["data"]["link"] = trim(strip_tags($data["link"]));
                if (empty($return["data"]["link"])) {
                    $return["errors"][] = l('banner_edit_error_link_empty', 'banners');
                } else {
                    if (!filter_var($return["data"]["link"], FILTER_VALIDATE_URL)) {
                        $return["errors"][] = l('banner_edit_error_link_invalid', 'banners');
                    }
                }
            }

            if (isset($data["alt_text"])) {
                $return["data"]["alt_text"] = trim(strip_tags($data["alt_text"]));

                if (empty($return["data"]["alt_text"])) {
                    $return["errors"][] = l('banner_edit_error_alt_text_empty', 'banners');
                } else {
                    $this->ci->load->model('moderation/models/Moderation_badwords_model');
                    $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return['data']['alt_text']);
                    if ($bw_count) {
                        $return['errors'][] = l('error_badwords_alt_text', 'banners');
                    }
                }
            }

            if (isset($data["number_of_clicks"])) {
                $return["data"]["number_of_clicks"] = intval($data["number_of_clicks"]);
            }

            if (isset($data["number_of_views"])) {
                $return["data"]["number_of_views"] = intval($data["number_of_views"]);
            }

            if (isset($data["new_window"])) {
                $return["data"]["new_window"] = intval($data["new_window"]);
            }

            if (isset($data["expiration_date_on"]) && empty($data["expiration_date"])) {
                $return["data"]["expiration_date"] = "0000-00-00 00:00:00";
            } elseif (!empty($data["expiration_date"])) {
                $return["data"]["expiration_date"] = date(self::DB_DATE_FORMAT, strtotime($data["expiration_date"]));
            }

            if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
                $this->ci->load->model("Uploads_model");
                $img_return = $this->ci->Uploads_model->validate_upload($this->upload_config_id, $file_name);
                if (!empty($img_return["error"])) {
                    $return['errors'][] = implode("<br>", $img_return["error"]);
                }
            } elseif (empty($id)) {
                $return["errors"][] = l('banner_edit_error_filename_empty', 'banners');
            }
        }

        //// HTML
        if ($return["data"]["banner_type"] == 2) {
            if (isset($data["html"])) {
                $return["data"]["html"] = $data["html"];

                if (empty($return["data"]["html"])) {
                    $return["errors"][] = l('banner_edit_error_html_empty', 'banners');
                }
            }
        }

        return $return;
    }

    /**
     * Return filtered banner objects as array
     *
     * banners - default return all objects
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     items per page
     * @param array   $order_by          sorting value
     * @param array   $params            filters parameters
     * @param array   $filter_object_ids filters identifiers
     *
     * @return array
     */
    public function getBanners($page = 1, $items_on_page = 20, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $objects = [];
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(TABLE_BANNERS);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            $this->ci->db->where_in($field, $value);
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $objects[$result['id']] = $result;
            }
            $objects = $this->format_banners($objects);
        }

        return $objects;
    }

    /**
     * Return number of filtered banners' objects
     *
     * Like get_banners method, but return number of objects
     *
     * necessary for pagination
     * banners - default return number of all objects
     *
     * @param array $params            filters parameters
     * @param array $filter_object_ids filters identifiers
     *
     * @return integer
     */
    public function cntBanners($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(TABLE_BANNERS);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            $this->ci->db->where_in($field, $value);
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]->cnt);
        }

        return false;
    }

    /**
     * Return banners' objects with groups data as array
     *
     * Like get_banners method, but return also groups data
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     items per page
     * @param array   $order_by          sorting value
     * @param array   $params            filters parameters
     * @param array   $filter_object_ids filters identifiers
     *
     * @return array
     */
    public function getBannersJoinGroups($page = 1, $items_on_page = 20, $order_by = null, $params = [], $filter_object_ids = null)
    {

        //// unset unused
        foreach ($this->fields as $attr) {
            $select_fields[] = TABLE_BANNERS . "." . $attr;
        }

        $this->ci->db->select(implode(", ", $select_fields));
        $this->ci->db->from(TABLE_BANNERS);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                if ($field == "banner_groups") {
                    $this->ci->db->join(TABLE_BANNERS_BANNER_GROUP, " " . TABLE_BANNERS_BANNER_GROUP . ".group_id='" . intval($value) . "' AND " . TABLE_BANNERS_BANNER_GROUP . ".banner_id=" . TABLE_BANNERS . ".id");
                } else {
                    $this->ci->db->where($field, $value);
                }
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                if ($field == "banner_groups") {
                    $this->ci->db->join(TABLE_BANNERS_BANNER_GROUP, " " . TABLE_BANNERS_BANNER_GROUP . ".group_id IN (" . implode(', ', $value) . ") AND " . TABLE_BANNERS_BANNER_GROUP . ".banner_id=" . TABLE_BANNERS . ".id");
                } else {
                    $this->ci->db->where_in($field, $value);
                }
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $objects[] = $result;
            }
            $objects = $this->format_banners($objects);

            return $objects;
        }

        return false;
    }

    public function getAllBanners()
    {
        if ($this->banners_all === null) {
            $fields = $this->fields;

            $this->banners_all = $this->ci->cache->get(TABLE_BANNERS, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(', ', $fields))
                    ->from(TABLE_BANNERS)
                    ->order_by('is_admin ASC')
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        if (empty($this->banners_all)) {
            return [];
        }

        return $this->banners_all;
    }

    public function getAllPositions()
    {
        if ($this->positions_all === null) {
            $fields = $this->positions_fields;

            $this->positions_all = $this->ci->cache->get(TABLE_BANNERS_BANNER_GROUP, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(', ', $fields))
                    ->from(TABLE_BANNERS_BANNER_GROUP)
                    ->order_by('is_admin ASC')
                    ->get()->result_array();

                return $results_raw;
            });
        }

        return $this->positions_all;
    }

    /**
     * Select banners objects for rotation in place
     *
     * @param integer $groups_id groups identifiers
     * @param integer $place_id  place identifiers
     * @param integer $positions number of positions
     *
     * @return array
     */
    public function showRotationBanners($groups_id, $place_id, $positions)
    {
        $banners_raw = $this->getAllBanners();
        if (empty($banners_raw)) {
            return [];
        }

        $banners_sorted = [];

        foreach ($banners_raw as $banner_raw) {
            $banners_sorted[$banner_raw['id']] = $banner_raw;
        }

        $results = $this->getAllPositions();
        if (empty($results)) {
            return [];
        }

        foreach ($results as $index => $position_raw) {
            if (in_array($position_raw['group_id'], $groups_id) === false || $position_raw['place_id'] != $place_id) {
                unset($results[$index]);
            } elseif (!isset($banners_sorted[$position_raw['banner_id']]) || $banners_sorted[$position_raw['banner_id']]['status'] != 1) {
                unset($results[$index]);
            } else {
                $results[$index] = array_merge($results[$index], $banners_sorted[$position_raw['banner_id']]);
            }
        }

        $banners_deactivated_users_ids = [];

        $banners = [];
        $used_positions = 1;
        $this->ci->load->model('banners/models/Banners_stat_model');
        shuffle($results);
        foreach ($results as $result) {
            $is_admin_banners = $result["is_admin"] == 1 ? true : false;
            if ($used_positions <= $positions || $is_admin_banners == false) {
                $used_positions += 1;

                $this->ci->Banners_stat_model->add_view($result['id']);
                $tmp_array[] = $result['id'];

                if (intval($result['number_of_clicks']) && $result["stat_clicks"] >= $result['number_of_clicks']) {
                    $this->save_banner_status($result['id'], 0);
                    $this->delete_all_banner_group($result['id']);

                    if (!empty($result['user_id'])) {
                        $banners_deactivated_users_ids[$result['id']] = $result['user_id'];
                    }

                    continue;
                }

                if (intval($result['number_of_views']) && $result["stat_views"] + 1 >= $result['number_of_views']) {
                    $this->save_banner_status($result['id'], 0);
                    $this->delete_all_banner_group($result['id']);

                    if (!empty($result['user_id'])) {
                        $banners_deactivated_users_ids[$result['id']] = $result['user_id'];
                    }

                    continue;
                }

                // check expiration date
                if ($result['expiration_date'] and strtotime($result['expiration_date']) > 0) {
                    if (time() + 24 * 60 >= strtotime($result['expiration_date'])) {
                        $this->save_banner_status($result['id'], 0);
                        $this->delete_all_banner_group($result['id']);

                        if (!empty($result['user_id'])) {
                            $banners_deactivated_users_ids[$result['id']] = $result['user_id'];
                        }

                        continue;
                    }
                }

                $this->saveBannerViews($result['id'], $result["stat_views"] + 1);
                $result = $this->formatBanner($result);
                for ($i = 1; $i <= $result["positions"]; ++$i) {
                    if ($result['banner_type'] == 3) {
                        $result['src'] = "";
                        $result['html'] = str_replace([PHP_EOL, chr(10), chr(13), '\r', '\n', '\t', '\x0B', '\0'], ' ', $result['html']);
                        preg_match_all('/src="([^"]*)"/iu', $result['html'], $matches);
                        if (!empty($matches[1][0])) {
                            unset($result['html']);
                            $result['src'] = $matches[1][0];
                        }
                    }
                    $banners[] = $result;
                }
            } else {
                break;
            }
        }

        if (!empty($banners_deactivated_users_ids) && $this->ci->pg_module->is_module_active("users")) {
            $this->ci->load->model('Users_model');
            $this->ci->load->model("Notifications_model");

            $users_ids = array_unique($banners_deactivated_users_ids);
            $users = $this->ci->Users_model->get_users_list_by_key(null, null, null, null, $users_ids);
            foreach ($results as $result) {
                if (!isset($banners_deactivated_users_ids[$result['id']]) || !isset($users[$banners_deactivated_users_ids[$result['id']]])) {
                    continue;
                }
                $user_data = $users[$banners_deactivated_users_ids[$result['id']]];
                $banner_data = [
                    'user'   => $user_data['output_name'],
                    'banner' => $result['name'],
                ];
                $this->ci->Notifications_model->send_notification($user_data['email'], "banner_status_expired", $banner_data, '', $user_data['lang_id']);
            }
        }

        return $banners;
    }

    /**
     * Number of banners that waited admin approve
     *
     * @return integer
     */
    public function cntNotApproveBanners()
    {
        $params["where"]['approve'] = 0;

        return $this->cnt_banners($params);
    }

    /**
     * Return banner object by identifier
     *
     * @param integer $banner_id banner identifier
     *
     * @return array
     */
    public function get($id, $is_formatted = true)
    {
        $object = [];
        if ($id) {
            $this->ci->db->select(implode(", ", $this->fields))->from(TABLE_BANNERS)->where('id', $id);
            $results = $this->ci->db->get()->result_array();
            if (!empty($results) && is_array($results)) {
                if ($is_formatted) {
                    $object = $this->format_banner($results[0]);
                    $object["banner_groups"] = $this->get_banner_group_ids($id);
                } else {
                    $object = $result[0];
                }
            }
        }

        return $object;
    }

    /**
     * Format banner object
     *
     * @param array $data banner data
     *
     * @return array
     */
    public function formatBanner($data)
    {
        $formatted = $this->formatBanners([$data]);

        return array_shift($formatted);
    }

    /**
     * Format banners objects
     *
     * @param array $data set banners objects
     *
     * @return array
     */
    public function formatBanners($data)
    {
        if (empty($data) || !is_array($data)) {
            return;
        }

        if (!$this->format_settings['use_format']) {
            return $data;
        }

        $user_ids = [];

        $this->ci->load->model('Uploads_model');
        foreach ($data as $key => $banner) {
            if (strtotime($banner["expiration_date"]) <= 0) {
                $banner["expiration_date"] = '';
            }

            if (!isset($banner["expiration_date_on"])) {
                $banner["expiration_date_on"] = (strtotime($banner["expiration_date"]) > 0) ? true : false;
            }
            if (!empty($banner["id"])) {
                $banner["prefix"] = $banner["id"];
            }

            if (!empty($banner["banner_image"])) {
                $banner["media"]["banner_image"] = $this->ci->Uploads_model->formatUpload($this->upload_config_id, $banner["prefix"], $banner["banner_image"]);
            } else {
                $banner["media"]["banner_image"] = $this->ci->Uploads_model->formatDefaultUpload($this->upload_config_id);
            }

            if ($banner["user_id"]) {
                $user_ids[] = $banner["user_id"];
            }

            $data[$key] = $banner;
        }

        if ($this->format_settings['get_user'] && !empty($user_ids)) {
            $this->ci->load->model('Users_model');
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], array_unique($user_ids), true);
            if ($this->format_settings['get_user']) {
                foreach ($data as $key => $banner) {
                    if (!$banner['user_id']) {
                        continue;
                    }
                    $data[$key]['user'] = (isset($users[$banner['user_id']])) ? $users[$banner['user_id']] :
                        $this->ci->Users_model->formatDefaultUser($banner['user_id']);
                }
            }
        }

        return $data;
    }

    /**
     * Change settings for formatting banner object
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
     * Return activation settings of user banner
     *
     * @param ineteger $banner_id banner identifier
     *
     * @return array
     */
    public function getUserActivateInfo($banner_id)
    {
        $this->ci->db->select("user_activate_info")->from(TABLE_BANNERS)->where('id', $banner_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $return = unserialize($results[0]["user_activate_info"]);
        } else {
            $return = "";
        }

        return $return;
    }

    /**
     * Save activation settings of user banner
     *
     * @param ineteger $banner_id     banner identifier
     * @param array    $activate_info activation settings
     *
     * @return void
     */
    public function setUserActivateInfo($banner_id, $activate_info)
    {
        $data["user_activate_info"] = serialize($activate_info);
        $this->ci->db->where('id', $banner_id);
        $this->ci->db->update(TABLE_BANNERS, $data);

        $this->ci->cache->flush(TABLE_BANNERS);
    }

    /**
     * Remove banner object by identifier
     *
     * @param integer $banner_id banner identifier
     *
     * @return void
     */
    public function delete($id)
    {
        if (empty($id)) {
            return;
        }

        $banner_data = $this->get($id);
        $this->delete_all_banner_group($id);

        $this->ci->db->where('id', $id);
        $this->ci->db->delete(TABLE_BANNERS);

        if (!empty($banner_data["banner_image"])) {
            $this->ci->load->model("Uploads_model");
            $this->ci->Uploads_model->delete_upload($this->upload_config_id, $banner_data["prefix"], $banner_data["banner_image"]);
        }

        $this->ci->db->where('banner_id', $id);
        $this->ci->db->delete(TABLE_BANNERS_BANNER_GROUP);

        $this->ci->load->model('banners/models/Banners_stat_model');
        $this->ci->Banners_stat_model->delete_statistic($id);

        $this->ci->load->model('menu/models/Indicators_model');
        $this->ci->Indicators_model->delete('new_banner_item', $id, true);

        $this->sendEvent(self::EVENT_BANNER_CHANGED, [
            'id' => $id,
            'type' => self::TYPE_USER_BANNER,
            'status' => self::STATUS_ITEM_DELETED,
        ]);

        $this->ci->cache->flush(TABLE_BANNERS);
        $this->ci->cache->flush(TABLE_BANNERS_BANNER_GROUP);
    }

    /**
     * Remove banner from all groups
     *
     * @param integer $banner_id banner identificator
     *
     * @return void
     */
    public function deleteAllBannerGroup($banner_id)
    {
        $this->ci->db->where('banner_id', $banner_id);
        $this->ci->db->delete(TABLE_BANNERS_BANNER_GROUP);

        $this->ci->cache->flush(TABLE_BANNERS_BANNER_GROUP);
    }

    /**
     * Add banner to specific groups
     *
     * @param integer $banner_id      banner identifier
     * @param array   $banner_groups  groups identifiers
     * @param integer $place_id       place identifier
     * @param integer $is_admin       if turn on it is admin banner
     * @param array   $group_position set of positions
     *
     * @return void
     */
    public function addBannerGroups($banner_id, $banner_groups, $place_id, $is_admin, $group_position = [])
    {
        $this->delete_all_banner_group($banner_id);
        if (!empty($banner_groups) && count($banner_groups) > 0) {
            foreach ($banner_groups as $group_id) {
                if ($group_id) {
                    $data = [
                        "banner_id" => intval($banner_id),
                        "group_id"  => intval($group_id),
                        "place_id"  => intval($place_id),
                        "is_admin"  => intval($is_admin),
                        "positions" => isset($group_position[$group_id]) ? intval($group_position[$group_id]) : 1,
                    ];
                    $this->ci->db->insert(TABLE_BANNERS_BANNER_GROUP, $data);
                }
            }

            $this->ci->cache->flush(TABLE_BANNERS_BANNER_GROUP);
        }
    }

    /**
     * Return groups identifiers of banner as array
     *
     * @param integer $banner_id banner identifier
     *
     * @return array
     */
    public function getBannerGroupIds($banner_id)
    {
        $object = [];
        $this->ci->db->select("group_id")->from(TABLE_BANNERS_BANNER_GROUP)->where("banner_id", $banner_id);
        $results = $this->ci->db->get()->result();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $object[] = $result->group_id;
            }
        }

        return $object;
    }

    /**
     * Update banner statistics
     *
     * @return void
     */
    public function updateStatistic()
    {
        $this->ci->load->model('banners/models/Banners_stat_model');
        $date = date("Y-m-d");
        $this->ci->Banners_stat_model->update_file_statistic();
        $this->ci->Banners_stat_model->update_day_statistic($date);
        $this->ci->Banners_stat_model->update_week_statistic($date);
        $this->ci->Banners_stat_model->update_month_statistic($date);
        $this->ci->Banners_stat_model->update_year_statistic($date);
    }

    ///// service functions

    /**
     * Validate data of activate banner service
     *
     * @param integer $user_id      user identifier
     * @param array   $data         user data
     * @param array   $service_data service data
     * @param float   $price        service price
     *
     * @return array
     */
    public function serviceValidateBanner($user_id, $data, $service_data = [], $price = '')
    {
        $return = ["errors" => [], "data" => $data];

        return $return;
    }

    /**
     * Buy banner service
     *
     * @param array $user_service user service data
     * @param array $user_data    user data
     * @param float $price        payment price
     *
     * @return boolean
     */
    public function serviceBuyBanner($id_user, $price, $service, $template, $payment_data, $users_package_id = 0, $count = 1)
    {
        $banner_id = $payment_data['user_data']['id_banner_payment'];
        $banner = $this->get($banner_id);
        $info = $this->get_user_activate_info($banner_id);

        if (floatval($info["sum"]) != floatval($price)) {
            return false;
        }

        $group_position = $info["positions"];
        $banner_groups = array_keys($group_position);

        $this->add_banner_groups($banner_id, $banner_groups, $banner["banner_place_id"], 0, $group_position);

        $period = $this->ci->pg_module->get_module_config("banners", "period");

        $data = [
            'expiration_date' => date(self::DB_DATE_FORMAT, time() + $period * 86400),
            'status'          => 1,
        ];

        $this->save($banner_id, $data);

        return true;
    }

    /**
     * Activate banner service
     *
     * @param array $user_service user service data
     * @param array $user_data    user data
     * @param float $price        payment price
     *
     * @return boolean
     */
    public function serviceActivateBanner()
    {
    }

    /**
     * Validate banners settings
     *
     * @param array $data banner settings
     *
     * @return array
     */
    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data['period'])) {
            $return["data"]["period"] = intval($data["period"]);
            if (empty($return["data"]["period"])) {
                $return["errors"][] = l("error_empty_period", "banners");
            }
        }

        if (isset($data['moderation_send_mail'])) {
            $return["data"]["moderation_send_mail"] = $data["moderation_send_mail"] ? 1 : 0;
        }

        /// email
        if (isset($data['admin_moderation_emails'])) {
            $return["data"]["admin_moderation_emails"] = trim(strip_tags((string)$data["admin_moderation_emails"]));

            if (!empty($return["data"]["admin_moderation_emails"])) {
                $chunks = explode(',', $return["data"]["admin_moderation_emails"]);
                foreach ($chunks as $chunk) {
                    if (!filter_var(trim($chunk), FILTER_VALIDATE_EMAIL)) {
                        $return["errors"][] = l("error_invalid_email", "banners");

                        break;
                    }
                }
            } elseif ($return["data"]["moderation_send_mail"]) {
                $return["errors"][] = l("error_empty_email", "banners");
            }
        }

        return $return;
    }

    /**
     * Return available user types with names
     *
     * @param string $template_gid template guid
     *
     * @return array
     */
    public function serviceUserTypeMethod($template_gid)
    {
        $this->ci->load->model('Users_model');
        $user_types = $this->ci->Users_model->get_user_types_names();

        return $user_types;
    }

    public function approve($banner_id)
    {
        $banner = $this->get($banner_id);
        if (empty($banner['banner_groups'])) {
            return false;
        }

        $this->save($banner_id, ['approve' => 1]);
        $this->sendNotification($banner, 'banner_status_approved');
        $this->sendEvent(self::EVENT_BANNER_CHANGED, [
            'id' => $banner_id,
            'type' => self::TYPE_USER_BANNER,
            'status' => self::STATUS_ITEM_APPROVED,
        ]);

        return true;
    }

    public function decline($banner_id)
    {
        $banner = $this->get($banner_id);

        $this->save($banner_id, ['approve' => -1, 'status' => 0]);

        $this->sendNotification($banner, 'banner_status_declined');

        $this->sendEvent(self::EVENT_BANNER_CHANGED, [
            'id' => $banner_id,
            'type' => self::TYPE_USER_BANNER,
            'status' => self::STATUS_ITEM_DECLINED,
        ]);

        return true;
    }

    private function sendNotification($banner, $notification_gid)
    {
        if (!$this->ci->pg_module->is_module_active("users")) {
            return;
        }

        $this->ci->load->model("Users_model");
        $user = $this->ci->Users_model->get_user_by_id($banner['user_id']);

        $banner['user'] = $user['output_name'];
        $banner['banner'] = $banner['name'];

        $this->ci->load->model("Notifications_model");
        $this->ci->Notifications_model->send_notification(
            $user['email'],
            $notification_gid,
            $banner,
            '',
            $user['lang_id']
        );
    }

    public function sendEvent($event_gid, $event_data)
    {
        $event_data['module'] = BannersModel::MODULE_GID;
        $event_data['action'] = $event_gid;

        $event = new EventBanners();
        $event->setData($event_data);

        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, $event_gid);
    }

    public function formatDashboardRecords($data)
    {
        $this->format_settings['get_user'] = true;
        $data = $this->formatBanners($data);
        $this->format_settings['get_user'] = false;

        foreach ($data as $key => $value) {
            $this->ci->view->assign('data', $value);
            $data[$key]['content'] = $this->ci->view->fetch('dashboard', 'admin', 'banners');
        }

        return $data;
    }

    public function getDashboardData($item_id, $status)
    {
        if ($status != self::STATUS_ITEM_ADDED) {
            return false;
        }

        $data = $this->get($item_id);
        $data['dashboard_header'] = 'header_user_banner';
        $data['dashboard_action_link'] = 'admin/banners/index/user';

        return $data;
    }

    public function isHtmlBannerByPlaceID($id)
    {
        return (bool) $this->cntBanners([
            'where' => [
                'banner_place_id' => $id,
                'banner_type' => 2,
                'status' => 1,
                'approve' => 1
            ]
        ]);
    }

    public function declineBannersData($user_id)
    {
        $data = $this->ci->db->select(implode(", ", $this->fields))
                        ->from(TABLE_BANNERS)
                        ->where('status', '0')
                        ->where('user_id', $user_id)
                        ->get()->result_array();
        if (!empty($data)) {
            $ids = [];
            $this->load->model(['menu/models/Indicators_model', 'Uploads_model']);
            foreach ($data as $value) {
                $ids[] = $value['id'];
                $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $value["prefix"], $value["banner_image"]);
                $this->sendEvent(self::EVENT_BANNER_CHANGED, [
                    'id' => $value['id'],
                    'type' => self::TYPE_USER_BANNER,
                    'status' => self::STATUS_ITEM_DELETED,
                ]);
            }
            $this->Indicators_model->delete('new_banner_item', $ids, true);

            $this->ci->db->where_in('id', $ids);
            $this->ci->db->delete(TABLE_BANNERS);

            $this->ci->db->where_in('banner_id', $ids);
            $this->ci->db->delete(TABLE_BANNERS_BANNER_GROUP);

            $this->ci->load->model('banners/models/Banners_stat_model');
            $this->ci->Banners_stat_model->deleteStatisticBanners($ids);

            $this->ci->cache->flush(TABLE_BANNERS);
            $this->ci->cache->flush(TABLE_BANNERS_BANNER_GROUP);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_banner_groups' => 'addBannerGroups',
            'cnt_banners' => 'cntBanners',
            'cnt_not_approve_banners' => 'cntNotApproveBanners',
            'delete_all_banner_group' => 'deleteAllBannerGroup',
            'format_banners' => 'formatBanners',
            'format_banner' => 'formatBanner',
            'get_banner_group_ids' => 'getBannerGroupIds',
            'get_banners_join_groups' => 'getBannersJoinGroups',
            'get_banners_overall_stat' => 'getBannersOverallStat',
            'get_banner_overall_stat' => 'getBannerOverallStat',
            'get_banners' => 'getBanners',
            'get_user_activate_info' => 'getUserActivateInfo',
            'save_banner_clicks' => 'saveBannerClicks',
            'save_banner_status' => 'saveBannerStatus',
            'save_banner_views' => 'saveBannerViews',
            'service_activate_banner' => 'serviceActivateBanner',
            'service_buy_banner' => 'serviceBuyBanner',
            'service_user_type_method' => 'serviceUserTypeMethod',
            'service_validate_banner' => 'serviceValidateBanner',
            'set_format_settings' => 'setFormatSettings',
            'set_user_activate_info' => 'setUserActivateInfo',
            'show_rotation_banners' => 'showRotationBanners',
            'update_statistic' => 'updateStatistic',
            'validate_banner' => 'validateBanner',
            'validate_settings' => 'validateSettings',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
