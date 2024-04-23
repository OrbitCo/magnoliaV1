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

/* helper_breadcrumbs.twig */
class __TwigTemplate_1fd7617372bdbfcb36492f2fe5822078fbc3c6799e2a5ead1d57c924bc1f7c2c extends \Twig\Template
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
        ob_start(function () { return ''; });
        // line 2
        echo "<div class=\"breadcrumbs\">
    ";
        // line 4
        echo "    <a href=\"";
        echo ($context["site_url"] ?? null);
        echo "start/index/page\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_start_page"        ,"start"        ,        );
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
    ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 6
            echo "        &nbsp;<i class=\"fa fa-angle-right\"></i>&nbsp;
        ";
            // line 7
            if ($this->getAttribute($context["item"], "url", [])) {
                // line 8
                echo "        <a href=\"";
                echo $this->getAttribute($context["item"], "url", []);
                echo "\" id=\"breadcrumb_";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "\">
            ";
                // line 9
                echo $this->getAttribute($context["item"], "text", []);
                echo "
        </a>
        ";
            } else {
                // line 12
                echo "            ";
                echo $this->getAttribute($context["item"], "text", []);
                echo "
        ";
            }
            // line 14
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "helper_breadcrumbs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 15,  89 => 14,  83 => 12,  77 => 9,  70 => 8,  68 => 7,  65 => 6,  61 => 5,  35 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_breadcrumbs.twig", "/home/mliadov/public_html/application/modules/menu/views/flatty/helper_breadcrumbs.twig");
    }
}
