<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

/**
 * Install module.
 *
 *
 * @copyright   Copyright (c) 2000-2016 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Install Main Model.
 *
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2016 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SystemRequirementsModel extends \Model
{

    const PHP_VERSION = '7.2';

    /**
     * System requirements;.
     *
     * @var array
     */
    private $requirements = [
        ['method' => 'shellExec',       'msg' => 'shell_exec — Execute command via shell and return the complete output as a string', 'require' => false],
        ['method' => 'isModRewrite',    'msg' => 'mod_rewrite library and support of .htaccess files with RewriteRule attribute (required for semantic, or user-friendly URLs)', 'require' => false],
        ['method' => 'phpVersion',      'msg' => 'PHP [general] or higher (PHP [encoded] or below for encoded version) - obligatory (*)', 'require' => true],
        ['method' => 'phpCliVersion',   'msg' => 'PHP (Cli) [version] or higher  - obligatory (*)', 'require' => false],
        ['method' => 'phpExtensions',   'msg' => 'PHP extensions: [extensions] - obligatory (*)', 'require' => true],
        ['method' => 'phpDbExtensions', 'msg' => 'PHP database extensions: [extensions] (either pdo, or mysqli, or mysql is required for database connection) (*)', 'require' => true],
        ['method' => 'mySQLVersion',    'msg' => 'MySQL [version] or higher - obligatory (*)', 'require' => true],
        ['method' => 'ionCubeVersion',  'msg' => 'ionCube PHP Loader [version] and above enabled on your server (for encoded version)', 'require' => false],
        ['method' => 'isFfmpeg',        'msg' => 'ffmpeg (required for video thumbs, video processing, etc.)', 'require' => false],
        ['method' => 'isServerOS',      'msg' => 'Server OS: [server]', 'require' => false],
    ];

    /**
     * Dating System requirements;.
     *
     * @var array
     */
    private $dating_requirements = [];

    /**
     * PHP versions.
     *
     * @var array
     */
    private $php_version = [
        'general' => self::PHP_VERSION,
        'encoded' => self::PHP_VERSION
    ];

    /**
     * PHP (Cli) versions.
     *
     * @var array
     */
    private $php_cli_version = self::PHP_VERSION;

    /**
     * PHP extensions.
     *
     * @var array
     */
    private $php_extensions = ['gd', 'iconv', 'mbstring'];

    /**
     * PHP db extensions.
     *
     * @var array
     */
    private $php_db_extensions = ['pdo', 'mysqli'];

    /**
     * MySQL version.
     *
     * @var string
     */
    private $mysql_version = '5.1';

    /**
     * ionCube PHP Loader version.
     *
     * @var string
     */
    private $ioncube_version = 'v4.0.12';

    /**
     * Server OS.
     *
     * @var array
     */
    private $server_os = ['Unix', 'Windows'];

    /**
     * Dating network PHP extensions.
     *
     * @var array
     */
    private $network_php_extensions = ['pcntl', 'posix'];

    /**
     * Check system.
     *
     * @var array
     */
    private $check_system = [];

    /**
     * SystemRequirementsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if ($this->ci->Install_model->get_module_config('network') !== false) {
            $this->dating_requirements[] = [
                'method' => 'networkPhpExtensions',
                'msg' => 'Dating network PHP extensions: ',
            ];
        }
    }

    /**
     * Check the system requirements.
     *
     * @return array
     */
    public function checkSystemRequirements(): array
    {
        $requirements = (PRODUCT_NAME == 'dating') ? array_merge($this->requirements, $this->dating_requirements) : $this->requirements;
        foreach ($requirements as $check) {
            $this->check_system[$check['method']] = $this->{$check['method']}($check['msg']);
        }

        return $this->check_system;
    }

    private function shellExec($msg): array
    {
        $result = ['status' => 0];

        if ($this->isShellExec() === true) {
            $result['status'] = 1;
        }

        $result['msg'] = $msg;

        return $result;
    }

    /**
     * Check mod_rewrite library and support of .htaccess files with RewriteRule attribute.
     *
     * @param string $msg
     *
     * @return array
     */
    private function isModRewrite(string $msg): array
    {
        if ('cgi' == CI_SERVER_API) {
            $is_rewrite = (bool) strpos((string) shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite');
        } elseif (function_exists('apache_get_modules')) {
            $is_rewrite = in_array('mod_rewrite', apache_get_modules(), true);
        } else {
            $is_rewrite = true;
        }
        $result['status'] = $is_rewrite;
        $result['msg'] = $msg;

        return $result;
    }

    /**
     * Check PHP Version.
     *
     * @param string $msg
     *
     * @return array
     */
    private function phpVersion(string $msg): array
    {
        $result = ['status' => 0];

        if (version_compare(PHP_VERSION, $this->php_version['general']) >= 0) {
            $result['status'] = 1;
        }

        $result['msg'] = str_replace(['[general]', '[encoded]'], $this->php_version, $msg);

        return $result;
    }

    /**
     * Check PHP (Cli) Version.
     *
     * @param string $msg
     *
     * @return array
     */
    private function phpCliVersion(string $msg): array
    {
        $result = ['status' => 0];
        if ($this->isShellExec() === true) {
            $output = shell_exec('php -v');
            if (!empty($output)) {
                $php_cli_v = explode(' ', $output)[1];
                if (version_compare($php_cli_v, $this->php_cli_version) >= 0) {
                    $result['status'] = 1;
                }
            }
        }

        $result['msg'] = str_replace('[version]', $this->php_cli_version, $msg);

        return $result;
    }

    /**
     * Check PHP Extensions.
     *
     * @param string $msg
     *
     * @return array
     */
    private function phpExtensions(string $msg): array
    {
        $result = [];
        foreach ($this->php_extensions as $extension) {
            $result['status'][$extension] = false;
            if ($extension != 'gd') {
                $result['status'][$extension] = (bool) extension_loaded($extension);
            } else {
                if (function_exists('gd_info')) {
                    $ver_info = gd_info();
                    preg_match('/\d/', $ver_info['GD Version'], $match);
                    $gd_ver = $match[0];
                    $result['status'][$extension] = ($gd_ver >= 2) ? 1 : 0;
                }
            }
            $result['msg'][$extension] = str_replace('[extensions]', $extension, $msg);
        }

        return $result;
    }

    /**
     * Check PHP Database Extensions.
     *
     * @param string $msg
     *
     * @return array
     */
    private function phpDbExtensions(string $msg): array
    {
        $result = [];
        foreach ($this->php_db_extensions as $extension) {
            $result['status'][$extension] = (bool) extension_loaded($extension);
            $result['msg'][$extension] = str_replace('[extensions]', $extension, $msg);
        }

        return $result;
    }

    /**
     * Check exec().
     *
     * @return bool
     */
    private function isExec(): bool
    {
        if (function_exists('exec') && !in_array('exec', array_map('trim', explode(', ', ini_get('disable_functions')))) && @exec('echo EXEC') == 'EXEC') {
            return true;
        }

        return false;
    }

    /**
     * Check MySQL version.
     *
     * @param string $msg
     *
     * @return array
     */
    private function mySQLVersion(string $msg): array
    {
        $result = ['status' => 0];
        if ($this->isExec() === true) {
            $mysql_data = explode(' ', exec('mysql -V'));
            $key_data = array_search('Distrib', $mysql_data, true) ?: array_search('Ver', $mysql_data, true);
            $mysql_version = (string)$mysql_data[$key_data + 1];

            if (version_compare($mysql_version, $this->mysql_version) >= 0) {
                $result['status'] = 1;
            }

            $msg = str_replace('[version]', $this->mysql_version, $msg);
            $result['msg'] = $msg;
        } else {
            $result['msg'] = $msg.' - Unknown';
        }

        return $result;
    }

    /**
     * Check ionCube.
     *
     * @param string $msg
     *
     * @return array
     */
    private function ionCubeVersion(string $msg): array
    {
        $result = [];

        if (PACKAGE_NAME == 'trial') {
            $result = ['status' => 0];

            if ($this->isIoncube() === true) {
                $ioncube_version = $this->ioncubeLoaderVersion();
                if (version_compare($ioncube_version, $this->ioncube_version) >= 0) {
                    $result['status'] = 1;
                }
                $result['msg'] = str_replace('[version]', $this->ioncube_version, $msg);
            } else {
                $result['msg'] = 'IonCube not installed';
            }
        }

        return $result;
    }

    /**
     * Check ionCube version.
     *
     * @return string
     */
    private function ioncubeLoaderVersion(): string
    {
        if (function_exists('ioncube_loader_iversion')) {
            $ioncube_loader_iversion = ioncube_loader_iversion();
            $ioncube_loader_version_major = (int) substr($ioncube_loader_iversion, 0, 1);
            $ioncube_loader_version_minor = (int) substr($ioncube_loader_iversion, 1, 2);
            $ioncube_loader_version_revision = (int) substr($ioncube_loader_iversion, 3, 2);
            $ioncube_loader_version = "$ioncube_loader_version_major.$ioncube_loader_version_minor.$ioncube_loader_version_revision";
        } else {
            $ioncube_loader_version = ioncube_loader_version();
        }

        return $ioncube_loader_version;
    }

    /**
     * Check ionCube PHP Loader.
     *
     * @return bool
     */
    private function isIoncube(): bool
    {
        return extension_loaded('ionCube Loader');
    }

    /**
     * Check ffmpeg-php extension should be installed.
     *
     * @param string $msg
     *
     * @return array
     */
    private function isFfmpeg(string $msg): array
    {
        return [
            'msg' => $msg,
            'status' => $this->statusFfmpeg(),
        ];
    }

    /**
     * Status ffmpeg.
     *
     * @return bool
     */
    private function statusFfmpeg(): bool
    {
        if ($this->isShellExec() === true) {
            return strpos((string) shell_exec('ffmpeg -version'), 'ffmpeg version') !== false;
        }

        return false;
    }

    /**
     * Method shell_exec availability check.
     *
     * @return bool
     */
    private function isShellExec(): bool
    {
        return function_exists('shell_exec') && is_callable('shell_exec');
    }

    /**
     * Check Server OS.
     *
     * @param string $msg
     *
     * @return array
     */
    private function isServerOS(string $msg): array
    {
        $server = (stripos(PHP_OS, 'WIN') === 0) ? 'Windows' : 'Unix';

        return [
            'status' => in_array($server, $this->server_os, true),
            'msg' => str_replace('[server]', $server, $msg),
        ];
    }

    /**
     * Check Other Php Extensions.
     *
     * @param string $msg
     *
     * @return array
     */
    private function networkPhpExtensions(string $msg): array
    {
        $result = [];
        foreach ($this->network_php_extensions as $extension) {
            $result['status'][$extension] = (bool) extension_loaded($extension);
            $result['msg'][$extension] = $msg.$extension.'(required for the Network)';
        }

        return $result;
    }
}
