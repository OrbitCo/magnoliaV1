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

/* helper_form_account.twig */
class __TwigTemplate_d548172386cdc7e25c6791a4539649d5e51a2038d9a84091ded3f5378798edd4 extends \Twig\Template
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
        echo "<form action=\"\" method=\"post\" class=\"form-horizontal\">
    <div class=\"form-group\">
        <label for=\"\" class=\"col-xs-12 tali\">
            ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("reg_subscriptions"        ,"subscriptions"        ,        );
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
        <div class=\"col-sm-6\">
            ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["subscriptions_list"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 8
            echo "                <input ";
            if ($this->getAttribute($context["item"], "subscribed", [])) {
                echo "checked";
            }
            echo " type=\"checkbox\" name=\"user_subscriptions_list[]\" value=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" id=\"sub";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                ";
            // line 9
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array($this->getAttribute(($context["item"] ?? null), "name_i", [])            ,"subscriptions"            ,            );
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
            // line 10
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "        </div>
    </div>
    <div class=\"form-group\">
        <div class=\"col-xs-12\">
            <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_subscriptions_save\" value=\"";
        // line 15
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
        echo "\">
        </div>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "helper_form_account.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 15,  102 => 11,  96 => 10,  75 => 9,  64 => 8,  60 => 7,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_form_account.twig", "/home/mliadov/public_html/application/modules/subscriptions/views/flatty/helper_form_account.twig");
    }
}
