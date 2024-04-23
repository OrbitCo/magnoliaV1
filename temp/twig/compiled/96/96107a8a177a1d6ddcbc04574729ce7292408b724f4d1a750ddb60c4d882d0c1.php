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

/* index_pleasure.twig */
class __TwigTemplate_625b329dd54702fdd70b870ebd61c3dd689cd9aa85f6161e83757e3daf9a2ed5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'bodyclass' => [$this, 'block_bodyclass'],
            'container' => [$this, 'block_container'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@app/header_lite.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("@app/header_lite.twig", "index_pleasure.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_bodyclass($context, array $blocks = [])
    {
        echo "index-pleasure";
    }

    // line 4
    public function block_container($context, array $blocks = [])
    {
        // line 5
        echo "     <div id=\"error_block\" class=\"hide\">";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "error", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "
             <br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</div>
     <div id=\"info_block\" class=\"hide\">";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "info", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "
             <br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</div>
     <div id=\"success_block\" class=\"hide\">";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["_PREDEFINED"] ?? null), "success", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ($this->getAttribute($context["item"], "text", [])) {
                echo $this->getAttribute($context["item"], "text", []);
                echo "
             <br>";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "</div>

     <div class=\"b-header custom-pleasure\" id=\"b-header\">
         <div class=\"container\">
             <div class=\"row\">
                 <div class=\"b-header__topline\">
                     <div class=\"col-sm-6\">
                         <div class=\"b-header__logo\">
                             <a href=\"";
        // line 18
        echo ($context["site_url"] ?? null);
        echo "start/index/page\">
                                 ";
        // line 19
        $module =         null;
        $helper =         'start';
        $name =         'logo';
        $params = array(["type" => "user", "settings" => ($context["logo_settings"] ?? null)]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                             </a>
                         </div>
                     </div>
                     <div class=\"col-sm-6\">
                         <div class=\"b-header__topnav\">
                             <a onclick=\"";
        // line 25
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("index"        ,"btn_sign_in"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
                                href=\"";
        // line 26
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"login_form"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "\" data-bind=\"login\">
                                 ";
        // line 27
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_login"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        // line 28
        $module =         null;
        $helper =         'users';
        $name =         'users_lang_select';
        $params = array(["type" => "menu", "template" => "summer"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                         </div>
                     </div>
                 </div>
             </div>
             <div class=\"row th-set__index_promo_text_main\" data-block=\"r\">
                 ";
        // line 34
        $module =         null;
        $helper =         'users';
        $name =         'usersRegistration';
        $params = array(["page" => 1, "is_registration" => ($context["is_registration"] ?? null)]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 35
        echo "             </div>
         </div>
     </div><!-- b-header -->

     <div class=\"b-afterheader th-set__index_promo_text_on_bg th-set__main_bg\">
         <div class=\"container\">
            ";
        // line 42
        echo "            ";
        $module =         null;
        $helper =         'users';
        $name =         'indexUsersBlock';
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
        // line 43
        echo "            ";
        // line 44
        echo "
             <div class=\"row\">
                 <div class=\"col-sm-8 col-sm-offset-2\">
                     <p>";
        // line 47
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_promo_description"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</p>
                     <p class=\"b-afterheader__apps\">
                         ";
        // line 49
        $module =         null;
        $helper =         'mobile';
        $name =         'mobileAppLinks';
        $params = array(["viewtype" => "ghostWhite"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                     </p>
                 </div>
             </div>
         </div>
     </div><!-- b-afterheader -->

     <div class=\"b-features\">
         <div class=\"container\">
             <div class=\"row\">
                 <div class=\"col-sm-4\">
                     <div class=\"b-features__item\">
                         <div class=\"b-features__image\"><img
                                 src=\"";
        // line 62
        echo ($context["site_root"] ?? null);
        echo "uploads/themes-fixed/pleasure/images/b-features_likeme.png\" alt=\"\">
                         </div>
                         <h3 class=\"b-features__title\">";
        // line 64
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("features_likeme"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</h3>
                         <p>";
        // line 65
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("features_likeme_txt"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</p>
                     </div>
                 </div>
                 ";
        // line 68
        $module =         null;
        $helper =         'utils';
        $name =         'depends';
        $params = array("nearest_users"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        $context['is_module_installed'] = $result;
        // line 69
        echo "                 ";
        if ($this->getAttribute(($context["is_module_installed"] ?? null), "nearest_users", [])) {
            // line 70
            echo "                     <div class=\"col-sm-4\">
                         <div class=\"b-features__item\">
                             <div class=\"b-features__image\"><img
                                     src=\"";
            // line 73
            echo ($context["site_root"] ?? null);
            echo "uploads/themes-fixed/pleasure/images/b-features_nearest.png\"
                                     alt=\"\"></div>
                             <h3 class=\"b-features__title\">";
            // line 75
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("features_nearest"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</h3>
                             <p>";
            // line 76
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("features_nearest_txt"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</p>
                         </div>
                     </div>
                 ";
        } else {
            // line 80
            echo "                     <div class=\"col-sm-4\">
                         <div class=\"b-features__item\">
                             <div class=\"b-features__image\"><img
                                     src=\"";
            // line 83
            echo ($context["site_root"] ?? null);
            echo "uploads/themes-fixed/pleasure/images/b-features_nearest.png\"
                                     alt=\"\"></div>
                             <h3 class=\"b-features__title\">";
            // line 85
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("advanced_search"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</h3>
                             <p>";
            // line 86
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("advanced_search_txt"            ,"start"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            echo "</p>
                         </div>
                     </div>
                 ";
        }
        // line 90
        echo "                 <div class=\"col-sm-4\">
                     <div class=\"b-features__item\">
                         <div class=\"b-features__image\"><img
                                 src=\"";
        // line 93
        echo ($context["site_root"] ?? null);
        echo "uploads/themes-fixed/pleasure/images/b-features_chats.png\" alt=\"\">
                         </div>
                         <h3 class=\"b-features__title\">";
        // line 95
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("features_chats"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</h3>
                         <p>";
        // line 96
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("features_chats_txt"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</p>
                     </div>
                 </div>
             </div>
         </div>
     </div><!-- b-features -->

     <div class=\"b-mobile\">
         <div class=\"container\">
             <div class=\"row\">
                 <div class=\"col-sm-4\">
                     <div class=\"b-mobile__img\">
                         <img class=\"img-responsive\"
                              src=\"";
        // line 109
        echo ($context["site_root"] ?? null);
        echo "uploads/themes-fixed/pleasure/images/b-mobile.png\" alt=\"\">
                     </div>
                 </div>
                 <div class=\"col-sm-8\">
                     <div class=\"b-mobile__text\">
                         <h2>";
        // line 114
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("mobile_app_title"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</h2>
                         <p>";
        // line 115
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("mobile_app_txt"        ,"start"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        echo "</p>
                         <p class=\"b-afterheader__apps\">
                             ";
        // line 117
        $module =         null;
        $helper =         'mobile';
        $name =         'mobileAppLinks';
        $params = array(["viewtype" => "ghostBlack"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 118
        echo "                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div><!-- b-mobile -->

    <footer>
         <div class=\"footer-menu\">
            <div class=\"container-fluid\" id=\"footer_menu\">
                <div class=\"row\">
                    ";
        // line 129
        $module =         null;
        $helper =         'menu';
        $name =         'get_menu';
        $params = array("user_footer_menu"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 130
        echo "                    <div class=\"col-sm-12 col-md-4 mobile_app_links\">
                        ";
        // line 131
        $module =         null;
        $helper =         'mobile';
        $name =         'mobile_app_links';
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
        // line 132
        echo "                    </div>
                </div>
            </div>
        </div>
         <div class=\"footer-info\">
            <div class=\"container-fluid\" id=\"footer_info\">
                <div class=\"row\">
                    ";
        // line 139
        $module =         null;
        $helper =         'mobile';
        $name =         'mobileVersion';
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
        // line 140
        echo "                    <div class=\"col-sm-6 col-md-6\">
                        <div class=\"copyright\">
                            ";
        // line 142
        $module =         null;
        $helper =         'start';
        $name =         'getCopyright';
        $params = array("internal"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
     ";
        // line 150
        $module =         null;
        $helper =         'users';
        $name =         'users_lang_select';
        $params = array(["type" => "menu", "template" => "sidebox"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 151
        echo "     </div>

     ";
        // line 153
        if ( !($context["is_pjax"] ?? null)) {
            // line 154
            echo "         ";
            // line 155
            echo "         <link rel=\"stylesheet\" href=\"";
            echo ($context["site_root"] ?? null);
            echo "uploads/themes-fixed/pleasure/styles/style-";
            echo $this->getAttribute(($context["_LANG"] ?? null), "rtl", []);
            echo ".css\">

         ";
            // line 158
            echo "         ";
            // line 159
            echo "     ";
        }
        // line 160
        echo "
     <script>
         \$(document).ready(function () {
             let headerImg = ";
        // line 163
        echo twig_jsonencode_filter(($context["header_style"] ?? null));
        echo ";
             if (headerImg !== null) {
                 \$(window).on('resize', setHeartImage)
                 let container = \$('#b-header')
                 let imgContainer = \$('.custom-header')

                 function setHeartImage () {
                     let widthW = document.body.clientWidth
                     let mobileWidth = 768
                     if (widthW > mobileWidth) {
                         if (typeof headerImg.image_url !== 'undefined') {
                             container.addClass('custom-header_without_img')
                             container.css({ 'background-image': 'url(' + headerImg.base_path + '/' + headerImg.image_url + ')' })
                         } else {
                             container.removeClass('custom-header_without_img')
                         }
                     } else if (widthW < mobileWidth) {
                         if (typeof headerImg.image_mobile_url !== 'undefined') {
                             container.addClass('custom-header_without_img')
                             container.css({ 'background-image': 'url(' + headerImg.base_path + '/' + headerImg.image_mobile_url + ')' })
                         } else {
                             container.removeClass('custom-header_without_img')
                         }
                     }
                 }

                 setHeartImage()
             }
         })
     </script>

     <script src=\"";
        // line 194
        echo ($context["site_root"] ?? null);
        echo "uploads/themes-fixed/pleasure/js/controls.js\"></script>

     ";
        // line 197
        echo "     ";
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"twigjs/twig.js"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 198
        echo "     ";
        $module =         null;
        $helper =         'themes';
        $name =         'load';
        $params = array(["name" => "modules", "ext" => "js"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "     ";
        $module =         null;
        $helper =         'themes';
        $name =         'load';
        $params = array(["name" => "modules_multi_request", "ext" => "js"]        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 200
        echo "

     ";
        // line 202
        $module =         null;
        $helper =         'cookie_policy';
        $name =         'cookie_policy_block';
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
        // line 203
        echo "     ";
        $module =         null;
        $helper =         'languages';
        $name =         'lang_editor';
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
        // line 204
        echo "     ";
        $module =         null;
        $helper =         'seo_advanced';
        $name =         'seo_traker';
        $params = array("footer"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 205
        echo "
     <script>
         \$(function () {
             \$.datepicker.setDefaults(\$.datepicker.regional[\"";
        // line 208
        echo $this->getAttribute(($context["_LANG"] ?? null), "code", []);
        echo "\"])
         })
     </script>

     </body>
     </html>

 ";
    }

    public function getTemplateName()
    {
        return "index_pleasure.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1038 => 208,  1033 => 205,  1011 => 204,  989 => 203,  968 => 202,  964 => 200,  942 => 199,  920 => 198,  898 => 197,  893 => 194,  859 => 163,  854 => 160,  851 => 159,  849 => 158,  841 => 155,  839 => 154,  837 => 153,  833 => 151,  812 => 150,  803 => 143,  782 => 142,  778 => 140,  757 => 139,  748 => 132,  727 => 131,  724 => 130,  703 => 129,  690 => 118,  669 => 117,  645 => 115,  622 => 114,  614 => 109,  579 => 96,  556 => 95,  551 => 93,  546 => 90,  520 => 86,  497 => 85,  492 => 83,  487 => 80,  461 => 76,  438 => 75,  433 => 73,  428 => 70,  425 => 69,  404 => 68,  379 => 65,  356 => 64,  351 => 62,  337 => 50,  316 => 49,  292 => 47,  287 => 44,  285 => 43,  263 => 42,  255 => 35,  234 => 34,  227 => 29,  206 => 28,  183 => 27,  160 => 26,  137 => 25,  130 => 20,  109 => 19,  105 => 18,  95 => 10,  82 => 9,  79 => 8,  66 => 7,  63 => 6,  49 => 5,  46 => 4,  40 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index_pleasure.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\index_pleasure.twig");
    }
}
