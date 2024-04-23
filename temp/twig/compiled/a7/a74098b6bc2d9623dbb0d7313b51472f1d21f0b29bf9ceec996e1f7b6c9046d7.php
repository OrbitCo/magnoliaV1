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

/* helper_button.twig */
class __TwigTemplate_75e8025ffe7d9d32923603aefe50dab80ce3ad18723e955efd65fdc206ae45b0 extends \Twig\Template
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
        if ((($context["template"] ?? null) == "popup")) {
            // line 2
            echo "    <span class=\"like_block";
            echo ($context["likes_helper_block_class"] ?? null);
            echo "\"
          title=\"[";
            // line 3
            echo ($context["likes_helper_gid"] ?? null);
            echo "_title]\" data-gid=\"";
            echo ($context["likes_helper_gid"] ?? null);
            echo "\"
          data-action=\"[";
            // line 4
            echo ($context["likes_helper_gid"] ?? null);
            echo "_action]\">
            <span id=\"like_btn_";
            // line 5
            echo ($context["likes_helper_gid"] ?? null);
            echo "\" href=\"javascript:void(0)\" class=\"like_btn [";
            echo ($context["likes_helper_gid"] ?? null);
            echo "_class] ";
            echo ($context["likes_helper_btn_class"] ?? null);
            echo " fa-lg\"></span>
            <span class=\"like_num";
            // line 6
            echo ($context["likes_helper_num_class"] ?? null);
            echo "\">[";
            echo ($context["likes_helper_gid"] ?? null);
            echo "]</span>
    </span>
";
        } else {
            // line 9
            echo "    <span class=\"like-btn-block like_block";
            echo ($context["likes_helper_block_class"] ?? null);
            echo "\"
          title=\"[";
            // line 10
            echo ($context["likes_helper_gid"] ?? null);
            echo "_title]\" data-gid=\"";
            echo ($context["likes_helper_gid"] ?? null);
            echo "\"
          data-action=\"[";
            // line 11
            echo ($context["likes_helper_gid"] ?? null);
            echo "_action]\">
            <span id=\"like_btn_";
            // line 12
            echo ($context["likes_helper_gid"] ?? null);
            echo "\" href=\"javascript:void(0)\" class=\"like_btn [";
            echo ($context["likes_helper_gid"] ?? null);
            echo "_class] ";
            echo ($context["likes_helper_btn_class"] ?? null);
            echo "\"></span>
            <span class=\"like_num";
            // line 13
            echo ($context["likes_helper_num_class"] ?? null);
            echo "\">[";
            echo ($context["likes_helper_gid"] ?? null);
            echo "]</span>
    </span>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 13,  78 => 12,  74 => 11,  68 => 10,  63 => 9,  55 => 6,  47 => 5,  43 => 4,  37 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_button.twig", "/home/mliadov/public_html/application/modules/likes/views/flatty/helper_button.twig");
    }
}
