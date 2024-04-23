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

/* index.twig */
class __TwigTemplate_cea33e365e6f351c53aa8c08a98872cadd047231dfd55c372ff7e46dca310f10 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "index.twig", 1)->display(twig_array_merge($context, ["load_type" => "ui", "hide_page_header" => true]));
        // line 2
        echo "
";
        // line 3
        $module =         null;
        $helper =         'dashboard';
        $name =         'dashboard_wall';
        $params = array(        );
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
        $context['wall'] = $result;
        // line 4
        $context["statistics_col_sm"] = 4;
        // line 5
        if (twig_trim_filter(($context["wall"] ?? null))) {
            // line 6
            echo "    ";
            echo ($context["wall"] ?? null);
            echo "
    ";
            // line 7
            $context["statistics_col_sm"] = 6;
        }
        // line 9
        echo "
<div class=\"dashboard__after\">
    <div class=\"col-md-12 col-sm-12 col-xs-12\">
        ";
        // line 12
        if (($context["ql_modules"] ?? null)) {
            // line 13
            echo "            <div class=\"x_panel\">
                <div class=\"x_title\">
                    <h2>";
            // line 15
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_get_started"            ,"admin_home_page"            ,            );
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
            echo "</h2>
                    <ul class=\"nav navbar-right panel_toolbox\">
                        <li>
                            <a class=\"collapse-link\"><i class=\"fa fa-chevron-up cursor-pointer\"></i></a>
                        </li>
                    </ul>
                    <div class=\"clearfix\"></div>
                </div>
                    <div class=\"quick-links x_content\">
                        <div class=\"col-md-12 col-sm-12 col-xs-12\">
                            <div class=\"row\">
                                ";
            // line 26
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["ql_modules"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["ql_module"]) {
                // line 27
                echo "                                    ";
                if ((($this->getAttribute($context["loop"], "index0", []) % 4) == 0)) {
                    // line 28
                    echo "                                    </div><div class=\"row\">
                                    ";
                }
                // line 30
                echo "                                    <div class=\"quick-link col-md-3 col-sm-6 col-xs-12\">
                                        <div class=\"hp100\" onclick=\"";
                // line 31
                $module =                 null;
                $helper =                 'start';
                $name =                 'setAnalytics';
                $params = array("dashboard"                ,$this->getAttribute(($context["ql_module"] ?? null), "name", [])                ,                );
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
                // line 32
                $module =                 null;
                $helper =                 'utils';
                $name =                 'render';
                $params = array($this->getAttribute(($context["ql_module"] ?? null), "name", [])                ,"link_settings"                ,""                ,$this->getAttribute(($context["ql_module"] ?? null), "options", [])                ,                );
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
                // line 33
                echo "                                        </div>
                                    </div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ql_module'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "                            </div>
                        </div>
                    </div>
            </div>
        ";
        }
        // line 41
        echo "        ";
        // line 42
        echo "        ";
        $module =         null;
        $helper =         'statistics';
        $name =         'mainBlock';
        $params = array(["col" => ($context["statistics_col_sm"] ?? null)]        ,        );
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
        // line 43
        echo "        ";
        $module =         null;
        $helper =         'guided_setup';
        $name =         'guidePageBtn';
        $params = array(["menu_gid" => "guided_pages"]        ,        );
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
        // line 44
        echo "    </div>
</div>
<div class=\"clearfix\"></div>
";
        // line 47
        $module =         null;
        $helper =         'start';
        $name =         'ad';
        $params = array(        );
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
        // line 48
        echo "
";
        // line 49
        $this->loadTemplate("@app/footer.twig", "index.twig", 49)->display($context);
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  281 => 49,  278 => 48,  257 => 47,  252 => 44,  230 => 43,  208 => 42,  206 => 41,  199 => 36,  183 => 33,  162 => 32,  139 => 31,  136 => 30,  132 => 28,  129 => 27,  112 => 26,  79 => 15,  75 => 13,  73 => 12,  68 => 9,  65 => 7,  60 => 6,  58 => 5,  56 => 4,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\start\\views\\gentelella\\index.twig");
    }
}
