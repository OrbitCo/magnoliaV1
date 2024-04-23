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

/* helper_top_menu_icons.twig */
class __TwigTemplate_e3c7466f343d683823bf87e9f375b68e3abd13aa7747c42cd7fa8ecde8e62f53 extends \Twig\Template
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
        echo "<menu id=\"users-alerts-menu\" class=\"menu-alerts\">
    ";
        // line 2
        if ((($context["auth_type"] ?? null) == "user")) {
            // line 3
            echo "        ";
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("tickets"            ,            );
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
            // line 4
            echo "        ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "tickets", [])) {
                // line 5
                echo "            <div class=\"menu-alerts-item  menu-item-icon  menu-item\" id=\"menu_admin_alerts\"  data-toggle=\"tooltip\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_alert_menu_new_alerts"                ,"menu"                ,                );
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
                echo "\" data-placement=\"bottom\">
                <a id=\"menu-messages-more\" href=\"\" class=\"uam-top menu-messages-more\"
                   data-target=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" role=\"button\"
                   aria-expanded=\"false\" data-pjax=\"0\">
                    <i class=\"fa fa-bell fa-lg item\"></i>
                    <span class=\"badge sum\"></span>
                </a>
                <div class=\"menu-alerts-more dropdown-menu\" role=\"menu\" aria-labelledby=\"menu-messages-more\">
                    <div class=\"menu-alerts-more-triangle\"></div>
                    ";
                // line 14
                $module =                 null;
                $helper =                 'tickets';
                $name =                 'admin_new_messages';
                $params = array(["template" => "header", "is_admin" => "1"]                ,                );
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
                echo "                    ";
                $module =                 null;
                $helper =                 'virtual_gifts';
                $name =                 'user_gifts_menu_notifier';
                $params = array($this->getAttribute(($context["user_session_data"] ?? null), "user_id", [])                ,                );
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
                // line 16
                echo "                </div>
            </div>
        ";
            }
            // line 19
            echo "
        <div class=\"menu-account-item  menu-item-icon menu-item\" id=\"menu_users_alerts_top\">
            <a id=\"menu-account-more\" href=\"\" class=\"uam-top menu-account-more\"
               data-target=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" role=\"button\"
               aria-expanded=\"false\" data-pjax=\"0\" data-type=\"account-more\">
                <i class=\"far fa-gem fa-lg item\"></i>
                <span class=\"badge sum\"></span>
            </a>
            <div class=\"menu-alerts-more dropdown-menu\" role=\"menu\" aria-labelledby=\"menu-alerts-more\">
                <div class=\"menu-alerts-more-triangle\"></div>
                <div class=\"header-settings_menu\">
                    ";
            // line 30
            $module =             null;
            $helper =             'users';
            $name =             'shortInformation';
            $params = array(            );
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
            // line 31
            echo "                </div>
                <div class=\"actions-settings_menu center\">
                    ";
            // line 33
            $module =             null;
            $helper =             'users';
            $name =             'actionsSettings';
            $params = array(            );
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
            // line 34
            echo "                </div>
            </div>
        </div>
    ";
        }
        // line 38
        echo "</menu>
<script type=\"text/javascript\">
\$(function () {
    loadScripts(
            \"";
        // line 42
        $module =         null;
        $helper =         'theme';
        $name =         'include_js';
        $params = array("users"        ,"top-menu.js"        ,"path"        ,        );
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
        echo "\",
            function () {
                top_menu = new topMenu({
                    siteUrl: site_url,
                    parent: '.menu-alerts-item',
                    summandsParent: '.menu-alerts-more-item'
                });
            },
            ['top_menu'],
            {async: false}
    );
    \$('#menu_users_alerts_top .menu-alerts-more').off().on('click', function() {
        ";
        // line 54
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("h"        ,"notify_people"        ,        );
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
        // line 55
        echo "    });
});
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_top_menu_icons.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 55,  245 => 54,  211 => 42,  205 => 38,  199 => 34,  178 => 33,  174 => 31,  153 => 30,  140 => 19,  135 => 16,  113 => 15,  92 => 14,  60 => 5,  57 => 4,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_top_menu_icons.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_top_menu_icons.twig");
    }
}
