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

/* helper_app_btns_black.twig */
class __TwigTemplate_b74da007e945b9ae2f97da6f332eeac0ccf6c63dfb52ed9dd17bbeac124c7dbf extends \Twig\Template
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
            if ($this->getAttribute(($context["params"] ?? null), "show_xs_menu_title", [])) {
                // line 3
                echo "    <div class=\"xs-menu-title\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("xs_menu_home_get_app"                ,"users"                ,                );
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
";
            }
            // line 5
            echo "<div class=\"download\">
    <div class=\"mobile-apps clearfix\">
        <div class=\"mobile-apps__item\">
            ";
            // line 8
            if (($context["android_url"] ?? null)) {
                // line 9
                echo "                <a onclick=\"";
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
                    <img class=\"img-responsive app-black-btns\" src=\"";
                // line 10
                echo ($context["site_root"] ?? null);
                echo "application/views/flatty/img/android.svg\">
                </a>
            ";
            }
            // line 13
            echo "        </div>
        <div class=\"mobile-apps__item\">
            ";
            // line 15
            if (($context["ios_url"] ?? null)) {
                // line 16
                echo "                <a onclick=\"";
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
                    <img class=\"img-responsive app-black-btns\" src=\"";
                // line 17
                echo ($context["site_root"] ?? null);
                echo "application/views/flatty/img/appstore.svg\">
                </a>
            ";
            }
            // line 20
            echo "        </div>
    </div>

    <div class=\"clearfix\"></div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_app_btns_black.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 20,  130 => 17,  104 => 16,  102 => 15,  98 => 13,  92 => 10,  66 => 9,  64 => 8,  59 => 5,  34 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_app_btns_black.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\mobile\\views\\flatty\\helper_app_btns_black.twig");
    }
}
