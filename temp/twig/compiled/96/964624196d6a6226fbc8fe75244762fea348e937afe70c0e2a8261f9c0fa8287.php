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

/* content_template.twig */
class __TwigTemplate_a85116b2b2208e810766a15e0e34f7026ebce7ec7f7242bb5067003f49f594c2 extends \Twig\Template
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
        echo "<table align=\"center\" bgcolor=\"#e3e3e3\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;\" width=\"100%\">
    <tr>
        <td height=\"100%\"  bgcolor=\"#e3e3e3\">
            <table  bgcolor=\"#ffffff\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"600\" style=\"border:0;padding:0\">
                <tr>
                    <td colspan=\"2\" style=\"padding:20px;font-family:Helvetica,sans-serif;font-weight:300;font-size:18px;color:#373737;line-height:1.5\">
                        ";
        // line 7
        echo ($context["content"] ?? null);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"border-top:1px solid #e3e3e3;padding: 20px;\">
                        <span style=\"font-family:Helvetica,sans-serif;font-weight:300;font-size:14px;color:#373737;line-height:1.5\">
                            ";
        // line 13
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("notification_best_regards"        ,"notifications"        ,($context["lang_id"] ?? null)        ,        );
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
        echo ",<br>
                            ";
        // line 14
        echo $this->getAttribute(($context["data"] ?? null), "mail_from_name", []);
        echo "
                        </span>
                    </td>
                    <td style=\"border-top:1px solid #e3e3e3;padding: 20px;text-align:right;\">
                        <a href=\"";
        // line 18
        echo ($context["site_url"] ?? null);
        echo "\" style=\"text-decoration:none;text-align:right;\">
                            <img src=\"";
        // line 19
        echo ($context["site_url"] ?? null);
        echo "application/views/";
        echo ($context["theme"] ?? null);
        echo "/logo/mini_logo_red.png\">
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>";
    }

    public function getTemplateName()
    {
        return "content_template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 19,  77 => 18,  70 => 14,  47 => 13,  38 => 7,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "content_template.twig", "/home/mliadov/public_html/application/modules/notifications/views/flatty/content_template.twig");
    }
}