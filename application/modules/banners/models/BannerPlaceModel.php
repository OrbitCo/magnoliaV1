<?php

declare(strict_types=1);

namespace Pg\modules\banners\models;

/**
 * Banners place model
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('TABLE_BANNERS_PLACES')) {
    define('TABLE_BANNERS_PLACES', DB_PREFIX . 'banners_places');
}

if (!defined('TABLE_BANNERS_PLACE_GROUP')) {
    define('TABLE_BANNERS_PLACE_GROUP', DB_PREFIX . 'banners_place_group');
}

if (!defined('TABLE_BANNERS_BANNER_GROUP')) {
    define('TABLE_BANNERS_BANNER_GROUP', DB_PREFIX . 'banners_banner_group');
}

/**
 * Banners place model
 *
 * Для области ставим в соответствие группы
 * Нет необходимости делить вывод областей на страницы , поэтому параметры
 * поиска(list_per_page, page, $search_param..) не используем
 *
 * @package     PG_RealEstate
 * @subpackage  Banners
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Real Estate - php real estate listing software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class BannerPlaceModel extends \Model
{
    /**
     * Properies of place object in data source
     *
     * @var array
     */
    protected $fields = [
        'id',
        'date_created',
        'date_modified',
        'keyword',
        'name',
        'places_in_rotation',
        'rotate_time',
        'width',
        'height',
        'access',
    ];

    /**
     * Places list
     *
     * @var array
     */
    private $places_all = null;

    /**
     * Class constructor
     *
     * @return Banner_place_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(TABLE_BANNERS_PLACES);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(TABLE_BANNERS_PLACE_GROUP);
        $this->ci->cache->registerService(TABLE_BANNERS_BANNER_GROUP);
    }

    /**
     * Return all banners' places
     *
     * @param integer $access user access
     *
     * @return array
     */
    public function getAllPlaces($access = false)
    {
        if ($this->places_all === null) {
            $fields = $this->fields;

            $this->places_all = $this->ci->cache->get(TABLE_BANNERS_PLACES, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(TABLE_BANNERS_PLACES)
                    ->order_by("date_created ASC")
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }

                return $results_raw;
            });
        }

        if (empty($this->places_all)) {
            return [];
        }

        if ($access !== false) {
            foreach ($this->places_all as $index => $place_raw) {
                if ($place_raw['access'] > $access) {
                    unset($this->places_all[$index]);
                }
            }
        }

        return $this->formatPlaces($this->places_all);
    }

    /**
     * Format data of banners' places
     *
     * @param array $data places data
     *
     * @return array
     */
    public function formatPlace($place_raw)
    {
        $places = $this->formatPlaces([$place_raw]);

        return $places[0];
    }

    /**
     * Format data of banners' places
     *
     * @param array $data places data
     *
     * @return array
     */
    public function formatPlaces($places_raw)
    {
        return $places_raw;
    }

    /**
     * Validate data of banners' place for saving to data source
     *
     * @param integer $place_id place identifier
     * @param array   $data     place data
     *
     * @return array
     */
    public function validatePlace($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["name"])) {
            $return["data"]["name"] = trim(strip_tags($data["name"]));
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('place_edit_error_name_empty', 'banners');
            }
        }

        if (isset($data["keyword"]) && is_null($id)) {
            $return["data"]["keyword"] = preg_replace("/[^a-z\-_0-9]+/i", '', trim(strip_tags($data["keyword"])));

            if (empty($return["data"]["keyword"])) {
                $return["errors"][] = l('place_edit_error_keyword_empty', 'banners');
            } else {
                $this->ci->db->select("COUNT(*) AS cnt")->from(TABLE_BANNERS_PLACES)->where("keyword", $return["data"]["keyword"]);
                if (!empty($id)) {
                    $this->ci->db->where("id <>", $id);
                }
                $results = $this->ci->db->get()->result();
                if (!empty($results) && is_array($results) && $results[0]->cnt > 0) {
                    $return["errors"][] = l('place_edit_error_keyword_exists', 'banners');
                }
            }
        }

        if (isset($data["width"]) && is_null($id)) {
            $return["data"]["width"] = intval($data["width"]);
            if (empty($return["data"]["width"])) {
                $return["errors"][] = l('place_edit_error_width_empty', 'banners');
            }
        }

        if (isset($data["height"]) && is_null($id)) {
            $return["data"]["height"] = intval($data["height"]);
            if (empty($return["data"]["height"])) {
                $return["errors"][] = l('place_edit_error_height_empty', 'banners');
            }
        }

        if (isset($data["rotate_time"])) {
            if ($data["rotate_time"] > 0) {
                $this->ci->load->model('Banners_model');
                $is_html = $this->ci->Banners_model->isHtmlBannerByPlaceID($id);
                if ($is_html === true) {
                    $return["errors"][] = l('error_html_place', 'banners');
                } else {
                    $return["data"]["rotate_time"] = intval($data["rotate_time"]);
                }
            } else {
                $return["data"]["rotate_time"] = intval($data["rotate_time"]);
            }
        }

        if (isset($data["places_in_rotation"])) {
            $return["data"]["places_in_rotation"] = intval($data["places_in_rotation"]);
            if (empty($return["data"]["places_in_rotation"])) {
                $return["errors"][] = l('place_edit_error_places_in_rotation_empty', 'banners');
            }
            /*if ($return["data"]["rotate_time"] == 0) {
                $return["data"]["places_in_rotation"] = 1;
            }*/
        }

        if (isset($data["place_groups"]) && is_array($data["place_groups"])) {
            $return["data"]["place_groups"] = $data["place_groups"];
        }

        if (isset($data["access"])) {
            $return["data"]["access"] = intval($data["access"]);
        }

        return $return;
    }

    /**
     * Save banner place object to data source
     *
     * @param integer $place_id place identifier
     * @param array   $data     place data
     *
     * @return integer
     */
    public function savePlace($id, $data)
    {
        ///// categories
        if (isset($data["place_groups"]) && !empty($data["place_groups"])) {
            $saved_place_groups = $data["place_groups"];
            unset($data["place_groups"]);
        }

        ////save
        if (!empty($id)) {
            $data["date_modified"] = date('Y-m-d H:i:s');
            $this->ci->db->where('id', $id);
            $this->ci->db->update(TABLE_BANNERS_PLACES, $data);
        } else {
            $data["date_created"] = date('Y-m-d H:i:s');
            $data["date_modified"] = date('Y-m-d H:i:s');
            $this->ci->db->insert(TABLE_BANNERS_PLACES, $data);
            $id = $this->ci->db->insert_id();
        }

        ///// update categories
        if (isset($saved_place_groups) && is_array($saved_place_groups) && count($saved_place_groups) > 0) {
            $this->ci->db->where('place_id', $id);
            $this->ci->db->delete(TABLE_BANNERS_PLACE_GROUP);
            foreach ($saved_place_groups as $group_id) {
                $this->ci->db->insert(TABLE_BANNERS_PLACE_GROUP, ['place_id' => $id, 'group_id' => $group_id]);
            }
        }

        // TODO: clear cache
        $this->ci->cache->flush(TABLE_BANNERS_PLACES);

        $this->places_all = null;

        return $id;
    }

    /**
     * Save link between place and group to data source
     *
     * @param integer $place_id place identifier
     * @param integer $group_id group identifier
     *
     * @return void
     */
    public function savePlaceGroup($place_id, $group_id)
    {
        if ($place_id && $group_id) {
            $this->ci->db->insert(TABLE_BANNERS_PLACE_GROUP, ['place_id' => $place_id, 'group_id' => $group_id]);
        }
    }

    /**
     * Remove banner place object by identifier
     *
     * @param integer $place_id place identifier
     *
     * @return void
     */
    public function delete($id = null)
    {
        if ($id) {
            $this->ci->db->where('id', $id);
            $this->ci->db->delete(TABLE_BANNERS_PLACES);

            $this->ci->db->where('place_id', $id);
            $this->ci->db->delete(TABLE_BANNERS_PLACE_GROUP);

            $this->ci->db->where('place_id', $id);
            $this->ci->db->delete(TABLE_BANNERS_BANNER_GROUP);

            // TODO: cache
            $this->ci->cache->flush(TABLE_BANNERS_PLACES);

            $this->places_all = null;
        }
    }

    /**
     * Return banner place object by id
     *
     * @param integer $place_id place identifier
     *
     * @return array
     */
    public function get($id)
    {
        $places = $this->getAllPlaces();

        foreach ($places as $place) {
            if ($place['id'] == $id) {
                return $place;
            }
        }

        return false;
    }

    /**
     * Return banner place object by id (alias of method get)
     *
     * @param integer $place_id place identifier
     *
     * @return array
     */
    public function getById($id)
    {
        return $this->get($id);
    }

    /**
     * Return banner place object by keyword
     *
     * @param string $keyword keyword
     *
     * @return array
     */
    public function getByKeyword($keyword)
    {
        $places = $this->getAllPlaces();

        foreach ($places as $place) {
            if ($place['keyword'] == $keyword) {
                return $place;
            }
        }

        return false;
    }

    /**
     * Return groups identifiers in banner place
     *
     * @param integer $place_id place identifier
     *
     * @return array
     */
    public function getPlaceGroupIds($place_id)
    {
        $object = [];
        $this->ci->db->select("group_id")->from(TABLE_BANNERS_PLACE_GROUP)->where("place_id", $place_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $object[] = $result["group_id"];
            }
        }

        return $object;
    }

    public function isRotationByPlaceID($id)
    {
        return  (bool) $this->getById($id)['rotate_time'];
    }

    public function __call($name, $args)
    {
        $methods = [
            'format_place' => 'formatPlace',
            'get_all_places' => 'getAllPlaces',
            'get_by_id' => 'getById',
            'get_by_keyword' => 'getByKeyword',
            'get_place_group_ids' => 'getPlaceGroupIds',
            'save_place' => 'savePlace',
            'save_place_group' => 'savePlaceGroup',
            'validate_place' => 'validatePlace',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
