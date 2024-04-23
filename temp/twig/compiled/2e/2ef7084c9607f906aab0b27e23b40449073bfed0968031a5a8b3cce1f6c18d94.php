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

/* list_installed.twig */
class __TwigTemplate_ab2bf4587a967ccfe8692e221f463b57274b1ee4e57b24cdf1f1c791aea98665 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_installed.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"menu-level2 hidden-xs\">
    <ul class=\"nav nav-tabs bar_tabs\">
        <li class=\"active\"><a href=\"";
        // line 5
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_installed_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "</a></li>
        <li><a href=\"";
        // line 6
        echo ($context["site_url"] ?? null);
        echo "admin/themes/enable_themes\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_enable_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "</a></li>
    </ul>
    &nbsp;
</div>

<div class=\"menu-level2 visible-xs\">
    <ul class=\"nav nav-tabs tabs-left\">
        <li class=\"active\"><a href=\"";
        // line 13
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_installed_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "</a></li>
        <li><a href=\"";
        // line 14
        echo ($context["site_url"] ?? null);
        echo "admin/themes/enable_themes\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_enable_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "</a></li>
    </ul>
    &nbsp;
</div>

<div class=\"x_panel\">
    <div class=\"menu-level3 hidden-xs\">
        <ul class=\"nav nav-tabs bar_tabs\">
            <li class=\"";
        // line 22
        if ((($context["type"] ?? null) == "user")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter"] ?? null), "user", [])) {
            echo " hide";
        }
        echo "\"><a href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes/user\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_user_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo $this->getAttribute(($context["filter"] ?? null), "user", []);
        echo ")</a></li>
            <li class=\"";
        // line 23
        if ((($context["type"] ?? null) == "admin")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter"] ?? null), "admin", [])) {
            echo " hide";
        }
        echo "\"><a href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes/admin\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_admin_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo $this->getAttribute(($context["filter"] ?? null), "admin", []);
        echo ")</a></li>
        </ul>
        &nbsp;
    </div>

    <div class=\"menu-level3 visible-xs\">
        <ul class=\"nav nav-tabs tabs-left\">
            <li class=\"";
        // line 30
        if ((($context["type"] ?? null) == "user")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter"] ?? null), "user", [])) {
            echo " hide";
        }
        echo "\"><a href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes/user\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_user_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo $this->getAttribute(($context["filter"] ?? null), "user", []);
        echo ")</a></li>
            <li class=\"";
        // line 31
        if ((($context["type"] ?? null) == "admin")) {
            echo "active";
        }
        if ( !$this->getAttribute(($context["filter"] ?? null), "admin", [])) {
            echo " hide";
        }
        echo "\"><a href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/installed_themes/admin\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_admin_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo $this->getAttribute(($context["filter"] ?? null), "admin", []);
        echo ")</a></li>
        </ul>
        &nbsp;
    </div>

    <div class=\"row form-group\">
            <div class=\"col-md-2 col-sm-2 col-xs-6\">
                <select id=\"section_btn\" class=\"form-control\">
                    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 40
            echo "                        <option value=\"";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">";
            echo $this->getAttribute($context["item"], "theme", []);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "                </select>
            </div>
            <div class=\"col-md-2 col-sm-2 col-xs-6\">
                <div class=\"btn-group\">
                    <a id=\"edit_set\" onclick=\"";
        // line 46
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("themes"        ,"sets_btn_add"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "\" class=\"btn btn-primary\" data-url=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/edit_set/\" href=\"";
        echo ($context["site_url"] ?? null);
        echo "admin/themes/edit_set/\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_set"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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

    <table id=\"data\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
            <tr class=\"headings\">
                <th class=\"hidden-xs\">&nbsp;</th>
                <th>";
        // line 55
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_theme"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th class=\"hidden-xs\">";
        // line 56
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th>";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_active"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 63
            echo "                <tr class=\"even pointer\">
                    <td class=\"hidden-xs\">";
            // line 64
            if ($this->getAttribute($context["item"], "img", [])) {
                // line 65
                echo "                        <img src=\"";
                echo $this->getAttribute($context["item"], "img", []);
                echo "\" class=\"img\">";
            }
            // line 66
            echo "                    </td>
                    <td >
                        ";
            // line 68
            echo $this->getAttribute($context["item"], "theme", []);
            echo "
                        ";
            // line 69
            if ($this->getAttribute($context["item"], "default", [])) {
                echo "&nbsp;(";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_default"                ,"themes"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
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
                echo ")";
            }
            // line 70
            echo "                    </td>
                    <td class=\"hidden-xs\"><b>";
            // line 71
            echo $this->getAttribute($context["item"], "theme_name", []);
            echo "</b><br>";
            echo $this->getAttribute($context["item"], "theme_description", []);
            echo "</td>
                    <td>
                        ";
            // line 73
            if ($this->getAttribute($context["item"], "active", [])) {
                // line 74
                echo "                            ";
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
                // line 75
                echo "                        ";
            } else {
                // line 76
                echo "                            ";
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
                // line 77
                echo "                        ";
            }
            // line 78
            echo "                    </td>
                    <td class=\"icons\">
                        <div class=\"btn-group\">
                            ";
            // line 81
            if ( !$this->getAttribute($context["item"], "active", [])) {
                // line 82
                echo "                            <button type=\"button\" class=\"btn btn-primary\"
                                    title=\"";
                // line 83
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_activate_theme"                ,"themes"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
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
                                    onclick=\"";
                // line 84
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("themes"                ,"btn_activate"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
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
                echo "document.location.href = '";
                echo ($context["site_url"] ?? null);
                echo "admin/themes/activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1'\">
                                ";
                // line 85
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
                // line 86
                echo "                            </button>
                            ";
            }
            // line 88
            echo "
                            ";
            // line 89
            if (( !$this->getAttribute($context["item"], "active", []) &&  !$this->getAttribute($context["item"], "default", []))) {
                // line 90
                echo "                            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                    aria-haspopup=\"true\" aria-expanded=\"false\">
                                <span class=\"caret\"></span>
                                <span class=\"sr-only\">Toggle Dropdown</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                                ";
                // line 96
                if ( !$this->getAttribute($context["item"], "active", [])) {
                    // line 97
                    echo "                                <li onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("themes"                    ,"btn_activate"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                                    <a href=\"";
                    // line 98
                    echo ($context["site_url"] ?? null);
                    echo "admin/themes/activate/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/1\">
                                        ";
                    // line 99
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("make_active"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                    echo "                                    </a>
                                </li>
                                ";
                }
                // line 103
                echo "                                <li>
                                    ";
                // line 104
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("note_uninstall_theme"                ,"themes"                ,""                ,($context["js"] ?? null)                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                $context['note_uninstall'] = $result;
                // line 105
                echo "                                    <a class=\"delete_theme\" data-link=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/themes/uninstall/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" href=\"#\">
                                        ";
                // line 106
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_uninstall_theme"                ,"themes"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
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
                // line 107
                echo "                                    </a>
                                </li>
                            </ul>
                            ";
            }
            // line 111
            echo "                        </div>
                    </td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "        </tbody>
    </table>
    <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
        <thead>
            <tr class=\"headings\">
                <th class=\"hidden-xs\">&nbsp;</th>
                <th>";
        // line 121
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_theme"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th class=\"hidden-xs\">";
        // line 122
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_description"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th>";
        // line 123
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_active"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
                <th>&nbsp;</th>
            </tr>
        </thead>
        ";
        // line 127
        if (($context["sets"] ?? null)) {
            // line 128
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sets"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["items"]) {
                // line 129
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["items"]);
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 130
                    echo "                <tbody>
                    <tr ";
                    // line 131
                    if (($this->getAttribute($context["item"], "active", []) && $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "active", []))) {
                        echo "class=\"selected\"";
                    }
                    echo ">
                        <td class=\"hidden-xs\"><div style=\"margin: 2px; background-color: #";
                    // line 132
                    echo $this->getAttribute($this->getAttribute($context["item"], "color_settings", []), "main_bg", []);
                    echo "\">&nbsp;</div></td>
                        <td >
                            ";
                    // line 134
                    echo $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "theme", []);
                    echo "
                            ";
                    // line 135
                    if ($this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "default", [])) {
                        echo "&nbsp;(";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("field_default"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                        echo ")";
                    }
                    // line 136
                    echo "                        </td>
                        <td class=\"hidden-xs\"><b>";
                    // line 137
                    echo $this->getAttribute($context["item"], "set_name", []);
                    echo "</b><br>";
                    echo $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "theme_description", []);
                    echo "</td>
                        <td>
                            ";
                    // line 139
                    if (($this->getAttribute($context["item"], "active", []) && $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "active", []))) {
                        // line 140
                        echo "                                ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_tableicon_is_active"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                        echo "                            ";
                    } else {
                        // line 142
                        echo "                                ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_tableicon_is_not_active"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                        // line 143
                        echo "                            ";
                    }
                    // line 144
                    echo "                        </td>
                        <td class=\"icons\">
                            <div class=\"btn-group\">
                                ";
                    // line 147
                    if (( !$this->getAttribute($context["item"], "active", []) && $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "active", []))) {
                        // line 148
                        echo "                                    <button type=\"button\" class=\"btn btn-primary\" title=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_activate_set"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                            onclick = \"";
                        // line 149
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("themes"                        ,"sets_btn_activate"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                        echo "document.location.href = '";
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/activate_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/1/";
                        echo ($context["type"] ?? null);
                        echo "'\">";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("make_active_now"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                        // line 150
                        echo "                                    </button>
                                ";
                    } elseif (($this->getAttribute(                    // line 151
($context["theme"] ?? null), "theme_type", []) == "admin")) {
                        // line 152
                        echo "                                    <a class=\"btn btn-primary\" href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/edit_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\">
                                    ";
                        // line 153
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_edit_set"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                    } elseif ( !$this->getAttribute($this->getAttribute(                    // line 154
($context["true_theme"] ?? null), $context["key"], [], "array"), "active", [])) {
                        // line 155
                        echo "                                    <a class=\"btn btn-primary\" href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/edit_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\">
                                    ";
                        // line 156
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_edit_set"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                    } else {
                        // line 158
                        echo "                                    <a class=\"btn btn-primary\" href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/edit_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\">
                                    ";
                        // line 159
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_edit_set"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                    // line 161
                    echo "
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>

                                <ul class=\"dropdown-menu\">
                                    ";
                    // line 169
                    if (( !$this->getAttribute($context["item"], "active", []) && $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "active", []))) {
                        // line 170
                        echo "                                        <li onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("themes"                        ,"sets_btn_activate"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                            <a href=\"";
                        // line 171
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/activate_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/1/";
                        echo ($context["type"] ?? null);
                        echo "\">";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("make_active_now"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                        </li>
                                    ";
                    }
                    // line 174
                    echo "                                    <li>
                                        <a href=\"";
                    // line 175
                    echo ($context["site_url"] ?? null);
                    echo "admin/themes/preview/";
                    echo $this->getAttribute($this->getAttribute(($context["true_theme"] ?? null), $context["key"], [], "array"), "theme", []);
                    echo "/";
                    echo $this->getAttribute($context["item"], "set_gid", []);
                    echo "\" target=\"_blank\">
                                            ";
                    // line 176
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_preview_theme"                    ,"themes"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                                    </li>
                                    <li  onclick=\"";
                    // line 178
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("themes"                    ,"sets_btn_edit"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                                        <a href=\"";
                    // line 179
                    echo ($context["site_url"] ?? null);
                    echo "admin/themes/edit_set/";
                    echo $this->getAttribute($context["item"], "id_theme", []);
                    echo "/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                        ";
                    // line 180
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("edit_colours"                    ,"themes"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                                    </li>
                                    ";
                    // line 182
                    if ($this->getAttribute($context["item"], "active", [])) {
                        // line 183
                        echo "                                    <li  onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("themes"                        ,"sets_btn_regenerate_css"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                        <a href=\"";
                        // line 184
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/edit_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/1\">
                                        ";
                        // line 185
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("regenerate"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                    </li>
                                    ";
                    }
                    // line 188
                    echo "                                    <li onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("themes"                    ,"btn_edit"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                    echo "\" >
                                        <a href=\"";
                    // line 189
                    echo ($context["site_url"] ?? null);
                    echo "admin/themes/view_installed/";
                    echo $context["key"];
                    echo "/";
                    echo ($context["lang_id"] ?? null);
                    echo "/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "\">
                                        ";
                    // line 190
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("edit_logo"                    ,"themes"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
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
                                    </li>
                                    ";
                    // line 192
                    if ( !$this->getAttribute($context["item"], "active", [])) {
                        // line 193
                        echo "                                        <li>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("note_delete_set"                        ,"themes"                        ,""                        ,($context["js"] ?? null)                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        $context['note_delete'] = $result;
                        // line 194
                        echo "                                            <a class=\"delete_set\" href=\"#\" data-theme=\"";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "\" data-set=\"";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\" data-link=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/themes/delete_set/";
                        echo $this->getAttribute($context["item"], "id_theme", []);
                        echo "/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\">";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_delete_set"                        ,"themes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
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
                                        </li>
                                    ";
                    }
                    // line 197
                    echo "                                </ul>
                            </div>
                        </td>
                    </tr>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 202
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['items'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 203
            echo "            ";
        } else {
            // line 204
            echo "                <tr><td colspan=\"3\" class=\"center\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_sets"            ,"themes"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
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
            echo "</td></tr>
            ";
        }
        // line 206
        echo "        </tbody>
    </table>
</div>
<!-- Datatables -->
<script>
var asInitVals = new Array();
\$(document).ready(function() {
    var oTable = \$('#data').dataTable({
        \"oLanguage\": {
            \"sSearch\": \"";
        // line 215
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
        // line 216
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_themes"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        \"aoColumnDefs\": [{
                'bSortable': false,
                'aTargets': []
            } //disables sorting for column one
        ],
        'iDisplayLength': 10,
        \"bPaginate\": false,
        \"bInfo\": false,
        \"bSort\": false,
        \"bFilter\": false,
        \"dom\": 'T<\"clear\"><\"actions\">lfrtip',
    });
    \$(\"tfoot input\").keyup(function() {
        /* Filter on the column based on the index of this element's parent <th> */
        oTable.fnFilter(this.value, \$(\"tfoot th\").index(\$(this).parent()));
    });
    \$(\"tfoot input\").each(function(i) {
        asInitVals[i] = this.value;
    });
    \$(\"tfoot input\").focus(function() {
        if (this.className == \"search_init\") {
            this.className = \"\";
            this.value = \"\";
        }
    });
    \$(\"tfoot input\").blur(function(i) {
        if (this.value == \"\") {
            this.className = \"search_init\";
            this.value = asInitVals[\$(\"tfoot input\").index(this)];
        }
    });
    var actions = \$(\"#actions\");
    \$('#data_wrapper').find('.actions').html(actions.html());
    actions.remove();

    \$('#section_btn').change(function() {
        var href = \$('#edit_set').data('url');
        href = href + \$('#section_btn').val();
        \$('#edit_set').attr('href', href);
    });

    \$('#section_btn').val(\$(\"#section_btn option:first\").val()).change();



    var delete_set = new loadingContent({
        loadBlockSize: 'small',
        loadBlockLeftType: 'center',
        loadBlockTopType: 'center',
        closeBtnClass: 'close',
        footerButtons: '<input type=\"submit\" id=\"set_delete\" name=\"btn_confirm\" value=\"";
        // line 268
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "\" class=\"btn btn-primary\">'
    });

    var delete_theme = new loadingContent({
        loadBlockSize: 'small',
        loadBlockLeftType: 'center',
        loadBlockTopType: 'center',
        closeBtnClass: 'close',
        footerButtons: '<input type=\"submit\" id=\"theme_delete\" name=\"btn_confirm\" value=\"";
        // line 276
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_confirm"        ,"media"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "\" class=\"btn btn-primary\">'
    });

    var content_set = '<div class=\"load_content_controller\">' +
        '<div class=\"inside\">' + '<form><label class=\"col-xs-12\">' + '";
        // line 280
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("note_delete_set"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "' + '</label></form>' +
        '</div>' +
        '</div>';

    var content_theme = '<div class=\"load_content_controller\">' +
        '<div class=\"inside\">' + '<form><label class=\"col-xs-12\">' + '";
        // line 285
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("note_delete_theme"        ,"themes"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
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
        echo "' + '</label></form>' +
        '</div>' +
        '</div>';

    \$(document).off('click', '.delete_set').on('click', '.delete_set', function(e) {
        e.preventDefault();
        var link = \$(this).data('link');
        delete_set.show_load_block(content_set);
        \$('#set_delete').unbind('click').on('click', function(e) {
            \$.ajax({
                url: link,
                cache: false,
                success: function(data) {
                    location.reload();
                }
            });
        });
    });

    \$(document).off('click', '.delete_theme').on('click', '.delete_theme', function(e) {
        e.preventDefault();
        var link = \$(this).data('link');
        delete_theme.show_load_block(content_theme);
        \$('#theme_delete').unbind('click').on('click', function(e) {
            \$.ajax({
                url: link,
                cache: false,
                success: function(data) {
                    location.reload();
                }
            });
        });
    });

});
</script>

";
        // line 322
        $this->loadTemplate("@app/footer.twig", "list_installed.twig", 322)->display($context);
    }

    public function getTemplateName()
    {
        return "list_installed.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1794 => 322,  1735 => 285,  1708 => 280,  1682 => 276,  1652 => 268,  1578 => 216,  1555 => 215,  1544 => 206,  1519 => 204,  1516 => 203,  1510 => 202,  1500 => 197,  1464 => 194,  1442 => 193,  1440 => 192,  1416 => 190,  1406 => 189,  1382 => 188,  1357 => 185,  1349 => 184,  1325 => 183,  1323 => 182,  1299 => 180,  1291 => 179,  1268 => 178,  1244 => 176,  1236 => 175,  1233 => 174,  1200 => 171,  1176 => 170,  1174 => 169,  1164 => 161,  1140 => 159,  1131 => 158,  1107 => 156,  1098 => 155,  1096 => 154,  1073 => 153,  1064 => 152,  1062 => 151,  1059 => 150,  1009 => 149,  985 => 148,  983 => 147,  978 => 144,  975 => 143,  953 => 142,  950 => 141,  928 => 140,  926 => 139,  919 => 137,  916 => 136,  891 => 135,  887 => 134,  882 => 132,  876 => 131,  873 => 130,  868 => 129,  863 => 128,  861 => 127,  835 => 123,  812 => 122,  789 => 121,  781 => 115,  772 => 111,  766 => 107,  745 => 106,  738 => 105,  717 => 104,  714 => 103,  709 => 100,  688 => 99,  682 => 98,  658 => 97,  656 => 96,  648 => 90,  646 => 89,  643 => 88,  639 => 86,  618 => 85,  591 => 84,  568 => 83,  565 => 82,  563 => 81,  558 => 78,  555 => 77,  533 => 76,  530 => 75,  508 => 74,  506 => 73,  499 => 71,  496 => 70,  471 => 69,  467 => 68,  463 => 66,  458 => 65,  456 => 64,  453 => 63,  449 => 62,  422 => 57,  399 => 56,  376 => 55,  320 => 46,  314 => 42,  303 => 40,  299 => 39,  258 => 31,  224 => 30,  184 => 23,  150 => 22,  118 => 14,  93 => 13,  62 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_installed.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\themes\\views\\gentelella\\list_installed.twig");
    }
}
