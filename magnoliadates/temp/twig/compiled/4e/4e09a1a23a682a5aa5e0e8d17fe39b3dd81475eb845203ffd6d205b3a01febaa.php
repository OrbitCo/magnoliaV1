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

/* module_block_module_finish.twig */
class __TwigTemplate_e92e937589c4ee53225b34463c7167bebb1ae0f240bc5521c7314ecd7b017249 extends \Twig\Template
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
        echo "    <h4>The module is successfully installed! </h4>
    <div>
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 4
            echo "    <b>";
            echo $context["item"];
            echo "</b><br><br>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "    </div>
    <div class=\"ln_solid\"></div>
    <div class=\"form-group\">
      <div class-\"col-xs-12\">
        <a href=\"";
        // line 10
        echo ($context["site_url"] ?? null);
        echo "admin/install/enable_modules\"
          name=\"finish_install\" class=\"btn btn-success\">Finish</a>
      </div>
    </div>
<script>
\$(function(){
    product_install.update_overall_progress(";
        // line 16
        echo ($context["current_overall_percent"] ?? null);
        echo ");
});
</script>

<script>
    \$(function() {
        if (parent) {
            try {
                parent.postMessage(JSON.stringify({\"progress\": \"installed\"}), \"*\");
            } catch(e) {
                
            }
        }
\t});
</script>
";
    }

    public function getTemplateName()
    {
        return "module_block_module_finish.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 16,  53 => 10,  47 => 6,  38 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "module_block_module_finish.twig", "/home/mliadov/public_html/application/modules/install/views/gentelella/module_block_module_finish.twig");
    }
}
