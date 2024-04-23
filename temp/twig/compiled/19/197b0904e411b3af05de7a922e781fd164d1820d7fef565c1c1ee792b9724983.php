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

/* helper_main_block.twig */
class __TwigTemplate_6f1612fe2153ea1622753e501aaf975f9914d97accd82778bc9672329a47df4f extends \Twig\Template
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
        echo "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
";
        // line 2
        if (($context["statistics"] ?? null)) {
            // line 3
            echo "    <div class=\"quick-stats x_content quick-stats-js\">
        <div class=\"col-xs-12 col-md-9 quick-stats__main\">
            ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["statistics"] ?? null));
            foreach ($context['_seq'] as $context["gid"] => $context["item"]) {
                // line 6
                echo "                <div class=\"col-md-4 col-sm-";
                echo ($context["col_sm"] ?? null);
                echo " col-xs-6 tile_stats_count\">
                    <span class=\"count_top text-overflow\">";
                // line 7
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array(("stat_" . ($context["gid"] ?? null))                ,"start"                ,                );
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
                echo "</span>
                    <div class=\"count\">";
                // line 8
                echo $this->getAttribute($context["item"], "week_1", []);
                echo "</div>
                    <span class=\"count_bottom\">
                        <i class=\"";
                // line 10
                if (($this->getAttribute($context["item"], "week_percent", []) > 0)) {
                    echo "green";
                } elseif (($this->getAttribute($context["item"], "week_percent", []) < 0)) {
                    echo "red";
                }
                echo "\">
                            ";
                // line 11
                echo $this->getAttribute($context["item"], "week_percent", []);
                echo "% </i> ";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("from_last_week"                ,"start"                ,                );
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
                echo "</span>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['gid'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 14
            echo "            ";
            if ((($context["payment_total"] ?? null) > 0)) {
                // line 15
                echo "                <div class=\"col-md-4 col-sm-";
                echo ($context["col_sm"] ?? null);
                echo " col-xs-6 tile_stats_count\">
                    <span class=\"count_top text-overflow\">";
                // line 16
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("stat_payments_all"                ,"start"                ,                );
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
                echo "</span>
                    <div class=\"count\">";
                // line 17
                echo ($context["payment_total"] ?? null);
                echo "</div>
                    <span class=\"count_bottom\"><i></i> ";
                // line 18
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("total"                ,"start"                ,                );
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
                echo "</span>
                </div>
            ";
            }
            // line 21
            echo "            ";
            $module =             null;
            $helper =             'mailbox';
            $name =             'statisticsMsgs';
            $params = array(            );
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
            // line 22
            echo "        </div>
        <div class=\"col-xs-12 col-md-3 quick-stats__other\"></div>
    </div>
    ";
            // line 25
            $module =             null;
            $helper =             'start';
            $name =             'demoPromoBlock';
            $params = array(["page" => "index"]            ,            );
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
            // line 26
            echo "    ";
            $module =             null;
            $helper =             'chatbox';
            $name =             'chatboxCounter';
            $params = array(            );
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
            // line 27
            echo "    <div class=\"row\">
        ";
            // line 28
            $module =             null;
            $helper =             'users';
            $name =             'onlineNow';
            $params = array(            );
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
            // line 29
            echo "        ";
            $module =             null;
            $helper =             'users';
            $name =             'usersCounter';
            $params = array(            );
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
            // line 30
            echo "    </div>
    ";
            // line 31
            $this->loadTemplate("site_visits_graph.twig", "helper_main_block.twig", 31)->display($context);
        }
    }

    public function getTemplateName()
    {
        return "helper_main_block.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  293 => 31,  290 => 30,  268 => 29,  247 => 28,  244 => 27,  222 => 26,  201 => 25,  196 => 22,  174 => 21,  149 => 18,  145 => 17,  122 => 16,  117 => 15,  114 => 14,  84 => 11,  76 => 10,  71 => 8,  48 => 7,  43 => 6,  39 => 5,  35 => 3,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_main_block.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\statistics\\views\\gentelella\\helper_main_block.twig");
    }
}
