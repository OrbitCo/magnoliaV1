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

/* sitemap.twig */
class __TwigTemplate_e297a53e1782871083320713a870201c2899f4c1144db986fc7a96e1474e01cb extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "sitemap.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12\">
    <div class=\"sitemap\">
        <div class=\"page-header\">
            <h1>
                ";
        // line 7
        $module =         null;
        $helper =         'seo';
        $name =         'seo_tags';
        $params = array("header_text"        ,        );
        @ob_start();
        $ci = &get_instance();
        $ci->load->helper($helper, $module);
        if (empty($module)) {
        $module = str_replace('_helper', '', $helper);
        }
        if (function_exists(NS_MODULES . $module . '\\helpers\\' . $name)) {
        $result = call_user_func_array(NS_MODULES . $module . '\\helpers\\' . $name, $params);
        } elseif (function_exists($name)) {
        $result = call_user_func_array($name, $params);
        } else {
        $result = '';
        }
        $output_buffer = @ob_get_contents();
        @ob_end_clean();
        echo $output_buffer.$result;
        // line 8
        echo "            </h1>
        </div>
        ";
        // line 10
        $context["line"] = 1;
        // line 11
        echo "
        <div class=\"site-map-block row\">
            ";
        // line 13
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
            // line 14
            echo "                <div class=\"col-xs-12 col-sm-3 col-md-3\">
                    ";
            // line 15
            $this->loadTemplate("sitemap_level.twig", "sitemap.twig", 15)->display(twig_array_merge($context, ["list" => $context["item"]]));
            // line 16
            echo "                </div>
                ";
            // line 17
            if ((0 == $this->getAttribute($context["loop"], "index", []) % 4)) {
                // line 18
                echo "                </div><div class=\"site-map-block row\">
                ";
            }
            // line 20
            echo "
            ";
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
        // line 22
        echo "        </div>


    </div>
    <div class=\"clr\"></div>

    <script type=\"text/javascript\">
        function equalHeight(group) {
            tallest = 0;
            group.each(function() {
                thisHeight = \$(this).height();
                if(thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            group.height(tallest);
        }
    </script>
</div>

";
        // line 42
        $this->loadTemplate("@app/footer.twig", "sitemap.twig", 42)->display($context);
    }

    public function getTemplateName()
    {
        return "sitemap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 42,  116 => 22,  101 => 20,  97 => 18,  95 => 17,  92 => 16,  90 => 15,  87 => 14,  70 => 13,  66 => 11,  64 => 10,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "sitemap.twig", "/home/mliadov/public_html/application/modules/site_map/views/flatty/sitemap.twig");
    }
}
