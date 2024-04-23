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

/* service_form.twig */
class __TwigTemplate_ae58cf9c118fdcf7fc6ce1596bc10bda362eeb962f0e0ef5e0c63aa46dbaf0cc extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "service_form.twig", 1)->display($context);
        // line 2
        echo "<form method=\"post\" action=\"";
        echo ($context["site_url"] ?? null);
        echo "services/form/";
        echo $this->getAttribute(($context["data"] ?? null), "gid", []);
        echo "\">
    <div class=\"service-payment-form col-xs-12\">
        <h1>";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_buy_service"        ,"services"        ,        );
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
        echo "&nbsp;&laquo;";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array($this->getAttribute(($context["data"] ?? null), "name_lang_gid", [])        ,"services"        ,        );
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
        echo "&raquo;</h1>
        
        <div class=\"service-description clearfix\">
            <div class=\"service-title\">
                <div class=\"col-xs-10\">";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array($this->getAttribute(($context["data"] ?? null), "name_lang_gid", [])        ,"services"        ,        );
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
                <div class=\"col-xs-2\">
                    <div class=\"pull-right\">";
        // line 10
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array(["value" => $this->getAttribute(($context["data"] ?? null), "price", [])]        ,        );
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
            </div>
            <div class=\"col-xs-12\">
                ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "data_admin_array", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 15
            echo "                    <div>";
            echo $this->getAttribute($context["item"], "name", []);
            echo ":
                        ";
            // line 16
            if (((($this->getAttribute($context["item"], "type", []) == "string") || ($this->getAttribute($context["item"], "type", []) == "int")) || ($this->getAttribute($context["item"], "type", []) == "text"))) {
                // line 17
                echo "                            ";
                echo $this->getAttribute($context["item"], "value", []);
                echo "
                        ";
            } elseif (($this->getAttribute(            // line 18
$context["item"], "type", []) == "price")) {
                // line 19
                echo "                            ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'currency_format_output';
                $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "value", [])]                ,                );
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
                // line 20
                echo "                        ";
            } elseif (($this->getAttribute($context["item"], "type", []) == "checkbox")) {
                // line 21
                echo "                            ";
                if (($this->getAttribute($context["item"], "value", []) == "1")) {
                    // line 22
                    echo "                                ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("yes_checkbox_value"                    ,"services"                    ,                    );
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
                    // line 23
                    echo "                            ";
                } else {
                    // line 24
                    echo "                                ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("no_checkbox_value"                    ,"services"                    ,                    );
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
                    echo "                            ";
                }
                // line 26
                echo "                        ";
            }
            // line 27
            echo "                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "            </div>
            <table>
                ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "data_user_array", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 32
            echo "                    ";
            if (($this->getAttribute($context["item"], "type", []) == "hidden")) {
                // line 33
                echo "                        <input type=\"hidden\" name=\"data_user[";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "]\" value=\"";
                echo $this->getAttribute($context["item"], "value", []);
                echo "\">
                    ";
            } else {
                // line 35
                echo "                        <tr>
                            <td>
                                ";
                // line 37
                echo $this->getAttribute($context["item"], "name", []);
                echo ":
                            </td>
                            ";
                // line 39
                if (($this->getAttribute($context["item"], "type", []) == "string")) {
                    // line 40
                    echo "                                <td class=\"value\">
                                    <input type=\"text\" value=\"";
                    // line 41
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                           name=\"data_user[";
                    // line 42
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\">
                                </td>
                            ";
                } elseif (($this->getAttribute(                // line 44
$context["item"], "type", []) == "int")) {
                    // line 45
                    echo "                                <td class=\"value\">
                                    <input type=\"text\" value=\"";
                    // line 46
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                           name=\"data_user[";
                    // line 47
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\" class=\"short\">
                                </td>
                            ";
                } elseif (($this->getAttribute(                // line 49
$context["item"], "type", []) == "price")) {
                    // line 50
                    echo "                                <td class=\"value\">
                                    <input type=\"text\" value=\"";
                    // line 51
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                           name=\"data_user[";
                    // line 52
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\" class=\"short\">
                                    ";
                    // line 53
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'currency_format_output';
                    $params = array(                    );
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
                    // line 54
                    echo "                                </td>
                            ";
                } elseif (($this->getAttribute(                // line 55
$context["item"], "type", []) == "text")) {
                    // line 56
                    echo "                                <td class=\"value\"class=\"value\">
                                    <textarea name=\"data_user[";
                    // line 57
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\">";
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "</textarea>
                                </td>
                            ";
                } elseif (($this->getAttribute(                // line 59
$context["item"], "type", []) == "checkbox")) {
                    // line 60
                    echo "                                <td class=\"value\">
                                    <input type=\"checkbox\" name=\"data_user[";
                    // line 61
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\"
                                        value=\"1\" ";
                    // line 62
                    if (($this->getAttribute($context["item"], "value", []) == "1")) {
                        echo "checked";
                    }
                    echo ">
                                </td>
                            ";
                }
                // line 65
                echo "                        </tr>
                    ";
            }
            // line 67
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        echo "                ";
        if (($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "price_type", []) == "2")) {
            // line 69
            echo "                    <tr>
                        <td>
                            ";
            // line 71
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_your_price"            ,"services"            ,            );
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
                        </td>
                        <td class=\"value\">
                            <input type=\"text\" value=\"";
            // line 74
            echo $this->getAttribute(($context["data"] ?? null), "price", []);
            echo "\" name=\"price\" class=\"short\">
                            <b>";
            // line 75
            $module =             null;
            $helper =             'start';
            $name =             'currency_format_output';
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
            echo "</b>
                        </td>
                    </tr>
                ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 78
($context["data"] ?? null), "template", []), "price_type", []) == "3")) {
            // line 79
            echo "                    <tr>
                        <td>
                            ";
            // line 81
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_price"            ,"services"            ,            );
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
                        </td>
                        <td class=\"value\">
                            <input type=\"hidden\" value=\"";
            // line 84
            echo $this->getAttribute(($context["data"] ?? null), "price", []);
            echo "\" name=\"price\" class=\"short\">
                            <b>";
            // line 85
            $module =             null;
            $helper =             'start';
            $name =             'currency_format_output';
            $params = array(["value" => $this->getAttribute(($context["data"] ?? null), "price", [])]            ,            );
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
            echo "</b>
                        </td>
                    </tr>
                ";
        }
        // line 89
        echo "            </table>
        </div>
    </div>
    <div class=\"service-payment-form col-xs-12\">
        
        ";
        // line 94
        $module =         null;
        $helper =         'special_offers';
        $name =         'getOfferNote';
        $params = array("services"        ,$this->getAttribute(($context["data"] ?? null), "id", [])        ,        );
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
        // line 95
        echo "        
        ";
        // line 96
        if ($this->getAttribute(($context["data"] ?? null), "free_activate", [])) {
            // line 97
            echo "            <div class=\"mtb20\">
                <input data-pjax=\"0\" type=\"submit\"  class=\"btn btn-primary\"  name=\"btn_account\" value=\"";
            // line 98
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_activate_free"            ,"services"            ,""            ,"button"            ,            );
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
            </div>
        ";
        } else {
            // line 101
            echo "            <input type=\"hidden\" value=\"1\" name=\"activate_immediately\" />
            ";
            // line 102
            if ((($this->getAttribute(($context["data"] ?? null), "price", []) > 0) && $this->getAttribute(($context["data"] ?? null), "user_account", []))) {
                // line 103
                echo "                <div class=\"pt10\">    
                    ";
                // line 104
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("on_your_account_now"                ,"services"                ,                );
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
                // line 105
                $module =                 null;
                $helper =                 'start';
                $name =                 'currency_format_output';
                $params = array(["value" => $this->getAttribute(($context["data"] ?? null), "user_account", [])]                ,                );
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
                // line 106
                echo "                </div>    
            ";
            }
            // line 108
            echo "            ";
            if (((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 1) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2)) && ($context["is_module_installed"] ?? null))) {
                // line 109
                echo "                ";
                if ($this->getAttribute(($context["data"] ?? null), "disable_account_pay", [])) {
                    // line 110
                    echo "                    <p>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("error_account_less_then_service_price"                    ,"services"                    ,                    );
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
                    // line 111
                    echo "                        <a href=\"";
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("users"                    ,"account"                    ,["action" => "update"]                    ,                    );
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
                            ";
                    // line 112
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_add_founds"                    ,"services"                    ,                    );
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
                    // line 113
                    echo "                        </a>
                    </p>
                ";
                } else {
                    // line 116
                    echo "                    <div class=\"mtb20\">
                        <input data-pjax=\"0\" type=\"submit\" name=\"btn_account\" class=\"btn btn-primary\" value=\"";
                    // line 117
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_pay_account"                    ,"services"                    ,""                    ,"button"                    ,                    );
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
                    </div>
                ";
                }
                // line 120
                echo "            ";
            }
            // line 121
            echo "            ";
            if ((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 3))) {
                // line 122
                echo "                ";
                if (((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 1) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2)) && ($context["is_module_installed"] ?? null))) {
                    // line 123
                    echo "                    <span class=\"select-payment-method\">
                        ";
                    // line 124
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_select_payment_method"                    ,"services"                    ,                    );
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
                    // line 125
                    echo "                    </span>
                ";
                }
                // line 126
                echo "    
                <div class=\"billing-systems-block row\">
                    ";
                // line 128
                if (($context["billing_systems"] ?? null)) {
                    // line 129
                    echo "                        <input type=\"hidden\" id=\"system_gid\" name=\"system_gid\" value=\"";
                    echo $this->getAttribute($this->getAttribute(($context["billing_systems"] ?? null), 0, []), "gid", []);
                    echo "\">
                        ";
                    // line 130
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 131
                        echo "                            <div class=\"col-xs-12 col-sm-6 col-md-3\">
                                <div class=\"billing-method ";
                        // line 132
                        if (($this->getAttribute($this->getAttribute(($context["billing_systems"] ?? null), 0, []), "gid", []) == $this->getAttribute($context["item"], "gid", []))) {
                            echo " selected ";
                        }
                        echo "\" data-gid=\"";
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "\" onclick=\"system_gid_change('";
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "')\">
                                    <img src=\"";
                        // line 133
                        echo $this->getAttribute($context["item"], "logo_url", []);
                        echo "\" class=\"img-responsive\" alt=\"";
                        echo $this->getAttribute($context["item"], "name", []);
                        echo "\" title=\"";
                        echo $this->getAttribute($context["item"], "name", []);
                        echo "\">
                                </div>
                            </div>
                            <div id=\"system_";
                        // line 136
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "\" class=\"hide\" data-tarifs=\"";
                        echo $this->getAttribute($context["item"], "tarifs_type", []);
                        echo "\">
                                <div id=\"details_";
                        // line 137
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "\">";
                        echo $this->getAttribute($context["item"], "info_data", []);
                        echo "</div>
                            </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 140
                    echo "                        <div class=\"col-xs-12 hide\" id=\"details\">
                            <label>
                                ";
                    // line 142
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_info_data"                    ,"payments"                    ,                    );
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
                            </label>
                            <div id=\"details_block\" class=\"system-data\"></div>
                        </div>
                        <div class=\"col-xs-12\">
                            <button type=\"submit\" name=\"btn_system\" value=\"1\" class=\"btn btn-primary\">
                                ";
                    // line 148
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_pay_systems"                    ,"services"                    ,                    );
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
                    // line 149
                    echo "                            </button>
                        </div>
                    ";
                } elseif (($this->getAttribute(                // line 151
($context["data"] ?? null), "pay_type", []) == 3)) {
                    // line 152
                    echo "                        <p>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("error_empty_billing_system_list"                    ,"service"                    ,                    );
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
                    echo "</p>
                    ";
                }
                // line 154
                echo "                </div>
            ";
            }
            // line 156
            echo "        ";
        }
        // line 157
        echo "    </div>
