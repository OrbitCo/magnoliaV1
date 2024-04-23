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

/* custom/registration/third_page.twig */
class __TwigTemplate_1e76bc87319b5d0229d506affc40c64eb4cdc30d0a2bbbca5fd4dc3ff08d2af1 extends \Twig\Template
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
        echo "<div data-block=\"pages\" data-act=\"close\" id=\"third-registration-page\" class=\"hide\">
    <div class=\"col-xs-12 
        ";
        // line 3
        if (( !twig_test_empty(($context["social_button"] ?? null)) && ($this->getAttribute(($context["data"] ?? null), "is_auth", []) == 0))) {
            // line 4
            echo "        col-md-8 col-md-offset-2";
        } else {
            echo "col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3";
        }
        echo "\">
        <div class=\"g-flatty-block\">
            <h3>";
        // line 6
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
            <div class=\"col-xs-12\">
                <div class=\"form-group nickname-block\">
                    <label for=\"\" class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        ";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_nickname"        ,"users"        ,        );
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
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        <input data-action=\"validation\" data-field=\"nickname\" id=\"nickname\" type=\"text\" name=\"data[nickname]\" value=\"";
        // line 13
        echo $this->getAttribute(($context["user_data"] ?? null), "nickname", []);
        echo "\" class=\"form-control\">
                    </div>
                    <div class=\"clearfix\"></div>
                </div>
                <div class=\"form-group birthday-block\">
                    <label for=\"\" class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("birth_date"        ,"users"        ,        );
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
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        <div id=\"datepicker\" class=\"hidden\"></div>
                        <input  data-action=\"validation\" data-field=\"birth_date\" type=\"text\" value=\"";
        // line 23
        if ( !twig_test_empty($this->getAttribute(($context["user_data"] ?? null), "birth_date", []))) {
            echo $this->getAttribute(($context["user_data"] ?? null), "birth_date", []);
        } else {
            echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "min_date", []));
        }
        echo "\" name=\"data[birth_date]\" id=\"birth_date\" maxlength=\"10\" class=\"form-control hidden\">                            
                    </div>
                    <div class=\"clearfix\"></div>
                </div>
                <div class=\"form-group location-block\">
                    <label for=\"\" class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        ";
        // line 29
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_location"        ,"users"        ,        );
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
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        ";
        // line 32
        $module =         null;
        $helper =         'countries';
        $name =         'locationSelect';
        $params = array(["module" => "countries", "select_type" => "city", "id_country" => $this->getAttribute(        // line 35
($context["user_data"] ?? null), "id_country", []), "id_region" => $this->getAttribute(        // line 36
($context["user_data"] ?? null), "id_region", []), "id_city" => $this->getAttribute(        // line 37
($context["user_data"] ?? null), "id_city", []), "lat" => $this->getAttribute(        // line 38
($context["user_data"] ?? null), "lat", []), "lon" => $this->getAttribute(        // line 39
($context["user_data"] ?? null), "lon", []), "var_country_name" => "data[id_country]", "var_region_name" => "data[id_region]", "var_city_name" => "data[id_city]", "var_lat_name" => "data[lat]", "var_lon_name" => "data[lon]", "auto_detect" => 1]        ,        );
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
        echo "                    </div>
                    <div class=\"clearfix\"></div>
                </div>

                ";
        // line 52
        echo "                <div class=\"registration-form-fields clearfix\">
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        <div class=\"row\">
                            ";
        // line 55
        $this->loadTemplate("custom/custom_form_fields.twig", "custom/registration/third_page.twig", 55)->display(twig_array_merge($context, ["register_form" => 1]));
        // line 56
        echo "                        </div>
                    </div>
                </div>
                ";
        // line 60
        echo "                
                ";
        // line 69
        echo "                <div class=\"form-group\">
                    <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3\">
                        <button onclick=\"";
        // line 71
        $module =         null;
        $helper =         'start';
        $name =         'setAnalytics';
        $params = array("index"        ,"btn_register_step3"        ,        );
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
        echo "\" data-action=\"update-profile\" class=\"btn btn-primary btn-block btn-lg\" data-page=\"3\" >";
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
                <div class=\"clearfix\"></div>
            </div>
            <div class=\"clearfix\"></div>
        </div>    
        <div class=\"sign_in-block center\">
            ";
        // line 79
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
        // line 80
        echo "            <a onclick=\"";
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
        // line 81
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
        // line 82
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
        // line 83
        echo "            </a>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "custom/registration/third_page.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 83,  338 => 82,  315 => 81,  291 => 80,  270 => 79,  219 => 71,  215 => 69,  212 => 60,  207 => 56,  205 => 55,  200 => 52,  194 => 47,  176 => 39,  175 => 38,  174 => 37,  173 => 36,  172 => 35,  168 => 32,  143 => 29,  130 => 23,  104 => 19,  95 => 13,  70 => 10,  44 => 6,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom/registration/third_page.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\custom\\registration\\third_page.twig");
    }
}
