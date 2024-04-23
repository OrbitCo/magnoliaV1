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

/* list_feeds.twig */
class __TwigTemplate_fed4948cb7ff23ecf80a8e5fda758632fcedb3073fbb579af2fc162cd6eb7b45 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list_feeds.twig", 1)->display($context);
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
        $params = array("admin_news_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            <div id=\"news_lang\" class=\"btn-group\" data-toggle=\"buttons\">
                <label class=\"btn btn-default";
        // line 12
        if ((($context["id_lang"] ?? null) == 0)) {
            echo " active";
        }
        if ( !$this->getAttribute(($context["filter_data"] ?? null), 0, [])) {
            echo " hide";
        }
        echo "\"
                       data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                       onclick=\"document.location.href='";
        // line 14
        echo ($context["site_url"] ?? null);
        echo "admin/news/feeds/0'\">
                    <input type=\"radio\" name=\"looking_user_type\"";
        // line 15
        if ((($context["id_lang"] ?? null) == 0)) {
            echo " selected";
        }
        echo ">
                    ";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all_feeds"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo $this->getAttribute(($context["filter_data"] ?? null), 0, []);
        echo ")
                </label>
            ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["lid"] => $context["item"]) {
            // line 19
            echo "                <label id=\"check_link\" class=\"btn btn-default";
            if (($context["lid"] == ($context["id_lang"] ?? null))) {
                echo " active";
            }
            if ( !$this->getAttribute(($context["filter_data"] ?? null), $context["lid"], [], "array")) {
                echo " hide";
            }
            echo "\"
                       data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\"
                       onclick=\"document.location.href='";
            // line 21
            echo ($context["site_url"] ?? null);
            echo "admin/news/feeds/";
            echo $context["lid"];
            echo "'\">
                    <input type=\"radio\" name=\"looking_user_type\"";
            // line 22
            if (($context["lid"] == ($context["id_lang"] ?? null))) {
                echo " selected";
            }
            echo ">
                    ";
            // line 23
            echo $this->getAttribute($context["item"], "name", []);
            echo " (";
            echo $this->getAttribute(($context["filter_data"] ?? null), $context["lid"], [], "array");
            echo ")
                </label>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['lid'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "            </div>
        </div>
        <div class=\"x_content\">
            <div id=\"actions\" class=\"hide\">
              <div class=\"btn-group\">
                <a href=\"";
        // line 31
        echo ($context["site_url"] ?? null);
        echo "admin/news/feed_edit\" class=\"btn btn-primary\">
                    ";
        // line 32
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_feeds"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                </a>
                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                  <span class=\"caret\"></span>
                  <span class=\"sr-only\">Toggle Dropdown</span>
                </button>
                <ul class=\"dropdown-menu\">
                  <li>
                    <a href=\"";
        // line 41
        echo ($context["site_url"] ?? null);
        echo "admin/news/feed_edit\">
                        ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_add_feeds"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            <table id=\"users\" class=\"data table table-striped responsive-utilities jambo_table\">
                <thead>
                    <tr>
                        <th class=\"column-title\">";
        // line 50
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_date_add"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 51
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_feed_title"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 52
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
                    </tr>
                </thead>
                <tbody>
                ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["feeds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 58
            echo "                    <tr>
                        <td>
                          ";
            // line 60
            $module =             null;
            $helper =             'date_format';
            $name =             'tpl_date_format';
            $params = array($this->getAttribute(($context["item"] ?? null), "date_add", [])            ,$this->getAttribute(($context["date_format_st"] ?? null), "date_time_literal", [])            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                        </td>
                        <td>
                            <b>";
            // line 63
            echo $this->getAttribute($context["item"], "title", []);
            echo "</b>";
            if ($this->getAttribute($context["item"], "description", [])) {
                echo "<br>
                            <i>";
                // line 64
                echo $this->getAttribute($context["item"], "description", []);
                echo "</i>";
            }
            // line 65
            echo "                        </td>
                        <td>
                          ";
            // line 67
            if ($this->getAttribute($context["item"], "status", [])) {
                // line 68
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
                // line 69
                echo "                          ";
            } else {
                // line 70
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
                // line 71
                echo "                          ";
            }
            // line 72
            echo "                        </td>
                        <td class=\"icons\">
                          <div class=\"btn-group\">
                            ";
            // line 75
            if ($this->getAttribute($context["item"], "status", [])) {
                // line 76
                echo "                                <button type=\"button\" class=\"btn btn-primary\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_deactivate_feed"                ,"news"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 77
                echo ($context["site_url"] ?? null);
                echo "admin/news/feed_activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/0'\">
                                    ";
                // line 78
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
                // line 79
                echo "                                </button>
                            ";
            } else {
                // line 81
                echo "                                <button type=\"button\" class=\"btn btn-primary\" title=\"";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_activate_feed"                ,"news"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                // line 82
                echo ($context["site_url"] ?? null);
                echo "admin/news/feed_activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1'\">
                                    ";
                // line 83
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
                // line 84
                echo "                                </button>
                            ";
            }
            // line 86
            echo "                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                  ";
            // line 92
            if ($this->getAttribute($context["item"], "status", [])) {
                // line 93
                echo "                                    <li>
                                      <a href=\"";
                // line 94
                echo ($context["site_url"] ?? null);
                echo "admin/news/feed_activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/0\">
                                          ";
                // line 95
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
                // line 96
                echo "                                      </a>
                                    </li>
                                  ";
            } else {
                // line 99
                echo "                                    <li>
                                      <a href=\"";
                // line 100
                echo ($context["site_url"] ?? null);
                echo "admin/news/feed_activate/";
                echo $this->getAttribute($context["item"], "id", []);
                echo "/1\">
                                          ";
                // line 101
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
                // line 102
                echo "                                      </a>
                                    </li>
                                  ";
            }
            // line 105
            echo "                                    <li>
                                        <a href=\"";
            // line 106
            echo ($context["site_url"] ?? null);
            echo "admin/news/feed_parse/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                                            ";
            // line 107
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_parse_feed"            ,"news"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                                        </a>
                                    </li>
                                    <li>
                                        <a href=\"";
            // line 111
            echo ($context["site_url"] ?? null);
            echo "admin/news/feed_edit/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\">
                                            ";
            // line 112
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_edit"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                                        </a>
                                    </li>
                                    <li>
                                        <a href=\"";
            // line 116
            echo ($context["site_url"] ?? null);
            echo "admin/news/feed_delete/";
            echo $this->getAttribute($context["item"], "id", []);
            echo "\"
                                           onclick=\"javascript: if(!confirm('";
            // line 117
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("note_delete_feed"            ,"news"            ,""            ,"js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 118
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_delete"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                                        </a>
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
        // line 126
        echo "                </tbody>
            </table>
            ";
        // line 128
        $this->loadTemplate("@app/pagination.twig", "list_feeds.twig", 128)->display($context);
        // line 129
        echo "        </div>
    </div>
</div>

<!-- Datatables -->
<script>
    var asInitVals = new Array();
    \$(document).ready(function () {
        var oTable = \$('#users').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"";
        // line 139
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
        // line 140
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("no_feeds"        ,"news"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    'aTargets': [2,3]
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
        // line 178
        $this->loadTemplate("@app/footer.twig", "list_feeds.twig", 178)->display($context);
    }

    public function getTemplateName()
    {
        return "list_feeds.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  825 => 178,  765 => 140,  742 => 139,  730 => 129,  728 => 128,  724 => 126,  712 => 119,  691 => 118,  668 => 117,  662 => 116,  657 => 113,  636 => 112,  630 => 111,  625 => 108,  604 => 107,  598 => 106,  595 => 105,  590 => 102,  569 => 101,  563 => 100,  560 => 99,  555 => 96,  534 => 95,  528 => 94,  525 => 93,  523 => 92,  515 => 86,  511 => 84,  490 => 83,  484 => 82,  460 => 81,  456 => 79,  435 => 78,  429 => 77,  405 => 76,  403 => 75,  398 => 72,  395 => 71,  373 => 70,  370 => 69,  348 => 68,  346 => 67,  342 => 65,  338 => 64,  332 => 63,  328 => 61,  307 => 60,  303 => 58,  299 => 57,  272 => 52,  249 => 51,  226 => 50,  196 => 42,  192 => 41,  182 => 33,  161 => 32,  157 => 31,  150 => 26,  139 => 23,  133 => 22,  127 => 21,  116 => 19,  112 => 18,  86 => 16,  80 => 15,  76 => 14,  66 => 12,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list_feeds.twig", "/home/mliadov/public_html/application/modules/news/views/gentelella/list_feeds.twig");
    }
}
