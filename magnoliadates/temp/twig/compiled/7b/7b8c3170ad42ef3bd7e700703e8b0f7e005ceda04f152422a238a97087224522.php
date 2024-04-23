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

/* list_services.twig */
class __TwigTemplate_23790588fe957015a7b91bd96e6d08c8ce33ebbf63ca768e57c1f8f50b2842aa extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_services.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 7
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_social_networking_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "            </ul>
        </div>

    ";
        // line 11
        if (($context["allow_add"] ?? null)) {
            // line 12
            echo "        <div class=\"x_title\">
            <a href=\"";
            // line 13
            echo ($context["site_url"] ?? null);
            echo "admin/social_networking/service_edit\" class=\"btn btn-primary\">
                ";
            // line 14
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_add_service"            ,"social_networking"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 15
            echo "            </a>
            <div class=\"clearfix\"></div>
        </div>
    ";
        }
        // line 19
        echo "        <div class=\"x_content\">
            <table id=\"data\" class=\"table table-striped jambo_table\" width=\"100%\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-title\">";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"social_networking"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_oauth"        ,"social_networking"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 25
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_active"        ,"social_networking"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    </tr>
                </thead>
                ";
        // line 29
        if (($context["services"] ?? null)) {
            // line 30
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["services"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 31
                echo "                        <tr>
                            <td>";
                // line 32
                echo $this->getAttribute($context["item"], "name", []);
                echo "</td>
                            <td>
                                ";
                // line 34
                if ($this->getAttribute($context["item"], "oauth_enabled", [])) {
                    // line 35
                    echo "                                    ";
                    if ($this->getAttribute($context["item"], "oauth_status", [])) {
                        // line 36
                        echo "                                        <a onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("social"                        ,"btn_login_yes"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\" type=\"button\" class=\"btn btn-primary networkinkg-status\" title=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("note_disable_login"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                                href=\"";
                        // line 37
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/oauth_active/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/0\">
                                            ";
                        // line 38
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_tableicon_yes"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                                        </a>
                                    ";
                    } else {
                        // line 41
                        echo "                                        <a onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("social"                        ,"btn_login_no"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\" type=\"button\" class=\"btn btn-primary networkinkg-status\" target=\"_blank\" title=\"";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("note_enable_login"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                                href=\"";
                        // line 42
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/oauth_active/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/1\">
                                            ";
                        // line 43
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_tableicon_no"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 44
                        echo "                                        </a>
                                    ";
                    }
                    // line 46
                    echo "                                ";
                }
                // line 47
                echo "                            </td>
                            <td class=\"text-center\">
                                ";
                // line 49
                if ($this->getAttribute($context["item"], "status", [])) {
                    // line 50
                    echo "                                    <a onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("social"                    ,"btn_widgets_yes"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\" type=\"button\" class=\"btn btn-primary\" title=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("note_disable_widget"                    ,"social_networking"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            href=\"";
                    // line 51
                    echo ($context["site_url"] ?? null);
                    echo "admin/social_networking/service_active/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/0\">
                                        ";
                    // line 52
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_tableicon_yes"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 53
                    echo "                                    </a>
                                ";
                } else {
                    // line 55
                    echo "                                    <a onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("social"                    ,"btn_widgets_no"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\" type=\"button\" class=\"btn btn-primary btn-outline\" title=\"";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("note_enable_widget"                    ,"social_networking"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            href=\"";
                    // line 56
                    echo ($context["site_url"] ?? null);
                    echo "admin/social_networking/service_active/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/1\">
                                        ";
                    // line 57
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_tableicon_no"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 58
                    echo "                                    </a>
                                ";
                }
                // line 60
                echo "                            </td>
                            <td class=\"icons\">
                              ";
                // line 62
                if ((($this->getAttribute($context["item"], "app_enabled", []) || ($context["allow_edit"] ?? null)) || ($context["allow_delete"] ?? null))) {
                    // line 63
                    echo "                                <div class=\"btn-group\">
                                  ";
                    // line 64
                    if ($this->getAttribute($context["item"], "app_enabled", [])) {
                        // line 65
                        echo "                                  <a onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("social"                        ,"btn_application"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "\" href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/application/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/\" class=\"btn btn-primary\">
                                      ";
                        // line 66
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_application"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 67
                        echo "                                  </a>
                                  ";
                    } elseif (                    // line 68
($context["allow_edit"] ?? null)) {
                        // line 69
                        echo "                                    <a href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/service_edit/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\" class=\"btn btn-primary\"
                                       title=\"";
                        // line 70
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_edit_service"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        // line 71
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_edit"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 72
                        echo "                                    </a>
                                  ";
                    } elseif (                    // line 73
($context["allow_delete"] ?? null)) {
                        // line 74
                        echo "                                    <a href=\"";
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/service_delete/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\" class=\"btn btn-primary\"
                                      title=\"";
                        // line 75
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_delete_service"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                      onclick=\"javascript: if (!confirm('";
                        // line 76
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("note_delete_service"                        ,"social_networking"                        ,""                        ,"js"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "')) return false;\">
                                        ";
                        // line 77
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_delete"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                                    </a>
                                  ";
                    }
                    // line 80
                    echo "                                  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                          aria-haspopup=\"true\" aria-expanded=\"false\">
                                      <span class=\"caret\"></span>
                                      <span class=\"sr-only\">Toggle Dropdown</span>
                                  </button>
                                  <ul class=\"dropdown-menu\">
                                      ";
                    // line 86
                    if ($this->getAttribute($context["item"], "app_enabled", [])) {
                        // line 87
                        echo "                                      <li onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("social"                        ,"btn_application"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        // line 88
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/application/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "/\">
                                            ";
                        // line 89
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_application"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                                        </a>
                                      </li>
                                      ";
                    }
                    // line 93
                    echo "                                      ";
                    if (($context["allow_edit"] ?? null)) {
                        // line 94
                        echo "                                      <li>
                                        <a href=\"";
                        // line 95
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/service_edit/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\"
                                           title=\"";
                        // line 96
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_edit_service"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        // line 97
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_edit"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 98
                        echo "                                        </a>
                                      </li>
                                      ";
                    }
                    // line 101
                    echo "                                      ";
                    if (($context["allow_delete"] ?? null)) {
                        // line 102
                        echo "                                      <li>
                                        <a href=\"";
                        // line 103
                        echo ($context["site_url"] ?? null);
                        echo "admin/social_networking/service_delete/";
                        echo $this->getAttribute($context["item"], "id", []);
                        echo "\" class=\"btn btn-primary\"
                                          title=\"";
                        // line 104
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("link_delete_service"                        ,"social_networking"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                          onclick=\"javascript: if (!confirm('";
                        // line 105
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("note_delete_service"                        ,"social_networking"                        ,""                        ,"js"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "')) return false;\">
                                            ";
                        // line 106
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("btn_delete"                        ,"start"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                                        </a>
                                      </li>
                                      ";
                    }
                    // line 110
                    echo "                                  </ul>
                                </div>
                              ";
                }
                // line 113
                echo "                            </td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 116
            echo "                ";
        }
        // line 117
        echo "            </table>
        </div>
    </div>
</div>

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 128
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
        // line 129
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_services"        ,"social_networking"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        \$('#data_wrapper').find('.actions').html(actions.html());
        actions.remove();
    });
</script>

";
        // line 167
        $this->loadTemplate("@app/footer.twig", "list_services.twig", 167)->display($context);
    }

    public function getTemplateName()
    {
        return "list_services.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1034 => 167,  974 => 129,  951 => 128,  938 => 117,  935 => 116,  927 => 113,  922 => 110,  917 => 107,  896 => 106,  873 => 105,  850 => 104,  844 => 103,  841 => 102,  838 => 101,  833 => 98,  812 => 97,  789 => 96,  783 => 95,  780 => 94,  777 => 93,  772 => 90,  751 => 89,  745 => 88,  721 => 87,  719 => 86,  711 => 80,  707 => 78,  686 => 77,  663 => 76,  640 => 75,  633 => 74,  631 => 73,  628 => 72,  607 => 71,  584 => 70,  577 => 69,  575 => 68,  572 => 67,  551 => 66,  523 => 65,  521 => 64,  518 => 63,  516 => 62,  512 => 60,  508 => 58,  487 => 57,  481 => 56,  436 => 55,  432 => 53,  411 => 52,  405 => 51,  360 => 50,  358 => 49,  354 => 47,  351 => 46,  347 => 44,  326 => 43,  320 => 42,  275 => 41,  271 => 39,  250 => 38,  244 => 37,  199 => 36,  196 => 35,  194 => 34,  189 => 32,  186 => 31,  181 => 30,  179 => 29,  153 => 25,  130 => 24,  107 => 23,  101 => 19,  95 => 15,  74 => 14,  70 => 13,  67 => 12,  65 => 11,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_services.twig", "/home/mliadov/public_html/application/modules/social_networking/views/gentelella/list_services.twig");
    }
}
