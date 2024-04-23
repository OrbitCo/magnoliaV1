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

/* @app/preloader.twig */
class __TwigTemplate_fe6fca4cc89e592704e282716a0dfb79ff2d71e7e4632004960751db7e029f1f extends \Twig\Template
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
        echo "<style>
    .page_overflow {
        overflow: hidden
    }
    .preloader_page {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 1);
        z-index: 100000;
    }
    .preloader_page.page_loaded {
        display: none;
    }
    .preloader_page .indicator-logo {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        30% {
            transform: scale(1.25);
        }
        40% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }
</style>
<div class=\"preloader_page\">
    <svg id=\"Layer_1\" class=\"indicator-logo\" xmlns=\"http://www.w3.org/2000/svg\"
         xmlns:xlink=\"http://www.w3.org/1999/xlink\" xml:space=\"preserve\" version=\"1.1\" x=\"0px\" y=\"0px\" width=\"80px\"
         height=\"80px\" viewBox=\"0 0 800 800\" enable-background=\"new 0 0 800 800\">
                <g>
                    <animateTransform attributeName=\"transform\" type=\"scale\" repeatCount=\"indefinite\" begin=\"0s\"
                                      dur=\"0.8s\" values=\"1; 1.2; 1; 1\" keyTimes=\"0; 0.1; 0.6; 1\"/>
                    <g>
                        <animateTransform attributeName=\"transform\" type=\"translate\" repeatCount=\"indefinite\" begin=\"0s\"
                                          dur=\"0.8s\" values=\"70 70; 0 0; 70 70; 70 70\" keyTimes=\"0; 0.1; 0.6; 1\"/>
                        <path fill=\"#F06078\"
                              d=\"M475.648,2.081c-52.68,0-103.021,22.231-136.405,55.615c-2.162,2.159-5.972,6.415-5.972,6.415 s-3.273-2.758-7.25-6.73C291.177,22.536,241.996,2.297,191.514,2.297c-46.279,0-93.654,17.022-132.035,55.403 c-80.255,80.251-66.556,200.905-0.345,267.112c66.211,66.215,274.107,274.085,274.107,274.085s211.262-211.572,273.395-273.713 c62.133-62.133,85.343-182.248,0-267.594C567.326,18.283,520.634,2.077,475.648,2.081\"/>
                    </g>
                </g>
            </svg>
</div>
<script>
    \$(function() {
        \$('.preloader_page').addClass('page_loaded');
        \$('body').removeClass('page_overflow');
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "@app/preloader.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@app/preloader.twig", "/home/mliadov/public_html/application/views/flatty/preloader.twig");
    }
}
