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

/* helper_btn_guided_pages.twig */
class __TwigTemplate_a9fd2585e8b350bde8c6c65d30e7219ebea1e18e292d620f8dabb5a5f47c9d11 extends \Twig\Template
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
        if (($context["guided_menu"] ?? null)) {
            // line 2
            echo "    <div class=\"guided_btn\">
        <div onclick=\"";
            // line 3
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("dashboard"            ,"guide"            ,            );
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
            echo "\" class=\"guide_link\" id=\"btn-guide_page\" ";
            if (($context["DEMO_MODE"] ?? null)) {
                echo "data-analytics-gid=\"guide\" data-analytics-cat=\"dashboard\"";
            }
            echo ">
            <i class=\"fas fa-sliders-h pr5\" aria-hidden=\"true\"></i>
            ";
            // line 5
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("admin_btn_guided_pages"            ,"guided_setup"            ,            );
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
            // line 6
            echo "        </div>
    </div>

    <script type=\"text/javascript\">
        \$(function(){
            \tloadScripts(
                        [
                            \"";
            // line 13
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("guided_setup"            ,"frame-slimscroll.js"            ,"path"            ,            );
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
            // line 14
            $module =             null;
            $helper =             'utils';
            $name =             'jscript';
            $params = array("guided_setup"            ,"guided_setup.js"            ,"path"            ,            );
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
                        ],
                        function(){
                                guided_setup = new GuidedSetup({
                                        siteUrl: site_url,
                                        guidedMenuId: ";
            // line 19
            echo $this->getAttribute(($context["guided_menu"] ?? null), "id", []);
            echo ",
                                        frameName: '";
            // line 20
            echo $this->getAttribute(($context["guided_menu"] ?? null), "gid", []);
            echo "',
                                        btnGuidePage: '#btn-guide_page',
                                });
                        },
                        ['guided_setup'],
                        {async: false}
                );

        });
    </script>

";
        }
    }

    public function getTemplateName()
    {
        return "helper_btn_guided_pages.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 20,  143 => 19,  116 => 14,  93 => 13,  84 => 6,  63 => 5,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_btn_guided_pages.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\guided_setup\\views\\gentelella\\helper_btn_guided_pages.twig");
    }
}
