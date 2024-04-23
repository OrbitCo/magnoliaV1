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

/* helper_selectbox.twig */
class __TwigTemplate_dfce731efb65dee1894f3d62aab2a3f05c34b7d939c50b7a30be425b895fd00c extends \Twig\Template
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
        echo "<select class=\"form-control\" name=\"";
        echo ($context["sb_input"] ?? null);
        if (($context["sb_is_multiple"] ?? null)) {
            echo "[]";
        }
        echo "\" id=\"";
        echo ($context["sb_id"] ?? null);
        echo "\" ";
        if (($context["sb_is_multiple"] ?? null)) {
            echo "multiple";
        }
        echo ">
    ";
        // line 2
        if (($context["sb_default"] ?? null)) {
            // line 3
            echo "        <option value=\"0\">";
            echo ($context["sb_default"] ?? null);
            echo "</option>
    ";
        }
        // line 5
        echo "
    ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sb_value"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 7
            echo "        ";
            if (($context["sb_is_multiple"] ?? null)) {
                // line 8
                echo "            <option value=\"";
                echo $context["key"];
                echo "\" ";
                if (twig_in_filter($context["key"], ($context["sb_selected"] ?? null))) {
                    echo "selected";
                }
                echo ">";
                echo $context["item"];
                echo "</option>
        ";
            } else {
                // line 10
                echo "            <option value=\"";
                echo $context["key"];
                echo "\" ";
                if ((($context["sb_selected"] ?? null) == $context["key"])) {
                    echo "selected";
                }
                echo ">";
                echo $context["item"];
                echo "</option>
        ";
            }
            // line 12
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "</select>
";
        // line 14
        if (($context["sb_is_multiple"] ?? null)) {
            // line 15
            echo "    <span class=\"a\" onclick=\"\$(this).parent().find('option').prop('selected', true);\">
        ";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("select_all"            ,"start"            ,            );
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
            // line 17
            echo "    </span>

    &nbsp;|&nbsp;

    <span class=\"a\" onclick=\"\$(this).parent().find('option').prop('selected', false);\">
        ";
            // line 22
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("unselect_all"            ,"start"            ,            );
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
            // line 23
            echo "    </span>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_selectbox.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 23,  128 => 22,  121 => 17,  100 => 16,  97 => 15,  95 => 14,  92 => 13,  86 => 12,  74 => 10,  62 => 8,  59 => 7,  55 => 6,  52 => 5,  46 => 3,  44 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_selectbox.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_selectbox.twig");
    }
}
