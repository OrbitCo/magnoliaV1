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

/* helper_message_button.twig */
class __TwigTemplate_8bc8de5a299caa0a4de55e043b685a952db3dfd673b53358e38a51b9974438be extends \Twig\Template
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
        echo "<a class=\"";
        if (($context["class"] ?? null)) {
            echo ($context["class"] ?? null);
        } else {
            echo "btn btn-secondary";
        }
        echo "  chatbox-start-dialog-btn\" ";
        if (($context["new_tab"] ?? null)) {
            echo "target=\"_blank\"";
        }
        echo " href=\"";
        echo ($context["site_url"] ?? null);
        echo "chatbox/chat/";
        echo ($context["user_id"] ?? null);
        echo "\"  data-user-id=\"";
        echo ($context["user_id"] ?? null);
        echo "\">
\t";
        // line 2
        if ((($context["text_type"] ?? null) == "chat")) {
            // line 3
            echo "\t";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("chat_now"            ,"chatbox"            ,            );
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
            echo "\t
\t";
        } else {
            // line 4
            echo "\t
    ";
            // line 5
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_message_send"            ,"chatbox"            ,            );
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
            echo "   \t";
        }
        // line 7
        echo "</a>";
    }

    public function getTemplateName()
    {
        return "helper_message_button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 7,  100 => 6,  79 => 5,  76 => 4,  51 => 3,  49 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_message_button.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\chatbox\\views\\flatty\\helper_message_button.twig");
    }
}
