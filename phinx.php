<?php

require_once "config.php";

use Pg\modules\install\models\InstallMigrateModel;

$migrations = '%%PHINX_CONFIG_DIR%%/application/modules/*/install/db/migrations';
$seeds = '%%PHINX_CONFIG_DIR%%/application/modules/*/install/db/seeds';

$sapi_type = php_sapi_name();
if (
    ($sapi_type !== 'cli'
        && substr($sapi_type, 0, 3) !== 'cgi'
        && INSTALL_DONE !== true)
    || !empty(getenv('SET_MODULE_ACTION'))
) {
    $migrations = InstallMigrateModel::$migrations;
    $seeds = InstallMigrateModel::$seeds;
}

return
    [
        'paths' => [
            'migrations' => $migrations,
            'seeds' => $seeds
        ],
        'templates' => [
            'file' => '%%PHINX_CONFIG_DIR%%/application/modules/install/install/migrations_template.default'
        ],
        'environments' => [
            'default_migration_table' => DB_PREFIX . 'phinxlog',
            'default_environment' => 'production',
            'production' => [
                'adapter' => 'mysql',
                'host' => DB_HOSTNAME,
                'name' => DB_DATABASE,
                'user' => DB_USERNAME,
                'pass' => DB_PASSWORD,
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => DB_HOSTNAME,
                'name' => DB_DATABASE,
                'user' => DB_USERNAME,
                'pass' => DB_PASSWORD,
                'charset' => 'utf8',
            ],
        ],
        'version_order' => 'creation'
    ];
