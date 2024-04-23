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

/* form.twig */
class __TwigTemplate_c3f2ddfd7f632bc83bc7ec5887e701769f180816c6c8ac8b511cbad0af444011 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "form.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12 contact-us-block clearfix\">
    <div class=\"row\">
        <div class=\"col-xs-12 col-sm-9 col-md-9 col-lg-9\">
            <h1>";
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
        echo "</h1>
            <div class=\"contact-us-form mb20\">
                <p class=\"mb10\">
                    ";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_contact_form_edit"        ,"contact_us"        ,        );
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
        // line 10
        echo "                </p>
                <div class=\"row\">
                    <form action=\"\" method=\"post\">
                        ";
        // line 13
        if (($context["reasons"] ?? null)) {
            // line 14
            echo "                            <div class=\"form-group\">
                                <label for=\"email\"  class=\"col-xs-12 tali\">
                                    ";
            // line 16
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_reason"            ,"contact_us"            ,            );
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
                                <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                    <select name=\"id_reason\" class=\"form-control\">
                                        ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["reasons"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 21
                echo "                                            <option value=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" ";
                if (($this->getAttribute(($context["data"] ?? null), "id_reason", []) == $this->getAttribute($context["item"], "id", []))) {
                    echo "selected";
                }
                echo ">
                                                ";
                // line 22
                echo $this->getAttribute($context["item"], "name", []);
                echo "
                                            </option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "                                    </select>
                                    <span class=\"pginfo msg reason\"></span>
                                </div>
                            </div>
                        ";
        }
        // line 30
        echo "
                        <div class=\"form-group\">
                            <label for=\"email\"  class=\"col-xs-12 tali\">
                                ";
        // line 33
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_user_name"        ,"contact_us"        ,        );
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
                            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                <input type=\"text\" name=\"user_name\" value=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "user_name", []));
        echo "\" class=\"form-control\">
                                <span class=\"pginfo msg user_name\"></span>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"email\"  class=\"col-xs-12 tali\">
                                ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_user_email"        ,"contact_us"        ,        );
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
                            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                <input type=\"text\" name=\"user_email\" value=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "user_email", []));
        echo "\" class=\"form-control\">
                                <span class=\"pginfo msg user_email\"></span>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label for=\"email\"  class=\"col-xs-12 tali\">
                                ";
        // line 51
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_subject"        ,"contact_us"        ,        );
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
                            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                <input type=\"text\" name=\"subject\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "subject", []));
        echo "\" class=\"form-control\">
                                <span class=\"pginfo msg subject\"></span>
                            </div>
                        </div>
                        <div class=\"form-group clearfix\">
                            <label for=\"email\"  class=\"col-xs-12 tali\">
                                ";
        // line 60
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_message"        ,"contact_us"        ,        );
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
                            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                <textarea name=\"message\" class=\"form-control\">";
        // line 63
        echo $this->getAttribute(($context["data"] ?? null), "message", []);
        echo "</textarea>
                                <span class=\"pginfo msg message\"></span>
                            </div>
                        </div>
                        <div class=\"form-group clearfix\">
                            <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8\">
                                ";
        // line 69
        $module =         null;
        $helper =         'start';
        $name =         'captcha';
        $params = array(["input_name" => "captcha_code"]        ,        );
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
        // line 70
        echo "                            </div>
                        </div> 
                        <div class=\"clearfix\">
                            <div class=\"col-xs-12 col-sm-12\">
                                <input data-pjax=\"0\" type=\"submit\" class=\"btn btn-primary contact_us-btn\" name=\"btn_save\" value=\"";
        // line 74
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_send"        ,"start"        ,""        ,"button"        ,        );
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ";
        // line 80
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
        // line 81
        echo "        </div>
        <div class=\"col-xs-12 col-sm-3 col-md-3 col-lg-3\">
            ";
        // line 83
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
        // line 84
        echo "            ";
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
        // line 85
        echo "            ";
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
        // line 86
        echo "            ";
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
        // line 87
        echo "        </div>
    </div>
</div>
<div class=\"social-buttons-block mt10\">
";
        // line 91
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_head';
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
        // line 92
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_like';
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
        // line 93
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_share';
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
        // line 94
        $module =         null;
        $helper =         'social_networking';
        $name =         'show_social_networks_comments';
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
        // line 95
        echo "</div>
";
        // line 96
        $this->loadTemplate("@app/footer.twig", "form.twig", 96)->display($context);
    }

    public function getTemplateName()
    {
        return "form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  551 => 96,  548 => 95,  527 => 94,  506 => 93,  485 => 92,  464 => 91,  458 => 87,  436 => 86,  414 => 85,  392 => 84,  371 => 83,  367 => 81,  346 => 80,  318 => 74,  312 => 70,  291 => 69,  282 => 63,  257 => 60,  248 => 54,  223 => 51,  214 => 45,  189 => 42,  180 => 36,  155 => 33,  150 => 30,  143 => 25,  134 => 22,  125 => 21,  121 => 20,  95 => 16,  91 => 14,  89 => 13,  84 => 10,  63 => 9,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "form.twig", "/home/mliadov/public_html/application/modules/contact_us/views/flatty/form.twig");
    }
}
