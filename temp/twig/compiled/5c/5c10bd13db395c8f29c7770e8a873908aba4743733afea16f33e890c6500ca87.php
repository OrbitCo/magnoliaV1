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

/* helper_app_ghost_black.twig */
class __TwigTemplate_b6ed989ad82475c2d9f388db3bd72bbcdb299477b167b8932454ab8770939d7e extends \Twig\Template
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
        if ((($context["android_url"] ?? null) || ($context["ios_url"] ?? null))) {
            // line 2
            echo "    ";
            if (($context["android_url"] ?? null)) {
                // line 3
                echo "        <a onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("index"                ,"btn_download_android_app"                ,                );
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
                echo "\" href=\"";
                echo ($context["android_url"] ?? null);
                echo "\" class=\"android_app\" target=\"_blank\">
            <img class=\"img-responsive\" src=\"";
                // line 4
                echo ($context["site_root"] ?? null);
                echo "application/views/flatty/img/android.svg\">
        </a>
    ";
            }
            // line 7
            echo "    ";
            if (($context["ios_url"] ?? null)) {
                // line 8
                echo "        <a onclick=\"";
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("index"                ,"btn_download_ios_app"                ,                );
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
                echo "\" href=\"";
                echo ($context["ios_url"] ?? null);
                echo "\" class=\"ios_app\" target=\"_blank\">
            <img class=\"img-responsive\" src=\"";
                // line 9
                echo ($context["site_root"] ?? null);
                echo "application/views/flatty/img/appstore.svg\">
        </a>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "helper_app_ghost_black.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 9,  70 => 8,  67 => 7,  61 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_app_ghost_black.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\mobile\\views\\flatty\\helper_app_ghost_black.twig");
    }
}
