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

/* additional_menu.twig */
class __TwigTemplate_9e04891b14fb17d521fd870c0ac4a1563bfa241681a501f79c2f5b1fb228c79e extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["types"] ?? null));
        foreach ($context['_seq'] as $context["gid"] => $context["name"]) {
            // line 2
            echo "    <li ";
            if ((($context["user_type"] ?? null) == $context["gid"])) {
                echo "class=\"active\"";
            }
            echo ">
        <a id=\"";
            // line 3
            echo $context["gid"];
            echo "\" href=\"";
            echo ($context["site_url"] ?? null);
            echo "admin/access_permissions/userTypes/";
            echo $context["gid"];
            echo "/\">";
            echo $context["name"];
            echo " </a>
    </li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['gid'], $context['name'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "additional_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "additional_menu.twig", "/home/mliadov/public_html/application/modules/access_permissions/views/gentelella/additional_menu.twig");
    }
}
