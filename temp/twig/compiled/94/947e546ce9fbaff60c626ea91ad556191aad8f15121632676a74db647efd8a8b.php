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

/* helper_add_funds.twig */
class __TwigTemplate_6fe81932ceb71f643459b87218b504b82576d6481e2721aac7b6ddd2bee1c07f extends \Twig\Template
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
        if ( !($context["id_user"] ?? null)) {
            // line 2
            echo "<a onclick=\"";
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("users"            ,"btn_add_funds"            ,            );
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
            echo "\" id=\"btn_add_funds\" href=\"javascript:void(0)\">
    ";
            // line 3
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_add_funds"            ,"users_payments"            ,            );
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
            // line 4
            echo "</a>
";
        } else {
            // line 6
            echo "    <a onclick=\"";
            $module =             null;
            $helper =             'start';
            $name =             'setAnalytics';
            $params = array("users"            ,"btn_add_funds"            ,            );
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
            echo "\" class=\"btn_add_funds_user\" data-id_user=\"";
            echo ($context["id_user"] ?? null);
            echo "\" href=\"javascript:void(0)\">
        ";
            // line 7
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("link_add_funds"            ,"users_payments"            ,            );
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
            echo "    </a>
";
        }
        // line 10
        echo "
";
        // line 11
        if ( !($context["id_user"] ?? null)) {
            // line 12
            echo "<script type=\"text/javascript\">
    var add_funds_link = \"";
            // line 13
            echo ($context["site_url"] ?? null);
            echo "admin/users_payments/ajax_add_funds\";
    var add_funds_form_link = \"";
            // line 14
            echo ($context["site_url"] ?? null);
            echo "admin/users_payments/ajax_add_funds_form\";
    \$(function() {
        loading_funds = new loadingContent({
            closeBtnPadding: '15',
            closeBtnClass: 'close',
            loadBlockSize: 'small',
            loadBlockTitle: '";
            // line 20
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("header_add_funds_selected"            ,"users_payments"            ,            );
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
            echo "',
            footerButtons: '<button type=\"button\" class=\"btn btn-success add_funds_btn\"  data-id_user=\"\" name=\"btn_save\" onclick=\"javascript: send_add_funds();\">";
            // line 21
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("btn_add"            ,"start"            ,""            ,"button"            ,            );
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
            echo "</button>'
        });
        \$('#btn_add_funds').click(function() {
            open_add_funds(add_funds_form_link);
            return false;
        });
    });
    function open_add_funds(url, id = null){
        \$.ajax({
            url: url,
            type: 'GET',
            cache: false,
            success: function(data){
                loading_funds.show_load_block(data);
                if(id) {
                    \$('.add_funds_btn').data('id_user', id);
                } else {
                    \$('.add_funds_btn').data('id_user', '');
                }
            }
        });
    }
    function send_add_funds(){
        var data = new Array();
        var id_user = \$('.add_funds_btn').data('id_user');
        if(id_user) {
            data[0] = id_user;
        } else {
            \$('.grouping:checked').each(function(i){
                data[i] = \$(this).val();
            });
        }

        if(data.length > 0){
            \$.ajax({
                url: add_funds_link,
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: {amount: \$('#add_fund_amount').val(), user_ids: data},
                success: function(data){
                    if(typeof(data.error) != 'undefined' && data.error != ''){
                        error_object.show_error_block(data.error, 'error');
                    }else{
                        if (loading_funds){
                            loading_funds.destroy();
                        }
                        error_object.show_error_block('";
            // line 68
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("success_add"            ,"users_payments"            ,""            ,"js"            ,            );
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
            echo "', 'success');
                        setTimeout(function (){location.reload()},2000)
                    }
                }
            });
        }else{
            error_object.show_error_block('";
            // line 74
            $module =             null;
            $helper =             'lang';
            $name =             'l';
            $params = array("error_no_users_to_add_funds"            ,"users_payments"            ,""            ,"js"            ,            );
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
            echo "', 'error');
        }
    }
</script>
";
        } else {
            // line 79
            echo "<script type=\"text/javascript\">
    \$(function() {
        \$('.btn_add_funds_user').unbind('click').on('click', function() {
            open_add_funds(add_funds_form_link, \$(this).data('id_user'));
            return false;
        });
    });
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "helper_add_funds.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  300 => 79,  273 => 74,  245 => 68,  176 => 21,  153 => 20,  144 => 14,  140 => 13,  137 => 12,  135 => 11,  132 => 10,  128 => 8,  107 => 7,  81 => 6,  77 => 4,  56 => 3,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "helper_add_funds.twig", "/home/mliadov/public_html/application/modules/users_payments/views/gentelella/helper_add_funds.twig");
    }
}
