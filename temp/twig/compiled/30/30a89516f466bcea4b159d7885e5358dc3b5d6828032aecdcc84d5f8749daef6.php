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

/* helper_online_now.twig */
class __TwigTemplate_e2974325fbda9a756fc68c0d27c8517f22e00c8407a57c0be13d0f1a1def765c extends \Twig\Template
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
        echo "<div class=\"col-sm-6 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"x_title\">
            <h2>";
        // line 4
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_online_now"        ,"users"        ,        );
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
        echo " <i class=\"fa fa-user\"></i> ";
        echo ($context["online_now"] ?? null);
        echo "</h2>
            <ul class=\"nav navbar-right panel_toolbox\">
                <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a>
                </li>
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\"><i class=\"fa fa-wrench\"></i></a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        <a class=\"dropdown-item\" href=\"#\">Settings 1</a>
                        <a class=\"dropdown-item\" href=\"#\">Settings 2</a>
                    </div>
                </li>
                <li><a class=\"close-link\"><i class=\"fa fa-close\"></i></a>
                </li>
            </ul>
            <div class=\"clearfix\"></div>
        </div>
        <div class=\"x_content\">
            <div id=\"online_counter\"></div>
        </div>
    </div>
</div>
<script>
    google.charts.load(\"current\", {packages:[\"corechart\"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['";
        // line 31
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_type"        ,"users"        ,        );
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
        echo "', '%'],
            ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["online_counter"] ?? null));
        foreach ($context['_seq'] as $context["status"] => $context["count"]) {
            // line 33
            echo "            ['";
            echo $context["status"];
            echo "', ";
            echo $context["count"];
            echo "],
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['status'], $context['count'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "        ]);

        var options = {
            pieHole: 0.1,
            colors: ['#32B44A', '#1479B8', '#73879C', '#5A738E', '#ECF0F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('online_counter'));
        chart.draw(data, options);
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_online_now.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 35,  113 => 33,  109 => 32,  86 => 31,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_online_now.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\users\\views\\gentelella\\helper_online_now.twig");
    }
}
