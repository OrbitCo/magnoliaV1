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
class __TwigTemplate_308fdb350165abe8fdbac4d41c5fc5a21e58e45dab18c1be1f86e33aeb0716e7 extends \Twig\Template
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
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 7
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_virtual_gifts_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
                <div class=\"btn-group\">
                    <a href=\"";
        // line 13
        echo ($context["site_url"] ?? null);
        echo "admin/virtual_gifts/upload\" class=\"btn btn-primary\">
                        ";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_upload_image"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                    </a>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                            aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"";
        // line 23
        echo ($context["site_url"] ?? null);
        echo "admin/virtual_gifts/upload\">
                                ";
        // line 24
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_upload_image"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 25
        echo "                            </a>
                        </li>
                        <li id=\"delete_select_block\">
                            <a href=\"javascript:void(0)\">
                                ";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_delete_gift"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        <li id=\"link_add_funds\">
                            <a id=\"btn_add_funds\" href=\"javascript:void(0)\">
                                ";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_change_price"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    </ul>
                </div>
            </div>
            <table id=\"virtual-gifts\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-group\"><input type=\"checkbox\" id=\"check-all\" class=\"flat\"></th>
                        <th class=\"column-title text-center\">";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gifts_by_order"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 43
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_image"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 44
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_price"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 45
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
                        <th class=\"bulk-actions\" colspan=\"5\">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["gifts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 53
            echo "                        <tr>
                            <td class=\"column-group\"><input type=\"checkbox\" class=\"grouping flat\" value=\"";
            // line 54
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" id=\"prod_";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\" data=\"table_records\"></td>
                            <td class=\"text-center\">
                                ";
            // line 56
            if ( !$this->getAttribute($this->getAttribute($context["item"], "sort", []), "first", [])) {
                // line 57
                echo "                                    <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/sort_gifts/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/up\" style=\"text-decoration: none;\">&uarr;</a>&nbsp;
                                ";
            }
            // line 59
            echo "                                ";
            if ( !$this->getAttribute($this->getAttribute($context["item"], "sort", []), "last", [])) {
                // line 60
                echo "                                    <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/sort_gifts/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/down\" style=\"text-decoration: none;\">&darr;</a>
                                ";
            }
            // line 62
            echo "                            </td>
                            <td>
                                <img src=\"";
            // line 64
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "mediafile", []), "thumbs_data", []), "big", []), "file_url", []);
            echo "\">
                            </td>
                            <td>";
            // line 66
            $module =             null;
            $helper =             'start';
            $name =             'currency_format_output';
            $params = array(["value" => $this->getAttribute(($context["item"] ?? null), "price", [])]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                            <td>
                              ";
            // line 68
            if ($this->getAttribute($context["item"], "is_active", [])) {
                // line 69
                echo "                                  ";
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
                // line 70
                echo "                              ";
            } else {
                // line 71
                echo "                                  ";
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
                // line 72
                echo "                              ";
            }
            // line 73
            echo "                            </td>
                            <td class=\"icons\">
                                <div class=\"btn-group\">
                                ";
            // line 76
            if ($this->getAttribute($context["item"], "is_active", [])) {
                // line 77
                echo "                                    <button type=\"button\" class=\"btn btn-primary\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("admin_deactivate_gift"                ,"virtual_gifts"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            onclick=\"document.location.href='";
                // line 78
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/gift_status/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/0'\">
                                        ";
                // line 79
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
                // line 80
                echo "                                    </button>
                                ";
            } else {
                // line 82
                echo "                                    <button type=\"button\" class=\"btn btn-primary\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("admin_activate_gift"                ,"virtual_gifts"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                            onclick=\"document.location.href='";
                // line 83
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/gift_status/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1'\">
                                        ";
                // line 84
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
                // line 85
                echo "                                    </button>
                                ";
            }
            // line 87
            echo "                                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                        <span class=\"caret\"></span>
                                        <span class=\"sr-only\">Toggle Dropdown</span>
                                    </button>
                                    <ul class=\"dropdown-menu\">
                                        <li>
                                        ";
            // line 94
            if ($this->getAttribute($context["item"], "is_active", [])) {
                // line 95
                echo "                                            <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/gift_status/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/0\">
                                                ";
                // line 96
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
                // line 97
                echo "                                            </a>
                                        ";
            } else {
                // line 99
                echo "                                            <a href=\"";
                echo ($context["site_url"] ?? null);
                echo "admin/virtual_gifts/gift_status/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1\">
                                                ";
                // line 100
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
                // line 101
                echo "                                            </a>
                                        ";
            }
            // line 103
            echo "                                        </li>
                                        <li>
                                            <a href=\"";
            // line 105
            echo ($context["site_url"] ?? null);
            echo "admin/virtual_gifts/delete/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"
                                               onclick=\"javascript: if (!confirm('";
            // line 106
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("gift_delete_confirm"            ,"virtual_gifts"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 107
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_delete_gift"            ,"virtual_gifts"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 108
            echo "                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 115
        echo "                </tbody>
            </table>
            ";
        // line 117
        $this->loadTemplate("@app/pagination.twig", "list.twig", 117)->display($context);
        // line 118
        echo "        </div>
    </div>
</div>
";
        // line 121
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
        // line 122
        echo "<link href='";
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css' rel='stylesheet' type='text/css' media='screen' />
<script type=\"text/javascript\">
    var add_funds_link = \"";
        // line 124
        echo ($context["site_url"] ?? null);
        echo "admin/virtual_gifts/ajax_change_price\";
    var add_funds_form_link = \"";
        // line 125
        echo ($context["site_url"] ?? null);
        echo "admin/virtual_gifts/ajax_change_price_form\";
    \$(function() {
        loading_funds = new loadingContent({
            loadBlockSize: 'big',
            loadBlockTitle: '";
        // line 129
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_price_change"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            footerButtons: '<input type=\"button\" name=\"btn_save\" value=\"";
        // line 130
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_price_change"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\" onclick=\"javascript: send_add_funds();\" class=\"btn btn-primary\">'
        });
        \$(document).off('click', '#btn_add_funds').on('click', '#btn_add_funds', function() {
            open_add_funds(add_funds_form_link);
            return false;
        });
    });
    function open_add_funds(url) {
        var gifts = [];
        \$(\".grouping:checked\").each(function(i) {
                gifts[i] = \$(this).val();
            });
        if (gifts.length > 0) {
            \$.ajax({
                url: url,
                type: 'post',
                cache: false,
                data: {\"gifts\":gifts},
                success: function(data){
                    loading_funds.show_load_block(data);
                }
            });
        } else {
            error_object.show_error_block('";
        // line 153
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_gift_not_chosen"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
    }
    function send_add_funds() {
        delete gifts;
        var gifts = [];
        \$('.grouping:checked').each(function(i){
            gifts[i] = \$(this).val();
        });
        if (gifts.length > 0) {
            \$.ajax({
                url: add_funds_link,
                type: 'POST',
                cache: false,
                data: {\"amount\": \$('#add_fund_amount').val(), \"gift_ids\": gifts},
                success: function(data){
                    if (typeof (data.error) != 'undefined' && data.error != ''){
                        error_object.show_error_block(data.error, 'error');
                    } else {
                        location.reload();
                    }
                }
            });
        } else {
            error_object.show_error_block('";
        // line 177
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_gift_not_chosen"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
    }

</script>

<script type=\"text/javascript\">
    var reload_link = \"";
        // line 184
        echo ($context["site_url"] ?? null);
        echo "admin/virtual_gifts/\";
        var order = '";
        // line 185
        echo ($context["order"] ?? null);
        echo "';
        var loading_content;
        var order_direction = '";
        // line 187
        echo ($context["order_direction"] ?? null);
        echo "';
        \$(document).off('click', '#delete_select_block').on('click', '#delete_select_block', function() {
            if (!confirm(\"";
        // line 189
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_delete_confirm"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\")) return false;
            var gifts = new Array();
            \$('.grouping:checked').each(function(i) {
                gifts[i] = \$(this).val();
            });
            if (gifts.length > 0) {
                \$.ajax({
                    url: site_url + 'admin/virtual_gifts/ajax_delete_gifts/',
                    data: {\"gift_ids\": gifts},
                    type: \"POST\",
                    cache: false,
                    success: function(data) {
                        location.reload();
                    }
                });
            } else {
                error_object.show_error_block('";
        // line 205
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("error_gift_not_chosen"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#virtual-gifts').dataTable({
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
        $params = array("gifts_empty"        ,"virtual_gifts"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    'aTargets': [0,2,4]
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
        \$('#virtual-gifts_wrapper').find('.actions').html(actions.html());
        actions.remove();
    });
</script>

";
        // line 254
        $this->loadTemplate("@app/footer.twig", "list.twig", 254)->display($context);
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
        return array (  1026 => 254,  966 => 216,  943 => 215,  911 => 205,  873 => 189,  868 => 187,  863 => 185,  859 => 184,  830 => 177,  784 => 153,  739 => 130,  716 => 129,  709 => 125,  705 => 124,  698 => 122,  677 => 121,  672 => 118,  670 => 117,  666 => 115,  654 => 108,  633 => 107,  610 => 106,  604 => 105,  600 => 103,  596 => 101,  575 => 100,  568 => 99,  564 => 97,  543 => 96,  536 => 95,  534 => 94,  525 => 87,  521 => 85,  500 => 84,  494 => 83,  470 => 82,  466 => 80,  445 => 79,  439 => 78,  415 => 77,  413 => 76,  408 => 73,  405 => 72,  383 => 71,  380 => 70,  358 => 69,  356 => 68,  332 => 66,  327 => 64,  323 => 62,  315 => 60,  312 => 59,  304 => 57,  302 => 56,  295 => 54,  292 => 53,  288 => 52,  259 => 45,  236 => 44,  213 => 43,  190 => 42,  159 => 33,  133 => 29,  127 => 25,  106 => 24,  102 => 23,  92 => 15,  71 => 14,  67 => 13,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/gentelella/list.twig");
    }
}
