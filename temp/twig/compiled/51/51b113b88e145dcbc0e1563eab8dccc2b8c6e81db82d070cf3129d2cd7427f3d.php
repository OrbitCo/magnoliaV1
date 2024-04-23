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
class __TwigTemplate_ed3bdbf74c70016710934da89f62e6b8941abbfdbc186a3b11ab9b06ff706afb extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            '__internal_bdc6f58d29de742f842fe8362f1fa775f391e1f009395f3181f219af7139ffcb' => [$this, 'block___internal_bdc6f58d29de742f842fe8362f1fa775f391e1f009395f3181f219af7139ffcb'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ($this->getAttribute(($context["country_helper_data"] ?? null), "is_button", [])) {
            // line 2
            echo "    <div class=\"input-autocomplete input-autocomplete-";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\" id=\"countries-input-block-";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\">
        <div class=\"input-group countries-input__input-group\">
            <input class=\"form-control\" name=\"region_name\" type=\"text\" id=\"country_text_";
            // line 4
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\"
                   value=\"";
            // line 5
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "location_text", []);
            echo "\"
                   autocomplete=\"off\" placeholder=\"";
            // line 6
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_autocomplete_placeholder"            ,"countries"            ,            );
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
            <span class=\"input-group-btn\">
                <button class=\"btn btn-default\" data-fieldaction=\"click\" type=\"button\">";
            // line 8
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_save"            ,"start"            ,""            ,"js"            ,            );
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
            echo "</button>
            </span>
        </div>
    </div>
";
        } else {
            // line 13
            echo "    <div class=\"input-autocomplete input-autocomplete-";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\" id=\"countries-input-block-";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\">
    <div class=\"input-group countries-input__input-group\">
        <input class=\"form-control\" name=\"region_name\" type=\"text\" id=\"country_text_";
            // line 15
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\"
               value=\"";
            // line 16
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "location_text", []);
            echo "\"
               autocomplete=\"off\" placeholder=\"";
            // line 17
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_autocomplete_placeholder"            ,"countries"            ,            );
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
        <span class=\"input-group-addon btn btn-default\">
            <i class=\"fas fa-globe\"></i>
        </span>
    </div>
</div>
";
        }
        // line 24
        echo "<span id=\"country_msg_";
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\" class=\"hide pginfo msg region_name\">
    ";
        // line 25
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
        // line 26
        echo "</span>
";
        // line 27
        if (($this->getAttribute(($context["country_helper_data"] ?? null), "is_radius", []) == 1)) {
            // line 28
            echo "    <div class=\"radius-block ";
            if ((($this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "longitude", []) == "") && ($this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "latitude", []) == ""))) {
                echo " hide";
            }
            echo "\">
        <div class=\"f-title\">
            ";
            // line 30
            echo twig_upper_filter($this->env,             $this->renderBlock("__internal_bdc6f58d29de742f842fe8362f1fa775f391e1f009395f3181f219af7139ffcb", $context, $blocks));
            // line 31
            echo "        </div>
        <div class=\"f-block\">
            <label>1";
            // line 33
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "radius_unit", []);
            echo "</label> &nbsp;
            <span id=\"circle_radius_span_bottom\" class=\"circle_radius_span\"></span>
            <div id=\"circle_radius_slider_bottom\"></div>
        </div>
    </div>
    <input name=\"";
            // line 38
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_radius_name", []);
            echo "\" type=\"hidden\"  id=\"radius_hidden_";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "\"  value=\"";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "radius", []);
            echo "\">
";
        }
        // line 40
        echo "<input name=\"";
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_country_name", []);
        echo "\" type=\"hidden\"
       id=\"country_hidden_";
        // line 41
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 42
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "country", []), "code", []);
        echo "\">
<input name=\"";
        // line 43
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_region_name", []);
        echo "\" type=\"hidden\"
       id=\"region_hidden_";
        // line 44
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 45
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "region", []), "id", []);
        echo "\">
<input name=\"";
        // line 46
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_city_name", []);
        echo "\" type=\"hidden\"
       id=\"city_hidden_";
        // line 47
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 48
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "id", []);
        echo "\">
<input name=\"";
        // line 49
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_lat_name", []);
        echo "\" type=\"hidden\"
       id=\"lat_hidden_";
        // line 50
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 51
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "latitude", []);
        echo "\">
<input name=\"";
        // line 52
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "var_lon_name", []);
        echo "\" type=\"hidden\"
       id=\"lon_hidden_";
        // line 53
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "\"
       value=\"";
        // line 54
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "longitude", []);
        echo "\">
