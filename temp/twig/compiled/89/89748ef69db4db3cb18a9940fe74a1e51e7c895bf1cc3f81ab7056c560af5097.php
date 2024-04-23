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

/* helper_location_select_autocomplete.twig */
class __TwigTemplate_e236b335863355a9f3036d485bb28a5f173e323cf4f8be07e6ed7016c347ef46 extends \Twig\Template
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
        echo "<input name=\"region_name\" type=\"text\" id=\"country_text_";
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 2
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "location_text", []);
        echo "\"
       autocomplete=\"off\"
       placeholder=\"";
        // line 4
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "placeholder", []);
        echo "\"
       class=\"form-control\">
<span id=\"country_msg_";
        // line 6
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
      class=\"hide pginfo msg region_name info\">";
        // line 7
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_select_from_list"        ,"countries"        ,        );
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
        echo "</span>
<input name=\"";
        // line 9
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_country_name", []);
        echo "\" type=\"hidden\"
       id=\"country_hidden_";
        // line 10
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 11
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "country", []), "code", []);
        echo "\">
<input name=\"";
        // line 12
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_region_name", []);
        echo "\" type=\"hidden\"
       id=\"region_hidden_";
        // line 13
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 14
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "region", []), "id", []);
        echo "\">
<input name=\"";
        // line 15
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_city_name", []);
        echo "\" type=\"hidden\"
       id=\"city_hidden_";
        // line 16
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 17
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "id", []);
        echo "\">
<input name=\"lat\" type=\"hidden\"
       id=\"lat_hidden_";
        // line 19
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 20
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "latitude", []);
        echo "\">
<input name=\"lon\" type=\"hidden\"
       id=\"lon_hidden_";
        // line 22
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 23
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "longitude", []);
        echo "\">

<script type='text/javascript'>
    ";
        // line 26
        if ($this->getAttribute(($context["country_helper_data"] ?? null), "var_js_name", [])) {
            echo "var ";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_js_name", []);
            echo ";";
        }
        // line 27
        echo "        \$(function () {

            loadScripts(
                    [";
        // line 31
        echo "                \"";
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array("countries"        ,"location-autocomplete.js"        ,"path"        ,        );
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
        echo "\"],
                function () {
                    new locationAutocomplete({
                        siteUrl: '";
        // line 34
        echo ($context["site_url"] ?? null);
        echo "',
                        rand: '";
        // line 35
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "',
                        id_country: '";
        // line 36
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "country", []), "code", []);
        echo "',
                        id_region: '";
        // line 37
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "region", []), "id", []);
        echo "',
                        id_city: '";
        // line 38
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "id", []);
        echo "',
                        lat: '";
        // line 39
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "latitude", []);
        echo "',
                        lon: '";
        // line 40
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "longitude", []);
        echo "',
                        isAdmin: true,
                        isSearch: ";
        // line 42
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "is_search", []);
        echo ",
                    });
                },
                'region_";
        // line 45
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "'
            );
        });
</script>
";
    }

    public function getTemplateName()
    {
        return "helper_location_select_autocomplete.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 45,  195 => 42,  190 => 40,  186 => 39,  182 => 38,  178 => 37,  174 => 36,  170 => 35,  166 => 34,  140 => 31,  135 => 27,  129 => 26,  123 => 23,  119 => 22,  114 => 20,  110 => 19,  105 => 17,  101 => 16,  97 => 15,  93 => 14,  89 => 13,  85 => 12,  81 => 11,  77 => 10,  73 => 9,  70 => 8,  49 => 7,  45 => 6,  40 => 4,  35 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_location_select_autocomplete.twig", "D:\\xampp\\htdocs\\social_proj\\public_html\\application\\modules\\countries\\views\\gentelella\\helper_location_select_autocomplete.twig");
    }
}
