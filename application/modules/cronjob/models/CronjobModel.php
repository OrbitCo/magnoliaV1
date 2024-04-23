<?php

declare(strict_types=1);

namespace Pg\modules\cronjob\models;

define('CRONJOB_TABLE', DB_PREFIX . 'cronjob');
define('CRONJOB_LOG_TABLE', DB_PREFIX . 'cronjob_log');

/**
 * Cronjob main model
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
class CronjobModel extends \Model
{
    public const MODULE_GID = 'cronjob';

    private $attrs = [
        'id',
        'date_add',
        'date_execute',
        'name',
        'module',
        'model',
        'method',
        'cron_tab',
        'status',
        'in_process',
        'is_kill',
        'skip_execute',
         'settings',
    ];

    private $attrs_log = [
        'id',
        'date_add',
        'cron_id',
        'function_result',
        'output',
        'errors',
        'execution_time',
        'memory_usage'
    ];

    private $log_expiried_period = 2592000;

    /**
     * Constructor
     *
     * @return
     */
    public function __construct()
    {
        parent::__construct();
        $this->log_expiried_period = $this->ci->pg_module->get_module_config('cronjob', 'log_expiried_period');
        $this->ci->cache->registerService(CRONJOB_TABLE);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(CRONJOB_LOG_TABLE);
    }

    public function getCronById($id_cron)
    {
        $fields     = implode(", ", $this->attrs);
        $nameTable  = CRONJOB_TABLE;
        $results = $this->ci->cache->get(CRONJOB_TABLE, 'getCronById' . $id_cron, function () use ($id_cron, $fields, $nameTable) {
            $ci = &get_instance();
            $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $id_cron);
            $result = $ci->db->get()->result_array();

            return $result;
        });

        if (!empty($results) && is_array($results)) {
            return $this->format_cron($results[0]);
        }

        return [];
    }

    public function getCrons($params = [])
    {
        $data = [];
        $this->ci->db->select(implode(", ", $this->attrs));
        $this->ci->db->from(CRONJOB_TABLE);

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
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $data = $this->format_crons($results);
        }

        return $data;
    }

    public function getCronsCount($params = [])
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(CRONJOB_TABLE);

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
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]['cnt']);
        }

        return 0;
    }

    public function formatCrons($data)
    {
        $this->ci->load->library('Cronparser');

        foreach ($data as $key => $cron) {
            $parts = explode(" ", trim($cron["cron_tab"]));
            $cron["ct_min"] = $parts[0];
            $cron["ct_hour"] = $parts[1];
            $cron["ct_day"] = $parts[2];
            $cron["ct_month"] = $parts[3];
            $cron["ct_wday"] = $parts[4];
            $this->ci->cronparser->calcLastRan($cron["cron_tab"]);
            $last_run = $this->ci->cronparser->getLastRan();
            if (!empty($last_run)) {
                $cron["date_scheduler"] = $last_run[5] . '-' . $last_run[3] . '-' . $last_run[2] . ' ' . $last_run[1] . ':' . $last_run[0] . ':00';
                $cron_scheduler = strtotime($cron["date_scheduler"]);
                $cron_execute = (!empty($cron['date_execute'])) ? strtotime($cron['date_execute']) : 0;
                $cron["expiried"] = ($cron_scheduler > $cron_execute) ? true : false;
                $data[$key] = $cron;
            }
        }

        return $data;
    }

    public function formatCron($data)
    {
        $this->ci->load->library('Cronparser');

        $parts = explode(" ", trim($data["cron_tab"]));
        $data["ct_min"] = $parts[0];
        $data["ct_hour"] = $parts[1];
        $data["ct_day"] = $parts[2];
        $data["ct_month"] = $parts[3];
        $data["ct_wday"] = $parts[4];
        $this->ci->cronparser->calcLastRan($data["cron_tab"]);
        $last_run = $this->ci->cronparser->getLastRan();
        if (!empty($last_run)) {
            $data["date_scheduler"] = $last_run[5] . '-' . $last_run[3] . '-' . $last_run[2] . ' ' . $last_run[1] . ':' . $last_run[0] . ':00';
            $cron_scheduler = strtotime($data["date_scheduler"]);
            $cron_execute = (!empty($data['date_execute'])) ? strtotime($data['date_execute']) : 0;
            $data["expiried"] = ($cron_scheduler > $cron_execute) ? true : false;
        }

        if (is_string($data['settings']) && !empty($data['settings'])) {
            $data['settings'] = json_decode($data['settings'], true);
        }

        return $data;
    }

    public function saveCron($id, $data)
    {
        if (is_null($id)) {
            $data["date_add"] = $data["date_execute"] = date("Y-m-d H:i:s");
            if (!isset($data["status"])) {
                $data["status"] = 1;
            }
            $this->ci->db->insert(CRONJOB_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(CRONJOB_TABLE, $data);
        }
        $this->ci->cache->flush(CRONJOB_TABLE);

        return $id;
    }

    public function deleteCron($id)
    {
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(CRONJOB_TABLE);
        $this->ci->cache->flush(CRONJOB_TABLE);
        $this->delete_log(['where' => ['cron_id' => $id]]);
    }

    public function deleteCronByParam($params = [])
    {
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
        $this->ci->db->delete(CRONJOB_TABLE);
        $this->ci->cache->flush(CRONJOB_TABLE);
    }

    public function validateCron($id, $data)
    {
        $return = ["errors" => [], "data" => []];
        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('string', 'reg_exps');
        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"]) || !preg_match($name_expr, $return["data"]["name"])) {
                $return["errors"][] = l('error_name_empty', 'cronjob');
            }
        }

        if (isset($data['settings']["time"]) && is_numeric($data['settings']["time"])) {
            $return["data"]['settings']["time"] = $data['settings']["time"];
        }

        if (isset($data["date_execute"])) {
            $return["data"]["date_execute"] = $data["date_execute"];
        }

        if (isset($data["status"])) {
            $return["data"]["status"] = $data["status"];
        }

        if (empty($id) && (empty($data["module"]) || empty($data["model"]) || empty($data["method"]))) {
            $return["errors"][] = l('error_function_empty', 'cronjob');
        } else {
            if (isset($data["module"])) {
                if (
                    $this->ci->pg_module->is_module_installed($data["module"]) &&
                    $this->isMethodCallable($data["module"], $data["model"], $data["method"])
                ) {
                    $return["data"]["module"] = $data["module"];
                    $return["data"]["model"] = $data["model"];
                    $return["data"]["method"] = $data["method"];
                } else {
                    $return["errors"][] = l('error_function_empty', 'cronjob');
                }
            }
        }

        if (isset($data["cron_tab"])) {
            $return["data"]["cron_tab"] = $data["cron_tab"];
        }

        if (isset($data["settings"]) && !empty($data["settings"])) {
            $return["data"]["settings"] = json_encode($data["settings"]);
        }

        if (
            isset($data["ct_min"]) &&
            isset($data["ct_hour"]) &&
            isset($data["ct_day"]) &&
            isset($data["ct_month"]) &&
            isset($data["ct_wday"])
        ) {
            $t[] = trim($data["ct_min"]);
            $t[] = trim($data["ct_hour"]);
            $t[] = trim($data["ct_day"]);
            $t[] = trim($data["ct_month"]);
            $t[] = trim($data["ct_wday"]);
            $return["data"]["cron_tab"] = implode(" ", $t);
            $this->ci->load->library('Cronparser');
            $this->ci->cronparser->calcLastRan($return["data"]["cron_tab"]);
            $last_run = $this->ci->cronparser->getLastRan();

            if (empty($last_run)) {
                $return["errors"][] = l('error_crontab_invalid', 'cronjob');
            }
        }

        return $return;
    }

    private function isMethodCallable($module, $model, $method)
    {
        if ($module . "_model" == strtolower($model)) {
            $model_path = $model;
        } else {
            $model_path = $module . '/models/' . $model;
        }
        $this->ci->load->model($model_path);
        $method_exists = true;

        // TODO: убрать после приведения к PSR
        if (!method_exists($this->ci->$model, $method)) {
            $chunks = explode('_', $method);
            $method = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }
            if (!method_exists($this->ci->$model, $method)) {
                $method_exists = false;
            }
        }

        return $method_exists;
    }

    public function run($id, $data = [])
    {
        $errors = [];

        $this->ci->benchmark->mark('cronjob_module_run_start');

        if (empty($data)) {
            $data = $this->getCronById($id);
        }

        if (empty($data)) {
            $errors[] = l('error_crontab_data_empty', 'cronjob');
        }

        if (!$this->isMethodCallable($data["module"], $data["model"], $data["method"])) {
            $errors[] = l('error_function_invalid', 'cronjob');
        } else {
            $this->saveCron($id, ["in_process" => 1, "skip_execute" => 0]);

            $model_url = $data["module"] . "/models/" . $data["model"];
            $this->ci->load->model($model_url);

            @ob_end_clean();
            ob_start();
            $function_result = call_user_func_array([&$this->ci->{$data["model"]}, $data["method"]], []);
            if (!empty($function_result)) {
                $log["function_result"] = $function_result;
            }
            $log["output"] = ob_get_contents();

            $this->ci->benchmark->mark('cronjob_module_run_end');

            if (intval(getenv('CRONJOB_LOG'))) {
                $log["execution_time"] = $this->ci->benchmark->elapsed_time('cronjob_module_run_start', 'cronjob_module_run_end');
                $log["memory_usage"] = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage() / 1024 / 1024, 2) . 'MB';
                $log["cron_id"] = $id;
                $log["errors"] = implode(", ", $errors);

                $this->saveLog($log);
            }

            if ($data['is_kill'] == 1) {
                $this->deleteCron($id);
            } else {
                $this->saveCron($id, ["date_execute" => date("Y-m-d H:i:s"), "in_process" => 0]);
            }
            $this->ci->cache->flush(CRONJOB_TABLE);
        }

        return $errors;
    }

    public function scheduler()
    {
        $this->clearLog();
        $this->ci->benchmark->mark('cronjob_scheduler_start');

        $params["where"]["status"] = 1;
        $crons = $this->get_crons($params);
        if (empty($crons)) {
            $messages[] = l('error_crontab_tasks_empty', 'cronjob');
        } else {
            foreach ($crons as $cron) {
                $cron = $this->get_cron_by_id($cron["id"]);
                if (isset($cron["expiried"]) && $cron["expiried"] === true) {
                    if ($cron["in_process"] == 0 || $cron["skip_execute"] >= 5) {
                        $this->run($cron["id"], $cron);
                        $messages[] = $cron["module"] . ":" . $cron["model"] . ":" . $cron["method"];
                    } else {
                        $this->saveCron($cron["id"], ['skip_execute' => $cron["skip_execute"]++]);
                    }
                }
            }
        }

        $this->ci->benchmark->mark('cronjob_scheduler_end');

        if (intval(getenv('CRONJOB_LOG'))) {
            $log["execution_time"] = $this->ci->benchmark->elapsed_time('cronjob_scheduler_start', 'cronjob_scheduler_end');
            $log["memory_usage"] = (!function_exists('memory_get_usage')) ? '0' : round(memory_get_usage() / 1024 / 1024, 2) . 'MB';
            $log["cron_id"] = 0;
            $log["output"] = implode("; ", $messages);

            $this->saveLog($log);
        }

    }

    public function getLog($params = [])
    {
        $data = [];
        $this->ci->db->select(implode(", ", $this->attrs_log));
        $this->ci->db->from(CRONJOB_LOG_TABLE);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $data = $results;
        }

        return $data;
    }

    public function getLogCount($params = [])
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(CRONJOB_LOG_TABLE);
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

        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        }

        return 0;
    }

    private function saveLog($data)
    {
        $data["date_add"] = date("Y-m-d H:i:s");
        $this->ci->db->insert(CRONJOB_LOG_TABLE, $data);

    }

    public function deleteLog($params = [])
    {
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
        $this->ci->db->delete(CRONJOB_LOG_TABLE);

    }

    private function clearLog()
    {
        $this->ci->db->where('date_add <', date('Y-m-d H:i:s', time() - $this->log_expiried_period));
        $this->ci->db->delete(CRONJOB_LOG_TABLE);

    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_cron' => 'deleteCron',
            'get_log_count' => 'getLogCount',
            'get_cron_by_id' => 'getCronById',
            'get_crons' => 'getCrons',
            'save_cron' => 'saveCron',
            'format_cron' => 'formatCron',
            'delete_cron_by_param' => 'deleteCronByParam',
            'get_crons_count' => 'getCronsCount',
            'get_log' => 'getLog',
            'is_method_callable' => 'isMethodCallable',
            'validate_cron' => 'validateCron',
            'format_crons' => 'formatCrons',
            'delete_log' => 'deleteLog',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
