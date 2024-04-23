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
class __TwigTemplate_6493e1a514e014de9d8506f7c686d283133f537cec5ed885ed1a2fa196f4cd31 extends \Twig\Template
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
        if ( !($context["is_pjax"] ?? null)) {
            // line 2
            echo "    <!DOCTYPE html>
    <html dir=\"";
            // line 3
            echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
            echo "\" lang=\"";
            echo $this->getAttribute(($context["_LANG"] ?? null), "code", []);
            echo "\">
        <head>
            
             <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">

            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
            <meta http-equiv=\"expires\" content=\"0\">
            <meta http-equiv=\"pragma\" content=\"no-cache\">
            <meta name=\"revisit-after\" content=\"3 days\">
            ";
            // line 14
            $module =             null;
            $helper =             'seo';
            $name =             'seo_tags';
            $params = array("robots"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "            ";
            $module =             null;
            $helper =             'start';
            $name =             'favicon';
            $params = array(["type" => "user"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 16
            echo "        ";
        }
        // line 17
        echo "
        ";
        // line 18
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("title"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 19
        echo "        ";
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("description|keyword|canonical|og_title|og_type|og_url|og_image|og_site_name|og_description"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 20
        echo "
        <script>
            var site_rtl_settings = '";
        // line 22
        echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
        echo "';
            var is_pjax = parseInt('";
        // line 23
        echo ($context["is_pjax"] ?? null);
        echo "');
            var js_events = ";
        // line 24
        echo twig_jsonencode_filter(($context["js_events"] ?? null));
        echo ";
            var id_user = ";
        // line 25
        if ($this->getAttribute(($context["user_session_data"] ?? null), "user_id", [])) {
            echo $this->getAttribute(($context["user_session_data"] ?? null), "user_id", []);
        } else {
            echo "0";
        }
        echo ";
            var auth_type = ";
        // line 26
        if ($this->getAttribute(($context["user_session_data"] ?? null), "auth_type", [])) {
            echo "'";
            echo $this->getAttribute(($context["user_session_data"] ?? null), "auth_type", []);
            echo "'";
        } else {
            echo "'guest'";
        }
        echo ";
            var is_webpack = true;
        </script>

        ";
        // line 30
        if ( !($context["is_pjax"] ?? null)) {
            // line 31
            echo "            <link rel=\"stylesheet\" href=\"";
            echo ($context["site_root"] ?? null);
            echo "application/views/flatty/css/bootstrap-";
            echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
            echo ".css\">
            ";
            // line 32
            $module =             null;
            $helper =             'theme';
            $name =             'include_css';
            $params = array("style"            ,"screen"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "            ";
            $module =             null;
            $helper =             'theme';
            $name =             'css';
            $params = array(($context["load_type"] ?? null)            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            <script>
              var site_url = '";
            // line 36
            echo ($context["site_url"] ?? null);
            echo "';
              var base_url = '";
            // line 37
            echo ($context["base_url"] ?? null);
            echo "';
              var site_root = '";
            // line 38
            echo ($context["site_root"] ?? null);
            echo "';
              var theme = '";
            // line 39
            echo ($context["theme"] ?? null);
            echo "';
              var img_folder = '";
            // line 40
            echo ($context["img_folder"] ?? null);
            echo "';
              var site_error_position = 'center';
              var use_pjax = parseInt('";
            // line 42
            echo ($context["use_pjax"] ?? null);
            echo "');
              var pjax_container = '#pjaxcontainer';
            </script>

            ";
            // line 46
            $module =             null;
            $helper =             'themes';
            $name =             'load';
            $params = array(["name" => "main", "ext" => "js"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 47
            echo "
            ";
            // line 48
            $module =             null;
            $helper =             'seo_advanced';
            $name =             'seo_traker';
            $params = array("top"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "            ";
            $module =             null;
            $helper =             'start';
            $name =             'analytics';
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
            // line 50
            echo "        </head>
        <body class=\"";
            // line 51
            if ((($context["page_type"] ?? null) != "like_me")) {
                echo "mod-inner";
            } else {
                echo "mod-likeme";
            }
            echo "\">
            ";
            // line 52
            $this->loadTemplate("@app/preloader.twig", "@app/header.twig", 52)->display($context);
            // line 53
            echo "            ";
            $module =             null;
            $helper =             'start';
            $name =             'demo_panel';
            $params = array(["type" => "user", "place" => "top"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 54
            echo "            ";
            $module =             null;
            $helper =             'users';
            $name =             'incorrect_email';
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
            // line 55
            echo "            ";
            $module =             null;
            $helper =             'chats';
            $name =             'chats_block';
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
            // line 56
            echo "            ";
            $module =             null;
            $helper =             'likes';
            $name =             'likes';
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
            // line 57
            echo "            ";
            $module =             null;
            $helper =             'audio_uploads';
            $name =             'audio_bottom_controls';
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
            // line 58
            echo "
            ";
            // line 59
            if ((twig_test_empty(($context["header_type"] ?? null)) || (($context["header_type"] ?? null) != "index"))) {
                // line 60
                echo "                ";
                if ((($context["auth_type"] ?? null) == "user")) {
                    // line 61
                    echo "                ";
                    if ((($context["page_type"] ?? null) != "chatbox")) {
                        // line 62
                        echo "                <div class=\"bottom-btns\" id=\"bottom-btns\">
                    ";
                        // line 63
                        $module =                         null;
                        $helper =                         'shoutbox';
                        $name =                         'shoutbox_button';
                        $params = array(                        );
                        @ob_start();
                        $ci = &get_instance();
                        $ci->load->helper($helper, $module);
                        if (empty($module)) {
                        $module = str_replace('_helper', '', $helper);
                        }
                        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        echo "                </div>
                ";
                    }
                    // line 66
                    echo "                ";
                }
                // line 67
                echo "            ";
            }
            // line 68
            echo "            <div id=\"pjaxcontainer\" class=\"pjaxcontainer\">
            ";
        }
        // line 70
        echo "            <div class=\"pjaxcontainer-inner\">
                <script type=\"text/javascript\">
                    \$.pjax.defaults.version = 'default';
                </script>
                ";
        // line 74
        if ((($context["page_type"] ?? null) != "like_me")) {
            // line 75
            echo "                    ";
            $module =             null;
            $helper =             'banners';
            $name =             'banner_initialize';
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
            // line 76
            echo "                ";
        }
        // line 77
        echo "                <div id=\"error_block\">";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "error", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div>
                <div id=\"info_block\">";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "info", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div>
                <div id=\"success_block\">";
        // line 79
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "success", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "<br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div>
                ";
        // line 80
        if ((twig_test_empty(($context["header_type"] ?? null)) || (($context["header_type"] ?? null) != "index"))) {
            // line 81
            echo "                    ";
            $this->loadTemplate("@app/header_navigation.twig", "@app/header.twig", 81)->display($context);
            // line 82
            echo "                    ";
            if (((($context["page_type"] ?? null) != "like_me") && (($context["page_type"] ?? null) != "chatbox"))) {
                // line 83
                echo "                        <div class=\"pre-main-inner-content\">
                            ";
                // line 84
                $module =                 null;
                $helper =                 'menu';
                $name =                 'mobileTopMenu';
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
                // line 85
                echo "                            ";
                if ((twig_test_empty(($context["header_type"] ?? null)) || (((((($context["header_type"] ?? null) != "index") && (($context["header_type"] ?? null) != "network")) && (($context["header_type"] ?? null) != "error_page")) && (($context["header_type"] ?? null) != "access_permissions")) && (($context["header_type"] ?? null) != "view_magazine")))) {
                    // line 86
                    echo "                                ";
                    $module =                     null;
                    $helper =                     'users';
                    $name =                     'featuredUsers';
                    $params = array(false                    ,                    );
                    @ob_start();
                    $ci = &get_instance();
                    $ci->load->helper($helper, $module);
                    if (empty($module)) {
                    $module = str_replace('_helper', '', $helper);
                    }
                    if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
                    $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
                    } elseif (function_exists($name)) {
                    $result = call_user_func_array($name, $params);
                    } else {
                    $result = '';
                    }
                    $output_buffer = @ob_get_contents();
                    @ob_end_clean();
                    echo $output_buffer.$result;
                    // line 87
                    echo "                            ";
                }
                // line 88
                echo "                        </div>
                    ";
            }
            // line 90
            echo "                ";
        }
        // line 91
        echo "                ";
        if ((($context["page_type"] ?? null) != "like_me")) {
            // line 92
            echo "                    ";
            $module =             null;
            $helper =             'special_offers';
            $name =             'specialOffersNotices';
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
            // line 93
            echo "                    <div class=\"main-inner-content\">
                        <div data-role=\"page\" id=\"main_page\">
                            <div class=\"container\">
                                ";
            // line 96
            if ((twig_test_empty(($context["header_type"] ?? null)) || ((($context["header_type"] ?? null) != "index") && (($context["header_type"] ?? null) != "view_magazine")))) {
                // line 97
                echo "                                <div class=\"row\">
                                    <div class=\"col-xs-12\">
                                        ";
                // line 99
                $module =                 null;
                $helper =                 'menu';
                $name =                 'get_breadcrumbs';
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
                // line 100
                echo "                                        ";
                $module =                 null;
                $helper =                 'banners';
                $name =                 'show_banner_place';
                $params = array("top-banner"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                        ";
                $module =                 null;
                $helper =                 'banners';
                $name =                 'show_banner_place';
                $params = array("top-banner-185x75"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                        ";
                $module =                 null;
                $helper =                 'banners';
                $name =                 'show_banner_place';
                $params = array("top-banner-320x75"                ,                );
                @ob_start();
                $ci = &get_instance();
                $ci->load->helper($helper, $module);
                if (empty($module)) {
                $module = str_replace('_helper', '', $helper);
                }
                if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                echo "                                    </div>
                                    ";
                // line 104
                $module =                 null;
                $helper =                 'users';
                $name =                 'availableActivation';
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
                // line 105
                echo "                                </div>
                                ";
            }
            // line 107
            echo "                                <div class=\"row row-content\">
                                    <div class=\"col-xs-12 static-alert-block\" id=\"static-alert-block\"></div>
                ";
        } else {
            // line 110
            echo "                    <div class=\"main-inner-content\">
                        <div class=\"container\"></div>
                        <div data-role=\"page\" id=\"main_page\" class=\"b-likeme-page\">
                            <div class=\"container b-likeme_h100\">
                                <div class=\"row\">
                                    ";
            // line 115
            $module =             null;
            $helper =             'users';
            $name =             'availableActivation';
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
            // line 116
            echo "                                </div>
                                <div class=\"row row-content b-likeme_h100\">
                                    <div class=\"b-likeme__alert\" id=\"static-alert-block\"></div>
                ";
        }
        // line 120
        echo "                ";
        $module =         null;
        $helper =         'twilio_chat';
        $name =         'twilioVideoChat';
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
        return array (  836 => 120,  830 => 116,  809 => 115,  802 => 110,  797 => 107,  793 => 105,  772 => 104,  769 => 103,  747 => 102,  725 => 101,  703 => 100,  682 => 99,  678 => 97,  676 => 96,  671 => 93,  649 => 92,  646 => 91,  643 => 90,  639 => 88,  636 => 87,  614 => 86,  611 => 85,  590 => 84,  587 => 83,  584 => 82,  581 => 81,  579 => 80,  565 => 79,  551 => 78,  536 => 77,  533 => 76,  511 => 75,  509 => 74,  503 => 70,  499 => 68,  496 => 67,  493 => 66,  489 => 64,  468 => 63,  465 => 62,  462 => 61,  459 => 60,  457 => 59,  454 => 58,  432 => 57,  410 => 56,  388 => 55,  366 => 54,  344 => 53,  342 => 52,  334 => 51,  331 => 50,  309 => 49,  288 => 48,  285 => 47,  264 => 46,  257 => 42,  252 => 40,  248 => 39,  244 => 38,  240 => 37,  236 => 36,  232 => 34,  210 => 33,  189 => 32,  182 => 31,  180 => 30,  167 => 26,  159 => 25,  155 => 24,  151 => 23,  147 => 22,  143 => 20,  121 => 19,  100 => 18,  97 => 17,  94 => 16,  72 => 15,  51 => 14,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/header.twig", "/home/mliadov/public_html/application/views/flatty/header.twig");
    }
}
