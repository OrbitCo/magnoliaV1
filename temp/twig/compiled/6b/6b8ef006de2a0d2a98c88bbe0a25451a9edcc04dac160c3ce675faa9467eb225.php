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

/* helper_product_version.twig */
class __TwigTemplate_b4d2d3f14edb91b7ba9a6959891a0a519e6e2951a0cf3804e2bacdd7f63b5285 extends \Twig\Template
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
        echo "<span class=\"product-version-block\">
    ";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("system_version"        ,"start"        ,        );
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
    <span>
        ";
        // line 11
        echo "        ";
        echo $this->getAttribute(($context["update_data"] ?? null), "current_version_name", []);
        echo "
    </span> ";
        // line 12
        echo twig_capitalize_string_filter($this->env, $this->getAttribute(($context["update_data"] ?? null), "package", []));
        echo "
</span>

";
    }

    public function getTemplateName()
    {
        return "helper_product_version.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 12,  57 => 11,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_product_version.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\gentelella\\helper_product_version.twig");
    }
}
