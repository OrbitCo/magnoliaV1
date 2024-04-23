<?php

declare(strict_types=1);

namespace Pg\modules\countries\helpers {

    use Pg\modules\countries\models\CountriesModel;

    if (!function_exists('locationSelect')) {
        function locationSelect($params)
        {
            $ci = &get_instance();
            $tpl_vars = [];
            $default_values = [
                'id_country' => '',
                'id_region' => 0,
                'id_city' => 0,
                'lat' => 0.0000000,
                'lon' => 0.0000000,
                'select_type' => 'city',
                'is_button' => false,
                'var_country_name' => 'id_country',
                'var_region_name'  => 'id_region',
                'var_city_name' => 'id_city',
                'var_lat_name' => 'lat',
                'var_lon_name' => 'lon',
                'var_js_name' => '',
                'var_radius_name' => 'radius',
                'placeholder' => '',
                'auto_detect'      => false,
                'id_bg'            => 'locationAutocompleteBg',
                'is_change_location' => 0,
                'radius' => 2000000,
                'radius_unit' => 'km',
                'is_radius' => 0,
                'is_search' => 0
            ];

            $tpl_vars['max_radius'] = $default_values['radius'];
            $search_radius      = $ci->pg_module->get_module_config('nearest_users', 'search_radius');
            $search_radius_unit = $ci->pg_module->get_module_config('nearest_users', 'search_radius_unit');

            if (!empty($search_radius)) {
                $tpl_vars['radius'] = $search_radius;
            }
            if (!empty($search_radius_unit)) {
                $tpl_vars['radius_unit'] = $search_radius_unit;
            }

            $filtered_params = filter_var_array($params, [
                'id_country' => FILTER_SANITIZE_STRING,
                'id_region' => FILTER_VALIDATE_INT,
                'id_city' => FILTER_VALIDATE_INT,
                'lat' => FILTER_VALIDATE_FLOAT,
                'lon' => FILTER_VALIDATE_FLOAT,
                'select_type' => FILTER_SANITIZE_STRING,
                'is_button' => FILTER_VALIDATE_BOOLEAN,
                'var_country_name' => FILTER_SANITIZE_STRING,
                'var_region_name'  => FILTER_SANITIZE_STRING,
                'var_city_name'  => FILTER_SANITIZE_STRING,
                'var_lat_name' => FILTER_SANITIZE_STRING,
                'var_lon_name' => FILTER_SANITIZE_STRING,
                'var_js_name' => FILTER_SANITIZE_STRING,
                'placeholder' => FILTER_SANITIZE_STRING,
                'auto_detect' => FILTER_VALIDATE_BOOLEAN,
                'id_bg' => FILTER_SANITIZE_STRING,
                'is_change_location' => FILTER_VALIDATE_INT,
                'is_radius' => FILTER_VALIDATE_INT,
                'radius' => FILTER_VALIDATE_INT,
                'radius_unit' => FILTER_SANITIZE_STRING,
                'is_search' => FILTER_VALIDATE_INT,
            ]);

            foreach ($default_values as $key => $value) {
                if (empty($filtered_params[$key])) {
                    $tpl_vars[$key] = $default_values[$key];
                } else {
                    $tpl_vars[$key] = $filtered_params[$key];
                }
            }

            $tpl_vars['rand'] = rand(100000, 999999);

            $ci->load->model('Countries_model');

            if (!empty($tpl_vars['id_country'])) {
                $tpl_vars['country'] = $ci->Countries_model->getCountry($tpl_vars['id_country']);
            }

            if (empty($tpl_vars['country'])) {
                $tpl_vars['country'] = null;
            }

            if (!empty($tpl_vars['id_region'])) {
                $tpl_vars['region'] = $ci->Countries_model->getRegion($tpl_vars['id_region']);
            }

            if (empty($tpl_vars['region'])) {
                $tpl_vars['region'] = null;
            }

            if (!empty($tpl_vars['id_city'])) {
                $tpl_vars['city'] = $ci->Countries_model->getCity($tpl_vars['id_city']);
            }

            if (empty($tpl_vars['city'])) {
                $tpl_vars['city'] = null;
            }

            $tpl_vars['location_text'] = CountriesModel::getLocationText(
                $tpl_vars['country'],
                $tpl_vars['region'],
                $tpl_vars['city']
            );

            $ci->load->model('countries/models/Countries_location_select_model');
            $ci->view->assign('country_helper_data', $tpl_vars);

            return $ci->view->fetch(
                $ci->Countries_location_select_model->getCurrentTplFile(),
                null,
                'countries'
            );
        }
    }

