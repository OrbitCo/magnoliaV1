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

/* forgot_form.twig */
class __TwigTemplate_689fdb9b323175cb9af1b900ebc509f8f790bef1db14020a45d175054d0cf868 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "forgot_form.twig", 1)->display($context);
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
        <p class=\"header-comment\">
            ";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_restore"        ,"users"        ,        );
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
        echo "        </p>
    </div>

    <div class=\"inside logform\">
        <form action=\"";
        // line 14
        echo ($context["site_url"] ?? null);
        echo "users/restore\" method=\"post\" class=\"form-horizontal\">
            <div class=\"form-group\">
                <label for=\"email\" class=\"col-xs-12 tali\">
                    ";
        // line 17
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
                <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-4\">
                    <input type=\"email\" name=\"email\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "email", []));
        echo "\" id=\"email\" class=\"form-control\">
                </div>
            </div>
            <div class=\"form-group\">
                <div class=\"col-sm-12\">
                    <input type=\"submit\" name=\"btn_save\" class=\"btn btn-primary\" value=\"";
        // line 25
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
        echo "\">
                </div>
            </div>
        </form>
    </div>
</div>
<div class=\"clr\"></div>

";
        // line 33
        $this->loadTemplate("@app/footer.twig", "forgot_form.twig", 33)->display($context);
    }

    public function getTemplateName()
    {
        return "forgot_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 33,  129 => 25,  121 => 20,  96 => 17,  90 => 14,  84 => 10,  63 => 9,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "forgot_form.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/forgot_form.twig");
    }
}
