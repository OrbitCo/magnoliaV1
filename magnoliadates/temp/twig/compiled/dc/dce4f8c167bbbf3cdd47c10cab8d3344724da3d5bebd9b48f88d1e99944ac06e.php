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

/* helper_top_menu_items_xs.twig */
class __TwigTemplate_7fe13f59a4959c8c8997e38611cfeae074b590e218cf3ee5251e1521af160aae extends \Twig\Template
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
        echo "<div id=\"menu_";
        echo $this->getAttribute(($context["menu_items"] ?? null), "gid", []);
        echo "_alerts\" data-gid=\"";
        echo $this->getAttribute(($context["menu_items"] ?? null), "gid", []);
        echo "\">
    <div class=\"xs-menu-title\">";
        // line 2
        echo $this->getAttribute(($context["menu_items"] ?? null), "value", []);
        echo "</div>
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["menu_items"] ?? null), "sub", []));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 4
            echo "        <div class=\"menu-alerts-item menu-item menu-alerts-more-item\">
            <a id=\"activities_";
            // line 5
            echo $this->getAttribute(($context["menu_items"] ?? null), "gid", []);
            echo "_";
            echo $this->getAttribute($context["item"], "gid", []);
            echo "\" href=\"";
            echo $this->getAttribute($context["item"], "link", []);
            echo "\" onclick=\"";
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("left_menu_user"            ,$this->getAttribute(($context["item"] ?? null), "gid", [])            ,            );
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
                ";
            // line 6
            echo $this->getAttribute($context["item"], "value", []);
            echo "
                ";
            // line 7
            if ($this->getAttribute($context["item"], "indicator", [])) {
                // line 8
                echo "                    <span class=\"badge summand ";
                echo $this->getAttribute($context["item"], "gid", []);
                echo "_count\">";
                echo $this->getAttribute($context["item"], "indicator", []);
                echo "</span>
                ";
            }
            // line 10
            echo "                ";
            if (($this->getAttribute($context["item"], "gid", []) == "friendlist_item")) {
                // line 11
                echo "                    ";
                $module =                 null;
                $helper =                 'friendlist';
                $name =                 'friend_requests';
                $params = array(["template" => "left"]                ,                );
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
                // line 12
                echo "                ";
            } elseif (($this->getAttribute($context["item"], "gid", []) == "visits_item")) {
                // line 13
                echo "                    ";
                $module =                 null;
                $helper =                 'users';
                $name =                 'visitors';
                $params = array(["template" => "left"]                ,                );
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
                // line 14
                echo "                ";
            } elseif (($this->getAttribute($context["item"], "gid", []) == "kisses_item")) {
                // line 15
                echo "                    ";
                $module =                 null;
                $helper =                 'kisses';
                $name =                 'new_kisses';
                $params = array(["template" => "left"]                ,                );
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
                // line 16
                echo "                ";
            } elseif (($this->getAttribute($context["item"], "gid", []) == "winks_item")) {
                // line 17
                echo "                    ";
                $module =                 null;
                $helper =                 'winks';
                $name =                 'winks_count';
                $params = array(["template" => "left"]                ,                );
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
                // line 18
                echo "                ";
            } elseif (($this->getAttribute($context["item"], "gid", []) == "questions_item")) {
                // line 19
                echo "                    ";
                $module =                 null;
                $helper =                 'questions';
                $name =                 'new_questions';
                $params = array(["template" => "left"]                ,                );
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
                // line 20
                echo "                ";
            }
            // line 21
            echo "            </a>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "helper_top_menu_items_xs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  227 => 24,  219 => 21,  216 => 20,  194 => 19,  191 => 18,  169 => 17,  166 => 16,  144 => 15,  141 => 14,  119 => 13,  116 => 12,  94 => 11,  91 => 10,  83 => 8,  81 => 7,  77 => 6,  48 => 5,  45 => 4,  41 => 3,  37 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_top_menu_items_xs.twig", "/home/mliadov/public_html/application/modules/menu/views/flatty/helper_top_menu_items_xs.twig");
    }
}
