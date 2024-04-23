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

/* notifications/moderation_status.twig */
class __TwigTemplate_c7e4a08cf9acf097a74eac6e80b8488d864ddb9d7d825baa90f27a4ed4f2ec8d extends \Twig\Template
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
        echo $this->getAttribute(($context["data"] ?? null), "fname", []);
        echo "!</td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;padding-top:30px;\">
            ";
        // line 7
        echo $this->getAttribute(($context["data"] ?? null), "preview", []);
        echo "
        </td>
    </tr>
    <tr>
        <td style=\"padding-bottom:30px;\">
            ";
        // line 12
        echo $this->getAttribute(($context["data"] ?? null), "status", []);
        echo "
        </td>
    </tr>
</table>";
    }

    public function getTemplateName()
    {
        return "notifications/moderation_status.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 12,  62 => 7,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "notifications/moderation_status.twig", "/home/mliadov/public_html/application/modules/moderation/views/flatty/notifications/moderation_status.twig");
    }
}