<script>
    \$(function () {
        loadScripts(
                [
                    \"";
        // line 59
        $module =         null;
        $helper =         'utils';
        $name =         'jscript';
        $params = array(""        ,"jquery-slimscroll.js"        ,"path"        ,        );
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
        echo "\",
                    \"";
        // line 60
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
        echo "\"
                ],
                function () {
                     autoloc_obj = new locationAutocomplete({
                        siteUrl: '";
        // line 64
        echo ($context["site_url"] ?? null);
        echo "',
                        rand: '";
        // line 65
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "',
                        id_country: '";
        // line 66
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "country", []), "code", []);
        echo "',
                        id_region: '";
        // line 67
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "region", []), "id", []);
        echo "',
                        id_city: '";
        // line 68
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "id", []);
        echo "',
                        lat: '";
        // line 69
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "latitude", []);
        echo "',
                        lon: '";
        // line 70
        echo $this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "city", []), "longitude", []);
        echo "',
                        searchIcon: 'fa-search',
                        closeIcon: 'fa-times',
                        id_bg: '";
        // line 73
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "id_bg", []);
        echo "',
                        isChangeLocation: '";
        // line 74
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "is_change_location", []);
        echo "',
                        getChangeLocationForm: 'users/getChangeLocationForm',
                        isRadius: ";
        // line 76
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "is_radius", []);
        echo ",
                        isAdmin: false,
                        isSearch: ";
        // line 78
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "is_search", []);
        echo ",
                    });

    ";
        // line 81
        if (($this->getAttribute(($context["country_helper_data"] ?? null), "auto_detect", []) &&  !$this->getAttribute($this->getAttribute(($context["country_helper_data"] ?? null), "country", []), "code", []))) {
            // line 82
            echo "                        if (\$('#country_text_";
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "').is(':visible')) {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function (position) {

                                    var latitude = position.coords.latitude;
                                    var longitude = position.coords.longitude;

                                    if (typeof (Storage) !== \"undefined\") {
                                        var userLocation = latitude + \";\" + longitude;
                                        if (localStorage.getItem(\"userLocation\") != userLocation) {
                                            localStorage.setItem(\"userLocation\", userLocation);
                                        }
                                    }

                                    autoloc_obj.identifyLocation();

                                }, function (error) {
                                    var geo_error;
                                    switch (error.code) {
                                        case error.PERMISSION_DENIED:
                                            geo_error = \"User denied the request for Geolocation.\"
                                            break;
                                        case error.POSITION_UNAVAILABLE:
                                            geo_error = \"Location information is unavailable.\"
                                            break;
                                        case error.TIMEOUT:
                                            geo_error = \"The request to get user location timed out.\"
                                            break;
                                        case error.UNKNOWN_ERROR:
                                            geo_error = \"An unknown error occurred.\"
                                            break;
                                    }
                                });
                            }
                        }
    ";
        }
        // line 118
        echo "                    },
                    'region_";
        // line 119
        echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
        echo "'
                    );
              let radius = 0;
              let radius_unit = '';
              let max_radius = 0;
            ";
        // line 124
        if (($this->getAttribute(($context["country_helper_data"] ?? null), "is_radius", []) == 1)) {
            // line 125
            echo "                   radius = 100;
                    max_radius = 100;
                   radius_unit = 'km';

            ";
            // line 129
            if ($this->getAttribute(($context["country_helper_data"] ?? null), "radius", [])) {
                // line 130
                echo "                    radius = ";
                echo $this->getAttribute(($context["country_helper_data"] ?? null), "radius", []);
                echo "
                    max_radius = ";
                // line 131
                echo $this->getAttribute(($context["country_helper_data"] ?? null), "max_radius", []);
                echo "
                    radius_unit = \"";
                // line 132
                echo $this->getAttribute(($context["country_helper_data"] ?? null), "radius_unit", []);
                echo "\"
                    radius = (radius <= max_radius) ? radius : max_radius;
            ";
            }
            // line 135
            echo "                let setRadius = (r) => {
                    let setRadius = (r / 1000);
                    let radius_width = \$('#circle_radius_slider_bottom').width()-50;
                    let left = \$(\"#circle_radius_slider_bottom>a\").css('left');
                    left = (parseInt(left)<20) ? '10px' : (parseInt(left)>parseInt(radius_width)) ? radius_width : left;
                    \$(\"#circle_radius_span_bottom\").css('padding-left', left).html(function(){
                        return (setRadius === 0) ? '1 '+ radius_unit :  setRadius +\" \"+ radius_unit;
                    });
                    \$(\"#circle_radius_slider\").slider(\"option\", \"value\", r);
                    \$('#radius_hidden_";
            // line 144
            echo $this->getAttribute(($context["country_helper_data"] ?? null), "rand", []);
            echo "').val(r);

                }

                \$(\"#circle_radius_slider_bottom\").slider({
                    range: 'min',
                    value: radius,
                    step: 100,
                    min: 1000,
                    max: max_radius,
                    create: function(event, ui) {
                        setRadius(radius);
                    },
                    slide: function( event, ui ) {
                        setRadius(ui.value);
                    },
                    change: function(event, ui) {

                    }
                });

            ";
        }
        // line 166
        echo "        });
</script>
";
    }

    // line 30
    public function block___internal_bdc6f58d29de742f842fe8362f1fa775f391e1f009395f3181f219af7139ffcb($context, array $blocks = [])
    {
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_search_by_radius"        ,"countries"        ,        );
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
        return array (  491 => 30,  485 => 166,  460 => 144,  449 => 135,  443 => 132,  439 => 131,  434 => 130,  432 => 129,  426 => 125,  424 => 124,  416 => 119,  413 => 118,  373 => 82,  371 => 81,  365 => 78,  360 => 76,  355 => 74,  351 => 73,  345 => 70,  341 => 69,  337 => 68,  333 => 67,  329 => 66,  325 => 65,  321 => 64,  295 => 60,  272 => 59,  264 => 54,  260 => 53,  256 => 52,  252 => 51,  248 => 50,  244 => 49,  240 => 48,  236 => 47,  232 => 46,  228 => 45,  224 => 44,  220 => 43,  216 => 42,  212 => 41,  207 => 40,  198 => 38,  190 => 33,  186 => 31,  184 => 30,  176 => 28,  174 => 27,  171 => 26,  150 => 25,  145 => 24,  116 => 17,  112 => 16,  108 => 15,  100 => 13,  73 => 8,  49 => 6,  45 => 5,  41 => 4,  33 => 2,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_location_select_autocomplete.twig", "/home/mliadov/public_html/application/modules/countries/views/flatty/helper_location_select_autocomplete.twig");
    }
}
