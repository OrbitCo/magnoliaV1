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

/* edit_form.twig */
class __TwigTemplate_902bbf471f7dbe13873cdd4e945bec0f16d95fffc67446611bb7f838760933b1 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_form.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        ";
        // line 5
        if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
            // line 6
            echo "            ";
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("seo_advanced"            ,            );
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
            $context['is_installed'] = $result;
            // line 7
            echo "            ";
            if ($this->getAttribute(($context["is_installed"] ?? null), "seo_advanced", [], "array")) {
                // line 8
                echo "                <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
                    <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                        <li class=\"";
                // line 10
                if ((($context["section_gid"] ?? null) == "text")) {
                    echo "active";
                }
                echo "\">
                            <a href=\"";
                // line 11
                echo ($context["site_url"] ?? null);
                echo "admin/content/edit/";
                echo ($context["current_lang"] ?? null);
                echo "/";
                echo ($context["parent_id"] ?? null);
                echo "/";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "/text\">
                                ";
                // line 12
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("filter_section_text"                ,"content"                ,                );
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
                echo "                            </a>
                        </li>
                        <li class=\"";
                // line 15
                if ((($context["section_gid"] ?? null) == "seo")) {
                    echo "active";
                }
                echo "\">
                            <a href=\"";
                // line 16
                echo ($context["site_url"] ?? null);
                echo "admin/content/edit/";
                echo ($context["current_lang"] ?? null);
                echo "/";
                echo ($context["parent_id"] ?? null);
                echo "/";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "/seo\">
                                ";
                // line 17
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("filter_section_seo"                ,"seo"                ,                );
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
                echo "                            </a>
                        </li>
                    </ul>
                </div>
            ";
            }
            // line 23
            echo "        ";
        }
        // line 24
        echo "

        ";
        // line 26
        if ((($context["section_gid"] ?? null) == "text")) {
            // line 27
            echo "            <div class='x_title'>
                <h2>
                    ";
            // line 29
            if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                // line 30
                echo "                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("admin_header_page_change"                ,"content"                ,                );
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
                // line 31
                echo "                    ";
            } else {
                // line 32
                echo "                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("admin_header_page_add"                ,"content"                ,                );
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
                // line 33
                echo "                    ";
            }
            // line 34
            echo "                </h2>
                <div class='clearfix'></div>
            </div>
            <div class='x_content'>
                <form method=\"post\" action=\"\" name=\"save_form\" enctype=\"multipart/form-data\" class=\"form-horizontal form-label-left\">
                    <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">

                        </label>
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">

                        </div>
                        <div class='clearfix'></div>
                    </div>


                    ";
            // line 50
            if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                // line 51
                echo "                        <div class=\"form-group\">    <!-- Link -->
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
                // line 53
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_view_link"                ,"content"                ,                );
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
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <label class=\"data-label\">
                                    <a href=\"";
                // line 57
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("content"                ,"view"                ,$this->getAttribute(($context["data"] ?? null), "gid", [])                ,                );
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
                // line 58
                $module =                 null;
                $helper =                 'seo';
                $name =                 'seolink';
                $params = array("content"                ,"view"                ,$this->getAttribute(($context["data"] ?? null), "gid", [])                ,                );
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
                // line 59
                echo "                                    </a>&nbsp;
                                </label>
                            </div>
                        </div>
                    ";
            }
            // line 64
            echo "                    <div class=\"form-group\">    <!-- Language -->
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
            // line 66
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_lang"            ,"content"            ,            );
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
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">
                            <select name=\"lang_id\" class=\"form-control\">
                                ";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 71
                echo "                                    <option ";
                if ((($this->getAttribute($context["item"], "id", []) == $this->getAttribute(($context["data"] ?? null), "lang_id", [])) || (($this->getAttribute($context["item"], "id", []) == ($context["current_lang"] ?? null)) &&  !$this->getAttribute(($context["data"] ?? null), "lang_id", [])))) {
                    // line 72
                    echo "                                                selected
                                            ";
                }
                // line 74
                echo "                                            value=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                        ";
                // line 75
                echo $this->getAttribute($context["item"], "name", []);
                echo "
                                    </option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            echo "                            </select>
                        </div>
                    </div>
                    <div class=\"form-group\">    <!-- Keyword -->
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
            // line 83
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_gid"            ,"content"            ,            );
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
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">
                            <input type=\"text\" value=\"";
            // line 86
            echo $this->getAttribute(($context["data"] ?? null), "gid", []);
            echo "\" name=\"gid\" class=\"form-control\">
                        </div>
                    </div>
                    <div class=\"form-group\">    <!-- Image -->
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
            // line 91
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_icon"            ,"content"            ,            );
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
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">
                            <input type=\"file\" name=\"page_icon\" class=\"form-control\">
                            ";
            // line 95
            if ($this->getAttribute(($context["data"] ?? null), "img", [])) {
                // line 96
                echo "                                <br><img src=\"";
                echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "img", []), "thumbs", []), "small", []);
                echo "\"  hspace=\"2\" vspace=\"2\"><br>
                                <input type=\"checkbox\" name=\"page_icon_delete\" value=\"1\" id=\"uichb\">
                                <label for=\"uichb\">
                                    ";
                // line 99
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_icon_delete"                ,"content"                ,                );
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
                // line 100
                echo "                                </label>
                            ";
            }
            // line 102
            echo "                        </div>
                    </div>
                    <div class=\"form-group\">    <!-- Title -->
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
            // line 106
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_title"            ,"content"            ,            );
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
            echo ":&nbsp;*
                        </label>
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">
                            ";
            // line 109
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                // line 110
                echo "                                ";
                $context["title"] = ("title_" . $context["lang_id"]);
                // line 111
                echo "                                    ";
                if (($context["lang_id"] == ($context["current_lang"] ?? null))) {
                    // line 112
                    echo "                                        <input type=\"text\" name=\"title[";
                    echo $context["lang_id"];
                    echo "]\"
                                       value=\"";
                    // line 113
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), ($context["title"] ?? null), [], "array"));
                    echo "\" lang-editor=\"value\" lang-editor-type=\"data-name\"
                                       lang-editor-lid=\"";
                    // line 114
                    echo $context["lang_id"];
                    echo "\" class=\"form-control\" />
                                    ";
                }
                // line 116
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            echo "                            <div class=\"accordion \" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                <div class=\"panel\">
                                    <a class=\"panel-heading\" role=\"tab\" id=\"headingOne\" data-toggle=\"collapse\"
                                       data-parent=\"#accordion\" href=\"#collapseOne\" aria-expanded=\"false\" aria-controls=\"collapseOne\">
                                        <h4 class=\"panel-title\">";
            // line 121
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
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                // line 126
                echo "                                                ";
                $context["title"] = ("title_" . $context["lang_id"]);
                // line 127
                echo "                                                ";
                if (($context["lang_id"] != ($context["current_lang"] ?? null))) {
                    // line 128
                    echo "                                                    <div class=\"form-group\">
                                                        <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                    // line 129
                    echo $this->getAttribute($context["lang_item"], "name", []);
                    echo "</label>
                                                        <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                            <input type=\"text\" name=\"title[";
                    // line 131
                    echo $context["lang_id"];
                    echo "]\" class=\"form-control\"
                                                                value=\"";
                    // line 132
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), ($context["title"] ?? null), [], "array"));
                    echo "\">
                                                        </div>
                                                    </div>
                                                ";
                }
                // line 136
                echo "                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 137
            echo "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"form-group\">    <!-- Annotation -->
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
            // line 145
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_annotation"            ,"content"            ,            );
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
            echo ":&nbsp;*
                        </label>
                        <div class=\"col-md-9 col-sm-9 col-xs-12\">
                            ";
            // line 148
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                // line 149
                echo "                                ";
                $context["annotation"] = ("annotation_" . $context["lang_id"]);
                // line 150
                echo "                                ";
                if (($context["lang_id"] == ($context["current_lang"] ?? null))) {
                    // line 151
                    echo "                                    <textarea name=\"annotation[";
                    echo $context["lang_id"];
                    echo "]\" rows=\"2\" cols=\"80\" class=\"form-control\"
                                              lang-editor=\"value\" lang-editor-type=\"data-annotation\"
                                              lang-editor-lid=\"";
                    // line 153
                    echo $context["lang_id"];
                    echo "\">";
                    ob_start(function () { return ''; });
                    // line 154
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), ($context["annotation"] ?? null), [], "array"));
                    echo "
                                    ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 155
                    echo "</textarea>
                                ";
                }
                // line 157
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 158
            echo "
                            <div class=\"accordion\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                <div class=\"panel\">
                                    <a class=\"panel-heading\" role=\"tab\" id=\"headingTwo\" data-toggle=\"collapse\"
                                       data-parent=\"#accordion\" href=\"#collapseTwo\" aria-expanded=\"false\" aria-controls=\"collapseTwo\">
                                        <h4 class=\"panel-title\">";
            // line 163
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
                                    <div id=\"collapseTwo\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingTwo\">
                                        <div class=\"panel-body\">
                                            ";
            // line 167
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                // line 168
                echo "                                                ";
                $context["annotation"] = ("annotation_" . $context["lang_id"]);
                // line 169
                echo "                                                ";
                if (($context["lang_id"] != ($context["current_lang"] ?? null))) {
                    // line 170
                    echo "                                                    <div class=\"form-group\">
                                                        <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                    // line 171
                    echo $this->getAttribute($context["lang_item"], "name", []);
                    echo "</label>
                                                        <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                            <textarea  name=\"annotation[";
                    // line 173
                    echo $context["lang_id"];
                    echo "]\" class=\"form-control\">";
                    ob_start(function () { return ''; });
                    // line 174
                    echo "                                                                ";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), ($context["annotation"] ?? null), [], "array"));
                    echo "
                                                            ";
                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                    // line 175
                    echo "</textarea>
                                                        </div>
                                                    </div>
                                                ";
                }
                // line 179
                echo "                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 180
            echo "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"form-group\">
                      <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 189
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_content"            ,"content"            ,            );
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
            echo "</label>
                      <div class=\"col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\">
                        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">

                          <ul id=\"info_lang\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                              ";
            // line 194
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                // line 195
                echo "                                  <li class = \"";
                if (($context["lang_id"] == ($context["current_lang"] ?? null))) {
                    echo "active";
                }
                echo "\"
                                      id=\"info_lang_";
                // line 196
                echo $context["lang_id"];
                echo "\">
                                      <a href=\"";
                // line 197
                echo ($context["site_url"] ?? null);
                echo "admin/content/edit/\" data-id=\"";
                echo $context["lang_id"];
                echo "\">";
                echo $this->getAttribute($context["item"], "name", []);
                echo "</a>
                                  </li>
                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 200
            echo "                          </ul>
                          <div id=\"info_content\">
                              ";
            // line 202
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                // line 203
                echo "                                  <div id=\"info_content_";
                echo $context["lang_id"];
                echo "\" class=\"info_content\"
                                       style=\"";
                // line 204
                if (($context["lang_id"] != ($context["current_lang"] ?? null))) {
                    echo "display: none;";
                }
                echo "\">
                                      ";
                // line 205
                echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "content_fck", []), $context["lang_id"]);
                echo "
                                  </div>
                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 208
            echo "                          </div>
                        </div>
                      </div>
                      <script>
                          \$(function(){
                              \$('#info_lang').find('li a').on('click', function(){
                                  var lang_id = \$(this).data('id');
                                  \$('#info_lang').find('li').removeClass('active');
                                  \$('#info_content').find('.info_content').hide();
                                  \$('#info_lang_'+lang_id).addClass('active');
                                  \$('#info_content_'+lang_id).show();
                                  return false;
                              });
                          });
                      </script>
                    </div>
                    <div class=\"ln_solid\"></div>
                    <div class=\"form-group\">
                        <div class=\"col-md-9 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-3\">
                            <button type=\"submit\" name=\"btn_save\" class=\"btn btn-success\" value=\"1\">
                                ";
            // line 228
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,            );
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
            echo "</button>
                            <a class=\"btn btn-default cancel\" href=\"";
            // line 229
            echo ($context["site_url"] ?? null);
            echo "admin/content/index/";
            echo ($context["current_lang"] ?? null);
            echo "\">
                                ";
            // line 230
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_cancel"            ,"start"            ,            );
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
            // line 231
            echo "                            </a>
                        </div>
                        <div class='clearfix'></div>
                    </div>
                </form>
            </div>

        ";
        } elseif ((        // line 238
($context["section_gid"] ?? null) == "seo")) {
            // line 239
            echo "            ";
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("seo_advanced"            ,            );
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
            $context['is_installed'] = $result;
            // line 240
            echo "            ";
            if ($this->getAttribute(($context["is_installed"] ?? null), "seo_advanced", [], "array")) {
                // line 241
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_fields"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["section"]) {
                    // line 242
                    echo "                    <form method=\"post\" action=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "action", []));
                    echo "\" name=\"seo_";
                    echo $this->getAttribute($context["section"], "gid", []);
                    echo "_form\"
                          enctype=\"multipart/form-data\" class=\"form-horizontal form-label-left\">
                        <div class=\"x_title\">
                            <h2>
                                ";
                    // line 246
                    echo $this->getAttribute($context["section"], "name", []);
                    echo "
                            </h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            ";
                    // line 251
                    if ($this->getAttribute($context["section"], "tooltip", [])) {
                        // line 252
                        echo "                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">&nbsp;</label>
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">";
                        // line 254
                        echo $this->getAttribute($context["section"], "tooltip", []);
                        echo "</div>
                                </div>
                            ";
                    }
                    // line 257
                    echo "                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["section"], "fields", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                        // line 258
                        echo "                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
                        // line 259
                        echo $this->getAttribute($context["field"], "name", []);
                        echo ": </label>
                                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                        ";
                        // line 261
                        $context["field_gid"] = $this->getAttribute($context["field"], "gid", []);
                        // line 262
                        echo "
                                        ";
                        // line 263
                        if (($this->getAttribute($context["field"], "type", []) == "checkbox")) {
                            // line 264
                            echo "                                            <input type=\"hidden\" name=\"";
                            echo $this->getAttribute($context["section"], "gid", []);
                            echo "[";
                            echo ($context["field_gid"] ?? null);
                            echo "]\" value=\"0\">
                                            <input type=\"checkbox\" name=\"";
                            // line 265
                            echo $this->getAttribute($context["section"], "gid", []);
                            echo "[";
                            echo ($context["field_gid"] ?? null);
                            echo "]\" value=\"1\"
                                                   ";
                            // line 266
                            if ($this->getAttribute(($context["seo_settings"] ?? null), ($context["field_gid"] ?? null), [], "array")) {
                                echo "checked";
                            }
                            // line 267
                            echo "                                                   class=\"flat\">

                                        ";
                        } elseif (($this->getAttribute(                        // line 269
$context["field"], "type", []) == "text")) {
                            // line 270
                            echo "                                            ";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                                // line 271
                                echo "                                                ";
                                $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                // line 272
                                echo "                                                ";
                                if (($context["lang_id"] == ($context["current_lang_id"] ?? null))) {
                                    // line 273
                                    echo "                                                    <input type=\"text\"
                                                       name=\"";
                                    // line 274
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\"
                                                       value=\"";
                                    // line 275
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), ($context["field_gid"] ?? null), [], "array"));
                                    echo "\"
                                                       lang-editor=\"value\" lang-editor-type=\"";
                                    // line 276
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "_";
                                    echo ($context["field_gid"] ?? null);
                                    echo "\"
                                                       lang-editor-lid=\"";
                                    // line 277
                                    echo $context["lang_id"];
                                    echo "\"
                                                       class=\"form-control\" >
                                                ";
                                }
                                // line 280
                                echo "                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 281
                            echo "                                            <div class=\"accordion\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                                <div class=\"panel\">
                                                    <a class=\"panel-heading\" role=\"tab\" id=\"heading";
                            // line 283
                            echo ($context["field_gid"] ?? null);
                            echo "\" data-toggle=\"collapse\"
                                                       data-parent=\"#accordion\" href=\"#collapse";
                            // line 284
                            echo ($context["field_gid"] ?? null);
                            echo "\" aria-expanded=\"false\"
                                                       aria-controls=\"collapse";
                            // line 285
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                                        <h4 class=\"panel-title\">";
                            // line 286
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("others_languages"                            ,"start"                            ,                            );
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
                                                    <div id=\"collapse";
                            // line 288
                            echo ($context["field_gid"] ?? null);
                            echo "\" class=\"panel-collapse collapse\" role=\"tabpanel\"
                                                         aria-labelledby=\"heading";
                            // line 289
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                                        <div class=\"panel-body\">
                                                            ";
                            // line 291
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                                // line 292
                                echo "                                                                ";
                                $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                // line 293
                                echo "                                                                ";
                                if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                                    // line 294
                                    echo "                                                                    <div class=\"form-group\">
                                                                        <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">
                                                                            ";
                                    // line 296
                                    echo $this->getAttribute($context["item"], "name", []);
                                    echo "
                                                                        </label>
                                                                        <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                                            <input type=\"text\"
                                                                                   name=\"";
                                    // line 300
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\" class=\"form-control\"
                                                                                   value=\"";
                                    // line 301
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), ($context["field_gid"] ?? null), [], "array"));
                                    echo "\">
                                                                        </div>
                                                                    </div>
                                                                ";
                                }
                                // line 305
                                echo "                                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 306
                            echo "                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        ";
                        } elseif (($this->getAttribute(                        // line 311
$context["field"], "type", []) == "textarea")) {
                            // line 312
                            echo "                                            ";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                                // line 313
                                echo "                                                ";
                                $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                // line 314
                                echo "                                                ";
                                if (($context["lang_id"] == ($context["current_lang_id"] ?? null))) {
                                    // line 315
                                    echo "                                                    <textarea name=\"";
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\"
                                                              rows=\"2\" cols=\"80\" class=\"form-control\" lang-editor=\"value\"
                                                              lang-editor-type=\"";
                                    // line 317
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "_";
                                    echo ($context["field_gid"] ?? null);
                                    echo "\"
                                                              lang-editor-lid=\"";
                                    // line 318
                                    echo $context["lang_id"];
                                    echo "\">";
                                    ob_start(function () { return ''; });
                                    // line 319
                                    echo "                                                        ";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), ($context["field_gid"] ?? null), [], "array"));
                                    echo "
                                                    ";
                                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                                    // line 320
                                    echo "</textarea>
                                                ";
                                }
                                // line 322
                                echo "                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 323
                            echo "
                                            <div class=\"accordion\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                                                <div class=\"panel\">
                                                    <a class=\"panel-heading\" role=\"tab\" id=\"heading";
                            // line 326
                            echo ($context["field_gid"] ?? null);
                            echo "\" data-toggle=\"collapse\"
                                                       data-parent=\"#accordion\" href=\"#collapse";
                            // line 327
                            echo ($context["field_gid"] ?? null);
                            echo "\"
                                                       aria-expanded=\"false\" aria-controls=\"collapse";
                            // line 328
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                                        <h4 class=\"panel-title\">";
                            // line 329
                            $module =                             null;
                            $helper =                             'lang';
                            $name =                             'l';
                            $params = array("others_languages"                            ,"start"                            ,                            );
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
                                                    <div id=\"collapse";
                            // line 331
                            echo ($context["field_gid"] ?? null);
                            echo "\" class=\"panel-collapse collapse\" role=\"tabpanel\"
                                                         aria-labelledby=\"heading";
                            // line 332
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                                        <div class=\"panel-body\">
                                                            ";
                            // line 334
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                                // line 335
                                echo "                                                                ";
                                $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                // line 336
                                echo "                                                                ";
                                if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                                    // line 337
                                    echo "                                                                    <div class=\"form-group\">
                                                                        <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">
                                                                            ";
                                    // line 339
                                    echo $this->getAttribute($context["item"], "name", []);
                                    echo "
                                                                        </label>
                                                                        <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                                            <!-- <input type=\"text\"> или <textarea> -->
                                                                            <textarea name=\"";
                                    // line 343
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\"
                                                                                      class=\"form-control\" rows=\"2\">";
                                    // line 344
                                    ob_start(function () { return ''; });
                                    // line 345
                                    echo "                                                                                ";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null), [], "array"), ($context["field_gid"] ?? null), [], "array"));
                                    echo "
                                                                            ";
                                    echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                                    // line 346
                                    echo "</textarea>
                                                                        </div>
                                                                    </div>
                                                                ";
                                }
                                // line 350
                                echo "                                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 351
                            echo "                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                        }
                        // line 356
                        echo "                                        ";
                        echo $this->getAttribute($context["field"], "tooltip", []);
                        echo "

                                    </div>
                                </div>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 361
                    echo "
                            ";
                    // line 390
                    echo "
                            <div class=\"ln_solid\"></div>

                            <div class=\"form-group\">
                                <div class=\"col-md-9 col-sm-9 col-xs-9 col-xs-12 col-md-offset-3 col-sm-offset-3\">
                                    <input type=\"submit\" name=\"btn_save_";
                    // line 395
                    echo $this->getAttribute($context["section"], "gid", []);
                    echo "\"  class=\"btn btn-success\"
                                            value=\"";
                    // line 396
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_save"                    ,"start"                    ,""                    ,"button"                    ,                    );
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
                    // line 397
                    echo ($context["site_url"] ?? null);
                    echo "admin/content/index/";
                    echo ($context["current_lang"] ?? null);
                    echo "\">
                                        ";
                    // line 398
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_cancel"                    ,"start"                    ,                    );
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
                    // line 399
                    echo "                                    </a>
                                </div>
                                <div class='clearfix'></div>
                            </div>
                            <input type=\"hidden\" name=\"btn_save\" value=\"1\">
                        </div>
                    </form>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['section'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 407
                echo "            ";
            }
            // line 408
            echo "        ";
        }
        // line 409
        echo "    </div>
