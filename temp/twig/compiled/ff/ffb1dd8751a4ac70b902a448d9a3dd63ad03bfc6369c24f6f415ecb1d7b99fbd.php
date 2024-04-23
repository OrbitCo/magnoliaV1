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

/* helper_currency_regexp.twig */
class __TwigTemplate_a8bb9dc302a4278f7dc93e9b0018111f73cefe5ef1c146ec0875ae49dfc5094d extends \Twig\Template
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
        echo "function(value) {
    return '";
        // line 2
        echo ($context["template"] ?? null);
        echo "'.replace(";
        echo twig_replace_filter(($context["pattern_value"] ?? null), ["^]" => "^\\]"]);
        echo "g, ";
        echo ($context["value"] ?? null);
        echo ");
}
";
    }

    public function getTemplateName()
    {
        return "helper_currency_regexp.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_currency_regexp.twig", "/home/mliadov/public_html/application/modules/payments/views/flatty/helper_currency_regexp.twig");
    }
}
