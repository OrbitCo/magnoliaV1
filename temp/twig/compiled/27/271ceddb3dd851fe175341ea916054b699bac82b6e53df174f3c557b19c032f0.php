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

/* registration/second_page.twig */
class __TwigTemplate_c71aef98ef1ac6299f1dc6ddb9602bb9bd893fc23e076f3bd208fa5d41670d3c extends \Twig\Template
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
        echo "<div data-block=\"pages\" data-act=\"close\" id=\"second-registration-page\" class=\"hide\">
    ";
        // line 2
        $module =         null;
        $helper =         'users_connections';
        $name =         'show_social_networking_login';
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
        $context['social_button'] = $result;
        // line 3
        echo "    <div class=\"col-xs-12 
        ";
        // line 4
        if (( !twig_test_empty(($context["social_button"] ?? null)) && ($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0))) {
            // line 5
            echo "        col-md-8 col-md-offset-2";
        } else {
            echo "col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3";
        }
        echo "\">
            <div class=\"g-flatty-block\">
                <h3>";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("get_started"        ,"users"        ,        );
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
                <div class=\"col-xs-12 ";
        // line 8
        if (( !twig_test_empty(($context["social_button"] ?? null)) && ($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0))) {
            echo "col-md-6 first-block";
        }
        echo "\">
                     <div class=\"form-group col-xs-12\">
                         <label for=\"email\">";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_email"        ,"users"        ,        );
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
        echo " : </label>
                         <div>
                             <input data-action=\"validation\" data-field=\"email\" id=\"email\" class=\"form-control\" type=\"email\" value=\"";
        // line 12
        echo $this->getAttribute(($context["user_data"] ?? null), "email", []);
        echo "\" name=\"data[email]\" placeholder=\"example@gmail.com\" autocomplete=\"new-email\">
                         </div>
                     </div>
                     <div class=\"form-group col-xs-12\">
                         <label for=\"password\">";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_password"        ,"users"        ,        );
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
        echo ": </label>
                         <div>
                             <input data-action=\"validation\" data-field=\"password\" id=\"password\" class=\"form-control\" type=\"password\" value=\"";
        // line 18
        echo $this->getAttribute(($context["user_data"] ?? null), "password", []);
        echo "\" name=\"data[password]\" autocomplete=\"new-password\" >
                         </div>
                    </div>
                    ";
        // line 21
        $module =         null;
        $helper =         'referral_links';
        $name =         'referral_get_code';
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
        // line 22
        echo "                    <div class=\"form-group col-xs-12\">
                        <label for=\"\">
                            <div style=\"display: inline;\">
                            <input data-action=\"validation\" data-field=\"confirmation\" id=\"confirmation\" type=\"checkbox\" name=\"data[confirmation]\" value=\"1\" 
                            ";
        // line 26
        if ($this->getAttribute(($context["user_data"] ?? null), "is_terms", [])) {
            echo " checked ";
        }
        echo ">
                            ";
        // line 27
        $module =         null;
        $helper =         'content';
        $name =         'get_page_link';
        $params = array(["page_gid" => "legal-terms"]        ,        );
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
        $context['legal_terms_link'] = $result;
        // line 28
        echo "                            ";
        $module =         null;
        $helper =         'content';
        $name =         'get_page_link';
        $params = array(["page_gid" => "privacy-and-security"]        ,        );
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
        $context['privacy_link'] = $result;
        // line 29
        echo "                            ";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_confirmation"        ,"users"        ,        );
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
        // line 30
        echo "                            </div>
                            ";
        // line 31
        if ( !twig_test_empty(($context["legal_terms_link"] ?? null))) {
            // line 32
            echo "                                <a href=\"javascript:void(0);\" data-href=\"";
            echo ($context["legal_terms_link"] ?? null);
            echo "\" id=\"terms_and_conditions\" data-gid=\"legal-terms\">
                                    ";
            // line 33
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("terms_and_conditions"            ,"users"            ,            );
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
            echo "                                </a>
                            ";
        }
        // line 36
        echo "                            ";
        if ( !twig_test_empty(($context["privacy_link"] ?? null))) {
            // line 37
            echo "                                 ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_and_the"            ,"users"            ,            );
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
            echo " 
                                <a href=\"javascript:void(0);\" data-href=\"";
            // line 38
            echo ($context["privacy_link"] ?? null);
            echo "\" id=\"privacy_and_security\" data-gid=\"privacy-and-security\">
                                    ";
            // line 39
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("privacy_and_security"            ,"users"            ,            );
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
            echo "                                </a>
                            ";
        }
        // line 42
        echo "
                        </label>
                        <span class=\"pginfo msg confirmation\"></span>
                    </div>
                     <div class=\"form-group col-xs-12\">
                         <div>
                             <button onclick=\"";
        // line 48
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("index"        ,"btn_register_step2"        ,        );
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
        echo "\" class=\"btn btn-primary btn-block btn-lg\" data-action=\"next-page\" data-page=\"2\"  type=\"button\" >";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_next"        ,"start"        ,        );
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
        echo "</button>
                         </div>
                     </div>
                </div>
                ";
        // line 52
        if (( !twig_test_empty(($context["social_button"] ?? null)) && ($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0))) {
            // line 53
            echo "                    <div class=\"col-xs-12 col-md-6 second-block\">
                        <div>";
            // line 54
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("login_or_signup"            ,"users"            ,            );
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
            echo "</div>
                        <div class=\"social_networking\">";
            // line 55
            $module =             null;
            $helper =             'users_connections';
            $name =             'show_social_networking_login';
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
            echo "</div>
                    </div>   
                ";
        }
        // line 58
        echo "                <div class=\"clearfix\"></div>
            </div>
            <div class=\"clearfix\"></div>
    
            <div class=\"sign_in-block center\">
                ";
        // line 63
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_have_account"        ,"users"        ,        );
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
        echo "                <a onclick=\"";
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
        // line 65
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
        // line 66
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
        // line 67
        echo "                </a>
            </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "registration/second_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 67,  530 => 66,  507 => 65,  483 => 64,  462 => 63,  455 => 58,  430 => 55,  407 => 54,  404 => 53,  402 => 52,  355 => 48,  347 => 42,  343 => 40,  322 => 39,  318 => 38,  294 => 37,  291 => 36,  287 => 34,  266 => 33,  261 => 32,  259 => 31,  256 => 30,  234 => 29,  212 => 28,  191 => 27,  185 => 26,  179 => 22,  158 => 21,  152 => 18,  128 => 16,  121 => 12,  97 => 10,  90 => 8,  67 => 7,  59 => 5,  57 => 4,  54 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "registration/second_page.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\registration\\second_page.twig");
    }
}
