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

/* helper_new_kisses_left.twig */
class __TwigTemplate_0d9504266193a6c4c697e115c48ef5f0e0bf6906a77c00a37f4c02ad1be28c0d extends \Twig\Template
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
        if ((($context["kisses_count"] ?? null) > 0)) {
            // line 2
            echo "<span class=\"badge summand fright kisses_count\">
    ";
            // line 3
            echo ($context["kisses_count"] ?? null);
            echo "
</span>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_new_kisses_left.twig";
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
        return new Source("", "helper_new_kisses_left.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\kisses\\views\\flatty\\helper_new_kisses_left.twig");
    }
}