    if (!function_exists('country')) {
        function country($id_country = '', $id_region = '', $id_city = '')
        {
            $ci = &get_instance();
            $ci->load->model("Countries_model");
            if (!empty($id_country)) {
                $data["country"] = $ci->Countries_model->get_country($id_country);
                $return_array[] = $data["country"]["name"];
            }
            if (!empty($id_region)) {
                $data["region"] = $ci->Countries_model->get_region($id_region);
                $return_array[] = $data["region"]["name"];
            }
            if (!empty($id_city)) {
                $data["city"] = $ci->Countries_model->get_city($id_city);
                $return_array[] = $data["city"]["name"];
            }
            $return = (is_array($return_array)) ? implode(', ', $return_array) : '';

            return $return;
        }
    }

    /*
     * Data is array( id => array(id_country, id_region, id_city), id => array(id_country, id_region, id_city), .....)
     * return array(id => str, id => str, id => str...);
     */
    if (!function_exists('countriesOutputFormat')) {
        function countriesOutputFormat($data)
        {
            if (empty($data)) {
                return [];
            }
            $ci = &get_instance();
            $location_data = get_location_data($data, 'country', false);
            $country_template = $ci->pg_module->get_module_config('countries', 'output_country_format');

            $return = [];
            foreach ($data as $id => $location) {
                if (isset($location["country"]) && isset($location_data["country"][$location["country"]])) {
                    $str = str_replace("[country]", $location_data["country"][$location["country"]]["name"], $country_template);
                    $str = str_replace('[country_code]', $location["country"], $str);
                } else {
                    $str = "";
                }
                $return[$id] = $str;
            }

            return $return;
        }
    }

    if (!function_exists('regionsOutputFormat')) {

        /**
         * Return locations output names in region format
         *
         * @param array $data locations data
         *
         * @return string
         */
        function regionsOutputFormat($data)
        {
            if (empty($data)) {
                return [];
            }
            $ci = &get_instance();
            $location_data = get_location_data($data, 'region', false);
            $country_template = $ci->pg_module->get_module_config('countries', 'output_country_format');
            $region_template = $ci->pg_module->get_module_config('countries', 'output_region_format');

            $return = [];
            foreach ($data as $id => $location) {
                $template = $country = $country_code = $region = '';
                if (isset($location["country"]) && !empty($location_data["country"][$location["country"]])) {
                    $country = $location_data["country"][$location["country"]]["name"];
                    $country_code = $location["country"];
                    $template = $country_template;
                }

                if (isset($location["region"]) && !empty($location_data["region"][$location["region"]])) {
                    $region = $location_data["region"][$location["region"]]["name"];
                    $template = $region_template;
                }

                if ($template) {
                    $template = str_replace("[country]", $country, $template);
                    $template = str_replace("[country_code]", $country_code, $template);
                    $template = str_replace("[region]", $region, $template);
                }
                $return[$id] = $template;
            }

            return $return;
        }
    }

