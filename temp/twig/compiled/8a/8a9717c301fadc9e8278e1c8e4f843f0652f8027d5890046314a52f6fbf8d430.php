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

/* deficit_funds.twig */
class __TwigTemplate_17f8a859d61ffa5b9c1d16f59559326b75e5b32632a434a79547f0a2eb3210b4 extends \Twig\Template
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
        echo "<div id=\"deficit-funds\">
    <h1>";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_funds"        ,"users_payments"        ,        );
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
        echo "?</h1>
    <div class=\"mtb20\"> ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_account_less_then_service_price"        ,"services"        ,        );
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
        echo " ";
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array(["value" => $this->getAttribute(($context["payment_data"] ?? null), "deficit", [])]        ,        );
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
    ";
        // line 24
        echo "    <div class=\"col-xs-12 b-billing-systems\">
        ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["system"]) {
            // line 26
            echo "            <div class=\"col-xs-4 com-sm-4 col-md-3 col-lg-3 b-billing-systems__item pointer\">
                <a data-action=\"set-payment-system\"   data-gid=\"";
            // line 27
            echo $this->getAttribute($context["system"], "gid", []);
            echo "\" data-price=\"";
            echo $this->getAttribute(($context["payment_data"] ?? null), "deficit", []);
            echo "\"  class=\"b-billing-systems__link\">
                    <img src=\"";
            // line 28
            echo $this->getAttribute($context["system"], "logo_url", []);
            echo "\" class=\"img-responsive\">
                    <span class=\"pay_sys-name\">";
            // line 29
            echo $this->getAttribute($context["system"], "name", []);
            echo "</span>
                </a>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['system'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "    </div>
    <div class=\"clearfix\"></div>
    <script>
        \$(function() {
            loadScripts(
                [\"";
        // line 38
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("users_payments"        ,"UsersPayments.js"        ,"path"        ,        );
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
        echo "\"],
                function () {
                    users_payments = new UsersPayments({
                        siteUrl: site_url
                    });
                },
                ['users_payments'],
                {async: true}
            );
        });
    </script>
</div>
";
    }

    public function getTemplateName()
    {
        return "deficit_funds.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 38,  130 => 33,  120 => 29,  116 => 28,  110 => 27,  107 => 26,  103 => 25,  100 => 24,  56 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "deficit_funds.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users_payments\\views\\flatty\\deficit_funds.twig");
    }
}