</form>
<script>
    function system_gid_change(value) {
        \$('#details').hide();
        if(value){
            var details = \$('#details_' + value).html();
            if(details.length) \$('#details').show().find('#details_block').html(details);
        }
    }
    \$(function(){
        loadScripts(
            [\"";
        // line 169
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
                services = new Services();
            },
            ['services'],
            {async: true}
        );
    });
</script>
";
        // line 178
        $this->loadTemplate("@app/footer.twig", "service_form.twig", 178)->display($context);
    }

    public function getTemplateName()
    {
        return "service_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  948 => 178,  917 => 169,  903 => 157,  900 => 156,  896 => 154,  871 => 152,  869 => 151,  865 => 149,  844 => 148,  816 => 142,  812 => 140,  801 => 137,  795 => 136,  785 => 133,  775 => 132,  772 => 131,  768 => 130,  763 => 129,  761 => 128,  757 => 126,  753 => 125,  732 => 124,  729 => 123,  726 => 122,  723 => 121,  720 => 120,  695 => 117,  692 => 116,  687 => 113,  666 => 112,  642 => 111,  620 => 110,  617 => 109,  614 => 108,  610 => 106,  589 => 105,  566 => 104,  563 => 103,  561 => 102,  558 => 101,  533 => 98,  530 => 97,  528 => 96,  525 => 95,  504 => 94,  497 => 89,  471 => 85,  467 => 84,  442 => 81,  438 => 79,  436 => 78,  411 => 75,  407 => 74,  382 => 71,  378 => 69,  375 => 68,  369 => 67,  365 => 65,  357 => 62,  353 => 61,  350 => 60,  348 => 59,  341 => 57,  338 => 56,  336 => 55,  333 => 54,  312 => 53,  308 => 52,  304 => 51,  301 => 50,  299 => 49,  294 => 47,  290 => 46,  287 => 45,  285 => 44,  280 => 42,  276 => 41,  273 => 40,  271 => 39,  266 => 37,  262 => 35,  254 => 33,  251 => 32,  247 => 31,  243 => 29,  236 => 27,  233 => 26,  230 => 25,  208 => 24,  205 => 23,  183 => 22,  180 => 21,  177 => 20,  155 => 19,  153 => 18,  148 => 17,  146 => 16,  141 => 15,  137 => 14,  111 => 10,  87 => 8,  40 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "service_form.twig", "/home/mliadov/public_html/application/modules/services/views/flatty/service_form.twig");
    }
}
