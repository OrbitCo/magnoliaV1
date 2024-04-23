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

/* registration/first_page.twig */
class __TwigTemplate_04a160812f0f8493da4a955d0ae2e8ffc5013f176e7916e3409279e15eac34f6 extends \Twig\Template
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
        if (((($context["is_link"] ?? null) == 1) || (($context["is_registration"] ?? null) == 1))) {
            // line 2
            echo "    <div data-block=\"pages\" data-act=\"close\" id=\"first-registration-page\" class=\"hide load-block\">
        <div class=\"col-xs-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3\">
            <div class=\"g-flatty-block\">
                <div class=\"col-xs-12\">
                    <h3>";
            // line 6
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_promo"            ,"start"            ,            );
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
            // line 7
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_promo_second"            ,"start"            ,            );
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
                    <div class=\"col-xs-12 form-group user_types-block\">
                        <input type=\"hidden\" name=\"data[user_type]\" value=\"";
            // line 9
            echo $this->getAttribute(($context["user_data"] ?? null), "user_type", []);
            echo "\">
                        <button data-button_type =\"i\"  type=\"button\" class=\"btn btn-default dropdown-toggle btn-lg btn-block btn-group\" data-toggle=\"dropdown\">
                            <span class=\"col-xs-11\">";
            // line 11
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_user_type_i"            ,"users"            ,            );
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
            echo "  ";
            if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "user_type", []))) {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), $this->getAttribute(($context["user_data"] ?? null), "user_type", []), [], "array");
            } else {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), "male", []);
            }
            echo "</span>  <span class=\"caret\"></span></button>
                        <ul class=\"dropdown-menu\" role=\"menu\" data-action=\"user-type\" data-user_type=\"i\">
                            ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 14
                echo "                                <li data-type=\"";
                echo $context["key"];
                echo "\"><a href=\"javascript:void(0);\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_user_type_i"                ,"users"                ,                );
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
                echo "  ";
                echo $context["item"];
                echo "</a></li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "                        </ul>
                    </div>
                    <div class=\"col-xs-12 form-group user_types-block\">
                        <input type=\"hidden\" name=\"data[looking_user_type]\" value=\"";
            // line 19
            echo $this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []);
            echo "\">
                        <button data-button_type =\"look\" type=\"button\" class=\"btn btn-default dropdown-toggle btn-lg btn-block btn-group\" data-toggle=\"dropdown\">
                            <span class=\"col-xs-11\">";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_user_type_look"            ,"users"            ,            );
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
            echo "  ";
            if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []))) {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), $this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []), [], "array");
            } else {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "looking_user_type", []), "option", []), "female", []);
            }
            echo "</span>  <span class=\"caret\"></span></button>
                        <ul class=\"dropdown-menu\" role=\"menu\"  data-action=\"user-type\" data-user_type=\"look\">
                            ";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "looking_user_type", []), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 24
                echo "                                <li data-type=\"";
                echo $context["key"];
                echo "\"><a href=\"javascript:void(0);\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_user_type_look"                ,"users"                ,                );
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
                echo "  ";
                echo $context["item"];
                echo "</a></li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "                        </ul>
                    </div>
                    <div class=\"form-group\">
                        <div class=\"col-xs-12 continue-block\">
                            <button onclick=\"";
            // line 30
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("index"            ,"btn_register"            ,            );
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
            echo "\" class=\"btn btn-primary btn-block btn-lg\" data-action=\"next-page\" data-page=\"1\"  type=\"button\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_continue"            ,"users"            ,            );
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
                <div class=\"clearfix\"></div>

            </div>
            <div class=\"sign_in-block\">
                ";
            // line 38
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_have_account"            ,"users"            ,            );
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
                <a onclick=\"";
            // line 39
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("index"            ,"btn_sign_in"            ,            );
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
            // line 40
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"login_form"            ,            );
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
            // line 41
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_login"            ,"start"            ,            );
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
            echo "                </a>
            </div>
            <div class=\"clearfix\"></div>
        </div>    
    </div>
