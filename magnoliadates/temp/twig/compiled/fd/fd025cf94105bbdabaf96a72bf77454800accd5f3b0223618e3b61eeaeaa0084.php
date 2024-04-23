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

/* notifications/user_no_exists_restore.twig */
class __TwigTemplate_4d03137888a10f7f49f503f49c299cbd378056b594c5d7957e6354cb3126198e extends \Twig\Template
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
            ";
        // line 4
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
        echo ". 
            ";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_field_user_no_exists"        ,"users"        ,($context["lang_id"] ?? null)        ,        );
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
        echo "        </td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;\">
            ";
        // line 10
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_field_registration_link"        ,"users"        ,($context["lang_id"] ?? null)        ,        );
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
            <a href='";
        // line 11
        echo ($context["site_url"] ?? null);
        echo "start/index/registration' style=\"text-decoration: none;\">
                ";
        // line 12
        echo ($context["site_url"] ?? null);
        echo "
            </a>
        </td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;\">
            ";
        // line 18
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_restore_is_error"        ,"users"        ,($context["lang_id"] ?? null)        ,        );
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
        echo ". 
        </td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "notifications/user_no_exists_restore.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 18,  112 => 12,  108 => 11,  85 => 10,  79 => 6,  58 => 5,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "notifications/user_no_exists_restore.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/notifications/user_no_exists_restore.twig");
    }
}
