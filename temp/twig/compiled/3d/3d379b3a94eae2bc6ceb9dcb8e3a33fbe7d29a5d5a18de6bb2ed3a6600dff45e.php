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

/* helper_mobile_top_menu.twig */
class __TwigTemplate_79a9d8539e1284c67dfcc07254c8aa4c25b2b770c62d106409c481ca6fc6df2d extends \Twig\Template
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
        echo "<div class=\"mobile-top-menu\">
    <div class=\"left-box\"></div>
    <div class=\"mobile-menu-wrapper\">
    </div>
    <div class=\"right-box\"></div>
</div>
<div class=\"scroll-to-top fixed mobile-menu-item\" data-id=\"pjaxcontainer\"><button class=\"btn btn-primary btn-large btn-block\" title=\"";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("button_back_to_top"        ,"menu"        ,        );
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
        echo "\"><i class=\"fa fa-arrow-up\" aria-hidden=\"true\"></i></button></div>
<script>
    \$(function () {
        loadScripts(
            [
                \"";
        // line 12
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"slick/slick.min.js"        ,"path"        ,        );
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
        echo "\",
                \"";
        // line 13
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("menu"        ,"../views/flatty/js/mobile-top-menu.js"        ,"path"        ,        );
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
            ],
            function () {
                var show_demopanel = false;
                var trial_mode = ";
        // line 17
        if (($context["TRIAL_MODE"] ?? null)) {
            echo "1";
        } else {
            echo "''";
        }
        echo ";
                var off_scroll = false;
                if (typeof isFramed != 'undefined' && !isFramed && trial_mode) {
                    off_scroll = true;
                }
                mTopMenu = new mobileTopMenu({
                    offScroll: off_scroll
                });
            },
            ['mTopMenu'],
            {async: true}
        );
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_mobile_top_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 17,  88 => 13,  65 => 12,  38 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_mobile_top_menu.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\menu\\views\\flatty\\helper_mobile_top_menu.twig");
    }
}
