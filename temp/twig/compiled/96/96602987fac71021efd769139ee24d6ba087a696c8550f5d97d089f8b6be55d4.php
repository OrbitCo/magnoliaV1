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

/* list_banners.twig */
class __TwigTemplate_73eaa287f267f17762b8f1664484eeb3544ce3566de6373b73932f4b2a001422 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_banners.twig", 1)->display($context);
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
        $params = array("admin_banners_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        <div class=\"x_title\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
                    <label class=\"btn btn-default";
        // line 13
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "admin")) {
            echo " active";
        }
        if (($this->getAttribute(($context["filter_data"] ?? null), "admin", []) == 0)) {
            echo " disabled";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           ";
        // line 15
        if (($this->getAttribute(($context["filter_data"] ?? null), "admin", []) > 0)) {
            echo "onclick=\"document.location.href='";
            echo ($context["site_url"] ?? null);
            echo "admin/banners/index/admin'\"";
        }
        echo ">
                        <input type=\"radio\">
                        ";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_admin_banners"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo $this->getAttribute(($context["filter_data"] ?? null), "admin", []);
        echo ")
                    </label>
                    <label class=\"btn btn-default";
        // line 19
        if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "user")) {
            echo " active";
        }
        if (($this->getAttribute(($context["filter_data"] ?? null), "user", []) == 0)) {
            echo " disabled";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           ";
        // line 21
        if (($this->getAttribute(($context["filter_data"] ?? null), "user", []) > 0)) {
            echo "onclick=\"document.location.href='";
            echo ($context["site_url"] ?? null);
            echo "admin/banners/index/user'\"";
        }
        echo ">
                        <input type=\"radio\">
                        ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_users_banners"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo $this->getAttribute(($context["filter_data"] ?? null), "user", []);
        echo ")
                    </label>
                </div>
            </div>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
                <div class=\"btn-group\">
                    <a id=\"banners_link_add\" href=\"";
        // line 32
        echo ($context["site_url"] ?? null);
        echo "admin/banners/edit\" class=\"btn btn-primary\">
                        ";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_banner"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                    </a>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a id=\"banners_link_add\" href=\"";
        // line 42
        echo ($context["site_url"] ?? null);
        echo "admin/banners/edit\">
                                ";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_banner"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                            </a>
                        </li>
                        <li>
                            <a id=\"banners_link_update\" href=\"";
        // line 47
        echo ($context["site_url"] ?? null);
        echo "admin/banners/update_hour_statistic\">
                                ";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("update_statistic_manually"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 49
        echo "                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table display\">
                <thead>
                    <tr class=\"headings text-center\">
                        <th class=\"column-title xs-hide text-center\">
                            ";
        // line 58
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_number"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                        </th>
                        <th class=\"column-title text-center\">
                            &nbsp;
                        </th>
                        <th class=\"column-title text-center\">
                            ";
        // line 64
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 65
        echo "                        </th>
                        <th class=\"column-title text-center\">
                            ";
        // line 67
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_location"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 68
        echo "                        </th>
                        <th class=\"column-title xs-hide text-center\">
                            ";
        // line 70
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_limitations"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                        </th>
                        <th class=\"column-title text-center\">
                            ";
        // line 73
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
        // line 74
        echo "                        </th>
                        <th class=\"column-title text-center\">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["banners"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
            // line 82
            echo "                    <tr class=\"even pointer\">
                        <td class=\"center xs-hide\">";
            // line 83
            echo $this->getAttribute($context["loop"], "index", []);
            echo "</td>
                        <td class=\"center view-banner\">
                            <i class=\"far fa-eye cursor-pointer\" id=\"view_";
            // line 85
            echo $this->getAttribute($context["banner"], "id", []);
            echo "\"
                               alt=\"";
            // line 86
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_view_banner"            ,"banners"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                               title=\"";
            // line 87
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_view_banner"            ,"banners"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\"></i>
                            <div id=\"view_";
            // line 88
            echo $this->getAttribute($context["banner"], "id", []);
            echo "_content\" class=\"preview\"></div>
                        </td>
                        <td class=\"center\">
                            ";
            // line 91
            echo $this->getAttribute($context["banner"], "name", []);
            echo "
                            ";
            // line 92
            if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "user")) {
                echo "(";
                echo $this->getAttribute($this->getAttribute($context["banner"], "user", []), "output_name", []);
                echo ")";
            }
            // line 93
            echo "                        </td>
                        <td class=\"center\">
                            ";
            // line 95
            if ($this->getAttribute($context["banner"], "banner_place_obj", [])) {
                // line 96
                echo "                                ";
                echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "name", []);
                echo " ";
                echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "width", []);
                echo "X";
                echo $this->getAttribute($this->getAttribute($context["banner"], "banner_place_obj", []), "height", []);
                echo "
                            ";
            }
            // line 98
            echo "                        </td>
                        <td class=\"center xs-hide\">
                            ";
            // line 100
            if (($this->getAttribute($context["banner"], "approve", []) ==  -1)) {
                // line 101
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("declined"                ,"banners"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 102
                echo "                            ";
            } else {
                // line 103
                echo "                                ";
                $context["limit"] = "";
                // line 104
                echo "                                ";
                if ($this->getAttribute($context["banner"], "number_of_views", [])) {
                    // line 105
                    echo "                                    ";
                    $context["limit"] = true;
                    // line 106
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("shows"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo " - ";
                    echo $this->getAttribute($context["banner"], "number_of_views", []);
                    echo "
                                    <br/>
                                ";
                }
                // line 109
                echo "                                ";
                if ($this->getAttribute($context["banner"], "number_of_clicks", [])) {
                    // line 110
                    echo "                                    ";
                    $context["limit"] = true;
                    // line 111
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("clicks"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo " - ";
                    echo $this->getAttribute($context["banner"], "number_of_clicks", []);
                    echo "
                                    <br/>
                                ";
                }
                // line 114
                echo "                                ";
                if (($this->getAttribute($context["banner"], "expiration_date", []) && ($this->getAttribute($context["banner"], "expiration_date", []) != "0000-00-00 00:00:00"))) {
                    // line 115
                    echo "                                    ";
                    $context["limit"] = true;
                    // line 116
                    echo "                                    ";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("till"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo " - ";
                    $module =                     null;
                    $helper =                     'date_format';
                    $name =                     'tpl_date_format';
                    $params = array($this->getAttribute(($context["banner"] ?? null), "expiration_date", [])                    ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 117
                    echo "                                ";
                }
                // line 118
                echo "                                ";
                if ( !($context["limit"] ?? null)) {
                    // line 119
                    echo "                                    ";
                    if ($this->getAttribute($context["banner"], "status", [])) {
                        // line 120
                        echo "                                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("never_stop"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 121
                        echo "                                    ";
                    } elseif (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "admin")) {
                        // line 122
                        echo "                                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("text_banner_inactivated"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 123
                        echo "                                    ";
                    } elseif ((($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "user") && ($this->getAttribute($context["banner"], "approve", []) == 1))) {
                        // line 124
                        echo "                                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("approved"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                                    ";
                    } else {
                        // line 126
                        echo "                                        ";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("waiting_activation"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        // line 127
                        echo "                                    ";
                    }
                    // line 128
                    echo "                                ";
                }
                // line 129
                echo "                            ";
            }
            // line 130
            echo "                        </td>
                        <td class=\"text-center\">
                            ";
            // line 132
            if (($this->getAttribute($context["banner"], "approve", []) == 1)) {
                // line 133
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
                // line 134
                echo "                            ";
            } else {
                // line 135
                echo "                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("btn_tableicon_is_inactive"                ,"start"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 136
                echo "                            ";
            }
            // line 137
            echo "                        </td>
                        <td class=\"icons\">
                            <div class=\"btn-group\">
                        ";
            // line 140
            if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "admin")) {
                // line 141
                echo "                            ";
                if (($this->getAttribute($context["banner"], "approve", []) == 1)) {
                    // line 142
                    echo "                                <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/activate/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "/0\"
                                    id=\"banner_deactivate_";
                    // line 143
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "\"
                                    title=\"";
                    // line 144
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_deactivate_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                    class=\"btn btn-primary\">
                                    ";
                    // line 146
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("make_inactive"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                <span id=\"span_banner_deactivate_";
                    // line 147
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "\" class=\"hide\">
                                    <div class=\"tooltip-info\">
                                    ";
                    // line 149
                    if ($this->getAttribute($context["banner"], "views_left", [])) {
                        // line 150
                        echo "                                        <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("shows_left"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        echo $this->getAttribute($context["banner"], "views_left", []);
                        echo "<br>
                                    ";
                    }
                    // line 152
                    echo "                                    ";
                    if ($this->getAttribute($context["banner"], "clicks_left", [])) {
                        // line 153
                        echo "                                        <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("clicks_left"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        echo $this->getAttribute($context["banner"], "clicks_left", []);
                        echo "<br>
                                    ";
                    }
                    // line 155
                    echo "                                    ";
                    if (($this->getAttribute($context["banner"], "expiration_date", []) && ($this->getAttribute($context["banner"], "expiration_date", []) != "0000-00-00 00:00:00"))) {
                        // line 156
                        echo "                                        <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("till"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        $module =                         null;
                        $helper =                         'date_format';
                        $name =                         'tpl_date_format';
                        $params = array($this->getAttribute(($context["banner"] ?? null), "expiration_date", [])                        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "<br>
                                    ";
                    }
                    // line 158
                    echo "                                    </div>
                                </span>
                            ";
                } else {
                    // line 161
                    echo "                                <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/activate/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "/1\"
                                    title=\"";
                    // line 162
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_activate_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                    class=\"btn btn-primary\">
                                    ";
                    // line 164
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
                    echo "</a>
                            ";
                }
                // line 166
                echo "                        ";
            } else {
                // line 167
                echo "                            ";
                if ((($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "user") && ($this->getAttribute($context["banner"], "approve", []) == 0))) {
                    // line 168
                    echo "                                <a class=\"btn btn-primary\" href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/edit/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "/1\">
                                    ";
                    // line 169
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_edit_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 171
                    echo "                                <a class=\"btn btn-primary\" href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/edit/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "\">
                                    ";
                    // line 172
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_edit_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 174
                echo "                        ";
            }
            // line 175
            echo "                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                ";
            // line 181
            if (($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "admin")) {
                // line 182
                echo "                                    <li>
                                    ";
                // line 183
                if (($this->getAttribute($context["banner"], "approve", []) == 1)) {
                    // line 184
                    echo "                                        <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/activate/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "/0\"
                                            id=\"banner_deactivate_";
                    // line 185
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "\"
                                            title=\"";
                    // line 186
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_deactivate_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 187
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("make_inactive"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                        <span id=\"span_banner_deactivate_";
                    // line 188
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "\" class=\"hide\">
                                            <div class=\"tooltip-info\">
                                                ";
                    // line 190
                    if ($this->getAttribute($context["banner"], "views_left", [])) {
                        // line 191
                        echo "                                                    <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("shows_left"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        echo $this->getAttribute($context["banner"], "views_left", []);
                        echo "<br>
                                                ";
                    }
                    // line 193
                    echo "                                                ";
                    if ($this->getAttribute($context["banner"], "clicks_left", [])) {
                        // line 194
                        echo "                                                    <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("clicks_left"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        echo $this->getAttribute($context["banner"], "clicks_left", []);
                        echo "<br>
                                                ";
                    }
                    // line 196
                    echo "                                                ";
                    if (($this->getAttribute($context["banner"], "expiration_date", []) && ($this->getAttribute($context["banner"], "expiration_date", []) != "0000-00-00 00:00:00"))) {
                        // line 197
                        echo "                                                    <b>";
                        $module =                         null;
                        $helper =                         'lang';
                        $name =                         'l';
                        $params = array("till"                        ,"banners"                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo ":</b> ";
                        $module =                         null;
                        $helper =                         'date_format';
                        $name =                         'tpl_date_format';
                        $params = array($this->getAttribute(($context["banner"] ?? null), "expiration_date", [])                        ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])                        ,                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                        } elseif (function_exists($name)) {
                        $result = call_user_func_array($name, $params);
                        } else {
                        $result = '';
                        }
                        $output_buffer = @ob_get_contents();
                        @ob_end_clean();
                        echo $output_buffer.$result;
                        echo "<br>
                                                ";
                    }
                    // line 199
                    echo "                                            </div>
                                        </span>
                                    ";
                } else {
                    // line 202
                    echo "                                        <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/banners/activate/";
                    echo $this->getAttribute($context["banner"], "id", []);
                    echo "/1\"
                                            title=\"";
                    // line 203
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_activate_banner"                    ,"banners"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 204
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
                    echo "</a>
                                    ";
                }
                // line 206
                echo "                                    </li>
                                ";
            }
            // line 208
            echo "                                    <li>
                                    ";
            // line 209
            if ((($this->getAttribute(($context["page_data"] ?? null), "view_type", []) == "user") && ($this->getAttribute($context["banner"], "approve", []) == 0))) {
                // line 210
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/banners/edit/";
                echo $this->getAttribute($context["banner"], "id", []);
                echo "/1\">
                                            ";
                // line 211
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_banner"                ,"banners"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 213
                echo "                                        <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/banners/edit/";
                echo $this->getAttribute($context["banner"], "id", []);
                echo "\">
                                            ";
                // line 214
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_banner"                ,"banners"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 216
            echo "                                    </li>
                                ";
            // line 217
            if (($this->getAttribute($context["banner"], "status", []) == 1)) {
                // line 218
                echo "                                    <li>
                                        <a href='";
                // line 219
                echo ($context["site_url"] ?? null);
                echo "admin/banners/statistic/";
                echo $this->getAttribute($context["banner"], "id", []);
                echo "/'>
                                            ";
                // line 220
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_view_statistic"                ,"banners"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 223
            echo "                                    <li>
                                        <a onclick=\"return confirm('";
            // line 224
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("note_delete_banner"            ,"banners"            ,""            ,"js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "');\"
                                           href=\"";
            // line 225
            echo ($context["site_url"] ?? null);
            echo "admin/banners/delete/";
            echo $this->getAttribute($context["banner"], "id", []);
            echo "\">
                                            ";
            // line 226
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_delete_banner"            ,"banners"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 227
            echo "                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 234
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 237
        $this->loadTemplate("@app/pagination.twig", "list_banners.twig", 237)->display($context);
        // line 238
        echo "    </div>
</div>

<script type=\"text/javascript\">
    \$(function() {
        \$(\"td.view-banner > i\").click(function() {
            if (\$(\"td.view-banner > .preview\").html() != '') {
              \$(\"td.view-banner > .preview\").html('');
            } else {
              \$(\"td.view-banner > .preview\").html('');
              var banner_id =  \$(this).attr('id').replace(/\\D+/g, '');
              \$.ajax({
                  url: '";
        // line 250
        echo ($context["site_url"] ?? null);
        echo "admin/banners/preview/' + banner_id,
                  success: function(data){
                      \$('#view_' + banner_id + '_content').html(data).show();
                  }
              });
            }
        });
        \$(document).click(function(){\$(\"td.view-banner > .preview\").html('')});
    });
</script>

";
        // line 261
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
        // line 262
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<!-- Datatables -->
<script type=\"text/javascript\">
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 270
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
        // line 271
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_banners"        ,"banners"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    'aTargets': [0,4,5,6]
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
        // line 309
        $this->loadTemplate("@app/footer.twig", "list_banners.twig", 309)->display($context);
    }

    public function getTemplateName()
    {
        return "list_banners.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1718 => 309,  1658 => 271,  1635 => 270,  1622 => 262,  1601 => 261,  1587 => 250,  1573 => 238,  1571 => 237,  1566 => 234,  1546 => 227,  1525 => 226,  1519 => 225,  1496 => 224,  1493 => 223,  1468 => 220,  1462 => 219,  1459 => 218,  1457 => 217,  1454 => 216,  1430 => 214,  1423 => 213,  1399 => 211,  1392 => 210,  1390 => 209,  1387 => 208,  1383 => 206,  1359 => 204,  1336 => 203,  1329 => 202,  1324 => 199,  1278 => 197,  1275 => 196,  1248 => 194,  1245 => 193,  1218 => 191,  1216 => 190,  1211 => 188,  1188 => 187,  1165 => 186,  1161 => 185,  1154 => 184,  1152 => 183,  1149 => 182,  1147 => 181,  1139 => 175,  1136 => 174,  1112 => 172,  1105 => 171,  1081 => 169,  1074 => 168,  1071 => 167,  1068 => 166,  1044 => 164,  1020 => 162,  1013 => 161,  1008 => 158,  962 => 156,  959 => 155,  932 => 153,  929 => 152,  902 => 150,  900 => 149,  895 => 147,  872 => 146,  848 => 144,  844 => 143,  837 => 142,  834 => 141,  832 => 140,  827 => 137,  824 => 136,  802 => 135,  799 => 134,  777 => 133,  775 => 132,  771 => 130,  768 => 129,  765 => 128,  762 => 127,  740 => 126,  737 => 125,  715 => 124,  712 => 123,  690 => 122,  687 => 121,  665 => 120,  662 => 119,  659 => 118,  656 => 117,  613 => 116,  610 => 115,  607 => 114,  579 => 111,  576 => 110,  573 => 109,  545 => 106,  542 => 105,  539 => 104,  536 => 103,  533 => 102,  511 => 101,  509 => 100,  505 => 98,  495 => 96,  493 => 95,  489 => 93,  483 => 92,  479 => 91,  473 => 88,  450 => 87,  427 => 86,  423 => 85,  418 => 83,  415 => 82,  398 => 81,  389 => 74,  368 => 73,  364 => 71,  343 => 70,  339 => 68,  318 => 67,  314 => 65,  293 => 64,  286 => 59,  265 => 58,  254 => 49,  233 => 48,  229 => 47,  224 => 44,  203 => 43,  199 => 42,  189 => 34,  168 => 33,  164 => 32,  131 => 23,  122 => 21,  112 => 19,  86 => 17,  77 => 15,  67 => 13,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_banners.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\banners\\views\\gentelella\\list_banners.twig");
    }
}
