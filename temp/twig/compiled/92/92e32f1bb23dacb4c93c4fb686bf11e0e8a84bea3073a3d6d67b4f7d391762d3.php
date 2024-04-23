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

/* helper_search_field_block.twig */
class __TwigTemplate_a0b138f4139aaa42f2dedcaea664114293447b9c9fdb06dbbe8edf1a21880ebb extends \Twig\Template
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
        $context["field_gid"] = $this->getAttribute($this->getAttribute(($context["field"] ?? null), "field", []), "gid", []);
        // line 2
        if ( !($context["field_name"] ?? null)) {
            // line 3
            echo "    ";
            $context["field_name"] = $this->getAttribute($this->getAttribute(($context["field"] ?? null), "field", []), "gid", []);
        }
        // line 5
        if (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field", []), "type", []) == "select")) {
            // line 6
            echo "    ";
            ob_start(function () { return ''; });
            // line 7
            echo "        ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("select_default"            ,"start"            ,            );
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
            // line 8
            echo "    ";
            $context["default_select_lang"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 9
            echo "    ";
            if (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "search_type", []) == "one")) {
                // line 10
                echo "        ";
                if (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "view_type", []) == "radio")) {
                    // line 11
                    echo "            ";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'radio';
                    $params = array(["input" =>                     // line 12
($context["field_name"] ?? null), "id" => (                    // line 13
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 14
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                    // line 15
($context["data"] ?? null), ($context["field_name"] ?? null)), "default" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 16
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", [])]                    ,                    );
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
                    echo "        ";
                } else {
                    // line 19
                    echo "            ";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'selectbox';
                    $params = array(["input" =>                     // line 20
($context["field_name"] ?? null), "id" => (                    // line 21
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 22
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                    // line 23
($context["data"] ?? null), ($context["field_name"] ?? null)), "default" =>                     // line 24
($context["default_select_lang"] ?? null), "is_multiple" => 0]                    ,                    );
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
                    echo "        ";
                }
                // line 28
                echo "    ";
            } else {
                // line 29
                echo "        ";
                if (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "view_type", []) == "multiselect")) {
                    // line 30
                    echo "            ";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'selectbox';
                    $params = array(["input" =>                     // line 31
($context["field_name"] ?? null), "id" => (                    // line 32
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 33
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                    // line 34
($context["data"] ?? null), ($context["field_name"] ?? null)), "default" =>                     // line 35
($context["default_select_lang"] ?? null), "is_multiple" => 1]                    ,                    );
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
                    echo "         ";
                } elseif (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "view_type", []) == "slider")) {
                    echo "  
            ";
                    // line 39
                    $context["field_gid_min"] = (($context["field_name"] ?? null) . "_min");
                    // line 40
                    echo "            ";
                    $context["field_gid_max"] = (($context["field_name"] ?? null) . "_max");
                    // line 41
                    echo "            ";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'slider';
                    $params = array(["id" => (                    // line 42
($context["field_name"] ?? null) . "_slider"), "min" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 43
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "min_val", []), "max" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 44
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "max_val", []), "value_min" => $this->getAttribute(                    // line 45
($context["data"] ?? null), ($context["field_gid_min"] ?? null)), "value_max" => $this->getAttribute(                    // line 46
($context["data"] ?? null), ($context["field_gid_max"] ?? null)), "field_name_min" => (                    // line 47
($context["field_name"] ?? null) . "_min"), "field_name_max" => (                    // line 48
($context["field_name"] ?? null) . "_max")]                    ,                    );
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
                    // line 50
                    echo "            <input type=\"text\" name=\"";
                    echo ($context["field_name"] ?? null);
                    echo "_min\" class=\"form-control\" value=\"";
                    echo $this->getAttribute(($context["data"] ?? null), ($context["field_gid_min"] ?? null));
                    echo "\" placeholder=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                    echo "\">
            &nbsp;-&nbsp;
            <input type=\"text\" name=\"";
                    // line 52
                    echo ($context["field_name"] ?? null);
                    echo "_max\" class=\"form-control\" value=\"";
                    echo $this->getAttribute(($context["data"] ?? null), ($context["field_gid_max"] ?? null));
                    echo "\" placeholder=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                    echo "\">
         ";
                } else {
                    // line 54
                    echo "             ";
                    if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "view_type", []) == "radio")) {
                        // line 55
                        echo "                ";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'radio';
                        $params = array(["input" =>                         // line 56
($context["field_name"] ?? null), "id" => (                        // line 57
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                        // line 58
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                        // line 59
($context["data"] ?? null), ($context["field_name"] ?? null)), "default" => $this->getAttribute($this->getAttribute($this->getAttribute(                        // line 60
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "empty_option", [])]                        ,                        );
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
                        // line 62
                        echo "            ";
                    } else {
                        // line 63
                        echo "                ";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'checkbox';
                        $params = array(["input" =>                         // line 64
($context["field_name"] ?? null), "id" => (                        // line 65
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                        // line 66
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                        // line 67
($context["data"] ?? null), ($context["field_name"] ?? null)), "group_methods" => 1]                        ,                        );
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
                        // line 70
                        echo "            ";
                    }
                    // line 71
                    echo "        ";
                }
                // line 72
                echo "    ";
            }
        } elseif (($this->getAttribute($this->getAttribute(        // line 73
($context["field"] ?? null), "field", []), "type", []) == "multiselect")) {
            // line 74
            echo "    ";
            if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "view_type", []) == "mselect")) {
                // line 75
                echo "        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("option_no_select"                ,"users"                ,                );
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
                $context['sb_default'] = $result;
                // line 76
                echo "        ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'selectbox';
                $params = array(["input" =>                 // line 77
($context["field_name"] ?? null), "id" => (                // line 78
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 79
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute(                // line 80
($context["data"] ?? null), ($context["field_name"] ?? null)), "is_multiple" => 1, "default" =>                 // line 82
($context["sb_default"] ?? null)]                ,                );
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
                // line 84
                echo "    ";
            } else {
                // line 85
                echo "        ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'checkbox';
                $params = array(["input" =>                 // line 86
($context["field_name"] ?? null), "id" => (                // line 87
($context["field_name"] ?? null) . "_select"), "value" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 88
($context["field"] ?? null), "field_content", []), "options", []), "option", []), "selected" => $this->getAttribute($this->getAttribute(                // line 89
($context["field"] ?? null), "field_content", []), "value", []), "group_methods" => 1]                ,                );
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
                // line 92
                echo "    ";
            }
        } elseif (($this->getAttribute($this->getAttribute(        // line 93
($context["field"] ?? null), "field", []), "type", []) == "text")) {
            // line 94
            echo "    ";
            if ((($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "search_type", []) == "number") && ($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "view_type", []) == "range"))) {
                // line 95
                echo "        ";
                $context["field_gid_min"] = (($context["field_name"] ?? null) . "_min");
                // line 96
                echo "        ";
                $context["field_gid_max"] = (($context["field_name"] ?? null) . "_max");
                // line 97
                echo "        <input type=\"text\" name=\"";
                echo ($context["field_name"] ?? null);
                echo "_min\" class=\"form-control\" value=\"";
                echo $this->getAttribute(($context["data"] ?? null), ($context["field_gid_min"] ?? null));
                echo "\" placeholder=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                echo "\">
        &nbsp;-&nbsp;
        <input type=\"text\" name=\"";
                // line 99
                echo ($context["field_name"] ?? null);
                echo "_max\" class=\"form-control\" value=\"";
                echo $this->getAttribute(($context["data"] ?? null), ($context["field_gid_max"] ?? null));
                echo "\" placeholder=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                echo "\">
    ";
            } elseif (($this->getAttribute($this->getAttribute(            // line 100
($context["field"] ?? null), "settings", []), "search_type", []) == "number")) {
                // line 101
                echo "        <input type=\"text\" name=\"";
                echo ($context["field_name"] ?? null);
                echo "\" class=\"form-control\" value=\"";
                echo $this->getAttribute(($context["data"] ?? null), ($context["field_name"] ?? null));
                echo "\"  placeholder=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                echo "\">
    ";
            } else {
                // line 103
                echo "        <input type=\"text\" name=\"";
                echo ($context["field_name"] ?? null);
                echo "\" value=\"";
                echo $this->getAttribute(($context["data"] ?? null), ($context["field_name"] ?? null));
                echo "\" class=\"form-control\" placeholder=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                echo "\">
    ";
            }
        } elseif (($this->getAttribute($this->getAttribute(        // line 105
($context["field"] ?? null), "field", []), "type", []) == "range")) {
            // line 106
            echo "    <div class=\"w200\">
        ";
            // line 107
            if (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "search_type", []) == "range")) {
                // line 108
                echo "            ";
                $context["field_gid_min"] = (($context["field_name"] ?? null) . "_min");
                // line 109
                echo "            ";
                $context["field_gid_max"] = (($context["field_name"] ?? null) . "_max");
                // line 110
                echo "            ";
                $module =                 null;
                $helper =                 'start';
                $name =                 'slider';
                $params = array(["id" => (                // line 111
($context["field_name"] ?? null) . "_slider"), "min" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 112
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "min_val", []), "max" => $this->getAttribute($this->getAttribute($this->getAttribute(                // line 113
($context["field"] ?? null), "field_content", []), "settings_data_array", []), "max_val", []), "value_min" => $this->getAttribute(                // line 114
($context["data"] ?? null), ($context["field_gid_min"] ?? null)), "value_max" => $this->getAttribute(                // line 115
($context["data"] ?? null), ($context["field_gid_max"] ?? null)), "field_name_min" => (                // line 116
($context["field_name"] ?? null) . "_min"), "field_name_max" => (                // line 117
($context["field_name"] ?? null) . "_max")]                ,                );
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
                // line 119
                echo "        ";
            } elseif (($this->getAttribute($this->getAttribute(($context["field"] ?? null), "settings", []), "search_type", []) == "number")) {
                // line 120
                echo "            ";
                $context["field_value"] = $this->getAttribute(($context["data"] ?? null), ($context["field_name"] ?? null));
                // line 121
                echo "            <input type=\"text\" name=\"";
                echo ($context["field_name"] ?? null);
                echo "\" class=\"form-control\" value=\"";
                echo twig_escape_filter($this->env, ($context["field_value"] ?? null));
                echo "\"  placeholder=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
                echo "\">
        ";
            }
            // line 123
            echo "    </div>
