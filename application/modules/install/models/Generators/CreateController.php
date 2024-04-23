<?php

declare(strict_types=1);

namespace Pg\modules\install\models\Generators;

use Pg\modules\install\models\Generators\Interfaces\IPropertyContainer;

/**
 * Create Controller
 *
 * @package PG_Dating
 * @subpackage  Install module
 * @category    models
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CreateController extends AbstractFileData
{
    /**
     * File extension
     *
     * @var string
     */
    protected const EXT = '.php';

    /**
     * Generate current controller
     *
     * @var bool
     */
    protected $is_api_controller = false;

    /**
     * @inheritDoc
     */
    public function create(IPropertyContainer $property_container)
    {
        $this->property_container = $property_container;
        $name = $this->property_container->get('module_name');
        $acl_prefix_controller = $this->property_container->get('acl_prefix_controller');

        $this->setPath($name, 'controllers');
        foreach ($acl_prefix_controller as $role => $prefix) {
            $this->is_api_controller = $role == 'api';
            $this->setFile($name, $prefix);
            $this->fileData($name);
        }
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $name, string $prefix = '', string $postfix = '')
    {
        $this->name = $this->setName($name, $prefix, $postfix);
        $file_path = $this->path . $this->name . self::EXT;

        if (!is_file($file_path)) {
            touch($file_path);
        }
    }

    /**
     * @inheritDoc
     */
    public function fileData(string $name)
    {
        $content = "<?php\n\ndeclare(strict_types=1);\n\n";
        $content .= "namespace Pg\\modules\\{$name}\\controllers;\n\n";
        if ($this->is_api_controller !== true) {
            $content .= "use Pg\\Libraries\\View;\n\n";
        }
        $methods = $this->getMethods();
        $content .= "class {$this->name} extends \Controller\n{\n{$methods}}\n";
        $file_path = $this->path . $this->name . self::EXT;
        file_put_contents($file_path, $content);
    }

    /**
     * Controller methods
     *
     * @return string
     */
    protected function getMethods(): string
    {
        $content = "    public function __construct()\n    {\n";
        $content .= "        parent::__construct();\n";
        $content .= $this->getModelName();
        $content .= "    }\n";
        $methods = $this->property_container->get('methods');
        foreach ($methods as $crud_method => $args) {
            $content .= "    public function {$crud_method}({$args})\n    {\n";
            if ($this->is_api_controller === true) {
                $content .= "        \$this->set_api_content('data', []);\n";
            } else {
                $content .= "        \$this->view->render('{$crud_method}');\n";
            }
            $content .= "    }\n\n";
        }

        return $content;
    }

    /**
     * Get module name
     *
     * @return string
     */
    private function getModelName(): string
    {
        $name = $this->property_container->get('module_name');
        $model = ucfirst($name).'Model';

        return "        \$this->load->model('{$model}');\n";
    }

    private function getContentIndex()
    {
        $name = $this->property_container->get('module_name');
        $content = '';

        return $content;
    }

    private function getContentCreate()
    {
        $name = $this->property_container->get('module_name');
        $content = '';

        return $content;
    }

    private function getContentView()
    {
        $name = $this->property_container->get('module_name');
        $content = '';

        return $content;
    }

    private function getContentEdit()
    {
        $name = $this->property_container->get('module_name');
        $content = '';

        return $content;
    }

    private function getContentDelete()
    {
        $name = $this->property_container->get('module_name');
        $content = '';

        return $content;
    }
}
