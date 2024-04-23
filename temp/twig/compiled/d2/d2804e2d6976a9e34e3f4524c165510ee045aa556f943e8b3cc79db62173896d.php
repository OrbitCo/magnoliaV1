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

/* main_menu.twig */
class __TwigTemplate_432198809cfb78df98fecb519493e2c4583855f3dc067bdc7246dc2d12d23ff0 extends \Twig\Template
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
        if ((($context["auth_type"] ?? null) == "admin")) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["menu"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["level1"]) {
                // line 3
                echo "        ";
                if ($this->getAttribute($context["level1"], "sub", [])) {
                    // line 4
                    echo "            <div class=\"menu_section\">
                <ul class=\"nav side-menu\">
                    ";
                    // line 6
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["level1"], "sub", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["level2"]) {
                        // line 7
                        echo "                    <li ";
                        if (($this->getAttribute($context["level2"], "active", []) == 1)) {
                            echo " class=\"current-page\"";
                        }
                        echo ">
                        <a href=\"";
                        // line 8
                        echo $this->getAttribute($context["level2"], "link", []);
                        echo "\" onclick=\"";
                        $module =                         null;
                        $helper =                         'start';
                        $name =                         'setAnalytics';
                        $params = array("left_menu"                        ,$this->getAttribute(($context["level2"] ?? null), "gid", [])                        ,                        );
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
                        echo "\" 
                        ";
                        // line 9
                        if (($context["use_material_design_icons"] ?? null)) {
                            echo " 
                            class=\"material-icons-link\"
                        ";
                        }
                        // line 11
                        echo "   
                            >
                            ";
                        // line 13
                        if (($context["use_material_design_icons"] ?? null)) {
                            echo "    
                            <i class=\"material-icons\">";
                            // line 14
                            echo $this->getAttribute($context["level2"], "material_icon", []);
                            echo "</i>   
                            <div class=\"menu_section_item-text\">";
                            // line 15
                            echo $this->getAttribute($context["level2"], "value", []);
                            echo "</div>   
                            ";
                        } else {
                            // line 16
                            echo "  
                            <i class=\"fa fa-";
                            // line 17
                            echo $this->getAttribute($context["level2"], "icon", []);
                            echo "\"></i> 
                            ";
                            // line 18
                            echo $this->getAttribute($context["level2"], "value", []);
                            echo " 
                            ";
                        }
                        // line 19
                        echo "  
                            ";
                        // line 20
                        if ($this->getAttribute($context["level2"], "indicator", [])) {
                            echo "<span class=\"num\">";
                            echo $this->getAttribute($context["level2"], "indicator", []);
                            echo "</span>";
                        }
                        // line 21
                        echo "                            
                        </a>
                    </li>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['level2'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 25
                    echo "                </ul>
            </div>
        ";
                }
                // line 28
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['level1'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 30
            echo "    <div class=\"menu\">
        <div class=\"t\">
            <div class=\"b min400\">
            </div>
        </div>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "main_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 30,  138 => 28,  133 => 25,  124 => 21,  118 => 20,  115 => 19,  110 => 18,  106 => 17,  103 => 16,  98 => 15,  94 => 14,  90 => 13,  86 => 11,  80 => 9,  55 => 8,  48 => 7,  44 => 6,  40 => 4,  37 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "main_menu.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\menu\\views\\gentelella\\main_menu.twig");
    }
}
