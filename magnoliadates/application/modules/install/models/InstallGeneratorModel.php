<?php

namespace Pg\modules\install\models;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Pg\modules\install\models\Generators\CreateCRUD;
use Pg\modules\install\models\Generators\CreateModel;
use Pg\modules\install\models\Generators\CreateModule;
use Pg\modules\install\models\Generators\PropertyContainer;

class InstallGeneratorModel
{
    protected $module;
    protected $model;
    protected $format_name_model;
    protected $table;
    protected $fields;
    protected $controller_side;

    /**
     * @param string $module
     */
    public function setModule(string $module)
    {
        $this->module = $module;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $table
     */
    public function setTable(string $table)
    {
        $this->table = $table;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param string $controller_side
     */
    public function setControllerSide(string $controller_side)
    {
        $this->controller_side = $controller_side;
    }

    /**
     * @param bool $is_example
     */
    public function setFormatNameModel(bool $is_example)
    {
        $this->format_name_model = $this->formatNameModel($this->module, $this->model, $is_example);
    }

    /**
     * Has model
     *
     * @param string $module_name
     * @param string $model_name
     *
     * @return bool
     */
    public function hasModel(string $module_name, string $model_name): bool
    {
        return file_exists(SITE_PATH . SITE_SUBFOLDER .
            "application/modules/{$module_name}/models/{$model_name}.php");
    }

    /**
     * Format name model
     *
     * @param string $module_name
     * @param string $model_name
     * @param bool $is_example
     *
     * @return array|string|string[]
     */
    public function formatNameModel(string $module_name, string $model_name, bool $is_example = true)
    {
        $model = str_replace(' ', '', ucwords(str_replace('_', ' ', $model_name)));
        $prefix = ucfirst($module_name);
        $postfix = 'Model';
        $is_prefix = strrpos($model, $prefix);
        if ($is_prefix === false && $is_example === true) {
            $model = $prefix.$model;
        } elseif ($is_prefix !== false && $is_example === false) {
            $model = str_replace($prefix, '', $model);
        }

        $is_postfix = strrpos($model, $postfix);
        if ($is_postfix === false) {
            $model = $model.$postfix;
        }

        return $model;
    }

    /**
     * @throws FileNotFoundException
     */
    public function generateCrud($is_return = true): array
    {
        $result = [];
        if ($this->hasModel($this->module, $this->format_name_model) !== true) {
            $model = new CreateCRUD($this->table, $this->fields, $this->module, $this->format_name_model, $this->controller_side);
            $model->generate();

            if (!empty($is_return)) {
                $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/");
                $filesystem = new Filesystem($adapter);
                $list = $filesystem->listContents('', true);

                $current_timestamp = strtotime('-1 minute');
                foreach ($list as $item) {
                    if ($item['type'] == 'file' && $item['timestamp'] > $current_timestamp) {
                        $result['data']['files_list'][] = $item;
                    }
                }
                $result['data']['success_msg'] = 'Create CRUD success';
                $result['data']['module_path'] = SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/";
            }
        } else {
            $result['errors'][] = "Model already exists!!!";
        }

        return $result;
    }

    /**
     * @return array[]
     */
    public function generateModule($is_return = true): array
    {
        $generator = new CreateModule($this->module);
        $generator->generate();

        $result = [];
        if (!empty($is_return)) {
            $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/");
            $filesystem = new Filesystem($adapter);

            return [
                'data' => [
                    'files_list' => $filesystem->listContents('', true),
                    'module_path' => SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/",
                    'success_msg' => "Module successfully created"
                ]
            ];
        }

        return $result;
    }

    public function generateModel($is_return = true): array
    {
        $result = [];
        if ($this->hasModel($this->module, $this->format_name_model) !== true) {
            if (!empty($is_return)) {
                $property_container = new PropertyContainer();
                $property_container->add('module_name', $this->module);
                $property_container->add('table_name', str_replace(DB_PREFIX, '', $this->table));
                $property_container->add('model_list', [strtolower($this->format_name_model) => $this->format_name_model]);
                $property_container->add(
                    'sample_fields',
                    $this->fieldsByTableStructure($this->fields)
                );

                (new CreateModel())->create($property_container);
                if (!empty($is_return)) {
                    $adapter = new Local(SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/");
                    $filesystem = new Filesystem($adapter);
                    $list = $filesystem->listContents('', true);

                    $current_timestamp = strtotime('-1 minute');
                    foreach ($list as $item) {
                        if ($item['type'] == 'file' && $item['timestamp'] > $current_timestamp) {
                            $result['data']['files_list'][] = $item;
                        }
                    }
                    $result['data']['success_msg'] = 'Create model success';
                    $result['data']['module_path'] = SITE_PATH . SITE_SUBFOLDER . "application/modules/$this->module/";
                }
            }
        } else {
            $result['errors'][] = "Model already exists!!!";
        }

        return $result;
    }

    private function fieldsByTableStructure(array $table): array
    {
        $fields = [];
        foreach ($table as $item) {
            $column_name = $item['Field'] ?? $item['name'];
            $default = $item['Default'] ?? null;
            $fields[$column_name] = ($column_name == 'id') ? [] : [
                'column_name' => $column_name,
                'type' => $item['Type'] ?? $item['native_type'],
                'options' => "['default' => {$default}]"
            ];
        }

        return $fields;
    }
}
