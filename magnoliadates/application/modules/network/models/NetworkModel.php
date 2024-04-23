<?php

declare(strict_types=1);

namespace Pg\modules\network\models;

require_once MODULEPATH . 'network/install/config.php';

/**
 * Network main model
 *
 * @package PG_Dating
 * @subpackage application
 * @category modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class NetworkModel extends \Model
{
    public const MODULE_GID = 'network';
    public const HEADER_KEY = 'x-pgn-key';
    public const HEADER_DOMAIN = 'x-pgn-domain';
    public const CLIENT_FAST = 'fast';
    public const CLIENT_SLOW = 'slow';

    public const NET_SHOW_LOG = false;

    public const FAST_SERVICE_EXECUTABLE = 'fast-client-service.php';

    private $logs_dir;

    private $slow_server = NETWORK_SLOW_SERVER;
    private $fast_server = NETWORK_FAST_SERVER;
    private $key = '';
    private $domain = '';

    protected $_log_files = [
        self::CLIENT_SLOW => 'slow_server.log',
        self::CLIENT_FAST => 'fast_server.log',
    ];

    protected $_client_path = '';
    protected $_cfg_data = [
        'slow_server',
        'fast_server',
        'key',
        'domain',
        'is_upload_photos',
        'is_registered',
    ];

    private $php_path = 'php-cli';

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        $this->_client_path = MODULEPATH . 'network/client/';
        $this->logs_dir = TEMPPATH . 'logs/' . self::MODULE_GID . '/';

        if (!shell_exec('which ' . $this->php_path)) {
            $this->php_path = 'php';
        }
    }

    public function getSlowServer(): string
    {
        return $this->slow_server;
    }

    public function getFastServer(): string
    {
        return $this->fast_server;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Get logs dir
     *
     * @return string
     */
    public function getLogsDir(): string
    {
        return $this->logs_dir;
    }

    /**
     * Get authentication data
     *
     * @return array
     */
    public function getAuthData(): array
    {
        $data = $this->getConfig();
        $this->slow_server = $data['slow_server'];
        $this->fast_server = $data['fast_server'];
        $this->key = $data['key'];
        $this->domain = $data['domain'];

        return $data;
    }

    /**
     * Get network settings from database
     *
     * @param mixed $cfg_gids
     *
     * @return array
     */
    public function getConfig($cfg_gids = null): array
    {
        if (empty($cfg_gids)) {
            $cfg_gids = $this->_cfg_data;
        } elseif (!is_array($cfg_gids)) {
            $cfg_gids = [$cfg_gids];
        }
        $settings = [];
        foreach ($cfg_gids as $cfg_gid) {
            $val = $this->ci->pg_module->get_module_config(self::MODULE_GID, $cfg_gid);
            if (!$val) {
                $val = '';
            } elseif ((false !== ($unser = @unserialize($val))) || 'b:0;' === $unser) {
                $val = $unser;
            }
            $settings[$cfg_gid] = $val;
        }

        return $settings;
    }

    /**
     * Save network settings
     *
     * @param array $data
     *
     * @return array
     */
    public function setConfig(array $data): array
    {
        foreach ($data as $config_gid => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            } else {
                $value = (string) $value;
            }
            log_message("error", "$config_gid=$value ");
            $this->ci->pg_module->set_module_config(self::MODULE_GID, $config_gid, $value);
        }

        return $data;
    }

    public function isRegistered(): bool
    {
        return (bool) $this->ci->pg_module->get_module_config(self::MODULE_GID, 'is_registered');
    }

    public function setRegistered($is_registered = true)
    {
        return $this->ci->pg_module->set_module_config(self::MODULE_GID, is_registered, (bool) $is_registered);
    }

    /**
     * Execute shell command
     *
     * @param string $file
     * @param string $command
     * @param string $preparams
     * @param string $postparams
     *
     * @return string
     */
    private function command($file, $command = 'sh', $preparams = null, $postparams = null): string
    {
        if ($preparams) {
            $preparams = $preparams . ' ';
        }
        if ($postparams) {
            $postparams = ' ' . $postparams;
        }
        return (string) shell_exec($command . " " . $preparams . $this->_client_path . $file . $postparams);
    }

    /**
     * Start slow client
     *
     * @return string
     */
    public function startSlow()
    {
        if ($this->isStartedSlow()) {
            return true;
        }

        $pid_file = $this->_client_path . 'logs/.pidfile';
        if ((int)shell_exec('test -f ' . $pid_file . ' && echo 1 || echo 0')) {
            unlink($pid_file);
        }

        // TODO: Проверка успешности
        return $this->command('slow-client.start');
    }

    /**
     * Start fast client
     *
     * @return bool
     */
    public function startFast(): bool
    {
        if ($this->isStartedFast()) {
            return true;
        }

        if ($this->isEnabled('shell_exec')) {
            $pid_file = $this->getLogsDir() . 'daemon.pid';
            if ((int)shell_exec('test -f ' . $pid_file . ' && echo 1 || echo 0')) {
                unlink($pid_file);
            }

            $cmd_result = $this->command(self::FAST_SERVICE_EXECUTABLE, $this->php_path, '-f');

            return $this->isStartedFast();
        }

        return false;
    }

    /**
     * Start client
     *
     * @return array
     */
    public function start(): array
    {
        $this->ci->pg_module->set_module_config('network', 'is_started', 1);

        return [
            self::CLIENT_SLOW => $this->startSlow(),
            self::CLIENT_FAST => $this->startFast(),
        ];
    }

    /**
     * Stop slow server
     *
     * @return string
     */
    public function stopSlow(): string
    {
        // TODO: Проверка успешности
        return $this->command('slow-client.stop');
    }

    /**
     * Stop fast server
     *
     * @return boolean
     */
    public function stopFast(): bool
    {
        if (!$this->isStartedFast()) {
            return true;
        }
        $pid = $this->getPidFast();
        if ($pid == 0) {
            return false;
        }
        // 15 — SIGTERM
        return posix_kill($pid, 15);
    }

    /**
     * Stop both clients
     *
     * @return array
     */
    public function stop(): array
    {
        $this->ci->pg_module->set_module_config('network', 'is_started', 0);

        return [
            self::CLIENT_SLOW => $this->stopSlow(),
            self::CLIENT_FAST => $this->stopFast(),
        ];
    }

    /**
     * Get fast client status
     *
     * @param int $lines
     *
     * @return array
     */
    public function getStatus(int $lines = 10): array
    {
        $LOG = &load_class('Log');

        return [
            self::CLIENT_FAST => [
                'is_started' => $this->isStartedFast(),
                'log'        => $LOG->read_log(self::MODULE_GID, self::CLIENT_FAST, $lines),
            ],
            self::CLIENT_SLOW => [
                'is_started' => $this->isStartedSlow(),
                'log'        => $LOG->read_log(self::MODULE_GID, self::CLIENT_SLOW, $lines),
            ],
        ];
    }

    public function requestKey($domain)
    {
        $result = json_decode((string)$this->curlPost(
            $this->slow_server . 'get_key',
            ['domain' => $domain]
        ), true);
        if (empty($result['code'])) {
            $result['code'] = '';
        }

        return $result;
    }

    public function getDefaultDomain(): string
    {
        return rtrim(str_ireplace(['http://', 'https://', 'www.'], '', SITE_SERVER), '/');
    }

    /**
     * Get process id of the slow server
     *
     * @return int
     */
    private function getPidSlow(): int
    {
        $result = $this->command('slow-client.status');

        return (int) $result;
    }

    /**
     * Get process id of the fast server
     *
     * @return int
     */
    private function getPidFast(): int
    {
        // TODO: Читать pid из базы
        $pid_file = $this->getLogsDir() . 'daemon.pid';
        if ((int)shell_exec('test -f ' . $pid_file . ' && echo 1 || echo 0')) {
            $pid = (int) file_get_contents($pid_file);
        } else {
            $pid = 0;
        }

        return $pid;
    }

    /**
     * Is slow server running
     *
     * @return bool
     */
    public function isStartedSlow(): bool
    {
        return (bool) $this->getPidSlow();
    }

    /**
     * Is slow server running
     *
     * @return bool
     */
    public function isStartedFast(): bool
    {
        //TODO: Передумать.
        $pid = $this->getPidFast();
        if (empty($pid)) {
            return false;
        }

        $result = false;
        if ($this->isEnabled('shell_exec')) {
            $result = (bool) shell_exec("ps ax | grep '^\s*" . $pid . "\s' | grep -v grep");
        }

        return $result;
    }

    /**
     * Are both servers running
     *
     * @return array
     */
    public function isStarted(): array
    {
        return [
            self::CLIENT_SLOW => $this->isStartedSlow(),
            self::CLIENT_FAST => $this->isStartedFast(),
        ];
    }

    /**
     * Check client data
     *
     * @param string|null $domain
     * @param string|null $key
     *
     * @return bool
     */
    public function checkAuthData(string $domain = null, string $key = null): bool
    {
        if (!is_null($key)) {
            $this->key = $key;
        }
        if (!is_null($domain)) {
            $this->domain = $domain;
        }
        $result = $this->send('test');

        return !empty($result['test']);
    }

    /**
     * Validate network settings
     *
     * @param array $settings
     *
     * @return array
     */
    public function validateSettings(array $settings): array
    {
        $errors = [];
        if (isset($settings['domain'])) {
            if (empty($settings['domain'])) {
                $errors['domain'] = l('admin_error_domain_empty', self::MODULE_GID);
            }
        }
        if (isset($settings['key'])) {
            if (empty($settings['key'])) {
                $errors['key'] = l('admin_error_key_empty', self::MODULE_GID);
            }
        }

        return $errors;
    }

    /**
     * Get auth headers for a POST request
     *
     * @return array
     */
    private function getAuthHeaders(): array
    {
        return [CURLOPT_HTTPHEADER => [
                self::HEADER_KEY . ': ' . $this->key,
                self::HEADER_DOMAIN . ': ' . $this->domain,
        ]];
    }

    /**
     * Send request to the server
     *
     * @param string $action
     * @param array  $data
     *
     * @return mixed
     */
    private function send(string $action, array $data = [])
    {
        if (empty($this->key) || empty($this->domain) || empty($this->slow_server)) {
            return -1;
        }
        $result = $this->curlPost($this->slow_server . $action, $data);

        return json_decode((string)$result, true);
    }

    /**
     * Send POST request
     *
     * @param string $url
     * @param        $data
     * @param array  $options
     *
     * @return type
     */
    private function curlPost(string $url, $data = null, array $options = [])
    {
        // TODO: добавить библиотеку Request и положить этот метод туда.
        $defaults = [
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_URL            => $url,
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_SSL_VERIFYPEER => false,
            ] + $this->getAuthHeaders();
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function validateRequirementsCli()
    {
        try {
            $result = $this->command('requirements.php', $this->php_path, '-f');
            if (!$result) {
                throw new \Exception('Error validate Requirements Cli');
            }

            return json_decode($result, true);
        } catch (\Exception $e) {
            log_message(
                'error',
                '(' . $e->getMessage() . ') in ' . $e->getFile()
            );

            throw $e;

            return false;
        }
    }

    /**
     * Validate module requirements
     *
     * @return array
     */
    public function validateRequirements(): array
    {
        $return = ['data' => [], 'result' => true];

        $check_list = [
            [
                'func' => function () {
                    return (bool) (string) extension_loaded('pcntl');
                },
                'msg' => 'PCNTL extension is loaded',
            ],
            [
                'func' => function () {
                    return (bool) (string) function_exists('pcntl_fork');
                },
                'msg' => 'pcntl_fork() function is available',
            ],
            [
                'func' => function () {
                    return (bool) (string) function_exists('pcntl_signal');
                },
                'msg' => 'pcntl_signal() function is available',
            ],
            [
                'func' => function () {
                    return (bool) (string) function_exists('pcntl_signal_dispatch');
                },
                'msg' => 'pcntl_signal_dispatch() function is available',
            ],
            [
                'func' => function () {
                    return (bool) (string) function_exists('posix_setsid');
                },
                'msg' => 'posix_setsid() function is available',
            ],
            [
                'func' => function () {
                    return (bool) (string) function_exists('posix_kill');
                },
                'msg' => 'posix_kill() function is available',
            ],
        ];

        foreach ($check_list as $check) {
            $suit = $check['func']();
            $return['data'][] = [
                'name'   => $check['msg'],
                'value'  => $suit ? 'Yes' : 'No',
                'result' => $suit,
            ];
            $return['result'] = $return['result'] && $suit;
        }

        return $return;
    }

    /**
     * Execute a command and return it's output. Either wait until the command exits or the timeout has expired.
     *
     * @param string $cmd     Command to execute.
     * @param number $timeout Timeout in seconds.
     *
     *@throws \Exception
     *
     * @return string Output of the command.
     */
    private function exec(string $cmd, $timeout)
    {
        $descriptors = [
            0 => ['pipe', 'r'], // stdin
            1 => ['pipe', 'w'], // stdout
            2 => ['pipe', 'w'],   // stderr
        ];

        $process = proc_open('exec ' . $cmd, $descriptors, $pipes);

        if (!is_resource($process)) {
            throw new \Exception('Could not execute process');
        }

        stream_set_blocking($pipes[1], false);

        $timeout = $timeout * 1000000;

        $buffer = '';

        while ($timeout > 0) {
            $start = microtime(true);

            $read = [$pipes[1]];
            $other = [];
            stream_select($read, $other, $other, 0, $timeout);

            $status = proc_get_status($process);

            $buffer .= stream_get_contents($pipes[1]);

            if (!$status['running']) {
                break;
            }

            $timeout -= (microtime(true) - $start) * 1000000;
        }

        $errors = stream_get_contents($pipes[2]);

        if (!empty($errors)) {
            return 0;
        }

        proc_terminate($process, 9);

        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        proc_close($process);

        return $buffer;
    }

    public function unregister()
    {
        $this->stop();
        $this->setConfig([
            'is_registered' => 0,
            'key'           => '',
            'domain'        => '',
        ]);
    }
    public function cronCheckStarted()
    {
        $is_started = $this->ci->pg_module->get_module_config('network', 'is_started');
        if ($is_started) {
            $this->start();
        } else {
            $this->stop();
        }
    }

    public static function filterData()
    {
        return filter_input_array(INPUT_POST, [
            'domain' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_FLAG_EMPTY_STRING_NULL
            ],
            'key' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_FLAG_EMPTY_STRING_NULL
             ],
            'is_upload_photos' => [
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_NULL_ON_FAILURE
            ],
            'site_type' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'user_type' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'orientation' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'lang' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'land' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'country_code' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags'  => FILTER_REQUIRE_ARRAY
            ],
            'min_age' => [
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_NULL_ON_FAILURE
            ],
            'max_age' => [
                'filter' => FILTER_VALIDATE_INT,
                'flags'  => FILTER_NULL_ON_FAILURE
            ]
        ]);
    }

    /**
     * Is active function
     *
     * @param string $f function name
     *
     * @return bool
     */
    private function isEnabled(string $f): bool
    {
        return is_callable($f) && false === stripos(ini_get('disable_functions'), $f);
    }

    public function __call($name, $args)
    {
        $methods = [
            'check_auth_data' => 'checkAuthData',
            'get_auth_data' => 'getAuthData',
            'get_config' => 'getConfig',
            'get_logs_dir' => 'getLogsDir',
            'get_status' => 'getStatus',
            'is_started' => 'isStarted',
            'is_started_fast' => 'isStartedFast',
            'is_started_slow' => 'isStartedSlow',
            'set_config' => 'setConfig',
            'start_fast' => 'startFast',
            'start_slow' => 'startSlow',
            'stop_fast' => 'stopFast',
            'stop_slow' => 'stopSlow',
            'validate_settings' => 'validateSettings',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
