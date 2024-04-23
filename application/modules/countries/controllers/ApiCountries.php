<?php

declare(strict_types=1);

namespace Pg\modules\countries\controllers;

/**
 * Countries api controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 * */
class ApiCountries extends \Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Countries_model');
    }

    /**
     * Returns locations
     *
     * @param string name
     */
    /**
    * @api {post} /countries/getLocations Get locations
    * @apiGroup Countries
    * @apiParam {string} name  location name
    */
    public function getLocations()
    {
        $name = $this->input->post('name', true);
        $data = [];
        if ($name) {
            $locations = $this->Countries_model->get_locations($name, ['priority' => 'ASC'], $this->pg_language->current_lang_id, $this->pg_language->languages);
            $data['count'] = count($locations['countries']) + count($locations['regions']) + count($locations['cities']);
            $data['items'] = $locations ? $locations : [];
            $this->set_api_content('data', ['name' => $name, 'data' => $data]);
        } else {
            $this->set_api_content('error', l('error_name_empty', 'countries'));
        }
    }

    /**
     * Returns countries list
     */
    /**
    * @api {post} /countries/getCountries Get countries list
    * @apiGroup Countries
    */
    public function getCountries()
    {
        $countries = $this->Countries_model->getCountries(
            ['priority' => 'ASC', 'lang_' . $this->pg_language->current_lang_id => 'ASC'],
            [],
            [],
            $this->pg_language->current_lang_id
        );
        $count = count($countries);
        if ($count) {
            $data = [];
            foreach ($countries as $country) {
                $data['items'][] = [
                    'id'   => $country['id'],
                    'code' => $country['code'],
                    'name' => $country['name'],
                    'priority' => $country['priority'],
                ];
            }
            $data['count'] = $count;
            $data['items'] = array_values($data['items']);

            $this->set_api_content('data', ['countries' => $data]);
        } else {
            $this->set_api_content('messages', l('no_countries', 'countries'));
        }
    }

    /**
     * Returns regions by country
     *
     * @param string $country_code
     */
    /**
    * @api {post} /countries/getRegions Get regions by country
    * @apiGroup Countries
    * @apiParam {string} country_code  country code
    */
    public function getRegions()
    {
        $country_code = $this->input->post('country_code', true);
        if (!$country_code) {
            log_message('error', 'API: Empty country code');
            $this->set_api_content('error', l('api_error_empty_country_code', 'countries'));
            return false;
        }

        $regions = $this->Countries_model->getRegions(
            $country_code,
            ['priority' => 'ASC', 'lang_' . $this->pg_language->current_lang_id => 'ASC'],
            [],
            [],
            $this->pg_language->current_lang_id
        );
        $count = count($regions);
        if ($count) {
            foreach ($regions as $region) {
                $regions['items'][] = [
                    'id'   => $region['id'],
                    'code' => $region['code'],
                    'name' => $region['name'],
                ];
            }
        }
        $regions['count'] = $count;
        $this->set_api_content('data', ['country_code' => $country_code, 'regions' => $regions]);
    }

    /**
     * Returns cities by region
     *
     * @param int    $region_id
     * @param string $search
     * @param int    $page
     */
    /**
    * @api {post} /countries/getCities Get cities by region
    * @apiGroup Countries
    * @apiParam {int} region_id  region id
    * @apiParam {int} page  page count
    * @apiParam {string} search  search string
    * @apiParam {boolean} is_simple  search full location for city name
    */
    public function getCities()
    {
        $cities = [];
        $params = [];

    // TODO: в приложениях сделано так что хотят сразу все данные
        $items_on_page = 100000;

        $region_id = $this->input->post('region_id', true);
        $is_simple = $this->input->post('simple_search', true);


        if (!$region_id && !$is_simple) {
            log_message('error', 'API: Empty region id');
            $this->set_api_content('error', l('api_error_empty_region_id', 'countries'));

            return false;
        }


        if ($region_id) {
            $cities['region'] = $this->Countries_model->get_region($region_id, $this->pg_language->current_lang_id);
            if (!$cities['region']) {
                log_message('error', 'API: Wrong region id ("' . $region_id . '")');
                $this->set_api_content('error', l('api_error_wrong_region_id', 'countries') . '("' . $region_id . '")');

                return false;
            }

            $cities['country'] = $this->Countries_model->get_country($cities['region']['country_code'], $this->pg_language->current_lang_id);
            if (!$cities['country']) {
                log_message('error', 'API: Wrong country code ("' . $cities['region']['country_code'] . '")');
                $this->set_api_content('error', l('api_error_wrong_country_code', 'countries') . '"(' . $cities['region']['country_code'] . ')"');
            }
            $params['where']['id_region'] = $region_id;
        }
        $search = $this->input->post('search', true);
        $search_string = null;

        if ($search) {
            $search_string = trim(strip_tags($search));
        }

        if (!empty($search_string)) {
            if ($this->pg_language->current_lang_id) {
                $var = 'lang_' . $this->pg_language->current_lang_id;
            } else {
                $var = 'name';
            }
            $params['where'][$var . ' LIKE'] = '%' . $search_string . '%';
        }

        $cities['count'] = $this->Countries_model->get_cities_count($params);
        $page = $this->input->post('page', true);
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $cities['count'], $items_on_page);

        $cities['pages'] = ceil($cities['count'] / $items_on_page);
        $cities['current_page'] = $page;
        $order_by = ['priority' => 'ASC', 'lang_' . $this->pg_language->current_lang_id => 'ASC'];

        if ($is_simple) {
            $order_by = ['custom_order_by' => '(CASE WHEN name LIKE "' . $search_string . '%" THEN 2 ELSE 3 END) ASC' ];
            $items_on_page = 25;
        }

        $cities['cities']['items'] =
            $this->Countries_model->get_cities(
                $page,
                $items_on_page,
                $order_by,
                $params,
                [],
                $this->pg_language->current_lang_id
            );
        $cities['cities']['items'] = array_values($cities['cities']['items']);

        if ($is_simple) {
            foreach ($cities['cities']['items'] as $key => $city) {
                $cities['cities']['items'][$key]['region'] = $this->Countries_model->get_region($city['id_region'], $this->pg_language->current_lang_id);
                $cities['cities']['items'][$key]['country'] = $this->Countries_model->get_country($cities['cities']['items'][$key]['region']['country_code'], $this->pg_language->current_lang_id);
            }
        }

        $this->set_api_content('data', $cities);
    }

    /**
     * Returns location data
     *
     * @param string     $type country/region/city
     * @param int|string $var  Country code, region id or city id
     */
    /**
    * @api {post} /countries/getData Get location data
    * @apiGroup Countries
    * @apiParam {string} type  country/region/city
    * @apiParam {string} var country code, region id or city id
    */
    public function getData()
    {
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
        if (!$type) {
            log_message('error', 'API: Empty location type');
            $this->set_api_content('error', l('api_error_empty_location_type', 'countries'));
            return false;
        }
        $var = filter_input(INPUT_POST, 'var', FILTER_VALIDATE_INT);
        if (!$var) {
            log_message('error', 'API: Empty location');
            $this->set_api_content('error', l('api_error_empty_location', 'countries'));
            return false;
        }
        $data = [];
        switch ($type) {
            case 'country':
                $data['country'] = $this->Countries_model->getCountry($var, $this->pg_language->current_lang_id);
                break;
            case 'region':
                $data['region'] = $this->Countries_model->getRegion($var, $this->pg_language->current_lang_id);
                $data['country'] = $this->Countries_model->getCountry($data['region']['country_code'], $this->pg_language->current_lang_id);
                break;
            case 'city':
                $data['city'] = $this->Countries_model->getCity($var, $this->pg_language->current_lang_id);
                $data['region'] = $this->Countries_model->getRegion($data['city']['id_region'], $this->pg_language->current_lang_id);
                $data['country'] = $this->Countries_model->getCountry($data['city']['country_code'], $this->pg_language->current_lang_id);
                break;
        }
        $this->set_api_content('data', $data);
    }
}
