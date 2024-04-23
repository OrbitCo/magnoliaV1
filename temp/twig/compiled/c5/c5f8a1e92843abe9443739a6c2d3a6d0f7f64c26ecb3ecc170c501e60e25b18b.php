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

/* ajax_service_form.twig */
class __TwigTemplate_e8ada35803e4c51bbfca0f2113df51af92caac91ed4f26e8d7dcea3ba34b3ce5 extends \Twig\Template
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
    <div class=\"inside\">
        <form method=\"post\" action=\"";
        // line 3
        echo ($context["site_url"] ?? null);
        echo "services/form/";
        echo $this->getAttribute(($context["data"] ?? null), "gid", []);
        echo "\" id=\"service_buy_form\">
            <input type=\"hidden\" id=\"payment_method\" name=\"\" value=\"1\">
            <div class=\"service-payment-form\">
                <h1>
                    ";
        // line 7
        if (($this->getAttribute(($context["data"] ?? null), "price", []) > 0)) {
            // line 8
            echo "                      ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_buy_service"            ,"services"            ,            );
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
            // line 9
            echo "                    ";
        } else {
            // line 10
            echo "                      ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_apply_service"            ,"services"            ,            );
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
            // line 11
            echo "                    ";
        }
        // line 12
        echo "                    &nbsp;&laquo;";
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
        echo "&raquo;
                </h1>

                <div class=\"service-description clearfix pointer\" data-action=\"show-more\">
                    <div class=\"service-title\">
                        <div class=\"col-xs-10\">
                            <div>";
        // line 18
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
                            <div class=\"service-description-teaser\">
                                ";
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array($this->getAttribute(($context["data"] ?? null), "description_lang_gid", [])        ,"services"        ,        );
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
        echo "                            </div>
                        </div>
                        <div class=\"col-xs-2\">
                            <div class=\"pull-right\">
                                ";
        // line 25
        if (($this->getAttribute(($context["data"] ?? null), "price", []) > 0)) {
            // line 26
            echo "                                    ";
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
            // line 27
            echo "                                ";
        } else {
            // line 28
            echo "                                    ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("free"            ,"services"            ,            );
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
            // line 29
            echo "                                ";
        }
        // line 30
        echo "                            </div>
                        </div>
                    </div>
                    <div class=\"col-xs-12\">
                        ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "data_admin_array", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 35
            echo "                            <div>";
            echo $this->getAttribute($context["item"], "name", []);
            echo ":
                                ";
            // line 36
            if (((($this->getAttribute($context["item"], "type", []) == "string") || ($this->getAttribute($context["item"], "type", []) == "int")) || ($this->getAttribute($context["item"], "type", []) == "text"))) {
                // line 37
                echo "                                    ";
                echo $this->getAttribute($context["item"], "value", []);
                echo "
                                ";
            } elseif (($this->getAttribute(            // line 38
$context["item"], "type", []) == "price")) {
                // line 39
                echo "                                    ";
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
                // line 40
                echo "                                ";
            } elseif (($this->getAttribute($context["item"], "type", []) == "checkbox")) {
                // line 41
                echo "                                    ";
                if (($this->getAttribute($context["item"], "value", []) == "1")) {
                    // line 42
                    echo "                                        ";
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
                    // line 43
                    echo "                                    ";
                } else {
                    // line 44
                    echo "                                        ";
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
                    // line 45
                    echo "                                    ";
                }
                // line 46
                echo "                                ";
            }
            // line 47
            echo "                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "                    </div>
                    <table>
                        ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "data_user_array", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 52
            echo "                            ";
            if (($this->getAttribute($context["item"], "type", []) == "hidden")) {
                // line 53
                echo "                                <input type=\"hidden\" name=\"data_user[";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "]\" value=\"";
                echo $this->getAttribute($context["item"], "value", []);
                echo "\">
                            ";
            } else {
                // line 55
                echo "                                <tr>
                                    <td>
                                        ";
                // line 57
                echo $this->getAttribute($context["item"], "name", []);
                echo ":
                                    </td>
                                    ";
                // line 59
                if (($this->getAttribute($context["item"], "type", []) == "string")) {
                    // line 60
                    echo "                                        <td class=\"value\">
                                            <input type=\"text\" value=\"";
                    // line 61
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                                   name=\"data_user[";
                    // line 62
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\">
                                        </td>
                                    ";
                } elseif (($this->getAttribute(                // line 64
$context["item"], "type", []) == "int")) {
                    // line 65
                    echo "                                        <td class=\"value\">
                                            <input type=\"text\" value=\"";
                    // line 66
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                                   name=\"data_user[";
                    // line 67
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\" class=\"short\">
                                        </td>
                                    ";
                } elseif (($this->getAttribute(                // line 69
$context["item"], "type", []) == "price")) {
                    // line 70
                    echo "                                        <td class=\"value\">
                                            <input type=\"text\" value=\"";
                    // line 71
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "\"
                                                   name=\"data_user[";
                    // line 72
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\" class=\"short\">
                                            ";
                    // line 73
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
                    // line 74
                    echo "                                        </td>
                                    ";
                } elseif (($this->getAttribute(                // line 75
$context["item"], "type", []) == "text")) {
                    // line 76
                    echo "                                        <td class=\"value\"class=\"value\">
                                            <textarea name=\"data_user[";
                    // line 77
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\">";
                    echo $this->getAttribute($context["item"], "value", []);
                    echo "</textarea>
                                        </td>
                                    ";
                } elseif (($this->getAttribute(                // line 79
$context["item"], "type", []) == "checkbox")) {
                    // line 80
                    echo "                                        <td class=\"value\">
                                            <input type=\"checkbox\" name=\"data_user[";
                    // line 81
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "]\"
                                                value=\"1\" ";
                    // line 82
                    if (($this->getAttribute($context["item"], "value", []) == "1")) {
                        echo "checked";
                    }
                    echo ">
                                        </td>
                                    ";
                }
                // line 85
                echo "                                </tr>
                            ";
            }
            // line 87
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "                        ";
        if (($this->getAttribute($this->getAttribute(($context["data"] ?? null), "template", []), "price_type", []) == "2")) {
            // line 89
            echo "                            <tr>
                                <td>
                                    ";
            // line 91
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
            // line 94
            echo $this->getAttribute(($context["data"] ?? null), "price", []);
            echo "\" name=\"price\" class=\"short\">
                                    <b>";
            // line 95
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
        } elseif (($this->getAttribute($this->getAttribute(        // line 98
($context["data"] ?? null), "template", []), "price_type", []) == "3")) {
            // line 99
            echo "                            <tr>
                                <td>
                                    ";
            // line 101
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
            // line 104
            echo $this->getAttribute(($context["data"] ?? null), "price", []);
            echo "\" name=\"price\" class=\"short\">
                                    <b>";
            // line 105
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
        // line 109
        echo "                    </table>
                </div>
            </div>
            <div class=\"service-payment-form\">

                ";
        // line 114
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
        // line 115
        echo "
                ";
        // line 116
        if ($this->getAttribute(($context["data"] ?? null), "free_activate", [])) {
            // line 117
            echo "                    <div class=\"mtb20\">
                        <input data-pjax=\"0\" type=\"submit\"  class=\"btn btn-primary\"  name=\"btn_account\" value=\"";
            // line 118
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
            echo "\" id=\"btn-apply-service\">
                    </div>
                    <input type=\"hidden\" value=\"1\" name=\"activate_immediately\" />
                    ";
            // line 121
            if (($this->getAttribute(($context["data"] ?? null), "gid", []) == "ability_delete")) {
                // line 122
                echo "                    <script>
                      \$(function() {
                        \$('#btn-apply-service').trigger('click');
                      });
                    </script>
                    ";
            }
            // line 128
            echo "                ";
        } else {
            // line 129
            echo "                    <input type=\"hidden\" value=\"1\" name=\"activate_immediately\" />
                    ";
            // line 130
            if ((($this->getAttribute(($context["data"] ?? null), "price", []) > 0) && $this->getAttribute(($context["data"] ?? null), "user_account", []))) {
                // line 131
                echo "                        <div class=\"pt10\">
                            ";
                // line 132
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
                // line 133
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
                // line 134
                echo "                            ";
                if ($this->getAttribute(($context["data"] ?? null), "disable_account_pay", [])) {
                    // line 135
                    echo "                                <br>";
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
                    // line 136
                    echo "                            ";
                }
                // line 137
                echo "                        </div>
                    ";
            }
            // line 139
            echo "                    ";
            if (((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 1) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2)) && ($context["is_module_installed"] ?? null))) {
                // line 140
                echo "                        <div class=\"mtb10 btn-group\">
                            ";
                // line 141
                if ($this->getAttribute(($context["data"] ?? null), "disable_account_pay", [])) {
                    // line 142
                    echo "                                <button class=\"btn btn-primary\" type=\"button\" data-action=\"set-payment-system\">
                                    ";
                    // line 143
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
                    // line 144
                    echo "                                </button>
                            ";
                } else {
                    // line 146
                    echo "                                <button class=\"btn btn-primary\" type=\"button\" id=\"btn_account\">
                                    ";
                    // line 147
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
                    // line 148
                    echo "                                </button>
                            ";
                }
                // line 150
                echo "                        </div>
                    ";
            }
            // line 152
            echo "                    ";
            if ((((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 1) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2)) && ($context["is_module_installed"] ?? null)) && (($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 3)))) {
                // line 153
                echo "                        <span class=\"mtb10 mlr10\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("add_founds_or"                ,"services"                ,                );
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
                echo "</span>
                    ";
            }
            // line 155
            echo "                    ";
            if ((($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 2) || ($this->getAttribute(($context["data"] ?? null), "pay_type", []) == 3))) {
                // line 156
                echo "                        <div class=\"mtb10 btn-group\">
                            <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                ";
                // line 158
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_direct_payment"                ,"services"                ,                );
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
                echo " <span class=\"caret\"></span>
                            </button>
                            <ul class=\"dropdown-menu\">
                                <input type=\"hidden\" id=\"system_gid\" name=\"system_gid\" value=\"\">
                                ";
                // line 162
                if (($context["billing_systems"] ?? null)) {
                    // line 163
                    echo "                                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["billing_systems"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 164
                        echo "                                            <li data-gid=\"";
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "\">
                                                <a data-pjax=\"0\" data-pjax-container=\"#pjaxcontainer\" href=\"javascript:void(0)\" class=\"btn_system\" data-payment-gid=\"";
                        // line 165
                        echo $this->getAttribute($context["item"], "gid", []);
                        echo "\">
                                                    <img src=\"";
                        // line 166
                        echo $this->getAttribute($context["item"], "logo_url", []);
                        echo "\" class=\"h50\">
                                                    ";
                        // line 167
                        echo $this->getAttribute($context["item"], "name", []);
                        echo "
                                                </a>
                                            </li>
                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 171
                    echo "                                ";
                }
                // line 172
                echo "                            </ul>
                        </div>
                    ";
            }
            // line 175
            echo "                ";
        }
        // line 176
        echo "            </div>
        </form>
        <script>
            \$(function(){
                loadScripts(
                    [\"";
        // line 181
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
        <script>
            \$(function() {
                \$('[data-action=\"show-more\"]').on('mouseover mouseout', function(e) {
                    e.preventDefault();
                    if (\$('.service-description-teaser').hasClass('open')) {
                        \$('.service-description-teaser').removeClass('open');
                    } else {
                        \$('.service-description-teaser').addClass('open');
                    }
                })
            });
        </script>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ajax_service_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  928 => 181,  921 => 176,  918 => 175,  913 => 172,  910 => 171,  900 => 167,  896 => 166,  892 => 165,  887 => 164,  882 => 163,  880 => 162,  854 => 158,  850 => 156,  847 => 155,  822 => 153,  819 => 152,  815 => 150,  811 => 148,  790 => 147,  787 => 146,  783 => 144,  762 => 143,  759 => 142,  757 => 141,  754 => 140,  751 => 139,  747 => 137,  744 => 136,  722 => 135,  719 => 134,  698 => 133,  675 => 132,  672 => 131,  670 => 130,  667 => 129,  664 => 128,  656 => 122,  654 => 121,  629 => 118,  626 => 117,  624 => 116,  621 => 115,  600 => 114,  593 => 109,  567 => 105,  563 => 104,  538 => 101,  534 => 99,  532 => 98,  507 => 95,  503 => 94,  478 => 91,  474 => 89,  471 => 88,  465 => 87,  461 => 85,  453 => 82,  449 => 81,  446 => 80,  444 => 79,  437 => 77,  434 => 76,  432 => 75,  429 => 74,  408 => 73,  404 => 72,  400 => 71,  397 => 70,  395 => 69,  390 => 67,  386 => 66,  383 => 65,  381 => 64,  376 => 62,  372 => 61,  369 => 60,  367 => 59,  362 => 57,  358 => 55,  350 => 53,  347 => 52,  343 => 51,  339 => 49,  332 => 47,  329 => 46,  326 => 45,  304 => 44,  301 => 43,  279 => 42,  276 => 41,  273 => 40,  251 => 39,  249 => 38,  244 => 37,  242 => 36,  237 => 35,  233 => 34,  227 => 30,  224 => 29,  202 => 28,  199 => 27,  177 => 26,  175 => 25,  169 => 21,  148 => 20,  124 => 18,  95 => 12,  92 => 11,  70 => 10,  67 => 9,  45 => 8,  43 => 7,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_service_form.twig", "/home/mliadov/public_html/application/modules/services/views/flatty/ajax_service_form.twig");
    }
}
