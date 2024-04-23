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

/* list.twig */
class __TwigTemplate_b3c09d0891cc5dd4221e7f78603859013906adbb50a6068c136df5fd6a42a9f9 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display($context);
        // line 2
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("access_permissions"        ,        );
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
        // line 3
        echo "<style type=\"text/css\">
    .fa-info-circle:hover {
        cursor: pointer;
    }
    .sm-hide .tooltip.top > .tooltip-arrow, .sm-hide .tooltip > .tooltip-inner, .actions .tooltip > .tooltip-inner{
        margin-bottom: 0px;
        font-weight: 200;
        font-size: 12px;
    }
    .sm-hide .tooltip-inner, .actions .tooltip > .tooltip-inner{
        max-width: 360px;
        min-width: 200px;
    }
    .actions .tooltip > .tooltip-arrow {
        border-left-color: rgba(52, 73, 94, 0.94);
        border-right-color: rgba(52, 73, 94, 0.94);
    }
</style>
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">

        <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
            <label class=\"btn btn-default\" data-analytic=\"qweqwe\"
                    data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                    onclick=\"";
        // line 27
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("users"        ,"btn_settings"        ,        );
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
        echo "document.location.href='";
        echo ($context["site_url"] ?? null);
        echo "admin/users/settings'\">
                ";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_settings"        ,"users"        ,        );
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
        echo "            </label>
        </div>

        <div class=\"clearfix\"></div>

        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                <li class=\"";
        // line 36
        if ((($context["filter"] ?? null) == "all")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 37
        if ($this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/all/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 38
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all_users"        ,"users"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "all", []);
        echo ")
                    </a>
                </li>
                <li class=\"";
        // line 41
        if ((($context["filter"] ?? null) == "not_active")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 42
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_not_active_users"        ,"users"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "not_active", []);
        echo ")
                    </a>
                </li>
                <li class=\"";
        // line 46
        if ((($context["filter"] ?? null) == "active")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 47
        if ($this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_active_users"        ,"users"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "active", []);
        echo ")
                    </a>
                </li>
                <li class=\"";
        // line 51
        if ((($context["filter"] ?? null) == "not_confirm")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 52
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_confirm/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 53
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_not_confirm_users"        ,"users"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "not_confirm", []);
        echo ")
                    </a>
                </li>
                <li class=\"";
        // line 56
        if ((($context["filter"] ?? null) == "deleted")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 57
        if ($this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/deleted";
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 58
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_deleted_users"        ,"users"        ,        );
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
        echo " (";
        echo $this->getAttribute(($context["filter_data"] ?? null), "deleted", []);
        echo ")
                    </a>
                </li>
                ";
        // line 61
        $module =         null;
        $helper =         'incomplete_signup';
        $name =         'not_registered_add_filter';
        $params = array(($context["filter"] ?? null)        ,        );
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
        echo "                ";
        // line 63
        echo "                <li>
                    <a href=\"";
        // line 64
        echo ($context["site_url"] ?? null);
        echo "admin/users/index_users\">
                        ";
        // line 65
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_index_users"        ,"users"        ,        );
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
        echo "                    </a>
                </li>
                ";
        // line 69
        echo "            </ul>
        </div>

        <div class=\"x_panel\">
            <div class=\"x_title\">
                <h2>";
        // line 74
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_filters"        ,"start"        ,        );
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
        echo "</h2>
                <ul class=\"nav navbar-right panel_toolbox\">
                    <li>
                        <a class=\"collapse-link\"><i class=\"fa fa-chevron-down cursor-pointer\"></i></a>
                    </li>
                </ul>
                <div class=\"clearfix\"></div>
            </div>
            <div class=\"x_content hide\">
                <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate
                    class=\"form-horizontal form-label-left\">
                    <input type=\"hidden\" name=\"filter\" value=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["filter"] ?? null));
        echo "\">
                    <input type=\"hidden\" name=\"order\" value=\"";
        // line 86
        echo twig_escape_filter($this->env, ($context["order"] ?? null));
        echo "\">
                    <input type=\"hidden\" name=\"order_direction\" value=\"";
        // line 87
        echo twig_escape_filter($this->env, ($context["order_direction"] ?? null));
        echo "\">
                    <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
        // line 90
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_type"        ,"users"        ,        );
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
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                            <div id=\"gender\" class=\"btn-group\" data-toggle=\"buttons\">
                                <label class=\"btn btn-default\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                    <input type=\"radio\" name=\"user_type\" value=\"all\"";
        // line 94
        if ((($context["user_type"] ?? null) == "all")) {
            echo " selected";
        }
        echo ">...
                                </label>
                                ";
        // line 96
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_types"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 97
            echo "                                <label class=\"btn btn-default\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                    <input type=\"radio\" name=\"user_type\" value=\"";
            // line 98
            echo $context["key"];
            echo "\"";
            if ((($context["user_type"] ?? null) == $context["key"])) {
                echo " selected";
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
        // line 101
        echo "                            </div>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-sm-3 control-label\">";
        // line 105
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_by"        ,"users"        ,        );
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
                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                            <input type=\"text\" name=\"val_text\" value=\"";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute(($context["search_param"] ?? null), "text", []));
        echo "\" class=\"form-control\">
                        </div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\">
                            <select name=\"type_text\" class=\"form-control\">
                                <option value=\"all\" ";
        // line 111
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "all")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 112
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all"        ,"users"        ,        );
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
        echo "                                </option>
                                <option value=\"email\" ";
        // line 114
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "email")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 115
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_email"        ,"users"        ,        );
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
        // line 116
        echo "                                </option>
                                <option value=\"fname\" ";
        // line 117
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "fname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 118
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_fname"        ,"users"        ,        );
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
        echo "                                </option>
                                <option value=\"sname\" ";
        // line 120
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "sname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 121
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_sname"        ,"users"        ,        );
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
        // line 122
        echo "                                </option>
                                <option value=\"nickname\" ";
        // line 123
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "nickname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 124
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_nickname"        ,"users"        ,        );
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
        echo "                                </option>
                            </select>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                            ";
        // line 131
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("latest_active"        ,"users"        ,        );
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
                            ";
        // line 133
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("last_active_from"        ,$this->getAttribute($this->getAttribute(($context["search_param"] ?? null), "last_active", []), "from", [])        ,["id" => "last_active_from", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        echo "                        </div>
                        <div class=\"col-md-1 col-sm-1 col-xs-1 text-center\">
                            <label class=\"control-label\" for=\"last_active_to\">&nbsp;";
        // line 136
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("to"        ,"users"        ,        );
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
        echo "&nbsp;</label>
                        </div>
                        <div class=\"col-md-4 col-sm-4 col-xs-12\">
                            ";
        // line 139
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("last_active_to"        ,$this->getAttribute($this->getAttribute(($context["search_param"] ?? null), "last_active", []), "to", [])        ,["id" => "last_active_to", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        // line 140
        echo "                        </div>
                    </div>
                    <div class=\"ln_solid\"></div>
                    <div class=\"form-group\">
                        <div class=\"col-md-9 col-sm-9 col-xs-12 col-sm-offset-3\">
                            <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 145
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_user_find"        ,"users"        ,        );
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
        echo "\" name=\"btn_search\">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
                <div class=\"btn-group\">
                    <a id=\"users_link_add\" href=\"";
        // line 155
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/\" class=\"btn btn-primary\">
                        ";
        // line 156
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_user"        ,"users"        ,        );
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
        // line 157
        echo "                    </a>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a id=\"users_link_add\" href=\"";
        // line 165
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/\">
                                ";
        // line 166
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_user"        ,"users"        ,        );
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
        // line 167
        echo "                            </a>
                        </li>
                        <li>
                            <a href=\"javascript:;\" id=\"users_link_delete\">
                                ";
        // line 171
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_delete_user"        ,"users"        ,        );
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
        // line 172
        echo "                            </a>
                        </li>
                        ";
        // line 174
        $module =         null;
        $helper =         'users_payments';
        $name =         'button_add_funds';
        $params = array(        );
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
        $context['add_funds'] = $result;
        // line 175
        echo "                        ";
        if (twig_trim_filter(($context["add_funds"] ?? null))) {
            // line 176
            echo "                        <li>
                            ";
            // line 177
            echo ($context["add_funds"] ?? null);
            echo "
                        </li>
                        ";
        }
        // line 180
        echo "                        <li>
                            <a data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 181
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("invalid_email_btn_tooltip"        ,"users"        ,        );
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
        echo "\" href=\"javascript:;\" id=\"make_invalid_emails\">
                                ";
        // line 182
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("invalid_email_btn"        ,"users"        ,        );
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
        // line 183
        echo "                            </a>
                        </li>
                        ";
        // line 188
        echo "                    </ul>
                </div>
            </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                <thead>
                        <tr class=\"headings\">
                            <th class=\"column-group\"><input type=\"checkbox\" id=\"check-all\" class=\"flat\"></th>
                            <th data-field=\"nickname\" data-action=\"sorting\" class=\"column-title\">";
        // line 195
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_nickname"        ,"users"        ,        );
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
        echo "</th>
                            <th data-field=\"user_type\" data-action=\"sorting\" class=\"column-title\">";
        // line 196
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_type"        ,"users"        ,        );
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
        echo "</th>
                            ";
        // line 197
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
            // line 198
            echo "                                <th data-field=\"user_membership\" class=\"column-title\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_membership"            ,"access_permissions"            ,            );
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
            echo "</th>
                            ";
        }
        // line 200
        echo "                            <th data-field=\"email\" data-action=\"sorting\" class=\"column-title sm-hide\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_email"        ,"users"        ,        );
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
        echo "</th>
                            <th data-field=\"account\" data-action=\"sorting\" class=\"column-title xs-hide\">";
        // line 201
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_account"        ,"users"        ,        );
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
        echo "</th>
                            <th data-field=\"date_created\" data-action=\"sorting\" class=\"column-title sm-hide\">";
        // line 202
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_date_created"        ,"users"        ,        );
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
        echo "</th>
                            <th class=\"column-title\">";
        // line 203
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_status"        ,"start"        ,        );
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
        echo "</th>
                            <th class=\"column-title\">&nbsp;</th>
                            <th class=\"bulk-actions\" colspan=\"8\"></th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 209
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 210
            echo "                    <tr class=\"";
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($context["item"], "net_is_incomer", [])])) {
                echo "net_incomer ";
            }
            echo "even pointer\">
                        <td class=\"text-center\">
                            ";
            // line 212
            if (($this->getAttribute($context["item"], "net_is_incomer", []) == 1)) {
                // line 213
                echo "                                <div class=\"corner-triangle\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_is_incomer"                ,"users"                ,                );
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
                echo "\"></div>
                            ";
            }
            // line 215
            echo "                            <input type=\"checkbox\" class=\"tableflat grouping\" value=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data=\"table_records\">
                        </td>
                        <td>
                            ";
            // line 218
            if (($this->getAttribute($context["item"], "user_type", []) == "couple")) {
                // line 219
                echo "                              <div><b>";
                echo $this->getAttribute($context["item"], "output_name", []);
                echo "</b></div>
                            ";
            } else {
                // line 221
                echo "                                <div><b>";
                echo $this->getAttribute($context["item"], "nickname", []);
                echo "</b><br>";
                echo $this->getAttribute($context["item"], "fname", []);
                echo " ";
                echo $this->getAttribute($context["item"], "sname", []);
                echo "</div>
                            ";
            }
            // line 223
            echo "                        </td>
                        <td>";
            // line 224
            echo $this->getAttribute($context["item"], "user_type_str", []);
            echo "</td>
                        ";
            // line 225
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
                // line 226
                echo "                            <td>";
                $module =                 null;
                $helper =                 'access_permissions';
                $name =                 'membershipChangeByAdmin';
                $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id", []), "user_type" => $this->getAttribute(($context["item"] ?? null), "user_type", [])]                ,                );
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
                echo "</td>
                        ";
            }
            // line 228
            echo "                        <td class=\"sm-hide\">
                            ";
            // line 229
            if (($this->getAttribute($context["item"], "net_is_incomer", []) == 1)) {
                // line 230
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_email"                ,"users"                ,                );
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
                echo "                            ";
            } else {
                // line 232
                echo "                                ";
                echo $this->getAttribute($context["item"], "email", []);
                echo "
                            ";
            }
            // line 234
            echo "                                <span><i class=\"fa fa-check-circle
                                    ";
            // line 235
            if ((($this->getAttribute($context["item"], "checked_email", []) == 1) && $this->getAttribute($context["item"], "valid_email", []))) {
                echo " ";
            } else {
                echo "hide";
            }
            echo "\" style=\"color: #32b44a;\"
                                         data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
            // line 236
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("email_valid_info"            ,"users"            ,            );
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
            echo "\"></i></span>
                                <span><i class=\"fa fa-info-circle
                                    ";
            // line 238
            if ((($this->getAttribute($context["item"], "checked_email", []) == 1) &&  !$this->getAttribute($context["item"], "valid_email", []))) {
                echo " ";
            } else {
                echo "hide";
            }
            echo "\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("email_not_valid_info"            ,"users"            ,            );
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
            echo "\"></i></span>
                                <div>
                                <span id=\"invalid-email-";
            // line 240
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"></span>
                                ";
            // line 245
            echo "                            </div>
                        </td>
                        <td class=\"xs-hide a-right\">
                            ";
            // line 248
            $module =             null;
            $helper =             'start';
            $name =             'currency_format_output';
            $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "account", []), "template" => "[abbr][value|dec_part:2|dec_sep:.|gr_sep:]"]            ,            );
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
            // line 249
            echo "                        </td>
                        <td class=\"sm-hide\">
                            ";
            // line 251
            echo $this->getAttribute($context["item"], "date_created", []);
            echo "
                        </td>
                        <td>
                            <div>";
            // line 254
            if ($this->getAttribute($context["item"], "approved", [])) {
                // line 255
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_tableicon_is_active"                ,"start"                ,                );
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
                // line 256
                echo "                            ";
            } else {
                // line 257
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_tableicon_is_not_active"                ,"start"                ,                );
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
                // line 258
                echo "                            ";
            }
            echo "</div>
                                ";
            // line 259
            if ($this->getAttribute($context["item"], "last_ip_addr", [])) {
                // line 260
                echo "                                    <div>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_ip_address"                ,"users"                ,                );
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
                echo $this->getAttribute($context["item"], "last_ip_addr", []);
                echo "</div>
                                ";
            }
            // line 262
            echo "                        </td>
                        <td class=\"icons\">
                            <div class=\"btn-group\">
                                ";
            // line 265
            if (($this->getAttribute($context["item"], "net_is_incomer", []) == 0)) {
                // line 266
                echo "                                    <button type=\"button\"
                                        class=\"btn btn-primary\" title=\"";
                // line 267
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_user"                ,"users"                ,                );
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
                echo "\"
                                        onclick = \"document.location.href='";
                // line 268
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "'\">
                                            ";
                // line 269
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_user"                ,"users"                ,                );
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
                // line 270
                echo "                                    </button>
                                ";
            } else {
                // line 272
                echo "                                     <button type=\"button\"
                                        class=\"btn btn-primary\" title=\"";
                // line 273
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_is_incomer"                ,"users"                ,                );
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
                // line 274
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_error_edit_user"                ,"users"                ,                );
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
                // line 275
                echo "                                    </button>
                                ";
            }
            // line 277
            echo "                               ";
            // line 290
            echo "
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li onclick=\"";
            // line 297
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("users"            ,"btn_edit_user"            ,            );
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
            // line 298
            if (($this->getAttribute($context["item"], "net_is_incomer", []) == 0)) {
                // line 299
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/edit/personal/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            ";
                // line 300
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_user"                ,"users"                ,                );
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
                // line 301
                echo "                                        </a>
                                    ";
            } else {
                // line 303
                echo "                                        <a>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_is_incomer"                ,"users"                ,                );
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
                echo ". ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("network_error_edit_user"                ,"users"                ,                );
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
            }
            // line 305
            echo "                                    </li>
                                    <li>
                                    ";
            // line 307
            if ($this->getAttribute($context["item"], "approved", [])) {
                // line 308
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/0\">
                                            ";
                // line 309
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("make_inactive"                ,"start"                ,                );
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
                // line 310
                echo "                                        </a>
                                    ";
            } else {
                // line 312
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/users/activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1\">
                                            ";
                // line 313
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("make_active"                ,"start"                ,                );
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
                // line 314
                echo "                                        </a>
                                    ";
            }
            // line 316
            echo "
                                    </li>
                                    ";
            // line 318
            $module =             null;
            $helper =             'users_payments';
            $name =             'buttonAddFunds';
            $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id", [])]            ,            );
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
            $context['add_funds'] = $result;
            // line 319
            echo "                                    ";
            if (twig_trim_filter(($context["add_funds"] ?? null))) {
                // line 320
                echo "                                    <li>
                                        ";
                // line 321
                echo ($context["add_funds"] ?? null);
                echo "
                                    </li>
                                    ";
            }
            // line 324
            echo "
                                    ";
            // line 325
            $module =             null;
            $helper =             'users';
            $name =             'delete_select_block';
            $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id", []), "deleted" => 0]            ,            );
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
            $context['delete'] = $result;
            // line 326
            echo "                                    ";
            if (($context["delete"] ?? null)) {
                // line 327
                echo "                                    <li>
                                        ";
                // line 328
                echo ($context["delete"] ?? null);
                echo "
                                    </li>
                                    ";
            }
            // line 331
            echo "
                                    ";
            // line 332
            $module =             null;
            $helper =             'tickets';
            $name =             'contact_user_link';
            $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id", [])]            ,            );
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
            $context['contact'] = $result;
            // line 333
            echo "                                    ";
            if (twig_trim_filter(($context["contact"] ?? null))) {
                // line 334
                echo "                                    <li onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("users"                ,"btn_contact_user"                ,                );
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
                // line 335
                echo ($context["contact"] ?? null);
                echo "
                                    </li>
                                    ";
            }
            // line 338
            echo "                                    ";
            if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
                // line 339
                echo "                                    <li>";
                $module =                 null;
                $helper =                 'access_permissions';
                $name =                 'membershipChangeByAdmin';
                $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id", []), "type" => "btn", "user_type" => $this->getAttribute(($context["item"] ?? null), "user_type", [])]                ,                );
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
                echo "</li>
                                    ";
            }
            // line 341
            echo "                                </ul>
                            </div>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 346
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 349
        $this->loadTemplate("@app/pagination.twig", "list.twig", 349)->display($context);
        // line 350
        echo "    </div>
