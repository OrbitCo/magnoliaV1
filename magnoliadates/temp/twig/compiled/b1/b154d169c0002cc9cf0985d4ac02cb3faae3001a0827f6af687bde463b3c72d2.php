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

/* notifications/users_restore_password.twig */
class __TwigTemplate_6cc0c459ad9ecf218f802d9eef50e5ac6e9c26ce0989143e72754710a4e79f8a extends \Twig\Template
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
        <td>";
        // line 3
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
        // line 7
        if ($this->getAttribute(($context["data"] ?? null), "is_admin", [])) {
            // line 8
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("notification_field_restore_link_is_admin"            ,"users"            ,($context["lang_id"] ?? null)            ,            );
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
            ";
        } else {
            // line 10
            echo "                ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("notification_field_restore_link"            ,"users"            ,($context["lang_id"] ?? null)            ,            );
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
            ";
        }
        // line 12
        echo "            <a href='";
        echo $this->getAttribute(($context["data"] ?? null), "restore_link", []);
        echo "' style=\"text-decoration: none;\">
                ";
        // line 13
        echo $this->getAttribute(($context["data"] ?? null), "restore_link", []);
        echo "
            </a>
        </td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;\">
            ";
        // line 19
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
        return "notifications/users_restore_password.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 19,  119 => 13,  114 => 12,  89 => 10,  64 => 8,  62 => 7,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "notifications/users_restore_password.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/notifications/users_restore_password.twig");
    }
}
