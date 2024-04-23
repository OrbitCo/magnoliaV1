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

/* tree.twig */
class __TwigTemplate_c7e85c7deabdd8ba92c8de95cbf89b4a40a4408523419d4cd8d1d6da2a85730f extends \Twig\Template
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
        echo "<ul class=\"nav nav-pills nav-stacked content-pages-tree\">
    ";
        // line 2
        if (($this->getAttribute(($context["page"] ?? null), "parent_id", []) != "0")) {
            // line 3
            echo "        <li class=\"back\">
            <div class=\"info-menu-inner\">
                <a href=\"";
            // line 5
            $module =             null;
            $helper =             'seo';
            $name =             'seolink';
            $params = array("content"            ,"view"            ,$this->getAttribute(($context["parent"] ?? null), "gid", [])            ,            );
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
                    &larr;&nbsp;Back
                </a>
            </div>
        </li>
    ";
        }
        // line 11
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currents"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 12
            echo "        <li ";
            if (($this->getAttribute($context["item"], "id", []) == $this->getAttribute(($context["page"] ?? null), "id", []))) {
                echo "class=\"active\"";
            }
            echo ">
            <div class=\"info-menu-inner\">
                <a href=\"";
            // line 14
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
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "title", []));
            echo "\">
                    <div class=\"clearfix\">
                        <div class=\"fleft  wp100\">
                            <div class=\"menu-item clearfix\">";
            // line 17
            echo $this->getAttribute($context["item"], "title", []);
            echo "</div>
                        </div>
                        ";
            // line 19
            if ($this->getAttribute($context["item"], "sub", [])) {
                // line 20
                echo "                            <div class=\"fright menu-arrow\"><i class=\"fa fa-angle-right\"></i></div>
                        ";
            }
            // line 22
            echo "                    </div>
                </a>
            </div>
        </li>
        ";
            // line 26
            if ($this->getAttribute($context["item"], "sub", [])) {
                // line 27
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "sub", []));
                foreach ($context['_seq'] as $context["k"] => $context["i"]) {
                    // line 28
                    echo "                <li  class=\"leaves ";
                    if ($this->getAttribute($context["i"], "active", [])) {
                        echo "active";
                    }
                    echo "\">
                    <div class=\"info-menu-inner\">
                        <a href=\"";
                    // line 30
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
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["i"], "title", []));
                    echo "\">
                            <div class=\"clearfix\">
                                <div class=\"fleft wp100\">
                                    <div class=\"menu-item\">";
                    // line 33
                    echo $this->getAttribute($context["i"], "title", []);
                    echo "</div>
                                </div>
                                ";
                    // line 35
                    if ($this->getAttribute($context["i"], "sub", [])) {
                        // line 36
                        echo "                                    <div class=\"fright menu-arrow\"><i class=\"fa fa-angle-right\"></i></div>
                                ";
                    }
                    // line 38
                    echo "                            </div>
                        </a>
                    </div>
                </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['k'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 43
                echo "        ";
            }
            // line 44
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "tree.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 45,  190 => 44,  187 => 43,  177 => 38,  173 => 36,  171 => 35,  166 => 33,  139 => 30,  131 => 28,  126 => 27,  124 => 26,  118 => 22,  114 => 20,  112 => 19,  107 => 17,  80 => 14,  72 => 12,  67 => 11,  39 => 5,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "tree.twig", "/home/mliadov/public_html/application/modules/content/views/flatty/tree.twig");
    }
}
