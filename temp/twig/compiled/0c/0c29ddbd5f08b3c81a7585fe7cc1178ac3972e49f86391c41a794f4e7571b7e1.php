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
class __TwigTemplate_54c8456430e7d00dd0c7d2f3ddfaf99ce0f19e64c1e5b9165f7d8376a2d18dbf extends \Twig\Template
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
        // line 6
        if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
            // line 7
            echo "        ";
            ob_start(function () { return ''; });
            ob_start(function () { return ''; });
            // line 8
            echo "            ";
            if (($context["sections"] ?? null)) {
                // line 9
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                    // line 10
                    echo "                <li";
                    if (($this->getAttribute($context["item"], "gid", []) == ($context["section"] ?? null))) {
                        echo " class=\"active\"";
                    }
                    echo ">
                    <a href=\"";
                    // line 11
                    echo ($context["site_url"] ?? null);
                    echo "admin/users/edit/";
                    echo $this->getAttribute($context["item"], "gid", []);
                    echo "/";
                    echo $this->getAttribute(($context["data"] ?? null), "id", []);
                    echo "\">
                        ";
                    // line 12
                    echo $this->getAttribute($context["item"], "name", []);
                    echo "
                    </a>
                </li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 16
                echo "            ";
            }
            // line 17
            echo "            ";
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("seo_advanced"            ,"media"            ,            );
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
            $context['is_module_installed'] = $result;
            // line 18
            echo "            ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "seo_advanced", [])) {
                // line 19
                echo "                <li";
                if ((($context["section"] ?? null) == "seo")) {
                    echo " class=\"active\"";
                }
                echo ">
                    <a href=\"";
                // line 20
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/seo/";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\">
                        ";
                // line 21
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
                // line 22
                echo "                    </a>
                </li>
            ";
            }
            // line 25
            echo "            ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "media", [])) {
                // line 26
                echo "                <li>
                    <a href=\"";
                // line 27
                echo ($context["site_url"] ?? null);
                echo "admin/media/user_media/";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\">
                        ";
                // line 28
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("filter_section_uploads"                ,"media"                ,                );
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
                echo "                    </a>
                </li>
            ";
            }
            // line 32
            echo "        ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            $context["user_menu"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 33
            echo "        ";
            if (($context["user_menu"] ?? null)) {
                // line 34
                echo "        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                <li";
                // line 36
                if ((($context["section"] ?? null) == "personal")) {
                    echo " class=\"active\"";
                }
                echo ">
                    <a href=\"";
                // line 37
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\">
                        ";
                // line 38
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("table_header_personal"                ,"users"                ,                );
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
                // line 39
                echo "                    </a>
                </li>
                ";
                // line 41
                echo ($context["user_menu"] ?? null);
                echo "
            </ul>
            &nbsp;
        </div>
        ";
            }
            // line 46
            echo "    ";
        }
        // line 47
        echo "        <div class=\"x_content\">
    ";
        // line 48
        if ((($context["section"] ?? null) == "personal")) {
            // line 49
            echo "        <form action=\"";
            echo $this->getAttribute(($context["data"] ?? null), "action", []);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" name=\"save_form\"
            data-parsley-validate class=\"form-horizontal form-label-left\">
                ";
            // line 52
            echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 54
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_user_type"            ,"users"            ,            );
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
            echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div id=\"gender\" class=\"btn-group\" data-toggle=\"buttons\">
                            ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_types"] ?? null), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 58
                echo "                            <label class=\"btn btn-default";
                if (($context["key"] == $this->getAttribute(($context["data"] ?? null), "user_type", []))) {
                    echo " active";
                }
                echo "\"
                                data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                <input type=\"radio\" name=\"user_type\" value=\"";
                // line 60
                echo $context["key"];
                echo "\"";
                if (($context["key"] == $this->getAttribute(($context["data"] ?? null), "user_type", []))) {
                    echo " checked";
                }
                echo ">";
                echo $context["item"];
                echo "
                            </label>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "                        </div>
                    </div>
                </div>
                ";
            // line 67
            echo "
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 70
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_looking_user_type"            ,"users"            ,            );
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
            echo ":</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div id=\"gender\" class=\"btn-group\" data-toggle=\"buttons\">
                            ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_types"] ?? null), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 74
                echo "                            <label class=\"btn btn-default";
                if (($context["key"] == $this->getAttribute(($context["data"] ?? null), "looking_user_type", []))) {
                    echo " active";
                }
                echo "\"
                                data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                <input type=\"radio\" name=\"looking_user_type\" value=\"";
                // line 76
                echo $context["key"];
                echo "\"";
                if (($context["key"] == $this->getAttribute(($context["data"] ?? null), "looking_user_type", []))) {
                    echo " checked";
                }
                echo ">";
                echo $context["item"];
                echo "
                            </label>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "                        </div>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 84
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_partner_age"            ,"users"            ,            );
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
            echo ":</label>
                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                        <select class=\"form-control\" name=\"age_min\">
                            ";
            // line 87
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["age_range"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["age"]) {
                // line 88
                echo "                            <option value=\"";
                echo $context["age"];
                echo "\"";
                if (($context["age"] == $this->getAttribute(($context["data"] ?? null), "age_min", []))) {
                    echo " selected";
                }
                echo ">
                                ";
                // line 89
                echo $context["age"];
                echo "
                            </option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['age'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "                        </select>
                    </div>
                    <div class=\"col-md-1 col-sm-1 col-xs-12 text-center\">
                        <span class=\"form-control-box\">";
            // line 95
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("to"            ,"users"            ,            );
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
                    </div>
                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                        <select class=\"form-control\" name=\"age_max\">
                            ";
            // line 99
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["age_range"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["age"]) {
                // line 100
                echo "                            <option value=\"";
                echo $context["age"];
                echo "\"";
                if (($context["age"] == $this->getAttribute(($context["data"] ?? null), "age_max", []))) {
                    echo " selected";
                }
                echo ">
                                ";
                // line 101
                echo $context["age"];
                echo "
                            </option>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['age'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            echo "                        </select>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 109
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_email"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"email\" name=\"email\" value=\"";
            // line 111
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "email", []));
            echo "\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 116
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_nickname"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "nickname", []));
            echo "\" name=\"nickname\" class=\"form-control\">
                    </div>
                </div>
                ";
            // line 121
            if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                // line 122
                echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
                // line 124
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_change_password"                ,"users"                ,                );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"checkbox\" value=\"1\" name=\"update_password\" id=\"pass_change_field\" class=\"flat\">
                    </div>
                </div>
                ";
            }
            // line 130
            echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 132
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_password"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"password\" value=\"\" name=\"password\" id=\"pass_field\"";
            // line 134
            if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                echo "disabled";
            }
            echo " class=\"form-control\">
                    </div>
                </div>
                ";
            // line 137
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["use_repassword"] ?? null)])) {
                // line 138
                echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
                // line 140
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_repassword"                ,"users"                ,                );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"password\" value=\"\" name=\"repassword\" id=\"repass_field\"";
                // line 142
                if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                    echo "disabled";
                }
                echo " class=\"form-control\">
                    </div>
                </div>
                ";
            }
            // line 146
            echo "                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 148
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_fname"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
            // line 150
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "fname", []));
            echo "\" name=\"fname\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 155
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_sname"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
            // line 157
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "sname", []));
            echo "\" name=\"sname\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 162
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_icon"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <input type=\"file\" value=\"";
            // line 164
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "sname", []));
            echo "\" name=\"user_icon\" class=\"btn btn-default\">
                        ";
            // line 165
            if (($this->getAttribute(($context["data"] ?? null), "user_logo", []) || $this->getAttribute(($context["data"] ?? null), "user_logo_moderation", []))) {
                // line 166
                echo "                            <br><input type=\"checkbox\" name=\"user_icon_delete\" value=\"1\" id=\"uichb\" class=\"flat\">
                            <label for=\"uichb\">";
                // line 167
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_icon_delete"                ,"users"                ,                );
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
                // line 168
                if ($this->getAttribute(($context["data"] ?? null), "user_logo_moderation", [])) {
                    // line 169
                    echo "                                <img src=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo_moderation", []), "thumbs", []), "middle", []);
                    echo "\" data-click=\"view-media\"  data-id-media=\"";
                    echo $this->getAttribute(($context["data"] ?? null), "id", []);
                    echo "\" data-user-id=\"";
                    echo $this->getAttribute(($context["data"] ?? null), "id", []);
                    echo "\">
                            ";
                } else {
                    // line 171
                    echo "                                <img src=\"";
                    echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "media", []), "user_logo", []), "thumbs", []), "middle", []);
                    echo "\" data-click=\"view-media\"  data-id-media=\"";
                    echo $this->getAttribute(($context["data"] ?? null), "id", []);
                    echo "\" data-user-id=\"";
                    echo $this->getAttribute(($context["data"] ?? null), "id", []);
                    echo "\">
                            ";
                }
                // line 173
                echo "                            <div>
                                <a data-click=\"view-media\" id=\"logo_";
                // line 174
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\"  data-id-media=\"";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\" data-user-id=\"";
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "\">
                                    ";
                // line 175
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("edit_object"                ,"moderation"                ,                );
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
                // line 176
                echo "                                </a>
                                <script>
                                    \$(function () {
                                        loadScripts(
                                                \"";
                // line 180
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
                echo "\",
                                                function () {
                                                    user_avatar_";
                // line 182
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo " = new UsersAvatar({
                                                        site_url: site_url,
                                                        load_avatar_url: 'admin/users/ajax_load_avatar/',
                                                        recrop_url: 'admin/users/ajax_recrop_avatar/',
                                                        rotateUrl: 'admin/users/photoRotate/',
                                                        id_user: '";
                // line 187
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "',
                                                        saveAfterSelect: false,
                                                        haveAvatar: false,
                                                        userType: 'admin',
                                                        photo_id: 'logo_";
                // line 191
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "'
                                                    });
                                                },
                                                'user_avatar_";
                // line 194
                echo $this->getAttribute(($context["data"] ?? null), "id", []);
                echo "',
                                                {async: false}
                                        );
                                    });
                                </script>
                            </div>
                        ";
            }
            // line 201
            echo "                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 205
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("birth_date"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        ";
            // line 207
            if ($this->getAttribute(($context["data"] ?? null), "birth_date_hidden", [])) {
                // line 208
                echo "                            ";
                $context["birth_date_hidden"] = $this->getAttribute(($context["data"] ?? null), "birth_date_hidden", []);
                // line 209
                echo "                        ";
            } else {
                // line 210
                echo "                             ";
                $context["birth_date_hidden"] = ($context["min_date"] ?? null);
                // line 211
                echo "                        ";
            }
            // line 212
            echo "                        ";
            $module =             null;
            $helper =             'start';
            $name =             'getCalendarInput';
            $params = array("birth_date"            ,($context["birth_date_hidden"] ?? null)            ,["id" => "birth_date", "year_range" => ["min" =>  -80, "max" =>  -18]]            ,            );
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
            // line 213
            echo "                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                        ";
            // line 217
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_region"            ,"users"            ,            );
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
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        ";
            // line 219
            $module =             null;
            $helper =             'countries';
            $name =             'locationSelect';
            $params = array(["select_type" => "city", "id_country" => $this->getAttribute(            // line 221
($context["data"] ?? null), "id_country", []), "id_region" => $this->getAttribute(            // line 222
($context["data"] ?? null), "id_region", []), "id_city" => $this->getAttribute(            // line 223
($context["data"] ?? null), "id_city", []), "lat" => $this->getAttribute(            // line 224
($context["data"] ?? null), "lat", []), "lon" => $this->getAttribute(            // line 225
($context["data"] ?? null), "lon", []), "var_country_name" => "id_country", "var_region_name" => "id_region", "var_city_name" => "id_city", "var_lat_name" => "lat", "var_lon_name" => "lon"]            ,            );
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
            // line 232
            echo "                    </div>
                </div>
                ";
            // line 234
            $module =             null;
            $helper =             'utils';
            $name =             'depends';
            $params = array("geomap"            ,            );
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
            $context['is_module_installed'] = $result;
            // line 235
            echo "                ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "geomap", [])) {
                // line 236
                echo "                    ";
                $module =                 null;
                $helper =                 'geomap';
                $name =                 'geomap_load_geocoder';
                $params = array(                );
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
                // line 237
                echo "                ";
            }
            // line 238
            echo "                <script type=\"text/javascript\">
                    \$(function() {
                        loadScripts(
                            [\"";
            // line 241
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("users"            ,"users-map.js"            ,"path"            ,            );
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
                            function() {
                                users_map = new usersMap({
                                    siteUrl: site_url,
                                });
                            },
                            ['users_map'],
                            {async: true}
                        );
                    });
                </script>
                ";
            // line 252
            if ($this->getAttribute(($context["data"] ?? null), "id", [])) {
                // line 253
                echo "                    ";
                if ($this->getAttribute(($context["data"] ?? null), "confirm", [])) {
                    // line 254
                    echo "                        <input type=\"hidden\" name=\"confirm\" value=\"1\">
                    ";
                } else {
                    // line 256
                    echo "                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
                    // line 258
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("field_confirm"                    ,"users"                    ,                    );
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
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <input type=\"checkbox\" value=\"1\" name=\"confirm\" class=\"flat\">
                            </div>
                        </div>
                    ";
                }
                // line 264
                echo "                ";
            }
            // line 265
            echo "
                <div class=\"ln_solid\"></div>

                <div class=\"form-group\">
                    <div class=\"col-md-9 col-sm-9 col-xs-12 col-sm-offset-3\">
                        <button type=\"submit\" name=\"btn_save\" class=\"btn btn-success\" value=\"1\">
                            ";
            // line 271
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
                        <a class=\"btn btn-default\" href=\"";
            // line 272
            echo ($context["site_url"] ?? null);
            echo "admin/users\">
                            ";
            // line 273
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
            echo "</a>

                        ";
            // line 275
            $module =             null;
            $helper =             'users';
            $name =             'delete_select_block';
            $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "deleted" => 0, "class" => "btn btn-primary"]            ,            );
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
            // line 276
            echo "
                    </div>
                </div>
            </form>
            <div class=\"clearfix\"></div>
    ";
        } elseif ((        // line 281
($context["section"] ?? null) == "seo")) {
            // line 282
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
            $context['is_module_installed'] = $result;
            // line 283
            echo "            ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "seo_advanced", [])) {
                // line 284
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_fields"] ?? null));
                foreach ($context['_seq'] as $context["key"] => $context["section"]) {
                    // line 285
                    echo "                    <form method=\"post\" action=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "action", []));
                    echo "\" name=\"seo_";
                    echo $this->getAttribute($context["section"], "gid", []);
                    echo "_form\"
                        data-parsley-validate class=\"form-horizontal form-label-left\">
                        <br>
                        <h3>";
                    // line 288
                    echo $this->getAttribute($context["section"], "name", []);
                    echo "</h3>

                        ";
                    // line 290
                    if ($this->getAttribute($context["section"], "tooltip", [])) {
                        // line 291
                        echo "                            <p>";
                        echo $this->getAttribute($context["section"], "tooltip", []);
                        echo "</p>
                        ";
                    }
                    // line 293
                    echo "
                        ";
                    // line 294
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["section"], "fields", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                        // line 295
                        echo "                            <div class=\"form-group\">

                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                    ";
                        // line 298
                        echo $this->getAttribute($context["field"], "name", []);
                        echo ": </label>

                                <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                    ";
                        // line 301
                        $context["field_gid"] = $this->getAttribute($context["field"], "gid", []);
                        // line 302
                        echo "                                    ";
                        if (($this->getAttribute($context["field"], "type", []) == "checkbox")) {
                            // line 303
                            echo "                                        <input type=\"hidden\" name=\"";
                            echo $this->getAttribute($context["section"], "gid", []);
                            echo "[";
                            echo ($context["field_gid"] ?? null);
                            echo "]\" value=\"0\">
                                        <input type=\"checkbox\" name=\"";
                            // line 304
                            echo $this->getAttribute($context["section"], "gid", []);
                            echo "[";
                            echo ($context["field_gid"] ?? null);
                            echo "]\" value=\"1\"
                                            class=\"flat\" ";
                            // line 305
                            if ($this->getAttribute(($context["seo_settings"] ?? null), ($context["field_gid"] ?? null))) {
                                echo "checked";
                            }
                            echo ">
                                    ";
                        } elseif (($this->getAttribute(                        // line 306
$context["field"], "type", []) == "text")) {
                            // line 307
                            echo "                                        ";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                                // line 308
                                echo "                                            ";
                                if (($context["lang_id"] == ($context["current_lang_id"] ?? null))) {
                                    // line 309
                                    echo "                                                ";
                                    $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                    // line 310
                                    echo "                                                <input type=\"text\" name=\"";
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\"
                                                    value=\"";
                                    // line 311
                                    echo $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null)), twig_escape_filter($this->env, ($context["field_gid"] ?? null)));
                                    echo "\"
                                                    class=\"form-control\">
                                            ";
                                }
                                // line 314
                                echo "                                        ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 315
                            echo "                                </div>


                                <div class=\"accordion col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3\" id=\"accordion-input-";
                            // line 318
                            echo ($context["field_gid"] ?? null);
                            echo "\" role=\"tablist\" aria-multiselectable=\"true\">
                                    <div class=\"panel\">
                                        <a class=\"panel-heading\" role=\"tab\" id=\"headingOne-input-";
                            // line 320
                            echo ($context["field_gid"] ?? null);
                            echo "\" data-toggle=\"collapse\" data-parent=\"#accordion-input-";
                            echo ($context["field_gid"] ?? null);
                            echo "\" href=\"#collapseOne-input-";
                            echo ($context["field_gid"] ?? null);
                            echo "\" aria-expanded=\"false\" aria-controls=\"collapseOne-input-";
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                            <h4 class=\"panel-title\">";
                            // line 321
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
                                        <div id=\"collapseOne-input-";
                            // line 323
                            echo ($context["field_gid"] ?? null);
                            echo "\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne-input-";
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                            <div class=\"panel-body\">
                                                ";
                            // line 325
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                                // line 326
                                echo "                                                    ";
                                if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                                    // line 327
                                    echo "                                                        ";
                                    $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                    // line 328
                                    echo "                                                        <div class=\"form-group\">
                                                            <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                                    // line 329
                                    echo $this->getAttribute($context["item"], "name", []);
                                    echo "</label>
                                                            <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                                <input name=\"";
                                    // line 331
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\" class=\"form-control\" value=\"";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null)), ($context["field_gid"] ?? null)));
                                    echo "\" />
                                                            </div>
                                                        </div>
                                                    ";
                                }
                                // line 335
                                echo "                                                ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 336
                            echo "                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"clearfix\"></div>

                                        ";
                        } elseif (($this->getAttribute(                        // line 341
$context["field"], "type", []) == "textarea")) {
                            // line 342
                            echo "                                            ";
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["lang_item"]) {
                                // line 343
                                echo "                                                ";
                                if (($context["lang_id"] == ($context["current_lang_id"] ?? null))) {
                                    // line 344
                                    echo "                                                    ";
                                    $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                    // line 345
                                    echo "                                                    <textarea name=\"";
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\" rows=\"5\" cols=\"80\"
                                                        class=\"form-control\">";
                                    // line 346
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null)), ($context["field_gid"] ?? null)));
                                    echo "</textarea>
                                                ";
                                }
                                // line 348
                                echo "                                            ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['lang_item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 349
                            echo "
                                </div>


                                <div class=\"accordion col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3\" id=\"accordion-textarea-";
                            // line 353
                            echo ($context["field_gid"] ?? null);
                            echo "\" role=\"tablist\" aria-multiselectable=\"true\">
                                    <div class=\"panel\">
                                        <a class=\"panel-heading\" role=\"tab\" id=\"headingOne-textarea-";
                            // line 355
                            echo ($context["field_gid"] ?? null);
                            echo "\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapseOne-textarea-";
                            echo ($context["field_gid"] ?? null);
                            echo "\" aria-expanded=\"false\" aria-controls=\"collapseOne-textarea-";
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                            <h4 class=\"panel-title\">";
                            // line 356
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
                                        <div id=\"collapseOne-textarea-";
                            // line 358
                            echo ($context["field_gid"] ?? null);
                            echo "\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne-textarea-";
                            echo ($context["field_gid"] ?? null);
                            echo "\">
                                            <div class=\"panel-body\">
                                                ";
                            // line 360
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                            foreach ($context['_seq'] as $context["lang_id"] => $context["item"]) {
                                // line 361
                                echo "                                                    ";
                                if (($context["lang_id"] != ($context["current_lang_id"] ?? null))) {
                                    // line 362
                                    echo "                                                        ";
                                    $context["section_gid"] = (($this->getAttribute($context["section"], "gid", []) . "_") . $context["lang_id"]);
                                    // line 363
                                    echo "                                                        <div class=\"form-group\">
                                                            <label class=\"control-label col-md-2 col-sm-2 col-xs-12\">";
                                    // line 364
                                    echo $this->getAttribute($context["item"], "name", []);
                                    echo "</label>
                                                            <div class=\"col-md-10 col-sm-10 col-xs-12\">
                                                                <textarea name=\"";
                                    // line 366
                                    echo $this->getAttribute($context["section"], "gid", []);
                                    echo "[";
                                    echo ($context["field_gid"] ?? null);
                                    echo "][";
                                    echo $context["lang_id"];
                                    echo "]\" rows=\"5\" cols=\"80\" class=\"form-control\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["seo_settings"] ?? null), ($context["section_gid"] ?? null)), ($context["field_gid"] ?? null)));
                                    echo "</textarea>
                                                            </div>
                                                        </div>
                                                    ";
                                }
                                // line 370
                                echo "                                                ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['lang_id'], $context['item'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 371
                            echo "                                            </div>
                                        </div>
                                    </div>
                                    <div class=\"clearfix\"></div>

                                        ";
                        }
                        // line 376
                        echo "<br>";
                        echo $this->getAttribute($context["field"], "tooltip", []);
                        echo "
                                </div>
                            </div>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 380
                    echo "
                        <div class=\"ln_solid\"></div>

                    <!-- Buttons -->
                        <button type=\"submit\" name=\"btn_save_";
                    // line 384
                    echo $this->getAttribute($context["section"], "gid", []);
                    echo "\" class=\"btn btn-success\"  value=\"1\">
                            ";
                    // line 385
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_save"                    ,"start"                    ,                    );
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
                        <a class=\"cancel\" href=\"";
                    // line 386
                    echo ($context["back_url"] ?? null);
                    echo "\">
                            ";
                    // line 387
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
                    echo "</a>

                        <input type=\"hidden\" name=\"btn_save\" value=\"1\">
                    </form>
                    <div class=\"clearfix\"></div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['section'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 393
                echo "            ";
            }
            // line 394
            echo "    ";
        } else {
            // line 395
            echo "            <form action=\"";
            echo $this->getAttribute(($context["data"] ?? null), "action", []);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" name=\"save_form\"
                  data-parsley-validate class=\"form-horizontal form-label-left\">

                ";
            // line 398
            $this->loadTemplate("custom_form_fields.twig", "edit_form.twig", 398)->display($context);
            // line 399
            echo "
                <div class=\"ln_solid\"></div>

            <!-- Buttons -->
                <div class=\"form-group\">
                    <div class=\"col-md-9 col-sm-9 col-xs-12 col-sm-offset-3\">
                        ";
            // line 405
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"button"            ,            );
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
            $context['save_text'] = $result;
            // line 406
            echo "                        <button type=\"submit\" name=\"btn_save\" class=\"btn btn-success\" value=\"1\">
                            ";
            // line 407
            echo ($context["save_text"] ?? null);
            echo "</button>
                        <a class=\"btn btn-default\" href=\"";
            // line 408
            echo ($context["site_url"] ?? null);
            echo "admin/users\">
                            ";
            // line 409
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
            echo "</a>
                            ";
            // line 410
            $module =             null;
            $helper =             'users';
            $name =             'delete_select_block';
            $params = array(["id_user" => $this->getAttribute(($context["data"] ?? null), "id", []), "deleted" => 0, "class" => "btn btn-primary"]            ,            );
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
            // line 411
            echo "                    </div>
                </div>
            </form>
            <div class=\"clearfix\"></div>
    ";
        }
        // line 416
        echo "        </div>
    </div>
