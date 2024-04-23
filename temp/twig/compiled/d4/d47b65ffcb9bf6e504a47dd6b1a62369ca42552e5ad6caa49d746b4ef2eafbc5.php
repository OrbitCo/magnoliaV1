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

/* settings.twig */
class __TwigTemplate_7f68fe17790782b770b8b531098d2e55ce8e4c7967b4219d3f2acc058623c4c1 extends \Twig\Template
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
        $this->loadTemplate("@app/header.twig", "settings.twig", 1)->display($context);
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
        $params = array("admin_virtual_gifts_menu"        ,        );
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
        <div class=\"x_content\">
            <form method=\"post\" enctype=\"multipart/form-data\" data-parsley-validate
                  class=\"form-horizontal form-label-left\" name=\"save_form\"
                  action=\"";
        // line 13
        echo $this->getAttribute(($context["data"] ?? null), "action", []);
        echo "\">
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 16
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("gift_price_default"        ,"virtual_gifts"        ,        );
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
        echo " (";
        $module =         null;
        $helper =         'start';
        $name =         'currency_format_output';
        $params = array($this->getAttribute(($context["item"] ?? null), "price", [])        ,        );
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
        echo "):</label>
                    <div class=\"col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
        // line 18
        echo $this->getAttribute(($context["data"] ?? null), "price_default", []);
        echo "\" name=\"price_default\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 23
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_items_per_page"        ,"virtual_gifts"        ,        );
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
                    <div class=\"col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
        // line 25
        echo $this->getAttribute(($context["data"] ?? null), "admin_items_per_page", []);
        echo "\" name=\"admin_items_per_page\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 30
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("user_items_per_page"        ,"virtual_gifts"        ,        );
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
                    <div class=\"col-sm-9 col-xs-12\">
                        <input type=\"text\" value=\"";
        // line 32
        echo $this->getAttribute(($context["data"] ?? null), "user_items_per_page", []);
        echo "\" name=\"user_items_per_page\" class=\"form-control\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3 col-xs-12\">
                      ";
        // line 37
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_payment_type"        ,"virtual_gifts"        ,        );
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
                    <div class=\"col-sm-9 col-xs-12\">
                        <input class=\"flat\" type=\"radio\" name=\"payment_type\" value=\"account\" ";
        // line 39
        if (($this->getAttribute(($context["data"] ?? null), "payment_type", []) == "account")) {
            echo "checked";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_payment_type_account"        ,"virtual_gifts"        ,        );
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
        echo "<br>
                        <input class=\"flat\" type=\"radio\" name=\"payment_type\" value=\"direct\" ";
        // line 40
        if (($this->getAttribute(($context["data"] ?? null), "payment_type", []) == "direct")) {
            echo "checked";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_payment_type_direct"        ,"virtual_gifts"        ,        );
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
        echo "<br>
                        <input class=\"flat\" type=\"radio\" name=\"payment_type\" value=\"account_and_direct\" ";
        // line 41
        if (($this->getAttribute(($context["data"] ?? null), "payment_type", []) == "account_and_direct")) {
            echo "checked";
        }
        echo ">";
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("admin_payment_type_both"        ,"virtual_gifts"        ,        );
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
        // line 42
        echo "                    </div>
                </div>
                <div class=\"ln_solid\"></div>
                <div class=\"form-group\">
                    <div class=\"col-sm-9 col-xs-12 col-sm-offset-3\">
                        <input type=\"submit\" name=\"btn_save\" value=\"";
        // line 47
        $module =         null;
        $helper =         'lang';
        $name =         'l';
        $params = array("save_settings"        ,"virtual_gifts"        ,        );
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
        echo "\" class=\"btn btn-success\">
                        <a class=\"btn btn-default\" href=\"";
        // line 48
        echo ($context["site_url"] ?? null);
        echo "admin/start/menu/add_ons_items\">
                          ";
        // line 49
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
                    </div>
                </div>
            </form>
\t</div>
    </div>
</div>
<div class=\"clearfix\"></div>
<script>
\$(function(){
    guides_open = new loadingContent({
        loadBlockWidth: '620px',
        loadBlockLeftType: 'center',
        loadBlockTopType: 'center',
        loadBlockTopPoint: 100,
        closeBtnClass: 'w'
    }).update_css_styles({'z-index': 2000}).update_css_styles({'z-index': 2000}, 'bg');
    \$('#gid_shipping').unbind('click').click(function(){
        \$.ajax({
            url: site_url + 'admin/store/ajax_gid_shipping',
            cache: false,
            success: function(data){
                    guides_open.show_load_block(data);
            }
        });
        return false;
    });
});
</script>

";
        // line 79
        $this->loadTemplate("@app/footer.twig", "settings.twig", 79)->display($context);
    }

    public function getTemplateName()
    {
        return "settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  379 => 79,  327 => 49,  323 => 48,  300 => 47,  293 => 42,  268 => 41,  241 => 40,  214 => 39,  190 => 37,  182 => 32,  158 => 30,  150 => 25,  126 => 23,  118 => 18,  73 => 16,  67 => 13,  60 => 8,  39 => 7,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "settings.twig", "/home/mliadov/public_html/application/modules/virtual_gifts/views/gentelella/settings.twig");
    }
}
