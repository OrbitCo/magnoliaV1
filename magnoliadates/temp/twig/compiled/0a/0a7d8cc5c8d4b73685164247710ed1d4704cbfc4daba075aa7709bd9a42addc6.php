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

/* my_form.twig */
class __TwigTemplate_d9daf0ec6506ca5e559f8164ef2468af5ba5144f2cf83c4f7c34d2ef2e8608ac extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "my_form.twig", 1)->display($context);
        // line 2
        echo "
<div class=\"col-xs-12 col-sm-6\">
    <div class=\"content-block\">
        <h1>
            ";
        // line 6
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("header_banner_form"        ,"banners"        ,        );
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
        // line 7
        echo "        </h1>
        <div class=\"content-value\">
            <form method=\"post\" action=\"";
        // line 9
        echo ($context["site_url"] ?? null);
        echo "banners/edit\" name=\"save_form\" enctype=\"multipart/form-data\">
                <div class=\"edit_block\">
                    <div class=\"form-group\">
                        <label>
                            ";
        // line 13
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_name"        ,"banners"        ,        );
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
                        </label>
                        <input type=\"text\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "name", []));
        echo "\" name=\"name\" class=\"form-control\">
                    </div>
                    <div class=\"form-group\">
                        <label>
                            ";
        // line 19
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("banner_place"        ,"banners"        ,        );
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
                        </label>
                        <select id=\"banner_place\" name=\"banner_place_id\" class=\"form-control\">
                            ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["places"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["place"]) {
            // line 23
            echo "                                <option value=\"";
            echo $this->getAttribute($context["place"], "id", []);
            echo "\" ";
            if (($this->getAttribute($context["place"], "id", []) == $this->getAttribute(($context["data"] ?? null), "banner_place_id", []))) {
                echo "selected";
            }
            echo ">
                                    ";
            // line 24
            echo $this->getAttribute($context["place"], "name", []);
            echo " (";
            echo $this->getAttribute($context["place"], "width", []);
            echo "x";
            echo $this->getAttribute($context["place"], "height", []);
            echo ")</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['place'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "                        </select>
                    </div>
                    <div class=\"form-group\">
                        <label>
                            ";
        // line 30
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_link"        ,"banners"        ,        );
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
                        </label>
                        <input type=\"text\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "link", []));
        echo "\" name=\"link\" class=\"form-control\">
                    </div>
                    <div class=\"form-group\">
                        <label>
                            ";
        // line 36
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_alt_text"        ,"banners"        ,        );
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
                        </label>
                        <input type=\"text\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute(($context["data"] ?? null), "alt_text", []));
        echo "\" name=\"alt_text\" class=\"form-control\">
                    </div>
                    <div class=\"form-group\">
                        <span class=\"btn btn-primary-inverted btn-file\">
                            ";
        // line 42
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_image"        ,"banners"        ,        );
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
        echo "<input type=\"file\" value=\"\" name=\"banner_image_file\">
                        </span>
                        <span id=\"upload-name\"></span>
                    </div>
                </div>
                <div class=\"b\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_save\" value=\"";
        // line 48
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_send"        ,"start"        ,""        ,"button"        ,        );
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

                    <a href=\"";
        // line 50
        echo ($context["site_url"] ?? null);
        echo "users/account/banners\" class=\"btn btn-cancel\">
                        ";
        // line 51
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("link_back_to_my_banners"        ,"banners"        ,        );
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
        // line 52
        echo "                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class=\"clr\"></div>
<script>
    \$(function () {
        \$(\"input[name=banner_image_file]\").change(function () {
            \$(\"#upload-name\").html('&nbsp;' + \$(this).val());
        });
    });
</script>
";
        // line 66
        $this->loadTemplate("@app/footer.twig", "my_form.twig", 66)->display($context);
    }

    public function getTemplateName()
    {
        return "my_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 66,  296 => 52,  275 => 51,  271 => 50,  247 => 48,  219 => 42,  212 => 38,  188 => 36,  181 => 32,  157 => 30,  151 => 26,  139 => 24,  130 => 23,  126 => 22,  101 => 19,  94 => 15,  70 => 13,  63 => 9,  59 => 7,  38 => 6,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "my_form.twig", "/home/mliadov/public_html/application/modules/banners/views/flatty/my_form.twig");
    }
}
