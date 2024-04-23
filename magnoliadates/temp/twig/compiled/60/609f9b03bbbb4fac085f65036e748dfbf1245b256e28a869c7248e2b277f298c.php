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

/* @app/header.twig */
class __TwigTemplate_5e6b22b2ef1dc0330b7c0f48b7437697173f7b3e2a168130e72d1a5516d7830f extends \Twig\Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
        echo "\" lang=\"";
        echo $this->getAttribute(($context["_LANG"] ?? null), "code", []);
        echo "\">
    
    <head>
        
        <meta http-equiv=\"X-UA-Compatible\">
           
        <meta http-equiv=\"X-UA-Compatible\">
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
        <meta http-equiv=\"expires\" content=\"0\">
        <meta http-equiv=\"pragma\" content=\"no-cache\">
        <meta name=\"revisit-after\" content=\"3 days\">
        <meta name=\"robot\" content=\"All\">
        ";
        // line 14
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("title|description|keyword|canonical|og_title|og_type|og_url|og_image|og_site_name|og_description"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        <script src=\"";
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 16
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/loading_content.js\"></script>

        <!-- Bootstrap core CSS -->
        <link href=\"";
        // line 19
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/css/bootstrap.min.css\" rel=\"stylesheet\">

";
        // line 22
        echo "        <link href=\"";
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/css/fontawesome/css/all.min.css\" rel=\"stylesheet\">
        <link href=\"";
        // line 23
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/css/animate.min.css\" rel=\"stylesheet\">
        <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">

        ";
        // line 26
        $module =         null;
        $helper =         'theme';
        $name =         'js';
        $params = array(($context["load_type"] ?? null)        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 27
        echo "        ";
        $module =         null;
        $helper =         'theme';
        $name =         'css';
        $params = array(($context["load_type"] ?? null)        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 28
        echo "        <script type=\"text/javascript\">
            var site_url = '";
        // line 29
        echo ($context["site_url"] ?? null);
        echo "';
            var site_rtl_settings = '";
        // line 30
        echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
        echo "';
            var site_error_position = ";
        // line 31
        if (($this->getAttribute(($context["_LANG"] ?? null), "rtl", []) == "ltr")) {
            echo "\"left\"";
        } else {
            echo "\"right\"";
        }
        echo ";
            var auth_type = ";
        // line 32
        if ($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", [])) {
            echo "'";
            echo $this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []);
            echo "'";
        } else {
            echo "'guest'";
        }
        echo ";
            var is_webpack = false;
        </script>

        ";
        // line 36
        $module =         null;
        $helper =         'start';
        $name =         'favicon';
        $params = array(["type" => "admin"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "
        <!-- Custom styling plus plugins -->
        <link href=\"";
        // line 39
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/css/icheck/flat/green.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 40
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/css/floatexamples.css\" rel=\"stylesheet\" type=\"text/css\"/>

        <script type=\"text/javascript\">
            var jQueryShow = \$.fn.show;
            \$.fn.show = function () {
                jQueryShow.apply(this);
                this.removeClass('hide');
                return this;
            };
        </script>
        ";
        // line 50
        $module =         null;
        $helper =         'start';
        $name =         'analytics';
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
        // line 51
        echo "        ";
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"easyTooltip.min.js"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        ";
        $module =         null;
        $helper =         'seo_advanced';
        $name =         'seo_traker';
        $params = array("top"        ,true        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "    </head>

    <body class=\"nav-md\">
        ";
        // line 56
        $module =         null;
        $helper =         'start';
        $name =         'demo_panel';
        $params = array(["type" => "admin", "place" => "top"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 57
        echo "        <div id=\"error_block\">
            ";
        // line 58
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "error", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 59
            echo "                ";
            if ($this->getAttribute($context["item"], "text", [])) {
                // line 60
                echo "                    ";
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>
                ";
            }
            // line 62
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "        </div>
        <div id=\"info_block\">
            ";
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "info", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 66
            echo "                ";
            if ($this->getAttribute($context["item"], "text", [])) {
                // line 67
                echo "                    ";
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>
                ";
            }
            // line 69
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "        </div>
        <div id=\"success_block\">
            ";
        // line 72
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "success", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 73
            echo "                ";
            if ($this->getAttribute($context["item"], "text", [])) {
                // line 74
                echo "                    ";
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>
                ";
            }
            // line 76
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        echo "        </div>

        <div class=\"container body ";
        // line 79
        if (($context["login_page"] ?? null)) {
            echo " container_loginpage ";
        }
        echo "\">
            <div
                class=\"main_container\">

                <!-- Left column -->
                <div class=\"left-sidebar\" id=\"left_col\">
                    <div class=\"left_col scroll-view\">
                        <div class=\"navbar nav_title\">
                            <a class=\"site_title\" href=\"";
        // line 87
        echo ($context["site_url"] ?? null);
        echo "admin/\">
                                <img src=\"";
        // line 88
        echo ($context["site_root"] ?? null);
        echo $this->getAttribute(($context["logo_settings"] ?? null), "path", []);
        echo "?";
        echo twig_random($this->env);
        echo "\" border=\"0\" alt=\"logo\" width=\"";
        echo $this->getAttribute(($context["logo_settings"] ?? null), "width", []);
        echo "\" height=\"";
        echo $this->getAttribute(($context["logo_settings"] ?? null), "height", []);
        echo "\" class=\"site-logo\">
                                <img src=\"";
        // line 89
        echo ($context["site_root"] ?? null);
        echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "path", []);
        echo "?";
        echo twig_random($this->env);
        echo "\" border=\"0\" alt=\"logo\" width=\"";
        echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "width", []);
        echo "\" height=\"";
        echo $this->getAttribute(($context["mini_logo_settings"] ?? null), "height", []);
        echo "\" class=\"site-mini-logo\">
                            </a>
                        </div>
                        <div class=\"clearfix\"></div>

                        <div
                            id=\"sidebar-menu\" class=\"main_menu_side hidden-print main_menu\">
                            <!-- Menu -->
                            ";
        // line 97
        if (($context["initial_setup"] ?? null)) {
            // line 98
            echo "                                ";
            $module =             null;
            $helper =             'install';
            $name =             'get_initial_setup_menu';
            $params = array(($context["step"] ?? null)            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                            ";
        } elseif (($context["modules_setup"] ?? null)) {
            // line 100
            echo "                                ";
            $module =             null;
            $helper =             'install';
            $name =             'get_modules_setup_menu';
            $params = array(($context["step"] ?? null)            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                            ";
        } elseif (($context["product_setup"] ?? null)) {
            // line 102
            echo "                                ";
            $module =             null;
            $helper =             'install';
            $name =             'get_product_setup_menu';
            $params = array(($context["step"] ?? null)            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                            ";
        } else {
            // line 104
            echo "                                ";
            if ((($context["auth_type"] ?? null) == "admin")) {
                // line 105
                echo "                                    ";
                $module =                 null;
                $helper =                 'fast_navigation';
                $name =                 'fast_navigation_helper';
                $params = array(                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                ";
            }
            // line 107
            echo "                                ";
            $module =             null;
            $helper =             'menu';
            $name =             'get_admin_main_menu';
            $params = array(            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                            ";
        }
        // line 109
        echo "                        </div>
                    </div>
                </div>

                <!-- Right column -->
                ";
        // line 115
        echo "                ";
        if ( !($context["login_page"] ?? null)) {
            // line 116
            echo "                    <div id=\"top_nav\" class=\"top_nav\">
                        <div class=\"nav_menu ";
            // line 117
            if (($context["menu_disabled"] ?? null)) {
                echo "hide";
            }
            echo "\">

                            <nav role=\"navigation\">
                                <div class=\"row\">
                                    <div class=\"col-md-8 col-sm-6 col-xs-6\">
                                        <div class=\"nav toggle\">
                                            <a id=\"menu_toggle\">
                                                <i class=\"fa fa-bars\"></i>
                                            </a>
                                        </div>
                                        <div class=\"nav navbar-nav nav-left version\">
                                            <span class=\"sm-hide\">";
            // line 128
            $module =             null;
            $helper =             'start';
            $name =             'product_version';
            $params = array(            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</span>
                                            ";
            // line 130
            echo "                                        </div>
                                    </div>
                                    <div class=\"col-md-4 col-sm-6 col-xs-6\">

                                        ";
            // line 134
            if ((($context["auth_type"] ?? null) == "admin")) {
                // line 135
                echo "                                            <ul class=\"nav navbar-nav navbar-right\">

                                                <li>
                                                    <ul class=\"list-inline\">
                                                        <li>
                                                            ";
                // line 140
                if ( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["modules_setup"] ?? null)])) {
                    // line 141
                    echo "                                                                <a href=\"";
                    echo ($context["site_url"] ?? null);
                    echo "admin/install/logoff\" class=\"logoff\">
                                                                    ";
                    // line 142
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("btn_logoff"                    ,"start"                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    echo "                                                                </a>
                                                            ";
                } elseif (( !call_user_func_array($this->env->getFunction('empty')->getCallable(), [                // line 144
($context["initial_setup"] ?? null)]) ||  !call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["product_setup"] ?? null)]))) {
                    // line 145
                    echo "
                                                            ";
                } elseif ((                // line 146
($context["auth_type"] ?? null) == "admin")) {
                    // line 147
                    echo "                                                                ";
                    $module =                     null;
                    $helper =                     'ausers';
                    $name =                     'logOff';
                    $params = array(                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                    echo "                                                            ";
                }
                // line 149
                echo "                                                        </li>
                                                        ";
                // line 150
                if (((call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["initial_setup"] ?? null)]) && call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["modules_setup"] ?? null)])) && call_user_func_array($this->env->getFunction('empty')->getCallable(), [($context["product_setup"] ?? null)]))) {
                    // line 151
                    echo "                                                            <li>
                                                                ";
                    // line 152
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'users_lang_select';
                    $params = array(                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 153
                    echo "                                                            </li>
                                                            ";
                    // line 155
                    echo "                                                        ";
                }
                // line 156
                echo "                                                    </ul>
                                                </li>
                                            </ul>
                                        ";
            }
            // line 160
            echo "
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <script src=\"";
            // line 165
            echo ($context["site_root"] ?? null);
            echo "application/views/gentelella/js/menu.js\"></script>
                    </div>
                ";
        }
        // line 168
        echo "                <div class=\"right_col\" role=\"main\">
                    <div class=\"right-sidebar\">
                        <div class=\"page-title ";
        // line 170
        if (($context["login_page"] ?? null)) {
            echo "hide";
        }
        echo "\">
                          ";
        // line 171
        if ($this->getAttribute(($context["_PREDEFINED"] ?? null), "back_link", [])) {
            // line 172
            echo "                            <div class=\"quest-block back-link\">
                              <a href=\"";
            // line 173
            echo $this->getAttribute(($context["_PREDEFINED"] ?? null), "back_link", []);
            echo "\" class=\"back\">
                                ";
            // line 174
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_back"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</a>&nbsp;
                            </div>
                          ";
        }
        // line 177
        echo "                          <div class=\"title_left\">
                            <h3>";
        // line 178
        echo $this->getAttribute(($context["_PREDEFINED"] ?? null), "header", []);
        echo "</h3>
                          </div>
                          ";
        // line 180
        $module =         null;
        $helper =         'start';
        $name =         'moduleInstructions';
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
        // line 181
        echo "                          ";
        // line 182
        echo "                        </div>
                        <div class=\"clearfix\"></div>
                        <div class=\"row\">
";
    }

    public function getTemplateName()
    {
        return "@app/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  813 => 182,  811 => 181,  790 => 180,  785 => 178,  782 => 177,  757 => 174,  753 => 173,  750 => 172,  748 => 171,  742 => 170,  738 => 168,  732 => 165,  725 => 160,  719 => 156,  716 => 155,  713 => 153,  692 => 152,  689 => 151,  687 => 150,  684 => 149,  681 => 148,  659 => 147,  657 => 146,  654 => 145,  652 => 144,  649 => 143,  628 => 142,  623 => 141,  621 => 140,  614 => 135,  612 => 134,  606 => 130,  583 => 128,  567 => 117,  564 => 116,  561 => 115,  554 => 109,  551 => 108,  529 => 107,  526 => 106,  504 => 105,  501 => 104,  498 => 103,  476 => 102,  473 => 101,  451 => 100,  448 => 99,  426 => 98,  424 => 97,  406 => 89,  395 => 88,  391 => 87,  378 => 79,  374 => 77,  368 => 76,  362 => 74,  359 => 73,  355 => 72,  351 => 70,  345 => 69,  339 => 67,  336 => 66,  332 => 65,  328 => 63,  322 => 62,  316 => 60,  313 => 59,  309 => 58,  306 => 57,  285 => 56,  280 => 53,  258 => 52,  236 => 51,  215 => 50,  202 => 40,  198 => 39,  194 => 37,  173 => 36,  160 => 32,  152 => 31,  148 => 30,  144 => 29,  141 => 28,  119 => 27,  98 => 26,  92 => 23,  87 => 22,  82 => 19,  76 => 16,  71 => 15,  50 => 14,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/header.twig", "/home/mliadov/public_html/application/views/gentelella/header.twig");
    }
}
