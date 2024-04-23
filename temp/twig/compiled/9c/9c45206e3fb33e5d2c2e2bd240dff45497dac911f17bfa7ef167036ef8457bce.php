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

/* helper_user_name.twig */
class __TwigTemplate_6a126be937708234242c0695cb8f9390a3aa78719a4a61d205eeb14385e5e208 extends \Twig\Template
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
        if (twig_test_empty($this->getAttribute(($context["data_name"] ?? null), "format", []))) {
            // line 2
            echo "    ";
            if ($this->getAttribute(($context["data_name"] ?? null), "is_link", [])) {
                // line 3
                echo "        <a class=\"g-users-gallery__name\" href=\"";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,$this->getAttribute(($context["data_name"] ?? null), "user", [])                ,                );
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
                echo "\">";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "output_name", []);
                echo "</a>            
    ";
            } else {
                // line 5
                echo "        ";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "output_name", []);
                echo "
    ";
            }
        } elseif (($this->getAttribute(        // line 7
($context["data_name"] ?? null), "format", []) == "age")) {
            // line 8
            echo "    ";
            if ($this->getAttribute(($context["data_name"] ?? null), "is_link", [])) {
                // line 9
                echo "        <a class=\"g-users-gallery__name\" href=\"";
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("users"                ,"view"                ,$this->getAttribute(($context["data_name"] ?? null), "user", [])                ,                );
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
                echo "\">";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "output_name", []);
                echo "</a>, ";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "age", []);
                echo "
    ";
            } else {
                // line 11
                echo "        ";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "output_name", []);
                echo ", ";
                echo $this->getAttribute($this->getAttribute(($context["data_name"] ?? null), "user", []), "age", []);
                echo "
     ";
            }
        }
        // line 14
        echo "    ";
    }

    public function getTemplateName()
    {
        return "helper_user_name.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 14,  102 => 11,  73 => 9,  70 => 8,  68 => 7,  62 => 5,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_user_name.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\helper_user_name.twig");
    }
}
