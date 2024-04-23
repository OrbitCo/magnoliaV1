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

/* install_city_list.twig */
class __TwigTemplate_0e4e7f1bf2639bdd9d480cc684882a241733c1bdbeb91fce972ea57c4aa73b52 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "install_city_list.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-md-12 col-sm-12 col-xs-12\">
    <div class=\"x_panel\">
        <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
            <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                ";
        // line 7
        $module =         null;
        $helper =         'menu';
        $name =         'get_admin_level1_menu';
        $params = array("admin_countries_menu"        ,        );
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
        // line 8
        echo "            </ul>
        </div>
        <div class = \"x_title\">
            ";
        // line 11
        echo ($context["regions_list_length"] ?? null);
        echo "
            ";
        // line 13
        echo "            <h4>";
        echo $this->getAttribute(($context["country"] ?? null), "name", []);
        echo ": ";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("cities_install_progress"        ,"countries"        ,        );
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
        echo "</h4>
            <div class=\"progress\" id=\"overall_bar\">
                <div class=\"bar progress-bar progress-bar-success\" style=\"width:0%\"
                     id=\"overall_bar\" aria-valuenow=\"0\">
                    0%
                </div>
            </div>
        </div>
        <div class=\"x_content\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\" id=\"region_reload\">
                ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["regions_list"] ?? null));
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
        foreach ($context['_seq'] as $context["c_key"] => $context["c_item"]) {
            // line 24
            echo "                    <div class=\"col-md-12 col-sm-12 col-xs-12 country-block\">
                        <span id=\"region_";
            // line 25
            echo $this->getAttribute($context["loop"], "index0", []);
            echo "\">
                            ";
            // line 26
            echo $this->getAttribute($context["c_item"], "name", []);
            echo "
                        </span>
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
        unset($context['_seq'], $context['_iterated'], $context['c_key'], $context['c_item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "            </div>
            <div class=\"clearfix\"></div>
            <div class=\"ln_solid\"></div>
            <div class=\"col-md-12 col-sm-12 col-xs-12\" id=\"back_btn\" class=\"hide\">
                <a href=\"";
        // line 34
        echo ($context["back_link"] ?? null);
        echo "\" class=\"btn btn-default\">
                    ";
        // line 35
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_back"        ,"start"        ,        );
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
        // line 36
        echo "                </a>
            </div>
        </div>
    </div>
</div>

";
        // line 42
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-ui.custom.min.js"        ,        );
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
        echo "<script type=\"text/javascript\" src=\"";
        echo ($context["site_root"] ?? null);
        echo "application/views/gentelella/js/progressbar/bootstrap-progressbar.min.js\"></script>
<script>
var country_install;
\$(function(){
    country_install=new adminCountries({
        siteUrl: '";
        // line 48
        echo ($context["site_url"] ?? null);
        echo "',
        regions: [";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["regions"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            if ($context["key"]) {
                echo ", ";
            }
            echo "'";
            echo $context["item"];
            echo "'";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "],
        country_code: '";
        // line 50
        echo $this->getAttribute(($context["country"] ?? null), "code", []);
        echo "'
    });
    country_install.start_city_install();
});
</script>

";
        // line 56
        $this->loadTemplate("@app/footer.twig", "install_city_list.twig", 56)->display($context);
    }

    public function getTemplateName()
    {
        return "install_city_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  244 => 56,  235 => 50,  219 => 49,  215 => 48,  206 => 43,  185 => 42,  177 => 36,  156 => 35,  152 => 34,  146 => 30,  128 => 26,  124 => 25,  121 => 24,  104 => 23,  69 => 13,  65 => 11,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "install_city_list.twig", "/home/mliadov/public_html/application/modules/countries/views/gentelella/install_city_list.twig");
    }
}
