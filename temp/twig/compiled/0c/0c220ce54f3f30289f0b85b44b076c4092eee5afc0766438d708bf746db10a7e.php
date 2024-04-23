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

/* helper_captcha.twig */
class __TwigTemplate_0f40f86ae85156794676a730fb640962e91cd3613cf77dc24e59931c597cccbb extends \Twig\Template
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
        if (($this->getAttribute(($context["captcha"] ?? null), "captcha_type", []) == "default")) {
            // line 2
            echo "    <label for=\"captcha\">
        ";
            // line 3
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_captcha"            ,"users"            ,            );
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
    <div class=\"input-group\">
        <span class=\"input-group-addon\">
            ";
            // line 7
            echo $this->getAttribute(($context["captcha"] ?? null), "captcha_image", []);
            echo "
        </span>
            <input id=\"g-recaptcha-response\" type=\"text\" name=\"";
            // line 9
            echo $this->getAttribute(($context["captcha"] ?? null), "input_name", []);
            echo "\" class=\"captcha form-control input-lg\" value=\"\" maxlength=\"";
            echo $this->getAttribute(($context["captcha"] ?? null), "captcha_word_length", []);
            echo "\" />
    </div>
";
        } elseif (($this->getAttribute(        // line 11
($context["captcha"] ?? null), "captcha_type", []) == "google")) {
            // line 12
            echo "    <input type=\"hidden\" id=\"g-recaptcha-response\" name=\"g-recaptcha-response\">
    <script src=\"https://www.google.com/recaptcha/api.js?render=";
            // line 13
            echo $this->getAttribute(($context["captcha"] ?? null), "site_key", []);
            echo "\"></script>
    <script>
        window.addEventListener(\"load\", function () {
            grecaptcha.ready(function() {
                let errorObj = new Errors();
                try {
                    grecaptcha.ready(function() {
                        \$(\".grecaptcha-badge\").css({display :'none'});
                        try {
                            grecaptcha.execute(\"";
            // line 22
            echo $this->getAttribute(($context["captcha"] ?? null), "site_key", []);
            echo "\", {action: 'homepage'}).then(function(token) {
                                document.getElementById('g-recaptcha-response').value = token;
                            });
                        }catch (e){
                            errorObj.show_error_block(\"";
            // line 26
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_recaptcha"            ,"start"            ,            );
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
            echo "\", 'error');
                            console.error(e.message);
                        }
                    });
                }catch (e){
                    errorObj.show_error_block(\"";
            // line 31
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_recaptcha"            ,"start"            ,            );
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
            echo "\",'error');
                    console.error(e.message);
                }
            });
        });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_captcha.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 31,  97 => 26,  90 => 22,  78 => 13,  75 => 12,  73 => 11,  66 => 9,  61 => 7,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_captcha.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/helper_captcha.twig");
    }
}
