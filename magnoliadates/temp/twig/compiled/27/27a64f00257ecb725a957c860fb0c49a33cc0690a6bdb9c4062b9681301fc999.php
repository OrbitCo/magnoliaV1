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

/* ajax_user_package_for_activate.twig */
class __TwigTemplate_419cc85d5d9c2e159c205f4f62ff06429b006cfd4e3e926c5ba067728c177e11 extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    <h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_use_services"        ,"services"        ,        );
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
        // line 4
        echo "    </h1>

    <div class=\"inside\">
        ";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("service_activate_confirm"        ,"services"        ,        );
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
        $context['data_alert_lng'] = $result;
        // line 8
        echo "
        ";
        // line 9
        if (($this->getAttribute(($context["service"] ?? null), "is_free_status", []) || $this->getAttribute(($context["block_data"] ?? null), "user_services", []))) {
            // line 10
            echo "            ";
            if ($this->getAttribute(($context["service"] ?? null), "is_free_status", [])) {
                // line 11
                echo "                <div>
                    ";
                // line 12
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("service_activate_free_text"                ,"services"                ,                );
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
                // line 13
                echo "                </div>
                <div class=\"service";
                // line 14
                if ($this->getAttribute(($context["block_data"] ?? null), "user_services", [])) {
                    echo " mb10";
                }
                echo "\">
                    
                    <div class=\"service-title clearfix\">
                        <div class=\"service-name\">
                            ";
                // line 18
                echo $this->getAttribute(($context["service"] ?? null), "name", []);
                echo "                            
                        </div>
                    </div>
                        
                    <div class=\"service-description\">
                        ";
                // line 23
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["service"] ?? null), "template", []), "data_admin_array", []));
                foreach ($context['_seq'] as $context["setting_gid"] => $context["setting_options"]) {
                    // line 24
                    echo "                            <div>
                                <span>
                                    ";
                    // line 26
                    echo $this->getAttribute($context["setting_options"], "name", []);
                    echo ": ";
                    echo $this->getAttribute($this->getAttribute(($context["service"] ?? null), "data_admin", []), $context["setting_gid"], [], "array");
                    echo "
                                </span>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['setting_gid'], $context['setting_options'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "                        
                    </div>
                    
                    <button class=\"btn btn-primary\" id=\"btn_activate_service\">";
                // line 32
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_activate"                ,"services"                ,                );
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
                echo "</button>
                    
                    <script type=\"text/javascript\">
                        \$('#btn_activate_service').off().on('click', function(){
                            var href = '";
                // line 36
                echo ($context["site_url"] ?? null);
                echo "services/user_service_activate/";
                echo $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []);
                echo "/0/";
                echo $this->getAttribute(($context["service"] ?? null), "gid", []);
                echo "';
                            var alert = '";
                // line 37
                echo twig_escape_filter($this->env, ($context["data_alert_lng"] ?? null));
                echo "<br>";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["service"] ?? null), "name", []), "js");
                echo "<br>({ service.description|e('js') }})';

                            if (!parseInt('";
                // line 39
                echo $this->getAttribute($this->getAttribute(($context["service"] ?? null), "template", []), "alert_activate", []);
                echo "')) {
                                locationHref(href);
                            } else {
                                alerts.show({
                                    text: alert.replace(/<br>/g, '\\n'),
                                    type: 'confirm',
                                    ok_callback: function () {
                                        locationHref(href);
                                    }
                                });
                            }                            
                        });
                    </script>

                </div>
                ";
                // line 54
                if ($this->getAttribute(($context["block_data"] ?? null), "user_services", [])) {
                    // line 55
                    echo "                    <div class=\"centered h3\">
                        ";
                    // line 56
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("or"                    ,"start"                    ,                    );
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
                    // line 57
                    echo "                    </div>
                ";
                }
                // line 59
                echo "            ";
            }
            // line 60
            echo "
            ";
            // line 61
            if ($this->getAttribute(($context["block_data"] ?? null), "user_services", [])) {
                // line 62
                echo "                <div class=\"mb30\">
                    ";
                // line 63
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("service_spend_text"                ,"services"                ,                );
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
                // line 64
                echo "                </div>
                <form method=\"POST\" action=\"\" id=\"ability_form\" role=\"form\">
                    ";
                // line 66
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["block_data"] ?? null), "user_services", []));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 67
                    echo "                        <div class=\"service\">
                            
                            <div class=\"service-title clearfix\">
                                <div class=\"service-name\">
                                    ";
                    // line 71
                    if ($this->getAttribute($context["item"], "package_name", [])) {
                        // line 72
                        echo "                                        ";
                        echo $this->getAttribute($context["item"], "package_name", []);
                        echo " :
                                    ";
                    }
                    // line 74
                    echo "                                    ";
                    if ($this->getAttribute($this->getAttribute($context["item"], "service", []), "name", [])) {
                        // line 75
                        echo "                                        ";
                        echo $this->getAttribute($this->getAttribute($context["item"], "service", []), "name", []);
                        echo "
                                    ";
                    } else {
                        // line 77
                        echo "                                        ";
                        echo $this->getAttribute($context["item"], "name", []);
                        echo "
                                    ";
                    }
                    // line 79
                    echo "                                    ";
                    if ($this->getAttribute($context["item"], "count", [])) {
                        // line 80
                        echo "                                        &nbsp;(";
                        echo $this->getAttribute($context["item"], "count", []);
                        echo ")
                                    ";
                    }
                    // line 81
                    echo "                           
                                </div>

                                ";
                    // line 84
                    if ($this->getAttribute($context["item"], "package_till_date", [])) {
                        // line 85
                        echo "                                    <div>
                                        ";
                        // line 86
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("package_active_till"                        ,"packages"                        ,                        );
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
                        echo ":&nbsp;
                                        ";
                        // line 87
                        $module =                         null;
                        $helper =                         'date_format';
                        $name =                         'tpl_date_format';
                        $params = array($this->getAttribute(($context["item"] ?? null), "package_till_date", [])                        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])                        ,                        );
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
                        // line 88
                        echo "                                    </div>
                                ";
                    }
                    // line 90
                    echo "
                                <div class=\"service-control\">
                                    <input type=\"button\" data-value=\"";
                    // line 92
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\"
                                           data-alert=\"";
                    // line 93
                    if ($this->getAttribute($this->getAttribute($context["item"], "template", []), "alert_activate", [])) {
                        // line 94
                        echo "                                           ";
                        echo twig_escape_filter($this->env, ($context["data_alert_lng"] ?? null));
                        echo "<br>
                                           ";
                        // line 95
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", []));
                        echo "<br>
                                           ";
                        // line 96
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", []));
                        echo "<br>
                                           ";
                        // line 97
                        echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "alert", []));
                        echo "
                                           ";
                    }
                    // line 98
                    echo "\" value=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_activate"                    ,"services"                    ,                    );
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
                    echo "\" class=\"btn btn-primary\"/>

                                </div>
                            </div>

                            <div class=\"service-description\">
                                ";
                    // line 104
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "service", []), "template", []), "data_admin_array", []));
                    foreach ($context['_seq'] as $context["setting_gid"] => $context["setting_options"]) {
                        // line 105
                        echo "                                    <div>
                                        <span>
                                            ";
                        // line 107
                        echo $this->getAttribute($context["setting_options"], "name", []);
                        echo ":
                                            ";
                        // line 108
                        echo $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "service", []), "data_admin", []), $context["setting_gid"], [], "array");
                        echo "
                                        </span>
                                    </div>
                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['setting_gid'], $context['setting_options'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 111
                    echo "                       
                            </div>
     
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 116
                echo "                </form>
            ";
            }
            // line 118
            echo "        ";
        } else {
            // line 119
            echo "            ";
            $module =             null;
            $helper =             'services';
            $name =             'serviceBuyForm';
            $params = array(["template_gid" => $this->getAttribute(($context["template"] ?? null), "gid", [])]            ,            );
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
            // line 120
            echo "        ";
        }
        // line 121
        echo "    </div>
    <div class=\"clr\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ajax_user_package_for_activate.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  504 => 121,  501 => 120,  479 => 119,  476 => 118,  472 => 116,  462 => 111,  452 => 108,  448 => 107,  444 => 105,  440 => 104,  411 => 98,  406 => 97,  402 => 96,  398 => 95,  393 => 94,  391 => 93,  387 => 92,  383 => 90,  379 => 88,  358 => 87,  335 => 86,  332 => 85,  330 => 84,  325 => 81,  319 => 80,  316 => 79,  310 => 77,  304 => 75,  301 => 74,  295 => 72,  293 => 71,  287 => 67,  283 => 66,  279 => 64,  258 => 63,  255 => 62,  253 => 61,  250 => 60,  247 => 59,  243 => 57,  222 => 56,  219 => 55,  217 => 54,  199 => 39,  192 => 37,  184 => 36,  158 => 32,  153 => 29,  141 => 26,  137 => 24,  133 => 23,  125 => 18,  116 => 14,  113 => 13,  92 => 12,  89 => 11,  86 => 10,  84 => 9,  81 => 8,  60 => 7,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_user_package_for_activate.twig", "/home/mliadov/public_html/application/modules/services/views/flatty/ajax_user_package_for_activate.twig");
    }
}
