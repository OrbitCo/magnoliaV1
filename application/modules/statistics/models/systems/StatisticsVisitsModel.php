<?php

declare(strict_types=1);

namespace Pg\modules\statistics\models\systems;

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
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StatisticsVisitsModel extends \Model
{
    /**
     * Module table
     *
     * @var string
     */
    const MODULE_TABLE = 'statistics_visits';

    /**
     * System GUID
     *
     * @var string
     */
    const SYSTEM_GID = 'visits';

    /**
     * Date format
     *
     * @var string
     */
    const DATE_FORMAT = 'd M';

    /**
     * Limit query
     *
     * var integer
     */
    const LIMIT_QUERY = 20;

    /**
     * Statistics object properties
     *
     * @var array
     */
    protected $fields = [
        self::MODULE_TABLE => [
            'object_time',
            'user_agent',
            'count',
            'date',
        ],
    ];

    /**
     * Statistics events
     *
     * @var array
     */
    protected $events = [
        self::SYSTEM_GID
    ];

    /**
     * Class constructor
     *
     * @return StatisticsVisitModel
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Parse file
     *
     * @param string $file
     *
     * @return void
     */
    public function parseFile($file)
    {
        $fp = fopen($file, "r");
        if ($fp) {
            while (($buffer = fgets($fp, 4096)) !== false) {
                $stat_point = json_decode($buffer);
                $this->createStatPoint($stat_point->params);
            }
            if (!feof($fp)) {
                $this->view->output("Error: unexpected fgets() fail\n");
                $this->view->render();
            }
            fclose($fp);
        }
    }

    /**
     * Create stat point
     *
     * @param object $object
     *
     * @return integer
     */
    public function createStatPoint($object)
    {
         return $this->setStatPoint([
            'object_time' => [
                'action' => 'set',
                'value' => self::objectTime($object->date)
            ],
            'user_agent' => [
                'action' => 'set',
                'value' => $object->user_agent
            ],
            'count' => [
                'action' => 'inc'
            ],
            'date' => [
                'action' => 'set',
                'value' => $object->date
            ]
         ]);
    }

    /**
     * Set stat point
     *
     * @param array  $data
     *
     * @return integer
     */
    private function setStatPoint($data)
    {
        $fields_upd = [];
        foreach ($data as $field => $val) {
            switch ($val['action']) {
                case 'inc':
                    $data[$field] = 1;
                    $fields_upd[] = "`{$field}` = `" . $field . "` + 1";
                    break;
                default:
                    $data[$field] = $val['value'];
                    $fields_upd[] = "`{$field}` = " . $this->ci->db->escape($val['value']) . "";
                    break;
            }
        }
        $update_str = implode(', ', $fields_upd);
        $sql = $this->ci->db->insert_string(DB_PREFIX . self::MODULE_TABLE, $data) . " ON DUPLICATE KEY UPDATE {$update_str}";
        $this->ci->db->query($sql);
        return $this->ci->db->affected_rows();
    }

    /**
     * System data
     *
     * @return array
     */
    public function getSystemData()
    {
        return [
            [
                'field_name' => l('stats_field_name_' . self::SYSTEM_GID, 'statistics'),
                'field_description' => l('stats_field_description_' . self::SYSTEM_GID, 'statistics')
            ]
        ];
    }

    /**
     * Event list
     *
     * @param boolean $format
     *
     * @return array
     */
    public function getEventsList($format = false)
    {
        if ($format == false) {
            return $this->events;
        } else {
            return [
                [
                    'field_name' => l('stats_field_name_' . self::SYSTEM_GID, 'statistics'),
                    'field_description' => l('stats_field_description_' . self::SYSTEM_GID, 'statistics')
                ]
            ];
        }
    }

    /**
     * Install system
     *
     * @return boolean
     */
    public function installSystem()
    {
        $file = MODULEPATH . 'statistics/models/systems_tables/structure_install_' . self::SYSTEM_GID . '.sql';
        if (file_exists($file)) {
            $this->ci->load->model('install/models/Install_model');
            $return = $this->ci->Install_model->simple_execute_sql($file);
            if (empty($return)) {
                $system_data = [
                    'module' => self::SYSTEM_GID,
                    'model' => 'Statistics_visits_model',
                    'cb_create' => 'test',
                    'cb_drop' => 'test',
                    'cb_process' => 'test',
                    'stat_points' => [],
                    'scheduler' => date('Y-m-d H:i:s'),
                    'status' => 1,
                ];
                foreach ($this->events as $event) {
                    $system_data['stat_points'][] = ['gid' => $event, 'status' => 1];
                }
                $system_data['stat_points'] = serialize($system_data['stat_points']);
                $this->ci->load->model('Statistics_model');
                $this->ci->Statistics_model->saveSystem(null, $system_data);
                return true;
            }
        }
        return false;
    }

    /**
     * Unistall system
     *
     * @return boolean
     */
    public function uninstallSystem()
    {
        $file = MODULEPATH . 'statistics/models/systems_tables/structure_deinstall_' . self::SYSTEM_GID . '.sql';
        if (file_exists($file)) {
            $this->ci->load->model('install/models/Install_model');
            $return = $this->ci->Install_model->simple_execute_sql($file);
            if (empty($return)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Reset system statistics
     *
     * @return boolean
     */
    public function resetSystemStatistics()
    {
        if ($this->ci->db->truncate(DB_PREFIX . self::MODULE_TABLE)) {
            return true;
        }
        return false;
    }

    /**
     * Format object time
     *
     * @param string $time
     *
     * @return string
     */
    private static function objectTime($time)
    {
        return strtotime($time);
    }

    /**
     * Visits data
     *
     * @return boolean/array
     */
    public function getVisitsData()
    {
        $results = $this->ci->db->select(implode(', ', $this->fields[self::MODULE_TABLE]))
            ->from(DB_PREFIX . self::MODULE_TABLE)
            ->order_by('date DESC')
            ->limit(self::LIMIT_QUERY)
            ->get()
            ->result_array();
        if (!empty($results) && is_array($results)) {
            return $results;
        }
        return false;
    }

    public function formatVisitsData($data)
    {
        $result = [
           ['date' => '"Day"', 'count' => '"' . l('stats_field_name_visits_count', 'statistics') . '"']
        ];
        $interval_days = self::intervalDays();
        foreach ($interval_days as $key => $day) {
            foreach ($data as $item) {
                if (date(self::DATE_FORMAT, (int)$item['object_time']) == $day) {
                    $result[$key]['date'] = '"' . $day . '"';
                    $result[$key]['count'] = $item['count'];
                }
            }
            if (!isset($result[$key])) {
                $result[$key]['date'] = '"' . $day . '"';
                $result[$key]['count'] = 0;
            }
        }
        return $result;
    }

    public static function intervalDays()
    {
        $i = 1;
        $days = [];
        while ($i <= self::LIMIT_QUERY) {
            $days[$i] = date(self::DATE_FORMAT, strtotime('-' . $i . ' days'));
            $i++;
        }
        return $days;
    }
}
