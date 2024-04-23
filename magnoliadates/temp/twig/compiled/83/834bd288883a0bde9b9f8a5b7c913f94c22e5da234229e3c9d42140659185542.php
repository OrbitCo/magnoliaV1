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

/* restore_password.twig */
class __TwigTemplate_2e6161505f93bd8c14a5a45ea4e812f310e48034a91c40fd217b16db47e11718 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "restore_password.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12 content-block load_content\">
    <div class=\"page-header\">
        <h1>
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
        echo "        </h1>
    </div>

    <div class=\"inside logform\">
        <form action=\"";
        // line 11
        echo ($context["site_url"] ?? null);
        echo "users/restore\" method=\"post\" class=\"form-horizontal\">
            <input type=\"hidden\" name=\"code\" value=\"";
        // line 12
        echo ($context["code"] ?? null);
        echo "\">
            <div class=\"form-group\">
                <label for=\"password\" class=\"col-xs-12 tali\">
                    ";
        // line 15
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_new_password"        ,"users"        ,        );
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
                <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                    <input type=\"password\" name=\"password\" value=\"\" id=\"password\" class=\"form-control\">
                </div>
            </div>
            <div class=\"form-group\">
                <label for=\"repassword\" class=\"col-xs-12 tali\">
                    ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_repassword"        ,"users"        ,        );
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
                <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                    <input type=\"password\" name=\"repassword\" value=\"\" id=\"repassword\" class=\"form-control\" required>
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <input type=\"submit\" name=\"btn_restore\" class=\"btn btn-primary\" value=\"";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,        );
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
        echo "\" required>
                </div>
            </div>
        </form>
    </div>
</div>
<div class=\"clr\"></div>
<script>
    \$(function(){
        let password = document.getElementById(\"password\");
        let repassword = document.getElementById(\"repassword\");
        const validatePassword = () => {
            if(password.value !== repassword.value) {
              repassword.setCustomValidity(\"Passwords Don't Match\");
            } else {
              repassword.setCustomValidity('');
            }
          }
          password.onchange = validatePassword;
          repassword.onkeyup = validatePassword;
    });
</script>
";
        // line 53
        $this->loadTemplate("@app/footer.twig", "restore_password.twig", 53)->display($context);
    }

    public function getTemplateName()
    {
        return "restore_password.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 53,  135 => 31,  105 => 23,  75 => 15,  69 => 12,  65 => 11,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "restore_password.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/restore_password.twig");
    }
}
