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

/* add_funds.twig */
class __TwigTemplate_43bfa0aa0510f075d60947523d98630e59ff99df1e09b3c1cc728901dcace3db extends \Twig\Template
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
        echo "<div id=\"add-funds-block\">
    <form action=\"";
        // line 2
        echo ($context["site_url"] ?? null);
        echo "users_payments/save_payment\" method=\"post\" name=\"save_payment\" id=\"save_payment-form\">
        <h1>";
        // line 3
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
        echo "</h1>
        <div class=\"col-xs-12 col-md-8 col-sm-8 col-lg-8 mtb20\" id=\"user-pay-data\">
           <input id=\"add-funds\" type=\"number\" value=\"";
        // line 5
        echo $this->getAttribute(($context["payment_data"] ?? null), "price", []);
        echo "\"
                  min=\"0\" name=\"amount\" pattern=\"\\d+(\\.\\d{2})?\"
                  placeholder=\"";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_funds_placeholder"        ,"users_payments"        ,        );
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
        echo "\"
                  class=\"form-control\" autofocus=\"true\" rel=\"tooltip\" title=\"";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("add_funds_tooltip"        ,"users_payments"        ,        );
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
           <span>
               ";
        // line 10
        if ($this->getAttribute($this->getAttribute(($context["payment_data"] ?? null), "use_system", []), "gid", [])) {
            // line 11
            echo "                    <img src=\"";
            echo $this->getAttribute($this->getAttribute(($context["payment_data"] ?? null), "use_system", []), "logo_url", []);
            echo "\" class=\"h50 img-rounded\">
                    <input id=\"use-system_gid\" type=\"hidden\" value=\"";
            // line 12
            echo $this->getAttribute($this->getAttribute(($context["payment_data"] ?? null), "use_system", []), "gid", []);
            echo "\" name=\"system_gid\">
               ";
        } else {
            // line 14
            echo "                   <img src=\"";
            echo $this->getAttribute($this->getAttribute(($context["billing_systems"] ?? null), 0, []), "logo_url", []);
            echo "\" class=\"h50 img-rounded\">
                    <input id=\"use-system_gid\" type=\"hidden\" value=\"";
            // line 15
            echo $this->getAttribute($this->getAttribute(($context["billing_systems"] ?? null), 0, []), "gid", []);
            echo "\" name=\"system_gid\">
               ";
        }
        // line 17
        echo "           </span>
        </div>
        <div class=\"col-xs-12 b-billing-systems\">
            ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["system"]) {
            // line 21
            echo "                <div class=\"col-xs-4 com-sm-4 col-md-3 col-lg-3 b-billing-systems__item pointer\">
                    <a data-action=\"update-payment-system\"
                       data-img=\"";
            // line 23
            echo $this->getAttribute($context["system"], "logo_url", []);
            echo "\"
                       data-gid=\"";
            // line 24
            echo $this->getAttribute($context["system"], "gid", []);
            echo "\"
                       data-is_card=\"";
            // line 25
            echo $this->getAttribute($context["system"], "is_card", []);
            echo "\"
                       class=\"b-billing-systems__link ";
            // line 26
            if (($this->getAttribute($this->getAttribute(($context["payment_data"] ?? null), "use_system", []), "gid", []) == $this->getAttribute($context["system"], "gid", []))) {
                echo " active ";
            } elseif ((($this->getAttribute($this->getAttribute(($context["billing_systems"] ?? null), 0, []), "gid", []) == $this->getAttribute($context["system"], "gid", [])) && ($this->getAttribute($this->getAttribute(($context["payment_data"] ?? null), "use_system", []), "gid", []) == ""))) {
                echo " active ";
            }
            echo "\">
                        <img src=\"";
            // line 27
            echo $this->getAttribute($context["system"], "logo_url", []);
            echo "\" class=\"img-responsive\">
                        <span class=\"pay_sys-name\">";
            // line 28
            echo $this->getAttribute($context["system"], "name", []);
            echo "</span>
                    </a>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['system'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "        </div>
        <div class=\"col-xs-12\">
            <div class=\"hide\" id=\"card_form\">";
        // line 34
        $module =         null;
        $helper =         'payments';
        $name =         'cardForm';
        $params = array(        );
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
        </div>
        <div class=\"col-xs-12\">
            <button type=\"button\" class=\"btn btn-primary\" data-action=\"add-payment\" name=\"btn_payment_save\" disabled=\"true\">
                ";
        // line 38
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
        // line 39
        echo "            </button>
            <a class=\"btn btn-close\" data-action=\"close\">";
        // line 40
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_close"        ,"start"        ,        );
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
        echo "</a>
        </div>
        <div class=\"clearfix\"></div>
    </form>
    <script>
        \$(function () {
            \$('#add-funds').tooltip();

            loadScripts(
                [\"";
        // line 49
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
        return "add_funds.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  267 => 49,  236 => 40,  233 => 39,  212 => 38,  186 => 34,  182 => 32,  172 => 28,  168 => 27,  160 => 26,  156 => 25,  152 => 24,  148 => 23,  144 => 21,  140 => 20,  135 => 17,  130 => 15,  125 => 14,  120 => 12,  115 => 11,  113 => 10,  89 => 8,  66 => 7,  61 => 5,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "add_funds.twig", "/home/mliadov/public_html/application/modules/users_payments/views/flatty/add_funds.twig");
    }
}
