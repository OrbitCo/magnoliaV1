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

/* menu_modules_install.twig */
class __TwigTemplate_697f433d66e812299edc58ec26a51b05065c9a0b6b8dd82fc50bcdd8c34adc2a extends \Twig\Template
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
        if ((($context["auth_type"] ?? null) == "module")) {
            // line 2
            echo "<div class=\"menu_section\">
    <ul class=\"nav side-menu\">
        <li";
            // line 4
            if ((($context["step"] ?? null) == "modules")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 5
            echo ($context["site_url"] ?? null);
            echo "admin/install/modules\">Installed modules</a>
        </li>
        <li";
            // line 7
            if (((($context["step"] ?? null) == "enable_modules") || (($context["step"] ?? null) == "module_install"))) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 8
            echo ($context["site_url"] ?? null);
            echo "admin/install/enable_modules\">Enable modules";
            if ((($context["enabled"] ?? null) && (($context["step"] ?? null) != "enable_modules"))) {
                echo "<span class=\"num\">";
                echo ($context["enabled"] ?? null);
                echo "</span>";
            }
            echo "</a>
        </li>
        <li";
            // line 10
            if ((($context["step"] ?? null) == "updates")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 11
            echo ($context["site_url"] ?? null);
            echo "admin/install/updates\">Enable updates";
            if ((($context["updates"] ?? null) && (($context["step"] ?? null) != "updates"))) {
                echo "<span class=\"num\">";
                echo ($context["updates"] ?? null);
                echo "</span>";
            }
            echo "</a>
        </li>
        <li";
            // line 13
            if ((($context["step"] ?? null) == "product_updates")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 14
            echo ($context["site_url"] ?? null);
            echo "admin/install/product_updates\">Enable product updates";
            if ((($context["product_updates"] ?? null) && (($context["step"] ?? null) != "product_updates"))) {
                echo "<span class=\"num\">";
                echo ($context["product_updates"] ?? null);
                echo "</span>";
            }
            echo "</a>
        </li>
        <li";
            // line 16
            if ((($context["step"] ?? null) == "libraries")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 17
            echo ($context["site_url"] ?? null);
            echo "admin/install/libraries\">Installed libraries</a>
        </li>
        <li";
            // line 19
            if ((($context["step"] ?? null) == "enable_libraries")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 20
            echo ($context["site_url"] ?? null);
            echo "admin/install/enable_libraries\">Enable libraries";
            if ((($context["enabled_libraries"] ?? null) && (($context["step"] ?? null) != "enable_libraries"))) {
                echo "<span class=\"num\">";
                echo ($context["enabled_libraries"] ?? null);
                echo "</span>";
            }
            echo "</a>
        </li>
        <li";
            // line 22
            if ((($context["step"] ?? null) == "langs")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 23
            echo ($context["site_url"] ?? null);
            echo "admin/install/langs\">Languages</a>
        </li>
        <li";
            // line 25
            if ((($context["step"] ?? null) == "ftp")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 26
            echo ($context["site_url"] ?? null);
            echo "admin/install/installer_settings\">Panel settings</a>
        </li>
        <li";
            // line 28
            if ((($context["step"] ?? null) == "migrations")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 29
            echo ($context["site_url"] ?? null);
            echo "admin/install/migrations\">Migrations</a>
        </li>
        <li";
            // line 31
            if ((($context["step"] ?? null) == "generator")) {
                echo " class=\"active\"";
            }
            echo ">
            <a href=\"";
            // line 32
            echo ($context["site_url"] ?? null);
            echo "admin/install/generator\">Generator</a>
        </li>
    </ul>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "menu_modules_install.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  165 => 32,  159 => 31,  154 => 29,  148 => 28,  143 => 26,  137 => 25,  132 => 23,  126 => 22,  115 => 20,  109 => 19,  104 => 17,  98 => 16,  87 => 14,  81 => 13,  70 => 11,  64 => 10,  53 => 8,  47 => 7,  42 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "menu_modules_install.twig", "/home/mliadov/public_html/application/modules/install/views/gentelella/menu_modules_install.twig");
    }
}
