<?php

declare(strict_types=1);

namespace Pg\modules\statistics\models\systems;

use Pg\modules\statistics\models\StatisticsModel;

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
class StatisticsMailboxModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    const MODULE_GID = StatisticsModel::MODULE_GID;

    /**
     * Module table
     *
     * @var string
     */
    const MODULE_TABLE = 'statistics_mailbox';

    /**
     * System GUID
     *
     * @var string
     */
    const SYSTEM_GID = 'mailbox';

    /**
     * Statistics object properties
     *
     * @var array
     */
    protected $fields = [
        self::MODULE_TABLE => [
            'object_id',
            'sent',
            'recieved',
            'replyed',
        ],
    ];

    protected $events = [
        'send',
        'read',
        'reply',
    ];

    /**
     * Settings for formatting statistics object
     *
     * @var array
     */
    protected $format_settings = [

    ];

    public function parseFile($file)
    {
        $fp = fopen($file, "r");
        if ($fp) {
            while (($buffer = fgets($fp, 4096)) !== false) {
                $stat_point = json_decode($buffer);
                $method = "processEvent_" . $stat_point->gid;
                $this->{$method}($stat_point->params);
            }
            if (!feof($fp)) {
                $this->view->output("Error: unexpected fgets() fail\n");

                $this->view->render();
            }
            fclose($fp);
        }
    }

    private function processEventSend($params)
    {
        $this->createStatPoint($params->from, ['sent' => ['action' => 'inc']]);
        $this->createStatPoint($params->to, ['recieved' => ['action' => 'inc']]);
    }

    public function createStatPoint($object_id, $stat_point)
    {
        $stat_point['object_id']['action'] = 'set';

        if ($object_id) {
            $stat_point['object_id']['value'] = $object_id;
        } else {
            $stat_point['object_id']['value'] = 0;
        }

        $object_id = $this->setStatPoint($stat_point);
    }

    public function getStatPoints($object_id, $stat_point_gids)
    {
        $results =
            $this->ci->db->select(implode(',', $stat_point_gids))
                         ->from(DB_PREFIX . self::MODULE_TABLE)
                         ->where('object_id', $object_id ? $object_id : 0)
                         ->get()
                         ->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0];
        }

        return false;
    }

    public function validateStatPoint($object_id, $stat_point)
    {
        return $stat_point;
    }

    private function setStatPoint($data)
    {
        $update_str = '';
        $fields_upd = [];

        foreach ($data as $field => $val) {
            switch ($val['action']) {
                case 'sum':
                    $data[$field] = $val['value'];
                    $fields_upd[] = "`{$field}` = `" . $field . "` + " . $val['value'];
                    break;
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

    public function getSystemData()
    {
        foreach ($this->fields[self::MODULE_TABLE] as $key => $value) {
            if ($value == 'object_id') {
                continue;
            }
            $data[$key]['field_name'] = l('stats_field_name_' . $value, 'statistics');
            $data[$key]['field_description'] = l('stats_field_description_' . $value, 'statistics');
        }

        return $data;
    }
    public function getEventsList($format = false)
    {
        if ($format == false) {
            return $this->events;
        } else {
            foreach ($this->events as $key => $value) {
                $data[$key]['field_name'] = l('event_' . $value . '_name', 'statistics');
                $data[$key]['field_description'] = l('event_' . $value . '_description', 'statistics');
            }

            return $data;
        }
    }

    public function installSystem()
    {
        $file = MODULEPATH . 'statistics/models/systems_tables/structure_install_' . self::SYSTEM_GID . '.sql';
        if (file_exists($file)) {
            $this->ci->load->model('install/models/Install_model');
            $return = $this->ci->Install_model->simple_execute_sql($file);
            if (empty($return)) {
                if (empty($return)) {
                    $system_data = [
                        'module' => self::SYSTEM_GID,
                        'model' => 'Statistics_mailbox_model',
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
        }

        return false;
    }

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

    public function resetSystemStatistics()
    {
        if ($this->ci->db->truncate(DB_PREFIX . self::MODULE_TABLE)) {
            return true;
        }

        return false;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_events_list' => 'getEventsList',
            'processEvent_send' => 'processEventSend',
            'uninstall_system' => 'uninstallSystem',
            'reset_system_statistics' => 'resetSystemStatistics',
            'install_system' => 'installSystem',
            'get_system_data' => 'getSystemData',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