</div>

<link href=\"";
        // line 353
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<script type=\"text/javascript\">
    var reload_link = '";
        // line 356
        echo ($context["site_url"] ?? null);
        echo "admin/users/index/';
    var filter = '";
        // line 357
        echo twig_escape_filter($this->env, ($context["filter"] ?? null), "js");
        echo "';
    var order = '";
        // line 358
        echo twig_escape_filter($this->env, ($context["order"] ?? null), "js");
        echo "';
    var loading_content;
    var order_direction = '";
        // line 360
        echo twig_escape_filter($this->env, ($context["order_direction"] ?? null), "js");
        echo "';

    \$(function(){
        \$(function () {
          \$('.sm-hide [data-toggle=\"tooltip\"]').tooltip();
          \$('.dropdown-menu li a').tooltip();
        })
        delete_select_block = new loadingContent({
            closeBtnPadding: '15',
            closeBtnClass: 'close',
            loadBlockSize: 'big',
            loadBlockTitle: '";
        // line 371
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
        // line 372
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
        // line 395
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

        \$(document).off('click', '#make_invalid_emails').on('click', '#make_invalid_emails', function() {
            var data = new Array();
            \$('.grouping:checked').each(function(i){
                data[i] = \$(this).val();
            });
            if(data.length > 0){
                make_invalid_email(data);
            }else{
                error_object.show_error_block('";
        // line 407
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

    function make_invalid_email(ids){
        \$.ajax({
            url: site_url + 'admin/users/ajax_make_invalid_email/',
            data: {user_ids: ids},
            type: \"POST\",
            cache: false,
            dataType: 'json',
            success: function(data){
                if (typeof (data.info) !== 'undefined') {
                    error_object.show_error_block(data.info, 'info');
                }
                \$.each(ids, function (index, value) {
                    var obj = \"#invalid-email-\" + value;
                    \$(obj).addClass('hide');
                    \$(obj).parents('td').find('.fa-check-circle').addClass('hide');
                    \$(obj).parents('td').find('.fa-info-circle').removeClass('hide');
                });
            }
        });
    }

    function reload_this_page(value){
        var link = reload_link + filter + '/' + value + '/' + order + '/' + order_direction;
        location.href=link;
    }
</script>

<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green',
        });
    });
</script>

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    var sorting_fields = {
        nickname: 1,
        user_type: 2,
        email: 4,
        account: 5,
        date_created: 6
    };
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"stateSave\": true,
            \"stateSaveCallback\": function (settings, data) {
                    localStorage.setItem('sorting_users_fields', JSON.stringify(data));
            },
            \"fnStateLoaded\": function (oSettings, data) {
                var sorting_users_fields = JSON.parse(localStorage.getItem('sorting_users_fields'))
                this.fnSort(sorting_users_fields.order);
            },
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 469
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("search_all_column"        ,"start"        ,        );
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
        echo ":\",
                \"sEmptyTable\": \"";
        // line 470
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_users"        ,"users"        ,        );
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
        echo "\"
            },
             columnDefs: [
                { type: 'natural-nohtml', targets: 0 }
              ],
             \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': [0,3, 8]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\"><\"actions\">lfrtip',
        });

        \$(\"tfoot input\").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
        });
        \$(\"tfoot input\").each(function (i) {
            asInitVals[i] = this.value;
        });
        \$(\"tfoot input\").focus(function () {
            if (this.className == \"search_init\") {
                this.className = \"\";
                this.value = \"\";
            }
        });
        \$(\"tfoot input\").blur(function (i) {
            if (this.value == \"\") {
                this.className = \"search_init\";
                this.value = asInitVals[\$(\"tfoot input\").index(this)];
            }
        });
        var actions = \$(\"#actions\");
        \$('#users_wrapper').find('.actions').html(actions.html());
        actions.remove();
        oTable.fnSort([sorting_fields[order], order_direction.toLowerCase()]);
        \$('[data-action=sorting]').click(function(){
            var field = \$(this).data('field');
            var sortLinks = ";
        // line 512
        echo twig_jsonencode_filter(($context["sort_links"] ?? null));
        echo ";
            locationHref(sortLinks[field]);
        });

    });
