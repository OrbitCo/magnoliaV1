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

/* index_users.twig */
class __TwigTemplate_611d4f669e6e6d20982c5446b8c20d328a937994895844142439df7bacf3dc27 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index_users.twig", 1)->display($context);
        // line 2
        echo "
<style>
    .c-profiles {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -1rem 2rem;
    }
    .c-profiles__item {
        flex-basis: 20%;
        padding: 1rem;
        cursor: pointer;
        min-width: 0;
        position: relative;
    }
    .c-profiles__item_image {
        position: relative;
    }
    .c-profiles__item_caption {
        padding: 0.5rem;
        border-left: 1px solid #e6e9ed;
        border-right: 1px solid #e6e9ed;
        border-bottom: 1px solid #e6e9ed;
    }
    .c-profiles__item_name,
    .c-profiles__item_location {
        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .c-profiles__item_check {
        display: none;
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        color: #32b44a;
        align-items: center;
        justify-content: center;
        font-size: 15rem;
    }
    .c-profiles__item.selected .c-profiles__item_check {
        display: flex;
    }
    @media (max-width: 1199px) {
        .c-profiles__item {
            flex-basis: 25%;
        }
        .c-profiles__item_check {
            font-size: 10rem;
        }
    }
    @media (max-width: 991px) {
        .c-profiles__item {
            flex-basis: calc(100% / 3);
        }
    }
</style>

<div class=\"col-xs-12\">
    <div class=\"x_panel\">
        <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
            <label class=\"btn btn-default\" data-analytic=\"qweqwe\"
                    data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                    onclick=\"";
        // line 69
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
        // line 70
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
        // line 71
        echo "            </label>
        </div>
        <div class=\"clearfix\"></div>

        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                <li class=\"";
        // line 77
        if ((($context["filter"] ?? null) == "all")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 78
        if ($this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/all/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 79
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
        // line 82
        if ((($context["filter"] ?? null) == "not_active")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 83
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 84
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
        // line 87
        if ((($context["filter"] ?? null) == "active")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 88
        if ($this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 89
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
        // line 92
        if ((($context["filter"] ?? null) == "not_confirm")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 93
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_confirm/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 94
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
        // line 97
        if ((($context["filter"] ?? null) == "deleted")) {
            echo "active";
        }
        echo " ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo "disabled";
        }
        echo "\">
                    <a href=\"";
        // line 98
        if ($this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/deleted";
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 99
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
        // line 102
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
        // line 103
        echo "                <li class=\"active\">
                    <a href=\"";
        // line 104
        echo ($context["site_url"] ?? null);
        echo "admin/users/index_users\">
                        ";
        // line 105
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
        // line 106
        echo "                    </a>
                </li>
            </ul>
        </div>

        <div class=\"x_panel\">
            <div class=\"x_title\">
                <h2>";
        // line 113
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
                <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate class=\"form-horizontal form-label-left\">
                    <div class=\"form-group\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            ";
        // line 125
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
                                <label class=\"btn btn-default ";
        // line 128
        if (($this->getAttribute(($context["search_params"] ?? null), "user_type", []) == "")) {
            echo "active";
        }
        echo "\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                    <input type=\"radio\" name=\"user_type\" value=\"\"";
        // line 129
        if (($this->getAttribute(($context["search_params"] ?? null), "user_type", []) == "")) {
            echo " checked";
        }
        echo ">...
                                </label>
                                ";
        // line 131
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user_types"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 132
            echo "                                    <label class=\"btn btn-default ";
            if (($this->getAttribute(($context["search_params"] ?? null), "user_type", []) == $context["key"])) {
                echo "active";
            }
            echo "\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">
                                        <input type=\"radio\" name=\"user_type\" value=\"";
            // line 133
            echo $context["key"];
            echo "\"";
            if (($this->getAttribute(($context["search_params"] ?? null), "user_type", []) == $context["key"])) {
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
        // line 136
        echo "                            </div>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-sm-3 control-label\">";
        // line 140
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
                            <input type=\"text\" name=\"search_text\" value=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->getAttribute(($context["search_params"] ?? null), "search_text", []));
        echo "\" class=\"form-control\">
                        </div>
                        <div class=\"col-md-3 col-sm-3 col-xs-12\">
                            <select name=\"search_type\" class=\"form-control\">
                                <option value=\"all\" ";
        // line 146
        if (($this->getAttribute(($context["search_params"] ?? null), "search_type", []) == "all")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 147
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
        // line 148
        echo "                                </option>
                                <option value=\"email\" ";
        // line 149
        if (($this->getAttribute(($context["search_params"] ?? null), "search_type", []) == "email")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 150
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
        // line 151
        echo "                                </option>
                                <option value=\"fname\" ";
        // line 152
        if (($this->getAttribute(($context["search_params"] ?? null), "search_type", []) == "fname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 153
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
        // line 154
        echo "                                </option>
                                <option value=\"sname\" ";
        // line 155
        if (($this->getAttribute(($context["search_params"] ?? null), "search_type", []) == "sname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 156
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
        // line 157
        echo "                                </option>
                                <option value=\"nickname\" ";
        // line 158
        if (($this->getAttribute(($context["search_params"] ?? null), "search_type", []) == "nickname")) {
            echo " selected";
        }
        echo ">
                                    ";
        // line 159
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
        // line 160
        echo "                                </option>
                            </select>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                            ";
        // line 166
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
        // line 168
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("last_active_from"        ,$this->getAttribute($this->getAttribute(($context["search_params"] ?? null), "last_active", []), "from", [])        ,["id" => "last_active_from", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        // line 169
        echo "                        </div>
                        <div class=\"col-md-1 col-sm-1 col-xs-1 text-center\">
                            <label class=\"control-label\" for=\"last_active_to\" style=\"font-weight:normal;\">&nbsp;";
        // line 171
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
        // line 174
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("last_active_to"        ,$this->getAttribute($this->getAttribute(($context["search_params"] ?? null), "last_active", []), "to", [])        ,["id" => "last_active_to", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        // line 175
        echo "                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                            ";
        // line 179
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
        echo ":</label>
                        <div class=\"col-md-4 col-sm-4 col-xs-12\">
                            ";
        // line 181
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("date_created_from"        ,$this->getAttribute($this->getAttribute(($context["search_params"] ?? null), "date_created", []), "from", [])        ,["id" => "date_created_from", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        // line 182
        echo "                        </div>
                        <div class=\"col-md-1 col-sm-1 col-xs-1 text-center\">
                            <label class=\"control-label\" for=\"date_created_to\" style=\"font-weight:normal;\">&nbsp;";
        // line 184
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
        // line 187
        $module =         null;
        $helper =         'start';
        $name =         'getCalendarInput';
        $params = array("date_created_to"        ,$this->getAttribute($this->getAttribute(($context["search_params"] ?? null), "date_created", []), "to", [])        ,["id" => "date_created_to", "year_range" => ["min" =>  -30, "max" => 1]]        ,        );
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
        // line 188
        echo "                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-md-3 col-sm-3 col-xs-12 control-label\">
                            ";
        // line 192
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_location"        ,"users"        ,        );
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
                            ";
        // line 194
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_search_country"        ,"users"        ,        );
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
        $context['location_lang'] = $result;
        // line 195
        echo "                            ";
        $module =         null;
        $helper =         'countries';
        $name =         'location_select';
        $params = array(["is_radius" => 0, "is_search" => 1, "select_type" => "city", "placeholder" =>         // line 199
($context["location_lang"] ?? null), "id_country" => $this->getAttribute(        // line 200
($context["search_params"] ?? null), "id_country", []), "id_region" => $this->getAttribute(        // line 201
($context["search_params"] ?? null), "id_region", []), "id_city" => $this->getAttribute(        // line 202
($context["search_params"] ?? null), "id_city", [])]        ,        );
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
        // line 204
        echo "                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"col-md-3 col-sm-3 col-xs-12\">
                            ";
        // line 208
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_with_photo"        ,"users"        ,        );
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
                            <input type=\"checkbox\" name=\"with_photo\" class=\"flat\" value=\"1\" ";
        // line 210
        if ($this->getAttribute(($context["search_params"] ?? null), "with_photo", [])) {
            echo "checked";
        }
        echo ">
                        </div>
                    </div>
                    <div class=\"ln_solid\"></div>
                    <div class=\"form-group\">
                        <div class=\"col-md-9 col-sm-9 col-xs-12 col-sm-offset-3\">
                            <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 216
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
            <div id=\"actions\" class=\"hide\"></div>

            <div class=\"c-profiles\">
                ";
        // line 227
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 228
            echo "                    <div class=\"c-profiles__item ";
            if (twig_in_filter($this->getAttribute($context["user"], "id", []), ($context["selected_users"] ?? null))) {
                echo "selected";
            }
            echo "\">
                        <div class=\"c-profiles__item_image\" data-action=\"index-user\" data-id=\"";
            // line 229
            echo $this->getAttribute($context["user"], "id", []);
            echo "\">
                            <img src=\"";
            // line 230
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["user"], "media", []), "user_logo", []), "thumbs", []), "great", []);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "output_name", []));
            echo "\" class=\"img-responsive\">
                            <div class=\"c-profiles__item_check\">
                                <i class=\"fa fa-check\"></i>
                            </div>
                        </div>
                        <div class=\"c-profiles__item_caption\">
                            <div class=\"c-profiles__item_name\">
                                <a href=\"";
            // line 237
            echo ($context["site_url"] ?? null);
            echo "admin/users/edit/personal/";
            echo $this->getAttribute($context["user"], "id", []);
            echo "\">";
            echo $this->getAttribute($context["user"], "output_name", []);
            echo "</a>";
            if ($this->getAttribute($context["user"], "age", [])) {
                echo ", ";
                echo $this->getAttribute($context["user"], "age", []);
            }
            // line 238
            echo "                            </div>
                            <div class=\"c-profiles__item_location\" title=\"";
            // line 239
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "location", []));
            echo "\">
                                ";
            // line 240
            echo $this->getAttribute($context["user"], "location", []);
            echo "
                            </div>
                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 245
        echo "            </div>
        </div>
        ";
        // line 247
        $this->loadTemplate("@app/pagination.twig", "index_users.twig", 247)->display($context);
        // line 248
        echo "    </div>
</div>

<script>
    \$(function () {
        \$('[data-action=\"index-user\"]').off('click').click(function (e) {
            e.preventDefault();

            const container = \$(this).parent();

            let userId = \$(this).data('id') || 0;
            let action = container.hasClass('selected') ? 'remove' : 'add';

            container.toggleClass('selected');

            \$.ajax({
                type: \"post\",
                url: site_url + \"admin/users/ajax_set_index_user\",
                data: {
                    user_id: userId,
                    action: action,
                },
                dataType: \"json\",
                backend: 1,
                cache: false,
                success: function (response) {
                    if (response.message) {
                        error_object.show_error_block(response.message, response.status == 1 ? 'success' : 'error');
                    }

                    if (response.status == 0) {
                        if (action == 'add') {
                            container.removeClass('selected');
                        } else {
                            container.addClass('selected');
                        }
                    }
                }
            });

            return false;
        })
    });
</script>

";
        // line 293
        $this->loadTemplate("@app/footer.twig", "index_users.twig", 293)->display($context);
    }

    public function getTemplateName()
    {
        return "index_users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1193 => 293,  1146 => 248,  1144 => 247,  1140 => 245,  1129 => 240,  1125 => 239,  1122 => 238,  1111 => 237,  1099 => 230,  1095 => 229,  1088 => 228,  1084 => 227,  1051 => 216,  1040 => 210,  1016 => 208,  1010 => 204,  992 => 202,  991 => 201,  990 => 200,  989 => 199,  984 => 195,  963 => 194,  939 => 192,  933 => 188,  912 => 187,  887 => 184,  883 => 182,  862 => 181,  838 => 179,  832 => 175,  811 => 174,  786 => 171,  782 => 169,  761 => 168,  737 => 166,  729 => 160,  708 => 159,  702 => 158,  699 => 157,  678 => 156,  672 => 155,  669 => 154,  648 => 153,  642 => 152,  639 => 151,  618 => 150,  612 => 149,  609 => 148,  588 => 147,  582 => 146,  575 => 142,  551 => 140,  545 => 136,  530 => 133,  523 => 132,  519 => 131,  512 => 129,  506 => 128,  481 => 125,  447 => 113,  438 => 106,  417 => 105,  413 => 104,  410 => 103,  389 => 102,  362 => 99,  353 => 98,  343 => 97,  316 => 94,  306 => 93,  296 => 92,  269 => 89,  259 => 88,  249 => 87,  222 => 84,  212 => 83,  202 => 82,  175 => 79,  165 => 78,  155 => 77,  147 => 71,  126 => 70,  101 => 69,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index_users.twig", "/home/mliadov/public_html/application/modules/users/views/gentelella/index_users.twig");
    }
}
