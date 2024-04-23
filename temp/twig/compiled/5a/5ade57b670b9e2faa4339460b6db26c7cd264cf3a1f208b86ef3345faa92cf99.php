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

/* edit_robots_form.twig */
class __TwigTemplate_36c8827caafb80d9aab6d98dedcbcb2ed1fbb8547d1b37158d5207dce2952d58 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_robots_form.twig", 1)->display($context);
        // line 2
        echo "<form class=\"x_panel form-horizontal\" method=\"post\" action=\"";
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" name=\"save_form\">
\t<div class=\"x_title h4\">";
        // line 3
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_robots_txt_editing"        ,"seo_advanced"        ,        );
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
\t<div class=\"x_content\">
\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_robots_file"        ,"seo_advanced"        ,        );
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
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12\"><textarea class=\"form-control\" name=\"content\" style=\"height: 170px\">";
        // line 7
        echo ($context["content"] ?? null);
        echo "</textarea></div>
\t\t</div>
\t\t<div class=\"ln_solid\"></div>
\t\t<div class=\"row form-group\">
\t\t\t<div class=\"col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9 col-xs-12\">
\t\t\t\t<input class=\"btn btn-success\" type=\"submit\" name=\"btn_save_robots\" value=\"";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
\t\t\t\t<a class=\"btn btn-default\" href=\"";
        // line 13
        echo ($context["site_url"] ?? null);
        echo "admin/seo_advanced\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
\t\t\t</div>
\t\t</div>
\t</div>
</form>

";
        // line 19
        $this->loadTemplate("@app/footer.twig", "edit_robots_form.twig", 19)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_robots_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 19,  116 => 13,  93 => 12,  85 => 7,  62 => 6,  37 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_robots_form.twig", "/home/mliadov/public_html/application/modules/seo_advanced/views/gentelella/edit_robots_form.twig");
    }
}
