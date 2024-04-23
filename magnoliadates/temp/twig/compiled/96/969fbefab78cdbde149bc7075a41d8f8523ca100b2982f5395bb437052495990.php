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

/* helper_checkbox.twig */
class __TwigTemplate_8d008b33bf08e01dfa17c30fd7f659f8d0a4cdfcf1c7f0b3bc5b0fc2e8e3a35a extends \Twig\Template
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
        echo "<div class=\"checkBox\" id=\"";
        echo ($context["cb_id"] ?? null);
        echo "_cbox\" iname=\"";
        echo ($context["cb_input"] ?? null);
        echo "\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cb_value"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 3
            echo "        <div class=\"input\">
            <div class=\"box far fa-";
            // line 4
            if ($this->getAttribute($context["item"], "checked", [])) {
                echo "check-";
            }
            echo "square ";
            if ($this->getAttribute($context["item"], "checked", [])) {
                echo "checked";
            }
            echo "\" gid=\"";
            echo $context["key"];
            echo "\"></div>
            <div class=\"label\" gid=\"";
            // line 5
            echo $context["key"];
            echo "\">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</div>
            ";
            // line 6
            if ($this->getAttribute($context["item"], "checked", [])) {
                // line 7
                echo "                <input type=\"hidden\" name=\"";
                echo ($context["cb_input"] ?? null);
                if ((($context["cb_count"] ?? null) > 1)) {
                    echo "[]";
                }
                echo "\" value=\"";
                echo $context["key"];
                echo "\" />
            ";
            }
            // line 9
            echo "        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    ";
        if (($context["cb_display_group_methods"] ?? null)) {
            // line 12
            echo "        <div class=\"clr\"></div>
        <span id=\"";
            // line 13
            echo ($context["cb_id"] ?? null);
            echo "_cbox_check_all\" class=\"a\" onclick=\"\$(this).parent().find('input[type=checkbox]').prop('checked', true);\">
            ";
            // line 14
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
            // line 15
            echo "        </span>
        &nbsp;|&nbsp;
        <span id=\"";
            // line 17
            echo ($context["cb_id"] ?? null);
            echo "_cbox_uncheck_all\" class=\"a\" onclick=\"\$(this).parent().find('input[type=checkbox]').prop('checked', false);\">
            ";
            // line 18
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
            // line 19
            echo "        </span>
    ";
        }
        // line 21
        echo "</div>
<script>
    checkboxes.push('";
        // line 23
        echo ($context["cb_id"] ?? null);
        echo "');
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_checkbox.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 23,  146 => 21,  142 => 19,  121 => 18,  117 => 17,  113 => 15,  92 => 14,  88 => 13,  85 => 12,  82 => 11,  75 => 9,  64 => 7,  62 => 6,  56 => 5,  44 => 4,  41 => 3,  37 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_checkbox.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/helper_checkbox.twig");
    }
}
