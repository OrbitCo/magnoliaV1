<?php

declare(strict_types=1);

namespace Pg\modules\statistics\models;

/**
 * Statistics module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Statistics main model
 *
 * @package     PG_Dating
 * @subpackage  Statistics
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StatisticsModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    public const MODULE_GID = 'statistics';

    /**
     * Module table
     *
     * @var string
     */
    public const MODULE_TABLE = 'statistics';

    /**
     * Statistics object properties
     *
     * @var array
     */
    protected $fields = [
        self::MODULE_TABLE => [
            'id',
            'module',
            'model',
            'cb_create',
            'cb_drop',
            'cb_process',
            'stat_points',
            'scheduler',
            'status',
        ],
    ];

    /**
     * Settings for formatting statistics object
     *
     * @var array
     */
    protected $format_settings = [];

    /**
     * Cache of statisticts systems
     *
     * @var array
     */
    private $cache_systems = [];

    private $systems_all = null;

    /**
     * Class constructor
     *
     * @return Statistics_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(self::MODULE_TABLE);
    }

    /**
     * Return statistics object by idnetifier
     *
     * @param string $field_name  field name
     * @param mixed  $field_value field value
     * @param array  $langs_ids   languages' idnetifiers
     *
     * @return array/false
     */
    private function getStatisticsObject($field_name, $field_value, $langs_ids = null)
    {
        if (empty($langs_ids)) {
            $langs_ids = [$this->ci->pg_language->current_lang_id];
        }

        $fields = implode(', ', $this->fields[self::MODULE_TABLE]);

        $results = $this->ci->db->select($fields)
            ->from(DB_PREFIX . self::MODULE_TABLE)
            ->where($field_name, $field_value)
            ->get()
            ->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    /**
     * Return statistics object by idnetifier
     *
     * @param integer $statistics_id statistics identifier
     * @param array   $langs_ids     languages' identifiers
     *
     * @return array/false
     */
    public function getStatisticsById($statistics_id, $langs_ids = null)
    {
        return $this->getStatisticsObject('id', $statistics_id, $langs_ids);
    }

    private function getAllSystems()
    {
        if ($this->systems_all === null) {
            $fields = $this->fields[self::MODULE_TABLE];

            $table = self::MODULE_TABLE;

            $this->systems_all = $this->ci->cache->get(self::MODULE_TABLE, 'all', function () use ($fields, $table) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(", ", $fields))
                    ->from(DB_PREFIX . $table)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return [];
                }

                return $results_raw;
            });
        }

        return $this->systems_all;
    }

    public function getSystemById($system_id, $langs_ids = null)
    {
        if (empty($this->cache_systems)) {
            $this->cache_systems = $this->getAllSystems();
        }

        foreach ($this->cache_systems as $system) {
            if ($system['id'] == $system_id) {
                return $system;
            }
        }

        return false;
    }

    public function getSystemByGid($system_gid, $langs_ids = null)
    {
        if (empty($this->cache_systems)) {
            $this->cache_systems = $this->getAllSystems();
        }

        foreach ($this->cache_systems as $system) {
            if ($system['module'] == $system_gid) {
                return $system;
            }
        }

        return false;
    }

    private function getSystemObject($field_name, $field_value, $langs_ids = null)
    {
        if (empty($langs_ids)) {
            $langs_ids = [$this->ci->pg_language->current_lang_id];
        }

        $fields = implode(', ', $this->fields[self::MODULE_TABLE]);

        $results = $this->ci->db->select($fields)
            ->from(DB_PREFIX . self::MODULE_TABLE)
            ->where($field_name, $field_value)
            ->get()
            ->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    /**
     * Return statistics object by guid
     *
     * @param string $statistics_gid statistics guid
     * @param array  $langs_ids      languages' identifiers
     *
     * @return array/false
     */
    public function getStatisticsByGid($statistics_gid, $langs_ids = null)
    {
        return $this->getStatisticsObject('gid', $statistics_gid, $langs_ids);
    }

    /**
     * Return sql criteria for searching statistics as array
     *
     * @param array $filters filters data
     *
     * @return array
     */
    public function getStatisticsCriteria($filters)
    {
        $filters = ['data' => $filters, 'table' => DB_PREFIX . self::MODULE_TABLE, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : DB_PREFIX . self::MODULE_TABLE;

        $fields = array_flip($this->fields[self::MODULE_TABLE]);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (!is_array($filter_data)) {
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
                            $params = array_merge_recursive($params, ['where_in' => [$filter_name => $filter_data]]);
                        } else {
                            $params = array_merge_recursive($params, ['where' => [$filter_name => $filter_data]]);
                        }
                    }

                    break;
                }
            }
        }

        return $params;
    }

    /**
     * Return statistics object from data source as array
     *
     * @param integer $page     page of results
     * @param string  $limits   results per page
     * @param array   $order_by sorting data
     * @param array   $params   sql criteria
     * @param array   $lang_ids languages' identifiers
     *
     * @return array
     */
    protected function getStatisticsListInternal($page = null, $limits = null, $order_by = null, $params = [], $lang_ids = null)
    {
        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        $table = DB_PREFIX . self::MODULE_TABLE;
        $fields = implode(', ', $this->fields[self::MODULE_TABLE]);

        if (isset($params['table']) && $params['table'] != $table) {
            $table = $params['table'];
            $fields = $table . '.' . implode(', ' . $table . '.', $fields);
        }

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

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function getSystemsInstalled()
    {
        $this->ci->db->select('module');
        $this->ci->db->from(DB_PREFIX . self::MODULE_TABLE);

        $results = $this->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $k => $v) {
                $res[] = $v['module'];
            }

            return $res;
        }

        return [];
    }

    protected function getSystemsListInternal($page = null, $limits = null, $order_by = null, $params = [], $lang_ids = null)
    {
        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        $table = DB_PREFIX . self::MODULE_TABLE;

        $fields = implode(', ', $this->fields[self::MODULE_TABLE]);

        if (isset($params['table']) && $params['table'] != $table) {
            $table = $params['table'];
            $fields = $table . '.' . implode(', ' . $table . '.', $fields);
        }

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

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields[self::MODULE_TABLE])) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $this->formatSystems($results);
        }

        return [];
    }

    protected function formatSystems($results)
    {
        foreach ($results as $key => $value) {
            $results[$key]['activities'] = $this->db->list_fields(DB_PREFIX . 'statistics_' . $value['module']);
            foreach ($results[$key]['activities'] as $k => $v) {
                unset($results[$key]['activities'][$k]);
                if ($v == 'object_id') {
                    continue;
                }
                $results[$key]['activities'][$k]['field_name'] = l('stats_field_name_' . $v, 'statistics');
                $results[$key]['activities'][$k]['field_description'] = l('stats_field_description_' . $v, 'statistics');
            }
            $tmp_events = unserialize($results[$key]['stat_points']);
            foreach ($tmp_events as $k2 => $v2) {
                $results[$key]['events'][$k2]['gid'] = $v2['gid'];
                $results[$key]['events'][$k2]['status'] = $v2['status'];
                $results[$key]['events'][$k2]['field_name'] = l('event_' . $v2['gid'] . '_name', 'statistics');
                $results[$key]['events'][$k2]['field_description'] = l('event_' . $v2['gid'] . '_description', 'statistics');
            }
            unset($tmp_events);
        }

        return $results;
    }
    /**
     * Return number of statistics in data source
     *
     * @param array $params sql criteria
     *
     * @return integer
     */
    protected function getStatisticsCountInternal($params = null)
    {
        $table = isset($params['table']) ? $params['table'] : DB_PREFIX . self::MODULE_TABLE;

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
     * Return filtered statistics objects from data source as array
     *
     * @param array   $filters       filters data
     * @param integer $page          page of results
     * @param integer $items_on_page results per page
     * @param string  $order_by      sorting data
     * @param array   $langs_ids     languages' identifier
     *
     * @return array
     */
    public function getStatisticsList($filters = [], $page = null, $items_on_page = null, $order_by = null, $langs_ids = null)
    {
        $params = $this->getStatisticsCriteria($filters);

        return $this->getStatisticsListInternal($page, $items_on_page, $order_by, $params, $langs_ids);
    }

    public function getSystemsList($filters = [], $items_on_page, $page = null, $order_by = null)
    {
        return $this->getSystemsListInternal($page, $items_on_page, $order_by, $filters);
    }

    /**
     * Return number of filtered statistics objects in data source
     *
     * @param array $filters filters data
     *
     * @return array
     */
    public function getStatisticsCount($filters = [])
    {
        $params = $this->getStatisticsCriteria($filters);

        return $this->getStatisticsCountInternal($params);
    }

    /**
     * Return number of filtered statistics objects in data source
     *
     * @param array $filters filters data
     *
     * @return array
     */
    public function getSystemsCount($filters = [])
    {
        return $this->getStatisticsCountInternal($filters);
    }

    /**
     * Change settings for formatting statistics object
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
     * Format data of statistics object
     *
     * @param array $statistics_data statistics data
     * @param array $lang_ids        languages' identifiers
     *
     * @return array
     */
    public function formatStatistics($statistics_data, $lang_ids = null)
    {
        return current($this->formatStatistics([$Statistics_data], $lang_ids));
    }

    /**
     * Format data of statistics' objects
     *
     * @param array $statistics_arr statistics' data
     * @param array $languages_ids  languages' identifiers
     *
     * @return array
     */
    public function formatStatisticsArr($statistics_arr, $languages_ids = null)
    {
        $result = [];

        $statistics_arr_ids = [];

        if (empty($languages_ids)) {
            $languages_ids = [$this->ci->pg_language->current_lang_id];
        }

        $language_id = current($languages_ids);

        foreach ($statistics_arr as $statistics) {
            $statistics_arr_ids[] = $statistics['id'];

            $result[$statistics['id']] = $statistics;

            // TODO:
        }

        return $result;
    }

    /**
     * Format statistics object by default
     *
     * @return array
     */
    public function formatDefaultStatistics()
    {
        $data = [];

        // TODO:

        return $data;
    }

    /**
     * Validate statistics object for saving to data source
     *
     * @param integer $statistics_id statistics identifier
     * @param array   $statistics    statistics data
     *
     * @return array
     */
    public function validateStatistics($statistics_id, $statistics)
    {
        $return = ['errors' => [], 'data' => [], 'services_data' => []];

        $default_lang_id = $this->ci->pg_language->current_lang_id;

        $languages = $this->ci->pg_language->languages;

        if ($statistics_id) {
            $current_statistics = $this->getStatisticsById($Statistics_id);
        } else {
            $current_statistics = [];
        }

        if (isset($statistics['id'])) {
            $return['data']['id'] = intval($statistics['id']);
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (isset($statistics['gid'])) {
            $return['data']['gid'] = strip_tags($statistics['gid']);
            $return['data']['gid'] = preg_replace("/[^a-z0-9\-_]+/i", '', $return['data']['gid']);
            if (empty($return['data']['gid'])) {
                $return['errors'][] = l('error_gid_empty', self::MODULE_GID);
            } elseif (strlen($return['data']['gid']) > 50) {
                $return['errors'][] = l('error_gid_length', self::MODULE_GID);
            } else {
                if ($statistics['gid'] !== $return['data']['gid']) {
                    $return['info']['gid'] = l('info_gid_filtered', self::MODULE_GID);
                }
                $param['where']['gid'] = $return['data']['gid'];
                if ($statistics_id) {
                    $param['where']['id <>'] = $statistics_id;
                }
                $gid_counts = $this->getStatisticsCountInternal($param);
                if ($gid_counts > 0) {
                    $return['errors'][] = l('error_gid_exists', self::MODULE_GID);
                }
            }
        }

        if (isset($statistics['date_created'])) {
            $value = strtotime($statistics['date_created']);
            if ($value) {
                $return['data']['date_created'] = date('Y-m-d H:i:s');
            } else {
                $return['data']['date_created'] = '0000-00-00 00:00:00';
            }
        }

        return $return;
    }

    /**
     * Save statistics object to data source
     *
     * @param integer $statistics_id  statistics identifier
     * @param array   $statistics_raw statistics raw data
     *
     * @return integer
     */
    public function saveStatistics($statistics_id, $statistics_raw)
    {
        if (empty($statistics_id)) {
            $statistics_raw['date_created'] = date('Y-m-d H:i:s');
            $this->ci->db->insert(DB_PREFIX . self::MODULE_TABLE, $statistics_raw);
            $statistics_id = $this->ci->db->insert_id();
            $this->incGidIndex();
        } else {
            $this->ci->db->where('id', $statistics_id);
            $this->ci->db->update(DB_PREFIX . self::MODULE_TABLE, $statistics_raw);
        }

        return $statistics_id;
    }

    /**
     * Remove statistics object from data source by identifier
     *
     * @param integer $statistics_id statistics identifier
     *
     * @return void
     */
    public function deleteStatistics($statistics_id)
    {
        if (is_array($statistics_id)) {
            foreach ($statistics_id as $item_id) {
                $this->deleteStatistics($item_id);
            }
        } else {
            $this->ci->db->where('id', $statistics_id);
            $this->ci->db->delete(DB_PREFIX . self::MODULE_TABLE);
        }
    }

    /**
     * Remove statistics' objects from data source
     *
     * @param integer $statistics_arr_ids statistics' identifiers
     *
     * @return void
     */
    public function deleteStatisticsArr(array $statistics_arr_ids)
    {
        foreach ($statistics_arr_ids as $statistics_id) {
            $this->deleteStatistics($statistics_id);
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
            "name"      => l('header_statistics_index', self::MODULE_GID),
            "link"      => rewrite_link(self::MODULE_GID, 'index'),
            "clickable" => true,
        ];

        return $block;
    }

    /**
     * Return current statistics counter
     *
     * @return integer
     */
    public function generateGUID()
    {
        $statistics_counter = $this->ci->pg_module->get_module_config('statistics', 'statistics_counter');
        $statistics_counter = (int) $statistics_counter + 1;

        return self::GUID_PREFIX . $statistics_counter;
    }

    /**
     * Increase statistics counter
     *
     * @return void
     */
    public function incGidIndex()
    {
        $statistics_counter = $this->ci->pg_module->get_module_config('statistics', 'statistics_counter');
        $statistics_counter = (int) $statistics_counter + 1;
        $this->ci->pg_module->set_module_config('statistics', 'statistics_counter', $statistics_counter);
    }

    /**
     * Save systen object to data source
     *
     * @param integer $system_id  system identifier
     * @param array   $system_raw system raw data
     *
     * @return integer
     */
    public function saveSystem($system_id, $system_raw)
    {
        if (empty($system_id)) {
            $this->ci->db->insert(DB_PREFIX . self::MODULE_TABLE, $system_raw);
            $system_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $system_id);
            $this->ci->db->update(DB_PREFIX . self::MODULE_TABLE, $system_raw);
        }

        $this->ci->cache->flush(self::MODULE_TABLE);

        $this->systems_all = null;

        return $system_id;
    }

    public function activateSystem($system_id, $status = 1)
    {
        $attrs["status"] = intval($status);

        return is_null($system_id) ? false : $this->saveSystem($system_id, $attrs);
    }

    public function getStatisticsFile($module_gid)
    {
        $results = $this->ci->db->select('module, scheduler')
            ->from(DB_PREFIX . self::MODULE_TABLE)
            ->where('module', $module_gid)
            ->get()
            ->result_array();

        $this->ci->cache->flush(self::MODULE_TABLE);

        $this->systems_all = null;

        if ($results[0]) {
            $timestamp = strtotime($results[0]['scheduler']);
            $old_log_file = $results[0]['module'] . "-" . strtotime($results[0]['scheduler']) . ".log";

            return $old_log_file;
        }

        return false;
    }

    public function parseStatistics()
    {
        $results = $this->ci->db->select('module, scheduler')
            ->from(DB_PREFIX . self::MODULE_TABLE)
            ->where('status', '1')
            ->order_by('scheduler ASC')
            ->get()
            ->result_array();

        foreach ($results as $result) {
            $timestamp = strtotime($result['scheduler']);

            // TODO: переписать (обрабатываем только данные за день)
            if (date('Y-m-d') == date('Y-m-d', $timestamp)) {
                continue;
            }

            $old_log_file = $result['module'] . "-" . strtotime($result['scheduler']) . ".log";
            $new_datetime = date('Y-m-d H:i:s');
            $new_log_file = $result['module'] . "-" . strtotime($new_datetime) . ".log";

            $old_log_path = TEMPPATH . 'logs/statistics/' . $old_log_file;
            $new_log_path = TEMPPATH . 'logs/statistics/' . $new_log_file;

            $fp = fopen($new_log_path, "a");
            fclose($fp);
            chmod($new_log_path, 0777);
            $this->ci->db->where('module', $result['module']);
            $this->ci->db->update(DB_PREFIX . self::MODULE_TABLE, ['scheduler' => $new_datetime]);

            $system_model = "Statistics_" . $result['module'] . "_model";
            $this->ci->load->model("statistics/models/systems/" . $system_model);

            if (file_exists($old_log_path)) {
                $this->ci->{$system_model}->parseFile($old_log_path);
                unlink($old_log_path);
            }
        }
    }

    public function activateEvent($system_id, $event_gid, $status = 1)
    {
        $system = $this->getSystemById($system_id);
        if ($system['stat_points']) {
            $sp_arr = unserialize($system['stat_points']);
            foreach ($sp_arr as $k => $v) {
                if ($sp_arr[$k]['gid'] == $event_gid) {
                    $sp_arr[$k]['status'] = $status;
                }
            }
            $system['stat_points'] = serialize($sp_arr);
            $attrs["stat_points"] = $system['stat_points'];

            return $this->saveSystem($system_id, $attrs);
        }

        return false;
    }

    public function getSystemEvents($system_gid)
    {
        $system = $this->getSystemByGid($system_gid);
        if ($system && $system['stat_points']) {
            $events_tmp = unserialize($system['stat_points']);
            foreach ($events_tmp as $k => $v) {
                $events[$v['gid']] = $v['status'];
            }

            return $events;
        }

        return false;
    }

    public function getStatPoints($system_gid, $object_id, $stat_point_gids)
    {
        $system = $this->getSystemByGid($system_gid);
        if ($system === false) {
            return false;
        }

        $systemModel = "Pg\\modules\\statistics\\models\\systems\\Statistics" . ucfirst($system_gid) . "Model";
        $systemModel = new $systemModel();

        return $systemModel->getStatPoints($object_id, $stat_point_gids);
    }

    public function getSiteVisitsCookie($gid = '')
    {
        return $this->ci->input->cookie(self::MODULE_GID . '-' . $gid);
    }

    public function setSiteVisitsCookie($gid = '')
    {
        $this->ci->load->helper('cookie');
        set_cookie([
            'name' => self::MODULE_GID . '-' . $gid,
            'value' => 1,
            'expire' => 86400,
            'domain' => COOKIE_SITE_SERVER,
            'path' => '/' . SITE_SUBFOLDER,
        ]);
    }

    /**
     * Check file existence and try to create id if necessary
     *
     * @param string $path
     *
     * @throws Exception
     *
     * @return boolean
     */
    public function checkFile($path)
    {
        if (file_exists($path)) {
            if (!is_file($path)) {
                throw new Exception('err_create_file ' . $path);
            }
        } else {
            if (!file_exists(dirname($path)) && !mkdir(dirname($path), 0777, true)) {
                throw new Exception('err_create_file ' . $path);
            }
            if (!touch($path)) {
                throw new Exception('err_create_file ' . $path);
            }
            chmod($path, 0777);
        }

        return true;
    }

    /**
     * User Agent Check
     *
     * @param type $user_agent
     *
     * @return boolean
     */
    public function isLog($user_agent)
    {
        if ($user_agent) {
            return (in_array($user_agent, [
               'rambler','googlebot','aport','yahoo','msnbot','turtle','mail.ru','omsktele',
                'yetibot','picsearch','sape.bot','sape_context','gigabot','snapbot','alexa.com',
                'megadownload.net','askpeter.info','igde.ru','ask.com','qwartabot','yanga.co.uk',
                'scoutjet','similarpages','oozbot','shrinktheweb.com','aboutusbot','followsite.com',
                'dataparksearch','google-sitemaps','appEngine-google','feedfetcher-google',
                'liveinternet.ru','xml-sitemaps.com','agama','metadatalabs.com','h1.hrn.ru',
                'googlealert.com','seo-rus.com','yaDirectBot','yandeG','yandex',
                'yandexSomething','Copyscape.com','AdsBot-Google','domaintools.com',
                'Nigma.ru','bing.com','dotnetdotcom', 'null'
            ]) === true) ? false : true;
        }

        return false;
    }

    public function __call($name, $args)
    {
        $methods = [
            'activate_system' => 'activateSystem',
            'activate_event' => 'activateEvent',
            'get_statistics_file' => 'getStatisticsFile',
            'parse_statistics' => 'parseStatistics',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
