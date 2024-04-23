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

/* helper_sorter.twig */
class __TwigTemplate_25838ca54e23faa20ba78093873acbec0f8275471aaacfa4879ed26530609f45 extends \Twig\Template
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
        echo "<div class=\"form-inline\">
<select id=\"sorter-select-";
        // line 2
        echo ($context["sort_rand"] ?? null);
        echo "\" class=\"form-control\">
\t";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sort_links"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 4
            echo "\t\t<option value=\"";
            echo $context["key"];
            echo "\" ";
            if (($context["key"] == ($context["sort_order"] ?? null))) {
                echo "selected";
            }
            echo ">
            ";
            // line 5
            echo $context["item"];
            echo "
        </option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</select>
<i id=\"sorter-dir-";
        // line 9
        echo ($context["sort_rand"] ?? null);
        echo "\" data-role=\"sorter-dir\" class=\"fa fa-arrow-";
        if ((($context["sort_direction"] ?? null) == "ASC")) {
            echo "up";
        } else {
            echo "down";
        }
        echo " gray\"></i>
<a href=\"";
        // line 10
        echo ($context["sort_url"] ?? null);
        echo "\" id=\"sorter-link-";
        echo ($context["sort_rand"] ?? null);
        echo "\" class=\"hide\">Go!</a>
<script>
\t\$('#sorter-select-";
        // line 12
        echo ($context["sort_rand"] ?? null);
        echo "').unbind('change').on('change', function(){
\t\tvar url = \$('#sorter-link-";
        // line 13
        echo ($context["sort_rand"] ?? null);
        echo "').attr('href') + '/' + \$(this).find('option:selected').val() + '/";
        if ((($context["sort_direction"] ?? null) == "ASC")) {
            echo "DESC";
        } else {
            echo "ASC";
        }
        echo "';
\t\t\$('#sorter-link-";
        // line 14
        echo ($context["sort_rand"] ?? null);
        echo "').attr('href', url).trigger('click');
\t});
\t\$('#sorter-dir-";
        // line 16
        echo ($context["sort_rand"] ?? null);
        echo "').unbind('click').on('click', function(){
\t\tvar url = \$('#sorter-link-";
        // line 17
        echo ($context["sort_rand"] ?? null);
        echo "').attr('href') + '/' +
                  \$('#sorter-select-";
        // line 18
        echo ($context["sort_rand"] ?? null);
        echo " option:selected').val() + '/' +
                  '";
        // line 19
        if ((($context["sort_direction"] ?? null) == "ASC")) {
            echo "DESC";
        } else {
            echo "ASC";
        }
        echo "';
\t\t\$('#sorter-link-";
        // line 20
        echo ($context["sort_rand"] ?? null);
        echo "').attr('href', url).trigger('click');
\t});
</script>
</div>
";
    }

    public function getTemplateName()
    {
        return "helper_sorter.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 20,  110 => 19,  106 => 18,  102 => 17,  98 => 16,  93 => 14,  83 => 13,  79 => 12,  72 => 10,  62 => 9,  59 => 8,  50 => 5,  41 => 4,  37 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_sorter.twig", "/home/mliadov/public_html/application/modules/start/views/flatty/helper_sorter.twig");
    }
}
