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

/* list.twig */
class __TwigTemplate_90c56f425b63f47fe52d1944cf4234dc145ec803a6e9860e9aaca49fe308d051 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display(twig_array_merge($context, ["load_type" => "ui"]));
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 7
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_countries_menu"        ,        );
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
        // line 8
        echo "            </ul>
        </div>

        ";
        // line 11
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("countries"        ,"admin-location-sorter.js"        ,        );
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
        // line 12
        echo "        <script>
            var sorter;
            \$(function () {
                sorter = new sortLocations({
                    siteUrl: '";
        // line 16
        echo ($context["site_url"] ?? null);
        echo "',
                    urlSaveSort: 'admin/countries/ajax_save_country_sorter'
                });
            });
        </script>
        <div class=\"x_content\">
            ";
        // line 22
        if (($context["sort_mode"] ?? null)) {
            // line 23
            echo "                ";
            $this->loadTemplate("countries_sort_mode.twig", "list.twig", 23)->display($context);
            // line 24
            echo "            ";
        } else {
            // line 25
            echo "                ";
            $this->loadTemplate("countries_view_mode.twig", "list.twig", 25)->display($context);
            // line 26
            echo "            ";
        }
        // line 27
        echo "        </div>
    </div>
</div>

";
        // line 31
        $this->loadTemplate("@app/footer.twig", "list.twig", 31)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 31,  115 => 27,  112 => 26,  109 => 25,  106 => 24,  103 => 23,  101 => 22,  92 => 16,  86 => 12,  65 => 11,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/countries/views/gentelella/list.twig");
    }
}