</div>
";
        // line 419
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-ui.custom.min.js"        ,        );
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
        // line 420
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<script type=\"text/javascript\">
    \$(function(){
        \$(document).off('ifChanged', 'input[name=\"update_password\"]').on('ifChanged', 'input[name=\"update_password\"]', function() {
            if(\$('#pass_change_field:checked').val()){
                \$(\"#pass_field\").prop('disabled', false);
                \$(\"#repass_field\").prop('disabled', false);
            }else{
                \$(\"#pass_field\").prop('disabled', true);
                \$(\"#repass_field\").prop('disabled', true);
            }
        });
    });
</script>

<script type=\"text/javascript\">
    var reload_link = '";
        // line 437
        echo ($context["site_url"] ?? null);
        echo "admin/users/index/';
    var filter = '";
        // line 438
        echo twig_escape_filter($this->env, ($context["filter"] ?? null), "js");
        echo "';
    var order = '";
        // line 439
        echo twig_escape_filter($this->env, ($context["order"] ?? null), "js");
        echo "';
    var loading_content;
    var order_direction = '";
        // line 441
        echo twig_escape_filter($this->env, ($context["order_direction"] ?? null), "js");
        echo "';

    \$(function(){
        loadScripts(\"";
        // line 444
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery.imgareaselect/jquery.imgareaselect.js"        ,"path"        ,        );
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
        echo "\", function () {}, '', {async: false});

        delete_select_block = new loadingContent({
            closeBtnPadding: '15',
            closeBtnClass: 'close',
            loadBlockSize: 'big',
            loadBlockTitle: '";
        // line 450
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_delete_user"        ,"users"        ,        );
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
        echo "',
            footerButtons: '<input type=\"submit\" id=\"full_delete\" class=\"btn btn-primary\" name=\"btn_confirm_del\" value=\"";
        // line 451
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm_del"        ,"users"        ,""        ,"js"        ,        );
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
        echo "\" disabled form=\"delete_user\">'
        });
        \$(document).off('click', '#users_link_delete').on('click', '#users_link_delete', function() {
            var data = new Array();
            \$('.grouping:checked').each(function(i){
                data[i] = \$(this).val();
            });
            if(data.length > 0){
                \$.ajax({
                    url: site_url + 'admin/users/ajax_delete_select/',
                    data: {user_ids: data},
                    type: \"POST\",
                    cache: false,
                    dataType: 'json',
                    success: function(data){
                        if (typeof (data.error) !== 'undefined' && data.error.length > 0) {
                            error_object.show_error_block(data.error, 'error');
                        } else {
                            delete_select_block.show_load_block(data.content);
                        }
                    }
                });
            }else{
                error_object.show_error_block('";
        // line 474
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_no_users_to_change_group"        ,"users"        ,""        ,"js"        ,        );
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
        echo "', 'error');
            }
        });
    });

    function reload_this_page(value){
        var link = reload_link + filter + '/' + value + '/' + order + '/' + order_direction;
        location.href=link;
    }
</script>

";
        // line 485
        $this->loadTemplate("@app/footer.twig", "edit_form.twig", 485)->display($context);
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
        return array (  1972 => 485,  1939 => 474,  1894 => 451,  1871 => 450,  1843 => 444,  1837 => 441,  1832 => 439,  1828 => 438,  1824 => 437,  1802 => 420,  1781 => 419,  1776 => 416,  1769 => 411,  1748 => 410,  1725 => 409,  1721 => 408,  1717 => 407,  1714 => 406,  1693 => 405,  1685 => 399,  1683 => 398,  1676 => 395,  1673 => 394,  1670 => 393,  1639 => 387,  1635 => 386,  1612 => 385,  1608 => 384,  1602 => 380,  1591 => 376,  1583 => 371,  1577 => 370,  1564 => 366,  1559 => 364,  1556 => 363,  1553 => 362,  1550 => 361,  1546 => 360,  1539 => 358,  1515 => 356,  1507 => 355,  1502 => 353,  1496 => 349,  1490 => 348,  1485 => 346,  1476 => 345,  1473 => 344,  1470 => 343,  1465 => 342,  1463 => 341,  1456 => 336,  1450 => 335,  1437 => 331,  1432 => 329,  1429 => 328,  1426 => 327,  1423 => 326,  1419 => 325,  1412 => 323,  1388 => 321,  1378 => 320,  1373 => 318,  1368 => 315,  1362 => 314,  1356 => 311,  1347 => 310,  1344 => 309,  1341 => 308,  1336 => 307,  1334 => 306,  1328 => 305,  1322 => 304,  1315 => 303,  1312 => 302,  1310 => 301,  1304 => 298,  1299 => 295,  1295 => 294,  1292 => 293,  1286 => 291,  1284 => 290,  1279 => 288,  1270 => 285,  1265 => 284,  1262 => 283,  1240 => 282,  1238 => 281,  1231 => 276,  1210 => 275,  1186 => 273,  1182 => 272,  1159 => 271,  1151 => 265,  1148 => 264,  1120 => 258,  1116 => 256,  1112 => 254,  1109 => 253,  1107 => 252,  1074 => 241,  1069 => 238,  1066 => 237,  1044 => 236,  1041 => 235,  1020 => 234,  1016 => 232,  998 => 225,  997 => 224,  996 => 223,  995 => 222,  994 => 221,  990 => 219,  966 => 217,  960 => 213,  938 => 212,  935 => 211,  932 => 210,  929 => 209,  926 => 208,  924 => 207,  900 => 205,  894 => 201,  884 => 194,  878 => 191,  871 => 187,  863 => 182,  839 => 180,  833 => 176,  812 => 175,  804 => 174,  801 => 173,  791 => 171,  781 => 169,  779 => 168,  756 => 167,  753 => 166,  751 => 165,  747 => 164,  723 => 162,  715 => 157,  691 => 155,  683 => 150,  659 => 148,  655 => 146,  646 => 142,  622 => 140,  618 => 138,  616 => 137,  608 => 134,  584 => 132,  580 => 130,  552 => 124,  548 => 122,  546 => 121,  540 => 118,  516 => 116,  508 => 111,  484 => 109,  477 => 104,  468 => 101,  459 => 100,  455 => 99,  429 => 95,  424 => 92,  415 => 89,  406 => 88,  402 => 87,  377 => 84,  370 => 79,  355 => 76,  347 => 74,  343 => 73,  318 => 70,  313 => 67,  308 => 63,  293 => 60,  285 => 58,  281 => 57,  256 => 54,  252 => 52,  246 => 49,  244 => 48,  241 => 47,  238 => 46,  230 => 41,  226 => 39,  205 => 38,  199 => 37,  193 => 36,  189 => 34,  186 => 33,  182 => 32,  177 => 29,  156 => 28,  150 => 27,  147 => 26,  144 => 25,  139 => 22,  118 => 21,  112 => 20,  105 => 19,  102 => 18,  80 => 17,  77 => 16,  67 => 12,  59 => 11,  52 => 10,  47 => 9,  44 => 8,  40 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_form.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\gentelella\\edit_form.twig");
    }
}
