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

/* edit_tracker_form.twig */
class __TwigTemplate_2ad01a2953a11e82c88d845de6b020d959603a107479a7c63519c38ca0ff574e extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "edit_tracker_form.twig", 1)->display($context);
        // line 2
        echo "
<form class=\"x_panel form-horizontal\" method=\"post\" action=\"";
        // line 3
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\" name=\"save_form\">
\t<div class=\"x_title h4\">
\t\t\t";
        // line 5
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_header_seo_tracker_editing"        ,"seo_advanced"        ,        );
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
\t<div class=\"x_content\">
\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
\t\t\t\t";
        // line 9
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_use_ga_tracker"        ,"seo_advanced"        ,        );
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
        echo ": </label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"1\" ";
        // line 11
        if ($this->getAttribute(($context["data"] ?? null), "seo_ga_default_activate", [])) {
            echo "checked";
        }
        echo " name=\"seo_ga_default_activate\" id=\"ga_active_yes\">
\t\t\t\t<label for=\"ga_active_yes\">";
        // line 12
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("use_ga_tracker_yes"        ,"seo_advanced"        ,        );
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
        echo "</label>&nbsp;
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"0\" ";
        // line 13
        if ( !$this->getAttribute(($context["data"] ?? null), "seo_ga_default_activate", [])) {
            echo "checked";
        }
        echo " name=\"seo_ga_default_activate\" id=\"ga_active_no\">
\t\t\t\t<label for=\"ga_active_no\">";
        // line 14
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("use_ga_tracker_no"        ,"seo_advanced"        ,        );
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
        echo "</label>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
\t\t\t\t";
        // line 20
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_ga_account_id"        ,"seo_advanced"        ,        );
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
        echo ": </label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12\">
\t\t\t\t<input class=\"form-control\" type=\"text\" value=\"";
        // line 22
        echo $this->getAttribute(($context["data"] ?? null), "seo_ga_default_account_id", []);
        echo "\" name=\"seo_ga_default_account_id\" id=\"input_ga_active\" ";
        if ( !$this->getAttribute(($context["data"] ?? null), "seo_ga_default_activate", [])) {
            echo "disabled";
        }
        echo ">
\t\t\t</div>
\t\t</div>

\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">&nbsp;</label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">";
        // line 28
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("ga_tracker_hint"        ,"seo_advanced"        ,        );
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
\t\t</div>

\t\t<!-- other trackers -->
\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
\t\t\t\t";
        // line 34
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_use_other_tracker"        ,"seo_advanced"        ,        );
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
        echo ": </label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"1\" ";
        // line 36
        if ($this->getAttribute(($context["data"] ?? null), "seo_ga_manual_activate", [])) {
            echo "checked";
        }
        echo " name=\"seo_ga_manual_activate\" id=\"other_active_yes\">
\t\t\t\t<label for=\"other_active_yes\">";
        // line 37
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("use_ga_tracker_yes"        ,"seo_advanced"        ,        );
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
        echo "</label>&nbsp;
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"0\" ";
        // line 38
        if ( !$this->getAttribute(($context["data"] ?? null), "seo_ga_manual_activate", [])) {
            echo "checked";
        }
        echo " name=\"seo_ga_manual_activate\" id=\"other_active_no\">
\t\t\t\t<label for=\"other_active_no\">";
        // line 39
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("use_ga_tracker_no"        ,"seo_advanced"        ,        );
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
        echo "</label>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
\t\t\t\t";
        // line 44
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_code_placement"        ,"seo_advanced"        ,        );
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
        echo ": </label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"top\" ";
        // line 46
        if (($this->getAttribute(($context["data"] ?? null), "seo_ga_manual_placement", []) == "top")) {
            echo "checked";
        }
        echo " name=\"seo_ga_manual_placement\" id=\"other_top\">
\t\t\t\t<label for=\"other_top\">";
        // line 47
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("tracker_top"        ,"seo_advanced"        ,        );
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
        echo "</label>&nbsp;
\t\t\t\t<input type=\"radio\" class=\"flat\" value=\"footer\" ";
        // line 48
        if (($this->getAttribute(($context["data"] ?? null), "seo_ga_manual_placement", []) == "footer")) {
            echo "checked";
        }
        echo " name=\"seo_ga_manual_placement\" id=\"other_footer\">
\t\t\t\t<label for=\"other_footer\">";
        // line 49
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("tracker_footer"        ,"seo_advanced"        ,        );
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
        echo "</label>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
\t\t\t\t";
        // line 54
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("field_other_code"        ,"seo_advanced"        ,        );
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
        echo ": </label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12\"><textarea class=\"form-control\" name=\"seo_ga_manual_tracker_code\" id=\"input_other_active\" style=\"height: 170px\" ";
        // line 55
        if ( !$this->getAttribute(($context["data"] ?? null), "seo_ga_manual_activate", [])) {
            echo "disabled";
        }
        echo ">";
        echo $this->getAttribute(($context["data"] ?? null), "seo_ga_manual_tracker_code", []);
        echo "</textarea></div>
\t\t</div>
\t\t<!-- other trackers -->

\t\t<div class=\"row form-group\">
\t\t\t<label class=\"control-label col-md-3 col-sm-3 col-xs-12\">&nbsp;</label>
\t\t\t<div class=\"col-md-9 col-sm-9 col-xs-12 data-label\">";
        // line 61
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("other_tracker_hint"        ,"seo_advanced"        ,        );
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
\t\t</div>
\t\t<div class=\"ln_solid\"></div>
\t\t<div class=\"row form-group\">
\t\t\t<div class=\"col-md-offset-3 col-sm-offset-3 col-md-9 col-sm-9 col-xs-12\">
\t\t\t\t<input class=\"btn btn-success\" type=\"submit\" name=\"btn_save\" value=\"";
        // line 66
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_save"        ,"start"        ,""        ,"button"        ,        );
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
\t\t\t\t<a class=\"btn btn-default\" href=\"";
        // line 67
        echo ($context["site_url"] ?? null);
        echo "admin/seo_advanced\">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("btn_cancel"        ,"start"        ,        );
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
\t\t\t</div>
\t\t</div>
\t</div>
</form>

<script>
\tfunction check_tag(gid, checked){
\t\tif (checked) {
\t\t\t\$('#input_'+gid).removeAttr(\"disabled\");
\t\t}else{
\t\t\t\$('#input_'+gid).attr('disabled', 'disabled');
\t\t}
\t}

    \$(function() {
        \$('#ga_active_yes').on('click', function() {
            check_tag('ga_active', true);
        });

        \$('#ga_active_no').on('click', function() {
            check_tag('ga_active', false);
        });

        \$('#other_active_yes').on('click', function() {
            check_tag('other_active', true);
        });

        \$('#other_active_no').on('click', function() {
            check_tag('other_active', false);
        });
    });
</script>

";
        // line 101
        $this->loadTemplate("@app/footer.twig", "edit_tracker_form.twig", 101)->display($context);
    }

    public function getTemplateName()
    {
        return "edit_tracker_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  534 => 101,  476 => 67,  453 => 66,  426 => 61,  413 => 55,  390 => 54,  363 => 49,  357 => 48,  334 => 47,  328 => 46,  304 => 44,  277 => 39,  271 => 38,  248 => 37,  242 => 36,  218 => 34,  190 => 28,  177 => 22,  153 => 20,  125 => 14,  119 => 13,  96 => 12,  90 => 11,  66 => 9,  40 => 5,  35 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "edit_tracker_form.twig", "/home/mliadov/public_html/application/modules/seo_advanced/views/gentelella/edit_tracker_form.twig");
    }
}
