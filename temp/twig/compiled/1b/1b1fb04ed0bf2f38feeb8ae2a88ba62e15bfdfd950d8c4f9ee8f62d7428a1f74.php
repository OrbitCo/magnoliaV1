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

/* helper_notifications_list_settings.twig */
class __TwigTemplate_948325b04096ecd5e3d067af6773a26fb99ffc17d0f79c7e08d70c7e5d0a847f extends \Twig\Template
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
        echo "<h1>";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_notify_desktop"        ,"start"        ,        );
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
<h3>";
        // line 2
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_notify_desktop_subtitle"        ,"start"        ,        );
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
        echo "</h3>
<div>
    <form action=\"\" method=\"post\" class=\"form-horizontal\">
        <div class=\"form-group\">
            <div class=\"col-xs-12\">
                ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["notifications_list"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["notification"]) {
            // line 8
            echo "                    <div class=\"checkbox\">
                        <label><input type=\"checkbox\" value=\"";
            // line 9
            echo $this->getAttribute($context["notification"], "gid", []);
            echo "\" name=\"desktop_notification[]\" 
                                      ";
            // line 10
            if (twig_in_filter($this->getAttribute($context["notification"], "gid", []), ($context["desktop_notifications_gids"] ?? null))) {
                echo "checked";
            }
            echo ">";
            echo $this->getAttribute($context["notification"], "name", []);
            echo "</label>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notification'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-xs-12\">
                <input class=\"btn btn-primary\" type=\"submit\" value=\"";
        // line 17
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
        echo "\" name=\"btn_save_desctop\">
            </div>
        </div>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "helper_notifications_list_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 17,  105 => 13,  92 => 10,  88 => 9,  85 => 8,  81 => 7,  54 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_notifications_list_settings.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/helper_notifications_list_settings.twig");
    }
}
