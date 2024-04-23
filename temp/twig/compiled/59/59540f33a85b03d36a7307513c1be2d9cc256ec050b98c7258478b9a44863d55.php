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

/* install_country_list.twig */
class __TwigTemplate_31e200c2a11cfb464d011cdd551be6fe635152a0d355a2f9d44bdb111948ba9a extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "install_country_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <!--1 level menu-->
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 8
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_countries_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 9
        echo "            </ul>
        </div>
        <!--2 level menu-->
        <div class='x_title'>
            <div id=\"menu\" class=\"btn-group\" data-toggle=\"buttons\">
                <label class=\"btn btn-default
                       ";
        // line 15
        if ((($context["filter"] ?? null) == "all")) {
            echo "active";
        }
        // line 16
        echo "                       ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "all", [])) {
            echo " hide";
        }
        echo "\"
                       onclick=\"document.location.href='";
        // line 17
        echo ($context["site_url"] ?? null);
        echo "admin/countries/install/country/all'\">
                    <input type=\"radio\" ";
        // line 18
        if ((($context["filter"] ?? null) == "all")) {
            echo " selected";
        }
        echo ">
                    ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_all_countries"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "(";
        echo $this->getAttribute(($context["filter_data"] ?? null), "all", []);
        echo ")
                </label>
                <label class=\"btn btn-default
                       ";
        // line 22
        if ((($context["filter"] ?? null) == "installed")) {
            echo "active";
        }
        // line 23
        echo "                       ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "installed", [])) {
            echo " hide";
        }
        echo "\"
                       onclick=\"document.location.href='";
        // line 24
        echo ($context["site_url"] ?? null);
        echo "admin/countries/install/country/installed'\">
                    <input type=\"radio\" ";
        // line 25
        if ((($context["filter"] ?? null) == "installed")) {
            echo " selected";
        }
        echo ">
                    ";
        // line 26
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_installed_countries"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "(";
        echo $this->getAttribute(($context["filter_data"] ?? null), "installed", []);
        echo ")
                </label>
                <label class=\"btn btn-default
                       ";
        // line 29
        if ((($context["filter"] ?? null) == "not-installed")) {
            echo "active";
        }
        // line 30
        echo "                       ";
        if ( !$this->getAttribute(($context["filter_data"] ?? null), "not_installed", [])) {
            echo " hide";
        }
        echo "\"
                       onclick=\"document.location.href='";
        // line 31
        echo ($context["site_url"] ?? null);
        echo "admin/countries/install/country/not-installed'\">
                    <input type=\"radio\" ";
        // line 32
        if ((($context["filter"] ?? null) == "all")) {
            echo " selected";
        }
        echo ">
                    ";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("filter_not_installed_countries"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "(";
        echo $this->getAttribute(($context["filter_data"] ?? null), "not_installed", []);
        echo ")
                </label>
            </div>
            <div class='clearfix'></div>
        </div>
        <div class='x_content'>
            <form action=\"";
        // line 39
        echo ($context["site_url"] ?? null);
        echo "admin/countries/install/selected_countries/";
        echo $this->getAttribute(($context["country"] ?? null), "code", []);
        echo "\" method=\"post\">
                <div id=\"actions\" class=\"hide\">
                  <div class=\"btn-group\">
                    <button type=\"submit\" name=\"install-btn\" class=\"btn btn-primary\"
                           value=\"1\" id=\"install-all\" onclick=\"";
        // line 43
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("countries"        ,"btn_install_selected"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "javascript: return checkBoxes();\">
                      ";
        // line 44
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("install_regions_link"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 45
        echo "                    </button>
                    <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                        aria-haspopup=\"true\" aria-expanded=\"false\">
                        <span class=\"caret\"></span>
                        <span class=\"sr-only\">Toggle Dropdown</span>
                    </button>
                    <ul class=\"dropdown-menu\">
                        <li>
                          <a href=\"javascript:;\" onclick=\"";
        // line 53
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("countries"        ,"btn_install_selected"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "javascript: \$('#install-all').trigger('click');\">
                            ";
        // line 54
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("install_regions_link"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                          </a>
                        </li>
                    </ul>
                  </div>
                </div>
                <table id=\"data\" class=\"table table-striped responsive-utilities jambo_table bulk_action\">
                    <thead>
                        <tr class=\"headings\">
                            <th class=\"text-center\">
                                <input type=\"checkbox\" id=\"check-all\" class=\"flat\">
                            </th>
                            <th class=\"column-title text-center\">";
        // line 66
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_code"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 67
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_name"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                            <th class=\"column-title text-center\">";
        // line 68
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_country_status"        ,"countries"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                            <th class=\"bulk-actions\" colspan=\"5\"></th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 75
            echo "                            ";
            $context["country_code"] = $this->getAttribute($context["item"], "code", []);
            // line 76
            echo "                            <tr class=\"";
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($context["item"], "net_is_incomer", [])])) {
                echo "net_incomer ";
            }
            echo "  ch-reg even pointer\">
                                <td class=\"text-center\">
                                    ";
            // line 78
            if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [$this->getAttribute($context["item"], "net_is_incomer", [])])) {
                // line 79
                echo "                                        <div class=\"corner-triangle\"></div>
                                    ";
            }
            // line 81
            echo "                                    <input type=\"checkbox\" class=\"tableflat grouping ch-reg\" value=\"";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\" name=\"countries[]\" data=\"table_records\"
                                           ";
            // line 82
            if ($this->getAttribute(($context["installed"] ?? null), ($context["country_code"] ?? null), [], "array")) {
                echo " disabled ";
            }
            echo ">
                                </td>
                                <td class=\"text-center\">";
            // line 84
            echo $this->getAttribute($context["item"], "code", []);
            echo "</td>
                                <td>";
            // line 85
            echo $this->getAttribute($context["item"], "name", []);
            echo "</td>
                                <td class=\"text-center\">
                                    ";
            // line 87
            if ($this->getAttribute(($context["installed"] ?? null), ($context["country_code"] ?? null), [], "array")) {
                // line 88
                echo "                                        <i>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("country_installed"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</i>
                                    ";
            } else {
                // line 90
                echo "                                        <i>";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("country_not_installed"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                echo "</i>
                                    ";
            }
            // line 92
            echo "                                </td>
                                <td class=\"icons\">
                                    <div class=\"btn-group\">
                                        <a onclick=\"";
            // line 95
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("countries"            ,"btn_install"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "admin/countries/install/region/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\"
                                           class=\"btn btn-primary\">
                                            ";
            // line 97
            if ($this->getAttribute(($context["installed"] ?? null), ($context["country_code"] ?? null), [], "array")) {
                // line 98
                echo "                                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("view_regions_link"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                            ";
            } else {
                // line 100
                echo "                                                ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("country_install_link"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                            ";
            }
            // line 102
            echo "                                        </a>
                                        <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                            aria-haspopup=\"true\" aria-expanded=\"false\">
                                            <span class=\"caret\"></span>
                                            <span class=\"sr-only\">Toggle Dropdown</span>
                                        </button>
                                        <ul class=\"dropdown-menu\">
                                            <li onclick=\"";
            // line 109
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("countries"            ,"btn_install"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            // line 110
            echo ($context["site_url"] ?? null);
            echo "admin/countries/install/region/";
            echo $this->getAttribute($context["item"], "code", []);
            echo "\">
                                                    ";
            // line 111
            if ($this->getAttribute(($context["installed"] ?? null), ($context["country_code"] ?? null), [], "array")) {
                // line 112
                echo "                                                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("view_regions_link"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                                    ";
            } else {
                // line 114
                echo "                                                        ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("country_install_link"                ,"countries"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                } elseif (function_exists($name)) {
                $result = call_user_func_array($name, $params);
                } else {
                $result = '';
                }
                $output_buffer = @ob_get_contents();
                @ob_end_clean();
                echo $output_buffer.$result;
                // line 115
                echo "                                                    ";
            }
            // line 116
            echo "                                                </a>
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
        // line 123
        echo "                    </tbody>
                </table>
            </form>
        </div>
        ";
        // line 127
        $this->loadTemplate("@app/pagination.twig", "install_country_list.twig", 127)->display($context);
        // line 128
        echo "    </div>
</div>
";
        // line 130
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
        // line 131
        echo "
<link href=\"";
        // line 132
        echo ($context["site_root"] ?? null);
        echo ($context["js_folder"] ?? null);
        echo "jquery-ui/jquery-ui.custom.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />

<!-- Datatables -->
<script src=\"";
        // line 135
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/datatables/js/jquery.dataTables.js\"></script>
<!-- Datatables -->

<script type=\"text/javascript\">    
    function checkBoxes(){
        if(\$('.ch-reg:checked').length > 0){
            return true;
        } else {
            return false;
        }
    }

    var asInitVals = new Array();
    \$(document).ready(function () {
        \$('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        var oTable = \$('#data').dataTable({
            \"oLanguage\": {
                \"sSearch\": \"Search all columns:\"
            },
            \"aoColumnDefs\": [
                {
                    'bSortable': false,
                    'aTargets': []
                } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            \"bPaginate\": false,
            \"bSort\": false,
            \"bFilter\": false,
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
        // line 195
        $this->loadTemplate("@app/footer.twig", "install_country_list.twig", 195)->display($context);
    }

    public function getTemplateName()
    {
        return "install_country_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  797 => 195,  734 => 135,  727 => 132,  724 => 131,  703 => 130,  699 => 128,  697 => 127,  691 => 123,  679 => 116,  676 => 115,  654 => 114,  651 => 113,  629 => 112,  627 => 111,  621 => 110,  598 => 109,  589 => 102,  586 => 101,  564 => 100,  561 => 99,  539 => 98,  537 => 97,  509 => 95,  504 => 92,  479 => 90,  454 => 88,  452 => 87,  447 => 85,  443 => 84,  436 => 82,  431 => 81,  427 => 79,  425 => 78,  417 => 76,  414 => 75,  410 => 74,  382 => 68,  359 => 67,  336 => 66,  323 => 55,  302 => 54,  279 => 53,  269 => 45,  248 => 44,  225 => 43,  216 => 39,  186 => 33,  180 => 32,  176 => 31,  169 => 30,  165 => 29,  138 => 26,  132 => 25,  128 => 24,  121 => 23,  117 => 22,  90 => 19,  84 => 18,  80 => 17,  73 => 16,  69 => 15,  61 => 9,  40 => 8,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "install_country_list.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\countries\\views\\gentelella\\install_country_list.twig");
    }
}
