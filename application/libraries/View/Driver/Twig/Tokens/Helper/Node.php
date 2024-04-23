<?php

namespace Pg\Libraries\View\Driver\Twig\Tokens\Helper;

use Twig\Compiler;

class Node extends \Twig\Node\Node
{
    /**
     * @param $module
     * @param $helper
     * @param $name
     * @param $params
     * @param null $var
     * @param int $line
     * @param null $tag
     */
    public function __construct($module, $helper, $name, $params, $var = null, $line = 0, $tag = null)
    {
        $nodes = [];
        $attrs = [];

        if ($module && is_object($module)) {
            $nodes['module'] = $module;
        } else {
            $attrs['module'] = $module;
        }

        if (is_string($helper)) {
            $attrs['helper'] = $helper;
        } else {
            $nodes['helper'] = $helper;
        }

        if (is_string($name)) {
            $attrs['name'] = $name;
        } else {
            $nodes['name'] = $name;
        }

        $attrs['params'] = $params;
        $attrs['var'] = $var;

        parent::__construct($nodes, $attrs, $line, $tag);
    }

    /**
     * @param Compiler $compiler
     */
    public function compile(Compiler $compiler)
    {
        $var = $this->getAttribute('var');
        $params = $this->getAttribute('params');

        $compiler
            ->addDebugInfo($this);

        $compiler
                ->write('$module = ');

        if ($this->hasNode('module')) {
            $compiler
               ->subcompile($this->getNode('module'));
        } else {
            $module = $this->getAttribute('module');

            $compiler
                ->write($module ? '\'' . $module . '\'' : 'null');
        }

        $compiler
            ->raw(";\n");

        $compiler
                ->write('$helper = ');

        if ($this->hasNode('helper')) {
            $compiler
               ->subcompile($this->getNode('helper'));
        } else {
            $compiler
                ->write('\'' . $this->getAttribute('helper') . '\'');
        }

        $compiler
            ->raw(";\n");

        $compiler
                ->write('$name = ');

        if ($this->hasNode('name')) {
            $compiler
               ->subcompile($this->getNode('name'));
        } else {
            $compiler
                ->write('\'' . $this->getAttribute('name') . '\'');
        }

        $compiler
            ->raw(";\n");

        $compiler
            ->write('$params = array(');

        foreach ($params as $param) {
            $compiler->subcompile($param)
                ->write(',');
        }

        $compiler
            ->write(')')
            ->raw(";\n")
            ->write('@ob_start()')
            ->raw(";\n")

            ->write('$ci = &get_instance()')
            ->raw(";\n")

            ->write('$ci->load->helper($helper, $module)')
            ->raw(";\n")

            // TODO: убрать после приведения к PSR
            ->write('if (empty($module)) {')
            ->raw("\n")

            ->write('$module = str_replace(\'_helper\', \'\', $helper)')
            ->raw(";\n")

            ->write('}')
            ->raw("\n")

            ->write('if (function_exists(NS_MODULES . $module . \'\\\\helpers\\\\\' . $name)) {')
            ->raw("\n")

            ->write('$result = call_user_func_array(NS_MODULES . $module . \'\\\\helpers\\\\\' . $name, $params)')
            ->raw(";\n")

            ->write('} elseif (function_exists($name)) {')
            ->raw("\n")

            ->write('$result = call_user_func_array($name, $params)')
            ->raw(";\n")

            ->write('} else {')
            ->raw("\n")

            ->write('$result = \'\'')
            ->raw(";\n")

            ->write('}')
            ->raw("\n")

            ->write('$output_buffer = @ob_get_contents()')
            ->raw(";\n")
            ->write('@ob_end_clean()')
            ->raw(";\n")
            ->write($var ? '$context[\'' . $var . '\'] = $result' : 'echo $output_buffer.$result')
            ->raw(";\n");
    }
}