";
        } else {
            // line 48
            echo "    <div data-block=\"pages\" id=\"first-registration-page\" class=\"hide\">
        <div class=\"col-sm-7 col-md-9\">
            <div class=\"b-header__message\">
                <h2>";
            // line 51
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_promo"            ,"start"            ,            );
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
            // line 52
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("text_promo_second"            ,"start"            ,            );
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
                <div class=\"col-xs-12 col-sm-12  col-md-5 user_types-block\">
                    <input type=\"hidden\" name=\"data[user_type]\" value=\"";
            // line 54
            echo $this->getAttribute(($context["user_data"] ?? null), "user_type", []);
            echo "\">
                    <button data-button_type =\"i\"  type=\"button\" class=\"btn btn-default dropdown-toggle btn-lg btn-block btn-group\" data-toggle=\"dropdown\">
                        <span class=\"col-xs-11\">";
            // line 56
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_user_type_i"            ,"users"            ,            );
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
            echo "  ";
            if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "user_type", []))) {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), $this->getAttribute(($context["user_data"] ?? null), "user_type", []), [], "array");
            } else {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), "male", []);
            }
            echo "</span>  <span class=\"caret\"></span></button>
                    <ul class=\"dropdown-menu\" role=\"menu\" data-action=\"user-type\" data-user_type=\"i\">
                        ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 59
                echo "                            <li data-type=\"";
                echo $context["key"];
                echo "\"><a href=\"javascript:void(0);\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_user_type_i"                ,"users"                ,                );
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
                echo "  ";
                echo $context["item"];
                echo "</a></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "                    </ul>
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-5 user_types-block\">
                    <input type=\"hidden\" name=\"data[looking_user_type]\" value=\"";
            // line 64
            echo $this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []);
            echo "\">
                    <button data-button_type =\"look\" type=\"button\" class=\"btn btn-default dropdown-toggle btn-lg btn-block btn-group\" data-toggle=\"dropdown\">
                        <span class=\"col-xs-11\">";
            // line 66
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_user_type_look"            ,"users"            ,            );
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
            echo "  ";
            if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []))) {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "user_types", []), "option", []), $this->getAttribute(($context["user_data"] ?? null), "looking_user_type", []), [], "array");
            } else {
                echo $this->getAttribute($this->getAttribute($this->getAttribute(($context["data"] ?? null), "looking_user_type", []), "option", []), "female", []);
            }
            echo "</span>  <span class=\"caret\"></span></button>
                    <ul class=\"dropdown-menu\" role=\"menu\"  data-action=\"user-type\" data-user_type=\"look\">
                        ";
            // line 68
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["data"] ?? null), "looking_user_type", []), "option", []));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 69
                echo "                            <li data-type=\"";
                echo $context["key"];
                echo "\"><a href=\"javascript:void(0);\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("field_user_type_look"                ,"users"                ,                );
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
                echo "  ";
                echo $context["item"];
                echo "</a></li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 71
            echo "                    </ul>
                </div>
                <div class=\"col-xs-12 col-sm-12 col-md-2 continue-block\">
                    <button onclick=\"";
            // line 74
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("index"            ,"btn_register"            ,            );
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
            echo "\" class=\"btn btn-primary btn-lg btn-block\" data-action=\"next-page\" data-page=\"1\"  type=\"button\">";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_continue"            ,"users"            ,            );
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
                <div class=\"sign_in-block\">
                    ";
            // line 77
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_have_account"            ,"users"            ,            );
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
                    <a onclick=\"";
            // line 78
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("index"            ,"btn_sign_in"            ,            );
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
            // line 79
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"login_form"            ,            );
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
            // line 80
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_login"            ,"start"            ,            );
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
            // line 81
            echo "                    </a>
                </div>
            </div>
        </div>    
        <div class=\"clearfix\"></div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "registration/first_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  727 => 81,  706 => 80,  683 => 79,  660 => 78,  637 => 77,  591 => 74,  586 => 71,  554 => 69,  550 => 68,  520 => 66,  515 => 64,  510 => 61,  478 => 59,  474 => 58,  444 => 56,  439 => 54,  415 => 52,  392 => 51,  387 => 48,  379 => 42,  358 => 41,  335 => 40,  312 => 39,  289 => 38,  238 => 30,  232 => 26,  200 => 24,  196 => 23,  166 => 21,  161 => 19,  156 => 16,  124 => 14,  120 => 13,  90 => 11,  85 => 9,  61 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "registration/first_page.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\registration\\first_page.twig");
    }
}
