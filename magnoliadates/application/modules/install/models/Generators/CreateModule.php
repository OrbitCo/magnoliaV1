<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

/**
 * Create Module
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateModule extends AbstractGenerator
{
    /**
     * Database table fields
     *
     * @var array
     */
    public $sample_fields = [
        'id' => [],
        'name' => [
            'column_name' => 'name',
            'type' => 'string',
            'options' => "['limit' => 100]"
        ],
        'description' => [
            'column_name' => 'description',
            'type' => 'text'
        ],
        'status' => [
            'column_name' => 'status',
            'type' => 'boolean',
            'options' => "['default' => false]"
        ],
        'date_update' => [
            'column_name' => 'date_update',
            'type' => 'datetime'
        ],
        'date_create' => [
            'column_name' => 'date_create',
            'type' => 'datetime'
        ],
    ];

    /**
     * Module lang packages
     *
     * @var array
     */
    public $langs = ['en', 'ru'];

    /**
     * Module lang files
     *
     * @var array
     */
    public $lang_files = [
        'arbitrary',
        'ds',
        'menu',
        'pages',
        'services'
    ];

    /**
     * Models postfix list
     *
     * @var array
     */
    protected $model_list = [
        'main' => 'Model',
        'install' => 'InstallModel'
    ];

    /**
     * InstallCreateModuleModel constructor
     */
    public function __construct(string $name)
    {
        $this->property_container = new PropertyContainer();
        $this->property_container->add('module_name', $name);
        $this->property_container->add('table_name', $name);
        $this->property_container->add('sample_fields', $this->sample_fields);
        $this->property_container->add('acl_prefix_controller', $this->acl_prefix_controller);
        $this->property_container->add('methods', $this->methods());
        $this->property_container->add('model_list', $this->model_list);
        $this->property_container->add('langs', $this->langs);
        $this->property_container->add('lang_files', $this->lang_files);
    }

    /**
     * Generate structure module
     *
     * @return void
     */
    public function generate()
    {
        (new CreateEvents())->create($this->property_container);
        (new CreateController())->create($this->property_container);
        (new CreateHelper())->create($this->property_container);
        (new CreateJs())->create($this->property_container);
        (new CreateLangsStructure())->create($this->property_container);
        (new CreateModel())->create($this->property_container);
        (new CreateView())->create($this->property_container);
        (new CreateInstallerMigration())->create($this->property_container);
        (new CreateInstallerStructure())->create($this->property_container);
    }

    /**
     * Methods list
     *
     * @return array
     */
    private function methods(): array
    {
        $this->methods['index'] = '';

        return $this->methods;
    }
}
