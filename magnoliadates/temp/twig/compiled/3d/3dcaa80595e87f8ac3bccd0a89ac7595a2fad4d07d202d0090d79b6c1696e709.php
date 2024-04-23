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

/* edit_country_form.twig */
class __TwigTemplate_6b5ea7d64cb199e18679ebc2460887aa2464e1aada7ef53cc50f0a2ea97e93a9 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_country_form.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"x_panel\">
    <div class=\"x_title\">
        <h2>
        ";
        // line 6
        if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
            // line 7
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_header_countries_change"            ,"countries"            ,            );
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
            echo "        ";
        } else {
            // line 9
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_header_countries_add"            ,"countries"            ,            );
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
            // line 10
            echo "        ";
        }
        // line 11
        echo "        </h2>
        <div class=\"clearfix\"></div>
    </div>
    <div class=\"x_content\">
        <form method=\"post\" action=\"";
        // line 15
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" name=\"save_form\" enctype=\"multipart/form-data\"
              class=\"form-horizontal form-label-left\">
            <div class=\"form-group\">
                <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                    ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_code"        ,"countries"        ,        );
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
                <div  class=\"col-md-9 col-sm-9 col-xs-12\">
                    <input type=\"text\" value=\"";
        // line 22
        echo $this->getAttribute(($context["data"] ?? null), "code", []);
        echo "\" name=\"code\" class=\"form-control\">
                </div>
                <div class=\"clearfix\"></div>
            </div>
            <div class=\"form-group\">
                <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                    ";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_name"        ,"countries"        ,        );
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
                <div  class=\"col-md-9 col-sm-9 col-xs-12\">
                    <input type=\"hidden\" value=\"";
        // line 31
        echo $this->getAttribute(($context["data"] ?? null), "name", []);
        echo "\" name=\"name\" />
                    <input type=\"text\" name=\"langs[";
        // line 32
        echo ($context["cur_lang"] ?? null);
        echo "]\" class=\"form-control\"
                           value=\"";
        // line 33
        if (($context["validate_lang"] ?? null)) {
            echo $this->getAttribute(($context["validate_lang"] ?? null), ($context["cur_lang"] ?? null), [], "array");
        } else {
            echo $this->getAttribute(($context["data"] ?? null), "name", []);
        }
        echo "\" >
                </div>
                ";
        // line 35
        if ((($context["languages_count"] ?? null) > 1)) {
            // line 36
            echo "                    <div class=\"accordion col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\"
                         id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                        <div class=\"panel\">
                            <a class=\"panel-heading\" role=\"tab\" id=\"headingOne\" data-toggle=\"collapse\" data-parent=\"#accordion\"
                               href=\"#collapseOne\" aria-expanded=\"false\" aria-controls=\"collapseOne\">
                                <h4 class=\"panel-title\">";
            // line 41
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("others_languages"            ,"start"            ,            );
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
            echo "</h4>
                            </a>
                            <div id=\"collapseOne\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">
                                <div class=\"panel-body\">
                                    ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                // line 46
                echo "                                        ";
                if (($context["lang_id"] != ($context["cur_lang"] ?? null))) {
                    // line 47
                    echo "                                            <div class=\"form-group\">
                                                <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                    // line 48
                    echo $this->getAttribute($context["item"], "name", []);
                    echo "</label>
                                                <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                    <input type=\"text\" name=\"langs[";
                    // line 50
                    echo $context["lang_id"];
                    echo "]\" class=\"form-control\"
                                                           value=\"";
                    // line 51
                    if (($context["validate_lang"] ?? null)) {
                        echo $this->getAttribute(($context["validate_lang"] ?? null), $context["lang_id"]);
                    } else {
                        echo $this->getAttribute(($context["data"] ?? null), "name", []);
                    }
                    echo "\">
                                                </div>
                                            </div>
                                        ";
                }
                // line 55
                echo "                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                                </div>
                            </div>
                        </div>
                    </div>
                ";
        }
        // line 61
        echo "                <div class=\"clearfix\"></div>
            </div>
            <div class=\"ln_solid\"></div>
            <div class=\"form-group\">
                <div class=\"col-md-12 col-sm-12 col-xs-12 col-md-offset-3 col-sm-offset-3\">
                    <input type=\"submit\" name=\"btn_save\"  class=\"btn btn-success\"
                           value=\"";
        // line 67
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
                    <a class=\"btn btn-default cancel\" href=\"";
        // line 68
        echo ($context["site_url"] ?? null);
        echo "admin/countries\">
                        ";
        // line 69
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
        echo "                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class=\"clearfix\"></div>
<script>
    \$(function () {
        \$(\"div.row:odd\").addClass(\"zebra\");
    });
    function showLangs(divId) {
        \$('#' + divId).slideToggle();
    }
</script>
";
        // line 86
        $this->loadTemplate("@app/footer.twig", "edit_country_form.twig", 86)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_country_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  331 => 86,  313 => 70,  292 => 69,  288 => 68,  265 => 67,  257 => 61,  250 => 56,  244 => 55,  233 => 51,  229 => 50,  224 => 48,  221 => 47,  218 => 46,  214 => 45,  188 => 41,  181 => 36,  179 => 35,  170 => 33,  166 => 32,  162 => 31,  137 => 28,  128 => 22,  103 => 19,  96 => 15,  90 => 11,  87 => 10,  65 => 9,  62 => 8,  40 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_country_form.twig", "/home/mliadov/public_html/application/modules/countries/views/gentelella/edit_country_form.twig");
    }
}
