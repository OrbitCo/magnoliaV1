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

/* settings.twig */
class __TwigTemplate_d74154c33146d1ef886ec138de8239ef4f188563ff623727e8f266c53b3ba440 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "settings.twig", 1)->display($context);
        // line 2
        echo "<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
            <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate
                  class=\"form-horizontal form-label-left\" name=\"save_form\"
                  action=\"";
        // line 7
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\">
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("im_status_field"        ,"im"        ,        );
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
        echo ":</label>
                    <div class=\"col-sm-9 col-xs-12\">
                        <input type=\"checkbox\" name=\"status\" value=\"1\"
                          ";
        // line 13
        if ($this->getAttribute(($context["settings_data"] ?? null), "status", [])) {
            echo "checked";
        }
        echo " class=\"flat\" id=\"im_status\">
                    </div>
                </div>
\t\t            <div class=\"form-group\">
                    <div class=\"control-label col-sm-3 col-xs-12\">
                        ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("im_message_max_chars_field"        ,"im"        ,        );
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
        echo ":</div>
                    <div class=\"col-sm-9 col-xs-12\">
                        <input type=\"text\" name=\"message_max_chars\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute(($context["settings_data"] ?? null), "message_max_chars", []));
        echo "\"
                               class=\"form-control\" id=\"message_max_chars\">
                    </div>
\t\t            </div>
                <div class=\"ln_solid\"></div>
                <div class=\"form-group\">
                    <div class=\"col-sm-9 col-xs-12 col-sm-offset-3\">
                        <input type=\"submit\" name=\"btn_save\" value=\"";
        // line 27
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
        echo "\" class=\"btn btn-success\">
                        <a class=\"btn btn-default\" href=\"";
        // line 28
        echo ($context["site_url"] ?? null);
        echo "admin/start/menu/add_ons_items\">";
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

";
        // line 36
        $this->loadTemplate("@app/footer.twig", "settings.twig", 36)->display($context);
    }

    public function getTemplateName()
    {
        return "settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 36,  137 => 28,  114 => 27,  104 => 20,  80 => 18,  70 => 13,  45 => 10,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\im\\views\\gentelella\\settings.twig");
    }
}
