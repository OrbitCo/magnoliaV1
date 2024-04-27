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

/* helper_services_buy_list.twig */
class __TwigTemplate_e8e8e3979e9108e3f5e48539951e582de4618ba814f6d7359d7a5a7d481ca165 extends \Twig\Template
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
        echo "    ";
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
            echo "          ";
            if (($this->getAttribute($context["item"], "gid", []) != "ability_delete")) {
                // line 6
                echo "            <div class=\"b-memberships__item\">
                <div class=\"b-member-plan\">
                    ";
                // line 8
                if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                    // line 9
                    echo "                    <ul class=\"b-member-plan__offers\">
                        ";
                    // line 10
                    if ($this->getAttribute($this->getAttribute($context["item"], "service_user_data", [], "any", false, true), "count", [], "any", true, true)) {
                        // line 11
                        echo "                            ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "count", []));
                        foreach ($context['_seq'] as $context["_key"] => $context["setting_options"]) {
                            // line 12
                            echo "                                <li>
                                        ";
                            // line 13
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("field_count"                            ,"users"                            ,                            );
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
                            // line 14
                            echo $context["setting_options"];
                            echo "
                                </li>
                            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['setting_options'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 17
                        echo "                        ";
                    } else {
                        // line 18
                        echo "                            ";
                        if (($this->getAttribute($context["item"], "gid", []) != "admin_approve")) {
                            // line 19
                            echo "                            ";
                            if ($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "date_expired", [])) {
                                echo "       
                            <li>";
                                // line 20
                                $module =                                 null;
                                $helper =                                 'lang';
                                $name =                                 'l';
                                $params = array("expires"                                ,"services"                                ,                                );
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
                                // line 21
                                $module =                                 null;
                                $helper =                                 'date_format';
                                $name =                                 'tpl_date_format';
                                $params = array($this->getAttribute($this->getAttribute(($context["item"] ?? null), "service_user_data", []), "date_expired", [])                                ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                                ,                                );
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
                                // line 22
                                echo "                            </li>
                            ";
                            }
                            // line 24
                            echo "                            ";
                        }
                        // line 25
                        echo "                        ";
                    }
                    // line 26
                    echo "                    </ul>
                    ";
                } else {
                    // line 28
                    echo "                    ";
                }
                // line 29
                echo "                    <div class=\"b-member-plan__title\">";
                echo $this->getAttribute($context["item"], "name", []);
                echo "</div>
                    <ul class=\"b-member-plan__offers\">
                        ";
                // line 31
                if ($this->getAttribute($context["item"], "description", [])) {
                    // line 32
                    echo "                            <li>";
                    echo $this->getAttribute($context["item"], "description", []);
                    echo "</li>
                        ";
                }
                // line 34
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "template", []), "data_admin_array", []));
                foreach ($context['_seq'] as $context["setting_gid"] => $context["setting_options"]) {
                    // line 35
                    echo "                            <li>
                                ";
                    // line 36
                    echo $this->getAttribute($context["setting_options"], "name", []);
                    echo ":
                                ";
                    // line 37
                    echo $this->getAttribute($this->getAttribute($context["item"], "data_admin", []), $context["setting_gid"], [], "array");
                    echo "
                            </li>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['setting_gid'], $context['setting_options'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 40
                echo "                    </ul>
                    <div class=\"b-member-plan__price clearfix\">
                        ";
                // line 42
                if ($this->getAttribute($context["item"], "price", [])) {
                    // line 43
                    echo "                            <div class=\"b-member-plan__price__val\">";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'currency_format_output';
                    $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "price", [])]                    ,                    );
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
                } else {
                    // line 45
                    echo "                            ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("free"                    ,"services"                    ,                    );
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
                    echo "                        ";
                }
                // line 47
                echo "
                        ";
                // line 48
                if ((($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0") && twig_test_empty($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "date_expired", [])))) {
                    // line 49
                    echo "                            <div class=\"b-member-plan__price__btn\">";
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
                    echo "</div>
                        ";
                } else {
                    // line 50
                    echo "                                    
                            ";
                    // line 51
                    if (($this->getAttribute($context["item"], "price", []) || ($this->getAttribute($this->getAttribute($context["item"], "template", []), "price_type", []) != 1))) {
                        // line 52
                        echo "                                <div class=\"b-member-plan__price__btn\">
                                    ";
                        // line 53
                        if ($this->getAttribute($this->getAttribute($context["item"], "service_user_data", [], "any", false, true), "activate", [], "any", true, true)) {
                            // line 54
                            echo "                                        <input type=\"button\" class=\"btn btn-primary btn-sm btn-service-active\"
                                            value=\"";
                            // line 55
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("link_activate_service"                            ,"services"                            ,                            );
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
                                              id=\"service_buy_";
                            // line 56
                            echo $this->getAttribute($context["item"], "tpl_gid", []);
                            echo "\" />
                                    ";
                        } else {
                            // line 58
                            echo "                                        <input type=\"button\"
                                            class=\"btn btn-primary btn-sm ";
                            // line 59
                            if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                                echo "btn-service-active";
                            } else {
                            }
                            echo "\"
                                            data-action=\"";
                            // line 60
                            if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                                echo "extend_service";
                            } else {
                            }
                            echo "\"
                                            value=\"";
                            // line 61
                            if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                                // line 62
                                echo "                                               ";
                                $module =                                 null;
                                $helper =                                 'lang';
                                $name =                                 'l';
                                $params = array("activated"                                ,"services"                                ,                                );
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
                                echo "                                            ";
                            } else {
                                // line 64
                                echo "                                                ";
                                $module =                                 null;
                                $helper =                                 'lang';
                                $name =                                 'l';
                                $params = array("btn_buy_now"                                ,"services"                                ,                                );
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
                                // line 65
                                echo "                                             ";
                            }
                            echo "\"
                                             id=\"service_buy_";
                            // line 66
                            echo $this->getAttribute($context["item"], "tpl_gid", []);
                            echo "\"  />
                                    ";
                        }
                        // line 67
                        echo "                               
                                </div>
                            ";
                    } else {
                        // line 70
                        echo "                                <div class=\"b-member-plan__price__btn\">
                                    <input type=\"button\" 
                                        class=\"btn btn-primary btn-sm ";
                        // line 72
                        if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                            echo "btn-service-active";
                        } else {
                        }
                        echo "\"
                                        data-action=\"";
                        // line 73
                        if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                            echo "extend_service";
                        } else {
                        }
                        echo "\"
                                        id=\"service_buy_";
                        // line 74
                        echo $this->getAttribute($context["item"], "tpl_gid", []);
                        echo "\" 
                                        value=\"";
                        // line 75
                        if (($this->getAttribute($this->getAttribute($context["item"], "service_user_data", []), "is_expired", []) == "0")) {
                            // line 76
                            echo "                                            ";
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("activated"                            ,"services"                            ,                            );
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
                            // line 77
                            echo "                                        ";
                        } elseif (($this->getAttribute($context["item"], "price", []) > 0)) {
                            // line 78
                            echo "                                            ";
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("btn_buy_now"                            ,"services"                            ,                            );
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
                            // line 79
                            echo "                                        ";
                        } else {
                            // line 80
                            echo "                                            ";
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("btn_apply"                            ,"start"                            ,                            );
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
                            // line 81
                            echo "                                        ";
                        }
                        echo "\"/>
                                </div>
                            ";
                    }
                    // line 84
                    echo "                        ";
                }
                // line 85
                echo "                    </div>
                </div>
            </div>
            <script>
                \$(function () {
                    loadScripts(
                            [
                                \"";
                // line 92
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array(""                ,"available_view.js"                ,"path"                ,                );
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
                                \"";
                // line 93
                $module =                 null;
                $helper =                 'utils';
                $name =                 'jscript';
                $params = array("users"                ,"../views/flatty/js/users-avatar.js"                ,"path"                ,                );
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
                            ],
                            function () {
                                ";
                // line 96
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "_available_view = new available_view({
                                    siteUrl: site_url,
                                    checkAvailableAjaxUrl: '";
                // line 98
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "checkAvailableAjaxUrl", []);
                echo "',
                                    buyAbilityAjaxUrl: '";
                // line 99
                echo $this->getAttribute($this->getAttribute($context["item"], "additional_settings", []), "buyAbilityAjaxUrl", []);
                echo "',
                                    buyAbilityFormId: 'ability_form',
                                    buyAbilitySubmitId: 'ability_form_submit',
                                    formType: 'list',
                                    success_request: function (message) {
                                        error_object.show_error_block(message, 'success');
                                    },
                                    fail_request: function (message) {
                                        error_object.show_error_block(message, 'error');
                                    },
                                });
                                \$('#service_buy_";
                // line 110
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "').off('click').on('click', function (e) {
                                    ";
                // line 111
                echo $this->getAttribute($context["item"], "tpl_gid", []);
                echo "_available_view.check_available();                            
                                    return false;
                                });
                            },
                            ['";
                // line 115
                echo $this->getAttribute($context["item"], "gid", []);
                echo "_available_view'],
                           {async: false}
                    );
                });
            </script>
          ";
            }
            // line 121
            echo "        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 122
            echo "            ";
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
            // line 123
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "    </div>
<script>
\$( document ).ready(function() {    
    \$('[data-action=\"extend_service\"]').on('mouseover', function() {
        \$(this).val(\"";
        // line 128
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("extend"        ,"services"        ,        );
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
        echo "\");
    });
    
    \$('[data-action=\"extend_service\"]').on('mouseout', function() {
        \$(this).val(\"";
        // line 132
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("activated"        ,"services"        ,        );
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
        echo "\");
    });
});    
</script>";
    }

    public function getTemplateName()
    {
        return "helper_services_buy_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  701 => 132,  675 => 128,  669 => 124,  663 => 123,  641 => 122,  636 => 121,  627 => 115,  620 => 111,  616 => 110,  602 => 99,  598 => 98,  593 => 96,  568 => 93,  545 => 92,  536 => 85,  533 => 84,  526 => 81,  504 => 80,  501 => 79,  479 => 78,  476 => 77,  454 => 76,  452 => 75,  448 => 74,  441 => 73,  434 => 72,  430 => 70,  425 => 67,  420 => 66,  415 => 65,  393 => 64,  390 => 63,  368 => 62,  366 => 61,  359 => 60,  352 => 59,  349 => 58,  344 => 56,  321 => 55,  318 => 54,  316 => 53,  313 => 52,  311 => 51,  308 => 50,  283 => 49,  281 => 48,  278 => 47,  275 => 46,  253 => 45,  228 => 43,  226 => 42,  222 => 40,  213 => 37,  209 => 36,  206 => 35,  201 => 34,  195 => 32,  193 => 31,  187 => 29,  184 => 28,  180 => 26,  177 => 25,  174 => 24,  170 => 22,  149 => 21,  126 => 20,  121 => 19,  118 => 18,  115 => 17,  106 => 14,  83 => 13,  80 => 12,  75 => 11,  73 => 10,  70 => 9,  68 => 8,  64 => 6,  61 => 5,  56 => 4,  52 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_services_buy_list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\services\\views\\flatty\\helper_services_buy_list.twig");
    }
}
