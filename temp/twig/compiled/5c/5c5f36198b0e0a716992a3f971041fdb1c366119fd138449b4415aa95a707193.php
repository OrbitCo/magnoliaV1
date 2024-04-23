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

/* list.twig */
class __TwigTemplate_3abfa3c44428606a4bb2382f4ca0533c52be98df745f6f2079fe9ae321d6d6bb extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "list.twig", 1)->display($context);
        // line 2
        echo "<div class=\"x_panel\">
    <div class=\"form-inline form-group\">
        <div class=\"form-group\">
            <label class=\"control-label\">";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("text_module_select"        ,"seo_advanced"        ,        );
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
        echo ":</label>
            <select name=\"module_gid\" onchange=\"javascript: reload_this_page(this.value);\" class=\"form-control\">
                ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modules"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 8
            echo "                    ";
            if (($this->getAttribute($context["item"], "module_gid", []) != "intercom")) {
                // line 9
                echo "                        <option value=\"";
                echo $this->getAttribute($context["item"], "module_gid", []);
                echo "\" ";
                if ((($context["module_gid"] ?? null) == $this->getAttribute($context["item"], "module_gid", []))) {
                    echo "selected";
                }
                echo ">";
                echo $this->getAttribute($context["item"], "module_name", []);
                echo " (";
                echo $this->getAttribute($context["item"], "module_gid", []);
                echo ")</option>
                    ";
            }
            // line 11
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "            </select>
        </div>
    </div>
    ";
        // line 15
        if (($context["default_settings"] ?? null)) {
            // line 16
            echo "        <table class=\"table table-striped jambo_table\">
            <thead>
                <tr>
                    <th>";
            // line 19
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("target_field"            ,"seo_advanced"            ,            );
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
            echo "</th>
                    <th>&nbsp;</th>
                </tr>
            <thead>
            <tbody>
                ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["default_settings"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 25
                echo "                    <tr>
                        <td>";
                // line 26
                echo ($context["site_url"] ?? null);
                echo ($context["module_gid"] ?? null);
                echo "/";
                echo $context["key"];
                if ($this->getAttribute($context["item"], "url", [])) {
                    echo "<br>(<b>";
                    $module =                     null;
                    $helper =                     'lang';
                    $name =                     'l';
                    $params = array("rewrite_url"                    ,"seo_advanced"                    ,                    );
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
                    echo ": </b><i>";
                    echo ($context["site_url"] ?? null);
                    echo $this->getAttribute($context["item"], "url", []);
                    echo "</i>)";
                }
                echo "</td>
                        <td class=\"icons\">
                            <div class=\"btn-group\">
                                <a href=\"";
                // line 29
                echo ($context["site_url"] ?? null);
                echo "admin/seo_advanced/edit/";
                echo ($context["module_gid"] ?? null);
                echo "/";
                echo $context["key"];
                echo "\"
                                   class=\"btn btn-primary\">
                                    ";
                // line 31
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_settings"                ,"seo_advanced"                ,                );
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
                echo "</a>
                                <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\"
                                        aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                </button>
                                <ul class=\"dropdown-menu\">
                                    <li>
                                        <a href=\"";
                // line 39
                echo ($context["site_url"] ?? null);
                echo "admin/seo_advanced/edit/";
                echo ($context["module_gid"] ?? null);
                echo "/";
                echo $context["key"];
                echo "\">
                                            ";
                // line 40
                $module =                 null;
                $helper =                 'lang';
                $name =                 'l';
                $params = array("link_edit_settings"                ,"seo_advanced"                ,                );
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
                echo "</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "            </tbody>
        </table>
    ";
        }
        // line 50
        echo "
    ";
        // line 51
        if ((($context["env"] ?? null) == "development")) {
            // line 52
            echo "
        <form class=\"x_panel form-horizontal accordion\" method=\"post\">
            <div class=\"form-inline form-group\">
                <div class=\"form-group\">
                    <label class=\"control-label\">Conversion for all modules (fast setting)</label>
                </div>
            </div>
            <div class=\"x_content\">
                <div>
                    <div class=\"row form-group panel-heading\">
                        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                            <div>";
            // line 63
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("field_title_default"            ,"seo_advanced"            ,            );
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
                        </label>
                    </div>
                    <div>
                        <div class=\"row form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                <span>replace on new prefix :</span> 
                                <br>
                                <span>(*if field empty prefix will just cleared)</span>
                            </label>
                            <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                <input type=\"text\" value=\"";
            // line 74
            echo ($context["prefix"] ?? null);
            echo "\" name=\"new_prefix\" class=\"form-control\"> 
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class=\"row form-group\">
                    <div class=\"col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9 col-xs-12\">
                        <input class=\"btn btn-success\" type=\"submit\" name=\"btn_save_prefix\" 
                            value=\"Replace prefix\">
                        <a class=\"btn btn-default\" href=\"";
            // line 84
            echo ($context["site_url"] ?? null);
            echo "admin/seo_advanced/listing/\">
                            ";
            // line 85
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_cancel"            ,"start"            ,            );
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
            // line 86
            echo "                        </a>
                    </div>
                </div>
            </div>
        </form>

    ";
        }
        // line 93
        echo "
    
    ";
        // line 95
        $this->loadTemplate("@app/pagination.twig", "list.twig", 95)->display($context);
        // line 96
        echo "</div>
<script type=\"text/javascript\">
    var reload_link = \"";
        // line 98
        echo ($context["site_url"] ?? null);
        echo "admin/seo_advanced/listing/\";
    function reload_this_page(value) {
        var link = reload_link + value;
        location.href = link;
    }
</script>
";
        // line 104
        $this->loadTemplate("@app/footer.twig", "list.twig", 104)->display($context);
    }

    public function getTemplateName()
    {
        return "list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  371 => 104,  362 => 98,  358 => 96,  356 => 95,  352 => 93,  343 => 86,  322 => 85,  318 => 84,  305 => 74,  272 => 63,  259 => 52,  257 => 51,  254 => 50,  249 => 47,  217 => 40,  209 => 39,  179 => 31,  170 => 29,  134 => 26,  131 => 25,  127 => 24,  100 => 19,  95 => 16,  93 => 15,  88 => 12,  82 => 11,  68 => 9,  65 => 8,  61 => 7,  37 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "list.twig", "/home/mliadov/public_html/application/modules/seo_advanced/views/gentelella/list.twig");
    }
}
