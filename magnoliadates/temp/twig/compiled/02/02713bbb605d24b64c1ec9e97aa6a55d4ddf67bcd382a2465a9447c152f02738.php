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

/* play.twig */
class __TwigTemplate_bf279c79bed10685eba80b52d7556334af16b6836eb4c402caf5f0f91e02b3da extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "play.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 b-likeme_h100\">
    <h1 class=\"b-title-menu b-title-menu_likeme\">
        <a class=\"b-likeme__backlink\" href=\"";
        // line 5
        echo ($context["site_url"] ?? null);
        echo "\"><i class=\"fa fa-chevron-left\"></i></a>
            ";
        // line 6
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        <a class=\"b-title-menu__btn b-title-menu__btn_header\" href=\"javascript:void(0);\" data-mobile-pop=\"#likenav\">
            <i class=\"fa fa-bars\"></i>
        </a>
    </h1>
    <div class=\"row b-likeme_h100\" id=\"like_me-block\">
        <div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
            <div class=\"b-mobile-pop\" id=\"likenav\">
                <div class=\"b-mobile-pop__header container\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <a href=\"javascript:void(0);\" data-mobile-pop-close=\"#likenav\"><i class=\"fa fa-times fa-lg\"></i></a>
                        </div>
                    </div>
                </div>

                <div class=\"b-mobile-pop__content\">
                    <div class=\"tabs tab-size-15 noPrint\">
                        <ul class=\"list-group\">
                            ";
        // line 25
        if ($this->getAttribute(($context["data"] ?? null), "play_local_used", [])) {
            // line 26
            echo "                                <li class=\"list-group-item ";
            if ((($context["action"] ?? null) == "play_global")) {
                echo "active";
            }
            echo "\">
                                    <a data-pjax-no-scroll=\"1\" href=\"";
            // line 27
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("like_me"            ,"index"            ,["action" => "play_global"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\" class=\"menu-link\">
                                        ";
            // line 28
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_play_global"            ,"like_me"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                                    </a>
                                </li>
                                <li class=\"list-group-item ";
            // line 31
            if ((($context["action"] ?? null) == "play_local")) {
                echo "active";
            }
            echo "\">
                                    <a data-pjax-no-scroll=\"1\" href=\"";
            // line 32
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("like_me"            ,"index"            ,["action" => "play_local"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\" class=\"menu-link\">
                                        ";
            // line 33
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_play_local"            ,"like_me"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
            echo "                                    </a>
                                </li>
                            ";
        } else {
            // line 37
            echo "                                <li class=\"list-group-item ";
            if ((($context["action"] ?? null) == "play_global")) {
                echo "active";
            }
            echo "\">
                                    <a data-pjax-no-scroll=\"1\" href=\"";
            // line 38
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("like_me"            ,"index"            ,["action" => "play_global"]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "\"  class=\"menu-link\">
                                        ";
            // line 39
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_play"            ,"like_me"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 40
            echo "                                    </a>
                                </li>
                            ";
        }
        // line 43
        echo "                            <li class=\"list-group-item ";
        if ((($context["action"] ?? null) == "matches")) {
            echo "active";
        }
        echo "\">
                                <a data-pjax-no-scroll=\"1\" href=\"";
        // line 44
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("like_me"        ,"index"        ,["action" => "matches"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\" class=\"menu-link\">
                                    ";
        // line 45
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_matches"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 46
        echo "                                </a>
                            </li>
                            
                            <li class=\"list-group-item ";
        // line 49
        if ((($context["action"] ?? null) == "like")) {
            echo "active";
        }
        echo "\">
                                <a data-pjax-no-scroll=\"1\" href=\"";
        // line 50
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("like_me"        ,"index"        ,["action" => "like"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\" class=\"menu-link\">
                                    ";
        // line 51
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_I_like_them"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                                </a>
                            </li>
                            <li class=\"list-group-item ";
        // line 54
        if ((($context["action"] ?? null) == "like_me")) {
            echo "active";
        }
        echo "\">
                                <a data-pjax-no-scroll=\"1\" href=\"";
        // line 55
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("like_me"        ,"like_me_profiles"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\" class=\"menu-link\">
                                    ";
        // line 56
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_I_like_me"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id=\"action-block\" class=\"col-xs-12 col-sm-9 col-md-9 col-lg-9 b-likeme_h100\"></div>
    </div>
</div>


<script>
    ";
        // line 70
        if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "have_more", []))) {
            // line 71
            echo "            var all_loaded = ";
            if ($this->getAttribute(($context["user_data"] ?? null), "have_more", [])) {
                echo "0";
            } else {
                echo "1";
            }
            echo ";
    ";
        } else {
            // line 73
            echo "            var all_loaded = 0;
    ";
        }
        // line 75
        echo "        \$('.b-likeme-page').css('position', 'fixed');
            \$(function () {                
                loadScripts(
                        [
                            \"";
        // line 79
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("like_me"        ,"like_me.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                            \"";
        // line 80
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("like_me"        ,"match_me.js"        ,"path"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        ],
                        function () {
                            var action_id = '";
        // line 83
        echo ($context["action"] ?? null);
        echo "';
                            like_me = new LikeMe({
                                siteUrl: site_url,
                                action_id: action_id,
                                isRegistr: ";
        // line 87
        echo ($context["is_registr"] ?? null);
        echo ",
                                langs: {
                                    header: \"";
        // line 89
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_evaluate_users"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                    gotItBtn: \"";
        // line 90
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_got_it"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                    searchBtn: \"";
        // line 91
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_skip"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                }
                            });
                            match_me = new MatchMe({
                                siteUrl: site_url,
                                all_loaded: all_loaded,
                                show_more_lang: \"";
        // line 97
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_show_more"        ,"like_me"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                        },
                        ['like_me', 'match_me'],
                        {async: true}
                );

                \$(\"[data-mobile-pop]\").on(\"click\", function () {
                    var mob_pop = \$(this).attr(\"data-mobile-pop\");
                    \$(mob_pop).addClass(\"b-mobile-pop_show\");
                });
                \$(\"[data-mobile-pop-close]\").on(\"click\", function () {
                    \$(this).parents('.b-mobile-pop').removeClass('b-mobile-pop_show');
                });
            });
</script>

";
        // line 114
        $this->loadTemplate("@app/footer.twig", "play.twig", 114)->display($context);
    }

    public function getTemplateName()
    {
        return "play.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  620 => 114,  581 => 97,  553 => 91,  530 => 90,  507 => 89,  502 => 87,  495 => 83,  470 => 80,  447 => 79,  441 => 75,  437 => 73,  427 => 71,  425 => 70,  410 => 57,  389 => 56,  366 => 55,  360 => 54,  356 => 52,  335 => 51,  312 => 50,  306 => 49,  301 => 46,  280 => 45,  257 => 44,  250 => 43,  245 => 40,  224 => 39,  201 => 38,  194 => 37,  189 => 34,  168 => 33,  145 => 32,  139 => 31,  135 => 29,  114 => 28,  91 => 27,  84 => 26,  82 => 25,  62 => 7,  41 => 6,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "play.twig", "/home/mliadov/public_html/application/modules/like_me/views/flatty/play.twig");
    }
}
