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

/* @app/footer.twig */
class __TwigTemplate_dea32256f49e2e7610f76b358db47c19e47c17f21b1766a2e6e15937f4475517 extends \Twig\Template
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
        echo "                        </div>
                    </div>
                </div>
            ";
        // line 4
        if ((twig_test_empty(($context["footer_type"] ?? null)) || (($context["footer_type"] ?? null) != "index"))) {
            // line 5
            echo "                ";
            $module =             null;
            $helper =             'shoutbox';
            $name =             'shoutboxMobileBlock';
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
            // line 6
            echo "                ";
            $module =             null;
            $helper =             'cookie_policy';
            $name =             'cookie_policy_block';
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
            // line 7
            echo "                <div class=\"logo-mobile-version\"></div>
            ";
        }
        // line 9
        echo "
            </div>
        </div>
        ";
        // line 12
        $module =         null;
        $helper =         'users';
        $name =         'isTerms';
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
        // line 13
        echo "        ";
        if (((twig_test_empty(($context["footer_type"] ?? null)) || (($context["footer_type"] ?? null) != "index")) && !twig_in_filter(($context["page_type"] ?? null), [0 => "like_me", 1 => "photo_upload"]))) {
            // line 14
            echo "        <footer>
            <div class=\"container-fluid\" id=\"footer_banner\">
                <div class=\"row\">
                    <div class=\"col-xs-12 col-md-12\">
                        <ul class=\"footer-banners\">
                            ";
            // line 19
            $module =             null;
            $helper =             'banners';
            $name =             'show_banner_place';
            $params = array("bottom-banner"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                        </ul>
                    </div>
                </div>
            </div>
            <div class=\"container-fluid\" id=\"footer_languages\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <ul class=\"footer-languages\">
                            ";
            // line 28
            $module =             null;
            $helper =             'languages';
            $name =             'lang_row_select';
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
            // line 29
            echo "                        </ul>
                    </div>
                </div>
            </div>
            <div class=\"footer-menu\">
                <div class=\"container-fluid\" id=\"footer_menu\">
                    <div class=\"row\">
                        ";
            // line 36
            $module =             null;
            $helper =             'menu';
            $name =             'get_menu';
            $params = array("user_footer_menu"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                        <div class=\"col-sm-12 col-md-4 mobile_app_links\">
                            ";
            // line 38
            $module =             null;
            $helper =             'mobile';
            $name =             'mobile_app_links';
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
            // line 39
            echo "                        </div>
                    </div>
                </div>
            </div>
            <div class=\"footer-info\">
                <div class=\"container-fluid\" id=\"footer_info\">
                    <div class=\"row\">
                        ";
            // line 46
            $module =             null;
            $helper =             'mobile';
            $name =             'mobileVersion';
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
            // line 47
            echo "                        <div class=\"col-sm-6 col-md-6\">
                            <div class=\"copyright\">
                                ";
            // line 49
            $module =             null;
            $helper =             'start';
            $name =             'getCopyright';
            $params = array("internal"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        ";
        }
        // line 57
        echo "
        <script>
            \$('body').removeClass('index-page site-page')
                     .addClass('";
        // line 60
        if ((($context["header_type"] ?? null) == "index")) {
            echo "index-page";
        } else {
            echo "site-page";
        }
        echo " mod-inner');
            ";
        // line 61
        if ((($context["page_type"] ?? null) != "like_me")) {
            // line 62
            echo "                 \$('body').removeClass('mod-likeme mod-likeme-matches').addClass('";
            echo ($context["body_class"] ?? null);
            echo "');
            ";
        } else {
            // line 64
            echo "                \$('body').removeClass('index-page site-page').addClass('mod-likeme mod-likeme-matches');
            ";
        }
        // line 66
        echo "        </script>

        <script>
          \$(function() {
            \$('body').removeClass('mod-magazine');
            \$('body').addClass('";
        // line 71
        echo ($context["body_class"] ?? null);
        echo "');
            \$.datepicker.setDefaults(\$.datepicker.regional[\"";
        // line 72
        echo $this->getAttribute(($context["_LANG"] ?? null), "code", []);
        echo "\"]);
          });
        </script>

        ";
        // line 76
        $module =         null;
        $helper =         'start';
        $name =         'new_features';
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
        // line 77
        if ( !($context["is_pjax"] ?? null)) {
            // line 78
            echo "        </div>

        ";
            // line 81
            echo "        ";
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"emoji-picker/js/config.js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 82
            echo "        ";
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"emoji-picker/js/util.js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "        ";
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"emoji-picker/js/jquery.emojiarea.js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "        ";
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"emoji-picker/js/emoji-picker.js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "
        ";
            // line 87
            echo "         ";
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array(""            ,"twigjs/twig.js"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "        <script src=\"//twemoji.maxcdn.com/twemoji.min.js\"></script>

        ";
            // line 90
            $module =             null;
            $helper =             'themes';
            $name =             'load';
            $params = array(["name" => "modules", "ext" => "js"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 91
            echo "        ";
            $module =             null;
            $helper =             'themes';
            $name =             'load';
            $params = array(["name" => "modules_multi_request", "ext" => "js"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 92
            echo "
        ";
            // line 93
            $module =             null;
            $helper =             'mobile';
            $name =             'pushNotifications';
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
            // line 94
            echo "
        <script type=\"text/javascript\">
          \$(function () {
            const messages = ";
            // line 97
            if (($context["_PREDEFINED"] ?? null)) {
                echo twig_jsonencode_filter(($context["_PREDEFINED"] ?? null), twig_constant("JSON_FORCE_OBJECT"));
            } else {
                echo "{}";
            }
            echo ";
            new pginfo({'messages': messages});

            alerts = new Alerts({
              alertOkName: \"";
            // line 101
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_ok"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
              alertCancelName: \"";
            // line 102
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_cancel"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
              alertConfirmClass: \"";
            // line 103
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("confirm_alert"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            });
            notifications = new Notifications();
          });
        </script>

        ";
            // line 109
            $module =             null;
            $helper =             'languages';
            $name =             'lang_editor';
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
            // line 110
            echo "        ";
            $module =             null;
            $helper =             'seo_advanced';
            $name =             'seo_traker';
            $params = array("footer"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "        ";
            $module =             null;
            $helper =             'start';
            $name =             'intercom';
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
            // line 112
            echo "\t</body>
";
        }
        // line 114
        echo "</html>
";
    }

    public function getTemplateName()
    {
        return "@app/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  704 => 114,  700 => 112,  678 => 111,  656 => 110,  635 => 109,  607 => 103,  584 => 102,  561 => 101,  550 => 97,  545 => 94,  524 => 93,  521 => 92,  499 => 91,  478 => 90,  474 => 88,  452 => 87,  449 => 85,  427 => 84,  405 => 83,  383 => 82,  361 => 81,  357 => 78,  355 => 77,  334 => 76,  327 => 72,  323 => 71,  316 => 66,  312 => 64,  306 => 62,  304 => 61,  296 => 60,  291 => 57,  282 => 50,  261 => 49,  257 => 47,  236 => 46,  227 => 39,  206 => 38,  203 => 37,  182 => 36,  173 => 29,  152 => 28,  142 => 20,  121 => 19,  114 => 14,  111 => 13,  90 => 12,  85 => 9,  81 => 7,  59 => 6,  37 => 5,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/footer.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\views\\flatty\\footer.twig");
    }
}
