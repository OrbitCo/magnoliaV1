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

/* helper_delete_select_block.twig */
class __TwigTemplate_da5f98ecbf11925b16364300e2c8e12a91f918e90d09d93ed1d9f8de7db9981b extends \Twig\Template
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
        echo "<a title=\"";
        echo $this->getAttribute(($context["params"] ?? null), "title_text", []);
        echo "\" id=\"delete_select_block_";
        echo $this->getAttribute(($context["params"] ?? null), "id_user", []);
        echo "\" class=\"";
        echo $this->getAttribute(($context["params"] ?? null), "class", []);
        echo "\"
   href=\"";
        // line 2
        echo ($context["site_url"] ?? null);
        echo "admin/users/ajax_delete_select/";
        echo $this->getAttribute(($context["params"] ?? null), "id_user", []);
        echo "/";
        echo $this->getAttribute(($context["params"] ?? null), "deleted", []);
        echo "\">
    ";
        // line 3
        echo $this->getAttribute(($context["params"] ?? null), "title_text", []);
        echo "
</a>

<script type=\"text/javascript\">
    \$(function(){
        \$('#delete_select_block_";
        // line 8
        echo $this->getAttribute(($context["params"] ?? null), "id_user", []);
        echo "').unbind('click').click(function(){
            \$.ajax({
                url: site_url + 'admin/users/ajax_delete_select/";
        // line 10
        echo $this->getAttribute(($context["params"] ?? null), "id_user", []);
        echo "/";
        echo $this->getAttribute(($context["params"] ?? null), "deleted", []);
        echo "',
                cache: false,
                dataType: 'json',
                success: function(data){
                    if (typeof (data.error) !== 'undefined' && data.error.length > 0) {
                        error_object.show_error_block(data.error, 'error');
                    } else {
                        delete_select_block.show_load_block(data.content);
                    }
                }
            });
            return false;
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_delete_select_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 10,  55 => 8,  47 => 3,  39 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_delete_select_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\gentelella\\helper_delete_select_block.twig");
    }
}
