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

/* helper_validity_periods.twig */
class __TwigTemplate_4db5a415668db5619347766db0dfa94667f164c169838db7ebb987111e8be7bf extends \Twig\Template
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
        echo "<h2>";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_validity_periods"        ,"access_permissions"        ,        );
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
        echo "</h2>
<div id=\"actions\">
    <div class=\"btn-group\">
        <a id=\"add-period\" onclick=\"";
        // line 4
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("access_permissions"        ,"btn_add_period"        ,        );
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
        echo "\" data-action=\"add-period\" class=\"btn btn-primary\" data-id=\"0\" ";
        if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
            echo "data-user_type=\"";
            echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
            echo "\"";
        }
        echo ">
            ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add"        ,"access_permissions"        ,        );
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
        // line 6
        echo "        </a>
    </div>
</div>
<div id=\"periods-list\">
    <table class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
            <tr class=\"headings\">
                <th class=\"column-title\">
                    <div>";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_period"        ,"access_permissions"        ,        );
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
                </th>
                ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 17
            echo "                    ";
            if ((($this->getAttribute($context["group"], "gid", []) != "default") && ($this->getAttribute($context["group"], "gid", []) != "trial"))) {
                // line 18
                echo "                    <th class=\"column-title\" data-group_actions=\"";
                echo $this->getAttribute($context["group"], "gid", []);
                echo "\">
                        <div data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
                // line 19
                echo $this->getAttribute($context["group"], "current_name", []);
                echo "\">
                            ";
                // line 20
                $module =                 null;
                $helper =                 'start';
                $name =                 'currency_format_output';
                $params = array(                );
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
                $context['currency'] = $result;
                // line 21
                echo "                            ";
                echo $this->getAttribute($context["group"], "current_name", []);
                echo "&nbsp;(";
                echo twig_replace_filter(($context["currency"] ?? null), [" " => ""]);
                echo ")
                        </div>
                    </th>
                    ";
            }
            // line 25
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "                <th></th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["periods"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["period"]) {
            // line 31
            echo "                <tr class=\"cursor-pointer\">
                    <td data-action=\"add-period\" data-id=\"";
            // line 32
            echo $this->getAttribute($context["period"], "id", []);
            echo "\" ";
            if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                echo " data-user_type=\"";
                echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                echo "\"";
            }
            echo ">";
            echo $this->getAttribute($context["period"], "period_str", []);
            echo "</td>
                    ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 34
                echo "                        ";
                if ((($this->getAttribute($context["group"], "gid", []) != "default") && ($this->getAttribute($context["group"], "gid", []) != "trial"))) {
                    // line 35
                    echo "                        <td data-action=\"add-period\" data-id=\"";
                    echo $this->getAttribute($context["period"], "id", []);
                    echo "\" ";
                    if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                        echo " data-user_type=\"";
                        echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                        echo "\"";
                    }
                    echo " data-group_actions=\"";
                    echo $this->getAttribute($context["group"], "gid", []);
                    echo "\">
                            ";
                    // line 36
                    if ($this->getAttribute($context["period"], ($this->getAttribute($context["group"], "gid", []) . "_group"), [], "array")) {
                        // line 37
                        echo "                                ";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'currency_format_output';
                        $params = array(["value" => $this->getAttribute(($context["period"] ?? null), ($this->getAttribute(($context["group"] ?? null), "gid", []) . "_group"), [], "array")]                        ,                        );
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
                        // line 38
                        echo "                            ";
                    } else {
                        // line 39
                        echo "                                ";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'currency_format_output';
                        $params = array(["value" => 0]                        ,                        );
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
                        // line 40
                        echo "                            ";
                    }
                    // line 41
                    echo "                        </td>
                        ";
                }
                // line 43
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "                    <td class=\"icons\">                   
                        <div class=\"btn-group\">
                            <a data-action=\"add-period\" class=\"btn btn-primary\"  data-id=\"";
            // line 46
            echo $this->getAttribute($context["period"], "id", []);
            echo "\" ";
            if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                echo " data-user_type=\"";
                echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                echo "\"";
            }
            echo ">
                                ";
            // line 47
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_edit"            ,"access_permissions"            ,            );
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
            // line 48
            echo "                            </a>
                            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                    aria-haspopup=\"true\" aria-expanded=\"false\">
                                <span class=\"caret\"></span>
                                <span class=\"sr-only\">Toggle Dropdown</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                                <li>
                                    <a data-action=\"add-period\" class=\"cursor-pointer\"  data-id=\"";
            // line 56
            echo $this->getAttribute($context["period"], "id", []);
            echo "\" ";
            if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                echo " data-user_type=\"";
                echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                echo "\"";
            }
            echo ">
                                        ";
            // line 57
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_edit"            ,"access_permissions"            ,            );
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
            // line 58
            echo "                                    </a>
                                </li>
                                <li>
                                    <a class=\"cursor-pointer\"  href=\"";
            // line 61
            echo ($context["site_url"] ?? null);
            echo "admin/access_permissions/periodDelete/";
            echo $this->getAttribute($context["period"], "id", []);
            echo "\">
                                        ";
            // line 62
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete"            ,"access_permissions"            ,            );
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
            // line 63
            echo "                                    </a>
                                </li>
                            </ul>
                        </div>                        
                    </td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['period'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "        </tbody>
    </table>
</div>";
    }

    public function getTemplateName()
    {
        return "helper_validity_periods.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  420 => 70,  408 => 63,  387 => 62,  381 => 61,  376 => 58,  355 => 57,  345 => 56,  335 => 48,  314 => 47,  304 => 46,  300 => 44,  294 => 43,  290 => 41,  287 => 40,  265 => 39,  262 => 38,  240 => 37,  238 => 36,  225 => 35,  222 => 34,  218 => 33,  206 => 32,  203 => 31,  199 => 30,  193 => 26,  187 => 25,  177 => 21,  156 => 20,  152 => 19,  147 => 18,  144 => 17,  140 => 16,  116 => 14,  106 => 6,  85 => 5,  56 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_validity_periods.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\access_permissions\\views\\gentelella\\helper_validity_periods.twig");
    }
}
