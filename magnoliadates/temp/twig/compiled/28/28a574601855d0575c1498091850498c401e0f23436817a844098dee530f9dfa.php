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

/* helper_top_menu.twig */
class __TwigTemplate_a22e2968313dbd57cd3b70867391fdf24468d6ac8dac6d9d56f1ec9f7debda0f extends \Twig\Template
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
        if (($context["menu"] ?? null)) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["menu"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["menu_item"]) {
                echo " 
        <div class=\"menu-alerts-item menu-item\" id=\"menu_";
                // line 3
                echo $this->getAttribute($context["menu_item"], "gid", []);
                echo "_alerts\" data-action=\"event_menu\" data-gid=\"";
                echo $this->getAttribute($context["menu_item"], "gid", []);
                echo "\">
        ";
                // line 4
                if ($this->getAttribute($context["menu_item"], "sub", [])) {
                    echo "     
            <div id=\"menu-";
                    // line 5
                    echo $this->getAttribute($context["menu_item"], "gid", []);
                    echo "-more\" class=\"top-menu-item-list\"
               data-toggle=\"dropdown\" aria-haspopup=\"true\" role=\"button\"
               aria-expanded=\"false\" data-pjax=\"0\">
                ";
                    // line 8
                    echo $this->getAttribute($context["menu_item"], "value", []);
                    echo "
                <span class=\"caret\"></span>
                <span class=\"badge sum\"></span>
            </div>
            <div class=\"menu-";
                    // line 12
                    echo $this->getAttribute($context["menu_item"], "gid", []);
                    echo "-more dropdown-menu\" role=\"menu\">
                <div class=\"menu-alerts-more-triangle\"></div>
                ";
                    // line 14
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["menu_item"], "sub", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 15
                        echo "                    <div class=\"menu-alerts-more-item clearfix\">
                        ";
                        // line 16
                        $module =                         null;
                        $helper =                         'menu';
                        $name =                         'getMenuItem';
                        $params = array($this->getAttribute(($context["item"] ?? null), "gid", [])                        ,(($context["template"] ?? null) . "_item")                        ,                        );
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
                        // line 17
                        echo "                    </div> 
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 19
                    echo "            </div>
        ";
                } else {
                    // line 21
                    echo "            <div class=\"menu-alerts-item menu-item top-menu-item-list no-notifications\">
                ";
                    // line 22
                    $module =                     null;
                    $helper =                     'menu';
                    $name =                     'getMenuItem';
                    $params = array($this->getAttribute(($context["menu_item"] ?? null), "gid", [])                    ,(($context["template"] ?? null) . "_item")                    ,                    );
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
                    // line 23
                    echo "            </div>
        ";
                }
                // line 24
                echo " 
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "helper_top_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 24,  130 => 23,  109 => 22,  106 => 21,  102 => 19,  95 => 17,  74 => 16,  71 => 15,  67 => 14,  62 => 12,  55 => 8,  49 => 5,  45 => 4,  39 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_top_menu.twig", "/home/mliadov/public_html/application/modules/menu/views/flatty/helper_top_menu.twig");
    }
}
