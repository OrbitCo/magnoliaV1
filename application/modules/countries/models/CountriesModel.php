<?php

declare(strict_types=1);

namespace Pg\modules\countries\models;

define('COUNTRIES_TABLE', DB_PREFIX . 'cnt_countries');
define('REGIONS_TABLE', DB_PREFIX . 'cnt_regions');
define('CITIES_TABLE', DB_PREFIX . 'cnt_cities');
define('CACHE_COUNTRIES_TABLE', DB_PREFIX . 'cnt_cache_countries');
define('CACHE_REGIONS_TABLE', DB_PREFIX . 'cnt_cache_regions');
define('GEOBASE_URL', 'http://download.pilotgroup.net/geobase/wget/');

/**
 * Countries main model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class CountriesModel extends \Model
{
    public const MODULE_GID = 'countries';

    public const DISTANCE = 10000;

    public const COUNT_ITEMS = 10;

    private $db_insert_step = 100;

    private $cache_attrs_country = [
        'id', 'code', 'name', 'areainsqkm', 'continent', 'currency',
        'region_update_date'
    ];

    private $cache_attrs_region = [
        'id', 'country_code', 'code', 'id_region', 'name'
    ];

    private $attrs_country = [
        'id', 'code', 'name', 'areainsqkm', 'continent', 'currency', 'priority', 'sorted'
    ];

    private $attrs_region = [
        'id', 'country_code', 'code', 'name', 'priority', 'sorted'
    ];

    private $attrs_city = [
        'id', 'id_region', 'name', 'latitude', 'longitude', 'country_code',
        'region_code', 'priority', 'sorted'
    ];

    private $use_infile_city_install = true;

    private $city_install_step = 100;

    public $temp_server_city_id = 0;

    private $countries_all = null;
    private $regions_all = null;

    /**
     * Constructor
     *
     * @return
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(COUNTRIES_TABLE);
        $this->ci->cache->registerService(REGIONS_TABLE);
        $this->ci->cache->registerService(CITIES_TABLE);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(CACHE_COUNTRIES_TABLE);
        $this->ci->cache->registerService(CACHE_REGIONS_TABLE);

        $this->use_infile_city_install = $this->ci->pg_module->get_module_config('countries', 'use_infile_city_install');
    }

    /**
     *  get country list from server
     *  put it in base cache
     *  return countries list
     *
     * @return array
     */
    private function wgetCountries()
    {
        $languages = array_values($this->ci->pg_language->languages);

        $langs_code = [];
        foreach ($languages as $language) {
            $langs_code[] = $language['code'];
        }

        $this->ci->load->library('Snoopy');
        $res = $this->ci->snoopy->fetch(GEOBASE_URL . 'get_countries/' . implode('-', $langs_code) . '/');

        if (!$res || !preg_match('/200 OK/i', $this->ci->snoopy->headers[0])) {
            return false;
        }
        $temp_geo_data = $this->ci->snoopy->results;

        $data = [];
        $temp_geo_array = preg_split('/\n/', $temp_geo_data);
        foreach ($temp_geo_array as $geo) {
            if (!strlen(trim($geo))) {
                continue;
            }
            $geo_array = preg_split("/\t/", $geo);

            $langs_names = [];
            foreach ($languages as $i => $language) {
                $langs_names['lang_' . $language['id']] = isset($geo_array[$i + 19]) ? $geo_array[$i + 19] : $geo_array[4];
            }

            $data[] = array_merge([
                'code'               => $geo_array[0],
                'name'               => $geo_array[4],
                'areainsqkm'         => $geo_array[6],
                'continent'          => $geo_array[8],
                'currency'           => $geo_array[10],
                'region_update_date' => '0000-00-00 00:00:00',
                ], $langs_names);
        }

        return $data;
    }

    /**
     * Upload region list from server
     *
     * Put it in base cache. Return region list.
     *
     * @param string $country_code country code
     *
     * @return array
     */
    private function wgetRegions($country_code)
    {
        $languages = array_values($this->ci->pg_language->languages);

        $langs_code = [];
        foreach ($languages as $language) {
            $langs_code[] = $language['code'];
        }

        $this->ci->load->library('Snoopy');
        $res = $this->ci->snoopy->fetch(GEOBASE_URL . 'get_regions/' . $country_code . '/' . implode('-', $langs_code) . '/');

        if (!$res || !preg_match('/200 OK/i', $this->ci->snoopy->headers[0])) {
            return false;
        }
        $temp_geo_data = $this->ci->snoopy->results;

        $data = [];
        $temp_geo_array = preg_split('/\n/', $temp_geo_data);
        foreach ($temp_geo_array as $geo) {
            if (!strlen(trim($geo))) {
                continue;
            }

            $geo_array = preg_split("/\t/", $geo);

            $langs_names = [];
            foreach ($languages as $i => $language) {
                $langs_names['lang_' . $language['id']] = isset($geo_array[$i + 4]) ? $geo_array[$i + 4] : $geo_array[3];
            }

            $data[] = array_merge(
                [
                'country_code' => $geo_array[1],
                'code'         => $geo_array[2],
                'id_region'    => $geo_array[0],
                'name'         => $geo_array[3],
                ],
                $langs_names
            );
        }

        return $data;
    }

    /**
     * Upload city list from server
     *
     * Put it in base cache. Return city list.
     *
     * @param string  $country_code     country code
     * @param integer $region_server_id region identifier
     * @param array   $region_data      region data
     *
     * @return array
     */
    private function wgetCities($country_code, $region_server_id, $region_data)
    {
        //// get cities from server and return cities list
        //// if returned data && infile == true - save file and return filepath
        //// if returned data && infile == false - return data array
        //// if returned install clear and return

        $languages = $this->ci->pg_language->languages;
        ksort($languages);
        $languages = array_values($languages);

        $langs_code = [];
        foreach ($languages as $language) {
            $langs_code[] = $language['code'];
        }

        $this->ci->load->library('Snoopy');
        $res = $this->ci->snoopy->fetch(GEOBASE_URL . 'get_regions_cities/' . $country_code . "/" . $region_server_id . "/" . $this->temp_server_city_id . '/' . implode('-', $langs_code) . '/');

        if (!$res || !preg_match('/200 OK/i', $this->ci->snoopy->headers[0])) {
            return false;
        }

        $temp_geo_data = $this->ci->snoopy->results;

        if ('installed' === trim($temp_geo_data)) {
            $this->temp_server_city_id = 0;

            return true;
        }

        $data = [];
        $temp_geo_array = preg_split('/\n/', $temp_geo_data);
        foreach ($temp_geo_array as $geo) {
            if (!strlen(trim($geo))) {
                continue;
            }
            $geo_array = preg_split("/\t/", $geo);

            $langs_names = [];
            foreach ($languages as $i => $language) {
                $langs_names['lang_' . $language['id']] = isset($geo_array[$i + 20]) ? $geo_array[$i + 20] : $geo_array[2];
            }
            $data[] = array_merge([
                'id'           => null,
                'id_region'    => $region_data["id"],
                'name'         => $geo_array[2],
                'latitude'     => $geo_array[5],
                'longitude'    => $geo_array[6],
                'country_code' => $country_code,
                'region_code'  => $region_data["code"],
                'priority'     => 0,
                'sorted'       => 0,
                ], $langs_names);

            $this->temp_server_city_id = $geo_array[0];
        }

        $return = ["data" => $data, "file" => ''];
        if ($this->use_infile_city_install) {
            $infile = "";
            foreach ($data as $city) {
                $infile .= implode("\t", $city) . "\n";
            }
            $path_to_file = TEMPPATH . 'countries/regions_' . $country_code . '.txt';
            $this->ci->load->helper('file');
            if (!write_file($path_to_file, $infile)) {
                $this->use_infile_city_install = false;

                return $return;
            }
            @chmod($path_to_file, 0777);
            $return["file"] = $path_to_file;

            return $return;
        }

        return $return;
    }

    /**
     * Return country list from cache
     *
     * If cache is empty or expiries - wget_countries
     * Save update date in module settings
     *
     * @return array
     */
    public function getCacheCountries()
    {
        $expiried_period = $this->ci->pg_module->get_module_config('countries', 'countries_update_period');

        $lang_id = $this->ci->pg_language->current_lang_id;

        $last_update = $this->ci->pg_module->get_module_config('countries', 'countries_last_update');

        $langs_names = [];
        foreach ($this->ci->pg_language->languages as $i => $language) {
            $langs_names[] = 'lang_' . $language['id'];
        }

        $this->ci->db->select(implode(", ", array_merge($this->cache_attrs_country, $langs_names)))->from(CACHE_COUNTRIES_TABLE)->order_by('lang_' . $lang_id . ' ASC')->order_by('name ASC');
        $results = $this->ci->db->get()->result_array();

        if (empty($results) || (!empty($last_update) && $last_update + $expiried_period < time()) || empty($last_update)) {
            $results = $this->wgetCountries();
            if (empty($results)) {
                return [];
            }

            $counter = 0;
            $data_count = count($results);
            $this->ci->db->query('TRUNCATE TABLE ' . CACHE_COUNTRIES_TABLE . '');

            $start_sql = "INSERT INTO " . CACHE_COUNTRIES_TABLE . " (" . implode(',', array_merge(['code', 'name', 'areainsqkm', 'continent', 'currency', 'region_update_date'], $langs_names)) . ") VALUES  ";

            while ($counter < $data_count) {
                unset($strings);
                $temp_geo = array_slice($results, $counter, $this->db_insert_step);
                foreach ($temp_geo as $data) {
                    $lang_string = '';
                    foreach ($langs_names as $lang_name) {
                        $lang_string .= ", " . $this->ci->db->escape($data[$lang_name]);
                    }
                    $strings[] = "( '" . $data["code"] . "', " . $this->ci->db->escape($data["name"]) . ", '" . $data["areainsqkm"] . "', '" . $data["continent"] . "', '" . $data["currency"] . "', '" . $data["region_update_date"] . "'" . $lang_string . ")";
                }

                $query = $start_sql . implode(", ", $strings);
                $this->ci->db->query($query);
                $counter = $counter + $this->db_insert_step;
            }

            $this->ci->pg_module->set_module_config('countries', 'countries_last_update', time());
        }

        foreach ($results as $key => $result) {
            if (empty($result['lang_' . $lang_id])) {
                continue;
            }
            $results[$key]['name'] = $result['lang_' . $lang_id];
        }

        return $results;
    }

    /**
     * Return country object from cache by code
     *
     * @param string $country_code country code
     *
     * @return array
     */
    public function getCacheCountryByCode($country_code)
    {
        $langs_names = [];
        foreach ($this->ci->pg_language->languages as $i => $language) {
            $langs_names[] = 'lang_' . $language['id'];
        }
        $this->ci->db->select(implode(", ", array_merge($this->cache_attrs_country, $langs_names)))->from(CACHE_COUNTRIES_TABLE)->where("code", $country_code);
        $data = $this->ci->db->get()->result_array();
        if (!empty($data)) {
            $lang_id = $this->ci->pg_language->current_lang_id;
            if (!empty($data[0]['lang_' . $lang_id])) {
                $data[0]['name'] = $data[0]['lang_' . $lang_id];
            }

            return $data[0];
        }

        return [];
    }

    /**
     * Install cities
     *
     * @param array $country_codes
     *
     * @return void
     */
    public function installCitiesForCountry($country_codes)
    {
        if (!empty($country_codes)) {
            foreach ($country_codes as $country_code) {
                $country_cache_data = $this->getCacheCountryByCode($country_code);
                if (!$country_cache_data) {
                    $this->getCacheCountries();
                }

                $regions_list = $this->getCacheRegions($country_code);
                if ($regions_list) {
                    foreach ($regions_list as $region) {
                        $this->temp_server_city_id = 0;
                        $this->installCities($country_code, $region['code'], $this->ci->pg_language->languages);
                    }
                }
            }
        }
    }

    /**
     * Return region list from cache
     *
     * If cache is empty or expiries - wget_regions
     * Save update date in cache region table
     *
     * @param string $country_code       country code
     * @param array  $country_cache_data country data from cache
     *
     * @return array
     */
    public function getCacheRegions($country_code, $country_cache_data = [])
    {
        $expiried_period = $this->ci->pg_module->get_module_config('countries', 'countries_update_period');

        if (empty($country_cache_data)) {
            $country_cache_data = $this->get_cache_country_by_code($country_code);
        }

        $lang_id = $this->ci->pg_language->current_lang_id;

        $last_update = (!empty($country_cache_data["region_update_date"])) ? $country_cache_data["region_update_date"] : "0000-00-00 00:00:00";
        $last_update = intval(strtotime($last_update));

        $langs_names = [];
        foreach ($this->ci->pg_language->languages as $i => $language) {
            $langs_names[] = 'lang_' . $language['id'];
        }

        $this->ci->db->select(implode(", ", array_merge($this->cache_attrs_region, $langs_names)))->from(CACHE_REGIONS_TABLE)->where('country_code', $country_code)->order_by('lang_' . $lang_id . ' ASC')->order_by('code ASC');
        $results = $this->ci->db->get()->result_array();

        if (empty($results) || (!empty($last_update) && $last_update + $expiried_period < time()) || empty($last_update)) {
            $results = $this->wgetRegions($country_code);
            if (empty($results)) {
                return [];
            }

            $counter = 0;
            $data_count = count($results);
            $this->ci->db->where('country_code', $country_code);
            $this->ci->db->delete(CACHE_REGIONS_TABLE);

            $start_sql = "INSERT INTO " . CACHE_REGIONS_TABLE . " (" . implode(',', array_merge(['country_code', 'code', 'id_region', 'name'], $langs_names)) . ") VALUES  ";

            while ($counter < $data_count) {
                unset($strings);
                $temp_geo = array_slice($results, $counter, $this->db_insert_step);
                foreach ($temp_geo as $data) {
                    $lang_string = '';
                    foreach ($langs_names as $lang_name) {
                        if (!empty($data[$lang_name])) {
                            $lang_string .= ", " . $this->ci->db->escape($data[$lang_name]);
                        }
                    }
                    $strings[] = "('" . $data["country_code"] . "', '" . $data["code"] . "', '" . $data["id_region"] . "', " . $this->ci->db->escape($data["name"]) . "" . $lang_string . ")";
                }

                $query = $start_sql . implode(", ", $strings);
                $this->ci->db->query($query);
                $counter = $counter + $this->db_insert_step;
            }

            $cdata["region_update_date"] = date('Y-m-d H:i:s');
            $this->ci->db->where("code", $country_code);
            $this->ci->db->update(CACHE_COUNTRIES_TABLE, $cdata);
        }

        foreach ($results as $key => $result) {
            if (empty($result['lang_' . $lang_id])) {
                continue;
            }
            $results[$key]['name'] = $result['lang_' . $lang_id];
        }

        return $results;
    }

    /**
     * Return region object from cache by code
     *
     * @param string $country_code country code
     * @param string $region_code  region code
     *
     * @return array
     */
    public function getCacheRegionByCode($country_code, $region_code)
    {
        $langs_names = [];
        foreach ($this->ci->pg_language->languages as $i => $language) {
            $langs_names[] = 'lang_' . $language['id'];
        }
        $this->ci->db->select(implode(", ", array_merge($this->cache_attrs_region, $langs_names)))->from(CACHE_REGIONS_TABLE)->where("country_code", $country_code)->where("code", $region_code);
        $data = $this->ci->db->get()->result_array();
        if (!empty($data)) {
            $lang_id = $this->ci->pg_language->current_lang_id;
            if (!empty($data[0]['lang_' . $lang_id])) {
                $data[0]['name'] = $data[0]['lang_' . $lang_id];
            }

            return $data[0];
        }

        return [];
    }

    public function getAllCountries()
    {
        if ($this->countries_all === null) {
            $fields = $this->attrs_country;

            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                $fields[] = 'lang_' . $lid;
            }

            $this->countries_all = $this->ci->cache->get(COUNTRIES_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(COUNTRIES_TABLE)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return [];
                }

                return $results_raw;
            });
        }

        return $this->countries_all;
    }

    /**
     * Return countries objects as array
     *
     * return installed countries
     *
     * @param array   $order_by          sorting data
     * @param array   $params            filters data
     * @param array   $filter_object_ids filters identifiers
     * @param integer $lang_id           language identifier
     *
     * @return array
     */
    public function getCountries($order_by = [], $params = [], $filter_object_ids = [], $lang_id = false)
    {
        if (empty($params) && empty($order_by)) {
            // TODO: cache
            $results_raw = $this->getAllCountries();

            if (empty($filter_object_ids)) {
                $filter_object_ids = [];
            }

            foreach ($results_raw as $index => $result_raw) {
                if (in_array($result_raw['id'], $filter_object_ids)) {
                    unset($results_raw[$index]);
                }
            }
        } else {
            $fields = $this->attrs_country;

            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                $fields[] = 'lang_' . $lid;
            }

            $this->ci->db->select(implode(", ", $fields))->from(COUNTRIES_TABLE);

            if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
                foreach ($params["where"] as $field => $value) {
                    $this->ci->db->where($field, $value);
                }
            }

            if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
                foreach ($params["where_in"] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
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
                    if (in_array($field, $fields)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }

            $results_raw = $this->ci->db->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                $results_raw = [];
            }
        }

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $results = [];
        foreach ($results_raw as $result_raw) {
            $result_raw['name'] = $result_raw['lang_' . $lang_id];
            $results[$result_raw['code']] = $result_raw;
            $this->country_cache[$result_raw['code']] = $result_raw;
        }

        return $results;
    }

    public function getCountriesByCode($filter_object_ids = [], $lang_id = false)
    {
        // TODO: get all records from data source to cache
        $results_raw = $this->getAllCountries();

        if (!$lang_id) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $results = [];

        foreach ($results_raw as $result_raw) {
            $result_raw['name'] = $result_raw['lang_' . $lang_id];
            $results[$result_raw['code']] = $result_raw;
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $results = array_intersect_key($results, array_flip($filter_object_ids));
        }

        return $results;
    }

    /**
     * Return number of countries
     *
     * @param array $params filters parameters
     *
     * @return integer
     */
    public function getCountriesCount($params = [])
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(COUNTRIES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function getAllRegions()
    {
        if ($this->regions_all === null) {
            $fields = $this->attrs_region;

            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                $fields[] = 'lang_' . $lid;
            }

            $this->regions_all = $this->ci->cache->get(REGIONS_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(REGIONS_TABLE)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return [];
                }

                return $results_raw;
            });
        }

        return $this->regions_all;
    }

    /**
     * Return regions objects as array
     *
     * @param string  $country_code      country code
     * @param array   $order_by          sorting data
     * @param array   $params            filters parameters
     * @param array   $filter_object_ids filters identifiers
     * @param integer $lang_id           language identifier
     *
     * @return array
     */
    public function getRegions($country_code, $order_by = [], $params = [], $filter_object_ids = [], $lang_id = false)
    {
        if (empty($params) && empty($order_by)) {
            // TODO: cache
            $results_raw = $this->getAllRegions();

            if (empty($filter_object_ids)) {
                $filter_object_ids = [];
            }

            foreach ($results_raw as $index => $result_raw) {
                if ($result_raw['country_code'] != $country_code && !in_array($result_raw['id'], $filter_object_ids)) {
                    unset($results_raw[$index]);
                }
            }
        } else {
            $fields = $this->attrs_region;
            if ($lang_id !== false) {
                $fields[] = 'lang_' . $lang_id;
            } else {
                foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                    $fields[] = 'lang_' . $lid;
                }
            }

            $this->ci->db->select(implode(", ", $fields))
                ->from(REGIONS_TABLE)
                ->where("country_code", $country_code);

            if (isset($params["where"]) && is_array($params["where"])) {
                foreach ($params["where"] as $field => $value) {
                    $this->ci->db->where($field, $value);
                }
            }

            if (isset($params["where_in"]) && is_array($params["where_in"])) {
                foreach ($params["where_in"] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
                }
            }

            if (isset($params["where_sql"]) && is_array($params["where_sql"])) {
                foreach ($params["where_sql"] as $value) {
                    $this->ci->db->where($value);
                }
            }

            if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids) > 0) {
                $this->ci->db->where_in("id", $filter_object_ids);
            }

            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $fields)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }

            $results_raw = $this->ci->db->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                $results_raw = [];
            }
        }

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $results = [];

        foreach ($results_raw as $result_raw) {
            $result_raw['name'] = $result_raw['lang_' . $lang_id];
            $results[$result_raw['id']] = $result_raw;
        }

        return $results;
    }

    /**
     * Return region objects by identifiers
     *
     * @param array   $filter_object_ids region identifiers
     * @param integer $lang_id           language identifier
     *
     * @return array
     */
    public function getRegionsById($filter_object_ids = [], $lang_id = false)
    {
        if (empty($filter_object_ids) || !is_array($filter_object_ids)) {
            return [];
        }

        $results_raw = $this->getAllRegions();

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $results = [];

        foreach ($results_raw as $result_raw) {
            if (in_array($result_raw['id'], $filter_object_ids)) {
                $result_raw['name'] = $result_raw['lang_' . $lang_id];
                $results[$result_raw['id']] = $result_raw;
            }
        }

        return $results;
    }

    /**
     * Return region objects by code
     *
     * @param string $country_code      country code
     * @param array  $order_by          sorting data
     * @param array  $params            filters parameters
     * @param array  $filter_object_ids filters identifiers
     *
     * @return array
     */
    public function getRegionsByCode($country_code, $order_by = [], $params = [], $filter_object_ids = [])
    {
        $data = [];
        $regions = $this->get_regions($country_code, $order_by, $params, $filter_object_ids);
        if (!empty($regions) && is_array($regions)) {
            foreach ($regions as $r) {
                if (!empty($r["code"])) {
                    $data[$r["code"]] = $r;
                }
            }
        }

        return $data;
    }

    /**
     * Return cities objects as array
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     results per page
     * @param array   $order_by          sorting data
     * @param array   $params            filters parameters
     * @param array   $filter_object_ids filters identifiers
     * @param integer $lang_id           language identifier
     *
     * @return array
     */
    public function getCities($page = null, $items_on_page = null, $order_by = [], $params = [], $filter_object_ids = [], $lang_id = false, /* DPC-4769 */ $is_sort_id = false /* /DPC-4769 */)
    {
        /// return installed cities

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $select_attrs = $this->attrs_city;
        if ($lang_id) {
            $select_attrs = array_diff($select_attrs, ['name']);
            $select_attrs[] = 'lang_' . $lang_id . ' as name';
        }

        $this->ci->db->select(implode(", ", $select_attrs))->from(CITIES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
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
            if (isset($order_by['custom_order_by'])) {
                $this->ci->db->order_by($order_by['custom_order_by']);
            } else {
                $all_fields = $this->attrs_city;
                foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
                    $all_fields[] = 'lang_' . $lang_id;
                }
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $all_fields)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }
        } elseif (!empty($order_by)) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            $data = [];
            /* DPC-4769 */
            if ($is_sort_id) {
                return $results;
            }
            foreach ($results as $r) {
                $this->city_cache[$r['id']] = $data[$r['id']] = $r;
            }

            /* /DPC-4769 */
            return $data;
        }

        return [];
    }

    /**
     * Return number of cities
     *
     * @param array $params            filters parameters
     * @param array $filter_object_ids filters identifiers
     *
     * @return integer
     */
    public function getCitiesCount($params = [], $filter_object_ids = [])
    {
        /// return installed cities
        $this->ci->db->select("COUNT(*) AS cnt")->from(CITIES_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     * Return cities objects as array
     *
     * @param array   $filter_object_ids filters identifiers
     * @param integer $lang_id           language identifier
     *
     * @return array
     */
    public function getCitiesById($filter_object_ids = [], $lang_id = false)
    {
        if (empty($filter_object_ids) || !is_array($filter_object_ids)) {
            return [];
        }

        $fields = $this->attrs_city;

        foreach ($this->ci->pg_language->languages as $l_id => $lang_data) {
            $fields[] = 'lang_' . $l_id;
        }

        $get_data_callback = function ($filter_object_ids, $resort_by_keys = false) use ($fields) {
            $ci = &get_instance();

            $results_raw = $ci->db->select(implode(", ", $fields))
                ->from(CITIES_TABLE)
                ->where_in("id", $filter_object_ids)
                ->get()
                ->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                return [];
            }

            if ($resort_by_keys) {
                $results = [];

                foreach ($results_raw as $result_raw) {
                    $results[$result_raw['id']] = $result_raw;
                }
            } else {
                $results = $results_raw;
            }

            return $results;
        };

        $results = $this->ci->cache->mget(CITIES_TABLE, $filter_object_ids, $get_data_callback);

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $format_results = [];
        foreach ($results as &$result) {
            $result['name'] = $result['lang_' . $lang_id];
            $format_results[$result['id']] = $result;
        }

        return $format_results;
    }

    /**
     * Return cities objects by radius
     *
     * @param float   $lat               point latitude
     * @param float   $lon               point longitude
     * @param integer $radius            search radius
     * @param string  $radius_type       radius measurement
     * @param integer $page              page of results
     * @param integer $items_on_page     results per page
     * @param array   $params            filters parameters
     * @param array   $filter_object_ids filters identifiers
     *
     * @return array
     */
    public function getCitiesByRadius($lat, $lon, $radius = 10, $radius_type = "km", $page = null, $items_on_page = null, $params = [], $filter_object_ids = [])
    {
        $lang_id = $this->ci->pg_language->current_lang_id;

        $select_attrs = $this->attrs_city;
        $select_attrs = array_diff($select_attrs, ['name']);
        $select_attrs[] = 'lang_' . $lang_id . ' as name';

        /// return installed cities
        $this->ci->db->select(implode(", ", $select_attrs))->from(CITIES_TABLE);

        $radius = ($radius_type == "mile") ? $radius : $radius * 0.6213712;
        $this->ci->db->where('(POW((69.1*(lon-"' . $lon . '")*cos(' . $lat . '/57.3)),"2")+POW((69.1*(lat-"' . $lat . '")),"2"))<(' . ($radius * $radius) . ')');

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
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

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $data = [];
            foreach ($results as $r) {
                $this->city_cache[$r['id']] = $data[$r['id']] = $r;
            }

            return $data;
        }

        return [];
    }

    /**
     * Return country object by code
     *
     * @param string  $country_code country code
     * @param integer $lang_id      language identifier
     * @param array   $languages    languages data
     *
     * @return array
     */
    public function getCountry($country_code, $lang_id = false, $languages = [])
    {
        /// return installed country

        $cache_enabled = false;

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $select_attrs = $this->attrs_country;
        if ($lang_id) {
            $select_attrs = array_diff($select_attrs, ['name']);
            $select_attrs[] = 'lang_' . $lang_id . ' as name';
            $cache_enabled = true;
        }
        if (!empty($languages)) {
            foreach ($languages as $id => $value) {
                $select_attrs[] = 'lang_' . $id . ' as lang_' . $id;
            }
            $cache_enabled = false;
        }

        if ($cache_enabled && isset($this->country_cache[$country_code])) {
            return $this->country_cache[$country_code];
        }

        $this->ci->db->select(implode(", ", $select_attrs))->from(COUNTRIES_TABLE)->where("code", $country_code);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            if ($cache_enabled) {
                $this->country_cache[$country_code] = $results[0];
            }

            return $results[0];
        }

        return [];
    }

    /**
     * Return country object by identifier
     *
     * @param integer $country_id country identifier
     *
     * @return array
     */
    public function getCountryById($country_id)
    {
        /// return installed country
        $this->ci->db->select(implode(", ", $this->attrs_country))->from(COUNTRIES_TABLE)->where("id", $country_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return [];
    }

    /**
     * Return region object by identifier
     *
     * @param integer $region_id region identifier
     * @param integer $lang_id   language identifier
     * @param array   $languages languages data
     *
     * @return array
     */
    public function getRegion($region_id, $lang_id = false, $languages = [])
    {
        /// return installed region

        $cache_enabled = false;

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $select_attrs = $this->attrs_region;
        if ($lang_id) {
            $select_attrs = array_diff($select_attrs, ['name']);
            $select_attrs[] = 'lang_' . $lang_id . ' as name';
            $cache_enabled = true;
        }
        if (!empty($languages)) {
            foreach ($languages as $id => $value) {
                $select_attrs[] = 'lang_' . $id . ' as lang_' . $id;
            }
            $cache_enabled = false;
        }

        if ($cache_enabled && isset($this->region_cache[$region_id])) {
            return $this->region_cache[$region_id];
        }

        $this->ci->db->select(implode(", ", $select_attrs))->from(REGIONS_TABLE)->where("id", $region_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            if ($cache_enabled) {
                $this->region_cache[$region_id] = $results[0];
            }

            return $results[0];
        }

        return [];
    }

    /**
     * Return region object by code
     *
     * @param string $region_code  region code
     * @param string $country_code country code
     *
     * @return array
     */
    public function getRegionByCode($region_code, $country_code = null)
    {
        /// return installed region
        $this->ci->db->select(implode(", ", $this->attrs_region));
        $this->ci->db->from(REGIONS_TABLE);
        if ($country_code) {
            $this->ci->db->where("country_code", $country_code);
        }
        $this->ci->db->where("code", $region_code);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return [];
    }

    /**
     * Return city object by identifier
     *
     * @param integer $city_id   city identifier
     * @param integer $lang_id   language identifier
     * @param array   $languages languages data
     *
     * @return array
     */
    public function getCity($city_id, $lang_id = false, $languages = [])
    {
        $fields = $this->attrs_city;

        if ($lang_id === false) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $select_attrs = $this->attrs_region;
        if ($lang_id) {
            $fields[] = 'lang_' . $lang_id;
        }

        if (!empty($languages)) {
            foreach ($languages as $id => $value) {
                $fields[] = 'lang_' . $id;
            }
        }

        // TODO: cache
        $result = $this->ci->cache->get(CITIES_TABLE, $city_id, function () use ($fields, $city_id) {
            $ci = &get_instance();

            $result = $ci->db->select(implode(", ", $fields))
                ->from(CITIES_TABLE)
                ->where("id", $city_id)
                ->get()->result_array();

            if (empty($result)) {
                return null;
            }

            return $result[0];
        });

        if ($result === null) {
            return false;
        }

        $result['name'] = $result['lang_' . $lang_id];

        return $result;
    }

    private function getQueryStringForLangs($value, array $languages = [])
    {
        $where = [];
        foreach ($languages as $lid => $lang_value) {
            $where[] = "lang_" . $lid . " like " . $this->ci->db->escape('%' . $value . '%');
        }

        return implode(' OR ', $where);
    }

    /**
     * Return location objects as array
     *
     * @param string  $loc_name  location name
     * @param array   $order_by  sorting data
     * @param integer $lang_id   language identifier
     * @param array   $languages languages data
     * @param integer $country   country identifier
     * @param integer $region    region identifier
     * @param integer $city      city identifier
     *
     * @return array
     */
    public function getLocations($loc_name, $order_by = [], $lang_id = false, $languages = [], $country = null, $region = null, $city = null, $limit = 50, $is_search = 0)
    {
        $return = [];
        if ($loc_name) {
            $where_str = '';
            $loc_names = [];
            if (!is_array($loc_name)) {
                $loc_name = trim($loc_name);
                $filter = [',', '.', '?', '!', '+', '-', '–', '—', '/', '\\', '-'];
                $loc_names[] = $loc_name;
                $loc_names[] = preg_replace('/\s+/', ' ', str_ireplace($filter, ' ', $loc_name));
            }

            foreach ($loc_names as $loc_subname) {
                if (empty($loc_subname)) {
                    continue;
                }
                if (strlen($where_str) > 0) {
                    $where_str .=  " OR";
                }
                $where_str .= " name like " . $this->ci->db->escape($loc_subname . '%') . " ";
                $query_string_for_langs = $this->getQueryStringForLangs($loc_subname, $languages);
                if ($query_string_for_langs) {
                    $where_str .=  'OR ' . $query_string_for_langs;
                }
            }
        }

        // Search in countries
        if (!$country) {
            $select_attrs = $this->attrs_country;
            if ($lang_id) {
                $select_attrs = array_diff($select_attrs, ['name']);
                $select_attrs[] = 'lang_' . $lang_id . ' as name';
            }

            $this->ci->db->select(implode(", ", $select_attrs))->from(COUNTRIES_TABLE);

            if ($where_str) {
                $this->ci->db->where($where_str, null, false);
            }

            $this->ci->db->limit($limit);
            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->attrs_country)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            } else {
                $this->ci->db->order_by($order_by);
            }

            $results = $this->ci->db->get()->result_array();
            $return['countries'] = $results ? $results : [];

            if (!empty($return['countries'])) {
                $this->ci->load->helper('countries');
                $locations_ids = [];

                foreach ($return['countries'] as $key => $row_countries) {
                    $locations_ids[$key] = [
                        'country' => $row_countries['code'],
                    ];

                    $list_locations = countries_output_format($locations_ids);
                    $return['countries'][$key]['name'] = $list_locations[$key];
                }
            }
        } else {
            $return['countries'] = [];
        }

        // Search in regions
        if (!$region) {
            $select_attrs = $this->attrs_region;
            if ($lang_id) {
                $select_attrs = array_diff($select_attrs, ['name']);
                $select_attrs[] = 'lang_' . $lang_id . ' as name';
            }

            $this->ci->db->select(implode(", ", $select_attrs))->from(REGIONS_TABLE);
            if ($country) {
                $this->ci->db->where('country_code', $country);
            }
            if ($where_str) {
                $this->ci->db->where('(' . $where_str . ')', null, false);
            }
            $this->ci->db->limit($limit);

            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->attrs_region)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }
            $results = $this->ci->db->get()->result_array();
            $return['regions'] = $results ? $results : [];

            if (!empty($return['regions'])) {
                $this->ci->load->helper('countries');
                $locations_ids = [];

                foreach ($return['regions'] as $key => $row_region) {
                    $locations_ids[$key] = [
                        'country' => $row_region['country_code'],
                        'region'  => $row_region['id'],
                    ];

                    $list_locations = regions_output_format($locations_ids);
                    $return['regions'][$key]['name'] = $list_locations[$key];
                }
            }
        } else {
            $return['regions'] = [];
        }

        // Search in cities
        if (!$city) {
            $select_attrs = $this->attrs_city;
            if ($lang_id) {
                $select_attrs = array_diff($select_attrs, ['name']);
                $select_attrs[] = 'lang_' . $lang_id . ' as name';
            }
            $this->ci->db->select(implode(", ", $select_attrs))->from(CITIES_TABLE);
            if ($country) {
                $this->ci->db->where('country_code', $country);
            }
            if ($region) {
                $this->ci->db->where('id_region', $region);
            }
            if ($where_str) {
                $this->ci->db->where('(' . $where_str . ')', null, false);
            }
            $this->ci->db->limit($limit);
            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->attrs_city)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }
            $results = $this->ci->db->get()->result_array();
            $return['cities'] = $results ? $this->formatCities($results) : [];
            if ($return['cities'] && $is_search != 1) {
                $return['countries'] = $return['regions'] = [];
            }
        } else {
            $return['cities'] = [];
        }

        if ($is_search != 1) {
            if (empty($return['cities']) && (count($return['countries']) == 1 || count($return['regions']) == 1)) {
                $this->ci->db->select(implode(", ", $select_attrs))->from(CITIES_TABLE);
                if (isset($return['countries'][0]['code'])) {
                    $this->ci->db->where('country_code', $return['countries'][0]['code']);
                }
                if (isset($return['regions'][0]['id'])) {
                    $this->ci->db->where('id_region', $return['regions'][0]['id']);
                }
                $this->ci->db->limit($limit);
                if (is_array($order_by) && count($order_by) > 0) {
                    foreach ($order_by as $field => $dir) {
                        if (in_array($field, $this->attrs_city)) {
                            $this->ci->db->order_by($field . " " . $dir);
                        }
                    }
                }
                $results = $this->ci->db->get()->result_array();
                $return['cities'] = $results ? $this->formatCities($results) : [];

                $return['countries'] = $return['regions'] = [];
            }
        }

        // Search in districts
        $use_district = $this->ci->pg_module->get_module_config('countries', 'use_district');
        if ($use_district) {
            $select_attrs = $this->attrs_district;
            if ($lang_id) {
                $select_attrs = array_diff($select_attrs, ['name']);
                $select_attrs[] = 'lang_' . $lang_id . ' as name';
            }
            $this->ci->db->select(implode(", ", $select_attrs))->from(DISTRICTS_TABLE);
            if ($country) {
                $this->ci->db->where('country_code', $country);
            }
            if ($region) {
                $this->ci->db->where('id_region', $region);
            }
            if ($city) {
                $this->ci->db->where('id_city', $city);
            }
            if ($where_str) {
                $this->ci->db->where('(' . $where_str . ')', null, false);
            }
            $this->ci->db->limit(50);
            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->attrs_city)) {
                        $this->ci->db->order_by($field . " " . $dir);
                    }
                }
            }
            $results = $this->ci->db->get()->result_array();
            $return['districts'] = $results ? $results : [];

            if (!empty($return['districts'])) {
                $this->ci->load->helper('countries');
                $locations_ids = [];

                foreach ($return['districts'] as $key => $row_districts) {
                    $locations_ids[$key] = [
                        'country'  => $row_districts['country_code'],
                        'region'   => $row_districts['id_region'],
                        'city'     => $row_districts['id_city'],
                        'district' => $row_districts['id'],
                    ];

                    $list_locations = districts_output_format($locations_ids);
                    $return['districts'][$key]['name'] = $list_locations[$key];
                }
            }
        } else {
            $return['districts'] = [];
        }

        return $return;
    }

    public function formatCities($data = [])
    {
        if (!empty($data)) {
            $this->ci->load->helper('countries');
            $locations_ids = [];

            foreach ($data as $key => $row_cities) {
                $locations_ids[$key] = [
                    'country' => $row_cities['country_code'],
                    'region'  => $row_cities['id_region'],
                    'city'    => $row_cities['id'],
                ];
            }

            $list_locations = cities_output_format($locations_ids);
            foreach ($list_locations as $key => $location) {
                $data[$key]['name'] = $location;
            }
        }

        return $data;
    }

    /**
     * Fill locations with parents
     *
     * @param array  $locations
     * @param string $attrs_country
     * @param string $attrs_region
     *
     * @return array
     */
    private function fillParents(&$locations, $attrs_country, $attrs_region)
    {
        $country_codes = array_keys($locations['countries']);
        $region_codes = array_keys($locations['regions']);
        $req_country_codes = [];
        $req_region_ids = [];
        $missing_countries = [];
        $missing_regions = [];

        $set_country_code = function (&$location) use ($country_codes, $locations, &$req_country_codes) {
            if (in_array($location['country_code'], $country_codes)) {
                $location['country'] = &$locations['countries'][$location['country_code']];
            } else {
                $req_country_codes[] = $location['country_code'];
            }
        };
        foreach ($locations['cities'] as &$city) {
            $set_country_code($city);
            if (in_array($city['id_region'], $region_codes)) {
                $city['region'] = &$locations['regions'][$city['id_region']];
            } else {
                $req_region_ids[] = $city['id_region'];
            }
        }
        foreach ($locations['regions'] as &$region) {
            $set_country_code($region);
        }
        if (!empty($req_country_codes)) {
            $this->ci->db->select(implode(', ', $attrs_country))
                ->from(COUNTRIES_TABLE)
                ->where_in('code', array_unique($req_country_codes));
            foreach ($this->ci->db->get()->result_array() as $country) {
                $missing_countries[$country['code']] = $country;
            }
        }
        if (!empty($req_region_ids)) {
            $this->ci->db->select(implode(', ', $attrs_region))
                ->from(REGIONS_TABLE)
                ->where_in('id', $req_region_ids);
            foreach ($this->ci->db->get()->result_array() as $missing_region) {
                $missing_regions[$missing_region['code']] = $missing_region;
            }
        }

        foreach ($locations['cities'] as &$city) {
            if (empty($city['country']) && !empty($missing_countries[$city['country_code']])) {
                $city['country'] = $missing_countries[$city['country_code']];
            }
            if (empty($city['region']) && !empty($missing_regions[$city['region_code']])) {
                $city['region'] = $missing_regions[$city['region_code']];
            }
        }
        foreach ($locations['regions'] as &$region) {
            if (empty($region['country']) && !empty($missing_countries[$region['country_code']])) {
                $region['country'] = $missing_countries[$region['country_code']];
            }
        }

        return $locations;
    }

    public function getRegionByName($region_name, $country_code = null, $lang_id = null)
    {
        if (is_null($lang_id)) {
            $where_str = "`name` LIKE " . $this->ci->db->escape('%' . $region_name . '%');
        } elseif (is_array($lang_id)) {
            foreach ($lang_id as $id) {
                $where_str[] = "`lang_$id` LIKE " . $this->ci->db->escape('%' . $region_name . '%');
            }
            $where_str = implode(' OR ', $where_str);
        } else {
            $where_str = "`lang_$lang_id` LIKE " . $this->ci->db->escape('%' . $region_name . '%');
        }
        if ($country_code) {
            $where_str = "($where_str) AND `country_code` = " . $this->ci->db->escape($country_code);
        }

        $results = $this->ci->db->select(implode(", ", $this->attrs_region))
                ->from(REGIONS_TABLE)
                ->where($where_str, null, false)
                ->limit(1)
                ->get()->result_array();
        if ($results) {
            return $results[0];
        }
        [];
    }

    public function getCityByName($city_name, $region_id = null, $country_code = null, $lang_id = null)
    {
        if (is_null($lang_id)) {
            $where_str = "`name` LIKE " . $this->ci->db->escape('%' . $city_name . '%');
        } elseif (is_array($lang_id)) {
            foreach ($lang_id as $id) {
                $where_str[] = "`lang_$id` LIKE " . $this->ci->db->escape('%' . $city_name . '%');
            }
            $where_str = implode(' OR ', $where_str);
        } else {
            $where_str = "`lang_$lang_id` LIKE " . $this->ci->db->escape('%' . $city_name . '%');
        }
        if ($region_id) {
            $where_str = "($where_str) AND `id_region` = " . $this->ci->db->escape($region_id);
        }
        if ($country_code) {
            $where_str = "($where_str) AND `country_code` = " . $this->ci->db->escape($country_code);
        }

        $results = $this->ci->db->select(implode(", ", $this->attrs_city))
                ->from(CITIES_TABLE)
                ->where($where_str, null, false)
                ->limit(1)
                ->get()->result_array();
        if ($results) {
            return $results[0];
        }
        [];
    }

    public function installCountry($country_code, $action = 'add')
    {
        $country_data = $this->get_cache_country_by_code($country_code);
        if (empty($country_data)) {
            return false;
        }
        $insert_data = [
            'code'       => $country_code,
            'name'       => $country_data["name"],
            'areainsqkm' => $country_data["areainsqkm"],
            'continent'  => $country_data["continent"],
            'currency'   => $country_data["currency"],
            'priority'   => $this->get_country_max_priority(),
        ];

        foreach ($this->ci->pg_language->languages as $id => $value) {
            if (isset($country_data['lang_' . $id])) {
                $insert_data['lang_' . $id] = $country_data['lang_' . $id];
            } else {
                $insert_data['lang_' . $id] = $country_data['name'];
            }
        }

        $this->saveCountry($country_code, $insert_data, $action);
    }

    public function installCities($country_code, $region_code, $languages = [])
    {
        /// set country installed
        /// set region installed
        /// get region data(new id and region code)
        /// while wget_cities !== true||false => wget_cities and install sities (use_infile_city_install)

        $country_data = $this->get_country($country_code);
        if (!$country_data) {
            $country_data = $this->get_cache_country_by_code($country_code);
            if (empty($country_data)) {
                return false;
            }
            $insert_data = [
                'code'       => $country_code,
                'name'       => $country_data["name"],
                'areainsqkm' => $country_data["areainsqkm"],
                'continent'  => $country_data["continent"],
                'currency'   => $country_data["currency"],
                "priority"   => $this->get_country_max_priority(),
                "sorted"     => 0,
            ];
            if (is_array($languages) && count($languages) > 0) {
                foreach ($languages as $id => $value) {
                    $insert_data['lang_' . $id] = $country_data['lang_' . $id];
                }
            }
            $this->save_country($country_code, $insert_data, "add");
        }

        $cache_region_data = $this->get_cache_region_by_code($country_code, $region_code);
        if (!$cache_region_data) {
            return false;
        }
        $region_server_id = $cache_region_data["id_region"];

        $region_data = $this->get_region_by_code($region_code, $country_code);
        if (!$region_data) {
            $insert_data = [
                'country_code' => $country_code,
                'code'         => $region_code,
                'name'         => $cache_region_data["name"],
                "priority"     => $this->get_region_max_priority($country_code),
            ];
            if (is_array($languages) && count($languages) > 0) {
                foreach ($languages as $id => $value) {
                    $insert_data['lang_' . $id] = $cache_region_data['lang_' . $id];
                }
            }

            $id_region = $this->saveRegion(null, $insert_data);

            $region_data = $this->get_region($id_region);
        }

        $this->ci->db->where("id_region", $region_data["id"]);
        $this->ci->db->delete(CITIES_TABLE);

        $install_data = 'start';
        $max_itaration = 20;
        $itaration_counter = 0;

        if ($this->use_infile_city_install && is_array($languages) && count($languages) > 0) {
            $sql_query = "UPDATE " . CITIES_TABLE . " SET ";
            $sql_set = "";
            $sql_where = "";
            foreach ($languages as $id => $value) {
                $sql_set .= strlen($sql_set) > 0 ? ", lang_" . $id . " = name" : "lang_" . $id . " = name";
                $sql_where .= strlen($sql_where) ? " AND lang_" . $id . " = '' " : " lang_" . $id . " = '' ";
            }
            $languages_query = $sql_query . $sql_set . " WHERE " . $sql_where;

            if (isset($region_data["id"])) {
                $languages_query .= " AND id_region = " . $region_data["id"];
            }
        }

        while ($install_data !== true && $install_data !== false) {
            if ($itaration_counter > $max_itaration) {
                break;
            }
            $install_data = $this->wgetCities($country_code, $region_server_id, $region_data);

            ++$itaration_counter;
            if ($install_data !== true && $install_data !== false) {
                if ($this->use_infile_city_install) {
                    if (file_exists($install_data["file"])) {
                        $sql_result = $this->ci->db->simple_query("LOAD DATA INFILE '" . $install_data["file"] . "' INTO TABLE " . CITIES_TABLE . "  FIELDS TERMINATED BY '\t';");
                        if ($sql_result === false) {
                            $this->use_infile_city_install = false;
                        }
                    }
                }

                if (!$this->use_infile_city_install) {
                    $counter = 0;
                    $data_count = count($install_data["data"]);
                    $start_sql = "INSERT INTO " . CITIES_TABLE . " (id_region, name, latitude, longitude, country_code, region_code";
                    if (is_array($languages) && count($languages) > 0) {
                        foreach ($languages as $id => $value) {
                            $start_sql .= ", lang_" . $id;
                        }
                    }
                    $start_sql .= ") VALUES ";

                    while ($counter < $data_count) {
                        unset($strings);
                        $temp_geo = array_slice($install_data["data"], $counter, $this->city_install_step);
                        foreach ($temp_geo as $incity) {
                            $incity["name"] = trim($incity["name"]);
                            $incity["lang_" . $id] = trim($incity["lang_" . $id]);
                            $string = "(" . $this->ci->db->escape($region_data["id"]) . ", " . $this->ci->db->escape($incity["name"]) . ", " . $this->ci->db->escape($incity["latitude"]) . ", " . $this->ci->db->escape($incity["longitude"]) . ", " . $this->ci->db->escape($country_code) . ", " . $this->ci->db->escape($region_code) . "";
                            if (is_array($languages) && count($languages) > 0) {
                                foreach ($languages as $id => $value) {
                                    $string .= ", " . $this->ci->db->escape($incity["lang_" . $id]) . "";
                                }
                            }
                            $string .= ")";
                            $strings[] = $string;
                        }
                        $query = $start_sql . implode(", ", $strings);

                        $this->ci->db->query($query);

                        $counter = $counter + $this->city_install_step;
                    }
                }
            }
        }

        if ($this->use_infile_city_install && !empty($languages_query)) {
            $this->ci->db->query($languages_query);
        }

        return true;
    }

    public function saveCountry($country_code, $data, $type = "add")
    {
        if ($type == "add") {
            if ($country_code) {
                $data["code"] = $country_code;
            }
            $this->ci->db->insert(COUNTRIES_TABLE, $data);
        } else {
            $this->ci->db->where('code', $country_code);
            $this->ci->db->update(COUNTRIES_TABLE, $data);
        }

        // TODO: cache
        $this->ci->cache->flush(COUNTRIES_TABLE);

        $this->countries_all = null;
    }

    public function saveRegion($id_region, $data)
    {
        if (empty($id_region)) {
            $this->ci->db->insert(REGIONS_TABLE, $data);
            $id_region = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id_region);
            $this->ci->db->update(REGIONS_TABLE, $data);
        }

        // TODO: cache
        $this->ci->cache->flush(REGIONS_TABLE);

        $this->regions_all = null;

        return $id_region;
    }

    public function saveCity($id_city, $data)
    {
        if (empty($id_city)) {
            $this->ci->db->insert(CITIES_TABLE, $data);
            $id_city = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id_city);
            $this->ci->db->update(CITIES_TABLE, $data);
        }

        // TODO: cache
        $this->ci->cache->delete(CITIES_TABLE, $id_city);

        return $id_city;
    }

    public function deleteCountry($country_code)
    {
        $this->ci->db->where('code', $country_code);
        $this->ci->db->delete(COUNTRIES_TABLE);

        $this->ci->db->where('country_code', $country_code);
        $this->ci->db->delete(REGIONS_TABLE);

        $this->ci->db->where('country_code', $country_code);
        $this->ci->db->delete(CITIES_TABLE);

        $this->ci->cache->flush(COUNTRIES_TABLE);

        $this->countries_all = null;
    }

    public function deleteRegion($id_region)
    {
        $this->ci->db->where('id', $id_region);
        $this->ci->db->delete(REGIONS_TABLE);

        $this->ci->db->where('id_region', $id_region);
        $this->ci->db->delete(CITIES_TABLE);

        $this->ci->cache->flush(REGIONS_TABLE);

        $this->regions_all = null;
    }

    public function deleteCity($id_city)
    {
        $this->ci->db->where('id', $id_city);
        $this->ci->db->delete(CITIES_TABLE);

        $this->ci->cache->delete(CITIES_TABLE, $id_city);
    }

    public function validate($type, $id, $data)
    {
        $return = ["errors" => [], "data" => []];

        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('name', 'reg_exps');

        if ($type == "country") {
            if (empty($id) && empty($data["code"]) || !preg_match($name_expr, $data['code'])) {
                $return["errors"][] = l('error_code_empty', 'countries');
            } elseif (isset($data["code"])) {
                $return["data"]["code"] = strtoupper(substr(strip_tags($data["code"]), 0, 2));

                if (empty($id) || $id != $return["data"]["code"]) {
                    $params["where"]["code"] = $return["data"]["code"];
                    $countries = $this->get_countries([], $params);
                    if (!empty($countries)) {
                        $return["errors"][] = l('error_code_already_exists', 'countries');
                    }
                }
            }
        }

        if ($type == "region") {
            if (isset($data["country_code"])) {
                $return["data"]["country_code"] = strtoupper(substr(strip_tags($data["country_code"]), 0, 2));
                if (empty($return["data"]["country_code"])  || !preg_match($name_expr, $return["data"]["country_code"])) {
                    $return["errors"][] = l('error_code_empty', 'countries');
                }
            }

            if (isset($data["code"])) {
                $return["data"]["code"] = strip_tags($data["code"]);
                if (empty($return["data"]["code"]) || !preg_match($name_expr, $return["data"]["code"])) {
                    $return["errors"][] = l('error_region_code_empty', 'countries');
                }
            }
        }

        if ($type == "city") {
            if (isset($data["country_code"])) {
                $return["data"]["country_code"] = strtoupper(substr(strip_tags($data["country_code"]), 0, 2));
                if (empty($return["data"]["country_code"]) || !preg_match($name_expr, $return["data"]["country_code"])) {
                    $return["errors"][] = l('error_code_empty', 'countries');
                }
            }
            if (isset($data["region_code"])) {
                $return["data"]["region_code"] = strip_tags($data["region_code"]);
                if (empty($return["data"]["region_code"]) || !preg_match($name_expr, $return["data"]["region_code"])) {
                    $return["errors"][] = l('error_region_code_empty', 'countries');
                }
            }
            if (isset($data["id_region"])) {
                $return["data"]["id_region"] = intval($data["id_region"]);
                if (empty($return["data"]["id_region"])) {
                    $return["errors"][] = l('error_region_empty', 'countries');
                }
            }
            if (isset($data["latitude"])) {
                $return["data"]["latitude"] = strval($data["latitude"]);
            }
            if (isset($data["longitude"])) {
                $return["data"]["longitude"] = strval($data["longitude"]);
            }
        }

        if (isset($data["name"])) {
            $return["data"]["name"] = $data['langs'][$this->ci->pg_language->current_lang_id];
            if (empty($return["data"]["name"]) || !preg_match($name_expr, $return["data"]["name"])) {
                $return["errors"][] = l('error_name_empty', 'countries');
            }
        }

        if (isset($data['langs'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['langs']);
            if ($langs === false) {
                $return["errors"][] = l('error_name_empty', 'countries');
            } else {
                foreach ($langs as $id => $value) {
                    $return["data"]['lang_' . $id] = $value;
                }
            }
        }

        return $return;
    }

    public function getCountryMaxPriority()
    {
        $this->ci->db->select("MAX(priority) as max_priority")->from(COUNTRIES_TABLE);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["max_priority"]);
        }

        return 0;
    }

    public function getRegionMaxPriority($country_code)
    {
        $this->ci->db->select("MAX(priority) as max_priority")->from(REGIONS_TABLE)->where("country_code", $country_code);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["max_priority"]);
        }

        return 0;
    }

    /**
     * Return max priority of cities
     *
     * @param string $country_code country code
     * @param string $region_id    region identifier
     *
     * @return integer
     */
    public function getCityMaxPriority($country_code, $region_id)
    {
        $this->ci->db->select("MAX(priority) as max_priority")
            ->from(CITIES_TABLE)
            ->where("country_code", $country_code)
            ->where("id_region", $region_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["max_priority"]);
        }

        return 0;
    }

    /**
     * Save city object priority
     *
     * @param string  $city_id  city identifier
     * @param integer $priority priority value
     *
     * @return void
     */
    public function setCityPriority($city_id, $priority)
    {
        $data["priority"] = intval($priority);
        $data["sorted"] = 1;
        $this->ci->db->where("id", $city_id);
        $this->ci->db->update(CITIES_TABLE, $data);

        $this->ci->cache->flush(CITIES_TABLE);
    }

    /**
     * Save country object priority
     *
     * @param string  $country_code city identifier
     * @param integer $priority     priority value
     *
     * @return void
     */
    public function setCountryPriority($country_code, $priority)
    {
        $data["priority"] = intval($priority);
        $data["sorted"] = 1;
        $this->ci->db->where("code", $country_code);
        $this->ci->db->update(COUNTRIES_TABLE, $data);

        $this->ci->cache->flush(COUNTRIES_TABLE);
    }

    /**
     * Save region object priority
     *
     * @param string  $id_region region identifier
     * @param integer $priority  priority value
     *
     * @return void
     */
    public function setRegionPriority($id_region, $priority)
    {
        $data["priority"] = intval($priority);
        $data["sorted"] = 1;
        $this->ci->db->where("id", $id_region);
        $this->ci->db->update(REGIONS_TABLE, $data);

        $this->ci->cache->flush(REGIONS_TABLE, 'all');
    }

    /**
     * Save default countries object priority
     *
     * @param array $countries_array
     *
     * @return void
     */
    public function setDefaultPriorityToCountries($countries_array)
    {
        $data["priority"] = sizeof($countries_array) + 1;
        $data["sorted"] = 0;
        $this->ci->db->where_not_in("code", $countries_array);
        $this->ci->db->update(COUNTRIES_TABLE, $data);

        $this->ci->cache->flush(COUNTRIES_TABLE);
    }

    /**
     * Save default regions object priority
     *
     * @param string $country_code  country code
     * @param array  $regions_array
     *
     * @return void
     */
    public function setDefaultPriorityToRegions($country_code, $regions_array)
    {
        $data["priority"] = sizeof($regions_array) + 1;
        $data["sorted"] = 0;
        $this->ci->db->where("country_code", $country_code);
        if ($data["priority"] > 1) {
            $this->ci->db->where_not_in("id", $regions_array);
        }
        $this->ci->db->update(REGIONS_TABLE, $data);

        $this->ci->cache->flush(REGIONS_TABLE);
    }

    /**
     * Save default cities object priority
     *
     * @param string $country_code country code
     * @param string $id_region    region identifier
     * @param array  $cities_array
     *
     * @return void
     */
    public function setDefaultPriorityToCities($country_code, $id_region, $cities_array)
    {
        $data["priority"] = sizeof($cities_array) + 1;
        $data["sorted"] = 0;
        $this->ci->db->where("id_region", $id_region);
        $this->ci->db->where("country_code", $country_code);
        if ($data["priority"] > 1) {
            $this->ci->db->where_not_in("id", $cities_array);
        }
        $this->ci->db->update(CITIES_TABLE, $data);

        $this->ci->cache->flush(CITIES_TABLE);
    }

    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if ($lang_id !== false) {
            $this->ci->load->dbforge();
            $fields = [
                'lang_' . $lang_id => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => false,
                ]
            ];

            $this->ci->dbforge->add_column(COUNTRIES_TABLE, $fields);
            $this->ci->db->set('lang_' . $lang_id, 'name', false);
            $this->ci->db->update(COUNTRIES_TABLE);

            $this->ci->dbforge->add_column(REGIONS_TABLE, $fields);
            $this->ci->db->set('lang_' . $lang_id, 'name', false);
            $this->ci->db->update(REGIONS_TABLE);

            $this->ci->dbforge->add_column(CITIES_TABLE, $fields);
            $this->ci->db->set('lang_' . $lang_id, 'name', false);
            $this->ci->db->update(CITIES_TABLE);

            $this->ci->dbforge->add_column(CACHE_COUNTRIES_TABLE, $fields);
            $this->ci->db->set('lang_' . $lang_id, 'name', false);
            $this->ci->db->update(CACHE_COUNTRIES_TABLE);

            $this->ci->dbforge->add_column(CACHE_REGIONS_TABLE, $fields);
            $this->ci->db->set('lang_' . $lang_id, 'name', false);
            $this->ci->db->update(CACHE_REGIONS_TABLE);

            $this->ci->cache->flush(COUNTRIES_TABLE);
            $this->ci->cache->flush(REGIONS_TABLE);
            $this->ci->cache->flush(CITIES_TABLE);
        }
    }

    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if ($lang_id !== false) {
            $field_name = "lang_" . $lang_id;
            $this->ci->load->dbforge();

            if ($this->ci->db->field_exists($field_name, COUNTRIES_TABLE) !== false) {
                $this->ci->dbforge->drop_column(COUNTRIES_TABLE, $field_name);
            }
            if ($this->ci->db->field_exists($field_name, REGIONS_TABLE) !== false) {
                $this->ci->dbforge->drop_column(REGIONS_TABLE, $field_name);
            }
            if ($this->ci->db->field_exists($field_name, CITIES_TABLE) !== false) {
                $this->ci->dbforge->drop_column(CITIES_TABLE, $field_name);
            }

            if ($this->ci->db->field_exists($field_name, CACHE_COUNTRIES_TABLE) !== false) {
                $this->ci->dbforge->drop_column(CACHE_COUNTRIES_TABLE, $field_name);
            }
            if ($this->ci->db->field_exists($field_name, CACHE_REGIONS_TABLE) !== false) {
                $this->ci->dbforge->drop_column(CACHE_REGIONS_TABLE, $field_name);
            }

            $this->ci->cache->flush('countries');
            $this->ci->cache->flush('regions');
            $this->ci->cache->flush('cities');
        }
    }

    public function installDefaultCountriesData()
    {
        $this->get_cache_countries();
        $countries = $this->get_countries();
        foreach ($countries as $country) {
            $this->installCountry($country['code'], 'update');
        }
    }

    public static function getLocationText(array $country = null, array $region = null, array $city = null)
    {
        $location_text_arr = [];
        if (!empty($city['name'])) {
            $location_text_arr[] = $city['name'];
        }

        if (!empty($region['name']) && empty($city['name'])) {
            $location_text_arr[] = $region['name'];
        }

        if (!empty($country['name'])) {
            $location_text_arr[] = $country['name'];
        }

        return implode(', ', $location_text_arr);
    }

    public function getClosestCities($latitude = 0, $longitude = 0)
    {
        $query = $this->ci->db->query(
            self::queryDistance($latitude, $longitude)
        );

        return $query->result_array();
    }

    private static function queryDistance($lat, $lng)
    {
        return "SELECT *,
         (3959 * acos(cos(radians({$lat})) * cos(radians(" . CITIES_TABLE . ".latitude)) *
         cos(radians(" . CITIES_TABLE . ".longitude) - radians({$lng})) + sin(radians({$lat})) *
         sin(radians(" . CITIES_TABLE . ".latitude)))) AS distance
         FROM " . CITIES_TABLE . "
         HAVING distance < "  . self::DISTANCE . "
         ORDER BY distance LIMIT 0 , 10";
    }

    public function groupByName($data)
    {
        $result = [];
        foreach ($data as $item) {
            $letter = $item['name'][0];
            $result[lcfirst($letter)]['title'] = $letter . '...';
            $result[lcfirst($letter)]['list'][] = $item;
        }

        return $result;
    }

    public function cronOneTimeTasks()
    {
        $this->installCitiesForCountry();
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_city' => 'deleteCity',
            'delete_country' => 'deleteCountry',
            'delete_region' => 'deleteRegion',
            'get_cache_countries' => 'getCacheCountries',
            'get_cache_country_by_code' => 'getCacheCountryByCode',
            'get_cache_region_by_code' => 'getCacheRegionByCode',
            'get_cache_regions' => 'getCacheRegions',
            'get_cities' => 'getCities',
            'get_city' => 'getCity',
            'get_cities_by_id' => 'getCitiesById',
            'get_cities_by_radius' => 'getCitiesByRadius',
            'get_cities_count' => 'getCitiesCount',
            'get_countries' => 'getCountries',
            'get_city_by_name' => 'getCityByName',
            'get_city_max_priority' => 'getCityMaxPriority',
            'get_countries_by_code' => 'getCountriesByCode',
            'get_countries_count' => 'getCountriesCount',
            'get_country' => 'getCountry',
            'get_locations' => 'getLocations',
            'get_region' => 'getRegion',
            'get_country_by_id' => 'getCountryById',
            'get_country_max_priority' => 'getCountryMaxPriority',
            'get_region_by_code' => 'getRegionByCode',
            'get_region_by_name' => 'getRegionByName',
            'get_region_max_priority' => 'getRegionMaxPriority',
            'get_regions' => 'getRegions',
            'get_regions_by_code' => 'getRegionsByCode',
            'get_regions_by_id' => 'getRegionsById',
            'install_cities' => 'installCities',
            'install_country' => 'installCountry',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'save_region' => 'saveRegion',
            'save_city' => 'saveCity',
            'save_country' => 'saveCountry',
            'set_city_priority' => 'setCityPriority',
            'set_country_priority' => 'setCountryPriority',
            'set_default_priority_to_cities' => 'setDefaultPriorityToCities',
            'set_default_priority_to_countries' => 'setDefaultPriorityToCountries',
            'set_default_priority_to_regions' => 'setDefaultPriorityToRegions',
            'set_region_priority' => 'setRegionPriority',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
