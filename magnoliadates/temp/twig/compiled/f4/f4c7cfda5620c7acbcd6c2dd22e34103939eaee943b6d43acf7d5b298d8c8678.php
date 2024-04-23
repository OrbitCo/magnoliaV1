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

/* list_sections.twig */
class __TwigTemplate_8f7da4bc462618c4e26f9dac494567386626f977a9aa8b29d3883264a5c50b8f extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_sections.twig", 1)->display(twig_array_merge($context, ["load_type" => "ui"]));
        // line 2
        echo "
<ul class=\"nav nav-tabs bar_tabs\">
    ";
        // line 4
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
        // line 5
        echo "</ul>

<div class=\"x_panel\">
    ";
        // line 8
        if ((($context["mode"] ?? null) == "sort")) {
            // line 9
            echo "        ";
            $this->loadTemplate("sections_sort_mode.twig", "list_sections.twig", 9)->display($context);
            // line 10
            echo "    ";
        } else {
            // line 11
            echo "        ";
            $this->loadTemplate("sections_view_mode.twig", "list_sections.twig", 11)->display($context);
            // line 12
            echo "    ";
        }
        // line 13
        echo "</div>

";
        // line 15
        $this->loadTemplate("@app/footer.twig", "list_sections.twig", 15)->display($context);
    }

    public function getTemplateName()
    {
        return "list_sections.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 15,  76 => 13,  73 => 12,  70 => 11,  67 => 10,  64 => 9,  62 => 8,  57 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_sections.twig", "/home/mliadov/public_html/application/modules/field_editor/views/gentelella/list_sections.twig");
    }
}
