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

/* custom/custom_form_fields.twig */
class __TwigTemplate_cbd30fc684957f63c2568da85a93509b0c2035e91cdfbec118c75e303041708e extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fields_data"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    ";
            $context["field_gid"] = $this->getAttribute($context["item"], "gid", []);
            // line 3
            echo "    ";
            if ( !$this->getAttribute(($context["not_editable_fields"] ?? null), ($context["field_gid"] ?? null))) {
                // line 4
                echo "        <div class=\"form-group clearfix\">
            <label for=\"\" class=\"col-xs-12 tali\">
                ";
                // line 6
                echo $this->getAttribute($context["item"], "name", []);
                echo ":
            </label>
            <div class=\"col-xs-12\" id=\"field-";
                // line 8
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\">
                ";
                // line 9
                if (($this->getAttribute($context["item"], "field_type", []) == "select")) {
                    // line 10
                    echo "                    ";
                    if (($this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "view_type", []) == "select")) {
                        // line 11
                        echo "                    <select name=\"";
                        echo $this->getAttribute($context["item"], "field_name", []);
                        echo "\" class=\"form-control ";
                        if (($context["register_form"] ?? null)) {
                            echo "input-lg";
                        }
                        echo "\">
                        ";
                        // line 12
                        if ($this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "empty_option", [])) {
                            // line 13
                            echo "                            <option value=\"0\" ";
                            if ((($context["value"] ?? null) == 0)) {
                                echo "selected";
                            }
                            echo ">";
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("option_no_select"                            ,"users"                            ,                            );
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
                            echo "</option>
                        ";
                        }
                        // line 15
                        echo "                        ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "options", []), "option", []));
                        foreach ($context['_seq'] as $context["value"] => $context["option"]) {
                            // line 16
                            echo "                            <option value=\"";
                            echo twig_escape_filter($this->env, $context["value"]);
                            echo "\" ";
                            if (($context["value"] == $this->getAttribute($context["item"], "value", []))) {
                                echo "selected";
                            }
                            echo ">";
                            echo $context["option"];
                            echo "</option>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['value'], $context['option'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 18
                        echo "                    </select>
                ";
                    } else {
                        // line 20
                        echo "                    ";
                        if ($this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "empty_option", [])) {
                            // line 21
                            echo "                        <input type=\"radio\" name=\"";
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "\" value=\"0\" id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "field_name", []));
                            echo "_0\" ";
                            if ((($context["value"] ?? null) == 0)) {
                                echo "checked";
                            }
                            echo ">
                        <label for=\"";
                            // line 22
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_0\">";
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("option_no_select"                            ,"users"                            ,                            );
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
                            echo "</label><br>
                    ";
                        }
                        // line 24
                        echo "                    ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "options", []), "option", []));
                        foreach ($context['_seq'] as $context["value"] => $context["option"]) {
                            // line 25
                            echo "                        <input type=\"radio\" name=\"";
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "\" value=\"";
                            echo twig_escape_filter($this->env, $context["value"]);
                            echo "\" id=\"";
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_";
                            echo $context["value"];
                            echo "\" ";
                            if (($context["value"] == $this->getAttribute($context["item"], "value", []))) {
                                echo "checked";
                            }
                            echo ">
                        <label for=\"";
                            // line 26
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_";
                            echo $context["value"];
                            echo "\">";
                            echo $context["option"];
                            echo "</label><br>
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['value'], $context['option'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 28
                        echo "                ";
                    }
                    // line 29
                    echo "            ";
                } elseif (($this->getAttribute($context["item"], "field_type", []) == "multiselect")) {
                    // line 30
                    echo "                ";
                    if (twig_test_empty($this->getAttribute($context["item"], "value", []))) {
                        // line 31
                        echo "                    ";
                        $context["item_value"] = $this->getAttribute(($context["data"] ?? null), $this->getAttribute($context["item"], "field_name", []), [], "array");
                        // line 32
                        echo "                ";
                    } else {
                        // line 33
                        echo "                    ";
                        $context["item_value"] = $this->getAttribute($context["item"], "value", []);
                        // line 34
                        echo "                ";
                    }
                    // line 35
                    echo "                ";
                    if (($this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "view_type", []) == "mselect")) {
                        // line 36
                        echo "                <select name=\"";
                        echo $this->getAttribute($context["item"], "field_name", []);
                        echo "[]\" multiple  class=\"form-control ";
                        if (($context["register_form"] ?? null)) {
                            echo "input-lg";
                        }
                        echo "\">
                    ";
                        // line 37
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "options", []), "option", []));
                        foreach ($context['_seq'] as $context["value"] => $context["option"]) {
                            // line 38
                            echo "                        <option value=\"";
                            echo twig_escape_filter($this->env, $context["value"]);
                            echo "\" ";
                            $module =                             null;
                            $helper =                             'utils';
                            $name =                             'inArray';
                            $params = array(($context["value"] ?? null)                            ,($context["item_value"] ?? null)                            ,"selected"                            ,                            );
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
                            echo " id=\"";
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_";
                            echo $context["value"];
                            echo "\">";
                            echo $context["option"];
                            echo "</option>
                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['value'], $context['option'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 40
                        echo "                </select>
                <a href=\"#\" class=\"select-link\">
                    ";
                        // line 42
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("select_all"                        ,"start"                        ,                        );
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
                        echo "                </a>

                &nbsp;|&nbsp;

                <a href=\"#\" class=\"unselect-link\">
                    ";
                        // line 48
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("unselect_all"                        ,"start"                        ,                        );
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
                        echo "                </a>
            ";
                    } else {
                        // line 51
                        echo "                ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["item"], "options", []), "option", []));
                        foreach ($context['_seq'] as $context["value"] => $context["option"]) {
                            // line 52
                            echo "                    <div class=\"chbx\">
                        <input type=\"checkbox\" name=\"";
                            // line 53
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "[]\" value=\"";
                            echo twig_escape_filter($this->env, $context["value"]);
                            echo "\" ";
                            $module =                             null;
                            $helper =                             'utils';
                            $name =                             'inArray';
                            $params = array(($context["value"] ?? null)                            ,($context["item_value"] ?? null)                            ,"checked"                            ,                            );
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
                            echo " id=\"";
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_";
                            echo $context["value"];
                            echo "\">
                        <label for=\"";
                            // line 54
                            echo $this->getAttribute($context["item"], "field_name", []);
                            echo "_";
                            echo $context["value"];
                            echo "\">";
                            echo $context["option"];
                            echo "</label>
                    </div>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['value'], $context['option'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 57
                        echo "                <div class=\"clr\"></div>
                <a href=\"#\" class=\"select-link\">
                    ";
                        // line 59
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("select_all"                        ,"start"                        ,                        );
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
                        // line 60
                        echo "                </a>

                &nbsp;|&nbsp;

                <a href=\"#\" class=\"unselect-link\">
                    ";
                        // line 65
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("unselect_all"                        ,"start"                        ,                        );
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
                        // line 66
                        echo "                </a>
            ";
                    }
                    // line 68
                    echo "            ";
                } elseif (($this->getAttribute($context["item"], "field_type", []) == "text")) {
                    // line 69
                    echo "                <input type=\"text\" name=\"";
                    echo $this->getAttribute($context["item"], "field_name", []);
                    echo "\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "value", []));
                    echo "\"
                       maxlength=\"";
                    // line 70
                    echo $this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "max_char", []);
                    echo "\"
                       ";
                    // line 71
                    if (($this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "max_char", []) < 11)) {
                        // line 72
                        echo "                           class=\"short form-control ";
                        if (($context["register_form"] ?? null)) {
                            echo "input-lg";
                        }
                        echo "\"
                       ";
                    } elseif (($this->getAttribute($this->getAttribute(                    // line 73
$context["item"], "settings_data_array", []), "max_char", []) > 1100)) {
                        // line 74
                        echo "                           class=\"long\"
                       ";
                    }
                    // line 75
                    echo " placeholder=\"";
                    echo $this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "default_value", []);
                    echo "\">
                ";
                } elseif (($this->getAttribute(                // line 76
$context["item"], "field_type", []) == "range")) {
                    // line 77
                    echo "                    <div>
                        ";
                    // line 78
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'slider';
                    $params = array(["id" => ($this->getAttribute(                    // line 79
($context["item"] ?? null), "field_name", []) . "_slider"), "single" => 1, "active_always" => 1, "min" => $this->getAttribute($this->getAttribute(                    // line 82
($context["item"] ?? null), "settings_data_array", []), "min_val", []), "max" => $this->getAttribute($this->getAttribute(                    // line 83
($context["item"] ?? null), "settings_data_array", []), "max_val", []), "value" => $this->getAttribute(                    // line 84
($context["item"] ?? null), "value", []), "field_name" => $this->getAttribute(                    // line 85
($context["item"] ?? null), "field_name", [])]                    ,                    );
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
                    // line 87
                    echo "                    </div>
                ";
                } elseif (($this->getAttribute(                // line 88
$context["item"], "field_type", []) == "textarea")) {
                    // line 89
                    echo "                    <textarea name=\"";
                    echo $this->getAttribute($context["item"], "field_name", []);
                    echo "\" class=\"form-control ";
                    if (($context["register_form"] ?? null)) {
                        echo "input-lg";
                    }
                    echo "\" placeholder=\"";
                    echo $this->getAttribute($this->getAttribute($context["item"], "settings_data_array", []), "default_value", []);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "value", []));
                    echo "</textarea>
                ";
                } elseif (($this->getAttribute(                // line 90
$context["item"], "field_type", []) == "checkbox")) {
                    // line 91
                    echo "                    <input type=\"checkbox\" name=\"";
                    echo $this->getAttribute($context["item"], "field_name", []);
                    echo "\" value=\"1\" ";
                    if (($this->getAttribute($context["item"], "value", []) == "1")) {
                        echo "checked";
                    }
                    echo ">
                ";
                }
                // line 93
                echo "            </div>
        </div>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo "<script>
    function setchbx(fid, status) {
        if (status) {
            \$('#' + fid).find('input[type=checkbox]').prop('checked', true);
        } else {
            \$('#' + fid).find('input[type=checkbox]').prop('checked', false);
        }
    }
    function  setmsel(fid, status) {
        if (status) {
            \$('#' + fid).find('option').prop('selected', true);
        } else {
            \$('#' + fid).find('option').prop('selected', false);
        }
    }
    \$(function () {
        \$('.select-link').unbind('click').bind('click', function () {
            setchbx(\$(this).parent().attr('id'), 1);
            setmsel(\$(this).parent().attr('id'), 1);
            return false;
        });
        \$('.unselect-link').unbind('click').bind('click', function () {
            setchbx(\$(this).parent().attr('id'), 0);
            setmsel(\$(this).parent().attr('id'), 0);
            return false;
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "custom/custom_form_fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  537 => 97,  528 => 93,  518 => 91,  516 => 90,  503 => 89,  501 => 88,  498 => 87,  480 => 85,  479 => 84,  478 => 83,  477 => 82,  476 => 79,  472 => 78,  469 => 77,  467 => 76,  462 => 75,  458 => 74,  456 => 73,  449 => 72,  447 => 71,  443 => 70,  436 => 69,  433 => 68,  429 => 66,  408 => 65,  401 => 60,  380 => 59,  376 => 57,  363 => 54,  332 => 53,  329 => 52,  324 => 51,  320 => 49,  299 => 48,  292 => 43,  271 => 42,  267 => 40,  231 => 38,  227 => 37,  218 => 36,  215 => 35,  212 => 34,  209 => 33,  206 => 32,  203 => 31,  200 => 30,  197 => 29,  194 => 28,  182 => 26,  167 => 25,  162 => 24,  136 => 22,  125 => 21,  122 => 20,  118 => 18,  103 => 16,  98 => 15,  69 => 13,  67 => 12,  58 => 11,  55 => 10,  53 => 9,  49 => 8,  44 => 6,  40 => 4,  37 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom/custom_form_fields.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\custom\\custom_form_fields.twig");
    }
}
