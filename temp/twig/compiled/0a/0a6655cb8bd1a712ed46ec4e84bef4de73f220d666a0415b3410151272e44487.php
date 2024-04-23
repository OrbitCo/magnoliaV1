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

/* helper_service_buy_form.twig */
class __TwigTemplate_9734c567cc75fe186bef41ce7d940f859de5d8dd23f25b9641d33a5a21b15f39 extends \Twig\Template
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
        // line 2
        echo "
<div class=\"b-memberships__list\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["services_block_services"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 5
            echo "        <div class=\"b-memberships__item\">
            <div class=\"b-member-plan\">
                ";
            // line 7
            if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                // line 8
                echo "                <ul class=\"b-member-plan__offers\">
                    ";
                // line 9
                if ($this->getAttribute($this->getAttribute($context["item"], "service_user_data", [], "any", false, true), "count", [], "any", true, true)) {
                    // line 10
                    echo "                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "count", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["setting_options"]) {
                        // line 11
                        echo "                            <li>
                                    ";
                        // line 12
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("field_count"                        ,"users"                        ,                        );
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
                                    ";
                        // line 13
                        echo $context["setting_options"];
                        echo "
                            </li>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['setting_options'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 16
                    echo "                    ";
                } else {
                    // line 17
                    echo "                    <li>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("expires"                    ,"services"                    ,                    );
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
                        &nbsp;";
                    // line 18
                    $module =                     null;
                    $helper =                     'date_format';
                    $name =                     'tpl_date_format';
                    $params = array($this->getAttribute($this->getAttribute(($context["item"] ?? null), "service_user_data", []), "date_expires", [])                    ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                    ,                    );
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
                    // line 19
                    echo "                    </li>
                    ";
                }
                // line 21
                echo "                </ul>
                ";
            } else {
                // line 23
                echo "                ";
            }
            // line 24
            echo "                <div class=\"b-member-plan__title\">";
            echo $this->getAttribute($context["item"], "name", []);
            echo "</div>
                <ul class=\"b-member-plan__offers\">
                    ";
            // line 26
            if ($this->getAttribute($context["item"], "description", [])) {
                // line 27
                echo "                        <li>";
                echo $this->getAttribute($context["item"], "description", []);
                echo "</li>
                    ";
            }
            // line 29
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "template", []), "data_admin_array", []));
            foreach ($context['_seq'] as $context["setting_gid"] => $context["setting_options"]) {
                // line 30
                echo "                        <li>
                            ";
                // line 31
                echo $this->getAttribute($context["setting_options"], "name", []);
                echo ":
                            ";
                // line 32
                echo $this->getAttribute($this->getAttribute($context["item"], "data_admin", []), $context["setting_gid"], [], "array");
                echo "
                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['setting_gid'], $context['setting_options'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "                </ul>
                <div class=\"b-member-plan__price\">
                    ";
            // line 37
            if ($this->getAttribute($context["item"], "price", [])) {
                // line 38
                echo "                        <div>";
                $module =                 null;
                $helper =                 'start';
                $name =                 'currency_format_output';
                $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "price", [])]                ,                );
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
            // line 40
            echo "
                    ";
            // line 41
            if (($this->getAttribute($context["item"], "price", []) || ($this->getAttribute($this->getAttribute($context["item"], "template", []), "price_type", []) != 1))) {
                // line 42
                echo "                        <div>
                            <input type=\"button\" 
                                class=\"btn btn-primary btn-sm get-service-form ";
                // line 44
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    echo "btn-service-active";
                } else {
                }
                echo "\" 
                                value=\"";
                // line 45
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    // line 46
                    echo "                                   ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("activated"                    ,"services"                    ,                    );
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
                    // line 47
                    echo "                                ";
                } else {
                    // line 48
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_buy_now"                    ,"services"                    ,                    );
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
                    echo "                                 ";
                }
                echo "\"
                                 data-gid=\"";
                // line 50
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\" />
                        </div>
                    ";
            } else {
                // line 53
                echo "                        <div>
                            <input type=\"button\" 
                                   class=\"btn btn-primary btn-sm ";
                // line 55
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    echo "btn-service-active";
                } else {
                }
                echo "\" 
                                   onclick=\"
                                var href='";
                // line 57
                echo ($context["site_url"] ?? null);
                echo "services/user_service_activate/";
                echo ($context["user_id"] ?? null);
                echo "/0/";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "';
                                var alert='";
                // line 58
                echo twig_escape_filter($this->env, ($context["data_alert_lng"] ?? null));
                echo "<br>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "name", []));
                echo "<br>(";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "description", []));
                echo ")';

                                if(!parseInt('";
                // line 60
                echo $this->getAttribute($this->getAttribute($context["item"], "template", []), "alert_activate", []);
                echo "')) {
                                    locationHref(href);
                                } else {
                                    alerts.show({
                                        text: alert.replace(/<br>/g, '\\n'),
                                        type: 'confirm',
                                        ok_callback: function(){
                                            locationHref(href);
                                        }
                                    });
                                }\" 
                                value=\"";
                // line 71
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    // line 72
                    echo "                                   ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("activated"                    ,"services"                    ,                    );
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
                    // line 73
                    echo "                                ";
                } else {
                    // line 74
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_buy_now"                    ,"services"                    ,                    );
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
                    // line 75
                    echo "                                 ";
                }
                echo "\"/>
                        </div>
                    ";
            }
            // line 78
            echo "                </div>
            </div>
        </div>
    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 82
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_services"            ,"services"            ,            );
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
            // line 83
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "        
        
    <script type=\"text/javascript\">
        
        
        
        \$(function(){
            function getServiceForm()
            {
                
            }
            
            
            loadScripts(
                [\"";
        // line 98
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("services"        ,"services.js"        ,"path"        ,        );
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
                function(){
                    services = new Services({siteUrl:site_url});
                },
                ['services'],
                {async: true}
            );
        });
    </script>
</div>
";
    }

    public function getTemplateName()
    {
        return "helper_service_buy_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  463 => 98,  447 => 84,  441 => 83,  419 => 82,  411 => 78,  404 => 75,  382 => 74,  379 => 73,  357 => 72,  355 => 71,  341 => 60,  332 => 58,  324 => 57,  316 => 55,  312 => 53,  306 => 50,  301 => 49,  279 => 48,  276 => 47,  254 => 46,  252 => 45,  245 => 44,  241 => 42,  239 => 41,  236 => 40,  211 => 38,  209 => 37,  205 => 35,  196 => 32,  192 => 31,  189 => 30,  184 => 29,  178 => 27,  176 => 26,  170 => 24,  167 => 23,  163 => 21,  159 => 19,  138 => 18,  114 => 17,  111 => 16,  102 => 13,  79 => 12,  76 => 11,  71 => 10,  69 => 9,  66 => 8,  64 => 7,  60 => 5,  55 => 4,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_service_buy_form.twig", "/home/mliadov/public_html/application/modules/services/views/flatty/helper_service_buy_form.twig");
    }
}
