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

/* deleted_list.twig */
class __TwigTemplate_3ae984cbf74ce1af024dcd178dca440b57c94d254a8e225cc41fa55178157ef6 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "deleted_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                <li class=\"";
        // line 7
        if ((($context["filter"] ?? null) == "all")) {
            echo "active";
        }
        if ($this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 8
        if ($this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/all/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 9
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
        // line 12
        if ((($context["filter"] ?? null) == "not_active")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 13
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 14
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
        // line 17
        if ((($context["filter"] ?? null) == "active")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 18
        if ($this->getAttribute(($context["filter_data"] ?? null), "active", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/active/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 19
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
        // line 22
        if ((($context["filter"] ?? null) == "not_confirm")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 23
        if ($this->getAttribute(($context["filter_data"] ?? null), "not_confirm", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/index/not_confirm/";
            echo ($context["user_type"] ?? null);
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 24
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
        // line 27
        if ((($context["filter"] ?? null) == "deleted")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo " disabled";
        }
        echo "\">
                    <a href=\"";
        // line 28
        if ($this->getAttribute(($context["filter_data"] ?? null), "deleted", [])) {
            echo ($context["site_url"] ?? null);
            echo "admin/users/deleted";
        } else {
            echo "javascript:;";
        }
        echo "\">
                        ";
        // line 29
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
        // line 33
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
        // line 34
        echo "
                ";
        // line 36
        echo "                <li>
                    <a href=\"";
        // line 37
        echo ($context["site_url"] ?? null);
        echo "admin/users/index_users\">
                        ";
        // line 38
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
        // line 39
        echo "                    </a>
                </li>
                ";
        // line 42
        echo "
            </ul>
        </div>
        <div class=\"x_panel\">
            <div class=\"x_title\">
                <h2>";
        // line 47
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_filters"        ,"users"        ,        );
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
        // line 58
        echo twig_escape_filter($this->env, ($context["filter"] ?? null));
        echo "\">
                    <input type=\"hidden\" name=\"order\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, ($context["order"] ?? null));
        echo "\">
                    <input type=\"hidden\" name=\"order_direction\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["order_direction"] ?? null));
        echo "\">
                    <div class=\"filter-form\">
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
        // line 64
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
        echo ":
                            </label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <div class=\"row\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"val_text\"
                                               value=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute(($context["search_param"] ?? null), "text", []));
        echo "\"
                                               class=\"form-control\">
                                    </div>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"type_text\" class=\"form-control\">
                                            <option value=\"all\"
                                                    ";
        // line 76
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "all")) {
            echo " selected";
        }
        echo ">
                                                ";
        // line 77
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
        // line 78
        echo "                                            </option>
                                            <option value=\"email\"
                                                    ";
        // line 80
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "email")) {
            echo " selected";
        }
        echo ">
                                                ";
        // line 81
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
        // line 82
        echo "                                            </option>
                                            <option value=\"fname\"
                                                    ";
        // line 84
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "fname")) {
            echo " selected";
        }
        echo ">
                                                ";
        // line 85
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
        // line 86
        echo "                                            </option>
                                            <option value=\"sname\"
                                                    ";
        // line 88
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "sname")) {
            echo " selected";
        }
        echo ">
                                                ";
        // line 89
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
        // line 90
        echo "                                            </option>
                                            <option value=\"nickname\"
                                                    ";
        // line 92
        if (($this->getAttribute(($context["search_param"] ?? null), "type", []) == "nickname")) {
            echo " selected";
        }
        echo ">
                                                ";
        // line 93
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
        // line 94
        echo "                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                ";
        // line 102
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_deleted_from"        ,"users"        ,        );
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
                                <div class=\"row\">
                                    <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                        <input type=\"text\" id=\"date_deleted_from\" name=\"date_deleted_from\"
                                               maxlength=\"10\" class=\"form-control\"
                                               value=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["search_param"] ?? null), "date_deleted", []), "from", []));
        echo "\">
                                    </div>
                                    <div class=\"col-md-1 col-sm-1 col-xs-12 text-center\">
                                        <label class=\"data-label\" for=\"date_deleted_to\">
                                            ";
        // line 113
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
        // line 114
        echo "                                        </label>
                                    </div>
                                        <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                            <input type=\"text\" id=\"date_deleted_to\" name=\"date_deleted_to\"
                                                   maxlength=\"10\" class=\"form-control\"
                                                   value=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["search_param"] ?? null), "date_deleted", []), "to", []));
        echo "\">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class=\"col-md-9 col-sm-9 col-xs-9 col-md-offset-3\">
                                <input type=\"submit\" name=\"btn_search\"  class=\"btn btn-primary\"
                                       value=\"";
        // line 128
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
        echo "\">
                            </div>
                            <div class='clearfix'></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
              <div class=\"btn-group\">
                <a id=\"users_link_add\" href=\"";
        // line 139
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/\" class=\"btn btn-primary\">
                    ";
        // line 140
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
        // line 141
        echo "                </a>
                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <ul class=\"dropdown-menu\">
                  <li>
                    <a onclick=\"\$('#users_link_add').trigger('click'); return false;\" href=\"";
        // line 149
        echo ($context["site_url"] ?? null);
        echo "admin/users/edit/personal/\">
                        ";
        // line 150
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
        // line 151
        echo "                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-title\">
                            ";
        // line 160
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
        // line 161
        echo "                        </th>
                        <th class=\"column-title\">
                            ";
        // line 163
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
        // line 164
        echo "                        </th>
                        <th class=\"column-title text-center\">
                            ";
        // line 166
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_deleted_date"        ,"users"        ,        );
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
        echo "                        </th>
                        <th class=\"column-title\">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 172
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 173
            echo "                        <tr class=\"even pointer]\">
                            <td class=\"first\">
                                <b>";
            // line 175
            echo $this->getAttribute($context["item"], "nickname", []);
            echo "</b>
                                <br>";
            // line 176
            echo $this->getAttribute($context["item"], "fname", []);
            echo " ";
            echo $this->getAttribute($context["item"], "sname", []);
            echo "
                            </td>
                            <td>";
            // line 178
            echo $this->getAttribute($context["item"], "email", []);
            echo "</td>
                            <td  class=\"text-center\">
                                ";
            // line 180
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_deleted", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
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
            // line 181
            echo "                            </td>
                            <td class=\"icons\">
                              <div class=\"btn-group\">
                                  ";
            // line 184
            $module =             null;
            $helper =             'users';
            $name =             'delete_select_block';
            $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id_user", []), "callback_user" => $this->getAttribute(($context["item"] ?? null), "data", []), "deleted" => 1, "class" => "btn btn-primary"]            ,            );
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
            // line 185
            echo "                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li>
                                      ";
            // line 192
            $module =             null;
            $helper =             'users';
            $name =             'delete_select_block';
            $params = array(["id_user" => $this->getAttribute(($context["item"] ?? null), "id_user", []), "callback_user" => $this->getAttribute(($context["item"] ?? null), "data", []), "deleted" => 1]            ,            );
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
            // line 193
            echo "                                    </li>
                                </ul>
                              </div>
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 199
        echo "                </tbody>
            </table>
            ";
        // line 201
        $this->loadTemplate("@app/pagination.twig", "deleted_list.twig", 201)->display($context);
        // line 202
        echo "        </div>
    </div>

