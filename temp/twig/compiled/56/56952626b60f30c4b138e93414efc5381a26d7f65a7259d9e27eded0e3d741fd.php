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

/* helper_counter_widget.twig */
class __TwigTemplate_13abbaf9685e55d3b81eb794857389a3abaa01e67b7e5807b5f92e5474494050 extends \Twig\Template
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
        echo "<div class=\"row\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["counter"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["v"]) {
            // line 3
            echo "    <div class=\"animated flipInY col-lg-3 col-md-3 col-sm-6  \">
        <div class=\"tile-stats\">
            <div class=\"icon\"><i class=\"fa fa-solid fa-comments\"></i>
            </div>
            <div class=\"count\">";
            // line 7
            echo $context["v"];
            echo "</div>

            <h3>";
            // line 9
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array(("filed_statistics_sent_messages_" . ($context["k"] ?? null))            ,"chatbox"            ,            );
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
            <p>";
            // line 10
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("filed_statistics_sent_messages"            ,"chatbox"            ,            );
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
            echo "</p>
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "</div>
<div class=\"clearfix\"></div>
";
    }

    public function getTemplateName()
    {
        return "helper_counter_widget.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 14,  71 => 10,  48 => 9,  43 => 7,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_counter_widget.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\chatbox\\views\\gentelella\\helper_counter_widget.twig");
    }
}
