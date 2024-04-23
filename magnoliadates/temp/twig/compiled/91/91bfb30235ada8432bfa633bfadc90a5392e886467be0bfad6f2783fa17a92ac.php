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

/* location_select_form.twig */
class __TwigTemplate_32211283af3f44ab3b8072ba30f858efdf26eb2a740d54bddb8d6f57a4ecbec1 extends \Twig\Template
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
        echo "<style>
    #location_select_items .location-item {
        cursor: pointer;
        padding: 2px;
    }
    #location_select_items .location-item:hover {
        background: #f5f5f5;
    }
    #location_select_items .location-item.active {
        font-weight: bold;
        background: #f5f5f5;
    }
</style>

<div class=\"load_content_controller\">
    <div class=\"controller-actions\">
        <div id=\"city_page\" class=\"fright\"></div>
        <div class=\"select-back\">
            ";
        // line 19
        if ((($context["type"] ?? null) == "region")) {
            // line 20
            echo "                <a href=\"javascript:;\" id=\"country_select_back\">
                    <span><i class=\"fas fa-long-arrow-alt-left fa-lg edge\"></i> ";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_select_another_country"            ,"countries"            ,            );
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
                </a>
            ";
        } elseif ((        // line 23
($context["type"] ?? null) == "city")) {
            // line 24
            echo "                <a href=\"javascript:;\" id=\"region_select_back\">
                    <span><i class=\"fas fa-long-arrow-alt-left fa-lg edge\"></i> ";
            // line 25
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_select_another_region"            ,"countries"            ,            );
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
                </a>
            ";
        }
        // line 28
        echo "        </div>
    </div>    
    <h1>
        ";
        // line 31
        if ((($context["type"] ?? null) == "region")) {
            // line 32
            echo "            ";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "country", []), "name", []);
            echo "
        ";
        } elseif ((        // line 33
($context["type"] ?? null) == "city")) {
            // line 34
            echo "            ";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "country", []), "name", []);
            echo ", ";
            echo $this->getAttribute($this->getAttribute(($context["data"] ?? null), "region", []), "name", []);
            echo "
        ";
        }
        // line 36
        echo "    </h1>
    <h3>
        ";
        // line 38
        if ((($context["type"] ?? null) == "country")) {
            // line 39
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_country_select"            ,"countries"            ,            );
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
            echo ":
        ";
        } elseif ((        // line 40
($context["type"] ?? null) == "region")) {
            // line 41
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_region_select"            ,"countries"            ,            );
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
            echo ":
        ";
        } elseif ((        // line 42
($context["type"] ?? null) == "city")) {
            // line 43
            echo "            ";
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_city_select"            ,"countries"            ,            );
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
            echo ":
        ";
        }
        // line 44
        echo "        
    </h3>
    <div class=\"inside\">
        ";
        // line 47
        if ($this->getAttribute(($context["data"] ?? null), "items", [])) {
            // line 48
            echo "        <ul class=\"controller-items\" id=\"location_select_items\">
            ";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "items", []));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 50
                echo "                <li class=\"location-item\" gid=\"";
                echo $this->getAttribute($context["item"], "id", []);
                echo "\" code=\"";
                echo $this->getAttribute($context["item"], "code", []);
                echo "\" lat=\"";
                echo $this->getAttribute($context["item"], "latitude", []);
                echo "\" lon=\"";
                echo $this->getAttribute($context["item"], "longitude", []);
                echo "\">";
                echo $this->getAttribute($context["item"], "name", []);
                echo "</li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "        </ul>
        ";
        } else {
            // line 54
            echo "            ";
            if ((($context["type"] ?? null) == "city")) {
                // line 55
                echo "            <div class=\"center\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("no_cities"                ,"countries"                ,                );
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
                echo "</div>    
            ";
            } elseif ((            // line 56
($context["type"] ?? null) == "region")) {
                // line 57
                echo "            <div class=\"center\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("no_regions"                ,"countries"                ,                );
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
                echo "</div>  
            ";
            }
            // line 58
            echo "        
        ";
        }
        // line 60
        echo "        <buttom class=\"btn btn-primary form-control mt20 ";
        if ($this->getAttribute(($context["data"] ?? null), "items", [])) {
            echo " hide ";
        }
        echo "\" data-action=\"save-location\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_ok"        ,"start"        ,        );
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
    </div>
    ";
        // line 62
        if (((($context["is_search"] ?? null) == 1) && (($context["type"] ?? null) != "city"))) {
            // line 63
            echo "        <div class=\"mt20\">
            <button class=\"btn btn-primary\" data-action=\"set-location\">";
            // line 64
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_select"            ,"countries"            ,            );
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
            ";
            // line 65
            if ((($context["type"] ?? null) == "country")) {
                // line 66
                echo "                <buttom class=\"btn btn-primary hide\"  data-action=\"next-region\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_add_region"                ,"countries"                ,                );
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
            ";
            } else {
                // line 68
                echo "                <buttom class=\"btn btn-primary hide\"  data-action=\"next-city\">";
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_add_city"                ,"countries"                ,                );
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
            ";
            }
            // line 70
            echo "        </div>
    ";
        }
        // line 72
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "location_select_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  420 => 72,  416 => 70,  391 => 68,  366 => 66,  364 => 65,  341 => 64,  338 => 63,  336 => 62,  307 => 60,  303 => 58,  278 => 57,  276 => 56,  252 => 55,  249 => 54,  245 => 52,  228 => 50,  224 => 49,  221 => 48,  219 => 47,  214 => 44,  189 => 43,  187 => 42,  163 => 41,  161 => 40,  137 => 39,  135 => 38,  131 => 36,  123 => 34,  121 => 33,  116 => 32,  114 => 31,  109 => 28,  84 => 25,  81 => 24,  79 => 23,  55 => 21,  52 => 20,  50 => 19,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "location_select_form.twig", "/home/mliadov/public_html/application/modules/countries/views/flatty/location_select_form.twig");
    }
}
