<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

/**
 * install module
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class InstallMigrateModel extends \Model
{
    /**
     * Parser extensions
     *
     * @var string
     */
    protected const EXT = 'php';

    /**
     * Configuration app
     *
     * @var string
     */
    public const CONFIG = 'phinx.php';

    /**
     * Migration path
     *
     * @var string
     */
    public static $migrations;

    /**
     * Seeder path
     *
     * @var string
     */
    public static $seeds;

    /**
     * Routes list
     *
     * @var string[]
     */
    public $routes = [
        'status' => 'getStatus',
        'migrate' => 'getMigrate',
        'rollback' => 'getRollback',
        'seed:run' => 'getSeed'
    ];

    /**
     * @var PhinxApplication
     */
    private $app;

    /**
     * @var TextWrapper
     */
    private $wrap;

    /**
     * constructor InstallMigrateModel
     */
    public function __construct()
    {
        parent::__construct();

        $this->app = new PhinxApplication();
        $this->wrap = new TextWrapper($this->app);
        $this->setOption();
    }

    /**
     * Set options
     *
     * @return void
     */
    private function setOption()
    {
        $this->wrap->setOption('parser', self::EXT);
        $this->wrap->setOption('configuration', self::config());
    }

    /**
     * Config data
     *
     * @return string
     */
    public static function config(): string
    {
        return SITE_PHYSICAL_PATH . self::CONFIG;
    }

    /**
     * Set module
     *
     * @param $module
     *
     * @return InstallMigrateModel
     */
    public function setModule($module): InstallMigrateModel
    {
        self::$migrations = MODULEPATH . "{$module}/install/db/migrations";
        self::$seeds = MODULEPATH . "{$module}/install/db/seeds";

        return $this;
    }

    /**
     * Execute command
     *
     * @param string $command "migrate" command
     * @param string|null $environment environment name (optional)
     * @param string|null $target target version (optional)
     *
     * @return array
     */
    public function execute(string $command, string $environment = null, string $target = null): array
    {
        $return = [];

        if (!isset($this->routes[$command])) {
            $commands = implode(', ', array_keys($this->routes));
            $return['errors'][] = "Command not found! Valid commands are: {$commands}.";
        }

        $return['output'] = $this->wrap->{$this->routes[$command]}($environment, $target);
        if ($this->wrap->getExitCode() > 0) {
            $return['errors'][] = explode("\n", $return['output'], -1)[13];
            $args = implode(', ', [var_export($environment, true), var_export($target, true)]);
            $debug_msg = "DEBUG: $command($args)" . PHP_EOL . PHP_EOL;
            log_message('error', $return['output']);
            log_message('info', $debug_msg);
        }

        return $return;
    }

    /**
     * Migrations List
     *
     * @return array
     */
    public function getMigrationsList(): array
    {
        $migrate_modules = $this->setModule('install')->execute('status', ENVIRONMENT);
        $output = explode(PHP_EOL, $migrate_modules['output']);

        $migration_list = [];
        $kstart = 0;
        foreach ($output as $key => $str) {
            $is_str = strripos($str, '[Migration ID]');
            if (($is_str !== false || $kstart > 0) && !empty($str)) {
                $kstart = $kstart === 0 ? $key : $kstart;
                $is_down = strripos($str, 'down');
                $is_up = strripos($str, 'up');
                $migration_str_data = explode(' ', $str);
                if ($is_up !== false) {
                    $migration_list['up'][] = [
                        'status' => $migration_str_data[5],
                        'migration_id' => $migration_str_data[7],
                        'started' => "{$migration_str_data[9]} {$migration_str_data[10]}",
                        'finished' => "{$migration_str_data[12]} {$migration_str_data[13]}",
                        'migration_name' => $migration_str_data[15]
                    ];
                } elseif ($is_down !== false) {
                    $migration_list['down'][] = [
                        'status' => $migration_str_data[3],
                        'migration_id' => $migration_str_data[5],
                        'migration_name' => $migration_str_data[49]
                    ];
                }
            }
        }

        return $migration_list;
    }
}
