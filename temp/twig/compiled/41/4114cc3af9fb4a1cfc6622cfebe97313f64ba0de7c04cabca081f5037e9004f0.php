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

/* modules_enabled.twig */
class __TwigTemplate_081470be478f1c416d8a5d666a83eee797372a166b75234a21ec538cfddbcfe7 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "modules_enabled.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
            <table id=\"users\" class=\"table table-striped responsive-utilities jambo_table\">
                <thead>
                    <tr class=\"headings\">
                        <th class=\"column-title\">Module</th>
                        <th class=\"column-title\">Description</th>
                        <th class=\"column-title\">Version</th>
                        <th class=\"column-title\">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modules"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 17
            echo "                    <tr>
                        <td><b>";
            // line 18
            echo $this->getAttribute($context["item"], "module", []);
            echo "</b></td>
                        <td><b>";
            // line 19
            echo $this->getAttribute($context["item"], "install_name", []);
            echo "</b><br>";
            echo $this->getAttribute($context["item"], "install_descr", []);
            echo "</td>
                        <td class=\"text-center\">";
            // line 20
            echo $this->getAttribute($context["item"], "version", []);
            echo "</td>
                        <td class=\"icons\">
                          <div class=\"btn-group\">
                            <a class=\"btn btn-primary\" href=\"";
            // line 23
            echo ($context["site_url"] ?? null);
            echo "admin/install/module_install/";
            echo $this->getAttribute($context["item"], "module", []);
            echo "\">
                                Install</a>
                            <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                    aria-haspopup=\"true\" aria-expanded=\"false\">
                              <span class=\"caret\"></span>
                              <span class=\"sr-only\">Toggle Dropdown</span>
                            </button>
                            <ul class=\"dropdown-menu\">
                              <li>
                                <a href=\"";
            // line 32
            echo ($context["site_url"] ?? null);
            echo "admin/install/module_install/";
            echo $this->getAttribute($context["item"], "module", []);
            echo "\">Install</a>
                              </li>
                            </ul>
                          </div>
                        </td>
                    </tr>
                </tbody>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "            </table>
        </div>
    </div>
</div>

";
        // line 45
        $this->loadTemplate("@app/footer.twig", "modules_enabled.twig", 45)->display($context);
    }

    public function getTemplateName()
    {
        return "modules_enabled.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 45,  101 => 40,  85 => 32,  71 => 23,  65 => 20,  59 => 19,  55 => 18,  52 => 17,  48 => 16,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules_enabled.twig", "/home/mliadov/public_html/application/modules/install/views/gentelella/modules_enabled.twig");
    }
}
