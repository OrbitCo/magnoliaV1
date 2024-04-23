<?php

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IGenerator;

abstract class AbstractGenerator implements IGenerator
{

    /**
     * @var PropertyContainer
     */
    protected $property_container;

    /**
     * Access control list (prefix controller)
     *
     * @var array
     */
    protected $acl_prefix_controller = [
        'admin' => 'Admin',
        'api' => 'Api',
        'user' => ''
    ];

    /**
     * Generate methods list
     * (controller methods and template files)
     *
     * @var array
     */
    public $methods = [
        'create' => '',
        'view' => '$id',
        'edit' => '$id',
        'delete' => '$id'
    ];

    /**
     * @inheritDoc
     */
    abstract public function generate();
}
