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

/* account_menu.twig */
class __TwigTemplate_619e7e579c252d9f523dc446abdc52ff42b4ca6e42b61ef47b4c007cef5ae1a3 extends \Twig\Template
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
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("banners"        ,"access_permissions"        ,"users_payments"        ,"payments"        ,"send_money"        ,"send_vip"        ,        );
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
        $context['is_module_installed'] = $result;
        // line 7
        echo "<div class=\"services-list-block__tabs\">
    <ul class=\"b-tabs\">
        <li id=\"all_services_tab\" class=\"b-tabs__item\" onclick=\"changeServicesTab('all_services');\"><span class=\"b-tabs__text\">";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_services"        ,"users"        ,        );
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
        echo "</span></li>
        ";
        // line 10
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "banners", [])) {
            // line 11
            echo "            <li id=\"banners_tab\" class=\"b-tabs__item\" onclick=\"changeServicesTab('banners');\"><span class=\"b-tabs__text\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_my_banners"            ,"banners"            ,            );
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
            echo "</span></li>
        ";
        }
        // line 13
        echo "        ";
        if (($this->getAttribute(($context["is_module_installed"] ?? null), "send_money", []) || $this->getAttribute(($context["is_module_installed"] ?? null), "send_vip", []))) {
            // line 14
            echo "            ";
            // line 15
            echo "            <li id=\"donate_tab\" class=\"b-tabs__item\" onclick=\"changeServicesTab('donate');\"><span class=\"b-tabs__text\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("donate"            ,"start"            ,            );
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
            echo "</span></li>
        ";
        }
        // line 17
        echo "    </ul>
</div>
<script>
    \$( document ).ready(function() {
        var action = '";
        // line 21
        echo ($context["action"] ?? null);
        echo "';
        if (action == 'services') {
            action = 'all_services';
        }
        changeServicesTab(action);
    });

    function changeServicesTab(tab) {
        \$('.b-tabs__item').removeClass('active');
        \$('.b-tabs__block').hide();
        \$('#' + tab + '_tab').addClass('active');
        \$('#' + tab).show();
    }

    \$('.expander').on('click', function () {
        var target = \$(this).parents('.expandable').find('.toggle');
        var icon = \$(this).find('.icon');
        if (target.is(':hidden')) {
            icon.removeClass('down');
            icon.addClass('up');
            target.slideDown();
        } else {
            icon.removeClass('up');
            icon.addClass('down');
            target.slideUp();
        }
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "account_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 21,  135 => 17,  110 => 15,  108 => 14,  105 => 13,  80 => 11,  78 => 10,  55 => 9,  51 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "account_menu.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/account_menu.twig");
    }
}
