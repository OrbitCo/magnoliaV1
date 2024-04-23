<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class InstallMainMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table(DB_PREFIX . 'languages');
        $table->addColumn('code', 'string', ['limit' => 10])
            ->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('status', 'boolean', ['default' => false])
            ->addColumn('rtl', 'enum', ['values' => ['rtl','ltr']])
            ->addColumn('is_default', 'boolean', ['default' => false])
            ->addColumn('date_created', 'datetime')
            ->addIndex('code', ['unique' => true])
            ->create();

        $table = $this->table(DB_PREFIX . 'lang_dedicate_modules');
        $table->addColumn('module', 'string', ['limit' => 25, 'null' => true])
            ->addColumn('model', 'string', ['limit' => 100])
            ->addColumn('method_add', 'string', ['limit' => 100])
            ->addColumn('method_delete', 'string', ['limit' => 100])
            ->addColumn('date_created', 'datetime')
            ->addIndex('model', ['unique' => true])
            ->create();

        $table = $this->table(DB_PREFIX . 'lang_ds');
        $table->addColumn('module_gid', 'string', ['limit' => 100])
            ->addColumn('gid', 'string', ['limit' => 100])
            ->addColumn('option_gid', 'string', ['limit' => 50, 'default' => ''])
            ->addColumn('type', 'enum', ['values' => ['header','option']])
            ->addColumn('sorter', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addIndex('module_gid')
            ->addIndex('sorter')
            ->create();

        $table = $this->table(DB_PREFIX . 'lang_pages');
        $table->addColumn('module_gid', 'string', ['limit' => 100])
            ->addColumn('gid', 'string', ['limit' => 100])
            ->addIndex('module_gid')
            ->create();

        $table = $this->table(DB_PREFIX . 'libraries');
        $table->addColumn('gid', 'string', ['limit' => 25])
            ->addColumn('version', 'float')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('date_add', 'datetime')
            ->create();

        $table = $this->table(DB_PREFIX . 'modules');
        $table->addColumn('module_gid', 'string', ['limit' => 25])
            ->addColumn('module_name', 'string', ['limit' => 100])
            ->addColumn('module_description', 'text')
            ->addColumn('category', 'string', ['limit' => 255])
            ->addColumn('version', 'float')
            ->addColumn('is_disabled', 'boolean', ['default' => 0, 'signed' => false])
            ->addColumn('is_custom_module', 'boolean', ['default' => 0, 'signed' => false])
            ->addColumn('date_add', 'datetime')
            ->addColumn('date_update', 'datetime')
            ->addIndex('module_gid', ['unique' => true])
            ->create();

        $table = $this->table(DB_PREFIX . 'modules_config');
        $table->addColumn('module_gid', 'string', ['limit' => 25])
            ->addColumn('config_gid', 'string', ['limit' => 100])
            ->addColumn('value', 'text')
            ->addIndex('module_gid')
            ->create();

        $table = $this->table(DB_PREFIX . 'modules_methods');
        $table->addColumn('module_gid', 'string', ['limit' => 25])
            ->addColumn('controller', 'string', ['limit' => 35])
            ->addColumn('method', 'string', ['limit' => 100])
            ->addColumn('access', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addIndex('module_gid')
            ->addIndex(['module_gid', 'controller', 'method'])
            ->create();

        $table = $this->table(DB_PREFIX . 'sessions');
        $table->addColumn('session_id', 'string', ['limit' => 40, 'default' => 0])
            ->addColumn('last_activity', 'integer', ['default' => 0, 'signed' => false])
            ->addColumn('ip_address', 'integer', ['default' => 0, 'limit' => MysqlAdapter::INT_BIG])
            ->addColumn('user_agent', 'string', ['limit' => 40])
            ->addColumn('user_data', 'text')
            ->addIndex('session_id')
            ->addIndex('last_activity')
            ->create();

        $table = $this->table(DB_PREFIX . 'themes');
        $table->addColumn('theme', 'string', ['limit' => 100])
            ->addColumn('theme_type', 'enum', ['default' => 'user', 'values' => ['admin','user']])
            ->addColumn('scheme', 'string', ['limit' => 100])
            ->addColumn('active', 'boolean', ['default' => 0])
            ->addColumn('theme_name', 'string', ['limit' => 255])
            ->addColumn('theme_description', 'string', ['limit' => 255])
            ->addColumn('setable', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addColumn('logo_width', 'integer')
            ->addColumn('logo_height', 'integer')
            ->addColumn('logo_default', 'string', ['limit' => 255])
            ->addColumn('mini_logo_width', 'integer')
            ->addColumn('mini_logo_height', 'integer')
            ->addColumn('mini_logo_default', 'string', ['limit' => 255])
            ->addColumn('mobile_logo_width', 'integer')
            ->addColumn('mobile_logo_height', 'integer')
            ->addColumn('mobile_logo_default', 'string', ['limit' => 255])
            ->addColumn('template_engine', 'enum', ['default' => 'twig', 'values' => ['templateLite', 'twig']])
            ->addIndex('active', ['name' => 'default'])
            ->create();

        $table = $this->table(DB_PREFIX . 'themes_coloursets_logo');
        $table->addColumn('id_set', 'integer')
            ->addColumn('id_lang', 'integer')
            ->addColumn('active', 'boolean', ['default' => 0])
            ->addColumn('logo_width', 'integer')
            ->addColumn('logo_height', 'integer')
            ->addColumn('logo', 'string', ['limit' => 255])
            ->addColumn('mini_logo_width', 'integer')
            ->addColumn('mini_logo_height', 'integer')
            ->addColumn('mini_logo', 'string', ['limit' => 255])
            ->addColumn('mobile_logo_width', 'integer')
            ->addColumn('mobile_logo_height', 'integer')
            ->addColumn('mobile_logo', 'string', ['limit' => 255])
            ->addColumn('text_logo', 'string', ['limit' => 20])
            ->addColumn('text_logo_mini', 'string', ['limit' => 20])
            ->addIndex('id_set')
            ->create();

        $table = $this->table(DB_PREFIX . 'themes_colorsets');
        $table->addColumn('set_name', 'string', ['limit' => 255])
            ->addColumn('set_gid', 'string', ['limit' => 100])
            ->addColumn('id_theme', 'integer')
            ->addColumn('color_settings', 'text')
            ->addColumn('default_color_settings', 'text')
            ->addColumn('active', 'boolean')
            ->addColumn('scheme_type', 'string', ['limit' => 5])
            ->addColumn('preset', 'string', ['limit' => 50, 'default' => 'default'])
            ->addColumn('is_generated', 'boolean', ['default' => 0])
            ->addIndex('id_theme')
            ->create();

        $table = $this->table(DB_PREFIX . 'seo_modules');
        $table->addColumn('module_gid', 'string', ['limit' => 25])
            ->addColumn('model_name', 'string', ['limit' => 50])
            ->addColumn('get_settings_method', 'string', ['limit' => 100])
            ->addColumn('get_rewrite_vars_method', 'string', ['limit' => 100])
            ->addColumn('get_sitemap_urls_method', 'string', ['limit' => 100])
            ->addIndex('module_gid')
            ->create();

        $table = $this->table(DB_PREFIX . 'seo_settings');
        $table->addColumn('controller', 'enum', ['values' => ['user','admin','custom']])
            ->addColumn('module_gid', 'string', ['limit' => 25])
            ->addColumn('method', 'string', ['limit' => 50])
            ->addColumn('noindex', 'integer', ['limit' => MysqlAdapter::INT_TINY])
            ->addColumn('url_template', 'string', ['limit' => 255])
            ->addColumn('lang_in_url', 'boolean', ['default' => 0])
            ->addColumn('priority', 'decimal', ['default' => '0.5', 'limit' => 1])
            ->addIndex('module_gid', ['name' => 'model'])
            ->addIndex('controller')
            ->addIndex('method')
            ->create();

        $table = $this->table(DB_PREFIX . 'acl');
        $table->addColumn('module_gid', 'string', ['limit' => 50])
            ->addColumn('caller_type', 'string', ['limit' => 50])
            ->addColumn('caller_id', 'integer', ['default' => 0])
            ->addColumn('role', 'string', ['limit' => 50])
            ->addColumn('type', 'string', ['limit' => 50])
            ->addColumn('action', 'string', ['limit' => 50])
            ->addColumn('resource_type', 'string', ['limit' => 255])
            ->addColumn('resource_id', 'integer')
            ->addColumn('data', 'text')
            ->addColumn('exclude', 'boolean')
            ->addIndex('caller_type')
            ->addIndex('role')
            ->create();
    }
}
