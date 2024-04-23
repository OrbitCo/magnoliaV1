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

/* helper_favicon.twig */
class __TwigTemplate_c6302a11d9cbc93782d7e2435cdc1c3b9e4920d1f572b6dfd379562767eceac7 extends \Twig\Template
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
        echo "<link rel=\"shortcut icon\" href=\"";
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/favicon.ico\">
<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        // line 2
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/apple-touch-icon.png\">
<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 3
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/favicon-32x32.png\">
<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 4
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/favicon-16x16.png\">
<link rel=\"manifest\" href=\"";
        // line 5
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/manifest.json\">
<link rel=\"mask-icon\" href=\"";
        // line 6
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/safari-pinned-tab.svg\" color=\"#5bbad5\">
<meta name=\"msapplication-config\" content=\"";
        // line 7
        echo ($context["site_root"] ?? null);
        echo ($context["img_folder"] ?? null);
        echo "favicon/browserconfig.xml\">
<meta name=\"theme-color\" content=\"#ffffff\">";
    }

    public function getTemplateName()
    {
        return "helper_favicon.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 7,  56 => 6,  51 => 5,  46 => 4,  41 => 3,  36 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_favicon.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\flatty\\helper_favicon.twig");
    }
}
