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

/* helper_top_menu_item.twig */
class __TwigTemplate_2ce88703d9c5870d51c28110a5ba168957f84e81ce8647163afebdaf802d79f5 extends \Twig\Template
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
        if (($context["item"] ?? null)) {
            // line 2
            echo "    <a id=\"activities_";
            echo $this->getAttribute(($context["item"] ?? null), "gid", []);
            echo "\" href=\"";
            echo $this->getAttribute(($context["item"] ?? null), "link", []);
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
        <span>        
            ";
            // line 4
            echo $this->getAttribute(($context["item"] ?? null), "value", []);
            echo "
        </span>
        ";
            // line 6
            if ($this->getAttribute(($context["item"] ?? null), "indicator", [])) {
                // line 7
                echo "            <span class=\"badge summand ";
                echo $this->getAttribute(($context["item"] ?? null), "gid", []);
                echo "_count\"></span>
        ";
            }
            // line 9
            echo "    
        ";
            // line 10
            if (($this->getAttribute(($context["item"] ?? null), "gid", []) == "friendlist_item")) {
                // line 11
                echo "            ";
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
                echo "        ";
            } elseif (($this->getAttribute(($context["item"] ?? null), "gid", []) == "visits_item")) {
                // line 13
                echo "            ";
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
                echo "        ";
            } elseif (($this->getAttribute(($context["item"] ?? null), "gid", []) == "kisses_item")) {
                // line 15
                echo "            ";
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
                echo "        ";
            } elseif (($this->getAttribute(($context["item"] ?? null), "gid", []) == "winks_item")) {
                // line 17
                echo "            ";
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
                echo "        ";
            } elseif (($this->getAttribute(($context["item"] ?? null), "gid", []) == "questions_item")) {
                // line 19
                echo "            ";
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
                echo "        ";
            }
            // line 21
            echo "    </a>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_top_menu_item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 21,  201 => 20,  179 => 19,  176 => 18,  154 => 17,  151 => 16,  129 => 15,  126 => 14,  104 => 13,  101 => 12,  79 => 11,  77 => 10,  74 => 9,  68 => 7,  66 => 6,  61 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_top_menu_item.twig", "/home/mliadov/public_html/application/modules/menu/views/flatty/helper_top_menu_item.twig");
    }
}
