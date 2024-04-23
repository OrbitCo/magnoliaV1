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

/* default_edit_form.twig */
class __TwigTemplate_b1b248ac1ba5bf7a89efae00653a60458ed184d087ae51b27eb32cd89c52c187 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "default_edit_form.twig", 1)->display($context);
        // line 2
        echo "<form class=\"x_panel form-horizontal\" method=\"post\" action=\"";
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" name=\"save_form\">
    <div class=\"x_title h4\">
        ";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_global_seo_settings_editing"        ,"seo"        ,        );
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
        echo " :
        ";
        // line 5
        if ((($context["controller"] ?? null) == "admin")) {
            // line 6
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("default_seo_admin_field"            ,"seo"            ,            );
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
            // line 7
            echo "        ";
        } else {
            // line 8
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("default_seo_user_field"            ,"seo"            ,            );
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
            echo "        ";
        }
        // line 10
        echo "    </div>
    <div class=\"x_content\">
        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_title_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_title"        ,"seo"        ,        );
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
        ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 19
            echo "            ";
            $context["section_gid"] = ("meta_" . $context["key"]);
            // line 20
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 22
            echo $this->getAttribute($context["item"], "name", []);
            echo ": </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <input type=\"text\" name=\"title[";
            // line 24
            echo $context["key"];
            echo "]\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "title", []));
            echo "\"
                           class=\"form-control\">
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_keyword_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 35
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_keyword"        ,"seo"        ,        );
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
        ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 38
            echo "            ";
            $context["section_gid"] = ("meta_" . $context["key"]);
            // line 39
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 41
            echo $this->getAttribute($context["item"], "name", []);
            echo ": </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <textarea name=\"keyword[";
            // line 43
            echo $context["key"];
            echo "]\" rows=\"5\" cols=\"80\"
                              class=\"form-control\">";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "keyword", []));
            echo "</textarea>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 52
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 54
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_description"        ,"seo"        ,        );
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
        ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 57
            echo "            ";
            $context["section_gid"] = ("meta_" . $context["key"]);
            // line 58
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 60
            echo $this->getAttribute($context["item"], "name", []);
            echo ": </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <textarea name=\"description[";
            // line 62
            echo $context["key"];
            echo "]\" rows=\"5\" cols=\"80\"
                              class=\"form-control\">";
            // line 63
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "description", []));
            echo "</textarea>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 71
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_section_og"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 73
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_og"        ,"seo"        ,        );
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
        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 79
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_og_title_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 81
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_og_title"        ,"seo"        ,        );
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
        ";
        // line 83
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 84
            echo "            ";
            $context["section_gid"] = ("og_" . $context["key"]);
            // line 85
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 87
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_og_title"            ,"seo"            ,            );
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
            echo "(";
            echo $this->getAttribute($context["item"], "name", []);
            echo "): </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <input type=\"text\" name=\"og_title[";
            // line 89
            echo $context["key"];
            echo "]\" class=\"form-control\"
                           value=\"";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "og_title", []));
            echo "\">
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 98
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_og_type_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 100
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_og_type"        ,"seo"        ,        );
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
        ";
        // line 102
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 103
            echo "            ";
            $context["section_gid"] = ("og_" . $context["key"]);
            // line 104
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 106
            echo $this->getAttribute($context["item"], "name", []);
            echo ": </label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <input type=\"text\" name=\"og_type[";
            // line 108
            echo $context["key"];
            echo "]\" class=\"form-control\"
                           value=\"";
            // line 109
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "og_type", []));
            echo "\"></div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        echo "        <br>

        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                <b>";
        // line 116
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_og_description_default"        ,"seo"        ,        );
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
        echo "</b></label>
            <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                ";
        // line 118
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_help_og_description"        ,"seo"        ,        );
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
        ";
        // line 120
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 121
            echo "            ";
            $context["section_gid"] = ("og_" . $context["key"]);
            // line 122
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 124
            echo $this->getAttribute($context["item"], "name", []);
            echo ":</label>
                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                    <textarea name=\"og_description[";
            // line 126
            echo $context["key"];
            echo "]\" rows=\"5\" cols=\"80\"
                              class=\"form-control\">";
            // line 127
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "og_description", []));
            echo "</textarea>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 131
        echo "        <br>

        ";
        // line 133
        if ((($context["controller"] ?? null) == "user")) {
            // line 134
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    <b>";
            // line 136
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_header_default"            ,"seo"            ,            );
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
            echo "</b></label>
                <div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
                    ";
            // line 138
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_help_header"            ,"seo"            ,            );
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
            ";
            // line 140
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 141
                echo "                ";
                $context["section_gid"] = ("meta_" . $context["key"]);
                // line 142
                echo "                <div class=\"row form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
                // line 143
                echo $this->getAttribute($context["item"], "name", []);
                echo ": </label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"text\" name=\"header[";
                // line 145
                echo $context["key"];
                echo "]\" class=\"form-control\"
                               value=\"";
                // line 146
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["user_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), "header", []));
                echo "\">
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 149
            echo "            
            <br>
        ";
        }
        // line 152
        echo "
        <div class=\"row form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                ";
        // line 155
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_lang_in_url"        ,"seo"        ,        );
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
                <input class=\"flat\" type=\"checkbox\" value=\"1\" name=\"lang_in_url\"
                       ";
        // line 158
        if ($this->getAttribute(($context["user_settings"] ?? null), "lang_in_url", [])) {
            echo "checked";
        }
        echo " id=\"lang_in_url\">
            </div>
        </div>
        ";
        // line 161
        if ((($context["controller"] ?? null) == "user")) {
            // line 162
            echo "            <div class=\"row form-group\">
                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                    ";
            // line 164
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_lang_canonical"            ,"seo"            ,            );
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
                    <input type=\"hidden\" name=\"lang_canonical\" value=\"0\">
                    <input class=\"flat\" type=\"checkbox\" name=\"lang_canonical\" value=\"1\"
                           ";
            // line 168
            if ($this->getAttribute(($context["user_settings"] ?? null), "lang_canonical", [])) {
                echo "checked";
            }
            echo ">
                </div>
            </div>
        ";
        }
        // line 172
        echo "        <div class=\"ln_solid\"></div>
        <div class=\"row form-group\">
            <div class=\"col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9 col-xs-12\">
                <input onclick=\"";
        // line 175
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,(("btn_edit_" . ($context["controller"] ?? null)) . "_save")        ,        );
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
        echo "\" class=\"btn btn-success\" type=\"submit\" name=\"btn_save\" value=\"";
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
                <a onclick=\"";
        // line 176
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("seo"        ,(("btn_edit_" . ($context["controller"] ?? null)) . "_cancel")        ,        );
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
        echo "\" class=\"btn btn-default\" href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/seo/index\">";
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