";
        } elseif (($this->getAttribute($this->getAttribute(        // line 124
($context["field"] ?? null), "field", []), "type", []) == "textarea")) {
            // line 125
            echo "    ";
            $context["field_value"] = $this->getAttribute(($context["data"] ?? null), ($context["field_name"] ?? null));
            // line 126
            echo "    <input type=\"text\" name=\"";
            echo ($context["field_name"] ?? null);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["field_value"] ?? null));
            echo "\"  placeholder=\"";
            echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", []);
            echo "\" class=\"form-control\">
";
        } elseif (($this->getAttribute($this->getAttribute(        // line 127
($context["field"] ?? null), "field", []), "type", []) == "checkbox")) {
            // line 128
            echo "    ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["field"] ?? null), "field_content", []), "settings_data_array", []), "default_value", [])) {
                // line 129
                echo "        ";
                $context["chbx_field_value"] = 1;
                // line 130
                echo "    ";
            } else {
                // line 131
                echo "        ";
                $context["chbx_field_value"] = 0;
                // line 132
                echo "    ";
            }
            // line 133
            echo "
    ";
            // line 134
            $module =             null;
            $helper =             'start';
            $name =             'checkbox';
            $params = array(["input" =>             // line 135
($context["field_name"] ?? null), "id" => (            // line 136
($context["field_name"] ?? null) . "_select"), "value" =>             // line 137
($context["chbx_field_value"] ?? null), "selected" => $this->getAttribute(            // line 138
($context["data"] ?? null), ($context["field_name"] ?? null))]            ,            );
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
        }
    }

    public function getTemplateName()
    {
        return "helper_search_field_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  532 => 138,  531 => 137,  530 => 136,  529 => 135,  525 => 134,  522 => 133,  519 => 132,  516 => 131,  513 => 130,  510 => 129,  507 => 128,  505 => 127,  496 => 126,  493 => 125,  491 => 124,  488 => 123,  478 => 121,  475 => 120,  472 => 119,  454 => 117,  453 => 116,  452 => 115,  451 => 114,  450 => 113,  449 => 112,  448 => 111,  443 => 110,  440 => 109,  437 => 108,  435 => 107,  432 => 106,  430 => 105,  420 => 103,  410 => 101,  408 => 100,  400 => 99,  390 => 97,  387 => 96,  384 => 95,  381 => 94,  379 => 93,  376 => 92,  358 => 89,  357 => 88,  356 => 87,  355 => 86,  350 => 85,  347 => 84,  329 => 82,  328 => 80,  327 => 79,  326 => 78,  325 => 77,  320 => 76,  298 => 75,  295 => 74,  293 => 73,  290 => 72,  287 => 71,  284 => 70,  266 => 67,  265 => 66,  264 => 65,  263 => 64,  258 => 63,  255 => 62,  237 => 60,  236 => 59,  235 => 58,  234 => 57,  233 => 56,  228 => 55,  225 => 54,  216 => 52,  206 => 50,  188 => 48,  187 => 47,  186 => 46,  185 => 45,  184 => 44,  183 => 43,  182 => 42,  177 => 41,  174 => 40,  172 => 39,  167 => 38,  149 => 35,  148 => 34,  147 => 33,  146 => 32,  145 => 31,  140 => 30,  137 => 29,  134 => 28,  131 => 27,  113 => 24,  112 => 23,  111 => 22,  110 => 21,  109 => 20,  104 => 19,  101 => 18,  83 => 16,  82 => 15,  81 => 14,  80 => 13,  79 => 12,  74 => 11,  71 => 10,  68 => 9,  65 => 8,  43 => 7,  40 => 6,  38 => 5,  34 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_search_field_block.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_search_field_block.twig");
    }
}