</div>

";
        // line 412
        $this->loadTemplate("@app/footer.twig", "edit_form.twig", 412)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1423 => 412,  1418 => 409,  1415 => 408,  1412 => 407,  1399 => 399,  1378 => 398,  1372 => 397,  1349 => 396,  1345 => 395,  1338 => 390,  1335 => 361,  1323 => 356,  1316 => 351,  1310 => 350,  1304 => 346,  1298 => 345,  1296 => 344,  1288 => 343,  1281 => 339,  1277 => 337,  1274 => 336,  1271 => 335,  1267 => 334,  1262 => 332,  1258 => 331,  1234 => 329,  1230 => 328,  1226 => 327,  1222 => 326,  1217 => 323,  1211 => 322,  1207 => 320,  1201 => 319,  1197 => 318,  1191 => 317,  1181 => 315,  1178 => 314,  1175 => 313,  1170 => 312,  1168 => 311,  1161 => 306,  1155 => 305,  1148 => 301,  1140 => 300,  1133 => 296,  1129 => 294,  1126 => 293,  1123 => 292,  1119 => 291,  1114 => 289,  1110 => 288,  1086 => 286,  1082 => 285,  1078 => 284,  1074 => 283,  1070 => 281,  1064 => 280,  1058 => 277,  1052 => 276,  1048 => 275,  1040 => 274,  1037 => 273,  1034 => 272,  1031 => 271,  1026 => 270,  1024 => 269,  1020 => 267,  1016 => 266,  1010 => 265,  1003 => 264,  1001 => 263,  998 => 262,  996 => 261,  991 => 259,  988 => 258,  983 => 257,  977 => 254,  973 => 252,  971 => 251,  963 => 246,  953 => 242,  948 => 241,  945 => 240,  923 => 239,  921 => 238,  912 => 231,  891 => 230,  885 => 229,  862 => 228,  840 => 208,  831 => 205,  825 => 204,  820 => 203,  816 => 202,  812 => 200,  799 => 197,  795 => 196,  788 => 195,  784 => 194,  757 => 189,  746 => 180,  740 => 179,  734 => 175,  728 => 174,  724 => 173,  719 => 171,  716 => 170,  713 => 169,  710 => 168,  706 => 167,  680 => 163,  673 => 158,  667 => 157,  663 => 155,  657 => 154,  653 => 153,  647 => 151,  644 => 150,  641 => 149,  637 => 148,  612 => 145,  602 => 137,  596 => 136,  589 => 132,  585 => 131,  580 => 129,  577 => 128,  574 => 127,  571 => 126,  567 => 125,  541 => 121,  535 => 117,  529 => 116,  524 => 114,  520 => 113,  515 => 112,  512 => 111,  509 => 110,  505 => 109,  480 => 106,  474 => 102,  470 => 100,  449 => 99,  442 => 96,  440 => 95,  414 => 91,  406 => 86,  381 => 83,  374 => 78,  365 => 75,  360 => 74,  356 => 72,  353 => 71,  349 => 70,  323 => 66,  319 => 64,  312 => 59,  291 => 58,  268 => 57,  242 => 53,  238 => 51,  236 => 50,  218 => 34,  215 => 33,  193 => 32,  190 => 31,  168 => 30,  166 => 29,  162 => 27,  160 => 26,  156 => 24,  153 => 23,  146 => 18,  125 => 17,  115 => 16,  109 => 15,  105 => 13,  84 => 12,  74 => 11,  68 => 10,  64 => 8,  61 => 7,  39 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_form.twig", "/home/mliadov/public_html/application/modules/content/views/gentelella/edit_form.twig");
    }
}
