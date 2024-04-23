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

/* menu_list.twig */
class __TwigTemplate_19194e2873812ab9aa46ec5306e81dccb7e12d7b49e63d9ddc9a7a12d8ce9073 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "menu_list.twig", 1)->display($context);
        // line 2
        echo "<div class=\"menu-list\">
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 4
            echo "    <div id=\"";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "_block\" class=\"settings-block";
            if ($this->getAttribute($context["item"], "gid", [])) {
                echo " with-";
                echo $this->getAttribute($context["item"], "gid", []);
            }
            echo "\" onclick=\"";
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("menu_list"            ,$this->getAttribute(($context["item"] ?? null), "gid", [])            ,            );
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
            echo "javascript: location.href='";
            echo $this->getAttribute($context["item"], "link", []);
            echo "';\">
        <a id=\"";
            // line 5
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" href=\"";
            echo $this->getAttribute($context["item"], "link", []);
            echo "\">
            <h6>";
            // line 6
            echo $this->getAttribute($context["item"], "value", []);
            echo "</h6>
        </a>
        <div>
            ";
            // line 9
            echo $this->getAttribute($context["item"], "tooltip", []);
            echo "
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "</div>
<div class=\"clearfix\"></div>
";
        // line 15
        $module =         null;
        $helper =         'start';
        $name =         'marketplace';
        $params = array(["gid" => $this->getAttribute(($context["menu"] ?? null), "gid", [])]        ,        );
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
        // line 16
        $this->loadTemplate("@app/footer.twig", "menu_list.twig", 16)->display($context);
    }

    public function getTemplateName()
    {
        return "menu_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 16,  98 => 15,  94 => 13,  84 => 9,  78 => 6,  72 => 5,  39 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "menu_list.twig", "/home/mliadov/public_html/application/modules/start/views/gentelella/menu_list.twig");
    }
}
