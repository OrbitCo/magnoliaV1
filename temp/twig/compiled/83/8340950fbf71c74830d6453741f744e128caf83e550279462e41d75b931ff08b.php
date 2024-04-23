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

/* edit_site_map_form.twig */
class __TwigTemplate_4dd9dd80c087f87efd6473a4767ceafcf54b7fd234fe7977ef70011d4f956875 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_site_map_form.twig", 1)->display($context);
        // line 2
        echo "
<form class=\"x_panel form-horizontal\" method=\"post\" action=\"";
        // line 3
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" name=\"save_site_xml_form\">
    <div class=\"x_title h4\">";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_sitemap_txt_editing"        ,"seo_advanced"        ,        );
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
    <div class=\"x_content\">
        ";
        // line 6
        if ($this->getAttribute(($context["sitemap_data"] ?? null), "mtime", [])) {
            // line 7
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 9
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_last_sitemap_generating"            ,"seo_advanced"            ,            );
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
            echo ": </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                    ";
            // line 11
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["sitemap_data"] ?? null), "current_date", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            // line 12
            echo "                </div>
            </div>
        ";
        }
        // line 15
        echo "        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                ";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_frequency"        ,"seo_advanced"        ,        );
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
        echo ":&nbsp;* </label>
            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                <select name=\"changefreq\" class=\"form-control\">
                    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["frequency_lang"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 21
            echo "                        <option value=\"";
            echo $context["key"];
            echo "\" ";
            if (($context["key"] == ($context["sitemap_changefreq"] ?? null))) {
                echo "selected";
            }
            echo ">";
            echo $context["item"];
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "                </select>
            </div>
        </div>
        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                ";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_last_modified"        ,"seo_advanced"        ,        );
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
        echo ":&nbsp;* </label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                <input class=\"flat\" type=\"radio\" name=\"lastmod\" value=\"0\" id=\"lastmod0\" ";
        // line 30
        if ((($context["sitemap_lastmod"] ?? null) == 0)) {
            echo "checked";
        }
        echo "> <label for=\"lastmod0\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_last_modified_0"        ,"seo_advanced"        ,        );
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
                <input class=\"flat\" type=\"radio\" name=\"lastmod\" value=\"1\" id=\"lastmod1\" ";
        // line 31
        if ((($context["sitemap_lastmod"] ?? null) == 1)) {
            echo "checked";
        }
        echo "> <label for=\"lastmod1\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_last_modified_1"        ,"seo_advanced"        ,        );
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
                <input class=\"flat\" type=\"radio\" name=\"lastmod\" value=\"2\" id=\"lastmod2\" ";
        // line 32
        if ((($context["sitemap_lastmod"] ?? null) == 2)) {
            echo "checked";
        }
        echo "> <label for=\"lastmod2\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_last_modified_2"        ,"seo_advanced"        ,        );
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
                <input class=\"form-control\" type=\"text\" name=\"lastmod_date\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute(($context["sitemap_data"] ?? null), "current_date", []));
        echo "\">
            </div>
        </div>
        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                ";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_priority"        ,"seo_advanced"        ,        );
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
        echo ":&nbsp;* </label>
            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                <select name=\"priority\" class=\"form-control\">
                    <option value=\"0\" ";
        // line 41
        if ((($context["sitemap_priority"] ?? null) == 0)) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_priority_none"        ,"seo_advanced"        ,        );
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
                    <option value=\"1\" ";
        // line 42
        if ((($context["sitemap_priority"] ?? null) == 1)) {
            echo "selected";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_priority_auto"        ,"seo_advanced"        ,        );
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
                </select>
            </div>
        </div>
        <div class=\"row form-group\" id=\"add_priority\" ";
        // line 46
        if ((($context["sitemap_priority"] ?? null) == 1)) {
            echo "style=\"display: none;\"";
        }
        echo ">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                ";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_priority"        ,"seo_advanced"        ,        );
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
        echo ":&nbsp;* </label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["urls_modules"] ?? null));
        foreach ($context['_seq'] as $context["module"] => $context["module_data"]) {
            // line 51
            echo "                    ";
            if ( !twig_test_empty($context["module_data"])) {
                // line 52
                echo "                        <div>
                            <div>";
                // line 53
                echo $context["module"];
                echo ":</div>
                            <div>
                                ";
                // line 55
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["module_data"]);
                foreach ($context['_seq'] as $context["key"] => $context["url_data"]) {
                    // line 56
                    echo "                                    <div class=\"row\">
                                        <div class=\"col-sm-3 col-md-2 col-xs-12\">
                                            <input type=\"text\" name=\"priorities[";
                    // line 58
                    echo $context["module"];
                    echo "][";
                    echo $this->getAttribute($context["url_data"], "page", []);
                    echo "]\"
                                                   value=\"";
                    // line 59
                    echo $this->getAttribute($context["url_data"], "priority", []);
                    echo "\" class=\"form-control\">
                                        </div>
                                        <div class=\"col-xs-1\"> - </div>
                                        <div class=\"col-xs-8 col-md-9 col-xs-12\">";
                    // line 62
                    echo twig_replace_filter($this->getAttribute($context["url_data"], "url", []), [($context["site_url"] ?? null) => "/"]);
                    echo "</div>
                                    </div>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['url_data'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "                            </div>
                        </div>
                    ";
            }
            // line 68
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['module'], $context['module_data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "            </div>
        </div>
        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">&nbsp;</label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 74
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_sitemap_help"        ,"seo_advanced"        ,        );
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
        echo "            </div>
        </div>
        <div class=\"ln_solid\"></div>
        <div class=\"row form-group\">
            <div class=\"col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9 col-xs-12\">
                <input class=\"btn btn-success\" type=\"submit\" name=\"btn_save_sitexml\" value=\"";
        // line 80
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
                <a class=\"btn btn-default\" href=\"";
        // line 81
        echo ($context["site_url"] ?? null);
        echo "admin/seo_advanced\">";
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
        echo "</a>
            </div>
        </div>
    </div>
</form>
<div class=\"clearfix\"></div>
<script>
    \$(function () {
        \$('select[name=priority]').change(function () {
            var is_visible = \$(this).val();
            if (is_visible === '0') {
                \$('#add_priority').show();
            } else {
                \$('#add_priority').hide();
            }
        });
    });
</script>

";
        // line 100
        $this->loadTemplate("@app/footer.twig", "edit_site_map_form.twig", 100)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_site_map_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  556 => 100,  513 => 81,  490 => 80,  483 => 75,  462 => 74,  455 => 69,  449 => 68,  444 => 65,  435 => 62,  429 => 59,  423 => 58,  419 => 56,  415 => 55,  410 => 53,  407 => 52,  404 => 51,  400 => 50,  376 => 48,  369 => 46,  339 => 42,  312 => 41,  287 => 38,  279 => 33,  252 => 32,  225 => 31,  198 => 30,  174 => 28,  167 => 23,  152 => 21,  148 => 20,  123 => 17,  119 => 15,  114 => 12,  93 => 11,  69 => 9,  65 => 7,  63 => 6,  39 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_site_map_form.twig", "/home/mliadov/public_html/application/modules/seo_advanced/views/gentelella/edit_site_map_form.twig");
    }
}
