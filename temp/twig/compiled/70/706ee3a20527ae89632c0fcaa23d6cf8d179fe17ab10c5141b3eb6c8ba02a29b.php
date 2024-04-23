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

/* helper_logo.twig */
class __TwigTemplate_7058716e64ca9328006dfff2f2b2e2082809e1cd264dcd8767f32e0dc9220cfe extends \Twig\Template
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
        if ($this->getAttribute(($context["data_logo"] ?? null), "text_logo", [])) {
            // line 2
            echo "    <h4 class=\"textlogo\" id=\"logo\">";
            echo $this->getAttribute(($context["data_logo"] ?? null), "text_logo", []);
            echo "</h4>
";
        } else {
            // line 4
            echo "    <img src=\"";
            echo ($context["site_root"] ?? null);
            echo $this->getAttribute(($context["data_logo"] ?? null), "path", []);
            echo "?";
            echo twig_random($this->env);
            echo "\" border=\"0\"
                    alt=\"";
            // line 5
            $module =             null;
            $helper =             'seo';
            $name =             'seo_tags_default';
            $params = array("header_text"            ,            );
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
                    width=\"";
            // line 6
            echo $this->getAttribute(($context["data_logo"] ?? null), "width", []);
            echo "\"
                    height=\"";
            // line 7
            echo $this->getAttribute(($context["data_logo"] ?? null), "height", []);
            echo "\" id=\"logo\">
";
        }
    }

    public function getTemplateName()
    {
        return "helper_logo.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 7,  69 => 6,  46 => 5,  38 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_logo.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_logo.twig");
    }
}
