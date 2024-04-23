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

/* helper_winks_left.twig */
class __TwigTemplate_ab0f256b30bb3cd2a62c9dc872cb90999c17f24473a667ed9c43567571b717ec extends \Twig\Template
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
        if ((($context["winks_count"] ?? null) > 0)) {
            // line 2
            echo "    <span class=\"badge summand winks_count fright\">
    ";
            // line 3
            echo ($context["winks_count"] ?? null);
            echo "
</span>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_winks_left.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_winks_left.twig", "/home/mliadov/public_html/application/modules/winks/views/flatty/helper_winks_left.twig");
    }
}