";
        // line 205
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
        // line 206
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<script type=\"text/javascript\">
    var reload_link = '";
        // line 208
        echo ($context["site_url"] ?? null);
        echo "admin/users/deleted/';
    var filter = '";
        // line 209
        echo ($context["filter"] ?? null);
        echo "';
    var order = '";
        // line 210
        echo ($context["order"] ?? null);
        echo "';
    var loading_content;
    var order_direction = '";
        // line 212
        echo ($context["order_direction"] ?? null);
        echo "';

    \$(function () {
        now = new Date();
        yr = (new Date(now.getYear() - 80, 0, 1).getFullYear()) + ':' + (new Date(now.getYear() - 18, 0, 1).getFullYear());
        \$(\"#date_deleted_from\").datepicker({
            defaultDate: \"+1w\",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: '";
        // line 221
        echo $this->getAttribute(($context["date_format_ui"] ?? null), "date_literal", []);
        echo "',
            onClose: function (selectedDate) {
                \$(\"#date_deleted_to\").datepicker(\"option\", \"minDate\", selectedDate);
            }
        });
        \$(\"#date_deleted_to\").datepicker({
            defaultDate: \"+1w\",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: '";
        // line 230
        echo $this->getAttribute(($context["date_format_ui"] ?? null), "date_literal", []);
        echo "',
            onClose: function (selectedDate) {
                \$(\"#date_deleted_from\").datepicker(\"option\", \"maxDate\", selectedDate);
            }
        });
    });
    function reload_this_page(value) {
        var link = reload_link + filter + '/' + value + '/' + order + '/' + order_direction;
        location.href = link;
    }
   delete_select_block = new loadingContent({
        closeBtnPadding: '15',
        closeBtnClass: 'close',
        loadBlockSize: 'big',
        loadBlockTitle: '";
        // line 244
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
        // line 245
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
    })
    function reload_this_page(value) {
        var link = reload_link + filter + '/' + value + '/' + order + '/' + order_direction;
        location.href = link;
    }
</script>

<!-- TABLES -->
<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });

    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"Search all columns:\"
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': [3]
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
    });
</script>

";
        // line 304
        $this->loadTemplate("@app/footer.twig", "deleted_list.twig", 304)->display($context);
    }

    public function getTemplateName()
    {
        return "deleted_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1145 => 304,  1064 => 245,  1041 => 244,  1024 => 230,  1012 => 221,  1000 => 212,  995 => 210,  991 => 209,  987 => 208,  980 => 206,  959 => 205,  954 => 202,  952 => 201,  948 => 199,  937 => 193,  916 => 192,  907 => 185,  886 => 184,  881 => 181,  860 => 180,  855 => 178,  848 => 176,  844 => 175,  840 => 173,  836 => 172,  829 => 167,  808 => 166,  804 => 164,  783 => 163,  779 => 161,  758 => 160,  747 => 151,  726 => 150,  722 => 149,  712 => 141,  691 => 140,  687 => 139,  654 => 128,  642 => 119,  635 => 114,  614 => 113,  607 => 109,  578 => 102,  568 => 94,  547 => 93,  541 => 92,  537 => 90,  516 => 89,  510 => 88,  506 => 86,  485 => 85,  479 => 84,  475 => 82,  454 => 81,  448 => 80,  444 => 78,  423 => 77,  417 => 76,  408 => 70,  380 => 64,  373 => 60,  369 => 59,  365 => 58,  332 => 47,  325 => 42,  321 => 39,  300 => 38,  296 => 37,  293 => 36,  290 => 34,  269 => 33,  241 => 29,  232 => 28,  223 => 27,  196 => 24,  186 => 23,  177 => 22,  150 => 19,  140 => 18,  131 => 17,  104 => 14,  94 => 13,  85 => 12,  58 => 9,  48 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "deleted_list.twig", "/home/mliadov/public_html/application/modules/users/views/gentelella/deleted_list.twig");
    }
}
