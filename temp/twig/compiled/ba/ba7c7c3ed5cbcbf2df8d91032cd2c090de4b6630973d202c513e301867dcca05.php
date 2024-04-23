<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* list_fields.twig */
class __TwigTemplate_4e919ccec0597fcbb929abe39a2dbc29fb718ee9eb82183f06beeea699d25800 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ((($context["mode"] ?? null) != "sort")) {
            $this->loadTemplate("@app/header.twig", "list_fields.twig", 1)->display($context);
        } else {
            $this->loadTemplate("@app/header.twig", "list_fields.twig", 1)->display(twig_array_merge($context, ["load_type" => "ui"]));
        }
        // line 2
        echo "<ul class=\"nav nav-tabs bar_tabs\">
    ";
        // line 3
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_fields_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 4
        echo "</ul>

<div class=\"x_panel\">
    ";
        // line 7
        if ((($context["mode"] ?? null) != "sort")) {
            // line 8
            echo "        ";
            $this->loadTemplate("list_fields_list.twig", "list_fields.twig", 8)->display($context);
            // line 9
            echo "    ";
        } else {
            // line 10
            echo "        ";
            $this->loadTemplate("list_fields_sort.twig", "list_fields.twig", 10)->display($context);
            // line 11
            echo "    ";
        }
        // line 12
        echo "
</div>

";
        // line 15
        $this->loadTemplate("@app/footer.twig", "list_fields.twig", 15)->display($context);
    }

    public function getTemplateName()
    {
        return "list_fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 15,  79 => 12,  76 => 11,  73 => 10,  70 => 9,  67 => 8,  65 => 7,  60 => 4,  39 => 3,  36 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_fields.twig", "/home/mliadov/public_html/application/modules/field_editor/views/gentelella/list_fields.twig");
    }
}
