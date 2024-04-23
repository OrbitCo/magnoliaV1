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

/* admin_moder_list.twig */
class __TwigTemplate_5b897d5170d27003761f04648a9971fca931415d3c871991a0928f5907b15f9d extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "admin_moder_list.twig", 1)->display($context);
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
        $params = array("admin_moderation_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        if ((($context["type_name"] ?? null) == "all")) {
            echo " active";
        }
        echo "\"
                           data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                           onclick=\"document.location.href='";
        // line 15
        echo ($context["site_url"] ?? null);
        echo "admin/moderation'\">
                        <input type=\"radio\" name=\"looking_user_type\"";
        // line 16
        if ((($context["type_name"] ?? null) == "all")) {
            echo " selected";
        }
        echo ">
                        ";
        // line 17
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("all_objects"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                    </label>
                    ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["moder_types"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 20
            echo "                        ";
            if (($this->getAttribute($context["item"], "mtype", []) >= 0)) {
                // line 21
                echo "                            <label id=\"check_link\" class=\"btn btn-default";
                if ((($context["type_name"] ?? null) == $this->getAttribute($context["item"], "name", []))) {
                    echo " active";
                }
                echo "\"
                                   data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                                   onclick=\"document.location.href='";
                // line 23
                echo ($context["site_url"] ?? null);
                echo "admin/moderation/index/";
                echo $this->getAttribute($context["item"], "name", []);
                echo "'\">
                                <input type=\"radio\" name=\"looking_user_type\"";
                // line 24
                if ((($context["type_name"] ?? null) == $this->getAttribute($context["item"], "name", []))) {
                    echo " selected";
                }
                echo ">
                                ";
                // line 25
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array(("mtype_" . $this->getAttribute(($context["item"] ?? null), "name", []))                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo $this->getAttribute($context["item"], "count", []);
                echo ")
                            </label>
                        ";
            }
            // line 28
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                </div>
            </div>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
                <button type=\"button\" class=\"btn btn-primary\" id=\"btn_mass_approve\">
                    ";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("approve_object"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 37
        echo "                </button>
            </div>
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table\">
                <thead>
                <tr class=\"headings\">
                    <th class=\"column-group\"><input type=\"checkbox\" id=\"check-all\" class=\"flat\"></th>
                    <th class=\"column-title text-center\">";
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_date_add"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 44
        if ((($context["type_name"] ?? null) == "all")) {
            // line 45
            echo "                        <th class=\"column-title text-center\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("moder_object_type"            ,"moderation"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 47
        echo "                    <th class=\"column-title\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("moder_object"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                <tbody>
                ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 53
            echo "                    <tr class=\"even pointer\">
                        <td class=\"text-center\">
                            <input type=\"checkbox\" class=\"tableflat grouping\" value=\"";
            // line 55
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data=\"table_records\">
                        </td>
                        <td class=\"text-center\">";
            // line 57
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_add", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_literal", [])            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 58
            if ((($context["type_name"] ?? null) == "all")) {
                // line 59
                echo "                            <td class=\"text-center\" style=\"text-transform: capitalize\">
                                ";
                // line 60
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array(("mtype_" . $this->getAttribute(($context["item"] ?? null), "type_name", []))                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                            </td>
                        ";
            }
            // line 63
            echo "                        <td>
                            ";
            // line 64
            echo $this->getAttribute($context["item"], "html", []);
            echo "
                        </td>
                        <td class=\"icons\"  ";
            // line 66
            if (($this->getAttribute($context["item"], "type_name", []) == "media_content")) {
                echo " id=\"media_";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                echo "\" ";
            }
            echo ">

                            ";
            // line 69
            echo "                            <div class=\"btn-group\">
                                <button onclick=\"";
            // line 70
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("moderation"            ,"btn_approve"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "admin/moderation/approve/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "/'\"
                                        type=\"button\" class=\"btn btn-primary\">
                                    ";
            // line 72
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("approve_object"            ,"moderation"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 73
            echo "                                </button>
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li onclick=\"";
            // line 80
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("moderation"            ,"btn_approve"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 81
            echo ($context["site_url"] ?? null);
            echo "admin/moderation/approve/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "/\">
                                            ";
            // line 82
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("approve_object"            ,"moderation"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 83
            echo "                                        </a>
                                    </li>
                                    ";
            // line 85
            if ($this->getAttribute($context["item"], "avail_decline", [])) {
                // line 86
                echo "                                        ";
                if (($this->getAttribute($context["item"], "type_name", []) == "network_data")) {
                    // line 87
                    echo "                                            <li onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("moderation"                    ,"btn_decline"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                                <a data-title=\"";
                    // line 88
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("decline_object"                    ,"moderation"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\" href='";
                    echo ($context["site_url"] ?? null);
                    echo "admin/moderation/decline/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/'>
                                                    ";
                    // line 89
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("decline_object"                    ,"moderation"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    echo "                                                </a>
                                            </li>
                                        ";
                } else {
                    // line 93
                    echo "                                            <li class=\"moderation-action-js\" onclick=\"";
                    $module =                     null;
                    $helper =                     'start';
                    $name =                     'setAnalytics';
                    $params = array("moderation"                    ,"btn_decline"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                                <a data-title=\"";
                    // line 94
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("decline_object"                    ,"moderation"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    echo "\" href=\"#\" data-href='";
                    echo ($context["site_url"] ?? null);
                    echo "admin/moderation/decline/";
                    echo $this->getAttribute($context["item"], "id", []);
                    echo "/'>
                                                    ";
                    // line 95
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("decline_object"                    ,"moderation"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 96
                    echo "                                                </a>
                                            </li>
                                        ";
                }
                // line 99
                echo "                                    ";
            }
            // line 100
            echo "                                    ";
            if ($this->getAttribute($context["item"], "view_link", [])) {
                // line 101
                echo "                                        <li>
                                            <a href=\"";
                // line 102
                echo $this->getAttribute($context["item"], "view_link", []);
                echo "\" target=\"_blank\">
                                                ";
                // line 103
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("view_object"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 104
                echo "                                            </a>
                                        </li>
                                    ";
            }
            // line 107
            echo "                                    ";
            if ($this->getAttribute($context["item"], "edit_link", [])) {
                // line 108
                echo "                                        <li>
                                            <a href=\"";
                // line 109
                echo $this->getAttribute($context["item"], "edit_link", []);
                echo "\" target=\"_blank\">
                                                ";
                // line 110
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
                // line 111
                echo "                                            </a>
                                        </li>
                                    ";
            }
            // line 114
            echo "                                    ";
            if ($this->getAttribute($context["item"], "avail_delete", [])) {
                // line 115
                echo "                                        <li class=\"moderation-action-js\" onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("moderation"                ,"btn_delete"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            <a href=\"#\" data-href=\"";
                // line 116
                echo ($context["site_url"] ?? null);
                echo "admin/moderation/delete_object/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/\"
                                               onclick=\"javascript: if(!confirm('";
                // line 117
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("note_delete_object"                ,"moderation"                ,""                ,"js"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "')) return false;\" data-title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("delete_object"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 118
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("delete_object"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                            </a>
                                        </li>
                                    ";
            }
            // line 122
            echo "                                    ";
            if ($this->getAttribute($context["item"], "mark_adult", [])) {
                // line 123
                echo "                                        <li class=\"moderation-action-js-adult\" onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("moderation"                ,"btn_mark_as_adult"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 124
                echo ($context["site_url"] ?? null);
                echo "admin/moderation/mark_adult_object/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/\" data-title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("mark_adult"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 125
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("mark_adult"                ,"moderation"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                        </li>
                                    ";
            }
            // line 129
            echo "                                    ";
            if ((((($this->getAttribute($context["item"], "type_name", []) == "media_content") || ($this->getAttribute($context["item"], "type_name", []) == "user_logo")) && ($this->getAttribute($this->getAttribute($context["item"], "user_data", []), "upload_gid", []) != "gallery_video")) && ($this->getAttribute($this->getAttribute($context["item"], "user_data", []), "upload_gid", []) != "gallery_audio"))) {
                // line 130
                echo "                                        <li class=\"moderation-action-js-edit\" onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("moderation"                ,"btn_edit"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            <a data-click=\"view-media\"   ";
                // line 131
                if (($this->getAttribute($context["item"], "type_name", []) == "user_logo")) {
                    echo "  id=\"logo_";
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo "\"  ";
                }
                echo "  data-id-media=\"";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                echo "\" data-user-id=\"";
                echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id_owner", []);
                echo "\">
                                                ";
                // line 132
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
                // line 133
                echo "                                            </a>
                                        </li>

                                    ";
                // line 136
                if (($this->getAttribute($context["item"], "type_name", []) == "user_logo")) {
                    // line 137
                    echo "                                        <script>
                                            \$(function () {
                                                loadScripts(
                                                    \"";
                    // line 140
                    $module =                     null;
                    $helper =                     'utils';
                    $name =                     'jscript';
                    $params = array("users"                    ,"../views/flatty/js/users-avatar.js"                    ,"path"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    // line 142
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo " = new UsersAvatar({
                                                            site_url: site_url,
                                                            load_avatar_url: 'admin/users/ajax_load_avatar/',
                                                            recrop_url: 'admin/users/ajax_recrop_avatar/',
                                                            rotateUrl: 'admin/users/photoRotate/',
                                                            id_user: '";
                    // line 147
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo "',
                                                            saveAfterSelect: true,
                                                            haveAvatar: false,
                                                            userType: 'admin',
                                                            photo_id: 'logo_";
                    // line 151
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo "'
                                                        });
                                                    },
                                                    'user_avatar_";
                    // line 154
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo "',
                                                    {async: false}
                                                );
                                            });
                                        </script>
                                    ";
                }
                // line 160
                echo "                                    ";
                if (((($this->getAttribute($context["item"], "type_name", []) == "media_content") && ($this->getAttribute($this->getAttribute($context["item"], "user_data", []), "upload_gid", []) != "gallery_video")) && ($this->getAttribute($this->getAttribute($context["item"], "user_data", []), "upload_gid", []) != "gallery_audio"))) {
                    // line 161
                    echo "                                        <script>
                                            \$(function () {
                                                loadScripts(
                                                    \"";
                    // line 164
                    $module =                     null;
                    $helper =                     'utils';
                    $name =                     'jscript';
                    $params = array("media"                    ,"../views/flatty/js/media.js"                    ,"path"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                                        recent_mediagallery = new media({
                                                            siteUrl: site_url,
                                                            gallery_name: 'recent_mediagallery',
                                                            galleryContentPage: 1,
                                                            idUser: '";
                    // line 170
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id_owner", []);
                    echo "',
                                                            all_loaded: 1,
                                                            post_data: {filter_duplicate: 1},
                                                            load_on_scroll: false,
                                                            viewMediaUrl: 'admin/media/ajax_view_media',
                                                            galleryContentDiv: 'media_";
                    // line 175
                    echo $this->getAttribute($this->getAttribute($context["item"], "user_data", []), "id", []);
                    echo "',
                                                            direction: 'desc'
                                                        });
                                                    },
                                                    'recent_mediagallery',
                                                    {async: false}
                                                );
                                            });
                                        </script>
                                    ";
                }
                // line 185
                echo "                                    ";
            }
            // line 186
            echo "                                </ul>
                            </div>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
        echo "                </tbody>
            </table>
        </div>
        ";
        // line 194
        $this->loadTemplate("@app/pagination.twig", "admin_moder_list.twig", 194)->display($context);
        // line 195
        echo "    </div>
</div>

";
        // line 198
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
        // line 199
        echo "<link href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<!-- Datatables -->
<script type=\"text/javascript\">
    \$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green',
        });
    });
</script>
<script type=\"text/javascript\">
    var asInitVals = new Array();
    \$(function () {
        loadScripts(\"";
        // line 212
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

        var oTable = \$('#users').dataTable({
            \"order\": [[1, 'desc']],
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 217
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
        // line 218
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_objects"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    'aTargets': [";
        // line 226
        if ((($context["type_name"] ?? null) == "all")) {
            echo "0,4";
        } else {
            echo "0,3";
        }
        echo "]
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bInfo\": false,
            \"dom\": 'T<\"clear\"><\"actions\">lfrtip'
        });
        var actions = \$(\"#actions\");
        \$('#users_wrapper').find('.actions').html(actions.html());
        actions.remove();
        oTable.fnSort([[1, 'desc']]);
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
        moderation_block = new loadingContent({
            loadBlockWidth: '50%',
            footerButtons: '<a class=\"btn btn-primary btn-moder-action-js\" href=\"#\">";
        // line 259
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
        echo "</a>',
            closeBtnLabel: '";
        // line 260
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_close"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "'

        });
        var action = false;

        \$('.moderation-action-js').click(function(){
            moderation_block.show_load_block('<div id=\"moderation_block\">\\n\\
            <h3>";
        // line 267
        $module =         null;
        $helper =         'lang';
        $name =         'ld_header';
        $params = array("rejection_reason"        ,"moderation"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</h3>\\n\\
                <div class=\"load_content\">\\n\\
            <div class=\"form-group\"><div>";
        // line 269
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["rejection_reason"] ?? null), "option", []));
        foreach ($context['_seq'] as $context["key"] => $context["reason"]) {
            echo "<div class=\"checkbox\"><input type=\"radio\" value=\"";
            echo $context["key"];
            echo "\" name=\"rejection_reason\" class=\"flat\" id=\"rejection-reason-";
            echo $context["key"];
            echo "\" ><label for=\"rejection-reason-";
            echo $context["key"];
            echo "\" class=\"reason-text\">";
            echo $context["reason"];
            echo "</label></div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['reason'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div></div></div><div class=\"alert alert-danger hide\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_empty_reason"        ,"users"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</div></div>');
            action = \$(this).find('a').data('href');
            var title = \$(this).find('a').data('title');
            \$('.btn-moder-action-js').text(title).attr('href', action);
        });

        \$(document)
            .off('ifChanged', 'input[name=\"rejection_reason\"]').on('ifChanged', 'input[name=\"rejection_reason\"]', function () {
            var key = \$(this).val();
            \$('.btn-moder-action-js').attr('href', action+key);
            \$('#moderation_block').find('.alert-danger').addClass('hide')
        }).off('click', '.btn-moder-action-js').on('click', '.btn-moder-action-js', function () {
            if ( \$('input[name=\"rejection_reason\"]').is( \":checked\" ) === false) {
                \$('#moderation_block').find('.alert-danger').removeClass('hide');
                return false;
            }
        });

    });
    \$(document).off('click', '#btn_mass_approve').on('click', '#btn_mass_approve', function() {
        var data = new Array();
        \$('.grouping:checked').each(function(i){
            data[i] = \$(this).val();
        });
        if(data.length > 0){
            \$.ajax({
                url: site_url + 'admin/moderation/mass_approve/',
                data: {ids: data},
                type: \"POST\",
                cache: false,
                dataType: 'json',
                success: function(data){
                    if (typeof (data.redirect) !== 'undefined' && data.redirect.length > 0) {
                        locationHref(data.redirect);
                    }
                }
            });
        }else{
            error_object.show_error_block('";
        // line 307
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
</script>


";
        // line 313
        $this->loadTemplate("@app/footer.twig", "admin_moder_list.twig", 313)->display($context);
    }

    public function getTemplateName()
    {
        return "admin_moder_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1447 => 313,  1419 => 307,  1342 => 269,  1318 => 267,  1289 => 260,  1266 => 259,  1226 => 226,  1196 => 218,  1173 => 217,  1146 => 212,  1128 => 199,  1107 => 198,  1102 => 195,  1100 => 194,  1095 => 191,  1085 => 186,  1082 => 185,  1069 => 175,  1061 => 170,  1033 => 164,  1028 => 161,  1025 => 160,  1016 => 154,  1010 => 151,  1003 => 147,  995 => 142,  971 => 140,  966 => 137,  964 => 136,  959 => 133,  938 => 132,  926 => 131,  902 => 130,  899 => 129,  894 => 126,  873 => 125,  846 => 124,  822 => 123,  819 => 122,  814 => 119,  793 => 118,  749 => 117,  743 => 116,  719 => 115,  716 => 114,  711 => 111,  690 => 110,  686 => 109,  683 => 108,  680 => 107,  675 => 104,  654 => 103,  650 => 102,  647 => 101,  644 => 100,  641 => 99,  636 => 96,  615 => 95,  588 => 94,  564 => 93,  559 => 90,  538 => 89,  511 => 88,  487 => 87,  484 => 86,  482 => 85,  478 => 83,  457 => 82,  451 => 81,  428 => 80,  419 => 73,  398 => 72,  370 => 70,  367 => 69,  358 => 66,  353 => 64,  350 => 63,  346 => 61,  325 => 60,  322 => 59,  320 => 58,  297 => 57,  292 => 55,  288 => 53,  284 => 52,  256 => 47,  231 => 45,  229 => 44,  206 => 43,  198 => 37,  177 => 36,  168 => 29,  162 => 28,  135 => 25,  129 => 24,  123 => 23,  115 => 21,  112 => 20,  108 => 19,  105 => 18,  84 => 17,  78 => 16,  74 => 15,  67 => 13,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "admin_moder_list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\moderation\\views\\gentelella\\admin_moder_list.twig");
    }
}
