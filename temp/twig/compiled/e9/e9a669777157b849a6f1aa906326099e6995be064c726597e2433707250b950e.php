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

/* account.twig */
class __TwigTemplate_7c198f338aed77ace25046a04333249b5792615064d4325fe01881353396a811 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "account.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-xs-12\">
    <h1>
        ";
        // line 4
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
        // line 5
        echo "    </h1>
</div>
";
        // line 7
        $this->loadTemplate("account_menu_line.twig", "account.twig", 7)->display($context);
        // line 8
        echo "<div class=\"col-xs-12 services-list\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            ";
        // line 11
        if ((((($context["action"] ?? null) == "services") || (($context["action"] ?? null) == "banners")) || (($context["action"] ?? null) == "donate"))) {
            // line 12
            echo "                <div class=\"services-list-block\">
                    ";
            // line 14
            echo "                    ";
            $this->loadTemplate("account_menu.twig", "account.twig", 14)->display($context);
            // line 15
            echo "                    ";
            // line 16
            echo "                    <div id=\"all_services\" class='b-tabs__block' style=\"display: none;\">
                        ";
            // line 17
            $module =             null;
            $helper =             'services';
            $name =             'servicesBuyList';
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
            // line 18
            echo "                    </div>
                    <div id='donate' class='b-tabs__block' style=\"display: none;\">
                        ";
            // line 20
            $module =             null;
            $helper =             'start';
            $name =             'donateViewBlock';
            $params = array("account"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 21
            echo "                    </div>
                    <div id='banners' class='b-tabs__block' style=\"display: none;\">
                        ";
            // line 23
            $module =             null;
            $helper =             'banners';
            $name =             'myBanners';
            $params = array(["page" => ($context["page"] ?? null), "base_url" => ($context["base_url"] ?? null)]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            echo $output_buffer.$result;
            // line 24
            echo "                    </div>
                </div>
            ";
        } elseif ((        // line 26
($context["action"] ?? null) == "update")) {
            // line 27
            echo "                ";
            $module =             null;
            $helper =             'users_payments';
            $name =             'update_account_block';
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
            // line 28
            echo "            ";
        } elseif ((($context["action"] ?? null) == "payments_history")) {
            // line 29
            echo "                ";
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"account"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            $context['back_link'] = $result;
            // line 30
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_back_to_my_account"            ,"users"            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
            $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
            } elseif (function_exists($name)) {
            $result = call_user_func_array($name, $params);
            } else {
            $result = '';
            }
            $output_buffer = @ob_get_contents();
            @ob_end_clean();
            $context['back_link_text'] = $result;
            // line 31
            echo "                ";
            $module =             null;
            $helper =             'payments';
            $name =             'user_payments_history';
            $params = array(["id_user" => ($context["user_id"] ?? null), "page" => ($context["page"] ?? null), "base_url" => ($context["base_url"] ?? null), "back_link" =>             // line 32
($context["back_link"] ?? null), "back_link_text" => ($context["back_link_text"] ?? null)]            ,            );
            @ob_start();
            $ci = &get_instance();
            $ci->load->helper($helper, $module);
            if (empty($module)) {
            $module = str_replace('_helper', '', $helper);
            }
            if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        }
        // line 34
        echo "        </div>
    </div>
</div>
<div class=\"clearfix\"></div>
<div class=\"account-banners\">
    <div class=\"col-xs-12 block-banners-big\">
        <div>
            ";
        // line 41
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-980x90"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 42
        echo "        </div>
    </div>
    <div class=\"col-md-5 block-banners-small\">
        <div class=\"col-sm-6\">
            ";
        // line 46
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-185x155"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        </div>
        <div class=\"col-sm-6\">
            ";
        // line 49
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-185x75"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        </div>
    </div>
    <div class=\"col-xs-12 col-sm-12 col-md-7 block-banners-middle\">
        <div class=\"col-xs-12 col-sm-6\">
            ";
        // line 54
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-320x250"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        </div>
        <div class=\"col-xs-12 col-sm-6\">
            ";
        // line 57
        $module =         null;
        $helper =         'banners';
        $name =         'show_banner_place';
        $params = array("banner-320x75"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
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
        echo "        </div>
    </div>
</div>
";
        // line 61
        $this->loadTemplate("@app/footer.twig", "account.twig", 61)->display($context);
    }

    public function getTemplateName()
    {
        return "account.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  392 => 61,  387 => 58,  366 => 57,  362 => 55,  341 => 54,  335 => 50,  314 => 49,  310 => 47,  289 => 46,  283 => 42,  262 => 41,  253 => 34,  250 => 33,  232 => 32,  227 => 31,  205 => 30,  183 => 29,  180 => 28,  158 => 27,  156 => 26,  152 => 24,  131 => 23,  127 => 21,  106 => 20,  102 => 18,  81 => 17,  78 => 16,  76 => 15,  73 => 14,  70 => 12,  68 => 11,  63 => 8,  61 => 7,  57 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "account.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\account.twig");
    }
}
