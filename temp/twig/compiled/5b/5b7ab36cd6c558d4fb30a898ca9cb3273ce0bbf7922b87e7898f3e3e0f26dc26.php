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

/* ajax_login_form.twig */
class __TwigTemplate_cb2528b47fbee87867c0181e218c4294c0450801e4d2bc2bb5d6bdb8bb2b5299 extends \Twig\Template
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
        echo "<div class=\"content-block load_content\">
    <h1>
        ";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_login"        ,"users"        ,        );
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
        // line 4
        echo "    </h1>

    <div class=\"inside logform\">
        <form action=\"";
        // line 7
        echo ($context["site_url"] ?? null);
        echo "users/login\" method=\"post\" class=\"form-horizontal\">
            <div class=\"form-group\">
                <label for=\"email\"  class=\"col-xs-12 tali\">
                    ";
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
        echo ":
                </label>
                <div class=\"col-xs-8\">
                    <input type=\"email\" name=\"email\" id=\"email\" class=\"form-control\" value=\"";
        // line 13
        if (($context["DEMO_MODE"] ?? null)) {
            echo $this->getAttribute(($context["demo_user_type_login_settings"] ?? null), "login", []);
        }
        echo "\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"password\"  class=\"col-xs-12 tali\">
                    ";
        // line 18
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
        echo ":
                </label>
                <div class=\"col-xs-8\">
                    <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\" value=\"";
        // line 21
        if (($context["DEMO_MODE"] ?? null)) {
            echo $this->getAttribute(($context["demo_user_type_login_settings"] ?? null), "password", []);
        }
        echo "\">
                </div>
                <div class=\"col-xs-12 after-form tali\">
                    <a href=\"";
        // line 24
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("users"        ,"restore"        ,        );
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
                        ";
        // line 25
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_restore"        ,"users"        ,        );
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
        // line 26
        echo "                    </a>
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"col-xs-12\">
                    <input type=\"hidden\" name=\"ajax_modal\" value=\"1\">
                    <button type=\"submit\" name=\"logbtn\" class=\"btn btn-primary\">
                        ";
        // line 33
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
        // line 34
        echo "                    </button>
                </div>
            </div>
        </form>

        <div class=\"clearfix row\">
            <div class=\"col-xs-12\">
                ";
        // line 41
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
        echo $output_buffer.$result;
        // line 42
        echo "            </div>
        </div>

        <div class=\"clearfix row\">
            <div class=\"col-xs-12\">
                <p class=\"header-comment\">
                    ";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_register_comment"        ,"users"        ,        );
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
        echo "                </p>
                <a href=\"";
        // line 50
        $module =         null;
        $helper =         'seo';
        $name =         'seolink';
        $params = array("start"        ,"index/registration"        ,        );
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
        echo "\" class=\"\">
                    <i class=\"fa fa-arrow-right\"></i>
                    ";
        // line 52
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_register"        ,"users"        ,        );
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
        echo "                </a>
            </div>
        </div>
    </div>
    <div class=\"clr\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ajax_login_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  315 => 53,  294 => 52,  270 => 50,  267 => 49,  246 => 48,  238 => 42,  217 => 41,  208 => 34,  187 => 33,  178 => 26,  157 => 25,  134 => 24,  126 => 21,  101 => 18,  91 => 13,  66 => 10,  60 => 7,  55 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ajax_login_form.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/ajax_login_form.twig");
    }
}
