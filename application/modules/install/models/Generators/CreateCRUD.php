<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use League\Flysystem\FileNotFoundException;

/**
 * Create CRUD
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateCRUD extends AbstractGenerator
{
    /**
     * Database table fields
     *
     * @var array
     */
    public $fields = [];

    public function __construct(string $table_name, array $table_structure, string $name, string $model_name, string $controller_side)
    {
        $this->property_container = new PropertyContainer();
        $this->property_container->add('module_name', $name);
        $this->property_container->add('table_name', str_replace(DB_PREFIX, '', $table_name));
        $this->property_container->add('acl_prefix_controller', $this->acl_prefix_controller);
        $this->property_container->add('methods', $this->methods($model_name));
        $this->property_container->add('model_list', [strtolower($model_name) => $model_name]);
        $this->property_container->add('controller_side', $controller_side);
        $this->property_container->add(
            'sample_fields',
            $this->fieldsByTableStructure($table_structure)
        );
    }

    private function fieldsByTableStructure(array $table): array
    {
        foreach ($table as $item) {
            $column_name = $item['Field'] ?? $item['name'];
            $default = $item['Default'] ?? null;
            $this->fields[$column_name] = ($column_name == 'id') ? [] : [
                'column_name' => $column_name,
                'type' => $item['Type'] ?? $item['native_type'],
                'options' => "['default' => {$default}]"
            ];
        }

        return $this->fields;
    }

    /**
     * Generate structure CRUD
     *
     * @throws FileNotFoundException
     *
     * @return void
     */
    public function generate()
    {
        (new CreateModel())->create($this->property_container);
        (new CreateControllerMethods())->create($this->property_container);
        (new CreateView())->create($this->property_container);
        //(new CreateInstallerMigration())->create($this->property_container);
        (new CreateInstallerStructure())->addContentPermissions($this->property_container);
    }

    /**
     * Methods list
     *
     * @param string $model
     *
     * @return array
     */
    private function methods(string $model): array
    {
        $prefix = str_replace($this->property_container->get('module_name'), '', $model);
        $prefix = lcfirst(str_replace('Model', '', $prefix));
        $methods = [];
        foreach ($this->methods as $method => $args) {
            $methods[$prefix.ucfirst($method)] = $args;
        }
        $this->methods = $methods;

        return $methods;
    }
}
