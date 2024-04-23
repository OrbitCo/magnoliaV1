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

/* user_information/main.twig */
class __TwigTemplate_51f88bcc5fdc2dccb58de972d2299a06cce3e48a3e1da3d90a35a1ec25d0454e extends \Twig\Template
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
        echo "<div class=\"content-page\">
    <div class=\"ui-title\">";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_main"        ,"virtual_gifts"        ,        );
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
        echo "</div>
    <div>
        ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_usr_inf_description"        ,"virtual_gifts"        ,        );
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
        echo "    </div>
    ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pages"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["link"] => $context["name"]) {
            // line 7
            echo "        <div><a href=\"";
            echo $context["link"];
            echo "\">";
            echo $context["name"];
            echo "</a></div>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 9
            echo "        ";
            if (($context["is_not_archive"] ?? null)) {
                // line 10
                echo "            <input type=\"checkbox\" name=\"ui_virtual_gifts\" data-module=\"virtual_gifts\" value=\"1\" class=\"ui_checkbox\" data-action=\"ui_change\" checked>
        ";
            } else {
                // line 12
                echo "            <div><i>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("list_empty"                ,"virtual_gifts"                ,                );
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
                echo "</i></div>
        ";
            }
            // line 14
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['link'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "user_information/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 15,  128 => 14,  103 => 12,  99 => 10,  96 => 9,  86 => 7,  81 => 6,  78 => 5,  57 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "user_information/main.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/flatty/user_information/main.twig");
    }
}
