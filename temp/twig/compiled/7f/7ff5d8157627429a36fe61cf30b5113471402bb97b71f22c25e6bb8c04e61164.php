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

/* helper_sitemap.twig */
class __TwigTemplate_31ceee2ba54a02b3d9d4a0ad3293a2b49eaa10582694f943b6f4efcb68d7d807 extends \Twig\Template
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
        echo "<script>
\tfunction equalHeight(group) {
\t\ttallest = 0;
\t\tgroup.each(function() {
\t\t\tthisHeight = \$(this).height();
\t\t\tif(thisHeight > tallest) {
\t\t\t\ttallest = thisHeight;
\t\t\t}
\t\t});
\t\tgroup.height(tallest);
\t}
</script>
<div class=\"sitemap\">
\t";
        // line 14
        $context["line"] = 1;
        // line 15
        echo "
\t<div class=\"site-map-block row\">
\t\t";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["blocks"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 18
            echo "\t\t\t<script>
\t\t\t\t\$(function(){
\t\t\t\t\tequalHeight(\$(\".line";
            // line 20
            echo ($context["line"] ?? null);
            echo "\"));
\t\t\t\t});
\t\t\t</script>

\t\t\t<div class=\"col-sm-3  col-md-3\">
\t            ";
            // line 25
            $this->loadTemplate("sitemap_level.twig", "helper_sitemap.twig", 25)->display(twig_array_merge($context, ["list" => $context["item"]]));
            // line 26
            echo "\t        </div>

\t        ";
            // line 28
            if ((0 == $this->getAttribute($context["loop"], "index", []) % 4)) {
                // line 29
                echo "\t        </div><div class=\"site-map-block row\">
\t        ";
            }
            // line 31
            echo "
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "\t</div>
</div>
<div class=\"clr\"></div>
";
    }

    public function getTemplateName()
    {
        return "helper_sitemap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 33,  92 => 31,  88 => 29,  86 => 28,  82 => 26,  80 => 25,  72 => 20,  68 => 18,  51 => 17,  47 => 15,  45 => 14,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_sitemap.twig", "/home/mliadov/public_html/application/modules/site_map/views/flatty/helper_sitemap.twig");
    }
}
