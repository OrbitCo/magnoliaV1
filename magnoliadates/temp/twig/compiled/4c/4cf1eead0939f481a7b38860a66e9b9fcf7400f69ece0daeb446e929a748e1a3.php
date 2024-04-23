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

/* helper_lang_select_summer.twig */
class __TwigTemplate_3cd602fa03a8e78600ebcaeb4832ddefac00185fcc781b0e3a8e8a32103c9a36 extends \Twig\Template
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
        echo "<a href=\"javascript:void(0);\" class=\"btn_tnl\" id=\"current_language\">
    ";
        // line 2
        echo $this->getAttribute($this->getAttribute(($context["languages"] ?? null), ($context["current_lang"] ?? null), [], "array"), "name", []);
        echo "
</a>
";
    }

    public function getTemplateName()
    {
        return "helper_lang_select_summer.twig";
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
        return new Source("", "helper_lang_select_summer.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/helper_lang_select_summer.twig");
    }
}
