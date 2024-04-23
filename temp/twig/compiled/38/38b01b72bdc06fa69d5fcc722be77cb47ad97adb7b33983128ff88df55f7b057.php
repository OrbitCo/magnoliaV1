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

/* list.twig */
class __TwigTemplate_d74261389343f99ce63edc9028a3532fb47b0a1cca58cb27add2d3df99b625da extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"content-module-block\">
    <div class=\"col-md-3\">
        <h1>
            ";
        // line 6
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
        // line 7
        echo "        </h1>
        <ul class=\"nav nav-pills nav-stacked content-pages-tree\">
            ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pages"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 10
            echo "                <li>
                    <div class=\"info-menu-inner\">
                        <a href=\"";
            // line 12
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("content"            ,"view"            ,($context["item"] ?? null)            ,            );
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
            echo "\">
                            <div class=\"clearfix\">
                                <div class=\"fleft\">";
            // line 14
            echo $this->getAttribute($context["item"], "title", []);
            echo "</div>
                                ";
            // line 15
            if ($this->getAttribute($context["item"], "sub", [])) {
                // line 16
                echo "                                    <div class=\"fright menu-arrow\"><i class=\"fa fa-angle-right\"></i></div>
                                    ";
            }
            // line 18
            echo "                            </div>
                        </a>
                    </div>
                </li>
                ";
            // line 22
            if ($this->getAttribute($context["item"], "sub", [])) {
                // line 23
                echo "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "sub", []));
                foreach ($context['_seq'] as $context["k"] => $context["i"]) {
                    // line 24
                    echo "                        <li  class=\"leaves ";
                    if ($this->getAttribute($context["i"], "active", [])) {
                        echo "active";
                    }
                    echo "\">
                            <div class=\"info-menu-inner\">
                                <a href=\"";
                    // line 26
                    $module =                     null;
                    $helper =                     'seo';
                    $name =                     'seolink';
                    $params = array("content"                    ,"view"                    ,($context["i"] ?? null)                    ,                    );
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
                    echo "\">
                                    <div class=\"clearfix\">
                                        <div class=\"fleft\">";
                    // line 28
                    echo $this->getAttribute($context["i"], "title", []);
                    echo "</div>
                                        ";
                    // line 29
                    if ($this->getAttribute($context["i"], "sub", [])) {
                        // line 30
                        echo "                                            <div class=\"fright menu-arrow\"><i class=\"fa fa-angle-right\"></i></div>
                                            ";
                    }
                    // line 32
                    echo "                                    </div>
                                </a>
                            </div>
                        </li>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                echo "                ";
            }
            // line 38
            echo "            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 39
            echo "                <div class=\"empty\">
                    ";
            // line 40
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("no_content_yet_header"            ,"content"            ,            );
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
            // line 41
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "        </ul>
    </div>
    <div class=\"clr\"></div>
</div>
";
        // line 47
        $this->loadTemplate("@app/footer.twig", "list.twig", 47)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 47,  210 => 43,  203 => 41,  182 => 40,  179 => 39,  174 => 38,  171 => 37,  161 => 32,  157 => 30,  155 => 29,  151 => 28,  127 => 26,  119 => 24,  114 => 23,  112 => 22,  106 => 18,  102 => 16,  100 => 15,  96 => 14,  72 => 12,  68 => 10,  63 => 9,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/content/views/flatty/list.twig");
    }
}