</script>
";
        // line 518
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "access_permissions", [])) {
            // line 519
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("access_permissions"            ,"AdminAccessPermissions.js"            ,            );
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
            // line 520
            echo "<script type='text/javascript'>
    \$(function () {
        new AdminAccessPermissions({
            siteUrl: '";
            // line 523
            echo ($context["site_root"] ?? null);
            echo "',
            contentObj: new loadingContent({
                footerButtons: '<input type=\"button\" data-action=\"change-membership\" value=\"Save\" class=\"btn btn-primary\">'
            })
        }).getMemberships();
    });
</script>
";
        }
        // line 531
        $this->loadTemplate("@app/footer.twig", "list.twig", 531)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2369 => 531,  2358 => 523,  2353 => 520,  2332 => 519,  2330 => 518,  2321 => 512,  2257 => 470,  2234 => 469,  2150 => 407,  2116 => 395,  2071 => 372,  2048 => 371,  2034 => 360,  2029 => 358,  2025 => 357,  2021 => 356,  2014 => 353,  2009 => 350,  2007 => 349,  2002 => 346,  1992 => 341,  1967 => 339,  1964 => 338,  1958 => 335,  1934 => 334,  1931 => 333,  1910 => 332,  1907 => 331,  1901 => 328,  1898 => 327,  1895 => 326,  1874 => 325,  1871 => 324,  1865 => 321,  1862 => 320,  1859 => 319,  1838 => 318,  1834 => 316,  1830 => 314,  1809 => 313,  1802 => 312,  1798 => 310,  1777 => 309,  1770 => 308,  1768 => 307,  1764 => 305,  1718 => 303,  1714 => 301,  1693 => 300,  1686 => 299,  1684 => 298,  1661 => 297,  1652 => 290,  1650 => 277,  1646 => 275,  1625 => 274,  1602 => 273,  1599 => 272,  1595 => 270,  1574 => 269,  1568 => 268,  1545 => 267,  1542 => 266,  1540 => 265,  1535 => 262,  1508 => 260,  1506 => 259,  1501 => 258,  1479 => 257,  1476 => 256,  1454 => 255,  1452 => 254,  1446 => 251,  1442 => 249,  1421 => 248,  1416 => 245,  1412 => 240,  1382 => 238,  1358 => 236,  1350 => 235,  1347 => 234,  1341 => 232,  1338 => 231,  1316 => 230,  1314 => 229,  1311 => 228,  1286 => 226,  1284 => 225,  1280 => 224,  1277 => 223,  1267 => 221,  1261 => 219,  1259 => 218,  1252 => 215,  1227 => 213,  1225 => 212,  1217 => 210,  1213 => 209,  1185 => 203,  1162 => 202,  1139 => 201,  1115 => 200,  1090 => 198,  1088 => 197,  1065 => 196,  1042 => 195,  1033 => 188,  1029 => 183,  1008 => 182,  985 => 181,  982 => 180,  976 => 177,  973 => 176,  970 => 175,  949 => 174,  945 => 172,  924 => 171,  918 => 167,  897 => 166,  893 => 165,  883 => 157,  862 => 156,  858 => 155,  826 => 145,  819 => 140,  798 => 139,  773 => 136,  769 => 134,  748 => 133,  724 => 131,  716 => 125,  695 => 124,  689 => 123,  686 => 122,  665 => 121,  659 => 120,  656 => 119,  635 => 118,  629 => 117,  626 => 116,  605 => 115,  599 => 114,  596 => 113,  575 => 112,  569 => 111,  562 => 107,  538 => 105,  532 => 101,  517 => 98,  514 => 97,  510 => 96,  503 => 94,  477 => 90,  471 => 87,  467 => 86,  463 => 85,  430 => 74,  423 => 69,  419 => 66,  398 => 65,  394 => 64,  391 => 63,  389 => 62,  368 => 61,  341 => 58,  332 => 57,  322 => 56,  295 => 53,  285 => 52,  275 => 51,  248 => 48,  238 => 47,  228 => 46,  201 => 43,  191 => 42,  181 => 41,  154 => 38,  144 => 37,  134 => 36,  125 => 29,  104 => 28,  79 => 27,  53 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\gentelella\\list.twig");
    }
}
