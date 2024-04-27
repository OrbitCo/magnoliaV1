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

/* notifications/users_view.twig */
class __TwigTemplate_116db422b1fe80ea5d79f809614581e172d1acf942987f383b3bd97ac5c4498a extends \Twig\Template
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
        echo "<table>
    <tr>
        <td style=\"padding-bottom:30px;\">
            <img src='";
        // line 4
        echo $this->getAttribute(($context["data"] ?? null), "image", []);
        echo "'>
        </td>
    </tr>
    <tr>
        <td>";
        // line 8
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_field_hello"        ,"notifications"        ,($context["lang_id"] ?? null)        ,        );
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
        echo ", ";
        echo $this->getAttribute(($context["data"] ?? null), "nickname", []);
        echo "!</td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;\">
            ";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_user_view"        ,"users"        ,($context["lang_id"] ?? null)        ,        );
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
        echo ": <a href='";
        echo $this->getAttribute(($context["data"] ?? null), "link_1", []);
        echo "' style=\"text-decoration: none;\">";
        echo $this->getAttribute(($context["data"] ?? null), "fname", []);
        echo " ";
        echo $this->getAttribute(($context["data"] ?? null), "sname", []);
        echo "</a>. 
        </td>
    </tr>
    <tr>
        <td valign=\"top\" style=\"margin:0;padding:0\">
            <table align=\"left\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200px\" style=\"margin:0;padding:10px\">
                <tr>
                    <td align=\"center\" valign=\"middle\" bgcolor=\"#f06078\" style=\"margin:0;\">
                        <a href='";
        // line 20
        echo $this->getAttribute(($context["data"] ?? null), "link_2", []);
        echo "' style='color:#ffffff;text-decoration: none;padding:10px;display:block;'>";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_my_guests"        ,"users"        ,($context["lang_id"] ?? null)        ,        );
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
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>";
    }

    public function getTemplateName()
    {
        return "notifications/users_view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 20,  70 => 12,  42 => 8,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "notifications/users_view.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\notifications\\users_view.twig");
    }
}
