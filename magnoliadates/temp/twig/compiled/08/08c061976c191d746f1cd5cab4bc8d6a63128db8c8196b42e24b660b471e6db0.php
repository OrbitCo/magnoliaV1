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

/* custom_view_fields.twig */
class __TwigTemplate_6077714c478df3a9aee1ee47c906f14616be8442b11b619cd708292deeb31ded extends \Twig\Template
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
        foreach ($context['_seq'] as $context["key"] => $context["field"]) {
            // line 2
            echo "    <div class=\"field-block clearfix\" data-field=\"fe_";
            echo $context["key"];
            echo "\" ";
            if (($context["is_owner"] ?? null)) {
                echo "data-action=\"change-field\"";
            }
            echo ">
        <div class=\"field-name col-xs-4 col-sm-4 col-md-4 col-lg-4\">
            ";
            // line 4
            echo $this->getAttribute($context["field"], "name", []);
            echo ":
        </div>
        <div class=\"field-info col-xs-12 col-sm-8 col-md-8 col-lg-8\">
            ";
            // line 7
            if (($this->getAttribute($context["field"], "field_type", []) == "select")) {
                // line 8
                echo "                ";
                if ( !twig_test_empty($this->getAttribute($context["field"], "value", []))) {
                    // line 9
                    echo "                    ";
                    echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["field"], "value", []), "html", null, true));
                    echo "
                ";
                } else {
                    // line 11
                    echo "                    <p class=\"example-fields\">
                        ";
                    // line 12
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_add"                    ,"users"                    ,                    );
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
                    echo ": ";
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'usersFieldsExample';
                    $params = array(["field" => ("fe_" . ($context["key"] ?? null))]                    ,                    );
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
                    echo "                    </p>
                ";
                }
                // line 15
                echo "            ";
            } elseif (($this->getAttribute($context["field"], "field_type", []) == "textarea")) {
                // line 16
                echo "                ";
                if ( !twig_test_empty($this->getAttribute($context["field"], "value", []))) {
                    // line 17
                    echo "                    <span class=\"field-info_normal\">";
                    echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["field"], "value", []), "html", null, true));
                    echo "</span>
                ";
                } else {
                    // line 19
                    echo "                    <p class=\"example-fields\">
                        ";
                    // line 20
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_add"                    ,"users"                    ,                    );
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
                    echo ": ";
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'usersFieldsExample';
                    $params = array(["field" => ("fe_" . ($context["key"] ?? null))]                    ,                    );
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
                    echo "                    </p>
                ";
                }
                // line 23
                echo "            ";
            } elseif (($this->getAttribute($context["field"], "field_type", []) == "text")) {
                // line 24
                echo "                ";
                if ( !twig_test_empty($this->getAttribute($context["field"], "value", []))) {
                    // line 25
                    echo "                    ";
                    echo nl2br(twig_escape_filter($this->env, $this->getAttribute($context["field"], "value", []), "html", null, true));
                    echo "
                ";
                } else {
                    // line 27
                    echo "                    <p class=\"example-fields\">
                        ";
                    // line 28
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_add"                    ,"users"                    ,                    );
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
                    echo ": ";
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'usersFieldsExample';
                    $params = array(["field" => ("fe_" . ($context["key"] ?? null))]                    ,                    );
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
                    echo "                    </p>
                ";
                }
                // line 31
                echo "            ";
            } elseif (($this->getAttribute($context["field"], "field_type", []) == "range")) {
                // line 32
                echo "                ";
                if (( !twig_test_empty($this->getAttribute($context["field"], "value", [])) && ($this->getAttribute($context["field"], "value", []) != "0.00"))) {
                    // line 33
                    echo "                    ";
                    echo $this->getAttribute($context["field"], "value", []);
                    echo "
                ";
                } else {
                    // line 35
                    echo "                    -
                ";
                }
                // line 37
                echo "            ";
            } elseif (($this->getAttribute($context["field"], "field_type", []) == "multiselect")) {
                // line 38
                echo "                ";
                if ( !twig_test_empty($this->getAttribute($context["field"], "value", []))) {
                    // line 39
                    echo "                    ";
                    echo $this->getAttribute($context["field"], "value_str", []);
                    echo "
                ";
                } else {
                    // line 41
                    echo "                    <p class=\"example-fields\">
                        ";
                    // line 42
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_add"                    ,"users"                    ,                    );
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
                    echo ": ";
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'usersFieldsExample';
                    $params = array(["field" => ("fe_" . ($context["key"] ?? null))]                    ,                    );
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
                    echo "                    </p>
                ";
                }
                // line 45
                echo "            ";
            } elseif (($this->getAttribute($context["field"], "field_type", []) == "checkbox")) {
                // line 46
                echo "                ";
                if ( !twig_test_empty($this->getAttribute($context["field"], "value", []))) {
                    // line 47
                    echo "                    ";
                    if (($this->getAttribute($context["field"], "value", []) == "0")) {
                        // line 48
                        echo "                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("option_checkbox_no"                        ,"start"                        ,                        );
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
                        echo "                    ";
                    } else {
                        // line 50
                        echo "                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("option_checkbox_yes"                        ,"start"                        ,                        );
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
                        // line 51
                        echo "                    ";
                    }
                    // line 52
                    echo "                ";
                } else {
                    // line 53
                    echo "                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("option_checkbox_no"                    ,"start"                    ,                    );
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
                    echo "                ";
                }
                // line 55
                echo "            ";
            }
            // line 56
            echo "            ";
            if (($context["is_owner"] ?? null)) {
                echo "<i class=\"fas fa-pencil-alt\"></i>";
            }
            // line 57
            echo "        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "custom_view_fields.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  404 => 57,  399 => 56,  396 => 55,  393 => 54,  371 => 53,  368 => 52,  365 => 51,  343 => 50,  340 => 49,  318 => 48,  315 => 47,  312 => 46,  309 => 45,  305 => 43,  263 => 42,  260 => 41,  254 => 39,  251 => 38,  248 => 37,  244 => 35,  238 => 33,  235 => 32,  232 => 31,  228 => 29,  186 => 28,  183 => 27,  177 => 25,  174 => 24,  171 => 23,  167 => 21,  125 => 20,  122 => 19,  116 => 17,  113 => 16,  110 => 15,  106 => 13,  64 => 12,  61 => 11,  55 => 9,  52 => 8,  50 => 7,  44 => 4,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom_view_fields.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/custom_view_fields.twig");
    }
}
