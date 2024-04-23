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

/* wall_permissions.twig */
class __TwigTemplate_7de4b79c4d716b44720085b3bffa09831cf45cffee63a7fab3c4fdda2ccf30b8 extends \Twig\Template
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
        $params = array("friendlist"        ,        );
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
        // line 2
        echo "<div class=\"content-block load_content\">
\t<h1>
        ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_wall_settings"        ,"wall_events"        ,        );
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
        echo "&nbsp;
    </h1>
    ";
        // line 6
        if (($context["user_perm"] ?? null)) {
            // line 7
            echo "        <div class=\"inside wall-perm-form \">
            <form action=\"";
            // line 8
            echo ($context["site_url"] ?? null);
            echo "wall_events/save_user_permissions\" method=\"post\">
                    <input type=\"hidden\" value=\"";
            // line 9
            echo ($context["redirect_url"] ?? null);
            echo "\" name=\"redirect_url\" />
                <div class=\"col-xs-12 no-padding-left\">
                    ";
            // line 11
            if ($this->getAttribute(($context["user_perm"] ?? null), "wall_post", [])) {
                // line 12
                echo "                            <div>
                                    <input type=\"hidden\" name=\"perm[wall_post][post_allow]\" value=\"0\" />
                                    <label>
                                            &nbsp;<input type=\"checkbox\" name=\"perm[wall_post][post_allow]\" value=\"1\" ";
                // line 15
                if ($this->getAttribute($this->getAttribute(($context["user_perm"] ?? null), "wall_post", []), "post_allow", [])) {
                    echo "checked";
                }
                echo " />&nbsp;";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("post_allow"                ,"wall_events"                ,                );
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
                echo "                                    </label>
                            </div>
                    ";
            }
            // line 19
            echo "                </div>
                <div class=\"col-xs-12 no-padding-left clearfix permission-header\">
                    <div class=\"col-xs-4 no-padding-left\">";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("events"            ,"wall_events"            ,            );
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
                    <div class=\"";
            // line 22
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                echo "col-xs-5";
            } else {
                echo "col-xs-8";
            }
            echo "\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("my_events_show"            ,"wall_events"            ,            );
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
            // line 23
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                // line 24
                echo "                        <div class=\"col-xs-3 no-padding-right\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("friends_events_show"                ,"wall_events"                ,                );
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
            }
            // line 26
            echo "                </div>
                <div class=\"col-xs-12 no-padding-left clearfix mb20\">
                    ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["user_perm"] ?? null));
            foreach ($context['_seq'] as $context["gid"] => $context["perm"]) {
                // line 29
                echo "                        <div class=\"clearfix permission-item\">
                            <div class=\"col-xs-4 no-padding-left\">";
                // line 30
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array(("wetype_" . ($context["gid"] ?? null))                ,"wall_events"                ,                );
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
                            <div class=\"";
                // line 31
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                    echo "col-xs-5";
                } else {
                    echo "col-xs-8";
                }
                echo "\">
                                <select name=\"perm[";
                // line 32
                echo $context["gid"];
                echo "][permissions]\" class=\"form-control\">
                                    <option value=\"0\"";
                // line 33
                if (($this->getAttribute($context["perm"], "permissions", []) == 0)) {
                    echo " selected";
                }
                echo ">
                                        ";
                // line 34
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("value_for_me"                ,"wall_events"                ,                );
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
                // line 35
                echo "                                    </option>
                                    ";
                // line 36
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                    // line 37
                    echo "                                    <option value=\"1\"";
                    if (($this->getAttribute($context["perm"], "permissions", []) == 1)) {
                        echo " selected";
                    }
                    echo ">
                                        ";
                    // line 38
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("value_for_friends"                    ,"wall_events"                    ,                    );
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
                    echo "                                    </option>
                                    ";
                }
                // line 41
                echo "                                    <option value=\"2\"";
                if (($this->getAttribute($context["perm"], "permissions", []) == 2)) {
                    echo " selected";
                }
                echo ">
                                        ";
                // line 42
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("value_for_registered"                ,"wall_events"                ,                );
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
                // line 43
                echo "                                    </option>
                                    <option value=\"3\"";
                // line 44
                if (($this->getAttribute($context["perm"], "permissions", []) == 3)) {
                    echo " selected";
                }
                echo ">
                                        ";
                // line 45
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("value_for_all"                ,"wall_events"                ,                );
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
                // line 46
                echo "                                    </option>
                                </select>
                            </div>                            
                            ";
                // line 49
                if ($this->getAttribute(($context["is_module_installed"] ?? null), "friendlist", [])) {
                    // line 50
                    echo "                                <div class=\"col-xs-1\"></div>
                                <div class=\"col-xs-2 no-padding-right\">    
                                    <input type=\"hidden\" name=\"perm[";
                    // line 52
                    echo $context["gid"];
                    echo "][feed]\" value=\"0\" />
                                    <input type=\"checkbox\" name=\"perm[";
                    // line 53
                    echo $context["gid"];
                    echo "][feed]\" value=\"1\" ";
                    if ($this->getAttribute($context["perm"], "feed", [])) {
                        echo " checked";
                    }
                    echo "/>
                                </div>    
                            ";
                }
                // line 55
                echo "                            
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['gid'], $context['perm'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "                </div>
                <div class=\"mt20\">
                    <input type=\"submit\" name=\"btn_save\" value=\"";
            // line 60
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
            echo "\" class=\"btn btn-primary\">
            </div>
            </form>
\t</div>
    ";
        } else {
            // line 65
            echo "\t<div class=\"p20\">
            ";
            // line 66
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_wall_events_types"            ,"wall_events"            ,            );
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
            // line 67
            echo "        </div>
\t";
        }
        // line 69
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "wall_permissions.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  473 => 69,  469 => 67,  448 => 66,  445 => 65,  418 => 60,  414 => 58,  406 => 55,  396 => 53,  392 => 52,  388 => 50,  386 => 49,  381 => 46,  360 => 45,  354 => 44,  351 => 43,  330 => 42,  323 => 41,  319 => 39,  298 => 38,  291 => 37,  289 => 36,  286 => 35,  265 => 34,  259 => 33,  255 => 32,  247 => 31,  224 => 30,  221 => 29,  217 => 28,  213 => 26,  188 => 24,  186 => 23,  157 => 22,  134 => 21,  130 => 19,  125 => 16,  100 => 15,  95 => 12,  93 => 11,  88 => 9,  84 => 8,  81 => 7,  79 => 6,  55 => 4,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "wall_permissions.twig", "/home/mliadov/public_html/application/modules/wall_events/views/flatty/wall_permissions.twig");
    }
}
