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

/* picture.twig */
class __TwigTemplate_69e4e18063e008f6e0bba5df4d572ecb2dc89e88915a9116e77a8f82d665c9d4 extends \Twig\Template
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
        $context["rand"] = twig_random($this->env, 111111, 999999);
        // line 2
        echo "<img 
    src=\"";
        // line 3
        echo ($context["site_url"] ?? null);
        echo "uploads/default/";
        echo $this->getAttribute(($context["picture_params"] ?? null), "size_name", []);
        echo "-default-gallery-image.png\" 
    data-src=\"";
        // line 4
        echo $this->getAttribute(($context["picture_params"] ?? null), "src", []);
        echo "?";
        echo ($context["rand"] ?? null);
        echo "\" alt=\"";
        echo $this->getAttribute(($context["picture_params"] ?? null), "alt", []);
        echo "\" 
    title=\"";
        // line 5
        echo $this->getAttribute(($context["picture_params"] ?? null), "title", []);
        echo "\" 
    class=\"";
        // line 6
        if ($this->getAttribute(($context["picture_params"] ?? null), "class", [])) {
            echo $this->getAttribute(($context["picture_params"] ?? null), "class", []);
            echo " img-responsive";
        }
        echo " lazyload lazy-";
        echo $this->getAttribute(($context["picture_params"] ?? null), "size_name", []);
        echo "\" 
    data-size=\"";
        // line 7
        echo $this->getAttribute(($context["picture_params"] ?? null), "size_name", []);
        echo "\"/>";
    }

    public function getTemplateName()
    {
        return "picture.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 7,  53 => 6,  49 => 5,  41 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "picture.twig", "/home/mliadov/public_html/application/modules/media/views/flatty/picture.twig");
    }
}
