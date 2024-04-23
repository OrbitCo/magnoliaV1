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

/* change_location_form.twig */
class __TwigTemplate_a33e1b69523f4a2677c57e3bbafb47500fa953b4a1be64a1b23fa2f798b624c7 extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    <div class=\"form-group clearfix\">
        <label for=\"\" class=\"col-xs-12 tali\">
            ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_region"        ,"users"        ,        );
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
        echo ":
        </label>
        <div class=\"col-xs-12\" id=\"change-location-block\">
        ";
        // line 7
        $module =         null;
        $helper =         'countries';
        $name =         'location_select';
        $params = array(["module" => "countries", "select_type" => "city", "id_country" => $this->getAttribute(        // line 10
($context["user"] ?? null), "id_country", []), "id_region" => $this->getAttribute(        // line 11
($context["user"] ?? null), "id_region", []), "id_city" => $this->getAttribute(        // line 12
($context["user"] ?? null), "id_city", []), "is_change_location" => 1]        ,        );
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
        // line 15
        echo "        </div>
        <div class=\"col-xs-12 mt10\">
            <button id=\"save-location-block\" class=\"btn btn-primary\">";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
        echo "</button>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "change_location_form.twig";
    }

    public function getDebugInfo()
    {
        return array (  88 => 17,  84 => 15,  66 => 12,  65 => 11,  64 => 10,  60 => 7,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "change_location_form.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/change_location_form.twig");
    }
}
