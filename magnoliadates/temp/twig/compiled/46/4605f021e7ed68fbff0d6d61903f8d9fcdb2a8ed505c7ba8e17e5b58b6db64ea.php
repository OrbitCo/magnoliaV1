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

/* helper_services_button.twig */
class __TwigTemplate_d975eebcd02f727089b2268443ea96bd655ef5e57fb743299bc2a665fffe55a6 extends \Twig\Template
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
        echo "<div class=\"services-owner-menu ";
        if (($this->getAttribute(($context["ervices_data"] ?? null), "count_services", []) != 1)) {
            echo "short";
        } else {
            echo "long";
        }
        echo "\">
    ";
        // line 2
        $module =         null;
        $helper =         'access_permissions';
        $name =         'getUserGroupInfo';
        $params = array(["id_user" => $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []), "is_default_excluded" => 1]        ,        );
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
        $context['user_group'] = $result;
        echo "    
    ";
        // line 3
        if (($this->getAttribute(($context["services_data"] ?? null), "is_long", []) && ($this->getAttribute(($context["services_data"] ?? null), "count_services", []) > 0))) {
            // line 4
            echo "        <span class=\"col-xs-10 col-sm-9\">
            <a class=\"btn btn-primary btn-block\" href=\"";
            // line 5
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("access_permissions"            ,"index"            ,            );
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
                <i class=\"fa fa-rocket\"></i>

                ";
            // line 8
            if ((twig_length_filter($this->env, $this->getAttribute(($context["user_group"] ?? null), "left_str", [])) > 0)) {
                // line 9
                echo "                    ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_prolong_membership"                ,"access_permissions"                ,                );
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
                echo "                ";
            } else {
                // line 11
                echo "                    ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_get_premium"                ,"users"                ,                );
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
                // line 12
                echo "                ";
            }
            // line 13
            echo "            </a>
        </span>
        <span class=\"col-xs-2 col-sm-3\">
            <button id=\"services-menu\" type=\"button\" class=\"btn btn-default btn-block\" onclick=\"sendAnalytics('dp_user_view_profile_btn_services_menu', 'user_profile', 'btn_services_menu');\" >
                <i class=\"fa fa-ellipsis-h\"></i>
            </button>
        </span>
     ";
        } elseif (($this->getAttribute(        // line 20
($context["services_data"] ?? null), "is_long", []) && ($this->getAttribute(($context["services_data"] ?? null), "count_services", []) == 0))) {
            // line 21
            echo "        <a class=\"btn btn-primary btn-block\" href=\"";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("access_permissions"            ,"index"            ,            );
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
            <i class=\"fa fa-rocket\"></i>
            ";
            // line 23
            if ((twig_length_filter($this->env, $this->getAttribute(($context["user_group"] ?? null), "left_str", [])) > 0)) {
                // line 24
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_prolong_membership"                ,"access_permissions"                ,                );
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
                // line 25
                echo "            ";
            } else {
                // line 26
                echo "                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_get_premium"                ,"users"                ,                );
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
                // line 27
                echo "            ";
            }
            // line 28
            echo "        </a>
    ";
        } elseif (($this->getAttribute(        // line 29
($context["services_data"] ?? null), "count_services", []) > 1)) {
            // line 30
            echo "        <span class=\"col-xs-10 col-sm-9\">
            <a class=\"btn btn-primary btn-block\" onclick=\"";
            // line 31
            echo $this->getAttribute($this->getAttribute(($context["services_data"] ?? null), "current_service", []), "gid", []);
            echo "_available_view.check_available();\">
                ";
            // line 32
            echo $this->getAttribute($this->getAttribute(($context["services_data"] ?? null), "current_service", []), "name", []);
            echo "
            </a>
        </span>
        <span class=\"col-xs-2 col-sm-3\">
            <button id=\"services-menu\" type=\"button\" class=\"btn btn-default btn-block\" onclick=\"sendAnalytics('dp_user_view_profile_btn_services_menu', 'user_profile', 'btn_services_menu');\" data-toggle=\"popover\">
                <i class=\"fa fa-ellipsis-h\"></i>
            </button>
        </span>
    ";
        } elseif (($this->getAttribute(        // line 40
($context["services_data"] ?? null), "count_services", []) == 1)) {
            // line 41
            echo "        <button type=\"button\" class=\"btn btn-primary btn-block\" onclick=\"";
            echo $this->getAttribute($this->getAttribute(($context["services_data"] ?? null), "current_service", []), "gid", []);
            echo "_available_view.check_available();\">
            ";
            // line 42
            echo $this->getAttribute($this->getAttribute(($context["services_data"] ?? null), "current_service", []), "name", []);
            echo "
        </button>
    ";
        }
        // line 45
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "helper_services_button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  268 => 45,  262 => 42,  257 => 41,  255 => 40,  244 => 32,  240 => 31,  237 => 30,  235 => 29,  232 => 28,  229 => 27,  207 => 26,  204 => 25,  182 => 24,  180 => 23,  155 => 21,  153 => 20,  144 => 13,  141 => 12,  119 => 11,  116 => 10,  94 => 9,  92 => 8,  67 => 5,  64 => 4,  62 => 3,  39 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_services_button.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_services_button.twig");
    }
}
