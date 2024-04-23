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

/* custom/helper_index_users.twig */
class __TwigTemplate_9ed40ba16042aacda2cd52562eb4317f931f4734c63e5ab523a5cba33a93e037 extends \Twig\Template
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
        echo "<div class=\"c-index-users\">
    <div class=\"c-profiles\">
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["h_data"] ?? null), "users", []));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 4
            echo "            <div class=\"c-profiles__item\">
                <div class=\"c-profiles__item_image\" title=\"";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "output_name", []));
            echo "\">
                    <a href=\"";
            // line 6
            echo $this->getAttribute($context["user"], "link", []);
            echo "\">
                        <img src=\"";
            // line 7
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["user"], "media", []), "user_logo", []), "thumbs", []), "great", []);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "output_name", []));
            echo "\" class=\"img-responsive\">
                    </a>
                </div>
                <div class=\"c-profiles__item_caption\">
                    <div class=\"c-profiles__item_name\">
                        <a href=\"";
            // line 12
            echo $this->getAttribute($context["user"], "link", []);
            echo "\">";
            echo $this->getAttribute($context["user"], "output_name", []);
            echo "</a>";
            if ($this->getAttribute($context["user"], "age", [])) {
                echo ", ";
                echo $this->getAttribute($context["user"], "age", []);
            }
            // line 13
            echo "                    </div>
                    <div class=\"c-profiles__item_location\" title=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["user"], "location", []));
            echo "\">
                        ";
            // line 15
            echo $this->getAttribute($context["user"], "city", []);
            echo "
                    </div>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "custom/helper_index_users.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 20,  75 => 15,  71 => 14,  68 => 13,  59 => 12,  49 => 7,  45 => 6,  41 => 5,  38 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom/helper_index_users.twig", "/home/mliadov/public_html/application/modules/users/views/flatty/custom/helper_index_users.twig");
    }
}
