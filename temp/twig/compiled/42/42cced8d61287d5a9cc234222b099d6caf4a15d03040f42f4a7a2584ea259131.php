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

/* site_visits_graph.twig */
class __TwigTemplate_575cf1c49bfb826c3dc66c1c2a4617f02e6849e83f9b7a5a2e3b63a789fef965 extends \Twig\Template
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
        $module =         null;
        $helper =         'statistics';
        $name =         'visitsData';
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
        $context['data'] = $result;
        // line 2
        $module =         null;
        $helper =         'cloudflare';
        $name =         'cloudflareAnalytics';
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
        $context['cloudflare_analytics'] = $result;
        // line 3
        echo "
";
        // line 4
        if (( !twig_test_empty(($context["data"] ?? null)) && ($this->getAttribute(($context["cloudflare_analytics"] ?? null), "is_visible", []) == 0))) {
            // line 5
            echo "    <div class=\"x_panel\">
        <div class=\"x_title\">
            <h2>";
            // line 7
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("stat_visits"            ,"start"            ,            );
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
        <div class=\"x_content\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"row\">
                    <div id=\"chart_div\" class=\"cursor-pointer\"></div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 29
                echo "                [";
                echo $this->getAttribute($context["item"], "date", []);
                echo ", ";
                echo $this->getAttribute($context["item"], "count", []);
                echo "],
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "            ]);
            var options = {
                hAxis: {title: '";
            // line 33
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("stats_field_name_visits_count"            ,"statistics"            ,            );
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
            echo "',  titleTextStyle: {color: '#333'}, direction: -1},
                vAxis: {minValue: 0},
                legend: {position: 'none'},
                height: 250,
                width: '100%',
                chartArea:{left:40,right:15},
                colors: ['#0089CF'],
                dir: 'rtl'
            };
            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            \$('#chart_div').click(function(){
                ";
            // line 45
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("dashboard"            ,"site_visits_graph"            ,            );
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
            // line 46
            echo "                ";
            if (($context["TRIAL_MODE"] ?? null)) {
                // line 47
                echo "                locationHref(site_url + 'admin/marketing/index');
                ";
            }
            // line 49
            echo "            });
            \$(function(){
                \$('#chart_div>div>div').attr('dir', site_rtl_settings);
            });
        }
    </script>
";
        } else {
            // line 56
            echo "    ";
            echo $this->getAttribute(($context["cloudflare_analytics"] ?? null), "content", []);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "site_visits_graph.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  214 => 56,  205 => 49,  201 => 47,  198 => 46,  177 => 45,  143 => 33,  139 => 31,  128 => 29,  124 => 28,  81 => 7,  77 => 5,  75 => 4,  72 => 3,  51 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "site_visits_graph.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\statistics\\views\\gentelella\\site_visits_graph.twig");
    }
}
