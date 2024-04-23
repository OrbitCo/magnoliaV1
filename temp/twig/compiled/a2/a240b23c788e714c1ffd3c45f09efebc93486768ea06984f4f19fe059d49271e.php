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

/* helper_subscription_type.twig */
class __TwigTemplate_3ce92cebceec3f2f1c37b93ee5cae58808d7a30ac7a19a6817a6b97c43256aaa extends \Twig\Template
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
        $params = array("field_subscription_type"        ,"access_permissions"        ,        );
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
        <a id=\"add-subscription-type\" data-action=\"add\" onclick=\"";
        // line 4
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("access_permissions"        ,"btn_add_group"        ,        );
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
        echo "\" class=\"btn btn-primary\" data-id=\"0\" ";
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
<div id=\"s-types-list\">
    <table class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
            <tr class=\"headings\">
                <th class=\"column-title\">
                    ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_title"        ,"access_permissions"        ,        );
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
        echo "                </th>
                <th class=\"column-title\">
                    ";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_status"        ,"access_permissions"        ,        );
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
        // line 18
        echo "                </th>
                <th class=\"column-title text-right\">
                    ";
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_action"        ,"access_permissions"        ,        );
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
        // line 21
        echo "                </th>                
            </tr>
        </thead>
        <tbody>
            ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 26
            echo "                <tr>
                    <td>";
            // line 27
            echo $this->getAttribute($context["group"], "current_name", []);
            echo "</td>
                    <td class=\"icons\">
                        ";
            // line 29
            if ( !$this->getAttribute($context["group"], "is_default", [])) {
                // line 30
                echo "                        <div class=\"checkbox\" data-action=\"status\" data-id=\"";
                echo $this->getAttribute($context["group"], "id", []);
                echo "\" data-gid=\"";
                echo $this->getAttribute($context["group"], "gid", []);
                echo "\">
                            <input type=\"checkbox\" name=\"subscriptions[";
                // line 31
                echo $this->getAttribute($context["group"], "gid", []);
                echo "]\" ";
                if ($this->getAttribute($context["group"], "is_active", [])) {
                    echo "checked";
                }
                echo " class=\"flat subscription-js\">
                        </div>
                        ";
            }
            // line 34
            echo "                    </td>
                    <td class=\"icons\">
                        <div class=\"btn-group\">
                            <a data-action=\"edit\" class=\"btn btn-primary\"  data-id=\"";
            // line 37
            echo $this->getAttribute($context["group"], "id", []);
            echo "\"  ";
            if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                echo "data-user_type=\"";
                echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                echo "\"";
            }
            echo " data-gid=\"";
            echo $this->getAttribute($context["group"], "gid", []);
            echo "\">
                                ";
            // line 38
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
            // line 39
            echo "                            </a>
                            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                    aria-haspopup=\"true\" aria-expanded=\"false\">
                                <span class=\"caret\"></span>
                                <span class=\"sr-only\">Toggle Dropdown</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                                <li>
                                    <a class=\"cursor-pointer\" ";
            // line 47
            if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                echo "data-user_type=\"";
                echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                echo "\"";
            }
            echo " data-action=\"edit\" data-id=\"";
            echo $this->getAttribute($context["group"], "id", []);
            echo "\" data-gid=\"";
            echo $this->getAttribute($context["group"], "gid", []);
            echo "\">
                                        ";
            // line 48
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
            // line 49
            echo "                                    </a>
                                </li>
                                ";
            // line 51
            if ( !$this->getAttribute($context["group"], "is_default", [])) {
                // line 52
                echo "                                    <li>
                                        <a class=\"cursor-pointer\" ";
                // line 53
                if ($this->getAttribute(($context["role_data"] ?? null), "type", [])) {
                    echo "data-user_type=\"";
                    echo $this->getAttribute(($context["role_data"] ?? null), "type", []);
                    echo "\"";
                }
                echo " data-action=\"delete\" data-id=\"";
                echo $this->getAttribute($context["group"], "id", []);
                echo "\" data-gid=\"";
                echo $this->getAttribute($context["group"], "gid", []);
                echo "\">
                                            ";
                // line 54
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_delete"                ,"access_permissions"                ,                );
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
                echo "                                        </a>
                                    </li>
                                ";
            }
            // line 58
            echo "                            </ul>
                        </div>
                    </td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "        </tbody>
    </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "helper_subscription_type.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  362 => 63,  352 => 58,  347 => 55,  326 => 54,  314 => 53,  311 => 52,  309 => 51,  305 => 49,  284 => 48,  272 => 47,  262 => 39,  241 => 38,  229 => 37,  224 => 34,  214 => 31,  207 => 30,  205 => 29,  200 => 27,  197 => 26,  193 => 25,  187 => 21,  166 => 20,  162 => 18,  141 => 17,  137 => 15,  116 => 14,  106 => 6,  85 => 5,  56 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_subscription_type.twig", "/home/mliadov/public_html/application/modules/access_permissions/views/gentelella/helper_subscription_type.twig");
    }
}
