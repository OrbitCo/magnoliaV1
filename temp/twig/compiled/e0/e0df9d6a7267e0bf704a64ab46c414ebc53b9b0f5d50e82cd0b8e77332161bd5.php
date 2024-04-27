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

/* menu_settings.twig */
class __TwigTemplate_01c1b282bf60e7cf6183fd1c4771d664806430e16ca990f3bae7230ed4cd7253 extends \Twig\Template
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
        echo "<ul class=\"nav nav-pills nav-stacked content-pages-tree\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu_settings"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 3
            echo "        <li ";
            if (($context["key"] == $this->getAttribute(($context["page"] ?? null), "gid", []))) {
                echo "class=\"active\"";
            }
            echo ">
            <div class=\"info-menu-inner\">
                <a href=\"";
            // line 5
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("users"            ,"settings"            ,($context["key"] ?? null)            ,            );
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
            echo "\">
                    <div class=\"clearfix\">
                        <div class=\"fleft\">";
            // line 7
            echo $context["item"];
            echo "</div>
                        ";
            // line 8
            if ($this->getAttribute(($context["menu_settings_alert"] ?? null), $context["key"], [], "array")) {
                // line 9
                echo "                            <span class=\"badge pull-right\">";
                echo $this->getAttribute(($context["menu_settings_alert"] ?? null), $context["key"], [], "array");
                echo "</span>
                        ";
            }
            // line 11
            echo "                    </div>
                </a>
            </div>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "menu_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 16,  81 => 11,  75 => 9,  73 => 8,  69 => 7,  45 => 5,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "menu_settings.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\flatty\\menu_settings.twig");
    }
}
