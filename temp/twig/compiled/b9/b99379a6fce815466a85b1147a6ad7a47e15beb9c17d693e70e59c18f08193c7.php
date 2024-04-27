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
class __TwigTemplate_a7e91f7ed3f50fbc204ed66ceef7deca5b85fb449b3530b53a64012edf3931d4 extends \Twig\Template
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
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
                <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
                    ";
        // line 7
        $module =         null;
        $helper =         'moderators';
        $name =         'count_ausers';
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
        echo $output_buffer.$result;
        // line 8
        echo "                    <label class=\"btn btn-default";
        if ((($context["filter"] ?? null) == "admin")) {
            echo " active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "admin", [])) {
            echo " disabled";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"";
        // line 10
        if ($this->getAttribute(($context["filter_data"] ?? null), "admin", [])) {
            echo "document.location.href='";
            echo ($context["site_url"] ?? null);
            echo "admin/ausers/index/admin'";
        } else {
            echo "return false;";
        }
        echo "\">
                        <input type=\"radio\" name=\"user_type\"";
        // line 11
        if ((($context["filter"] ?? null) == "admin")) {
            echo " selected";
        }
        echo ">
                        ";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_admin_users"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                </div>
            <div class=\"clearfix\"></div>
        </div>

        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
                <div class=\"btn-group\">
                    <a href=\"";
        // line 21
        echo ($context["site_url"] ?? null);
        echo "admin/ausers/edit\" class=\"btn btn-primary\">
                        ";
        // line 22
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_user"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 23
        echo "                    </a>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"";
        // line 31
        echo ($context["site_url"] ?? null);
        echo "admin/ausers/edit\">
                                ";
        // line 32
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_user"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                            </a>
                        </li>
                        ";
        // line 35
        $module =         null;
        $helper =         'moderators';
        $name =         'add_moderator';
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
        $context['add_moderator'] = $result;
        // line 36
        echo "                        ";
        if (twig_trim_filter(($context["add_moderator"] ?? null))) {
            // line 37
            echo "                        <li>
                            ";
            // line 38
            echo ($context["add_moderator"] ?? null);
            echo "
                        </li>
                        ";
        }
        // line 41
        echo "                    </ul>
                </div>
            </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-group hide\">
                            <input type=\"checkbox\" id=\"check-all\" class=\"flat\">
                        </th>
                        <th class=\"column-title\">
                            ";
        // line 51
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_nickname"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 52
        echo "                        </th>
                        <th class=\"column-title\">
                            ";
        // line 54
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 55
        echo "                        </th>
                        <th class=\"column-title\">
                            ";
        // line 57
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_email"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                        </th>
                        <th class=\"column-title\">
                            ";
        // line 60
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_date_created"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 61
        echo "                        </th>
                        <th class=\"column-title\">
                            ";
        // line 63
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
        // line 64
        echo "                        </th>
                        <th class=\"column-title\">&nbsp;</th>
                </thead>
                <tbody>
                    ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 69
            echo "                    <tr>
                        <td class=\"a-center hide\">
                            <input type=\"checkbox\" class=\"tableflat\" value=\"";
            // line 71
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data=\"table_records\">
                        </td>
                        <td>
                            ";
            // line 74
            echo $this->getAttribute($context["item"], "nickname", []);
            echo "
                        </td>
                        <td>
                            ";
            // line 77
            echo $this->getAttribute($context["item"], "name", []);
            echo "
                        </td>
                        <td>
                            ";
            // line 80
            echo $this->getAttribute($context["item"], "email", []);
            echo "
                        </td>
                        <td data-sort=\"";
            // line 82
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_make_timestamp';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_created", [])            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 83
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_created", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 84
            echo "                        </td>
                        <td>
                          ";
            // line 86
            if ($this->getAttribute($context["item"], "status", [])) {
                // line 87
                echo "                              ";
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
                // line 88
                echo "                          ";
            } else {
                // line 89
                echo "                              ";
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
                // line 90
                echo "                          ";
            }
            // line 91
            echo "                        </td>
                        <td class=\"icons\">
                            <div class=\"btn-group\">
                                ";
            // line 94
            if ((($context["active_count"] ?? null) == 1)) {
                // line 95
                echo "                                    <button type=\"button\"
                                        class=\"btn btn-primary\" title=\"";
                // line 96
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_user"                ,"ausers"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 97
                echo ($context["site_root"] ?? null);
                echo "admin/";
                echo $this->getAttribute($context["item"], "module", []);
                echo "/edit/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "'\">
                                            ";
                // line 98
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_user"                ,"ausers"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 99
                echo "                                    </button>
                                 ";
            } else {
                // line 101
                echo "                                    ";
                if ($this->getAttribute($context["item"], "status", [])) {
                    // line 102
                    echo "                                    <button type=\"button\"
                                        class=\"btn btn-primary\" title=\"";
                    // line 103
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_deactivate_user"                    ,"ausers"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 104
                    echo ($context["site_root"] ?? null);
                    echo "admin/";
                    echo $this->getAttribute($context["item"], "module", []);
                    echo "/activate/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/0'\">
                                            ";
                    // line 105
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
                    // line 106
                    echo "                                    </button>
                                    ";
                } else {
                    // line 108
                    echo "                                        <button type=\"button\"
                                            class=\"btn btn-primary\" title=\"";
                    // line 109
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("link_activate_user"                    ,"ausers"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 110
                    echo ($context["site_root"] ?? null);
                    echo "admin/";
                    echo $this->getAttribute($context["item"], "module", []);
                    echo "/activate/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/1'\">
                                                ";
                    // line 111
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
                    // line 112
                    echo "                                        </button>
                                    ";
                }
                // line 114
                echo "                                ";
            }
            // line 115
            echo "                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li>
                                    ";
            // line 122
            if ($this->getAttribute($context["item"], "status", [])) {
                // line 123
                echo "                                        ";
                if ((($context["active_count"] ?? null) > 1)) {
                    // line 124
                    echo "                                            <a href=\"";
                    echo ($context["site_root"] ?? null);
                    echo "admin/";
                    echo $this->getAttribute($context["item"], "module", []);
                    echo "/activate/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/0\">
                                                ";
                    // line 125
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
                    // line 126
                    echo "                                            </a>
                                        ";
                }
                // line 128
                echo "                                    ";
            } else {
                // line 129
                echo "                                        <a href=\"";
                echo ($context["site_root"] ?? null);
                echo "admin/";
                echo $this->getAttribute($context["item"], "module", []);
                echo "/activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1\">
                                                ";
                // line 130
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
                // line 131
                echo "                                        </a>
                                    ";
            }
            // line 133
            echo "                                    </li>
                                    <li>
                                        <a href=\"";
            // line 135
            echo ($context["site_root"] ?? null);
            echo "admin/";
            echo $this->getAttribute($context["item"], "module", []);
            echo "/edit/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                                            ";
            // line 136
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_edit_user"            ,"ausers"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 137
            echo "                                        </a>
                                    </li>
                                    ";
            // line 139
            if ((($context["active_count"] ?? null) > 1)) {
                // line 140
                echo "                                    <li>
                                        <a id=\"delete_admin\" href=\"";
                // line 141
                echo ($context["site_root"] ?? null);
                echo "admin/";
                echo $this->getAttribute($context["item"], "module", []);
                echo "/delete/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\">
                                            ";
                // line 142
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_delete_user"                ,"ausers"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                        </a>
                                    </li>
                                    ";
            }
            // line 146
            echo "                                </ul>
                            </div>
                        </td>
                    </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 154
        $this->loadTemplate("@app/pagination.twig", "list.twig", 154)->display($context);
        // line 155
        echo "    </div>
</div>

";
        // line 158
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
        // line 159
        echo "
<link href=\"";
        // line 160
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<!-- Datatables -->
";
        // line 164
        echo "
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
                \"sSearch\": \"";
        // line 177
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
        // line 178
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("ausers_list_empty"        ,"ausers"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    'aTargets': [0,6]
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

    \$('#delete_admin').off('click').on('click', function(){
        ";
        // line 216
        if ((($context["users_count"] ?? null) > 1)) {
            // line 217
            echo "            javascript: if(!confirm('";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("note_delete_user"            ,"ausers"            ,""            ,"js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "')) return false;
        ";
        } else {
            // line 219
            echo "            error_object.show_error_block('";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_delete_user"            ,"ausers"            ,""            ,"js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            return false;
        ";
        }
        // line 222
        echo "    });
</script>

";
        // line 225
        $this->loadTemplate("@app/footer.twig", "list.twig", 225)->display($context);
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
        return array (  1047 => 225,  1042 => 222,  1016 => 219,  991 => 217,  989 => 216,  929 => 178,  906 => 177,  891 => 164,  884 => 160,  881 => 159,  860 => 158,  855 => 155,  853 => 154,  848 => 151,  838 => 146,  833 => 143,  812 => 142,  804 => 141,  801 => 140,  799 => 139,  795 => 137,  774 => 136,  766 => 135,  762 => 133,  758 => 131,  737 => 130,  728 => 129,  725 => 128,  721 => 126,  700 => 125,  691 => 124,  688 => 123,  686 => 122,  677 => 115,  674 => 114,  670 => 112,  649 => 111,  641 => 110,  618 => 109,  615 => 108,  611 => 106,  590 => 105,  582 => 104,  559 => 103,  556 => 102,  553 => 101,  549 => 99,  528 => 98,  520 => 97,  497 => 96,  494 => 95,  492 => 94,  487 => 91,  484 => 90,  462 => 89,  459 => 88,  437 => 87,  435 => 86,  431 => 84,  410 => 83,  387 => 82,  382 => 80,  376 => 77,  370 => 74,  364 => 71,  360 => 69,  356 => 68,  350 => 64,  329 => 63,  325 => 61,  304 => 60,  300 => 58,  279 => 57,  275 => 55,  254 => 54,  250 => 52,  229 => 51,  217 => 41,  211 => 38,  208 => 37,  205 => 36,  184 => 35,  180 => 33,  159 => 32,  155 => 31,  145 => 23,  124 => 22,  120 => 21,  87 => 12,  81 => 11,  71 => 10,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\ausers\\views\\gentelella\\list.twig");
    }
}