";
        // line 182
        $this->loadTemplate("@app/footer.twig", "default_edit_form.twig", 182)->display($context);
    }

    public function getTemplateName()
    {
        return "default_edit_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  959 => 182,  908 => 176,  864 => 175,  859 => 172,  850 => 168,  824 => 164,  820 => 162,  818 => 161,  810 => 158,  785 => 155,  780 => 152,  775 => 149,  765 => 146,  761 => 145,  756 => 143,  753 => 142,  750 => 141,  746 => 140,  722 => 138,  698 => 136,  694 => 134,  692 => 133,  688 => 131,  678 => 127,  674 => 126,  669 => 124,  665 => 122,  662 => 121,  658 => 120,  634 => 118,  610 => 116,  604 => 112,  595 => 109,  591 => 108,  586 => 106,  582 => 104,  579 => 103,  575 => 102,  551 => 100,  527 => 98,  521 => 94,  511 => 90,  507 => 89,  481 => 87,  477 => 85,  474 => 84,  470 => 83,  446 => 81,  422 => 79,  394 => 73,  370 => 71,  364 => 67,  354 => 63,  350 => 62,  345 => 60,  341 => 58,  338 => 57,  334 => 56,  310 => 54,  286 => 52,  280 => 48,  270 => 44,  266 => 43,  261 => 41,  257 => 39,  254 => 38,  250 => 37,  226 => 35,  202 => 33,  196 => 29,  183 => 24,  178 => 22,  174 => 20,  171 => 19,  167 => 18,  143 => 16,  119 => 14,  113 => 10,  110 => 9,  88 => 8,  85 => 7,  63 => 6,  61 => 5,  38 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "default_edit_form.twig", "/home/mliadov/public_html/application/modules/seo/views/gentelella/default_edit_form.twig");
    }
}