    if (!function_exists('citiesOutputFormat')) {
        function citiesOutputFormat($data = [], $user_data = [], $lang_id = false)
        {
            if (empty($data)) {
                return [];
            }

            $ci = &get_instance();
            $location_data = !empty($user_data) ? $user_data : getLocationData($data, 'city', $lang_id);
            $country_template = $ci->pg_module->get_module_config('countries', 'output_country_format');
            $region_template = $ci->pg_module->get_module_config('countries', 'output_region_format');
            $city_template = $ci->pg_module->get_module_config('countries', 'output_city_format');
            $city_region_template = $ci->pg_module->get_module_config('countries', 'output_city_region_format');

            $return = [];
            foreach ($data as $key => $loc) {
                if (isset($loc['country'])) {
                    $countries[$loc['country']][] = $key;
                }
            }

            foreach ($data as $id => $location) {
                $template = $country = $country_code = $region = $city = '';
                if (isset($location["country"]) && !empty($location_data["country"][$location["country"]])) {
                    $country = $location_data["country"][$location["country"]]["name"];
                    $country_code = $location["country"];
                    $template = $country_template;
                }

                if (isset($location["region"]) && !empty($location_data["region"][$location["region"]])) {
                    $region = $location_data["region"][$location["region"]]["name"];
                    $template = $region_template;
                }

                if (isset($location["city"]) && !empty($location_data["city"][$location["city"]])) {
                    $city = $location_data["city"][$location["city"]]["name"];

                    if (count($countries[$location['country']]) > 1) {
                        $template = $city_region_template;
                    } else {
                        $template = $city_template;
                    }
                }

                if ($template) {
                    $search = ['[city]', '[region]', '[country]', '[country_code]'];
                    $replace = [$city, $region, $country, $country_code];
                    $template = str_replace($search, $replace, $template);
                }
                $return[$id] = $template;
            }

            return $return;
        }
    }

    if (!function_exists('getLocationData')) {

        /**
         * Return location data from identifiers
         *
         * @param array  $data location identifiers
         * @param string $type max level data type
         *
         * @return array
         */
        function getLocationData($data = [], $type = 'city', $lang_id = false)
        {
            $ci =& get_instance();
            $ci->load->model("Countries_model");

            if (empty($data)) {
                return [];
            }

            $return = $country_ids = $region_ids = $city_ids = $district_ids = [];
            foreach ($data as $set) {
                // country
                if (isset($set['country']) && !empty($set['country']) && !in_array($set['country'], $country_ids)) {
                    $country_ids[] = $set['country'];
                }

                if ($type != 'country') {
                    // region
                    if (isset($set['region']) && !empty($set['region']) && !in_array($set['region'], $region_ids)) {
                        $region_ids[] = $set['region'];
                    }

                    if ($type != 'region') {
                        // city
                        if (isset($set['city']) && !empty($set['city']) && !in_array($set['city'], $city_ids)) {
                            $city_ids[] = $set['city'];
                        }

                        if ($type != 'city') {
                            // district
                            if (isset($set['district']) && !empty($set['district']) && !in_array($set['district'], $district_ids)) {
                                $district_ids[] = $set['district'];
                            }
                        }
                    }
                }
            }

            if ($lang_id === false || is_null($lang_id)) {
                $lang_id = $ci->pg_language->current_lang_id;
            }

            if (!empty($country_ids)) {
                $return["country"] = $ci->Countries_model->getCountriesByCode($country_ids, $lang_id);
            }

            if (!empty($region_ids)) {
                $return["region"] = $ci->Countries_model->getRegionsById($region_ids, $lang_id);
            }

            if (!empty($city_ids)) {
                $return["city"] = $ci->Countries_model->getCitiesById($city_ids, $lang_id);
            }

            if (!empty($district_ids)) {
                $return["district"] = $ci->Countries_model->getDistrictsById($district_ids, $lang_id);
            }

            return $return;
        }
    }

}

namespace {

    if (!function_exists('location_select')) {
        function location_select($params)
        {
            return Pg\modules\countries\helpers\locationSelect($params);
        }
    }

    if (!function_exists('country')) {
        function country($id_country = '', $id_region = '', $id_city = '')
        {
            return Pg\modules\countries\helpers\country($id_country, $id_region, $id_city);
        }
    }

    if (!function_exists('countries_output_format')) {
        function countries_output_format($data)
        {
            return Pg\modules\countries\helpers\countriesOutputFormat($data);
        }
    }

    if (!function_exists('regions_output_format')) {
        function regions_output_format($data)
        {
            return Pg\modules\countries\helpers\regionsOutputFormat($data);
        }
    }

    if (!function_exists('cities_output_format')) {
        function cities_output_format($data = [], $user_data = [], $lang_id = false)
        {
            return Pg\modules\countries\helpers\citiesOutputFormat($data, $user_data, $lang_id);
        }
    }

    if (!function_exists('get_location_data')) {
        function get_location_data($data = [], $type = 'city', $lang_id = false)
        {
            return Pg\modules\countries\helpers\getLocationData($data, $type, $lang_id);
        }
    }

}
